<?php  
session_start();
if (!isset($_SESSION['patientId'])||empty($_SESSION['patientId'])) {
	die('Access Denied');
}
include_once "../includes/autoloader.include.php";
$roles=new Role();
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<?php 
//    include "../includes/jquery.html";
    
    ?>
	
<?php include "header.php"; ?>
    <div class="container pt-5">
<div class="filter">
	<label>Category : </label>
	<select class="floating-select" style="    width: 15rem;" name="filter_category">
		<option value="*" selected="true">----All----</option>
		<?php $s=$roles->displayRoleList();
          echo ($s!==false)?$s:'No Record Found for roles';
          ?>
	</select>
</div>
<div class="filter">
	<div><label>Booking Date : </label></div>
	<input type="date" style="    width: 15rem;" class="floating-input d-inline mr-3" name="filter_bookingDate">
    <button class="btn btn-secondary" id="reset_bookingDate">Reset</button>
</div>
<div class="filter">
	<div><label>Booking Status : </label></div>
	<select name="filter_bookingStatus" style="    width: 15rem;" class="floating-select d-inline mr-3" id="filter_bookingStatus">
		<option value="*" selected="true">Undefined</option>
		<option value="requested">Requested</option>
		<option value="confirmed">Confirmed</option>
		<option value="request_for_cancellation">Request for cancellation</option>
		<option value="expired">Expired</option>
		<option value="attended">Attended</option>
		<option value="rescheduled">Rescheduled</option>
	</select>
</div>
<div class="filter">
	<div><label>Appointment Date : </label></div>
	<input type="date" style="    width: 15rem;" class="floating-input d-inline mr-3"  name="filter_appointmentDate">
	 <button class="btn btn-secondary" id="reset_appointmentDate">Reset</button>
</div>
<div class="filter">
	<div><label>Doctor Name : </label></div>
	<input type="text" style="    width: 15rem;" class="floating-input d-inline mr-3"  name="filter_doctorName">
	 <button class="btn btn-secondary" id="reset_doctorName">Reset</button>
</div>
<div id="display-bookings">

</div>
</div>
</body>
    <script src="../includes/patientBookingList.js"></script>
</html>