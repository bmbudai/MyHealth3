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
            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT);
            $insert = $link->prepare('insert into Users (username, password) values (?,?)');
            $insert->bind_param("ss", $param_username, $param_password);

            // Attempt to execute the prepared statement
            if($insert->execute()){
                // Redirect to login page
                header("Location: login.html");
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }

        $stmt->close();
    }
?>