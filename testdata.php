<?php

      require_once "config.php";

      echo '<table class="w3-table-all w3-hoverable w3-card">
            <thead>
            <tr class="color1">
            <th>Id</th>
            <th>Username</th>
            <th>Password</th>
            </tr>
            </thead>';
      // $conn = mysqli_connect("192.168.0.14", "myhealth3", "myhealthPass", "testdb");

      $sql = "SELECT id, username, password FROM Users;";
      // if($stmt = mysqli_prepare($link, $sql)){
      //       if(mysqli_stmt_execute($stmt)){
      //             // Store result
      //             mysqli_stmt_store_result($stmt);
      //       }
      // }
      // Check connection
      if ($link->connect_error) {
      die("Connection failed: " . $link->connect_error);
      }
      $result = $link->query($sql);
      if ($result->num_rows > 0) {
      // output data of each row
            while($row = $result->fetch_assoc()) {
                  echo '<tr><td>' . $row['id']. '</td><td>' . $row['username'] . '</td><td>'
                  . $row['password']. '</td></tr>';
            }
      } else { echo '<tr><td>EMPTY</td><td>EMPTY</td><td>EMPTY</td></tr>'; }
      echo "</table>";
      $link->close();
      ?>