<?php

      require_once "config.php";

      //Determine if doctor or pharmacist is accessing the page
      //If user is a doctor
      if ($_SESSION['usertypeid'] == 2){

        //Print table header
        echo '<table class="w3-table-all w3-hoverable w3-card">
              <thead>
              <tr class="color1">
              <th>Date</th>
              <th>Patient Name</th>
              <th>Service</th>
              <th>Medication Prescribed</th>
              </tr>
              </thead>';

        $sql = $link->prepare('SELECT Date, Name, Service, DrugName FROM PatientRecords as PR natural join Providers as P natural join Drugs as D left join Patients PT on PT.PatientId = PR.PatientId order by Date desc;');

        // Check connection
        if ($link->connect_error) {
          die("Connection failed: " . $link->connect_error);
        }
        $sql->execute();
        $sql->store_result();
        if ($sql->num_rows > 0) {
            $sql->bind_result(
              $Date,
              $Name,
              $Service,
              $DrugName
            );
            while ($sql->fetch()){
              echo '<tr>
              <td>' . $Date . '</td>
              <td>' . $Name . '</td>
              <td>' . $Service . '</td>
              <td>' . $DrugName . '</td></tr>';
            }
        } else { echo '<tr><td>EMPTY</td><td>EMPTY</td><td>EMPTY</td><td>EMPTY</td></tr>'; }
        echo "</table>";

      }

      //If user is a pharmacist
      else if ($_SESSION['usertypeid'] == 3){

        //Print table header
        echo '<table class="w3-table-all w3-hoverable w3-card">
              <thead>
              <tr class="color1">
              <th>Date</th>
              <th>Patient Name</th>
              <th>Medication Prescribed</th>
              </tr>
              </thead>';

        $sql = $link->prepare('SELECT Date, Name, DrugName FROM PatientRecords as PR natural join Providers as P natural join Drugs as D left join Patients PT on PT.PatientId = PR.PatientId order by Date desc;');

        // Check connection
        if ($link->connect_error) {
          die("Connection failed: " . $link->connect_error);
        }
        $sql->execute();
        $sql->store_result();
        if ($sql->num_rows > 0) {
            $sql->bind_result(
              $Date,
              $Name,
              $DrugName
            );
            while ($sql->fetch()){
              echo '<tr>
              <td>' . $Date . '</td>
              <td>' . $Name . '</td>
              <td>' . $DrugName . '</td></tr>';
            }
        } else { echo '<tr><td>EMPTY</td><td>EMPTY</td><td>EMPTY</td></tr>'; }
        echo "</table>";
      }

      //If user is a insurance company rep
      else if ($_SESSION['usertypeid'] == 4){

        //Print table header
        echo '<table class="w3-table-all w3-hoverable w3-card">
              <thead>
              <tr class="color1">
              <th>Date</th>
              <th>Patient Name</th>
              <th>Service</th>
              <th>Medication Prescribed</th>
              </tr>
              </thead>';

        $sql = $link->prepare('SELECT Date, Name, Service, DrugName FROM PatientRecords as PR natural join Providers as P natural join Drugs as D left join Patients PT on PT.PatientId = PR.PatientId order by Date desc;');

        // Check connection
        if ($link->connect_error) {
          die("Connection failed: " . $link->connect_error);
        }
        $sql->execute();
        $sql->store_result();
        if ($sql->num_rows > 0) {
            $sql->bind_result(
              $Date,
              $Name,
              $Service,
              $DrugName
            );
            while ($sql->fetch()){
              echo '<tr>
              <td>' . $Date . '</td>
              <td>' . $Name . '</td>
              <td>' . $Service . '</td>
              <td>' . $DrugName . '</td></tr>';
            }
        } else { echo '<tr><td>EMPTY</td><td>EMPTY</td><td>EMPTY</td><td>EMPTY</td></tr>'; }
        echo "</table>";

      }

      else {
        echo "Access Denied.";
      }

      $link->close();

      ?>
