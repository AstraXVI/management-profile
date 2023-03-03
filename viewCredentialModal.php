<?php
    require "db.php";

    $id = $_POST['id'];

    $q = "SELECT * FROM credential WHERE id='$id'";
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
    <?php if($fetch['type'] == 'Image'){ ?>
        <img src="<?php echo $fetch['pic'] ?>" alt="" width='100%'>
    <?php }else{ ?>
        <p>The file is automatic download to see</p>
        <iframe src="<?php echo $fetch['pic'] ?>"></iframe>
    <?php } ?>
</body>
</html>