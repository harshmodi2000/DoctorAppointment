<?php
include_once "../includes/autoloader.include.php";
if (!isset($_SESSION['userId'])||empty($_SESSION['userId'])) {
	die('Access Denied');
}
if(isset($_POST['submit'])||isset($_POST['name'])||isset($_POST['duration']))
{
	$name=$_POST['name'];
	$duration=$_POST['duration'];
	$service=new Service();
	if($service->add($name,$duration))
	{
		$_SESSION['success']='Service added successfully';
		header('Location:serviceManager.php');
		exit();
	}else
	{
		echo '<p style="color:red">Could not add service</p>';
	}
}
		?>
<!DOCTYPE html>
<html>
<head>
	<title>Add service</title>
</head>
<body>
<form method="POST">
<table>
<td><input type="text" name="name" placeholder="Enter service name..."></td>
<td><input type="number" name="duration" placeholder="enter duration in minutes..."></td>
<td><input type="submit" name="submit" value="Add service"></td>
</form>
</table>
</body>
</html>		

