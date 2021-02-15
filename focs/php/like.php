<?php
session_start();
$img_id=$_GET['img_id'];
$user_id=$_SESSION['id'];
echo $user_id."<br>".$img_id;
include '../include/dbconnect.php';
$sql1="SELECT * FROM likes_track Where user_id='$user_id' and img_id='$img_id'";
$result=$conn->query($sql1);
if($result->num_rows<=0)
{
	$sql2="UPDATE stories set likes=likes+1 Where image='$img_id'";
	$conn->query($sql2);
	$sql3="INSERT INTO likes_track(user_id,img_id) VALUES('$user_id','$img_id')";
	$conn->query($sql3);
	#header("location:../timeline.php");
	header('Location: ' . $_SERVER['HTTP_REFERER']);
}
else
{
	#header("location:../timeline.php");
	header('Location: ' . $_SERVER['HTTP_REFERER']);
}

?>