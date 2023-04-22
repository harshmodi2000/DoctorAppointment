<?php 
session_start();
include_once "../includes/autoloader.include.php";
if (!isset($_SESSION['patientId'])||empty($_SESSION['patientId'])) {
	die('Access Denied');
}
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">

    <style>
        body{
            font-family: 'Lato';
        }
        nav{
            width:100%;
            height: 2rem;
            padding: 1rem;
            background: rgba(64,66,250,1.0);
            position: fixed;
            color: #fff;
            top:0;
        }
        .msgFromUser{
            border-radius: 20px 20px 0px 20px;
            background: rgba(88,95,255,1.00);
            color:#FFF;
            padding: 1rem;
            font-size: 1rem;
/*            min-width: 12%;*/
/*            position: absolute;*/
/*            float: right;*/            
            width:40%;
            
            right:0rem;
            display: inline-block;
            margin-bottom: 1rem;
            text-align: right;
            margin-left: 56%;
           
        }
        .msgFromSender:first-of-type,.msgFromUser:first-of-type{ margin-top:4rem; }
        .msgFromSender{
            border-radius: 0px 20px 20px 20px;
            background: rgba(255,255,255,1.00);
            border: #000 solid 1px;
/*            color:#fff;*/
            padding: 1rem;
             min-width: 12%;
            font-size: 1rem;
/*            width: 40%;*/
            left:1rem;
            display: inline-block;
            margin-bottom: 1rem;
            text-align: left;
            
           
        }
        .msgTs{
            font-size: .8rem;
            color:rgba(150,150,150,1.00);
        }
        .msgFromSender .msgTs{
            text-align: right;
        }
        .UserprofileImg{
            display: inline-block;
/*            vertical-align: baseline;*/
            position: relative;
            top:1rem;
            right: 0;
        }
        .UserprofileImg img{
            width: 40px;
/*            width:4%;*/
            
        }
    </style>
<title>Chat</title>
</head>

<body>
    <div id="messages">
    
    </div>
    <div style="width: 100%; position: fixed; bottom: 0;">
    <textarea style="width:99%;" id="txtbox" placeholder="Type your message here"></textarea>
    <input type="button" style="padding: 1rem; color:white; text-decoration: none; border:none; float: right; background:rgba(87,172,56,1.00); " value="Send" id="btnSend">
    </div>
</body>
    <script>
    $("#btnSend").click(function(){
  $.post("chatOp.php",
  {
    did:4,
    pid:"<?php echo $_SESSION['patientId'];?>",
    msg:$("#txtbox").val(),
    isFromPatient:true
      
  
},function(data, status){
    //alert("Data: " + data + "\nStatus: " + status);
      $("#txtbox").val("");
//      $("#messages").load("chatOp.php",{pid:1,
//    did:"<?php //echo $_SESSION['userId'];?>"});
  }
);
    });

//  $("#messages").load("chatOp.php",{pid:1,
//    did:"<?php //echo $_SESSION['userId'];?>"});
setInterval(function(){
     $("#messages").load("chatOp.php",{pid:<?php echo $_SESSION['patientId'];?>,
    did:<? echo $_GET['did']; ?>});
    
},1000);
            
    </script>
</html>