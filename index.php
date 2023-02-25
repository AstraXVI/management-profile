<?php
    require "db.php";
    session_start();

    if(empty($_SESSION['status'])){
        $_SESSION['status'] = 'invalid';
    }

    if($_SESSION['status'] == 'admin'){
        header("location: admin_dashboard.php");
    }
    if($_SESSION['status'] == 'client'){
        header("location: client_dashboard.php");
    }

    // echo $_SESSION['status'];

    if(isset($_POST['loginBtn'])){
        $email = $_POST['email'];
        $pass = $_POST['pass'];

        $q = "SELECT * FROM `users` WHERE email='$email' AND pass='$pass'";
        $list = $con->query($q);
        $info = $list->fetch_assoc();
        
        // $_SESSION['id'] = $info['id'];

        if($list->num_rows){

            $_SESSION['id'] = $info['id'];
            $_SESSION['school'] = $info['school'];
            $_SESSION['status'] = $info['role'];
            $_SESSION['privacy'] = 1;


            if($info['role'] == 'Admin'){
                header("location: admin_dashboard.php");
            }else{
                header("location: client_dashboard.php");
            }
        }else{
            echo "<script>alert('Wrong Email or Password. Try Again!')</script>";
        }

        // header('Refresh:0');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <link rel="stylesheet" href="css/index.css">
    <title>Login</title>
</head>
<body style="background: url(img/bannerweb.png) no-repeat; background-size: cover; background-position: center; height: 100vh">
    <!-- <form method='post'>
        <input type="text" name='email'>
        <input type="pass" name='pass'>
        <button name='loginBtn'>LOGIN</button>
    </form> -->
    <div class="login" style="background-color: rgba(0,0,0,0.6)">
    <h1 class="text-center mb-5 fw-bold text-light" style="letter-spacing: 4px;">LOGIN</h1>
        <form method="post">
            <div class="d-flex">
                <span><i class="fas fa-user"></i></span>
                <div class="form-floating mb-3 flex-grow-1">
                    <input type="email" class="form-control rounded-0" id="floatingInput" name="email" placeholder="name@example.com" required>
                    <label for="floatingInput">Email address</label>
                </div>
            </div>
            <div class="d-flex">
                <span><i class="fas fa-lock"></i></i></span>
                <div class="form-floating mb-3 flex-grow-1">
                    <input type="password" class="form-control rounded-0" id="floatingPassword" name="pass" placeholder="Password" required>
                    <label for="floatingPassword">Password</label>
                </div>
            </div>
            <!-- <hr style="width: 34vmax; margin-left: -86px; opacity: 0.2;"> -->
            <button type="submit" name="loginBtn" class="btn btn-primary btn-lg mt-4 d-block mx-auto w-75 px-4">LOG IN</button>
          </form>
    </div>
    <?php include 'footer.php'?>
    <!-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> -->
</body>
</html>