<?php 
include_once "../includes/autoloader.include.php";
$partitioner=new TimePartition();
if(isset($_POST['default_duration'])&&isset($_POST['default_margin']))
{
	$duration=$_POST['default_duration'];
	$margin=$_POST['default_margin'];
	if(strlen($duration)<1&&!is_numeric($duration))
	{
		echo '<p style="color:red">Enter a numeric default duration</p>';
	}else{
				if(!strlen($margin)<1)
				{
					if(!is_numeric($margin))
					{
						echo '<p style="color:red">Margin must be numeric</p>';
						exit();
					}

				}else $margin=0;
				if($partitioner->insertDefaultPartition($duration,$margin)!==false){
					echo '<script>alert("Default set Successfully");location.reload();</script>';
				}else{
					echo '<p style="color:red">Could not set default</p>';
				}

		}
}

if(isset($_POST['action'])&&$_POST['action']==="truncate")
{
	if($partitioner->removeDefault()!==false)
	{
		echo '<script>alert("Default set to Max successfully");location.reload();</script>';
	}else{
		echo '<p style="color:red">Could not set default</p>';
	}
}
if(isset($_POST['roleId'])&&
	$_POST['action']==="delete")
{	
	$id=$_POST['roleId'];
	$existingPartition=$partitioner->checkPartition($id);
	if($existingPartition!==false)
	{
		if($partitioner->deletePartition($id)!==false)
		{
			echo '<script>alert("Patition deleted successfully");location.reload();</script>';
		}else{
		echo '<p style="color:red">Could not delete partition</p>';
		}
	}
}
if(isset($_POST['duration'])&&isset($_POST['roleId']))
{
	$duration=$_POST['duration'];
	$margin=$_POST['margin'];
	$id=$_POST['roleId'];
	if(!is_numeric($id))
	{
		echo '<p style="color:red">ID is not numeric</p>';
		exit();
	}

	if(strlen($duration)<1&&!is_numeric($duration))
	{
		echo '<p style="color:red">Enter a numeric default duration</p>';
	}else{
				if(!strlen($margin)<1)
				{
					if(!is_numeric($margin))
					{
						echo '<p style="color:red">Margin must be numeric</p>';
						exit();
					}

				}else $margin=0;
			$success="";
			$existingPartition=$partitioner->checkPartition($id);
			if($existingPartition!==false)
			{
				if($existingPartition['preferred']!==$duration)
				{
					if($partitioner->updateRecord($id,"preferred",$duration)!==false)
					{
						$success.="--Duration updated successfully--";
					}else{
						echo '<p style="color:red">Could not update duration</p>';
					}
				}
				if($margin!==0)
				{
					if($existingPartition['margin']!==$margin)
					{
						if($partitioner->updateRecord($id,"margin",$margin)!==false)
						{
							$success.="--Margin updated successfully--";
						}else{
							echo '<p style="color:red">Could not update margin</p>';
						}
					}
				}
			}else{
				if($partitioner->insertPartition($id,$duration,$margin)!==false)
				{
					$success.="Partition saved successfully";
				}else{
					echo '<p style="color:red">Could not save partition</p>';
				}
			}
			if(strlen($success)>1)
			echo '<script>alert("'.$success.'");location.reload();</script>';
		}
}

 ?>

