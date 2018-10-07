<html>
<body>
<?php
session_start();
if(isset($_SESSION['USRNAME']))
{
	echo "<h2>Welcome  " .$_SESSION['USRNAME'] ."</h2>";
}
else
{
	header('location: login.php');
}
?>
<br>
<a href="login.php">sign Out</a>
</body>

</html>