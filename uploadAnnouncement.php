<?php
require "db.php";

// $email = $_POST['email'];

$target_dir = "uploads/announcement/";
$target_file = $target_dir . basename($_FILES["file"]["name"]);

$name = $_FILES["file"]["name"];

if(!empty($_FILES["file"]["name"])){
    
    move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);

    $q = "INSERT INTO `announcement`(`pic`, `name`) VALUES ('$target_file','$name')";
    
    $con->query($q);

}
 

?>
