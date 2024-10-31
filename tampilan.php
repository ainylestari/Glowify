<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Artikel Kecantikan</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .article { margin-bottom: 20px; padding: 10px; border: 1px solid #ddd; }
        .article img { max-width: 200px; display: block; margin-bottom: 10px; }
        .category { font-style: italic; color: #555; }
    </style>
</head>
<body>
    <h1>Artikel Kecantikan & Fashion</h1>

    <?php
        include 'koneksi.php'; // Memastikan file koneksi sudah benar

        // Query untuk mengambil data artikel beserta kategori dan penulis
        $query = mysqli_query($konek, 
            "SELECT post.post_id, post.title, post.content, post.image, 
                    category.category_name, user.username 
             FROM post
             JOIN category ON post.category_id = category.category_id 
             JOIN user ON post.author_id = user.user_id");

        // Jika ada data, tampilkan dalam bentuk loop
        if (mysqli_num_rows($query) > 0) {
            while ($data = mysqli_fetch_array($query)) {
    ?>
                <div class="article">
                    <h2><?php echo $data['title']; ?></h2>
                    <p class="category">
                        Kategori: <?php echo $data['category_name']; ?> | 
                        Penulis: <?php echo $data['username']; ?>
                    </p>
                    <?php if ($data['image']): ?>
                        <img src="uploads/<?php echo $data['image']; ?>" alt="<?php echo $data['title']; ?>">
                    <?php endif; ?>
                    <p><?php echo $data['content']; ?></p>
                </div>

    <?php 
            } 
        } else {
            echo "<p>Tidak ada artikel yang ditemukan.</p>";
        }
    ?>

                <div>
                    <button class="btn btn-primary editbtn" herf="post.php"> tambah</button>
                </div>

</body>
</html>
