<?php
//ajax function
add_action('wp_ajax_remove_invoice', 'remove_invoice');
add_action('wp_ajax_nopriv_remove_invoice', 'remove_invoice');
function remove_invoice(){
    echo $_POST["invoiceId"];
    if(isset($_POST["invoiceId"]) && $_POST["invoiceId"]){
        global $wpdb;
        $wpdb->query("delete from $wpdb->wrranty_db_table where invoiceId='".$_POST["invoiceId"]."' AND user_id='".$_POST["userId"]."'");
        echo  1;
    }
    echo 0;
    die();
}

add_action('wp_ajax_deducted_point', 'deducted_point');
add_action('wp_ajax_nopriv_deducted_point', 'deducted_point');
function deducted_point(){
    if(isset($_POST)){
        $user_id = get_current_user_id();
        update_user_meta( $user_id, 'point', "0", get_the_author_meta( 'point', $user_id ) );
        echo  1;
    }
    echo 0;
    die();
}