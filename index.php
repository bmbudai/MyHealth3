<?php
  session_start();
  if ($_SESSION['nouser']==TRUE) {
    $authFailModalShow = "display:block";
    $authFailReason = "There is no user with that username";
    $_SESSION['nouser']=FALSE;
  }
  else if ($_SESSION['badpassword']==TRUE){
    $authFailModalShow = "display:block";
    $authFailReason = "Your password is incorrect";
    $_SESSION['badpassword']=FALSE;
  }
  else {
    $authFailModalShow = "display:none";
  }
?>

<!DOCTYPE html>
<html lang="en">
<title>Login - MyHealth</title>
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



<!-- Header -->
<header class="w3-container color1 w3-center" style="padding:128px 16px">
  <h1 class="w3-margin w3-jumbo">Welcome to MyHealth!</h1>
  <p class="w3-xlarge">Login to get started, or create an account.</p>
</header>

<!--Modal for if auth failed-->
<div id="authFailModal" class="w3-modal" style="<?php echo $authFailModalShow;?>">
  <div class="w3-modal-content w3-animate-zoom w3-card-4">
    <header class="w3-container color1">
      <span onclick="document.getElementById('authFailModal').style.display='none'"
      class="w3-button w3-display-topright">&times;</span>
      <h2>Authentication Failed</h2>
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
            <h2>Log In</h2>
          </div>

          <form class="w3-container" action="authenticate.php" method="post">
            <p>
            <label for="username">
            </label>
            <input class="w3-input" type="text" name="username" placeholder="Username" id="username" required>
            <p>
            <label for="password">
            </label>
            <p>
            <input class="w3-input" type="password" name="password" placeholder="Password" id="password" required>
            <input class="w3-button color1 w3-padding-large w3-large w3-margin-top" type="submit" value="Login">
            <a href="create-account.php" class="w3-button color1 w3-padding-large w3-large w3-margin-top">Create Account</a>
            <p>
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
</script>

</body>
</html>
