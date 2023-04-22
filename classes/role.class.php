<?php
class Role extends DbAccess
{
	private $table,$pdo,$service,$name;

	
	public function __construct()
	{
		$this->pdo=$this->connect();
		$this->table="role";
	}

	public function add($name,$service)
	{
		$sql="INSERT INTO $this->table(name,service) VALUES(:name,:service)";
		$stmt=$this->pdo->prepare($sql);
		if($stmt->execute(array(':name' =>$name ,':service'=>$service)))
		{
			return true;
		}else
		{
			return false;
		}
	}

	public function delete($id)
	{
		$sql="DELETE  FROM $this->table WHERE id=:id";
		$stmt=$this->pdo->prepare($sql);
		if($stmt->execute(array(':id' =>$id)))
		{
			return true;
		}else
		{
			return false;
		}

	}
	public function updateName($id,$name)
	{
		 $sql="UPDATE $this->table SET name=:name WHERE id=:id";
            $stmt=$this->pdo->prepare($sql);
            if($stmt->execute(array(':name'=>$name,':id'=>$id)))
            {
            	return true;
            }
            else{
            	return false;
            }
	}
	public function updateService($id,$service)
	{
		 $sql="UPDATE $this->table SET service=:service WHERE id=:id";
            $stmt=$this->pdo->prepare($sql);
            if($stmt->execute(array(':service'=>$service,':id'=>$id))){
            	return true;
            }
            else
            {
            	return false;
            }
	}
	public function setRoleById($id)
	{
		$sql="SELECT * FROM $this->table WHERE id=:id";
		$stmt=$this->pdo->prepare($sql);
            $stmt->execute
            (
            array
                (
                    ':id'=>$id
                )
            );
            $result=$stmt->fetch();
            if(!empty($result))
            {
            	$this->name=$result['name'];
            	$this->service=$result['service'];
            	return true;
            }
            else
            {
            	return false;
            }
	}

	public function getAll()
	{
		$sql="SELECT * FROM $this->table ORDER BY name ASC";
		$stmt=$this->pdo->prepare($sql);
		$stmt->execute();
            $result=$stmt->fetchAll();
            if(empty($result))
            {
            	return false;
            }
            else
            {
            	return $result;
            }
	}
	public function getName()
	{
		return $this->name;
	}
	public function getService()
	{
		return $this->service;
	}
	public function setName($name)
	{
		 $this->name=$name;
	}
	public function setService($service)
	{
		 $this->service=$service;
	}
	public function displayRoleList()
	{
		$roleList=$this->getAll();
		$select="";
		if(empty($roleList))
		{
			return false;
		}else{
			foreach ($roleList as $role) {
	          $select.='<option value="'.$role['id'].'">'.ucwords($role['name'])."</option>";
	      	}
          return $select;
		}
	}
	public function matchingService($id)
	{
		$sql="SELECT * FROM service WHERE id=:id";
            $stmt=$this->pdo->prepare($sql);
            if($stmt->execute(array(':id'=>$id)))
            {
            	$result=$stmt->fetch();
            	if(!empty($result))
            	{
            		$info=$result['name']." (".$result['duration']."min)";
            		return $info;
            	}
            	else
            		return false;
            }
            else
            	return false;
	}

	public function returnIdByname($name)
	{
	$sql= "SELECT * FROM $this->table WHERE name=:name";
    $stmt=$this->pdo->prepare($sql);
    $stmt->execute(array(':name' => $name ));
    $result = $stmt->fetch();
    if(!empty($result)){
        return $result['id'];
    }
    else
        return false;
	}

	public function setDoctorRole($did,$rid)
	{	
		try{
		$sql="INSERT INTO role_map(doctorId,roleId) values(:did,:rid)";
		$stmt=$this->pdo->prepare($sql);
		$stmt->execute(array(':did'=>$did,':rid'=>$rid));
		}catch(PDOException $e)
		{
			error_log("error truncating the default partition".$e->getMessage(),0);
			return false;
		}
		return true;
	}

	public function getUserRole($did)
	{
		$sql=<<<l
		SELECT role.name FROM role_map INNER JOIN role ON role_map.roleId =  role.id WHERE role_map.doctorId=:id
		l;
		$stmt=$this->pdo->prepare($sql);
		$stmt->execute(array(':id' => $did));
		$rows=$stmt->fetch();
		if(empty($rows))
		{
			$result="undefined";
		}else{
			$result=$rows['name'];
		}
		return $result;

	}

	public function getMatchingRole($did)
	{
		$sql="SELECT * from role_map WHERE doctorId=:did";
		$stmt=$this->pdo->prepare($sql);
		$stmt->execute(array(':did'=>$did));
		$result=$stmt->fetch();
		if(empty($result))
		{
			return false;
		}else{
			return $result;
		}

	}
	public function updateRole($did,$rid)
	{
		try{
			$sql="UPDATE role_map SET roleId=:rid WHERE doctorId=:did";
			$stmt=$this->pdo->prepare($sql);
			$stmt->execute(array(':did'=>$did,':rid'=>$rid));
		}catch(PDOException $e)
		{
			error_log($e->getMessage(),0);
			return false;
		}
		return true;
	}


}