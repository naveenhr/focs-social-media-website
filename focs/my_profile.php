<?php

	session_start();
	include 'include/dbconnect.php';
	$email=$_SESSION['id'];

?>

<!DOCTYPE html>
<html>
<head>
	<title>Profile</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/timeline.css">
	<script src="js/timeline.js"></script>
</head>
<body>
	<div class="topnav" >
		<a href="index.php"><logo>focs</logo></a>
		<div class="navbuttons">
			<a href="timeline.php" >Home</a>
			<a href="my_profile.php" active="enable">My_Profile</a>
			<a href="logout.php">Logout</a>
		</div>
	</div>
		<div class="profilecard" align="center">

		<?php
		$email=$_SESSION['id'];
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
		echo "<div class='friends'>";
		#echo "<h2>Friends</h2>";

			$sqlfl="SELECT COUNT(email) as count FROM profile WHERE (email in (SELECT friend_id FROM friends_list WHERE user_id='$email') or email in(select user_id FROM friends_list WHERE friend_id='$email'))";
			$res=$conn->query($sqlfl);
			if($res->num_rows>0)
			{
				while ($row=$res->fetch_assoc()) {

					$no_of_frnz=$row['count'];
					#$user_id=$row['fname'].$row['mname'].$row['lname'];
					#$request_id=$row['email'];
					#$img=$row['profile_pic'];
				/*echo "<div class='online' >
			<img src='uploads/profile/$img' id='online-profile-img'> <input type='hidden' name='request_id' value='$request_id'> <label id='user-id' >$user_id</label> 
			<a href='php/request.php?req_id=$request_id'><input type='button' id='view_profile' value='VIEW_PROFILE'></a>
			
		</div>";
				*/	
				}
				echo "<h4>Friends:".$no_of_frnz."</h4>";

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
			$sql="SELECT * FROM stories WHERE user_id='$email'";
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
				echo "<time>Uploaded in $date </time>  <likes>likes <b>$likes</b> </likes>";
				echo "<caption>caption:<i><b> $caption </b></i></caption><br><br>";
				echo "</div>";
				}
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

</body>
</html>