<?php
    require "../db.php";

    $id = $_POST['id'];
    $title = $_POST['title'];
    $from = $_POST['from'];
    $to = $_POST['to'];
    $hrs = $_POST['hrs'];
    $typeOfLd = $_POST['typeOfLd'];
    $conducted = $_POST['conducted'];

    if(!empty($_FILES["file"]["name"])){
        
        $target_dir = "uploads/learning/";
        echo $target_file = $target_dir . basename($_FILES["file"]["name"]);

        
        move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);

        $q = "UPDATE `learning` SET `title`='$title',`dateFrom`='$from',`dateTo`='$to',`hours`='$hrs',`typeOfLd`='$typeOfLd',`conducted`='$conducted', `pic`='$target_file' WHERE id='$id'";
        
        $con->query($q);

        
        // echo "meron";
        
    }else{

        $q = "UPDATE `learning` SET `title`='$title',`dateFrom`='$from',`dateTo`='$to',`hours`='$hrs',`typeOfLd`='$typeOfLd',`conducted`='$conducted' WHERE id='$id'";
        
        $con->query($q);

        
        // echo "wala";


    }
?>