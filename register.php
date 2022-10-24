<?php
    require 'functions.php';
    if(isset($_SESSION["id"])){
      header("Location: index.php");
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">
</head>
<body style="background-image: url(asset/void.gif); background-size: cover;">
    <div class="container" style="width: 1000px; height: 100vh; background-color: white; opacity: 0.9;">
        <div class="register-box" id="regist">
            <h1>REGISTER</h1>
            <form autocomplete="off" action="" method="post">
                <input type="hidden" id="action" value="register">
                <div class="FN">
                    <p>Fullname</p>
                    <input type="text" id="fullname" placeholder="Fullname" name="fullname">
                    <p class="error-fn" style="color: red;"></p>
                </div>
                <div class="UN">
                    <p>Username</p>
                    <input type="text" id="username" placeholder="Username" name="username">
                    <p class="error-un" style="color: red;"></p>
                </div>
                <div class="PS">
                    <p>Password</p>
                    <input type="password" id="password" placeholder="Password" name="password">
                    <p class="error-ps" style="color: red;"></p>
                </div>
                <p class="flip"><a href="index.php" style="color: black; text-decoration:none;">Login Here.</a></p>
                <div class="apply-btn">
                    <button onmousedown="submitDatareg()" type="submit" name="simpan">REGISTER</button>
                </div>
            </form>
        </div>
    </div>
    <script src="js/scriptreg.js"></script>
    <script src="js/jquery.js"></script>
</body>
</html>