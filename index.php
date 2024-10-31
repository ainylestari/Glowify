<?php
include 'koneksi.php'; // Koneksi ke database

    $title = $_POST['title'];
    $pesan = $_POST['pesan'];
    $category_id = $_POST['category'];

    // Upload gambar
    $image = $_FILES['image']['name'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($image);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Validasi tipe file
    $allowed_types = ['jpg', 'jpeg', 'png'];
    if (!in_array($imageFileType, $allowed_types)) {
        die("Hanya file JPG, JPEG, dan PNG yang diizinkan.");
    }

    // Validasi ukuran file (maks 2MB)
    if ($_FILES['image']['size'] > 2 * 1024 * 1024) {
        die("Ukuran file maksimal 2MB.");
    }

    // Proses upload
    if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
        // Simpan data ke database
        $proyek_web = "INSERT INTO post (title, content, image, category_id, author_id) 
                VALUES ('$title', '$pesan', '$image', '$category_id', '?')"; // '1' sebagai contoh ID kategori dan penulis

        if ($konek->query($proyek_web) === TRUE) {
            echo "Artikel dan gambar berhasil disimpan! lihat hasilnya
                <a href='tampilan.php'> disini </a>";
        } else {
            echo  "Proses Input gagal";
        }
    } else {
        echo "Gagal mengupload gambar.";
    }
