<?php
    require "../db.php";

    $email = $_POST['email'];
    $cs = $_POST['cs'];
    $cc = $_POST['cc'];
    $cf = $_POST['cf'];
    $ct = $_POST['ct'];
    $ch = $_POST['ch'];
    $cy = $_POST['cy'];
    $cSc = $_POST['cSc'];
    $gs = $_POST["gs"];
    $gc = $_POST["gc"];
    $gf = $_POST["gf"];
    $gt = $_POST["gt"];
    $gh = $_POST["gh"];
    $gy = $_POST["gy"];
    $gSc = $_POST['gSc'];

    $q = "UPDATE `educationalbg` SET `schoolCollege`='$cs',`graduateStudies`='$gs',`collegeCourse`='$cc',`graduateCourse`='$gc',`collegeFrom`='$cf',`collegeTo`='$ct',`graduateFrom`='$gf',`graduateTo`='$gt',`collegeHigh`='$ch',`graduateHigh`='$gh',`collegeYear`='$cy',`graduateYear`='$gy',`collegeScholar`='$cSc',`graduateScholar`='$gSc' WHERE email='$email'";

    $con->query($q);
?>