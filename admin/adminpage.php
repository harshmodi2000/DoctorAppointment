<?php  
session_start();
if (!isset($_SESSION['adminId'])||empty($_SESSION['adminId'])) {
	die('Access Denied');
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin HOMEPAGE</title>
<?php 
include "header.php"; 
?>
    </head>
    <body>
    <? include "nav.html";?>
        <h3 class="text-center mt-5">Welcome Admin</h3>
</body>
</html>