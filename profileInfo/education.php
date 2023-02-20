<?php
    require "../db.php";
    session_start();

    $id = $_POST['id'];

    $q = "SELECT * from educationalbg where email='$id'";
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
    <h2 class="text-secondary fw-bold mb-3">Educational Background</h2>


     <!-- get email profile -->
     <input type="hidden" value='<?php echo $info['email'] ?>' id='profileUserEmail'>
        <!--  -->

    <!-- Tabs navs -->
    <ul class="nav nav-tabs tabsss mb-3" id="ex1" style="font-size: 14px;" role="tablist">
    <li class="nav-item" role="presentation" id='profileProfileButton'>
        <a class="nav-link" id="ex1-tab-1" data-mdb-toggle="tab" href="#ex1-tabs-1" role="tab" aria-controls="ex1-tabs-1" aria-selected="true">Personal Information</a>
    </li>
    <li class="nav-item" role="presentation" id='profileEducationButton'>
        <a class="nav-link active" id="ex1-tab-2" data-mdb-toggle="tab" href="#ex1-tabs-2" role="tab" aria-controls="ex1-tabs-2" aria-selected="false">Educational Background</a>
    </li>
    <li class="nav-item" role="presentation" id='profileCivilButton'>
        <a class="nav-link" id="ex1-tab-3" data-mdb-toggle="tab" href="#ex1-tabs-3" role="tab" aria-controls="ex1-tabs-3" aria-selected="false">Civil Service Eligibility</a>
    </li>
    <li class="nav-item" role="presentation" id='profileWorkExpBtn'>
        <a class="nav-link" id="ex1-tab-4" data-mdb-toggle="tab" href="#ex1-tabs-4" role="tab" aria-controls="ex1-tabs-4" aria-selected="false">Work Experience</a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link" id="ex1-tab-5" data-mdb-toggle="tab" href="#ex1-tabs-5" role="tab" aria-controls="ex1-tabs-5" aria-selected="false">Voluntary Work</a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link" id="ex1-tab-6" data-mdb-toggle="tab" href="#ex1-tabs-6" role="tab" aria-controls="ex1-tabs-6" aria-selected="false">Learning and Development</a>
    </li>
    </ul>

    <table class='table text-center bg-light table-striped p-2'>
        <thead>
            <tr>
                <th>Level</th>
                <th>Name of School</th>
                <th>Basic Education/Degree/Course</th>
                <th colspan='2'>Period of attendance</th>
                <th>Highest Level/Unit Earned</th>
                <th>Year Graduate</th>
                <th>Scholarship/Academic Honors Received</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th>Elementary</th>
                <td><?php echo $info['elemSchool'] ?></td>
                <td><?php echo $info['elemEduc'] ?></td>
                <td><?php echo $info['elemFrom'] ?></td>
                <td><?php echo $info['elemTo'] ?></td>
                <td><?php echo $info['elemHighLvl'] ?></td>
                <td><?php echo $info['elemGraduate'] ?></td>
                <td><?php echo $info['elemScholar'] ?></td>
            </tr>
            <tr>
                <th>Secondary</th>
                <td><?php echo $info['secSchool'] ?></td>
                <td><?php echo $info['secEduc'] ?></td>
                <td><?php echo $info['secFrom'] ?></td>
                <td><?php echo $info['secTo'] ?></td>
                <td><?php echo $info['secHighLvl'] ?></td>
                <td><?php echo $info['secGraduate'] ?></td>
                <td><?php echo $info['secScholar'] ?></td>
            </tr>
            <tr>
                <th>Vocational/Trade course</th>
                <td><?php echo $info['vocSchool'] ?></td>
                <td><?php echo $info['vocEduc'] ?></td>
                <td><?php echo $info['vocFrom'] ?></td>
                <td><?php echo $info['vocTo'] ?></td>
                <td><?php echo $info['vocHighLvl'] ?></td>
                <td><?php echo $info['vocGraduate'] ?></td>
                <td><?php echo $info['vocScholar'] ?></td>
            </tr>
            <tr>
                <th>College</th>
                <td><?php echo $info['schoolCollege'] ?></td>
                <td><?php echo $info['collegeCourse'] ?></td>
                <td><?php echo $info['collegeFrom'] ?></td>
                <td><?php echo $info['collegeTo'] ?></td>
                <td><?php echo $info['collegeHigh'] ?></td>
                <td><?php echo $info['collegeYear'] ?></td>
                <td><?php echo $info['collegeScholar'] ?></td>
            </tr>
            <tr>
                <th>Graduate Studies</th>
                <td><?php echo $info['graduateStudies'] ?></td>
                <td><?php echo $info['graduateCourse'] ?></td>
                <td><?php echo $info['graduateFrom'] ?></td>
                <td><?php echo $info['graduateTo'] ?></td>
                <td><?php echo $info['graduateHigh'] ?></td>
                <td><?php echo $info['graduateYear'] ?></td>
                <td><?php echo $info['graduateScholar'] ?></td>
            </tr>
        </tbody>
    </table>
    
    <button class='btn btn-info' data-bs-toggle="modal" data-bs-target="#updateEducationModal" value='<?php echo $id ?>' id='updateProfileEducationButton'>Update data</button>
</body>
</html>