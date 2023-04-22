<?php
include_once "../includes/autoloader.include.php";
if (!isset($_SESSION['adminId'])||empty($_SESSION['adminId'])) {
  die('Access Denied');
}
$scheduler=new Scheduler();
if(isset($_POST['submit'])&&isset($_POST['name'])&&isset($_POST['role'])&&isset($_POST['phone'])&&isset($_POST['gender'])&&isset($_POST['email']))
{
        $doctor = new Doctor();
        $authenticator = new Authenticator($doctor);
        $error_message=array();
        $name= $_POST['name'];  
        $role= $_POST['role'];  
        $phone= $_POST['phone'];  
        $gender= $_POST['gender'];  
        $email= $_POST['email'];
        if(Validator::emptyfields($name,$role,$gender,$email))
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
          $doctor->setUser($name,$gender,$phone,$email);
          if($doctor->addUserToDatabase())
          {
            $success = "<p style='color:#ffa500'>Registration successful !</p>";
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
                  $success.="<p style='color:#ffa500'>An Email has been sent to the doctor...</p>";
                }
                else{
                $error='Could not send Email to the user';
                array_push($error_message, $error);
                }
              }
              else{
                $error="We could not generate email";
                array_push($error_message, $error);
              }

          }
          else
          {
            $error='Your registration has failed!';
            array_push($error_message, $error);
          }
         }
         //Displaying errors
         if(!empty($error_message)&&!count($error_message)<1)
          {
          echo '<h1 style="color:red">Errors</h1>';
          echo '<ul>';
          foreach ( $error_message as $r) 
          {
            echo "<li style='font-color:red;font-size=16px'>$r</li>";
          }
            echo '</ul>';
          }
            elseif(!empty($success)){
              echo $success;
              $id=$doctor->getIdByMail($email);
              if($id!==false){
                  if(isset($_POST['schedule'])&&!strlen($_POST['schedule'])<1)
                  {
                    $s=strtolower($_POST['schedule']);
                    if($scheduler->setDoctorSchedule($id,$s)!==false)
                    {
                       echo "<p style='color:#ffa500'>Schedule Added Successfully</p>";
                    }else{
                      echo '<script>alert("Schedule could not be added")</script>';
                    }
                  }
                  if(is_numeric($role))
                  {
                    $roleManager=new Role();
                    if($roleManager->setDoctorRole($id,$role)!==false)
                    {
                      echo "<p style='color:#ffa500'>"."Role Added Successfully"."</p>";
                    }else{
                      echo '<script>alert("Role could not be set")</script>';
                    }
                  }
                }else{
                  echo '<script>alert("user not found! Could neither add Role or schedule")</script>';
                }
            }
}         
$roles= new Role();
?>   
<div class="container pt-5">
      <h2>Register Doctor</h2>
    <form method="POST" enctype="multipart/form-data">
    <div class="floating-form">
        <div class="floating-label mt-4">
          <input class="floating-input" type="text" name="name" placeholder=" ">
      <span class="highlight"></span>
      <label>Name*</label>
        </div>
        <div class="floating-label mt-4">
          <select class="floating-select" id="" onclick="this.setAttribute('value', this.value);" value="" name="role">
              <option value=""></option>
          <?php $s=$roles->displayRoleList();
          echo ($s!==false)?$s:'No Record Found for roles';
          ?>
          </select>  
           <label>Role *</label>  
        </div>
        <div class="floating-label mt-4">
       
      <input type="text" class="floating-input" name="phone" placeholder=" ">
             <label>Phone </label>
        </div>
      <div>
          <span>Gender *</span>
      <input type="radio" id="male" name="gender" value="M" checked>
      <span for="male">Male</span>
      
      <input type="radio" id="female" name="gender" value="F">
      <span for="male">Female</span>
      
        </div>
        <div class="floating-label mt-4">
          
      <input type="text" name="email" placeholder=" " class="floating-input" >
            <label>Valid Email*</label>
        </div>
        <div class="floating-label">
      
          <select id="" onclick="this.setAttribute('value', this.value);" value=""  class="floating-select" name="schedule">
              <option value=""></option>
          <?php $s=$scheduler->displayScheduleList();
          echo ($s!==false)?$s:'No Model Available!';
          ?>
          </select>
        <label>Schedule</label>
        </div>
      <input type="submit" class="btn btn-success btn-lg" name="submit" value="Register">
    </div>
  </form> 
  </div>
