<?php
    session_start();
    include_once "config.php";

    // Now we check if the data from the new account form was submitted, isset() will check if the data exists.
    if ( !isset($_POST['username'], $_POST['password']) ) {
        // Could not get the data that should have been sent.
        exit('Invalid action, please try something else.');
    }

    // Prepare our SQL, preparing the SQL statement will prevent SQL injection.
    if ($stmt = $link->prepare('SELECT id FROM Users WHERE username = ?')) {
        // Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
        $stmt->bind_param('s', $_POST['username']);
        $stmt->execute();
        // Store the result so we can check if the account exists in the database.
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            // $stmt->bind_result($id);
            // $stmt->fetch();
            // Someone already used this username.
            $_SESSION['usernameTaken'] = TRUE;
            $_SESSION['usernameAttempted'] = $_POST['username'];
            header('Location: create-account.html');
        } else if ($_POST['password']!=$_POST['confirmpassword']){
            $_SESSION['passDontMatch'] = TRUE;
            header('Location: create-account.html');
        } else {
            //Everything must be dandy, let's move on
            $password = trim($_POST['password']);
            $username = trim($_POST['username']);
            $firstname = trim($_POST['firstname']);
            $middlename = trim($_POST['middlename']);
            $lastname = trim($_POST['lastname']);
            $streetaddress = trim($_POST['streetaddress']);
            $city = trim($_POST['city']);
            $state = trim($_POST['state']);
            $zip = trim($_POST['zip']);
            $dateofbirth = trim($_POST['dateofbirth']);
            $phone = trim($_POST['phone']);
            $email = trim($_POST['email']);
            $employer = trim($_POST['employer']);
            $emergencycontactname = trim($_POST['emergencycontactname']);
            $emergencycontactphone = trim($_POST['emergencycontactphone']);

            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT);
            $insertUser = $link->prepare('insert into Users (username, password) values (?,?)');
            $insertUser->bind_param("ss", $param_username, $param_password);

            if(isset($middlename) && !empty($middlename)) {
                $middlename = $middlename . ' ';
            }
            $name = $firstname . ' ' . $middlename .$lastname;

            $address = $streetaddress . ', ' . $city . ' ' . $state . ' ' . $zip;

            $insertPatient = $link->prepare('insert into Patients (Name, DateOfBirth, Address, EmployerName, EmergencyContactName, EmergencyContactTelNo, PatientTelNo, PatientEmail) values (?,?,?,?,?,?,?,?)');
            $insertPatient->bind_param("ssssssss", $name, $dateofbirth, $address, $employer, $emergencycontactname, $emergencycontactphone, $phone, $email);

            // Attempt to execute the prepared statement
            if($insertUser->execute() && $insertPatient->execute()){
                // Redirect to login page
                header("Location: login.html");
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }

        $stmt->close();
    }
?>