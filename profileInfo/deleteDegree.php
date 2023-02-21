<?php
    require "../db.php";

    $id = $_POST['id'];

    $con->query("DELETE FROM `educationaldegree` WHERE id='$id'");
?>