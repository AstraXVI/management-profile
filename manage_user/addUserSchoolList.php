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

    <div class="form-floating mb-3">
        <input type="email" class="form-control" id="inputEmailUser" placeholder="name@example.com">
        <label>Email</label>
    </div>
    <div class="form-floating mb-3">
        <input type="email" class="form-control" id="inputPassword" placeholder="name@example.com">
        <label>Password</label>
    </div>


    <label class='my-2'>Role</label>
    <select id='inputRole' class="form-select" aria-label="Default select example">
        <option value="Client">Client</option>
        <option value="Admin">Admin</option>
    </select>


    <label class='mt-3 mb-2'>School</label>
    <select id='inputSchool' class="form-select" aria-label="Default select example">

        <?php
            $getSchool = "SELECT school_name FROM schools";
            $schoolList = $con->query($getSchool);
            $schoolFetch = $schoolList->fetch_assoc();
        ?>

        <?php if($schoolList->num_rows){ ?>
            <?php do{ ?>
                <option value="<?php echo $schoolFetch['school_name'] ?>"><?php echo $schoolFetch['school_name'] ?></option>
            <?php }while($schoolFetch = $schoolList->fetch_assoc()) ?>
        <?php } ?>
        
    </select>

</body>
</html>