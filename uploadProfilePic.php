<?php
require "db.php";

$id = $_POST['id'];

$target_dir = "uploads/profile_pics/";
$target_file = $target_dir . basename($_FILES["file"]["name"]);

if(!empty($_FILES["file"]["name"])){
    
    move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);

    $q = "UPDATE `profile` SET `picture`='$target_file' WHERE id='$id'";
    
    $con->query($q);

}
 

?>
