<!doctype html>
<html lang="en">
<?php
include 'z_execute/connection.php';

$sqlshow_products="select p.product_id,p.name,p.description,p.price,p.sku,s.company_name,status_id,stocks,date_added from tbl_supplier s join tbl_product p using(supplier_id)";
$sqlshow_allstatus="select status_id,status_name from tbl_status;";
$sqlshow_allunit="select unit_id,unit_type from tbl_pricing;";
$sqlshow_allsuppliers="select supplier_id,company_name from tbl_supplier;";
session_start();
$result = $connection->query($sqlshow_products);

$resultstats = $connection->query($sqlshow_allstatus);

$resultunits = $connection->query($sqlshow_allunit);

$resultsups = $connection->query($sqlshow_allsuppliers);
?>

<html lang="en">

<head>
    <?php include 'z_otherUI/mainhead.php' ?>
</head>

<body>
    <div class="wrapper">
        <!-- Start of sidebar -->
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
                <li class="active">

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
            </ul>
        </div>
        </div>
        <!-- End of sidebar -->

        <div class="main-panel">
            <!-- Start of navbar -->
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
                        <a class="navbar-brand" href="#"></a>
                    </div>
                    <div class="collapse navbar-collapse">
                        <ul class="nav navbar-nav navbar-left">
                            <li>
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-dashboard"></i>
                                    <p class="hidden-lg hidden-md">Dashboard</p>
                                </a>
                            </li>
                            <li class="dropdown">
                            </li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <li class="separator hidden-lg hidden-md"></li>
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- END of navbar -->

            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="header">
                                    <h4 class="title">Product Details</h4>
                                </div>
                                <div class="content">
                                    <!-- START FORM -->
                                    <form method="POST" action="z_execute/add_product.php">

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div style="margin-bottom: 5px;" class="form-group">
                                                    <label>NAME</label>
                                                    <input name="thispname" autocomplete=" " autofill="false" type="text"
                                                        class="form-control" placeholder="Product Name">

                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div style="margin-bottom: 5px;" class="form-group">
                                                    <label for="exampleInputEmail1">Supplier</label>
                                                    <select class="form-control"  name="thissupplier">
                                                        <?php
										                                             while($rowsups=mysqli_fetch_assoc($resultsups))
											                                    {
											                                   ?>
                                                        <option value="<?php echo $rowsups['supplier_id']; ?>"><?php echo $rowsups['company_name']; ?>
                                                        </option>
                                                        <?php
									                                             }
								                                         ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div style="margin-bottom: 5px;" class="form-group">
                                                    <label>Date Added</label>
                                                    <input disabled type="text" class="form-control"
                                                       name="" placeholder="Date Added">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div style="margin-bottom: 5px;" class="form-group">
                                                    <label>Added By</label>
                                                    <input readonly type="text" value="<?php echo $_SESSION['username'];  ?>" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div style="margin-bottom: 5px;" class="form-group">
                                                    <label>Status</label>
                                                    <select class="form-control"  name="thisstatus"
                                                        placeholder="Program">
                                                        <?php
										                                              while($rowstats=mysqli_fetch_assoc($resultstats))
											                                                       {
											                                                                    ?>
                                                        <option value="<?php echo $rowstats['status_id']; ?>"><?php echo $rowstats['status_name']; ?></option>
                                                        <?php
									                                             }
								                                                       ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>



                                        <div class="row">
                                            <div class="col-md-4">
                                                <div style="margin-bottom: 5px;" class="form-group">
                                                    <label>Price Per Unit</label>
                                                    <input type="text" name="thisprice" class="form-control" placeholder="Price of Unit" value="">
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div style="margin-bottom: 5px;" class="form-group">
                                                    <label>Priced</label>
                                                    <select class="form-control" name="thisunits"
                                                        placeholder="status">
                                                        <?php
										                                              while($rowunits=mysqli_fetch_assoc($resultunits))
											                                                       {
											                                                                    ?>
                                                        <option value="<?php echo $rowunits['unit_id']; ?>"><?php echo $rowunits['unit_type']; ?>
                                                        </option>
                                                        <?php
									                                             }
								                                                       ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div style="margin-bottom: 5px;" class="form-group">
                                                    <label>SKU</label>
                                                    <input name="thissku" type="text" class="form-control" placeholder="SKU of item">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div style="margin-bottom: 5px;" class="form-group">
                                                    <label>Stocks</label>
                                                    <input name="thisstocks" type="text" class="form-control" placeholder="Stocks">
                                                </div>
                                            </div>
                                          </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Description</label>
                                                    <textarea rows="3" class="form-control"
                                                        placeholder="Here can be your description"
                                                        value="Mike" name="thisdesc"></textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-info btn-fill pull-right" onclick="diplaynotof('top','center')">Add Product</button>
                                        <div class="clearfix"></div>
                                    </form>

                                    <!-- END FORM -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</body>

<script src="assets/js/jquery-3.5.1.min.js" type="text/javascript"></script>
<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
<!--  Charts Plugin -->
<script src="assets/js/chartist.min.js"></script>
<!--  Notifications Plugin    -->
<script src="assets/js/bootstrap-notify.js"></script>
<!--  Google Maps Plugin    -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
<!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
<script src="assets/js/light-bootstrap-dashboard.js?v=1.4.0"></script>
<!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
<script src="assets/js/demo.js"></script>
<script>
//     function diplaynotof() {
//         $.notify({
// 	// options
// 	message: 'Product Added'
// },{
// 	// settings
// 	type: 'success'
// });
// }

</script>
</html>
