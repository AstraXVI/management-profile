<?php
    require "db.php";
    session_start();

    $userId = $_SESSION['id'];

    if(empty($_SESSION['status']) || $_SESSION['status'] == 'invalid'){

        header("location: index.php");
    }

    if($_SESSION['status'] == 'client'){

        header("location: client_dashboard.php");
    }
    
    // Logout btn
    if(isset($_POST['logoutBtn'])){
        unset($_SESSION['id']);
        unset($_SESSION['status']);

        header("location: index.php");
    }

    // GET USER INFO
    $getUserInfo = "SELECT * FROM users WHERE id='$userId'";
    $userInfo = $con->query($getUserInfo);
    $fetchUserInfo = $userInfo->fetch_assoc();

    // =================FOR DASH BOARD COUNT
    // ADMIN
    $countAdmin = "SELECT * FROM `users` WHERE role='admin'";
    $listAdmin = $con->query($countAdmin);
    $adminCount = $listAdmin->num_rows;
    // CLIENT
    $countClient = "SELECT * FROM `users` WHERE role='client'";
    $listClient = $con->query($countClient);
    $clientCount = $listClient->num_rows;
    // SCHOOL
    $countSchool = "SELECT * FROM `schools`";
    $listSchool = $con->query($countSchool);
    $schoolCount = $listSchool->num_rows;
    // Elementary School
    $countElemSchool = "SELECT * FROM `schools` WHERE level='Elementary School'";
    $listElemSchool = $con->query($countElemSchool);
    $elemSchoolCount = $listElemSchool->num_rows;
    // High School
    $countHighSchool = "SELECT * FROM `schools` WHERE level='High School'";
    $listHighSchool = $con->query($countHighSchool);
    $highSchoolCount = $listHighSchool->num_rows;


    // GET NUMBER OF REQUEST
    $getRequest = "SELECT * FROM `equipment` WHERE permission='Deny'";
    $listRequest = $con->query($getRequest);
    $requestCount = $listRequest->num_rows;

    // 
    $y = "SELECT * FROM `profile`";
    $x = $con->query($y);
    $p = $x->num_rows;


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.2.min.js" integrity="sha256-2krYZKh//PcchRtd+H+VyyQoZ/e3EcrkxhM8ycwASPA=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/admin_dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Prata&family=Rubik:wght@400;500&display=swap" rel="stylesheet">
    <style>
        body > header > div > ul > li:nth-child(2):hover{
            background-color: #E9ECEF;
        }
        *{
            font-family: 'Montserrat', sans-serif;
            /* font-family: 'Prata', serif;
            font-family: 'Rubik', sans-serif; */
            }
        html{
            font-size: 15px;
        }
    </style>
