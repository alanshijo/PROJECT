<?php 

include "db.php";
$n = $_SESSION['uname'];

if(!isset($n)){
    session_destroy();
    header('location:login.php');
}

$update=false;

$q="select useremail,password from tbl_users where username='".$n."'";

$result = mysqli_query($conn,$q);
//echo $result;
$row = mysqli_fetch_array($result);
$pass = $row['password'];
$email = $row['useremail'];
//echo $email; exit;
//echo $pass; exit;
$q7="select cus_name,place,address,phone from tbl_customer where username='".$n."'";

$result7 = mysqli_query($conn,$q7);
//echo $result;
$row2 = mysqli_fetch_array($result7);
$cus_name = $row2['cus_name'];
$place = $row2['place'];
$address = $row2['address'];
$phone = $row2['phone'];

if(isset($_POST['update']))
{
  $cus_name=$_POST['cus_name'];
  //echo $cus_name; exit;
  $place=$_POST['place'];
  $address=$_POST['address'];
  $phone=$_POST['phone'];
  $pass=$_POST['password'];

  $sql="update `tbl_users` set password='$pass' where username='".$n."'";
  $result2 = mysqli_query($conn,$sql);
  $sql2="update `tbl_customer` set cus_name='$cus_name',place='$place' ,address='$address', phone='$phone' where username='".$n."'";
  $result3 = mysqli_query($conn,$sql2);
  if($result2)
  {
    $update=true;
    echo'<script> alert ("Account Updated");</script>';
    echo'<script>window.location.href="view_cus.php";</script>';
  }else{
    echo'<script> alert ("username  already exists!");</script>';
    echo'<script>window.location.href="update_cus.php";</script>'; 
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

    <title>SB Admin 2 - Register</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>


<script>
    //name
                                                    function Validstr1() {
                                                            var val = document.getElementById('name').value;
                                                            if (!val.match(/^[A-Za-z ]*$/))
                                                            {
                                                            document.getElementById('msg').innerHTML="Only alphabets are allowed";
                                                                    document.getElementById('name').value = val;
                                                                    document.getElementById('name').style.color = "red";
                                                                    return false;
                                                                    flag=1;
                                                            }
                                                            else{
                                                            document.getElementById('msg').innerHTML=" ";
                                                            document.getElementById('name').style.color = "green";
                                                            //return true;
                                                            
                                                            }
                                                        }
//username
                                        
                                                    function Validstr() {
                                                            var val = document.getElementById('username').value;
                                                            if (!val.match(/^[A-Za-z ]*$/))
                                                            {
                                                            document.getElementById('msg1').innerHTML="Start with a Capital letter & Only alphabets are allowed";
                                                                    document.getElementById('username').value = val;
                                                                    document.getElementById('username').style.color = "red";
                                                                    return false;
                                                                    flag=1;
                                                            }
                                                            if(val.length<4||val.length>10){
                                                            document.getElementById('msg1').innerHTML="Username between 4 to 10 characters";
                                                                    document.getElementById('username').value = val;
                                                                    document.getElementById('username').style.color = "red";
                                                                    return false;
                                                                    flag=1;
                                                            }else{
                                                            document.getElementById('msg1').innerHTML=" ";
                                                            document.getElementById('username').style.color = "green";
                                                            //return true;
                                                            
                                                            }
                                                        }

//email

                                function Validateemail()
                                        {
                                        var email=document.getElementById('email').value;  
                                        var mailformat = /^\w+([\.-]?\w+)@\w+([\.-]?\w+)(\.\w{2,3})+$/;
                                        if(email.length<3||email.length>40){
                                            document.getElementById('email1').innerHTML="Invalid Email";
                                                document.getElementById('email').value = email;
                                                document.getElementById('email').style.color = "red";
                                                return false;
                                        }
                                        if(!email.match(/^[\w\+\'\.-]+@[\w\'\.-]+\.[a-zA-Z]{2,}$/)){  
                                            document.getElementById('email1').innerHTML="Please enter a valid email";  
                                            document.getElementById('email').value = email;
                                                document.getElementById('email').style.color = "red";
                                        return false;  
                                        }else{
                                        document.getElementById('email1').innerHTML=" ";
                                        document.getElementById('email').style.color = "green";
                                        // return true;
                                        }
                                    }
//phone

                        function Validphone() 
                        {
                        var val = document.getElementById('phone').value;
                          if (!val.match(/^[789][0-9]{9}$/))
                           {
                            document.getElementById('msg2').innerHTML="Only Numbers are allowed and must contain 10 number";
                                  document.getElementById('phone').value = val;
                                    return false;
                           }else{
                            document.getElementById('msg2').innerHTML="";
                        //   return true;
                        }
                    }
//password

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
                                            function Val()
                        {
                          if(Validstr1()===false || Validstr()===false || ValidateEmail()===false || Validphone()==false || Password()===false)
                          {
                            return false;
                          }
                        }



</script>


<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <!-- <div class="col-lg-5 d-none d-lg-block bg-register-image"></div> -->
                    <div class="col-lg-12">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4"><strong>Update Your Account!</strong></h1>
                            </div>
                            <form class="user" method="post" action="" onsubmit="return Val();">
                                <div class="form-group">
                                    <!-- <div class="col-sm-6 mb-3 mb-sm-0"> -->
                                        <input type="text" class="form-control form-control-user" id="name" name="cus_name" value="<?php echo "$cus_name"; ?>"
                                            placeholder="Customer Name" onkeyup="return Validstr1()"/>
                                    </div>
                                    <span id="msg" style="color:red;"></span>
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user" id="username" name="username" value="<?php echo "$n";?>"
                                            placeholder="Username" required disabled/>
                                    </div>
                                <!-- </div> -->
                                <span id="msg1" style="color:red;"></span>

                                <!-- <div class="form-group">
                                        <input type="text" class="form-control form-control-user" id="exampleplace" name="usertype"
                                            placeholder="usertype"> 
                                           
                                </div> -->
                                 <div class="form-group">
                                        <input type="text" class="form-control form-control-user" id="exampleplace" name="place" value="<?php echo "$place";?>"
                                            placeholder="Place" required>
                                    </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="exampleInputaddress" name="address" value="<?php echo "$address";?>"
                                        placeholder="Address" required>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user" id="email" name="email" value="<?php echo "$email";?>"
                                        placeholder="Email" required disabled/>
                                </div>
                                <span id="email1" style="color:red;"></span>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="phone" name="phone" value="<?php echo "$phone";?>"
                                        placeholder="Phone" onkeyup="return Validphone()";/>
                                </div>
                                <span id="msg2" style="color:red;"></span>
                                <div class="form-group">
                                    <input type="password" name="password" class="form-control form-control-user" id="password"  value="<?php echo "$pass";?>"
                                        placeholder="Password" onkeyup="return Password();"/>
                                </div>
                                <span id="pass" style="color:red;"></span>
                                <div class="form-group row">
                                    <!-- <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" class="form-control form-control-user" name="password"
                                            id="exampleInputPassword" placeholder="Password">
                                    </div> -->
                                    <!-- <div class="col-sm-6">
                                        <input type="password" class="form-control form-control-user"
                                            id="exampleRepeatPassword" placeholder="Repeat Password">
                                    </div> -->
                                </div>
                                <!-- <a href="login.php" class="btn btn-primary btn-user btn-block">
                                    Sign Up
                                </a> -->
                                <button class="btn btn-primary btn-user btn-block" name="update">Update</button>
                                <hr>
                                
                            </form>


                            <hr>
                            <div class="text-center">
                                <a class="small" href="forgot-password.html">Forgot Password?</a>
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

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>