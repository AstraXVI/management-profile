<?php
    require "db.php";

    session_start();

    $school = $_SESSION['school'];
        
    $q = "SELECT * FROM `equipment` WHERE school='$school' ORDER BY id DESC";

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
    <!-- <h1 class="text-center"><?php echo strtoupper($school) ?></h1> -->
    <div class=" text-secondary fw-bold p-2 ps-0 mb-3 w-75 h3"><?php echo ucwords($school) ?></div>
    <!-- <button type="button" class="btn btn-primary mb-3 mt-2" data-bs-toggle="modal" data-bs-target="#addEquipmentModal">Add Equipment</button> -->




    <div class="d-flex align-items-center justify-content-between mb-3 mt-4 position-relative">
        
        <div class="d-flex align-items-center gap-2">
            <input id='searchEquipmentInput' class="form-control form-control-sm fs-17 py-2 ps-5" style="border: 2px solid grey; border-radius: 100vmax; width: 320px;"  type="text" placeholder='Search Data'
            aria-label="Search">
            <div style="position: absolute; top: 8px; left: 15px; z-index: 1;">
                <i class="fas fa-search fs-5 text-secondary" aria-hidden="true"></i>
            </div>
        </div>

        <div class="d-flex gap-3">
            <button id='excelBtn' class="btn btn-success w-auto"><i class="fa-solid fa-file-arrow-down pe-2"></i>Download Excel</button>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addEquipmentModal"><i class="fa-solid fa-plus pe-2"></i>Add Equipment</button>
        </div>

    </div>



    <!-- FOR DELETE AND SEARCH EQUIPMENT -->
    <input type="hidden" value='<?php echo $school ?>' id='schoolNameForDeleteAndSearch'>
    <!--  -->


    <div class="table-responsive" style="max-height: 480px;">
        <table id='tableToXLS' class='table text-center ' placeholder='Search data'>
            <thead>
                <tr>
                    <th>Item No.</th>
                    <th>Code</th>
                    <th>Article</th>
                    <th>Description</th>
                    <th>Date Acquired</th>
                    <th>Unit Value</th>
                    <th>Total Value</th>
                    <th>Source of Funds</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id='equipmentTableTbody'>
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
                            <tr style="opacity: 0.3; background-color: #E78587;cursor: not-allowed;" title='Need approval'>
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
            </tbody>
        </table>
    </div>
</body>
</html>