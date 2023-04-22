<?php  
include_once "../includes/autoloader.include.php";
session_start();
if (!isset($_SESSION['userId'])||empty($_SESSION['userId'])) {
	die('Access Denied');
}
if(isset($_POST['name'])&&isset($_POST['action'])&&$_POST['action']=='details')
{
	$name=strtolower($_POST['name']);
	$scheduler=new Scheduler();
					echo "<table>";
					echo "<th>Days</th><th>T1</th><th>T2</th><th>T3</th><th>T4</th>";
				$model=$scheduler->getScheduleDetail($name);
				if($model!==false)
				{
					foreach ($model as $value) {
						echo "<tr>";
						echo "<td>".$value['days']."</td>";
						for($i=1;$i<=4;$i++)
						{
								if(isset($value['time'.$i])&&!empty($value['time'.$i]))
								{
									$temp=explode('-',$value['time'.$i]);
									$temp[0]=DateTime::createFromFormat( 'H:i', $temp[0] )->format( 'g:i a' );
									$temp[1]=DateTime::createFromFormat( 'H:i', $temp[1] )->format( 'g:i a' );
									$time=implode(' - ',$temp);
									echo "<td>".$time."</td>";
								}else echo "<td></td>";
								
						}
						echo "</tr>";
					}
					
				}else{
					echo '<h3 style="color:red">No Detail Found</h3>';
				}
				echo "</table>";
}else{
	die('Access Denied');
}
?>