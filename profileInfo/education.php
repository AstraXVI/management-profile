<?php
    require "../db.php";
    session_start();

    $id = $_POST['id'];

    $q = "SELECT * from educationalbg where email='$id'";
    $list = $con->query($q);
    $info = $list->fetch_assoc();

    $getDegree = "SELECT * FROM educationaldegree WHERE email ='$id'";
    $listDegree = $con->query($getDegree);
    $fetchDegree = $listDegree->fetch_assoc();
    
    // GET NAME
    $name = "SELECT * from profile where email='$id'";
    $listName = $con->query($name);
    $infoName = $listName->fetch_assoc();

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
    <h2 class="text-secondary fw-bold mb-3">Educational Background <?php if($_SESSION['status'] == 'Admin') echo "| ".$infoName['name'] ?></h2>


     <!-- get email profile -->
     <input type="hidden" value='<?php echo $info['email'] ?>' id='profileUserEmail'>
    <!--  -->

    <!-- get user email -->
    <input type="hidden" value="<?php echo $id ?>" id='userEmailProfile'>
    <!--  -->

    <!-- get user email -->
    <input type="hidden" value="<?php echo $id ?>" id='degreeUserEmail'>
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
    <li class="nav-item" role="presentation" id='profileAwardExpBtn'>
        <a class="nav-link" id="ex1-tab-5" data-mdb-toggle="tab" href="#ex1-tabs-5" role="tab" aria-controls="ex1-tabs-5" aria-selected="false">Awards</a>
    </li>
    <li class="nav-item" role="presentation" id="profileLearningAndDevelopmentButton">
        <a class="nav-link" id="ex1-tab-6" data-mdb-toggle="tab" href="#ex1-tabs-6" role="tab" aria-controls="ex1-tabs-6" aria-selected="false">Learning and Development</a>
    </li>
    </ul>

    <div class="d-flex justify-content-between mb-3">
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addDegreeModalButton"><i class="fa-solid fa-plus me-2"></i>Add Degree</button>
        <button class='btn btn-info' data-bs-toggle="modal" data-bs-target="#updateEducationModal" value='<?php echo $id ?>' id='updateProfileEducationButton'>Update data</button>
    </div>

    <div style="max-height: 61vh; overflow-y: scroll">
        <table class='table text-center table-responsive table-striped p-2 bg-light'>
            <thead>
                <tr>
                    <th>Level</th>
                    <th>Name of School</th>
                    <th>Basic Education/Degree/Course</th>
                    <th colspan='2'>Period of attendance <br><span class="me-4 text-primary" style="font-size: 14px">From</span><span class="ms-4 text-primary" style="font-size: 14px">To</span></th>
                    <th>Highest Level/Unit Earned</th>
                    <th>Year Graduate</th>
                    <th>Scholarship/Academic Honors Received</th>
                    <th>Action</th>
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
                    <td>
                        <!-- <button class='btn btn-info' data-bs-toggle="modal" data-bs-target="#updateEducationModal" value='<?php echo $id ?>' id='updateProfileEducationButton'>Update data</button> -->
                    </td>
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
                    <td></td>
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
                    <td></td>
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
                    <td></td>
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
                    <td></td>
                </tr>
                <?php if($listDegree->num_rows){ ?>
                    <?php do{ ?>
                        <tr>
                            <th><?php echo $fetchDegree['lvl'] ?></th>
                            <td><?php echo $fetchDegree['nameSchool'] ?></td>
                            <td><?php echo $fetchDegree['education'] ?></td>
                            <td><?php echo $fetchDegree['periodFrom'] ?></td>
                            <td><?php echo $fetchDegree['periodTo'] ?></td>
                            <td><?php echo $fetchDegree['highLvl'] ?></td>
                            <td><?php echo $fetchDegree['year'] ?></td>
                            <td><?php echo $fetchDegree['scholar'] ?></td>
                            <td>
                                <div class="d-flex gap-2">
                                    <button class='btn btn-info text-light btn-sm' data-bs-toggle="modal" data-bs-target="#editDegreeModalProfie" value='<?php echo $fetchDegree['id'] ?>' id='editButonDegreeModal'><i class="fa-solid fa-pen"></i></button>
                                    <button class='btn btn-danger btn-sm' value='<?php echo $fetchDegree['id'] ?>' id='deleteButonDegreeModal'><i class="fa-solid fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                    <?php }while($fetchDegree = $listDegree->fetch_assoc()) ?>
                <?php } ?>
            </tbody>
        </table>
    </div>
    
</body>
</html>