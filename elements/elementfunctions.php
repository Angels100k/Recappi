<?php
function dd_img($image, $type, $width = '', $height = '', $style = '', $class = '', $onclick = '', $id = '', $custom = "")
{
            if($type != "svg"){
        $src = "/assets/img/webp/".$image . ".webp";
        $errsrc = "/assets/img/".$image . "." . $type;

        $class_content = $class != "" ? " class='" . $class . "'" : "";
        $style_content = $style != "" ? " style='" . $style . "'" : "";
        $onclick_content = $onclick != "" ? " onclick='" . $onclick . "'" : "";
        $id_content = $id != "" ? " id='" . $id . "'" : "";

        return '<img '. $custom . " ".$id_content.' src="'.$src.'" onerror="imgerror(this, `'.$errsrc.'`);" width="'.$width.'" height="'.$height.'" '.$style_content. $class_content. $onclick_content.'>';
    }
    else {
        $src = "/assets/img/svg/".$image . "." . $type;
        return '<img src="'.$src.'" '. $custom .' width="'.$width.'" height="'.$height.'" style="'.$style.'" class="'.$class.'">';
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

function dd_draftrecipebigedit($data){
    if($data["image"] && $data["type"]):
        $img = dd_img($data["image"], $data["type"], "150px", "150px", "", "border-small object-cover bg-img");
    else:
        $img = dd_img("placeholder", "png", "150px", "150px", "", "bg-img");
    endif;
    return '
        <a href="/edit/recipe/'.$data["id"].'" style="flex-shrink:0;" class="shadow mr-2 border-small bs-bb w-150 h-150 img-bg edit-draft-close">
        '.$img.'
        <h3 class="txt-white text-center">'.$data['recipe'].'</h3>
            '.dd_img("pen-white", "svg", "18px", "18px", "    position: absolute; right: 10px; bottom: 10px;", "").'
        </a>
    ';
}

function dd_DraftRecipeBigShow($data){
    if($data["image"] && $data["type"]):
        $img = dd_img($data["image"], $data["type"], "150px", "150px", "", "border-small object-cover");
    else:
        $img = dd_img("placeholder", "png", "150px", "150px", "", "bg-img");
    endif;
    return '
        <a href="/recipe/'.$data["id"].'" style="flex-shrink:0;" class="shadow mr-2 border-small bs-bb w-150 h-150 img-bg">
        '.$img.'
        <h3 class="txt-white text-center">'.$data['recipe'].'</h3>
            '.dd_img("savefill", "svg", "18px", "18px", "    position: absolute; right: 10px; bottom: 10px;", "").'
        </a>
    ';
}

function dd_head($title, $extra ="")
{
    $html = "";

    $html .= '<meta charset="UTF-8">';
    $html .= '<meta http-equiv="X-UA-Compatible" content="IE=edge">';
    $html .= '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
    $html .= '<title>'. $title .'</title>';
    $html .= '<script src="/assets/js/index.js"></script>';
    $html .= '<script defer src="/assets/js/navbar.js"></script>';
    $html .= '<script defer src="/assets/js/history.js"></script>';
    $html .= '<link rel="stylesheet" href="/assets/css/main.css">';
    $html .= '<link rel="manifest" href="/manifest.json">';
    $html .= '<link rel="icon" href="/favicon.ico" type="image/x-icon" />';
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

function dd_layout_post($id, $receptname, $preptime, $difficulty, $likes, $repsonses, $image, $type, $likedID, $saveID, $userid){
    // $reuslt = $sql->userinfo($userid);
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
    if($userid != $_SESSION["id"]){
        $button = ' <button onclick="savepost(`'. $id .'`, this); return false;" class="p-r button-no-style rf">
        '.$img.'
        '. $saveimg .'
    </button>';
    }else {
        $button = ' <div class="p-r button-no-style rf">
        '.$img.'
    </div>';
    }
    $dots = "";
   
    for ($x = 0; $x < $difficulty; $x++):
        $dots.= "<span class='text-black mr-02'>&#9679</span>";
    endfor;
    for ($y = $x; $y <= 4; $y++):
        $dots.= "<span class='text-grey mr-02'>&#9679</span>";
    endfor;
    return '<a style="margin-top: 1rem;" href="/recipe/'.$id.'/" class="txt-black shadow col-12 bg-white p-1 border-small mt-3 bs-bb receptitem">
    <div style="" class="row">
        <div style="margin-top: -15px" class="col-12"><h2 class="text-bold">'.$receptname.'</h2></div>
        <div class="col-7">
            <div class="txt-subheader">Prep time</div>
            <span class="text-bold">'.$preptime.' min</span><br>
            <div style="padding-top: 1rem;" class="txt-subheader">Difficulty</div>
            '.$dots.'
            <div style="padding-top: 1rem; padding-bottom: 10px;" class="text-bold">
                <button style="padding-right: 1rem" onclick="likepost(`'. $id .'`, this); return false;" class="button-no-style">
                '. $likeimg .'<span>'.$likes.'</span> 
                </button>
                    
                <button class="button-no-style" onclick="location.href=`/recipe/'.$id.'/#comments`;return false;">
                    '. dd_img("comment", "svg", "20px", "20px", "", "") .''.$repsonses.'
                </button>
                 
            </div>
        </div>
        <div class="col-5 jc-center">
           '.$button.'
        </div>
    </div>
            
    </a>';
}


function dd_layout_friend($row){
    return '<a href="/profile/'.$row["name"].'/" class="txt-black shadow col-12 bg-white p-1 border-small mt-3 bs-bb receptitem">
    <div class="row">
        <div class="col-3 text-center">
            '. dd_img($row["image"], $row["imgtype"], "60px", "60px", "", "profile-main-picture") .'
        </div>
        <div class="col">
            <div class="row">
                <div class="text-bold text-size-1-5">'.$row["username"].'</div>
            </div>
            <div class="row" style="align-content: center; align-items: center">
                <div class="text-bold">'.$row["recepts"].'</div><div class="ml-05 text-grey txt-medium">recepten</div>
            </div>
        </div>
    </div>
            
    </a>';
}

function dd_showshoppinglist($data){
    if($data["owned"] == 1){
        $own = "checked";
    }else {
        $own = "";
    }
    return'
    <div class="col-12 row  mt-1-not-first top-border">
        <div class="pt-05">
            <div class="custom-checkbox"  onclick="klikaj(`checkbox_'.$data["id"].'`)">
                <input type="checkbox" '.$own.' id="checkbox_'.$data["id"].'" />
                <label for="checkbox" ></label>
            </div>
        </div>
        <div class="ml-1 pt-05 border col">
            <span class="text-bold">'.$data['amount'].'</span> '.$data['ingredient'].' <span class="text-bold"> '. $data['amountunit'].' '.$data['unit'].'</span>
        </div>
    </div>
    ';
}

function dd_showshoppinglistedit($data){
    if($data["owned"] == 1){
        $own = "checked";
    }else {
        $own = "";
    }
    return'
    <div class="col-12 row  mt-1-not-first top-border">
        <div class="pt-05">
            <div class="custom-checkbox"  onclick="klikaj(`checkbox_'.$data["id"].'`)">
                <input type="checkbox" '.$own.' id="checkbox_'.$data["id"].'" />
                <label for="checkbox" ></label>
            </div>
        </div>
        <div class="ml-1 pt-05 border col row">
            <div class="col" onclick="klikajEdit(`'.$data["amountId"].'`,`'.$data['amount'].'`, `'.$data['ingredient'].'`, `'. $data['amountunit'].'`, `'.$data['unit'].'`, this)">
                <span class="text-bold">'.$data['amount'].'</span> '.$data['ingredient'].' <span class="text-bold"> '. $data['amountunit'].' '.$data['unit'].'</span>
            </div>
            <span class="rf text-h-primary text-bold" onclick="klikajDel(`checkbox_'.$data["id"].'`, `shoppingListContainer`)">DELETE</span>
        </div>
    </div>
    ';
}

function dd_showingradientlist($data){
    return'
    <div class="col-12 row  mt-1-not-first top-border">
        <div class="pt-05">
            <div class="custom-checkbox">
                <input type="checkbox"/>
                <label for="checkbox" ></label>
            </div>
        </div>
        <div class="ml-1 pt-05 border col">
            <span class="text-bold">'. $data['amountunit'].' '.$data['unit'].'</span> '.$data['ingredient'].'
        </div>
    </div>
    ';
}

function dd_showingradientlistedit($data){
    return'
    <div class="col-12 row  mt-1-not-first top-border">
        <div class="pt-05">
            <div class="custom-checkbox">
                <input type="checkbox"/>
                <label for="checkbox" ></label>
            </div>
        </div>
        <div class="ml-1 pt-05 border col row">
            <div class="col" onclick="klikajEditrecipe(`'. $data['amountunit'].'`, `'.$data['unit'].'`, `'.$data['ingredient'].'`, `'.$data["id"].'`, this)">
            <span class="text-bold">'. $data['amountunit'].' '.$data['unit'].'</span> '.$data['ingredient'].'
            </div>
            <span class="rf text-h-primary text-bold" onclick="klikajDelrecipe(`checkbox_'.$data["id"].'`, `ingredientContainer`)">DELETE</span>
        </div>
    </div>
    ';
}


function dd_showshoppinglistrecipe($data, $multiplier){
    return'
    <div class="col-12 row  mt-1-not-first top-border">
        <div class="pt-05">
            <div class="custom-checkbox" onclick="klikadd(`checkbox_'.$data["id"].'`)">
                <input type="checkbox" class="checkbox" id="checkbox_'.$data["id"].'"/>
                <label for="checkbox" ></label>
            </div>
        </div>
        <div class="ml-1 pt-05 border col converted-container">
             <span class="text-bold converted converted-amountunit" data-multiplier="'.$multiplier.'" data-amountunit="'. $data['amountunit'].'" data-unit="'.$data['unit'].'" > '. $data['amountunit'].' </span> <span class="text-bold converted-unit"> '.$data['unit'].' </span><span data-id="'.$data['ingredientid'].'" class="converted-ingredient">'.$data['ingredient'].'</span>
        </div>
    </div>
    ';
}

function dd_preprecipe($data){
    return'
    <div class="col-12 row  mt-1-not-first">
        <div class="ml-1 pt-05 border col">
             <span class="text-size-1-5"> '. $data['step'].'   </span><span>'.$data['text'].'</span>
        </div>
    </div>
    ';
}
function dd_preprecipeedit($data){
    return'
    <div class="col-12 row  mt-1-not-first" onclick="editPrepMethodRecipe(`'. $data['step'].'`,`'.$data['text'].'`,this)">
        <div class="ml-1 pt-05 border col">
             <span class="text-size-1-5"> '. $data['step'].'   </span><span>'.$data['text'].'</span>
        </div>
    </div>
    ';
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