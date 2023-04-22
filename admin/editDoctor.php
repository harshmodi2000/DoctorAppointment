<?php
session_start();
if (!isset($_SESSION['adminId'])||empty($_SESSION['adminId'])) {
	die('Access Denied');
}
include_once "../includes/autoloader.include.php";
if(isset($_GET['id']))
{
	if(!is_numeric($_GET['id']))
	{
		header('Location:doctorManager.php');
		exit();
	}
	$id=$_GET['id'];
	$doctor=new Doctor();
	$role=new Role();
	$scheduler=new Scheduler();
	if($doctor->setUserById($id)!==false)
	{
		$name=$doctor->getName();
		$phone=$doctor->getPhone();
		$username=$doctor->getUsername();
		$gender=$doctor->getGender();
		$email=$doctor->getEmail();
		$profileImage=$doctor->getProfileImageLink();
		$urole=$role->getMatchingRole($id);
		$schedule=$scheduler->getSchedule($id);

	}else{
		$_SESSION['error']='<script>alert("user not found")</script>';
		header('Location:doctorManager.php');
		exit();
	}
	$roleList=$role->getAll();
	$selectListRole="";
	if($roleList!==false)
	{
		if($urole!==false)
		{
			foreach ($roleList as $roles) {
					if($roles['id']===$urole['roleId'])
						{
							$selectListRole.='<option value="'.$roles['id'].'" selected="true">'.ucwords($roles['name'])."</option>";
						}else{
							$selectListRole.='<option value="'.$roles['id'].'">'.ucwords($roles['name'])."</option>";
						}}
		}else{
			$selectListRole.='<option selected="true" value="NULL">--unassigned--</option>';
			foreach ($roleList as $roles) {
				$selectListRole.='<option value="'.$roles['id'].'">'.ucwords($roles['name'])."</option>";
			}
		}
	}else{
		$selectListRole="No record for role found!";
	}
	$scheduleList=$scheduler->getScheduleNames();
	$selectListSchedule="";
	if($scheduleList!==false){
		if($schedule!==false)
			{
				foreach ($scheduleList as $schedules) {
							if(strtolower($schedules['name'])!==strtolower($schedule))
							{
								$selectListSchedule.='<option value="'.$schedules['name'].'">'.ucwords($schedules['name'])."</option>";
							}else{
								$selectListSchedule.='<option value="'.$schedules['name'].'" selected="true">'.ucwords($schedules['name'])."</option>";
							}
				}
			}else{
				$selectListSchedule.='<option selected="true" value="NULL">--undefined--</option>';
				foreach ($scheduleList as $schedules) {
								$selectListSchedule.='<option value="'.$schedules['name'].'">'.ucwords($schedules['name'])."</option>";
				}
			}
	}else{
		$selectListSchedule="No record found for schedule";
	}
	$m="";
	$f="";
	if(strtolower($gender)==="m")
	{
		$m="checked";
	}elseif(strtolower($gender)==="f")
	{
		$f="checked";
	}
	$genderRadio='&nbsp <input type="radio" name="gender" value="M" '.$m.'>M &nbsp';
	$genderRadio.='<input type="radio" name="gender" value="F" '.$f.'>F';



}else{
	header('Location:doctorManager.php');
	exit();
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Edit Doctor Info</title>
  <?php include "header.php"?>
  <style type="text/css">
    .image-pro{
      height: 10rem;
      width: 10rem;
      
        margin-bottom: 2rem;
    }
  </style>
</head>
<body>
    <? include "nav.html"; ?>
	<?php
	if(isset($_SESSION['error']))
	{
		echo $_SESSION['error'];
		unset($_SESSION['error']);
	}
	if(isset($_SESSION['success']))
	{
		echo $_SESSION['success'];
		unset($_SESSION['success']);
	}
	?>
<div class="container pt-5 pb-5">
   <form action="updateDoctor.php" method="POST" enctype="multipart/form-data">
  <div><img class="image-pro" src="<?php echo $profileImage; ?>"></div>
<!--  <table>-->
       <div class="floating-form pt-3">
  	<input type="hidden" name="id" value="<?php echo $id;?>">
   <div class="floating-label">
<input type="text" name="name" class="floating-input" value="<?php echo $name; ?>">      <label>Name</label></div>
    
    <div class="floating-label mt-3 mb-3">
      <select class="floating-select" name="role"><?php echo $selectListRole; ?></select><label>Role</label>
    </div>
    <div class="floating-label">
      Gender :<?php echo $genderRadio; ?>
        </div>
    <div class="floating-label  mt-3 mb-3">
 <input type="email" class="floating-input" placeholder=" " name="email" value="<?php echo $email; ?>" >     <label>Email</label>
        </div>
    <div class="floating-label">
      <td><input placeholder=" " type="text" class="floating-input" name="username" value="<?php echo $username; ?>"><label>Username</label>

           </div>
    <div class="floating-label mt-3 mb-3">
<input placeholder=" " class="floating-input" type="text" name="phone" value="<?php echo $phone; ?>"><label>Phone Number</label>
        </div>
    <div class="floating-label">
     
          <select class="floating-select" id="" name="schedule">
          	<?php echo $selectListSchedule; ?>
              
          </select>
              <label>Schedule</label>
          </div>
    <div class="mt-3 mb-3">
        Update Profile image:
<input type="file" class="btn btn-secondary" name="image">

           </div>
    <div><input type="submit" class="btn btn-info" name="submit" value="Update profile"></div>
<!--  </table>--></div>
</form>  
</div>
</body>
</html>
