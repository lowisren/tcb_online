<?php
    $elements = $this->getHtmlArr();
?>
<input type="hidden" name="login_url" value="<?php echo get_permalink(get_id_by_slug("members-login")); ?>">
<div class="warranty-form tcp-form">
    <div class="group-input">
        <div class="section-input clearfix">
            <label class="label-col"><?php echo $elements["title"]["label"]; ?><span class="require-mark">*</span></label>
            <?php foreach($elements["title"]["option"] as $key=>$val){
            ?>
            <div class="tcb-input-check">
                <input type="radio" name="<?php echo $elements["title"]["name"]; ?>" value="<?php echo $val; ?>" id="<?php echo $elements["title"]["name"] . "-" . $key; ?>" <?php echo (!$key)? "checked" : "" ?>>
                <label for="<?php echo $elements["title"]["name"] . "-" . $key; ?>"><?php echo $val; ?></label>
            </div>
            <?php
            } ?>
        </div>
        <div class="section-input clearfix">
            <?php echo $this->showHtml("surname","text");?>
        </div>
        <div class="section-input clearfix">
            <?php echo $this->showHtml("given_name","text",1);?>
        </div>
        <div class="section-input clearfix">
            <?php echo $this->showHtml("NRIC_FIN","text", 1);?>
        </div>
        <div class="section-input clearfix">
            <?php echo $this->showHtml("dob","date");?>
        </div>
<!--        <div class="section-input clearfix">-->
<!--            <label class="label-col">--><?php //echo $elements["nationality"]["label"]; ?><!--</label>-->
<!--            --><?php //foreach($elements["nationality"]["option"] as $key=>$val){
//                ?>
<!--                <div class="tcb-input-check">-->
<!--                    <input type="radio" name="--><?php //echo $elements["nationality"]["name"]; ?><!--" value="--><?php //echo $val; ?><!--" id="--><?php //echo $elements["nationality"]["name"] . "-" . $key; ?><!--">-->
<!--                    <label for="--><?php //echo $elements["nationality"]["name"] . "-" . $key; ?><!--">--><?php //echo $val; ?><!--</label>-->
<!--                </div>-->
<!--            --><?php
//            } ?>
<!--        </div>-->
        <div class="section-input clearfix">
            <label class="label-col">ADDRESS<span class="require-mark">*</span></label>
            <div class="text-group">
                <div class="text-section">
                <?php echo $this->showHtml("block","text");?>
                </div>
                <div class="text-section">
                <?php echo $this->showHtml("street_name","text");?>
                </div>
            </div>
        </div>
        <div class="section-input clearfix">
            <?php echo $this->showHtml("postal_code","text",1);?>
        </div>
        <div class="section-input clearfix">
            <?php echo $this->showHtml("contact","text",1);?>
        </div>
        <div class="section-input clearfix">
            <?php echo $this->showHtml("invoice_no","text",1);?>
        </div>
        <div class="section-input clearfix">
            <?php echo $this->showHtml("date_of_installation","date",1);?>
        </div>
        <div class="section-input clearfix">
            <?php echo $this->showHtml("email","text",1);?>
        </div>
        <div class="section-input clearfix">
            <?php
            foreach($elements["agree"]["checkbox"] as $key=>$val){
                ?>
                <div class="tcb-input-check agree-checkbox">
                    <input type="checkbox" name="<?php echo $elements["agree"]["name"]; ?>" value="<?php echo $val; ?>" id="<?php echo $elements["agree"]["name"] . "_" . $key; ?>" required>
                    <label for="<?php echo $elements["agree"]["name"] . "_" . $key; ?>">I have read and understand the policy.</label>
                </div>
            <?php
            } ?>
        </div>
        <div class="section-input">
            <input type="submit" class="submit-butt" value="REGISTER" />
            <img class="submit-loading" src="<?php echo plugins_url( '../assets/css/images/ajax-loader.gif', __FILE__ ); ?>"/>
        </div>
    </div>
</div><!--/tcp form -->

<script>
    jQuery(document).ready(function($){
        $("#warranty_form .submit-butt").on('click', function(event){
            $("#warranty_form .submit-loading").fadeToggle();
        });
        $("#warranty_form").validate({
            rules: {
                given_name: "required",
                street_name: "required",
                nric_fin :"required",
                postal_code :"required",
                contact: {
                    number: true,
                    minlength: 8,
                    maxlength: 8,
                    required: true
                },
                invoice_no :"required",
                date_of_installation :"required",
                email: {
                    required: true,
                    email: true
                }
            },
            messages: {
                email: "Please enter a valid email address"
            },
            invalidHandler: function(event, validator) {
                $("#warranty_form .submit-loading").fadeToggle();
            }
        });
        setTimeout(function(){
            $('.feedback_popup').bPopup({
                fadeSpeed : 'slow',
                speed : 500,
                modalClose : false,
                escClose: false
            });
        }, 3000);
    })
    function warranty_form_redirect(){
        var url = "<?php echo get_permalink(get_id_by_slug("thank-you-for-your-registration")); ?>";
        window.location.href = url;
    }
</script>