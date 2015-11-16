<div class="section-input clearfix">
    <label class="label-col"><?php echo $elements["title" . $index]["label"]; ?><span class="require-mark">*</span></label>
    <?php foreach($elements["title" . $index]["option"] as $key=>$val){
        ?>
        <div class="tcb-input-check">
            <input type="radio" name="<?php echo $elements["title" . $index]["name"]; ?>" value="<?php echo $val; ?>" id="<?php echo $elements["title" . $index]["name"] . "-" . $key; ?>" <?php echo (!$key)? "checked" : "" ?>>
            <label for="<?php echo $elements["title" . $index]["name"] . "-" . $key; ?>"><?php echo $val; ?></label>
        </div>
    <?php
    } ?>
</div>
<div class="section-input clearfix">
    <?php echo $this->showHtml("surname" . $index,"text");?>
</div>
<div class="section-input clearfix">
    <?php echo $this->showHtml("given_name" . $index,"text",1);?>
</div>
<!--<div class="section-input clearfix">-->
<!--    <label class="label-col">--><?php //echo $elements["nationality" . $index]["label"]; ?><!--</label>-->
<!--    --><?php //foreach($elements["nationality" . $index]["option"] as $key=>$val){
//        ?>
<!--        <div class="tcb-input-check">-->
<!--            <input type="radio" name="--><?php //echo $elements["nationality" . $index]["name"]; ?><!--" value="--><?php //echo $val; ?><!--" id="--><?php //echo $elements["nationality" . $index]["name"] . "-" . $key; ?><!--">-->
<!--            <label for="--><?php //echo $elements["nationality" . $index]["name"] . "-" . $key; ?><!--">--><?php //echo $val; ?><!--</label>-->
<!--        </div>-->
<!--    --><?php
//    } ?>
<!--</div>-->
<div class="section-input clearfix">
    <?php echo $this->showHtml("contact" . $index,"text",1);?>
</div>
<div class="section-input clearfix">
    <?php echo $this->showHtml("email" . $index,"text", 1);?>
</div>