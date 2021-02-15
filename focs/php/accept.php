<?php
			session_start();
			include '../include/dbconnect.php';
			$date=date("d/m/Y  h:i a");
			#echo $_GET['req_id'];
			
				#echo "entered here";
				$email=$_SESSION['id'];
				$request_id=$_GET['req_id'];
				$sql1="INSERT INTO friends_list(user_id,friend_id,confirmed_date) VALUES('$email','$request_id','$date')";
				if($conn->query($sql1))
				{
					$sql2="DELETE FROM request_list where user_id='$email' and request_id='$request_id'";
					$conn->query($sql2);
					echo "<script> alert('Accepted');</script>";
					header("location:../timeline.php");
				}
				else
				{
				
					echo "Error: " . $sql1 . "<br>" . $conn->error."<br>";
					sleep(5);
					echo "<script type='text/javascript'>location.replace('../timeline.php')</script>";
					
				}
			
?>