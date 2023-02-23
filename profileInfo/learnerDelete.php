<?php
    require "../db.php";

    $id = $_POST['id'];

    $con->query("DELETE FROM `learning` WHERE id='$id'");
?>