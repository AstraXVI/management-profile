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

    <?php if($list->num_rows){ ?>

        <?php do{ ?>

            <img src="<?php echo $fetch['pic'] ?>" alt="<?php echo $fetch['pic'] ?>" width='100%'>
            
        <?php }while($fetch = $list->fetch_assoc()) ?>

    <?php }else{ ?>

        <p>No upload yet</p>

    <?php } ?>
</body>
</html>