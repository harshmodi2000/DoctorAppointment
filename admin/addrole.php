<?php
session_start();
if (!isset($_SESSION['adminId'])||empty($_SESSION['adminId'])) {
	die('Access Denied');
}
include_once "../includes/autoloader.include.php";
if(isset($_POST['submit'])||isset($_POST['name'])||isset($_POST['serviceList']))
{
	$name=strtolower($_POST['name']);
	if(strlen($name)<1||empty($_POST['serviceList']))
	{
		echo '<p style="color:red">Name and one service is compulsory</p>';
	}
	else{
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
}
$serviceObj=new Service();
		?>
<!DOCTYPE html>
<html>
<head>
	<title>Add Role</title>
	<? include "header.php"; ?>
</head>
<body>
	<?php include "nav.html";?>
    <div class="container pt-5 pb-5">
<form method="POST">
<table>
<td><div class="floating-form"><div class="floating-label"><input type="text" name="name" class="floating-input" placeholder=" " required ><label>Role Name</label></div></div></td>
<td><?php echo $serviceObj->displayServiceList();?></td>
<td><input type="submit" name="submit" class="btn btn-success"  value="Add role"></td>
</form>
</table>
        </div>
</body>
</html>		

