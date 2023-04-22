<?php 
session_start();
if(!isset($_SESSION['doctorId'])&&empty($_SESSION['doctorId']))
{
	die('ACCESS DENIED');
}
include_once "../includes/autoloader.include.php";
if(isset($_POST['ap_date'])&&isset($_POST['patient_name']))
{
	$count=0;
	$ap_date=$_POST['ap_date'];
	$p_name=$_POST['patient_name'];
	$ap=new Booking();
	$ap->updateExpiredBookings();
	$appointmentList=$ap->doctorAppointmentList($_SESSION['doctorId']);
	echo '<table>';
	echo '<thead><th>Date</th><th>Time</th><th>Patient</th><th></th><th></th></thead>';
	
	foreach ($appointmentList as $ap) {
		
		if($ap['status']==='request_for_ cancellation'||$ap['status']==='expired'||$ap['status']==='rescheduled')
		{
			continue;
		}
		$pat=new Patient();
		$pat->setUserById($ap['patientId']);
		$pat_info=empty($pat->getName())?$pat->getEmail():$pat->getName();
		if(!empty($ap_date))
		{
			if($ap_date!==$ap['appointmentDate'])
			{
				continue;
			}
		}
		if(!empty($p_name))
		{
			$pat=new Patient();
				if(!stripos($pa->getName(),$p_name))
				{
					continue;
				}
		}
		echo '<tr>';
		echo '<input type="hidden" value="'.$ap['id'].'" class="bid">';
		echo '<td>'.DateTime::createFromFormat( 'Y-m-d', $ap['appointmentDate'] )->format( 'd-M-Y' ).'</td>';
		echo '<td>'.DateTime::createFromFormat( 'H:i:s', $ap['appointmentTime'] )->format( 'g:i A' ).'</td>';
		echo '<td>'.$pat_info.'</td>';
		if($ap['status']==='attended')
		{
			echo '<td><a href="#" class="prescription">See prescription</a></td>';
		}else{
			echo '<td><a href="chat.php?bid='.$ap['id'].'&pid='.$pat->getId().'"><button type="button" class="btn btn-success">Receive</button></a></td>';
			echo '<td><button class="reschedule btn btn-secondary">Reschedule</button></td>';
		}
		$count++;
		echo '</tr>';
	}
	if($count<1){
		echo "No appointment found";
	}
	echo '</table>';
}else{
	header('location:appointmentManager.php');
	exit();
}

 ?>
