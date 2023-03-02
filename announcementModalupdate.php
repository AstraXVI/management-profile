<?php
    require "db.php";

    $id = $_POST['id'];
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
    
    <!-- get id -->
    <input type="hidden" value='<?php echo $id ?>' id='announcementId'>
    <!--  -->

    <div class="input-group mb-3">
        <input type="file" class="form-control" id="inputEditAnnouncementFile">
    </div>
</body>
</html>