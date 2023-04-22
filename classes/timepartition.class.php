<?php
class TimePartition extends DbAccess{

	private $pdo;
	public function __construct()
	{
		$this->pdo=$this->connect();
	}
	public function getMax($id)
	{
		$sql="SELECT service FROM role WHERE id=:id";
		$stmt=$this->pdo->prepare($sql);
		$stmt->execute(array(':id'=>$id));
		$role=$stmt->fetch();
		if(empty($role))
		{
			return false;
		}else{
			$temp=explode(',',$role['service']);
			$max=array();

			foreach ($temp as $t => $value) {
					$d = $this->correspondingServiceDuration($value);
					if($d!==false)
					{
						array_push($max,$d);
					}else continue;
			}
			return max($max);
		}
	}
	/*public function defaultDuration()
	{
		$result=array();
		$sql="SELECT * FROM role";
		$stmt=$this->pdo->prepare($sql);
		$stmt->execute();
		$roles=$stmt->fetchAll();
		if(empty($roles))
		{
			return -1;
		}else{
			foreach ($roles as $role) {
				$temp=explode(',',$role['service']);
				$max=array();
				foreach ($temp as $t => $value) {
					$d = $this->correspondingServiceDuration($value);
					if($d!==false)
					{
						array_push($max,$d);
					}else continue;
				}
				$result[$role['id']]=$max;
			}
			return $result;
		}
	}*/
	public function correspondingServiceDuration($id){
		$sql="SELECT duration FROM service WHERE id=:id";
		$stmt=$this->pdo->prepare($sql);
		$stmt->execute(array(':id'=>$id));
		$duration=$stmt->fetch();
		if(empty($duration))
		{
			return false;
		}else{
				return $duration['duration'];
			}
		}

	/*public function updateDefaultDuration()
	{
		$durations=$this->defaultDuration();
		if(empty($durations))
		{
			return false;
		}else{
			foreach ($durations as $d => $val) {
				if($this->updateRecord($roleId,"defaultDuration",$val)!==false)
				{
					continue;
				}else{
					return false;
				}
			}
		}
	}*/

	public function updateRecord($roleId,$col,$val)
	{
		try{
			$sql="UPDATE time_partition SET $col=:val WHERE roleId=:id";
			$stmt=$this->pdo->prepare($sql);
			$stmt->execute(array(':val'=>$val,':id'=>$roleId));
		}catch(PDOException $e)
		{
			error_log($e->getMessage(),0);
			return false;
		}
		return true;
	}

	public function getrecord()
	{
		$sql=<<<l
		SELECT role.id,role.name,time_partition.preferred,time_partition.margin FROM role LEFT JOIN time_partition ON role.id = time_partition.roleId ORDER BY role.name ASC
		l;
		$stmt=$this->pdo->prepare($sql);
		$stmt->execute();
		$rows=$stmt->fetchAll();
		if(empty($rows))
		{
			return false;
		}else{
			$result=array();
			$i=0;
				foreach ($rows as $row) {
					$result[$i]['id']=$row['id'];
					$result[$i]['name']=$row['name'];
					if(isset($row['preferred'])&&$row['preferred']!==null)
					{
						$result[$i]['duration']=$row['preferred'];
						$result[$i]['margin']=$row['margin'];
					}else{
						$temp=$this->getDefault($row['id']);
						$result[$i]['duration']=$temp['duration'];
						$result[$i]['margin']=$temp['margin'];
					}
					$i++;
				}
				return $result;
			}
	}
	public function singleRecord($id)
	{
		$sql=<<<l
		SELECT role.id,role.name,time_partition.preferred,time_partition.margin FROM role LEFT JOIN time_partition ON role.id = time_partition.roleId WHERE role.id=:id ORDER BY role.name ASC
		l;
		$stmt=$this->pdo->prepare($sql);
		$stmt->execute(array(':id' => $id));
		$rows=$stmt->fetch();
		if(empty($rows))
		{
			return false;
		}else{
			$result=array();
					$result['id']=$rows['id'];
					$result['name']=$rows['name'];
					if(isset($row['preferred'])&&$rows['preferred']!==null)
					{
						$result['duration']=$rows['preferred'];
						$result['margin']=$rows['margin'];
					}else{
						$temp=$this->getDefault($rows['id']);
						$result['duration']=$temp['duration'];
						$result['margin']=$temp['margin'];
					}
				return $result;
			}
	}
	public function insertPartition($id,$duration,$margin)
	{
		try{
		$sql="INSERT INTO time_partition(roleId,preferred,margin) values(:id,:duration,:margin)";
		$stmt=$this->pdo->prepare($sql);
		$stmt->execute(array(':id'=>$id,':duration'=>$duration,':margin'=>$margin));
		}catch(PDOException $e)
		{
			error_log("Error inserting partition".$e->getMessage(),0);
			return false;
		}
		return true;
	}

