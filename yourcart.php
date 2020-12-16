<html>
<?php
include 'z_execute/connection.php';
session_start();
$sqlshow_allcart="select product_id,p.name,qty,c.price,subtotal from tbl_cart c join tbl_product p using(product_id) where qty > 0";
$result = mysqli_query($connection, $sqlshow_allcart);

if(mysqli_num_rows($result) == 0){
  $_SESSION['error_message']=".";
   header("Location:./icons.php");
   exit();
}


$sqlcalculate="SELECT sum(subtotal) AS totalitems from tbl_cart;";
$result2 = mysqli_query($connection, $sqlcalculate);
$row2 = $result2->fetch_assoc();

?>

<head>

  <?php include 'z_otherUI/mainhead.php'; ?>

</head>

<style>
input[type=none]:focus {
    background-color: whitesmoke;
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
              <li>
                <a href="table.php">
                    <i class="fad fa-clipboard"></i>
                    <p>Product Lists</p>

                </a>
              </li>
              <li>

                <a href="supplier_table.php">
                    <i class="fad fa-dolly"></i>
                    <p>Suppliers</p>
                </a>

            <li>
              <a href="icons.php">
                  <i class="fal fa-money-check-edit-alt"></i>
                  <p>Sales</p>
              </a>
            </li>
            <li class="active">
              <a href="ordersummary.php">
                  <i class="fal fa-truck"></i>
                  <p>Orders</p>
              </a>
            </li>

            
          </ul>
        </div>
      </div>


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
                        <a class="navbar-brand" href="#"></a>
                    </div>
                    <div class="collapse navbar-collapse">
                        <ul class="nav navbar-nav navbar-left">

                        </ul>

                        <ul class="nav navbar-nav navbar-right">

                            <li class="dropdown">

                                <ul class="dropdown-menu">

                                </ul>
                            </li>
                            <li>

                            </li>
                            <li class="separator hidden-lg hidden-md"></li>
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
                        elseif (isset($_SESSION['error_stocks']))
                        {
                        ?>
                        <body onload="errorstocks('top','center')">
                        <?php
                        unset($_SESSION['error_stocks']);
                        }
                          ?>
                      </div>

                        <div class="col-md-12">
                            <div class="card">
                                <div class="col-md-10 header">
                                    <h4 class="title">Products</h4>
                                </div>
                                <div class="content table-responsive">
                                <form id="tableform" method="post">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th style="font-size:13px">ID</th>
                                                <th style="font-size:13px" scope="col">Product</th>
                                                <th style="font-size:13px" scope="col">Available</th>
                                                <th style="font-size:13px; " scope="col" class="text-center">Quantity</th>
                                                <th style="font-size:13px" scope="col" class=""></th>
                                                <th style="font-size:13px" scope="col" class="text-right"></th>
                                                <th style="font-size:13px" scope="col" class="text-right">Price</th>
                                                <th style="font-size:13px" scope="col" class="text-center">Action</th>
                                        </thead>
                                        <tbody>
                                          <div class="table2">
                                            <tr>
                                              <?php while($row = $result->fetch_assoc()) {
                                              ?>

                                                <td class="example" style="font-size:15px:"><?php echo $row['product_id']; ?></td>
                                                <td style="font-size:15px"><?php echo $row['name']; ?></td>
                                                <td style="font-size:15px">In stock</td>
                                                <td style="font-size:15px;" class="text-center"><?php echo $row['qty']; ?></td>
                                                      <!-- PLUS AND MINUS BTN -->
                                                <td><button style="border:none; background:none;" class="btnadd" value="<?php echo $row['product_id']; ?>"><i style="font-size:25px; color: yellowgreen;" class="fas fa-plus-square"></i></button>&nbsp;&nbsp;
                                                  <button  style="border:none; background:none;" class="btnminus" value="<?php echo $row['product_id']; ?>"><i style="font-size:25px; color:red ;" class="fas fa-minus-square"></i></button></td>
                                                <td style="font-size:15px"></td>
                                                <td style="font-size:15px" class="text-right">
                                                <?php echo $row['price']; ?> ₱</td>
                                                <td style="font-size:15px" class="text-center">
                                                  <a href="yourcart0.php?deleteID=<?php echo $row['product_id']; ?>" class="btn btn btn-danger"><i class="fa fa-trash"></i></a>
                                                  </button> </td>
                                                </tr>

                                                <?php
                                              }

                                               ?>


                                                <tr>
                                                  <td></td>
                                                  <td></td>
                                                  <td></td>
                                                  <td></td>
                                                    <td></td>
                                                  <td style="font-size:15px; color:  blue"><strong>Subtotal</strong></td>
                                                  <td style="font-size:15px; color:  blue" class="text-right">
                                                      <strong><?php echo $row2['totalitems']?> ₱</strong>
                                                  </td>
                                                </tr>
                                            </div>
                                        </tbody>
                                    </table>
                                  </form>
                                </div>




                              <!-- END OF MOADAL -->
                          </div>

                        </div>
                        <div class="col mb-2">
                            <div class="row">
                                <div class="col-sm-12  col-md-6">
                                    <button onclick="location.href='icons.php'"
                                        class="btn btn-medium btn-block btn-fill">Continue Shopping</button>
                                </div>
                                <div class="col-sm-12 col-md-6 text-right">

                                  <button onclick="location.href = 'Checkout.php';" class="btn btn-medium btn-block btn-fill btn-success text-uppercase">
                                    Checkout
                                </button>

                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="text-light">
            <div class="container">

            </div>
        </footer>
    </div>
</body>

  <script src="assets/js/jquery-3.5.1.min.js" type="text/javascript"></script>
  <script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
<!--  Charts Plugin -->
  <script src="assets/js/chartist.min.js"></script>
<!--  Notifications Plugin    -->
  <script src="assets/js/bootstrap-notify.js"></script>
<!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
  <script src="assets/js/light-bootstrap-dashboard.js"></script>
<!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
  <script src="assets/js/demo.js"></script>
<script>
//FOR FROPDOWN
$(document).ready(function() {
    $(".dropdown-toggle").dropdown();
});
// FOR UI ID COLOR
$( document ).ready(function() {
    //console.log( "ready!" );
  var x = document.getElementsByClassName("example");
  var i;
  for (i = 0; i < x.length; i++) {
    x[i].style.color = "darkgray";
  }
});
//DELETE DATA FROM MODAL AFTER HIDDEN
$('#exampleModals').on('hide.bs.modal', function() {
    $('#exampleModals').removeData();
});
//IF CASH IS lower
function error() {
  $.notify({
    message:'Cash cannot be lower than total cost!'
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

function errorstocks() {
  $.notify({
    message:'Sorry this product is now out of stock!'
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

$(".btnadd").on("click", function() {
 //var data1=$(".uname").val();
 var fired_button = $(this).val();
  var dataString = 'id=' + fired_button;
  $.ajax({
    url: 'cart_plusquant0.php',
    method: 'GET',
    data: dataString,
	  cache: true,
    async:false,
      success: function(data) {
	     console.log(data);
      alert(data);
    },
    error: function(xhr, textStatus, error) {
      // alert(xhr.statusText);
      // console.log(textStatus);
      // console.log(error);
    }
  });
});

$(".btnminus").on("click", function() {
 //var data1=$(".uname").val();
 var fired_button = $(this).val();
  var dataString = 'id=' + fired_button;
  $.ajax({
    url: 'cart_minusquant.php',
    method: 'GET',
    data: dataString,
	  cache: true,
  async:false,
      success: function(data) {
	     console.log(data);
      //alert(data);
    },
    error: function(xhr, textStatus, error) {
      // alert(xhr.statusText);
      // console.log(textStatus);
      // console.log(error);
    }
  });
});


</script>

</html>
