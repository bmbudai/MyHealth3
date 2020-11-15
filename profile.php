<?php

      require_once "config.php";

      echo '<table class="w3-table-all w3-hoverable w3-card">
            <thead>
            <tr class="color1">
            <th>Username</th>
            <th>Name</th>
            <th>Date of Birth</th>
            <th>Address</th>
            <th>Employer</th>
            <th>Emergency Contact</th>
            <th>Emergency Contact Phone</th>
            <th>Phone</th>
            <th>Email</th>
            </tr>
            </thead>';

      $sql = $link->prepare('SELECT username, Name, DateOfBirth, Address, EmployerName, EmergencyContactName, EmergencyContactTelNo, PatientTelNo, PatientEmail FROM Users U inner join Patients P on P.PatientId = U.id where U.username = ?;');
      $sql->bind_param('s', $username);

      // Check connection
      if ($link->connect_error) {
        die("Connection failed: " . $link->connect_error);
      }
      $sql->execute();
      $sql->store_result();
      if ($sql->num_rows > 0) {
          $sql->bind_result(
            $username,
            $Name,
            $DateOfBirth,
            $Address,
            $EmployerName,
            $EmergencyContactName,
            $EmergencyContactTelNo,
            $PatientTelNo,
            $PatientEmail
          );
          $sql->fetch();
            echo '<tr>
            <td>' . $username . '</td>
            <td>' . $Name . '</td>
            <td>' . $DateOfBirth . '</td>
            <td>' . $Address . '</td>
            <td>' . $EmployerName . '</td>
            <td>' . $EmergencyContactName . '</td>
            <td>' . $EmergencyContactTelNo . '</td>
            <td>' . $PatientTelNo . '</td>
            <td>' . $PatientEmail . '</td></tr>';
      } else { echo '<tr><td>EMPTY</td><td>EMPTY</td><td>EMPTY</td><td>EMPTY</td><td>EMPTY</td><td>EMPTY</td><td>EMPTY</td><td>EMPTY</td><td>EMPTY</td></tr>'; }
      echo "</table>";
      $link->close();
      ?>