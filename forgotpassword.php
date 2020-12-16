<!DOCTYPE html>
<html lang="en">
<?php
include 'z_execute/connection.php';
session_start();


if(isset($_POST['submit'])){

    $getuser=$_POST['user'];

    $sql = "select user_id,username,password from tbl_login where username='$getuser'";; //fixed
    $result = mysqli_query($connection, $sql); //fixed


    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        $msg = $row['user_id'];
        //give session
        $_SESSION['user_id']=  $msg;
        $_SESSION['success_message']="";
        header("Location:./confirm_account.php");
         exit();
        //     echo "<script type='text/javascript'>alert('$msg');</script>";
        //     $_SESSION['success_message']="";
      } else {
        //echo "0 results";
        $_SESSION['error_message']="";

      }

}


?>

<head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>XYT - Login</title>
        <!-- Custom fonts for this template-->
        <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <!-- Custom styles for this template-->
        <link href="custom/css/bootstrap.css" rel="stylesheet">
        <link href="css/indexphp.css" rel="stylesheet">
        <link href="animate/animate.css" rel="stylesheet">
        <link href="fontawesome/css/all.css" rel="stylesheet">

        <link href="assets/css/animate.min.css" rel="stylesheet" />
        <link href="fontawesome/css/all.css" rel="stylesheet">
        <link href="assets/css/pe-icon-7-stroke.css" rel="stylesheet" />

</head>
<body>
        <div class="container py-4 min-vh-100 d-flex flex-column justify-content-center">
                <div class="animate__animated animate__slideInDown row">
                        <div class="col-xl-10 mx-auto">
                                <div class="card border-0 shadow">
                                        <div class="row no-gutters justify-content-center">

                                                <!--IMAGE PART-->
                                                <div class="col-sm-6 rounded text-white text-center">
                                                        <div
                                                                class="bg-dark rounded p-5 h-100 d-flex flex-column align-items-center justify-content-center">
                                                                <h1 class="font-weight-bold">Forgot password?</h1>
                                                                <a style="cursor: pointer; "
                                                                        class="pointer small my-3">Enter existing
                                                                        username</a>
                                                                <button id="btnsignup" style="display:none;"
                                                                        type="submit"
                                                                        class="btn btn-outline-light rounded-pill">Sign-up</button>
                                                        </div>
                                                </div>

                                                <!-- WELCOME -->
                                                <div class="col-sm-6 text-center py-5">
									 <!--ADD SPACE -->
										  <div style="padding: 10px;">
										</div>

                                                        	<!--ERROR MESSAGE-->
                                                        	<div class="col-9 mx-auto text-center">
                                                                <div class="">
                                                                        <?php  if(isset($_SESSION['error_message'])) {?>

                                                                        <body onload="diplaynotof('top','center')">


                                                                                <?php
                      										unset($_SESSION['error_message']);
                    										}
                    										?>

                                                                                <?php

if(isset($_SESSION['success_message']))
{
  ?>

                                                                                <body onload="success('top','center')">
                                                                                        <?php
    unset($_SESSION['success_message']);
  }
  ?>
                                                                </div>
                                                        </div>

                                                        <!--ADD SPACE -->
                                                        <div style="padding: 8px;"></div>

                                                        <form action="forgotpassword.php" method="POST" role="form">

                                                                <!--Username textarea -->
                                                                <div class="form-group">
                                                                        <div class="col-8  mx-auto">
                                                                                <input name="user"
                                                                                        style="border-radius: 12px;"
                                                                                        type="text" class="form-control"
                                                                                        id="inputEmailForm"
                                                                                        placeholder="Username"
                                                                                        required="" autofocus="">
                                                                                <div class="invalid-feedback">Oops,
                                                                                        email is required</div>
                                                                        </div>
                                                                </div>

                                                                <!-- Password textarea-->


                                                                <!-- Forgot Password -->
                                                                <div class="form-group">
                                                                        <div class="mx-auto">

                                                                        </div>
                                                                </div>
                                                                <div class="form-group justify-content-center">
                                                                        <div class="pb-3 pt-2">
                                                                                <button style="border-radius: 12px;"
                                                                                        name="submit" type="submit"
                                                                                        class="btn btn-primary">Confirm</button>
                                                                        </div>
                                                                </div>
                                                        </form>
                                                </div>
                                        </div>
                                </div>
                        </div>
                </div>
        </div>



</body>

<!-- Bootstrap core JavaScript-->
<script src="assets/js/jquery-3.5.1.min.js" type="text/javascript"></script>
<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
<!--  Charts Plugin -->
<script src="assets/js/chartist.min.js"></script>
<!--  Notifications Plugin    -->
<script src="assets/js/bootstrap-notify.js"></script>

<!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
<script src="assets/js/light-bootstrap-dashboard.js"></script>
<!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
<script src="assets/js/demo.js"></script>


<script>

function diplaynotof() {
        $.notify({

                message: 'We couldnt find your account'
        }, {
                // settings
                offset: 50,
                type: 'danger',
                placement: {
                        from: "top",
                        align: "center"
                }
        });
}
</script>

</html>
