<?php
    require "db.php";

    $id = $_POST['id'];

    // TO GET THE SCHOOL OF THE DELETED SCHOOL
    $q = "SELECT * FROM `schools` WHERE id='$id'";
    $list = $con->query($q);
    $fetch = $list->fetch_assoc();
    $schoolName = $fetch['school_name'];

    // DELETE ALL EQUIPMENT OF THAT SCHOOL
    $con->query("DELETE FROM `equipment` WHERE school='$schoolName'");

    // DELETE SCHOOL
    $con->query("DELETE FROM `schools` WHERE id='$id'");
?>