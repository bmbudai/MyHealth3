<?php

      require_once "config.php";

//Header that tells user if they are enrolled and who they are enrolled to
      $query = "SELECT e.Company, e.PlanId FROM Enrolled e
                             left join Patients p on p.PatientId = e.PatientId
                             left join Users u on u.id = e.PatientId
                             where u.username = ?";

      $sql2 = $link->prepare($query);
      $sql2->bind_param("s", $username);

      // Check connection
      if ($link->connect_error) {
        die("Connection failed: " . $link->connect_error);
      }
      $sql2->execute();
      $sql2->store_result();
      if ($sql2->num_rows > 0) {
          $sql2->bind_result(
            $Company,
            $PlanId
          );
          while ($sql2->fetch()){
            echo '<h3>Enrollment Status: You are enrolled in ' . $Company . ' Plan ID: ' . $PlanId . '</h3>';
          }
      } else { echo '<h3>Enrollment Status: You are not currently enrolled in an insurance plan.</h3>'; }



//Table of available insurance plans
      echo '<table class="w3-table-all w3-hoverable w3-card">
            <thead>
            <tr class="color1">
            <th>Company</th>
            <th>Network</th>
            <th>Annual Premium</th>
            <th>Annual Deductible</th>
            <th>Annual Coverage Limit</th>
            <th>Lifetime Limit</th>
            </tr>
            </thead>';

      $sql = $link->prepare('SELECT Company, Network, AnnualPremium, AnnualDeductible, AnnualCoverageLimit, LifetimeLimit, PlanId FROM InsurancePlans');


      // Check connection
      if ($link->connect_error) {
        die("Connection failed: " . $link->connect_error);
      }
      $sql->execute();
      $sql->store_result();
      if ($sql->num_rows > 0) {
          $sql->bind_result(
            $Company,
            $Network,
            $AnnualPremium,
            $AnnualDeductible,
            $AnnualCoverageLimit,
            $LifetimeLimit,
            $PlanId
          );
          while ($sql->fetch()){
            echo '<tr>
            <td>' . $Company . '</td>
            <td>' . $Network . '</td>
            <td>' . '$'. $AnnualPremium . '</td>
            <td>' . '$' . $AnnualDeductible . '</td>
            <td>' . '$' . $AnnualCoverageLimit . '</td>
            <td>' . '$' . $LifetimeLimit . '</td></tr>';
          }
      } else { echo '<tr><td>EMPTY</td><td>EMPTY</td><td>EMPTY</td><td>EMPTY</td><td>EMPTY</td><td>EMPTY</td></tr>'; }
      echo "</table>";



//dropdown for enrolling in plan

      echo '<br><br>
      <form action="newenroll.php" method="post">
      <label for="insplans">Choose an Insurance Plan:</label>

      <select name="insplans" id="insplans">';
      $sql->execute();
      $sql->store_result();
      while ($sql->fetch()){
      echo '<option value="' . $PlanId . '">' . $Company . '</option>';
      }
      echo '</select>
      <br><br>
      <input type="submit" value="Enroll">
      </form>';



      ?>
