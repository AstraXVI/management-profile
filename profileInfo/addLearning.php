<?php
    require "../db.php";

    echo $email = $_POST['email'];
    echo $title = $_POST['title'];
    echo $from = $_POST['from'];
    echo $to = $_POST['to'];
    echo $hrs = $_POST['hrs'];
    echo $typeOfLd = $_POST['typeOfLd'];
    echo $conducted = $_POST['conducted'];

    $q = "INSERT INTO `learning`(`email`, `title`, `dateFrom`, `dateTo`, `hours`, `typeOfLd`, `conducted`) VALUES ('$email','$title','$from','$to','$hrs','$typeOfLd','$conducted')";

    $con->query($q);
?>