<?php 
session_start();
if (!isset($_SESSION['patientId'])||empty($_SESSION['patientId'])) {
	die('Access Denied');
}
include_once "../includes/autoloader.include.php";
if(isset($_POST['category'])&&isset($_POST['appointment_date'])&&isset($_POST['doctor_name'])&&isset($_POST['booking_date'])&&isset($_POST['booking_status']))
{
	$bdate=$_POST['booking_date'];
	$cat=$_POST['category'];
	$apdate=$_POST['appointment_date'];
	$dname=$_POST['doctor_name'];
	$bstat=$_POST['booking_status'];
	$bookings=new Booking();
	$bookings->updateExpiredBookings();
	$bookingList=$bookings->patientAppointmentList($_SESSION['patientId']);
	if($bookingList===false)
		{
	echo "No Booking Found!";
	exit();
		}
	echo '<table>';
	echo '<thead><th>Appointment</th><th>Category</th><th>Doctor</th><th>Booking Details</th><th></th></thead>';
	foreach ($bookingList as $booking) {
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
		$apDetail="";
		$category="";
		$docDetails="";
		$bstatus=$booking['status'];
		if($booking['status']==='request_for_ cancellation')
		{
			$bstatus= 'Requested for cancellation';
		}

		$boDetails='Booked On : '.$booking['bookingDate'].'<br> Status : '.ucfirst($bstatus);
			if(!empty($apdate))
			{
				if($apdate!==$booking['appointmentDate'])
				{
					continue;
				}
			}
			$apDetail.='Date : '.DateTime::createFromFormat( 'Y-m-d', $booking['appointmentDate'] )->format("d-M-Y" ).'<br>';
			$apDetail.='Time : '.DateTime::createFromFormat( 'H:i:s', $booking['appointmentTime'] )->format( "g:i A" );
			$do=new Doctor();
			if($do->setUserById($booking['doctorId'])===false)
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
			$roleId=$role->getMatchingRole($do->getId());
			if($cat!=="*")
			{
				if($cat!==$roleId['roleId'])
				{
					continue;
				}
			}
			$doctorRole=ucwords($doctorRole);
			$docDetails.=$do->getName();
			$category=$doctorRole;
			echo '<tr>';
			echo '<input type="hidden" class="booking-id" value="'.$booking['id'].'">';
			echo '<td>'.$apDetail.'</td>';
			echo '<td>'.$category.'</td>';
			echo '<td>'.$docDetails.'</td>';
			echo '<td>'.$boDetails.'</td>';
//			if($booking['status']==='requested'||$booking['status']==='confirmed')
			if($booking['status']==='requested')
            {
				echo '<td><button class="cancel-booking btn btn-danger">Cancel</button></td>';
			}elseif($booking['status']==='attended')
			{
				echo '<td><a href="#"" class="prescription"><button class="see-prescription btn btn-alert">See prescription</button></a></td>';
			}
            elseif($booking['status']==='confirmed'){
                echo '<td><a href="chat.php?did='.$do->getId().'" class="btn btn-info">Chat with doctor</a></td>';
            }
			echo '</tr>';
		}	
	echo '</table>';
}else{
	header('Location:booking.php?unauthorized');
	exit();
}