</head>
<body style="background: url(https://cdn.pixabay.com/photo/2017/07/01/19/48/background-2462431_960_720.jpg) no-repeat; background-size: cover; background-color: #e5e5e5; background-blend-mode: overlay; ">
    <header class="d-flex align-items-center py-2 bg-success text-light" style=" position: absolute; top: 20px; right:40px; padding-inline: 20px;  border-radius: 10px;">
        <span id='profileIconHeader'>
            <?php if(empty($fetchUserInfo['picture'])){ ?>
                <i class="fa-solid fa-user fs-4 mt-1"></i>
            <?php }else{ ?>
                <img src="<?php echo $fetchUserInfo['picture'] ?>" alt="" style='width:30px;height:30px;border: 3px solid white ;border-radius: 100vmax; margin-right: 7px;'>
            <?php } ?>
        </span>
        <div class="dropdown">
            <a id="dropdownBtn" class="text-decoration-none dropdown-toggle ps-1" style="color: #f5f5f5" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <?php echo $fetchUserInfo['email'] ?>
            </a>

            <ul class="dropdown-menu">
                <li id="profileBtn" value='<?php echo $fetchUserInfo['id'] ?>' ><button class="dropdown-item py-2">My Profile</button></li>
                <li>
                    <!-- <a class="dropdown-item" href="#"> -->
                        <!-- <form action="" method="post">
                            <span class="d-flex align-items-center"><i class="fa-solid fa-right-from-bracket text-danger"></i><input type="submit" class="btn btn-sm" name="logoutBtn" value="LOGOUT"></span>
                        </form> -->
                    <!-- </a> -->
                    <a class='btn ms-1' data-bs-toggle="modal" data-bs-target="#LogoutModal">Logout</a>
                </li>
            </ul>
        </div>
        </div>
    </header>
    <div class='container-fluid m-0 p-0 flex-grow-1 d-flex'>
    <!-- <span class="position-absolute" style="left: 300px; top: 30px;"><i id="menuBtn" class="fa-solid fa-bars text-dark fs-3"></i></span> -->
        <div class='nav_wrapper'>
            <nav>
                <div class="d-flex flex-column flex-shrink-0 p-3 bg-dark text-light" style="min-width: 280px; max-width: 290px; height:100vh; position-relative">
                    <a href="admin_dashboard.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
                    <img class="bi me-2" width="50" height="50" src="https://sdovalenzuelacity.deped.gov.ph/wp-content/uploads/2021/04/New-DO-Logo.png" alt="logo">
                    <span class="fs-6 text-light">DepEd Valenzuela Personnel Profile System</span>
                    </a>
                    <!-- lagyan mo id at tawagin mo addevent para lumabas or hindi ang navbar -->
                    <hr>
                    <ul class="nav nav-pills flex-column mb-auto">
                        <li>
                            <a id="navBtn1" class="nav-link link-light active" href="javascript:window.location.reload(true)">
                                <span class="bi me-2" width="16" height="16"><i class="fa-solid fa-chart-simple"></i></span>
                                Dashboard
                            </a>
                        </li>
                        <!-- <li id='chiefHeadBtn'>
                            <a id='navBtn4' href="#" class="nav-link link-light">
                                <span class="bi me-2" width="16" height="16"><i class="fa-solid fa-clipboard-user"></i></span>
                                Chief Head
                            </a>
                        </li> -->
                        <li id='schoolBtn'>
                            <a id="navBtn2" href="#" class="nav-link link-light">
                                <span class="bi me-2" width="16" height="16"><i class="fa-solid fa-user-tie"></i></span>
                                School Head
                            </a>
                            <ul id='levelBtnDashboard' style='display:none; padding-left: 13px;'>
                                <li><button class='ms-n4 bg-dark text-light' value='High School' style="border:none;" id='navHighSchoolBtn'><i class="fa-solid fa-minus text-secondary me-2"></i>High School</button></li>
                                <li><button class='bg-dark text-light' value='Elementary School' style="border:none;" id='navElemSchoolBtn'><i class="fa-solid fa-minus text-secondary me-2"></i>Elementary School</button></li>
                            </ul>
                        </li>
                        <!-- <li id='unitHeadBtn'>
                            <a id='navBtn5' href="#" class="nav-link link-light">
                                <span class="bi me-2" width="16" height="16"><i class="fa-solid fa-user"></i></span>
                                Unit Head
                            </a>
                        </li> -->
                        <li id='manageUserBtn'>
                            <a id='navBtn3' href="#" class="nav-link link-light">
                                <span class="bi me-2" width="16" height="16"><i class="fa-solid fa-users"></i></span>
                                Manage Users
                            </a>
                        </li>
                        <!-- <li id='requestBtn'>
                            <a id='navBtn4' href="#" class="nav-link link-light">
                                <span class="bi me-2" width="16" height="16"><i class="fa-solid fa-calendar-plus"></i></span>
                                Request Approval 
                                
                                <span id='requestCountNav'>
                                    <?php if($requestCount){ ?>
                                        <span style='background-color:gray;color:black;padding:5px'><?php echo $requestCount  ?></span>
                                    <?php } ?>
                                </span>

                            </a>
                        </li> -->
                    </ul>
                </div>
                <!-- <ul>
                    <li><a href="javascript:window.location.reload(true)">Dashboard</a></li>
                    <li id='schoolBtn'>Schoool</li>
                </ul> -->
            </nav>
        </div>
    
        <div id='dashBoardBody' class="mx-auto w-75" style=" margin-top: 100px;">
            <!-- Ilagay dito ang dashboard -->
            <div class=" text-secondary fw-bold p-2 ps-0 mb-3 w-25 h3">Dashboard</div>
            <div class="d-flex flex-column py-5 px-5 text-light" style="gap: 30px; background-color: white; height: 65vh; overflow-y: scroll;">
                <div class="d-flex flex-row gap-5">
                    <div class="card w-100" style=" border: none; max-width: 310px">
                        <div class="card-body bg-dark" style="border-radius: 20px;">
                            <!-- Title -->
                            <h4 class="card-title"><i class="fa-solid fa-users-gear me-3"></i><?php echo $adminCount ?> <br> <p class="mt-2">System Admin</p></h4>
                            <hr>
                            <!-- Text -->
                            <p class="card-text">Number of People who have more control to the system.</p>
                            <!-- <button class="btn btn-rounded text-light px-4 btn-md toManageUser" style="background-color: rgba(0, 0, 0, 0.3);">See more<i class="fa-solid fa-arrow-up-right-from-square ms-2"></i></button> -->
                        </div>
                    </div>
                    <div class="card w-100" style="border: none; max-width: 310px">
                        <div class="card-body bg-success" style="border-radius: 20px;">
                            <!-- Title -->
                            <h4 class="card-title"><i class="fa-solid fa-user-tie me-3"></i><?php echo $p ?> <br> <p class="mt-2">School Head</p></h4>
                            <hr>
                            <!-- Text -->
                            <p class="card-text">Number of registered School head.</p>
                            <!-- <button id="toSchoolList" class="btn btn-rounded text-light px-4 btn-md" style="background-color: rgba(0, 0, 0, 0.3);">See more<i class="fa-solid fa-arrow-up-right-from-square ms-2"></i></button> -->
                        </div>
                    </div>
                </div>
                <div class="d-flex flex-row gap-5">
                    <div class="card w-100" style="border: none; max-width: 350px ">
                        <div class="card-body bg-danger" style="border-radius: 20px;">
                            <!-- Title -->
                            <h4 class="card-title"><i class="fa-solid fa-users me-3"></i><?php echo $clientCount ?> <br> <p class="mt-2">Users</p></h4>
                            <hr>
                            <!-- Text -->
                            <p class="card-text">Number of registered users.</p>
                            <!-- <button class="btn btn-rounded text-light px-4 btn-md toManageUser" style="background-color: rgba(0, 0, 0, 0.3);">See more<i class="fa-solid fa-arrow-up-right-from-square ms-2"></i></button> -->
                        </div>
                    </div>
                    <div class="card w-100" style="border: none; max-width: 350px ">
                        <div class="card-body bg-warning" style="border-radius: 20px;">
                            <!-- Title -->
                            <h4 class="card-title"><i class="fa-solid fa-school me-3"></i><?php echo $elemSchoolCount ?> <br> <p class="mt-2">Elementary School</p></h4>
                            <hr>
                            <!-- Text -->
                            <p class="card-text">Number of registered Elementary School.</p>
                            <!-- <button class="btn btn-rounded text-light px-4 btn-md toManageUser" style="background-color: rgba(0, 0, 0, 0.3);">See more<i class="fa-solid fa-arrow-up-right-from-square ms-2"></i></button> -->
                        </div>
                    </div>
                    <div class="card w-100 " style="border: none; max-width: 350px ">
                        <div class="card-body bg-primary" style="border-radius: 20px;">
                            <!-- Title -->
                            <h4 class="card-title"><i class="fa-solid fa-school-flag me-3"></i><?php echo $highSchoolCount ?> <br> <p class="mt-2">High School</p></h4>
                            <hr>
                            <!-- Text -->
                            <p class="card-text">Number of registered High School.</p>
                            <!-- <button class="btn btn-rounded text-light px-4 btn-md toManageUser" style="background-color: rgba(0, 0, 0, 0.3);">See more<i class="fa-solid fa-arrow-up-right-from-square ms-2"></i></button> -->
                        </div>
                    </div>
                </div>
                <!-- <div class="d-flex flex-row gap-5">
                    <div class="card w-100" style=" border: none; max-width: 310px">
                        <div class="card-body" style="border-radius: 20px; background-color: #87194C"> -->
                            <!-- Title -->
                            <!-- <h4 class="card-title"><i class="fa-solid fa-bullhorn me-3"></i><?php echo $adminCount ?> <br> <p class="mt-2">Announcement</p></h4>
                            <hr> -->
                            <!-- Text -->
                            <!-- <p class="card-text">Number of Announcement.</p> -->
                            <!-- <button class="btn btn-rounded text-light px-4 btn-md toManageUser" style="background-color: rgba(0, 0, 0, 0.3);">See more<i class="fa-solid fa-arrow-up-right-from-square ms-2"></i></button> -->
                        <!-- </div>
                    </div>
                    <div class="card w-100" style="border: none; max-width: 310px">
                        <div class="card-body" style="border-radius: 20px; background-color: #35DCCC;"> -->
                            <!-- Title -->
                            <!-- <h4 class="card-title"><i class="fa-solid fa-calendar-plus me-3"></i><?php echo $schoolCount ?> <br> <p class="mt-2">Request</p></h4>
                            <hr> -->
                            <!-- Text -->
                            <!-- <p class="card-text">Number of request that need to approve.</p> -->
                            <!-- <button id="toSchoolList" class="btn btn-rounded text-light px-4 btn-md" style="background-color: rgba(0, 0, 0, 0.3);">See more<i class="fa-solid fa-arrow-up-right-from-square ms-2"></i></button> -->
                        <!-- </div>
                    </div>
                </div> -->
            </div>
        </div>
    </div>



    <!-- MODALS ADD SCHOOL -->
    <div class="modal fade" id="addSchool" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add School Head</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="inputName" placeholder="Name">
                    <label for="floatingInput">Name</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="inputBirthDay" placeholder="Name">
                    <label for="floatingInput">Birthday</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="inputAddress" placeholder="Name">
                    <label for="floatingInput">Address</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="inputEmail" placeholder="Name">
                    <label for="floatingInput">Deped Email</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="inputContact" placeholder="Name">
                    <label for="floatingInput">Contact No.</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="inputSex" placeholder="Name">
                    <label for="floatingInput">Sex</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="inputYearAsSchoolHead" placeholder="Name">
                    <label for="floatingInput">Year as Schoolhead</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="inputDurationYear" placeholder="Name">
                    <label for="floatingInput">Duration year of stay</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="inputLearningPerformance" placeholder="Name">
                    <label for="floatingInput">Learners Performance</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="inputTeacherPerformance" placeholder="Name">
                    <label for="floatingInput">Teacher Performance</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="inputFinancialMng" placeholder="Name">
                    <label for="floatingInput">Financial Management</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="inputComplaints" placeholder="Name">
                    <label for="floatingInput">Complaints</label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id='addSchoolBtn'>Add School Head</button>
            </div>
            </div>
        </div>
    </div>

    <!-- MODAL EDIT  SCHOOL -->
    <div class="modal fade" id="editSchool" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit School</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div id='editSchoolModal' class="modal-body">
                <!-- school update info -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id='saveEditSchoolBtn' data-bs-dismiss="modal">Save changes</button>
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
                <input type="hidden" id='insertSchoolName'>
                <!--  -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id='addEquipmentBtnInput' data-bs-dismiss="modal">Add Equipment</button>
            </div>
            </div>
        </div>
    </div>

    <!-- MODAL MANAGE USER (ADD) -->
    <div class="modal fade" id="addUserManageUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div id='modalBodyAddUserSchool' class="modal-body">
                <!-- add school modal info -->
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" id='addUserDbBtn' class="btn btn-primary" data-bs-dismiss="modal">Add User</button>
            </div>
            </div>
        </div>
    </div>

    <!-- MODAL MANAGE USER (EDIT) -->
    <div class="modal fade" id="EditUserManageUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div id='editModalManageUser' class="modal-body">
                <!-- Modal edit body in another index -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id='updateUserManageUser'>Save changes</button>
            </div>
            </div>
        </div>
    </div>

    <!-- paturo ka kay renz dito -->

    <div class="modal fade" id="EditUserProfile" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
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

    <!-- PROFILE UPLOAD PIC MODAL -->
    <div class="modal fade" id="uploadProfileModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update profile picture</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3" id='uploadProfileModalUpdate'>
                    <!-- <input type="hidden" value='<?php echo $fetchUserInfo['id'] ?>' id='profilePictureId'>
                    <input class="form-control" type="file" id="profileUploadedPicture"> -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id='profileUploadBtnDb' value='<?php echo $userId ?>'>Upload</button>
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
        <div class="modal-footer d-flex align-items-center gap-3">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <form action="" method="post">
                <span class="d-flex align-items-center"><i class="fa-solid fa-right-from-bracket text-danger"></i><input type="submit" class="btn btn-sm" name="logoutBtn" value="Logout"></span>
            </form>
        </div>
        </div>
    </div>
    </div>

    <script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
    <script>
        $(document).ready(function(){

            // dashboard see more
            $('.toManageUser').click(function(){
                $('#dashBoardBody').load("manage_user/manageUser.php");

            });

            $('#toSchoolList').click(function(){
                $('#dashBoardBody').load("table.php");

            });

            // logout
            $('#dropdownBtn').click(function(){
                
                $('.dropdown-menu').toggleClass('d-block');
            })

            // NAV
            $('#navBtn2').click(function(){
                $('#dashBoardBody').load("table.php");

                $('#navBtn1').removeClass('active');
                $('#navBtn2').addClass('active');
                $('#navBtn3').removeClass('active');
                $('#navBtn4').removeClass('active');

                // TOGGLE LVL SCHOOL
                $("#levelBtnDashboard").toggleClass("showLevel");

            })

            $('#chiefHeadBtn').click(function(){
                $('#dashBoardBody').load("chief_head.php");

                $('#navBtn1').removeClass('active');
                $('#navBtn2').removeClass('active');
                $('#navBtn3').removeClass('active');
                $('#navBtn4').addClass('active');
                $('#navBtn5').removeClass('active');

                // // TOGGLE LVL SCHOOL
                // $("#levelBtnDashboard").toggleClass("showLevel");

            })

            $('#unitHeadBtn').click(function(){
                $('#dashBoardBody').load("unit_head.php");

                $('#navBtn1').removeClass('active');
                $('#navBtn2').removeClass('active');
                $('#navBtn3').removeClass('active');
                $('#navBtn4').removeClass('active');
                $('#navBtn5').addClass('active');

                // // TOGGLE LVL SCHOOL
                // $("#levelBtnDashboard").toggleClass("showLevel");

            })



            
            $('#navHighSchoolBtn').click(function(){

                $('#navBtn1').removeClass('active');
                $('#navBtn2').removeClass('active');
                $('#navBtn3').removeClass('active');
                $('#navBtn4').removeClass('active');
                $('#navElemSchoolBtn').removeClass('active');
                $('#navHighSchoolBtn').addClass('active');

            })

            

            // $('#menuBtn').click(function(){
                
            //     $('.nav_wrapper').toggleClass('translate');
            //     $('#dashBoardBody').toggleClass('w-100');
            // })

            // ADD SCHOOL
            $("#addSchoolBtn").click(function(){
                
                const name = $("#inputName").val();
                const bday = $("#inputBirthDay").val();
                const address = $("#inputAddress").val();
                const email = $("#inputEmail").val();
                const contact = $("#inputContact").val();
                const sex = $("#inputSex").val();
                const yearSchoolHead = $("#inputYearAsSchoolHead").val();
                const durationYear = $("#inputDurationYear").val();
                const inputLearningPerformance = $("#inputLearningPerformance").val();
                const inputTeacherPerformance = $("#inputTeacherPerformance").val();
                const inputFinancialMng = $("#inputFinancialMng").val();
                const inputComplaints = $("#inputComplaints").val();
                

                // alert(bday)
                if(name && bday && address && email && contact && sex && yearSchoolHead && durationYear && inputLearningPerformance && inputTeacherPerformance && inputFinancialMng && inputComplaints){
                    $.ajax({
                        url : "addProfileNew.php",
                        method : "post",
                        data : {
                            name : name,
                            bday : bday,
                            address : address,
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
                            $('#dashBoardBody').load("table.php");
                            // $('#dashBoardBody').html(e);
    
                            $("#inputName").val("");
                            $("#inputBirthDay").val("");
                            $("#inputAddress").val("");
                            $("#inputEmail").val("");
                            $("#inputContact").val("");
                            $("#inputSex").val("");
                            $("#inputYearAsSchoolHead").val("");
                            $("#inputDurationYear").val("");
                            $("#inputLearningPerformance").val("");
                            $("#inputTeacherPerformance").val("");
                            $("#inputFinancialMng").val("");
                            $("#inputComplaints").val("");
                        }
                    })
                    // alert("success")
                }else{
                    confirm(`Please fill up all the field!`)

                    $("#inputName").val("");
                    $("#inputBirthDay").val("");
                    $("#inputAddress").val("");
                    $("#inputEmail").val("");
                    $("#inputContact").val("");
                    $("#inputSex").val("");
                    $("#inputYearAsSchoolHead").val("");
                    $("#inputDurationYear").val("");
                    $("#inputLearningPerformance").val("");
                    $("#inputTeacherPerformance").val("");
                    $("#inputFinancialMng").val("");
                    $("#inputComplaints").val("");
                }


            })
            
            // SEARCH IN SCHOOL DATA
            $("#dashBoardBody").on('keyup','#searchBar',function(){
                const searchValue = $(this).val();

                $.ajax({
                    url: "search.php",
                    method: "post",
                    data:{
                        searchValue : searchValue
                    },
                    success(e){
                        $('#idForSearchOutput').html(e);

                    },
                })
            })

            // DELETE SCHOOL
            $("#dashBoardBody").on('click','#deleteBtn',function(){
                const id = $(this).val();
                
                if(confirm(`Are you sure you want to delete this?`)){
                    $.ajax({
                        url:"delete.php",
                        method:'post',
                        data:{
                            id:id
                        },
                        success(e){
                            // $('#dashBoardBody').load("table.php");
                            // $('#dashBoardBody').html(e);
                            $('#dashBoardBody').load("table.php");

                        }
                    })
                }
            })

            // EDIT SCCHOOL POPUP INFO
            $("#dashBoardBody").on("click","#editBtn",function(){
                const id =  $(this).val();

                $.ajax({
                    url: "editSchoolModal.php",
                    method: 'post',
                    data:{
                        id : id
                    },
                    success(e){
                        // $('#dashBoardBody').load("table.php");
                        $('#editSchoolModal').html(e);
                    }
                })
            })

            // EDIT SCHOOL SAVE BUTTON
            $("#saveEditSchoolBtn").click(function(){

                const idEditSchool = $("#idEditSchool").val();
                const schoolName = $("#inputSchoolNameEdit").val();
                const schoolID = $("#inputSchoolIDEdit").val();
                const contactPerson = $("#inputContactPersonEdit").val();
                const contactNo = $("#inputContactNoEdit").val();
                const email = $("#inputEmailEdit").val();
                const division = $("#inputDivisionEdit").val();
                const schoolType = $("#inputSchoolTypeEdit").val();
                const district = $("#inputDistrictEdit").val();
                const schoolLevel = $("#inputSchoolLevelEdit").val();

                if(schoolName && schoolID && contactPerson && contactNo && email && division && schoolType && district && schoolLevel){
                    $.ajax({
                    url:"updateSchool.php",
                    method:"post",
                    data:{
                        id : idEditSchool,
                        schoolName : schoolName,
                        schoolID : schoolID,
                        contactPerson : contactPerson,
                        contactNo : contactNo,
                        email : email,
                        division : division,
                        schoolType : schoolType,
                        district : district,
                        schoolLevel : schoolLevel
                    },
                    success(){
                        $('#dashBoardBody').load("table.php");
        
                    }
                    })
                }else{
                    confirm('Please fill up all fields!')
                }
 
            })

            // VIEW EQUIPMENT
            $("#dashBoardBody").on("click","#viewBtn",function(){

                const id = $(this).val();

                // alert(id)

                $.ajax({
                    url:"profile.php",
                    method:"post",
                    data:{
                        id : id
                    },
                    success(e){
                        $("#dashBoardBody").html(e)
                    }
                })
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

                if(code && article && description && date && unitValue && totalValue && sourceOfFunds && status){
                    $.ajax({
                        url:"schools_equipment/add_equipment.php",
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

                                    $("#inputCode").val("")
                                    $("#inputArticle").val("")
                                    $("#inputDescription").val("")
                                    $("#inputDate").val("")
                                    $("#inputUnitValue").val("")
                                    $("#inputTotalValue").val("")
                                    $("#inputSourceOfFunds").val("")
                                    $("#inputStatus").val("")
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
                        url:"schools_equipment/update_equipment.php",
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
                                        $("#inputStatusEdit").val("")
                                    }
                            })
                        }
                    })
                }else{
                    confirm('Fill up all fields! If not available type N/A.')
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

            // MANAGE USER BUTTON
            $("#manageUserBtn").click(function(){

                $('#navBtn1').removeClass('active');
                $('#navBtn2').removeClass('active');
                $('#navBtn3').addClass('active');
                $('#navBtn4').removeClass('active');
                $('#navBtn5').removeClass('active');

                $("#dashBoardBody").load("manage_user/manageUser.php")
            })

            // MANAGE USER (ADD USER BUTTON FOR MODAL)
            $("#dashBoardBody").on("click","#addUsersSchoolsModal",function(){
                $("#modalBodyAddUserSchool").load("manage_user/addUserSchoolList.php")
            })

            // MANAGE USER (ADD USER BTN ON DB)
            $("#addUserDbBtn").click(function(){
                const email = $("#inputEmailUser").val();
                const pass = $("#inputPassword").val();
                const role = $("#inputRole").val();
                const school = '';

                if(email && pass){
                    $.ajax({
                        url:"manage_user/addUser.php",
                        method:"post",
                        data:{
                            email:email,
                            pass:pass,
                            role:role,
                            school:school
                        },
                        success(){
                            $("#manageUserTbody").load("manage_user/manageUserTbody.php")
                        }
                    })
                }else{
                    confirm("Please fill up all field!")
                    
                    $("#inputEmailUser").val("");
                    $("#inputPassword").val("");
                }
            })

            // MANAGE USER (DELETE USER BTN ON DB)
            $("#dashBoardBody").on("click","#deleteUserManageUser",function(){
                const id = $(this).val();

                if(confirm("Are you sure to delete this item?")){
                    $.ajax({
                        url:"manage_user/deleteUser.php",
                        method:'post',
                        data:{
                            id:id
                        },
                        success(){
                            $("#manageUserTbody").load("manage_user/manageUserTbody.php")
                        }
                    })
                }
            })

            // MANAGE USER (EDIT USER BTN FOR MODAL)
            $("#dashBoardBody").on("click","#editUserManageUser",function(){
                const id = $(this).val();

                $.ajax({
                    url:"manage_user/editUserModal.php",
                    method:"post",
                    data:{
                        id:id
                    },
                    success(e){
                        $("#editModalManageUser").html(e)
                    }
                })
            })

            // MANAGE USER (UPDATE BTN ON DB)
            $("#updateUserManageUser").click(function(){

                const id = $("#updateUserIdManageUser").val();
                const email = $("#inputEmailUserEdit").val();
                const pass = $("#inputPasswordEdit").val();
                const role = $("#inputRoleEdit").val();
                const school = $("#inputSchoolEdit").val();

                $.ajax({
                    url: "manage_user/updateUser.php",
                    method:"post",
                    data:{
                        id : id,
                        email : email,
                        pass : pass,
                        role : role,
                        school : school
                    },
                    success(){
                        $("#manageUserTbody").load("manage_user/manageUserTbody.php")
                        // $("#manageUserTbody").html(e)
                    }
                })
            })

            // MANAGE USER (SEARCH ON DB)
            $("#dashBoardBody").on("keyup","#searchUserDb",function(){
                const searchValue = $(this).val()

                $.ajax({
                    url: "manage_user/userSearch.php",
                    method:"post",
                    data:{
                        searchValue : searchValue
                    },
                    success(e){
                        $("#manageUserTbody").html(e)
                    }
                })
            })

            // SELECT DISTRICT
            $("#dashBoardBody").on("change","#selectDisctrictFilter",function(){
                const district = $(this).val();
                $.ajax({
                    url:"district.php",
                    method:"post",
                    data:{
                        district : district
                    },
                    success(e){
                        $("#idForSearchOutput").html(e)
                    }
                })
            })

            // CONTACT
            $("#contactBtnNav").click(function(){
                $('#navBtn1').removeClass('active');
                $('#navBtn2').removeClass('active');
                $('#navBtn3').removeClass('active');
                $('#navBtn4').addClass('active');
            })

            // PROFILE BUTTON
            $("#profileBtn").click(function(){
                $('.dropdown-menu').toggleClass('d-block');
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

            // SELECTED ROLE
            $("#dashBoardBody").on("change","#selectedRole",function(){
                const role = $(this).val();

                $.ajax({
                    url:"selectedRole.php",
                    method:"post",
                    data:{
                        role:role
                    },
                    success(e){
                        $("#manageUserTbody").html(e)
                    }
                })
            })

            // PROFILE UPLOAD IMG DB
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

            // DOR FILE BUTTON MODAL
            $("#dashBoardBody").on("click","#dorButtonModal",function(){
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

            // EXPORT TABLE
            $("#dashBoardBody").on("click","#excelBtn",function(){
                if (confirm("Export this table?")) {
                    exportToExcel();
                }
            })

            // HIGH SCHOOL BUTTON
            $("#navHighSchoolBtn").click(function(){
                const level =  $(this).val();

                $.ajax({
                    url: "schoolLevelTable.php",
                    method: "post",
                    data:{
                        level : level
                    },
                    success(e){
                        $("#dashBoardBody").html(e)
                    }
                })
            })

            // ELEM SCHOOL BUTTON
            $("#navElemSchoolBtn").click(function(){
                const level =  $(this).val();

                $.ajax({
                    url: "schoolLevelTable.php",
                    method: "post",
                    data:{
                        level : level
                    },
                    success(e){
                        $("#dashBoardBody").html(e)
                    }
                })
            })

            // SEARCH SCHOOL WITH LEVEL FILTER
            $("#dashBoardBody").on('keyup',"#searchBarLevel",function(){
                const searchVal = $(this).val();
                const level = $("#inputLevelValue").val();

                $.ajax({
                    url:"search.php",
                    method:"post",
                    data:{
                        searchValue : searchVal,
                        level : level
                    },
                    success(e){
                        $('#idForSearchOutput').html(e);
                    }
                })
            })

            $("#dashBoardBody").on("change","#selectDisctrictFilterLevel",function(){
                const district = $(this).val();
                const level = $("#inputLevelValue").val();
                
                $.ajax({
                    url:"district.php",
                    method:"post",
                    data:{
                        district : district,
                        level : level
                    },
                    success(e){
                        $("#idForSearchOutput").html(e)
                    }
                })
            })

            $("#requestBtn").click(function(){

                $('#navBtn1').removeClass('active');
                $('#navBtn2').removeClass('active');
                $('#navBtn3').removeClass('active');
                $('#navBtn4').addClass('active');

                $("#dashBoardBody").load("requestTable.php")
            })

            $("#dashBoardBody").on('click',"#approveBtn",function(){
                const id = $(this).val()

                $.ajax({
                    url:"approveEquipment.php",
                    method:"post",
                    data:{
                        id : id
                    },
                    success(e){

                        $("#dashBoardBody").load("requestTable.php")
                        // $("#dashBoardBody").html(e)

                        $("#requestCountNav").html(e)

                    }
                })
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
            XLSX.writeFile(wb, "ExportedTable.xlsx");
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>            <?php include 'footer.php' ?>
    <?php include 'footer.php' ?>


</body>
</html>