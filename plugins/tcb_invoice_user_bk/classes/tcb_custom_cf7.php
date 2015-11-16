<?php
class tcb_custom_cf7{
    protected $shortcode_str;
    public $html_arr = array();
    public function __construct($shortcode){
        $this->register_shortcode($shortcode);
    }
    public function get_shortcode(){
        return $this->shortcode_str;
    }
    public function register_shortcode($shortcode){
        wpcf7_add_shortcode($shortcode, array($this, 'shortcode_process'), true);
    }
    public function shortcode_process(){
        ob_start();
        include($this->template);
        $output = ob_get_contents();
        ob_clean();
        return $output;
    }
    public function setTemplate($url){
        $this->template = $url;
    }
    public function setHtmlArr($htmlArr){
        $this->html_arr = $htmlArr;
    }
    public function getHtmlArr(){
        return $this->html_arr;
    }
    public function addHtml($html){

    }
    public function showHtml($key, $type, $require = 0){
        $requireSign = ($require) ? '<span class="require-mark">*</span>' : "";
        $elements = $this->getHtmlArr();
        if($type == "text"){
            $html = '<label class="question label-text label-col" for="'. $elements[$key]["name"]. '">'. $elements[$key]["label"] . $requireSign . '</label>
            <input type="text" name="'. $elements[$key]["name"]. '" id="'. $elements[$key]["name"]. '" value="'. $elements[$key]["value"]. '" >';
        }
        if($type == "date"){
            $html = '<label class="question label-text label-col" for="'. $elements[$key]["name"]. '">'. $elements[$key]["label"] . $requireSign . '</label>
            <input type="text" name="'. $elements[$key]["name"]. '" id="'. $elements[$key]["name"]. '" value="'. $elements[$key]["value"]. '" class="datepicker" >';
        }
        return $html;
    }
}