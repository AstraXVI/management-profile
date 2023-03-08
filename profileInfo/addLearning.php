<?php
    require "../db.php";

    $email = $_POST['email'];
    $title = $_POST['title'];
    $from = $_POST['from'];
    $to = $_POST['to'];
    $hrs = $_POST['hrs'];
    $typeOfLd = $_POST['typeOfLd'];
    $conducted = $_POST['conducted'];

    if(!empty($_FILES["file"]["name"])){
        
        $target_dir = "uploads/learning/";
        $target_file = $target_dir . basename($_FILES["file"]["name"]);

        
        move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);

        $q = "INSERT INTO `learning`(`email`, `title`, `dateFrom`, `dateTo`, `hours`, `typeOfLd`, `conducted`, `pic`) VALUES ('$email','$title','$from','$to','$hrs','$typeOfLd','$conducted','$target_file')";
        
        $con->query($q);

        
        // echo "meron";
        
    }else{

        $q = "INSERT INTO `learning`(`email`, `title`, `dateFrom`, `dateTo`, `hours`, `typeOfLd`, `conducted`) VALUES ('$email','$title','$from','$to','$hrs','$typeOfLd','$conducted')";
        
        $con->query($q);

        
        // echo "wala";


    }
?>