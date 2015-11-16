<?php
/*
Plugin Name: TCB extra user's profile
Description: TCB extra user's profile field
Version: 1.0.0
*/
define("TCB_PATH",plugin_dir_path(__FILE__));
include_once(TCB_PATH . "libs/Custom_Table.php");
include_once(TCB_PATH . "libs/function-ajax.php");
include_once(TCB_PATH . "libs/Mobile_Detect.php");
include_once(TCB_PATH . "libs/functions.php");
add_action( 'show_user_profile', 'tcb_extra_user_profile_fields' );
add_action( 'edit_user_profile', 'tcb_extra_user_profile_fields' );
function tcb_extra_user_profile_fields( $user ) {
    global $wpdb;
    $result = $wpdb->get_results( "SELECT * FROM {$wpdb->wrranty_db_table} WHERE user_id = " . $_GET["user_id"], ARRAY_A);
    $user_meta = get_user_meta($user->ID);
    $key_t = 1;
    ?>
    <h3>Extra information</h3>
    <table class="form-table">
        <tr>
            <th><label for="salutation">SALUTATION</label></th>
            <td>
                <input type="text" name="salutation" id="salutation" value="<?php echo esc_attr( $user_meta['salutation'][0]); ?>" class="regular-text" />
            </td>
        </tr>
        <tr>
            <th><label for="nric_fin">NRIC/FIN</label></th>
            <td>
                <input type="text" name="nric_fin_user" id="nric_fin" value="<?php echo esc_attr( $user_meta['nric_fin_user'][0]); ?>" class="regular-text" />
            </td>
        </tr>
        <tr>
            <th><label for="dob">Date of birth</label></th>
            <td>
                <input type="text" name="dob" id="dob" value="<?php echo esc_attr( $user_meta['dob'][0]); ?>" class="regular-text datepicker" />
            </td>
        </tr>
<!--        <tr>-->
<!--            <th><label for="nationality">NATIONALITY</label></th>-->
<!--            <td>-->
<!--                <input type="text" name="nationality" id="nationality" value="--><?php //echo esc_attr( $user_meta['nationality'][0]); ?><!--" class="regular-text" />-->
<!--            </td>-->
<!--        </tr>-->
        <tr>
            <th><label for="address">ADDRESS</label></th>
            <td>
                <input type="text" name="address_user" id="address" value="<?php echo esc_attr( $user_meta['address_user'][0]); ?>" class="regular-text" />
            </td>
        </tr>
        <tr>
            <th><label for="postal_code">POSTAL CODE</label></th>
            <td>
                <input type="text" name="postal_code" id="postal_code" value="<?php echo esc_attr( $user_meta['postal_code'][0]); ?>" class="regular-text" />
            </td>
        </tr>
        <tr>
            <th><label for="phone">Phone</label></th>
            <td>
                <input type="text" name="phone" id="phone" value="<?php echo esc_attr( $user_meta['phone'][0]); ?>" class="regular-text" />
            </td>
        </tr>
    </table>
    <h3><?php _e("Invoice warranty information", "blank"); ?></h3>
    <input type="hidden" name="user_id" value="<?php echo $_GET["user_id"]; ?>"/>
    <table class="form-table tcb-invoice-table">
        <tr>
            <th><label><?php _e("Invoice Id"); ?></label></th>
<!--            <th><label>--><?php //_e("Name"); ?><!--</label></th>-->
<!--            <th><label>--><?php //_e("NRIC/FIN"); ?><!--</label></th>-->
            <th><label><?php _e("Address"); ?></label></th>
            <th><label><?php _e("Contact"); ?></label></th>
            <th><label><?php _e("Date of Installation"); ?></label></th>
            <th><label><?php _e("Warranty Started Date"); ?></label></th>
            <th>Edit</th>
        </tr>
        <?php
        if($result){
            foreach($result as $key=>$val){
            ?>
                <tr>
                    <td>
                        <input type="text" name="invoiceId[]" id="invoiceId_<?php echo $key_t; ?>" class="regular-text"
                               value="<?php echo $val["invoiceId"]?>" />
                    </td>
<!--                    <td>-->
<!--                        <input type="text" name="name[]" id="name_--><?php //echo $key_t; ?><!--" class="regular-text"-->
<!--                               value="--><?php //echo $val["name"]?><!--" />-->
<!--                    </td>-->
<!--                    <td>-->
<!--                        <input type="text" name="nric_fin[]" id="nric_fin_--><?php //echo $key_t; ?><!--" class="regular-text"-->
<!--                               value="--><?php //echo $val["nric_fin"]?><!--" />-->
<!--                    </td>-->
                    <td>
                        <input type="text" name="address[]" id="address_<?php echo $key_t; ?>" class="regular-text"
                               value="<?php echo $val["address"]?>" />
                    </td>
                    <td>
                        <input type="text" name="contact[]" id="contact_<?php echo $key_t; ?>" class="regular-text"
                               value="<?php echo $val["contact"]?>" />
                    </td>
                    <td>
                        <input type="text" name="date_of_installation[]" id="date_of_installation_<?php echo $key_t; ?>" class="regular-text datepicker"
                               value="<?php echo $val["date_of_installation"]?>" />
                    </td>
                    <td>
                        <input type="text" name="wrranty_date[]" id="wrranty_date_<?php echo $key_t; ?>" class="regular-text datepicker"
                               value="<?php echo $val["wrranty_date"]?>" />
                    </td>
                    <td><input type="button" rel="<?php echo $val["invoiceId"]?>" rel_userid="<?php echo $_GET["user_id"]; ?>" class="delete-invoice" value="delete"/> </td>
                </tr>
            <?php
                $key_t++;
            }
        }else{
            ?>
        <tr>
            <td>
                <input type="text" name="invoiceId[]" id="invoiceId" class="regular-text"
                       value="" />
            </td>
<!--            <td>-->
<!--                <input type="text" name="name[]" id="name_--><?php //echo $key_t; ?><!--" class="regular-text"-->
<!--                       value="" />-->
<!--            </td>-->
<!--            <td>-->
<!--                <input type="text" name="nric_fin[]" id="nric_fin_--><?php //echo $key_t; ?><!--" class="regular-text"-->
<!--                       value="" />-->
<!--            </td>-->
            <td>
                <input type="text" name="address[]" id="address_<?php echo $key_t; ?>" class="regular-text"
                       value="" />
            </td>
            <td>
                <input type="text" name="contact[]" id="contact_<?php echo $key_t; ?>" class="regular-text"
                       value="" />
            </td>
            <td>
                <input type="text" name="date_of_installation[]" id="date_of_installation_<?php echo $key_t; ?>" class="regular-text datepicker"
                       value="" />
            </td>
            <td>
                <input type="text" name="wrranty_date[]" id="wrranty_date_<?php echo $key_t; ?>" class="regular-text datepicker"
                       value="" />
            </td>
            <td><input type="button" rel="" value="delete"/> </td>
        </tr>
        <?php
        }
        ?>

    </table>
    <input type="button" value="add invoice" rel_count="<?php echo $key_t; ?>" onclick="add_field_text(this)" />


    <h3>Customer point</h3>

    <table class="form-table">

        <tr>
            <th><label for="point">Point</label></th>

            <td>
                <input type="text" name="point" id="point" value="<?php echo esc_attr( get_the_author_meta( 'point', $user->ID ) ); ?>" class="regular-text" />
            </td>
        </tr>

    </table>
<?php
}

