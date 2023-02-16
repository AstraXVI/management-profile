<?php
    require "db.php";

    $id = $_POST['id'];

    $q = "DELETE FROM `profile` WHERE id='$id'";

    $con->query($q);
?>