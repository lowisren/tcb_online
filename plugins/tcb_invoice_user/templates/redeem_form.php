<?php
    $elements = $this->getHtmlArr();
    global $current_user;
?>
<input type="hidden" name="email_user" value="<?php echo $current_user->user_email; ?>">
<input type="hidden" name="given_name" value="<?php echo $current_user->last_name; ?>">
<input type="hidden" name="link_profile" value="<?php echo get_admin_url() . "user-edit.php?user_id=" .  $current_user->ID ; ?>">
<div class="warranty-form tcp-form">
    <div class="group-input">
        <div class="section-input clearfix">
            <?php echo $this->showHtml("surname","text");?>
        </div>
        <div class="section-input clearfix">
            <?php echo $this->showHtml("point","text");?>
        </div>
        <div class="section-input submit-butt">
            <input type="submit" value="Redeem" class="active-redeem" />
        </div>
    </div>
</div><!--/tcp form -->

<script>
    jQuery(document).ready(function($){
        $(".submit-butt").on('click', function(event){
            $(".submit-loading").fadeToggle();
        });
    });
</script>