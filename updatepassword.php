<!DOCTYPE html>
<html lang="en">
<?php
session_start();
include 'z_execute/connection.php';



if(isset($_SESSION['user_id']))//!!
{
  $var_id=$_SESSION['user_id'];
//
 } else {
     echo 'rip';
 }


 date_default_timezone_set("Singapore");
 $date_today=date('Y-m-d h:m:s');



if(isset($_POST['submit']))//!!
{
  $var_password1=$_POST['var_password1'];
  $var_password2=$_POST['var_password2'];
  // echo $var_password1."/";
  // echo $var_password2."/";


if($var_password1==$var_password2){//if_password_matched
//  echo 'same';
    $sql="update tbl_login set password='$var_password1' where user_id='$var_id'" ;//UPDATE PASSWORD!
    if (mysqli_query($connection, $sql)) {

        //TBL_RECORDS Here
          $sqlrecord="INSERT INTO TBL_RECORDS(actions,date,user_id) values ('Password has been updated','$date_today','1')";
          if (!mysqli_query($connection, $sqlrecord)) {
            echo "Error: RECORDS" . $sqlrecord . "<br>" . mysqli_error($connection);
          }

      $_SESSION['success_message']=".";
       header("Location:./index.php");//!!
       exit();
      //echo "password updated";
    } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($connection);
    }
}else {//if not
//  echo 'not same';
  $_SESSION['error_message']="sssssssssssssss.";
}

}
  //if_password_not_matched
  // if($var_password1=$var_password2){
  //
  // // $_SESSION['error_message']="sssssssssssssss.";
  // echo 'same';
  // }
//   else { //if_password matched
//     // session_start();
//     // $_SESSION['success_message']="sssssssssssssss.";
// echo 'ok';
//
//   }
//
// }



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
  <input style="display:none;" name="loguser_id" value="<?php echo $var_id;  ?>">

  <div class="container py-4 min-vh-100 d-flex flex-column justify-content-center">
    <div class="animate__animated animate__slideInDown row">
      <div class="col-xl-10 mx-auto">
        <div class="card border-0 shadow">
          <div class="row no-gutters justify-content-center">



          <!-- WELCOME -->
          <div class="col-sm-6 text-center py-5">
            <!--ADD SPACE -->
            <div style="padding: 10px;"></div>


            <!--ERROR MESSAGE-->
            <div class="col-9 mx-auto text-center">
              <div class="">

                <?php
                if(isset($_SESSION['error_message']))
                {
                ?>
                <body onload="error('top','center')">
                <?php
                unset($_SESSION['error_message']);
                }
                ?>


              </div>
              <div class="">
              <?php

              if(isset($_SESSION['success_message'])) {
              ?>

              <body onload="success('top','center')">
              <?php unset($_SESSION['success_message']);
              }
              ?>
                </div>
            </div>

                <h4>Enter your new password.<h4>
                <!--ADD SPACE -->
              <div style="padding: 8px;"></div>

                <form action="updatepassword.php" method="POST" role="form">
                  <div class="form-group">

                    <!--DROPDOWN -->


                    <!--INPUT -->

                    <div class="form-group">
                      <div class="col-11   mx-auto">
                        <input name="var_password1" type="password" style="border-radius: 8px;" type="text" class="form-control"
                        id="inputEmailForm" placeholder="New password" value="" required="" autofocus="">
                      </div>
                    </div>

                    <div style="padding: 3px;"></div>

                    <!--INPUT -->
                    <div class="form-group">
                      <div class="col-11   mx-auto">
                        <input name="var_password2" type="password" style="border-radius: 8px;" type="text" class="form-control"
                        id="inputEmailForm" placeholder="Confirm new password" value=""required="" autofocus="">
                      </div>
                    </div>


                    <div class="form-group justify-content-center">
                      <div class="pb-3 pt-2">
                        <button style="border-radius: 12px;" name="submit" type="submit"
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
    function success() {
      $.notify({

        message:'Account Confirmed.'
      }, {
        // settings
        offset: 50,
        type: 'success',
        placement: {
          from: "top",
          align: "center"
        }
      });
    }


    </script>
    <script>
    function error() {
      $.notify({

        message:'Passwords did not match!'
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
