<?php
    require "db.php";

    $userId = $_POST['id'];

    $getUserInfo = "SELECT * FROM profile WHERE id='$userId'";
    $userInfo = $con->query($getUserInfo);
    $fetchUserInfo = $userInfo->fetch_assoc();
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
    <!-- GET ID -->
    <input type="hidden" id='idEditSchool' value='<?php echo $fetchUserInfo['id'] ?>'>
    <!--  -->
<div class="form-floating mb-3">
        <input type="text" class="form-control" id="inputNameEdited" placeholder="Name" value="<?php echo $fetchUserInfo['name'] ?>">
        <label for="floatingInput">Name</label>
    </div>
    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="inputBirthDayEdited" placeholder="Name" value="<?php echo $fetchUserInfo['bday'] ?>">
        <label for="floatingInput">Birthday</label>
    </div>
    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="inputAddressEdited" placeholder="Name" value="<?php echo $fetchUserInfo['address'] ?>">
        <label for="floatingInput">Address</label>
    </div>
    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="inputEmailEdited" placeholder="Name" value="<?php echo $fetchUserInfo['email'] ?>">
        <label for="floatingInput">Deped Email</label>
    </div>
    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="inputContactEdited" placeholder="Name" value="<?php echo $fetchUserInfo['contactNo'] ?>">
        <label for="floatingInput">Contact No.</label>
    </div>
    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="inputSexEdited" placeholder="Name" value="<?php echo $fetchUserInfo['sex'] ?>">
        <label for="floatingInput">Sex</label>
    </div>
    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="inputYearAsSchoolHeadEdited" placeholder="Name" value="<?php echo $fetchUserInfo['yearAsSchoolHead'] ?>">
        <label for="floatingInput">Year as Schoolhead</label>
    </div>
    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="inputDurationYearEdited" placeholder="Name" value="<?php echo $fetchUserInfo['duration'] ?>">
        <label for="floatingInput">Duration year of stay</label>
    </div>
    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="inputLearningPerformanceEdited" placeholder="Name" value="<?php echo $fetchUserInfo['learnersPerf'] ?>">
        <label for="floatingInput">Learners Performance</label>
    </div>
    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="inputTeacherPerformanceEdited" placeholder="Name" value="<?php echo $fetchUserInfo['teacherPerf'] ?>">
        <label for="floatingInput">Teacher Performance</label>
    </div>
    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="inputFinancialMngEdited" placeholder="Name" value="<?php echo $fetchUserInfo['financialMng'] ?>">
        <label for="floatingInput">Financial Management</label>
    </div>
    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="inputComplaintsEdited" placeholder="Name" value="<?php echo $fetchUserInfo['complaints'] ?>">
        <label for="floatingInput">Complaints</label>
    </div>
</body>
</html>