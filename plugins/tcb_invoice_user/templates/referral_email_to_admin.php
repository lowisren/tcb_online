<div>
    <a href="<?php echo home_url();?>">
        <img src="<?=get_template_directory_uri() . '/public/img/email_header.jpg'?>"/>
    </a>
</div>
<div style="width: 606px">
    Subject: Referral form

    <p>Customer:  <?= $posted_data["name_user"];?></p>
    <p>Email: <?= $posted_data["email_user"];?></p>
    <p>Link: <?= $posted_data["link_profile"];?></p>

    <?php
    for($i = 1; $i <= $posted_data["element-counter"]; $i++){
    ?>
        <h4>His/her referral</h4>
        <p>Title : <?= $posted_data["title_" . $i];?></p>
        <p>Surname: <?= $posted_data["surname_" . $i];?></p>
        <p>Given Name: <?= $posted_data["given_name_" . $i];?></p>
        <p>Contact: <?= $posted_data["contact_" . $i];?></p>
        <p>Email: <?= $posted_data["email_" . $i];?></p>
    <?php
    }
    ?>
</div>