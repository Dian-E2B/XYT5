<!doctype html>
<?php
include 'z_execute/connection.php';
$sql_in_icons="Select product_id,name,price from tbl_product where status_id=1 and stocks>0";
$result_icons = $connection->query($sql_in_icons);
session_start();

if (isset($_POST['submit'])) {
	$getproductid=$_POST['thisprodid'];
	$getproductqty=$_POST['thisqty'];

	 //echo $getproductqty;
	 //echo $getproductid;
	$sql="select product_id from tbl_product where product_id='$getproductid';";
	$result = mysqli_query($connection, $sql);

if (mysqli_num_rows($result)> 0 ) {
  //echo "with results";

} else {
  //echo "0 results";
}

}

?>



<html lang="en">

<head>
    <?php include 'z_otherUI/mainhead.php' ?>
    <style>
    body {
        background: rgba(43, 43, 233, 0.15);
    }




    .modal .modal-dialog-aside {
        width: 350px;
        max-width: 80%;
        height: 100%;
        margin: 0;
        transform: translate(0);
        transition: transform .2s;
    }

    .modal .modal-dialog-aside .modal-content {
        height: inherit;
        border: 0;
        border-radius: 0;
    }


    .modal .modal-dialog-aside .modal-content .modal-body {
        overflow-y: auto
    }

    .modal.fixed-left .modal-dialog-aside {
        margin-left: auto;
        transform: translateX(100%);
    }

    .modal.fixed-right .modal-dialog-aside {
        margin-right: auto;
        transform: translateX(-100%);
    }

    .modal.show .modal-dialog-aside {
        transform: translateX(0);
    }
    </style>
</head>

<body>

    <div class="wrapper">

				 <?php include 'z_otherUI/sidebar_icons.php' ?>


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
                        <a class="navbar-brand" href="#">List of  Products for sale</a>
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

                                <ul class="dropdown-menu">
                                    <li><a href="#">Notification 1</a></li>
                                    <li><a href="#">Notification 2</a></li>
                                    <li><a href="#">Notification 3</a></li>
                                    <li><a href="#">Notification 4</a></li>
                                    <li><a href="#">Another notification</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="">
                                    <i style="display:none;" class="fa fa-search"></i>
                                    <p class="hidden-lg hidden-md">Search</p>
                                </a>
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

                                    <li><a href="./yourcart.php"><i  class="fas fa-cart-arrow-down"></i>&nbsp;View cart</a></li>

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
												if(isset($_SESSION['exceedqty_message']))
												{
												?>
												<body onload="errorexceed('top','center')">
												<?php
												unset($_SESSION['exceedqty_message']);
												}
												?>


											</div>
                        <div class="col-md-12">



												<div class="card">
          								<div class="content all-icons">
														<form>
																<div class="row">
																		<?php
										            			while($rowprods=mysqli_fetch_assoc($result_icons))
											            		{
											            		?>
                                            <div style="padding-left:5px; padding-right:5px;"class="font-icon-list col-md-3">
                                                <div style="border-radius:15px;" class="font-icon-detail ">

                                                    <b style="font-size: 20px;"><?php echo $rowprods['name'] ?></b>
                                                    <p style="font-size: 13px; padding-top:5px;">₱
                                                        <?php echo $rowprods['price'] ?></p>


                                                    <button  type="button" style="padding: 10px;position:relative;border:none;background-color: darkgreen;" data-toggle="modal"
                                                        data-target="#stocksformmodal" class="btn-block"
                                                        data-id="<?php echo $rowprods['product_id'] ?>" value=""> <i
                                                            style="color:yellowgreen;font-size:30px; "
                                                            class="fas fa-cart-plus"></i></button>

                                                    <a style="display:none;" id="btncart2" class="col-md-3 pull-right"
                                                        href="" data-toggle="modal" data-id=""
                                                        data-target="#modal_aside_right"><i style="font-size:25px;"
                                                            class="fas fa-eye"></i></a>

                                								</div>
                            								</div>
                            				<?php
									                    }
								                      ?>

																	</div>
																</form>
															</div>
														</div>




                    <div class="modal fade" id="stocksformmodal" role="dialog" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header border-bottom-0">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    Enter Quantity:
                                </div>
                                <div class="cart">
                                    <!-- Content goes in here -->
                                </div>

                            </div>
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
$(document).ready(function() {
    $(".dropdown-toggle").dropdown();
});

$(".btncart1").on("click", function(callback) {
    //var data1=$(".uname").val();
    var fired_button = $(this).val();
    var dataString = 'id=' + fired_button;

    $.ajax({
        url: 'add_to_cart.php',
        method: 'GET',
        data: dataString,
        cache: true,

        success: function(data) {
            console.log(data);
            // alert(data);
						callback(data);
        },

        error: function(xhr, textStatus, error) {
            alert(xhr.statusText);
            console.log(textStatus);
            console.log(error);
        }
    });


});

$('#stocksformmodal').on('show.bs.modal', function(event) {

    var button = $(event.relatedTarget) // Button that triggered the modal
    var recipient = button.data('id') // Extract info from data-* attributes
    var modal = $(this);
    var dataString = 'id=' + recipient;

    $.ajax({
        type: "GET",
        url: "add_to_cart_stocksmodal.php",
        data: dataString,
        cache: false,
        success: function(data) {
            console.log(data);
            modal.find('.cart').html(data);
        },
        error: function(err) {
            console.log(err);
        }
    });
})

$('#stocksformmodal').on('hide.bs.modal', function() {
    $('#stocksformmodal').removeData();
})


function error() {
  $.notify({
		icon: 'fas fa-cart-arrow-down',
    message:'Sorry your cart is empty.'
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

function errorexceed() {
  $.notify({
		icon: 'fas fa-exclamation-circle',
    message:'Quantity exceeds available stocks.'
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
