<?php  
session_start();
if (!isset($_SESSION['userId'])||empty($_SESSION['userId'])) {
	die('Access Denied');
}
include_once "../includes/autoloader.include.php";
$doctor = new Doctor();
$doctor->setUserById($_SESSION['userId']);
$success='';
if(isset($_POST['submit']))
{
       
        $authenticator = new Authenticator($doctor);
        $error_message=array();
        $username= $_POST['username'];  
        $phone= $_POST['phone'];   
        $file= $_FILES['image'];  

       if(!empty($username)&&$username!==$doctor->getUsername())
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
            }else{
                if($doctor->updateUsername($username)===false)
                {
                    $error="Could not update username";
                    array_push($error_message, $error);
                }
                else{
                  $success.="<li>Username has been updated</li>";
                }
            }  
          }
        }
        if(!empty($phone)&&$phone!==$doctor->getPhone())
        {
          $phone=Validator::isvalidPhonenumber($phone);
            if($phone===false)
            {
              $error="enter a valid phone number";
              array_push($error_message, $error);
            }
            else{
              if($doctor->updatePhone($phone)===false)
                {
                   $error="Could not update Phone number";
                    array_push($error_message, $error);
                }
                else{
                  $success.="<li>Phone number has been updated</li>";
                }
            }
        }

        if (!Validator::isEmptyfile($file)) 
        {
          if(Validator::invalidImageSize($file))
          {
            $error="file size cannot be over 5MB";
            array_push($error_message, $error);
          }else{
              if(Validator::fileUploadError($file))
              {
                $error="there was an error while uploading file";
                array_push($error_message, $error);
              }else{
                  if(Validator::invalidImageFormat($file))
                    {
                  $error="Image should be of format jpg,png,jpeg only";
                  array_push($error_message, $error);
                  }else{
                      if($doctor->updateProfileImage($file)===false)
                        {
                         $error="Could not update profil Image";
                          array_push($error_message, $error);
                        }
                      else
                        {
                           $success.="<li>Profile Image has been updated</li>";
                        }
                  }
                }
            }
          }
         if(!empty($error_message))
          {
          echo '<ul>';
          foreach ( $error_message as $r) 
          {
            echo "<li style='color:red'>$r</li>";
          }
          echo '</ul>';
          }
  if(!empty($success)){
    echo "<ul style='color:green'>$success</ul>";
  } 
}     
?>
<!DOCTYPE html>
<html>
<head>
  <title>Account</title>
  <style type="text/css">
    .image{
      height: 300px;
      width: 300px;
      float: left;
    }
  </style>
</head>
<body>
<div>
   <form method="POST" enctype="multipart/form-data">
  <img class="image" src="<?php echo($doctor->getProfileImageLink()); ?>">
  <table>
    <tr>
      <td>Name :</td><td><?php echo $doctor->getName(); ?></td> 
    </tr>
    <tr>
      <td>Speciality :</td><td><?php echo $doctor->getSpeciality(); ?></td>
    </tr>
    <tr>
      <td>Gender :</td><td><?php echo $doctor->getGender(); ?></td> 
    </tr>
    <tr>
      <td>Email :</td><td><?php echo $doctor->getEmail(); ?></td>
    </tr>
      <tr>
      <td>Username: </td><td><input type="text" name="username" value="<?php echo $doctor->getUsername(); ?>"></td>
    </tr>
    <tr>
      <td>Phone number : </td><td><input type="text" name="phone" value="<?php echo $doctor->getPhone(); ?>"></td>
    </tr>
        <tr>
      <td>Update Profile image:</td>
      <td><input type="file" name="image"></td>
    </tr>
    <tr><td><input type="submit" name="submit" value="Update profile"></td></tr>
  </table>
</form>  
</div>
</body>
</html>
