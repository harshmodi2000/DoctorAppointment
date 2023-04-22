<?php
include_once "../includes/autoloader.include.php";
if (!isset($_SESSION['adminId'])||empty($_SESSION['adminId'])) {
	die('Access Denied');
}
if(isset($_POST['submit'])||isset($_POST['name'])||isset($_POST['duration']))
{
	$name=$_POST['name'];
	$duration=$_POST['duration'];
	$service=new Service();
	if($service->add($name,$duration))
	{
		$_SESSION['success']='Service added successfully';
		header('Location:serviceManager.php');
		exit();
	}else
	{
		echo '<p style="color:red">Could not add service</p>';
	}
}
		?>
<form method="POST">
<!--<table>-->
    <div class="floating-form mb-3">
<div class="floating-label"><input type="text" class="floating-input" name="name" placeholder=" "><label>Service Name</label></div>
<div class="floating-label">
<input type="number" name="duration" class="floating-input" placeholder=" " min="1">
<label>Duration in min</label>
</div>
<input type="submit" name="submit" class="btn btn-success" value="Add Service">
        </div>
</form>
<!--</table>-->
<!--
</body>
</html>		

-->
