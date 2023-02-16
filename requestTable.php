<?php
    require "db.php";
      
    $q = "SELECT * FROM `equipment` WHERE permission='Deny' ";

    $list = $con->query($q);

    $fetch = $list->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.2.min.js" integrity="sha256-2krYZKh//PcchRtd+H+VyyQoZ/e3EcrkxhM8ycwASPA=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
    <title>Document</title>
</head>
<body>
    
    <div class=" text-secondary fw-bold p-2 ps-0 mb-3 w-25 h3">Request Approval</div>



    <div class="table-responsive" style="max-height: 480px;">
        <table id='tableToXLS' class='table text-center table-striped' placeholder='Search data'>
            <thead>
                <tr>
                    <th>School Name</th>
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
            <tbody>
                <?php if($list->num_rows){ ?>
                    <?php do{ ?>
                        <tr>
                            <td><?php echo $fetch['school'] ?></td>
                            <td><?php echo $fetch['code'] ?></td>
                            <td><?php echo $fetch['article'] ?></td>
                            <td><?php echo $fetch['description'] ?></td>
                            <td><?php echo $fetch['date_acquired'] ?></td>
                            <td><?php echo $fetch['unit_value'] ?></td>
                            <td><?php echo $fetch['total_value'] ?></td>
                            <td><?php echo $fetch['source_of_fund'] ?></td>
                            <td><?php echo $fetch['status'] ?></td>
                            <td class="d-flex gap-1 justify-content-center">
                                <button class='btn btn-info' value='<?php echo $fetch['id'] ?>' id='approveBtn'>APPROVE</button>
                                <button class='btn btn-info' value='<?php echo $fetch['id'] ?>' id='deleteRequestBtn'>DELETE</button>
                            </td>
                        </tr>
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