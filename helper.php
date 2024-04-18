<?php

define('VEN_ELEMENT_FORM_PATH', __DIR__.'/form');
function element($name, $data)
{
    $cls = "\\element\\".$name;
    return $cls::create($data);
}

function element_to_str($arr)
{
    if(!$arr) {
        return;
    }
    unset($arr['name']);
    $str = "";
    foreach($arr as $k => $v) {
        if(is_numeric($k)) {
            $str .=  " ".$v." ";
        } elseif($v) {
            $str .= $k."=\"".$v."\" ";
        }
    }
    return $str;
}