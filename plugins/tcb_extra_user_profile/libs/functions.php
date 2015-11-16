<?php
function get_id_by_slug($page_slug) {
    $page = get_page_by_path($page_slug);
    if ($page) {
        return $page->ID;
    } else {
        return null;
    }
}
function create_dwb_menu() {
    if ( is_super_admin())
        return;
    global $wp_admin_bar;
    $current_user = wp_get_current_user();

    $userinfo = $wp_admin_bar->get_node( 'user-info' );
    $userinfo->href = get_permalink(get_id_by_slug("members-dashboard"));
    $avatar = get_avatar( $userinfo->ID, 64 );
    $userinfo->title = $avatar . $current_user->last_name;
    $array = (array) $userinfo;
    $wp_admin_bar->add_menu($array);

    $logout = $wp_admin_bar->get_node( 'logout' );
    $logout->href = wp_logout_url( get_permalink(get_id_by_slug("members-login")));
    $array = (array) $logout;
    $wp_admin_bar->add_menu($array);

    $sitename = $wp_admin_bar->get_node( 'site-name' );
    $sitename->href = home_url();
    $array = (array) $sitename;
    $wp_admin_bar->add_menu($array);

    $my_account = $wp_admin_bar->get_node( 'my-account' );
    $avatar = get_avatar( $userinfo->ID, 28 );
    $my_account->title = "Hello, $current_user->last_name" . $avatar;
    $array = (array) $my_account;
    $wp_admin_bar->add_menu($array);

    $wp_admin_bar->remove_node( 'edit-profile' );
    $wp_admin_bar->remove_node( 'wp-logo' );
    $wp_admin_bar->remove_node( 'dashboard' );
}
add_action('admin_bar_menu', 'create_dwb_menu', 2000);

add_action( 'init', 'blockusers_init' );
function blockusers_init() {
    if ( is_admin() && is_user_logged_in() && !current_user_can( 'administrator' ) &&
        ! ( defined( 'DOING_AJAX' ) && DOING_AJAX ) ) {
        wp_redirect( home_url() );
        exit;
    }
}


/**
 * Function Name: front_end_login_fail.
 * Description: This redirects the failed login to the custom login page instead of default login page with a modified url
 **/
add_action( 'wp_login_failed', 'front_end_login_fail' );
function front_end_login_fail( $username ) {

// Getting URL of the login page
    $referrer = $_SERVER['HTTP_REFERER'];
// if there's a valid referrer, and it's not the default log-in screen
    if( !empty( $referrer ) && !strstr( $referrer,'wp-login' ) && !strstr( $referrer,'wp-admin' ) ) {
        wp_redirect( get_permalink(get_id_by_slug("members-login")) . "?login=failed" );
        exit;
    }

}

/**
 * Function Name: check_username_password.
 * Description: This redirects to the custom login page if user name or password is   empty with a modified url
 **/
add_action( 'authenticate', 'check_username_password', 1, 3);
function check_username_password( $login, $username, $password ) {

// Getting URL of the login page
    $referrer = $_SERVER['HTTP_REFERER'];

// if there's a valid referrer, and it's not the default log-in screen
    if( !empty( $referrer ) && !strstr( $referrer,'wp-login' ) && !strstr( $referrer,'wp-admin' ) ) {
        if( $username == "" || $password == "" ){
            wp_redirect( get_permalink(get_id_by_slug("members-login")) . "?login=empty" );
            exit;
        }
    }

}

add_action( 'login_form_middle', 'add_lost_password_link' );
function add_lost_password_link() {
    $forget_pass = '<a href="' . wp_lostpassword_url() . '" title="Lost Password">Forgot Password?</a>';
    return $forget_pass;
}

add_action('admin_head', 'tcb_admin_css');

function tcb_admin_css() {
    echo '<style>
    #postimagediv{
        display: block;
    }
  </style>';
}


if ( !function_exists('wp_new_user_notification') ) {
    function wp_new_user_notification( $user_id, $plaintext_pass = '' ) {
        $user = new WP_User($user_id);

        $user_login = stripslashes($user->user_login);
        $user_email = stripslashes($user->user_email);
        $user_lastname = stripslashes($user->last_name);

        $message  = sprintf(__('New user registration on your blog %s:'), get_option('blogname')) . "\r\n\r\n";
        $message .= sprintf(__('Username: %s'), $user_login) . "\r\n\r\n";
        $message .= sprintf(__('E-mail: %s'), $user_email) . "\r\n";

        @wp_mail(get_option('admin_email'), sprintf(__('[%s] New User Registration'), get_option('blogname')), $message);

        if ( empty($plaintext_pass) )
            return;

        ob_start();
        include_once(TCB_PATH . "templates/template_registration.php");
        $message = ob_get_contents();
        ob_end_clean();


        add_filter( 'wp_mail_content_type', 'set_html_content_type' );
        add_filter('wp_mail_from','tcb_website_email');
        add_filter('wp_mail_from_name','tcb_website_name');
        wp_mail($user_email, sprintf(__('[%s] Account Login Details'), get_option('blogname')), $message);
        remove_filter( 'wp_mail_content_type', 'set_html_content_type' );
        remove_filter('wp_mail_from_name','tcb_website_name');
        remove_filter('wp_mail_from','tcb_website_email');
    }
}

add_filter("retrieve_password_message", "tcb_retrieve_password_message", 0, 4);
function tcb_retrieve_password_message($message, $key, $user_login, $user_data){
    $user_lastname = stripslashes($user_data->last_name);

    ob_start();
    include_once(TCB_PATH . "templates/template_reset_pass.php");
    $message = ob_get_contents();
    ob_end_clean();

    add_filter( 'wp_mail_content_type', 'set_html_content_type' );
    add_filter('wp_mail_from','tcb_website_email');
    add_filter('wp_mail_from_name','tcb_website_name');

    return $message;
}

add_filter('wp_login_errors', 'tcb_wp_login_errors', 0);
function tcb_wp_login_errors($errors){
    if(isset($_GET['checkemail']) && 'confirm' == $_GET['checkemail']){
        $errors->errors["confirm"][0] = "Please check your email for the password reset link.";
    }
    return $errors;
}

if(!function_exists("set_html_content_type")){
    function set_html_content_type() {
        return 'text/html';
    }
}

function tcb_website_email() {
    $sender_email= get_option( "main_email" );
    return $sender_email;
}
function tcb_website_name(){
    $site_name = get_option( "blogname" );
    return $site_name;
}

$tcb_new_general_setting = new tcb_new_general_setting();
class tcb_new_general_setting {
    function tcb_new_general_setting( ) {
        add_filter( 'admin_init' , array( &$this , 'register_fields' ) );
    }
    function register_fields() {
        register_setting( 'general', 'main_email', 'esc_attr' );
        add_settings_field('fav_email', '<label for="main_email">'.__('Add main email' , 'main_email' ).'</label>' , array(&$this, 'fields_html') , 'general' );
    }
    function fields_html() {
        $value = get_option( 'main_email', '' );
        echo '<input type="text" id="main_email" name="main_email" value="' . $value . '" />';
    }
}