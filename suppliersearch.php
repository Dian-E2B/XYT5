<!doctype html>
<html lang="en">
<?php
include 'z_execute/connection.php';
session_start();
$var_search=$_POST['thissearch'];//done!
//echo $var_search;//done!
$sql="Select supplier_id,company_name,email,phone,address,status_id from tbl_supplier where company_name like '%$var_search%'
or address like '%$var_search%';";
$result = mysqli_query($connection, $sql);
if(!$result ){
  echo "Error: " . $sql . "<br>" . $connection->error;
}
else {
//
// while($row = $result->fetch_assoc()) {
//     echo "id: " . $row["supplier_id"]. " - Name: " . $row["company_name"]. " " . $row["phone"]. "<br>";}
}

?>
<head>
    <?php include 'z_otherUI/mainhead.php' ?>
</head>

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
        <li>
          <a href="table.php">
              <i class="fad fa-clipboard"></i>
              <p>Product Lists</p>

          </a>
        </li>
        <li  class="active">

          <a href="supplier_table.php">
              <i class="fad fa-dolly"></i>
              <p>Suppliers</p>
          </a>
          </li>
        <li >
          <a href="icons.php">
              <i class="fal fa-money-check-edit-alt"></i>
              <p>Sales</p>
          </a>
        </li>
        <li>
            <a href="icons.php">
                <i class="pe-7s-cash"></i>
                <p>Sales</p>
            </a>
        </li>
        <li>
          <a href="ordersummary.php">
              <i class="fal fa-truck"></i>
              <p>Orders</p>
          </a>
        </li>
      
    </ul>
</div>
</div>


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
                                    <table class=" table table-hover table-striped">


                                        <thead>
                                            <th style="display:block">ID</th>
                                            <th>Name</th>
                                            <th>email</th>
                                            <th>phone</th>
                                            <th>address</th>
                                            <th>status</th>
                                            <th>check</th>
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
<script src="assets/js/jquery-3.5.1.min.js" type="text/javascript">
</script>
<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
<!--  Charts Plugin -->
<script src="assets/js/chartist.min.js"></script>
<!--  Notifications Plugin    -->
<script src="assets/js/bootstrap-notify.js"></script>
<!--  Google Maps Plugin    -->
<!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
<script src="assets/js/light-bootstrap-dashboard.js"></script>
<!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
<script src="assets/js/demo.js"></script>
<script>
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
