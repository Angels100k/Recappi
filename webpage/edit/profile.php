<?php 
$title = 'edit profile';

$stmt = $sqlQuery->getprofileedit();
$email ="";
$username ="";
$bio ="";
$profileImagetype ="";
$profileImage ="";

while($row = $stmt->fetch()){
    $email = $row['email'];
    $username = $row['username'];
    $bio = $row['bio'];
    $profileImagetype = $row['imgtype'];
    $profileImage = $row['image'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?=dd_head($title, '<link rel="stylesheet" href="/assets/css/profile-edit.css">')?>
</head>
<body style="background-color: var(--background)">
<?php require $dir.'/elements/navbar/navbar-edit-profile.php';?>

    <div class="mt-5 text-center row">
        <div class="col-12">
        <?=dd_img($profileImage, $profileImagetype, '130px', '130px', '', "profile-main-picture", "", "profileimage", ' data-name="'. $profileImage .'" data-type="'. $profileImagetype .'"')?>
        </div>
        <div class="col-12">
            <div class="choose_file txt-primary text-bold">
                <span>add/change photo</span>
                <input id="profilepic" name="Select File" type="file" accept="image/png, image/wbp, image/jpeg" />
            </div>
        </div>
    </div>
    <div class="main-container">
            <h3>Personal Information</h3>

            <input required type="text" id="username" name="username" value="<?=$username?>" placeholder="Name">
            <input required type="email" id="email" name="email" placeholder="Email" value="<?=$email?>">
    </div>
    <div class="main-container">
            <h3>Bio</h3>

            <textarea name="bio" id="bio" id="" placeholder="Tell us about yourself as a cook…"><?=$bio?></textarea>
    </div>

    <div class="main-container">
            <button onclick="profilesave()" class="button txt-white bg-primary w-100 mt-05 r-max bs-bb">Save</button>
    </div>
    <div class="main-container text-center mt-05">
        <a class="txt-primary text-bold" href="/home">Finish later & go to the app</a>
    </div>

    <script src="/assets/js/profile-edit.js"></script>
</body>
</html>