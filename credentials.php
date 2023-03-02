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
    <h4><?php echo $email ?></h4>

    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#navCredentialsButton">Upload file</button>

    <div class="bg-light d-flex align-items-center justify-content-center" style="width: 74vw; height: 68vh;">
        <div class="d-flex gap-4 flex">
            <?php if($list->num_rows){ ?>
                <?php do{ ?>
                    <a href='<?php echo $fetch['pic'] ?>' title='Click to download' download><img src="<?php echo $fetch['pic'] ?>" alt="<?php echo $fetch['pic'] ?>" width='100%'></a>
            
                <?php }while($fetch = $list->fetch_assoc()) ?>
            <?php }else{ ?>
                <p>No upload yet</p>
            <?php } ?>
        </div>
    </div>
</body>
</html>