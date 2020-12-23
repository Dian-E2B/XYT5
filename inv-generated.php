<!doctype html>
<html lang="en">

<?php
include 'z_execute/connection.php';
session_start();

$start = $_POST['startdate'];
$end = $_POST['enddate'];
$product = $_POST['product'];
$supplier = $_POST['supplier'];
$returned = $_POST['returned'];

$str_start = '';
$str_end = '';
$str_prod ='';
$str_sup ='';
$str_ret ='';


if ($start != "") {
  $str_start = "AND p.date_added BETWEEN '$start'";
}

if ($end != "") {
  $str_end = "AND '$end'";
}

if ($product != "") {
  $str_prod = "AND p.name = '$product'";
}

if ($supplier != "") {
  $str_sup = "AND s.company_name = '$supplier'";
}

if ($returned != "") {
  if ($returned == "True") {
    $str_ret = "AND ret.quantity >= 1";
  }
  else {
    $str_ret = "AND ret.quantity IS null";
  }
}


$sql= "SELECT p.product_id, p.name, p.description, p.stocks, p.price,(p.stocks*price) as Totalsales,u.unit_type,
            p.SKU, CAST(p.date_added AS DATE) date_added, a.username, s.company_name, p.status_id, ret.quantity AS returns
            FROM tbl_product p
            LEFT JOIN tbl_pricing u ON p.price_type = u.unit_id
            LEFT JOIN tbl_login a ON p.addedby_id = a.user_id
            LEFT JOIN tbl_supplier s ON p.supplier_id = s.supplier_id
            LEFT JOIN tbl_returned ret ON ret.product_id = p.product_id
            WHERE p.status_id = 1
            AND p.stocks >= 1
            $str_start
            $str_end
            $str_prod
            $str_sup
            $str_ret
            group by p.product_id;";



$result1 = $connection->query($sql);
$total_row1 = $result1->num_rows;

if($total_row1 > 0) {
  foreach($result1 as $row1) {

      if (isset($row2)) {
        $row2=$row2+$row1['Totalsales'];
      }
      else
      {
      $row2=$row1['Totalsales'];
      }


}}

?>

<head>
    <?php include 'z_otherUI/mainhead.php' ?>

</head>

<body>

  <div class="wrapper">
    <?php include 'z_otherUI/sidebar_reports.php' ?>

    <div class="main-panel">
      <?php include 'z_otherUI/navbar_reports-plain.php' ?>

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
                  <form method="POST" action="inv-reports.php">
                    <div class="row">

                      <div class="col-md-2">
                        <div class="form-group">
                          <label for="startdate">Start Date</label>
                          <input type="date" class="form-control" name="startdate" placeholder="Start Date" value="<?php echo $start; ?>" disabled>
                        </div>
                      </div>

                      <div class="col-md-2">
                        <div class="form-group">
                          <label for="enddate">End Date</label>
                          <input type="date" class="form-control" name="enddate" placeholder="End Date" value="<?php echo $end; ?>" disabled>
                        </div>
                      </div>

                      <div class="col-md-2">
                        <div class="form-group">
                          <label for="product">Product</label>
                          <select class="form-control"  name="product" disabled>
                            <option><?php echo $product; ?></option>
                          </select>
                        </div>
                      </div>

                      <div class="col-md-2">
                        <div class="form-group">
                          <label for="product">Returns</label>
                          <select class="form-control"  name="returned" disabled>
                            <option><?php echo $returned; ?></option>
                          </select>
                        </div>
                      </div>


                      <div class="col-md-2">
                        <div class="form-group">
                          <label for="supplier">Supplier</label>
                          <select class="form-control" name="supplier" disabled>
                            <option><?php echo $supplier; ?></option>
                          </select>
                        </div>
                      </div>
                    </div><!-- filter row -->

                    <div class="row">
                      <div class="col-md-4"></div>

                      <div class="col-md-1">
                        <div style="margin-top:5px;" class="form-group">
                          <button type="submit" class="btn btn-primary btn-fill pull-right" onClick="window.location.href='inv-reports.php'">Clear</button>
                        </div>
                      </div>


                      <div class="col-md-2">
                        <div style="margin-top:5px;" class="form-group">
                          <a href="#" id="btnExport" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" style="padding:9px;"><i
                                  class="fas fa-download fa-sm text-white-50"></i> Export report</a>
                        </div>
                      </div>
                    </div><!-- button row -->

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
                        <tr style="color:blue;">
                            <td><b> Profitable Sales:  </td>
                            <td><b> ₱ <?php if(isset($row2)){
                                echo $row2;
                            }
                            else {
                                echo "0";
                            }


                             ?></b></td>
                        </tr>
                          <th>ID</th>
                          <th>Product Name</th>
                          <th style="display:none">Description</th>
                          <th>SKU</th>
                          <th>Quantity</th>
                          <th>Unit</th>
                          <th>Price</th>
                          <th>Supplier</th>
                          <th>Added By</th>
                          <th>Date Added</th>
                          <th>Returns</th>
                        </thead>

                        <tbody>
                          <tr>
                            <?php
                              $result = $connection->query($sql);
                              $total_row = $result->num_rows;

                              if($total_row > 0) {
                                foreach($result as $row) { ?>

                                  <tr>
                                    <td><?php echo $row['product_id']; ?></td>
                                    <td><?php echo $row['name']; ?></td>
                                    <td style="word-wrap: break-word; width: 150px; display:none;"><?php echo $row['description']; ?></td>
                                    <td><?php echo $row['SKU']; ?></td>
                                    <td><?php echo $row['stocks']; ?></td>
                                    <td><?php echo $row['unit_type']; ?></td>
                                    <td>₱ <?php echo $row['price']; ?></td>
                                    <td><?php echo $row['company_name']; ?></td>
                                    <td><?php echo $row['username']; ?></td>
                                    <td><?php echo $row['date_added']; ?></td>
                                    <td><?php echo $row['returns']; ?></td>
                                  </tr>

                              <?php
                                }
                              }

                              else { ?>
                                <tr>
                                  <td colspan="11" align="center">No data found.</td>
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
         html2canvas($('#tblInventory')[0], {
             onrendered: function (canvas) {
                 var data = canvas.toDataURL();
                 var docDefinition = {
                     content: [{
                         image: data,
                         width: 500
                     }]
                 };
                 pdfMake.createPdf(docDefinition).download("inventory-data.pdf");
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
      ['Name', 'Stocks'],
      <?php
      $exec = mysqli_query($connection,$sql);
      while($row = mysqli_fetch_array($exec)){
        echo "['".$row['name']."',".$row['stocks']."],";
      }
      ?>

      ]);

      var options = {
        title: 'Inventory'
      };
      var chart = new google.visualization.ColumnChart(document.getElementById("columnchart"));
      chart.draw(data, options);
    }
 </script>






</html>
