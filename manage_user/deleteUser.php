<?php
    require "../db.php";

    $id = $_POST['id'];

    $con->query("DELETE FROM users WHERE id='$id'");
?>