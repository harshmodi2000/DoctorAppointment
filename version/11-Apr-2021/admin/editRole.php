<?php  
include_once 'index.php';
include_once "../includes/autoloader.include.php";
if(isset($_GET['action'])&&isset($_GET['id'])&&!strlen($_GET['id'])<1&&$_GET['action']==='edit'&&is_numeric($_GET['id']))
{
	$success="";
	$error="";
	$id=$_GET['id'];
	$role=new Role();
	$details=$role->setRoleById($id);
	$roleName=$role->getName();
	$roleServices=$role->getService();
	$selfurl=$_SERVER['PHP_SELF']."?action=edit&id=$id";
	if(isset($_POST['submit'])&&isset($_POST['name'])&&isset($_POST['serviceList']))
	{
			$services=$_POST['serviceList'];
				sort($services);
					$temp='';
				foreach ($services as $service) {
				$temp.="$service,";
					}
			$services=trim($temp,',');
		if(!empty($_POST['name'])&&!strlen($_POST['name'])<1&&$_POST['name']!==$roleName)
		{
			if($role->updateName($id,$_POST['name'])!==false)
			{
				$role->setName($_POST['name']);
				$success.='<li style="color:green">Name has been updated</li>';
				
			}else
			{
				$error.='<li style="color:red">Could not update name</li>';
			}
		}
		if(!empty($services)&&!strlen($services)<1&&$services!==$roleServices)
		{
			if($role->updateService($id,$services)!==false)
			{
				$role->setService($services);
				$success.='<li style="color:green">Service has been updated</li>';
			}else
			{
				$error.='<li style="color:red">Could not update Service</li>';
			}
		}
	}
	$serviceObj=new Service();
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
				header('Location:roleManager.php');
				exit();
			}
			if(!empty($error)){
				echo $serror;
			}
		?>
		</ul>
	<form method="POST" action="<?php echo($selfurl);?>">
		<table>
			<td><input type="text" name="name" value="<?php  echo($role->getName());?>"></td>
			<td><?php  echo($serviceObj->displayServiceList_checked($roleServices));?></td>
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