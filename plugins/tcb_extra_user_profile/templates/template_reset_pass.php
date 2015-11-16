<div style="text-align: center">
    <a href="<?php echo home_url();?>">
        <img src="<?=get_template_directory_uri() . '/public/img/logo_email.jpg'?>"/>
    </a>
</div>

<p>Hello <?=$user_lastname ?>,</p>
<p>We received a request to reset your password. To reset your password, please click on the link
<?=network_site_url("wp-login.php?action=rp&key=$key&login=" . rawurlencode($user_login), 'login') ?> and enter your new password.</p>
<p>If you did not request for this email, this means another user has entered your email address in the member’s login section. Please ignore this email.</p>

<p>For security reasons, this link will expire after 24 hours. You will then need to renew your request.</p>

<p>Note: If you remember your password, please ignore this email.</p>

<p>Please do not hesitate to call us at <a href="tel:+6568461128">6846 1128</a> or email us at <a href="mailto:enquiry@tcb.com.sg">enquiry@tcb.com.sg</a> if you have questions about your account.</p>

<p>Best Regards,<br/>
    The Curtain Boutique Team</p>
<hr/>
<p style="font-size: 11px;">Please do not reply to this email.<br />
    <br />
</p>