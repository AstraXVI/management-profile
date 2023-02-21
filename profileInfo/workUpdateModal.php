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
    <div class="input-group mb-3">
        <span class="input-group-text" id="inputGroup-sizing-default">Position Title (Write in full/ Do not abbreviate)</span>
        <input type="text" value='<?php echo $fetch['title'] ?>' class="form-control" id="EditworkExpPosition" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
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

    <div class="input-group mb-3">
        <span class="input-group-text" id="inputGroup-sizing-default">Gov't Service (Y/N)</span>
        <input type="text" value='<?php echo $fetch['govService'] ?>' class="form-control" id="EditworkExpService" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
    </div>
</body>
</html>