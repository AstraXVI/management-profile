<?php
    require "db.php";

    $id = $_POST['id'];
    $name = $_POST['name'];
    $bday = $_POST['bday'];
    $address = $_POST['address'];
    $employeeNo = $_POST['employeeNoEdit'];
    $placeBday = $_POST['placeOfBirthEdit'];
    $citizen = $_POST['citizenEdit'];
    $civil = $_POST['civilStatusEdit'];
    $zipcode = $_POST['zipcodeEdit'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $sex = $_POST['sex'];
    $yearSchoolHead = $_POST['yearSchoolHead'];
    $durationYear = $_POST['durationYear'];
    $inputLearningPerformance = $_POST['inputLearningPerformance'];
    $inputTeacherPerformance = $_POST['inputTeacherPerformance'];
    $inputFinancialMng = $_POST['inputFinancialMng'];
    $inputComplaints = $_POST['inputComplaints'];

    $q = "UPDATE `profile` SET `name`='$name',`bday`='$bday',`address`='$address',`email`='$email',`contactNo`='$contact',`sex`='$sex',`yearAsSchoolHead`='$yearSchoolHead',`duration`='$durationYear',`learnersPerf`='$inputLearningPerformance',`teacherPerf`='$inputTeacherPerformance',`financialMng`='$inputFinancialMng',`complaints`='$inputComplaints', `citizenship`='$citizen',`civil`='$civil',`zipcode`='$zipcode',`employeeNo`='$employeeNo',`placeBirth`='$placeBday' WHERE id='$id'";


    $con->query($q);
?>