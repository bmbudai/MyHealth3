<?php

    require_once "config.php";

    $getPatients = "SELECT Name n, PatientId id FROM Patients";

    $getPatients = $link->prepare($getPatients);
    // Check connection
    if ($link->connect_error) {
      die("Connection failed: " . $link->connect_error);
    }
    $getPatients->execute();
    $getPatients->store_result();
    if ($getPatients->num_rows > 0) {
        $getPatients->bind_result(
          $patientName,
          $patientId
        );
        while ($getPatients->fetch()){
          echo '<option value="' . $patientId . '">' . $patientName . '</option>';
        }
    }
?>
