<?php
define("TCP_PATH",plugin_dir_path(__FILE__));
define("TCP_TEMPLATE_PATH", TCP_PATH . "templates/");
define("TCP_TEMPLATE_FRONT_PATH", TCP_PATH . "template_frontend/");

include_once(TCP_PATH . "classes/tcb_custom_cf7.php");
include_once(TCP_PATH . "classes/tcb_add_html.php");
include_once(TCP_PATH . "libs/functions.php");
//include_once(TCP_PATH . "classes/tcb_template_page.php");
add_action("init", "tcb_register_shortcode");
function tcb_register_shortcode(){
    //feedback shortcode
    $tcb_cf7 = new tcb_custom_cf7("feedback");
    $tcb_cf7->setTemplate(TCP_TEMPLATE_PATH . "feedback_form.php");

    $fromSource = new tcb_input_checkbox("fromSource");
    $fromSource->set_checkbox(array("Advertisement", "Designer", "Facebook", "Referral from friends/relatives", "Search Engine", "Walk-in"));
    $fromSource->addToShortcode($tcb_cf7, "fromSource");

    $array_name = array("Attitude","Product Knowledge", "Responsiveness");
    $array_opt = array("Excellent", "Good", "Average", "Poor");
    $option_grp = new tcb_group_radio($array_name, $array_opt, "salesperson");
    $option_grp->addToShortcode($tcb_cf7, "optionGroup_1");

    $array_name = array("Attitude","Punctuality", "Tidiness of the work done", "Workmanship");
    $option_grp = new tcb_group_radio($array_name, $array_opt, "installer");
    $option_grp->addToShortcode($tcb_cf7, "optionGroup_2");

//warranty shortcode
    $tcb_warranty = new tcb_custom_cf7("warranty");
    $tcb_warranty->setTemplate(TCP_TEMPLATE_PATH . "warranty_form.php");

    $salutation_arr = array("Mr", "Mrs", "Ms", "Mdm", "Dr", "Prof");
    $radio_salutation = new tcb_input_radio("title");
    $radio_salutation->set_option($salutation_arr);
    $radio_salutation->addToShortcode($tcb_warranty, "title");

    $text_surname = new tcb_input_text("surname");
    $text_surname->addToShortcode($tcb_warranty, "surname");

    $text_surname = new tcb_input_text("given name");
    $text_surname->addToShortcode($tcb_warranty, "given_name");

    $text_surname = new tcb_input_text("NRIC FIN");
    $text_surname->addToShortcode($tcb_warranty, "NRIC_FIN");

    $text_surname = new tcb_input_text("DATE OF BIRTH");
    $text_surname->addToShortcode($tcb_warranty, "dob");

//    $nationality_arr = array("Singapore Citizen", "Singapore PR");
//    $radio_nationality = new tcb_input_radio("nationality");
//    $radio_nationality->set_option($nationality_arr);
//    $radio_nationality->addToShortcode($tcb_warranty, "nationality");

    $text_surname = new tcb_input_text("block");
    $text_surname->addToShortcode($tcb_warranty, "block");

    $text_strname = new tcb_input_text("street name");
    $text_strname->addToShortcode($tcb_warranty, "street_name");

    $text_postalcode = new tcb_input_text("POSTAL CODE");
    $text_postalcode->addToShortcode($tcb_warranty, "postal_code");

    $text_contact = new tcb_input_text("CONTACT");
    $text_contact->addToShortcode($tcb_warranty, "contact");

    $text_invoice = new tcb_input_text("INVOICE NO");
    $text_invoice->addToShortcode($tcb_warranty, "invoice_no");

    $text_doIntall = new tcb_input_text("DATE OF INSTALLATION");
    $text_doIntall->addToShortcode($tcb_warranty, "date_of_installation");

    $text_email = new tcb_input_text("Email");
    $text_email->addToShortcode($tcb_warranty, "email");

    $checkbox_Agree = new tcb_input_checkbox("agree");
    $checkbox_Agree->set_checkbox(array("agree"));
    $checkbox_Agree->addToShortcode($tcb_warranty, "agree");

//refferal shortcode
    $tcb_referral = new tcb_custom_cf7("referral");
    $tcb_referral->setTemplate(TCP_TEMPLATE_PATH . "referral_form.php");

//referral 1
    $salutation_arr = array("Mr", "Mrs", "Ms", "Mdm", "Dr", "Prof");
    $radio_salutation = new tcb_input_radio("title");
    $radio_salutation->set_name("title_1");
    $radio_salutation->set_option($salutation_arr);
    $radio_salutation->addToShortcode($tcb_referral, "title_1");

    $text_surname = new tcb_input_text("surname");
    $text_surname->set_name("surname_1");
    $text_surname->addToShortcode($tcb_referral, "surname_1");

    $text_givenname = new tcb_input_text("given name");
    $text_givenname->set_name("given_name_1");
    $text_givenname->addToShortcode($tcb_referral, "given_name_1");

//    $nationality_arr = array("Singapore Citizen", "Singapore PR");
//    $radio_nationality = new tcb_input_radio("nationality");
//    $radio_nationality->set_name("nationality_1");
//    $radio_nationality->set_option($nationality_arr);
//    $radio_nationality->addToShortcode($tcb_referral, "nationality_1");

    $text_contact = new tcb_input_text("CONTACT");
    $text_contact->set_name("contact_1");
    $text_contact->addToShortcode($tcb_referral, "contact_1");

    $text_email = new tcb_input_text("Email");
    $text_email->set_name("email_1");
    $text_email->addToShortcode($tcb_referral, "email_1");

//referral 2
    $radio_salutation = new tcb_input_radio("title");
    $radio_salutation->set_name("title_2");
    $radio_salutation->set_option($salutation_arr);
    $radio_salutation->addToShortcode($tcb_referral, "title_2");

    $text_surname = new tcb_input_text("surname");
    $text_surname->set_name("surname_2");
    $text_surname->addToShortcode($tcb_referral, "surname_2");

    $text_givenname = new tcb_input_text("given name");
    $text_givenname->set_name("given_name_2");
    $text_givenname->addToShortcode($tcb_referral, "given_name_2");

//    $radio_nationality = new tcb_input_radio("nationality");
//    $radio_nationality->set_name("nationality_2");
//    $radio_nationality->set_option($nationality_arr);
//    $radio_nationality->addToShortcode($tcb_referral, "nationality_2");

    $text_contact = new tcb_input_text("CONTACT");
    $text_contact->set_name("contact_2");
    $text_contact->addToShortcode($tcb_referral, "contact_2");

    $text_email = new tcb_input_text("Email");
    $text_email->set_name("email_2");
    $text_email->addToShortcode($tcb_referral, "email_2");

//referral 3
    $radio_salutation = new tcb_input_radio("title");
    $radio_salutation->set_name("title_3");
    $radio_salutation->set_option($salutation_arr);
    $radio_salutation->addToShortcode($tcb_referral, "title_3");

    $text_surname = new tcb_input_text("surname");
    $text_surname->set_name("surname_3");
    $text_surname->addToShortcode($tcb_referral, "surname_3");

    $text_givenname = new tcb_input_text("given name");
    $text_givenname->set_name("given_name_3");
    $text_givenname->addToShortcode($tcb_referral, "given_name_3");

//    $radio_nationality = new tcb_input_radio("nationality");
//    $radio_nationality->set_name("nationality_3");
//    $radio_nationality->set_option($nationality_arr);
//    $radio_nationality->addToShortcode($tcb_referral, "nationality_3");

    $text_contact = new tcb_input_text("CONTACT");
    $text_contact->set_name("contact_3");
    $text_contact->addToShortcode($tcb_referral, "contact_3");

    $text_email = new tcb_input_text("Email");
    $text_email->set_name("email_3");
    $text_email->addToShortcode($tcb_referral, "email_3");

    $checkbox_Agree = new tcb_input_checkbox("agree");
    $checkbox_Agree->set_checkbox(array("agree"));
    $checkbox_Agree->addToShortcode($tcb_referral, "agree");

//refferal shortcode
    global $current_user;
    $point = esc_attr( get_the_author_meta( 'point', $current_user->ID ) );
    $tcb_redeem= new tcb_custom_cf7("redeem");
    $tcb_redeem->setTemplate(TCP_TEMPLATE_PATH . "redeem_form.php");

    $text_surname = new tcb_input_text("surname");
    $text_surname->setDefaultVal($current_user->last_name);
    $text_surname->addToShortcode($tcb_redeem);

    $text_point = new tcb_input_text("point");
    $text_point->setDefaultVal($point);
    $text_point->addToShortcode($tcb_redeem);
}

