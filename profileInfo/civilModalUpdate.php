<?php
    require "../db.php";

    $id = $_POST['id'];

    $q = "SELECT * FROM civil WHERE id='$id'";
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
    <!-- ID AND EMAIL -->
    <input type="hidden" value='<?php echo $id ?>' id='idForCivilUpdate'>
    <input type="hidden" value='<?php echo $fetch['email'] ?>' id='emailForCivilUpdate'>
    <!--  -->
    <div class="input-group mb-3">
        <span class="input-group-text">Career Service</span>
        <input type="text" class="form-control" id="EditcivilInputCareer" value="<?php echo $fetch['careerService'] ?>" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
    </div>

    <div class="input-group mb-3">
        <span class="input-group-text">Rating</span>
        <input type="text" class="form-control" id="EditcivilInputRating" value="<?php echo $fetch['rating'] ?>" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
    </div>

    <div class="input-group mb-3">
        <span class="input-group-text">Date of Examination</span>
        <input type="date" class="form-control" id="EditcivilDateExam" value="<?php echo $fetch['dateOfExam'] ?>" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
    </div>

    <div class="input-group mb-3">
        <span class="input-group-text">Place of Examination</span>
        <input type="text" class="form-control" id="EditcivilPlaceExam" value="<?php echo $fetch['placeOfExam'] ?>" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
    </div>

    <label class="d-block text-center text-secondary">License (if applicable)</label>
    <br>
    <!-- <input type="text" id='civilDate' placeholder='Number'> -->
    <div class="input-group mb-3">
        <span class="input-group-text">Number</span>
        <input type="text" class="form-control" id="EditcivilNumber" value="<?php echo $fetch['licenseNumber'] ?>" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
    </div>
    <div class="input-group mb-3">
        <span class="input-group-text">Date of Validity</span>
        <input type="text" class="form-control" id="EditcivilDate" value="<?php echo $fetch['licenseDateOfValidity'] ?>" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
    </div>
    <!-- <input type="text" id='civilNumber' placeholder='Date of Validity'> -->
</body>
</html>