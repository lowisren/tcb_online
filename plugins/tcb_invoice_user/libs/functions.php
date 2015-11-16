<?php
add_action( 'wpcf7_mail_sent', 'tcb_mail_sent_function' );
function tcb_mail_sent_function( $contact_form ) {
    $title = $contact_form->title;
    $submission = WPCF7_Submission::get_instance();

    if ( $submission ) {
        $posted_data = $submission->get_posted_data();
    }
    if ( 'referralForm' == $title ) {

        $current_user = wp_get_current_user();
        $mail = $contact_form->prop('mail');
        for($i = 1; $i <= $posted_data["element-counter"]; $i++){
            add_filter( 'wp_mail_content_type', 'set_html_content_type' );
            $headers = "From: " . $mail["sender"] . "\r\n";
            if(!$posted_data["email_" . $i]){
                continue;
            }

            ob_start();
            include(TCP_TEMPLATE_PATH . "referral_email.php");
            $message = ob_get_contents();
            ob_end_clean();

            wp_mail($posted_data["email_" . $i], 'e-Voucher from ' . $current_user->user_lastname . " " . $current_user->user_firstname, $message, $headers);
            remove_filter( 'wp_mail_content_type', 'set_html_content_type' );
        }

//        add_filter( 'wp_mail_content_type', 'set_html_content_type' );
//        add_filter('wp_mail_from','tcb_website_email');
//        add_filter('wp_mail_from_name','tcb_website_name');
//
//        ob_start();
//        include(TCP_TEMPLATE_PATH . "referral_email_to_admin.php");
//        $message = ob_get_contents();
//        ob_end_clean();
//
//        wp_mail(get_bloginfo("admin_email"), "Referral form" , $message);
//        remove_filter( 'wp_mail_content_type', 'set_html_content_type' );
//        remove_filter('wp_mail_from_name','tcb_website_name');
//        remove_filter('wp_mail_from','tcb_website_email');
    }
}

if(!function_exists("set_html_content_type")){
    function set_html_content_type() {
        return 'text/html';
    }
}


add_action("wpcf7_before_send_mail", "tcb_custom_mail_components");
function tcb_custom_mail_components($WPCF7_ContactForm) {
    $title = $WPCF7_ContactForm->title;

    if ( 'referralForm' == $title ) {
        $submission = WPCF7_Submission::get_instance();

        if ( $submission ) {
            $posted_data = $submission->get_posted_data();
        }

        $mail = $WPCF7_ContactForm->prop('mail');
        ob_start();
        include(TCP_TEMPLATE_PATH . "referral_email_to_admin.php");
        $message = ob_get_contents();
        ob_end_clean();

        $mail['body'] = str_replace('[referral_content]', $message , $mail['body'] );
        $WPCF7_ContactForm->set_properties( array( 'mail' => $mail ) );
    }
    if ( 'Warranty form' == $title ) {
        $submission = WPCF7_Submission::get_instance();

        if ( $submission ) {
            $posted_data = $submission->get_posted_data();
        }

        $password = $posted_data["nric_fin"];
        $user_email = $posted_data["email"];
        $mail = $WPCF7_ContactForm->prop('mail_2');
        $user_id = username_exists( $user_email );
        if ( !$user_id and email_exists($user_email) == false ) {
            $userdata = array(
                'user_login'  =>  $user_email,
                'user_pass'   =>  $password,
                'user_email' => $user_email,
                'first_name' => $posted_data["surname"],
                'last_name' => $posted_data["given_name"],
                'display_name' => $posted_data["given_name"]
            );
            $user_id = wp_insert_user( $userdata ) ;
            //update extra info for customer
            update_user_meta( $user_id, 'salutation', $posted_data['title'], get_the_author_meta( 'salutation', $user_id ) );
            update_user_meta( $user_id, 'nric_fin_user', $posted_data['nric_fin'], get_the_author_meta( 'nric_fin', $user_id ) );
            update_user_meta( $user_id, 'dob', $posted_data['date_of_birth'], get_the_author_meta( 'dob', $user_id ) );
            update_user_meta( $user_id, 'address_user', $posted_data['block'] . " " . $posted_data['street_name'], get_the_author_meta( 'address', $user_id ) );
            update_user_meta( $user_id, 'postal_code', $posted_data['postal_code'], get_the_author_meta( 'postal_code', $user_id ) );
            update_user_meta( $user_id, 'phone', $posted_data['contact'], get_the_author_meta( 'phone', $user_id ) );

            $message = "<div>Username: " . $user_email . "</div><div>Password: " . $password . "</div>";

            $mail['body'] = str_replace('[user_pass]', $message , $mail['body'] );
            $WPCF7_ContactForm->set_properties( array( 'mail_2' => $mail ) );

            global $wpdb;
            $sql = "INSERT INTO {$wpdb->wrranty_db_table} (invoiceId, address, contact, date_of_installation, wrranty_date, user_id) ";
            $sql .= " VALUES ('". $posted_data["invoice_no"] ."', '" . $posted_data['block'] . " " . $posted_data['street_name'] . "' , '" . $posted_data['contact'] . "' , '" . $posted_data["date_of_installation"] . "', '', '" . $user_id . "') ";
            $wpdb->query($sql);
        }
        else{
//            $WPCF7_ContactForm->skip_mail = true;
            $mail['body'] = "";
            $WPCF7_ContactForm->set_properties( array( 'mail_2' => $mail ) );
        }
    }
}