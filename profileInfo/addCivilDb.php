<?php
    require "../db.php";

    $email = $_POST['email'];

    $career = $_POST['career'];
    $rt = $_POST['rating'];
    $Dexam = $_POST['dateExam'];
    $Pexam = $_POST['placeExam'];
    $Ldate = $_POST['Ldate'];
    $Lnumber = $_POST['Lnumber'];

    $q = "INSERT INTO `civil`(`email`, `careerService`, `rating`, `dateOfExam`, `placeOfExam`, `licenseNumber`, `licenseDateOfValidity`) VALUES ('$email','$career','$rt','$Dexam','$Pexam','$Ldate','$Lnumber')";

    $con->query($q)
?>