<?php 
//session_start();
//if(!isset($_SESSION['patientId'])||empty($_SESSION['patientId']))
//{
//	die("ACCESS DENIED!");
//}
include_once "../includes/autoloader.include.php";
if(isset($_POST['doctorId'])&&is_numeric($_POST['doctorId'])&&!strlen($_POST['doctorId'])<1&&isset($_POST['ap_date']))
{
$doctorId=$_POST['doctorId'];
$ap_date=$_POST['ap_date'];
$scheduler=new Scheduler();
$role=new Role();
$partitioner=new TimePartition();
$dRole=$role->getMatchingRole($doctorId);
$roleId=$dRole['roleId'];
$partition=$partitioner->singleRecord($roleId);
$duration=$partition['duration'];
$margin=$partition['margin'];
$scheduleName=$scheduler->getSchedule($doctorId);
	if($scheduleName===false)
	{
		echo "No schedule found for this doctor";
		exit();
	}
$scheduleDetail=$scheduler->getScheduleDetail($scheduleName);
	if($scheduleDetail===false)
	{
		echo "Schedule not defined";
		exit();
	}
	$datetime=new Datetime($ap_date);
//	echo '<table class="mt-3 mb-3">';
//	echo "<th>".$datetime->format("d-M-Y")."</th><th>".$datetime->modify("+1 day")->format("d-M-Y")."</th><th>".$datetime->modify("+1 day")->format("d-M-Y")."</th>";
//	echo "<tr>";
    echo '<div class="mt-3 mb-3 bookingSlots text-center row">';
	echo "<div class='bookingDate col'>".$datetime->format("d-M-Y")."</div><div class='bookingDate col'>".$datetime->modify("+1 day")->format("d-M-Y")."</div><div class='bookingDate col'>".$datetime->modify("+1 day")->format("d-M-Y")."</div></div>";
	echo "<div class='bookingBtndisplay row'>";
	date_default_timezone_set('ASIA/KOLKATA');
	for($i=0;$i<=2;$i++)
	{
		$datetime=new Datetime($ap_date);
		if($i>0)
		$datetime->modify("+$i day");
		$finaldate=$datetime->format("Y-m-d");
		$parsedSlot=Slot::parseSlot($scheduleDetail);
		$arrangedSlot=Slot::arrangeSlot($parsedSlot,$finaldate);
		$slots=Slot::getSlots($arrangedSlot, $duration, $margin);
//		echo "<td class='p-3 '>";
        echo '<div class="DateWiseBtns col">';
		echo '<input type="hidden" name="ap_date" value="'.$finaldate.'">';
		foreach ($slots as $slot) {
			$status="";
            $btnColor="btn-success";
			if($finaldate===date("Y-m-d"))
			{
				if(time()+300>strtotime(DateTime::createFromFormat( 'g:i A', $slot )->format( 'H:i' )))
				{
					$status='disabled';
                    $btnColor="btn-danger";
				}
			}
			$ap=new Appointment();
			$bookedSlot=$ap->getBookedSlot($doctorId, $finaldate);
			if($bookedSlot!==false)
			{	
					if(in_array($slot,$bookedSlot))
					{
						$status='disabled';
                         $btnColor="btn-danger";
					}
			}		
			echo '<label><input type="radio" class="apRadioBtn" name="ap_time" value="'.$slot.'" '.$status.'>';
			echo '<span class="btn '.$btnColor.' apBtn m-1">';
			echo $slot;
			echo '</span></label>';
		}
		echo "</div>";
	}
	echo "</div>";
	echo "</div>";
	echo '<button class="book btn btn-outline-light mt-3 mb-3">Next</button>';
}else{
	header('Location:bookAppointment.php');
	exit();
}