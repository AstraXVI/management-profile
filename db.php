<?php
 

    try{

        $con = new mysqli('localhost','root','','deped-db');

    }catch(Exception $e){

        // $con = 'error';
        echo "<script>alert('A Database Error Occured')</script>";
    }

?>