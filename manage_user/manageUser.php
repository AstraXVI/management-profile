<?php
    require "../db.php";

    $getUsers = "SELECT * FROM users";
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
    <div class=" text-secondary fw-bold p-2 ps-0 mb-3 w-25 h3">Manage Users</div>

    <div class="d-flex align-items-center justify-content-between mb-3 mt-4 position-relative">
        
        
        <div class="d-flex align-items-center gap-3">
            <input id='searchUserDb' class="form-control form-control-sm fs-17 py-2 ps-5" style="border: 2px solid grey; border-radius: 100vmax; width: 350px;"  type="text" placeholder='Search User'
            aria-label="Search">
            <div style="position: absolute; top: 8px; left: 15px; z-index: 1;">
                <i class="fas fa-search fs-5 text-secondary" aria-hidden="true"></i>
            </div>

            <select id='selectedRole' class="form-select w-50" style="border: 2px solid grey" aria-label="Default select example">
                <option value='Default'>Select Role</option>
                <option value="Admin">Admin</option>
                <option value="CLient">Client</option>
            </select>
        </div>

        <button type="button" id='addUsersSchoolsModal' class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUserManageUser"><i class="fa-solid fa-plus pe-2"></i>Add User</button>


    </div>

    <div class="table-responsive" style="max-height: 480px;">
        <table class='table text-center'>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>EMAIL</th>
                    <th>PASSWORD</th>
                    <th>ROLE</th>
                    <th>SCHOOL</th>
                    <th>ACTION</th>
                </tr>
            </thead>
            <tbody id='manageUserTbody'>
                <?php if($list->num_rows){ ?>
                    <?php do{ ?>
                        <tr>
                            <td><?php echo $fetchUserInfo['id'] ?></td>
                            <td><?php echo $fetchUserInfo['email'] ?></td>
                            <td><?php echo $fetchUserInfo['pass'] ?></td>
                            <td><?php echo $fetchUserInfo['role'] ?></td>
                            <td><?php echo $fetchUserInfo['school'] ?></td>
                            <td class="d-flex gap-1 justify-content-center">
                                <button type="button" title="Edit" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#EditUserManageUser" value='<?php echo $fetchUserInfo['id'] ?>' id='editUserManageUser'><i class="fa-solid fa-pen"></i></button>
                                <button class='btn btn-danger btn-sm' title="Delete" id='deleteUserManageUser' value='<?php echo $fetchUserInfo['id'] ?>' ><i class="fa-solid fa-trash"></i></button>
                            </td>
                        </tr>
                    <?php }while($fetchUserInfo = $list->fetch_assoc()) ?>
                <?php }else{ ?>
                    <tr>
                        <td colspan='6'>No data</td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>