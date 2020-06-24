<?php
$success = 0;
require ('includes/AdminInfo.php');
require_once ('includes/config.php');
require ('includes/PHPMailer/PHPMailerAutoload.php');

$errors = array();

if (str_word_count($_POST['fullname']) >= 2){
    $customarName = $_POST['fullname'];
}else{
    $errors['nameWord'] = "Your name must be at least two word";
}
$emailPattern = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';
if (preg_match($emailPattern, $_POST['email'])){
    $pendingEmail = $_POST['email'];
    $query = "SELECT * FROM users WHERE email = '$pendingEmail'";

    $res = mysqli_query($con,$query);
    $row = mysqli_num_rows($res);
    if ($row <= 0){
        $customerEmail = $_POST['email'];
    }else{
        $errors['EmailExists'] = "*";
    }

}else{
    $errors['invalidEmail'] = "Your Email is Invaild";
}
if (validate_mobile($_POST['contactno'])){
    $customarNumber = $_POST['contactno'];
}else{
    $errors['invalidNumber'] = "Your Mobile Number is Invaild";
}
if (strlen($_POST['password']) >=6){
    $pendingPassword = $_POST['password'];
}else{
    $errors['invalidPassword'] = "Your Password must be grether than 6";
}

if ($_POST['password'] == $_POST['confirmpassword']){
    $customarPassword = $_POST['confirmpassword'];
}else{
    $errors['PasswordMatch'] = "Password Don't Match";
}

if (count($errors) == 0){

    $str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqustuvwxyz1234567890@#$%";

    $vkey = substr(str_shuffle($str),0,8);

    $mail = new PHPMailer;

    //    $mail->SMTPDebug = 4;                               // Enable verbose debug output

    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = Email;                 // SMTP username
    $mail->Password = Password;                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to

    $mail->setFrom(Email, 'GO-Bazar');
    $mail->addAddress($customerEmail);     // Add a recipient
    // Name is optional
    $mail->addReplyTo(Email, 'GO-Bazar');


    //   $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    //    $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
    $mail->isHTML(true);                                  // Set email format to HTML

    $mail->Subject = "Welcome $customarName ! Please verify your email address.";
    $mail->Body    = '<p>'."Hellow  $customarName,<br/>
        Wellcome to Go-Bazar Online Shopping Platfrom.To complete your registration,please verify your email address by visiting the following link :".'</p>'
        .'<a href="http://localhost/shopingcart/verified-email.php?id='.$vkey.'&email='.$customerEmail.'">'."http://localhost/shopingcart/verified-email.php?id='.$vkey.'".'</a><br>'."<p>Thank You</p>";
    $mail->AltBody = "Welcome $customarName ! Please verify your email address.";

    if(!$mail->send()) {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        $query = "INSERT INTO users (id, name, email, phoneNumber, password, vKey, is_active) VALUES (NULL,'$customarName','$customerEmail','$customarNumber','$customarPassword','$vkey',0)";
        $results = mysqli_query($con,$query);
        if ($results){
            $success = 1;
            echo $success;
        }else{
            echo $success;
        }

    }
}else{
    echo json_encode($errors);
}

















function validate_mobile($mobile)
{
    return preg_match('/01[3|4|6|7|8|9][0-9]{8}/', $mobile);
}

?>