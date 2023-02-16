<?php
    require "db.php";

    $id = $_POST["id"];
    $email = $_POST["email"];
    $newPass = $_POST["newPass"];

    $q = "UPDATE `users` SET `email`='$email',`pass`='$newPass' WHERE id='$id'";

    $con->query($q);
?>