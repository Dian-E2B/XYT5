<!doctype html>
<html lang="en">
<?php
include 'z_execute/connection.php';
session_start();

  //from search(navbar.php)

  //LOAD DATA
        $sqlshow_records="SELECT * from tbl_records";
        $resultrecords = mysqli_query($connection, $sqlshow_records);
        //$row = mysqli_fetch_assoc($resultrecords)




?>
<head>
  <?php include 'z_otherUI/mainhead.php' ?>

<link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>
<style>
body:not(.modal-open){
  padding-right: 0px !important;
}
</style>
<body>

    <div class="wrapper">
      <div class="sidebar" data-color="blue">

      <!--   you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple" -->


      <div class="sidebar-wrapper">
          <div class="logo">
              <a class="simple-text">
                  <?php echo $_SESSION['username'];  ?>
              </a>
          </div>

          <ul class="nav">
              <li>
                  <a href="reports.php">
                    <i class="fas fa-chart-pie"></i>
                      <p>Reports</p>
                  </a>
              </li>
              <li >

                  <a href="table.php">
                      <i class="fad fa-clipboard"></i>
                      <p>Product Lists</p>

                  </a>

              <li>
                  <a href="supplier_table.php">
                      <i class="fad fa-dolly"></i>
                      <p>Suppliers</p>
                  </a>
              </li>
              <li>
                  <a href="icons.php">
                      <i class="fal fa-money-check-edit-alt"></i>
                      <p>Sales</p>
                  </a>
              </li>
              <li>
                  <a href="ordersummary.php">
                      <i class="fal fa-truck"></i>
                      <p>Orders</p>
                  </a>
              </li>
              <li class="active">
                  <a href="Records.php">
                    <i class="fad fa-cabinet-filing"></i></i>
                      <p>Records</p>
                  </a>
              </li>
          </ul>
      </div>
      </div>


        <div class="main-panel">


            <div class="content">
                <div class="container-fluid">
                    <div class="row">
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
                          if(isset($_SESSION['success_added']))
                          {
                          ?>
                          <body onload="successadded('top','center')">
                          <?php
                          unset($_SESSION['success_added']);
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
                        <div class="col-md-12">
                            <div class="card">
                                <div class="col-md-10 header">
                                    <h4 class="title">Logs</h4>
                                </div>

                                <div class="content table-responsive">
                                    <table   id="dataTable" class="table table-hover  table-bordered table-sm"  width="100%">


                                        <thead>
                                            <th>Date</th>
                                            <th>Actions</th>
                                            <th>User</th>
                                        </thead>
                                        <tbody style="padding:0px;">
                                          <?php  while($row = $resultrecords->fetch_assoc()) {
                                      ?>
                                            <tr>
                                              <td style="width:200px;">
                                                  <?php echo $row['Date']; ?></td>
                                                <td ><?php echo $row['Actions']; ?></td>
                                                <td ><?php echo $row['User_id']; ?></td>
                                            </tr>
                                            <?php

                                                }
                                            ?>
                                        </tbody>


                                    </table>

                                </div>
                                <!-- Modal content-->

                                <!--end of Modal content-->

                                <!-- Modal content-->

                                <!--end of Modal content-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<!--   Core JS Files   -->


<script src="assets/js/jquery-3.5.1.min.js" type="text/javascript"></script>
<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
<!--  Charts Plugin -->
<!--  Notifications Plugin    -->
<script src="assets/js/bootstrap-notify.js"></script>
<!--  Google Maps Plugin    -->
<!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
<script src="assets/js/light-bootstrap-dashboard.js"></script>
<!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->

   <!-- Page level plugins -->
   <script src="vendor/datatables/jquery.dataTables.min.js"></script>
   <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

   <!-- Page level custom scripts -->
   <script src="js/demo/datatables-demo.js"></script>
   <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="js/sb-admin-2.min.js"></script>
<script>

$('#dataTable').dataTable( {
//  "searching": false

} );


$(document).ready(function(){
  $(".dropdown-toggle").dropdown();
});

$('#exampleModals').on('hide.bs.modal', function() {
    $('#exampleModals').removeData();
})
$('#exampleModals').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var recipient = button.data('id') // Extract info from data-* attributes
    var modal = $(this);
    var dataString = 'id=' + recipient;

    $.ajax({
        type: "GET",
        url: "t.view_prodmodal.php",
        data: dataString,
        cache: false,
        success: function(data) {
            console.log(data);
            modal.find('.dash').html(data);
        },
        error: function(err) {
            console.log(err);
        }
    });
})

function success() {
  $.notify({
    message:'Product successfully updated.'
  }, {
    // settings
    offset: 30,
    type: 'success',
    placement: {
      from: "top",
      align: "right"
    }
  });
}
function successadded() {
  $.notify({
    message:'Product successfully added.'
  }, {
    // settings
    offset: 30,
    type: 'success',
    placement: {
      from: "top",
      align: "right"
    }
  });
}


</script>
</html>
