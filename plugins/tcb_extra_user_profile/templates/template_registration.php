<div style="text-align: center">
    <a href="<?php echo home_url();?>">
        <img src="<?=get_template_directory_uri() . '/public/img/logo_email.jpg'?>"/>
    </a>
</div>

<p>Dear <?=$user_lastname ?>,<br /><br />
    Welcome to The Curtain Boutique. To log in, click <a href="<?=get_the_permalink(get_id_by_slug('members-login')); ?>">Login</a> and then enter your username and password.</p>

<p>Username: <?=$user_login?></p>

<p>Password: <?=$plaintext_pass?> <br />
    <br />
    When you log in to your account, you will be able to do the following:</p>

<p>- Check the status of your warranty</p>

<p>- Check how many points you have accumulated </p>

<p>- Redeem cash vouchers</p>

<p>- Start your family members or friends with a 15% off* credit towards our products</p>

<p>If you have any queries about your account, please feel free to contact us at <a href="tel:+6568461128">6846 1128</a> or <a href="mailto:enquiry@tcb.com.sg">enquiry@tcb.com.sg</a>. Our customer service officers will be happy to assist you. </p>

<p>Yours Sincerely,<br/>
    The Curtain Boutique Team</p>

<hr/>
<p style="font-size: 11px;">Please do not reply to this email.<br />
    <br />
</p>



