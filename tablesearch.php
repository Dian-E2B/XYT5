<!doctype html>
<html lang="en">
<?php
include 'z_execute/connection.php';
session_start();
$var_search=$_POST['thissearch'];
//echo $var_search;

$sql="select p.product_id,p.name,p.description,p.price,p.sku,s.company_name,p.status_id,stocks,date_added,u.unit_type
from tbl_product p
join tbl_supplier s using(supplier_id)
join tbl_pricing u on u.unit_id=p.price_type
where p.name like '%$var_search%' or description like '%$var_search%';";
$result = mysqli_query($connection, $sql);
if(!$result ){
  echo "Error: " . $sql . "<br>" . $connection->error;
}
else {
//
}

?>
<head>
    <meta charset="utf-8" />
    <link rel="icon" type="image/png" href="assets/img/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>Light Bootstrap Dashboard by Creative Tim</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="assets/css/animate.min.css" rel="stylesheet" />

    <!--  Light Bootstrap Table core CSS    -->
    <link href="assets/css/light-bootstrap-dashboard.css" rel="stylesheet" />


    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="assets/css/demo.css" rel="stylesheet" />


    <!--     Fonts and icons     -->

    <link href="fontawesome/css/all.css" rel="stylesheet">
    <link href="assets/css/pe-icon-7-stroke.css" rel="stylesheet" />
</head>

<body>

    <div class="wrapper">
        <?php include 'z_otherUI/sidebartables.php' ?>


        <div class="main-panel">
            <?php include 'z_otherUI/navbar.php' ?>

            <div class="content">
                <div class="container-fluid">
                    <div class="row">

                        <div class="col-md-12">
                            <div class="card">
                                <div class="col-md-10 header">
                                    <h4 class="title">Products</h4>
                                </div>

                                <div class="content table-responsive">
                                    <table class="table table-hover table-striped">


                                        <thead>
                                            <th style="display:block">ID</th>
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th>Price</th>
                                            <th>Unit</th>
                                            <th>SKU</th>
                                            <th>Supplier</th>
                                            <th>Status</th>
                                            <th>Stocks</th>
                                            <th>Date Added</th>
                                            <th>Check</th>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <?php  while($row = $result->fetch_assoc()) {
                                            ?>



                                                 <td style="padding-right: 0px; word-wrap: break-word;">
                                                    <?php echo $row['product_id']; ?></td>
                                                <td style="padding-right: 0px; word-wrap: break-word;">
                                                    <strong><?php echo $row['name']; ?></strong></td>
                                                <td class="col-md-1"style="padding-right: 4px;  word-wrap: break-word;">
                                                    <?php echo $row['description']; ?></td>

                                                <td class="" style=" word-wrap: break-all;">
                                                    <?php echo $row['price']; ?></td>
                                                <td style=" word-wrap: break-all;"><?php echo $row['unit_type']; ?></td>
                                                <td style=" word-wrap: break-all;"><?php echo $row['sku']; ?></td>
                                                <td class=""
                                                    style="padding-left: 6px; padding-right: 0px; word-wrap: break-all;">
                                                    <?php echo $row['company_name']; ?></td>
                                                <td class="text-md-left" style=" word-wrap: break-all;">
                                                    <?php echo $row['status_id']; ?></td>
                                                <td class="text-md-left" style="word-wrap: break-all;">
                                                    <?php echo $row['stocks']; ?></td>
                                                <td><?php echo $row['date_added']; ?></td>

                                                <td><button
                                                        style="padding-top:4px; padding-bottom: 4px; border-radius: 15px;"
                                                        class="btn btn-primary btn-fill" data-toggle="modal"
                                                        data-id=<?php echo $row['product_id']; ?>
                                                        data-target="#exampleModals">
													                              <i class="far fa-eye"></i>
													                           </button>
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
                                                <h4 class="modal-title">Product Details</h4>
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
</script>


</html>
