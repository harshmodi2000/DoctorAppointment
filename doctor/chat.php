<?php 
session_start();
include_once "../includes/autoloader.include.php";
if (!isset($_SESSION['doctorId'])||empty($_SESSION['doctorId'])) {
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
            width:25%;
            
            right:0rem;
            display: inline-block;
            margin-bottom: 1rem;
            text-align: right;
            margin-left: 71%;
           
        }
        .msgFromSender:first-of-type,.msgFromUser:first-of-type{ margin-top:4rem; }
        .msgFromSender:last-of-type,.msgFromUser:last-of-type{ margin-bottom:5rem; }
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
    <div style="background:#fff;position: fixed; bottom:0; width: 100%;">
    <textarea id="txtbox" style="width:99%;"></textarea>
        <div>
    <input type="button" style="background: rgba(10,120,255,1.00); border:none; padding: 1rem; color: #fff; float:right; margin-right: 2rem;" value="Send" id="btnSend">
            <a href="CreatePrescription.php?bid=<? echo $_GET['bid'];?>"><input type="button" style="background: rgba(146,2,206,1.00); border:none; padding: 1rem; color: #fff; float:right; margin-right: 2rem;" value="End Chat and Create Prescription" id="btnSend"></a>
            </div>
    </div>

</body>
    <script>
    $("#btnSend").click(function(){
  $.post("chatOp.php",
  {
    did:"<?php echo $_SESSION['doctorId'];?>",
    pid:<?php echo $_GET['pid']; ?>,
    msg:$("#txtbox").val(),
    isFromPatient:false
      
  
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
     $("#messages").load("chatOp.php",{pid:<? echo $_GET['pid'];?>,
    did:"<?php echo $_SESSION['doctorId'];?>"});
    
},1000);
            
    </script>
</html>