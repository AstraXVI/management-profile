<?php
    require "../db.php";

    $id = $_POST['id'];

    $q = "SELECT * FROM award WHERE id='$id'";
    $list = $con->query($q);
    $Info = $list->fetch_assoc();
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
    <input type="hidden" id='profileAwardid' value='<?php echo $id ?>'>
    <!--  -->
    <div class="input-group my-3">
        <span class="input-group-text" id="basic-addon1">Title of award</span>
        <input type="text" id='EditinputAwardTitle' value='<?php echo $Info['title'] ?>' class="form-control" aria-label="Username" aria-describedby="basic-addon1">
    </div>
    <div class="input-group mb-3">
        <label class="input-group-text" for="">Level of award</label>
        <select class="form-select" id='EditinputAwardlvl'>
            <option class='bg-primary' value="<?php echo $Info['lvl'] ?>"><?php echo $Info['lvl'] ?></option>
            <option value="International (Managerial)">International (Managerial)</option>
            <option value="International (Supervisory)">International (Supervisory)</option>
            <option value="International (Technical)">International (Technical)</option>
            <option value="National">National</option>
            <option value="Regional">Regional</option>
            <option value="Division">Division</option>
            <option value="School">School</option>
        </select>
    </div>

    <div class="input-group my-3">
        <span class="input-group-text" id="basic-addon1">Certificate issue date</span>
        <input type="date" id='EditinputAwardDate' value='<?php echo $Info['date'] ?>' class="form-control" aria-label="Username" aria-describedby="basic-addon1">
    </div>

    <div class="input-group mb-3">
        <input type="file" class="form-control" id="EditinputAwardFile">
        <!-- <label class="input-group-text" for="inputGroupFile02">Upload</label> -->
    </div>
</body>
</html>