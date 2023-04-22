<?php
$path="../mailer/src/";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require $path.'Exception.php';
require $path.'PHPMailer.php';
require $path.'SMTP.php';

class Mailer{
	private $host='smtp.gmail.com';
	private $authentication = 'true';
	private $username='docare.app2021@gmail.com';
	private $password='docare@avengers2021';
	private $port='587';
	private $sender='Docare App';

	public function sendMail(...$args){
		$receiver=$args[0];
		$subject=$args[1];
		$body=$args[2];
		$mail = new PHPMailer(true);
		try {
    //Server settings
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = $this->host;                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = $this->username;                     // SMTP username
    $mail->Password   = $this->password;                               // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = $this->port;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom($this->username, $this->sender);
    //$mail->addAddress($reciever, 'Joe User');     // Add a recipient
    $mail->addAddress($receiver);               // Name is optional
    //$mail->addReplyTo('info@example.com', 'Information');
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

    // Attachments
    if(count($args)>3)
    {
    	for ($i=3; count($args)>3 ; $i++) { 
    		$mail->addAttachment($args[$i]);
    		unset($args[$i]); 
    	}
    }	
            // Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = $subject;
    $mail->Body    = $body;
    $mail->AltBody = $body;

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
	}
}