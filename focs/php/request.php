<?php
			session_start();
			include '../include/dbconnect.php';
			$date=date("d/m/Y  h:i a");
			echo $_GET['req_id'];
			
				#echo "entered here";
				$email=$_SESSION['id'];
				$request_id=$_GET['req_id'];
				$sql1="INSERT INTO request_list(user_id,request_id,request_date) VALUES('$request_id','$email','$date')";
				$sql2="SELECT friend_id FROM friends_list WHERE user_id='$email' AND friend_id='$request_id'";
			#if(!empty($conn->query($sql2)))
			{
				if($conn->query($sql1))
				{
					echo "<script> alert('Requested');</script>";
					header("location:../timeline.php");
				}
				else
				{
					echo "Error: " . $sql . "<br>" . $conn->error;
				}
			}
			
?>