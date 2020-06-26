<?php



class SendEmail{
    private $email;
    private $ReseterName;
    const EMAIL = "nurulaminlimon261893@gmail.com";
    const PASSWORD = "##$369949$##";
    public $sqli;

    public function __construct($email)
    {
        $this->sqli = new database();
        $this->email = $email;
    }
    public function SetResetName($name){
        $this->ReseterName = $name;
    }

    public function Send(){
        $rand = rand(11111111,99999990);
        $vkey = substr($rand,0,6);

        $mail = new PHPMailer;

        //    $mail->SMTPDebug = 4;                               // Enable verbose debug output

        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = self::EMAIL;                 // SMTP username
        $mail->Password = self::PASSWORD;                           // SMTP password
        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;                                    // TCP port to connect to

        $mail->setFrom(self::EMAIL, 'GO-Bazar');
        $mail->addAddress($this->email);     // Add a recipient
        // Name is optional
        $mail->addReplyTo(self::EMAIL, 'GO-Bazar');


        //   $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
        //    $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
        $mail->isHTML(true);                                  // Set email format to HTML

        $mail->Subject = "Reset Password Notification";
        $mail->Body    = '<p>'."Hellow ".$this->ReseterName." ,<br/>
        WWe have received a request for forgotten password of your account.<br>
        You can enter the following code to reset your password.".'</p>'.
            "code :".$vkey."<br>".
            "This password reset link will expire in 2 minutes."
            ;
        $mail->AltBody = "Welcome $this->ReseterName ! Reset Your Password.";

        if(!$mail->send()) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            $query = "UPDATE users SET forgetKey= '$vkey' WHERE email = '".$this->email."'";
            $results = mysqli_query($this->sqli->sql,$query);
            if ($results){
                return true;
            }else{
                return false;
            }

        }
    }

    public function NullSet(){

        $query = "UPDATE users SET forgetKey= NULL WHERE email = '".$this->email."'";
        $results = mysqli_query($this->sqli->sql,$query);
        if ($results){
            return true;
        }else{
            return false;
        }
    }

    public function ForgetKeyMatch($key){

        $query = "SELECT users.forgetKey FROM users WHERE email = '".$this->email."'";
        $res = $this->sqli->sql->query($query);
        if ($res->field_count > 0){
            $row = $res->fetch_array();
            $fkey =  $row['forgetKey'];
            if ($fkey == $key){
                return 1;
            }else{
                return 0;
            }
        }
    }

}


?>