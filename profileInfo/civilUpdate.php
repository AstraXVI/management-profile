<?php
    require "../db.php";

    $id = $_POST['id'];
    $career = $_POST['career'];
    $rt = $_POST['rating'];
    $Dexam = $_POST['dateExam'];
    $Pexam = $_POST['placeExam'];
    $Ldate = $_POST['Ldate'];
    $Lnumber = $_POST['Lnumber'];

    $q = "UPDATE `civil` SET `careerService`='$career',`rating`='$rt',`dateOfExam`='$Dexam',`placeOfExam`='$Pexam',`licenseNumber`='$Lnumber',`licenseDateOfValidity`='$Ldate' WHERE id='$id'";

    $con->query($q)
?>