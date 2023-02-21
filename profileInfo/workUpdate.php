<?php
    require "../db.php";

    $id = $_POST['id'];

    $from = $_POST['from'];
    $to = $_POST['to'];
    $position = $_POST['position'];
    $department = $_POST['department'];
    $salary = $_POST['salary'];
    $job = $_POST['job'];
    $status = $_POST['status'];
    $service = $_POST['service'];

    $q = "UPDATE `work` SET `dateFrom`='$from',`dateTo`='$to',`title`='$position',`department`='$department',`monthSalary`='$salary',`salary`='$job',`statusApointment`='$status',`govService`='$service' WHERE id='$id'";

    $con->query($q);
?>