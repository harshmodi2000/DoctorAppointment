<?php
if(isset($_GET['key'])){

	$key=$_GET['key'];
	if ($key!=="0"&&$key!=="1"&&$key!=="2") {//0for doctor, 1 for patient, 2 for admin

			header('Location:../homepage/homepage.php');//go to homepage
			exit();
	}
}
else
{
	header('Location:../homepage/homepage.php');//go to homepage
	exit();
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Reset Password</title>
</head>
<body>
<h1>Reset your password</h1>
<h3> En email will be sent to you with the instructions on how to rest your password...</h3>
<form action="reset-password.php" method="post">
<p>Enter your registered mail address :</p>
<input type="hidden" name="key" value=<?php echo $key;?>>
<input type="text" name="email">
<br>
<input type="submit" name="submit">
</form>
</body>
</html>