(function ($, root, undefined) {
    $(function () {

    });
    function getQueryParams(qs) {
        qs = qs.split("+").join(" ");
        var params = {},
            tokens,
            re = /[?&]?([^=]+)=([^&]*)/g;

        while (tokens = re.exec(qs)) {
            params[decodeURIComponent(tokens[1])]
                = decodeURIComponent(tokens[2]);
        }

        return params;
    }
    jQuery(document).ready(function($){
        var $_GET = getQueryParams(document.location.search);
        if($_GET["checkemail"] == "confirm"){
            $("#loginform").remove();
        }
        if($_GET["action"] == "resetpass"){
            var temp = $(".message.reset-pass");
            var a = $(".message.reset-pass a");
            $(a).html("login");
            $(a).attr("href", MyAjax.loginurl);
            $(temp).html("Your password has been reset. To ")
            .append(a).append(", enter your existing email address and your new password.");
        }
        $(document).on('focus',".datepicker", function(){
            $(this).datepicker({
                'dateFormat': 'dd/mm/yy',
                changeMonth: true,
                changeYear: true,
                yearRange: "-100:+0"
            });
        });
    });
})(jQuery, this);
