<?php
    require "../db.php";

    $id = $_POST['id'];

    $con->query("DELETE FROM `work` WHERE id='$id'");
?>