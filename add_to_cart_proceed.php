<?php
include 'z_execute/connection.php';
session_start();

if (isset($_POST['submit'])) {


	$getproductid=$_POST['thisprodid'];
	$getproductqty=$_POST['thisqty'];
	$getproductprice=$_POST['thisprice'];


  $sqlcutomerid="select max(customer_id)+1 as maxcustid from tbl_customer;";
  $resultmaxid = $connection->query($sqlcutomerid);
  $rowid = $resultmaxid->fetch_assoc();
  $rowidget=$rowid['maxcustid'];




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

  // header("Location:./icons.php");
} else {
  echo "Error: " . $sql2 . "<br>" . mysqli_error($connection);
}

} else { //IF NO CART ID EXIST

  $sql2="insert into tbl_cart(product_id,qty,price,subtotal)
  values('$getproductid','$getproductqty','$getproductprice','$var');";

if (mysqli_query($connection, $sql2)) {
  echo "New records created successfully";

					$sqlupdateprod="update tbl_product set stocks=stocks-'$getproductqty' where product_id='$getproductid';";
					if (!mysqli_query($connection, $sqlupdateprod)) {
					    echo "Error: " . $sqlupdateprod . "<br>" . mysqli_error($connection);
					}

  // header("Location:./icons.php");
} else {
  echo "Error: " . $sql2 . "<br>" . mysqli_error($connection);
}
}



}

?>
