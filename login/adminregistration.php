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

       if(!Validator::emptyfields($username))
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

          if(!Validator::emptyfields($email))
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
         if(empty($error_message)||count($error_message)<1)
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
    <link rel="stylesheet" href="../css/adminReg.css">
    <? include "../includes/bootstrap.php"; ?>
</head>
<body>
 
<!--
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
-->
    <div class="container-fluid">
    <div class="row" style="width: 60rem; position: absolute; top:50%; left:50%; transform: translate(-50%,-50%); ">
        <div class="col" style="background: url(https://images.unsplash.com/photo-1518455027359-f3f8164ba6bd?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1536&q=80); background-size: cover; height: 70vh;">
<!--        <img src="../img/img2.jpg" style="width:100%; height: 80vh;"/>-->
        <img src="../img/logo.png" width="200px" height="" />
        </div>
    <div class="col bg-light">
    <form method="POST">
       
    <div class="reg-from ml-4">
         <h3 class="mt-3 text-center">Admin Registration</h3>
        <div class="reg-label form__group">

            <input type="text" name="name" id="" class="form__field" placeholder="Name">
            <label for="" class="form__label">Name</label>
        </div>
        <div class="reg-label form__group">
            
            <input type="text" class="form__field" placeholder="Email" name="email" id="">
            <label class="form__label" for="">Email</label>
        </div>
        <div class="reg-label form__group">
           
            <input type="text" class="form__field" placeholder="Username" name="username" id="">
            <label class="form__label"> Username</label>
        </div>
       <div class="reg-label form__group">
            <input type="password" class="form__field" placeholder="Password" name="password" id="">
           <label class="form__label">Password</label>
        </div>
           <div class="reg-label form__group">
            <input type="password" class="form__field" name="confirm_password" id="" placeholder="Confirm Password">
               <label class="form__label">Confirm Password</label>
           </div>
        
        <div class="text-right">
            <button type="submit" class="btn btn-primary mr-5 mt-4" name="submit">Register</button>
        </div>
        </div>
</form>
</div> 
    
    </div>
    </div>
</body>
</html>