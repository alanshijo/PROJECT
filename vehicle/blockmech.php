<?php
include 'db.php';
if(!isset($_SESSION['uname'])){
    header('Location:login.php');
}

if(isset($_GET['block']))
{
$mech=$_GET['block'];

$sql="UPDATE `tbl_mechanic` SET `status`='0' WHERE mech_name = '$mech' ";
$res=mysqli_query($conn,$sql);
if($res)
{
    header('location:view_mechh.php');
}

}


if(isset($_GET['unblock']))
{
$mech=$_GET['unblock'];

$sql="UPDATE `tbl_mechanic` SET `status`='1' WHERE mech_name = '$mech' ";
$res=mysqli_query($conn,$sql);
if($res)
{
    header('location:view_mechh.php');
}

}

else{
    die(mysqli_error($conn));
}

?>