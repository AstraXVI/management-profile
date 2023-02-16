<?php
    require "db.php";

    $searchValue = $_POST['searchValue'];

    if(empty($_POST['level'])){
        $q = "SELECT * FROM schools WHERE id LIKE '%$searchValue%' OR  school_name LIKE '%$searchValue%' OR school_id LIKE '%$searchValue%' OR division LIKE '%$searchValue%' OR school_type LIKE '%$searchValue%' OR  contact_person LIKE '%$searchValue%' OR  contact_no LIKE '%$searchValue%' OR email LIKE '%$searchValue%' OR  district LIKE '%$searchValue%' OR  level LIKE '%$searchValue%' ORDER BY id DESC";
    }else{
        $level = $_POST['level'];

        $q = "SELECT * FROM schools WHERE level='$level' AND ( id LIKE '%$searchValue%' OR  school_name LIKE '%$searchValue%' OR school_id LIKE '%$searchValue%' OR division LIKE '%$searchValue%' OR school_type LIKE '%$searchValue%' OR  contact_person LIKE '%$searchValue%' OR  contact_no LIKE '%$searchValue%' OR email LIKE '%$searchValue%' OR  district LIKE '%$searchValue%' OR  level LIKE '%$searchValue%' ) ORDER BY id DESC";

    }

    $list = $con->query($q);
    $fetch = $list->fetch_assoc();
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
            <td><?php echo $fetch['id'] ?></td>
            <td><?php echo $fetch['school_name'] ?></td>
            <td><?php echo $fetch['school_id'] ?></td>
            <td><?php echo $fetch['division'] ?></td>
            <td><?php echo $fetch['school_type'] ?></td>
            <td><?php echo $fetch['contact_person'] ?></td>
            <td><?php echo $fetch['contact_no'] ?></td>
            <td><?php echo $fetch['email'] ?></td>
            <td><?php echo $fetch['district'] ?></td>
            <td><?php echo $fetch['level'] ?></td>
            <td>
                <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#fileUplaodsDorModal" id='dorButtonModal' value='<?php echo $fetch['school_name'] ?>'><i class="fa-regular fa-folder-open text-light"></i></button>
            </td>
            <td>
                <div class="d-flex gap-1 justify-content-center">
                    <button type="button" id='editBtn' value='<?php echo $fetch['id'] ?>' class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editSchool"><i class="fa-solid fa-pen"></i></button>
                    <button class="btn btn-danger btn-sm" id='deleteBtn' value='<?php echo $fetch['id'] ?>'><i class="fa-solid fa-trash"></i></button>
                    <button class="btn btn-success btn-sm" id="viewBtn" value='<?php echo $fetch['school_name'] ?>'><i class="fa-solid fa-eye"></i></button>
                </div>
            </td>
        </tr>
    <?php }while($fetch = $list->fetch_assoc()) ?>
<?php }else{ ?>
    <tr>
        <td colspan='12'>No data</td>
    </tr>
<?php } ?>
</body>
</html>