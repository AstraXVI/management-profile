<?php
     require "../db.php";

     $id = $_POST['id'];
 
     $code = $_POST['code'];
     $article = $_POST['article'];
     $description = $_POST['description'];
     $date = $_POST['date'];
     $unitValue = $_POST['unitValue'];
     $totalValue = $_POST['totalValue'];
     $sourceOfFunds = $_POST['sourceOfFunds'];
     $status = $_POST['status'];
     $permission = 'Deny';

     $q = "UPDATE `equipment` SET `code`='$code',`article`='$article',`description`='$description',`date_acquired`='$date',`unit_value`='$unitValue',`total_value`='$totalValue',`source_of_fund`='$sourceOfFunds', `status`='$status', `permission`='$permission'  WHERE id='$id'";

     $con->query($q);

?>