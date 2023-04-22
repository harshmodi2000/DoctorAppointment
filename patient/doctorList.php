<?php 
//session_start();
//if(!isset($_SESSION['patientId'])||empty($_SESSION['patientId']))
//{
//	die("ACCESS DENIED!");
//}
include_once "../includes/autoloader.include.php";

if(isset($_POST['filter_category'])&&isset($_POST['filter_name'])&&isset($_POST['filter_value']))
{
	$category=$_POST['filter_category'];
	$filter_name=$_POST['filter_name'];
	$filter_value=$_POST['filter_value'];

$role=new Role();
$doctorAll=new Doctor();
$doctorList=$doctorAll->getIds();
	if($doctorList===false)
	{
		echo "NO DOCTOR FOUND";
		exit();
	}
$count=0;
$doctors=array();	
	foreach ($doctorList as $doc) {
		$doctor=new Doctor();
		$d = $doctor->setUserById($doc['id']);
		$drole=$role->getMatchingRole($doc['id']);
		$doctors[$count]['id'] = $doc['id'];
		$doctors[$count]['name'] = $doctor->getName();
		$doctors[$count]['gender'] = $doctor->getGender();
		$doctors[$count]['roleId'] = $drole['roleId'];
		$doctors[$count]['rolename'] = ucwords($role->getUserRole($doc['id']));
		$doctors[$count]['profileLink'] = $doctor->getProfileImageLink();
		$count++;
	}
$records=0;
	foreach ($doctors as $docs) {

		if($category!=='*')
		{
			if($docs['roleId']!==$category)
			{
				continue;
			}
		}

		if($filter_name!=="undefined")
		{
			if($filter_name==="name")
			{
				if(!strlen($filter_value)<1)
				{
				if($filter_value!=="undefined")
				{
					if(stripos($docs['name'],$filter_value)===false)
					{
						continue;
					}
				}
				}
			}
			elseif ($filter_name==="gender") {
				if(strtolower($docs['gender'])!==strtolower($filter_value))
				{
					continue;
				}

			}
			elseif($filter_name==="available")
			{
									date_default_timezone_set('ASIA/KOLKATA');
									$doctorId=$docs['id'];
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
											continue;
										}
										$scheduleDetail=$scheduler->getScheduleDetail($scheduleName);
										if($scheduleDetail===false)
										{
											continue;
											
										}
										$count=0;
										$today=date("Y-m-d");
										$parsedSlot=Slot::parseSlot($scheduleDetail);
										$arrangedSlot=Slot::arrangeSlot($parsedSlot,$today);
										$slots=Slot::getSlots($arrangedSlot, $duration, $margin);
										foreach ($slots as $slot) {
											if(time()+300>strtotime(DateTime::createFromFormat( 'g:i A', $slot )->format( 'H:i' )))
											{
												continue;
											}
											$ap=new Appointment();
											$bookedSlot=$ap->getBookedSlot($doctorId, $today);
											if($bookedSlot!==false)
											{	
												if(in_array($slot,$bookedSlot))
												{
													continue;
												}
											}
											$count++;
										}
										if($count<1)
										{
											continue;
										}
				}
			}

		echo '<div class="dcontainer mb-3 pl-5">';
		echo '<input type="hidden" name="dId" class="doctorId" value="'.$docs['id'].'">';
		echo '<div class="docinfo row">';
		echo '<div class=" col-2"><img class="profile" src="'.$docs['profileLink'].'"></div>';
        
		echo '<div class="col-3"><div><label>Category : </label>'.$docs['rolename']."</div>";
		echo '<div><label>Name : </label>'.ucwords($docs['name'])."</div>";
		echo '<div><label>Gender: </label>'.$docs['gender']."</div>";
		echo '</div>';
		echo '</div></div>';
		$records++;
	}
	if($records===0)
	{
		echo "NO CORRESPONDING DOCTOR FOUND";
	}

}
else{
	header('Location:bookAppointment.php');
	exit();
}
