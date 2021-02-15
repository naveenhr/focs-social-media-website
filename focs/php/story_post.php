<?php
session_start();
include '../include/dbconnect.php';
if(isset($_POST['upload']))
{
	$user_id=$_SESSION['id'];
	$date=date("d/m/Y  h:i a");
	$caption=$_POST["caption"];
	$img=$_FILES['img']['name'];
	$target_file="../uploads/story/".basename($img);
	if(move_uploaded_file($_FILES['img']['tmp_name'], $target_file))
	{
		$sql="INSERT INTO stories(user_id,image,caption,upload_date,likes) VALUES('$user_id','$img','$caption','$date','0')";
		if($conn->query($sql) === TRUE)
		{
			$msg="image uploaded ;";
			#header("location:../timeline.php?Message={$msg}");
			header('Location: ' . $_SERVER['HTTP_REFERER']);
		}
		else
		{
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}
}

?>