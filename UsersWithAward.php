<?php
    require "db.php";

    $lvl = $_POST['lvl'];

    $q = "SELECT DISTINCT email,lvl FROM `award` WHERE lvl='$lvl'";

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
    <div class=" text-secondary fw-bold p-2 ps-0 mb-3 w-50 h3"><?php echo $lvl ?></div>

    
    <div class="table-responsive md" style="max-height: 480px;">
        <table id='tableToXLS' class='table text-center table-striped'>
            <thead>
                <tr>
                   <th>Name</th>
                   <th>Employee No.</th>
                   <th>Email</th>
                   <th>Contact No.</th>
                   <th>Sex</th>
                   <th>Action</th>
                </tr>

            </thead>
            <tbody>
                <?php if($list->num_rows){ ?>
                    <?php do{ ?>
                        <?php
                            $email = $fetch['email'];
                            $qName = "SELECT * FROM profile WHERE email='$email'";
                            $lName = $con->query($qName);
                            $f = $lName->fetch_assoc();
                        ?>
                        <tr>
                            <td><?php echo $f['name'] ?></td>
                            <td><?php echo $f['employeeNo'] ?></td>
                            <td><?php echo $fetch['email'] ?></td>
                            <td><?php echo $f['contactNo'] ?></td>
                            <td><?php echo $f['sex'] ?></td>
                            <td>
                                <button class='btn btn-primary' value='<?php echo $fetch['email'] ?>' id='viewBtn'>VIEW</button>
                            </td>
                        </tr>
                    <?php }while($fetch = $list->fetch_assoc()) ?>
                <?php }else{ ?>
                    <tr>
                        <td colspan='6' >No data</td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    
  
</body>
</html>