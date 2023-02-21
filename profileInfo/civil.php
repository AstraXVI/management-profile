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
     <input type="hidden" value='<?php echo $email ?>' id='profileUserEmail'>
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
    <li class="nav-item" role="presentation" id='profileWorkExpBtn'>
        <a class="nav-link" id="ex1-tab-4" data-mdb-toggle="tab" href="#ex1-tabs-4" role="tab" aria-controls="ex1-tabs-4" aria-selected="false">Work Experience</a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link" id="ex1-tab-5" data-mdb-toggle="tab" href="#ex1-tabs-5" role="tab" aria-controls="ex1-tabs-5" aria-selected="false">Awards</a>
    </li>
    <li class="nav-item" role="presentation" id="profileLearningAndDevelopmentButton">
        <a class="nav-link" id="ex1-tab-6" data-mdb-toggle="tab" href="#ex1-tabs-6" role="tab" aria-controls="ex1-tabs-6" aria-selected="false">Learning and Development</a>
    </li>
    </ul>

    <button class="btn btn-primary my-3" data-bs-toggle="modal" data-bs-target="#civilAddData"><i class="fa-solid fa-plus text-light me-2"></i>Add Civil Service Eligibility</button>

    <table class='table text-center table-striped bg-light'>
        <thead>
            <tr>
                <th>Career Service/RA 1080(Board/Bar) Under special Laws/CES/CSEE Barangay Eligibility / Driver License</th>
                <th>Rating (if applicable)</th>
                <th>Date of examination/Conferment</th>
                <th>Place of Examination/Conferment</th>
                <th colspan='2'>License (if applicable)</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if($list->num_rows){ ?>
                <?php do{ ?>
                    <tr>
                        <td><?php echo $info['careerService'] ?></td>
                        <td><?php echo $info['rating'] ?></td>
                        <td><?php echo $info['dateOfExam'] ?></td>
                        <td><?php echo $info['placeOfExam'] ?></td>
                        <td><?php echo $info['licenseNumber'] ?></td>
                        <td><?php echo $info['licenseDateOfValidity'] ?></td>
                        <td>
                            <div class="d-flex gap-2">
                                <button class='btn btn-info btn-sm' data-bs-toggle="modal" data-bs-target="#civilModalEditModal" value='<?php echo $info['id'] ?>' id='editCivilModalButton'><i class="fa-solid fa-pen text-light"></i></button>
                                <button value='<?php echo $info['id'] ?>' id='civilDeleteButtonDB' class='btn btn-danger btn-sm'><i class="fa-solid fa-trash"></i></button>
                            </div>
                        </td>
                    </tr>
                <?php }while($info = $list->fetch_assoc()) ?>
            <?php }else{ ?>
                <tr>
                    <td colspan='7'>No data</td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    
    <!-- <button class='btn btn-info' data-bs-toggle="modal" data-bs-target="#updateCivilModal" value='<?php echo $info['email'] ?>'>Update data</button> -->
</body>
</html>