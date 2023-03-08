<?php
    require "../db.php";
    session_start();

    $email = $_POST['email'];

    $q = "SELECT * from `award` where email='$email'";
    $list = $con->query($q);
    $info = $list->fetch_assoc();

    // get name
    $name = "SELECT * from profile where email='$email'";
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
    <h2 class="text-secondary fw-bold mb-3">Rewards and Recognitions <?php if($_SESSION['status'] == 'Admin') echo "| ".$infoName['name'] ?></h2>


    <!-- get email profile -->
     <input type="hidden" value='<?php echo $email ?>' id='profileUserEmail'>
    <!--  -->

    <!-- get user email -->
    <input type="hidden" value="<?php echo $email ?>" id='userEmailProfile'>
    <!--  -->

    <!-- Tabs navs -->
    <ul class="nav nav-tabs tabsss mb-3" id="ex1" style="font-size: 14px;" role="tablist">
   

    <?php if($_SESSION['status'] == "Admin"){ ?>
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
            <a class="nav-link" id="ex1-tab-4" data-mdb-toggle="tab" href="#ex1-tabs-4" role="tab" aria-controls="ex1-tabs-4" aria-selected="false">Work Experience</a>
        </li>

        <li class="nav-item" role="presentation" id='profileAwardExpBtn'>
            <a class="nav-link active" id="ex1-tab-5" data-mdb-toggle="tab" href="#ex1-tabs-5" role="tab" aria-controls="ex1-tabs-5" aria-selected="false">Rewards and Recognition</a>
        </li>
        <li class="nav-item" role="presentation" id="profileLearningAndDevelopmentButton">
            <a class="nav-link" id="ex1-tab-6" data-mdb-toggle="tab" href="#ex1-tabs-6" role="tab" aria-controls="ex1-tabs-6" aria-selected="false">Learning and Development</a>
        </li>
    <?php } ?>
    </ul>

    <button class="btn btn-primary my-3" data-bs-toggle="modal" data-bs-target="#profileAwardModal"><i class="fa-solid fa-plus text-light me-2"></i>Add Rewards and Recognitions</button>

    <table class='table text-center table-striped bg-light' style="font-size: 14px;">
        <thead>
            <tr>
                <th>Title of Award</th>
                <th>Level of award</th>
                <th>Certificate issue date</th>
                <th>Files</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if($list->num_rows){ ?>
                <?php do{ ?>
                    <tr>
                        <td><?php echo $info['title'] ?></td>
                        <td><?php echo $info['lvl'] ?></td>
                        <td><?php echo $info['date'] ?></td>
                        <td>
                            <button class='btn btn-info btn-sm' data-bs-toggle="modal" data-bs-target="#viewFileRewardAndRecognition" value='<?php echo $info['id'] ?>' id='viewFileButtonNew'><i class="fa-regular fa-folder-open text-light"></i></button>
                        </td>
                        <td>
                            <div>
                                <button class='btn btn-info btn-sm' data-bs-toggle="modal" data-bs-target="#profileAwardModalEdit" value='<?php echo $info['id'] ?>' id='profileAwardEditButtonModal'><i class="fa-solid fa-pen text-light"></i></button>
                                <button value='<?php echo $info['id'] ?>' class='btn btn-danger btn-sm' id='profileAwardDeleteButton'><i class="fa-solid fa-trash"></i></button>
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

</body>
</html>