<?php 
    require "db.php";

    $q = "SELECT * FROM announcement";
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
    <div class=" text-secondary fw-bold p-2 ps-0 mb-3 w-50 h3">Announcements</div>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#announcementModal">Add anouncement</button>

    <div class="bg-light" style="width: 74vw; height: 60vh;">

        <table class='table text-center'>
            <thead>
                <tr>
                    <td>id</td>
                    <td>Name</td>
                    <td>Action</td>
                </tr>
            </thead>
            <tbody id='announcemenTableTBody'>
                <?php if($list->num_rows){ ?>
                    <?php do{ ?>
                        <tr>
                            <td><?php echo $fetch['id'] ?></td>
                            <td><?php echo $fetch['name'] ?></td>
                            <td>
                                <button class='btn btn-primary text-light' value="<?php echo $fetch['id'] ?>"><i class="fa-solid fa-pen"></i></button>
                                <button class='btn btn-danger text-light' value="<?php echo $fetch['id'] ?>"><i class="fa-solid fa-trash"></i></button>
                            </td>
                        </tr>
                    <?php }while($fetch = $list->fetch_assoc()) ?>
                <?php }else{ ?>
                    <tr>
                        <td colspan='3'>No announcement</td>
                    </tr>
                <?php } ?>
            </tbody>

        </table>
    </div>
</body>
</html>