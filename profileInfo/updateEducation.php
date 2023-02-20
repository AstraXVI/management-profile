<?php
    require "../db.php";

    $email = $_POST['email'];
    // elementary
    $es  =  $_POST['es'];
    $ec  =  $_POST['ec'];
    $ef  =  $_POST['ef'];
    $et  =  $_POST['et'];
    $eh  =  $_POST['eh'];
    $ey  =  $_POST['ey'];
    $eSc  =  $_POST['eSc'];
    // secondary
    $ss = $_POST['ss'];
    $sc = $_POST['sc'];
    $sf = $_POST['sf'];
    $st = $_POST['st'];
    $sh = $_POST['sh'];
    $sy = $_POST['sy'];
    $sSh = $_POST['sSc'];
    // Vocational
    $vs = $_POST['vs'];
    $vc = $_POST['vc'];
    $vf = $_POST['vf'];
    $vt = $_POST['vt'];
    $vh = $_POST['vh'];
    $vy = $_POST['vy'];
    $vSh = $_POST['vSc'];
    // college
    $cs = $_POST['cs'];
    $cc = $_POST['cc'];
    $cf = $_POST['cf'];
    $ct = $_POST['ct'];
    $ch = $_POST['ch'];
    $cy = $_POST['cy'];
    $cSc = $_POST['cSc'];
    // graduate study
    $gs = $_POST["gs"];
    $gc = $_POST["gc"];
    $gf = $_POST["gf"];
    $gt = $_POST["gt"];
    $gh = $_POST["gh"];
    $gy = $_POST["gy"];
    $gSc = $_POST['gSc'];



    $q = "UPDATE `educationalbg` SET `schoolCollege`='$cs',`graduateStudies`='$gs',`collegeCourse`='$cc',`graduateCourse`='$gc',`collegeFrom`='$cf',`collegeTo`='$ct',`graduateFrom`='$gf',`graduateTo`='$gt',`collegeHigh`='$ch',`graduateHigh`='$gh',`collegeYear`='$cy',`graduateYear`='$gy',`collegeScholar`='$cSc',`graduateScholar`='$gSc',`elemSchool`='$es',`secSchool`='$ss',`vocSchool`='$vs',`elemEduc`='$ec',`secEduc`='$sc',`vocEduc`='$vs',`elemFrom`='$ef',`secFrom`='$sf',`vocFrom`='$vf',`elemTo`='$et',`secTo`='$st',`vocTo`='$vt',`elemHighLvl`='$eh',`secHighLvl`='$sh',`vocHighLvl`='$vh',`elemGraduate`='$ey',`secGraduate`='$sy',`vocGraduate`='$vy',`elemScholar`='$eSc',`secScholar`='$sSh',`vocScholar`='$vSh' WHERE email='$email'";

    $con->query($q);
?>