<?php
include 'db.php';

if(isset($_GET['accept']))
{
$ws_name=$_GET['accept'];

$sql2="UPDATE `tbl_workshop` SET `isApproved`='1' WHERE ws_name = '$ws_name' ";
$res2=mysqli_query($conn,$sql2);
if($res2)
{
    header('location:admin_home.php');
}
}

if(isset($_GET['reject']))
{

$ws_name=$_GET['reject'];

$sql2="UPDATE `tbl_workshop` SET `isApproved`='5' WHERE ws_name = '$ws_name' ";
$res=mysqli_query($conn,$sql2);
if($res)
{
    header('location:admin_home.php');
}
   
}
else{
    die(mysqli_error($conn));
}

?>
