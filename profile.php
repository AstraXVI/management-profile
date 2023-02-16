<?php
    require "db.php";
    session_start();

    $id = $_POST['id'];

    $q = "SELECT * from users where id='$id'";
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
    <h2 class="text-secondary fw-bold mb-3">Personal Info</h2>

    <!-- user id -->
    <!-- <input type="hidden" value='<?php echo $info['id'] ?>' id='profileUserId'> -->
    <!--  -->
    <!-- <label>Email</label>
    <input type="text" value='<?php echo $info['email'] ?>' disabled>
    <label>Role</label>
    <input type="text" value='<?php echo $info['role'] ?>' disabled>
    <label>School</label>
    <input type="text" value='<?php echo $info['school'] ?>' disabled>
    <label>Password</label>
    <input type="text" value='<?php echo $info['pass'] ?>' disabled>
    <input type="text" id='profileNewPassword' placeholder='New password'>
    <input type="text" id='profileNewpassValidation' placeholder='Retype new password'> -->
    <!-- <button>BACK</button> -->
    <!-- <button id='updateUserInfoProfile'>UPDATE</button> -->


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
                    <div class="profile-button"><button class='btn text-light w-100' data-bs-toggle="modal" data-bs-target="#uploadProfileModal">Upload here</button></div>
                </div>
            </div>
        </div>
        <!-- <div class="divider"></div> -->
        <div class="card mb-3 w-50">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-3"><h6 class="mb-0">Email</h6></div>
                    <div class="col-sm-9 text-secondary"><?php echo $info['email'] ?></div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-3"><h6 class="mb-0">Role</h6></div>
                    <div class="col-sm-9 text-secondary"><?php echo $info['role'] ?></div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-3"><h6 class="mb-0">School</h6></div>
                    <div class="col-sm-9 text-secondary"><?php echo $info['school'] ?></div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-3"><h6 class="mb-0">Password</h6></div>
                    <div class="col-sm-9 text-secondary"><?php echo $info['pass'] ?></div>
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