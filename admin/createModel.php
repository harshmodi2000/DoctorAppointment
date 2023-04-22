<?php
session_start();
if (!isset($_SESSION['adminId'])||empty($_SESSION['adminId'])) {
	die('Access Denied');
}

include_once "../includes/autoloader.include.php";
$scheduler=new Scheduler();
if(isset($_POST['name']))
{
	$tablenameError=false;
	$name=strtolower($_POST['name']);
	if(Validator::emptyfields($name))
	{
		$tablenameError=true;
		echo '<span style="color:red">Schedule name cannot be empty!</span>';
	}
	elseif(Validator::invalidUsername($name)){
		$tablenameError=true;
		echo '<span style="color:red">Name should not start with a digit and should be composed of digits and letters only(without space)</span>';
	}elseif($scheduler->modelNameExist(strtolower($name)))
	{
		$tablenameError=true;
		echo '<span style="color:red">The name already exist</span>';
	}

}		

if(isset($_POST['submit'])&&!empty($_POST))
{
	if($tablenameError===true)
	{
		$_SESSION['error']='<script>alert("invalid tablename or tablename already exist!")</script>';
		header('Location:scheduleModel.php');
		exit();
	}else{
			$tablename=strtolower($_POST['name']);
			if($scheduler->newTable($tablename)!==false&&$scheduler->addModelToList($tablename)!==false)
			{
				$rowCounter=0;
				$rows=0;
				foreach ($_POST as $key) {
				if(is_array($key))
				{
					$rows++;
					continue;
				}
				$rows++;
				}

				for ($i=1; $i <= ($rows-3)/4 ; $i++) {

					if(isset($_POST['d'.$i]))
					{
					$temp=implode('-',$_POST['d'.$i]);
					$days=strlen(trim($temp))>1?$temp:'';
					}else continue;

					$temp=implode('-',$_POST['t1'.$i]);
					$time1=strlen(str_replace('-','',trim($temp)))>1?$temp:'';
					$temp=implode('-',$_POST['t2'.$i]);
					$time2=strlen(str_replace('-','',trim($temp)))>1?$temp:'';
					$temp=implode('-',$_POST['t3'.$i]);
					$time3=strlen(str_replace('-','',trim($temp)))>1?$temp:'';
					$temp=implode('-',$_POST['t4'.$i]);
					$time4=strlen(str_replace('-','',trim($temp)))>1?$temp:'';
					if(strlen($days)<1||strlen($time1)<1&&strlen($time2)<1&&strlen($time3)<1&&strlen($time4)<1)
					{
						continue;
					}
					else{
						if($scheduler->addRecord($tablename,$days,$time1,$time2,$time3,$time4))
						{
							$rowCounter++;
						}else{
							$_SESSION['error']= '<script>alert("row'.$i.' could not be added'.'"'.')</script>';
							header('Location:scheduleModel.php');
							exit();				
						}
					}

				}
				if($rowCounter<1){
				$scheduler->deleteModel($tablename);
				$_SESSION['error']= '<script>alert("Model cannot be empty, enter at least one day and one timeslot")</script>';
				header('Location:scheduleModel.php');
				exit();

				}else{
				$_SESSION['success']='<p style="color:#ffa500">Model Created successfully<p>';
				header('Location:scheduleModel.php');
				exit();
				}
			}else{
				$scheduler->deleteModel($tablename);
				$_SESSION['error']='<script>alert("Could not create Model!")</script>';
				header('Location:scheduleModel.php');
				exit();
			}
		}
	}		
 ?>

<script>
$('#scheduleName').removeClass("input-error");
	var error="<?php echo $tablenameError?>";
	if(error==true)
	{
		$('#scheduleName').addClass("input-error");
	}
</script>