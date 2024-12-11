<?php
session_start();
include '../loginregis/koneksi.php';

// Periksa apakah pengguna login
if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('Anda harus login terlebih dahulu!'); window.location.href = '../login.php';</script>";
    exit;
}

$post_id = isset($_GET['post_id']) ? intval($_GET['post_id']) : 0;
$user_id = $_SESSION['user_id']; // ID pengguna yang login

// Validasi apakah post milik pengguna yang login
$query_check_post = "SELECT * FROM post WHERE post_id = '$post_id' AND author_id = '$user_id'";
$result_check_post = mysqli_query($konek, $query_check_post);

if (!$result_check_post || mysqli_num_rows($result_check_post) === 0) {
    echo "<script>alert('Anda tidak memiliki akses untuk mengedit post ini!'); window.location.href = '../semuapost.php';</script>";
    exit;
}

// Ambil data post jika validasi berhasil
$post = mysqli_fetch_assoc($result_check_post);

// Ambil file terkait
$file_query = mysqli_query($konek, "SELECT file_id, file_name FROM file WHERE post_id = '$post_id'");
$existing_files = [];
while ($file = mysqli_fetch_assoc($file_query)) {
    $existing_files[$file['file_id']] = $file['file_name'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <title>Edit Post</title>
    <style>
        body { background: linear-gradient(135deg, #FFCAD4, #b6d8f0); color: #333; }
        main { margin-top: 20px; }
        .card { padding: 20px; border-radius: 15px; background-color: rgba(255, 255, 255, 0.9); }
    </style>
</head>
<body>
    <a href="../semuapost.php" class="btn btn-secondary">Kembali</a>
    <main class="d-flex justify-content-center align-items-center">
        <div class="card d-grid col-lg-7 col-12">
            <h1 class="text-center">Edit Post</h1>
            <hr>
            <form method="POST" action="" enctype="multipart/form-data">
                <input type="hidden" name="post_id" value="<?php echo $post['post_id']; ?>">
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" name="title" id="title" class="form-control" value="<?php echo htmlspecialchars($post['title']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="category" class="form-label">Category</label>
                    <select id="category" name="category" class="form-select" required>
                        <option value="">Pilih category</option>
                        <?php
                        $category_query = mysqli_query($konek, "SELECT category_id, category_name FROM category");
                        while ($category = mysqli_fetch_array($category_query)) {
                            $selected = $post['category_id'] == $category['category_id'] ? 'selected' : '';
                            echo "<option value='{$category['category_id']}' $selected>{$category['category_name']}</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="pesan" class="form-label">Pesan</label>
                    <textarea id="pesan" name="pesan" class="form-control" rows="5" required><?php echo htmlspecialchars($post['content']); ?></textarea>
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </main>

    <?php
if (isset($_POST['submit'])) {
    $post_id = intval($_POST['post_id']);
    $title = mysqli_real_escape_string($konek, $_POST['title']);
    $category = intval($_POST['category']);
    $pesan = mysqli_real_escape_string($konek, $_POST['pesan']);

    if (!empty($_POST['delete_files'])) {
        foreach ($_POST['delete_files'] as $file_id) {
            $file_id = intval($file_id);
            if (isset($existing_files[$file_id])) {
                $file_path = '../uploads/' . $existing_files[$file_id];
                if (file_exists($file_path)) {
                    unlink($file_path); // Hapus file fisik
                }
                mysqli_query($konek, "DELETE FROM file WHERE file_id = $file_id"); // Hapus dari database
            }
        }
    }

    $file_query = mysqli_query($konek, "SELECT file_name FROM file WHERE post_id = '$post_id'");
    while ($file = mysqli_fetch_assoc($file_query)) {
        $file_path = '../uploads/' . $file['file_name'];
        if (file_exists($file_path)) {
            unlink($file_path); // Hapus file fisik
        }
    }
    mysqli_query($konek, "DELETE FROM file WHERE post_id = '$post_id'"); // Hapus dari database

    if (isset($_FILES['image']['tmp_name'][0]) && $_FILES['image']['error'][0] !== UPLOAD_ERR_NO_FILE) {
        foreach ($_FILES['image']['tmp_name'] as $key => $tmp_name) {
            $name = $_FILES['image']['name'][$key];
            $typefile = pathinfo($name, PATHINFO_EXTENSION);
            $renamefile = pathinfo($name, PATHINFO_FILENAME) . '-' . time() . '.' . $typefile;

            if (move_uploaded_file($tmp_name, '../uploads/' . $renamefile)) {
                mysqli_query($konek, "INSERT INTO file (post_id, file_name) VALUES ('$post_id', '$renamefile')");
            }
        }
    }

    $query_update = "UPDATE post SET 
                     title = '$title',
                     category_id = '$category',
                     content = '$pesan'
                     WHERE post_id = '$post_id'";
    $run_query_update = mysqli_query($konek, $query_update);

    if (!$run_query_update) {
        echo "<script>alert('Data gagal diedit');</script>";
        echo "<script>window.location = 'edit_post.php';</script>";
        exit();
    }

    echo "<script>alert('Data berhasil diedit');</script>";
    echo "<script>window.location = '../semuapost.php';</script>";
}
?>
</body>
</html>
