<?php
include "db.php";

//username

if(!empty($_POST['username'])){
    $username= $_POST['username'];
    $check = "SELECT username FROM `tbl_users` WHERE `username`='$username'";
    
    $rslt = mysqli_query($conn, $check);

    $rsltcheck = mysqli_num_rows($rslt);
    if($rsltcheck > 0){
        echo "<span style='color:red;'>username already exist</span>";
        echo "<script>$('#submit').prop('disabled',true);</script>";
    }
    else{
        //echo "<span style='color:green;'>username available</span>";
        echo "<script>$('#submit').prop('disabled',true);</script>";
    } 
}
?>