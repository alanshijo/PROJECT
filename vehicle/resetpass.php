<?php
include "db.php";
$message=false;
$token=false;
$useremail=false;
$a1=false;
if(!isset($_GET['token']))
{
  session_destroy();
  header('location:login.php');
}

if(!isset($_POST['submit'])){
    $token = $_GET['token'];
    $useremail = $_GET['useremail'];
    
    $qry = "select token_status from tbl_users where token= $token and username = $username";  
    
    //check token session_status
    // if($token_status == 0){
    //     $a="update tbl_users set token_status = 1 where token=$token";
    // } else {
    //     echo "invalid token page";
    // }
}

if(isset($_GET['token']) && isset($_GET['useremail'])) {
  
    $token=$_GET['token'];
    $useremail=$_GET['useremail'];
   // $pass=$_POST["password"];
   $qry = "SELECT * FROM tbl_users WHERE useremail='$useremail' and token='$token'";
   // exit;
   $check=mysqli_query($conn, $qry);

   //$res1= mysqli_query($conn,$check);
    if($check)
    {
    while($row2=mysqli_fetch_assoc($check))
    
    {
        $token=$row2['token'];
        $email=$row2['useremail'];
        $token_status=$row2['token_status'];
    }
    }
// echo $token_status; exit;
//    if (mysqli_num_rows($check)!=1) {
//      alert("This url is invalid or already been used. Please verify and try again.");
//      exit;
//    }


//check token token_status
if($token_status == 0){
    echo $a= "update tbl_users set token_status = 1 where token='".$token."'"; 
    mysqli_query($conn, $a);


$_SESSION['email']=$useremail;
$_SESSION['token']=$token;


//}

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $password1=mysqli_real_escape_string($conn,$_POST['password']);
    $password2=mysqli_real_escape_string($conn,$_POST['cpassword']);
    if ($password2==$password1) {
      $email=$_SESSION['email'];
      $tok=$_SESSION['token'];
      
        mysqli_query($conn,"UPDATE tbl_users set password='$password1' where useremail='$email'");
        $q="select username as c from tbl_users  where useremail = '$email'";

        header('location:login.php');
    }
    else{
        $message="Verify your password";
    }
        
}
else{
  //  echo "error";
}
} else {
   $a1= "Page Expired!!!";
}
}

        
?>
<?php
   $email=$_SESSION['email'];
$nam= mysqli_query($conn,"select username from tbl_users where useremail='$email'");
?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Forgot Password</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>
<script>
                                        function Password()
                                            {
                                                var pass=document.getElementById('password').value;
                                                //var patt= /^(?=.[0-9])(?=.[!@#$%^&])[A-Za-z0-9!@#$%^&]{7,15}$/;
                                                //var patt = /^[a-zA-Z0-9@#$%^&]{7,15}$/;
                                                var patt = /^(?=.*[A-Z])(?=.*[!@#$&*])(?=.*[0-9])(?=.*[a-z]).{7,15}$/;

                                                if(!pass.match(patt)){
                                                    console.log(pass);
                                                    document.getElementById('pass').innerHTML="Password must be 7 to 15 character with number and special character ";  
                                                    document.getElementById('password').value = pass;
                                                        document.getElementById('password').style.color = "red";
                                                return false;  
                                                }else{
                                                    console.log(pass, "Green");
                                                document.getElementById('pass').innerHTML=" ";
                                                document.getElementById('password').style.color = "green";
                                                //return true;
                                                }
                                            }
</script>
<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <!-- <div class="col-lg-6 d-none d-lg-block bg-password-image"></div> -->
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-2">Reset Your Password?</h1>
                                        
                                    </div>
                                    <script>
                                        function showerr()
                                            {
                                                document.getElementById("time").style.visibility="visible";

                                            }
                                            setTimeout("showerr()",0);

                                            function hideerr()
                                            {
                                                document.getElementById("time").style.visibility="hidden";

                                            }
                                            setTimeout("hideerr()",3000);
                                    </script>
                                    <?php 

                                    if($a1) {
                                        
                                        echo ' <div class="alert alert-danger 
                                            alert-dismissible fade show" role="alert" id="time" style="visibility:hidden">'. $a1.'

                                    
                                    </div> '; 
                                    
                                    }
                                    ?>
                                    <form class="user" method="post" action="">

                                    <?php
                                        // if($message) {
                                            
                                        //     echo ' <div class="alert alert-warning 
                                        //         alert-dismissible fade show" role="alert" id="time" style="visibility:hidden"> 
                                        //     <strong>Error!</strong> '. $message.'

                                        
                                        // </div> '; 
                                        // }
                                    ?> 
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user" name="useremail"
                                                id="exampleInputEmail" aria-describedby="emailHelp" value="<?php echo "$email"; ?>"
                                                placeholder="Enter Email Address..." required disabled/>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" name="password"
                                                id="password" aria-describedby="emailHelp"
                                                placeholder="Enter new password..." onkeyup="return Password()"/>
                                        </div>
                                        <span id="pass" style="color:red;"></span>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" name="cpassword"
                                                id="password" aria-describedby="emailHelp"
                                                placeholder="Conform password...">
                                        </div>
                                        <input type="submit" class="btn btn-primary btn-user btn-block"  name="submit" value="Submit">
                                            
                                    </input>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="login.php">Create an Account!</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="login.php">Already have an account? Login!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>