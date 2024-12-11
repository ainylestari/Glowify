<?php

    session_start();
    include 'loginregis/koneksi.php';

    if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
    }

$category_id = isset($_GET['category_id']) ? $_GET['category_id'] : '';

$post_data = [];

if (!empty($category_id)) {
    $query = "
        SELECT p.post_id, p.title, k.comment, c.category_name, u.username, p.views, 
        f.file_name AS image_path
        FROM post p
        LEFT JOIN category c ON p.category_id = c.category_id
        LEFT JOIN user u ON p.author_id = u.user_id
        LEFT JOIN file f ON p.post_id = f.post_id
        LEFT JOIN comment k ON p.comment_id = k.comment_id
        WHERE p.category_id = '$category_id'
        GROUP BY p.post_id
    ";
} else {
    $query = "
        SELECT p.post_id, p.title, k.comment, c.category_name, u.username, p.views, 
        f.file_name AS image_path
        FROM post p
        LEFT JOIN category c ON p.category_id = c.category_id
        LEFT JOIN user u ON p.author_id = u.user_id
        LEFT JOIN file f ON p.post_id = f.post_id
        LEFT JOIN comment k ON p.comment_id = k.comment_id
        GROUP BY p.post_id
    ";
}

$result = mysqli_query($konek, $query);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $post_data[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Post List</title>
    <style>
        body {
            background: linear-gradient(135deg, #FFCAD4, #b6d8f0);
            color: #333;
            overflow-x: hidden;
        }
        .content {
            margin: 80px 20px;
            display: grid;
            gap: 1rem;
        }

        @media (min-width: 992px) {
            .content {
                grid-template-columns: repeat(4, 1fr);
            }
        }

        @media (max-width: 991px) {
            .content {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 576px) {
            .content {
                grid-template-columns: 1fr;
            }
        }

        .card {
            background: #fff;
            border: none;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s;
        }

        .card:hover {
            transform: scale(1.02);
        }

        .card img {
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .card h4 {
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <?php include 'navbar.php'; ?>

    <div class="container">
        <h1 class="text-center my-4">
            <?php
            echo !empty($category_id) ? htmlspecialchars($post_data[0]['category_name']) : "All Posts";
            ?>
        </h1>
        <div class="content">
            <?php if (!empty($post_data)): ?>
                <?php foreach ($post_data as $post): ?>
                    <?php 
                        $image_src = !empty($post['image_path']) ? 'uploads/' . htmlspecialchars($post['image_path']) : 'uploads/default.png';
                    ?>
                    <div class="card">
                        <a href="detail.php?post_id=<?php echo $post['post_id']; ?>" style="text-decoration: none; color: inherit;">
                            <img src="<?php echo $image_src; ?>" alt="<?php echo htmlspecialchars($post['title']); ?>">
                            <div class="p-3">
                                <h4><?php echo htmlspecialchars($post['title']); ?></h4>
                                <p class="text-secondary mb-0">By <?php echo htmlspecialchars($post['username']); ?></p>
                                <p class="text-secondary"><?php echo htmlspecialchars($post['views']); ?> views</p>
                                <p><?php echo htmlspecialchars($post['comment']); ?></p>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-center">No posts found.</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
