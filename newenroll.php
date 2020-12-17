<?php
session_start();
require_once "config.php";
$username = htmlspecialchars($_SESSION["name"]);

//Get the selected plan id from the enrollment.php page
$planid = $_POST["insplans"];

$query = "SELECT Company, Network FROM InsurancePlans where PlanId = ?";

$sql5 = $link->prepare($query);
$sql5->bind_param("d", $planid);

// Check connection
if ($link->connect_error) {
  die("Connection failed: " . $link->connect_error);
}

$sql5->execute();
$sql5->store_result();
if ($sql5->num_rows > 0) {
    $sql5->bind_result(
      $Company,
      $Network
    );

    $sql5->fetch();
}


#Get the id of currently logged in user
$unamequery = "SELECT id FROM Users where Username=?";
$sql6 = $link->prepare($unamequery);
$sql6->bind_param("s", $username);
// Check connection
if ($link->connect_error) {
  die("Connection failed: " . $link->connect_error);
}
$sql6->execute();
$sql6->store_result();
if ($sql6->num_rows > 0) {
    $sql6->bind_result(
      $UserId
    );
    $sql6->fetch();

}


//Check if user is already enrolled in a plan, if yes then update the row, if no then insert the row
$ce = "SELECT * FROM Enrolled where PatientId = ?";

$sql9 = $link->prepare($ce);
$sql9->bind_param("s", $UserId);

// Check connection
if ($link->connect_error) {
  die("Connection failed: " . $link->connect_error);
}
$sql9->execute();
$sql9->store_result();
if ($sql9->num_rows > 0) {
      $updatequery = "UPDATE Enrolled SET Company = ?, PlanId = ? WHERE PatientId = ?";
      $sql10 = $link->prepare($updatequery);
      $sql10->bind_param("sss", $Company, $planid, $UserId);
      $sql10->execute();

}
else {
  $insertquery = "INSERT INTO Enrolled (Company, PlanId, PatientId) VALUES (?,?,?)";
  $sql10 = $link->prepare($insertquery);
  $sql10->bind_param("sss", $Company, $planid, $UserId);
  $sql10->execute();
  }


header('Location: enrollment.php');

?>
