<?php
include_once "../includes/autoloader.include.php";
if (isset($_GET['selector'])&&isset($_GET['validator'])&&isset($_GET['key'])) {
	$selector=$_GET['selector'];
	$validator=$_GET['validator'];
	$key=$_GET['key'];
	if ($key!=='0'&&$key!=='1'&&$key!=="2") {
		header('Location:../homepage/homepage.php');
		exit();
	}
	if(empty($selector)||empty($validator))
	{
		echo "Error!";
	}
	else
	{
		if(ctype_xdigit($selector)!==false&&ctype_xdigit($validator)!==false)
		{
			?>
			
			<!DOCTYPE html>
			<html>
			<head>
				<title>Reset Password</title>
			</head>
			<body>
				<form action='resetvalidation.php' method='post'>
					<input type='hidden' name='selector' value=<?php echo $selector; ?> >
					<input type='hidden' name='validator' value=<?php echo $validator; ?> >
					<input type='hidden' name='key' value=<?php echo $key; ?> >
					<input type='password' name='password' placeholder='Enter your new password...'>
					<input type='password' name='confirm_password' placeholder='Retype your password...'>
					<input type='submit' name='submit' value='Reset Password'>
				</form>
			</body>
			</html> 

			<?php
		}
		else{
			//selector and validator has been modified and their format is incorrect
			header('Location:../homepage/homepage.php');//go to homepage
			exit();
		}
	}

}