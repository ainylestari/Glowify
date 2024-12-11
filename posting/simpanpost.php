<?php  
include '../loginregis/koneksi.php';
session_start();

$title = $_POST['title'];
$pesan = $_POST['pesan'];
$category_id = $_POST['category'];
$author_id = $_SESSION['user_id'];

$post_query = "INSERT INTO post (title, content, category_id, author_id, created_at) VALUES ('$title', '$pesan', '$category_id', '$author_id', NOW())";

if (mysqli_query($konek, $post_query)) {
    $post_id = mysqli_insert_id($konek);

    if (empty($post_id)) {
        die("Error: post_id is null or empty.");
    }

    if (empty($post_id)) {
        die("Error: post_id is null or empty.");
    }

    if (isset($_FILES['image']['name']) && count($_FILES['image']['name']) > 0) {
        $total_files = count($_FILES['image']['name']);
        
        for ($i = 0; $i < $total_files; $i++) {
            if (!empty($_FILES['image']['name'][$i])) {
                $file_name = $_FILES['image']['name'][$i];
                $file_tmp = $_FILES['image']['tmp_name'][$i];
                $target_dir = "../uploads/";
                $target_file = $target_dir . basename($file_name);

               if (move_uploaded_file($file_tmp, $target_file)) {
                $file_query = "INSERT INTO file (post_id, file_name) VALUES ('$post_id', '$file_name')";
                if (!mysqli_query($konek, $file_query)) {
                    echo "Error menyimpan file ke database: " . mysqli_error($konek) . "<br>";
                }
            } else {
                echo "Gagal mengunggah file: $file_name<br>";
            }
        }
    }
} else {
    echo "Tidak ada file yang diunggah.<br>";
}

    header("Location: ../home.php");
    exit;
} else {
    echo "Error menyimpan post: " . mysqli_error($konek);
}
?>
