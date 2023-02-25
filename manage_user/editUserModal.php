<?php
    require "../db.php";

    $id = $_POST['id'];

    $getUsers = "SELECT * FROM users WHERE id='$id'";
    $list = $con->query($getUsers);
    $fetchUserInfo = $list->fetch_assoc();
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

    <!-- USER ID -->
    <input type="hidden" value='<?php echo $fetchUserInfo['id'] ?>' id='updateUserIdManageUser'>
    <!--  -->

    <!-- <div class="form-floating mb-3">
        <input type="email" class="form-control" value='<?php echo $fetchUserInfo['email'] ?>' id="inputEmailUserEdit" placeholder="name@example.com">
        <label>Email</label>
    </div> -->
    <label class='mt-3 mb-3'>Email</label>
    <select id="inputEmailUserEdit" class="form-select" aria-label="Default select example">

        <option value="<?php echo $fetchUserInfo['email'] ?>" class='bg-primary text-light'><?php echo $fetchUserInfo['email'] ?></option>

        <?php
            $getSchool = "SELECT email FROM profile";
            $schoolList = $con->query($getSchool);
            $schoolFetch = $schoolList->fetch_assoc();
        ?>

        <?php if($schoolList->num_rows){ ?>
            <?php do{ ?>
                <option value="<?php echo $schoolFetch['email'] ?>"><?php echo $schoolFetch['email'] ?></option>
            <?php }while($schoolFetch = $schoolList->fetch_assoc()) ?>
        <?php } ?>
        
    </select>

    <div class="form-floating my-3">
        <input type="email" class="form-control" value='<?php echo $fetchUserInfo['pass'] ?>' id="inputPasswordEdit" placeholder="name@example.com">
        <label>Password</label>
    </div>


    <label class='my-2'>Role</label>
    <select id='inputRoleEdit' class="form-select" aria-label="Default select example">
        <option value="<?php echo $fetchUserInfo['role'] ?>" class='bg-primary text-light'><?php echo $fetchUserInfo['role'] ?></option>
        <option value="Client">Client</option>
        <option value="Admin">Admin</option>
    </select>



</body>
</html>