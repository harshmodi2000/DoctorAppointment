<?php  
session_start();
if (!isset($_SESSION['userId'])||empty($_SESSION['userId'])) {
	die('Access Denied');
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Doctor HOMEPAGE</title>
</head>
<body>
<nav>
	<ul>
		<li><a href="account.php">Manage Account</a></li>
	</ul>
</nav>
</body>
</html>