<?php
    require "db.php";

    $school = $_POST['school'];

    $q = "SELECT * FROM dor WHERE school_name='$school'";

    $list = $con->query($q);
    $fetchInfo = $list->fetch_assoc();


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
    <!-- get school name -->
    <input type="hidden" value='<?php echo $school ?>' id='schoolNameDor'>
    <!--  -->

    <h3><?php echo $school ?></h3>
    <?php if($list->num_rows){ ?>

        <?php do{ ?>

            <img src="<?php echo $fetchInfo['dor_pics'] ?>" style='width:90%;margin: auto'>

        <?php }while($fetchInfo = $list->fetch_assoc()) ?>

    <?php }else{ ?>
        <p>No Uploaded files.</p>
    <?php } ?>





</body>
</html>