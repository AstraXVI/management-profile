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

            <?php if($fetch['type'] == 'Image'){ ?>

                <a href='<?php echo $fetch['pic'] ?>' title='Click to download' download><img src="<?php echo $fetch['pic'] ?>" alt="<?php echo $fetch['pic'] ?>" width='100%'></a>

            <?php }else{ ?>

                <div class='my-3'>
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/0/0c/File_alt_font_awesome.svg/1024px-File_alt_font_awesome.svg.png" width='100%'>
                    <a href='<?php echo $fetch['pic'] ?>' title='Click to download' download>
                        <p><?php echo $fetch['name'] ?></p>
                    </a>
                </div>
                
            <?php } ?>
            
        <?php }while($fetch = $list->fetch_assoc()) ?>

    <?php }else{ ?>

        <p>No upload yet</p>

    <?php } ?>
</body>
</html>