<?php
    require "db.php";

    $userId = $_POST['id'];

    $getUserInfo = "SELECT * FROM users WHERE id='$userId'";
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
    <input type="hidden" id='profileId' value='<?php echo $fetchUserInfo['id'] ?>' id='profileUserId'>
    <div class="form-floating mb-3">
        <input type="email" class="form-control" id="profileEmailModal" value='<?php echo $fetchUserInfo['email'] ?>' placeholder="name@example.com">
        <label for="floatingInput">Email address</label>
    </div>
    <div class="form-floating mb-3">
        <input type="email" class="form-control" id="floatingInput" value='<?php echo $fetchUserInfo['role'] ?>' placeholder="name@example.com" disabled>
        <label for="floatingInput">Role</label>
    </div>
    <div class="form-floating mb-3">
        <input type="email" class="form-control" id="floatingInput" value='<?php echo $fetchUserInfo['school'] ?>' placeholder="name@example.com" disabled>
        <label for="floatingInput">School</label>
    </div>
    <div class="form-floating mb-3">
        <input type="email" class="form-control" id="floatingInput" value='<?php echo $fetchUserInfo['pass'] ?>' placeholder="name@example.com" disabled>
        <label for="floatingInput">Password</label>
    </div>
    <div class="form-floating mb-3">
        <input type="email" class="form-control" id="profileNewPassModal" placeholder="name@example.com">
        <label for="floatingInput">New Password</label>
    </div>
    <div class="form-floating mb-3">
        <input type="email" class="form-control" id="ProfileRetypePassModal" placeholder="name@example.com">
        <label for="floatingInput">Retype Password</label>
    </div>
</body>
</html>