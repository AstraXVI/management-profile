<?php
    require "db.php";

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

    $q = "INSERT INTO `profile`(`name`, `bday`, `address`, `email`, `contactNo`, `sex`, `yearAsSchoolHead`, `duration`, `learnersPerf`, `teacherPerf`, `financialMng`, `complaints`) VALUES ('$name','$bday','$address','$email','$contact','$sex','$yearSchoolHead','$durationYear','$inputLearningPerformance','$inputTeacherPerformance','$inputFinancialMng','$inputComplaints')";

    $con->query($q);

?>