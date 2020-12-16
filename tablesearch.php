<!doctype html>
<html lang="en">
<?php
include 'z_execute/connection.php';
session_start();
$var_search=$_POST['thissearch'];
//echo $var_search;

$sql="SELECT p.product_id,p.name,p.description,p.price,p.sku,s.company_name,p.status_id,stocks,date_added,u.unit_type
from tbl_product p
join tbl_supplier s using(supplier_id)
join tbl_pricing u on u.unit_id=p.price_type
where p.name like '%$var_search%' or description like '%$var_search%' or company_name like '%$var_search%';";
$result = mysqli_query($connection, $sql);
if(!$result ){
  echo "Error: " . $sql . "<br>" . $connection->error;
}
else {
//
}

?>
<head>
  <?php include 'z_otherUI/mainhead.php' ?>
</head>

<body>

    <div class="wrapper">
        <?php include 'z_otherUI/sidebartables.php' ?>


        <div class="main-panel">

          <nav class="navbar navbar-default navbar-fixed">
                          <div class="container-fluid">
                              <div class="navbar-header">
                                  <button type="button" class="navbar-toggle" data-toggle="collapse"
                                      data-target="#navigation-example-2">
                                      <span class="sr-only">Toggle navigation</span>
                                      <span class="icon-bar"></span>
                                      <span class="icon-bar"></span>
                                      <span class="icon-bar"></span>
                                  </button>
                                  <a  href="table.php"style="font-size: 30px; margin-top:-2px;" class="navbar-brand" ><i   class="fas fa-arrow-alt-square-left"></i></a>
                              </div>
                              <div class="collapse navbar-collapse">
                                  <ul class="nav navbar-nav navbar-left">
                                      <li>
                                          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                              <i class="fa fa-dashboard"></i>
                                              <p class="hidden-lg hidden-md">Dashboard</p>
                                          </a>
                                      </li>

                                      <li>
                                          <form id="searchform" method="POST" action="tablesearch.php" >  <!-- SEARCH INPUT -->
                                            <input  id="myInput" name="thissearch" style="margin-top:10px;" class="form-control result" placeholder="Search Items">
                                          </form>
                                      </li>

                                      <li>

                                          <i style="border:0px;  font-size: 20px; padding:20px;" class="fa fa-search" aria-hidden="true" ></i>

                                      </li>

                                  </ul>

                                  <ul class="nav navbar-nav navbar-right">

                                      <li class="dropdown  ">
                                          <a href="#" class="dropdown-toggle"  data-toggle="dropdown" >
                                              <p>
                                              <i class="fas fa-bars"></i>
                                                      &nbsp;
                                              </p>
                                          </a>
                                          <ul class="dropdown-menu">
                                              <li><a href="./add_productform.php"><i style="font-size:16px;"class="fas fa-cubes"></i>&nbsp;Add Product</a></li>
                                              <li><a href="./add_supplierform.php"><i class="fas fa-parachute-box"></i>&nbsp;Add Supplier</a></li>
                                              <li><a href="#">Temp</a></li>
                                              <li><a href="#">Temp</a></li>
                                              <li><a href="#">Temp</a></li>
                                              <li class="divider"></li>
                                              <li><a href="#">Temp</a></li>
                                          </ul>
                                      </li>

                                  </ul>
                              </div>
                          </div>
                      </nav>


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
