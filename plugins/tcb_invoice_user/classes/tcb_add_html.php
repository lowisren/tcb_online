<?php
abstract class tcb_html{
    protected $attr_array = array();
    public function __construct($name){
        $this->attr_array["label"] = $name;
        $this->set_name($name);
    }
    public function set_label($label){
        $this->attr_array["label"] = $label;
    }
    public function set_name($name){
        $name = strtolower(str_replace(" ", "_", $name));
        $this->attr_array["name"] = $name;
    }
    public function getAttr(){
        return $this->attr_array;
    }
    public function setDefaultVal($val){
        $this->attr_array["value"] = $val;
    }
    public function addToShortcode(tcb_custom_cf7 $tcb_custom_cf7, $key = 0){
        if(!$key){
            $key = $this->attr_array["name"];
        }
        $tcb_custom_cf7->html_arr[$key] = $this->getAttr();
    }
}

class tcb_input_text extends tcb_html{

}

class tcb_input_radio extends tcb_html{
    public function set_option($option){
        $this->attr_array["option"] = $option;
    }
}

class tcb_input_checkbox extends tcb_html{
    public function set_checkbox($select){
        $this->attr_array["checkbox"] = $select;
    }
}

class tcb_group_radio extends tcb_html{
    public function __construct($array_name, $array_opt, $prefix=0){
        $this->set_prefix($prefix);
        $this->set_name_arr($array_name);
        $this->set_option_arr($array_opt);
        $this->set_group();
    }
    public function set_group(){
        foreach($this->attr_array["name_arr"] as $key=>$val){
            $tempName = (isset($this->attr_array["prefix"])) ? ($this->attr_array["prefix"] . " " . $val) : $val;
            $tempRadio = new tcb_input_radio($tempName);
            $tempOpt = array();
            foreach($this->attr_array["option_arr"] as $key1=>$val1){
                $value = $this->attr_array["option_arr"][$key1];
                $tempOpt[$value] = $value;
            }
            $tempRadio->set_option($tempOpt);
            $this->attr_array["group-option"][] = $tempRadio->getAttr();
        }
    }
    public function set_prefix($prefix){
        if($prefix)
            $this->attr_array["prefix"] = $prefix;
    }
    public function set_option_arr($option_arr){
        $this->attr_array["option_arr"] = $option_arr;
    }
    public function set_name_arr($name_arr){
        $this->attr_array["name_arr"] = $name_arr;
    }
}