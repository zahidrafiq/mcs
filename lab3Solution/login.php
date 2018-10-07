<?php
/*
Point to understand
Why client side validation?
Why Server side validation?
Why we use 'id' and 'name'?
Why we have used SESSION ?
Why we set $_SESSION['USRNAME'] it to null in login.php at line 5 ?
*/
?>




<html>
<head></head>
<?php
session_start();
	$_SESSION['USRNAME']=null;               // Check why We set it to null? 
	if(isset($_POST['btnLogin'])==true)
	{	
	    $name=$_POST['txtName'];             //Getting Name on server side entered by user.
		$passwd=$_POST['txtPwd'];
		if($name=='' || $passwd=='')         //Server side validation
			echo "<h3 style='color:red'>Enter username and password (Server side validation) </h3>";
		else
		{
			//Connecting to database
			$servername = "localhost";
			$username = "root";
			$password = "";
			$dbname = "lab3";   //Name of database you have created
			$conn = mysqli_connect($servername, $username, $password,$dbname);
			if (!$conn) {
				die("Connection failed: " . mysqli_connect_error());
			}
			
			//Getting data from database
			$sql = "SELECT * FROM users Where usrName="."'".$name."'"." AND usrPassword="."'".$passwd."'";
			$result = mysqli_query($conn, $sql);
			$recordsFound = mysqli_num_rows($result); //To get number of records returned from database			
			
			if ($recordsFound > 0)  //It will be true for valid user. 
			{
			  $_SESSION['USRNAME'] = $name;
			  header('location: home.php');   //To redirect to home.php
			}
			else
			{
				echo "<h3 style='color:red'>Invalid username or password</h3>";
			}
		}
	}
?>

<script>
// For client side validation.
function validate()
{
	document.getElementById("btnLogin").onclick=function(){
		var name=document.getElementById("txtName").value;
		var pwd=document.getElementById("txtPwd").value;
		if(name=='' || pwd=='')
		alert("Enter username and password");
	}
}
</script>
<body onload=validate();>

<form method="post" action="#">
User Name:<input type="text" id="txtName" name="txtName"/></br></br>
Password:<input type="password" id="txtPwd" name="txtPwd"/></br></br>
<input type="submit" id="btnLogin" name="btnLogin"/>
</form>

</body>



</html>