<?php
include 'koneksi.php';
session_start();

if (isset($_POST['submit'])) {
    $username = isset($_POST['username']) ? trim($_POST['username']) : "";
    $password = isset($_POST['password']) ? trim($_POST['password']) : "";

    if (empty($username) || empty($password)) {
        $_SESSION["error"] = "Please complete the fields below";
        $_SESSION["status"] = "fail";
        header("location:loginregis.php");
        exit();
    }

    if ($_POST['action'] == 'login') {
        $query = new mysqli('localhost', 'root', '', 'proyek_web');
        if ($query->connect_error) {
            die("Database connection failed: " . $query->connect_error);
        }

        $sql_check_username = "SELECT * FROM user WHERE username = ?";
        $stmt_check_username = $query->prepare($sql_check_username);
        $stmt_check_username->bind_param("s", $username);
        $stmt_check_username->execute();
        $result_username = $stmt_check_username->get_result();

        if ($result_username->num_rows === 0) {
            $_SESSION["error"] = "Username not found. Please register first.";
            $_SESSION["status"] = "fail";
            header("location:loginregis.php");
            exit();
        } else {
            $user_data = $result_username->fetch_assoc();

            if ($user_data['password'] !== $password) {
                $_SESSION["error"] = "Incorrect password. Please try again.";
                $_SESSION["status"] = "fail";
                header("location:loginregis.php");
                exit();
            } else {
                $_SESSION['user_id'] = $user_data['user_id'];
                $_SESSION['username'] = $user_data['username'];
                $_SESSION['status'] = "login";
                $_SESSION["error"] = "";

                header("location:../home.php");
                exit();
            }
        }
    }
} else {
    $_SESSION["error"] = "Unauthorized access";
    $_SESSION["status"] = "fail";
    header("location:loginregis.php");
    exit();
}
