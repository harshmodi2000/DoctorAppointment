<?php 
//require_once("../classes/chat.class.php");
include_once "../includes/autoloader.include.php";

if(isset($_POST['did'])&&isset($_POST['pid'])&&isset($_POST['isFromPatient'])&&isset($_POST['msg'])){
    $chat=new Chat();
    $chat->SendMessage($_POST['did'],$_POST['pid'],$_POST['isFromPatient']?1:0,$_POST['msg']);
}
else if(isset($_POST['pid'])&&isset($_POST['did'])){
//    $patient=new Patient();
//    $patient->setUserById($_POST['pid']);
//    
//    echo "<div>Patient Name:".$patient->getName().", Gender:".$patient->getGender().", DOB:".$patient->getDateOfBirth()."</div>";
    $chat=new Chat();
    $doctor=new Doctor();
    $doctor->setUserById($_POST['did']);
    echo "<nav><span style='margin-right:1rem; color:white;'><img src='../icon/user.png' width='30px'/></span>Name:Dr.".$doctor->getName().",Gender:".$doctor->getGender()."</nav>";
    $msgs=$chat->GetChat($_POST['pid'],$_POST['did']);
//    print_r($msgs);
    foreach($msgs as $msg){
        if($msg['isFromPatient']==0){
            echo "<div class='msgFromSender' > ".$msg['msg']."<div class='msgTs'>".$msg['msg_ts']."</div></div><br>";
        }
        else{
//            $t=new DateTimeImmutable($msg['msg_ts']);
//            $time=DateTime::createFromImmutable($t);
//            $time->format("h:i A");
            
            echo "<div><div class='msgFromUser'> ".$msg['msg']."<div class='msgTs'>".$msg['msg_ts']."</div></div><!--<div class='UserprofileImg'> <img src='../icon/user.png' /></div>--></div>";
        
        }
    }
}
//echo "<h1> Hello</h1>";
?>