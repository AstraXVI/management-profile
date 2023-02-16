<?php
    require "../db.php";

    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $role = $_POST['role'];
    $school = $_POST['school'];

    $q = "INSERT INTO `users`(`email`, `pass`, `role`, `school`) VALUES ('$email','$pass','$role','$school')";

    $con->query($q);
?>