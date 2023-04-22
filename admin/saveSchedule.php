<?php 
session_start();
if (!isset($_SESSION['adminId'])||empty($_SESSION['adminId'])) {
	die('Access Denied');
}
include_once "../includes/autoloader.include.php";
$scheduler=new Scheduler();
if(isset($_POST['userId'])&&isset($_POST['schedulename'])&&!empty($_POST['userId'])&&!empty($_POST['schedulename'])&&is_numeric($_POST['userId'])&&!strlen($_POST['schedulename'])<1)
{
	$id=$_POST['userId'];
	$schedule_name=strtolower($_POST['schedulename']);
	$result=$scheduler->setSchedule($id,$schedule_name);
	if($result==1){
		echo '<script>alert("Schedule assigned successfully")</script>';
		echo '<script>location.reload()</script>';
	}elseif($result==2){
		echo '<script>alert("Schedule updated successfully")</script>';
		echo '<script>location.reload()</script>';
	}elseif($result===false){
		echo '<p style="color:red">Could not update schedule<p>';
	}
}

if(isset($_POST['userId'])&&isset($_POST['action'])&&$_POST['action']==='s_delete')
{
	if($scheduler->delete_map($_POST['userId'])!==false)
	{
		echo '<script>alert("Schedule deleted successfully")</script>';
		echo '<script>location.reload()</script>';
	}else{
		echo '<p style="color:red">Could not delete schedule<p>';
	}
}
 ?>

