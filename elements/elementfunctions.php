<?php
function dd_img($image, $type, $width = '', $height = '', $style = '', $class = '', $onclick = '')
{
    if($type != "svg"){
        $src = "/assets/img/webp/".$image . ".webp";
        $errsrc = "/assets/img/".$image . "." . $type;
        $class_content = $class != "" ? " class='" . $class . "'" : "";
        $style_content = $style != "" ? " style='" . $style . "'" : "";
        $onclick_content = $onclick != "" ? " onclick='" . $onclick . "'" : "";

        return '<img src="'.$src.'" onerror="this.onerror=null; this.src=`'.$errsrc.'`;test(`'.$image . "`,`" . $type.'`)" width="'.$width.'" height="'.$height.'" '.$style_content. $class_content. $onclick_content.'>';
    }
    else {
        $src = "/assets/img/svg/".$image . "." . $type;
        return '<img src="'.$src.'" width="'.$width.'" height="'.$height.'" style="'.$style.'">';
    }
}

function dd_input($text, $name, $type = "text", $class="",$style =""){
    $text = $text ? $text : "";
    if ($text == "") {
        return "";
    }

    $class_content = $class != "" ? " class='" . $class . "'" : "";
    $style_content = $style != "" ? " style='" . $style . "'" : "";

    $name_content = $name != "" ? " name='" . $name . "'": "";

    $output = "<input " . $name_content . $class_content . $style_content . ">" . $text . "</input>";
}

function dd_head($title, $extra ="")
{
    $html = "";

    $html .= '<meta charset="UTF-8">';
    $html .= '<meta http-equiv="X-UA-Compatible" content="IE=edge">';
    $html .= '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
    $html .= '<title>'. $title .'</title>';
    $html .= '<script src="/assets/js/index.js"></script>';
    $html .= '<link rel="stylesheet" href="/assets/css/main.css">';
    $html .= '<link rel="manifest" href="/manifest.json">';
    $html .= '<link rel="icon" href="favicon.ico" type="image/x-icon" />';
    $html .= '<link rel="apple-touch-icon" href="images/hello-icon-152.png">';
    $html .= '<meta name="theme-color" content="white"/>';
    $html .= '<meta name="apple-mobile-web-app-capable" content="yes">';
    $html .= '<meta name="apple-mobile-web-app-status-bar-style" content="black">';
    $html .= '<meta name="apple-mobile-web-app-title" content="Hello World">';
    $html .= '<meta name="msapplication-TileImage" content="images/hello-icon-144.png">';
    $html .= '<meta name="msapplication-TileColor" content="#FFFFFF">';
    $html .= $extra;

    return $html;
}

function dd_field_wrapper($text, $el = "div", $class = "", $style = "")
{
  $text = $text ? $text : "";
  if ($text == "") {
    return "";
  }
  $class_content = $class != "" ? " class='" . $class . "'" : "";
  $style_content = $style != "" ? " style='" . $style . "'" : "";

  $return = "<" . $el . $class_content . $style_content . ">" . $text . "</" . $el . ">";

  return $return;
}

function dd_layout_post($id, $receptname, $preptime, $difficulty, $likes, $repsonses, $image, $type, $likedID, $saveID){
    $img;
    if($image && $type):
        $img = dd_img($image, $type, "120px", "120px", "", "border-small object-cover");
    else:
        $img = dd_img("placeholder", "png", "120px", "120px", "", "border-small object-cover ");
    endif;
    if($likedID != null):
        $likeimg = dd_img("heartfill", "svg", "20px", "20px", "", "");
    else:
        $likeimg = dd_img("heartempty", "svg", "20px", "20px", "", "");
    endif;
    if($saveID != null):
        $saveimg = dd_img("savefill", "svg", "20px", "20px", "    position: absolute; right: 10px; bottom: 10px;", "");
    else:
        $saveimg = dd_img("saveempty", "svg", "20px", "20px", "    position: absolute; right: 10px; bottom: 10px;", "");
    endif;
    $dots = "";
   
    for ($x = 0; $x <= $difficulty; $x++):
        $dots.= "<span class='text-black mr-02'>&#9679</span>";
    endfor;
    for ($y = $x; $y <= 4; $y++):
        $dots.= "<span class='text-grey mr-02'>&#9679</span>";
    endfor;
    return '<a href="/recept/'.$id.'/" class="txt-black shadow col-12 bg-white p-1 border-small mt-3 bs-bb receptitem">
    <div class="row">
        <div class="col-12"><h2 class="text-bold">'.$receptname.'</h2></div>
        <div class="col-7">
            prep time<br>
            <span class="text-bold">'.$preptime.' min</span><br>
            difficulty<br>
            '.$dots.'
            <div class="text-bold">
                <button onclick="likepost(`'. $id .'`,`frank`, this); return false;" class="button-no-style">
                '. $likeimg .'<span>'.$likes.'</span> 
                </button>
                    
                <button class="button-no-style">
                    '. dd_img("comment", "svg", "20px", "20px", "", "") .'
                </button>
                 '.$repsonses.'
            </div>
        </div>
        <div class="col-5 jc-center">
            <button onclick="savepost(`'. $id .'`, this); return false;" class="p-r button-no-style rf">
                '.$img.'
                '. $saveimg .'
            </button>
        </div>
    </div>
            
    </a>';
}

function dd_button($text, $onclick, $type, $class = "", $style = ""){
    $button = "<" . $type . " ";
    if($class !=""){
        $button .= " class='". $class . "' ";
    }
    if($style !=""){
        $button .= " style='". $style . "' ";
    }
    $button .= $onclick;
    $button .= '>';
    $button .= $text;
    $button .='</'.$type.'>';

    return $button;
}