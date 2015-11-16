<?php

/**
 * @author jegbagus
 */

// section navigator need here to be global
$sectionnavigator = array();
$jkreativplugincompatible = '1.2.1';

locate_template(array('lib/init.php'), true, true);								// initialize
locate_template(array('lib/init-widget.php'), true, true);						// widget
locate_template(array('lib/init-image.php'), true, true);						// image functionality
locate_template(array('lib/themes-functionality.php'), true, true);				// additional themes functionality
locate_template(array('lib/build-shortcode.php'), true, true);					// build shortcode
locate_template(array('lib/init-menu.php'), true, true);						// initialize menu
locate_template(array('lib/admin.php'), true, true);							// back end
locate_template(array('lib/ajax-response.php'), true, true);					// response ajax
locate_template(array('lib/scriptstyle.php'), true);						    // loading style & script
locate_template(array('lib/jkreativ-customizer.php'), true, true);				// customizer
locate_template(array('tgm/class-tgm-plugin-activation.php'), true, true);		// tgm plugin
locate_template(array('tgm/plugin-list.php'), true, true);						// tgm plugin list
locate_template(array('lib/update-notice.php'), true, true);					// jkreativ plugin check

/** for demo purpose
require_once locate_template('/demo/demo.php');
*/

add_action('init', 'app_output_buffer');
function app_output_buffer() {
    ob_start();
}
add_action('wp_head', 'add_google_code');
function add_google_code(){
    global $post;
    if($post->post_name == "thank-you-for-your-registration"){
        echo '<!-- Google Code for Curtain Boutique conversion Conversion Page -->

<script type="text/javascript">

/* <![CDATA[ */

var google_conversion_id = 1006433622;

var google_conversion_language = "en";

var google_conversion_format = "3";

var google_conversion_color = "ffffff";

var google_conversion_label = "BtpUCJK50gMQ1urz3wM";

var google_conversion_value = 1.00;

var google_conversion_currency = "SGD";

var google_remarketing_only = false;

/* ]]> */

</script>

<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">

</script>

<noscript>

<div style="display:inline;">

<img height="1" width="1" style="border-style:none;" alt="" src="//www.googleadservices.com/pagead/conversion/1006433622/?value=1.00&amp;currency_code=SGD&amp;label=BtpUCJK50gMQ1urz3wM&amp;guid=ON&amp;script=0"/>

</div>

</noscript>';
    }
}