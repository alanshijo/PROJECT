<?php
$n=false;
$m=false;
$m1=false;
$m3=false;
include "db.php";
session_unset();
if(isset($_POST['submit'])){

    $uname = mysqli_real_escape_string($conn,$_POST['username']);
    $password = mysqli_real_escape_string($conn,$_POST['password']);
 
    if ($uname != "" && $password != ""){
        
        $sql_query = "select count(*) as cntUser,type_id as val from tbl_users where username='".$uname."' and password='".$password."'";
       
        $result = mysqli_query($conn,$sql_query);
        $row = mysqli_fetch_array($result);

        $count1 = $row['cntUser'];
        $v=$row['val'];
 
       
        if($count1 > 0){
            if($v==2){
           
            
                $sq="select isApproved as st from tbl_workshop where username='".$uname."'";
                $res = mysqli_query($conn,$sq);
                $row1 = mysqli_fetch_array($res);
    
                $st=$row1['st'];  
                
                if($st=="0")
                {
                    $m="Yet to be verified by Admin";
                }
                elseif($st=="1"){
                    $_SESSION['uname'] = $uname;
                    header('location:ws_home.php');
                }elseif($st=="9"){
                    $m1="Blocked by admin";
                }
                
            }
            if($v=="5")
            {
                $_SESSION['uname'] = $uname;
                header('Location:van_home.php');
                
            }elseif($v=="4"){
                $_SESSION['uname'] = $uname;
               header('Location:cus_home.php');
              
            }elseif($v=="3"){

                $sq1="select status as st from tbl_mechanic where username='".$uname."'";
                $res1 = mysqli_query($conn,$sq1);
                $row2 = mysqli_fetch_array($res1);
    
                $st1=$row2['st']; 
                if($st1=="0")
                {
                    $m3="Blocked by Workshop";
                }else{
                $_SESSION['uname'] = $uname;
               header('Location:mech_home.php');
                }
              
            }
            
         
           elseif($v=="1"){
            $_SESSION['uname'] = $uname;
            header('Location:ad_home.php');
          
           }
           
        }
        else{
           
           $n = "Invalid username and password";
           
           
        }

    }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Login</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <script>
        $( document ).ready(function() {
            $("#proceedRegistration").click(function(){
                //$(this).hide();
                var res = $('input[name="userType"]:checked').val();

                // alert("Hai "+ res); 
                
                if(res == "customer"){
                    window.location.href = '/vehicle/add_cust.php'
                } else {
                    if(res == "van"){
                    window.location.href = '/vehicle/add_van.php'
                    }else{
                        window.location.href = '/vehicle/add_workshop.php'
                    }
                }
            });
        });

       
    </script>
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

</head>
<style>
.angled-gradient {
  background: linear-gradient(70deg, black, pink);
}
</style>
<body class="angled-gradient">

    <div class="container">
       

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-6 col-lg-8 col-md-5">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                    <?php
    if($n) {
       
        echo ' <div class="alert alert-danger 
            alert-dismissible fade show" role="alert" id="time" style="visibility:hidden"> 
        <strong>Error!</strong> '. $n.'
    
       
     </div> '; 
     
    }
    if($m) {
       
        echo ' <div class="alert alert-warning 
            alert-dismissible fade show" role="alert" id="time" style="visibility:hidden"> 
        <strong>Error!</strong> '. $m.'
    
       
     </div> '; 
    }
    if($m1) {
       
        echo ' <div class="alert alert-warning 
            alert-dismissible fade show" role="alert" id="time" style="visibility:hidden"> 
        <strong>Error!</strong> '. $m1.'
    
       
     </div> '; 
    }
    if($m3) {
       
        echo ' <div class="alert alert-warning 
            alert-dismissible fade show" role="alert" id="time" style="visibility:hidden"> 
        <strong>Error!</strong> '. $m3.'
    
       
     </div> '; 
    }
     ?>
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <!-- /<div class="col-lg-6 d-none d-lg-block bg-login-image"></div> -->
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>
                                    <form class="user" method="post" action="login.php">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" name="username"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Enter Username...">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" name="password"
                                                id="exampleInputPassword" placeholder="Password">
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember
                                                    Me</label>
                                            </div>
                                        </div>
                                       
                                        
                                        <button class="btn btn-primary btn-user btn-block" id="log" type="submit" name="submit">Login</button>
                                        <hr>
                                        
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="forgot-password.php">Forgot Password?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="">Create an Account!</a>
                                    </div>
                                    <div class="text-center">
                                    <input type="radio" id="workshop" name="userType" value="workshop">
                                    <label for="html">workshop</label>&nbsp;
                                    <input type="radio" id="customer" name="userType" value="customer">
                                    <label for="css">customer</label>&nbsp;
                                    <input type="radio" id="van" name="userType" value="van">
                                    <label for="javascript">recovery van</label>
                                    <button class="btn btn-primary btn-user btn-block" id="proceedRegistration" >Go</button>
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
    <script>
  if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>
</body>

</html>