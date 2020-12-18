<?php
include 'z_execute/connection.php';
session_start();


$var_orderlogid=$_POST['thisorderlog'];
echo $var_orderlogid. "<br>";
// echo $_SESSION['username']."<br>";
if(isset($_POST['submit'])){
$SQLPASSWORD="SELECT password from tbl_login where username='admin'";
$SQLPASSWORDRES = mysqli_query($connection, $SQLPASSWORD);
$ROWRES = mysqli_fetch_assoc($SQLPASSWORDRES);
$VARPASS=$ROWRES['password'];
$X = $_POST['thispassword'];//PASSWORD

// echo $VARPASS;
// echo $X;

if ($VARPASS==$X) {
  $var_orderlogid2=$_POST['thislogid'];//FROM FROM INPUT
  $var_sessionid=$_SESSION['username'];
  $sql2="SELECT USER_ID from tbl_LOGIN where username='$var_sessionid';";
  $result2 = mysqli_query($connection, $sql2);
  if(!$result2){
  echo "Error: " . $sql2 . "<br>" . mysqli_error($connection);
  }else{
    $row2 = mysqli_fetch_assoc($result2);
    $var_sessionid0=$row2['USER_ID'];//get
    // echo $row2['USER_ID'];
    // echo $var_sessionid0."<br>";
  }

  date_default_timezone_set("Singapore");
  $date_today=date('Y-m-d h:m:s');


  $sql="SELECT order_log_id,product_id,qty from tbl_orderline where order_log_id='$var_orderlogid2'";
  $result = mysqli_query($connection, $sql);
  if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
      //GET ALL
      $varlog_id= $row["order_log_id"];
      $varprodid= $row["product_id"];
      $varqty=$row["qty"];
      // echo "id: " . $row["order_log_id"]. " - product_id: " . $row["product_id"]. "- qty: " . $row["qty"]. "<br>";
      $SQL3 ="INSERT INTO TBL_RETURNED(returnedby_id,orderline_id,product_id,Quantity,date) VALUES ('$var_sessionid0','$var_orderlogid2','$varprodid','$varqty','$date_today');";
      if (!mysqli_query($connection, $SQL3)) {
        echo "Error: " . $SQL3 . "<br>" . mysqli_error($connection);
      }
      else {
          $SQL4 ="UPDATE tbl_orderdetails SET STATUS='Returned' where order_log_id='$var_orderlogid2'";
          if (!mysqli_query($connection, $SQL4)) {
            echo "Error: " . $SQL4 . "<br>" . mysqli_error($connection);
          }
          else {
              header("Location:./ordersummary.php");
          }


      }
    }
  } else {
    echo "0 results";
  }
  echo "MACTHDE!";
  $_SESSION['success_message']="Invalid username or password.";
  header("Location:./ordersummary.php");
  exit();
}else {
  echo "NOT MATCHED!";
  $_SESSION['error_message']="Invalid username or password.";
  header("Location:./ordersummary.php");
  exit();
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

                 <h4>Enter your password to confirm.<h4>
                 <!--ADD SPACE -->
               <div style="padding: 8px;"></div>

                 <form action="return.php" method="POST" role="form">
                   <div class="form-group">

                     <!--DROPDOWN -->


                     <!--INPUT -->

                     <div class="form-group">
                       <div class="col-11   mx-auto">
                         <input name="thispassword" style="border-radius: 8px;" type="password" class="form-control"
                         id="inputEmailForm" placeholder="password" value="" required="" autofocus="">
                       </div>
                     </div>

                     <div style="padding: 3px;"></div>

                     <!--INPUT for val -->

                     <input style="display:none;" name="thislogid" value="<?php echo $var_orderlogid ?>">


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
     function error() {
       $.notify({
         message:'password did not match!'
       }, {
         // settings
         offset: 30,
         type: 'danger',
         placement: {
           from: "top",
           align: "right"
         }
       });
     }
     </script>

     </html>
