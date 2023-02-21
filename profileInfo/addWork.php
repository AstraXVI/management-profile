<?php
    require "../db.php";

    $email = $_POST['email'];
    $from = $_POST['from'];
    $to = $_POST['to'];
    $position = $_POST['position'];
    $department = $_POST['department'];
    $salary = $_POST['salary'];
    $job = $_POST['job'];
    $status = $_POST['status'];
    $service = $_POST['service'];

    $q = "INSERT INTO `work`(`email`,`dateFrom`, `dateTo`, `title`, `department`, `monthSalary`, `salary`, `statusApointment`, `govService`) VALUES ('$email','$from','$to','$position','$department','$salary','$job','$status','$service')";

    $con->query($q);
?>