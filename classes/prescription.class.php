<?php 
class Prescription extends DbAccess{
    private $pdo;
    private $table;
    private $apId;
    private $id;
    private $pName;
    private $pAge;
    private $BP;
    private $HR;
    private $T;
    private $RR;
    private $SPO2;
    private $remarks;
    private $prescriptionFile;
    private $weight;

    public function __construct(){
        $this->pdo=$this->connect();
        $this->table="prescriptions";
    }
    public function uploadPrescriptionFile($file)
    {
        $destination= '../uploads/prescription/';
        $name = 'p'.$this->id.'_'.uniqid();
        $filelink=Basic::moveFile($file,$destination,$name);
        return $filelink;
    }
    public function updatePrescriptionFile($fileList)
    {
        try{
        $sql="UPDATE $this->table SET prescriptionFile=:file WHERE id=:id";
        $stmt=$this->pdo->prepare($sql);
        $stmt->execute(array(':file'=>$fileList,':id'=>$this->id));
             $this->prescriptionFile=$fileList;
             return true;
         }catch(PDOException $e)
        {
            error_log($e->getMessage(),0);
            return false;
        }
    }
    public function addPrescription($appointmentId,$name,$age,$weight,$BP,$HR,$T,$RR,$SPO2,$remarks)
    {
        try{
        $sql="INSERT INTO $this->table(appointmentId,name,age,weight,BP,HR,T,RR,SPO2,remarks) values(:appointmentId,:name,:age,:weight,:BP,:HR,:T,:RR,:SPO2,:remarks)";
        $stmt=$this->pdo->prepare($sql);
        $stmt->execute(array(
            ':appointmentId'=>$appointmentId,
            ':name'=>$name,
            ':age'=>$age,
            ':weight'=>$weight,
            ':BP'=>$BP,
            ':HR'=>$HR,
            ':T'=>$T,
            ':RR'=>$RR,
            ':SPO2'=>$SPO2,
            ':remarks'=>$remarks
        ));
        return $this->pdo->lastInsertId();
        }catch(PDOException $e)
        {
            error_log("error updating file".$e->getMessage(),0);
            return false;
        }
    }
    public function setPrescriptionByApId($apId)
    {
        $sql="SELECT * FROM $this->table WHERE appointmentId=:id";
        $stmt=$this->pdo->prepare($sql);
        $stmt->execute(array(':id' =>$apId));
        $result=$stmt->fetch();
        if(empty($result))
        {
            return false;
        }else{
            $this->id=$result['id'];
            $this->apId=$result['appointmentId'];
            $this->pName=$result['name'];
            $this->pAge=$result['age'];
            $this->BP=$result['BP'];
            $this->HR=$result['HR'];
            $this->T=$result['T'];
            $this->RR=$result['RR'];
            $this->SPO2=$result['SPO2'];
            $this->remarks=$result['remarks'];
            $this->prescriptionFile=$result['prescriptionFile'];
            $this->weight=$result['weight'];
            return $result;
            }
    }
    public function setPrescriptionById($pid)
    {
        $sql="SELECT * FROM $this->table WHERE id=:id";
        $stmt=$this->pdo->prepare($sql);
        $stmt->execute(array(':id' =>$pid));
        $result=$stmt->fetch();
        if(empty($result))
        {
            return false;
        }else{
            $this->id=$result['id'];
            $this->apId=$result['appointmentId'];
            $this->pName=$result['name'];
            $this->pAge=$result['age'];
            $this->BP=$result['BP'];
            $this->HR=$result['HR'];
            $this->T=$result['T'];
            $this->RR=$result['RR'];
            $this->SPO2=$result['SPO2'];
            $this->remarks=$result['remarks'];
            $this->prescriptionFile=$result['prescriptionFile'];
            $this->weight=$result['weight'];
            return $result;
            }
    }

    public function getPrescriptionId()
    {
        return $this->id;
    }
    public function getAppointmentId()
    {
        return $this->apId;
    }

    public function getPatientName()
    {
        return $this->pName;
    }
    public function getPatientAge()
    {
        return $this->pAge;
    }
    public function getPatientBloodPressure()
    {
        return $this->BP;
    }
    public function getPatientHeartRate()
    {
        return $this->HR;
    }
        public function getPatientTemperature()
    {
        return $this->T;
    }
    public function getPrescriptionFile()
    {
        return $this->prescriptionFile;
    }
    public function getPatientRespiratoryRate()
    {
        return $this->RR;
    }
    public function getPatientOxygenLevel()
    {
        return $this->SPO2;
    }
    public function getRemarksFromDoctor()
    {
        return $this->remarks;
    }
    public function getPatientWeight()
    {
        return $this->weight;
    }
    public function getPrescriptionFileLink($filename)
    {
        return '../uploads/prescription/'.$filename;
    }
    public function deleteApId($id)
    {
        try{
            $sql="DELETE FROM $this->table WHERE appointmentId=:id";
            $stmt=$this->pdo->prepare($sql);
            $stmt->execute(array('id'=>$id));
               return true;
        }catch(PDOException $e)
        {
            error_log($e->getMessage(),0);
            return false;
        }
    }

    public function readPrescriptionFile($filename)
    {
        $filename=basename($filename);
        $filepath='../uploads/prescription/'.$filename;
        if(!empty($filename)&&file_exists($filepath))
        {
            header("Cache-Control: public");
            header("Content-Description: FILE Transfer");
            header("Content-Disposition: attachment; filename= $filename");
            header("Content-Type: application/octet-stream");
            header("Content-Transfer-Encoding: binary");
            readfile($filepath);
            return true;
        }else{
            return false;
        }
    }

}
