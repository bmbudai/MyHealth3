<?php

      require_once "config.php";

      echo '<table class="w3-table-all w3-hoverable w3-card">
            <thead>
            <tr class="color1">
            <th>Provider</th>
            <th>Service</th>
            <th>Date</th>
            <th>Cost to Insurance</th>
            <th>Cost to You</th>
            <th>Insurance Payment</th>
            <th>Your Payment</th>
            <th>Medication</th>
            </tr>
            </thead>';

      $sql = $link->prepare('SELECT ProviderName, Service, Date, CostToInsurance, CostToPatient, InsPayment, PatientPayment, DrugName FROM PatientRecords as PR natural join Providers as P natural join Drugs as D inner join Users as U on PR.PatientID = U.id where U.username=? order by Date desc;');
      $sql->bind_param('s', $username);

      // Check connection
      if ($link->connect_error) {
        die("Connection failed: " . $link->connect_error);
      }
      $sql->execute();
      $sql->store_result();
      if ($sql->num_rows > 0) {
          $sql->bind_result(
            $Provider,
            $Service,
            $Date,
            $CostToIns,
            $CostToPatient,
            $InsPayment,
            $PatientPayment,
            $DrugName
          );
          while ($sql->fetch()){
            echo '<tr>
            <td>' . $Provider . '</td>
            <td>' . $Service . '</td>
            <td>' . $Date . '</td>
            <td>' . '$' . $CostToIns . '</td>
            <td>' . '$' . $CostToPatient . '</td>
            <td>' . '$' . $InsPayment . '</td>
            <td>' . '$' . $PatientPayment . '</td>
            <td>' . $DrugName . '</td></tr>';
          }
      } else { echo '<tr><td>EMPTY</td><td>EMPTY</td><td>EMPTY</td><td>EMPTY</td><td>EMPTY</td><td>EMPTY</td><td>EMPTY</td><td>EMPTY</td></tr>'; }
      echo "</table>";
      $link->close();
      ?>
