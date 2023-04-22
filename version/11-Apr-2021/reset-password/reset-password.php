<?php
require '../includes/mailer.include.php';
include_once "../includes/autoloader.include.php";
if (isset($_POST['key'])&&isset($_POST['submit'])&&isset($_POST['email'])) {
	$reseter= new ResetPassword();
	$key=$_POST['key'];
	$email=$_POST['email'];

	if($key==="0")
	{
		$user = new Doctor();
	}elseif ($key==="1") {
		$user=new Patient();
	}
	elseif($key==="2"){
		$user=new Admin();
	}

	$authenticator = new Authenticator($user);
	if(Validator::isValidMail($email)!==false)
	{
		if ($authenticator->emailExist($email)!==false) {

				$link=$reseter->getLink($key,$email,1800);

				if($link!==false)
				{
					$mailer=new Mailer();
					$receiver=$email;
					$subject='Reset Docare Password';
					$body='We have received a request for password reset.<p>To reset your password, open the link below</p><p>Do not share this link with anyone!</p><p>Link to reset your password:</p><p><a href='.$link.'>'.$link.'</a></p><p><b>Note<b> that you can use the link within 30 minutes</p><br><br>Thank you for using Docare';
					$mailer=$mailer->sendMail($receiver,$subject,$body);
					if($mailer){
						echo "<h2 style='color:green'>An Email has been sent to you! Please check your mailbox...</h2>";
						exit();
					}
					else{
						echo "<h2 style='color:red'>We could not send the email to you!</h2>";
						exit();
					}
				}
				else{
					echo "<h2 style='color:red'>We could not generate email for you!</h2>";
						exit();
				}
			}else{
				echo "<h2 style='color:red'>The email does not exist</h2>";
						exit();
			}	
	}else{
		echo "<h2 style='color:red'>Enter a correct email</h2>";
						exit();
	}
}