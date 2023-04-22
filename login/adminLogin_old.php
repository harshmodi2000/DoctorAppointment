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
                $_SESSION['userId']=$id;
                header('Location:../admin/index.php');
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
</head>
<body>
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
</body>
</html>
