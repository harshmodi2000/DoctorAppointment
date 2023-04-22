<?php
include_once "../includes/autoloader.include.php";
if (isset($_POST['submit'])&&isset($_POST['password'])&&isset($_POST['username'])) {

    $patient=new Patient();
    $error_message=array();
    $password=$_POST['password'];
    $username=$_POST['username'];
    if(Validator::emptyfields($password,$username)){
        $error='all field has to be filled';
        array_push($error_message, $error);
    }
    else{
        $authenticator = new Authenticator($patient);
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
                $patient->setUserById($id);
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
    echo "<h1 style='color:green'>$success</h1>";
?>   
<!DOCTYPE html>
<html>
<head>
    <title>Patient login Success</title>
</head>
<body>
<div>
    <table>
        <tr>
            <td>Name :</td><td><?php echo $patient->getName(); ?></td>   
        </tr>
        <tr>
            <td>Address :</td><td><?php echo $patient->getAddress(); ?></td>
        </tr>
        <tr>
            <td>Gender :</td><td><?php echo $patient->getGender(); ?></td>   
        </tr>
        <tr>
            <td>Email :</td><td><?php echo $patient->getEmail(); ?></td>
        </tr>
        <tr>
            <td>Phone number :</td><td><?php echo $patient->getPhone(); ?></td>
        </tr>
    </table>
    <p><a href="../reset-password/chekmail.html?key=1"> Forgot Password? </p>

    <p> OR <a href="patientRegistration.php">Register Here!</a></p>
</div>
</body>
</html>

<?php
  }