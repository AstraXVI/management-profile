<?php
    require "../db.php";

    $id = $_POST['id'];

    $getData = "SELECT * FROM `users` WHERE id='$id'";
    $list = $con->query($getData);
    $fetch = $list->fetch_assoc();

    $email = $fetch['email'];

    $con->query("DELETE FROM `educationalbg` WHERE email='$email'");

    $con->query("DELETE FROM users WHERE id='$id'");
?>