<?php
	session_start();
	include 'include/dbconnect.php';
	#echo $_SESSION["id"]."<br>";
	#echo $_SESSION["fname"];
	if(isset($_GET["Message"]))
	{
		$msg=$_GET["Message"];
		echo "<script>alert('$msg');</script>";
	}
	$email=$_SESSION["id"];
	#echo date("d/m/Y  h:i a");
	if(empty($_SESSION["id"]))
	{
		header("location:login.php");
	}

?>
<!DOCTYPE html>
<html>
<head>
	<title>timeline</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/timeline.css">
	<script src="js/timeline.js"></script>
</head>
<body>
	<div class="topnav" >
		<a href="index.php"><logo>focs</logo></a>
		<div class="navbuttons">
			<a href="timeline.php" active="enable">Home</a>
			<a href="my_profile.php">My_Profile</a>
			<a href="logout.php">Logout</a>
		</div>
	</div>

	<div>

	<div class="profilecard" align="center">

		<?php
		$sql="SELECT * FROM profile WHERE email='$email'";
		$result=$conn->query($sql);
		if ($result->num_rows > 0) 
		{
 			while($row = $result->fetch_assoc()) 
 			{

 				$id=$row["email"];
 				$img=$row["profile_pic"];
 				$fname=$row["fname"];
 				$mname=$row["mname"];
 				$lname=$row["lname"];
 				$phn=$row["phn"];
 				$profileimage="uploads/profile/".$img;
 			}	
 		}
 		echo "<img src='$profileimage' class='profileimage' align='center'>";
		echo "<h4>"."@".$fname."_".$mname."_".$lname."</h4>";
		echo "<h4>email: ".$id."</h4>";
		echo "<h4>Phone :".$phn."</h4>";
		echo "<h2>Friends</h2>";
		echo "<div class='friends'>";
			$sqlfl="SELECT * FROM profile WHERE email in (SELECT friend_id FROM friends_list WHERE user_id='$email') or email in (SELECT user_id FROM friends_list WHERE friend_id='$email')";
			$res=$conn->query($sqlfl);
			if($res->num_rows>0)
			{
				while ($row=$res->fetch_assoc()) {

					$user_id=$row['fname'].$row['mname'].$row['lname'];
					$request_id=$row['email'];
					$img=$row['profile_pic'];
				echo "<div class='online' >
			<img src='uploads/profile/$img' id='online-profile-img'> <input type='hidden' name='request_id' value='$request_id'> <label id='user-id' >$user_id</label> 
			<a href='profile.php?req_id=$request_id'><input type='button' id='view_profile' value='VIEW_PROFILE'></a>
			
		</div>";
					
				}
			}



		echo "</div>";

 		?>

	</div>
	<div class="timeline" align="center">

		 <!-- Trigger/Open The Modal -->
		<button id="myBtn" onclick="uploadmodal()" class="imgmodal">Upload Image</button><br>

		<!-- The Modal -->
		<div id="myModal" class="modal">

		<form method="POST" action="php/story_post.php" enctype="multipart/form-data">

  		<!-- Modal content -->
  		<div class="modal-content">
    		<span class="close">&times;</span>
    		Upload Image : <input type="file" name="img" accept="image/*" id="imgselect"><br> 
    		<textarea rows="1" cols="60" class="story" placeholder="write image caption" name="caption"></textarea><br>
    		<input type="submit" id="Upload" name="upload" value="Upload">
		
  		</div>
  		</form>
		</div> 

		<div class="news">
			<?php
			$sql="SELECT * FROM stories WHERE (user_id in (SELECT friend_id FROM friends_list WHERE user_id='$email') or user_id in (SELECT user_id FROM friends_list WHERE friend_id='$email') or user_id='$email') ORDER BY upload_date desc";

			$result=$conn->query($sql);
			#echo $result;
			if ($result->num_rows > 0) 
			{
			 	# code...
			 	while($row = $result->fetch_assoc())
			 	{

			 		
			 		$caption=$row["caption"];
			 		$img=$row["image"];
			 		$date=$row["upload_date"];
			 		$likes=$row["likes"];
			 		$user_id=$row['user_id'];
			 		#echo $img;
			 		$sql1="SELECT * FROM profile WHERE email='$user_id'";
			 		$result1=$conn->query($sql1);
			if ($result1->num_rows > 0) 
			{
				while($row = $result1->fetch_assoc())
			 	{
			 		$user_name=$row["fname"].$row["mname"]." ".$row["lname"];
			 echo "<div class='poster'>";
				echo "<br><header float='left'>$user_name</header><br>";
				echo "<img src='uploads/story/$img' class='newsimage'><br>";
				echo "<a href='php/like.php?img_id=$img'><img class='likeicon' src='icon/like_icon.png'></a><br>";
				echo "<time>Uploaded in $date </time>  <likes><b>likes $likes </b></likes>";
				echo "<caption>caption:<i><b> $caption </b></i></caption><br><br>";

			echo "</div>";
				}
			}
			else
			{
				echo "<h2>Your timeline seems empty..!! Upload Your Memorable Movements Here...</h2>";
			}
			 } 
			}
			else
			{
				echo "<h2>Your timeline seems empty..!! Upload Your Memorable Movements Here...</h2>";
			}
			?>
		</div>
	</div>

	<div class="chatroom">
		<center>
		<div class="online-header" align="center"><h2>Suggestion</h2></div>
		</center>
		<?php 
		

			$sql="SELECT * FROM profile WHERE (email NOT IN(SELECT email FROM profile WHERE(email IN(SELECT user_id FROM friends_list WHERE friend_id='$email') OR email IN(SELECT friend_id FROM friends_list WHERE user_id='$email'))) AND email NOT IN (SELECT user_id FROM request_list WHERE request_id='$email')) AND (email NOT IN (SELECT request_id FROM request_list WHERE user_id='$email'))";
			$sql3="SELECT email FROM profile WHERE(email IN(SELECT user_id FROM friends_list WHERE friend_id='$email') OR email IN(SELECT friend_id FROM friends_list WHERE user_id='$email'))";
			$result3=$conn->query($sql3);
			$result=$conn->query($sql);
			if($result3->num_rows>0)
			{
				while ($row3=$result3->fetch_assoc()) {
					#echo $row3['email'];
					$f_id=$row3['email'];
					}
			}
				if($result->num_rows>0)
			{
				while ($row=$result->fetch_assoc()) {
					$user_id=$row['fname'].$row['mname'].$row['lname'];
					$request_id=$row['email'];
					$img=$row['profile_pic'];
					if($request_id!=$email)
				echo "<div class='online' >
			<img src='uploads/profile/$img' id='online-profile-img'> <input type='hidden' name='request_id' value='$request_id'> <label id='user-id' >$user_id</label> 
			<a href='php/request.php?req_id=$request_id'><input type='button' id='request' value='REQUEST'></a>
			
		</div>";
			
				}
			}
			
		?>
		<center>
		<div class="online-header" align="center"><h2>REQUESTS</h2></div>
		</center>
		<div>
			<?php 
		

			$sql="SELECT * FROM profile WHERE email in (SELECT request_id FROM request_list WHERE user_id='$email')";
			$result=$conn->query($sql);
			if($result->num_rows>0)
			{
				$i=1;
				while ($row=$result->fetch_assoc()) {
					$user_id=$row['fname'].$row['mname'].$row['lname'];
					$request_id=$row['email'];
					$img=$row['profile_pic'];
				echo "<div class='online'>
			<img src='uploads/profile/$img' id='online-profile-img'> <input type='hidden' name='request_id' value='$request_id'> <label id='user-id'>$user_id</label> 
			<a href='php/accept.php?req_id=$request_id'><input type='button' id='accept' value='ACCEPT'></a>
			
		</div>";
				$i=$i+1;
				}
			}
		?>
		</div>

		
	</div>

	</div>

</body>
</html>

<?php
			#$date=date("d/m/Y  h:i a");
			#echo $request_id." ".$email." ".$date;
			
?>
