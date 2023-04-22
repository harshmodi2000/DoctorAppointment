<?php
include_once "../includes/autoloader.include.php";

if(isset($_POST['submit'])&&isset($_POST['name'])&&isset($_POST['address'])&&isset($_POST['username'])&&isset($_POST['phone'])&&isset($_POST['gender'])&&isset($_POST['email'])&&isset($_POST['password'])&&isset($_POST['confirm_password'])&&isset($_POST['date_of_birth']))
{
        $patient = new Patient();
        $authenticator = new Authenticator($patient);
        $error_message=array();
        $name= $_POST['name'];  
        $address= $_POST['address'];  
        $username= $_POST['username'];  
        $phone= $_POST['phone'];  
        $gender= $_POST['gender'];  
        $email= $_POST['email'];
        $password= $_POST['password'];  
        $confirm_password= $_POST['confirm_password'];
        $date_of_birth= $_POST['date_of_birth'];  

        if(Validator::emptyfields($name,$date_of_birth,$phone,$gender,$email,$password,$confirm_password))
        {
            $error="the * fields cannot be empty!";
            array_push($error_message, $error);
        }
        
        if(Validator::invalidName($name))
        {
            $error="name cannot contain special characters";
            array_push($error_message, $error);
        }

       if(!empty($username))
        {
          if(Validator::invalidUsername($username)){
            $error="Username can contain numbers and letters with no space";
            array_push($error_message, $error);
          }
          else{
            if($authenticator->usernameExist($username)!==false)
            {
              $error="Username already exist";
              array_push($error_message, $error);
            }  
          }
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
          if (Validator::isNotMatched($password,$confirm_password)) 
        {
          $error="password and confirm pasword do not match";
           array_push($error_message, $error);
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

          if(!empty($password))
          {
              if(Validator::invalidPasswordLength($password))
              {
                $error='password should be at least 6 character length';
                array_push($error_message, $error);
              } 
           }    
         if(empty($error_message))
         {
          $patient->setUser($name,$gender,$address,$phone,$date_of_birth,$email,$username,$password);
          if($patient->addUserToDatabase())
          {$success = "You are now registered !";}
          else
          {
            $error_message='Your registration has failed!';
            array_push($error_message, $error);
          }
         }
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
?>
<html>
<head>
    <title>Patient Login</title>
</head>
<body>
<form method="POST">
    <table>
        <tr>
            <td>Name *</td>
            <td><input type="text" name="name" id=""></td>
        </tr>
        <tr>
            <td>Address</td>
            <td><textarea name="address" id="" cols="30" rows="10"></textarea></td>
        </tr>
        <tr>
            <td>Contact *</td>
            <td><input type="text" name="phone"></td>
        </tr>
        <tr>
            <td>Date of birth *</td>
            <td><input type="date" name="date_of_birth" id=""></td>
        </tr>
        <tr>
            <td>Gender *</td>
            <td><input type="radio" name="gender" value="M" id="" checked>Male<input type="radio" name="gender" value="F" id="">Female</td>
        </tr>
        <tr>
            <td>Email *</td>
            <td><input type="text" name="email" id=""></td>
        </tr>
        <tr>
            <td>username</td>
            <td><input type="text" name="username" id=""></td>
        </tr>
        <tr>
            <td>Password *</td>
            <td><input type="password" name="password" id=""></td>
            <tr><td></td>
            <td><input type="password" name="confirm_password" id="" placeholder="Retype your password..."></td>
          </tr>
        </tr>
        <tr>
            <td><button type="submit" name="submit">Register</td>
        </tr>
    </table>
</form>
</body>
</html>