<!DOCTYPE html>
<html lang="en">
<title>New Account - MyHealth</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="theme.css">
<style>
body,h1,h2,h3,h4,h5,h6 {font-family: "Lato", sans-serif}
.w3-bar,h1,button {font-family: "Montserrat", sans-serif}
.fa-anchor,.fa-coffee {font-size:200px}
</style>
<body>

<?php
session_start();
if ($_SESSION['usernameTaken']==TRUE) {
  $authFailModalShow = "style='display:block;'";
  $authFailReason = "The username '". $_SESSION['usernameAttempted'] ."' isn't available";
  $_SESSION['usernameTaken']=FALSE;
}
else if ($_SESSION['passDontMatch']==TRUE){
  $authFailModalShow = "style='display:block;'";
  $authFailReason = "Your passwords don't match";
  $_SESSION['passDontMatch']=FALSE;
}
else {
  $authFailModalShow = "style='display:none;'";
}
?>

<!-- Header -->
<header class="w3-container color1 w3-center" style="padding:128px 16px">
  <h1 class="w3-margin w3-jumbo">Nice to meet you!</h1>
  <!-- <p class="w3-xlarge">Template by w3.css</p> -->
</header>

<!--Modal for if creating account failed-->
<div id="authFailModal" class="w3-modal" <?php echo $authFailModalShow;?>>
  <div class="w3-modal-content w3-animate-zoom w3-card-4">
    <header class="w3-container color1">
      <span onclick="document.getElementById('authFailModal').style.display='none'"
      class="w3-button w3-display-topright">&times;</span>
      <h2>Registration Failed</h2>
    </header>
    <div class="w3-container">
      <p class="w3-xlarge"><?php echo $authFailReason;?></p>
    </div>
    <footer class="w3-container color1">
      <p></p>
    </footer>
  </div>
</div>


<!-- First Grid -->
<div class="w3-row-padding w3-padding-64 w3-container">
  <div class="w3-content">
    <div class="w3-container">
      <div class="w3-card-4">
        <div class="w3-container color1">
          <h2>Personal Information</h2>
        </div>

        <form class="w3-container" action="create-user.php" method="post">
          <input class="w3-input" placeholder="Username" name="username"  type="text" required>
          </p>
          <input class="w3-input" placeholder="First Name" name="firstname"  type="text" required>
          </p>
          <input class="w3-input" placeholder="Middle Name" name="middlename"  type="text">
          </p>
          <input class="w3-input" placeholder="Last Name" name="lastname"  type="text" required>
          </p>
          <input class="w3-input" type="date" name="dateofbirth" required>
          <label class="w3-text-grey">Date of Birth </label></p>
          <input class="w3-input" placeholder="Street Address" name="streetaddress"  type="text" required>
          </p>

          <div>
            <div class="w3-third">
              <input class="w3-input" placeholder="City" name="city"  type="text" required>
              </p>
            </div>
            <div class="w3-third w3-row-padding">
              <input class="w3-input" placeholder="State (e.g. ID)" name="state"  type="text" required>
              </p>
            </div>
            <div class="w3-third">
              <input class="w3-input" placeholder="ZIP" name="zip"  type="number" required>
              </p>
            </div>
          </div>

          <input class="w3-input" placeholder="Phone" name="phone"  type="tel" required>
          </p>
          <input class="w3-input" placeholder="Email" name="email"  type="email" required>
          </p>
          <input class="w3-input" placeholder="Employer" name="employer"  type="text">
          </p>
          <input class="w3-input" placeholder="Emergency Contact Name" name="emergencycontactname"  type="text" required>
          </p>
          <input class="w3-input" placeholder="Emergency Contact Phone" name="emergencycontactphone"  type="tel" required>
          </p>
          <input class="w3-input" placeholder="Password" name="password"  type="password" required>
          </p>
          <input class="w3-input" placeholder="Confirm Password" name="confirmpassword"  type="password" required>
          </p>
          <p>
          <button class="w3-button color1 w3-padding-large w3-large w3-margin-top" type="submit">Create Account</button>
          <a href="index.php" class="w3-button color1 w3-padding-large w3-large w3-margin-top">Use Existing Account</a>
        </form>
      </div>
    </div>

  </div>
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
</div>
-->
<div class="w3-container w3-black w3-center w3-opacity w3-padding-64">
  <h1 class="w3-margin w3-xlarge">&copy; Copyright 2020, Benjamin Budai and Joshua Tan</h1>
  <p>Powered by <a href="https://www.w3schools.com/w3css/default.asp" target="_blank">w3.css</a></p>
</div>

<!-- Footer -->
<!-- <footer class="w3-container w3-padding-64 w3-center w3-opacity">
</footer> -->

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
</script>

</body>
</html>