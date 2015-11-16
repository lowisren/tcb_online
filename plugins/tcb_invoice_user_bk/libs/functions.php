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

        for($i = 1; $i <= 3; $i++){
            add_filter( 'wp_mail_content_type', 'set_html_content_type' );
            add_filter('wp_mail_from','tcb_website_email');
            add_filter('wp_mail_from_name','tcb_website_name');
            if(!$posted_data["email_" . $i]){
                continue;
            }

            ob_start();
            include(TCP_TEMPLATE_PATH . "referral_email.php");
            $message = ob_get_contents();
            ob_end_clean();

            wp_mail($posted_data["email_" . $i], 'e-Voucher from ' . $current_user->user_firstname . " " . $current_user->user_lastname, $message);
            remove_filter( 'wp_mail_content_type', 'set_html_content_type' );
            remove_filter('wp_mail_from_name','tcb_website_name');
            remove_filter('wp_mail_from','tcb_website_email');
        }
    }
}

if(!function_exists("set_html_content_type")){
    add_filter( 'wp_mail_content_type', 'set_html_content_type' );
    function set_html_content_type() {
        return 'text/html';
    }
}

add_filter('wp_mail_from','tcb_website_email');
add_filter('wp_mail_from_name','tcb_website_name');

function tcb_website_email() {
    $sender_email= get_bloginfo("admin_email");
    return $sender_email;
}
function tcb_website_name(){
    $site_name = get_bloginfo("name");;
    return $site_name;
}
