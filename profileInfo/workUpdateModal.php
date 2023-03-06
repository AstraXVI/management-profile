<?php
    require "../db.php";

    $id = $_POST['id'];

    $q = "SELECT * FROM work WHERE id='$id'";

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
    <!-- ID -->
    <input type="hidden" value='<?php echo $id ?>' id='workUserId'>
    <!--  -->
    <label class="mb-2">INCLUSIVE DATES</label>
    <br>
    <div class="d-flex gap-4">
        <div class="input-group mb-3">
            <span class="input-group-text" id="inputGroup-sizing-default">From</span>
            <input type="date" class="form-control" value='<?php echo $fetch['dateFrom'] ?>' id="EditworkExpDateFrom" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="inputGroup-sizing-default">To</span>
            <input type="date" class="form-control" value='<?php echo $fetch['dateTo'] ?>' id="EditworkExpDateTo" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
        </div>
    </div>
    <!-- <div class="input-group mb-3">
        <span class="input-group-text" id="inputGroup-sizing-default">Position Title (Write in full/ Do not abbreviate)</span>
        <input type="text" value='<?php echo $fetch['title'] ?>' class="form-control" id="EditworkExpPosition" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
    </div> -->
    <div class="input-group mb-3">
        <label class="input-group-text" for="">Position Category</label>
        <select class="form-select" id="EditworkExpPositionLvl">
            <option class='bg-primary' value="<?php echo $fetch['positionLvl'] ?>"><?php echo $fetch['positionLvl'] ?></option>
            <option value="School Administrator">School Administrator</option>
            <option value="Teaching Personnel">Teaching Personnel</option>
        </select>
    </div>

    <div class="input-group mb-3">
        <label class="input-group-text" for="">Position Title (Write in full/ Do not abbreviate)</label>
        <select class="form-select" id="EditworkExpPosition">
           <option class='bg-primary' value="<?php echo $fetch['title'] ?>"><?php echo $fetch['title'] ?></option>

            <?php if($fetch['positionLvl'] == 'School Administrator'){ ?>
                <option value='Head Teacher I'>Head Teacher I</option>
                <option value='Head Teacher II'>Head Teacher II</option>
                <option value='Head Teacher II'>Head Teacher III</option>
                <option value='Head Teacher IV'>Head Teacher IV</option>
                <option value='Head Teacher V'>Head Teacher V</option>
                <option value='Head Teacher VI'>Head Teacher VI</option>
                <option value='School Head I'>School Head I</option>
                <option value='School Head II'>School Head II</option>
                <option value='School Head III'>School Head III</option>
                <option value='School Head IV'>School Head IV</option>
                <option >Other Admin Roles (Please Specify)</option>
            <?php }else{ ?>
                <option value='Teacher I'>Teacher I</option>
                <option value='Teacher II'>Teacher II</option>
                <option value='Teacher III'>Teacher III</option>
                <option value='Master Teacher I'>Master Teacher I</option>
                <option value='Master Teacher II'>Master Teacher II</option>
                <option value='Master Teacher III'>Master Teacher III</option>
            <?php } ?>
           
        </select>
    </div>

    <div class="input-group mb-3">
        <span class="input-group-text" id="inputGroup-sizing-default">Department/Agency/Office/Company (Write in full/ Do not abbreviate)</span>
        <input type="text" value='<?php echo $fetch['department'] ?>' class="form-control" id="EditworkExpDepartment" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
    </div>

    <div class="input-group mb-3">
        <span class="input-group-text" id="inputGroup-sizing-default">Monthly Salary</span>
        <input type="text" value='<?php echo $fetch['monthSalary'] ?>' class="form-control" id="EditworkExpSalary" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
    </div>

    <div class="input-group mb-3">
        <span class="input-group-text" id="inputGroup-sizing-default">Salary/Job/Pay Grade (if applicable)</span>
        <input type="text" value='<?php echo $fetch['salary'] ?>' class="form-control" id="EditworkExpJob" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
    </div>

    <div class="input-group mb-3">
        <span class="input-group-text" id="inputGroup-sizing-default">Status of Appointment</span>
        <input type="text" value='<?php echo $fetch['statusApointment'] ?>' class="form-control" id="EditworkExpStatus" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
    </div>

    <!-- <div class="input-group mb-3">
        <span class="input-group-text" id="inputGroup-sizing-default">Gov't Service (Y/N)</span>
        <input type="text" value='<?php echo $fetch['govService'] ?>' class="form-control" id="EditworkExpService" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
    </div> -->

    <div class="input-group mb-3">
        <label class="input-group-text" for="">Gov't Service (Y/N)</label>
        <select class="form-select" id="EditworkExpService">
            <option class="bg-primary" value='<?php echo $fetch['govService'] ?>'><?php echo $fetch['govService'] ?></option>
            <option value="Yes">Yes</option>
            <option value="No">No</option>
        </select>
    </div>
</body>
</html>