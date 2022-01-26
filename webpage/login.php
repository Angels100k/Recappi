<?php 

// $mail = new PHPMailer();
$style = '<link rel="stylesheet" href="/assets/css/login.css">';
if (isset($_SESSION['login']) && $_SESSION['login'] == true) {
    header("Location: /home");
}

$pathtwo = $urlpaths[2] ?? 0;
$query = $url['query'] ?? "nextUrl=/";
parse_str($query, $results);
$error = 0;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'] ?? "";
    if($password != ""):
        $returned = $sqlQuery->loginUser($email);
        while($row = $returned->fetch()): 
            if (password_verify($password, $row["password"])):
                $_SESSION["id"] = $row["id"];
                if($row['email'] != null){
                    $_SESSION["admin"] = 1;
                    header("Location: /admin");
                }
                else{
                    if($results){
                        header("Location: ".$results["nextUrl"]);
                    }else {
                        header("Location: /home");
                    }
                }

            else:
                    $error = 1;
            endif;
        endwhile;
    else:
        $returned = $sqlQuery->forgotUser($email);
        while($row = $returned->fetch()): 
        //    sendmail
            sendmail($row["email"]);
        endwhile;
    endif;
}
function sendmail($email){
    // Pear Mail Library
    // $mail = new PHPMailer(true);

    // try {
    //     //Server settings
    //     $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    //     $mail->isSMTP();                                            //Send using SMTP
    //     $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    //     $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    //     $mail->Username   = 'receppi100k@gmail.com';                     //SMTP username
    //     $mail->Password   = '4Y^v4uLnQAnrf';                               //SMTP password
    //     $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    //     $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    
    //     //Recipients
    //     $mail->setFrom('receppi100k@gmail.com', 'Mailer');   //Add a recipient
    //     $mail->addAddress($email);
  
    //     //Content
    //     $mail->isHTML(true);                                  //Set email format to HTML
    //     $mail->Subject = 'Here is the subject';
    //     $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
    //     $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    
    //     $mail->send();
    //     echo 'Message has been sent';
    // } catch (Exception $e) {
    //     echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    // }
    
ini_set("SMTP", "smtp.google.com");
ini_set("sendmail_from", "receppi100k@gmail.com");
$to      = 'olvar@digitaldecoder.nl';
$subject = 'the subject';
$message = 'hello';
$headers = array(
    'From' => 'webmaster@example.com',
    'Reply-To' => 'webmaster@example.com',
    'X-Mailer' => 'PHP/' . phpversion()
);

mail($to, $subject, $message, $headers);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?=dd_head("Login", $style)?>
</head>

<body style="background-color: var(--background)">
<div class="d-flex jc-center" style="margin-top: 4rem;flex-wrap: wrap;">
        <?=dd_img("logo-red-dot", "svg", "212px","81px", "flex:100%;")?>
    </div>


    <div class="main-container text-center" style="bottom: 20px;position: absolute;left: 16px;right: 16px;">
    <?php
if($pathtwo != 0){
   ?>
   <?=dd_field_wrapper("Forgot password", "h1", "text-center f-100")?>
        <?=dd_field_wrapper("Enter your email and we will send you a link to reset your password", "h2", "text-center text-normal f-100")?>
           <form method="post">
            <input required type="text" id="email" name="email" placeholder="Email"><br>
            <input type="submit" value="Send mail" class="button txt-white bg-primary w-100 mt-05 r-max bs-bb">
        </form>
   <?php
}else {
?>
        <?=dd_field_wrapper("Welcome back", "h1", "text-center f-100")?>
        <?=dd_field_wrapper("Login to get to your personal cookbook", "h2", "text-center text-normal f-100")?>
        <form method="post">
            <input required type="text" id="email" name="email" placeholder="Email"><br>
            <input required type="password" id="password" name="password" placeholder="Password"><br>
            <?=dd_button("Forgot my password", "href='/login/forgotpassword'", "a", "txt-primary", "")?>
            <input type="submit" value="Log in" class="button txt-white bg-primary w-100 mt-05 r-max bs-bb">
        </form>
<?php
}
?>
        <?=dd_button("No account yet? Create one here", "href='/register'", "a", "txt-primary mt-1")?>
        </div>

</body>
</html>