<?php
    require "../db.php";

    $email = $_POST['email'];
    $title = $_POST['title'];
    $lvl = $_POST['lvl'];
    $date = $_POST['date'];

    $q = "INSERT INTO `award`(`email`, `title`, `lvl`, `date`) VALUES ('$email','$title','$lvl','$date')";

    $con->query($q)
?>