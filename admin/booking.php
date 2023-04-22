<?php  
session_start();
if (!isset($_SESSION['adminId'])||empty($_SESSION['adminId'])) {
	die('Access Denied');
}
include_once "../includes/autoloader.include.php";
$roles=new Role();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Booking And Appointment</title>
	<?php include "../includes/jquery.html";?>
	<?php include "header.php"; ?>
</head>
<body>
    <? include "nav.html"; ?>
    <div class="container pt-5">
    <div style="width:20rem;">
        
<div class="filter floating-label">

	<select name="filter_category" class="floating-select" style="color:#fff;">
		<option value="*" selected="true">----All----</option>
		<?php $s=$roles->displayRoleList();
          echo ($s!==false)?$s:'No Record Found for roles';
          ?>
	</select>
    	<label>Category : </label>
</div>
<div class="filter floating-label">

	<input type="date" class="floating-input" style="color:#fff;" name="filter_bookingDate">
    	<label>Booking Date : </label>
	<button class="btn btn-secondary mt-3 mb-3" id="reset_bookingDate">Reset</button>
</div>
<div class="filter floating-label">

	<select name="filter_bookingStatus" class="floating-select" style="color:#fff;" id="filter_bookingStatus">
		<option value="*" selected="true">All</option>
		<option value="requested">Requested</option>
		<option value="confirmed">Confirmed</option>
		<option value="request_for_cancellation">Request for cancellation</option>
		<option value="expired">Expired</option>
		<option value="attended">Attended</option>
		<option value="rescheduled">Rescheduled</option>
	</select>
    	<label>Booking Status : </label>
</div>
<div class="filter floating-label">
	
	<input type="date" placeholder=" " class="floating-input" style="color:#fff;" name="filter_appointmentDate">
    <label>Appointment Date : </label>
	<button id="reset_appointmentDate" class="btn btn-secondary mt-3 mb-3">Reset</button>
</div>
<div class="filter floating-label">
	
	<input type="text" placeholder=" " class="floating-input" style="color:#fff;" name="filter_doctorName" class="floating-label">
    <label>Doctor Name : </label>
	<button class="btn btn-secondary mt-3 mb-3" id="reset_doctorName">Reset</button>
</div>
<div class="filter floating-label">
	
	<input type="number" placeholder=" " class="floating-input" style="color:#fff;" name="filter_bookingId">
    <label>Booking ID : </label>
	<button class="btn btn-secondary mt-3 mb-3" id="reset_bookingId">Reset</button>
</div>
        </div>
<div id="display-bookings">

</div>
   </div> 
</body>
    <script src="../includes/bookinglist.js"></script>
</html>