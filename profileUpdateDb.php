<?php
    require "db.php";

    $id = $_POST['id'];
    $name = $_POST['name'];
    $bday = $_POST['bday'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $sex = $_POST['sex'];
    $yearSchoolHead = $_POST['yearSchoolHead'];
    $durationYear = $_POST['durationYear'];
    $inputLearningPerformance = $_POST['inputLearningPerformance'];
    $inputTeacherPerformance = $_POST['inputTeacherPerformance'];
    $inputFinancialMng = $_POST['inputFinancialMng'];
    $inputComplaints = $_POST['inputComplaints'];

    $q = "UPDATE `profile` SET `name`='$name',`bday`='$bday',`address`='$address',`email`='$email',`contactNo`='$contact',`sex`='$sex',`yearAsSchoolHead`='$yearSchoolHead',`duration`='$durationYear',`learnersPerf`='$inputLearningPerformance',`teacherPerf`='$inputTeacherPerformance',`financialMng`='$inputFinancialMng',`complaints`='$inputComplaints' WHERE id='$id'";

    $con->query($q);
?>