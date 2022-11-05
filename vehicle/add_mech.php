<?php

include 'db.php';
$uname= $_SESSION['uname'];
$sql1 = " SELECT ws_name,address FROM `tbl_workshop` where username='$uname'";
$result1 = $conn->query($sql1);
$row1 = $result1->fetch_assoc();

if(isset($_POST['submit'])){
    $mname = $_POST["m_name"];
    $place = $_POST["place"];
    $ws_name = $row1["ws_name"];
	$address = $row1["address"];
    $email = $_POST["email"];
	$phone = $_POST["phone"];
    $username = $_POST["username"];
	$password = $_POST["password"];
   
    $type_id=3;
    $status=1;
    

    $check = "SELECT * FROM `tbl_users` WHERE `username`='$username'";
    
    $rslt = mysqli_query($conn, $check);
    $rsltcheck = mysqli_num_rows($rslt);
    if($rsltcheck == 0){

        $sql = "INSERT INTO `tbl_users`(`username`, `password`, `useremail`, `type_id`) VALUES ('$username','$password','$email','$type_id');";
        // $_SESSION['uname'] = $uname;
        $reg_query = mysqli_query($conn,$sql);
        $users_id = mysqli_insert_id($conn);
        if($reg_query){
            
             $cus_reg = "INSERT INTO `tbl_mechanic`(`users_id`,`ws_name`, `username`, `mech_name`, `address`, `place`, `phone`, `email`, `status`) VALUES ('$users_id','$ws_name','$username','$mname','$address','$place','$phone','$email','$status')";
            $user_reg_query = mysqli_query($conn,$cus_reg);
            echo'<script> alert ("Account created");</script>';
            echo'<script>window.location.href="ws_home.php";</script>';  }

    }
    else{
        echo'<script> alert ("username  already exists!");</script>';
        echo'<script>window.location.href="add_mech.php";</script>'; 
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
                                                            // return true;
                                                            
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
                                <h1 class="h4 text-gray-900 mb-4"><strong>Create an Account!<strong></h1>
                            </div>
                            <form class="user" method="post" action="" onsubmit="return Val();">
                                <div class="form-group">
                                    <!-- <div class="col-sm-6 mb-3 mb-sm-0"> -->
                                        <input type="text" class="form-control form-control-user" id="name" name="m_name"
                                            placeholder="Mechcanic Name" onkeyup="return Validstr1()"/>
                                    </div>
                                    <span id="msg" style="color:red;"></span>
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user" id="username" name="username"
                                            placeholder="Username" onkeyup="return Validstr()"/>
                                    </div>
                                    <span id="msg1" style="color:red;"></span>
                                <!-- </div> -->

                                <!-- <div class="form-group">
                                        <input type="text" class="form-control form-control-user" id="exampleplace" name="usertype"
                                            placeholder="usertype"> 
                                           
                                </div> -->
                                 <div class="form-group">
                                        <input type="text" class="form-control form-control-user" id="exampleplace" name="place"
                                            placeholder="Place" required>
                                    </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="exampleInputaddress" name="address"
                                        placeholder="Address" value="<?php echo $row1['address'];?>" required disabled/>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user" id="email" name="email"
                                        placeholder="Email" onkeyup="return Validateemail();"/>
                                </div>
                                <span id="email1" style="color:red;"></span>
                                <div class="form-group">
                                    <input type="number" class="form-control form-control-user" id="phone" name="phone"
                                        placeholder="Phone" onkeyup="return Validphone()"/>
                                </div>
                                <span id="msg2" style="color:red;"></span>
                                <div class="form-group">
                                        <input type="password" class="form-control form-control-user" name="password"
                                            id="password" placeholder="Password" onkeyup="return Password()"/>
                                </div>
                                <span id="pass" style="color:red;"></span>
                                <!-- <a href="login.php" class="btn btn-primary btn-user btn-block">
                                    Sign Up
                                </a> -->
                                <button class="btn btn-primary btn-user btn-block" name="submit">Sign Up</button>
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