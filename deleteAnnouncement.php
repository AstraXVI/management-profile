<?php

    require "db.php";

    echo $id = $_POST['id'];

    $con->query("DELETE FROM `announcement` WHERE id='$id'");
?>