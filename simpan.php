<?php
    include 'koneksi.php';

    if(isset($_POST['simpan'])){
        $Id = rand(10000, 100000);
        var_dump($id);
        $Fullname = $_POST['Fullname'];
        $Username = $_POST['Fullname'];
        $Password = $_POST['Fullname'];
        $Created_At = date("Y-m-d");

        $sql = "INSERT INTO db_users ('Id', 'Fullname', 'Username', 'Password', 'Created_At')
        VALUES ('$Id', '$Fullname', '$Username', '$Password' ,'$Created_At')";

        $query = mysqli_query($connect, $sql);

        if($query){
            header('Location: index.php');
        }else{
            header('Location: simpan.php?status=gagal');
        }
    }
?>