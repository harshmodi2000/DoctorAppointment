<?php 
session_start();
if (!isset($_SESSION['adminId'])||empty($_SESSION['adminId'])) {
	die('Access Denied');
}
include_once "../includes/autoloader.include.php";
$scheduler=new Scheduler();

?>
<!DOCTYPE html>
<html>
<head>
	<title>New Model</title>
	<?php include_once "../includes/jquery.html";?>
	<style>
		#row{
	display: none;
	}
	.cbDays{
		width:100px;
	}

	</style>
<script src="../includes/schedulescript.js"></script>
	<?php 
    include("header.php");
	 ?>
</head>
<body>
<?php include "nav.html";
if(isset($_SESSION['error']))
{
	echo $_SESSION['error'];
	unset($_SESSION['error']);
}
	if(isset($_SESSION['success']))
	{
		echo $_SESSION['success'];
		unset($_SESSION['success']);
	}
?>	 

    <div class="container pt-5">
    <form action="createModel.php" method="POST" id="mdlform">
	<p class="message"></p>
    <div class="floating-label w-25">
	<input type="text" id="scheduleName" name="name" class="floating-input" placeholder=" " required>
    <label>Schedule name*</label>
    </div>
    <table id="serv">
        <thead><th>Days</th><th>T1 </th><th>T2 </th><th>T3 </th><th>T4 </th></thead>
	
		<tr id="row">
			<td class="cbDays">
				<input type="checkbox" class='days' value="MON"><span>MON</span><br>
				<input type="checkbox" class='days' value="TUE"><span>TUE</span><br>
				<input type="checkbox" class='days' value="WED"><span>WED</span><br>
				<input type="checkbox" class='days' value="THU"><span>THU</span><br>
				<input type="checkbox" class='days' value="FRI"><span>FRI</span><br>
				<input type="checkbox" class='days' value="SAT"><span>SAT</span><br>
				<input type="checkbox" class='days'value="SUN"><span>SUN</span><br> 
			</td>

			<td>
				<lable>FROM&nbsp:&nbsp</lable><input class="time1" type="time">
				<lable>TO&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp:&nbsp</lable><input class="time1" type="time">
			</td>
			<td>
				<lable>FROM&nbsp:&nbsp</lable><input class="time2" type="time" >
				<lable>TO&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp:&nbsp</lable><input class="time2" type="time" >
			</td>
			<td>
				<lable>FROM&nbsp:&nbsp</lable><input  class="time3" type="time" >
				<lable>TO&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp:&nbsp</lable><input  class="time3" type="time" >
			</td>
			<td>
				<lable>FROM&nbsp:&nbsp</lable><input  class="time4" type="time" >
				<lable>TO&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp:&nbsp</lable><input  class="time4" type="time" >
			</td>
		</tr>
	</table>
    <div class="mt-3">
			<button type="button" class="btn btn-secondary mr-3" id="newRow">Add Row</button>
			<input type="submit" id="submit" class="btn btn-success"  name="submit" onclick="return confirm('Please confirm schedule creation')">
			
    </div>
</form>
</div>
</body>
    
</html>