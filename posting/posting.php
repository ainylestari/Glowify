<?php
session_start();
include '../loginregis/koneksi.php';

if (!isset($_SESSION['username'])) {
header("Location: ../index.php");
exit();
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
    <?php include '../loginregis/koneksi.php'; ?>
    <a href="../home.php" class="btn-back"><i class="fa fa-arrow-left"></i></a>
    <main class="d-flex justify-content-center align-items-center">
        <div class="card d-grid col-lg-7 col-12">
            <h1 class="text-center">Create a New Post</h1><hr>
            <p class="text-center mb-3">Yuk, share tips andalanmu biar semua orang bisa ikut mencobanya dan terinspirasi!</p>
            <form method="POST" action="simpanpost.php" enctype="multipart/form-data">
                <div class="d-grid col-auto gap-3">
                    <input type="text" name="title" placeholder="Title" required class="form-control">
                    <div class="d-flex col-auto gap-2">
                        <div class="flex-grow-1">
                            <input type="file" name="image[]" id="image" class="form-control" multiple onchange="displaySelectedFiles()">
                            <ul id="fileList" class="list-unstyled mt-2"></ul>
                        </div>
                        <div class="flex-grow-1">
                            <select id="category" name="category" class="form-select" required>
                                <option value="">Pilih category</option>
                                <?php
                                include '../loginregis/koneksi.php';
                                $query = mysqli_query($konek, "SELECT category_id, category_name FROM category");
                                while ($category = mysqli_fetch_array($query)) {
                                    echo "<option value='{$category['category_id']}'>{$category['category_name']}</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <textarea class="form-control" rows="10" name="pesan" placeholder="Pesan" required></textarea>
                    <button type="submit" class="btn btn-primary col-auto">Post</button>
                </div> 
            </form>
        </div>
    </main>
    <script>
        function displaySelectedFiles() {
            const fileList = document.getElementById("fileList");
            const input = document.getElementById("image");
            fileList.innerHTML = ''; 
            
            for (let i = 0; i < input.files.length; i++) {
                const file = input.files[i];
                const listItem = document.createElement("li");
                listItem.textContent = file.name;
                fileList.appendChild(listItem);
            }
        }
    </script>
</body>
</html>