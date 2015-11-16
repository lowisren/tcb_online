<?php
    $elements = $this->getHtmlArr();
    global $current_user;
?>
<input type="hidden" name="id_user" value="<?php echo $current_user->ID; ?>">
<input type="hidden" name="name_user" value="<?php echo trim($current_user->last_name); ?>">
<input type="hidden" name="email_user" value="<?php echo $current_user->user_email; ?>">
<input type="hidden" name="login_url" value="<?php echo get_permalink(get_id_by_slug("members-login")); ?>">
<input type="hidden" name="phone_user" value="<?php echo get_the_author_meta( 'phone', $current_user->ID ); ?>">
<input type="hidden" name="link_profile" value="<?php echo get_admin_url() . "user-edit.php?user_id=" .  $current_user->ID ; ?>">

<div class="warranty-form tcp-form">
    <div id="group-input-wrapper">
        <!--    referral group 1-->
        <div class="group-input">
            <div class="section-input clearfix">
                <h4>Your Referral</h4>
            </div>
            <?php
            $index = "_1";
            include (TCP_TEMPLATE_PATH . "referral-section.php");
            ?>
            <input type="hidden" name="group_id" value="1" class="group_id">
        </div>
        <a href="javascript:void(0)" id="add-more-referral" class="submit-button-tcb">Refer more family members and friends</a>
    </div>
    <input type="hidden" id="element-counter" name="element-counter" value="1">
    <!--   end referral group 1-->
    <div class="section-input clearfix">
        <?php
        foreach($elements["agree"]["checkbox"] as $key=>$val){
            ?>
            <div class="tcb-input-check agree-checkbox">
                <input type="checkbox" name="<?php echo $elements["agree"]["name"]; ?>" value="<?php echo $val; ?>" id="<?php echo $elements["agree"]["name"] . "-" . $key; ?>" required>
                <label for="<?php echo $elements["agree"]["name"] . "-" . $key; ?>">I have read and understand the policy.</label>
            </div>
        <?php
        } ?>
    </div>
    <div class="section-input outer-button">
        <input type="submit" value="Join now" class="cd-popup-trigger submit-butt"/>
        <a href="<?php echo home_url(); ?>" class="submit-button-tcb popup-referral">Maybe next time</a>
        <img class="submit-loading" src="<?php echo plugins_url( '../assets/css/images/ajax-loader.gif', __FILE__ ); ?>"/>
    </div>
</div><!--/tcp form -->
<script>
    function referral_form_redirect(){
        var url = "<?php echo get_permalink(get_id_by_slug("thank-you-for-your-referral")); ?>";
        window.location.href = url;
    }
    jQuery(document).ready(function($){
        $(".submit-butt").on('click', function(event){
            $(".submit-loading").fadeToggle();
        });
        $(".wpcf7-form").validate({
            rules: {
                email_1: {
                    email: true
                },
                email_2: {
                    email: true
                },
                email_3: {
                    email: true
                },
                contact_1: {
                    number: true,
                    minlength: 8,
                    maxlength: 8
                },
                contact_2: {
                    number: true,
                    minlength: 8,
                    maxlength: 8
                },
                contact_3: {
                    number: true,
                    minlength: 8,
                    maxlength: 8
                }
            },
            messages: {
                email_1: "Please enter a valid email address",
                email_2: "Please enter a valid email address",
                email_3: "Please enter a valid email address"
            },
            invalidHandler: function(event, validator) {
                $(".submit-loading").fadeToggle();
            }
        });
    });
</script>