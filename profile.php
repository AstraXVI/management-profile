<?php
    require "db.php";
    session_start();

    $id = $_POST['id'];

    $q = "SELECT * from profile where email='$id' OR id='$id'";
    $list = $con->query($q);
    $info = $list->fetch_assoc();
    
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
            margin-top: -7%;
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
        /* .profile-img::before{
            content: '';
            width: 380px;
            height: 300px;
            background-color: #f5f5f5;
            position: absolute;
            top: 0;
            left: 0;
        } */


        /* .profile-container {
        position: relative;
        margin-top: -10px;
        width: 380px;
        height: 300px;
        margin-right: 20px;
        }

        .profile-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0);
        transition: background 0.5s ease;
        }

        .profile-container:hover .profile-overlay {
        display: block;
        background: rgba(0, 0, 0, .5);
        }

        .profile-container img {
        position: absolute;
        width: 300px;
        max-width: 380px;
        height: 300px;
        left: 0;
        right: 0;
        margin-inline: auto;
        max-height: 300px;
        }

        .profile-title {
        position: absolute;
        width: 380px;
        left: 0;
        bottom: 50px;
        font-weight: 700;
        font-size: 30px;
        text-align: center;
        text-transform: capitalize;
        color: white;
        z-index: 1;
        transition: bottom .5s ease;
        }

        .profile-container:hover .profile-title {
        bottom: 80px;
        }

        .profile-button {
        position: absolute;
        width: 380px;
        left:0;
        bottom: 30px;
        text-align: center;
        opacity: 0;
        transition: opacity .35s ease;
        }

        .profile-button a {
        width: 200px;
        padding: 12px 48px;
        text-align: center;
        color: white;
        border: solid 2px white;
        z-index: 1;
        text-decoration: none;
        }

        .profile-container:hover .profile-button {
        opacity: 1;
        } */

        /* .tabsss.nav-link, .tabsss.nav-link.active {
            color: #f5f5f5;
            background-color: rgba(13, 109, 253, 0.521);
            border-color: #dee2e6;
        } */

    </style>
