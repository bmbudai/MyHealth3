<?php
    session_start();
    include_once "config.php";

    if (!isset($_SESSION['loggedin'])) {
        header('Location: index.php');
        $hideNotLoggedIn = "display:none;";

        exit;
    }
    else {
        $username = htmlspecialchars($_SESSION["name"]);
        $hideNotLoggedIn = " ";
    }

    // Prepare our SQL, preparing the SQL statement will prevent SQL injection.
    // if ($stmt = $link->prepare('SELECT id FROM Users WHERE username = ?')) {
    //     // Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
    //     $stmt->bind_param('s', $_POST['username']);
    //     $stmt->execute();
    //     // Store the result so we can check if the account exists in the database.
    //     $stmt->store_result();

        // if ($stmt->num_rows > 0) {
        //     // $stmt->bind_result($id);
        //     // $stmt->fetch();
        //     // Someone already used this username.
        //     $_SESSION['usernameTaken'] = TRUE;
        //     $_SESSION['usernameAttempted'] = $_POST['username'];
        //     header('Location: create-account.php');
        // } else if ($_POST['password']!=$_POST['confirmpassword']){
        //     $_SESSION['passDontMatch'] = TRUE;
        //     header('Location: create-account.php');
        // } else {

    $patient = trim($_POST['patient']);
    $provider = trim($_POST['provider']);
    $service = trim($_POST['service']);
    $servicedate = trim($_POST['servicedate']);
    $inscost = trim($_POST['inscost']);
    $patcost = trim($_POST['patcost']);
    $inspayment = trim($_POST['inspayment']);
    $patpayment = trim($_POST['patpayment']);
    $drug = trim($_POST['drug']);


    $insertRecord = $link->prepare('insert into PatientRecords values (?,?,?,?,?,?,?,?,?)');
    $insertRecord->bind_param("sssssssss", $patient, $provider, $service, $servicedate, $inscost, $patcost, $inspayment, $patpayment, $drug);

    // Attempt to execute the prepared statement
    if(!$insertRecord->execute()) {
        $_SESSION['addRecordFail'] = TRUE;
        $_SESSION['failReason'] = "Couldn't insert record.";
        $insertRecord->close();
        $previous = $_SERVER['HTTP_REFERER'];
        header("Location: " . $previous);
    }
    else {
        $insertRecord->close();
        header("Location: patientrecords.php");
    }

    // }
?>
