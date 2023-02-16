<?php
    require "db.php";

    $id = $_POST['id'];

    $q = "SELECT * FROM profile WHERE id='$id'";

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
    <input type="hidden" value='<?php echo $fetch['id'] ?>' id='profilePictureId'>
    <input class="form-control" type="file" id="profileUploadedPicture">
</body>
</html>