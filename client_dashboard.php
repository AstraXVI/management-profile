<?php
    require "db.php";
    session_start();

    if(empty($_SESSION['status']) || $_SESSION['status'] == 'invalid'){

        header("location: index.php");
    }

    if($_SESSION['status'] == 'admin'){

        header("location: admin_dashboard.php");
    }
    
    // Logout btn
    if(isset($_POST['logoutBtn'])){
        unset($_SESSION['id']);
        unset($_SESSION['status']);
        unset($_SESSION['school']);

        header("location: index.php");
    }


    $_SESSION['id'];
    $_SESSION['status'];
    $school = $_SESSION['school'];


    // GET USER INFO
    $userId = $_SESSION['id'];

    $getUserInfo = "SELECT * FROM users WHERE id='$userId'";
    $userInfo = $con->query($getUserInfo);
    $fetchUserInfo = $userInfo->fetch_assoc();

    $emailNew = $fetchUserInfo['email'];

    //  get user info profile
    $getDataUser = "SELECT * FROM `profile` WHERE email='$emailNew'";
    $userLists = $con->query($getDataUser);
    $data = $userLists->fetch_assoc();

    $getEmail = "SELECT * FROM `educationaldegree` WHERE email='$emailNew'";
    $degreeList = $con->query($getEmail);
    $fetchSchool = $degreeList->fetch_assoc();


    // get POST degree
    $postDegree = "SELECT * FROM `educationaldegree` WHERE lvl='Post Degree' AND email='$emailNew' ORDER BY id DESC";
    $postList = $con->query($postDegree);
    $fetchPost = $postList->fetch_assoc();

    // get MASTER degree
    $mastersDegree = "SELECT * FROM `educationaldegree` WHERE lvl='Masters Degree' AND email='$emailNew' ORDER BY id DESC";
    $mastersList = $con->query($mastersDegree);
    $fetchMasters = $mastersList->fetch_assoc();
    

    // DASH BOARD award count

    // international
    $qInternational = "SELECT * FROM award WHERE lvl LIKE '%international%' AND email='$emailNew'";
    $lInternational = $con->query($qInternational);
    $fInternational = $lInternational->num_rows;

    // regional
    $qRegional = "SELECT * FROM award WHERE lvl LIKE '%Regional%' AND email='$emailNew'";
    $lRegional = $con->query($qRegional);
    $fRegional = $lRegional->num_rows;

    // division
    $qDivision = "SELECT * FROM award WHERE lvl LIKE '%Division%' AND email='$emailNew'";
    $lDivision = $con->query($qDivision);
    $fDivision = $lDivision->num_rows;

    // school
    $qSchool = "SELECT * FROM award WHERE lvl LIKE '%School%' AND email='$emailNew'";
    $lSchool = $con->query($qSchool);
    $fSchool = $lSchool->num_rows;


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.2.min.js" integrity="sha256-2krYZKh//PcchRtd+H+VyyQoZ/e3EcrkxhM8ycwASPA=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/admin_dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="shortcut icon" href="https://sdovalenzuelacity.deped.gov.ph/wp-content/uploads/2021/04/New-DO-Logo.png" type="image/x-icon">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <style>
        .dropdown-menu:hover{
            background-color: #f5f5f5;
        }
    </style>
