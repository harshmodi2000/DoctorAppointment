<?php 
class Appointment extends  DbAccess
{
	private $pdo;
	private $ap_id;
	private $d_id;
	private $p_id;
	private $ap_date;
	private $ap_time;
	private $table;
	public function __construct(){
		$this->table="appointment";
		$this->pdo=$this->connect();
	}
	public function saveAppointment($patient_id,$doctor_id,$ap_date,$ap_time)
	{
		$time=DateTime::createFromFormat( 'g:i A', $ap_time )->format( 'H:i' );
		try{
		$sql="INSERT INTO $this->table(patientId,doctorId,appointmentDate,appointmentTime) VALUES(:pid,:did,:apdate,:aptime)";
		$stmt=$this->pdo->prepare($sql);
		$stmt->execute(array(
			':pid'=>$patient_id,
			':did'=>$doctor_id,
			':apdate'=>$ap_date,
			':aptime'=>$time));
		return $this->pdo->lastInsertId();
		}
		catch(PDOException $e)
		{
			error_log($e->getMessage(),0);
			return false;
		}
			return true;
	}
	public function deleteAppointment($ap_id)
	{
		try
		{
		$sql="DELETE FROM $this->table WHERE id=:id";
		$stmt=$this->pdo->prepare($sql);
		$stmt->execute(array(':id' =>$ap_id));
		return true;
		}	
			catch(PDOException $e)
		{
			error_log($e->getMessage(),0);
			return false;
		}
	}
	public function getBookedSlot($d_id,$checkingDate)
	{

		$sql="SELECT appointmentTime FROM $this->table WHERE doctorId=:id AND appointmentDate=:d ";
		$stmt=$this->pdo->prepare($sql);
		$stmt->execute(array(':id' =>$d_id ,':d'=>$checkingDate));
		$result=$stmt->fetchAll();
		if(empty($result))
		{
			return false;
		}else{
			$count=0;
			$final=array();
			foreach ($result as $t) {
				$time=DateTime::createFromFormat('H:i:s', $t['appointmentTime'])->format( 'g:i A' );
				array_push($final,$time);
			}
			return $final;
		}
	}

	public function setAppointmentById($apId)
	{
		$sql="SELECT * FROM $this->table WHERE id=:id";
		$stmt=$this->pdo->prepare($sql);
		$stmt->execute(array(':id' =>$apId));
		$result=$stmt->fetch();
		if(empty($result))
		{
			return false;
		}else{
			$this->ap_id=$result['id'];
			$this->d_id=$result['doctorId'];
			$this->p_id=$result['patientId'];
			$this->ap_date=$result['appointmentDate'];
			$this->ap_time=$result['appointmentTime'];
			return $result;
			}
	}

	public function getApId()
	{
		return $this->ap_id;
	}
	public function getDId()
	{
		return $this->d_id;;
	}
	public function getPId()
	{
		return $this->p_id;
	}
	public function getApDate()
	{
		return $this->ap_date;
	}
	public function getApTime()
	{
		return $this->ap_time;
	} 

	public function getDoctorAppointment($did)
	{
		$sql="SELECT * FROM $this->table WHERE doctorId=:did";
		$stmt=$this->pdo->prepare($sql);
		$stmt->execute(array(':did' =>$did));
		$result=$stmt->fetchAll();
		if(empty($result))
		{
			return false;
		}else{
			return $result;
		}
	}
	
}