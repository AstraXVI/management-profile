<?php
    require "../db.php"
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

    <label class='mt-3 mb-2'>Email</label>
    <select id="inputEmailUser" class="form-select mb-3" aria-label="Default select example">

        <?php
            $getSchool = "SELECT email FROM profile";
            $schoolList = $con->query($getSchool);
            $schoolFetch = $schoolList->fetch_assoc();
        ?>

        <?php if($schoolList->num_rows){ ?>
            <?php do{ ?>
                <option value="<?php echo $schoolFetch['email'] ?>"><?php echo $schoolFetch['email'] ?></option>
            <?php }while($schoolFetch = $schoolList->fetch_assoc()) ?>
        <?php } ?>
        
    </select>

    <div class="form-floating mb-3">
        <input type="email" class="form-control" id="inputPassword" placeholder="name@example.com">
        <label>Password</label>
    </div>


    <label class='my-2'>Role</label>
    <select id='inputRole' class="form-select" aria-label="Default select example">
        <option value="Client">Client</option>
        <option value="Admin">Admin</option>
    </select>


    

</body>
</html>