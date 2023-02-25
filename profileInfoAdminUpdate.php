<?php
    require "db.php";

    $id = $_POST['id'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];

    if(empty($pass)){
        $con->query("UPDATE `users` SET `email`='$email' WHERE id='$id'");
    }else{
        $con->query("UPDATE `users` SET `email`='$email',`pass`='$pass' WHERE id='$id'");
    }
?>