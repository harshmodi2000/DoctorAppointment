<?php
require "dbAccess.class.php";
class PatientHistory extends DbAccess
{
    private $table, $pdo;
    private $pid, $apid, $age, $weight;
    function __construct()
    {
        $this->pdo = $this->connect();
        $this->table = "medical_history";
    }
    function add($pid, $apid, $age, $weight)
    {
        $sql = "INSERT INTO $this->table(pid,apid,age,weight) VALUES (:pid,:apid,:age,:weight)";
        $stmt = $this->pdo->prepare($sql);
        if ($stmt->execute(array(':pid' => $pid, ':apid' => $apid, ':age' => $age, ':weight' => $weight))) {
            return true;
        } else {

            return false;
        }
    }

    function delete($id)
    {
        $sql = "DELETE FROM $this->table where id=:id";
        $stmt = $this->pdo->prepare($sql);
        if ($stmt->execute(array(':id' => $id))) {
            return true;
        } else {
            return false;
        }
    }
    public function getAll()
    {
        $sql = "SELECT * from $this->table ORDER BY id ASC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        if (empty($result)) {
            return false;
        } else {
            return $result;
        }
    }
    public function getPId()
    {
        return $this->pid;
    }
    public function setPId($pid)
    {
        $this->$pid = $pid;
    }
    public function getApId()
    {
        return $this->apid;
    }
    public function setApId($apid)
    {
        $this->$apid = $apid;
    }
    public function getAge()
    {
        return $this->age;
    }
    public function setAge($age)
    {
        $this->$age = $age;
    }
    public function getWeight()
    {
        return $this->weight;
    }
    public function setWeight($weight)
    {
        $this->$weight = $weight;
    }
    public function seById($id)
    {
        $sql = "SELECT * FROM $this->table WHERE id=:id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(array(':id' => $id));
        $result = $stmt->fetch();
        if (!empty($result)) {
            $this->pid = $result['pid'];
            $this->apid = $result['apid'];
            $this->age = $result['age'];
            $this->weight = $result['weight'];
            return true;
        } else {
            return false;
        }
    }
    public function seByPId($pid)
    {
        $sql = "SELECT * FROM $this->table WHERE pid=:pid";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(array(':pid' => $pid));
        $result = $stmt->fetch();
        if (!empty($result)) {
            $this->id = $result['id'];
            $this->apid = $result['apid'];
            $this->age = $result['age'];
            $this->weight = $result['weight'];
            return true;
        } else {
            return false;
        }
    }
    public function seByAPId($apid)
    {
        $sql = "SELECT * FROM $this->table WHERE apid=:apid";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(array(':apid' => $apid));
        $result = $stmt->fetch();
        if (!empty($result)) {
            $this->id = $result['id'];
            $this->pid = $result['pid'];
            $this->age = $result['age'];
            $this->weight = $result['weight'];
            return true;
        } else {
            return false;
        }
    }
    public function updatePId($id, $pid)
    {
        $sql = "UPDATE $this->table SET pid=:pid WHERE id=:id";
        $stmt = $this->pdo->prepare($sql);
        if ($stmt->execute(array(':pid' => $pid, ':id' => $id))) {
            return true;
        } else {
            return false;
        }
    }
    public function updateAPId($id, $apid)
    {
        $sql = "UPDATE $this->table SET apid=:apid WHERE id=:id";
        $stmt = $this->pdo->prepare($sql);
        if ($stmt->execute(array(':apid' => $apid, ':id' => $id))) {
            return true;
        } else {
            return false;
        }
    }
    public function updateAge($id, $age)
    {
        $sql = "UPDATE $this->table SET age=:age WHERE id=:id";
        $stmt = $this->pdo->prepare($sql);
        if ($stmt->execute(array(':age' => $age, ':id' => $id))) {
            return true;
        } else {
            return false;
        }
    }
    public function updateWeight($id, $weight)
    {
        $sql = "UPDATE $this->table SET weight=:weight WHERE id=:id";
        $stmt = $this->pdo->prepare($sql);
        if ($stmt->execute(array(':weight' => $weight, ':id' => $id))) {
            return true;
        } else {
            return false;
        }
    }
}$ph=new PatientHistory();
//$ph->add(1,1,21,82);
$result=$ph->getAll();
foreach($result as $r){
	echo $r['pid']."-".$r['apid']."-".$r['weight'];
	$ph->updateWeight(1,75);
}
?>