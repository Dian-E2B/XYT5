<!DOCTYPE html>
<html lang="en">
<?php
include 'z_execute/connection.php';
session_start();

if(isset($_SESSION['user_id']))//!!
{
  //get this session!
$var_id = $_SESSION['user_id'];//!!
  //JUST LOAD DATA
 $sql2="select quest_id,question from tbl_questions";//!!
 $result2 = mysqli_query($connection, $sql2);//!!
 if ($result2) {//!!
 } else {
   echo "Error: " . $sql2 . "<br>" . mysqli_error($connection);
 }
 }




if(isset($_POST['submit']))//!!
{
  $var_question=$_POST['var_question'];//!!
  $var_answer=$_POST['var_answer'];//!!
  //check_if_matched
  $sql3="select $var_id  from tbl_login  where question_id='$var_question' AND sec_answer='$var_answer';";//!!
  $result3 = mysqli_query($connection, $sql3);//!!
  if (!$result3) {//fixed
     echo "Error: " . $sql3 . "<br>" . mysqli_error($connection);//!!
  }
  else {
    //CHECK IF WITH RESULT
    if (mysqli_num_rows($result3) > 0) {//!!
    $row = mysqli_fetch_assoc($result3);//!!
    //echo "MATCHED!";
    //go to page

    $_SESSION['success_message']=".";
     header("Location:./updatepassword.php");//!!
     exit();
    }
    else {//IF NO RESULT
      //echo "Not macthed with id";

      $_SESSION['error_message']=".";

      //session_write_close();
    }}
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
              <h1 class="font-weight-bold">XYT</h1>
              <a class="pointer small my-3">Confirm your account</a>
              <button id="btnsignup" style="display:none;" type="submit"
              class="btn btn-outline-light rounded-pill">Sign-up</button>
              </div>
            </div>

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

                <!--ADD SPACE -->
              <div style="padding: 8px;"></div>

                <form name="main_form" action="confirm_account.php" method="POST" role="form">
                  <div class="form-group">
                    <input style="display:none;" name="loguserid" value="<?php echo $var_id;  ?>"></input>
                    <!--DROPDOWN -->
                    <div class="col-11 mx-auto">
                      <select name="var_question" class="custom-select">
                        <option selected>Choose your security question</option>
                        <?php
                        while ($row = mysqli_fetch_assoc($result2)){
                        ?>
                        <option value="<?php echo $row['quest_id'] ?>">
                        <?php echo $row['question'] ?></option>
                        <?php
                        }
                        ?>
                        </select>
                      </div>
                    </div>

                    <!--INPUT -->
                    <div class="form-group">
                      <div class="col-11   mx-auto">
                        <input name="var_answer" style="border-radius: 12px;" type="text" class="form-control"
                        id="inputEmailForm" placeholder="Answer" required="" autofocus="">
                      </div>
                    </div>


                    <div class="form-group justify-content-center">
                      <div class="pb-3 pt-2">
                        <button style="border-radius:12px;"  onclick="submitForms()"   name="submit" type="submit"
                        class="btn btn-primary">Confirm</button>
                      </div>
                    </div>
                  </form>

                  <form id="form2" style="display:none;" method="POST" action="updatepassword.php">
                    <input type="hidden" name="loginid" value="<?php echo $var_id;?>" >
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

        message:'Account matched.'
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

        message:'Question or Answer did not match!'
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
