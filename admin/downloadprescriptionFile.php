<?php 
include_once "../includes/autoloader.include.php";
if(isset($_POST['booking_id'])&&!empty($_POST['booking_id']))
{
	$booking = new Booking();
	$bList=$booking->setBookingById($_POST['booking_id']);
	$presc=new Prescription();
	$pList=$presc->setPrescriptionByApId($booking->getAppointmentId());
	//if($pList!==false)
	//{

		//$files=explode(',',$presc->getPrescriptionFile());
		//for($i=0;$i<count($files);$i++) {
			$presc->readPrescriptionFile($presc->getPrescriptionFile());
		//}
	//}else{
		//error_log("could not initiate prescription",0);
	//}
}