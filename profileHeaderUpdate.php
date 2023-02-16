<?php
    require "db.php";

    $id = $_POST['id'];

    $q = "SELECT * from users where id='$id'";
    $list = $con->query($q);
    $info = $list->fetch_assoc();
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
    <img src="<?php echo $info['picture'] ?>" alt="" style='width:30px;height:30px;border: 3px solid white ;border-radius: 100vmax; margin-right: 7px;'>
</body>
</html>