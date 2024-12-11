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
  <title>Proyek Kosmetik</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <style>
    body {
      background: linear-gradient(135deg, #FFCAD4, #b6d8f0);
      color: #333;
      overflow-x: hidden;
    }

    @media (max-width: 991px) {
      .all {
        width: 100%;
      }
    }

    .all {
      min-height: 100vh;
    }

    .card-body {
      background: #fff;
      border-radius: 5px !important;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.5) !important;
      padding: 20px; 
    }

    .card-body:hover {
      background: rgba(255, 202, 212, 0.8) !important;
    }

  </style>
</head>

<body>
  <?php include 'navbar.php'; ?>
  <div class="all">
    <div>
      <div class="position-relative p-5 m-5 text-center">
        <div class="mx-auto">
          <h1 class="display-3 mb-3 fw-bold">Beauty and Fashion Tips</h1>
          <h3 class="fw-normal text-muted mb-3">Your Guide to Timeless Beauty and Modern Style</h3>
        </div>
      </div>
    </div>

    <div class="row col-11 justify-content-center mx-auto">
      <div class="col-sm-4 mb-3 mb-sm-0">
        <a href="semuapost.php?category_id=123123" style="text-decoration: none; color: inherit;">
          <div class="card">
            <div class="card-body">
              <div>
                <img height="60" src="/proyek/asset/beauty.png" alt="beauty">
                <h5 class="card-title">Beauty</h5>
                <p class="card-text">Jelajahi tips dan trik kecantikan yang bikin kamu tampil fresh setiap hari</p>
              </div>
            </div>
          </div>
        </a>
      </div>
      <div class="col-sm-4 mb-3 mb-sm-0">
        <a href="semuapost.php?category_id=123231" style="text-decoration: none; color: inherit;">
          <div class="card">
            <div class="card-body">
              <div>
                <img height="60" src="/proyek/asset/makeup.png" alt="makeup">
                <h5 class="card-title">Makeup</h5>
                <p class="card-text">Lihat tren makeup terbaru dan dapatkan rekomendasi produk di sini</p>
              </div>
            </div>
          </div>
        </a>
      </div>
      <div class="col-sm-4 mb-3 mb-sm-0">
        <a href="semuapost.php?category_id=123321" style="text-decoration: none; color: inherit;">
          <div class="card">
            <div class="card-body">
              <div>
                <img height="60" src="/proyek/asset/fashion.png" alt="fashion">
                <h5 class="card-title">Fashion</h5>
                <p class="card-text">Temukan inspirasi gaya fashion sesuai kepribadianmu dan ikuti tren fashion terkini</p>
              </div>
            </div>
          </div>
          <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

        </a>
      </div>
    </div>
  </div>


</body>

</html>