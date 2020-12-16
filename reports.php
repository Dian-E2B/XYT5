<!doctype html>
<html lang="en">

<?php
include 'z_execute/connection.php';
session_start();
?>

<head>
<?php include 'z_otherUI/mainhead.php' ?>
<style>
.button3 {
  background-image: linear-gradient(to right, #02AAB0 0%, #00CDAC  51%, #02AAB0  100%) !important;
  margin: 10px;
           padding: 15px 45px !important;
           text-align: center !important;
           text-transform: uppercase !important;
           transition: 0.5s !important;
           background-size: 200% auto !important;
           color: white !important;
           box-shadow: 0 0 20px #eee !important;
           border-radius: 10px !important;
           display: block !important;
}
.button3:hover {
            background-position: right center; /* change the direction of the change here */
            color: #fff;
            text-decoration: none;
          }

.button4 {
  background-image: linear-gradient(to right, #1A2980 0%, #26D0CE  51%, #1A2980  100%) !important;
  margin: 10px;
           padding: 15px 45px !important;
           text-align: center !important;
           text-transform: uppercase !important;
           transition: 0.5s !important;
           background-size: 200% auto !important;
           color: white !important;
           box-shadow: 0 0 20px #eee !important;
           border-radius: 10px !important;
           display: block !important;
}
.button4:hover {
            background-position: right center; /* change the direction of the change here */
            color: #fff;
            text-decoration: none;
          }


</style>
</head>

<body>

  <div class="wrapper">
<?php include 'z_otherUI/sidebar_reports.php' ?>

    <div class="main-panel">
      <?php include 'z_otherUI/navbar_reports-plain.php' ?>

      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">

                <div class="col-md-10 header">
                  <h4 class="title">Reports</h4>
                </div>

                <div class="row"></div>

                <div class="content table-responsive">
                  <div class="row">



                    <div  class="col-md-3">
                      <div  class=" form-group">
                        <button  type="submit" class="btn button3 btn-fill "
                        style="min-width:180px; height: 100px; background-color:green; border: none;" onClick="window.location.href='inv-reports.php'"><img src="img/inventory.svg" alt="Kiwi standing on oval" style="height: 5rem; width:5rem; margin-right: 8px;">Inventory</button>
                      </div>
                    </div>

                    <div  class="col-md-3">
                      <div   class=" form-group">
                        <button type="submit" class="btn btn-primary button4 btn-fill  "
                        style="min-width: 230px; height: 100px; border: none;" onClick="window.location.href='sales-reports.php'"><img src="img/tag.svg" alt="Kiwi standing on oval" style="height: 4.5rem; width:4.5rem; margin-right: 8px;">Sales</button>
                      </div>
                    </div>

                  </div>
                </div> <!-- content table-responsive -->
              </div> <!-- card -->
            </div> <!-- col-md-12  -->
          </div> <!-- first row  -->
        </div> <!-- container-fluid -->
      </div> <!-- content -->
    </div> <!-- main-panel -->
  </div> <!-- wrapper -->

</body>


<!--   Core JS Files   -->
<script src="assets/js/jquery-3.5.1.min.js" type="text/javascript"></script>
<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>


<!-- Page level custom scripts -->
<script src="js/demo/chart-area-demo.js"></script>
<script src="js/demo/chart-pie-demo.js"></script>



<!--  Charts Plugin -->
<script src="assets/js/chartist.min.js"></script>




</html>
