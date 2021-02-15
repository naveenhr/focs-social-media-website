<?php
	session_start();
	include 'include/dbconnect.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>login</title>
	<link rel="stylesheet" type="text/css" href="css/login.css">
</head>
<body>
	<div class="topnav">
		<a href="index.php"><logo>focs</logo></a>
	</div>
<center>	
<form method="post" action="">
	<div class="login-page" align="center">
		<h2>login</h2>
		<input type="text" name="email" id="email" placeholder="email"><br>
		<input type="password" name="password" id="password" placeholder="password"><br>
		<input type="submit" name="submit" id="login" value="login"><br>
		if you don't have an account <a href="index.php">create here</a> ...!!!
	</div>
	
</form>
</center>
</body>
</html>

<?php

if(isset($_POST['submit']))
{
	$username=$_POST['email'];
	$password=$_POST['password'];


 $sql="SELECT fname,mname,lname,email,password FROM profile WHERE email='$username' AND password='$password'";
 $result=$conn->query($sql);
 if ($result->num_rows > 0) {
 	while($row = $result->fetch_assoc()) {

 		$id=$row["email"];
 		$pass=$row["password"];
 		$fname=$row["fname"];
 	}	
 		if($username==$id and $password==$pass)
 		{
 			$_SESSION["id"]=$id;
 			$_SESSION["fname"]=$fname;
 			header("location:timeline.php");
 		}
    
 }
 else
 {
 	echo "<script>alert('email and password missmatching; try again');</script>";
 }
}

$conn->close();
?>