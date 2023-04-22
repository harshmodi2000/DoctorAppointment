<?php 
session_start();
if(!isset($_SESSION['patientId'])||empty($_SESSION['patientId']))
{
	echo '<script>alert("Please Log In")</script>';
}
include_once "../includes/autoloader.include.php";
if(isset($_POST['ap_date'])&&isset($_POST['ap_time'])&&isset($_POST['doctorId']))
{
	$pid=$_SESSION['patientId'];
	$did=$_POST['doctorId'];
	$ap_date=$_POST['ap_date'];
	$ap_time=$_POST['ap_time'];
	$time=DateTime::createFromFormat( 'g:i A', $ap_time )->format( 'H:i' );
	$ap=new Appointment();
	$appointmentId=$ap->saveAppointment($pid, $did, $ap_date, $ap_time);
	if($appointmentId!==false)
	{
		$bo=new Booking();
		$bookedSlot=$ap->getBookedSlot($did, $ap_date);
			if($bookedSlot!==false)
			{	
					if(in_array($time, $bookedSlot))
					{
						echo '<p style="color:red">Sorry, Slot already booked!</p>';
						exit();
					}
			}
					if($bo->saveBooking($appointmentId))
					{	
						$role=new Role();
						$doctor=new Doctor();
						$doctor->setUserById($did);
						$patient=new Patient();
						$patient->setUserById($pid);
						$mailer=new Mailer();
                		$receiver=$patient->getEmail();
                		$subject='New Appointment';
                		$body="Dear <b>".$patient->getName().',</b>';
                		$body.="<p>You have requested an appointment with <b>Dr ".$doctor->getName()."</b> (".ucwords($role->getUserRole($did)).") on <b>$ap_date</b> at <b>$ap_time</b>.</p>";
                		$body.='Your request have been received and waiting for approval.';
                		$body.='<p>Thank you for trusting Docare.<p>';
                 		$mailer=$mailer->sendMail($receiver,$subject,$body);
						echo '<script>alert("Booking has been placed")</script>';

					}else{
						if($ap->deleteAppointment($appointmentId))
						{echo '<p style="color:red">Could not place booking</p>';}
					}
	}else{
		echo '<p style="color:red">Could not save appointment</p>';
	}
}else{
	header('Location:booking.php');
	exit();
}
