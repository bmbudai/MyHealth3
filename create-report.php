<?php
    session_start();

    if (!isset($_SESSION['loggedin'])) {
      header('Location: index.php');
      $hideNotLoggedIn = "display:none;";

      exit('I failed for some reason.');
    }
    else {
      $username = htmlspecialchars($_SESSION["name"]);
      $hideNotLoggedIn = " ";
    }

    if ( !isset($_POST['startdate'], $_POST['enddate']) ) {
        // Could not get the data that should have been sent.
        exit('Invalid action, please try something else.');
    }

    include_once "config.php";

    //Set up vars with the dates
    $startDate = trim($_POST['startdate']);
    $endDate = trim($_POST['enddate']);
    $curDate = date('Y-m-d');

    //Make sure the dates are valid, kicking the user back if they aren't
    if($startDate > $curDate) {
        $_SESSION['invalidstartdate'] = TRUE;
        header('Location: report.php');
    }
    else if($endDate > $curDate) {
        $_SESSION['invalidenddate'] = TRUE;
        header('Location: report.php');
    }
    else if($startDate > $endDate) {
        $_SESSION['invalidenddate'] = TRUE;
        header('Location: report.php');
    }

    //Get the user's full name for use in the report
    $getName = $link->prepare('SELECT Name FROM Users U inner join Patients P on P.PatientId = U.id where U.username = ?;');
    $getName->bind_param('s', $username);

    // Check connection
    if ($link->connect_error) {
      die("Connection failed: " . $link->connect_error);
    }
    $getName->execute();
    $getName->store_result();
    if ($getName->num_rows > 0) {
        $getName->bind_result(
          $Name
        );
        $getName->fetch();
          $fullname = $Name;
    } else { $fullname = "Patient"; }

    //Prepare query to generate report
    $sql = $link->prepare('SELECT ProviderName, Service, Date, CostToInsurance, CostToPatient, InsPayment, PatientPayment, DrugName FROM PatientRecords as PR natural join Providers as P natural join Drugs as D inner join Users as U on PR.PatientID = U.id where Date>=? and Date<=? and U.username=? order by Date desc;');
    $sql->bind_param('sss', $startDate, $endDate, $username);

    // Check connection
    if ($link->connect_error) {
      die("Connection failed: " . $link->connect_error);
    }

    //Set up a file with the report and let the user download it
    $boldline = "\n===============================================================\n";
    $thinline = "\n---------------------------------------------------------------\n";
    $dotline = "\n...............................................................\n";

    $grandTotalPatient = 0.00;
    $grandTotalInsurance = 0.00;


    header('Content-type: text/plain');
    header('Content-Disposition: attachment; filename="report-' . $curDate . '.txt"');

    //Not using $boldline so that this will be right at the top instead of with a \n
    echo "===============================================================\n";
    echo "\n";
    echo $fullname . " MyHealth Report - " . $curDate;
    echo "\n";
    echo "Report Date Range: " . $startDate . " - " . $endDate;
    echo "\n";
    echo $boldline;
    // echo "\n";
    // echo $thinline;
    echo "\n";

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
            echo "\n";
            echo $Date;
            echo $dotline;

            echo "\nService \"" . $Service . "\" was provided by " . $Provider . "\n\n";

            echo "Cost to Insurance:  . . . . . . .$" . $CostToIns . "\n";
            echo "Cost to Patient:  . . . . . . . .$" . $CostToPatient . "\n";
            echo "Amount Paid by Insurance: . . . .$" . $InsPayment . "\n";
            echo "Amount Paid by Patient: . . . . .$" . $CostToPatient . "\n\n";

            $total = number_format($InsPayment+$PatientPayment, 2, '.', '');

            echo "Total Paid to Provider  . . . . .$" . $total . "\n\n";

            if(empty($DrugName)) {
                echo "No medication was prescribed\n";
            }
            else {
                echo $DrugName . " was prescribed\n";
            }
            echo "\n\n\n";

            $grandTotalPatient+=$PatientPayment;
            $grandTotalInsurance+=$InsPayment;
        }
        echo $thinline;
        echo "\n";

        echo "Grand Totals:\n";
        $grandTotalCombined = $grandTotalInsurance+$grandTotalPatient;
        echo $fullname . ": $" . number_format($grandTotalPatient, 2, '.', '')
             . " | Insurance: $" . number_format($grandTotalInsurance, 2, '.', '')
              . " | Combined: $" . number_format($grandTotalCombined, 2, '.', '');

        echo "\n" . $boldline;

    }
    else {
        echo "\n";
        echo "No Payments between " . $startDate . " and " . $endDate;
    }
    $link->close();
?>