add_action( 'personal_options_update', 'tcb_save_extra_user_profile_fields' );
add_action( 'edit_user_profile_update', 'tcb_save_extra_user_profile_fields' );
function tcb_save_extra_user_profile_fields( $user_id ) {
    global $wpdb;

    $saved = false;
    if ( current_user_can( 'edit_user', $user_id ) ) {
        $sql = "INSERT INTO {$wpdb->wrranty_db_table} (invoiceId, address, contact, date_of_installation, wrranty_date, user_id) ";
        if(isset($_POST["invoiceId"])){
            $key = 0;
            foreach($_POST["invoiceId"] as $key=>$val){
                if(!$_POST["invoiceId"][$key]){
                    continue;
                }
                if(!$key){
                    $sql .= " VALUES ('$val', '" . $_POST["address"][$key] . "' , '" . $_POST["contact"][$key] . "' , '" . $_POST["date_of_installation"][$key] . "', '" . $_POST["wrranty_date"][$key] . "', '" . $_POST["user_id"] . "') ";
                    $key++;
                }
                else
                    $sql .= " ,('$val', '" . $_POST["address"][$key] . "' , '" . $_POST["contact"][$key] . "' , '" . $_POST["date_of_installation"][$key] . "', '" . $_POST["wrranty_date"][$key] . "', '" . $_POST["user_id"] . "') ";
            }
        }
        $sql .= " ON DUPLICATE KEY UPDATE
        date_of_installation = VALUES(date_of_installation),
        wrranty_date = VALUES(wrranty_date),
        address = VALUES(address),
        contact = VALUES(contact)";
//        echo $sql;
//        exit;
        $wpdb->query($sql);
        $saved = true;

        //update extra info for customer
        update_user_meta( $user_id, 'salutation', $_POST['salutation'], get_the_author_meta( 'salutation', $user_id ) );
        update_user_meta( $user_id, 'nric_fin_user', $_POST['nric_fin_user'], get_the_author_meta( 'nric_fin', $user_id ) );
        update_user_meta( $user_id, 'dob', $_POST['dob'], get_the_author_meta( 'dob', $user_id ) );
//        update_user_meta( $user_id, 'nationality', $_POST['nationality'], get_the_author_meta( 'nationality', $user_id ) );
        update_user_meta( $user_id, 'address_user', $_POST['address_user'], get_the_author_meta( 'address', $user_id ) );
        update_user_meta( $user_id, 'postal_code', $_POST['postal_code'], get_the_author_meta( 'postal_code', $user_id ) );
        update_user_meta( $user_id, 'phone', $_POST['phone'], get_the_author_meta( 'phone', $user_id ) );
        update_user_meta( $user_id, 'point', $_POST['point'], get_the_author_meta( 'point', $user_id ) );
    }
    return true;
}

