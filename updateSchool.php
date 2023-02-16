<?php
    require "db.php";

    $id = $_POST['id'];
    // $schoolNameEdit = $_POST['schoolNameEdit'];
    // $principalEdit = $_POST['principalEdit'];
    // $addressEdit = $_POST['addressEdit'];
    // $contactEdit = $_POST['contactEdit'];
    $schoolName = $_POST['schoolName'];
    $schoolID = $_POST['schoolID'];
    $contactPerson = $_POST['contactPerson'];
    $contactNo = $_POST['contactNo'];
    $email = $_POST['email'];
    $division = $_POST['division'];
    $schoolType = $_POST['schoolType'];
    $district = $_POST['district'];
    $level = $_POST['schoolLevel'];

    // echo $id,$schoolNameEdit, $principalEdit,$addressEdit,$contactEdit;

    // $q = "UPDATE `schools` SET `school_name`='$schoolNameEdit',`address`='$addressEdit',`principal`='$principalEdit',`contact`='$contactEdit' WHERE id='$id'";
    $q = "UPDATE `schools` SET `school_name`='$schoolName',`school_id`='$schoolID',`division`='$division',`school_type`='$schoolType',`contact_person`='$contactPerson',`contact_no`='$contactNo',`email`='$email',`district`='$district',`level`='$level'  WHERE id='$id'";

    $con->query($q);
?>