<?php
include 'z_execute/connection.php';
session_start();

if (isset($_POST['thisprodid'])) {



	$getproductid=$_POST['thisprodid'];
	$getproductqty=$_POST['thisqty'];
	// $sql="select product_id,price,stocks from tbl_product where product_id='$getproductid';";
	//
	// if (condition) {
	// 	// code...
	// }

	$getproductprice=$_POST['thisprice'];



	$sqllogid="SELECT MAX(order_log_id) AS MAXLOGID from tbl_ORDERDETAILS;";
  $resultmaxid = mysqli_query($connection, $sqllogid);
  $rowid = mysqli_fetch_assoc($resultmaxid);


	if  (empty($rowid['MAXLOGID'])) {
			$var_lastid1=1;
		}
	else {
			$var_lastid1=$rowid['MAXLOGID']+1;
		}

		$rowidgetid=$var_lastid1;

	 //echo $getproductqty;
	 //echo $getproductid;
	  //echo $getproductprice;

		//LOAD DATA
	$sql="select product_id from tbl_cart where product_id='$getproductid';";
	$result = mysqli_query($connection, $sql);
	$var = $getproductqty * $getproductprice; // CALCULATION FOR SUBTOTAL


if (mysqli_num_rows($result)> 0 ) {//IF CART ID EXITSTED ALREAdy,
 //multuply qty to price
 //update the table cart
				  $sql2="Update tbl_cart set
				  qty=qty+$getproductqty,
				  price='$getproductprice',
				  subtotal=subtotal + $var
				  where product_id='$getproductid'
				  ";

				  echo $getproductqty."---";
					 echo $getproductid."---";
					 echo $getproductprice."---";
				  echo $var."------";

					if (mysqli_query($connection, $sql2)) {
					  echo "New records updated successfully";

									$sqlupdateprod="update tbl_product set stocks=stocks-'$getproductqty' where product_id='$getproductid';";
									if (!mysqli_query($connection, $sqlupdateprod)) {
											echo "Error: " . $sqlupdateprod . "<br>" . mysqli_error($connection);
											}

  					header("Location:./icons.php");

							} else {
							  echo "Error: " . $sql2 . "<br>" . mysqli_error($connection);
							}

} else { //IF NO CART ID EXIST

  $sql2="insert into tbl_cart(order_log_id,product_id,qty,price,subtotal)
  values('$rowidgetid','$getproductid','$getproductqty','$getproductprice','$var');";

if (mysqli_query($connection, $sql2)) {
  echo "New records created successfully";

					$sqlupdateprod="update tbl_product set stocks=stocks-'$getproductqty' where product_id='$getproductid';";
					if (!mysqli_query($connection, $sqlupdateprod)) {
					    echo "Error: " . $sqlupdateprod . "<br>" . mysqli_error($connection);
					}

  header("Location:./icons.php");
} else {
  echo "Error: " . $sql2 . "<br>" . mysqli_error($connection);
}
}



}

?>
