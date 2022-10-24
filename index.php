<?php
    require 'functions.php';
    if (isset($_SESSION["id"])) {
        header("Location: game.php");
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enter</title>
    <link rel="stylesheet" href="css/styleentry.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<body style="background-image: url(asset/void.gif); background-size: cover;">
    <div class="container" style="width: 1000px; height: 100vh; background-color: white; opacity: 0.9;">
        <div class="login-box" id="enter">
            <h1>LOGIN</h1>
            <form autocomplete="off" action="" method="post" onsubmit="return false">
                <input type="hidden" id="actionentry" value="login">
                <div class="UN">
                    <p>Username</p>
                    <input type="text" id="usernameentry" name="Username" placeholder="username">
                    <p id="error-un" style="color: red; display: none;">Username Wajib diisi</p>
                </div>
                <div class="PS">
                    <p>Password</p>
                    <input type="password" id="passwordentry" name="Password" placeholder="password">
                    <p id="error-ps" style="color: red; display: none;">Password Wajib diisi</p>
                </div>
                <p class="reflip"><a href="register.php" style="color: black; text-decoration:none;">Register Here.</a></p>
                <div class="save-btn">
                    <button onmousedown="submitData()" type="submit" name="simpan">LOGIN</button>
                </div>
            </form>
        </div>
    </div>
    <script src="js/scriptlog.js"></script>
    <script src="js/jquery.js"></script>
</body>
</html>