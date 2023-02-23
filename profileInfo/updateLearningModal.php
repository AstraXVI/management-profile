<?php
    require "../db.php";

    $id = $_POST['id'];

    // GET Learning
    $q = "SELECT * FROM `learning` WHERE id='$id'";
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
    <!-- get id and email-->
    <input type="hidden" id='learnerIdUser' value="<?php echo $id ?>">
    <input type="hidden" id='learnerEmailUser' value="<?php echo $Info["email"] ?>">
    <!--  -->
    <div class="input-group mb-3">
        <span class="input-group-text" style="font-size: 14px;" id="inputGroup-sizing-default">Title of Learning and Development Intervention/Training Program (Write in full)</span>
        <input type="text" class="form-control" value='<?php echo $Info['title'] ?>' id="EditlearningAndDevelopmentTitle" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
    </div>
    <label class="mb-2">Inclusive Dates of Attendance</label>
    <br>
    <div class="d-flex gap-4">
        <div class="input-group mb-3">
            <span class="input-group-text" id="inputGroup-sizing-default">From</span>
            <input type="date" class="form-control" value='<?php echo $Info['dateFrom'] ?>' id="EditlearningAndDevelopmentDateFrom" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="inputGroup-sizing-default">To</span>
            <input type="date" class="form-control" value='<?php echo $Info['dateTo'] ?>' id="EditlearningAndDevelopmentDateTo" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
        </div>
    </div>

    <div class="input-group mb-3">
        <span class="input-group-text" id="inputGroup-sizing-default">Number of Hours</span>
        <input type="text" class="form-control" value='<?php echo $Info['hours'] ?>' id="EditlearningAndDevelopmentHours" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
    </div>

    <div class="input-group mb-3">
        <span class="input-group-text" id="inputGroup-sizing-default">Type of LD (Managerial/supervisory/technical/etc)</span>
        <input type="text" class="form-control" value='<?php echo $Info['typeOfLd'] ?>' id="EditlearningAndDevelopmentLD" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
    </div>

    <div class="input-group mb-3">
        <span class="input-group-text" id="inputGroup-sizing-default">Conducted/Sponsored by (Write in full)</span>
        <input type="text" class="form-control" value='<?php echo $Info['conducted'] ?>' id="EditlearningAndDevelopmentConducted" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
    </div>
</body>
</html>