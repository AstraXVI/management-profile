<?php
    require "../db.php";
    session_start();

    $email = $_POST['email'];

    $q = "SELECT * from work where email='$email'";
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
    <h2 class="text-secondary fw-bold mb-3">Work Experience</h2>


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
        <a class="nav-link" id="ex1-tab-3" data-mdb-toggle="tab" href="#ex1-tabs-3" role="tab" aria-controls="ex1-tabs-3" aria-selected="false">Civil Service Eligibility</a>
    </li>
    <li class="nav-item" role="presentation" id='profileWorkExpBtn'>
        <a class="nav-link active" id="ex1-tab-4" data-mdb-toggle="tab" href="#ex1-tabs-4" role="tab" aria-controls="ex1-tabs-4" aria-selected="false">Work Experience</a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link" id="ex1-tab-5" data-mdb-toggle="tab" href="#ex1-tabs-5" role="tab" aria-controls="ex1-tabs-5" aria-selected="false">Voluntary Work</a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link" id="ex1-tab-6" data-mdb-toggle="tab" href="#ex1-tabs-6" role="tab" aria-controls="ex1-tabs-6" aria-selected="false">Learning and Development</a>
    </li>
    </ul>

    <button class="btn btn-primary my-3" data-bs-toggle="modal" data-bs-target="#workAddData">Add Work Experience</button>

    <table class='table text-center bg-light'>
        <thead style="background-color: #dcdcdc;">
            <tr>
               <th colspan='2'>Inclusive Dates (mm/dd/yyyy)</th>
               <th>Position Title (Write in full/ Do not abbreviate)</th>
               <th>Department/Agency/Office/Company (Write in full/ Do not abbreviate)</th>
               <th>Monthly Salary</th>
               <th>Salary/Job/Pay Grade</th>
               <th>Status of appointment</th>
               <th>Gov't Service (Y/N)</th>
               <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if($list->num_rows){ ?>
                <?php do{ ?>
                    <tr>
                        <td><?php echo $info['dateFrom'] ?></td>
                        <td><?php echo $info['dateTo'] ?></td>
                        <td><?php echo $info['title'] ?></td>
                        <td><?php echo $info['department'] ?></td>
                        <td><?php echo $info['monthSalary'] ?></td>
                        <td><?php echo $info['salary'] ?></td>
                        <td><?php echo $info['statusApointment'] ?></td>
                        <td><?php echo $info['govService'] ?></td>
                        <td>
                            <button class='btn btn-info'>Edit</button>
                            <button class='btn btn-danger'>Delete</button>
                        </td>
                    </tr>
                <?php }while($info = $list->fetch_assoc()) ?>
            <?php }else{ ?>
                <tr>
                    <td colspan='9'>No data</td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    
    <!-- <button class='btn btn-info' data-bs-toggle="modal" data-bs-target="#updateCivilModal" value='<?php echo $info['email'] ?>'>Update data</button> -->
</body>
</html>