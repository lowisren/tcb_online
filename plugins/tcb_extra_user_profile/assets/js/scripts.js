(function ($, root, undefined) {
    $(function () {
        //add field
        window.add_field_text = function(e){
            $count = $(e).attr("rel_count");
            $count++;
            $(e).attr("rel_count",$count);
            var html = '<tr><td><input type="text" name="invoiceId[]" class="regular-text" value="" /></td>';
//            html += '<td><input type="text" name="name[]" class="regular-text" value="" /></td>';
//            html += '<td><input type="text" name="nric_fin[]" class="regular-text" value="" /></td>';
            html += '<td><input type="text" name="address[]" class="regular-text" value="" /></td>';
            html += '<td><input type="text" name="contact[]" class="regular-text" value="" /></td>';
            html += '<td><input type="text" name="date_of_installation[]" id="date_of_installation_'+$count+'" class="regular-text datepicker" value="" /></td>';
            html += '<td><input type="text" name="wrranty_date[]" id="wrranty_date_'+$count+'" class="regular-text datepicker" value="" /></td>';
            html += '<td><input type="button" rel="" value="delete" class="delete-invoice-js"/> </td> </tr>';
            $(".tcb-invoice-table").append(html);
        }
    });
    jQuery(document).ready(function($){
        $(".delete-invoice").click(function(){
            if (confirm("Delete this invoice ?") == true) {
                var parent = $(this).parents("tr");
                $.ajax({
                    url: MyAjax.ajaxurl,
                    data: {
                        "action": "remove_invoice",
                        "invoiceId" : $(this).attr("rel"),
                        "userId" : $(this).attr("rel_userid")
                    },
                    type: "post",
                    success:function(result) {
                        if(result)
                            $(parent).remove();
                    }
                });
            }
        })
        $(".tcb-invoice-table").delegate(".delete-invoice-js","click",function(){
            if (confirm("Delete this invoice ?") == true) {
                $(this).parents("tr").remove();
            }
        });
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
