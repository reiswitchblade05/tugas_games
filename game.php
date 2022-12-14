<?php
    require 'functions.php';
    if(isset($_SESSION["id"])){
        $id = $_SESSION["id"];
        $user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM db_gamers WHERE id = $id"));
    } else {
        header("Location: index.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/stylegame.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    
    <div>
        <div class="form" id="inputform">
        <div class="title">
            <h1 style="color: red;">☣ HELL'S GATES ☣</h1>
            <p style="color: red; font-style: italic;">"Keluar Tanduknya, Trus Ekornya Melayang. wadidaw :v"</p>
            <p style="color: red;">- Pak Agus, September 2022 😉</p>
        </div>
        <div class="game-input">
            <p style="color: red;">Player : <?= $user['username'];?> #<?= $user['id'] ?></p><br>
            <div style="display: flex; align-items: center; "> 
                <p style="color: red;">Pilih Warna : </p><input style="margin-left: 15px; width: 50px;" type="color" id="warna">
            </div> 
            <div style="font-weight: bold;">
                <button class="btn1" onclick="expel()" style="font-weight: bold; border: 1px solid red; margin-top: 15px; color: red; padding: 5px; border-radius: 10px; background: none;">Logout</button><button class="btn2" style="font-weight: bold; border: 1px solid red; margin-left: 385px; color: red; padding: 5px; border-radius: 10px; background: none;" onclick="Play(), startGame()">Start</button>
            </div>
        </div>
        </div>
        <div class="footer" style="font-weight: bold;">
            <p>🙂 Developed by : RAFI REI RIORDAN 🥰</p>
        </div>
    </div>
    <div id="content" style="display: none;">
    <p id="gamer" style="font-weight: bold; position: absolute;z-index: 3; left: 3%; ">Player : <?= $user['username'];?> #<?= $user['id'] ?></p>
    <div id="area"><canvas id="game" style="display: none;"></canvas></div>
        <p class="crash" id="failure" style="display: none;">YOU HAVE FAILED. What action do you want to take?</p>
        <div id="buttons" style="display: none; text-align:center; width:600px; margin-left: 375px; margin-top: 25px;">
            <button onclick="reset()" style="background-color: black; color: red; border: 1px solid red; padding: 5px; border-radius: 7px; font-size: 21px; margin-top: 10px;">≪ TRY AGAIN</button>
            <button onclick="quit()" style="background-color: black; color: red; border: 1px solid red; padding: 5px; border-radius: 7px; font-size: 21px; margin-top: 10px; margin-left: 10px;">⊝ EXIT</button>
        </div>
    </div>
    <script>
        var myGamePiece;
        var myObstacles = [];
        var myScore;
        var player = document.getElementById("gamer");

        function Play(){

            document.getElementById("inputform").style.display = "none";
            document.getElementById("content").style.display = "block";
            document.getElementById("game").style.display = "block";
            document.getElementById("buttons").style.display = "none";
            document.getElementById("failure").style.display = "none";

            var a = document.getElementById("warna").value;
            myGamePiece = new component(30, 30, a, 10, 130);
            myScore = new component("30px", "Space Mono", "white", 1000, 40, "text");
            myGameArea.start();
            player.style.color = a;
            myObstacles = [];
        }
    
            var myGameArea = {
                canvas : document.getElementById("game"),
                start : function() {
                    this.canvas.width = 1300;
                    this.canvas.height = 360;
                    this.context = this.canvas.getContext("2d");
                    document.getElementById("area").insertBefore(this.canvas, document.getElementById("area").childNodes[0]);
                    this.frameNo = 0;
                    this.interval = setInterval(updateGameArea, 20);
                    window.addEventListener("keydown", function(c){
                        myGameArea.key = c.keyCode;
                    })
                    window.addEventListener("keyup", function(){
                        myGameArea.key = false;
                    })
                    },
                clear : function() {
                    this.context.clearRect(0, 0, this.canvas.width, this.canvas.height);
                },
                stop : function() {
                    clearInterval(this.interval);
                }
            }
            
            function component(width, height, color, x, y, type) {
                this.type = type;
                this.width = width;
                this.height = height;
                this.speedX = 0;
                this.speedY = 0;    
                this.x = x;
                this.y = y;    
                this.update = function() {
                    ctx = myGameArea.context;
                    if (this.type == "text") {
                        ctx.font = this.width + " " + this.height;
                        ctx.fillStyle = color;
                        ctx.fillText(this.text, this.x, this.y);
                    } else {
                        ctx.fillStyle = color;
                        ctx.fillRect(this.x, this.y, this.width, this.height);
                    }
                }
                this.newPos = function() {
                    this.x += this.speedX;
                    this.y += this.speedY;        
                }
                this.crashWith = function(otherobj) {
                    var myleft = this.x;
                    var myright = this.x + (this.width);
                    var mytop = this.y;
                    var mybottom = this.y + (this.height);
                    var otherleft = otherobj.x;
                    var otherright = otherobj.x + (otherobj.width);
                    var othertop = otherobj.y;
                    var otherbottom = otherobj.y + (otherobj.height);
                    var crash = true;
                    if ((mybottom < othertop) || (mytop > otherbottom) || (myright < otherleft) || (myleft > otherright)) {
                        crash = false;
                    }
                    return crash;
                }
            }
            
            function updateGameArea() {
                var x, height, gap, minHeight, maxHeight, minGap, maxGap;
                for (i = 0; i < myObstacles.length; i += 1) {
                    if (myGamePiece.crashWith(myObstacles[i])) {
                        document.getElementById("game").style.filter = "grayscale(100%)";
                        document.getElementById("failure").style.display = "block";
                        document.getElementById("buttons").style.display = "block";
                        document.getElementById("gamer").style.filter = "grayscale(100%)";
                        myGameArea.stop();
                        return;
                    } 
                }
                myGameArea.clear();
                myGamePiece.speedX = 0;
                myGamePiece.speedY = 0;
            
                if(myGameArea.key && myGameArea.key == 87){
                    myGamePiece.speedY = -3;
                }
                if(myGameArea.key && myGameArea.key == 83){
                    myGamePiece.speedY = 3;
                }
            
                myGameArea.frameNo += 1;
                if (myGameArea.frameNo == 1 || everyinterval(45)) {
                    x = myGameArea.canvas.width;
                    minHeight = 20;
                    maxHeight = 200;
                    height = Math.floor(Math.random()*(maxHeight-minHeight+1)+minHeight);
                    minGap = 50;
                    maxGap = 200;
                    gap = Math.floor(Math.random()*(maxGap-minGap+1)+minGap);
                    myObstacles.push(new component(15, height, "#FF4500", x, 0));
                    myObstacles.push(new component(15, x - height - gap, "#FF4500", x, height + gap));
                }
                for (i = 0; i < myObstacles.length; i += 1) {
                    myObstacles[i].speedX = -11;
                    myObstacles[i].newPos();
                    myObstacles[i].update();
                }
                myScore.text="SCORE: " + myGameArea.frameNo;
                myScore.update();
                myGamePiece.newPos();    
                myGamePiece.update();
            }
            
            function everyinterval(n) {
                if ((myGameArea.frameNo / n) % 1 == 0) {return true;}
                return false;
            }
            
            function moveup() {
                myGamePiece.speedY = -5; 
            }
            
            function movedown() {
                myGamePiece.speedY = 5; 
            }
            
            function clearmove() {
                myGamePiece.speedX = 0; 
                myGamePiece.speedY = 0; 
            }
            
            function quit(){
                location.reload();
            }

            function reset(){
                document.getElementById("game").style.filter = "grayscale(0%)";
                document.getElementById("gamer").style.filter = "grayscale(0%)";
                myGameArea.stop();
                myGameArea.clear();
                Play();
            }

            function expel(){
                window.location.href = 'logout.php';
            }
    </script>
</body>
</html>