<?php
 

    try{

        $con = new mysqli('localhost','root','','deped_db');

    }catch(Exception $e){

        // $con = 'error';
        echo "<script>alert('A Database Error Occured')</script>";
    }

    // echo

?>