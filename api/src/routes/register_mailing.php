<?php
	require "../../vendors/phpmailer/class.phpmailer.php";
	require "../../vendors/phpmailer/PHPMailerAutoload.php";
     /*Lo primero es añadir al script la clase phpmailer desde la ubicación en que esté*/
 
//Crear una instancia de PHPMailer
$mail = new PHPMailer();
//Definir que vamos a usar SMTP
$mail->IsSMTP();
//Se recoge el id del usuario al que se le enviará el correo
$iduser=$id;
//Esto es para activar el modo depuración. En entorno de pruebas lo mejor es 2, en producción siempre 0
// 0 = off (producción)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug  = 0;
//Ahora definimos gmail como servidor que aloja nuestro SMTP
$mail->Host       = 'smtp.gmail.com';
//El puerto será el 587 ya que usamos encriptación TLS
$mail->Port       = 587;
//Definmos la seguridad como TLS
$mail->SMTPSecure = 'tls';
//Tenemos que usar gmail autenticados, así que esto a TRUE
$mail->SMTPAuth   = true;
//Definimos la cuenta que vamos a usar. Dirección completa de la misma
$mail->Username   = "newgameweb@gmail.com";
//Introducimos nuestra contraseña de gmail
$mail->Password   = "newgamenewgame=1";
//Definimos el remitente (dirección y, opcionalmente, nombre)
$mail->SetFrom('david.gargom.94@gmail.com', 'NewGame');
//Y, ahora sí, definimos el destinatario (dirección y, opcionalmente, nombre)
$mail->AddAddress($email, $username);
//Definimos el tema del email
$mail->Subject = 'NewGame Confirmation email';
//Para enviar un correo formateado en HTML lo cargamos con la siguiente función. Si no, puedes meterle directamente una cadena de texto.
$mail->MsgHTML("<p><h1>Welcome ".$username."</h1>
			To confirm your account for user: ".$username." please click on the next link: http://www.newgame.local/api/public/users/update/".$id."</p>");
//Y por si nos bloquean el contenido HTML (algunos correos lo hacen por seguridad) una versión alternativa en texto plano (también será válida para lectores de pantalla)
$mail->AltBody = 'This is a plain-text message body';
//Enviamos el correo
if(!$mail->Send()) {
  echo "Error: " . $mail->ErrorInfo;
} else {
  echo "A confirmation link has send to your email, please click on the link to activate your account";
}
?>