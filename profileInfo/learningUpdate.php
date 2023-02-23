<?php
    require "../db.php";

    $id = $_POST['id'];
    $title = $_POST['title'];
    $from = $_POST['from'];
    $to = $_POST['to'];
    $hrs = $_POST['hrs'];
    $typeOfLd = $_POST['typeOfLd'];
    $conducted = $_POST['conducted'];

    $q = "UPDATE `learning` SET `title`='$title',`dateFrom`='$from',`dateTo`='$to',`hours`='$hrs',`typeOfLd`='$typeOfLd',`conducted`='$conducted' WHERE id='$id'";

    $con->query($q);
?>