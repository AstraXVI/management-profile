<?php
    require "db.php";

    $id = $_POST['id'];

    $q = "UPDATE `equipment` SET `permission`='Approve' WHERE id='$id'";

    $con->query($q);

    // GET NUMBER OF REQUEST
    $getRequest = "SELECT * FROM `equipment` WHERE permission='Deny'";
    $listRequest = $con->query($getRequest);
    $requestCount = $listRequest->num_rows;


    if($requestCount){
        echo $requestCount;
    }

?>