<?php
	require "../../vendors/phpmailer/class.phpmailer.php";
	require "../../vendors/phpmailer/PHPMailerAutoload.php";
 
  $mail = new PHPMailer();
  $mail->isHTML(true);
  $mail->isMail();
  $mail->SMTPDebug  = 0;
  $mail->Host       = 'smtp.gmail.com';
  $mail->Port       = 587;
  $mail->SMTPSecure = 'tls';
  $mail->SMTPAuth   = true;
  $mail->Username   = "newgameweb@gmail.com";
  $mail->Password   = "newgamenewgame=1";
  $mail->SetFrom($email, 'NewGame');
  $mail->AddAddress("newgameweb@gmail.com", $username);
  $mail->Subject = 'NewGame contact confirmation email';
  $mail->MsgHTML("<h1>".$subject."</h1>
                  <p>".$description."</p>
                  <p>From: <b>".$username.",</b>
                     Email: <b>".$email."</b></p>"
                  );
  $mail->AltBody = 'This is a plain-text message body';
  if(!$mail->Send()) {
    echo "Error: " . $mail->ErrorInfo;
  } else {
    echo "A confirmation link has send to your email, please click on the link to activate your account";
  }
?>