<?php
    require "../db.php";

    $id = $_POST['id'];
    $title = $_POST['title'];
    $lvl = $_POST['lvl'];
    $date = $_POST['date'];

    $q = "UPDATE `award` SET `title`='$title',`lvl`='$lvl',`date`='$date' WHERE id='$id'";

    $con->query($q)
?>