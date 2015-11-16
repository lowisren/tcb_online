<div class="group-option">
    <div class="group-option-row clearfix not-show-vmobile">
        <div class="name-option"></div>
        <div class="option-subject clearfix">
            <?php
            foreach($elements[$keyInShortcode]["option_arr"] as $key=>$val){
                ?>
                <div class="option-subject-cell"><?php echo $val;?></div>
            <?php
            }
            ?>
        </div>
    </div>
    <?php
    $temp = 0;
    foreach($elements[$keyInShortcode]["group-option"] as $key=>$val){
        ?>
        <div class="group-option-row clearfix group-checkbox">
            <div class="name-option"><?php echo $elements[$keyInShortcode]["name_arr"][$key]; ?></div>
            <div class="option-subject clearfix">
                <?php
                $temp1 = 0;
                foreach($val["option"] as $key_sub=>$val_sub){
                    ?>
                    <div class="option-subject-cell tcb-input-check">
                        <input type="radio" name="<?php echo $val["name"] ?>" value="<?php echo $val_sub; ?>" id="<?php echo $val["name"] . "-" . $temp . "-" . $temp1; ?>" <?php echo (!$temp1) ? "required" : ""; ?>/>
                        <label for="<?php echo $val["name"] . "-" . $temp . "-" . $temp1; ?>"></label>
                    </div>
                <?php
                    $temp1++;
                }
                ?>
            </div>
            <div class="show-hmobile name-option-mobile">
                <?php
                foreach($elements[$keyInShortcode]["option_arr"] as $key=>$val){
                    ?>
                    <div class="option-subject-cell"><?php echo $val;?></div>
                <?php
                }
                ?>
            </div>
        </div>
    <?php
        $temp++;
    }
    ?>
</div>