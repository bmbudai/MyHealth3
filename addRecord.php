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
?>

<!DOCTYPE html>
<html lang="en">
<title>Add Record - MyHealth</title>
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

<?php
session_start();
if ($_SESSION['addRecordFail']==TRUE) {
  $authFailReason = htmlspecialchars($_SESSION['failReason']);
  $authFailModalShow = "style='display:block;'";
  $_SESSION['addRecordFail']=FALSE;
}
else {
  $authFailModalShow = "style='display:none;'";
}
?>

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
  <h1 class="w3-margin w3-jumbo">Add A Service Record</h1>
</header>


<!--Modal for if creating a record failed-->
<div id="authFailModal" class="w3-modal" <?php echo $authFailModalShow;?>>
  <div class="w3-modal-content w3-animate-zoom w3-card-4">
    <header class="w3-container color1">
      <span onclick="document.getElementById('authFailModal').style.display='none'"
      class="w3-button w3-display-topright">&times;</span>
      <h2>Failed to Create Record</h2>
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
          <h2>Record Details</h2>
        </div>

        <form class="w3-container" action="insertRecord.php" method="post">
          </p>
          <select class="w3-select" name="patient" required>
            <option value="" disabled selected>Patient</option>
            <?php include "patientOptions.php"?>
          </select>
          </p>
          <select class="w3-select" name="provider" required>
            <option value="" disabled selected>Provider</option>
            <?php include "providerOptions.php"?>
          </select>
          </p>
          <textarea class="w3-input" placeholder="Service" name="service" rows="1" maxlength="100"></textarea>
          </p>
          <input class="w3-input" type="date" name="servicedate" required>
          <label class="w3-text-grey">Service Date</label></p>
          </p>

          <div>
            <div class="w3-quarter w3-row-padding">
              <input class="w3-input" placeholder="Cost to Insurance" name="inscost"  type="number" required>
              </p>
            </div>
            <div class="w3-quarter">
              <input class="w3-input" placeholder="Cost to Patient" name="patcost"  type="number" required>
              </p>
            </div>
            <div class="w3-quarter w3-row-padding">
              <input class="w3-input" placeholder="Insurance Payment" name="inspayment"  type="number" required>
              </p>
            </div>
            <div class="w3-quarter">
              <input class="w3-input" placeholder="Patient Payment" name="patpayment"  type="number" required>
              </p>
            </div>
          </div>

          <select class="w3-select" name="drug" required>
            <option value="" disabled selected>Medication Prescribed</option>
            <?php include "drugOptions.php"?>
          </select>
          </p>
          <p>
          <button class="w3-button color1 w3-padding-large w3-large w3-margin-top" type="submit">Create Record</button>
          <a href="patientrecords.php" class="w3-button color1 w3-padding-large w3-large w3-margin-top">Cancel</a>
        </form>
      </div>
    </div>

  </div>
</div>









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
