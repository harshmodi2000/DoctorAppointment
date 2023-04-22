<?php
include_once "../includes/autoloader.include.php";
include_once "index.php";
if(isset($_POST['submit'])||isset($_POST['name'])||isset($_POST['serviceList']))
{
	$name=ucwords($_POST['name']);
	$services=$_POST['serviceList'];
	sort($services);
	$temp='';
	foreach ($services as $service) {
		$temp.="$service,";
	}
	$service=trim($temp,',');
	$role=new Role();
	if($role->add($name,$service))
	{
		$_SESSION['success']="Role added successfully";
		header('Location:roleManager.php');
	}else
	{
		echo '<p style="color:red">Could not add role</p>';
	}
}
$serviceObj=new Service();
		?>
<!DOCTYPE html>
<html>
<head>
	<title>Add Role</title>
</head>
<body>
<form method="POST">
<table>
<td><input type="text" name="name" placeholder="Enter role name..."></td>
<td><?php echo $serviceObj->displayServiceList();?></td>
<td><input type="submit" name="submit" value="Add role"></td>
</form>
</table>
</body>
</html>		

