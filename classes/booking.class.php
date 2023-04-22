<?php
class Booking extends DbAccess{
	private $booking_id;
	private $appointment_id;
	private $booking_date;
	private $booking_status;
	private $table;
	private $pdo;

	public function __construct(){
		$this->table="bookings";
		$this->pdo=$this->connect();
	}

	public function saveBooking($ap_id)
	{
		try{
		$sql="INSERT INTO $this->table(appointmentId) VALUES(:ap_id)";
		$stmt=$this->pdo->prepare($sql);
		$stmt->execute(array(':ap_id'=>$ap_id));
		return true;
		}
		catch(PDOException $e)
		{
			error_log($e->getMessage(),0);
			return false;
		}
			return true;
	} 

	public function updateBookingStatus($b_id,$status)
	{
		try{
		$sql="UPDATE $this->table SET status=:status WHERE id=:id";
		$stmt=$this->pdo->prepare($sql);
		$stmt->execute(array(':status'=>$status,':id'=>$b_id));
		return true;
		}
		catch(PDOexception $e)
		{
			error_log($e->getMessage(),0);
			return false;
		}
		
	}

	public function confirmBooking($b_id)
	{
		if($this->updateBookingStatus($b_id,'confirmed')===true)
		{
			return true;
		}else{
			return false;
		}
	}

		public function getAll()
	{
		$sql="SELECT * FROM $this->table";
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
	public function deleteBooking($id)
	{
		try
		{
		$sql="DELETE FROM $this->table WHERE id=:id";
		$stmt=$this->pdo->prepare($sql);
		$stmt->execute(array(':id' =>$id));
		return true;
		}	
			catch(PDOException $e)
		{
			error_log($e->getMessage(),0);
			return false;
		}
	}

	public function setBookingById($bid)
	{
		$sql="SELECT * FROM $this->table WHERE id=:id";
		$stmt=$this->pdo->prepare($sql);
		$stmt->execute(array(':id' =>$bid));
		$result=$stmt->fetch();
		if(empty($result))
		{
			return false;
		}else{
			$this->booking_id=$result['id'];
	 		$this->appointment_id=$result['appointmentId'];
	 		$this->booking_date=$result['bookingDate'];
	 		$this->booking_status=$result['status'];
	 		return $result;
		}
	}
	public function getAppointmentId()
	{
		return $this->appointment_id;
	}
		public function getbookingDate()
	{
		return $this->booking_date;
	}
		public function getbookingStatus()
	{
		return $this->booking_status;
	}

	public function patientAppointmentList($pid)
	{
		$sql=<<<l
		SELECT bookings.id, bookings.bookingDate ,bookings.status, appointment.patientId, appointment.doctorId, appointment.appointmentDate, appointment.appointmentTime FROM bookings INNER JOIN appointment ON bookings.appointmentId = appointment.id WHERE appointment.patientId=:id ORDER BY bookings.bookingDate ASC
		l;
		$stmt=$this->pdo->prepare($sql);
		$stmt->execute(array(':id' => $pid));
		$rows=$stmt->fetchAll();
		if(empty($rows))
		{
			return false;
		}else{
			return $rows;
		}
	}

	public function doctorAppointmentList($did)
	{
		$sql=<<<l
		SELECT bookings.id, bookings.bookingDate ,bookings.appointmentId, bookings.status, appointment.patientId, appointment.doctorId, appointment.appointmentDate, appointment.appointmentTime FROM bookings INNER JOIN appointment ON bookings.appointmentId = appointment.id WHERE appointment.doctorId=:id ORDER BY appointment.appointmentTime ASC
		l;
		$stmt=$this->pdo->prepare($sql);
		$stmt->execute(array(':id' => $did));
		$rows=$stmt->fetchAll();
		if(empty($rows))
		{
			return false;
		}else{
			return $rows;
		}
	}

	public function updateExpiredBookings()
	{
		$sql=<<<l
		SELECT bookings.id, bookings.bookingDate ,bookings.appointmentId, bookings.status, appointment.patientId, appointment.doctorId, appointment.appointmentDate, appointment.appointmentTime FROM bookings INNER JOIN appointment ON bookings.appointmentId = appointment.id
		l;
		$stmt=$this->pdo->prepare($sql);
		$stmt->execute();
		$rows=$stmt->fetchAll();
		if(empty($rows))
		{
			return false;
		}else{
			date_default_timezone_set('ASIA/KOLKATA');
			foreach ($rows as $row) {

			if($row['status']==='requested'||$row['status']==='confirmed')
			{	
				if($row['appointmentDate']<date('Y-m-d'))
				{
					$this->updateBookingStatus($row['id'],'expired');
				}
			}

			}
		}
	}

	


}