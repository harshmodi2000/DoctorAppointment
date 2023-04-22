<?php
include_once "../includes/autoloader.include.php";
if(isset($_POST['selector'])&&isset($_POST['validator'])&&isset($_POST['key'])&&isset($_POST['password'])&&isset($_POST['confirm_password'])&&isset($_POST['submit']))	
{
	$selector=$_POST['selector'];
	$validator=hex2bin($_POST['validator']);
	$key=$_POST['key'];
		if($key==="0")
	{
		$user = new Doctor();
	}elseif ($key==="1") {
		$user=new Patient();
	}elseif($key==="2"){
		$user = new Admin();
	}

	$password=$_POST['password'];
	$confirm_password=$_POST['confirm_password'];
	$reseter= new ResetPassword();
	if(Validator::invalidPasswordLength($password)!==false)
		{
			echo "Password should be at least 6 character";	
		}
		else{
			if(Validator::isNotMatched($password,$confirm_password)!==false)
			{	
				echo "password and confirm do not match!";
				exit();
				
			}
			else
				{
					$email=$reseter->validateRequest($selector,$validator);

					if($email!==false)
					{

						if($user->updatePasswordByEmail($email,$password)){
								echo "<h2 style='color:green'>You password has been reset successfully</h2><br><a href='../login/patientlogin.html'>Go to login page</a>";
								exit();
						}
						else {
								echo "Could not reset your password";
								exit();
						}

					}
					else
					{
							echo "Could not validate your request";
								exit();
					}

				}		
			}
}