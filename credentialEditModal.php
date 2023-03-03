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
    <!-- id -->
    <input type="hidden" value='<?php echo $id ?>' id='inputCredentialId'>
    <!--  -->
    <div class="mb-3">  
        <label for="formFile" class="form-label">Update Credential</label>
        <input class="form-control" type="file" id="EdituploadCredentialInput">
    </div>

    <div class="input-group mb-3">
        <label class="input-group-text" for="">Type</label>
        <select class="form-select" id='EditinputCredentialType'>
            <option class='bg-primary' value="<?php echo $fetch['type'] ?>"><?php echo $fetch['type'] ?></option>
            <option value="Image">Image</option>
            <option value="File">File</option>
        </select>
    </div>
</body>
</html>