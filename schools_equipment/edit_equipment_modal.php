<?php
    require "../db.php";

    $id = $_POST['id'];

    $q = "SELECT * FROM `equipment` WHERE id='$id'";

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
    <!-- For update -->
    <input type="hidden" id='updateIdEquipment' value='<?php echo $fetch['id'] ?>'>
    <input type="hidden" id='updateSchoolNameEquipment' value='<?php echo $fetch['school'] ?>'>
    <!--  -->
    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="inputCodeEdit" value="<?php echo $fetch['code'] ?>" placeholder="School Name">
        <label>Code</label>
    </div>
    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="inputArticleEdit" value="<?php echo $fetch['article'] ?>" placeholder="School Name">
        <label>Article</label>
    </div>
    <div class="form-floating mb-3">
        <input type="text" class="form-control" value="<?php echo $fetch['description'] ?>" id="inputDescriptionEdit" placeholder="School Name">
        <label>Description</label>
    </div>
    <div class="form-floating mb-3">
        <input type="text" class="form-control" value="<?php echo $fetch['date_acquired'] ?>" id="inputDateEdit" placeholder="School Name">
        <label>Date Acquired</label>
    </div>
    <div class="form-floating mb-3">
        <input type="text" class="form-control" value="<?php echo $fetch['unit_value'] ?>" id="inputUnitValueEdit" placeholder="School Name">
        <label>Unit Value</label>
    </div>
    <div class="form-floating mb-3">
        <input type="text" class="form-control" value="<?php echo $fetch['total_value'] ?>" id="inputTotalValueEdit" placeholder="School Name">
        <label>Total Value</label>
    </div>
    <div class="form-floating mb-3">
        <input type="text" class="form-control" value="<?php echo $fetch['source_of_fund'] ?>" id="inputSourceOfFundsEdit" placeholder="School Name">
        <label>Source of Funds</label>
    </div>

    <label class='ps-1'>Status</label>
    <select id='inputStatusEdit' class="form-select" aria-label="Default select example">
        <option class='bg-primary' value="<?php echo $fetch['status'] ?>"><?php echo $fetch['status'] ?></option>
        <option value="Working">Working</option>
        <option value="Condemned">Condemned</option>
        <option value="Need Repair">Need repair</option>
    </select>
</body>
</html>