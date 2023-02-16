<?php
    require "../db.php";
    session_start();

    $schoolName = $_POST['schoolName'];
    $search = $_POST['searchValue'];

    
    $q = "SELECT * FROM equipment WHERE school = '$schoolName' AND ( id LIKE '%$search%' OR code LIKE '%$search%' OR article LIKE '%$search%' OR description LIKE '%$search%' OR date_acquired LIKE '%$search%' OR unit_value LIKE '%$search%' OR total_value LIKE '%$search%' OR source_of_fund LIKE '%$search%' OR status LIKE '%$search%') ORDER BY id DESC";

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
    
    <!-- FOR DELETE AND SEARCH EQUIPMENT -->
    <input type="hidden" value='<?php echo $schoolName ?>' id='schoolNameForDeleteAndSearch'>
    <!--  -->
    
    <?php if($list->num_rows){ ?>
        <?php do{ ?>
            <?php if($fetch['permission'] == "Approve"){ ?>
                <tr>
                    <td><?php echo $fetch['id'] ?></td>
                    <td><?php echo $fetch['code'] ?></td>
                    <td><?php echo $fetch['article'] ?></td>
                    <td><?php echo $fetch['description'] ?></td>
                    <td><?php echo $fetch['date_acquired'] ?></td>
                    <td><?php echo $fetch['unit_value'] ?></td>
                    <td><?php echo $fetch['total_value'] ?></td>
                    <td><?php echo $fetch['source_of_fund'] ?></td>
                    <td><?php echo $fetch['status'] ?></td>
                    <td>

                        <button type="button" title="Edit" class="btn btn-primary btn-sm" value='<?php echo $fetch['id'] ?>' data-bs-toggle="modal" data-bs-target="#editEquipmentModal" id='editEquipmentBtn'><i class="fa-solid fa-pen"></i></button>
                        <!-- <button class="btn btn-danger btn-sm" title="Delete" id='deleteEquipmentBtn' value='<?php echo $fetch['id'] ?>'><i class="fa-solid fa-trash"></i></button> -->
                    </td>
                </tr>
            <?php }else{ ?>
                <tr style="opacity: 0.3; background-color: lightgrey;cursor: not-allowed;" title='Need approval'>
                    <td><?php echo $fetch['id'] ?></td>
                    <td><?php echo $fetch['code'] ?></td>
                    <td><?php echo $fetch['article'] ?></td>
                    <td><?php echo $fetch['description'] ?></td>
                    <td><?php echo $fetch['date_acquired'] ?></td>
                    <td><?php echo $fetch['unit_value'] ?></td>
                    <td><?php echo $fetch['total_value'] ?></td>
                    <td><?php echo $fetch['source_of_fund'] ?></td>
                    <td><?php echo $fetch['status'] ?></td>
                    <td>

                        <button type="button" title="Edit" class="btn btn-primary btn-sm" value='<?php echo $fetch['id'] ?>' data-bs-toggle="modal" data-bs-target="#editEquipmentModal" id='editEquipmentBtn' disabled><i class="fa-solid fa-pen"></i></button>
                        <!-- <button class="btn btn-danger btn-sm" title="Delete" id='deleteEquipmentBtn' value='<?php echo $fetch['id'] ?>'><i class="fa-solid fa-trash"></i></button> -->
                    </td>
                </tr>
            <?php } ?>
        <?php }while($fetch = $list->fetch_assoc()) ?>
    <?php }else{ ?>
        <tr>
            <td colspan='10'>No Data</td>
        </tr>
    <?php } ?>

</body>
</html>