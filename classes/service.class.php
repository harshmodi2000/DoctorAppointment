<?php
class Service extends DbAccess
{
	private $table,$pdo,$name,$duration;

	
	public function __construct()
	{
		$this->pdo=$this->connect();
		$this->table="service";
	}

	public function add($name,$duration)
	{
		$sql="INSERT INTO $this->table(name,duration) VALUES(:name,:duration)";
		$stmt=$this->pdo->prepare($sql);
		if($stmt->execute(array(':name' =>$name ,':duration'=>$duration)))
		{
			return true;
		}else
		{
			return false;
		}
	}

	public function delete($id)
	{
		$sql="DELETE FROM $this->table WHERE id=:id";
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
	public function updateDuration($id,$duration)
	{
		 $sql="UPDATE $this->table SET duration=:duration WHERE id=:id";
            $stmt=$this->pdo->prepare($sql);
            if($stmt->execute(array(':duration'=>$duration,':id'=>$id))){
            	return true;
            }
            else
            {
            	return false;
            }
	}
	public function setServiceById($id)
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
            	$this->duration=$result['duration'];
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
	public function getDuration()
	{
		return $this->duration;
	}
	public function setName($name)
	{
		 $this->name=$name;
	}
	public function setDuration($duration)
	{
		 $this->duration=$duration;
	}
	public function displayServiceList()
	{
		$serviceList=$this->getAll();
		$checkbox='';
		if(empty($serviceList))
		{
			return false;
		}else{
			foreach ($serviceList as $service) {
				$checkbox.='<input class="" type="checkbox" name="serviceList[]" value="'.$service['id'].'">';
  				$checkbox.=ucfirst($service['name'])."(".$service['duration']."min)<br>";
			}
			return $checkbox;
		}
	}

	public function displayServiceList_checked($string)
	{
		$origin=explode(',',$string);
		$serviceList=$this->getAll();
		$checkbox="";
		if(empty($serviceList))
		{
			return false;
		}else{
			foreach ($serviceList as $service) {
				if(in_array($service['id'],$origin)){
	          	$checkbox.='<input class="" type="checkbox" name="serviceList[]" value="'.$service['id'].'" checked>';
  				$checkbox.=ucfirst($service['name'])."(".$service['duration']."min)<br>";
  			}
	          else
	          {
	          	$checkbox.='<input class="" type="checkbox" name="serviceList[]" value="'.$service['id'].'">';
  				$checkbox.=ucfirst($service['name'])."(".$service['duration']."min)<br>";
	      		}
	      	}
          return $checkbox;
		}
	}


}