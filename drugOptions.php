<?php

    require_once "config.php";

    $getDrugs = "SELECT DrugName n, DrugId id, MedicalName mn FROM Drugs";

    $getDrugs = $link->prepare($getDrugs);
    // Check connection
    if ($link->connect_error) {
      die("Connection failed: " . $link->connect_error);
    }
    $getDrugs->execute();
    $getDrugs->store_result();
    if ($getDrugs->num_rows > 0) {
        $getDrugs->bind_result(
          $drugName,
          $drugId,
          $medicalName
        );
        while ($getDrugs->fetch()){
          echo '<option value="' . $drugId . '">' . $drugName . " (" . $medicalName . ') </option>';
        }
    }
?>
