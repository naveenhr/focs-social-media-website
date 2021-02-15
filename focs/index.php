
<!DOCTYPE html> 
<html>
<head>
	<title> Forum of Computer Scince </title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="css/navigation.css">
</head>
<body>
<form method="POST" action="php/index.php" enctype="multipart/form-data">
<div class="topnav">
	<logo>focs</logo>
	<input type="submit" id="signin" name="signin" value="sign_in">
	<input type="password" id="password" name="password" placeholder="password">
	<input type="text" id="username" name="username" placeholder="email/phno">
</div>
<div class="regform" align="center">
	<h1 align="middle">Sign Up</h1>
	<input type="text" name="firstname" id="firstname" placeholder="* firstname"><br>
	<input type="text" name="middlename" id="middlename" placeholder="middlename"><br>
	<input type="text" name="lastname" id="lastname" placeholder="* lastname"><br>
	<input type="text" name="email" id="email" placeholder="* e-mail"><br>
	<input type="text" name="phno" id="phno" placeholder="* phone number"><br>
	<input type="file" name="image" id="profile_img" accept="image/*"><br>
	<input type="password" name="password1" id="password1" placeholder="create password"><br>
	<input type="password" name="password2" id="password2" placeholder="confirm password"><br>
	<input type="submit" name="submit" id="submit"value="confirm">

</div>
</form>
<div class="slideshow-container">

<div class="mySlides fade">
  <div class="numbertext">1 / 5</div>
  <img src="icon/slide1.jpeg" style="width:100%">
  <div class="text">Caption Text</div>
</div>

<div class="mySlides fade">
  <div class="numbertext">2 / 5</div>
  <img src="icon/slide2.jpg" style="width:100%">
  <div class="text">Caption Two</div>
</div>

<div class="mySlides fade">
  <div class="numbertext">3 / 5</div>
  <img src="icon/slide3.png" style="width:100%">
  <div class="text">Caption Three</div>
</div>
<div class="mySlides fade">
  <div class="numbertext">4 / 5</div>
  <img src="icon/slide4.png" style="width:100%">
  <div class="text">Caption Three</div>
</div>
<div class="mySlides fade">
  <div class="numbertext">5 / 5</div>
  <img src="icon/slide5.jpg" style="width:100%">
  <div class="text">Caption Three</div>
</div>
<div style="text-align:center">
  <span class="dot"></span> 
  <span class="dot"></span> 
  <span class="dot"></span> 
  <span class="dot"></span> 
  <span class="dot"></span> 
</div>

</div>


<script>
var slideIndex = 0;
showSlides();

function showSlides() {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("dot");
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";  
  }
  slideIndex++;
  if (slideIndex > slides.length) {slideIndex = 1}    
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " active";
  setTimeout(showSlides, 2000); // Change image every 2 seconds
}
</script>


</body>
</html>