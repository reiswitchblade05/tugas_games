<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "dbusers");

// IF
if(isset($_POST["action"])){
    if($_POST["action"] == "register"){
        register();
    } else if($_POST["action"] == "login"){
        login();
    }
}

// REGISTER SCHEMATICS
function register(){
    global $conn;  

    $id = mt_rand(10000,100000);
    var_dump($id);
    $fullname = $_POST["fullname"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $creation = date("y-m-d");

    if(empty($fullname) || empty($username) || empty($password)){
        echo "Please Fill in the Application, Stupid baka -_-";
        exit;
    }

    $user = mysqli_query($conn, "SELECT * FROM db_gamers WHERE username = '$username'");
    if(mysqli_num_rows($user) > 0){
        echo "Username has already taken. Please insert a new one.";
        exit;
    }

    $query = "INSERT INTO db_gamers VALUES ('$id','$fullname','$username','$password','$creation')";
    mysqli_query($conn, $query);
    echo "Successful";
}

// LOGIN SCHEMATICS
function login(){
    global $conn;

    $username = $_POST["username"];
    $password = $_POST["password"];

    $user = mysqli_query($conn, "SELECT * FROM db_gamers WHERE username = '$username'");

    if (mysqli_num_rows($user) > 0){
        $row = mysqli_fetch_assoc($user);
        if($password == $row["password"]){
            echo "Entry Successful";
            $_SESSION["login"] = true;
            $_SESSION["id"] = $row["id"];
        } else {
            echo "Wrong Password";
            exit;
        }
    } else {
        echo "User Unregistered";
        exit;
    }
}
?>