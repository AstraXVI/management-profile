<?php
    require "db.php";
    session_start();

    $id = $_POST['id'];

    $q = "SELECT * from profile where id='$id'";
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
            padding: 20px;
        }
        .profile-img .file {
            position: relative;
            overflow: hidden;
            margin-top: -20%;
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

    </style>
</head>
<body style="background: url(https://cdn.pixabay.com/photo/2017/07/01/19/48/background-2462431_960_720.jpg) no-repeat; background-size: cover; background-color: #e5e5e5; background-blend-mode: overlay;">
    <h2 class="text-secondary fw-bold mb-3">My Profile</h2>




    <div class="wrapper d-flex align-items-center justify-content-center gap-3 px-3 position-relative" style=" padding-block: 70px; background-color: #e2f8fb">
        
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
        <div class="card mb-3 w-50">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-3"><h6 class="mb-0">Name</h6></div>
                    <div class="col-sm-9 text-secondary"><?php echo $info['name'] ?></div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-3"><h6 class="mb-0">Birthday</h6></div>
                    <div class="col-sm-9 text-secondary"><?php echo $info['bday'] ?></div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-3"><h6 class="mb-0">Address</h6></div>
                    <div class="col-sm-9 text-secondary"><?php echo $info['address'] ?></div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-3"><h6 class="mb-0">Deped Email</h6></div>
                    <div class="col-sm-9 text-secondary"><?php echo $info['email'] ?></div>
                </div>
                <div class="row">
                    <div class="col-sm-3"><h6 class="mb-0">Contact</h6></div>
                    <div class="col-sm-9 text-secondary"><?php echo $info['contactNo'] ?></div>
                </div>
                <div class="row">
                    <div class="col-sm-3"><h6 class="mb-0">Sex</h6></div>
                    <div class="col-sm-9 text-secondary"><?php echo $info['sex'] ?></div>
                </div>
                <div class="row">
                    <div class="col-sm-3"><h6 class="mb-0">Year as School Head</h6></div>
                    <div class="col-sm-9 text-secondary"><?php echo $info['yearAsSchoolHead'] ?></div>
                </div>
                <div class="row">
                    <div class="col-sm-3"><h6 class="mb-0">Duration year of stay</h6></div>
                    <div class="col-sm-9 text-secondary"><?php echo $info['duration'] ?></div>
                </div>
                <div class="row">
                    <div class="col-sm-3"><h6 class="mb-0">Learners Performance</h6></div>
                    <div class="col-sm-9 text-secondary"><?php echo $info['learnersPerf'] ?></div>
                </div>
                <div class="row">
                    <div class="col-sm-3"><h6 class="mb-0">Teacher Performance</h6></div>
                    <div class="col-sm-9 text-secondary"><?php echo $info['teacherPerf'] ?></div>
                </div>
                <div class="row">
                    <div class="col-sm-3"><h6 class="mb-0">Financial Management</h6></div>
                    <div class="col-sm-9 text-secondary"><?php echo $info['financialMng'] ?></div>
                </div>
                <div class="row">
                    <div class="col-sm-3"><h6 class="mb-0">Complaints</h6></div>
                    <div class="col-sm-9 text-secondary"><?php echo $info['complaints'] ?></div>
                </div>

                <hr>
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
</body>
</html>