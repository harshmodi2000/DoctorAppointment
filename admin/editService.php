<?php  
session_start();
if (!isset($_SESSION['adminId'])||empty($_SESSION['adminId'])) {
	die('Access Denied');
}
include_once 'index.php';
include_once "../includes/autoloader.include.php";
if(isset($_GET['action'])&&isset($_GET['id'])&&!strlen($_GET['id'])<1&&$_GET['action']==='edit'&&is_numeric($_GET['id']))
{
	$success="";
	$error="";
	$id=$_GET['id'];
	$service=new Service();
	$details=$service->setServiceById($id);
	$serviceName=$service->getName();
	$serviceDuration=$service->getDuration();
	$selfurl=$_SERVER['PHP_SELF']."?action=edit&id=$id";
	if(isset($_POST['submit'])&&isset($_POST['name'])&&isset($_POST['duration']))
	{
		if(!empty($_POST['name'])&&!strlen($_POST['name'])<1&&$_POST['name']!==$serviceName)
		{
			if($service->updateName($id,$_POST['name'])!==false)
			{
				$service->setName($_POST['name']);
				$success.='<li style="color:green">Name has been updated</li>';
				
			}else
			{
				$error.='<li style="color:red">Could not update name</li>';
			}
		}
		if(!empty($_POST['duration'])&&!strlen($_POST['duration'])<1&&$_POST['duration']!==$serviceDuration)
		{
			if($service->updateDuration($id,$_POST['duration'])!==false)
			{
				$service->setDuration($_POST['duration']);
				$success.='<li style="color:green">Duration has been updated</li>';
			}else
			{
				$error.='<li style="color:red">Could not update duration</li>';
			}
		}
	}
	?>
	<!DOCTYPE html>
	<html>
	<head>
		<title>Edit Service</title>
		<script type="text/javascript">
		function confirmation()
		{
			if(confirm('Press Ok to confirm'))
				{form.submit();}
		}
	</script>
	</head>
	<body>
		<ul>
		<?php
			if(!empty($success)){
				$_SESSION['success']=$success;
				header('Location:serviceManager.php');
				exit();
			}
			if(!empty($error)){
				echo $serror;
			}
		?>
		</ul>
	<form method="POST" action="<?php echo($selfurl);?>">
		<table>
			<td><input type="text" name="name" value="<?php  echo($service->getName());?>"></td>
			<td><input type="number" name="duration" value="<?php  echo($service->getDuration());?>"></td>
			<td><button type="submit" name="submit" value="Edit" onclick="confirmation()">Edit Service</button></td>
	</form>
	</form>
	</body>
	</html>
	<?php

}else
{
	header('Location:index.php');
	exit();
}
?>