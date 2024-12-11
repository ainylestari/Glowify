<?php
session_start();
$error = "";
if (!empty($_SESSION["error"])) {
    $error = $_SESSION["error"];
    unset($_SESSION["error"]); 
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="stylelogin.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Access Page</title>
    <style>
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

        .warning-message {
            position: fixed;
            top: 10px;
            left: 50%;
            transform: translateX(-50%);
            background-color: #f8d7da;
            color: #721c24;
            padding: 15px;
            border-radius: 5px;
            border: 1px solid #f5c6cb;
            text-align: center;
            z-index: 1000;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>

    <?php
    if ($error != "") { ?>
        <div class="warning-message">
            <?php echo $error ?>
        </div>
    <?php } ?>

    <a href="../index.php" class="btn-back"><i class="fa fa-arrow-left"></i></a>
    <div class="container" id="container">
        <div class="form-container sign-up">
            <form method="POST" action="cekregis.php">
                <h1>Create Account</h1>
                <br>
                <span>Use your email for registration</span>
                <input type="text" placeholder="Username" name="username">
                <input type="password" placeholder="Password" name="password">
                <button name="submit">Regist</button>
                <input type="hidden" name="action" value="regist">
            </form>
        </div>
        <div class="form-container sign-in">
            <form method="POST" action=" ceklogin.php">
                <h1>Sign In</h1>
                <br>
                <span>Use your email and password</span>
                <input type="text" placeholder="Username" name="username">
                <input type="password" placeholder="Password" name="password">
                <button name="submit">Sign In</button>
                <input type="hidden" name="action" value="login">
            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>💝Welcome Back!</h1>
                    <p>Enter your account details to continue your journey exploring beauty, fashion, and personal style.</p>
                    <button class="hidden" id="login">Sign In</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1>🎀Hello, BeautyEnt!</h1>
                    <p>Regist to access beauty tips, makeup tutorials, fashion inspiration, and a supportive community designed just for you.</p>
                    <button class="hidden" id="register">Regist</button>
                </div>
            </div>
        </div>
    </div>
    <script src="script.js"></script>
</body>

</html>