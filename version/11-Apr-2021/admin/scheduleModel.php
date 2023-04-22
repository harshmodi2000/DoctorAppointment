<?php 
include 'index.php';
include_once "../includes/autoloader.include.php";
include_once "../includes/jquery.html";
$scheduler=new Scheduler();
if(isset($_SESSION['error']))
{
	echo $_SESSION['error'];
	unset($_SESSION['error']);
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>New Model</title>
	<script src="../includes/schedulescript.js"></script>
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
#row{
	display: none;
}
.input-error{
	box-shadow: 0 0 5px red;
	}
	</style>
</head>
<body>
	<?php 
	if(isset($_SESSION['success']))
	{
		echo $_SESSION['success'];
		unset($_SESSION['success']);
	}
	 ?>
<form action="createModel.php" method="POST" id="mdlform">
	<p class="message"></p>
	<label><b><u>Schedule name :</u></b>&nbsp</label><input type="text" id="scheduleName" name="name" placeholder="Enter name of the schedule" required><br><br>
	<table id="serv">
	<th>Days</th><th>T1 </th><th>T2 </th><th>T3 </th><th>T4 </th>
		<tr id="row">
			<td class="cbDays">
				<input type="checkbox" class='days' value="MON"><label>MON</label><br>
				<input type="checkbox" class='days' value="TUE"><label>TUE</label><br>
				<input type="checkbox" class='days' value="WED"><label>WED</label><br>
				<input type="checkbox" class='days' value="THU"><label>THU</label><br>
				<input type="checkbox" class='days' value="FRI"><label>FRI</label><br>
				<input type="checkbox" class='days' value="SAT"><label>SAT</label><br>
				<input type="checkbox" class='days'value="SUN"><label>SUN</label><br> 
			</td>

			<td>
				<input class="time1" type="time">
				<input class="time1" type="time">
			</td>
			<td>
				<input class="time2" type="time" >
				<input class="time2" type="time" >
			</td>
			<td>
				<input  class="time3" type="time" >
				<input  class="time3" type="time" >
			</td>
			<td>
				<input  class="time4" type="time" >
				<input  class="time4" type="time" >
			</td>
		</tr>
	</table>
			<button type="button" id="newRow">Add Row</button>
			<input type="submit" id="submit" name="submit" onclick="return confirm('Please confirm schedule creation')">
			

</form>
</body>
</html>