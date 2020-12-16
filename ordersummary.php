<!doctype html>
<?php
session_start();
include 'z_execute/connection.php';
//LOAD DATA
$sql1="SELECT order_log_id,c.name,p.payment_type,r.type_name,date from tbl_orderdetails
join tbl_customer c using(customer_id)
join tbl_customertype r using(customertype_id)
JOIN tbl_payment p using(payment_id) ORDER BY order_log_id DESC";
$results1 = mysqli_query($connection, $sql1);


?>
<html lang="en">
<head>
	<?php include 'z_otherUI/mainhead.php'; ?>
	<?php include 'z_otherUI/ordersummarymodalstyle.php'; ?>

</head>
<body>

<div class="wrapper">
  <?php include 'z_otherUI/sidebar_ordersum.php' ?>

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
			                        <a class="navbar-brand" >Product Lists</a>
			                    </div>
			                    <div class="collapse navbar-collapse">
			                        <ul class="nav navbar-nav navbar-left">



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
			                                    <li><a href="./add_productform.php"><img src="img/package.svg" alt="Kiwi standing on oval" style="height: 3rem; width:3rem;"> Returned Products </li>
			                                 

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
										if(isset($_SESSION['error_message']))
										{
										?>
										<body onload="success('top','center')">
										<?php
										unset($_SESSION['error_message']);
										}
										?>

									</div>

                    <div class="col-md-12">
                        <div class="card">
                            <div   class="header">
                                <h4  class="title">Order Details</h4>
                            </div>
                            <div class="content">
                                <form>
																	  <div class="content table-responsive">
																	<table class="table table-striped">
																			<thead>
																				<tr>
																					<th>Order Log</th>
																					<th>Client Name</th>
																					<th>Payment</th>
																					<th>Discounts</th>
																					<th>Date</th>
																					<th>Action</th>
																				</tr>
																			</thead>

																			<?php


																			while ($row1 = mysqli_fetch_assoc($results1)) {
																				// code...

																			 ?>
																				<tr>
																				<td><?php echo $row1['order_log_id']; ?></td>
																				<td><?php echo $row1['name']; ?></td>
																					<td><?php echo $row1['payment_type']; ?></td>
																					<td><?php echo $row1['type_name']; ?></td>
																					<td><?php echo $row1['date'] ?></td>
																					<td><a type="button" style=" padding:5px 15px 5px 15px;"class="btn btn-info btn-fill" data-toggle="modal" data-id=<?php echo $row1['order_log_id']; ?> data-target="#exampleModals"><i style="font-size:20px;" class="fad fa-eye"></i></a></td>
																			</tr>
																			<?php
																		}


																			 ?>
																	</table>
																	</div>
                                </form>
                            </div>
                        </div>
                    </div>


<!-- MODAL -->






                </div>
            </div>

						<div class="container demo">
						    <div class="text-center">

						    </div>
						    <div class="modal left fade" id="exampleModals" tabindex="" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
						        <div class="modal-dialog" role="document">
						            <div class="modal-content">

															<div class="dash">
																	<!-- Content goes in here -->
															</div>


						            </div>
						        </div>
						    </div>
						</div>






        </div>



    </div>
</div>


</body>

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
        url: "ordersummary0.php",
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
function error() {
	$.notify({
		message:'password did not match!'
	}, {
		// settings
		offset: 30,
		type: 'danger',
		placement: {
			from: "top",
			align: "center"
		}
	});
}

function success() {
	$.notify({
		message:'Product successfully tagged as returned.'
	}, {
		// settings
		offset: 30,
		type: 'info',
		placement: {
			from: "top",
			align: "right"
		}
	});
}
</script>
</html>
