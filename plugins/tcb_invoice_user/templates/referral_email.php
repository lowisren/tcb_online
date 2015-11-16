<div>
    <a href="<?php echo home_url();?>">
        <img src="<?=get_template_directory_uri() . '/public/img/email_header.jpg'?>"/>
    </a>
</div>
<div style="width: 606px">
    <p>Dear <b><?=$posted_data["given_name_" . $i]; ?></b>, <br />
        <br />
        I hope this email finds you well. We received your information from <b><?= $current_user->user_lastname . " " . $current_user->user_firstname; ?></b> who would love for you to enjoy the same great experience they had at The Curtain Boutique. <b><?= $current_user->user_lastname . " " . $current_user->user_firstname; ?></b> would like to start you off with a<b> 15% off</b> credit* towards our products. </p>

        <img src="<?=get_template_directory_uri() . '/public/img/sale_tcb.jpg'?>"/>

    <p>Simply print this email and head on down to our flagship showroom located at 81 Ubi Avenue 4, UB. One, #01-17, Singapore 408830 to enjoy this exclusive discount. We are open from Monday to Saturday, 10am to 7pm.</p>

    <p>For more inspirations and product information, click on the link to visit our <a href="http://www.tcb.com.sg/">website</a> or our <a href="http://www.facebook.com/TheCurtainBoutique">Facebook Page</a>. </p>

    <p>Please feel free to contact us at <a href="tel:+6568461128">6846 1128</a> (customer service hotline) or <a href="mailto:enquiry@tcb.com.sg">enquiry@tcb.com.sg</a> (email) if you need further information.</p>

    <p>Best Regards, </p>
    <p>The Curtain Boutique Team</p>

    <div style="font-size: 12px; color: #777">
        <hr style="background-color: #777">
        <p>Terms and conditions:</p>

        <p>1. This credit is only valid for use with whole house package signed.</p>

        <p>2. This credit is only valid with a minimum spending of $1500 in a single receipt.</p>

        <p>3. A hard copy of this email must be presented to enjoy this credit and you must notify The Curtain Boutique’s sales consultant of your intention to redeem this credit upon visit to our Showroom, or else, The Curtain Boutique reserves the rights not to issue this credit.</p>

        <p>4. This credit cannot be used in conjunction with other discounts/promotions.</p>

        <p>5. This credit is non-transferable.</p>

        <p>6. This credit is valid for 1 year from the date of email sent.</p>

        <p>7. The Curtain Boutique reserves the rights to amend any terms and conditions without giving prior notice.</p>

        <p>8. If, for any reason, we believe that you have not complied with these terms and conditions, we may, at our sole discretion, terminate this credit.</p>
    </div>
</div>