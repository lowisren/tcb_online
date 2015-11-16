jQuery(document).ready(function($){
    //open popup
//    $('.cd-popup-trigger').on('click', function(event){
////        event.preventDefault();
//        $('.cd-popup').addClass('is-visible');
//    });
    //close popup
    $('.cd-popup').on('click', function(event){
        if( $(event.target).is('.cd-popup-close') || $(event.target).is('.cd-popup') ) {
            event.preventDefault();
            $(this).removeClass('is-visible');
        }
    });
    //close popup when clicking the esc keyboard button
//    $(document).keyup(function(event){
//        if(event.which=='27'){
//            if($(".feedback_popup:visible").length > 0){
//                return false;
//            }
////            $('.cd-popup').removeClass('is-visible');
//        }
//    });

    $(".redeem-confirm").click(function(e){
        e.preventDefault();
        if($(".point").html() !== "0"){
            $.ajax({
                url: MyAjax.ajaxurl,
                data: {
                    "action": "deducted_point"
                },
                type: "post",
                success:function(result) {
                    if(result){
                        $(".active-redeem").trigger("click");
                        $(".point").html("0");
                        $(".redeem-remove").remove();
                    }
                }
            });
        }
    })

});
