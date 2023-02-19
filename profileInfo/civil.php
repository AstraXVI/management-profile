<?php
    require "../db.php";
    session_start();

    $email = $_POST['email'];

    $q = "SELECT * from civil where email='$email'";
    $list = $con->query($q);
    $info = $list->fetch_assoc();

    // echo $id;
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2 class="text-secondary fw-bold mb-3">Civil Service Eligibility</h2>


     <!-- get email profile -->
     <input type="hidden" value='<?php echo $info['email'] ?>' id='profileUserEmail'>
        <!--  -->

    <!-- Tabs navs -->
    <ul class="nav nav-tabs tabsss mb-3" id="ex1" style="font-size: 14px;" role="tablist">
    <li class="nav-item" role="presentation" id='profileProfileButton'>
        <a class="nav-link" id="ex1-tab-1" data-mdb-toggle="tab" href="#ex1-tabs-1" role="tab" aria-controls="ex1-tabs-1" aria-selected="true">Personal Information</a>
    </li>
    <li class="nav-item" role="presentation" id='profileEducationButton'>
        <a class="nav-link" id="ex1-tab-2" data-mdb-toggle="tab" href="#ex1-tabs-2" role="tab" aria-controls="ex1-tabs-2" aria-selected="false">Educational Background</a>
    </li>
    <li class="nav-item" role="presentation" id='profileCivilButton'>
        <a class="nav-link active" id="ex1-tab-3" data-mdb-toggle="tab" href="#ex1-tabs-3" role="tab" aria-controls="ex1-tabs-3" aria-selected="false">Civil Service Eligibility</a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link" id="ex1-tab-4" data-mdb-toggle="tab" href="#ex1-tabs-4" role="tab" aria-controls="ex1-tabs-4" aria-selected="false">Work Experience</a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link" id="ex1-tab-5" data-mdb-toggle="tab" href="#ex1-tabs-5" role="tab" aria-controls="ex1-tabs-5" aria-selected="false">Voluntary Work</a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link" id="ex1-tab-6" data-mdb-toggle="tab" href="#ex1-tabs-6" role="tab" aria-controls="ex1-tabs-6" aria-selected="false">Learning and Development</a>
    </li>
    </ul>

    <table class='table text-center'>
        <thead>
            <tr>
                <th>Career Service/RA 1080(Board/Bar) Under special Laws/CES/CSEE Barangay Eligibility / Driver License</th>
                <th>Rating (if applicable)</th>
                <th>Date of examination/Conferment</th>
                <th>Place of Examination/Conferment</th>
                <th colspan='2'>License (if applicable)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?php echo $info['careerService'] ?></td>
                <td><?php echo $info['rating'] ?></td>
                <td><?php echo $info['dateOfExam'] ?></td>
                <td><?php echo $info['placeOfExam'] ?></td>
                <td><?php echo $info['licenseNumber'] ?></td>
                <td><?php echo $info['licenseDateOfValidity'] ?></td>
            </tr>
        </tbody>
    </table>
    
    <button class='btn btn-info' data-bs-toggle="modal" data-bs-target="#updateCivilModal" value='<?php echo $info['email'] ?>'>Update data</button>
</body>
</html>