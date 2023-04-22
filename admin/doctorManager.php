<?php
session_start();
if (!isset($_SESSION['adminId'])||empty($_SESSION['adminId'])) {
	die('Access Denied');
}
include_once "../includes/autoloader.include.php";
$doctor=new Doctor();
$role=new Role();
$scheduler=new Scheduler();
  ?>

<!DOCTYPE html>
<html>
<head>
	<title>Doctor Manager</title>
	<?php include "header.php"?>
</head>
<body>
	<?php include "nav.html"?>
	<?php
	if(isset($_GET['delete'])&&is_numeric($_GET['delete']))
		{
	if($doctor->deleteAccount($_GET['delete']))
	{
		echo '<p style="color:#ffa500">Account deleted successfully</p>';
	}else{
		echo '<p style="color:red">Could not delete account</p>';
	}
	unset($_GET['delete']);
		}
	?>
<div class="container pt-5">
	<a class="btn btn-success mb-3" href="addDoctor.php">Add Doctor</a>
	<table id="serv">
        <thead>
		<th>Name</th><th>Gender</th><th>Role</th><th>Phone</th><th>Email</th><th>Schedule name</th><th></th>
            </thead>
		<?php 
		$doctorList=$doctor->getAll();
		if($doctorList===false)
		{
			echo "No record found!";
		}else{
			foreach ($doctorList as $doc) {
				$r=$role->getUserRole($doc['id']);
				if($r===false){
					$r="Unassigned";
				}
				$s=$scheduler->getSchedule($doc['id']);
				if($s===false){
					$s="Undefined";
				}

			echo "<tr>";
			echo "<td>".$doc['name']."</td>";
			echo "<td>".$doc['gender']."</td>";
			echo "<td>".ucwords($r)."</td>";
			echo "<td>".$doc['phone']."</td>";
			echo "<td>".$doc['email']."</td>";
			echo "<td>".ucfirst($s)."</td>";
			echo '<td><a href="editDoctor.php?id='.$doc['id'].'" class="btn btn-info mr-3" >Edit</a><a href="doctorManager.php?delete='.$doc['id'].'"><button type="button" class="btn btn-danger" onclick="return confirm(\'Please confirm deletion\')" >Delete</button></a></td>';
			echo "<tr>";
			}
		}

		 ?>
		
	</table>
    </div>
</body>
</html>