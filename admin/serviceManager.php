<?php
session_start();
if (!isset($_SESSION['adminId'])||empty($_SESSION['adminId'])) {
	die('Access Denied');
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Service Manager</title>
    <?php include "header.php" ?>
<body>    
	<?php include "nav.html"; ?>
<div class="container pt-5 pb-5">	
<div id="addservice">
<?php 
include_once 'addservice.php';//including add services
if(isset($_SESSION['success']))
{
	echo "<p style='color:#ffa500'>".$_SESSION['success']."</p>";
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
    <thead>
<th>Name</th><th>Duration(min)</th><th></th><th></th>
        </thead>
	<?php
		foreach ($serviceList as $unit) {
			?>
			<tr>
				<td><?php echo $unit['name']; ?></td>
				<td><?php echo $unit['duration'];?></td>
				<td><a href="editService.php?action=edit&id=<?php echo $unit['id'];?>" class="btn btn-info">Edit</a></td>
				<td><a href="serviceManager.php?action=delete&id=<?php echo $unit['id'];?>" onclick="return confirm('click ok to confirm deletion')" class="btn btn-danger">Delete</a></td>
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