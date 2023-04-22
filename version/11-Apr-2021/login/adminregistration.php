<?php
include_once "../includes/autoloader.include.php";

if(isset($_POST['submit'])&&isset($_POST['name'])&&isset($_POST['email'])&&isset($_POST['password'])&&isset($_POST['confirm_password']))
{
        $admin = new Admin();
        $authenticator = new Authenticator($admin);
        $error_message=array();
        $name= $_POST['name'];   
        $username= $_POST['username'];  
        $email= $_POST['email'];
        $password= $_POST['password'];  
        $confirm_password= $_POST['confirm_password'];

        if(Validator::emptyfields($name,$email,$password,$confirm_password))
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
          $admin->setUser($name,$email,$username,$password);
          if($admin->addUserToDatabase())
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
    <title>Admin Registration</title>
</head>
<body>
<form method="POST">
    <table>
        <tr>
            <td>Name *</td>
            <td><input type="text" name="name" id=""></td>
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