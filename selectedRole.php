<?php
    require "db.php";

    $role = $_POST['role'];

    if($role == "Default"){
        $getUsers = "SELECT * FROM users";

    }else{
        $getUsers = "SELECT * FROM users WHERE role='$role'";
    }

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
    <?php if($list->num_rows){ ?>
        <?php do{ ?>
            <tr>
                <td><?php echo $fetchUserInfo['id'] ?></td>
                <td><?php echo $fetchUserInfo['email'] ?></td>
                <td><?php echo $fetchUserInfo['pass'] ?></td>
                <td><?php echo $fetchUserInfo['role'] ?></td>
                <td><?php echo $fetchUserInfo['school'] ?></td>
                <td class="d-flex gap-1 justify-content-center">
                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#EditUserManageUser" value='<?php echo $fetchUserInfo['id'] ?>' id='editUserManageUser'><i class="fa-solid fa-pen"></i></button>
                    <button class='btn btn-danger btn-sm' id='deleteUserManageUser' value='<?php echo $fetchUserInfo['id'] ?>' ><i class="fa-solid fa-trash"></i></button>
                </td>
            </tr>
        <?php }while($fetchUserInfo = $list->fetch_assoc()) ?>
    <?php }else{ ?>
        <tr>
            <td colspan='6'>No data</td>
        </tr>
    <?php } ?>
</body>
</html>