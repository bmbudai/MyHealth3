<?php
  session_start();
  if (!isset($_SESSION['loggedin'])) {
    header('Location: index.php');
    $hideNotLoggedIn = "display:none;";

    exit;
  }
  else {
    $username = htmlspecialchars($_SESSION["name"]);
    $hideNotLoggedIn = " ";
  }

  if ($_SESSION['usertypeid'] == 1){
    $displaypatientrecords = "none";
  }
  else{
    $displaypatientrecords = "block";
  }
?>

<!DOCTYPE html>
<html lang="en">
<title>Dashboard - MyHealth</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
<script src="https://kit.fontawesome.com/02c7279755.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="theme.css">
<style>
body,h1,h2,h3,h4,h5,h6 {font-family: "Lato", sans-serif}
.w3-bar,h1,button {font-family: "Montserrat", sans-serif}
.fa-anchor,.fa-coffee {font-size:200px}
</style>
<body>


<!-- Navbar -->
<div class="w3-top">
  <div class="w3-bar color1 w3-card w3-left-align w3-large">
    <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large color1" href="javascript:void(0);" onclick="myFunction()" title="Toggle Navigation Menu"><i class="fa fa-bars"></i></a>
    <a href="landing.php" class="w3-bar-item w3-button w3-padding-large w3-white">Home</a>
    <a href="enrollment.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Enroll</a>
    <a href="records.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Records</a>
    <a href="#" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">TBA</a>
    <a href="credits.html" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Credits</a>
    <button id="profile-button" class="w3-bar-item w3-button w3-padding-large w3-right" style="<?php echo $hideNotLoggedIn;?>" onclick="profileButtons()" title="Manage your account"> Profile</button>
  </div>

  <div id="profileMenu" class="w3-right w3-quarter w3-bar-block w3-white w3-hide w3-large">
    <a href="logout.php" class="w3-bar-item w3-button w3-padding-large">Sign Out</a>
    <a href="profilepage.php" class="w3-bar-item w3-button w3-padding-large">Account Info</a>
  </div>

  <!-- Navbar on small screens -->
  <div id="navDemo" class="w3-bar-block w3-white w3-hide w3-hide-large w3-hide-medium w3-large">
    <a href="landing.php" class="w3-bar-item w3-button w3-padding-large">Link 1</a>
    <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 2</a>
    <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 3</a>
    <a href="credits.html" class="w3-bar-item w3-button w3-padding-large">Credits</a>
  </div>
</div>

<!-- Header -->
<header class="w3-container color1 w3-center" style="padding:128px 16px">
  <h1 class="w3-margin w3-jumbo">Welcome Back, <b><?php echo $username; ?></b>!</h1>
</header>

<!-- First Grid -->
<div class="w3-row-padding w3-center w3-margin">
  <!-- <div class="w3-content"> -->
    <div class="w3-quarter w3-margin-top">
      <div class="w3-card-4" onclick="location.href='records.php';" style="cursor: pointer;">
         <div class=" w3-container w3-hover-light-gray w3-hover-text-green">
            <h2>Records</h2>
            <i class="fa fa-receipt fa-9x w3-padding-64 w3-margin-right"></i>
         </div>
      </div>
   </div>
    <div class="w3-quarter w3-margin-top">
      <div class="w3-card-4">
         <div class=" w3-container w3-hover-light-gray w3-hover-text-green">
            <h2>Prescriptions</h2>
            <i class="fa fa-pills fa-9x w3-padding-64 w3-margin-right"></i>
         </div>
      </div>
   </div>
    <div class="w3-quarter w3-margin-top">
      <div class="w3-card-4" onclick="location.href='enrollment.php';" style="cursor: pointer;">
         <div class=" w3-container w3-hover-light-gray w3-hover-text-green">
            <h2>Enroll</h2>
            <i class="fa fa-hand-holding-medical fa-9x w3-padding-64 w3-margin-right"></i>
         </div>
      </div>
   </div>
   <div class="w3-quarter w3-margin-top">
     <div class="w3-card-4" onclick="location.href='patientrecords.php';" style="cursor: pointer; display: <?php echo $displaypatientrecords;?>;">
        <div class=" w3-container w3-hover-light-gray w3-hover-text-green">
           <h2>Patient Records</h2>
           <i class="fa fa-receipt fa-9x w3-padding-64 w3-margin-right"></i>
        </div>
     </div>
  </div>
     </div>
  </div>

  <!-- </div> -->
</div>

<!-- Second Grid -->
<!-- <div class="w3-row-padding w3-light-grey w3-padding-64 w3-container">
  <div class="w3-content">
    <div class="w3-third w3-center">
      <i class="fa fa-coffee w3-padding-64 text-color1 w3-margin-right"></i>
    </div>

    <div class="w3-twothird">
      <h1>Lorem Ipsum</h1>
      <h5 class="w3-padding-32">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</h5>

      <p class="w3-text-grey">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Excepteur sint
        occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
        laboris nisi ut aliquip ex ea commodo consequat.</p>
    </div>
  </div>
</div> -->

<div class="w3-container w3-black w3-center w3-opacity w3-padding-64">
    <h1 class="w3-margin w3-xlarge">&copy; Copyright 2020, Benjamin Budai and Joshua Tan</h1>
    <p>Powered by <a href="https://www.w3schools.com/w3css/default.asp" target="_blank">w3.css</a></p>
</div>

<script>
// Used to toggle the menu on small screens when clicking on the menu button
function myFunction() {
  var x = document.getElementById("navDemo");
  if (x.className.indexOf("w3-show") == -1) {
    x.className += " w3-show";
  } else {
    x.className = x.className.replace(" w3-show", "");
  }
}

function profileButtons() {
  var x = document.getElementById("profileMenu");
  if (x.className.indexOf("w3-show") == -1) {
    x.className += " w3-show";
  } else {
    x.className = x.className.replace(" w3-show", "");
  }
}
</script>

</body>
</html>
