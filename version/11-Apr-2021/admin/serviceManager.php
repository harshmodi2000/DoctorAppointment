<!DOCTYPE html>
<html>
<head>
	<title>Service Manager</title>
	<?php
	include_once '../includes/jquery.html';//adding jquery
	?>
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

<div>	
<?php
include_once 'index.php';//Including main navigators
?>
</div>

<div id="addservice">
<?php 
include_once 'addservice.php';//including add services
if(isset($_SESSION['success']))
{
	echo "<p style='color:green'>".$_SESSION['success']."</p>";
	unset($_SESSION['success']);
}
?>
</div>

<?php
$service=new Service();
if(isset($_GET['action'])&&isset($_GET['id'])&&$_GET['action']==='delete'&&is_numeric($_GET['id']))
{
	if($service->delete($_GET['id'])!==false)
		{	
			$_SESSION['success']='Service deleted successfully';
			header('Location:'.$_SERVER['PHP_SELF']);
			exit();
		}
		else
		{
			echo "<p style='color:red'>Could not delete record</p>";
		}
}
$serviceList=$service->getAll();
if(empty($serviceList))
{
	echo "<h3>No service found!</h3>";
}
else{
?>
<table id="serv">
<th>Name</th><th>Duration(min)</th>
	<?php
		foreach ($serviceList as $unit) {
			?>
			<tr>
				<td><?php echo $unit['name']; ?></td>
				<td><?php echo $unit['duration'];?></td>
				<td><a href="editService.php?action=edit&id=<?php echo $unit['id'];?>"><button type="button">Edit</button></a></td>
				<td><a href="serviceManager.php?action=delete&id=<?php echo $unit['id'];?>" onclick="return confirm('click ok to confirm deletion')" ><button type="button">Delete</button></a></td>
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