<?php
    require "../db.php";

    $email = $_POST['email'];
    $degree = $_POST['degree'];
    $school = $_POST['school'];
    $educ = $_POST['educ'];
    $from = $_POST['from'];
    $to = $_POST['to'];
    $high = $_POST['high'];
    $year = $_POST['year'];
    $scholar = $_POST['scholar'];

    $q = "INSERT INTO `educationaldegree`(`email`, `lvl`, `nameSchool`, `education`, `periodFrom`, `periodTo`, `highLvl`, `year`, `scholar`) VALUES ('$email','$degree','$school','$educ','$from','$to','$high','$year','$scholar')";

    $con->query($q);
?>