<?php
session_start();
include 'koneksi.php';

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        $_SESSION["error"] = "Please Complete the Fields Below";
        header("location:loginregis.php");
        exit();
    }

    if ($_POST['action'] == "regist") {
        $query = "SELECT * FROM user WHERE username='$username'";
        $data = mysqli_query($konek, $query) or die(mysqli_error($konek));

        if (mysqli_num_rows($data) > 0) {
            $_SESSION["error"] = "Username Already Taken";
            header("location:loginregis.php");
        } else if (strlen($password) < 8) {
            $_SESSION["error"] = "Password Too Short <br> Minimum length is 8 characters.";
            header("location:loginregis.php");
        } else {
            $data = "INSERT INTO user (username, password) VALUES ('$username', '$password')";
            $success = mysqli_query($konek, $data);

            if ($success) {
                $_SESSION["error"] = "Registration Success!";
                header("location:loginregis.php");
            } else {
                $_SESSION["error"] = "Registration Failed!";
                header("location:loginregis.php");
            }
        }
    }
}
?>
