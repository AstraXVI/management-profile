<?php
    require "db.php";
    session_start();

    $id = $_POST['id'];

    $q = "SELECT * from users where id='$id'";
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


    </style>
</head>
<body style="background: url(https://cdn.pixabay.com/photo/2017/07/01/19/48/background-2462431_960_720.jpg) no-repeat; background-size: cover; background-color: #e5e5e5; background-blend-mode: overlay;">
    <h2 class="text-secondary fw-bold mb-5">Profile <?php echo "| ".$info['email'] ?></h2>

    <!-- Tabs content -->
    <div class="tab-content 5" id="ex1-content">
        <div class="tab-pane fade show active" id="ex1-tabs-1" role="tabpanel" aria-labelledby="ex1-tab-1">
        
        <div class="wrapper d-flex align-items-center gap-3 px-3 position-relative" style=" padding-block: 20px 10px; background-color: #e2f8fb">
        
        <div class="col-md-4">
                <div class="profile-img">
    
                    <?php if(empty($info['picture'])){ ?>
                        <img src="https://sdovalenzuelacity.deped.gov.ph/wp-content/uploads/2021/04/New-DO-Logo.png" alt="" />
                    <?php }else{ ?>
                        <img src="<?php echo $info['picture'] ?>" alt="" />
                    <?php } ?>

                    <div class="file btn btn-lg btn-primary">
                        <i class="fa-solid fa-rotate me-2"></i>Change Photo
                        <div class="profile-button"><button class='btn text-light w-100'  value="<?php echo $info['id'] ?>">Upload here</button></div>
                    </div>
                </div>
            </div>
            <!-- <div class="divider"></div> -->
            <div class="card mb-3 w-75" style="max-height: 490px">
                <div class="card-body">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Email</span>
                        <input type="text" class="form-control" value='<?php echo $info['email'] ?>' id='profileInputAdminInfoEmail' aria-label="Username" aria-describedby="basic-addon1" >
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Password</span>
                        <input type="text" class="form-control" value='<?php echo $info['pass'] ?>' aria-label="Username" aria-describedby="basic-addon1" disabled>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Role</span>
                        <input type="text" class="form-control" value='<?php echo $info['role'] ?>' aria-label="Username" aria-describedby="basic-addon1" disabled>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">New password</span>
                        <input type="text" class="form-control" aria-label="Username" id='profileInputAdminInfoNewPass' aria-describedby="basic-addon1" >
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Re-type New password</span>
                        <input type="text" class="form-control" aria-label="Username" id='profileInputAdminInfoRPass' aria-describedby="basic-addon1" >
                    </div>
                    <button class='btn btn-primary' id='updateAdminProfileDb' value='<?php echo $id ?>' >Update data</button>
                </div>
            </div>
        </div>
    </div>

<!-- MDB -->

</body>
</html>