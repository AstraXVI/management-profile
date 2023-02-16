<?php
     require "../db.php";

     echo $id = $_POST['id'];
 
     echo $code = $_POST['code'];
     echo $article = $_POST['article'];
     echo $description = $_POST['description'];
     echo $date = $_POST['date'];
     echo $unitValue = $_POST['unitValue'];
     echo $totalValue = $_POST['totalValue'];
     echo $sourceOfFunds = $_POST['sourceOfFunds'];
     echo $status = $_POST['status'];

     $q = "UPDATE `equipment` SET `code`='$code',`article`='$article',`description`='$description',`date_acquired`='$date',`unit_value`='$unitValue',`total_value`='$totalValue',`source_of_fund`='$sourceOfFunds', `status`='$status'  WHERE id='$id'";

     $con->query($q);

?>