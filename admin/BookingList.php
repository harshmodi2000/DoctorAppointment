<?php 
session_start();
if (!isset($_SESSION['adminId'])||empty($_SESSION['adminId'])) {
	die('Access Denied');
}
include_once "../includes/autoloader.include.php";
if(isset($_POST['category'])&&isset($_POST['application_date'])&&isset($_POST['doctor_name'])
	&&isset($_POST['booking_id'])&&isset($_POST['booking_date'])&&isset($_POST['booking_status']))
{
	$bdate=$_POST['booking_date'];
	$cat=$_POST['category'];
	$apdate=$_POST['application_date'];
	$dname=$_POST['doctor_name'];
	$booking_id=$_POST['booking_id'];
	$bstat=$_POST['booking_status'];
	$bookings=new Booking();
	$bookings->updateExpiredBookings();
	$bookingList=$bookings->getAll();
	if($bookingList===false)
		{
	echo "No Booking Found!";
	exit();
		}
	echo '<table>';
	echo '<thead><th>Booking ID</th><th>Appointment</th><th>Category</th><th>Doctor</th><th>Patient</th><th>Booking Details</th><th colspan="2"></th></thead>';
	foreach ($bookingList as $booking) {

		if(!empty($booking_id))
		{
			if($booking_id!==$booking['id'])
			{
				continue;
			}
		}
		if(!empty($bdate))
		{
			$actualBdate=DateTime::createFromFormat( 'Y-m-d H:i:s', $booking['bookingDate'] )->format( 'Y-m-d' );
			if($bdate!==$actualBdate)
			{
				continue;
			}
		}
		if($bstat!=="*"){
			if($booking['status']!==$bstat)
			{
				continue;
			}
		}
		$bid=$booking['id'];
		$apDetail="";
		$category="";
		$docDetails="";
		$patDetails="";
		$boDetails='Booked On : '.$booking['bookingDate'].'<br> Status : '.ucfirst($booking['status']);
			$ap=new Appointment();
			if($ap->setAppointmentById($booking['appointmentId'])===false)
			{
				$bookings->deleteBooking($booking['id']);
				continue;
			}
			if(!empty($apdate))
			{
				if($apdate!==$ap->getApDate())
				{
					continue;
				}
			}
			$apDetail.='Date : '.$ap->getApDate().'<br>';
			$apDetail.='Time : '.$ap->getApTime();
			$do=new Doctor();
			if($do->setUserById($ap->getDId())===false)
			{
				continue;
			}
			if(!empty($dname))
			{
				if(stripos($do->getName(),$dname)===false)
				{
					continue;
				}
			}
			$role=new Role();
			$doctorRole=$role->getUserRole($do->getId());
			if($cat!=="*")
			{
				if($cat!==$doctorRole)
				{
					continue;
				}
			}
			$doctorRole=ucwords($doctorRole);
			$docDetails.='Name : '.$do->getName().'<br>';
			$docDetails.='Phone : '.$do->getPhone().'<br>';
			$docDetails.'email : '.$do->getEmail();
			$category=$doctorRole;
			$pa=new Patient();
			$pa->setUserById($ap->getPId());
			$patDetails.='Name: '.$pa->getName().'<br>';
			$patDetails.='Phone : '.$pa->getPhone().'<br>';
			$patDetails.='Email : '.$pa->getEmail();
			echo '<tr>';
			echo '<td><input type="hidden" class="booking-id" value="'.$bid.'">'.$bid.'</td>';
			echo '<td>'.$apDetail.'</td>';
			echo '<td>'.$category.'</td>';
			echo '<td>'.$docDetails.'</td>';
			echo '<td>'.$patDetails.'</td>';
			echo '<td>'.$boDetails.'</td>';
			if($booking['status']==='requested')
			{
				echo '<td><button class="confirm-booking btn btn-primary">Confirm</button></td>';
				echo '<td><button class="cancel-booking btn btn-danger">Cancel</button></td>';
			}elseif($booking['status']==='attended')
			{
				echo '<td><a href="#" class="prescription btn btn-success">See Prescription</a></td>';
			}else{
				echo '<td colspan="2"><button class="cancel-booking btn btn-danger">Cancel</button></td>';
			}
			echo '</tr>';

		}	
	echo '</table>';
}else{
	header('Location:booking.php?unauthorized');
	exit();
}