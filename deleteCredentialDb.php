<?php

    require "db.php";

    echo $id = $_POST['id'];

    $con->query("DELETE FROM `credential` WHERE id='$id'");
?>