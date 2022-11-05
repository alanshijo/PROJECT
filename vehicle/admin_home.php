<?php
include "db.php";

$q="select count(*) as c from tbl_workshop where isApproved  = 0 ";


$result = mysqli_query($conn,$q);
//echo $result;
$row = mysqli_fetch_array($result);
$count = $row['c'];

?>
<!doctype html>
<html>
    <head>
    <script language="javascript" type="text/javascript">
    window.history.forward();
  </script>
    <style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200&display=swap');
</style>
    <link rel="stylesheet" href="new/style.css">
    <link rel="stylesheet" href="new/style2.css">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </head>
    <body>
   <div class="m-5">
    
        
        <?php
        echo "<h1>Welcome,</h1>";
        ?>
       
       <div class="mt-5">
        <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
    View Requests <span class="badge bg-secondary"><?php echo "$count" ?></span>
         </a>
         <!-- accept workshop -->
         

  <div class="collapse" id="collapseExample">
  <div class="card card-body">
  <table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">id</th>
      <th scope="col">name</th>
      <th scope="col">place</th>
      <th scope="col">address</th>
      <th scope="col">email</th>
      <th scope="col">phone</th>
      <th scope="col">action</th>
    </tr>
  </thead>
  <tbody>

  <?php
$qu="select * from tbl_workshop where isApproved = 0 ";
$res= mysqli_query($conn,$qu);
if($res)
{
  while($row1=mysqli_fetch_assoc($res))
  {
    $ws_id=$row1['ws_id'];
    $ws_name=$row1['ws_name'];
    $place=$row1['place'];
    $address=$row1['address'];
    $email=$row1['email'];
    $phone=$row1['phone'];
   echo ' <tr>
   <th scope="row">'.$ws_id.'</th>
   <td>'.$ws_name.'</td>
   <td>'.$place.'</td>
   <td>'.$address.'</td>
   <td>'.$email.'</td>
   <td>'.$phone.'</td> 
   <td>
 <button  type="button" class="btn btn-outline-success"><a href="acceptws.php?accept='.$ws_name.'">Accept</a></button>
 <button type="button" class="btn btn-outline-danger"><a href="acceptws.php?reject='.$ws_name.'">Reject</a></button>
</td>
 </tr>';
  }
}
?>

  </tbody>
</table>
  </div>
</div>
</div>
    </body>
</html>
