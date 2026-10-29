<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';


// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer();
$body = 'hello';

try {
	$mail->SMTPSecure = "ssl";
	$mail->Port       = 587;
  $mail->Host       = 'smtp.gmail.com';   // SMTP server
//  $mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
  //$mail->SMTPAuth   = true;                  // enable SMTP authentication
 // $mail->Host       = "mail.yourdomain.com"; // sets the SMTP server
  $mail->Port       = 465;                    // set the SMTP port for the GMAIL server
  $mail->Username   = 'sinaframework@gmail.com'; // SMTP account username
  $mail->Password   = 'Hello@123';         // SMTP account password


  $mail->AddReplyTo('sinaframework@gmail.com', 'First Last');//sender
  $mail->SetFrom('sinaframework@gmail.com', 'Sina');//sender

  $mail->AddAddress('elias.jabed@gmail.com', 'John Doe');//receiver

  $mail->Subject = 'Invoice - Nutajir';
  $mail->AltBody = 'To view the message, please use an HTML compatible email viewer!'; // optional - MsgHTML will create an alternate automatically

  $mail->MsgHTML($body); //echo "jabed";

  // $mail->AddAttachment('images/phpmailer.gif');
  // $mail->AddAttachment('images/phpmailer_mini.gif');

  $mail->Send();
  echo "Message Sent OK</p>\n";
} catch (phpmailerException $e) {
  echo $e->errorMessage(); //Pretty error messages from PHPMailer
} catch (Exception $e) {
  echo $e->getMessage(); //Boring error messages from anything else!
}
