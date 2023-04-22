<?php
include_once "../includes/autoloader.include.php";
session_start();
if (isset($_POST['submit'])&&isset($_POST['password'])&&isset($_POST['username'])) {
	$doctor=new Doctor();
	$error_message=array();
	$password=$_POST['password'];
	$username=$_POST['username'];
	if(Validator::emptyfields($password,$username)){
		$error='all field has to be filled';
		array_push($error_message, $error);
	}
	else{
		$authenticator = new Authenticator($doctor);
		$id = $authenticator->authenticateUser($username,$password);
		if($id===-1) 
		{
			$error='The entered Username or Email is incorrect or do not exist';
			array_push($error_message, $error);
		}
		else
		{
			if($id===0)
			{
			$error='Wrong Password!';
			array_push($error_message, $error);
			}
			else
			{
				$_SESSION['userId']=$id;
				header('Location:../doctor/index.php');
				exit();
			}
		}
	}
}
if(!empty($error_message)){
$_SESSION['error']=$error_message;
header('Location:'.$_SERVER['PHP_SELF']);
exit();
}
 ?>
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Login</title>
</head>
<body>
  <div class=""><!-- this is where the errors will be displayed-->
  	<div id="">
  		<ul class="">
  			<?php
  		if(!empty($_SESSION['error']))
          {
          foreach ( $_SESSION['error'] as $r) 
          {
            echo "<li style='color:red;'>$r</li>";//here will be displayed the error messages,you can add styling to it
          }
          unset($_SESSION['error']);
 		}

  			  ?>
  		</ul>
  	</div>
    <form method="POST">
    <div class="">
      <h2>Login<h2>
        <input type="text" name="username" placeholder="Email or Username...">
        <input type="password" name="password" placeholder="Password">
        <input type="submit" name="submit" value="Log in">
      </form>    
    </div>
    <p><a href="../reset-password/checkmail.php?key=0"> Forgot Password? </p>

    <p> OR <a href="doctorRegistration.html">Register Here!</a></p>
  
  </div>
</body>
 </html>


