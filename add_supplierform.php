<!doctype html>
<html lang="en">
<?php
include 'z_execute/connection.php';

$sqlshow_products="select p.product_id,p.name,p.description,p.price,p.sku,s.company_name,stocks,date_added from tbl_supplier s join tbl_product p using(supplier_id)";
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
                        <a href="dashboard.html">
                            <i class="pe-7s-graph"></i>
                            <p>temp</p>
                        </a>
                    </li>
                    <li >
                        <a href="user.html">
                            <i class="pe-7s-user"></i>
                            <p>temp</p>
                        </a>
                    </li>
                    <li class="active">
                        <a href="table.php">
                            <i class="pe-7s-note2"></i>
                            <p>Product List</p>
                        </a>
                    </li>
                    <li>
                        <a href="Supplier_table.php">
                            <i class="pe-7s-news-paper"></i>
                            <p>Suppliers</p>
                        </a>
                    </li>
                    <li>
                        <a href="icons.html">
                            <i class="pe-7s-science"></i>
                            <p>temp</p>
                        </a>
                    </li>
                    <li>
                        <a href="maps.html">
                            <i class="pe-7s-map-marker"></i>
                            <p>temp</p>
                        </a>
                    </li>
                    <li>
                        <a href="notifications.html">
                            <i class="pe-7s-bell"></i>
                            <p>temp</p>
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
                        <a class="navbar-brand" href="#">texthere</a>
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
                                    <h4 class="title">Supplier Details</h4>
                                </div>
                                <div class="content">
                                    <!-- START FORM -->
                                    <form method="POST" action="z_execute/add_supplier.php">

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div style="margin-bottom: 5px;" class="form-group">
                                                    <label>Company Name</label>
                                                    <input name="thissuppliername" autocomplete="off" autofill="off"
                                                        class="form-control" placeholder="Name">

                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div style="margin-bottom: 5px;" class="form-group">
                                                    <label for="exampleInputEmail1">Email</label>
                                                    <input name="thisemail" autocomplete="off" autofill="off" type="email"
                                                        class="form-control" placeholder="Supplier Email">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">


                                            <div class="col-md-4">
                                                <div style="margin-bottom: 5px;" class="form-group">
                                                    <label style="display:none;">Status</label>
                                                    <select style="display:none;" class="form-control"  name="thisstatus1"
                                                       >
                                                        <?php
										            while($rowstats=mysqli_fetch_assoc($resultstats))
											            {
											            ?>
                                                        <option value="<?php echo $rowstats['status_id']; ?>"  ><?php echo $rowstats['status_name']; ?></option>
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
                                                    <label>Phone</label>
                                                    <input type="text" name="thisphone" class="form-control" autocomplete="off" placeholder="Phone">
                                                </div>
                                            </div>


                                        </div>


                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Description</label>
                                                    <textarea rows="3" class="form-control"
                                                        placeholder="Here can be your description"
                                                        value="Mike" name="thisaddress"></textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-info btn-fill pull-right" onclick="diplaynotof('top','center')">Add Supplier</button>
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

<!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
<script src="assets/js/light-bootstrap-dashboard.js?v=1.4.0"></script>
<!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
<script src="assets/js/demo.js"></script>
<script>
//     function diplaynotof() {
//         $.notify({
// 	// options
// 	message: 'Supplier Added'
// },{
// 	// settings
// 	type: 'success'
// });
// }

</script>
</html>
