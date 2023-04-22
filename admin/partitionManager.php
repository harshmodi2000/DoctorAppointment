<?php 
session_start();
if (!isset($_SESSION['adminId'])||empty($_SESSION['adminId'])) {
	die('Access Denied');
}
include_once "../includes/autoloader.include.php";

?>
<!DOCTYPE html>
<html>
<head>
	<title>Time Partition</title>
	<?php include_once "header.php";?>
</head>
<body>
	<?php include "nav.html";?>
    <div class="container pt-5">

	<div id="message"></div>
	<div id="default">
<?php
$partitioner=new TimePartition();
$timeslots=$partitioner->getrecord();
echo '<br><alabel id="primary-label"><b>Default:</b>&nbsp</alabel>';
$default=$partitioner->checkDefaultTable();
if($default!==false)
{
	echo '<select id="default-selected">';
	echo '<option value="max">Max service</option>';
	echo '<option value="customize" selected="true" >Customize</option>';
	echo "</select>";
	echo "&nbsp<label>Duration: </label>";
	echo '<input type="number" value='.$default['duration'].' readonly="true" id="new-duration">';
	echo "&nbsp<label>Margin: </label>";
	$margin=isset($default['margin'])&&$default['margin']!==null?$default['margin']:'0';
	echo '<input type="number" value='.$margin.' readonly="true" id="new-margin">';
	echo '<button type="button" id="edit-default">Modify</button>';
	echo '<button type="button" id="delete-default">Delete</button>';
}else{
	echo '<select id="default-selected">';
	echo '<option value="max" selected="true" >Max service</option>';
	echo '<option value="customize" >Customize</option>';
	echo "</select>";
}
if(empty($timeslots))
{
	echo "<h3>No role found!</h3>";
}
else{
?>
</div>
<br>
<table id="serv">
    <thead>
	<th>Roles</th><th>Duration(min)</th><th>Margin(min)</th><th></th>
        </thead>
	<?php
		foreach ($timeslots as $unit) {
			echo "<tr>";
			echo '<input type="hidden" value="'.$unit['id'].'" >';
			echo "<td >".ucwords($unit['name'])."</td>";
			echo '<td class="duration">'.$unit['duration']."</td>";
			echo '<td class="margin">'.$unit['margin']."</td>";
			echo '<td class="action">';
			echo '<a href="#" class="edit-row btn btn-info mr-3">Edit</a><a href="#" class="delete-row btn btn-danger">Delete</a>';
			echo '</td>';
			echo "</tr>";
		}
	?>
</table>
<?php 
}
 ?>
        </div>
</body>
    <script src="../includes/partition.js"></script>
</html>
</body>
</html>