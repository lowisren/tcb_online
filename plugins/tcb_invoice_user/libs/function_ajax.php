<?php
add_action( 'wp_ajax_nopriv_zoe_get_content', 'zoe_get_content' );
add_action( 'wp_ajax_zoe_get_content', 'zoe_get_content' );
function zoe_get_content(){
    $zoe_content = new ZoeContentAjax($_POST);
    $zoe_content->show();
//    $obj_id = $_POST["post_id"];
//    $obj = get_post($obj_id);
//    echo json_encode( $obj );
    die();
}