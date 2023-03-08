<?php
    require "../db.php";

    echo $id = $_POST['id'];
    echo $title = $_POST['title'];
    echo $lvl = $_POST['lvl'];
    echo $date = $_POST['date'];

    // echo $_FILES["file"]["name"];

    
    if(!empty($_FILES["file"]["name"])){
        
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["file"]["name"]);

        
        move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);

        $q = "UPDATE `award` SET `title`='$title',`lvl`='$lvl',`date`='$date',`pic`='$target_file' WHERE id='$id'";
        
        $con->query($q);

        
        // echo "meron";
        
    }else{

        $q = "UPDATE `award` SET `title`='$title',`lvl`='$lvl',`date`='$date' WHERE id='$id'";
        
        $con->query($q);

        
        // echo "wala";


    }
?>