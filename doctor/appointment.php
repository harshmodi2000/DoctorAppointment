<?php 
session_start();
if(!isset($_SESSION['doctorId'])&&empty($_SESSION['doctorId']))
{
	die('ACCESS DENIED');
}
include_once "../includes/autoloader.include.php";
if(isset($_POST['action'])&&isset($_POST['bid']))
{
	$action=$_POST['action'];
	$bid=$_POST['bid'];
	if($action==='reschedule')
	{
		$b=new Booking();
		if($b->updateBookingStatus($bid,"rescheduled"))
		{
			$success='<p style="color:green">Appointment Rescheduled successfully</p>';
		}else{
			$error='<p style="color:red">Could not Reschedule appointment</p>';
		}
	}
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Appointment List</title>
	<?php include "../includes/jquery.html";?>
	
<?php include "header.php";
    ?>
	<?php 
	if(isset($success))
	echo $success;
	if(isset($error))
		echo $error;
	 ?>
	<div class="container pt-5">
<div class="filter mb-4">
	<form>
        <div class="floating-label ">
            <input placeholder=" " class="mr-3 floating-input" style="color: white;" type="date" name="ap_date">
            <label>Date</label>
        </div>
        <div class="floating-label mt-3">
            <input placeholder=" "  type="text" name="patient_name"  class="floating-input" style="color: white;">
            <label>Patient Name</label>
        </div><!--<button id="reset_apdate">Reset</button>-->
    <button type="reset" id="reset_pname" class="btn btn-danger">Reset</button>    
    </form>
</div>	
<!--
<div class="filter">
	<button >Reset</button>
</div>
-->
<div id="apList">
	
</div>
        </div>
</body>
    <script src="../includes/doctorBookingList.js"></script>
</html>