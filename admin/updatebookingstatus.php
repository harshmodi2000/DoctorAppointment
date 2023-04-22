<?php 
session_start();
if (!isset($_SESSION['adminId'])||empty($_SESSION['adminId'])) {
	die('Access Denied');
}
include_once "../includes/autoloader.include.php";

if(isset($_POST['bookingId'])&&isset($_POST['action'])){
$bid=$_POST['bookingId'];
$action=strtolower($_POST['action']);
$mailer=new Mailer();
$booking=new Booking();
$appointment=new Appointment();
$patient=new Patient();
$doctor=new Doctor();
if($booking->setBookingById($bid)===false)exit();
if($appointment->setAppointmentById($booking->getAppointmentId())===false)exit();
if($doctor->setUserById($appointment->getDId())===false)exit();
if($patient->setUserById($appointment->getPId())===false)exit();
$role=new Role();
switch ($action) {

	case 'confirm':
		if($booking->confirmBooking($bid))
		{
						$receiver=$patient->getEmail();
                		$subject='Appointment Confirmation';
                		$body="Dear <b>".$patient->getName().',</b>';
                		$body.="<p>Your appointment with <b>Dr ".$doctor->getName()."</b> (".ucwords($role->getUserRole($doctor->getId())).") is scheduled for <b>".$appointment->getApTime()."</b> on <b>".$appointment->getApDate()."</b>.</p>";
                		$body.='<p>Thank you for trusting Docare.<p>';
                 		$mailer=$mailer->sendMail($receiver,$subject,$body);
		}
		break;

	case 'cancel':
	$apid=$appointment->getApId();
			if($appointment->deleteAppointment($apid))
		{
						$receiver=$patient->getEmail();
                		$subject='Appointment Cancellation';
                		$body="Dear <b>".$patient->getName().',</b>';
                		$body.="<p>Your appointment with <b>Dr ".$doctor->getName()."</b> (".ucwords($role->getUserRole($doctor->getId())).") on <b>".$appointment->getApDate()."</b> at <b>".$appointment->getApTime()."</b> has been cancelled.</p>";
                		$body.='<p>Thank you for trusting Docare.<p>';
                 		$mailer=$mailer->sendMail($receiver,$subject,$body);
		}
		break;
	}

}else{
	header('Location:booking.php');
	exit();
}