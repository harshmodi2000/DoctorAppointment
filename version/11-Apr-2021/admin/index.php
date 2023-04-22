<?php  
session_start();
if (!isset($_SESSION['userId'])||empty($_SESSION['userId'])) {
	die('Access Denied');
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin HOMEPAGE</title>
</head>
<body>
<nav>
	<ul>
		<li><a href="serviceManager.php">Manage service</a></li>
		<li><a href="doctorManager.php">Manage doctor</a></li>
		<li><a href="roleManager.php">Manage roles</a></li>
		<li><a href="scheduleManager.php">Manage Schedule</a></li>
	</ul>
</nav>
</body>
</html>