<?php
    require "db.php";

    $q = "SELECT * FROM `schools` ORDER BY id DESC";

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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
</head>
<body>
    <div class=" text-secondary fw-bold p-2 ps-0 mb-3 w-25 h3">Registered School</div>
    <div class="d-flex align-items-center justify-content-between mb-3 mt-4 position-relative">
        <div class="d-flex align-items-center gap-4">
            <input id='searchBar' class="form-control form-control-sm fs-17 py-2 ps-5" style="border: 2px solid grey; border-radius: 100vmax; width: 350px;" type="text" placeholder='Search School'
            aria-label="Search">
            <div style="position: absolute; top: 8px; left: 15px; z-index: 1;">
                <i class="fas fa-search fs-5 text-secondary" aria-hidden="true"></i>
            </div>


            <select class="form-select w-50" style="border: 2px solid grey" aria-label="Default select example" id='selectDisctrictFilter'>
                <option value="Default">Select District</option>
                <option value="Congressional I">Congressional I</option>
                <option value="Congressional II">Congressional II</option>
                <option value="South">South</option>
                <option value="North">North</option>
                <option value="East">East</option>
                <option value="Central">Central</option>
            </select>
        </div>
        <div class="d-flex gap-3">
            <button id='excelBtn' class='btn btn-success '><i class="fa-solid fa-file-arrow-down pe-2"></i>Download Excel</button>
            <button type="button" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#addSchool"><i class="fa-solid fa-plus pe-2"></i>Add School</button>
        </div>
    </div>
    <div class="table-responsive md" style="max-height: 480px;">
        <table id='tableToXLS' class='table text-center table-striped'>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>School Name</th>
                    <th>School ID</th>
                    <th>Division</th>
                    <th>School type</th>
                    <th>Contact Person</th>
                    <th>Contact No.</th>
                    <th>Email</th>
                    <th>District</th>
                    <th>School Level</th>
                    <th>DOR</th>
                    <th colspan='3'>Action</th>
                </tr>

            </thead>
            <tbody id="idForSearchOutput">
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
                                    <button title="edit" type="button" id='editBtn' value='<?php echo $fetch['id'] ?>' class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editSchool"><i class="fa-solid fa-pen"></i></button>
                                    <button title="Delete" class="btn btn-danger btn-sm" id='deleteBtn' value='<?php echo $fetch['id'] ?>'><i class="fa-solid fa-trash"></i></button>
                                    <button title="View Equipment" class="btn btn-success btn-sm" id="viewBtn" value='<?php echo $fetch['school_name'] ?>'><i class="fa-solid fa-eye"></i></button>
                                </div>
                            </td>
                        </tr>
                    <?php }while($fetch = $list->fetch_assoc()) ?>
                <?php }else{ ?>
                    <tr>
                        <td colspan='12'>No data</td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    
  
</body>
</html>