<!-- <?php
        $showError = "false";
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            include 'dbconnection.php';
            $user_email = $_POST['signupEmail'];
            $pass = $_POST['password'];
            $cpass = $_POST['cpassword'];

            // Check whether this email exists
            $existSql = "SELECT * FROM `users` WHERE user_email = '$user_email'";
            $result = mysqli_query($conn, $existSql);
            $numRows = mysqli_num_rows($result);
            if ($numRows > 0) {
                $showError = "Email already in use";
            } else {
                if ($pass == $cpass) {
                    $hash = password_hash($pass, PASSWORD_DEFAULT);
                    $sql = "INSERT INTO `users` (`user_email`, `user_pass`, `tstamp`) 
            VALUES ('$user_email', '$hash', current_timestamp())";  //insertion query from the database
                    $result = mysqli_query($conn, $sql);

                    if ($result) {
                        $showAlert = true;
                        header("Location: /php1/Forum/index.php?signupsuccess=true");
                        exit();
                    }
                } else {
                    $showError = "Passwords do not match";
                }
            }
            header("Location: /php1/Forum/index.php?signupsuccess=false&error=$showError");
        }
        ?> -->


<?php
$showError = "false";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'dbconnection.php';
    $user_email = $_POST['signupEmail'];
    $pass = $_POST['password'];
    $cpass = $_POST['cpassword'];

    // check whether this email exist
    $existSql = "select * from 'users' where user_email = '$user_email'";
    $result = mysqli_query($conn, $existSql);
    $numRows = mysqli_num_rows($result);
    if ($numRows > 0) {
        $showError = "Email already in use";
    } else {
        if ($pass == $cpass) {
            $hash = password_hash($pass, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `users` (`user_email`, `user_pass`, `tstamp`) 
            VALUES ('$user_email', '$hash', current_timestamp())";  //insertion query from the database
            $result = mysqli_query($conn, $sql);

            if ($result) {
                $showAlert = true;
                header("location: /php1/Forum/index.php?signupsuccess=true");
                exit();
            }
        } else {
            $showError = "password does not match";
        }
    }
    header("location: /php1/Forum/index.php?signupsuccess=false&error=$showError");
}
?>