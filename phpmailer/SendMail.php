<?php
//$mailer = new PHPMailer;
		//$TO_ADDRESS
		//$SUBJECT
		//$BODY 
// 	require_once 'PHPMailerAutoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';
	$mailer = new PHPMailer;
	function SendMail($mailer,$TO_ADDRESS,$SUBJECT='',$BODY='',$ATTACHMENT='',$BCC='') {
		$SMTP_SERVER_EMAIL='noreply@xpertsfinder.com';
		$NO_REPLY='noreply@xpertsfinder.com';
		$SMTP_SERVER_PASSWORD='hXilJ(.o[#zx';
		$SMTP_FROM_NAME = "Xperts Finder";
		// $SMTP_SERVER_EMAIL='elias@hostdivine.com';
		// $NO_REPLY='no-reply@hostdivine.com';
		// $SMTP_SERVER_PASSWORD='=p7nKW$@2*L*';
		// $SMTP_FROM_NAME = "Directory";

		$mailer->SMTPSecure = "STARTTLS"; //ssl STARTTLS
		$mailer->Host       = "mail.xpertsfinder.com";
		$mailer->Port       = 465;

		$mailer->Username   = $SMTP_SERVER_EMAIL;     // SMTP server username
		$mailer->Password   = $SMTP_SERVER_PASSWORD;            // SMTP server password

		$mailer->ClearAddresses();
		//send to client
		$mailer->From = $SMTP_SERVER_EMAIL;
		$mailer->FromName = $SMTP_FROM_NAME;
		//$mailer->addAddress($sendTo);
		//$mailer->addBCC($admin2);
		//$mailer->addBCC($admin3);
		//$mailer->addCC($SMTP_SERVER_EMAIL);

		$mailer->addAddress($TO_ADDRESS);

		if(trim($BCC) !="") {
			$BCC_ARRAY = explode(",",$BCC);
			foreach ($BCC_ARRAY as $bcc_email){
				$bcc_email = trim($bcc_email);
				$mailer->addBCC($bcc_email);
			}
		}

		$mailer->addReplyTo($NO_REPLY);
		$mailer->isHTML(true);
		$mailer->Subject = $SUBJECT;
		$mailer->Body = $BODY;

		if($ATTACHMENT !="") { //echo 'att';
		$mailer->addAttachment($ATTACHMENT, 'Attachment'); //echo 'att';
		}
		//$mailer->AltBody = $message;
		if(!$mailer->send()){
			//return false;
		}else{
			//return true;
		}
	}

?>
