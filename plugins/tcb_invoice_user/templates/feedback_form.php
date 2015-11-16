<?php
    $elements = $this->getHtmlArr();
?>
<div class="feedback_form tcp-form">
    <h3>We value your opinion!</h3>
    <p>Your feedback is helpful to The Curtain Boutique in our continuous quest for improvements in our service and thereby enhancing your satisfaction. Your privacy will be protected. It will take up to 5 minutes to complete this form.</p>
    <div class="group-input">
        <div class="section-input clearfix group-checkbox">
            <p class="question">1.	How did you get to know about The Curtain Boutique?</p>
            <?php foreach($elements["fromSource"]["option"] as $key=>$val){
            ?>
            <div class="tcb-input-check">
                <input type="radio" name="<?php echo $elements["fromSource"]["name"]; ?>[]" value="<?php echo $val; ?>" id="<?php echo $elements["fromSource"]["name"] . "_" . $key; ?>" <?php echo (!$key) ? "required minlength='1'" : ""?>>
                <label for="<?php echo $elements["fromSource"]["name"] . "_" . $key; ?>"><?php echo $val; ?></label>
            </div>
            <?php
            } ?>
        </div>
        <div class="section-input">
            <p class="question">2.	How do you find our salesperson's service?</p>
            <?php
            $keyInShortcode = "optionGroup_1";
            include (TCP_TEMPLATE_PATH . "group-option.php");
            ?>
        </div>
        <div class="section-input">
            <p class="question">3.	How do you find our installer’s service?</p>
            <?php
            $keyInShortcode = "optionGroup_2";
            include (TCP_TEMPLATE_PATH . "group-option.php");
            ?>
        </div>
        <div class="section-input">
            <p class="question">4.	Comments (if any):</p>
            <textarea name="comment" rows="10" cols="40"></textarea>
        </div>
        <div class="section-input">
            <input type="submit" class="cd-popup-trigger submit-butt feedback-butt" value="Proceed to register your warranty" />
            <img class="submit-loading" src="<?php echo plugins_url( '../assets/css/images/ajax-loader.gif', __FILE__ ); ?>"/>
        </div>
    </div>
</div><!--/tcp form -->
<script>
    jQuery(document).ready(function($) {
//                $(".mainpage").jnormalblog();
        $("#feedback_form .submit-butt").on('click', function(event){
            $("#feedback_form .submit-loading").fadeToggle();
        });
        $("#feedback_form").validate({
                invalidHandler: function(event, validator) {
                    $("#feedback_form .submit-loading").fadeToggle();
                }
            }
        );
    });
    function feedback_form_close(){
        jQuery('.feedback_popup').bPopup().close()
    }
</script>