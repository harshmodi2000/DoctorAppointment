<?php
session_start();
if (!isset($_SESSION['adminId'])||empty($_SESSION['adminId'])) {
	die('Access Denied');
}
include_once "../includes/autoloader.include.php";
$scheduler=new Scheduler();
$role=new Role();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Schedule Manager</title>
	<?php include "header.php"; ?>
    <script src="../includes/mapsetting.js"></script>
    <style>
    	#list, #message,#no-display{
			display: none;
			}
    </style>
</head>
<body>
<?php 
include "nav.html";
?>
<div class="container pt-5 pb-5">
<a href="scheduleModel.php" class="btn btn-success">CREATE A MODEL </a>
<a href="ScheduleList.php" class="btn btn-secondary">SEE LIST OF SCHEDULE </a>
<p id="message"></p>
<table id="serv">
    <thead>
	<th>Doctor Name</th><th>Role</th><th>Schedule</th>
        </thead>
    
	<tr id="no-display">
		<td id="list" colspan="3">
		<select  name="schedule">
          <?php $s=$scheduler->displayScheduleList();
          echo ($s!==false)?$s:'No Model Available!';
          ?>
          </select>
	</td></tr>
	<?php 
	$map=$scheduler->showScheduleMapping();
	if($map===false){
		echo "<p>No record for mapping found<p>";
	}else{
		foreach ($map as $row) {
			echo '<tr>';
			echo '<input type="hidden" class="hiddenId" value="'.$row['id'].'" >';
			echo "<td>".$row['name']."</td>";
			echo "<td>".ucwords($role->getUserRole($row['id']))."</td>";
			$s=$row['schedule_name']!==null?'<p class="schedulename">'.ucfirst($row['schedule_name']).'<p><a class="btn btn-light mr-3"  href="scheduleList.php?s='.$row['schedule_name'].'">See details</a><a class="btn btn-info mr-3 edit" href="#">Edit</a><a href="#" class="delete btn btn-danger">Delete</a>':'<p>Not Specified</p><a href="#" class="edit">Add</a>';
			echo '<td class="s-name">'.$s."</td>";
			echo "</tr>";
		}
	}
	 ?>
</table>
    </div>
</body>
</html>