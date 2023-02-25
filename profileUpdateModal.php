<?php
    require "db.php";
    session_start();

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
    <!-- <div class="form-floating mb-3">
        <input type="text" class="form-control" id="inputNameEdited" placeholder="Name" value="<?php echo $fetchUserInfo['name'] ?>">
        <label for="floatingInput">Fullname</label>
    </div> -->
    <div class="input-group mb-3">
        <span class="input-group-text">Employee No.</span>
        <input type="text" class="form-control" id="inputEmployeeNoEdit" value="<?php echo $fetchUserInfo['employeeNo'] ?>" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
    </div>

    <div class="d-flex">
        <div class="input-group mb-3">
            <span class="input-group-text">Fullname</span>
            <input type="text" class="form-control" id="inputNameEdited" value="<?php echo $fetchUserInfo['name'] ?>" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text">Date of Birth</span>
            <input type="date" class="form-control" id="inputBirthDayEdited" value="<?php echo $fetchUserInfo['bday'] ?>" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
        </div>
    </div>

    <!-- <div class="form-floating mb-3">
        <input type="text" class="form-control" id="inputBirthDayEdited" placeholder="Name" value="<?php echo $fetchUserInfo['bday'] ?>">
        <label for="floatingInput">Date of Birth</label>
    </div> -->
    <div class="d-flex">
        <div class="input-group mb-3">
            <span class="input-group-text">Place of Birth</span>
            <input type="text" class="form-control" id="inputPlaceOfBirthEdit" value='<?php echo $fetchUserInfo['placeBirth'] ?>' aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
        </div>
        <div class="input-group mb-3">
            <label class="input-group-text" for="">Citizenship</label>
            <select class="form-select" id="inputCitizenEdit" value="di ayos">
                <option value='<?php echo $fetchUserInfo['citizenship'] ?>'><?php echo $fetchUserInfo['citizenship'] ?></option>
                <option value="filipino">Filipino</option>
                <option value="dual_citizenship">Dual Citizenship</option>
            </select>
        </div>
    </div>

    <div class="d-flex">
        <div class="input-group mb-3">
        <label class="input-group-text" for="inputSexEdited">Sex</label>
            <select class="form-select" id="inputSexEdited" value="<?php echo $fetchUserInfo['sex'] ?>">
                <option value="male">Male</option>
                <option value="female">Female</option>
            </select>
        </div>
        <div class="input-group mb-3">
        <label class="input-group-text" for="">Civil Status</label>
            <select class="form-select" id="inputCivilStatusEdit">
                <option value='<?php echo $fetchUserInfo['civil'] ?>'><?php echo $fetchUserInfo['civil'] ?></option>
                <option value="single">Single</option>
                <option value="married">Married</option>
                <option value="separated">Separated</option>
                <option value="widowed">Widowed</option>
                <option value="others">others</option>
            </select>
        </div>
    </div>

    <!-- <div class="form-floating mb-3">
        <input type="text" class="form-control" id="inputAddressEdited" placeholder="Name" value="<?php echo $fetchUserInfo['address'] ?>">
        <label for="floatingInput">Residential Address</label>
    </div> -->

    <div class="d-flex">
        <div class="input-group mb-3 w-75">
            <span class="input-group-text">Residential Address</span>
            <input type="text" class="form-control" id="inputAddressEdited" value="<?php echo $fetchUserInfo['address'] ?>" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
        </div>
        <div class="input-group mb-3 w-25">
            <span class="input-group-text">Zip Code</span>
            <input type="text" class="form-control" style="" id="inputZipcodeEdit" value="<?php echo $fetchUserInfo['zipcode'] ?>" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
        </div>

    </div>

    <!-- <div class="form-floating mb-3">
        <input type="text" class="form-control" id="inputEmailEdited" placeholder="Name" value="<?php echo $fetchUserInfo['email'] ?>">
        <label for="floatingInput">Deped Email</label>
    </div> -->

    <div class="input-group mb-3">
        <span class="input-group-text">Deped Email</span>
        <input type="text" class="form-control" id="inputEmailEdited" value="<?php echo $fetchUserInfo['email'] ?>" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" disabled>
    </div>

    <!-- <div class="form-floating mb-3">
        <input type="text" class="form-control" id="inputContactEdited" placeholder="Name" value="<?php echo $fetchUserInfo['contactNo'] ?>">
        <label for="floatingInput">Contact No.</label>
    </div> -->

    <div class="input-group mb-3">
        <span class="input-group-text">Contact No.</span>
        <input type="text" class="form-control" id="inputContactEdited" value="<?php echo $fetchUserInfo['contactNo'] ?>" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
    </div>
    <!-- <div class="form-floating mb-3">
        <input type="text" class="form-control" id="inputSexEdited" placeholder="Name" value="<?php echo $fetchUserInfo['sex'] ?>">
        <label for="floatingInput">Sex</label>
    </div> -->

    

    


    <!-- <div class="form-floating mb-3">
        <input type="text" class="form-control" id="inputYearAsSchoolHeadEdited" placeholder="Name" value="<?php echo $fetchUserInfo['yearAsSchoolHead'] ?>">
        <label for="floatingInput">Year as Schoolhead</label>
    </div> -->

    <div class="input-group mb-3">
        <span class="input-group-text">Year as Schoolhead</span>
        <input type="text" class="form-control" id="inputYearAsSchoolHeadEdited" value="<?php echo $fetchUserInfo['yearAsSchoolHead'] ?>" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
    </div>

    <!-- <div class="form-floating mb-3">
        <input type="text" class="form-control" id="inputDurationYearEdited" placeholder="Name" value="<?php echo $fetchUserInfo['duration'] ?>">
        <label for="floatingInput">Duration year of stay</label>
    </div> -->

    <?php if($_SESSION['status'] == 'Admin'){ ?>
        <div class="d-flex">
            <div class="input-group mb-3">
                <span class="input-group-text">Learner Performance</span>
                <input type="text" class="form-control" id="inputLPerformanceEdit" value="<?php echo $fetchUserInfo['learnersPerf'] ?>" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text">Teacher Performance</span>
                <input type="text" class="form-control" id="inputTPerformanceEdit" value="<?php echo $fetchUserInfo['teacherPerf'] ?>" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
            </div>
        </div>
        <div class="d-flex">
            <div class="input-group mb-3">
                <span class="input-group-text">Financial Management</span>
                <input type="text" class="form-control" id="inputFinanceMngEdit" value="<?php echo $fetchUserInfo['financialMng'] ?>" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text">Duration year of stay</span>
                <input type="text" class="form-control" id="inputDurationYearEdited" value="<?php echo $fetchUserInfo['duration'] ?>" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
            </div>
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text">Complaints</span>
            <input type="text" class="form-control" id="inputComplaintsEdit" value="<?php echo $fetchUserInfo['complaints'] ?>" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
        </div>
    <?php } ?>
    <!-- <div class="form-floating mb-3">
        <input type="text" class="form-control" id="inputLearningPerformanceEdited" placeholder="Name" value="<?php echo $fetchUserInfo['learnersPerf'] ?>" >
        <label for="floatingInput">Learners Performance</label>
    </div>
    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="inputTeacherPerformanceEdited" placeholder="Name" value="<?php echo $fetchUserInfo['teacherPerf'] ?>" >
        <label for="floatingInput">Teacher Performance</label>
    </div>
    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="inputFinancialMngEdited" placeholder="Name" value="<?php echo $fetchUserInfo['financialMng'] ?>" >
        <label for="floatingInput" >Financial Management</label>
    </div>
    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="inputComplaintsEdited" placeholder="Name" value="<?php echo $fetchUserInfo['complaints'] ?>" >
        <label for="floatingInput">Complaints</label>
    </div> -->
</body>
</html>