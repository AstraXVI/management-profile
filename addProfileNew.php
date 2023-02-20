<?php
    require "db.php";

    $name = $_POST['name'];
    $bday = $_POST['bday'];
    $address = $_POST['address'];
    $citizen = $_POST['citizen'];
    $civilStatus = $_POST['civilStatus'];
    $zipcode = $_POST['zipcode'];
    $employeeNo = $_POST['employeeNo'];
    $placeOfBirth = $_POST['placeOfBirth'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $sex = $_POST['sex'];
    $yearSchoolHead = $_POST['yearSchoolHead'];
    $durationYear = $_POST['durationYear'];
    $inputLearningPerformance = $_POST['inputLearningPerformance'];
    $inputTeacherPerformance = $_POST['inputTeacherPerformance'];
    $inputFinancialMng = $_POST['inputFinancialMng'];
    $inputComplaints = $_POST['inputComplaints'];
    $school = $_POST['school'];

    $q = "INSERT INTO `profile`(`name`, `bday`, `address`, `email`, `contactNo`, `sex`, `yearAsSchoolHead`, `duration`, `learnersPerf`, `teacherPerf`, `financialMng`, `complaints`, `school`, `citizenship`, `civil`, `zipcode`, `employeeNo`, `placeBirth`) VALUES ('$name','$bday','$address','$email','$contact','$sex','$yearSchoolHead','$durationYear','$inputLearningPerformance','$inputTeacherPerformance','$inputFinancialMng','$inputComplaints','$school', '$citizen','$civilStatus','$zipcode','$employeeNo','$placeOfBirth')";

    $con->query($q);

    // ADD EDUCATION EMAIL
    $w = "INSERT INTO `educationalbg`(`email`) VALUES ('$email')";
    $con->query($w);

    // // ADD CIVIL
    // $c = "INSERT INTO `civil`(`email`) VALUES ('$email')";
    // $con->query($c);

?>