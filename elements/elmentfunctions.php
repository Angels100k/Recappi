<?php
function dd_img($image, $type, $size = '', $style = '')
{
    $src = "/assets/img/webp/".$image . ".webp";
    $errsrc = "/assets/img/".$image . "." . $type;
    return '<img src="'.$src.'" onerror="this.onerror=null; this.src=`'.$errsrc.'`;test(`'.$image . "`,`" . $type.'`)" width="'.$size.'" height="'.$size.'" style="'.$style.'">';
}

function dd_head($title, $extra ="")
{
    $html = "";

    $html .= '<meta charset="UTF-8">';
    $html .= '<meta http-equiv="X-UA-Compatible" content="IE=edge">';
    $html .= '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
    $html .= '<title>'. $title .'</title>';
    $html .= '<script src="/assets/js/index.js"></script>';
    $html .= '<link rel="stylesheet" href="./assets/css/main.css">';
    $html .= $extra;
    
    return $html;
}

function dd_button($text, $onclick, $type, $class = "", $style = ""){
    $button = "<" . $type . " ";
    if($class !=""){
        $button .= " class='". $class . "' ";
    }
    if($style !=""){
        $button .= " style='". $class . "' ";
    }
    $button .= $onclick;
    $button .= '>';
    $button .= $text;
    $button .='</'.$type.'>';

    return $button;
}