<?php
include '../loginregis/koneksi.php';
$post_id = isset($_GET['post_id']) ? intval($_GET['post_id']) : 0;

$query = mysqli_query($konek, "SELECT * FROM post WHERE post_id = '$post_id'");
if ($query && mysqli_num_rows($query) > 0) {
    $post = mysqli_fetch_assoc($query);
} else {
    echo "<script>alert('Post tidak ditemukan!');window.location.href='../home.php';</script>";
    exit;
}

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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <title>Create a New Post</title>
    <style>
        body {
            background: linear-gradient(135deg, #FFCAD4, #b6d8f0);
            color: #333;
            overflow-x: hidden;
            font-family: 'Arial', sans-serif;
        }

        main {
            margin-top: 20px;
            min-height: 100vh;
        }

        .card {
            padding: 20px;
            border-radius: 15px;
            background-color: rgba(255, 255, 255, 0.9);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
            transition: transform 0.2s;
        }

        .card:hover {
            transform: scale(1.02);
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        textarea {
            resize: none;
            background-color: #f8f9fa;
            color: #333;
        }

        .btn-back {
            border: none;
            padding: 10px 15px;
            display: inline-block;
            border-radius: 50%;
            background-color: #65869e;
            color: #FFCAD4;
            position: absolute;
            top: 10px;
            left: 10px;
        }
    </style>
</head>

<body>
    <a href="../semuapost.php" class="btn-back"><i class="fa fa-arrow-left"></i></a>
    <main class="d-flex justify-content-center align-items-center">
        <div class="card d-grid col-lg-7 col-12">
            <h1 class="text-center">Edit Post</h1>
            <hr>
            <p class="text-center mb-3">Yuk, share tips andalanmu biar semua orang bisa ikut mencobanya dan terinspirasi!</p>
            <form method="POST" action="" enctype="multipart/form-data">
                <input type="hidden" name="post_id" value="<?php echo $post['post_id']; ?>"> <!-- Hidden field untuk post_id -->
                <div class="d-grid col-auto gap-3">
                    <input type="text" name="title" placeholder="Title" required class="form-control"
                        value="<?php echo htmlspecialchars($post['title']); ?>">
                    <div class="d-flex col-auto gap-2">
                        <div class="flex-grow-1">
                            <input type="file" name="image[]" id="image" class="form-control" multiple onchange="displaySelectedFiles()">
                            <ul id="fileList" class="list-unstyled mt-2">
                            </ul>
                        </div>

                        <div class="flex-grow-1">
                            <select id="category" name="category" class="form-select" required>
                                <option value="">Pilih category</option>
                                <?php
                                $query = mysqli_query($konek, "SELECT category_id, category_name FROM category");
                                while ($category = mysqli_fetch_array($query)) {
                                    $selected = $post['category_id'] == $category['category_id'] ? 'selected' : '';
                                    echo "<option value='{$category['category_id']}' $selected>{$category['category_name']}</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <textarea class="form-control" rows="10" name="pesan" placeholder="Pesan" required><?php echo htmlspecialchars($post['content']); ?></textarea>
                    <button type="submit" name="submit" class="btn btn-primary col-auto">Update</button>
                </div>
            </form>

        </div>
    </main>
    <script>
        function displaySelectedFiles() {
            const fileList = document.getElementById("fileList");
            const input = document.getElementById("image");
            fileList.innerHTML = ''; // Clear previous file list

            for (let i = 0; i < input.files.length; i++) {
                const file = input.files[i];
                const listItem = document.createElement("li");
                listItem.textContent = file.name;
                fileList.appendChild(listItem);
            }
        }
    </script>

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