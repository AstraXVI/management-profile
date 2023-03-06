<?php
    require "../db.php";

    $id = $_POST['id'];

    $q = "SELECT * FROM award WHERE id='$id'";
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
    <?php
        $file_location = $fetch['pic'];

        // Get the file extension
        $file_extension = strtolower(pathinfo($file_location, PATHINFO_EXTENSION));
        
        // Check if it's an image file
        $image_extensions = array("jpg", "jpeg", "png", "gif", "bmp" , "webp");
    ?>


    <?php if (in_array($file_extension, $image_extensions)) { ?>
        <!-- <p>img</p> -->
        <!-- <?php echo $fetch['pic'] ?> -->
        <img src="profileInfo/<?php echo $fetch['pic'] ?>" alt="" width='100%'>
    <?php } else { ?>
        <?php
            $file_location = $fetch['pic'];
            $file_name = str_replace("uploads/", "", $file_location);
            
            ?>

        <?php if($fetch['pic'] == 'uploads/credentials'){ ?>
            <p>No file upload</p>
        <?php }else{ ?>

            <!-- <p>file</p> -->
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/0/0c/File_alt_font_awesome.svg/1024px-File_alt_font_awesome.svg.png" alt="" width='100%'>
            <a href="profileInfo/<?php echo $fetch['pic'] ?>" download><?php echo $file_name ?></a>
        <?php } ?>

    <?php } ?>

</body>
</html>