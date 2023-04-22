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

	public function divideSlot( $time, $plusMinutes ) {

    $time = DateTime::createFromFormat( 'g:i A', $time );
    $time->add( new DateInterval( 'PT' . ( (integer) $plusMinutes ) . 'M' ) );
    $newTime = $time->format( 'g:ia' );
    return $newTime;
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
		return true;
		}
		catch(PDOException $e)
		{
			error_log($e->getMessage(),0);
			return false;
		}
		
	}

	public function addRecord($tablename,$days,$time1,$time2,$time3,$time4){
		try{
		$sql="INSERT INTO $tablename(days,time1,time2,time3,time4) VALUES(:days,:time1,:time2,:time3,:time4)";
		$stmt=$this->pdo->prepare($sql);
		$stmt->execute(array(':days'=>$days,':time1'=>$time1,':time2'=>$time2,':time3'=>$time3,':time4'=>$time4));
		return true;
		}catch(PDOException $e)
		{
			error_log($e->getMessage(),0);
			return false;
		}
		

	}

	public function addColumn($colName,$tablename)
	{
		try{
		$sql="ALTER TABLE :name ADD :column varchar(20)";
		$stmt=$this->pdo->prepare($sql);
		$stmt->execute(array(':name'=>$tablename,':column'=>$colName));
		return true;
		}
		catch(PDOException $e)
		{
			error_log($e->getMessage(),0);
			return false;
		}
		
	}

	public function addRecordToColumn($name,$colName,$value)
	{
		try{
		$sql="INSERT INTO :name(:column) VALUES(:val)";
		$stmt=$this->pdo->prepare($sql);
		$stmt->execute(array(':name'=>$name,':column'=>$colName,':val'=>$value));
			return true;
		}
		catch(PDOException $e)
		{
			error_log($e->getMessage(),0);
			return false;
		}
	
	}

	public function addModelToList($name)
	{
		try{
		$sql="INSERT INTO model_list(name) VALUES(:name)";
		$stmt=$this->pdo->prepare($sql);
		$stmt->execute(array(':name'=>strtolower($name)));
		return true;
		}
		catch(PDOException $e)
		{
			error_log($e->getMessage(),0);
			return false;
		}
		
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
		return true;
		}	
			catch(PDOException $e)
		{
			error_log($e->getMessage(),0);
			return false;
		}
		
	}

	public function deleteTable($name)
	{
		try
		{
		$sql="DROP TABLE $name";
		$stmt=$this->pdo->prepare($sql);
		$stmt->execute();
		return true;
		}	
			catch(PDOException $e)
		{
			error_log($e->getMessage(),0);
			return false;
		}
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
		if(empty($scheduleList))
		{
			return false;
		}else{
			foreach ($scheduleList as $schedule) {
	          $select.='<option value="'.ucwords($schedule['name']).'">'.ucwords($schedule['name'])."</option>";
	      	}
          return $select;
		}
	}


}