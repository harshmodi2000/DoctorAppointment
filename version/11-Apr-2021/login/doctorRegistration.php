<?php
include_once "../includes/autoloader.include.php";
if (!isset($_SESSION['userId'])||empty($_SESSION['userId'])) {
  die('Access Denied');
}
$scheduler=new Scheduler();
if(isset($_POST['submit'])&&isset($_POST['name'])&&isset($_POST['speciality'])&&isset($_POST['phone'])&&isset($_POST['gender'])&&isset($_POST['email']))
{
        $doctor = new Doctor();
        $authenticator = new Authenticator($doctor);
        $error_message=array();
        $name= $_POST['name'];  
        $speciality= $_POST['speciality'];  
        $phone= $_POST['phone'];  
        $gender= $_POST['gender'];  
        $email= $_POST['email'];
        if(Validator::emptyfields($name,$speciality,$gender,$email))
        {
            $error="the * fields cannot be empty!";
            array_push($error_message, $error);
        }
        
        if(Validator::invalidName($name))
        {
            $error="name cannot contain special characters";
            array_push($error_message, $error);
        }

          if(!empty($email))
          {
            $email=Validator::isvalidMail($email);
            if($email===false)
            {
              $error="enter valid mail";
              array_push($error_message, $error);
            }
            else{
              if($authenticator->emailExist($email))
              {
                $error="email already exist";
                array_push($error_message, $error);
              }
            }
          }
        if(!empty($phone))
        {
          $phone=Validator::isvalidPhonenumber($phone);
            if($phone===false)
            {
              $error="enter a valid phone number";
              array_push($error_message, $error);
            }
        }      
         if(empty($error_message))
         {
          $doctor->setUser($name,$gender,$speciality,$phone,$email);
          if($doctor->addUserToDatabase())
          {
            $success = "Registration successful !";
            $reseter=new ResetPassword();
            $link=$reseter->getLink("0",$email,604800);

              if($link!==false)
              {
                $mailer=new Mailer();
                $receiver=$email;
                $subject='New doctor account';
                $body='Your account has been created.<p>To reset your password, open the link below</p><p>Do not share this link with anyone!</p><p>Link to reset your password:</p><p><a href='.$link.'>'.$link.'</a></p><p><b>Note<b> that you can use the link within 1 week</p><br><br>Thank you for trusting Docare';
                 $mailer=$mailer->sendMail($receiver,$subject,$body);
                if($mailer){
                  $success.="<br>An Email has been sent to the doctor...";
                }
                else{
                $error_message='Could not send Email to the user';
                array_push($error_message, $error);
                }
              }
              else{
                $error_message="We could not generate email";
                array_push($error_message, $error);
              }

          }
          else
          {
            $error_message='Your registration has failed!';
            array_push($error_message, $error);
          }
         }
         //Displaying errors
         if(!empty($error_message))
          {
    echo '<h1 style="color:red">Errors</h1>';
    echo '<ul>';
          foreach ( $error_message as $r) 
          {
            echo "<li style='font-color:red;font-size=16px'>$r</li>";
          }
    echo '</ul>';
          }
  if(!empty($success)){
    echo "<h1 style='color:green'>$success</h1>";
  }


}         
$roles= new Role();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Registration</title>
</head>
<body>
  <div class="">
    <form action="" method="POST" enctype="multipart/form-data">
    <div class="">
    <p> Name *</p>
      <input type="text" name="name" placeholder="fullname...">
      <br>
    <p>Speciality *</p>
          <select id="" name="speciality">
          <?php $s=$roles->displayRoleList();
          echo ($s!==false)?$s:'No Record Found for roles';
          ?>
          </select>  
      <p>Phone </p>
      <input type="text" name="phone" placeholder="Mobile number">
      <br>
      <p>Gender *</p>
      <input type="radio" id="male" name="gender" value="M" checked>
      <label for="male">Male</label>
      <br>
      <input type="radio" id="female" name="gender" value="F">
      <label for="male">Female</label>
      <br>
      <p>Valid email *</p>
      <input type="text" name="email" placeholder="abc@xyz.com" >
      <br>
      <br>
      Schedule *
          <select id="" name="schedule">
          <?php $s=$scheduler->displayScheduleList();
          echo ($s!==false)?$s:'No Model Available!';
          ?>
          </select> <br><br>
      <input type="submit" name="submit" value="Register">
    </div>
  </form> 
  </div>
</body>
 </html>