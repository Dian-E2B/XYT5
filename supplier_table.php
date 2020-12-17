<!doctype html>
<html lang="en">
<?php
include 'z_execute/connection.php';
session_start();
$sqlshow_suppliers="Select supplier_id,company_name,email,phone,address,status_id from tbl_supplier order by status_id desc;";
$result = $connection->query($sqlshow_suppliers);

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
      <?php include 'z_otherUI/sidebar_suppliers.php' ?>


        <div class="main-panel">
            <?php include 'z_otherUI/supplierformnavbar.php' ?>

            <div class="content">
                <div class="container-fluid">
                    <div class="row">

                      <div class="">
                      <?php

                      if(isset($_SESSION['success_message'])) {
                      ?>

                      <body onload="success('top','center')">
                      <?php unset($_SESSION['success_message']);
                      }
                      ?>
                        </div>
                        <div class="">
                        <?php

                        if(isset($_SESSION['success_added'])) {
                        ?>

                        <body onload="successadded('top','center')">
                        <?php unset($_SESSION['success_added']);
                        }
                        ?>
                          </div>

                        <div class="col-md-12">
                            <div class="card">
                                <div class="col-md-10 header">
                                    <h4 class="title">Suppliers</h4>
                                </div>

                                <div class="content table-responsive">
                                    <table id="dataTable" class="table table-hover table-striped"  width="100%">


                                        <thead>
                                            <th style="display:block">ID</th>
                                            <th>Name</th>
                                            <th>email</th>
                                            <th>phone</th>
                                            <th>address</th>
                                            <th>status</th>
                                            <th>Action</th>
                                        </thead>

                                        <tbody>
                                            <tr>
                                                <?php  while($row = $result->fetch_assoc()) {
                                            ?>
                                                 <td style="padding-right: 4px; word-wrap: break-word;">
                                                    <?php echo $row['supplier_id']; ?></td>
                                                <td style="padding-right: 0px; word-wrap: break-word;">
                                                    <?php echo $row['company_name']; ?></td>
                                                <td class="col-md-2"style="padding-right: 4px;  word-wrap: break-word;">
                                                    <?php echo $row['email']; ?></td>

                                                <td class="" style=" word-wrap: break-all;">
                                                    <?php echo $row['phone']; ?></td>


                                                <td class="text-md-left" style=" word-wrap: break-all;">
                                                    <?php echo $row['address']; ?></td>
                                                    <td class="text-md-left" style=" word-wrap: break-all;">
                                                    <?php echo $row['status_id']; ?></td>

                                                <td><button
                                                        style="padding-top:4px; padding-bottom: 4px; border-radius: 15px;"
                                                        class="btn btn-primary btn-fill" data-toggle="modal"
                                                        data-id=<?php echo $row['supplier_id']; ?>
                                                        data-target="#exampleModals"><i class="far fa-eye"></i></button>
                                                </td>
                                            </tr>
                                        </tbody>

                                        <?php

                                            }
                                        ?>
                                    </table>

                                </div>
                                <!-- Modal content-->
                                <div id="exampleModals" class="modal fade" data-backdrop="true">
                                    <div class="modal-dialog">

                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" >&times;</button>
                                                <h4 class="modal-title">Supplier Details</h4>
                                            </div>
                                            <div class="dash">
                                                <!-- Content goes in here -->
                                            </div>
                                        </div>
                                    </div>

                                </div>
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
$(document).ready(function(){
  $(".dropdown-toggle").dropdown();
});
$('#exampleModals').on('hide.bs.modal', function() {
    $('#exampleModals').removeData();
})

$('#dataTable').dataTable( {
  "searching": false

} );


$('#exampleModals').on('show.bs.modal', function(event) {

    var button = $(event.relatedTarget) // Button that triggered the modal
    var recipient = button.data('id') // Extract info from data-* attributes
    var modal = $(this);
    var dataString = 'id=' + recipient;

    $.ajax({
        type: "GET",
        url: "t.view_suppliers.php",
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

    message:'Supplier successfully updated!'
  }, {
    // settings
    offset: 50,
    type: 'success',
    placement: {
      from: "top",
      align: "right"
    }
  });
}

function successadded() {
  $.notify({

    message:'Supplier successfully added!'
  }, {
    // settings
    offset: 50,
    type: 'success',
    placement: {
      from: "top",
      align: "right"
    }
  });
}
</script>


</html>
