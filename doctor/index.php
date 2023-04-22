<?php  
session_start();
if (!isset($_SESSION['doctorId'])||empty($_SESSION['doctorId'])) {
	die('Access Denied');
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Doctor HOMEPAGE</title>
<?php include "header.php"; ?>
</body>
</html>