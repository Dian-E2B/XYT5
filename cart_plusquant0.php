<?php
include 'z_execute/connection.php';
session_start();
$var_id= $_GET['id'];
echo "Quantity decreased=". $var_id;
//start here

$sql0="SELECT stocks from tbl_product where product_id='$var_id'";
$sql0result=mysqli_query($connection, $sql0);
$sql0row = mysqli_fetch_assoc($sql0result);
$var_stocks=$sql0row['stocks'];


if ($var_stocks == 0) {
	 $_SESSION['error_stocks']="Quantity exceeds product's stocks.";
}
else {
	//SQL MINUS Product FROM TBL_CART
	$sql="UPDATE tbl_cart set Qty=Qty+1
		where product_id='$var_id'";

	if ($result_test = $connection->query($sql)) {
	    $sql="SELECT product_id,qty,price from tbl_cart where product_id='$var_id';";
	    $result = mysqli_query($connection, $sql);
	    $row = mysqli_fetch_assoc($result);
	    $var_quantity=$row['qty'];
	    $var_price=$row['price'];
	    $var_subtotal = $var_quantity * $var_price; // CALCULATION FOR SUBTOTAL UPDATE

	    $sql2="UPDATE tbl_cart set
	    subtotal=$var_subtotal
	    where product_id='$var_id'";
	      if (mysqli_query($connection, $sql2)) { // EXECUTE UPDATE TBL_CART

					$sql3="UPDATE tbl_product set stocks=stocks-1 where product_id='$var_id'";

						if (!mysqli_query($connection, $sql3)) {
							 echo "Error: " . $sql3 . "<br>" . mysqli_error($connection);
						}
	        //header("Location:./yourcart.php");
	      } else {
	        echo "Error: " . $sql2 . "<br>" . mysqli_error($connection);
	      }
	}
	else{
			  echo "Error:1 " . $sql . "<br>" . $connection->error;
	  }

}










?>
