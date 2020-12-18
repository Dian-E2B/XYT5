<!doctype html>
<html lang="en">

<?php
include 'z_execute/connection.php';
session_start();
$fetch_prod="SELECT name FROM tbl_product WHERE stocks >=1 AND status_ID = 1";
$result_prod = $connection->query($fetch_prod);

$fetch_sup="SELECT company_name
            FROM tbl_supplier
            WHERE status_id = 1
            GROUP BY company_name";
$result_sup = $connection->query($fetch_sup);

$fetch_prodtbl="SELECT p.product_id, p.name, p.description, p.stocks, p.price, u.unit_type,
            p.SKU, CAST(p.date_added AS DATE) date_added, a.username, s.company_name, p.status_id, ret.quantity AS returns
            FROM tbl_product p
            LEFT JOIN tbl_pricing u ON p.price_type = u.unit_id
            LEFT JOIN tbl_login a ON p.addedby_id = a.user_id
            LEFT JOIN tbl_supplier s ON p.supplier_id = s.supplier_id
            LEFT JOIN tbl_returned ret ON ret.product_id = p.product_id
            WHERE p.status_id = 1
            AND p.stocks >= 1";
$result_prodtbl = $connection->query($fetch_prodtbl);

?>

<head>
  <?php include 'z_otherUI/mainhead.php' ?>

</head>

<body>

  <div class="wrapper">
  <?php include 'z_otherUI/sidebar_reports.php' ?>

    <div class="main-panel">

      <nav class="navbar navbar-default navbar-fixed">
                      <div class="container-fluid">


      <!-- responsive -->

                          <div class="navbar-header">
                              <button type="button" class="navbar-toggle" data-toggle="collapse"
                                  data-target="#navigation-example-2">
                                  <span class="sr-only">Toggle navigation</span>
                                  <span class="icon-bar"></span>
                                  <span class="icon-bar"></span>
                                  <span class="icon-bar"></span>
                              </button>
                              <a href="reports.php"  class="navbar-brand" ><i  style="font-size:3rem; margin-top:-5px; color: blue;" class="fas fa-caret-square-left"></i></a>
                          </div>

      <!-- responsive -->
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
                              </ul>

                              <ul class="nav navbar-nav navbar-right">


                              </ul>
                          </div>
      <!-- responsive -->

                      </div>
                  </nav>

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
                  <form method="POST" action="inv-generated.php" id="form">
                    <div class="row">
                      <div class="col-md-2">
                        <div class="form-group">
                          <label for="startdate">Start Date</label>
                          <input type="date" class="form-control" name="startdate" id="startdate">
                        </div>
                      </div>

                      <div class="col-md-2">
                        <div class="form-group">
                          <label for="enddate">End Date</label>
                          <input type="date" class="form-control" name="enddate" id ="enddate">
                        </div>
                      </div>

                      <div class="col-md-2">
                        <div class="form-group">
                          <label for="product">Product</label>
                          <select class="form-control"  name="product">
                            <option></option>
                            <?php while($ugh=mysqli_fetch_assoc($result_prod)) { ?>
                              <option value="<?php echo $ugh['name']; ?>">
                                <?php echo $ugh['name']; ?>
                              </option>
                            <?php } ?>
                          </select>
                        </div>
                      </div>

                      <div class="col-md-2">
                        <div class="form-group">
                          <label for="product">Returns</label>
                          <select class="form-control"  name="returned">
                            <option></option>
                            <option value="True">True</option>
                            <option value="False">False</option>
                          </select>
                        </div>
                      </div>

                      <div class="col-md-2">
                        <div class="form-group">
                          <label for="supplier">Supplier</label>
                          <select class="form-control" name="supplier">
                            <option></option>
                            <?php while($ugh=mysqli_fetch_assoc($result_sup)) { ?>
                              <option value="<?php echo $ugh['company_name']; ?>">
                                <?php echo $ugh['company_name']; ?>
                              </option>
                            <?php } ?>
                          </select>
                        </div>
                      </div>

                      <div class="col-md-2">
                      </div>

                    </div> <!-- filter row -->


                    <div class="row">
                      <div class="col-md-4"></div>

                      <div class="col-md-2">
                        <div style="margin-top:5px;" class="form-group">
                          <button type="submit" id="generate" class="btn btn-primary btn-fill pull-right">Generate report</button>
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
                      <table class="table table-hover table-striped">
                        <thead>
                          <th>Product Name</th>
                          <th>SKU</th>
                          <th>Quantity</th>
                          <th>Price</th>
                          <th>Unit</th>
                          <th>Supplier</th>
                          <th>Date Added</th>
                          <th>Returns</th>
                        </thead>

                        <tbody>
                          <tr>
                            <?php while($row=mysqli_fetch_assoc($result_prodtbl)) { ?>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['SKU']; ?></td>
                            <td><?php echo $row['stocks']; ?></td>
                            <td><?php echo $row['price']; ?></td>
                            <td><?php echo $row['unit_type']; ?></td>
                            <td><?php echo $row['company_name']; ?></td>
                            <td><?php echo $row['date_added']; ?></td>
                            <td><?php echo $row['returns']; ?></td>
                          </tr>
                        </tbody>
                        <?php } ?>
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

<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
   google.load("visualization", "1", {packages:["corechart"]});
   google.setOnLoadCallback(drawChart);
   function drawChart() {
     var data = google.visualization.arrayToDataTable([
     ['Name', 'Stocks'],
     <?php
     $query = "SELECT name, stocks FROM tbl_product WHERE stocks >= 1 AND status_id = 1";
     $exec = mysqli_query($connection,$query);
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


<script>
$('#startdate, #enddate').on('change', function(){
    $('#enddate').attr('min', $('#startdate').val());
});
</script>


<script>
$('#form').submit(function( event ) {
  if (($("#startdate").val()) !== "" && ($("#enddate").val()) === "") {
    alert('Please enter an end date.');
    return false;
  } else if (($("#startdate").val()) === "" && ($("#enddate").val()) !== "") {
    alert('Please enter a start date.');
    return false;
  } else {
    $("#form").attr("action", "inv-generated.php");
    $( "#form" ).submit();
  }
});
</script>


<script>
function checkForm(form)
{
  re = /^(\d{1,2})\/(\d{1,2})\/(\d{4})$/;

  if(form.startdate.value != '') {
    if(regs = form.startdate.value.match(re)) {
      // day value between 1 and 31
      if(regs[1] < 1 || regs[1] > 31) {
        alert("Invalid value for day: " + regs[1]);
        form.startdate.focus();
        return false;
      }
      // month value between 1 and 12
      if(regs[2] < 1 || regs[2] > 12) {
        alert("Invalid value for month: " + regs[2]);
        form.startdate.focus();
        return false;
      }
      // year value between 1902 and 2020
      if(regs[3] < 1902 || regs[3] > (new Date()).getFullYear()) {
        alert("Invalid value for year: " + regs[3] + " - must be between 1902 and " + (new Date()).getFullYear());
        form.startdate.focus();
        return false;
      }
    } else {
      alert("Invalid date format: " + form.startdate.value);
      form.startdate.focus();
      return false;
    }
  }

  return true;
}
</script>



</html>
