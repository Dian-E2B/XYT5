<!doctype html>
<html lang="en">

<?php
include 'z_execute/connection.php';
session_start();
$fetch_prod="SELECT name FROM tbl_product WHERE stocks >=1 AND status_ID = 1";
$result_prod = $connection->query($fetch_prod);

$fetch_pymnt="SELECT payment_type FROM tbl_payment";
$result_pymnt = $connection->query($fetch_pymnt);

$fetch_saletbl="SELECT * FROM saleable";
$result_saletbl = $connection->query($fetch_saletbl);

$fetch_saletbl2="SELECT sum(total) as totalsales FROM saleable";
$result_saletbl02= $connection->query($fetch_saletbl2); //GET TOTAL
$result_saletbl002=mysqli_fetch_assoc($result_saletbl02);
$total=$result_saletbl002['totalsales'];

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
                  <h4 class="title">Sales Reports</h4>
                </div>

                <div class="row"></div>
                <div class="content table-responsive">

                  <!-- filters -->
                  <div class="row">
                    <form method="POST" action="sales-generated.php" id="form">

                      <div class="col-md-2">
                        <div class="form-group">
                          <label for="startdate">Start Date</label>
                          <input type="date" class="form-control" name="startdate" id="startdate">
                        </div>
                      </div>

                      <div class="col-md-2">
                        <div class="form-group">
                          <label for="enddate">End Date</label>
                          <input type="date" class="form-control" name="enddate" id="enddate">
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
                          <label for="supplier">Payment</label>
                          <select class="form-control" name="payment">
                            <option></option>
                            <?php while($ugh=mysqli_fetch_assoc($result_pymnt)) { ?>
                              <option value="<?php echo $ugh['payment_type']; ?>">
                                <?php echo $ugh['payment_type']; ?>
                              </option>
                            <?php } ?>
                          </select>
                        </div>
                      </div>

                      <div class="col-md-2">
                        <div style="margin-top:25px;" class="form-group">
                          <button type="submit" class="btn btn-primary btn-fill pull-right">Generate report</button>
                        </div>
                      </div>
                      </form> <!-- filters -->
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

                            <?php while($row=mysqli_fetch_assoc($result_saletbl)) { ?>

                            <td><?php echo $row['order_log_id']; ?></td>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['SKU']; ?></td>
                            <td><?php echo $row['qty']; ?></td>
                            <td><?php echo $row['price']; ?></td>
                            <td><?php echo $row['total']; ?></td>
                            <td><?php echo $row['payment_type']; ?></td>
                            <td><?php echo $row['date']; ?></td>

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

<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
   google.load("visualization", "1", {packages:["corechart"]});
   google.setOnLoadCallback(drawChart);
   function drawChart() {
     var data = google.visualization.arrayToDataTable([
     ['Product', 'Sales'],
     <?php
     $q = "SELECT SUM(qty) AS qty, CAST(date AS DATE) date
            FROM saleable
            WHERE date BETWEEN CURRENT_DATE - 7 AND CURRENT_DATE
            GROUP BY date";
     $exec = mysqli_query($connection,$q);
     while($row = mysqli_fetch_array($exec)){
       echo "['".$row['date']."',".$row['qty']."],";
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
    $("#form").attr("action", "sales-generated.php");
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
