<!DOCTYPE html>
<html lang="en">
<?php
include 'z_execute/connection.php';
session_start();

?>

<head>

  <?php
  include 'z_otherUI/secondhead.php';

  ?>

</head>
<body>
  <div class="container py-4 min-vh-100 d-flex flex-column justify-content-center">
    <div class="animate__animated animate__slideInDown row">
      <div class="col-xl-10 mx-auto">
        <div class="card border-0 shadow">
          <div class="row no-gutters justify-content-center">

            <!--IMAGE PART-->
            <div class="col-sm-6 rounded text-white text-center">
              <div class="bg-dark rounded p-5 h-100 d-flex flex-column align-items-center justify-content-center">
                <h1 class="font-weight-bold">XYT</h1>
                <a onclick=myFunction() style="cursor: pointer; "class="pointer small my-3">Want to start free?</a>
                <button  id="btnsignup" style="display:none;"   type="submit" class="btn btn-outline-light rounded-pill">Sign-up</button>
              </div>
            </div>

            <!-- WELCOME -->
            <div class="col-sm-6 text-center py-5">
              <h3 class="font-weight-bold">Welcome!</h3>

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

              <form action="z_execute/validate.php" method="POST" role="form">

                <!--Username textarea -->
                <div class="form-group">
                  <div class="col-8 col-sm-12 col-md-10 mx-auto">
                    <input name="user" style="border-radius: 12px;" type="text" class="form-control"
                    id="inputEmailForm" placeholder="Username" required="" autofocus="">
                    <div class="invalid-feedback">Oops, email is required</div>
                  </div>
                </div>

                <!-- Password textarea-->
                <div class="form-group">
                  <div class="col-8 col-sm-12 col-md-10 mx-auto">
                    <input name="pass" accept="" style="border-radius: 12px;" type="password" class="form-control"
                    id="inputPasswordForm" placeholder="Password" required="" autocomplete="no">
                    <div class="valid-feedback">Nice looks good!</div>
                    <div class="invalid-feedback">6 chars (1 upper, 1 lower &amp; numeric)</div>
                  </div>
                </div>

                <!-- Forgot Password -->
                <div class="form-group">
                  <div class="mx-auto">
                    <a href="forgotpassword.php" class="small text-dark">Forgot your password?</a>
                  </div>
                </div>

                <div class="form-group justify-content-center">
                  <div class="pb-3 pt-2">
                    <button style="border-radius: 12px;" type="submit" class="btn btn-primary">Sign-in</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Bootstrap core JavaScript-->
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
function myFunction() {
  var x = document.getElementById("btnsignup");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}


</script>
<script>
function success() {
  $.notify({

    message:'Password successfully changed.'
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