function tcb_profile_load_scripts() {
    wp_register_script(
        'tcb_uijs',
        plugins_url( '/assets/js/jquery-ui.min.js', __FILE__ ),
        array( 'jquery' )
    );
    wp_enqueue_script( 'tcb_uijs' );
    wp_register_script(
        'tcb_profilejs',
        plugins_url( '/assets/js/scripts.js', __FILE__ ),
        array( 'jquery' )
    );
    wp_enqueue_script( 'tcb_profilejs' );
    wp_localize_script( 'tcb_profilejs', 'MyAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );

    wp_register_style('tcb_jquery-ui.min-css', plugins_url( '/assets/css/jquery-ui.min.css', __FILE__ ) );
    wp_enqueue_style('tcb_jquery-ui.min-css'); // Enqueue it!
    wp_register_style('tcb_jquery-ui.structure.min-css', plugins_url( '/assets/css/jquery-ui.structure.min.css', __FILE__ ) );
    wp_enqueue_style('tcb_jquery-ui.structure.min-css'); // Enqueue it!
    wp_register_style('tcb_jquery-ui.theme.min-css', plugins_url( '/assets/css/jquery-ui.theme.min.css', __FILE__ ) );
    wp_enqueue_style('tcb_jquery-ui.theme.min-css'); // Enqueue it!
    wp_register_style('tcb_profile-css', plugins_url( '/assets/css/style.css', __FILE__ ) );
    wp_enqueue_style('tcb_profile-css'); // Enqueue it!


}
add_action('admin_enqueue_scripts', 'tcb_profile_load_scripts');


function tcb_profile_load_scripts_front() {
    wp_register_style('tcb_style_front-css', plugins_url( '/assets/css/style_front.css', __FILE__ ) );
    wp_enqueue_style('tcb_style_front-css'); // Enqueue it!

    $detect = new Mobile_Detect;
    if( $detect->isiOS() ){
        wp_register_style('tcb_style_front-ios-css', plugins_url( '/assets/css/style_ios_front.css', __FILE__ ) );
        wp_enqueue_style('tcb_style_front-ios-css'); // Enqueue it!
    }

    wp_register_script(
        'tcb_frontjs',
        plugins_url( '/assets/js/scripts_front.js', __FILE__ ),
        array( 'jquery' )
    );
    wp_enqueue_script( 'tcb_frontjs' );
    wp_localize_script( 'tcb_frontjs', 'MyAjax',
        array(
            'ajaxurl' => admin_url( 'admin-ajax.php' ) ,
            'loginurl' => get_permalink(get_id_by_slug("members-login"))
    ) );
}
add_action('init', 'tcb_profile_load_scripts_front');


