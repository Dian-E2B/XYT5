<?php
$host='localhost';
$username='root';
$password='';
$database='possys';
        $conn = new mysqli($host, $username, $password, $database);
        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }
		session_start();
        if (isset($_GET['id'])) {
            $var= $_GET['id'];
			         $sql="select product_id,price,stocks from tbl_product where product_id='$var';";

			if ($result = $conn->query($sql)) {
					$row = $result->fetch_assoc();

				}
			  else{
				  echo "Error:1 " . $sql . "<br>" . $connection->error;

			  }

		}
?>
<html>
<head>

</head>
<body>
	  <form id="myForm" action="add_to_cart_proceed0.php" method="POST">
        <div class="modal-body">
		          <div class="form-group">
                  <label for="email1">Quantity</label>
			            <input autocomplete="off" id="qty1" name="thisqty" type="number" class="form-control" id="email1" aria-describedby="emailHelp" placeholder="">
			                 <input style="display:none;"  name="thisprodid" value="<?php echo $row['product_id']; ?>" class="form-control"  placeholder="">
                       <input style="display:none;"  name="thisprice" value="<?php echo $row['price']; ?>" class="form-control" placeholder="">
                        <hr>
                        Stocks: Available<input readonly style="display:block; width:50px;" id="stocks1" value="<?php echo $row['stocks']; ?>" class="form-control" placeholder="">
                     </div>
        </div>

        <div class="modal-footer border-top-0 d-flex justify-content-center">
          <button  type="button" onclick="getInputValue()"; class="btn btn-sm btn-success">Add to Cart</button>
        </div>

      </form>

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
function getInputValue(){
  var inputVal = document.getElementById("qty1").value;
  var inputVal2 = document.getElementById("stocks1").value;
  var integer1 = parseInt(inputVal, 10);
  var intege2 = parseInt(inputVal2, 10);
  if (integer1>intege2){
    alert("Quantity exceeds available stocks");
  }
  else {
     document.getElementById("myForm").submit();
     $
  }

}
</script>
</html>
