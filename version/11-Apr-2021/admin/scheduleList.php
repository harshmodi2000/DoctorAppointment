<?php 
include 'index.php';
include_once "../includes/autoloader.include.php";
include_once "../includes/jquery.html";
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
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script>
		$(function(){
			$('a.listItem').click(function(e){
				e.preventDefault();
				var val=$(this).text();
				$('.column2').load("modelDetail.php",{
				name: val,
				action: "details"
				});
			});
			$('button.btnDelete').click(function(e){
				e.preventDefault();
				var val=$(this).val();
				if(confirm('Please Confirm Deletion')){
				var parent=$('<form method="POST"></form>');
				var el=$('<input type="hidden" name="name" value="'+val+'">');
				parent.append(el).appendTo('body');
				parent.submit().remove();
				}
			});
		});
	</script>
	<style>
		table, td, th {
  border: 1px solid black;
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
</head>
<body>
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
  <div class="column1" style="background-color:#aaa;">
  	<h2>Names</h2>
    <table id="list">
    	<?php
    	$list=$scheduler->getScheduleNames();
    	if($list!==false)
    	{
    		foreach ($list as $name) {
    			echo '<tr><td><a href="#" class="listItem">'.ucfirst($name['name']).'</a></td>';
    			echo '<td><button class="btnDelete" value="'.$name['name'].'">Delete</button></td></tr>';
    		}
    	}else{
    		echo '<p style="color:red">No model found</p>';
    	}
    	?>
    </table>
  </div>
  <div class="column2" style="background-color:#bbb;">
  	<h2>Details</h2>
  </div>
</div>
</div>
</body>
</html>