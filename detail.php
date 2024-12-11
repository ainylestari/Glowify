<?php
    session_start();
    include 'loginregis/koneksi.php';

    if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Post Detail</title>
    <style>
        .container {
            margin-top: 80px;
        }

        .d-flex {
            align-items: flex-start;
        }

        .carousel-inner img {
            object-fit: cover;
            width: 100%;
        }

        .d-grid {
            align-self: stretch;
        }

        .fixed {
            flex: 0 0 auto;
        }

        @media (max-width: 991px) {
            .d-flex {
                flex-direction: column;
            }

            .fixed {
                width: auto;
                height: auto;
            }
        }

        .comment {
            width: auto;
        }

        .btn-back {
            margin-top: 70px;
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
    <?php include 'navbar.php'; ?>
    <div class="container col-lg-11 col-12">
        <?php
        include 'loginregis/koneksi.php';

        $post_id = isset($_GET['post_id']) ? intval($_GET['post_id']) : 0;

        $query = mysqli_query(
            $konek,
            "SELECT p.title, p.content, u.username, p.created_at, p.views
            FROM post p
            JOIN user u ON p.author_id = u.user_id
            WHERE p.post_id = '$post_id'"
        );
        $data = mysqli_fetch_array($query);

        $image_query = mysqli_query($konek, "SELECT file_name FROM file WHERE post_id = '$post_id'");
        $images = [];
        while ($row = mysqli_fetch_assoc($image_query)) {
            $images[] = 'uploads/' . htmlspecialchars($row['file_name']);
        }

        if (empty($images)) {
            $images[] = '/proyek/uploads/default.png';
        }
        ?>
        <a href="semuapost.php" class="btn-back"><i class="fa fa-arrow-left"></i></a>
        <div class="d-flex gap-4">
            <div class="fixed col-5">
                <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <?php foreach ($images as $index => $image_src): ?>
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="<?php echo $index; ?>"
                                class="<?php echo $index === 0 ? 'active' : ''; ?>"
                                aria-label="Slide <?php echo $index + 1; ?>"></button>
                        <?php endforeach; ?>
                    </div>
                    <div class="carousel-inner">
                        <?php foreach ($images as $index => $image_src): ?>
                            <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                                <img src="<?php echo $image_src; ?>" class="d-block w-100" alt="Image <?php echo $index + 1; ?>">
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
                <div class="d-flex gap-2 mt-3">
                    <a href="comment/edit_post.php?post_id=<?php echo $post_id; ?>" class="btn btn-warning btn-sm">
                        <i class="fa fa-edit"></i> Edit
                    </a>

                    <form action="comment/delete_post.php" method="POST">
    <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
    <button type="submit" class="btn btn-danger btn-sm">
        <i class="fa fa-trash"></i> Delete
    </button>
</form>
                </div>
            </div>

            <div class="d-grid col-6 gap-3">
                <p class="text-muted m-0"><?php echo $data['username']; ?></p>
                <h2 class="m-0"><?php echo $data['title']; ?></h2>
                <p class="m-0"><?php echo $data['content']; ?></p>
                <div class="d-flex justify-content-between text-muted">
                    <p><?php echo $data['created_at']; ?></p>
                    <div class="d-flex align-items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-eye me-1" viewBox="0 0 16 16">
                            <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z" />
                            <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0" />
                        </svg>
                        <p class="mb-0"><?php echo $data['views']; ?></p>
                    </div>
                </div>

                <div class="comment">
                    <h4>Comments</h4>
                    <?php
                    $current_user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;  // Retrieve the logged-in user's ID

                    $comment_query = mysqli_query(
                        $konek,
                        "SELECT c.comment_id, c.comment, u.username, c.created_at, c.user_id
        FROM comment c
        JOIN user u ON c.user_id = u.user_id
        WHERE c.post_id = '$post_id'
        ORDER BY c.created_at DESC"
                    );

                    if (mysqli_num_rows($comment_query) > 0) {
                        while ($comment_data = mysqli_fetch_array($comment_query)) {
                            $is_owner = $comment_data['user_id'] == $current_user_id;
                    ?>
                            <div class="comment-box">
                                <div class="comment-text">
                                    <strong><?php echo htmlspecialchars($comment_data['username']); ?></strong>
                                    <span class="text-muted">(<?php echo $comment_data['created_at']; ?>)</span>:
                                    <?php echo htmlspecialchars($comment_data['comment']); ?>
                                </div>
                                <?php if ($is_owner): ?>
                                    <form action="" method="POST" style="display: inline;">
                                        <input type="hidden" name="delete" value="<?php echo $comment_data['comment_id']; ?>">
                                        <button type="submit" class="btn btn-sm btn-danger" style="border: none; background: transparent;">
                                            <i class="fa fa-trash"></i> 
                                        </button>
                                    </form>
                                <?php endif; ?>
                            </div>
                    <?php
                        }
                    } else {
                        echo "<p>No comments yet.</p>";
                    }
                    ?>
                </div>


                <form action="comment/add_comment.php" method="POST">
                    <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
                    <div class="d-flex gap-2 mb-3">
                        <input class="form-control" id="comment" name="comment" placeholder="Add a comment"></input>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>