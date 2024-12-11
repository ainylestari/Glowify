<?php
session_start();
include '../loginregis/koneksi.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $post_id = $_POST['post_id'];
    $comment = mysqli_real_escape_string($konek, $_POST['comment']);
    $username = $_SESSION['username'];

    $user_query = mysqli_query($konek, "SELECT user_id FROM user WHERE username = '$username'");
    $user = mysqli_fetch_assoc($user_query);
    $user_id = $user['user_id'];

    $insert_query = "INSERT INTO comment (post_id, user_id, comment, created_at) 
                    VALUES ('$post_id', '$user_id', '$comment', NOW())";

    if (mysqli_query($konek, $insert_query)) {
        header("Location: ../detail.php?post_id=$post_id"); // Redirect back to post detail page
    } else {
        echo "Error: " . mysqli_error($konek);
    }
}
