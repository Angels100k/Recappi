<?php
function dd_img($image, $type, $size = '300px', $style = '')
{
    $src = "/assets/img/webp/".$image . ".webp";
    $errsrc = "/assets/img/".$image . $type;
    return '<img src="'.$src.'" onerror="this.onerror=null; this.src=`'.$errsrc.'`" width="'.$size.'" height="'.$size.'" style="'.$style.'">';
}