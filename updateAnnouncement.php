<?php
require "db.php";

$id = $_POST['id'];

$target_dir = "uploads/announcement/";
$target_file = $target_dir . basename($_FILES["file"]["name"]);

$name = $_FILES["file"]["name"];

if(!empty($_FILES["file"]["name"])){
    
    move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);

    $q = "UPDATE `announcement` SET `pic`='$target_file',`name`='$name' WHERE id='$id'";
    
    $con->query($q);

}
 

?>