</head>
<body style="background: url(https://cdn.pixabay.com/photo/2017/07/01/19/48/background-2462431_960_720.jpg) no-repeat; background-size: cover; background-color: #e5e5e5; background-blend-mode: overlay;">
    <h2 class="text-secondary fw-bold mb-3">Profile</h2>

        <!-- get email profile -->
        <input type="hidden" value='<?php echo $info['email'] ?>' id='profileUserEmail'>
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
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="ex1-tab-5" data-mdb-toggle="tab" href="#ex1-tabs-5" role="tab" aria-controls="ex1-tabs-5" aria-selected="false">Voluntary Work</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="ex1-tab-6" data-mdb-toggle="tab" href="#ex1-tabs-6" role="tab" aria-controls="ex1-tabs-6" aria-selected="false">Learning and Development</a>
        </li>
    </ul>

    <!-- Tabs content -->
    <div class="tab-content" id="ex1-content">
        <div class="tab-pane fade show active" id="ex1-tabs-1" role="tabpanel" aria-labelledby="ex1-tab-1">
        
        <!-- Personal info -->
        <div class="wrapper d-flex align-items-center gap-3 px-3 position-relative" style=" padding-block: 20px 10px; background-color: #e2f8fb">
        
        <!-- <div class="profile-container">
            <p class="profile-title">Change Profile</p>
            <div class="profile-overlay" ></div>
            <div class="profile-button"><button class='btn text-light' data-bs-toggle="modal" data-bs-target="#uploadProfileModal">Upload here</button></div>
        </div> -->
        
        
        <div class="col-md-4">
                <div class="profile-img">
                    <!-- <img src="https://cdn.pixabay.com/photo/2016/08/31/11/54/icon-1633249_960_720.png" alt=""> -->
                    <?php if(empty($info['picture'])){ ?>
                        <img src="https://cdn.pixabay.com/photo/2016/08/31/11/54/icon-1633249_960_720.png" alt="" />
                    <?php }else{ ?>
                        <img src="<?php echo $info['picture'] ?>" alt="" />
                    <?php } ?>
    
                <!-- <span class="px-5 pb-1"><i class="fa-solid fa-user fs-1"></i></span>
                <hr> -->
                    <div class="file btn btn-lg btn-primary">
                    <i class="fa-solid fa-rotate me-2"></i>Change Photo
                        <div class="profile-button"><button class='btn text-light w-100' data-bs-toggle="modal" data-bs-target="#uploadProfileModal" id='uploadHereButton' value="<?php echo $info['id'] ?>">Upload here</button></div>
                    </div>
                </div>
            </div>
            <!-- <div class="divider"></div> -->
            <div class="card mb-3 w-75" style="max-height: 490px; overflow-y: scroll;">
                <div class="card-body">
                <div class="d-flex gap-2">
                        <!-- <div class="col-sm-1"><h6 class="mb-0">Employee no.</h6></div>
                        <div class="col-sm-1 text-secondary">01</div> -->
                        <h6 class="mb-0">Employee no.</h6>
                        <span class="text-secondary">01</span>
                    </div>
                    <hr>
                    <div class="d-flex gap-5">
                        <div class="d-flex align-items-center gap-2">
                            <h6 class="mb-0 col-15">Fullname:</h6>
                            <span class="text-secondary"><?php echo $info['name'] ?></span>
                        </div>
                        <span style="border-right: 2px solid lightgrey"></span>
                        <div class="d-flex align-items-center gap-2">
                            <h6 class="mb-0">Date of Birth:</h6>
                            <span class=" text-secondary"><?php echo $info['bday'] ?></span>
                        </div>
                    </div>
                    <hr>
                    <div class="d-flex gap-5">
                        <div class="d-flex align-items-center gap-2">
                            <h6 class="mb-0">Place of Birth:</h6>
                            <span class="text-secondary">Quezon City</span>
                        </div>
                        <span style="border-right: 2px solid lightgrey"></span>
                        <div class="d-flex align-items-center gap-2">
                            <h6 class="mb-0">Citizenship:</h6>
                            <span class="col-sm-9 text-secondary">Filipino</span>
                        </div>
                    </div>
                    <hr>
                    <div class="d-flex gap-5">
                        <div class="d-flex align-items-center gap-2 pe-5 me-5">
                            <h6 class="mb-0">Sex:</h6>
                            <span class="text-secondary"><?php echo $info['sex'] ?></span>
                        </div>
                        <span style="border-right: 2px solid lightgrey"></span>
                        <div class="d-flex align-items-center gap-2">
                            <h6 class="mb-0">Civil Status:</h6>
                            <span class=" text-secondary">married</span>
                        </div>
                    </div>
                    <hr>
                    <div class="d-flex gap-5">
                        <div class="d-flex align-items-center gap-2">
                            <h6 class="mb-0">Residential Address:</h6>
                            <span class="text-secondary"><?php echo $info['address'] ?></span>
                        </div>
                        <span style="border-right: 2px solid lightgrey"></span>
                        <div class="d-flex align-items-center gap-2">
                            <h6 class="mb-0">Zip Code:</h6>
                            <span class=" text-secondary">1442</span>
                        </div>
                    </div>
                    <hr>
                    <div class="d-flex gap-2 align-items-center">
                        <h6 class="mb-0">Deped Email:</h6>
                        <span class="col-sm-9 text-secondary"><?php echo $info['email'] ?></span>
                    </div>
                    <hr>
                    <div class="d-flex gap-2">
                        <h6 class="mb-0">Contact:</h6>
                        <span class="col-sm-9 text-secondary"><?php echo $info['contactNo'] ?></span>
                    </div>
                    <hr>
                    <!-- <div class="row">
                        <div class="col-sm-3"><h6 class="mb-0">Year as School Head</h6></div>
                        <div class="col-sm-9 text-secondary"><?php echo $info['yearAsSchoolHead'] ?></div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3"><h6 class="mb-0">Duration year of stay</h6></div>
                        <div class="col-sm-9 text-secondary"><?php echo $info['duration'] ?></div>
                    </div>
                    <hr>
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