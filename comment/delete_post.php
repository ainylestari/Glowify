<?php
session_start();
include '../loginregis/koneksi.php';

if (isset($_POST['post_id'])) {
    $post_id = intval($_POST['post_id']); 
    $user_id = $_SESSION['user_id']; 

    $query_check_post = "SELECT * FROM post WHERE post_id = '$post_id' AND author_id = '$user_id'";
    $result_check_post = mysqli_query($konek, $query_check_post);

    if (mysqli_num_rows($result_check_post) > 0) {
        $query_files = "SELECT file_name FROM file WHERE post_id = '$post_id'";
        $result_files = mysqli_query($konek, $query_files);
        while ($file = mysqli_fetch_assoc($result_files)) {
            $file_path = '../uploads/' . $file['file_name'];
            if (file_exists($file_path)) {
                unlink($file_path);
            }
        }
        
        $query_delete_files = "DELETE FROM file WHERE post_id = '$post_id'";
        mysqli_query($konek, $query_delete_files);

        $query_delete_comments = "DELETE FROM comment WHERE post_id = '$post_id'";
        mysqli_query($konek, $query_delete_comments);

        $query_delete_post = "DELETE FROM post WHERE post_id = '$post_id'";
        if (mysqli_query($konek, $query_delete_post)) {
            echo "<script>alert('Post berhasil dihapus!'); window.location = '../semuapost.php';</script>";
        } else {
            echo "<script>alert('Gagal menghapus post.'); window.location = '../detail.php?post_id=$post_id';</script>";
        }
    } else {
        echo "<script>alert('Anda tidak memiliki akses untuk menghapus postingan ini!'); window.location = '../detail.php?post_id=$post_id';</script>";
    }
} else {
    echo "<script>alert('Post ID tidak ditemukan!'); window.location = '../semuapost.php';</script>";
}
?>
