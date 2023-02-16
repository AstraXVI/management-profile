<?php
    require "../db.php";

    $id = $_POST['id'];

    // echo $id;
    $con->query("DELETE FROM `equipment` WHERE id='$id'");
?>