function tcb_load_scripts() {
    wp_register_script(
        'tcb_uijs',
        plugins_url( '/assets/js/jquery-ui.min.js', __FILE__ ),
        array( 'jquery' )
    );
    wp_enqueue_script( 'tcb_uijs' );
    wp_register_script(
        'tcb_jquery.validate.min.js',
        plugins_url( '/assets/js/jquery.validate.min.js', __FILE__ ),
        array( 'jquery' )
    );
    wp_enqueue_script( 'tcb_jquery.validate.min.js' );
    wp_register_script(
        'tcb_scriptjs',
        plugins_url( '/assets/js/scripts.js', __FILE__ ),
        array( 'jquery' )
    );
    wp_enqueue_script( 'tcb_scriptjs' );
    wp_register_script(
        'jquery.bpopup.min',
        plugins_url( '/assets/js/jquery.bpopup.min.js', __FILE__ ),
        array( 'jquery' )
    );
    wp_enqueue_script( 'jquery.bpopup.min' );

    wp_register_style('tcb_jquery-ui.min-css', plugins_url( '/assets/css/jquery-ui.min.css', __FILE__ ) );
    wp_enqueue_style('tcb_jquery-ui.min-css'); // Enqueue it!
    wp_register_style('tcb_jquery-ui.structure.min-css', plugins_url( '/assets/css/jquery-ui.structure.min.css', __FILE__ ) );
    wp_enqueue_style('tcb_jquery-ui.structure.min-css'); // Enqueue it!
//    wp_register_style('tcb_jquery-ui.theme.min-css', plugins_url( '/assets/css/jquery-ui.theme.min.css', __FILE__ ) );
//    wp_enqueue_style('tcb_jquery-ui.theme.min-css'); // Enqueue it!
    wp_register_style('style-css', plugins_url( '/assets/css/style.css', __FILE__ ) );
    wp_enqueue_style('style-css'); // Enqueue it!
    if(is_user_logged_in()){
        wp_register_style('login-css', plugins_url( '/assets/css/login-css.css', __FILE__ ) );
        wp_enqueue_style('login-css'); // Enqueue it!
    }

}
add_action('init', 'tcb_load_scripts');