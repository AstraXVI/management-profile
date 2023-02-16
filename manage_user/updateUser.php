<?php

    require "../db.php";

    $id = $_POST['id'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $role = $_POST['role'];
    $school = $_POST['school'];

    $q = "UPDATE `users` SET `email`='$email',`pass`='$pass',`role`='$role',`school`='$school' WHERE id='$id'";

    $con->query($q);

?>