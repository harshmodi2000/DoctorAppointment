<?php  
session_start();
if (!isset($_SESSION['adminId'])||empty($_SESSION['adminId'])) {
	die('Access Denied');
}
require '../includes/mailer.include.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Doctor Registration</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include "header.php";?>
    <?php include "nav.html";?>
</head> 
<body>
<?php include "../login/doctorRegistration.php"; ?>
</body>
</html>