<?php
    require "../db.php";

    $id = $_POST['id'];

    $q = "DELETE FROM `civil` WHERE id='$id'";

    $con->query($q)
?>