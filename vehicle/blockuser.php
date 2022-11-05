<?php
include 'db.php';
if(!isset($_SESSION['uname'])){
    header('Location:login.php');
}




if(isset($_GET['block']))
{
$ws=$_GET['block'];

$sql="UPDATE `tbl_workshop` SET `status`='0',`isApproved`='9' WHERE ws_name = '$ws' ";
$res=mysqli_query($conn,$sql);
if($res)
{
    header('location:view_ws.php');
}

}


if(isset($_GET['unblock']))
{
$ws=$_GET['unblock'];

$sql="UPDATE `tbl_workshop` SET `status`='1',`isApproved`='1' WHERE ws_name = '$ws' ";
$res=mysqli_query($conn,$sql);
if($res)
{
    header('location:view_ws.php');
}

}

else{
    die(mysqli_error($conn));
}

?>