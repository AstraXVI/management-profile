<?php
    require "db.php";
    session_start();

    $id = $_POST['id'];

    $q = "SELECT * from profile where email='$id' OR id='$id'";
    $list = $con->query($q);
    $info = $list->fetch_assoc();

    $emailNew = $info['email'];
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .profile-img{
            text-align: center;
        }
        .profile-img img{
            width: 300px;
            height: 310px;
            /* border: 2px solid red; */
            padding-bottom: 17px;
        }
        .profile-img .file {
            position: relative;
            overflow: hidden;
            margin-top: -21%;
            width: 90%;
            border: none;
            border-radius: 0;
            font-size: 15px;
            background: #212529b8;
        }
        .profile-img .file .profile-button {
            position: absolute;
            opacity: 0;
            right: 0;
            left: 0;
            margin-inline: auto;
            width: 100%;
            top: 0;
            
        }
        .profile-img .profile-button{
            cursor: pointer;
        } 
        .wrapper{
            background-size: cover;
            background-repeat: no-repeat;
        }


    </style>
</head>
<body style="background: url(https://cdn.pixabay.com/photo/2017/07/01/19/48/background-2462431_960_720.jpg) no-repeat; background-size: cover; background-color: #e5e5e5; background-blend-mode: overlay;">
    <h2 class="text-secondary fw-bold mb-3">Profile <?php if($_SESSION['status'] == 'Admin') echo "| ".$info['name'] ?></h2>

        <!-- get email profile -->
        <input type="hidden" value='<?php echo $info['email'] ?>' id='profileUserEmail'>
        <!--  -->

        <!-- get user email -->
        <input type="hidden" value="<?php echo $emailNew ?>" id='userEmailProfile'>
        <!--  -->

        <!-- Tabs navs -->
    <ul class="nav nav-tabs tabsss mb-3" id="ex1" style="font-size: 14px;" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="ex1-tab-1" data-mdb-toggle="tab" href="#ex1-tabs-1" role="tab" aria-controls="ex1-tabs-1" aria-selected="true">Personal Information</a>
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

        <?php if($_SESSION['status'] == "Admin"){ ?>
            <li class="nav-item" role="presentation" id='profileAwardExpBtn'>
                <a class="nav-link" id="ex1-tab-5" data-mdb-toggle="tab" href="#ex1-tabs-5" role="tab" aria-controls="ex1-tabs-5" aria-selected="false">Awards</a>
            </li>
            <li class="nav-item" role="presentation" id='profileLearningAndDevelopmentButton'>
                <a class="nav-link" id="ex1-tab-6" data-mdb-toggle="tab" href="#ex1-tabs-6" role="tab" aria-controls="ex1-tabs-6" aria-selected="false">Learning and Development</a>
            </li>
        <?php } ?>
    </ul>

    <!-- Tabs content -->
    <div class="tab-content" id="ex1-content">
        <div class="tab-pane fade show active" id="ex1-tabs-1" role="tabpanel" aria-labelledby="ex1-tab-1">
        
        <!-- Personal info -->
        <div class="wrapper d-flex align-items-center gap-5 px-3 position-relative" style=" padding-block: 20px 10px; background-color: #e2f8fb">
        
        <!-- <div class="profile-container">
            <p class="profile-title">Change Profile</p>
            <div class="profile-overlay" ></div>
            <div class="profile-button"><button class='btn text-light' data-bs-toggle="modal" data-bs-target="#uploadProfileModal">Upload here</button></div>
        </div> -->
        
        
            <div class="d-flex flex-column gap-2" style="width: 300px;">
                <div class="col-md-4">
                    <div class="profile-img">
                        <!-- <img src="https://cdn.pixabay.com/photo/2016/08/31/11/54/icon-1633249_960_720.png" alt=""> -->
                        <?php if(empty($info['picture'])){ ?>
                            <img src="https://scontent.xx.fbcdn.net/v/t1.15752-9/296344997_586548009673064_9187631585299920607_n.jpg?stp=dst-jpg_p206x206&_nc_cat=108&ccb=1-7&_nc_sid=aee45a&_nc_eui2=AeHAgqD-NN46txOuxTTZ9IBUQMjAV9imIFtAyMBX2KYgW2E6OeEFZVbu6up4jl5fr40qqR8tG-V5VuAQV77jJDE7&_nc_ohc=i72A9GXT7osAX-Gz46l&_nc_ad=z-m&_nc_cid=0&_nc_ht=scontent.xx&oh=03_AdQ2Xiv7KMAW3d4w7QlCA4bu8yhfcigynEHna_EBuvPljw&oe=64262D58" alt="" />
                        <?php }else{ ?>
                            <img src="<?php echo $info['picture'] ?>" alt="" />
                        <?php } ?>
                        <!-- <span class="px-5 pb-1"><i class="fa-solid fa-user fs-1"></i></span>
                        <hr> -->
                        <div class="file btn btn-lg btn-primary" style="width: 300px">
                        <i class="fa-solid fa-rotate me-2"></i>Change Photo
                            <div class="profile-button"><button class='btn text-light w-100' data-bs-toggle="modal" data-bs-target="#uploadProfileModal" id='uploadHereButton' value="<?php echo $info['id'] ?>">Upload here</button></div>
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <div class="text-dark fw-bold fs-3"><?php echo $info['name'] ?></div>
                    <div class="text-primary "><a href="https://mail.google.com"><?php echo $info['email'] ?></a></div>
                    <span>Employee no.: </span><span class="text-dark fw-bold"><?php echo $info['employeeNo'] ?></span>
                </div>
            </div>
            <!-- <div class="divider"></div> -->
            <div class="card mb-3 w-75" style="max-height: 490px; overflow-y: scroll;">
                <div class="card-body">
                <div class="d-flex gap-2">
                        <!-- <div class="col-sm-1"><h6 class="mb-0">Employee no.</h6></div>
                        <div class="col-sm-1 text-secondary">01</div> -->
                        <!-- <h6 class="mb-0">Employee no.</h6>
                        <span class="text-secondary"><?php echo $info['employeeNo'] ?></span> -->
                    </div>
                    <!-- <hr> -->
                    <div class="d-flex gap-4">
                        <!-- <div class="d-flex align-items-center gap-2">
                            <h6 class="mb-0 col-15">Fullname:</h6>
                            <span class="text-secondary"><?php echo $info['name'] ?></span>
                        </div> -->
                        <!-- <span style="border-right: 2px solid lightgrey"></span> -->
                        <div class="d-flex align-items-center gap-2">
                            <h6 class="mb-0">Date of Birth:</h6>
                            <span class=" text-secondary"><?php echo $info['bday'] ?></span>
                        </div>
                    </div>
                    <hr>
                    <div class="d-flex gap-4">
                        <div class="d-flex align-items-center gap-2">
                            <h6 class="mb-0">Place of Birth:</h6>
                            <span class="text-secondary"><?php echo $info['placeBirth'] ?></span>
                        </div>
                        <span style="border-right: 2px solid lightgrey"></span>
                        <div class="d-flex align-items-center gap-2">
                            <h6 class="mb-0">Citizenship:</h6>
                            <span class="col-sm-9 text-secondary"><?php echo $info['citizenship'] ?></span>
                        </div>
                    </div>
                    <hr>
                    <div class="d-flex gap-4">
                        <div class="d-flex align-items-center gap-2 pe-5 me-5">
                            <h6 class="mb-0">Sex:</h6>
                            <span class="text-secondary"><?php echo $info['sex'] ?></span>
                        </div>
                        <span style="border-right: 2px solid lightgrey"></span>
                        <div class="d-flex align-items-center gap-2 ms-2">
                            <h6 class="mb-0">Civil Status:</h6>
                            <span class=" text-secondary"><?php echo $info['civil'] ?></span>
                        </div>
                    </div>
                    <hr>
                    <div class="d-flex gap-4">
                        <div class="d-flex align-items-center gap-2">
                            <h6 class="mb-0">Residential Address:</h6>
                            <span class="text-secondary"><?php echo $info['address'] ?></span>
                        </div>
                        <span style="border-right: 2px solid lightgrey"></span>
                        <div class="d-flex align-items-center gap-2">
                            <h6 class="mb-0">Zip Code:</h6>
                            <span class=" text-secondary"><?php echo $info['zipcode'] ?></span>
                        </div>
                    </div>
                    <hr>
                    <div class="d-flex gap-4">
                        <!-- <div class="d-flex gap-2 align-items-center">
                            <h6 class="mb-0">Deped Email:</h6>
                            <span class="col-sm-9 text-secondary"><?php echo $info['email'] ?></span>
                        </div>
                        <hr>
                        <div class="d-flex gap-2">
                            <h6 class="mb-0">Contact:</h6>
                            <span class="col-sm-9 text-secondary"><?php echo $info['contactNo'] ?></span>
                        </div> -->

                        <!-- <div class="d-flex align-items-center gap-2">
                            <h6 class="mb-0">Deped Email:</h6>
                            <span class="text-secondary"><?php echo $info['email'] ?></span>
                        </div> -->
                        <!-- <span style="border-right: 2px solid lightgrey"></span> -->
                        <div class="d-flex align-items-center gap-2">
                            <h6 class="mb-0">Contact:</h6>
                            <span class=" text-secondary"><?php echo $info['contactNo'] ?></span>
                        </div>
                    </div>
                    <hr>
                    <div class="d-flex gap-4">
                        <!-- <div class="row">
                            <div class="col-sm-3"><h6 class="mb-0">Year as School Head</h6></div>
                            <div class="col-sm-9 text-secondary"><?php echo $info['yearAsSchoolHead'] ?></div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3"><h6 class="mb-0">Duration year of stay</h6></div>
                            <div class="col-sm-9 text-secondary"><?php echo $info['duration'] ?></div>
                        </div> -->

                        <div class="d-flex align-items-center gap-2">
                            <h6 class="mb-0">Year as School Head:</h6>
                            <span class="text-secondary"><?php echo $info['yearAsSchoolHead'] ?></span>
                        </div>
                        <span style="border-right: 2px solid lightgrey"></span>
                        <div class="d-flex align-items-center gap-2">
                            <h6 class="mb-0">Duration year of stay:</h6>
                            <span class=" text-secondary"><?php echo $info['duration'] ?></span>
                        </div>
                    </div>
                    <hr>
                    <!-- 
                    <div class="row">
                        <div class="col-sm-3"><h6 class="mb-0">Learners Performance</h6></div>
                        <div class="col-sm-9 text-secondary"><?php echo $info['learnersPerf'] ?></div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3"><h6 class="mb-0">Teacher Performance</h6></div>
                        <div class="col-sm-9 text-secondary"><?php echo $info['teacherPerf'] ?></div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3"><h6 class="mb-0">Financial Management</h6></div>
                        <div class="col-sm-9 text-secondary"><?php echo $info['financialMng'] ?></div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3"><h6 class="mb-0">Complaints</h6></div>
                        <div class="col-sm-9 text-secondary"><?php echo $info['complaints'] ?></div>
                    </div>
    
                    <hr> -->
                    <!-- <div class="row">
                        <div class="col-sm-3"><h6 class="mb-0">Address</h6></div>
                        <div class="col-sm-9 text-secondary">Bay Area, San Francisco, CA</div>
                    </div>
                    <hr> -->
                    <div class="row">
                        <div class="col-sm-12"><button type="button" class="btn btn-info d-block mx-auto" data-bs-toggle="modal" data-bs-target="#EditUserProfile" id='editProfileBtnDb' value='<?php echo $info['id'] ?>'>Update Profile</button></div>
                    </div>
                </div>
            </div>
        </div>

        </div>
        <div class="tab-pane fade" id="ex1-tabs-2" role="tabpanel" aria-labelledby="ex1-tab-2">
            Tab 2 content
        </div>
        <div class="tab-pane fade" id="ex1-tabs-3" role="tabpanel" aria-labelledby="ex1-tab-3">
            Tab 3 content
        </div>
    </div>

<!-- MDB -->

</body>
</html>