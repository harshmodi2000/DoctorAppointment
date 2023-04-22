<?php 
//require_once("../classes/chat.class.php");
include_once "../includes/autoloader.include.php";

if(isset($_POST['did'])&&isset($_POST['pid'])&&isset($_POST['isFromPatient'])&&isset($_POST['msg'])){
    $chat=new Chat();
    $chat->SendMessage($_POST['did'],$_POST['pid'],$_POST['isFromPatient']?0:1,$_POST['msg']);
}
else if(isset($_POST['pid'])&&isset($_POST['did'])){
    $patient=new Patient();
    $patient->setUserById($_POST['pid']);
    
    echo "<nav>Patient Name:".$patient->getName().", Gender:".$patient->getGender().", DOB:".$patient->getDateOfBirth()."</nav>";
    $chat=new Chat();
    $msgs=$chat->GetChat($_POST['pid'],$_POST['did']);
//    print_r($msgs);
    foreach($msgs as $msg){
        if($msg['isFromPatient']==1){
            echo "<div class='msgFromSender'> ".$msg['msg']."<div class='msgTs'>".$msg['msg_ts']."</div></div><br>";
        }
        else{
            
            echo "<div class='msgFromUser'> ".$msg['msg']."<div class='msgTs'>".$msg['msg_ts']."</div></div><br>";
        
        }
    }
}
//echo "<h1> Hello</h1>";
?>