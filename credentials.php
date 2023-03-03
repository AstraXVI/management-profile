<?php
    require "db.php";

    $email = $_POST['email'];

    $q = "SELECT * FROM credential WHERE email='$email'";
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
    <!-- <h4><?php echo $email ?></h4> -->

    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#navCredentialsButton"><i class="fa-solid fa-plus me-2"></i>Upload file</button>

    <div class="bg-light text-center p-3" style="width: 74vw; height: 68vh; overflow: scroll">
        <div class="table-responsive md" style="max-height: 480px;">
            <table class='table text-center table-striped'>
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>File Name</th>
                        <th>Type</th>
                        <th>Action</th>
                    </tr>

                </thead>
                <tbody id="idForSearchOutput">
                    <?php if($list->num_rows){ ?>
                        <?php do{ ?>
                            <tr>
                                <td><?php echo $fetch['id'] ?></td>
                                <td><?php echo $fetch['name'] ?></td>
                                <td><?php echo $fetch['type'] ?></td>
                                <td>
                                    <div class="d-flex gap-1 justify-content-center">
                                        <button title="edit" type="button" id='editCredentialButtonModal' value='<?php echo $fetch['id'] ?>' class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editCredentialModal"><i class="fa-solid fa-pen"></i></button>
                                        <button title="Delete" class="btn btn-danger btn-sm" id='deleteButonCredentialsDb' value='<?php echo $fetch['id'] ?>'><i class="fa-solid fa-trash"></i></button>
                                        <button title="View Equipment" class="btn btn-success btn-sm" id="viewCredentialButtonModal" value='<?php echo $fetch['id'] ?>' data-bs-toggle="modal" data-bs-target="#viewCredentialModal"><i class="fa-solid fa-eye"></i></button>
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
    </div>
    <!-- <div class="bg-light d-flex align-items-center justify-content-center p-3" style="width: 74vw; height: 68vh; overflow: scroll">
        <div class="d-flex gap-4 flex-wrap">
            <?php if($list->num_rows){ ?>
                <?php do{ ?>
                    <img src="<?php echo $fetch['pic'] ?>" alt="<?php echo $fetch['pic'] ?>" width='300px'>
            
                <?php }while($fetch = $list->fetch_assoc()) ?>
            <?php }else{ ?>
                <p>No upload yet</p>
            <?php } ?>
        </div>
    </div> -->
</body>
</html>