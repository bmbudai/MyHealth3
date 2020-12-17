<?php

    require_once "config.php";

    $getProviders = "SELECT ProviderName n, ProviderId id FROM Providers";

    $getProviders = $link->prepare($getProviders);
    // Check connection
    if ($link->connect_error) {
      die("Connection failed: " . $link->connect_error);
    }
    $getProviders->execute();
    $getProviders->store_result();
    if ($getProviders->num_rows > 0) {
        $getProviders->bind_result(
          $provName,
          $provId
        );
        while ($getProviders->fetch()){
          echo '<option value="' . $provId . '">' . $provName . '</option>';
        }
    }
?>
