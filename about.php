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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <title>Beauty and Fashion Tips</title>
    <style>
        body {
            background: linear-gradient(135deg, #FFCAD4, #b6d8f0);
            color: #333;
            overflow-x: hidden;
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
    </style>
</head>
<body>
<?php include 'navbar.php'; ?>
<main class="d-flex justify-content-center align-items-center">
    <div class="card d-grid col-lg-7 col-12 m-3">
        <div class="d-flex gap-4">
            <img height="300" src="/proyek/asset/logo.png" alt="">
            <div class="d-grid">
                <h2>About us</h2>
                <p>Selamat datang di GLOWIFY! Kami adalah platform yang menginspirasi dan memberikan panduan seputar kecantikan, makeup, dan fashion. Dengan tujuan membantu setiap individu tampil lebih percaya diri, kami menyediakan artikel, tips, dan tutorial yang relevan dengan tren kecantikan terbaru. Bergabunglah dengan kami untuk menemukan inspirasi dan berbagi pengalaman dalam dunia kecantikan!</p>
            </div>
        </div>
    </div>
    </main>
</body>
</html>