<!doctype html>
<html lang="en">

<?php
include 'z_execute/connection.php';
session_start();

$start=$_SESSION['startdate'];
$end=$_SESSION['enddate'];
$product=$_SESSION['product'];
$payment=$_SESSION['payment'];

$sale=$_POST['saleable'];

$str_start = '';
$str_end = '';
$str_product ='';
$str_payment ='';
$str_sale = '';


if ($sale != "") {
  if ($sale == "desc") {
    $str_sale = "DESC";
  }
  else {
    $str_sale == "ASC";
  }
}

if ($start != "") {
  $str_start = "AND date BETWEEN '$start'";
}

if ($end != "") {
  $str_end = "AND '$end'";
}
if ($product != "") {
  $str_product = "AND name = '$product'";
}

if ($payment != "") {
  $str_payment = "AND payment_type = '$payment'";
}

$sql= "SELECT name, SKU, SUM(qty) AS qty, price, total
          FROM saleable
          WHERE qty >= 1
          $str_start
          $str_end
          $str_product
          $str_payment
          GROUP BY name
          ORDER BY qty $str_sale";
$saleable = $connection->query($sql);

?>

<head>
    <meta charset="utf-8" />
    <link rel="icon" type="image/png" href="assets/img/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>XYT - Sales Reports</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/css/animate.min.css" rel="stylesheet" />
    <link href="assets/css/light-bootstrap-dashboard.css" rel="stylesheet" />
    <link href="fontawesome/css/all.css" rel="stylesheet">
    <link href="assets/css/pe-icon-7-stroke.css" rel="stylesheet" />

</head>

<body>

  <div class="wrapper">
    <div class="sidebar" data-color="blue">
      <div class="sidebar-wrapper">
        <div class="logo">
          <a class="simple-text"><?php echo $_SESSION['username'];  ?></a>
        </div>

         <ul class="nav"> <!--sidebar nav -->
            <li class="active">
              <a href="reports.php">
                <i class="pe-7s-graph"></i><p>REPORTS</p>
              </a>
            </li>

            <li>
              <a href="table.php">
                  <i class="pe-7s-note2"></i><p>Product Lists</p>
              </a>
            </li>

            <li>
              <a href="supplier_table.php">
                  <i class="pe-7s-news-paper"></i><p>Suppliers</p>
              </a>
            </li>

            <li>
              <a href="icons.php">
                  <i class="pe-7s-cash"></i><p>Sales</p>
              </a>
            </li>
        </ul>

      </div> <!--sidebar wrapper -->
    </div> <!--sidebar -->

    <div class="main-panel">
      <?php include 'z_otherUI/navbar.php' ?>

      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">

                <div class="col-md-10 header">
                  <h4 class="title">Inventory Reports</h4>
                </div>

                <div class="row"></div>
                <div class="content table-responsive">

                  <!-- filters -->
                    <div class="row">
                      <form method="POST" action="sales-reports.php">
                      <div class="col-md-2">
                        <div style="margin-top:5px;" class="form-group">
                          <button type="submit" class="btn btn-primary btn-fill pull-right"
                          onClick="window.location.href='sales-reports.php'"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back to reports</button>
                        </div>
                      </div>

                      <div class="col-md-2">
                        <div style="margin-top:5px;" class="form-group">
                          <a href="#" id="btnExport" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" style="padding:9px;"><i
                                  class="fas fa-download fa-sm text-white-50"></i> Export report</a>
                        </div>
                      </div>
                    </form>
                  </div> <!-- filters -->


                  <!-- graph -->
                  <div class="row">
                    <div class="col-md-8">
                        <div id="columnchart" style="width: 900px; height: 500px;"></div>
                    </div>
                  </div> <!--  graph -->


                  <!-- table -->
                  <div class="content table-responsive">
                    <div class="row">
                      <table class="table table-hover table-striped" id="tblInventory">
                        <thead>
                          <th>Product</th>
                          <th>SKU</th>
                          <th>Quantity</th>
                          <th>Price Per Unit</th>
                          <th>Total Price</th>
                        </thead>

                        <tbody>
                          <tr>
                            <?php
                              $result = $connection->query($sql);
                              $total_row = $result->num_rows;

                              if($total_row > 0) {
                                foreach($result as $row) { ?>

                                  <tr>
                                    <td><?php echo $row['name']; ?></td>
                                    <td><?php echo $row['SKU']; ?></td>
                                    <td><?php echo $row['qty']; ?></td>
                                    <td><?php echo $row['price']; ?></td>
                                    <td><?php echo $row['total']; ?></td>
                                  </tr>

                              <?php
                                }
                              }

                              else { ?>
                                <tr>
                                  <td colspan="5" align="center">No data found.</td>
                                </tr>
                            <?php } ?>


                        </tbody>
                      </table>
                    </div>
                  </div> <!-- table -->

                </div> <!-- content table-responsive -->
              </div> <!-- card -->
            </div> <!-- col-md-12  -->
          </div> <!-- first row  -->
        </div> <!-- container-fluid -->
      </div> <!-- content -->
    </div> <!-- main-panel -->
  </div> <!-- wrapper -->

</body>


<!--   Core JS Files   -->
<script src="assets/js/jquery-3.5.1.min.js" type="text/javascript"></script>
<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
<!-- Page level custom scripts -->
<script src="js/demo/chart-area-demo.js"></script>
<script src="js/demo/chart-pie-demo.js"></script>
<!--  Charts Plugin -->
<script src="assets/js/chartist.min.js"></script>

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.22/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>

 <script type="text/javascript">
     $("body").on("click", "#btnExport", function () {
         html2canvas($('#tblInventory')[0], {
             onrendered: function (canvas) {
                 var data = canvas.toDataURL();
                 var docDefinition = {
                     content: [{
                         image: data,
                         width: 500
                     }]
                 };
                 pdfMake.createPdf(docDefinition).download("sales-data.pdf");
             }
         });
     });
 </script>


 <script type="text/javascript" src="https://www.google.com/jsapi"></script>
 <script type="text/javascript">
    google.load("visualization", "1", {packages:["corechart"]});
    google.setOnLoadCallback(drawChart);
    function drawChart() {
      var data = google.visualization.arrayToDataTable([
      ['Product', 'Sales'],
      <?php
      $exec = mysqli_query($connection,$sql);
      while($row = mysqli_fetch_array($exec)){
        echo "['".$row['name']."',".$row['qty']."],";
      }
      ?>

      ]);

      var options = {
        title: 'Sales (last 7 days)'
      };
      var chart = new google.visualization.LineChart(document.getElementById("columnchart"));
      chart.draw(data, options);
    }
 </script>



</html>