</head>
<body style="background: url(https://cdn.pixabay.com/photo/2017/07/01/19/48/background-2462431_960_720.jpg) no-repeat; background-size: cover; background-color: #e5e5e5; background-blend-mode: overlay;">

    <header class="d-flex align-items-center py-2 bg-success text-light" style=" position: absolute; top: 20px; right:40px; padding-inline: 20px;  border-radius: 10px;">
            <span id='profileIconHeader'>
                <?php if(empty($data['picture'])){ ?>
                    <i class="fa-solid fa-user fs-4 mt-1"></i>
                <?php }else{ ?>
                    <img src="<?php echo $data['picture'] ?>" alt="" style='width:30px;height:30px;border: 3px solid white ;border-radius: 100vmax; margin-right: 7px;'>
                <?php } ?>
            </span>
            <div class="dropdown">
                <a id="dropdownBtn" class="text-decoration-none dropdown-toggle ps-1" style="color: #f5f5f5" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <?php echo $fetchUserInfo['email'] ?>
                </a>

                <ul class="dropdown-menu mt-2">
                    <!-- <li id="profileBtn" value='<?php echo $fetchUserInfo['id'] ?>' ><button class="dropdown-item py-2">My Profile</button></li> -->
                    <li>
                        <!-- <a class="dropdown-item" href="#">
                            <form action="" method="post">
                                <span class="d-flex align-items-center"><i class="fa-solid fa-right-from-bracket text-danger"></i><input type="submit" class="btn btn-sm" name="logoutBtn" value="LOGOUT"></span>
                            </form>
                        </a> -->
                        <a class="ps-2 logout-client text-danger" style="cursor: pointer; text-decoration: none; color: black; padding-right: 35%" data-bs-toggle="modal" data-bs-target="#LogoutModal"><i class="fa-solid fa-arrow-right-from-bracket me-2"></i>Logout</a>
                    </li>
                </ul>
            </div>
            </div>
        </header>


        <!-- get user email -->
        <input type="hidden" value="<?php echo $emailNew ?>" id='userEmailProfile'>
        <!--  -->

    <div class='container-fluid m-0 p-0 m-0 flex-grow-1 d-flex'>
        <div class='nav_wrapper'>
            <nav>
                <div class="d-flex flex-column flex-shrink-0 p-3 bg-dark text-light" style="width: 280px; height:100vh; ">
                    <a href="" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
                    <img class="bi me-2" width="50" height="50" src="https://sdovalenzuelacity.deped.gov.ph/wp-content/uploads/2021/04/New-DO-Logo.png" alt="logo">
                    <span class="fs-6 text-light">DepEd Valenzuela Personnel Profile System</span>
                    </a>
                    <hr>
                    <ul class="nav nav-pills flex-column mb-auto">
                        <li>
                            <a id="navBtn1" class="nav-link link-light active" href="javascript:window.location.reload(true)">
                            <span class="bi me-2" width="16" height="16"><i class="fa-solid fa-chart-simple"></i></span>
                            Dashboard
                            </a>
                        </li>
                        <li id="profileBtn" value='<?php echo $data['id']  ?>'>
                            <a id="navBtn2" href="#" class="nav-link link-light">
                            <span class="bi me-2" width="16" height="16"><i class="fa-solid fa-user"></i></span>
                            My Profile
                            <!-- <li ><button class="dropdown-item py-2"></button></li> -->
                            </a>
                        </li>
                        <li id="credentialBtn" data-bs-toggle="modal" data-bs-target="#navCredentialsButton">
                            <a id="navBtn3" href="#" class="nav-link link-light">
                            <span class="bi me-2" width="16" height="16"><i class="fa-solid fa-id-card"></i></span>
                            Credentials
                            <!-- <li ><button class="dropdown-item py-2"></button></li> -->
                            </a>
                        </li>
                        <li id="announcementBtn">
                            <a id="navBtn4" href="#" class="nav-link link-light">
                            <span class="bi me-2" width="16" height="16"><i class="fa-solid fa-bullhorn"></i></span>
                            Announcements
                            <!-- <li ><button class="dropdown-item py-2"></button></li> -->
                            </a>
                        </li>
                        <!-- <li>

                            <button type="button" class=" btn-sm text-light bg-transparent" style="border: none; padding-right: 130px;" data-bs-toggle="modal" data-bs-target="#fileUplaodsDorModal" id='dorButtonModal' value='<?php echo $fetchUserInfo['school'] ?>'><i class="fa-regular fa-folder-open text-light fs-6 ms-2 me-3"></i>DOR</button>
                    
                        </li> -->
                    </ul>
                </div>
                <!-- <ul>
                    <li><a href="javascript:window.location.reload(true)">Dashboard</a></li>
                    <li id='schoolBtn'>Schoool</li>
                </ul> -->
            </nav>
        </div>
    
        <div id='dashBoardBody' class="mx-auto" style="width: 76%; margin-top: 70px;">
            <!-- Ilagay dito ang dashboard -->
            <div class=" text-secondary fw-bold p-2 ps-0 mb-3 w-25 h3">Dashboard</div>
            <div class="d-flex flex-column py-5 px-5 text-light" style="gap: 40px; background-color: white;">
            
                <div class="d-flex gap-5">
                    <?php if(empty($fetchSchool['lvl'])){ ?>
                        <?php
                            $checkCollege = "SELECT * FROM educationalbg WHERE email='$emailNew'";
                            $collegeSchool = $con->query($checkCollege);
                            $fetchSchoolName = $collegeSchool->fetch_assoc();
                        ?>
                        <?php if(!empty($fetchSchoolName['schoolCollege'])){ ?>
                            <div class="card w-75" style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px; max-width: 350px">
                                <div class="card-body bg-primary rounded-1">
                                    <!-- Title -->
                                    <h4 class="card-title"><p><i class="fa-solid fa-ranking-star me-2"></i>College Degree</p></h4>
                                    <hr>
                                    <!-- Text -->
                                    <p class="card-text"><?php echo $fetchSchoolName['schoolCollege'] ?></p>
                                    <p class="card-text"><?php echo $fetchSchoolName['collegeCourse'] ?></p>
                                    <div class="d-flex gap-3 fs-4">
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    
                    <?php }else if(!empty($fetchPost['lvl'])){ ?>
                        <div class="card w-75" style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px; max-width: 350px">
                            <div class="card-body bg-primary rounded-1">
                                <!-- Title -->
                                <h4 class="card-title"><p><i class="fa-solid fa-ranking-star me-2"></i>Post Degree</p></h4>
                                <hr>
                                <!-- Text -->
                                <p class="card-text"><?php echo $fetchPost['nameSchool'] ?></p>
                                <p class="card-text"><?php echo $fetchPost['education'] ?></p>
                                <div class="d-flex gap-3 fs-4">
                                <span class="fa fa-star text-warning"></span>
                                    <span class="fa fa-star text-warning"></span>
                                    <span class="fa fa-star text-warning"></span>
                                    <span class="fa fa-star text-warning"></span>
                                    <span class="fa fa-star text-warning"></span>
                                </div>
                                <!-- <button id="toEquipment" class="btn btn-rounded text-light px-4 btn-md" style="background-color: rgba(0, 0, 0, 0.3);">See Profile<i class="fa-solid fa-arrow-up-right-from-square ms-2"></i></button> -->
                            </div>
                        </div>
                    <?php }else if(!empty($fetchMasters['lvl'])){ ?>
                        <div class="card w-75" style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px; max-width: 350px">
                            <div class="card-body bg-primary rounded-1">
                                <!-- Title -->
                                <h4 class="card-title"><p><i class="fa-solid fa-ranking-star me-3"></i>Master Degree</p></h4>
                                <hr>
                                <!-- Text -->
                                <p class="card-text"><?php echo $fetchMasters['nameSchool'] ?></p>
                                <p class="card-text"><?php echo $fetchMasters['education'] ?></p>
                                <div class="d-flex gap-3 fs-4">
                                    <span class="fa fa-star text-warning"></span>
                                    <span class="fa fa-star text-warning"></span>
                                    <span class="fa fa-star text-warning"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                </div>
                                <!-- <button id="toEquipment" class="btn btn-rounded text-light px-4 btn-md" style="background-color: rgba(0, 0, 0, 0.3);">See Profile<i class="fa-solid fa-arrow-up-right-from-square ms-2"></i></button> -->
                            </div>
                        </div>
                        
                    <?php } ?>
                
                    <div class="card w-75" style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px; max-width: 350px">
                      <div class="card-body bg-danger rounded-1">
                          <!-- Title -->
                          <h4 class="card-title"><p><i class="fa-solid fa-person-chalkboard me-2"></i>Years As Teaching Personnel</p></h4>
                          <hr>

                          <!-- Get date to get year experience -->

                          <?php

                            // GET ALL TEACHING EXP YEARS
                            $qGetAllFrom = "SELECT dateFrom FROM work WHERE email='$emailNew' AND positionLvl='Teaching Personnel'";
                            $qListFrom = $con->query($qGetAllFrom);
                            $qFetchFrom = $qListFrom->fetch_assoc();

                            $qGetAllTo = "SELECT dateTo FROM work WHERE email='$emailNew' AND positionLvl='Teaching Personnel'";
                            $qListTo = $con->query($qGetAllTo);
                            $qFetchTo = $qListTo->fetch_assoc();


                            // GET ALL SYSTEM ADMIN EXP YEARS
                            $qGetAllFromAdmin = "SELECT dateFrom FROM work WHERE email='$emailNew' AND positionLvl='School Administrator'";
                            $qListFromAdmin = $con->query($qGetAllFromAdmin);
                            $qFetchFromAdmin = $qListFromAdmin->fetch_assoc();

                            $qGetAllToAdmin = "SELECT dateTo FROM work WHERE email='$emailNew' AND positionLvl='School Administrator'";
                            $qListToAdmin = $con->query($qGetAllToAdmin);
                            $qFetchToAdmin = $qListToAdmin->fetch_assoc();
                          ?>
                          <!--  -->
                          <!-- Text -->
                          <p class="card-text fs-4" id='yearAsTeachingPersonnel'></p>
                      </div>
                   
                    </div>

                    <!-- INPUT TEACHING PERSONEL EXP -->
                    <!-- <?php if(empty($qFetchFrom['dateFrom'])) ?> -->
                    <?php do{ ?>
                        <input type="hidden" id="allDateFrom" value='<?php echo $qFetchFrom['dateFrom'] ?>'>
                    <?php }while($qFetchFrom = $qListFrom->fetch_assoc()) ?>
                    <?php do{ ?>
                        <input type="hidden" id="allDateTo" value='<?php echo $qFetchTo['dateTo'] ?>'>
                    <?php }while($qFetchTo = $qListTo->fetch_assoc()) ?>

                    <!-- INPUT SYSTEM ADD -->
                    <?php do{ ?>
                        <input type="hidden" id="allDateFromAdmin" value='<?php echo $qFetchFromAdmin['dateFrom'] ?>'>
                    <?php }while($qFetchFromAdmin = $qListFromAdmin->fetch_assoc()) ?>
                    <?php do{ ?>
                        <input type="hidden" id="allDateToAdmin" value='<?php echo $qFetchToAdmin['dateTo'] ?>'>
                    <?php }while($qFetchToAdmin = $qListToAdmin->fetch_assoc()) ?>

                    <div class="card w-75" style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px; max-width: 350px">
                        <div class="card-body bg-warning rounded-1">
                            <!-- Title -->
                            <h4 class="card-title"><p><i class="fa-solid fa-school-lock me-2"></i>Years As School Administration</p></h4>
                            <hr>
                            <!-- Text -->
                            <p class="card-text fs-4" id='yearAsSchoolAdmin'></p>
                        </div>
                    </div>

                </div>

                <div class="d-flex gap-5">
                    <div class="card w-75" style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px; max-width: 300px">
                        <div class="card-body bg-success rounded-1">
                            <!-- Title -->
                            <h4 class="card-title"><p>6 <i class="fa-solid fa-award me-2"></i>Awards</p></h4>
                            <hr>
                            <!-- Text -->
                            <!-- <p class="card-text fs-3" id='awards'></p> -->
                            <p class="card-text mb-1 fs-6" id='awards'><i class="fa-solid fa-medal text-warning"></i> <?php echo $fInternational  ?> - International Awards</p>
                            <p class="card-text mb-1 fs-6" id='awards'><i class="fa-solid fa-medal text-warning"></i> <?php echo $fRegional ?> - Regional Awards</p>
                            <p class="card-text mb-1 fs-6" id='awards'><i class="fa-solid fa-medal text-warning"></i> <?php echo $fDivision ?> - Division Awards</p>
                            <p class="card-text mb-1 fs-6" id='awards'><i class="fa-solid fa-medal text-warning"></i> <?php echo $fSchool ?> - School Awards</p>
                        </div>
                    </div>
                    <div class="card w-75" style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px; max-width: 300px">
                        <div class="card-body rounded-1" style="background-color: #87194C">
                            <!-- Title -->
                            <h4 class="card-title"><p>2 <i class="fa-solid fa-bullhorn me-2"></i>Announcement</p></h4>
                            <hr>
                            <!-- Text -->
                            <p class="card-text fs-3" id='announcement'></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- MODAL EDIT EQUIPMENT -->
    <div class="modal fade" id="editEquipmentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Equipment</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div id='editEquipmentModalBody' class="modal-body">
                <!-- school update info -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id='saveEditEquipmentBtn' data-bs-dismiss="modal">Save changes</button>
            </div>
            </div>
        </div>
    </div>

    <!-- MODAL  ADD EQUIPMENT -->
    <div class="modal fade" id="addEquipmentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add Equipments</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="inputCode" placeholder="School Name">
                    <label>Code</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="inputArticle" placeholder="School Name">
                    <label>Article</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="inputDescription" placeholder="School Name">
                    <label>Description</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="inputDate" placeholder="School Name">
                    <label>Date Acquired</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="inputUnitValue" placeholder="School Name">
                    <label>Unit Value</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="inputTotalValue" placeholder="School Name">
                    <label>Total Value</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="inputSourceOfFunds" placeholder="School Name">
                    <label>Source of Funds</label>
                </div>

                <label class='ps-1'>Status</label>
                <select id='inputStatus' class="form-select" aria-label="Default select example">
                    <option value="Working">Working</option>
                    <option value="Condemned">Condemned</option>
                    <option value="Need Repair">Need repair</option>
                </select>
                <!-- insert school name -->
                <input type="hidden" id='insertSchoolName' value="<?php echo $_SESSION['school'] ?>">
                <!--  -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id='addEquipmentBtnInput' data-bs-dismiss="modal">Add Equipment</button>
            </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="EditUserProfile" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div id='profileModalBody' class="modal-body">
                <!-- Get data from another index -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id='profileUpdateBtnDatabase' data-bs-dismiss="modal">Save changes</button>
            </div>
            </div>
        </div>
    </div>

    <!-- FILES UPLOAD DOR -->
    <div class="modal fade" id="fileUplaodsDorModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Files</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div id='dorBodyModal' class="modal-body">
                <!-- DOR BODY -->
            </div>
            <div class="modal-footer d-flex justify-content-between">
                <input class="form-control form-control-sm w-50" id="inputFileDorPic" type="file">
                
                <div>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id='uploadDorDbButton'>Upload Files</button>
                </div>
            </div>
            </div>
        </div>
    </div>

    <!-- PROFILE UPLOAD PIC MODAL -->
    <div class="modal fade" id="uploadProfileModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update profile picture</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id='uploadProfileModalUpdate'>
                <div class="mb-3">
                    <!-- <label for="formFile" class="form-label">Upload profile picture</label> -->
                    <!-- <input type="hidden" value='<?php echo $fetchUserInfo['id'] ?>' id='profilePictureId'>
                    <input class="form-control" type="file" id="profileUploadedPicture"> -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id='profileUploadBtnDb'>Upload</button>
            </div>
            </div>
        </div>
    </div>

        <!-- MODAL LOGOUT -->
    <div class="modal fade" id="LogoutModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">LOGOUT</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure to logout?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <form action="" method="post">
                    <span class="d-flex align-items-center"><i class="fa-solid fa-right-from-bracket text-danger"></i><input type="submit" class="btn btn-sm" name="logoutBtn" value="LOGOUT"></span>
                </form>
            </div>
            </div>
        </div>
    </div>

    <!-- update education -->
    <div class="modal fade "  id="updateEducationModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content" >
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Educational Background</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            <div class="modal-body" id='modalBodyupdateEducation'>
                <!-- Modal update education body -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id='profileSaveButtonEducation' data-bs-dismiss="modal" >Save changes</button>
            </div>
            </div>
        </div>
    </div>

     <!-- ADD CIVIL MODAL-->
    <div class="modal fade" id="civilAddData" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Civil Service Eligibility</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <!-- <div class="form-floating mb-3">
                <input type="text" class="form-control" id="civilInputCareer" placeholder="Career Service">
                <label>Career Service</label>
            </div> -->
            <!-- <div class="input-group mb-3">
                <span class="input-group-text">Career Service</span>
                <input type="text" class="form-control" id="civilInputCareer" value="" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
            </div> -->
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">Career Service</span>
                <select class="form-select" id='civilInputCareer' aria-label="Default select example">
                    <option selected value="CSC - Sub Professional">CSC - Sub Professional</option>
                    <option value="CSC - Professional">CSC - Professional</option>
                    <option value="RA - 1080 Bar/Board Eligibility">RA - 1080 Bar/Board Eligibility</option>
                </select>
            </div>

            <!-- <div class="form-floating mb-3">
                <input type="text" class="form-control" id="civilInputRating" placeholder="School Name">
                <label>Rating</label>
            </div> -->

            <div class="input-group mb-3">
                <span class="input-group-text">Rating</span>
                <input type="text" class="form-control" id="civilInputRating" value="" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
            </div>

            <div class="input-group mb-3">
                <span class="input-group-text">Date of Examination</span>
                <input type="date" class="form-control" id="civilDateExam" value="" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
            </div>

            <div class="input-group mb-3">
                <span class="input-group-text">Place of Examination</span>
                <input type="text" class="form-control" id="civilPlaceExam" value="" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
            </div>

            <label class="d-block text-center text-secondary">License (if applicable)</label>
            <br>
            <!-- <input type="text" id='civilDate' placeholder='Number'> -->
            <div class="input-group mb-3">
                <span class="input-group-text">Number</span>
                <input type="text" class="form-control" id="civilNumber" value="" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text">Date of Validity</span>
                <input type="text" class="form-control" id="civilDate" value="" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
            </div>
            <!-- <input type="text" id='civilNumber' placeholder='Date of Validity'> -->
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id='addCivilServiceButtonDb'>Add Civil Service</button>
        </div>
        </div>
    </div>
    </div>

    <!-- ADD WORK MODAL -->
    <div class="modal fade" id="workAddData" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Work Experience</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

            <label class="mb-2">INCLUSIVE DATES</label>
            <br>
            <div class="d-flex gap-4">
                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">From</span>
                    <input type="date" class="form-control" id="workExpDateFrom" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">To</span>
                    <input type="date" class="form-control" id="workExpDateTo" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                </div>
            </div>

            <div class="input-group mb-3">
                <label class="input-group-text" for="">Position Category</label>
                <select class="form-select" id="workExpPositionLvl">
                    <option value="School Administrator">School Administrator</option>
                    <option value="Teaching Personnel">Teaching Personnel</option>
                </select>
            </div>

            <div class="input-group mb-3">
                <label class="input-group-text" for="">Position Title (Write in full/ Do not abbreviate)</label>
                <select class="form-select" id="workExpPosition">
                    <!-- Default-->
                    <option value='Head Teacher I'>Head Teacher I</option>
                    <option value='Head Teacher II'>Head Teacher II</option>
                    <option value='Head Teacher II'>Head Teacher III</option>
                    <option value='Head Teacher IV'>Head Teacher IV</option>
                    <option value='Head Teacher V'>Head Teacher V</option>
                    <option value='Head Teacher VI'>Head Teacher VI</option>
                    <option value='School Head I'>School Head I</option>
                    <option value='School Head II'>School Head II</option>
                    <option value='School Head III'>School Head III</option>
                    <option value='School Head IV'>School Head IV</option>
                    <option >Other Admin Roles (Please Specify)</option>
                </select>
            </div>
            <!-- <div class="input-group mb-3">
                <span class="input-group-text" id="inputGroup-sizing-default">Position Title (Write in full/ Do not abbreviate)</span>
                <input type="text" class="form-control" id="workExpPosition" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
            </div> -->

            <div class="input-group mb-3">
                <span class="input-group-text" id="inputGroup-sizing-default">Department/Agency/Office/Company (Write in full/ Do not abbreviate)</span>
                <input type="text" class="form-control" id="workExpDepartment" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
            </div>

            <div class="input-group mb-3">
                <span class="input-group-text" id="inputGroup-sizing-default">Monthly Salary</span>
                <input type="text" class="form-control" id="workExpSalary" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
            </div>

            <div class="input-group mb-3">
                <span class="input-group-text" id="inputGroup-sizing-default">Salary/Job/Pay Grade (if applicable)</span>
                <input type="text" class="form-control" id="workExpJob" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
            </div>

            <div class="input-group mb-3">
                <span class="input-group-text" id="inputGroup-sizing-default">Status of Appointment</span>
                <input type="text" class="form-control" id="workExpStatus" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
            </div>

            <div class="input-group mb-3">
                <span class="input-group-text" id="inputGroup-sizing-default">Gov't Service (Y/N)</span>
                <input type="text" class="form-control" id="workExpService" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
            </div>
            
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id='addWorkServiceButtonDb'>Add</button>
        </div>
        </div>
    </div>
    </div>

    <!-- LEARNING AND DEVELOPMENT MODAL -->
    <div class="modal fade" id="learningAndDevelopmentAddData" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Learning and Development</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
        
                <div class="input-group mb-3">
                    <span class="input-group-text" style="font-size: 14px;" id="inputGroup-sizing-default">Title of Learning and Development Intervention/Training Program (Write in full)</span>
                    <input type="text" class="form-control" id="learningAndDevelopmentTitle" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                </div>
                <label class="mb-2">Inclusive Dates of Attendance</label>
                <br>
                <div class="d-flex gap-4">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="inputGroup-sizing-default">From</span>
                        <input type="date" class="form-control" id="learningAndDevelopmentDateFrom" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="inputGroup-sizing-default">To</span>
                        <input type="date" class="form-control" id="learningAndDevelopmentDateTo" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                    </div>
                </div>

                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">Number of Hours</span>
                    <input type="text" class="form-control" id="learningAndDevelopmentHours" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                </div>

                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">Type of LD (Managerial/supervisory/technical/etc)</span>
                    <input type="text" class="form-control" id="learningAndDevelopmentLD" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                </div>

                <div class="input-group mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">Conducted/Sponsored by (Write in full)</span>
                    <input type="text" class="form-control" id="learningAndDevelopmentConducted" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                </div>
                
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id='profileAddLearningButtonDb'>Add</button>
                </div>
                </div>
        </div>
    </div>

    <!-- privacy notice modal -->
    <?php if($_SESSION['privacy']){ ?>
        <div class="modal fade" id="myModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title">PRIVACY NOTICE</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>The Department of Education Valenzuela recognizes its responsibility under the <i>Republic Act No. 10173</i>, also known as the <i>Data Privacy Act of 2012</i>, to handle appropriately collected, recorded, organized, updated, used, and consolidated information from its personnel. 

                    </br></br> Data obtained from this form is entered and stored within the organization's authorized information and communications system and is only accessible to authorized personnel. The administrative team has instituted appropriate organizational, technical, and physical security measures to protect personal data. 

                    </br></br>Furthermore, all information will be subject to strict confidentiality. <b>DepEd SDO Valenzuela</b> will not disclose any information without consent.
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-bs-dismiss="modal">OK</button>
                    <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                </div>
                </div>
            </div>
        </div>
    <?php $_SESSION['privacy'] = 0; }?>

    <!-- Add degree Modal -->
    <div class="modal fade" id="addDegreeModalButton" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add degree</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- user email -->
                <input type="hidden" id='degreeUserEmail' value='<?php echo $emailNew ?>'>
                <!--  -->
                <!-- <label>Select Degree</label> -->
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Select Degree</span>
                    <select class="form-select" id='inputDegreeDegree' aria-label="Default select example">
                        <option value="Masters Degree">Masters Degree</option>
                        <option value="Post Degree">Post Degree</option>
                    </select>
                </div>

                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Name of School</span>
                    <input type="text" id='inputDegreeSchool' class="form-control"  aria-label="Username" aria-describedby="basic-addon1">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Basic Education/Degree/Course</span>
                    <input type="text" id='inputDegreeEduc' class="form-control"  aria-label="Username" aria-describedby="basic-addon1">
                </div>
                <label class='mb-2'>Period of attendance</label>
                <br>
                <!-- <label>From :</label>
                <input type="date" name="" id='inputDegreeFrom'>
                <label>To:</label>
                <input type="date" name="" id='inputDegreeTo'> -->
                <div class="d-flex gap-4">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="inputGroup-sizing-default">From</span>
                        <input type="date" class="form-control" id="inputDegreeFrom" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="inputGroup-sizing-default">To</span>
                        <input type="date" class="form-control" id="inputDegreeTo" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                    </div>
                </div>

                <div class="input-group my-3">
                    <span class="input-group-text" id="basic-addon1">Highest Level/Unit Earned</span>
                    <input type="text" id='inputDegreeHigh' class="form-control" aria-label="Username" aria-describedby="basic-addon1">
                </div>
                <div class="input-group my-3">
                    <span class="input-group-text" id="basic-addon1">Year Graduate</span>
                    <input type="text" id='inputDegreeYear' class="form-control" aria-label="Username" aria-describedby="basic-addon1">
                </div>
                <div class="input-group my-3">
                    <span class="input-group-text" id="basic-addon1">Scholarship/Academic Honors Received</span>
                    <input type="text" id='inputDegreeScholar' class="form-control" aria-label="Username" aria-describedby="basic-addon1">
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id='addDegreeButtonDatabase'>Add degree</button>
            </div>
            </div>
        </div>
    </div>

    <!-- Modal EDIT DEGREE-->
    <div class="modal fade" id="editDegreeModalProfie" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Degree</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id='modalBodyEditDegree'>
                    <!-- EDIT DEGREE -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id='updateDegreeDatabaseButton'>Save changes</button>
            </div>
            </div>
        </div>
    </div>

    <!-- Modal EDIT CIVIL-->
    <div class="modal fade" id="civilModalEditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Civil</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id='modalBodyCivilUpdate'>
                <!-- EDIT CIVIL -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id='civilUpdateButtonDatabase'>Save changes</button>
            </div>
            </div>
        </div>
    </div>

    <!-- Modal EDIT WORK EXP -->
    <div class="modal fade" id="editWorkModalButton" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Work Experience</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id='editWorkExpModalBody'>
                <!-- Modal body edit work exp -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id='updateWorkExpButtonDb'>Save changes</button>
            </div>
            </div>
        </div>
    </div>
    
    <!-- Modal CREDENTIALS -->
    <div class="modal fade" id="navCredentialsButton" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Credentials</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="formFile" class="form-label">Upload Credentials</label>
                    <input class="form-control" type="file" id="uploadCredentialInput">
                </div>

                <!-- Credentials uploaded -->
                <div >
                    <?php
                        $qGetCredentials = "SELECT * FROM credential WHERE email='$emailNew'";
                        $lCredentials = $con->query($qGetCredentials);
                        $fCredentials = $lCredentials->fetch_assoc();
                    ?>

                    <?php if($lCredentials->num_rows){ ?>

                        <?php do{ ?>

                            <img src="<?php echo $fCredentials['pic'] ?>" alt="<?php echo $fCredentials['pic'] ?>" width='100%'>
                            
                        <?php }while($fCredentials = $lCredentials->fetch_assoc()) ?>

                    <?php }else{ ?>

                        <p>No upload yet</p>

                    <?php } ?>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id='uploadCredentialButtonDB'>UPLOAD</button>
            </div>
            </div>
        </div>
    </div>

    <!-- Modal Add Award -->
    <div class="modal fade" id="profileAwardModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add Award</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="input-group my-3">
                    <span class="input-group-text" id="basic-addon1">Title of award</span>
                    <input type="text" id='inputAwardTitle' class="form-control" aria-label="Username" aria-describedby="basic-addon1">
                </div>
    
                <div class="input-group mb-3">
                    <label class="input-group-text" for="">Level of award</label>
                    <select class="form-select" id='inputAwardlvl'>
                        <option value="International (Managerial)">International (Managerial)</option>
                        <option value="International (Supervisory)">International (Supervisory)</option>
                        <option value="International (Technical)">International (Technical)</option>
                        <option value="Regional">Regional</option>
                        <option value="Division">Division</option>
                        <option value="School">School</option>
                    </select>
                </div>

                <div class="input-group my-3">
                    <span class="input-group-text" id="basic-addon1">Certificate issue date</span>
                    <input type="date" id='inputAwardDate' class="form-control" aria-label="Username" aria-describedby="basic-addon1">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id='profileAwardAddBtnDb'>Add award</button>
            </div>
            </div>
        </div>
    </div>

    <!-- Modal EDIT AWARD-->
    <div class="modal fade" id="profileAwardModalEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit award</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id='awardModalBody'>
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id='profileAwardUpdateButtonDb'>Save changes</button>
            </div>
            </div>
        </div>
    </div>

    <!-- Modal EDIT learning-->
    <div class="modal fade" id="profileLearningModalEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit learning</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id='learningModalBody'>
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id='profileLearningUpdateButtonDb'>Save changes</button>
            </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>

    <script>
        //load privacy
        $(window).on('load', function() {
                $('#myModal').modal('show');
        });

        $(document).ready(function(){
            // logout
            $('#dropdownBtn').click(function(){
                
                $('.dropdown-menu').toggleClass('d-block');
            })

            $('#toEquipment').click(function(){
                $('#dashBoardBody').load("profile.php");

            });

            //load announcement
            $('#announcementBtn').click(function(){
                $('#dashBoardBody').load("announcement.php");

            });

            // NAV
            $('#profileBtn').click(function(){
                // $('#dashBoardBody').load("profile.php");

                $('#navBtn1').removeClass('active');
                $('#navBtn2').addClass('active');
                $('#navBtn3').removeClass('active');
                $('#navBtn4').removeClass('active');
            })
            $('#credentialBtn').click(function(){
                // $('#dashBoardBody').load("profile.php");

                $('#navBtn1').removeClass('active');
                $('#navBtn2').removeClass('active');
                $('#navBtn3').addClass('active');
                $('#navBtn4').removeClass('active');
            })
            $('#announcementBtn').click(function(){
                // $('#dashBoardBody').load("profile.php");

                $('#navBtn1').removeClass('active');
                $('#navBtn2').removeClass('active');
                $('#navBtn3').removeClass('active');
                $('#navBtn4').addClass('active');
            })

            // ADD EQUIPMENT ON DB
            $("#addEquipmentBtnInput").click(function(){
                
                const schoolName = $("#insertSchoolName").val();

                const code = $("#inputCode").val();
                const article = $("#inputArticle").val();
                const description = $("#inputDescription").val();
                const date = $("#inputDate").val();
                const unitValue = $("#inputUnitValue").val();
                const totalValue = $("#inputTotalValue").val();
                const sourceOfFunds = $("#inputSourceOfFunds").val();
                const status = $("#inputStatus").val();

                // console.log(code,article,description,date,unitValue,totalValue,sourceOfFunds)

                if(code && article && description && date && unitValue && totalValue && sourceOfFunds){
                    $.ajax({
                        url:"schools_equipment/add_equipment_client.php",
                        method:'post',
                        data:{
                            schoolName : schoolName,
                            code : code,
                            article : article,
                            description : description,
                            date : date,
                            unitValue : unitValue,
                            totalValue : totalValue,
                            sourceOfFunds : sourceOfFunds,
                            status : status
                        },
                        success(){

                            $.ajax({
                                url: "schools_equipment/equipmentTbody.php",
                                method : 'post',
                                data:{
                                    schoolName : schoolName
                                },
                                success(e){
                                    $("#equipmentTableTbody").html(e)

                                    $("#inputCode").val("");
                                    $("#inputArticle").val("");
                                    $("#inputDescription").val("");
                                    $("#inputDate").val("");
                                    $("#inputUnitValue").val("");
                                    $("#inputTotalValue").val("");
                                    $("#inputSourceOfFunds").val("");
                                    $("#inputStatus").val("");

                                }
                            })

                            
                        }
                    })
    
                    
                }else{
                    $("#inputCode").val("");
                    $("#inputArticle").val("");
                    $("#inputDescription").val("");
                    $("#inputDate").val("");
                    $("#inputUnitValue").val("");
                    $("#inputTotalValue").val("");
                    $("#inputSourceOfFunds").val("");
                    confirm(`Please fill up all the fields!`)

                }

            })

            // DELETE EQUIPMENT ON DB
            $("#dashBoardBody").on('click','#deleteEquipmentBtn',function(){
                const id = $(this).val()

                const schoolNameForDelete = $("#schoolNameForDeleteAndSearch").val();


                if(confirm(`Are you sure to delete this item?`)){
                    $.ajax({
                        url: "schools_equipment/delete_Equipment.php",
                        method:"post",
                        data:{
                            id : id
                        },
                        success(){

                            $.ajax({
                                url: "schools_equipment/equipmentTbody.php",
                                method : 'post',
                                data:{
                                    schoolName : schoolNameForDelete
                                },
                                success(e){
                                    $("#equipmentTableTbody").html(e)
                                }
                            })

                        }
                    })
    
                    
                }


            })

            // EDIT EQUIPMENT MODAL FORM UPDATE
            $("#dashBoardBody").on("click","#editEquipmentBtn",function(){
                const id = $(this).val()


                $.ajax({
                    url: "schools_equipment/edit_equipment_modal.php",
                    method: 'post',
                    data: {
                        id:id
                    },
                    success(e){
                        $("#editEquipmentModalBody").html(e)
                    }
                })

            })

            // UPDATE EQUIPMENT ON DB
            $("#saveEditEquipmentBtn").click(function(){

                const id = $("#updateIdEquipment").val();
                const schoolName = $("#updateSchoolNameEquipment").val();

                const code = $("#inputCodeEdit").val();
                const article = $("#inputArticleEdit").val();
                const description = $("#inputDescriptionEdit").val();
                const date = $("#inputDateEdit").val();
                const unitValue = $("#inputUnitValueEdit").val();
                const totalValue = $("#inputTotalValueEdit").val();
                const sourceOfFunds = $("#inputSourceOfFundsEdit").val();
                const status = $("#inputStatusEdit").val();


                if(code && article && description && date && unitValue && totalValue && sourceOfFunds){
                    $.ajax({
                        url:"schools_equipment/update_equipment_client_db.php",
                        method:'post',
                        data:{
                            id:id,
                            code : code,
                            article : article,
                            description : description,
                            date : date,
                            unitValue : unitValue,
                            totalValue : totalValue,
                            sourceOfFunds : sourceOfFunds,
                            status : status
                        },
                        success(){
                            // $("#dashBoardBody").html(e)
    
                            $.ajax({
                                    url: "schools_equipment/equipmentTbody.php",
                                    method : 'post',
                                    data:{
                                        schoolName : schoolName
                                    },
                                    success(e){
                                        $("#equipmentTableTbody").html(e)
    
                                        $("#inputCodeEdit").val("")
                                        $("#inputArticleEdit").val("")
                                        $("#inputDescriptionEdit").val("")
                                        $("#inputDateEdit").val("")
                                        $("#inputUnitValueEdit").val("")
                                        $("#inputTotalValueEdit").val("")
                                        $("#inputSourceOfFundsEdit").val("")
                                        $("#inputStatusEdit").val("");

                                    }
                            })
                        }
                    })
                }else{
                    confirm(`Please fill up all the fields! or Type N/A if not applicable.`)
                }
            })

            // SEARCH EQUIPMENT
            $("#dashBoardBody").on("keyup","#searchEquipmentInput",function(){
                const searchValue = $(this).val();
                const schoolName = $("#schoolNameForDeleteAndSearch").val();

                $.ajax({
                    url:"schools_equipment/search_equipment.php",
                    method:"post",
                    data:{
                        searchValue : searchValue,
                        schoolName : schoolName
                    },
                    success(e){
                        $("#equipmentTableTbody").html(e)
                    }
                })
            })

            // PROFILE BUTTON
            $("#profileBtn").click(function(){
                // $('.dropdown-menu').toggleClass('d-block');
                const userId = $(this).val()

                $.ajax({
                    url:"profile.php",
                    method:"post",
                    data:{
                        id : userId
                    },
                    success(e){
                        $("#dashBoardBody").html(e)
                    }
                })
            })

            // PROFIE (UPDATE BUTTON)
            $("#dashBoardBody").on("click","#updateUserInfoProfile",function(){
                const id = $("#profileUserId").val()
                const newPass = $("#profileNewPassword").val();
                const retypePass = $("#profileNewpassValidation").val()

                // alert(id)
                
                if(newPass && retypePass){

                    if(newPass == retypePass){
                    
                        $.ajax({
                            url:"profileUpdate.php",
                            method:"post",
                            data:{
                                id:id,
                                newPass:newPass
                            },
                            success(e){
                                $("#dashBoardBody").html(e)
                            }
                        })

                        // alert(newPass)

                    }else{
                        $("#profileNewPassword").val("");
                        $("#profileNewpassValidation").val("")

                        confirm('Your password is not match!')
                    }
                }
                
            })


            // PROFIE (UPDATE BUTTON)
            $("#dashBoardBody").on("click","#editProfileBtnDb",function(){
                const id = $(this).val();

                $.ajax({
                    url:"profileUpdateModal.php",
                    method:"post",
                    data:{
                        id:id
                    },
                    success(e){
                        $("#profileModalBody").html(e)
                    }
                })
            })

            // PROFILE UPDATE (DATABASE)
            $("#profileUpdateBtnDatabase").click(function(){
                const id = $("#idEditSchool").val();
                const name = $("#inputNameEdited").val();
                const bday = $("#inputBirthDayEdited").val();
                const address = $("#inputAddressEdited").val();
                const inputEmployeeNoEdit = $("#inputEmployeeNoEdit").val();
                const inputPlaceOfBirthEdit = $("#inputPlaceOfBirthEdit").val();
                const inputCitizenEdit = $("#inputCitizenEdit").val();
                const inputCivilStatusEdit = $("#inputCivilStatusEdit").val();
                const inputZipcodeEdit = $("#inputZipcodeEdit").val();
                const email = $("#inputEmailEdited").val();
                const contact = $("#inputContactEdited").val();
                const sex = $("#inputSexEdited").val();
                const yearSchoolHead = $("#inputYearAsSchoolHeadEdited").val();
                const durationYear = $("#inputDurationYearEdited").val();
                const inputLearningPerformance = $("#inputLearningPerformanceEdited").val();
                const inputTeacherPerformance = $("#inputTeacherPerformanceEdited").val();
                const inputFinancialMng = $("#inputFinancialMngEdited").val();
                const inputComplaints = $("#inputComplaintsEdited").val();
                
                        
                $.ajax({
                    url:"profileUpdateDb.php",
                    method:"post",
                    data:{
                        id : id,
                        name : name,
                        bday : bday,
                        address : address,
                        employeeNoEdit : inputEmployeeNoEdit,
                        placeOfBirthEdit : inputPlaceOfBirthEdit,
                        citizenEdit : inputCitizenEdit,
                        civilStatusEdit : inputCivilStatusEdit,
                        zipcodeEdit : inputZipcodeEdit,
                        email : email,
                        contact : contact,
                        sex : sex,
                        yearSchoolHead : yearSchoolHead,
                        durationYear : durationYear,
                        inputLearningPerformance : inputLearningPerformance,
                        inputTeacherPerformance : inputTeacherPerformance,
                        inputFinancialMng : inputFinancialMng,
                        inputComplaints : inputComplaints
                    },
                    success(){

                        $.ajax({
                            url:"profile.php",
                            method:"post",
                            data:{
                                id : id
                            },
                            success(e){
                                confirm("Update profile successful!");
                                $("#dashBoardBody").html(e)
                            }
                        })
                    }
                })
            })


            // EXPORT TO EXCEL  BUTTON
            $("#dashBoardBody").on("click","#excelBtn",function(){
                if (confirm("Export this table?")) {
                    exportToExcel();
                }
            })

            // DOR FILE BUTTON MODAL
            $("#dorButtonModal").click(function(){
                const school = $(this).val();

                $.ajax({
                    url:"dorPictures.php",
                    method: "post",
                    data:{
                        school:school
                    },
                    success(e){
                        $("#dorBodyModal").html(e);
                    }
                })
            })

            // DOR FILE UPLOAD BUTTON DATABSE
            $("#uploadDorDbButton").click(function(){
                const schoolName = $("#schoolNameDor").val();
                const file = $("#inputFileDorPic").prop("files")[0];

                const formData = new FormData();
                formData.append("file", file);
                formData.append("school", schoolName);
                
                $.ajax({
                    url: "uploadDor.php",
                    type: "POST",
                    data:formData,
                    processData: false,
                    contentType: false,
                    success: function(data) {
                    console.log("Upload successful!");
                    }
                });
            })

            // PROFILE UPLOAD BUTTON DB
            $("#profileUploadBtnDb").click(function(){
                const id = $("#profilePictureId").val();
                const file = $("#profileUploadedPicture").prop("files")[0];

                const formData = new FormData();
                formData.append("file", file);
                formData.append("id", id);

                if(file){

                    $.ajax({
                        url: "uploadProfilePic.php",
                        type: "POST",
                        data:formData,
                        processData: false,
                        contentType: false,
                        success: function() {

                            $.ajax({
                                url:"profile.php",
                                method:"post",
                                data:{
                                    id:id
                                },
                                success(e){
                                    $("#dashBoardBody").html(e)
                                }
                            })

                            $.ajax({
                                url:"profileHeaderUpdate.php",
                                method:"post",
                                data:{
                                    id:id
                                },
                                success(e){
                                    $("#profileIconHeader").html(e)
                                }
                            })

                        }
                    });
                }else{
                    confirm('Please Select file!');
                }
                
                
            })

            $("#dashBoardBody").on("click","#uploadHereButton",function(){
                const id = $(this).val()

                $.ajax({
                    url:"updateModalProfile.php",
                    method:"post",
                    data:{
                        id : id
                    },
                    success(e){
                        $("#uploadProfileModalUpdate").html(e)
                    }
                })
            })


            // PROFILE MAIN
            $("#dashBoardBody").on("click","#profileProfileButton",function(){
                const email = $("#profileUserEmail").val();

                $.ajax({
                    url:"profile.php",
                    method:"post",
                    data:{
                        id : email
                    },
                    success(e){
                        $("#dashBoardBody").html(e)

                    }
                })
            })

            // PROFILE EDUCATION BG
            $("#dashBoardBody").on("click","#profileEducationButton",function(){
                const email = $("#profileUserEmail").val();

                $.ajax({
                    url:"profileInfo/education.php",
                    method:"post",
                    data:{
                        id : email
                    },
                    success(e){
                        $("#dashBoardBody").html(e)

                    }
                })
            })

            // UPDATE EDUCATION BUTTON MODAL
            $("#dashBoardBody").on("click","#updateProfileEducationButton",function(){
                const email = $(this).val();

                $.ajax({
                    url:"profileInfo/updateEducationModal.php",
                    method: "post",
                    data:{
                        email : email
                    },
                    success(e){
                        $('#modalBodyupdateEducation').html(e)
                    }
                })
            })

            // update Education button Database
            $("#profileSaveButtonEducation").click(function(){

                
                const email = $("#userEmailProfile").val();

                // elem
                const es = $('#Eschool').val();
                const ec = $('#Ecourse').val();
                const ef = $('#Efrom').val();
                const et = $('#Eto').val();
                const eh = $('#Ehigh').val();
                const ey = $('#Eyear').val();
                const eSc = $('#Escholar').val();
                
                // secondary
                const ss = $('#Sschool').val();
                const sc = $('#Scourse').val();
                const sf = $('#Sfrom').val();
                const st = $('#Sto').val();
                const sh = $('#Shigh').val();
                const sy = $('#Syear').val();
                const sSc = $('#Sscholar').val();

                // vocational
                const vs = $('#Vschool').val();
                const vc = $('#Vcourse').val();
                const vf = $('#Vfrom').val();
                const vt = $('#Vto').val();
                const vh = $('#Vhigh').val();
                const vy = $('#Vyear').val();
                const vSc = $('#Vscholar').val();
                
                // college
                const cs =  $("#Cschool").val()
                const cc = $("#CCourse").val()
                const cf = $("#CFrom").val()
                const ct = $("#CTo").val()
                const ch =$("#CHigh").val()
                const cy = $("#CYear").val()
                const cSc = $("#CScholar").val()
                
                // graduate
                const gs =  $("#Gschool").val()
                const gc = $("#GCourse").val()
                const gf = $("#GFrom").val()
                const gt = $("#GTo").val()
                const gh =$("#GHigh").val()
                const gy = $("#GYear").val()
                const gSc = $("#GScholar").val()

                // alert(cSc)

                $.ajax({
                    url:"profileInfo/updateEducation.php",
                    method:"post",
                    data:{
                        email : email,
                        // elem
                        es : es,
                        ec : ec,
                        ef :ef,
                        et :et,
                        eh :eh,
                        ey :ey,
                        eSc : eSc,
                        
                        // secondary
                        ss : ss,
                        sc :sc,
                        sf :sf,
                        st :st,
                        sh :sh,
                        sy :sy,
                        sSc :sSc,

                        // vocational
                        vs : vs,
                        vc :vc,
                        vf :vf,
                        vt :vt,
                        vh :vh,
                        vy :vy,
                        vSc :vSc,
                        
                        // college
                        cs : cs,
                        cc : cc,
                        cf : cf,
                        ct : ct,
                        ch : ch,
                        cy : cy,
                        cSc : cSc,
                        // graduate
                        gs : gs,
                        gc : gc,
                        gf : gf,
                        gt : gt,
                        gh : gh,
                        gy : gy,
                        gSc : gSc
                    },
                    success(e){
                        
                        $.ajax({
                            url:"profileInfo/education.php",
                            method:"post",
                            data:{
                                id : email
                            },
                            success(e){
                                $("#dashBoardBody").html(e)

                            }
                        })
                    }
                })
            })

            //LEARNING and development button
            $("#dashBoardBody").on("click","#profileLearningAndDevelopmentButton",function(){
                const email = $("#profileUserEmail").val();

                // alert(email)

                $.ajax({
                    url:"profileInfo/learning_and_development.php",
                    method:"post",
                    data:{
                        email : email
                    },
                    success(e){
                        $("#dashBoardBody").html(e)

                    }
                })
            })

            // CIVIL BUTTON
            $("#dashBoardBody").on("click","#profileCivilButton",function(){
                const email = $("#profileUserEmail").val();

                // alert(email)

                $.ajax({
                    url:"profileInfo/civil.php",
                    method:"post",
                    data:{
                        email : email
                    },
                    success(e){
                        $("#dashBoardBody").html(e)

                    }
                })
            })

            // ADD CIVIL BUTTON DB
            $("#addCivilServiceButtonDb").click(function(){
                const email = $("#profileUserEmail").val();
                const career = $("#civilInputCareer").val();
                const rating = $("#civilInputRating").val();
                const dateExam = $("#civilDateExam").val();
                const placeExam = $("#civilPlaceExam").val();
                const Ldate = $("#civilDate").val();
                const Lnumber = $("#civilNumber").val();

                if(career){
                    $.ajax({
                        url:"profileInfo/addCivilDb.php",
                        method:"post",
                        data:{
                            email : email,
                            career : career,
                            rating : rating,
                            dateExam : dateExam,
                            placeExam : placeExam,
                            Ldate : Ldate,
                            Lnumber : Lnumber
                        },
                        success(){
                            $.ajax({
                                url:"profileInfo/civil.php",
                                method:"post",
                                data:{
                                    email : email
                                },
                                success(e){
                                    $("#dashBoardBody").html(e)

                                    confirm("Add Success!")

                                }
                            })
                        }
                    })
                }else{
                    confirm("Please add career service!")
                }
                
            })

            // WORK EXPERIENCE BUTTON
            $("#dashBoardBody").on("click","#profileWorkExpBtn",function(){
                const email = $("#profileUserEmail").val();

                // alert(email)

                $.ajax({
                    url:"profileInfo/workExp.php",
                    method:"post",
                    data:{
                        email : email
                    },
                    success(e){
                        $("#dashBoardBody").html(e)

                    }
                })
            })

            // ADD DEGREE DATABASE BUTTON
            $("#addDegreeButtonDatabase").click(function(){
                const email = $("#degreeUserEmail").val();
                const degree = $("#inputDegreeDegree").val();
                const school = $("#inputDegreeSchool").val();
                const educ = $("#inputDegreeEduc").val();
                const from = $("#inputDegreeFrom").val();
                const to = $("#inputDegreeTo").val();
                const high = $("#inputDegreeHigh").val();
                const year = $("#inputDegreeYear").val();
                const scholar = $("#inputDegreeScholar").val();

                $.ajax({
                    url:"profileInfo/addDegreeDb.php",
                    method:"post",
                    data:{
                        email : email,
                        degree : degree,
                        school : school,
                        educ : educ,
                        from : from,
                        to : to,
                        high : high,
                        year : year,
                        scholar : scholar
                    },
                    success(){

                        $.ajax({
                            url:"profileInfo/education.php",
                            method:"post",
                            data:{
                                id : email
                            },
                            success(e){
                                $("#dashBoardBody").html(e)

                            }
                        })

                    }
                })
            })

            // EDIT DEGREE BUTTON
            $("#dashBoardBody").on('click','#editButonDegreeModal',function(){
                const id = $(this).val();

                $.ajax({
                    url:"profileInfo/editDegreeModal.php",
                    method:'post',
                    data:{
                        id:id
                    },
                    success(e){
                        $("#modalBodyEditDegree").html(e)
                    }
                })

            })

            // UPDATE DEGREE DATABASE BUTTON
            $('#updateDegreeDatabaseButton').click(function(){
                
                const email = $("#editDegreeUserId").val()
                const id = $("#editDegreeUserEmail").val();
                const degree = $("#inputEditDegreeDegree").val();
                const school = $("#inputEditDegreeSchool").val();
                const educ = $("#inputEditDegreeEduc").val();
                const from = $("#inputEditDegreeFrom").val();
                const to = $("#inputEditDegreeTo").val();
                const high = $("#inputEditDegreeHigh").val();
                const year = $("#inputEditDegreeYear").val();
                const scholar = $("#inputEditDegreeScholar").val();

                // alert(scholar)

                $.ajax({
                    url:"profileInfo/updateDegreeDb.php",
                    method:"post",
                    data:{
                        id : id,
                        degree : degree,
                        school : school,
                        educ : educ,
                        from : from,
                        to : to,
                        high : high,
                        year : year,
                        scholar : scholar
                    },
                    success(e){

                        // $("#dashBoardBody").html(e)

                        $.ajax({
                            url:"profileInfo/education.php",
                            method:"post",
                            data:{
                                id : email
                            },
                            success(e){
                                $("#dashBoardBody").html(e)

                            }
                        })

                    }
                })

            })

            // delete degree db
            $("#dashBoardBody").on("click","#deleteButonDegreeModal",function(){
                const id = $(this).val();
                const email = $("#userEmailProfile").val()

                if(confirm("Are you sure to delete this?")){
                    $.ajax({
                    url:"profileInfo/deleteDegree.php",
                    method:"post",
                    data:{
                        id:id
                    },
                    success(){
                        $.ajax({
                            url:"profileInfo/education.php",
                            method:"post",
                            data:{
                                id : email
                            },
                            success(e){
                                $("#dashBoardBody").html(e)

                            }
                        })
                    }
                })
                }
               
            })

            // MODAL EDIT CIVIL BUTTON
            $("#dashBoardBody").on("click","#editCivilModalButton",function(){

                const id = $(this).val();

                $.ajax({
                    url:"profileInfo/civilModalUpdate.php",
                    method:"post",
                    data:{
                        id : id
                    },
                    success(e){
                        $("#modalBodyCivilUpdate").html(e)
                    }
                })
            })

            // CIVIL UPDATE DATA BASE
            $("#civilUpdateButtonDatabase").click(function(){
                const id = $("#idForCivilUpdate").val();
                const email = $("#emailForCivilUpdate").val();
                const career = $("#EditcivilInputCareer").val();
                const rating = $("#EditcivilInputRating").val();
                const dateExam = $("#EditcivilDateExam").val();
                const placeExam = $("#EditcivilPlaceExam").val();
                const Ldate = $("#EditcivilDate").val();
                const Lnumber = $("#EditcivilNumber").val();

                $.ajax({
                    url:"profileInfo/civilUpdate.php",
                    method:'post',
                    data:{
                        id:id,
                        career:career,
                        rating:rating,
                        dateExam:dateExam,
                        placeExam:placeExam,
                        Ldate:Ldate,
                        Lnumber:Lnumber
                    },
                    success(e){
                        // $("#dashBoardBody").html(e)

                        $.ajax({
                            url:"profileInfo/civil.php",
                            method:"post",
                            data:{
                                email : email
                            },
                            success(e){
                                $("#dashBoardBody").html(e)

                                confirm("Update Success!")

                            }
                        })
                    }
                })
            })

            // CIVIL DELETE DB
            $("#dashBoardBody").on('click','#civilDeleteButtonDB',function(){
                const id = $(this).val();
                const email = $("#profileUserEmail").val();

                // alert(email)

                if(confirm("Are you sure to delete this?")){
                    $.ajax({
                        url:"profileInfo/civilDelete.php",
                        method:'post',
                        data:{
                            id:id
                        },
                        success(){

                            $.ajax({
                                url:"profileInfo/civil.php",
                                method:"post",
                                data:{
                                    email : email
                                },
                                success(e){
                                    $("#dashBoardBody").html(e)

                                    // confirm("Update Success!")

                                }
                            })
                        }
                    })
                }
                
            })
            
            // ADD WORKEXP DB
            $("#addWorkServiceButtonDb").click(function(){
                
                const email = $("#profileUserEmail").val();
                const from = $("#workExpDateFrom").val();
                const to = $("#workExpDateTo").val();
                const positionLvl = $("#workExpPositionLvl").val();
                const position = $("#workExpPosition").val();
                const department = $("#workExpDepartment").val();
                const salary = $("#workExpSalary").val();
                const job = $("#workExpJob").val();
                const status = $("#workExpStatus").val();
                const service = $("#workExpService").val();

                if(position){
                    $.ajax({
                        url:"profileInfo/addWork.php",
                        method:"post",
                        data:{
                            email:email,
                            from:from,
                            to:to,
                            positionLvl:positionLvl,
                            position:position,
                            department:department,
                            salary:salary,
                            job:job,
                            status:status,
                            service:service
                        },
                        success(){
                            $.ajax({
                                url:"profileInfo/workExp.php",
                                method:"post",
                                data:{
                                    email : email
                                },
                                success(e){
                                    $("#dashBoardBody").html(e)
                                    confirm("Add success!")

                                }
                            })
                        }
                    })
                }else{
                    confirm("Please add Position Title!")
                }

            })

            // WORK EXP EDIT BUTTON MODAL UPDATE
            $("#dashBoardBody").on("click","#editWorkExpBtnForModal",function(){
                const id = $(this).val();

                $.ajax({
                    url:"profileInfo/workUpdateModal.php",
                    method:"post",
                    data:{
                        id:id
                    },
                    success(e){
                        $("#editWorkExpModalBody").html(e)
                    }
                })

            })

            // WORK UPDATE DB
            $("#updateWorkExpButtonDb").click(function(){

                const email = $("#profileUserEmail").val();
                const id = $("#workUserId").val();

                const from = $("#EditworkExpDateFrom").val();
                const to = $("#EditworkExpDateTo").val();
                const positionLvl = $("#EditworkExpPositionLvl").val();
                const position = $("#EditworkExpPosition").val();
                const department = $("#EditworkExpDepartment").val();
                const salary = $("#EditworkExpSalary").val();
                const job = $("#EditworkExpJob").val();
                const status = $("#EditworkExpStatus").val();
                const service = $("#EditworkExpService").val();

                $.ajax({
                    url:"profileInfo/workUpdate.php",
                    method: "post",
                    data:{
                        id:id,
                        from:from,
                        to:to,
                        positionLvl:positionLvl,
                        position:position,
                        department:department,
                        salary:salary,
                        job:job,
                        status:status,
                        service:service
                    },
                    success(){

                        $.ajax({
                            url:"profileInfo/workExp.php",
                            method:"post",
                            data:{
                                email : email
                            },
                            success(e){
                                $("#dashBoardBody").html(e)

                                confirm("Update success!")
                            }
                        })

                    }
                })
            })

            // WORK DELETE 
            $("#dashBoardBody").on("click","#deleteWorkExpButtonDb",function(){
                const id = $(this).val();
                const email = $("#userEmailProfile").val();

                if(confirm("Are you sure to delete this?")){

                    $.ajax({
                        url:"profileInfo/workDelete.php",
                        method:"post",
                        data:{
                            id:id
                        },
                        success(){
    
                            $.ajax({
                                url:"profileInfo/workExp.php",
                                method:"post",
                                data:{
                                    email : email
                                },
                                success(e){
                                    $("#dashBoardBody").html(e)
    
                                }
                            })
                        }
                    })
                }
            })

            // AWARD BUTTON LOAD
            $("#dashBoardBody").on("click","#profileAwardExpBtn",function(){
                const email = $("#profileUserEmail").val();

                $.ajax({
                    url:"profileInfo/award.php",
                    method:"post",
                    data:{
                        email:email
                    },
                    success(e){
                        $("#dashBoardBody").html(e)
                    }
                })
            })

            // ADD AWARD DB
            $("#profileAwardAddBtnDb").click(function(){

                const email = $("#profileUserEmail").val();
                const title = $("#inputAwardTitle").val();
                const lvl = $("#inputAwardlvl").val();
                const date = $("#inputAwardDate").val();


                if(title){
                    $.ajax({
                        url:"profileInfo/addAward.php",
                        method:"post",
                        data:{
                            email : email,
                            title : title,
                            lvl : lvl,
                            date : date
                        },
                        success(){

                            $.ajax({
                                url:"profileInfo/award.php",
                                method:"post",
                                data:{
                                    email:email
                                },
                                success(e){
                                    $("#dashBoardBody").html(e)

                                    confirm("Add award success")

                                }
                            })

                        }
                    })
                }else{
                    confirm("Please add title!")
                }
               
            })

            // AWARD EDIT BUTTON UPDATE MODAL
            $("#dashBoardBody").on("click","#profileAwardEditButtonModal",function(){
                const id = $(this).val();

                $.ajax({
                    url:"profileInfo/updateAwardModal.php",
                    method:"post",
                    data:{
                        id:id
                    },
                    success(e){
                        $("#awardModalBody").html(e)
                    }
                })
            })

            // UPDATE AWARD DATABASE BUTTON
            $("#profileAwardUpdateButtonDb").click(function(){

                const id = $("#profileAwardid").val();
                const email = $("#profileUserEmail").val();
                const title = $("#EditinputAwardTitle").val();
                const lvl = $("#EditinputAwardlvl").val();
                const date = $("#EditinputAwardDate").val();

                // alert(date)

                $.ajax({
                    url:"profileInfo/updateAward.php",
                    method:"post",
                    data:{
                        id : id,
                        title : title,
                        lvl : lvl,
                        date : date
                    },
                    success(){

                        $.ajax({
                            url:"profileInfo/award.php",
                            method:"post",
                            data:{
                                email:email
                            },
                            success(e){
                                $("#dashBoardBody").html(e)

                                confirm("Update success")
                            }
                        })

                    }
                })
            })

            // DELETE AWARD DATABASE BUTTON
            $("#dashBoardBody").on("click","#profileAwardDeleteButton",function(){
                const id = $(this).val();
                const email = $("#userEmailProfile").val();

                if(confirm("Are you sure to delete this?")){
                    $.ajax({
                        url:"profileInfo/awardDelete.php",
                        method:"post",
                        data:{
                            id:id
                        },
                        success(){
    
                            $.ajax({
                                url:"profileInfo/award.php",
                                method:"post",
                                data:{
                                    email:email
                                },
                                success(e){
                                    $("#dashBoardBody").html(e)
                                }
                            })
    
                        }
                    })
                }
            })
            
            // ADD LEARNING BUTTON DB
            $("#profileAddLearningButtonDb").click(function(){

                const email = $("#userEmailProfile").val();
                const title = $("#learningAndDevelopmentTitle").val();
                const from = $("#learningAndDevelopmentDateFrom").val();
                const to = $("#learningAndDevelopmentDateTo").val();
                const hrs = $("#learningAndDevelopmentHours").val();
                const typeOfLd = $("#learningAndDevelopmentLD").val();
                const conducted = $("#learningAndDevelopmentConducted").val();

                if(title){
                    $.ajax({
                    url:"profileInfo/addLearning.php",
                    method:"post",
                    data:{
                        email:email,
                        title:title,
                        from:from,
                        to:to,
                        hrs:hrs,
                        typeOfLd:typeOfLd,
                        conducted:conducted
                    },
                    success(e){
                        // $("#dashBoardBody").html(e)

                        $.ajax({
                            url:"profileInfo/learning_and_development.php",
                            method:"post",
                            data:{
                                email : email
                            },
                            success(e){
                                $("#dashBoardBody").html(e)

                                confirm("Add success!")
                            }
                        })
                    }
                    })
                }else{
                    confirm("Please add Title")
                }
                

            })

            // edit learner button
            $("#dashBoardBody").on("click","#editLearnerButoonModal",function(){
                const id = $(this).val();
                
                $.ajax({
                    url:"profileInfo/updateLearningModal.php",
                    method:"post",
                    data:{
                        id:id
                    },
                    success(e){
                        $("#learningModalBody").html(e)
                    }
                })

            })

            // LEARNING UPDATE
            $("#profileLearningUpdateButtonDb").click(function(){
                const id = $("#learnerIdUser").val()
                const email = $("#learnerEmailUser").val()

                const title = $("#EditlearningAndDevelopmentTitle").val();
                const from = $("#EditlearningAndDevelopmentDateFrom").val();
                const to = $("#EditlearningAndDevelopmentDateTo").val();
                const hrs = $("#EditlearningAndDevelopmentHours").val();
                const typeOfLd = $("#EditlearningAndDevelopmentLD").val();
                const conducted = $("#EditlearningAndDevelopmentConducted").val();

                // console.log(id,email,title,from,to,hrs,typeOfLd,conducted)

                if(title){
                    $.ajax({
                        url:"profileInfo/learningUpdate.php",
                        method:"post",
                        data:{
                            id:id,
                            title:title,
                            from:from,
                            to:to,
                            hrs:hrs,
                            typeOfLd:typeOfLd,
                            conducted:conducted
                        },
                        success(){
                            // $("#dashBoardBody").html(e)

                            $.ajax({
                                url:"profileInfo/learning_and_development.php",
                                method:"post",
                                data:{
                                    email : email
                                },
                                success(e){
                                    $("#dashBoardBody").html(e)

                                    confirm("Update success!")
                                }
                            })
                        }
                    })
                }else{
                    confirm("Please add Title")
                }
            })

            // DELETE LEARNING
            $("#dashBoardBody").on("click","#profileLearningDeleteButton",function(){
                const id = $(this).val()
                const email = $("#userEmailProfile").val()

                if(confirm("Are you sure to delete this?")){
                    $.ajax({
                        url:"profileInfo/learnerDelete.php",
                        method:"post",
                        data:{
                            id:id
                        },
                        success(){

                            $.ajax({
                                url:"profileInfo/learning_and_development.php",
                                method:"post",
                                data:{
                                    email : email
                                },
                                success(e){
                                    $("#dashBoardBody").html(e)

                                    // confirm("Update success!")
                                }
                            })
                        }
                    })
                }
                
            })

            // Get year experience
            

            // UPLOAD Credential button
            $("#uploadCredentialButtonDB").click(function(){
                const email = $("#userEmailProfile").val();
                const file = $("#uploadCredentialInput").prop("files")[0];

                // alert()

                const formData = new FormData();
                formData.append("file", file);
                formData.append("email", email);

                if(file){

                    $.ajax({
                        url: "uploadCredential.php",
                        type: "POST",
                        data:formData,
                        processData: false,
                        contentType: false,
                        success: function() {

                            

                        }
                    });
                }else{
                    confirm('Please Select file!');
                }
            })

            
            // GET TEACHING PERSONEL EXP
            const from = $("[id = 'allDateFrom']").map(function() {
                return $(this).val();
            }).get();

            const to = $("[id = 'allDateTo']").map(function() {
                return $(this).val();
            }).get();


            let totalDiff = 0;

            for (let i = 0; i < from.length; i++) {
                let startDate = moment(from[i]);
                let endDate = moment(to[i]);
                totalDiff += endDate.diff(startDate, 'years');
            }
            if(totalDiff){
                // console.log('1')
                $("#yearAsTeachingPersonnel").html(`${totalDiff} YEAR(S)`)
            }else{
                // console.log('2')
                $("#yearAsTeachingPersonnel").html(`0 YEAR(S)`)
            }
            

            // GET SYSTEM AD EXP YEARS
            const fromAdmin = $("[id = 'allDateFromAdmin']").map(function() {
                return $(this).val();
            }).get();

            const toAdmin = $("[id = 'allDateToAdmin']").map(function() {
                return $(this).val();
            }).get();

            // console.log(fromAdmin)
            // console.log(toAdmin)

            let totalDiffAdmin = 0;

            for (let i = 0; i < fromAdmin.length; i++) {
                let startDateAdmin = moment(fromAdmin[i]);
                let endDateAdmin = moment(toAdmin[i]);
                totalDiffAdmin += endDateAdmin.diff(startDateAdmin, 'years');
            }

            if(totalDiffAdmin){
                // console.log('1')
                $("#yearAsSchoolAdmin").html(`${totalDiffAdmin} YEAR(S)`)
            }else{
                // console.log('2')
                $("#yearAsSchoolAdmin").html(`0 YEAR(S)`)
            }

            // Change dropdown in work experience depend on position titl
            $("#workExpPositionLvl").change(function(){
                const lvl = $(this).val()

                if(lvl == 'School Administrator'){
                    $("#workExpPosition").html("<option value='Head Teacher I'>Head Teacher I</option><option value='Head Teacher II'>Head Teacher II</option><option value='Head Teacher II'>Head Teacher III</option><option value='Head Teacher IV'>Head Teacher IV</option><option value='Head Teacher V'>Head Teacher V</option><option value='Head Teacher VI'>Head Teacher VI</option><option value='School Head I'>School Head I</option><option value='School Head II'>School Head II</option><option value='School Head III'>School Head III</option><option value='School Head IV'>School Head IV</option><option >Other Admin Roles (Please Specify)</option>")
                }else{
                    $("#workExpPosition").html("<option value='Teacher I'>Teacher I</option><option value='Teacher II'>Teacher II</option><option value='Teacher III'>Teacher III</option><option value='Master Teacher I'>Master Teacher I</option><option value='Master Teacher II'>Master Teacher II</option><option value='Master Teacher III'>Master Teacher III</option>")

                }
            })

            $("#editWorkExpModalBody").on("change","#EditworkExpPositionLvl",function(){
                const lvl = $(this).val()

                // alert(lvl)
                if(lvl == 'School Administrator'){
                    $("#EditworkExpPosition").html("<option value='Head Teacher I'>Head Teacher I</option><option value='Head Teacher II'>Head Teacher II</option><option value='Head Teacher II'>Head Teacher III</option><option value='Head Teacher IV'>Head Teacher IV</option><option value='Head Teacher V'>Head Teacher V</option><option value='Head Teacher VI'>Head Teacher VI</option><option value='School Head I'>School Head I</option><option value='School Head II'>School Head II</option><option value='School Head III'>School Head III</option><option value='School Head IV'>School Head IV</option><option >Other Admin Roles (Please Specify)</option>")
                }else{
                    $("#EditworkExpPosition").html("<option value='Teacher I'>Teacher I</option><option value='Teacher II'>Teacher II</option><option value='Teacher III'>Teacher III</option><option value='Master Teacher I'>Master Teacher I</option><option value='Master Teacher II'>Master Teacher II</option><option value='Master Teacher III'>Master Teacher III</option>")
                }
            })

        })

        function exportToExcel() {

            const table = $("#tableToXLS");
            const headers = [];
            const rows = table.find("tr");
            const data = [];

            // Collect header data from table
            table.find("th:not(:last-child)").each(function() {
                headers.push($(this).text());
            });

            // Collect data from table, excluding the last column
            rows.each(function() {
                const row = [];
                $(this).find("td:not(:last-child)").each(function() {
                    row.push($(this).text());
                });
                data.push(row);
            });

            // Prepend header data to the data array
            data.unshift(headers);

            // Convert data to a workbook and export to XLSX
            const wb = XLSX.utils.book_new();
            const ws = XLSX.utils.aoa_to_sheet(data);
            XLSX.utils.book_append_sheet(wb, ws, "Sheet1");
            XLSX.writeFile(wb, "<?php echo $fetchUserInfo['school']?>"+".xlsx");
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <?php include 'footer.php' ?>
</body>
</html>