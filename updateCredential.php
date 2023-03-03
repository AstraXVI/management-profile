<?php
require "db.php";

$id = $_POST['id'];
$type = $_POST['type'];

$target_dir = "uploads/credentials/";
$target_file = $target_dir . basename($_FILES["file"]["name"]);

$name = $_FILES["file"]["name"];

if(empty($_FILES["file"]["name"])){
    
    $q = "UPDATE `credential` SET `type`='$type' WHERE id='$id'";
    
    $con->query($q);
   

}else{
    
    move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);

    $q = "UPDATE `credential` SET `pic`='$target_file',`name`='$name',`type`='$type' WHERE id='$id'";
    
    $con->query($q);
}
 

?>
