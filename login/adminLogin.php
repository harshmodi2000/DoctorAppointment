<?php
include_once "../includes/autoloader.include.php";
session_start();
if (isset($_POST['submit'])&&isset($_POST['password'])&&isset($_POST['username'])) {

    $admin=new Admin();
    $error_message=array();
    $password=$_POST['password'];
    $username=$_POST['username'];
    if(Validator::emptyfields($password,$username)){
        $error='all field has to be filled';
        array_push($error_message, $error);
    }
    else{
        $authenticator = new Authenticator($admin);
        $id = $authenticator->authenticateUser($username,$password);
        if($id===-1) 
        {
            $error='The entered Username or Email is incorrect or do not exist';
            array_push($error_message, $error);
        }
        else
        {
            if($id===0)
            {
            $error='Wrong Password!';
            array_push($error_message, $error);
            }
            else
            {
                $success='Welcome!';
                $_SESSION['adminId']=$id;
                header('Location:../admin/adminpage.php');
                exit();
            }
        }
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
    echo "<h1 style='color:green'>$success</h1>";}
?>   
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
     <?php include '../includes/bootstrap.php'; ?>
    <link rel="stylesheet" href="../style/loginstyle.css">
</head>
<body>
<!--
    <form method="POST">
        <table>
            <tr>
                <td>Username or Email</td>
                <td><input type="text" name="username" id=""></td>
            </tr>
            <tr>
                <td>Password</td>
                <td><input type="password" name="password" id=""></td>
            </tr>
            <tr>
                
                <td><input type="submit" name="submit" Value="Log In"></td>
            </tr>
        </table>
         <p><a href="index.php">Go to Main Page</p>
        <p><a href="../reset-password/checkmail.php?key=2"> Forgot Password? </p>
    </form>
-->
     <section>
        
<!--
        <div class="color"></div>
        <div class="color"></div>
        <div class="color"></div>
-->
        <div class="box">
            <div class="square" style="--i:0"></div>
            <div class="square" style="--i:1"></div>
            <div class="square" style="--i:2"></div>
            <div class="square" style="--i:3"></div>
            <div class="square" style="--i:4"></div>
            <div class="container">
                <div class="form">
                    <img src="../img/logo.png"
             alt="" width="40%" class="mb-2">
                    <h2>Login Form</h2>
                    <form method="post">
                        <div class="inputBox">
                            <input type="text" name="username" placeholder="Username">
                        </div>
                        <div class="inputBox">
                            <input type="password" name="password" placeholder="Password">
                        </div>
                        <div class="inputBox">
                            <input type="submit" name="submit" value="Login">
                        </div>
                        <p class="forget">Forget password ? 
                            <a href="#" data-toggle="modal" data-target="#exampleModal">Click Here</a>
                        </p>
                        <p class="forget">Don't have an account ?
                            <a href="adminregistration.php">Sign up</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </section>
<!--    Model-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Forgot Password?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
    <div id="forgot">
    
<form action="" method="post">
<p>Enter your registered mail address :</p>
<!--<input type="hidden" id="key" name="key" value="2">-->
<input type="text" id="forgotEmail" name="email">
<br>
<!--<input type="submit" name="submit">-->
</form>
    </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" id="BtnSubmit" class="btn btn-primary">
            Submit</button>
      </div>
    </div>
  </div>
</div>
</body>
    <script>
//    $(document).ready(function(){
                
        
        $("#BtnSubmit").on("click",function(){
            var emailVal=$("#forgotEmail").val();
//            var keyVal=$("#key").val();
            $("#forgot").load("../reset-password/reset-password.php",{email:emailVal,key:2,submit:"submit"});          
        });
//        $("#forgot").load("../reset-password/checkmail.php?key=2");
//    });    

    </script>
</html>
