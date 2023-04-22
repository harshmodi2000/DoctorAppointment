<?php 
//session_start();
//if(!isset($_SESSION['patientId'])||empty($_SESSION['patientId']))
//{
//	die("ACCESS DENIED!");
//}
include_once "../includes/autoloader.include.php";
$roles=new Role();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Book Appointment</title>
	<?php include("../includes/jquery.html"); ?>
	<script src="../includes/bookAppointment.js"></script>
	<style>
		
/*
		td, th{
			border-style: ridge;
			border-width: 2px;
            background:rgba(0,0,0,0.45);
            margin-right: 1rem;
		}
*/
        tr{
            margin-right: 1rem;
            background:rgba(0,0,0,0.45);
            border:1px solid;
        }

	</style>
<?php include "header.php"; ?>
    <div class="container pt-5 pb-5">
<h1 class="mb-3">Book Appointment</h1>
<div class="maincategory mb-2">
    <div class="floating-label">

	<select class="floating-select" style="width:13rem;background-color: blue;" id="category">
       
		<option value="*" >----All----</option>
		<?php $s=$roles->displayRoleList();
          echo ($s!==false)?$s:'No Record Found for roles';
          ?>
	</select>
        	<label class="form-label">Category : </label>
        </div>
</div>
<div id="filter" class="mb-3">
    
	<button id="addfilter" class="btn btn-success">Add filter</button>
</div>
<div id="message"></div>
<div id="display">
	
</div>
        </div>
</body>
</html>