<?php
    require "../db.php";

    $email = $_POST['email'];
    $title = $_POST['title'];
    $lvl = $_POST['lvl'];
    $date = $_POST['date'];

    // $q = "INSERT INTO `award`(`email`, `title`, `lvl`, `date`) VALUES ('$email','$title','$lvl','$date')";

    // $con->query($q)

    $target_dir = "uploads/credentials";
    $target_file = $target_dir . basename($_FILES["file"]["name"]);

    move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);

    $q = "INSERT INTO `award`(`email`, `title`, `lvl`, `date`, `pic`) VALUES ('$email','$title','$lvl','$date','$target_file')";
    
    $con->query($q);

?>