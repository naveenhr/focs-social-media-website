<?php
session_start();
include '../include/dbconnect.php';
if(isset($_POST['signin']))
{
	//header("location:http://localhost/focs/timeline.php");
	$username=$_POST['username'];
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
 			header("location:http:../timeline.php?id=$id");
 		}
    
 }
 else
 {
 	echo "<script type='text/javascript'>alert('email and password missmatching; try again');location.replace('../index.php')</script>";
 	#header("location:../index.php");
 }

}
if(isset($_POST['submit']))
{
	echo "submit button clicked";
	$fname=$_POST["firstname"];
	$mname=$_POST["middlename"];
	$lname=$_POST["lastname"];
	$email=$_POST["email"];
	$phone=$_POST["phno"];
	//$img=$_POST["img"];
	$password=$_POST["password1"];
	$password2=$_POST["password2"];
	$image = $_FILES['image']['name'];
	$target_dir ="../uploads/profile/";
	$filename =$_FILES['image']['tmp_name'];
	//$img_path = $_FILES['img']['name'];
	$target_file = $target_dir.basename($image);
	echo $target_file;
	echo $password." ".$password2;
	#move_uploaded_file($_FILES['image']['tmp_name'], $target_file)
	if(move_uploaded_file($_FILES['image']['tmp_name'], $target_file))
	{
		echo "image uploaded";

	if($password!=$password2)
	{
		echo "password not matched";
		header("location:http:../index.php");
		echo "<script>alert('password did not match!; enter again;');</script>";
		
	}
	else
	{
		$sql="INSERT INTO profile(fname,mname,lname,email,phn,profile_pic,password) VALUES('$fname','$mname','$lname','$email','$phone','$image','$password')";
		if ($conn->query($sql) === TRUE) 
		{
    		echo "<script type='text/javascript'>alert('Sign-up completed;Login to your Account;');location.replace('../login.php')</script>";
    		#echo "New record created successfully";
    		#header("location:../login.php");
		} 
		else 
		{
    		echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}
	}
}

	
$conn->close();
?>