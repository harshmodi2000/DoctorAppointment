<?php
class Scheduler extends DbAccess
{
	private $scheduleTable;
	private $serviceTable;
	private $pdo;
	private $table;
	public function __construct()
	{
		$this->pdo=$this->connect();
	}

	public function checkAvailableDays($availableDays)
	{
	$result='';
	foreach ($availableDays as $days) {
		$result.='<input class="" type="checkbox" name="selectedDays[]" value="'.$days.'">'.$days."<br>";
	}
	return $result;
	}

	public function modelNameExist($name)
	{
		$sql="SHOW TABLES LIKE :name";
		$stmt=$this->pdo->prepare($sql);
		$stmt->execute(array(':name'=>$name));
		$result=$stmt->fetch();
		if(!empty($result))
		{
			return true;
		}
		else
			return false;
	}

	public function newTable($name)
	{
		try{
		$sql="CREATE TABLE $name(id INT(2) AUTO_INCREMENT PRIMARY KEY , 
		days VARCHAR(128), time1 VARCHAR(20), time2 VARCHAR(20), time3 VARCHAR(20), time4 VARCHAR(20))";
		$stmt=$this->pdo->exec($sql);
		
		}
		catch(PDOException $e)
		{
			error_log($e->getMessage(),0);
			return false;
		}
		return true;
		
	}

	public function addRecord($tablename,$days,$time1,$time2,$time3,$time4){
		try{
		$sql="INSERT INTO $tablename(days,time1,time2,time3,time4) VALUES(:days,:time1,:time2,:time3,:time4)";
		$stmt=$this->pdo->prepare($sql);
		$stmt->execute(array(':days'=>$days,':time1'=>$time1,':time2'=>$time2,':time3'=>$time3,':time4'=>$time4));
	
		}catch(PDOException $e)
		{
			error_log($e->getMessage(),0);
			return false;
		}
			return true;
		

	}

	public function addColumn($colName,$tablename)
	{
		try{
		$sql="ALTER TABLE :name ADD :column varchar(20)";
		$stmt=$this->pdo->prepare($sql);
		$stmt->execute(array(':name'=>$tablename,':column'=>$colName));
		
		}
		catch(PDOException $e)
		{
			error_log($e->getMessage(),0);
			return false;
		}
		return true;
		
	}

	public function addRecordToColumn($name,$colName,$value)
	{
		try{
		$sql="INSERT INTO :name(:column) VALUES(:val)";
		$stmt=$this->pdo->prepare($sql);
		$stmt->execute(array(':name'=>$name,':column'=>$colName,':val'=>$value));
			
		}
		catch(PDOException $e)
		{
			error_log($e->getMessage(),0);
			return false;
		}
		return true;
	
	}

	public function addModelToList($name)
	{
		try{
		$sql="INSERT INTO model_list(name) VALUES(:name)";
		$stmt=$this->pdo->prepare($sql);
		$stmt->execute(array(':name'=>strtolower($name)));
		
		}
		catch(PDOException $e)
		{
			error_log($e->getMessage(),0);
			return false;
		}
		return true;
		
	}
	public function getScheduleNames()
	{
		$sql='SELECT * FROM model_list';
		$stmt=$this->pdo->prepare($sql);
		$stmt->execute();
		$result=$stmt->fetchAll();
		if(empty($result))
		{
			return false;
		}else{
			return $result;
		}
	}

	public function getScheduleDetail($name)
	{
		$sql="SELECT * FROM $name";
		$stmt=$this->pdo->prepare($sql);
		$stmt->execute();
		$result=$stmt->fetchAll();
		if(empty($result))
		{
			return false;
		}else{
			return $result;
		}
	}

	public function deleteScheduleName($name)
	{
		try
		{
		$sql="DELETE FROM model_list WHERE name=:name";
		$stmt=$this->pdo->prepare($sql);
		$stmt->execute(array(':name' =>$name));
	
		}	
			catch(PDOException $e)
		{
			error_log($e->getMessage(),0);
			return false;
		}
			return true;
		
	}

	public function deleteTable($name)
	{
		try
		{
		$sql="DROP TABLE $name";
		$stmt=$this->pdo->prepare($sql);
		$stmt->execute();
		}	
			catch(PDOException $e)
		{
			error_log($e->getMessage(),0);
			return false;
		}
		return true;
	}

	public function deleteModel($name)
	{
		if($this->deleteTable($name)!==false)
		{
				if($this->deleteScheduleName($name)!==false)
				{
					return true;
				}else return false;
		}else return false;
	}
	public function displayScheduleList()
	{
		$scheduleList=$this->getScheduleNames();
		$select="";
		if($scheduleList===false)
		{
			return false;
		}else{
			foreach ($scheduleList as $schedule) {
	          $select.='<option value="'.$schedule['name'].'">'.ucwords($schedule['name'])."</option>";
	      	}
          return $select;
		}
	}
	public function setDoctorSchedule($id,$schedule)
	{
		try{
		$sql="INSERT INTO schedule_map(doctorId,schedule_name) VALUES(:id,:schedule)";
		$stmt=$this->pdo->prepare($sql);
		$stmt->execute(array(':id'=>$id,':schedule'=>$schedule));
		}
		catch(PDOException $e)
		{
			error_log($e->getMessage(),0);
			return false;
		}
		return true;
	}

	public function showScheduleMapping()
	{
		$sql=<<<l
		SELECT doctor.id,name,schedule_name FROM doctor LEFT JOIN schedule_map ON doctor.id = schedule_map.doctorId
		l;
		$stmt=$this->pdo->prepare($sql);
		$stmt->execute();
		$result=$stmt->fetchAll();
		if(empty($result))
		{
			return false;
		}else{
			return $result;
		}
	}

	public function updateSchedule($id,$name)
	{
		try{
		$sql="UPDATE schedule_map SET schedule_name=:name WHERE doctorId=:id";
		$stmt=$this->pdo->prepare($sql);
		$stmt->execute(array(':name'=>$name,':id'=>$id));
		}catch(PDOexception $e)
		{
			error_log($e->getMessage(),0);
			return false;
		}
		return true;
	}

	public function getSchedule($id)
	{
		$sql="SELECT schedule_name FROM schedule_map WHERE doctorId=:id";
		$stmt=$this->pdo->prepare($sql);
		$stmt->execute(array(':id'=>$id));
			$row=$stmt->fetch();
			if(empty($row))
			{
				return false;
			}else return $row['schedule_name'];
	}

	public function setSchedule($id,$name)
	{
		$r=$this->getSchedule($id);
				if($r===false)
				{
					if($this->setDoctorSchedule($id,$name)!==false)
					return 1;
					else {
						return false;
						}

				}elseif($r!==$name){
					if($this->updateSchedule($id,$name)!==false)
					return 2;
					else {
						return false;
					}
				}
	}
	public function delete_map($id)
	{
		try
		{
			$sql="DELETE FROM schedule_map WHERE doctorId=:id";
			$stmt=$this->pdo->prepare($sql);
			$stmt->execute(array(':id' =>$id ));
		}catch(PDOException $e)
		{
			error_log($e->getMessage(),0);
			return false;
		}
		return true;

	}
}