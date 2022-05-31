<?php
function changeFormat($date,$date_format){
    return date($date_format,strtotime($date));   
}
function convertDate($t){
    foreach ($t as &$row){
        foreach($row as &$r){
            if (isDate($r)) {
                $r = date("m/d/Y", strtotime($r));
            }
        }
    }
    return $t; 
}
function isDate($value) 
{
    if (!$value) {
        return false;
    }
    try {
        new \DateTime($value);
        return true;
    } catch (\Exception $e) {
        return false;
    }
}
function convertBack($element) {
        $time =  date("H:i:s");
        $date = DateTime::createFromFormat('d/m/Y H:i:s',$element." ".$time);
        if ($date) return $date->format('Y-m-d H:i:s');
        else       return $element;
}
