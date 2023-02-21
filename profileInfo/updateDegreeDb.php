<?php
    require "../db.php";

    $id = $_POST['id'];
    $degree = $_POST['degree'];
    $school = $_POST['school'];
    $educ = $_POST['educ'];
    $from = $_POST['from'];
    $to = $_POST['to'];
    $high = $_POST['high'];
    $year = $_POST['year'];
    $scholar = $_POST['scholar'];

    $q = "UPDATE `educationaldegree` SET `lvl`='$degree',`nameSchool`='$school',`education`='$educ',`periodFrom`='$from',`periodTo`='$to',`highLvl`='$high',`year`='$year',`scholar`='$scholar' WHERE id='$id'";

    $con->query($q);
?>