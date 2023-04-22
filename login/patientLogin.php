<?php
include_once "../includes/autoloader.include.php";

if (isset($_POST['submit'])&&isset($_POST['password'])&&isset($_POST['username'])) {

    $patient=new Patient();
    $error_message=array();
    $password=$_POST['password'];
    $username=$_POST['username'];
    $pswdError=false;
    $usernameError=false;
    if(Validator::emptyfields($password,$username)){
        $error='all field has to be filled';
        array_push($error_message, $error);
        $pswdError=true;
         $usernameError=true;
    }
    else{
        $authenticator = new Authenticator($patient);
        $id = $authenticator->authenticateUser($username,$password);
        if($id===-1) 
        {
            $error='The entered Username or Email is incorrect or do not exist';
            array_push($error_message, $error);
             $usernameError=true;
        }
        else
        {
            if($id===0)
            {
            $error='Wrong Password!';
            array_push($error_message, $error);
            $pswdError=true;
            }
            else
            {
                session_start();
                $_SESSION['patientId']=$id;
                echo '<script>window.location.replace("../patient/booking.php")</script>';
            }
        }
    }


if(!empty($error_message))
          {
          foreach ( $error_message as $r) 
          {
    echo "<p style='color:red'>$r</p>";
          }
    }
?>   
<? include "../includes/jquery.html";?>
<script>
$('#username').removeClass("input-error");
$('#password').removeClass("input-error");
    var $usernameError="<?php echo $usernameError;?>";
     var $pswdError="<?php echo $pswdError;?>";
    if($usernameError==true)
    {
        alert('username Error');
        $('#username').addClass("input-error");
    }
    if($pswdError==true){
        alert('password Error');
        $('#password').addClass("input-error");
    }
</script>
<?php 
}else{
    header('Location:patientlogin.html?unauthorized');
    exit();
}
 ?>
