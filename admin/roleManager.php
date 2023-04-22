<?php 
session_start();
if (!isset($_SESSION['adminId'])||empty($_SESSION['adminId'])) {
	die('Access Denied');
}
//include 'index.php';
include_once "../includes/autoloader.include.php";

?>
<!DOCTYPE html>
<html>
<head>
	<title>Role Manager</title>
	<?php include "header.php";?>
</head>
<body>
<?php include "nav.html";
if(isset($_SESSION['success']))
{
	echo "<p style='color:#ffa500'>".$_SESSION['success']."</p>";
	unset($_SESSION['success']);
}
?>
<div class="container pt-5 pb-5">
<a href="addrole.php" class="btn btn-success mb-3">Add role</a>
<?php
$role=new Role();
if(isset($_GET['action'])&&isset($_GET['id'])&&$_GET['action']==='delete'&&is_numeric($_GET['id']))
{
	if($role->delete($_GET['id'])!==false)
		{	
			$_SESSION['success']='Role deleted successfully';
			header('Location:'.$_SERVER['PHP_SELF']);
			exit();
		}
		else
		{
			echo "<p style='color:red'>Could not delete record</p>";
		}
}
$roleList=$role->getAll();
if(empty($roleList))
{
	echo "<h3>No role found!</h3>";
}
else{
?>

<table id="serv">
    <thead>
	<th>Name</th><th>Services</th><th></th><th></th>
        </thead>
	<?php
		foreach ($roleList as $unit) {
	?>
			<tr>
				<td><?php echo ucwords($unit['name']); ?></td>
				<td>
	<?php 
				$serviceNames="";
				$services=explode(',',$unit['service']);
				foreach ($services as $service) {
					$serviceNames.='<ul>'.$role->matchingService($service).'</ul>';
				}

				echo $serviceNames;
	?>
				</td>
				<td><a href="editRole.php?action=edit&id=<?php echo $unit['id'];?>" target="_blank"><button class="btn btn-info" type="button">Edit</button></a></td>
				<td><a href="roleManager.php?action=delete&id=<?php echo $unit['id'];?>" onclick="return confirm('click ok to confirm deletion')" ><button type="button" class="btn btn-danger">Delete</button></a></td>
			</tr>
			<?php
		}
	?>
</table>
<?php 
}
 ?>
    </div>
</body>
</html>
</body>
</html>