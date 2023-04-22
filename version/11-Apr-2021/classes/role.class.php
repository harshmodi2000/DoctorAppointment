<?php
class Role extends DbAccess
{
	private $table,$pdo,$service,$name;

	
	function __construct()
	{
		$this->pdo=$this->connect();
		$this->table="role";
	}

	function add($name,$service)
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
	          $select.='<option value="'.ucwords($role['name']).'">'.ucwords($role['name'])."</option>";
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


}