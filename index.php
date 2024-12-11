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
        
        .navbar {
            background-color: white;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
        }
        .navbar-brand, .nav-link {
            color: #ff407d !important;
        }
        .nav-link {
            transition: color 0.3s ease;
        }
        .nav-link:hover {
            background-color: #b6d8f0 !important;
            height: 200%;
        }
        
        .container {
            margin-top: 150px;
            min-height: 100vh;
        }

        .shadow-custom {
            filter: url(#svg-shadow);
            border-radius: 30px;
            transition: transform 0.3s ease;
            max-width: 100%;
        }
        .shadow-custom:hover {
            transform: scale(1.05);
        }

        .fade-in {
            animation: fadeIn 1s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .content-wrapper {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        @media (min-width: 992px) {
            .content-wrapper {
                flex-direction: row;
                align-items: center;
                justify-content: center;
                text-align: left;
                gap: 2rem;
            }
            .content-wrapper img {
                max-width: 40%;
            }
            .text-content {
                max-width: 50%;
            }
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <div class="d-flex gap-3 align-items-center fw-bold">
                <img height="50" src="/proyek/asset/logo.png" alt="logo">
                <a class="navbar-brand fw-bold" href="#">Glowify</a>
            </div>
            <a class="nav-link btn btn-outline-primary rounded-pill px-4" href="loginregis/loginregis.php">Login</a>
        </div>
    </nav>

    <div class="container fade-in">
        <div class="content-wrapper gap-5">
            <svg width="0" height="0">
                <defs>
                    <filter id="svg-shadow" x="-50%" y="-50%" width="200%" height="200%">
                        <feGaussianBlur in="SourceAlpha" stdDeviation="50"/>
                        <feOffset dx="0" dy="10" result="offsetblur"/>
                        <feFlood flood-color="rgba(0, 0, 0, 0.3)"/>
                        <feComposite in2="offsetblur" operator="in"/>
                        <feMerge>
                            <feMergeNode/>
                            <feMergeNode in="SourceGraphic"/>
                        </feMerge>
                    </filter>
                </defs>
            </svg>            
        <img class="shadow-custom" width="25%" src="asset/produk.png" alt="icon">
            
            <div class="text-content">
                <h1 class="display-3 mb-3 fw-bold" style="color: #1B3C73">Glowify</h1>
                <h2 class="display-3 mb-3 fw-bold">Beauty and Fashion Tips</h2>
                <h3 class="fw-normal text-muted mb-3">Your Guide to Timeless Beauty and Modern Style</h3>
            </div>
        </div>
    </div>

</body>
</html>
