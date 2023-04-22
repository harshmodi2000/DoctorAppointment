<?php 
include 'index.php';
include_once "../includes/autoloader.include.php";
if(isset($_SESSION['success']))
{
	echo "<p style='color:green'>".$_SESSION['success']."</p>";
	unset($_SESSION['success']);
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Role Manager</title>
	<style>
#serv {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#serv td, #serv th {
  border: 1px solid #ddd;
  padding: 8px;
}

#serv tr:nth-child(even){background-color: #f2f2f2;}

#serv tr:hover {background-color: #ddd;}

#serv th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #4CAF50;
  color: white;
}
	</style>

</head>
<body>
<h2><a href="addrole.php">Add role</a></h2>
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
	<th>Name</th><th>Services</th>
	<?php
		foreach ($roleList as $unit) {
	?>
			<tr>
				<td><?php echo $unit['name']; ?></td>
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
				<td><a href="editRole.php?action=edit&id=<?php echo $unit['id'];?>"><button type="button">Edit</button></a></td>
				<td><a href="roleManager.php?action=delete&id=<?php echo $unit['id'];?>" onclick="return confirm('click ok to confirm deletion')" ><button type="button">Delete</button></a></td>
			</tr>
			<?php
		}
	?>
</table>
<?php 
}
 ?>
</body>
</html>
</body>
</html>