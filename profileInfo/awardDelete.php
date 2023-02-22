<?php
    require "../db.php";

    $id = $_POST['id'];

    $con->query("DELETE FROM `award` WHERE id='$id'");
?>