	public function insertDefaultPartition($duration,$margin)
	{
		try{
		$sql="INSERT INTO partition_default(duration,margin) values(:duration,:margin)";
		$stmt=$this->pdo->prepare($sql);
		$stmt->execute(array(':duration'=>$duration,':margin'=>$margin));
		}catch(PDOException $e)
		{
			error_log("Error inserting partition".$e->getMessage(),0);
			return false;
		}
		return true;
	}
	public function setDefault($roleId,$col,$val)
	{
		try{
			$sql="UPDATE partition_default SET :col=:val WHERE roleId=:id";
			$stmt=$this->pdo->prepare($sql);
			$stmt->execute(array(':col'=>$col,':val'=>$val,':id'=>$roleId));
		}catch(PDOException $e)
		{
			error_log($e->getMessage(),0);
			return false;
		}
		return true;
	}
	public function removeDefault()
	{
		try{
			$sql="TRUNCATE TABLE partition_default";
			$stmt=$this->pdo->prepare($sql);
			$stmt->execute();
		}catch(PDOException $e)
		{
			error_log("error truncating the default partition".$e->getMessage(),0);
			return false;
		}
		return true;
	}

	public function getDefault($id)
	{
		$sql="SELECT * FROM partition_default";
		$stmt=$this->pdo->prepare($sql);
		$stmt->execute();
		$row=$stmt->fetch();
		$result=array();
		if(empty($row))
		{
			$result['duration']=$this->getMax($id);
			$result['margin']=null;
		}else{
			$result['duration']=$row['duration'];
			$result['margin']=$row['margin'];
		}
		return $result;
	}
		public function checkDefaultTable()
	{
		$sql="SELECT * FROM partition_default";
		$stmt=$this->pdo->prepare($sql);
		$stmt->execute();
		$row=$stmt->fetch();
		if(empty($row))
		{
			return false;
		}else{
			return $row;
		}
		
	}

	public function changePreferredToDefault($id)
	{
		try{
		$sql="INSERT INTO time_partition(roleId,duration,margin) values(:id,:duration)";
		$stmt=$this->pdo->prepare($sql);
		$max=$this->getMax($id);
		$duration=$max;
		$stmt->execute(array(':id'=>$id,':duration'=>$duration));
		}catch(PDOException $e)
		{
			error_log("Error inserting partition".$e->getMessage(),0);
			return false;
		}
		return true;
	}
	public function checkPartition($id)
	{
		$sql="SELECT * FROM time_partition WHERE roleId=:id";
		$stmt=$this->pdo->prepare($sql);
		$stmt->execute(array(':id' =>$id ));
		$row=$stmt->fetch();
		if(empty($row))
		{
			return false;
		}else{
			return $row;
		}
	}

	public function deletePartition($id)
	{
		try{
			$sql="DELETE FROM time_partition WHERE roleId=:id";
			$stmt=$this->pdo->prepare($sql);
			$stmt->execute(array(':id'=>$id));
		}catch(PDOException $e)
		{
			error_log($e->getMessage(),0);
			return false;
		}
		return true;
	}

}