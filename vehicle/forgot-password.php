
<?php

$mailmsg=false;
$noemail=false;
$a=false;
// $useremail=false;
// $tokn=false;
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';
include "db.php";




if(isset($_POST['submit'])){

    $useremail=$_POST['useremail'];
    $s = "SELECT * FROM tbl_users WHERE useremail='$useremail'";
    $res = mysqli_query($conn, $s);
    $nu=mysqli_num_rows($res);
  

    if($nu==0)
    {
        $noemail="Invalid Email";
        //header('location:forgotpassword.php');
    }
    else{
        $name="select username as c from tbl_users where useremail='$useremail'";
        $namef=mysqli_query($conn,$name);
        $row = mysqli_fetch_array($namef);
          $nam = $row['c'];
        $token=md5(time()+1234567% rand(100, 550000));
        $que="UPDATE `tbl_users` SET `token` = '$token' WHERE `useremail` = '$useremail'";
        $res2=mysqli_query($conn,$que);
        $mail = new PHPMailer(true);

        
        //Server settings
       // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'abhijithsbabu2023a@mca.ajce.in';                     //SMTP username
        $mail->Password   = 'Abhijith@123';                               //SMTP password
        $mail->SMTPSecure = 'ssl';            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    
        //Recipients
        $mail->setFrom('abhijithsbabu2023a@mca.ajce.in', 'Break Down Asist');
        $mail->addAddress($_POST['useremail']);     //Add a recipient
       //
    
        //Attachments
       // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
       // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
    
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Hi '.$nam.' Reset Your Password';
        $mail->Body    = '<a href ="http://localhost/vehicle/resetpass.php?token='.$token.'&useremail='.$useremail.'">Click here to reset password</a>';
        //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    
        $mail->send();
        $mailmsg="Please check your mail $useremail";
       // $_SESSION['mailrespo'] = $mailmsg;
        //header('location:forgotpassword.php');
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
                                        <h1 class="h4 text-gray-900 mb-2">Forgot Your Password?</h1>
                                        <p class="mb-4">We get it, stuff happens. Just enter your email address below
                                            and we'll send you a link to reset your password!</p>
                                    </div>
                                    <form class="user" method="post" action="forgot-password.php">

                                    <?php

                                      if($noemail){
                                        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>!Error</strong>'.$noemail.'</div>';
                                      }
                                    ?>
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user" name="useremail"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Enter Email Address...">
                                        </div>
                                        <input type="submit" class="btn btn-primary btn-user btn-block"  name="submit" value="reset password">
                                            
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