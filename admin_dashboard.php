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
    $countSchool = "SELECT * FROM `profile`";
    $listSchool = $con->query($countSchool);
    $schoolCount = $listSchool->num_rows;
    // Elementary School
    $countElemSchool = "SELECT * FROM `profile` WHERE school='Elementary School'";
    $listElemSchool = $con->query($countElemSchool);
    $elemSchoolCount = $listElemSchool->num_rows;
    // High School
    $countHighSchool = "SELECT * FROM `profile` WHERE school='High School'";
    $listHighSchool = $con->query($countHighSchool);
    $highSchoolCount = $listHighSchool->num_rows;


    // GET NUMBER OF REQUEST
    $getRequest = "SELECT * FROM `equipment` WHERE permission='Deny'";
    $listRequest = $con->query($getRequest);
    $requestCount = $listRequest->num_rows;

    // count head profile
    $y = "SELECT * FROM `profile`";
    $x = $con->query($y);
    $fetchProfileInfoNew = $x->fetch_assoc();
    $p = $x->num_rows;

    // count male
    $qMale = "SELECT * FROM profile WHERE sex='male'";
    $lMale = $con->query($qMale);
    $nMale = $lMale->num_rows;

    // count female
    $qFemale = "SELECT * FROM profile WHERE sex='female'";
    $lFemale = $con->query($qFemale);
    $nFemale = $lFemale->num_rows;

    // count master degree
    $qMaster = "SELECT DISTINCT email,lvl FROM educationaldegree WHERE lvl='Masters degree'";
    $lMaster = $con->query($qMaster);
    $nMaster = $lMaster->num_rows;

    // count post degree
    $qPost = "SELECT DISTINCT email,lvl FROM educationaldegree WHERE lvl='Post degree'";
    $lPost = $con->query($qPost);
    $nPost = $lPost->num_rows;

    // count international award
    $qInternationalAward = "SELECT DISTINCT email,lvl FROM award WHERE lvl LIKE '%international%'";
    $lInternationalAward = $con->query($qInternationalAward);
    $nInternationalAward = $lInternationalAward->num_rows;

    
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
    <link rel="shortcut icon" href="https://sdovalenzuelacity.deped.gov.ph/wp-content/uploads/2021/04/New-DO-Logo.png" type="image/x-icon">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body > header > div > ul > li:nth-child(2):hover{
            background-color: #E9ECEF;
        }
        *{
            font-family: 'Montserrat', helvetica,  sans-serif;
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
        <!-- <span id='profileIconHeader'> -->
        <span>
                <i class="fa-solid fa-user fs-4 mt-1"></i>
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

    <!-- get user email -->
    <!-- <input type="hidden" value="<?php echo $userEmail ?>" id='userEmailProfile'> -->
    <!--  -->

    <div class='container-fluid m-0 p-0 flex-grow-1 d-flex'>
    <!-- <span class="position-absolute" style="left: 300px; top: 30px;"><i id="menuBtn" class="fa-solid fa-bars text-dark fs-3"></i></span> -->
        <div class='nav_wrapper'>
            <nav>
                <div class="d-flex flex-column flex-shrink-0 p-3 bg-dark text-light" style="min-width: 280px; max-width: 290px; height:100vh; position-relative">
                    <a href="admin_dashboard.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
                    <img class="bi me-2" width="50" height="50" src="https://sdovalenzuelacity.deped.gov.ph/wp-content/uploads/2021/04/New-DO-Logo.png" alt="logo">
                    <span class="fs-6 text-light">DepEd Valenzuela | Personnel Profiling System</span>
                    </a>
                    <!-- lagyan mo id at tawagin mo addevent para lumabas or hindi ang navbar -->
                    <hr>
                    <ul class="nav nav-pills flex-column mb-auto">
                        <li>
                            <a id="navBtn1" class="nav-link link-light active" href="javascript:window.location.reload(true)">
                                <span class="bi me-2" width="16" height="16"><i class="fa-solid fa-chart-simple"></i></span>
                                Performance Analytics
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
                            <!-- <ul id='levelBtnDashboard' style='display:none; padding-left: 13px;'>
                                <li><button class='ms-n4 bg-dark text-light' value='High School' style="border:none;" id='navHighSchoolBtn'><i class="fa-solid fa-minus text-secondary me-2"></i>High School</button></li>
                                <li><button class='bg-dark text-light' value='Elementary School' style="border:none;" id='navElemSchoolBtn'><i class="fa-solid fa-minus text-secondary me-2"></i>Elementary School</button></li>
                            </ul> -->
                        </li>
                        <li id='manageUserBtn'>
                            <a id='navBtn3' href="#" class="nav-link link-light">
                                <span class="bi me-2" width="16" height="16"><i class="fa-solid fa-users"></i></span>
                                Manage Users
                            </a>
                        </li>
                        <li id='announcementBtn'>
                            <a id='navBtn4' href="#" class="nav-link link-light">
                                <span class="bi me-2" width="16" height="16"><i class="fa-solid fa-bullhorn"></i></span>
                                Announcement
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
            </nav>
        </div>
    
        <div id='dashBoardBody' class="mx-auto w-75" style=" margin-top: 60px;">
            <!-- Ilagay dito ang dashboard -->

            <!-- <div class=" text-secondary fw-bold p-2 ps-0 mb-3 w-25 h3">Dashboard</div> -->

            <div class=" text-secondary fw-bold p-2 ps-0 w-50 h3">Performance Analytics</div>
            
            <div class="d-flex flex-column py-3 px-5 text-light mt-3" style=" background-color: white; height: 73vh; overflow-y: scroll;">
                <div class="d-flex gap-5 my-5">
                    <div class="d-flex flex-column w-100">
                        <div class="text-center text-secondary fw-bold ps-0 mt-3 mb-5 w-100 h5">Number of School Principal / Admin & Users</div>
                        <canvas id="pieChart" style="width:100%; width: 420px; max-width:450px"></canvas>
                        <div class="d-flex justify-content-around mt-4">
                            <button class='btn btn-primary btn-sm' id="loadSchoolHead" style="background-color: #00aba9; border:none;" id='viewManagerialButtonDashboard'>School Head</button>
                            <button class='btn btn-primary btn-sm' id="loadAdminProfile" value='<?php echo $fetchUserInfo['id'] ?>' style="background-color: #b91d47; border:none;" id='viewSupervisoryButtonDashboard'>System Admin</button>
                            <button class='btn btn-primary btn-sm' id="loadUser" style="background-color: #2b5797; border:none;" id='viewTechnicalButtonDashBoard'>Users</button>
                        </div>
                    </div>
                    <div class="d-flex flex-column w-100">

                        <div class="text-center text-secondary fw-bold ps-0 mt-3 mb-5 w-100 h5">Number of School Principal with Masters Degree / Doctoral Degree</div>

                        <canvas id="degreeChart" style="width:100%; width: 420px; max-width:450px"></canvas>
                        <div class="d-flex justify-content-around">
                            <button class='btn btn-primary btn-sm' style="background-color: #2b5797; border:none;" id='viewAllMasterDegreeBtn' value='Masters Degree'>Master's Degree</button>
                            <button class='btn btn-primary btn-sm' style="background-color: #1e7145; border:none;" id='viewAllPostDegreeBtn' value='Post Degree'>Post Degree</button>
                        </div>
                    </div>
                </div>
                <div class="d-flex gap-5 mt-5">
                    <div class="d-flex flex-column w-100">
                        <div class="text-center text-secondary fw-bold ps-0 mt-3 mb-5 w-100 h5">Number of School Principal with Training</div>
                        <canvas id="trainingChart" style="width:100%; width: 420px; max-width:450px"></canvas>
                        <div class="d-flex justify-content-around mt-4">
                            <button class='btn btn-primary btn-sm' style="background-color: #e8c3b9; border:none;" value='Managerial' id='viewManagerialButtonDashboard'>Managerial</button>
                            <button class='btn btn-primary btn-sm' style="background-color: #1e7145; border:none;" value='Supervisory' id='viewSupervisoryButtonDashboard'>Supervisory</button>
                            <button class='btn btn-primary btn-sm' style="background-color: #2b5797; border:none;" value='Technical' id='viewTechnicalButtonDashBoard'>Technical</button>
                        </div>
                    </div>
                    <div class="d-flex flex-column w-100">
                        <div class="text-center text-secondary fw-bold ps-0 mt-3 mb-5 w-100 h5">Number of School Principal with Rewards and Recognitions</div>
                        <canvas id="RaRChart" style="width:100%; width: 420px; max-width:450px"></canvas>
                        <div class="d-flex justify-content-around mt-4">

                            <button class='btn btn-primary btn-sm' style="background-color: #00aba9; border:none" id='viewAllInternationalBtn' value='International'>International</button>
                            <button class='btn btn-primary btn-sm' style="background-color: #2b5797; border:none" id='viewAllNationalBtn' value='National'>National</button>
                            <button class='btn btn-primary btn-sm' style="background-color: #e8c3b9; border:none" id='viewAllRegionalBtn' value='Region'>Regional</button>
                            <button class='btn btn-primary btn-sm' style="background-color: #1e7145; border:none" id='viewAllDivisionBtn' value='Division'>Division</button>
                            <button class='btn btn-primary btn-sm' style="background-color: #87194c; border:none" id='viewAllSchoolBtn' value='School'>School</button>
                        </div>
                    </div>
                </div>
                
                <div class="text-center text-secondary fw-bold ps-0 w-100 h5 mb-3" style="margin-top: 150px">Number of School Principal with Civil Service Eligibility Ratings</div>
                <!-- <div style="margin-top: -30px;">
                    <button class='btn btn-primary' id='subProfessionalDashBoardButton'>SUB-PROFESSIONAL</button>
                    <button class='btn btn-primary' id='professionalDashBoardBtn'>PROFESSIONAL</button>
                    <button class='btn btn-primary' id='barDashBoardBtn'>RA - 1080 BAR</button>
                </div> -->
                <!-- CHARTTTT -->
                <div  id='chartWrapper'>
                    <!-- CHART NI RENZ -->
                    <div>
                        <canvas id="myChart" style="width:100%; width: 500px; max-width:80%; margin-inline: auto;"></canvas>
                        <div class="d-flex justify-content-center gap-5 mt-4">
                            <button class='btn btn-primary btn-sm' style="background-color: red; border:none" value='CSC - Sub Professional' id='viewAllSubProfessionalButton'>Sub professional</button>
                            <button class='btn btn-primary btn-sm' style="background-color: blue; border:none" value='CSC - Professional' id='viewAllProfessionalButton'>Professional</button>
                            <button class='btn btn-primary btn-sm' style="background-color: green; border:none" value='RA - 1080 Bar/Board Eligibility' id='viewAllBarButton'>RA - 1080 Bar/Board Eligibility</button>
                        </div>
                    </div>
                        <!-- GET NUMBER OF THAT USERS -->
                            <?php

                                //CSC - Sub Professional

                                // 80
                                $qGetUsersNumber80 = "SELECT * FROM civil WHERE rating >= 80 AND rating <= 80.99 AND careerService='CSC - Sub Professional'";
                                $lUserNumber80 = $con->query($qGetUsersNumber80);
                                $fUserNumber80 = $lUserNumber80->num_rows;
                                // 81
                                $qGetUsersNumber81 = "SELECT * FROM civil WHERE rating >= 81 AND rating <= 81.99 AND careerService='CSC - Sub Professional'";
                                $lUserNumber81 = $con->query($qGetUsersNumber81);
                                $fUserNumber81 = $lUserNumber81->num_rows;
                                // 82
                                $qGetUsersNumber82 = "SELECT * FROM civil WHERE rating >= 82 AND rating <= 82.99 AND careerService='CSC - Sub Professional'";
                                $lUserNumber82 = $con->query($qGetUsersNumber82);
                                $fUserNumber82 = $lUserNumber82->num_rows;
                                // 83
                                $qGetUsersNumber83 = "SELECT * FROM civil WHERE rating >= 83 AND rating <= 83.99 AND careerService='CSC - Sub Professional'";
                                $lUserNumber83 = $con->query($qGetUsersNumber83);
                                $fUserNumber83 = $lUserNumber83->num_rows;
                                // 84
                                $qGetUsersNumber84 = "SELECT * FROM civil WHERE rating >= 84 AND rating <= 84.99 AND careerService='CSC - Sub Professional'";
                                $lUserNumber84 = $con->query($qGetUsersNumber84);
                                $fUserNumber84 = $lUserNumber84->num_rows;
                                // 85
                                $qGetUsersNumber85 = "SELECT * FROM civil WHERE rating >= 85 AND rating <= 85.99 AND careerService='CSC - Sub Professional'";
                                $lUserNumber85 = $con->query($qGetUsersNumber85);
                                $fUserNumber85 = $lUserNumber85->num_rows;
                                // 86
                                $qGetUsersNumber86 = "SELECT * FROM civil WHERE rating >= 86 AND rating <= 86.99 AND careerService='CSC - Sub Professional'";
                                $lUserNumber86 = $con->query($qGetUsersNumber86);
                                $fUserNumber86 = $lUserNumber86->num_rows;
                                // 87
                                $qGetUsersNumber87 = "SELECT * FROM civil WHERE rating >= 87 AND rating <= 87.99 AND careerService='CSC - Sub Professional'";
                                $lUserNumber87 = $con->query($qGetUsersNumber87);
                                $fUserNumber87 = $lUserNumber87->num_rows;
                                // 88
                                $qGetUsersNumber88 = "SELECT * FROM civil WHERE rating >= 88 AND rating <= 88.99 AND careerService='CSC - Sub Professional'";
                                $lUserNumber88 = $con->query($qGetUsersNumber88);
                                $fUserNumber88 = $lUserNumber88->num_rows;
                                // 89
                                $qGetUsersNumber89 = "SELECT * FROM civil WHERE rating >= 89 AND rating <= 89.99 AND careerService='CSC - Sub Professional'";
                                $lUserNumber89 = $con->query($qGetUsersNumber89);
                                $fUserNumber89 = $lUserNumber89->num_rows;
                                // 90
                                $qGetUsersNumber90 = "SELECT * FROM civil WHERE rating >= 90 AND rating <= 90.99 AND careerService='CSC - Sub Professional'";
                                $lUserNumber90 = $con->query($qGetUsersNumber90);
                                $fUserNumber90 = $lUserNumber90->num_rows;
                                // 91
                                $qGetUsersNumber91 = "SELECT * FROM civil WHERE rating >= 91 AND rating <= 91.99 AND careerService='CSC - Sub Professional'";
                                $lUserNumber91 = $con->query($qGetUsersNumber91);
                                $fUserNumber91 = $lUserNumber91->num_rows;
                                // 92
                                $qGetUsersNumber92 = "SELECT * FROM civil WHERE rating >= 92 AND rating <= 92.99 AND careerService='CSC - Sub Professional'";
                                $lUserNumber92 = $con->query($qGetUsersNumber92);
                                $fUserNumber92 = $lUserNumber92->num_rows;
                                // 93
                                $qGetUsersNumber93 = "SELECT * FROM civil WHERE rating >= 93 AND rating <= 93.99 AND careerService='CSC - Sub Professional'";
                                $lUserNumber93 = $con->query($qGetUsersNumber93);
                                $fUserNumber93 = $lUserNumber93->num_rows;
                                // 94
                                $qGetUsersNumber94 = "SELECT * FROM civil WHERE rating >= 94 AND rating <= 94.99 AND careerService='CSC - Sub Professional'";
                                $lUserNumber94 = $con->query($qGetUsersNumber94);
                                $fUserNumber94 = $lUserNumber94->num_rows;
                                // 95
                                $qGetUsersNumber95 = "SELECT * FROM civil WHERE rating >= 95 AND rating <= 95.99 AND careerService='CSC - Sub Professional'";
                                $lUserNumber95 = $con->query($qGetUsersNumber95);
                                $fUserNumber95 = $lUserNumber95->num_rows;
                                // 96
                                $qGetUsersNumber96 = "SELECT * FROM civil WHERE rating >= 96 AND rating <= 96.99 AND careerService='CSC - Sub Professional'";
                                $lUserNumber96 = $con->query($qGetUsersNumber96);
                                $fUserNumber96 = $lUserNumber96->num_rows;
                                // 97
                                $qGetUsersNumber97 = "SELECT * FROM civil WHERE rating >= 97 AND rating <= 97.99 AND careerService='CSC - Sub Professional'";
                                $lUserNumber97 = $con->query($qGetUsersNumber97);
                                $fUserNumber97 = $lUserNumber97->num_rows;
                                // 98
                                $qGetUsersNumber98 = "SELECT * FROM civil WHERE rating >= 98 AND rating <= 98.99 AND careerService='CSC - Sub Professional'";
                                $lUserNumber98 = $con->query($qGetUsersNumber98);
                                $fUserNumber98 = $lUserNumber98->num_rows;
                                // 99
                                $qGetUsersNumber99 = "SELECT * FROM civil WHERE rating >= 99 AND rating <= 99.99 AND careerService='CSC - Sub Professional'";
                                $lUserNumber99 = $con->query($qGetUsersNumber99);
                                $fUserNumber99 = $lUserNumber99->num_rows;
                                // 100
                                $qGetUsersNumber100 = "SELECT * FROM civil WHERE rating >= 100 AND careerService='CSC - Sub Professional'";
                                $lUserNumber100 = $con->query($qGetUsersNumber100);
                                $fUserNumber100 = $lUserNumber100->num_rows;


                                //CSC - Professional

                                // 80
                                $qGetUsersNumber80_pro = "SELECT * FROM civil WHERE rating >= 80 AND rating <= 80.99 AND careerService='CSC - Professional'";
                                $lUserNumber80_pro = $con->query($qGetUsersNumber80_pro);
                                $fUserNumber80_pro = $lUserNumber80_pro->num_rows;
                                // 81
                                $qGetUsersNumber81_pro = "SELECT * FROM civil WHERE rating >= 81 AND rating <= 81.99 AND careerService='CSC - Professional'";
                                $lUserNumber81_pro = $con->query($qGetUsersNumber81_pro);
                                $fUserNumber81_pro = $lUserNumber81_pro->num_rows;
                                // 82
                                $qGetUsersNumber82_pro = "SELECT * FROM civil WHERE rating >= 82 AND rating <= 82.99 AND careerService='CSC - Professional'";
                                $lUserNumber82_pro = $con->query($qGetUsersNumber82_pro);
                                $fUserNumber82_pro = $lUserNumber82_pro->num_rows;
                                // 83
                                $qGetUsersNumber83_pro = "SELECT * FROM civil WHERE rating >= 83 AND rating <= 83.99 AND careerService='CSC - Professional'";
                                $lUserNumber83_pro = $con->query($qGetUsersNumber83_pro);
                                $fUserNumber83_pro = $lUserNumber83_pro->num_rows;
                                // 84
                                $qGetUsersNumber84_pro = "SELECT * FROM civil WHERE rating >= 84 AND rating <= 84.99 AND careerService='CSC - Professional'";
                                $lUserNumber84_pro = $con->query($qGetUsersNumber84_pro);
                                $fUserNumber84_pro = $lUserNumber84_pro->num_rows;
                                // 85
                                $qGetUsersNumber85_pro = "SELECT * FROM civil WHERE rating >= 85 AND rating <= 85.99 AND careerService='CSC - Professional'";
                                $lUserNumber85_pro = $con->query($qGetUsersNumber85_pro);
                                $fUserNumber85_pro = $lUserNumber85_pro->num_rows;
                                // 86
                                $qGetUsersNumber86_pro = "SELECT * FROM civil WHERE rating >= 86 AND rating <= 86.99 AND careerService='CSC - Professional'";
                                $lUserNumber86_pro = $con->query($qGetUsersNumber86_pro);
                                $fUserNumber86_pro = $lUserNumber86->num_rows;
                                // 87
                                $qGetUsersNumber87_pro = "SELECT * FROM civil WHERE rating >= 87 AND rating <= 87.99 AND careerService='CSC - Professional'";
                                $lUserNumber87_pro = $con->query($qGetUsersNumber87_pro);
                                $fUserNumber87_pro = $lUserNumber87_pro->num_rows;
                                // 88
                                $qGetUsersNumber88_pro = "SELECT * FROM civil WHERE rating >= 88 AND rating <= 88.99 AND careerService='CSC - Professional'";
                                $lUserNumber88_pro = $con->query($qGetUsersNumber88_pro);
                                $fUserNumber88_pro = $lUserNumber88_pro->num_rows;
                                // 89
                                $qGetUsersNumber89_pro = "SELECT * FROM civil WHERE rating >= 89 AND rating <= 89.99 AND careerService='CSC - Professional'";
                                $lUserNumber89_pro = $con->query($qGetUsersNumber89_pro);
                                $fUserNumber89_pro = $lUserNumber89_pro->num_rows;
                                // 90
                                $qGetUsersNumber90_pro = "SELECT * FROM civil WHERE rating >= 90 AND rating <= 90.99 AND careerService='CSC - Professional'";
                                $lUserNumber90_pro = $con->query($qGetUsersNumber90_pro);
                                $fUserNumber90_pro = $lUserNumber90_pro->num_rows;
                                // 91
                                $qGetUsersNumber91_pro = "SELECT * FROM civil WHERE rating >= 91 AND rating <= 91.99 AND careerService='CSC - Professional'";
                                $lUserNumber91_pro = $con->query($qGetUsersNumber91_pro);
                                $fUserNumber91_pro = $lUserNumber91_pro->num_rows;
                                // 92
                                $qGetUsersNumber92_pro = "SELECT * FROM civil WHERE rating >= 92 AND rating <= 92.99 AND careerService='CSC - Professional'";
                                $lUserNumber92_pro = $con->query($qGetUsersNumber92_pro);
                                $fUserNumber92_pro = $lUserNumber92_pro->num_rows;
                                // 93
                                $qGetUsersNumber93_pro = "SELECT * FROM civil WHERE rating >= 93 AND rating <= 93.99 AND careerService='CSC - Professional'";
                                $lUserNumber93_pro = $con->query($qGetUsersNumber93_pro);
                                $fUserNumber93_pro = $lUserNumber93_pro->num_rows;
                                // 94
                                $qGetUsersNumber94_pro = "SELECT * FROM civil WHERE rating >= 94 AND rating <= 94.99 AND careerService='CSC - Professional'";
                                $lUserNumber94_pro = $con->query($qGetUsersNumber94_pro);
                                $fUserNumber94_pro = $lUserNumber94_pro->num_rows;
                                // 95
                                $qGetUsersNumber95_pro = "SELECT * FROM civil WHERE rating >= 95 AND rating <= 95.99 AND careerService='CSC - Professional'";
                                $lUserNumber95_pro = $con->query($qGetUsersNumber95_pro);
                                $fUserNumber95_pro = $lUserNumber95_pro->num_rows;
                                // 96
                                $qGetUsersNumber96_pro = "SELECT * FROM civil WHERE rating >= 96 AND rating <= 96.99 AND careerService='CSC - Professional'";
                                $lUserNumber96_pro = $con->query($qGetUsersNumber96_pro);
                                $fUserNumber96_pro = $lUserNumber96_pro->num_rows;
                                // 97
                                $qGetUsersNumber97_pro = "SELECT * FROM civil WHERE rating >= 97 AND rating <= 97.99 AND careerService='CSC - Professional'";
                                $lUserNumber97_pro = $con->query($qGetUsersNumber97_pro);
                                $fUserNumber97_pro = $lUserNumber97_pro->num_rows;
                                // 98
                                $qGetUsersNumber98_pro = "SELECT * FROM civil WHERE rating >= 98 AND rating <= 98.99 AND careerService='CSC - Professional'";
                                $lUserNumber98_pro = $con->query($qGetUsersNumber98_pro);
                                $fUserNumber98_pro = $lUserNumber98_pro->num_rows;
                                // 99
                                $qGetUsersNumber99_pro = "SELECT * FROM civil WHERE rating >= 99 AND rating <= 99.99 AND careerService='CSC - Professional'";
                                $lUserNumber99_pro = $con->query($qGetUsersNumber99_pro);
                                $fUserNumber99_pro = $lUserNumber99_pro->num_rows;
                                // 100
                                $qGetUsersNumber100_pro = "SELECT * FROM civil WHERE rating >= 100 AND careerService='CSC - Professional'";
                                $lUserNumber100_pro = $con->query($qGetUsersNumber100_pro);
                                $fUserNumber100_pro = $lUserNumber100_pro->num_rows;

                                
                                //RA - 1080 Bar/Board Eligibility

                                $qGetUsersNumber80_RA = "SELECT * FROM civil WHERE rating >= 80 AND rating <= 80.99 AND careerService='RA - 1080 Bar/Board Eligibility'";
                                $lUserNumber80_RA = $con->query($qGetUsersNumber80_RA);
                                $fUserNumber80_RA = $lUserNumber80_RA->num_rows;
                                // 81
                                $qGetUsersNumber81_RA = "SELECT * FROM civil WHERE rating >= 81 AND rating <= 81.99 AND careerService='RA - 1080 Bar/Board Eligibility'";
                                $lUserNumber81_RA = $con->query($qGetUsersNumber81_RA);
                                $fUserNumber81_RA = $lUserNumber81_RA->num_rows;
                                // 82
                                $qGetUsersNumber82_RA = "SELECT * FROM civil WHERE rating >= 82 AND rating <= 82.99 AND careerService='RA - 1080 Bar/Board Eligibility'";
                                $lUserNumber82_RA = $con->query($qGetUsersNumber82_RA);
                                $fUserNumber82_RA = $lUserNumber82_RA->num_rows;
                                // 83
                                $qGetUsersNumber83_RA = "SELECT * FROM civil WHERE rating >= 83 AND rating <= 83.99 AND careerService='RA - 1080 Bar/Board Eligibility'";
                                $lUserNumber83_RA = $con->query($qGetUsersNumber83_RA);
                                $fUserNumber83_RA = $lUserNumber83_RA->num_rows;
                                // 84
                                $qGetUsersNumber84_RA = "SELECT * FROM civil WHERE rating >= 84 AND rating <= 84.99 AND careerService='RA - 1080 Bar/Board Eligibility'";
                                $lUserNumber84_RA = $con->query($qGetUsersNumber84_RA);
                                $fUserNumber84_RA = $lUserNumber84_RA->num_rows;
                                // 85
                                $qGetUsersNumber85_RA = "SELECT * FROM civil WHERE rating >= 85 AND rating <= 85.99 AND careerService='RA - 1080 Bar/Board Eligibility'";
                                $lUserNumber85_RA = $con->query($qGetUsersNumber85_RA);
                                $fUserNumber85_RA = $lUserNumber85_RA->num_rows;
                                // 86
                                $qGetUsersNumber86_RA = "SELECT * FROM civil WHERE rating >= 86 AND rating <= 86.99 AND careerService='RA - 1080 Bar/Board Eligibility'";
                                $lUserNumber86_RA = $con->query($qGetUsersNumber86_RA);
                                $fUserNumber86_RA = $lUserNumber86_RA->num_rows;
                                // 87
                                $qGetUsersNumber87_RA = "SELECT * FROM civil WHERE rating >= 87 AND rating <= 87.99 AND careerService='RA - 1080 Bar/Board Eligibility'";
                                $lUserNumber87_RA = $con->query($qGetUsersNumber87_RA);
                                $fUserNumber87_RA = $lUserNumber87_RA->num_rows;
                                // 88
                                $qGetUsersNumber88_RA = "SELECT * FROM civil WHERE rating >= 88 AND rating <= 88.99 AND careerService='RA - 1080 Bar/Board Eligibility'";
                                $lUserNumber88_RA = $con->query($qGetUsersNumber88_RA);
                                $fUserNumber88_RA = $lUserNumber88_RA->num_rows;
                                // 89
                                $qGetUsersNumber89_RA = "SELECT * FROM civil WHERE rating >= 89 AND rating <= 89.99 AND careerService='RA - 1080 Bar/Board Eligibility'";
                                $lUserNumber89_RA = $con->query($qGetUsersNumber89_RA);
                                $fUserNumber89_RA = $lUserNumber89_RA->num_rows;
                                // 90
                                $qGetUsersNumber90_RA = "SELECT * FROM civil WHERE rating >= 90 AND rating <= 90.99 AND careerService='RA - 1080 Bar/Board Eligibility'";
                                $lUserNumber90_RA = $con->query($qGetUsersNumber90_RA);
                                $fUserNumber90_RA = $lUserNumber90_RA->num_rows;
                                // 91
                                $qGetUsersNumber91_RA = "SELECT * FROM civil WHERE rating >= 91 AND rating <= 91.99 AND careerService='RA - 1080 Bar/Board Eligibility'";
                                $lUserNumber91_RA = $con->query($qGetUsersNumber91_RA);
                                $fUserNumber91_RA = $lUserNumber91_RA->num_rows;
                                // 92
                                $qGetUsersNumber92_RA = "SELECT * FROM civil WHERE rating >= 92 AND rating <= 92.99 AND careerService='RA - 1080 Bar/Board Eligibility'";
                                $lUserNumber92_RA = $con->query($qGetUsersNumber92_RA);
                                $fUserNumber92_RA = $lUserNumber92_RA->num_rows;
                                // 93
                                $qGetUsersNumber93_RA = "SELECT * FROM civil WHERE rating >= 93 AND rating <= 93.99 AND careerService='RA - 1080 Bar/Board Eligibility'";
                                $lUserNumber93_RA = $con->query($qGetUsersNumber93_RA);
                                $fUserNumber93_RA = $lUserNumber93_RA->num_rows;
                                // 94
                                $qGetUsersNumber94_RA = "SELECT * FROM civil WHERE rating >= 94 AND rating <= 94.99 AND careerService='RA - 1080 Bar/Board Eligibility'";
                                $lUserNumber94_RA = $con->query($qGetUsersNumber94_RA);
                                $fUserNumber94_RA = $lUserNumber94_RA->num_rows;
                                // 95
                                $qGetUsersNumber95_RA = "SELECT * FROM civil WHERE rating >= 95 AND rating <= 95.99 AND careerService='RA - 1080 Bar/Board Eligibility'";
                                $lUserNumber95_RA = $con->query($qGetUsersNumber95_RA);
                                $fUserNumber95_RA = $lUserNumber95_RA->num_rows;
                                // 96
                                $qGetUsersNumber96_RA = "SELECT * FROM civil WHERE rating >= 96 AND rating <= 96.99 AND careerService='RA - 1080 Bar/Board Eligibility'";
                                $lUserNumber96_RA = $con->query($qGetUsersNumber96_RA);
                                $fUserNumber96_RA = $lUserNumber96_RA->num_rows;
                                // 97
                                $qGetUsersNumber97_RA = "SELECT * FROM civil WHERE rating >= 97 AND rating <= 97.99 AND careerService='RA - 1080 Bar/Board Eligibility'";
                                $lUserNumber97_RA = $con->query($qGetUsersNumber97_RA);
                                $fUserNumber97_RA = $lUserNumber97_RA->num_rows;
                                // 98
                                $qGetUsersNumber98_RA = "SELECT * FROM civil WHERE rating >= 98 AND rating <= 98.99 AND careerService='RA - 1080 Bar/Board Eligibility'";
                                $lUserNumber98_RA = $con->query($qGetUsersNumber98_RA);
                                $fUserNumber98_RA = $lUserNumber98_RA->num_rows;
                                // 99
                                $qGetUsersNumber99_RA = "SELECT * FROM civil WHERE rating >= 99 AND rating <= 99.99 AND careerService='RA - 1080 Bar/Board Eligibility'";
                                $lUserNumber99_RA = $con->query($qGetUsersNumber99_RA);
                                $fUserNumber99_RA = $lUserNumber99_RA->num_rows;
                                // 100
                                $qGetUsersNumber100_RA = "SELECT * FROM civil WHERE rating >= 100 AND careerService='RA - 1080 Bar/Board Eligibility'";
                                $lUserNumber100_RA = $con->query($qGetUsersNumber100_RA);
                                $fUserNumber100_RA = $lUserNumber100_RA->num_rows;





                                // $qGetUsersNumber85_90 = "SELECT * FROM civil WHERE rating >= 86 AND rating <= 90.99 AND careerService='CSC - Sub Professional'";
                                // $lUserNumber85_90 = $con->query($qGetUsersNumber85_90);
                                // $fUserNumber85_90 = $lUserNumber85_90->num_rows;
                
                                // 90-95
                                // $qGetUsersNumber90_95 = "SELECT * FROM civil WHERE rating >= 91 AND rating <= 95.99 AND careerService='CSC - Sub Professional'";
                                // $lUserNumber90_95 = $con->query($qGetUsersNumber90_95);
                                // $fUserNumber90_95 = $lUserNumber90_95->num_rows;
                                // 95-100
                                // $qGetUsersNumber95_100 = "SELECT * FROM civil WHERE rating >= 96 AND rating <= 100 AND careerService='CSC - Sub Professional'";
                                // $lUserNumber95_100 = $con->query($qGetUsersNumber95_100);
                                // $fUserNumber95_100 = $lUserNumber95_100->num_rows;
                            ?>
                        <!--  -->
                        <!-- <script>
                            var xValues = ["80-85", "86-90", "91-95", "96-100"];
                            var yValues = [<?php echo $fUserNumber ?>,<?php echo $fUserNumber85_90 ?>,<?php echo $fUserNumber90_95 ?>,<?php echo $fUserNumber95_100 ?>];
                            var barColors = ["red", "green","blue","orange","brown"];
                            new Chart("myChart", {
                            type: "bar",
                            data: {
                                labels: xValues,
                                datasets: [{
                                backgroundColor: barColors,
                                data: yValues
                                }]
                            },
                            options: {
                                legend: {display: false},
                                title: {
                                display: true,
                                text: "SUB PROFESSIONAL"
                                },
                                scales: {
                                    yAxes: [{
                                        ticks: {
                                            beginAtZero: true
                                        }
                                    }]
                                }
                            }
                            });
                        </script> -->

                        <script>
                        var ctx = document.getElementById("myChart").getContext("2d");

                        // create the chart data
                        var data = {
                        labels: ["80", "81", "82", "83", "84", "85", "86", "87", "88", "89", "90", "91", "92", "93", "94", "95", "96", "97", "98", "99", "100"],
                        datasets: [
                            {
                            label: "Sub Professional",
                            data: [<?php echo $fUserNumber80 ?>, <?php echo $fUserNumber81 ?>, <?php echo $fUserNumber82 ?>, <?php echo $fUserNumber83 ?>, <?php echo $fUserNumber84 ?>, <?php echo $fUserNumber85 ?>, <?php echo $fUserNumber86 ?>, <?php echo $fUserNumber87 ?>, <?php echo $fUserNumber88 ?>, <?php echo $fUserNumber89 ?>, <?php echo $fUserNumber90 ?>, <?php echo $fUserNumber91 ?>, <?php echo $fUserNumber92 ?>, <?php echo $fUserNumber93 ?>, <?php echo $fUserNumber94 ?>, <?php echo $fUserNumber95 ?>, <?php echo $fUserNumber96 ?>, <?php echo $fUserNumber97 ?>, <?php echo $fUserNumber98 ?>, <?php echo $fUserNumber99 ?>, <?php echo $fUserNumber100 ?>],
                            borderColor: "red",
                            fill: false
                            },
                            {
                            label: "Professional",
                            data: [<?php echo $fUserNumber80_pro ?>, <?php echo $fUserNumber81_pro ?>, <?php echo $fUserNumber82_pro ?>, <?php echo $fUserNumber83_pro ?>, <?php echo $fUserNumber84_pro ?>, <?php echo $fUserNumber85_pro ?>, <?php echo $fUserNumber86_pro ?>, <?php echo $fUserNumber87_pro ?>, <?php echo $fUserNumber88_pro ?>, <?php echo $fUserNumber89_pro ?>, <?php echo $fUserNumber90_pro ?>, <?php echo $fUserNumber91_pro ?>, <?php echo $fUserNumber92_pro ?>, <?php echo $fUserNumber93_pro ?>, <?php echo $fUserNumber94_pro ?>, <?php echo $fUserNumber95_pro ?>, <?php echo $fUserNumber96_pro ?>, <?php echo $fUserNumber97_pro ?>, <?php echo $fUserNumber98_pro ?>, <?php echo $fUserNumber99_pro ?>, <?php echo $fUserNumber100_pro ?>],
                            borderColor: "blue",
                            fill: false
                            },
                            {
                            label: "RA - 1080 Bar/Board Eligibility",
                            data: [<?php echo $fUserNumber80_RA ?>, <?php echo $fUserNumber81_RA ?>, <?php echo $fUserNumber82_RA ?>, <?php echo $fUserNumber83_RA ?>, <?php echo $fUserNumber84_RA ?>, <?php echo $fUserNumber85_RA ?>, <?php echo $fUserNumber86_RA ?>, <?php echo $fUserNumber87_RA ?>, <?php echo $fUserNumber88_RA ?>, <?php echo $fUserNumber89_RA ?>, <?php echo $fUserNumber90_RA ?>, <?php echo $fUserNumber91_RA ?>, <?php echo $fUserNumber92_RA ?>, <?php echo $fUserNumber93_RA ?>, <?php echo $fUserNumber94_RA ?>, <?php echo $fUserNumber95_RA ?>, <?php echo $fUserNumber96_RA ?>, <?php echo $fUserNumber97_RA ?>, <?php echo $fUserNumber98_RA ?>, <?php echo $fUserNumber99_RA ?>, <?php echo $fUserNumber100_RA ?>],
                            borderColor: "green",
                            fill: false
                            }
                        ]
                        };

                        // create the chart options
                        var options = {
                        responsive: true,
                        title: {
                            display: false,
                            text: "Civil"
                        },
                        tooltips: {
                            mode: "index",
                            intersect: false
                        },
                        hover: {
                            mode: "nearest",
                            intersect: true
                        },
                        scales: {
                            xAxes: [
                            {
                                display: true,
                                scaleLabel: {
                                display: true,
                                labelString: "Ratings"
                                }
                            }
                            ],
                            yAxes: [
                            {
                                display: true,
                                ticks: {
                                    beginAtZero: true
                                        },
                                scaleLabel: {
                                display: true,
                                labelString: "Counts"
                                }
                            }
                            ]
                        }
                        };

                        // create the chart
                        var myChart = new Chart(ctx, {
                        type: "line",
                        data: data,
                        options: options
                        });
                    </script>
                </div>
            </div>



            <!-- <div class="d-flex flex-column py-5 px-5 text-light" style="gap: 30px; background-color: white; height: 73vh; overflow-y: scroll;">

                <div class="d-flex flex-row gap-5">
                    <div class="card w-100" style=" border: none; max-width: 310px">
                        <div class="card-body bg-danger" style="border-radius: 20px;">
                            
                            <h4 class="card-title"><i class="fa-solid fa-users-gear me-3"></i><?php echo $adminCount ?> <br> <p class="mt-2">System Admin</p></h4>
                            <hr>
                            
                            <p class="card-text">Number of People who have more control to the system.</p>
                            
                        </div>
                    </div>
                    <div class="card w-100" style="border: none; max-width: 310px">
                        <div class="card-body bg-success" style="border-radius: 20px;">
                            
                            <h4 class="card-title"><i class="fa-solid fa-user-tie me-3"></i><?php echo $p ?> <br> <p class="mt-2">School Head</p></h4>
                            <hr>
                            
                            <p class="card-text">Total Number of School head.</p>

                            <div class="d-flex align-items-center justify-content-around">
                                <div>
                                    <div class='d-inline p-2 text-dark bg-light' style="border-radius: 100vmax;"><?php echo $nMale ?></div>
                                    <div class="mt-2">Male</div>
                                </div>
                                <div>
                                    <div class='d-inline p-2 text-dark bg-light' style="border-radius: 100vmax; margin-left: 13px;"><?php echo $nFemale ?></div>
                                    <div class="mt-2">Female</div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="card w-100" style="border: none; max-width: 310px">
                        <div class="card-body bg-info" style="border-radius: 20px;">
                            
                            <h4 class="card-title"><i class="fa-solid fa-clipboard-user me-3"></i>17 <br> <p class="mt-2">Assistant Principal</p></h4>
                            <hr>
                            
                            <p class="card-text">Total Number of Assistant School principal.</p>

                            <div class="d-flex align-items-center justify-content-around">
                                <div>
                                    <div class='d-inline p-2 text-dark bg-light' style="border-radius: 100vmax;">5</div>
                                    <div class="mt-2">Male</div>
                                </div>
                                <div>
                                    <div class='d-inline p-2 text-dark bg-light' style="border-radius: 100vmax; margin-left: 13px;">12</div>
                                    <div class="mt-2">Female</div>
                                </div>
                            </div>
       
                        </div>
                    </div>
                </div>
                <div class="d-flex flex-row gap-5">
                    <div class="card w-100" style="border: none; max-width: 310px ">
                        <div class="card-body bg-danger" style="border-radius: 20px;">
                            
                            <h4 class="card-title"><i class="fa-solid fa-users me-3"></i><?php echo $clientCount ?> <br> <p class="mt-2">Users</p></h4>
                            <hr>
                            
                            <p class="card-text">Number of registered users.</p>
                            
                        </div>
                    </div>
                    <div class="card w-100" style="border: none; max-width: 310px ">
                        <div class="card-body bg-warning" style="border-radius: 20px;">
                            
                            <h4 class="card-title"><i class="fa fa-ranking-star me-3"></i><?php echo $nMaster ?> <br> <p class="mt-2">With Master's Degree</p></h4>
                            <hr>
                            
                            <p class="card-text">Total no. of school principal with Master degree.</p>
                            
                        </div>
                    </div>
                    <div class="card w-100 " style="border: none; max-width: 310px ">
                        <div class="card-body bg-primary" style="border-radius: 20px;">
                            
                            <h4 class="card-title"><i class="fa-solid fa-ranking-star text-dark me-3"></i><?php echo $nPost ?> <br> <p class="mt-2">With Post Degree</p></h4>
                            <hr>
                            
                            <p class="card-text">Total no. of school principal with doctorate degree.</p>
                            
                        </div>
                    </div>
                </div>
                <div class="d-flex flex-row gap-5">
                    <div class="card w-100" style=" border: none; max-width: 300px">
                        <div class="card-body" style="border-radius: 20px; background-color: #87194C">
                            
                            <h4 class="card-title"><i class="fa fa-ranking-star me-3 text-warning"></i><?php echo $nInternationalAward ?> <br> <p class="mt-2">With International awards</p></h4>
                            <hr>
                            
                            <p class="card-text">Total no. of school principal with International Awards.</p>
                            
                        </div>
                    </div>
                    <div class="card w-100" style="border: none; max-width: 300px;">
                        <div class="card-body" style="border-radius: 20px; background-color: #87194C">
                            
                            <?php
                                $countCivilNumber = "SELECT DISTINCT email FROM civil";
                                $listCivilNumber = $con->query($countCivilNumber);
                                $fetchCivilNumberCount = $listCivilNumber->fetch_assoc();
                                $civilNumberCount = $listCivilNumber->num_rows;

                                
                            ?>
                            <h4 class="card-title"><i class="fa-solid fa-scale-balanced me-3"></i><?php  echo $civilNumberCount ?> <br> <p class="mt-2">With civil service eligibility</p></h4>
                            <hr>
                            
                            <p class="card-text">Total no. of school principal with civil service eligibility.</p>
                            
                        </div>
                    </div>
                </div>
            </div> -->
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
                    <input type="text" class="form-control" id="inputCitizen" placeholder="Name">
                    <label for="floatingInput">Citizenship</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="inputPlaceOfBirth" placeholder="Name">
                    <label for="floatingInput">Place of Birth</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="inputCivilStatus" placeholder="Name">
                    <label for="floatingInput">Civil status</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="inputZipcode" placeholder="Name">
                    <label for="floatingInput">Zip Code</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="inputEmployeeNo" placeholder="Name">
                    <label for="floatingInput">Employee No.</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="inputEmail" placeholder="Name">
                    <label for="floatingInput">Deped Email</label>
                </div>
                <!-- <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="inputSchoolProfileLvl" placeholder="Name">
                    <label for="floatingInput">School</label>
                </div> -->
                <label class='ps-1'>School Level</label>
                <select id="inputSchoolProfileLvl" class="form-select mb-3" aria-label="Default select example">
                    <option value="High School">High School</option>
                    <option value="Elementary School">Elementary School</option>
                </select>
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
                <button type="button" class="btn btn-primary" id='addSchoolBtn'>Add School Head</button>
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
        <div class="modal-dialog modal-xl">
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
                <button type="button" class="btn btn-primary" id='profileUpdateBtnDatabase' data-bs-dismiss="modal">Save changes</button>
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

    <!-- privacy notice -->
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

         <!-- ADD CIVIL -->
         <!-- <div class="modal fade" id="civilAddData" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Civil Service Eligibility</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="civilInputCareer" placeholder="Career Service">
                        <label>Career Service</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="civilInputRating" placeholder="School Name">
                        <label>Rating</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="civilDateExam" placeholder="Date of Examination">
                        <label>Date of Examination</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="civilPlaceExam" placeholder="Place of Examination">
                        <label>Place of Examination</label>
                    </div>

                    <label class='mb-2'>License (if applicable)</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Number</span>
                        <input type="text" id='civilNumber' class="form-control" aria-label="Username" aria-describedby="basic-addon1">
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Date of Validity</span>
                        <input type="date" id='civilDate' class="form-control" aria-label="Username" aria-describedby="basic-addon1">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id='addCivilServiceButtonDb'>Add Civil Service</button>
                </div>
                </div>
            </div>
        </div> -->
    <!-- update education -->
    <div class="modal fade "  id="updateEducationModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content" >
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Educational Background</h5>
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
                <input type="date" class="form-control" id="civilDate" value="" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
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

            <div class="input-group mb-3">
                <span class="input-group-text" id="inputGroup-sizing-default">Department/Agency/Office/Company (Write in full/ Do not abbreviate)</span>
                <input type="text" class="form-control" id="workExpDepartment" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
            </div>

            <div class="input-group mb-3">
                <span class="input-group-text" id="inputGroup-sizing-default">Monthly Salary</span>
                <input type="text" class="form-control" id="workExpSalary" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
            </div>

            <!-- <div class="input-group mb-3">
                <span class="input-group-text" id="inputGroup-sizing-default">Salary/Job/Pay Grade (if applicable)</span>
                <input type="text" class="form-control" id="workExpJob" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
            </div> -->
            <div class="input-group mb-3">
                <label class="input-group-text" for="">Salary/Job/Pay Grade (if applicable)</label>
                <select class="form-select" id="workExpJob">
                    <option value="SG 1">SG 1</option>
                    <option value="SG 2">SG 2</option>
                    <option value="SG 3">SG 3</option>
                    <option value="SG 4">SG 4</option>
                    <option value="SG 5">SG 5</option>
                    <option value="SG 6">SG 6</option>
                    <option value="SG 7">SG 7</option>
                    <option value="SG 8">SG 8</option>
                    <option value="SG 9">SG 9</option>
                    <option value="SG 10">SG 10</option>
                    <option value="SG 11">SG 11</option>
                    <option value="SG 12">SG 12</option>
                    <option value="SG 13">SG 13</option>
                    <option value="SG 14">SG 14</option>
                    <option value="SG 15">SG 15</option>
                    <option value="SG 16">SG 16</option>
                    <option value="SG 17">SG 17</option>
                    <option value="SG 18">SG 18</option>
                    <option value="SG 19">SG 19</option>
                    <option value="SG 20">SG 20</option>
                    <option value="SG 21">SG 21</option>
                    <option value="SG 22">SG 22</option>
                    <option value="SG 23">SG 23</option>
                    <option value="SG 24">SG 24</option>
                    <option value="SG 25">SG 25</option>
                    <option value="SG 26">SG 26</option>
                </select>
            </div>

            <!-- <div class="input-group mb-3">
                <span class="input-group-text" id="inputGroup-sizing-default">Status of Appointment</span>
                <input type="text" class="form-control" id="workExpStatus" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
            </div> -->
            <div class="input-group mb-3">
                <label class="input-group-text" for="">Status of Appointment</label>
                <select class="form-select" id="workExpStatus">
                    <option value="Permanent">Permanent</option>
                    <option value="Contract of Service (CoS)">Contract of Service (CoS)</option>
                    <option value="Local School Board (LSB)">Local School Board (LSB)</option>
                </select>
            </div>

            <!-- <div class="input-group mb-3">
                <span class="input-group-text" id="inputGroup-sizing-default">Gov't Service (Y/N)</span>
                <input type="text" class="form-control" id="workExpService" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
            </div> -->
            <div class="input-group mb-3">
                <label class="input-group-text" for="">Gov't Service (Y/N)</label>
                <select class="form-select" id="workExpService">
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                </select>
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

                    <!-- <div class="input-group mb-3">
                        <span class="input-group-text" id="inputGroup-sizing-default">Type of LD (Managerial/supervisory/technical/etc)</span>
                        <input type="text" class="form-control" id="learningAndDevelopmentLD" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                    </div> -->
                    <div class="input-group mb-3">
                        <label class="input-group-text" for="">Type of LD (Managerial/supervisory/technical/etc)</label>
                        <select class="form-select" id='learningAndDevelopmentLD'>
                            <option value="Managerial">Managerial</option>
                            <option value="Supervisory">Supervisory</option>
                            <option value="Technical">Technical</option>
                        </select>
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text" id="inputGroup-sizing-default">Conducted/Sponsored by (Write in full)</span>
                        <input type="text" class="form-control" id="learningAndDevelopmentConducted" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                    </div>
                
                    <div class="input-group mb-3">
                        <input type="file" class="form-control" id="inputLearningFile">
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
    <!-- <div class="modal fade" id="myModal" tabindex="-1">
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
            </div>
            </div>
        </div>
    </div> -->

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
                <!-- <input type="hidden" id='degreeUserEmail' value='<?php echo $emailNew ?>'> -->
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
                    <input class="form-control" type="file" id="formFile">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">UPLOAD</button>
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
                    <span class="input-group-text" id="basic-addon1">Title of Award/Recognitions</span>
                    <input type="text" id='inputAwardTitle' class="form-control" aria-label="Username" aria-describedby="basic-addon1">
                </div>
    
                <div class="input-group mb-3">
                    <label class="input-group-text" for="">Level of award</label>
                    <select class="form-select" id='inputAwardlvl'>
                        <option value="International">International</option>
                        <option value="National">National</option>
                        <option value="Region">Region</option>
                        <option value="Division">Division</option>
                        <option value="School">School</option>
                    </select>
                </div>

                <div class="input-group my-3">
                    <span class="input-group-text" id="basic-addon1">Certificate issue date</span>
                    <input type="date" id='inputAwardDate' class="form-control" aria-label="Username" aria-describedby="basic-addon1">
                </div>

                <div class="input-group mb-3">
                    <input type="file" class="form-control" id="inputAwardFile">
                    <!-- <label class="input-group-text" for="inputGroupFile02">Upload</label> -->
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

    <!-- Credential modal -->
    <div class="modal fade" id="credentialModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Credentials</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id='credentialModalBody'>
                <!-- Get data in another file -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
            </div>
            </div>
        </div>
    </div>

<!-- ADD ANNOUNCEMENT Modal -->
<div class="modal fade" id="announcementModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Anoouncement</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="input-group mb-3">
            <input type="file" class="form-control" id="inputAnnouncementFile">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary"  data-bs-dismiss="modal" id='addAnnouncementButtonDb'>Add announcement</button>
      </div>
    </div>
  </div>
</div>

<!-- EDIT ANNOUNCEMENT Modal -->
<div class="modal fade" id="editAnnouncementModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update announcement</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id='editAnnouncementModalBody'>
        <!-- update announcement -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id='updateAnnouncementButtonDB'>Save changes</button>
      </div>
    </div>
  </div>
</div>

<!-- VIEW FILE REWARDS and RECOGNITION -->
<div class="modal fade" id="viewFileRewardAndRecognition" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">File</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id='viewFileModal'>
        <!-- view file modal -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>

<!-- Modal VIEW FILE LEARNING -->
<div class="modal fade" id="viewFileLearningModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">View File</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id='viewFileLearningModalBody'>
        <!-- View file -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>

    <script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
    <script>
        $(document).ready(function(){

            $('#loadSchoolHead').click(function(){
                $('#dashBoardBody').load("table.php");
            })

            $("#loadUser").click(function(){

                $("#dashBoardBody").load("manage_user/manageUser.php")
            })


            $("#loadAdminProfile").click(function(){

                const userId = $(this).val()

                $.ajax({
                    url:"profileAdmin.php",
                    method:"post",
                    data:{
                        id : userId
                    },
                    success(e){
                        $("#dashBoardBody").html(e)
                    }
                })
            })

            //load privacy notice
            $(window).on('load', function() {
                $('#myModal').modal('show');
            });

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

            //load announcement
            $('#announcementBtn').click(function(){
                $('#dashBoardBody').load("announcementAdmin.php");

            });

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

            $('#announcementBtn').click(function(){
                // $('#dashBoardBody').load("profile.php");

                $('#navBtn1').removeClass('active');
                $('#navBtn2').removeClass('active');
                $('#navBtn3').removeClass('active');
                $('#navBtn4').addClass('active');
            })

            

            // $('#menuBtn').click(function(){
                
            //     $('.nav_wrapper').toggleClass('translate');
            //     $('#dashBoardBody').toggleClass('w-100');
            // })

            // ADD SCHOOL HEAD
            $("#addSchoolBtn").click(function(){
                
                const name = $("#inputName").val();
                const bday = $("#inputBirthDay").val();
                const address = $("#inputAddress").val();
                const citizen = $("#inputCitizen").val();
                const civilStatus = $("#inputCivilStatus").val();
                const zipcode = $("#inputZipcode").val();
                const employeeNo = $("#inputEmployeeNo").val();
                const placeOfBirth = $("#inputPlaceOfBirth").val();
                const email = $("#inputEmail").val();
                const contact = $("#inputContact").val();
                const sex = $("#inputSex").val();
                const yearSchoolHead = $("#inputYearAsSchoolHead").val();
                const durationYear = $("#inputDurationYear").val();
                const inputLearningPerformance = $("#inputLearningPerformance").val();
                const inputTeacherPerformance = $("#inputTeacherPerformance").val();
                const inputFinancialMng = $("#inputFinancialMng").val();
                const inputComplaints = $("#inputComplaints").val();
                const schoolLvl = $("#inputSchoolProfileLvl").val();
                
                // alert(bday)
                if(name && email){
                    $.ajax({
                        url : "addProfileNew.php",
                        method : "post",
                        data : {
                            name : name,
                            bday : bday,
                            address : address,
                            citizen : citizen,
                            civilStatus : civilStatus,
                            zipcode : zipcode,
                            employeeNo : employeeNo,
                            placeOfBirth : placeOfBirth,
                            email : email,
                            contact : contact,
                            sex : sex,
                            yearSchoolHead : yearSchoolHead,
                            durationYear : durationYear,
                            inputLearningPerformance : inputLearningPerformance,
                            inputTeacherPerformance : inputTeacherPerformance,
                            inputFinancialMng : inputFinancialMng,
                            inputComplaints : inputComplaints,
                            school : schoolLvl
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
                    Swal.fire({
                                        icon: 'success',
                                        title: 'Success',
                                        text: 'Added Successfully'
                                    })
                }else{
                    Swal.fire({
                    icon: 'warning',
                    title: 'Warning',
                    text: 'Please fill up all fields.'})
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
                            Swal.fire({
                                        icon: 'success',
                                        title: 'Success',
                                        text: 'User Successfully Added.'
                                    })
                        }
                    })
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Please fill all fields.'
                             })
                    
                    $("#inputEmailUser").val("");
                    $("#inputPassword").val("");
                }
            })

            // MANAGE USER (DELETE USER BTN ON DB)
            $("#dashBoardBody").on("click","#deleteUserManageUser",function(){
                const id = $(this).val();

                Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        url:"manage_user/deleteUser.php",
                        method:'post',
                        data:{
                            id:id
                        },
                        success(){
                            $("#manageUserTbody").load("manage_user/manageUserTbody.php");

                            Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                            )
                        }
                    })
                    
                }
                })

                // if(confirm("Are you sure to delete this item?")){
                    
                // }
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
                 if(pass){
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
                        Swal.fire({
                                        icon: 'success',
                                        title: 'Success',
                                        text: 'Edited Successfully.'
                                    })
                    }
                    
                })
            }else{
                Swal.fire({
                        icon: 'warning',
                        title: 'Warning',
                        text: 'Please fill all fields.'
                        })
                }
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
                    url:"profileAdmin.php",
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
                const inputLearningPerformance = $("#inputLPerformanceEdit").val();
                const inputTeacherPerformance = $("#inputTPerformanceEdit").val();
                const inputFinancialMng = $("#inputFinanceMngEdit").val();
                const inputComplaints = $("#inputComplaintsEdit").val();
                
                if(name && bday && address && inputEmployeeNoEdit && inputPlaceOfBirthEdit && inputCitizenEdit && inputCivilStatusEdit && inputZipcodeEdit && email && contact && sex && yearSchoolHead && durationYear && inputLearningPerformance && inputTeacherPerformance && inputFinancialMng && inputComplaints){
                   
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
                                Swal.fire({
                                        icon: 'success',
                                        title: 'Success',
                                        text: 'Updated Successfully'
                                    })
                                $("#dashBoardBody").html(e)
                            }
                        })
                    }
                
                })
            }else{( Swal.fire({
                    icon: 'warning',
                    title: 'Warning',
                    text: 'Please fill all fields.'
                }))}


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

                            // $.ajax({
                            //     url:"profileHeaderUpdate.php",
                            //     method:"post",
                            //     data:{
                            //         id:id
                            //     },
                            //     success(e){
                            //         $("#profileIconHeader").html(e)
                            //     }
                            // })

                        }
                    });
                }else{
                    confirm('Please Select file!');
                }

            
                
               
            })

            // ADMIN UPDATE DATA INFO DB
            $("#dashBoardBody").on('click',"#updateAdminProfileDb",function(){
                const id = $(this).val();
                const email = $("#profileInputAdminInfoEmail").val();
                const nPass = $("#profileInputAdminInfoNewPass").val();
                const rPass = $("#profileInputAdminInfoRPass").val();

                if(nPass === rPass && email){
                    $.ajax({
                        url:"profileInfoAdminUpdate.php",
                        method:"post",
                        data:{
                            id:id,
                            email:email,
                            pass:nPass
                        },
                        success(){
                            $.ajax({
                                url:"profileAdmin.php",
                                method:"post",
                                data:{
                                    id : id
                                },
                                success(e){
                                    $("#dashBoardBody").html(e)

                                    confirm("Update profile Success!")
                                }
                            })
                        }
                    })
                }else{
                    $("#profileInputAdminInfoNewPass").val("");
                    $("#profileInputAdminInfoRPass").val("")

                    confirm("Password did not match! Please try again.")
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

            // filter district
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

                // alert(email)
             
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
                        gs : gs,
                        gc : gc,
                        gf : gf,
                        gt : gt,
                        gh : gh,
                        gy : gy,
                        gSc : gSc
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
                                Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: 'Updated Successfully'
                                })
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

                if(career && rating && dateExam && placeExam && Ldate && Lnumber){
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

                                        Swal.fire({
                                        icon: 'success',
                                        title: 'Success',
                                        text: 'Addded Successfully'
                                    })

                                }
                            })
                        }
                    })
                }else{
                    Swal.fire({
                    icon: 'warning',
                    title: 'Warning',
                    text: 'Please Fill All Fields.'
                })
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

                if (degree && school && educ && from && to && high && year && scholar){
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
                                Swal.fire({
                                        icon: 'success',
                                        title: 'Success',
                                        text: 'Added Successfully'
                                    })
                            }
                        })

                    }
                })
            }else{(Swal.fire({
                    icon: 'warning',
                    title: 'Warning',
                    text: 'Please Fill All Fields.'
                }))}
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
                if (degree && school && educ && from && to && high && year && scholar){
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
                                Swal.fire({
                                        icon: 'success',
                                        title: 'Success',
                                        text: 'Degree Updated Successfully'
                                    })
                            }
                        })

                    }
                })
            }else{(Swal.fire({
                    icon: 'warning',
                    title: 'Warning',
                    text: 'Please Fill All Fields'
                }))}

            })

            // delete degree db
            $("#dashBoardBody").on("click","#deleteButonDegreeModal",function(){
                const id = $(this).val();
                const email = $("#userEmailProfile").val()

                Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                if (result.isConfirmed) {
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
                                Swal.fire({
                                        icon: 'success',
                                        title: 'Success',
                                        text: 'Deleted Successfully'
                                    })
                            }
                        })
                    }
                })                   
                }
                })              
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

                if (career && rating && dateExam && placeExam && Ldate && Lnumber){

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
                                Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: 'Updated Successfully'
                            })

                            }
                        })
                    }
                })

                }else{( Swal.fire({
                        icon: 'warning',
                        title: 'Warning',
                        text: 'Please Fill All Fields.'
                    }))}
            })

            // CIVIL DELETE DB
            $("#dashBoardBody").on('click','#civilDeleteButtonDB',function(){
                const id = $(this).val();
                const email = $("#profileUserEmail").val();

                // alert(email)

                                    Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                    if (result.isConfirmed) {

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
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Success',
                                        text: 'Deleted Successfully'
                                    })
                                }
                            })
                        }
                    })
                       
                    }
                    })

                
                    
                
                
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

                // alert(position)

                if(from && to && positionLvl && position && department && salary && job && status && service){
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
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Success',
                                        text: 'Added Successfully'
                                    })

                                }
                            })
                        }
                    })
                }else{
                    Swal.fire({
                    icon: 'warning',
                    title: 'Warning',
                    text: 'Please Fill All Fields.',
                    })
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

                if (from && to && positionLvl && position && department && salary && job && status && service){

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

                                Swal.fire({
                                        icon: 'success',
                                        title: 'Success',
                                        text: 'Updated Successfully'
                                    })
                            }
                        })

                    }
                })
            }else{(Swal.fire({
                    icon: 'warning',
                    title: 'Warning',
                    text: 'Please Fill All Fields.',
                    }))}
            })

            // WORK DELETE 
            $("#dashBoardBody").on("click","#deleteWorkExpButtonDb",function(){
                const id = $(this).val();
                const email = $("#userEmailProfile").val();

                Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                if (result.isConfirmed) {

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
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Success',
                                        text: 'Deleted Successfully'
                                    })

                                }
                            })
                        }
                    })
                   
                }
                })

           
                    
                
 
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

                // file

                const file = $("#inputAwardFile").prop("files")[0];

                // alert(id)

                // alert($("#inputAnnouncementFile").prop("files")[0])

                const formData = new FormData();
                formData.append("file", file);
                formData.append("email", email);
                formData.append("title", title);
                formData.append("lvl", lvl);
                formData.append("date", date);

                if (title && lvl && date){

                $.ajax({
                    url: "profileInfo/addAward.php",
                    type: "POST",
                    data:formData,
                    processData: false,
                    contentType: false,
                    success: function() {

                        $.ajax({
                            url:"profileInfo/award.php",
                            method:"post",
                            data:{
                                email:email
                            },
                            success(e){
                                $("#dashBoardBody").html(e)

                                Swal.fire({
                                        icon: 'success',
                                        title: 'Success',
                                        text: 'Added Successfully'
                                    })

                            }
                        })

                    }
                });
         
            }else{( Swal.fire({
                    icon: 'warning',
                    title: 'Warning',
                    text: 'Please Fill All Fields.'
                }))}
               
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
                // const file = $("#EditinputAwardFile").val();
                const file = $("#EditinputAwardFile").prop("files")[0];


                // alert(file)
                const formData = new FormData();

                formData.append("id", id);
                formData.append("file", file);
                formData.append("title", title);
                formData.append("lvl", lvl);
                formData.append("date", date);

                if (title && lvl && date){

                $.ajax({
                    url: "profileInfo/updateAward.php",
                    type: "POST",
                    data:formData,
                    processData: false,
                    contentType: false,
                    success: function(e) {

                        // $("#dashBoardBody").html(e)


                        $.ajax({
                            url:"profileInfo/award.php",
                            method:"post",
                            data:{
                                email:email
                            },
                            success(e){
                                $("#dashBoardBody").html(e)

                                Swal.fire({
                                        icon: 'success',
                                        title: 'Success',
                                        text: 'Updated Successfully'
                                    })
                            }
                        })

                    }
                });
            }else{( Swal.fire({
                    icon: 'warning',
                    title: 'Warning',
                    text: 'Please Fill All Fields.'
                }))}

            })

            // DELETE AWARD DATABASE BUTTON
            $("#dashBoardBody").on("click","#profileAwardDeleteButton",function(){
                const id = $(this).val();
                const email = $("#userEmailProfile").val();
                Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                if (result.isConfirmed) {
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

                const file = $("#inputLearningFile").prop("files")[0];

                const formData = new FormData();

                formData.append("email", email);
                formData.append("title", title);
                formData.append("from", from);
                formData.append("to", to);
                formData.append("hrs", hrs);
                formData.append("typeOfLd", typeOfLd);
                formData.append("conducted", conducted);
                formData.append("file", file);

                if (title && from && to && hrs && typeOfLd && conducted){

                $.ajax({
                    url: "profileInfo/addLearning.php",
                    type: "POST",
                    data:formData,
                    processData: false,
                    contentType: false,
                    success: function() {

                        // $("#dashBoardBody").html(e)


                        $.ajax({
                            url:"profileInfo/learning_and_development.php",
                            method:"post",
                            data:{
                                email : email
                            },
                            success(e){
                                $("#dashBoardBody").html(e)

                            Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Added Successfully.'
                            })
                            }
                        })
                       
                    }
                });
            }else{( Swal.fire({
                    icon: 'warning',
                    title: 'Warning',
                    text: 'Please Fill All Fields.'
                }))}
                

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

                const file = $("#inputEditLearningFile").prop("files")[0];

                const formData = new FormData();

                formData.append("id", id);
                formData.append("title", title);
                formData.append("from", from);
                formData.append("to", to);
                formData.append("hrs", hrs);
                formData.append("typeOfLd", typeOfLd);
                formData.append("conducted", conducted);
                formData.append("file", file);

                // alert($("#inputEditLearningFile").val())

                if(title && from && to && hrs && typeOfLd && conducted){
                    $.ajax({
                        url:"profileInfo/learningUpdate.php",
                        method:"post",
                        data:formData,
                        processData: false,
                        contentType: false,
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
                                    Swal.fire({
                                    icon: 'success',
                                    title: 'Success',
                                    text: 'Added Successfully.'
                                    })
                                }
                            })
                        }
                    })
                }else{
                    Swal.fire({
                    icon: 'warning',
                    title: 'Warning',
                    text: 'Please Fill All Fields.'
                })
                }
            })

            // DELETE LEARNING
            $("#dashBoardBody").on("click","#profileLearningDeleteButton",function(){
                const id = $(this).val()
                const email = $("#userEmailProfile").val()

                Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                if (result.isConfirmed) {
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
                                    Swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success'
                                    )
                                    // confirm("Update success!")
                                }
                            })
                        }
                    })
               
                }
                })
                
            })

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

            // CREDENTIAL FOLDER IN SCHOOL HEAD
            $("#dashBoardBody").on("click","#credentialButtonFolder",function(){
                const email = $(this).val()

                // $("$credentialModalBody").html(email)

                $.ajax({
                    url:"credentialsModal.php",
                    method:"post",
                    data:{
                        email:email
                    },
                    success(e){
                        $("#credentialModalBody").html(e)
                    }
                })
            })

            // ANNOUNCEMENT BUTTON DB
            $("#addAnnouncementButtonDb").click(function(){

                const file = $("#inputAnnouncementFile").prop("files")[0];

                // alert($("#inputAnnouncementFile").prop("files")[0])

                const formData = new FormData();
                formData.append("file", file);
                // formData.append("email", email);

                if(file){

                    $.ajax({
                        url: "uploadAnnouncement.php",
                        type: "POST",
                        data:formData,
                        processData: false,
                        contentType: false,
                        success: function() {

                            $("#announcemenTableTBody").load("announcementTbody.php");
                            Swal.fire({
                                        icon: 'success',
                                        title: 'Success',
                                        text: 'File Added Successfully'
                                    })

                        }
                    });
                }else{
                    Swal.fire({
                                        icon: 'warning',
                                        title: 'Warning',
                                        text: 'Please Select File'
                                    })
                }
            })

            // DELETE ANNOUNCEMENT
            $("#dashBoardBody").on("click","#deleteAnnouncementButtonDb",function(){
                const id = $(this).val();

                Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url:"deleteAnnouncement.php",
                        method:"post",
                        data:{
                            id:id
                        },
                        success(){

                            $("#announcemenTableTBody").load("announcementTbody.php");
                            Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                        )
                            // $("#announcemenTableTBody").html(e);

                        }
                    })
                    
                }
                })

                // if(confirm('Are you sure to delete this?')){

                   
                // }
                
            })

            // EDIT ANNOUNCEMENT BUTTON FOR MODAL
            $("#dashBoardBody").on("click","#editAnnouncementButtonModal",function(){
                const id = $(this).val();

                $.ajax({
                    url:"announcementModalupdate.php",
                    method:"post",
                    data:{
                        id:id
                    },
                    success(e){
                        $("#editAnnouncementModalBody").html(e)
                    }
                })
            })

            // ANNOUNCEMENT
            $("#updateAnnouncementButtonDB").click(function(){
                const id = $("#announcementId").val();
                
                const file = $("#inputEditAnnouncementFile").prop("files")[0];

                // alert(id)

                // alert($("#inputAnnouncementFile").prop("files")[0])

                const formData = new FormData();
                formData.append("file", file);
                formData.append("id", id);

                if(file){

                    $.ajax({
                        url: "updateAnnouncement.php",
                        type: "POST",
                        data:formData,
                        processData: false,
                        contentType: false,
                        success: function() {

                            $("#announcemenTableTBody").load("announcementTbody.php");
                            Swal.fire({
                                        icon: 'success',
                                        title: 'Success',
                                        text: 'File Updated Successfully'
                                    })


                        }
                    });
                }else{
                    Swal.fire({
                                        icon: 'warning',
                                        title: 'Warning',
                                        text: 'Please Select File'
                                    })
                }

            })

            // VIEW FILE 
            $("#dashBoardBody").on("click","#viewFileButtonNew",function(){
                const id = $(this).val()

                $.ajax({
                    url:"profileInfo/viewFileModal.php",
                    method:"post",
                    data:{
                        id:id
                    },
                    success(e){
                        $("#viewFileModal").html(e)
                    }
                })
            })

            $("#dashBoardBody").on("click","#viewFileLearningButton",function(){
                const id = $(this).val()

                $.ajax({
                    url:"profileInfo/viewFileLearningModal.php",
                    method:"post",
                    data:{
                        id:id
                    },
                    success(e){
                        $("#viewFileLearningModalBody").html(e)
                    }
                })
            })

            // CHANGE CHART DASHBOARD
            $("#subProfessionalDashBoardButton").click(function(){
                $("#chartWrapper").load("dashBoardCivilChart/subPro.php");
            })
            $("#professionalDashBoardBtn").click(function(){
                $("#chartWrapper").load("dashBoardCivilChart/professional.php");
            })

            $("#barDashBoardBtn").click(function(){
                $("#chartWrapper").load("dashBoardCivilChart/bar.php");
            })

            // VIEW BUTTON DASHBOARD SHORTCUTS
            $('#viewAllPostDegreeBtn').click(function(){
                const degree = $(this).val();

                $.ajax({
                    url:"Degree.php",
                    method:'post',
                    data:{
                        degree : degree
                    },
                    success(e){
                        $("#dashBoardBody").html(e)
                    }
                })
            })


            $('#viewAllMasterDegreeBtn').click(function(){
                const degree = $(this).val();

                $.ajax({
                    url:"Degree.php",
                    method:'post',
                    data:{
                        degree : degree
                    },
                    success(e){
                        $("#dashBoardBody").html(e)
                    }
                })
            })

            $("#viewManagerialButtonDashboard").click(function(){
                const learning = $(this).val();

                $.ajax({
                    url:"Learning.php",
                    method:'post',
                    data:{
                        learning : learning
                    },
                    success(e){
                        $("#dashBoardBody").html(e)
                    }
                })
            })

            $("#viewSupervisoryButtonDashboard").click(function(){
                const learning = $(this).val();

                $.ajax({
                    url:"Learning.php",
                    method:'post',
                    data:{
                        learning : learning
                    },
                    success(e){
                        $("#dashBoardBody").html(e)
                    }
                })
            })
            

            $("#viewTechnicalButtonDashBoard").click(function(){
                const learning = $(this).val();

                $.ajax({
                    url:"Learning.php",
                    method:'post',
                    data:{
                        learning : learning
                    },
                    success(e){
                        $("#dashBoardBody").html(e)
                    }
                })
            })

            $("#viewAllInternationalBtn").click(function(){
                const lvl = $(this).val();

                $.ajax({
                    url:"UsersWithAward.php",
                    method:'post',
                    data:{
                        lvl : lvl
                    },
                    success(e){
                        $("#dashBoardBody").html(e)
                    }
                })
            })

            $("#viewAllNationalBtn").click(function(){
                const lvl = $(this).val();

                $.ajax({
                    url:"UsersWithAward.php",
                    method:'post',
                    data:{
                        lvl : lvl
                    },
                    success(e){
                        $("#dashBoardBody").html(e)
                    }
                })
            })

            $("#viewAllRegionalBtn").click(function(){
                const lvl = $(this).val();

                $.ajax({
                    url:"UsersWithAward.php",
                    method:'post',
                    data:{
                        lvl : lvl
                    },
                    success(e){
                        $("#dashBoardBody").html(e)
                    }
                })
            })

            $("#viewAllDivisionBtn").click(function(){
                const lvl = $(this).val();

                $.ajax({
                    url:"UsersWithAward.php",
                    method:'post',
                    data:{
                        lvl : lvl
                    },
                    success(e){
                        $("#dashBoardBody").html(e)
                    }
                })
            })

            $("#viewAllSchoolBtn").click(function(){
                const lvl = $(this).val();

                $.ajax({
                    url:"UsersWithAward.php",
                    method:'post',
                    data:{
                        lvl : lvl
                    },
                    success(e){
                        $("#dashBoardBody").html(e)
                    }
                })
            })

            $("#viewAllSubProfessionalButton").click(function(){
                const service =  $(this).val();
                
                $.ajax({
                    url:"civilServiceShortcut.php",
                    method:"post",
                    data:{
                        service : service
                    },
                    success(e){
                        $("#dashBoardBody").html(e)
                    }
                })
            })

            $("#viewAllProfessionalButton").click(function(){
                const service =  $(this).val();
                
                $.ajax({
                    url:"civilServiceShortcut.php",
                    method:"post",
                    data:{
                        service : service
                    },
                    success(e){
                        $("#dashBoardBody").html(e)
                    }
                })
            })

            $("#viewAllBarButton").click(function(){
                const service =  $(this).val();
                
                $.ajax({
                    url:"civilServiceShortcut.php",
                    method:"post",
                    data:{
                        service : service
                    },
                    success(e){
                        $("#dashBoardBody").html(e)
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
    <!-- copy lang -->
    <script>
        var xValues = ["System Admin (<?php echo $adminCount ?>)", "School Head (<?php echo $p ?>)", "Users (<?php echo $clientCount ?>)", "School head with Master's Degree (<?php echo $nMaster ?>)", "School head with Post Degree (<?php echo $nPost ?>)", "School head with International Awards (<?php echo $nInternationalAward ?>)"];
        var yValues = [<?php echo $adminCount ?>, <?php echo $p ?>, <?php echo $clientCount ?>, <?php echo $nMaster ?>, <?php echo $nPost ?>, <?php echo $nInternationalAward ?>];
        var barColors = [
        "#b91d47",
        "#00aba9",
        "#2b5797",
        "#e8c3b9",
        "#1e7145",
        "#87194c",
        ];

        new Chart("copyChart", {
        type: "pie",
        data: {
            labels: xValues,
            datasets: [{
            backgroundColor: barColors,
            data: yValues
            }]
        },
        options: {
            title: {
            display: false,
            text: "Performance Analytics"
            },
            legend: {
                display: true,
                position: 'right',
                labels: {
                    font: {
                        size: 20
                    }
                }
            }
        }
        
        });
    </script>

    <!-- User chart -->
    <script>
        var xValues = ["System Admin (<?php echo $adminCount ?>)", "School Head (<?php echo $p ?>)", "Users (<?php echo $clientCount ?>)"];
        var yValues = [<?php echo $adminCount ?>, <?php echo $p ?>, <?php echo $clientCount ?>];
        var barColors = [
        "#b91d47",
        "#00aba9",
        "#2b5797",
        ];

        new Chart("pieChart", {
        type: "pie",
        data: {
            labels: xValues,
            datasets: [{
            backgroundColor: barColors,
            data: yValues
            }]
        },
        options: {
            title: {
            display: false,
            text: "Performance Analytics"
            },
            legend: {
                display: true,
                position: 'right',
                labels: {
                    font: {
                        size: 20
                    }
                }
            }
        }
        
        });
    </script>

    <!-- Degree Chart -->
    <script>
        var xValues = ["Master's Degree (<?php echo $nMaster ?>)", "Post Degree (<?php echo $nPost ?>)"];
        var yValues = [ <?php echo $nMaster ?>, <?php echo $nPost ?>];
        var barColors = [
        "#2b5797",
        "#1e7145",
        ];

        new Chart("degreeChart", {
        type: "bar",
        data: {
            labels: xValues,
            datasets: [{
            backgroundColor: barColors,
            data: yValues
            }]
        },
        options: {
            title: {
            display: false,
            text: "Performance Analytics"
            },
            legend: {
                display: false,
                position: 'right',
                labels: {
                    font: {
                        size: 20
                    }
                }
            },
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }

        }
        
        });
    </script>

    <!-- Rewards and Recognition -->
    <?php 

        $getInternational = "SELECT DISTINCT email,lvl FROM award WHERE lvl='International'";
        $lInternational = $con->query($getInternational);
        $international = $lInternational->num_rows;

        $getNational = "SELECT DISTINCT email,lvl FROM award WHERE lvl='National'";
        $lNational = $con->query($getNational);
        $National = $lNational->num_rows;

        $getRegion = "SELECT DISTINCT email,lvl FROM award WHERE lvl='Region'";
        $lRegion = $con->query($getRegion);
        $Region = $lRegion->num_rows;

        $getDivision = "SELECT DISTINCT email,lvl FROM award WHERE lvl='Division'";
        $lDivision = $con->query($getDivision);
        $Division = $lDivision->num_rows;

        $getSchool = "SELECT DISTINCT email,lvl FROM award WHERE lvl='School'";
        $lSchool = $con->query($getSchool);
        $School = $lSchool->num_rows;

    ?>
    <script>
        var xValues = ["International (<?php echo $international ?>)", "National (<?php echo $National ?>)", "Regional (<?php echo $Region ?>)", "Division (<?php echo $Division ?>)", "School (<?php echo $School ?>)"];
        var yValues = [<?php echo $international ?>,<?php echo $National ?>,<?php echo $Region ?>,<?php echo $Division ?>,<?php echo $School ?>];
        var barColors = [
        // "#b91d47",
        "#00aba9",
        "#2b5797",
        "#e8c3b9",
        "#1e7145",
        "#87194c",
        ];

        new Chart("RaRChart", {
        type: "doughnut",
        data: {
            labels: xValues,
            datasets: [{
            backgroundColor: barColors,
            data: yValues
            }]
        },
        options: {
            title: {
            display: false,
            text: "Performance Analytics"
            },
            legend: {
                display: true,
                position: 'right',
                labels: {
                    font: {
                        size: 20
                    }
                }
            }
        }
        
        });
    </script>

    <!-- Training Chart -->
    <?php
        $getManagerial = "SELECT DISTINCT email,typeOfLd FROM learning WHERE typeOfLd='Managerial'";
        $lManegerial = $con -> query($getManagerial);
        $managerial = $lManegerial->num_rows;

        $getSupervisory = "SELECT DISTINCT email,typeOfLd FROM learning WHERE typeOfLd='Supervisory'";
        $lSupervisory = $con -> query($getSupervisory);
        $Supervisory = $lSupervisory->num_rows;

        $getTechnical = "SELECT DISTINCT email,typeOfLd FROM learning WHERE typeOfLd='Technical'";
        $lTechnical = $con -> query($getTechnical);
        $Technical = $lTechnical->num_rows;
    ?>
    <script>
        var xValues = ["Managerial (<?php echo $managerial ?>)", "Supervisory (<?php echo $Supervisory ?>)", "Technical (<?php echo $Technical ?>)"];
        var yValues = [ <?php echo $managerial ?>, <?php echo $Supervisory ?>, <?php echo $Technical ?>];
        var barColors = [
        "#e8c3b9",
        "#1e7145",
        "#2b5797",
        ];

        new Chart("trainingChart", {
        type: "bar",
        data: {
            labels: xValues,
            datasets: [{
            backgroundColor: barColors,
            data: yValues
            }]
        },
        options: {
            title: {
            display: false,
            text: "Performance Analytics"
            },
            legend: {
                display: false,
                position: 'right',
                labels: {
                    font: {
                        size: 20
                    }
                }
            },
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
        
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>            <?php include 'footer.php' ?>
    <?php include 'footer.php' ?>


</body>
</html>