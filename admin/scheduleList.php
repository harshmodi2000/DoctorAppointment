<?php 
session_start();
if (!isset($_SESSION['adminId'])||empty($_SESSION['adminId'])) {
  die('Access Denied');
}
include_once "../includes/autoloader.include.php";
$scheduler=new Scheduler();
if(isset($_POST['name']))
{
	$name=$_POST['name'];
				if($scheduler->deleteModel($name)!==false)
				{
					echo '<script>alert("Model Deleted Successfully")</script>';
				}else{
					echo '<script>alert("Could not delete Model!")</script>';
				}
}

if(isset($_GET['s']))
{
$s=ucfirst($_GET['s']);
$script=<<<l
$(document).ready(function(){
$("a.listItem:contains('$s')").trigger('click')});
l;
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Schedule detail</title>
	<style>
		table, td, th {
/*  border: 1px solid black;*/
}

table {
  width: 100%;
  border-collapse: collapse;
}
* {
  box-sizing: border-box;
}

/* Create two equal columns that floats next to each other */
.column2 {
  float: left;
  width: 70%;
  padding: 10px;
  height: 300px; /* Should be removed. Only for demonstration */
}
.column1 {
  float: left;
  width: 30%;
  padding: 10px;
  height: 300px; /* Should be removed. Only for demonstration */
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}

	</style>
<?php 
    include "header.php"; 
    ?>
</head>
<body>    
    <?php include "nav.html";?>
	<div class="container pt-5 pb-5">
	<h1>LIST OF SCHEDULE</h1>
	<?php
	if(isset($_SESSION['success']))
	{
		echo $_SESSION['success'];
		unset($_SESSION['success']);
	}
		if(isset($_SESSION['error']))
	{
		echo $_SESSION['error'];
		unset($_SESSION['error']);
	}
	?>
	<div class="row">
  <div class="column1">
  	<h2>Names</h2>
    <table id="list">
    	<?php
    	$list=$scheduler->getScheduleNames();
    	if($list!==false)
    	{
    		foreach ($list as $name) {
    			echo '<tr><td><a href="#" class="listItem" style="color:white">'.ucfirst($name['name']).'</a></td>';
    			echo '<td><button class="btnDelete btn btn-danger" value="'.$name['name'].'">Delete</button></td></tr>';
    		}
    	}else{
    		echo '<p style="color:red">No model found</p>';
    	}
    	?>
    </table>
  </div>
  <div class="column2" style="background-color:#202020;">
  	<h3>Click the link on the left to see details...</h3>
  </div>
</div>
</div>
    </div>
</body>
<script src="../includes/schedulelist.js"></script>
<script>
	<?php 
  if(isset($script)&&!empty($script))
  {echo $script;} 
  ?>
</script>
</html>