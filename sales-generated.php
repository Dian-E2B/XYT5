<!doctype html>
<html lang="en">

<?php
include 'z_execute/connection.php';
session_start();

$start=$_POST['startdate'];
$end=$_POST['enddate'];
$product=$_POST['product'];
$payment=$_POST['payment'];

$_SESSION['startdate'] = $start;
$_SESSION['enddate'] = $end;
$_SESSION['product'] = $product;
$_SESSION['payment'] = $payment;

$str_start = '';
$str_end = '';
$str_product ='';
$str_payment ='';

if ($start != "") {
  $str_start = "AND ord.date BETWEEN '$start'";
}

if ($end != "") {
  $str_end = "AND '$end'";
}
if ($product != "") {
  $str_product = "AND p.name = '$product'";
}

if ($payment != "") {
  $str_payment = "AND pay.payment_type = '$payment'";
}

$sql= "SELECT ord.order_log_id, p.name, p.SKU, ol.qty,
        	p.price, ol.qty*p.price AS total, pay.payment_type,
        	CAST(ord.date AS DATE) date
        	FROM tbl_orderline ol
        	LEFT JOIN tbl_product p ON ol.product_id = p.product_id
        	LEFT JOIN tbl_orderdetails ord ON ol.order_log_id = ord.order_log_id
        	LEFT JOIN tbl_payment pay ON ord.payment_id = pay.payment_id
        	WHERE ol.qty >= 1
          $str_start
          $str_end
          $str_product
          $str_payment
          EXCEPT
            SELECT ord.order_log_id, p.name, p.SKU, ol.qty,
            p.price, ol.qty*p.price AS total, pay.payment_type,
            CAST(ord.date AS DATE) date
            FROM tbl_orderline ol
            LEFT JOIN tbl_product p ON ol.product_id = p.product_id
            LEFT JOIN tbl_orderdetails ord ON ol.order_log_id = ord.order_log_id
            LEFT JOIN tbl_payment pay ON ord.payment_id = pay.payment_id
            WHERE pay.payment_type = 'cheque'
            AND ord.date > CURRENT_DATE - 4
          ";
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
    <?php include 'z_otherUI/sidebartables.php' ?>

    <div class="main-panel">
      <?php include 'z_otherUI/navbar.php' ?>

      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">

                <div class="col-md-10 header">
                  <h4 class="title">Sales Reports</h4>
                </div>

                <div class="row"></div>
                <div class="content table-responsive">

                  <!-- filters -->
                  <div class="row">
                    <form method="POST" action="sales-reports.php">

                      <div class="col-md-2">
                        <div class="form-group">
                          <label for="startdate">Start Date</label>
                          <input type="date" class="form-control" name="startdate" value="<?php echo $start; ?>" disabled>
                        </div>
                      </div>

                      <div class="col-md-2">
                        <div class="form-group">
                          <label for="enddate">End Date</label>
                          <input type="date" class="form-control" name="enddate" value="<?php echo $end; ?>" disabled>
                        </div>
                      </div>

                      <div class="col-md-2">
                        <div class="form-group">
                          <label for="product">Product</label>
                          <select class="form-control" name="product" disabled>
                            <option><?php echo $product; ?></option>
                          </select>
                        </div>
                      </div>

                      <div class="col-md-2">
                        <div class="form-group">
                          <label for="payment">Payment</label>
                          <select class="form-control" name="payment" disabled>
                            <option><?php echo $payment; ?></option>
                          </select>
                        </div>
                      </div>

                      <div class="col-md-1">
                        <div style="margin-top:25px;" class="form-group">
                          <button type="submit" class="btn btn-primary btn-fill pull-right" onClick="window.location.href='sales-reports.php'">Clear</button>
                        </div>
                      </div>

                      <div class="col-md-2">
                        <div style="margin-top:25px;" class="form-group">
                          <a href="#" id="btnExport" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" style="padding:9px;"><i
                                  class="fas fa-download fa-sm text-white-50"></i> Export report</a>
                        </div>
                      </div>
                      </form>
                    </div> <!-- filter row -->

                    <div class="row"> <!-- button -->
                      <form method="POST" action="sales-sort.php">

                      <div class="col-md-2">
                        <div class="form-group">
                          <label for="saleable">Saleable</label>
                          <select class="form-control" name="saleable">
                            <option></option>
                            <option value="asc">Low to high</option>
                            <option value="desc">High to low</option>
                          </select>
                        </div>
                      </div>

                      <div class="col-md-1">
                        <div style="margin-top:25px;" class="form-group">
                          <button type="submit" class="btn btn-primary btn-fill pull-right" onClick="window.location.href='sales-sort.php'">
                            <i class="fas fa-sort"></i> Filter</button>
                        </div>
                      </div>

                    </form> <!-- button row -->

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
                      <table class="table table-hover table-striped" id="tblSales">
                        <thead>
                          <th>Order #</th>
                          <th>Product</th>
                          <th>SKU</th>
                          <th>Quantity</th>
                          <th>Price Per Unit</th>
                          <th>Total Price</th>
                          <th>Payment Type</th>
                          <th>Date</th>
                        </thead>

                        <tbody>
                          <tr>
                            <?php
                              $result = $connection->query($sql);
                              $total_row = $result->num_rows;

                              if($total_row > 0) {
                                foreach($result as $row) { ?>

                                  <tr>
                                    <td><?php echo $row['order_log_id']; ?></td>
                                    <td><?php echo $row['name']; ?></td>
                                    <td><?php echo $row['SKU']; ?></td>
                                    <td><?php echo $row['qty']; ?></td>
                                    <td><?php echo $row['price']; ?></td>
                                    <td><?php echo $row['total']; ?></td>
                                    <td><?php echo $row['payment_type']; ?></td>
                                    <td><?php echo $row['date']; ?></td>
                                  </tr>

                              <?php
                                }
                              }

                              else { ?>
                                <tr>
                                  <td colspan="8" align="center">No data found.</td>
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

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.22/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>

 <script type="text/javascript">
     $("body").on("click", "#btnExport", function () {
         html2canvas($('#tblSales')[0], {
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
        title: 'Sales'
      };
      var chart = new google.visualization.LineChart(document.getElementById("columnchart"));
      chart.draw(data, options);
    }
 </script>



</html>
