<?php 
$title = 'edit Recipe';
$recipeName ="";
$image ="";
$type ="";
$description = "";
$made = 0;
if ($urlpaths[3]) {
    $stmt = $sqlQuery->getRecipeEdit($urlpaths[3]);
    
        while($row = $stmt->fetch()){
        $recipeName = $row["recipe"];
        $image = $row["image"];
        $type = $row["type"];
        $made = $row["made"];
        $description = $row["description"];
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?=dd_head($title, '<link rel="stylesheet" href="/assets/css/profile-edit.css">')?>
</head>

<body style="background-color: var(--background)">
    <div class="main-container d-grid">
        <input required type="text" value="<?=$recipeName?>" id="recipeName" name="recipeName"
            placeholder="Name recipe"><br>
        <div class="row mb-4">
            <div class="col">
                <?=dd_img($image, $type, "150px", "150px", "", "border-small object-cover"); ?>
            </div>
            <div class="col">
                <div class="row">
                    <div class="col">
                        <p>Did you make this photo yourself?</p>

                    </div>
                    <div class="col">
                        <label class="switch rf">
                            <input type="checkbox" <?php  if($made) echo "checked"; ?>>
                            <span class="slider round"></span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <span class="text-bold">
            Decription (optional)
        </span>
        <textarea id="" cols="30" rows="10" placeholder="Add a short description about your recipe.."><?=$description?></textarea>
        <span class="text-bold mt-2">
            Duration
        </span>
        
    </div>
</body>

</html>