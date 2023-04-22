<?php
session_start();
if (!isset($_SESSION['adminId'])||empty($_SESSION['adminId'])) {
	die('Access Denied');
}
include_once "../includes/autoloader.include.php";
$patient=new Patient();

?>
<!DOCTYPE html>
<html>
<head>
	<title>Patient Manager</title>
<? 
include "header.php"; 

?>
</head>
<body>
	<?php include "nav.html";
	if(isset($_GET['delete'])&&is_numeric($_GET['delete']))
{
	if($patient->deleteAccount($_GET['delete']))
	{
		echo '<p style="color:#ffa500">Account deleted successfully</p>';
	}else{
		echo '<p style="color:red">Could not delete account</p>';
	}
	unset($_GET['delete']);
}
?>
    <div class="container pt-5">
	<table id="serv">
        <thead>
		<th>Id</th><th>Name</th><th>Gender</th><th>Address</th><th>Phone</th><th>Email</th><th>Date of birth</th><th></th>
            </thead>
		<?php 
		$patientList=$patient->getAll();
		if($patientList===false)
		{
			echo "No record found!";
		}else{
			foreach ($patientList as $pat) {


			echo "<tr>";
			echo "<td>".$pat['id']."</td>";
			echo "<td>".$pat['name']."</td>";
			echo "<td>".$pat['gender']."</td>";
			echo "<td>".$pat['address']."</td>";
			echo "<td>".$pat['phone']."</td>";
			echo "<td>".$pat['email']."</td>";
			echo "<td>".$pat['date_of_birth']."</td>";
			echo '<td><a href="patientManager.php?delete='.$pat['id'].'"><button type="button" class="btn btn-danger" onclick="return confirm(\'Please confirm deletion\')" >Delete</button></a></td>';
			echo "<tr>";
			}
		}

		 ?>
		
	</table>
        </div>
</body>
</html>
</html>