<?php
//require "dbAccess.class.php";
class Chat extends DbAccess{
    private $table;
    private $pdo;
    function __construct(){
        $this->pdo = $this->connect();
        $this->table = "chat";
    }
    function GetUserPatientsPrevChatList($did){
        $sql="select patient.id,patient.name from $this->table,patient where patient.id and $this->table.did=:did order by patient.name";
        $stmt=$this->pdo->prepare($sql);
        $stmt->execute(array(":did"=>$did));
        $result=$stmt->fetchAll();
        return !empty($result)?true : false;
    }
    function GetUserDoctorPrevChatList($pid){
        $sql="select doctor.id,doctor.name from $this->table,doctor where doctor.id and $this->table.pid=:pid order by doctor.name";
        $stmt=$this->pdo->prepare($sql);
        $stmt->execute(array(":pid"=>$pid));
        $result=$stmt->fetchAll();
        return !empty($result)?true : false;
    }
    function GetChat($pid,$did){
        $sql="select * from $this->table where pid=:pid and did=:did";
        $stmt=$this->pdo->prepare($sql);
        $stmt->execute(array(":pid"=>$pid,":did"=>$did));
        $result=$stmt->fetchAll();
        return !empty($result)?$result : false;
    }
    function SendMessage($did,$pid,$isFromPatient,$msg){
        $sql="insert into chat(did,pid,isFromPatient,msg) values (:did,:pid,:isFromPatient,:msg)";
        $stmt=$this->pdo->prepare($sql);
        return $stmt->execute(array(":did"=>$did,":pid"=>$pid,":isFromPatient"=>$isFromPatient,":msg"=>$msg))?true:false;
        
    }
}
?>