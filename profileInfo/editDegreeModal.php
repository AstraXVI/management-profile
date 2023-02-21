<?php
    require "../db.php";

    $id = $_POST['id'];

    $q = "SELECT * FROM educationaldegree WHERE id='$id'";
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
    <!-- get id  and email-->
    <input type="hidden" id='editDegreeUserEmail' value='<?php echo $id ?>'>
    <input type="hidden" id='editDegreeUserId' value='<?php echo $fetch['email'] ?>'>
    <!--  -->
    <!-- <label>Select Degree</label>
    <select class="form-select mb-2" id='inputEditDegreeDegree' aria-label="Default select example">
        <option class='bg-primary' value="<?php echo $fetch['lvl'] ?>"><?php echo $fetch['lvl'] ?></option>
        <option value="Masters Degree">Masters Degree</option>
        <option value="Post Degree">Post Degree</option>
    </select> -->

    <div class="input-group mb-3">
        <span class="input-group-text">Select Degree</span>
        <select class="form-select" id='inputEditDegreeDegree' aria-label="Default select example">
            <option class='bg-primary' value="<?php echo $fetch['lvl'] ?>"><?php echo $fetch['lvl'] ?></option>
            <option value="Masters Degree">Masters Degree</option>
            <option value="Post Degree">Post Degree</option>
        </select>
    </div>

    <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1">Name of School</span>
        <input type="text" id='inputEditDegreeSchool' value="<?php echo $fetch['nameSchool'] ?>" class="form-control"  aria-label="Username" aria-describedby="basic-addon1">
    </div>
    <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1">Basic Education/Degree/Course</span>
        <input type="text" id='inputEditDegreeEduc' value="<?php echo $fetch['education'] ?>" class="form-control"  aria-label="Username" aria-describedby="basic-addon1">
    </div>
    <label class='mb-2'>Period of attendance</label>
    <br>
    <div class="d-flex gap-4">
        <div class="input-group mb-3">
            <span class="input-group-text">From</span>
            <input type="date" class="form-control" value="<?php echo $fetch['periodFrom'] ?>" id='inputEditDegreeFrom' aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="inputGroup-sizing-default">To</span>
            <input type="date" class="form-control" value="<?php echo $fetch['periodTo'] ?>" id='inputEditDegreeTo' aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
        </div>
    </div>

    <!-- <label>From :</label>
    <input type="date" name="" value="<?php echo $fetch['periodFrom'] ?>" id='inputEditDegreeFrom'>
    <label>To:</label>
    <input type="date" name="" value="<?php echo $fetch['periodTo'] ?>" id='inputEditDegreeTo'> -->

    <div class="input-group my-3">
        <span class="input-group-text" id="basic-addon1">Highest Level/Unit Earned</span>
        <input type="text" id='inputEditDegreeHigh' value="<?php echo $fetch['highLvl'] ?>" class="form-control" aria-label="Username" aria-describedby="basic-addon1">
    </div>
    <div class="input-group my-3">
        <span class="input-group-text" id="basic-addon1">Year Graduate</span>
        <input type="text" id='inputEditDegreeYear' value="<?php echo $fetch['year'] ?>" class="form-control" aria-label="Username" aria-describedby="basic-addon1">
    </div>
    <div class="input-group my-3">
        <span class="input-group-text" id="basic-addon1">Scholarship/Academic Honors Received</span>
        <input type="text" id='inputEditDegreeScholar' value="<?php echo $fetch['scholar'] ?>" class="form-control" aria-label="Username" aria-describedby="basic-addon1">
    </div>
</body>
</html>