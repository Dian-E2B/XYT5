<?php
include 'connection.php';
session_start();
$getproductname=$_POST['thispname'];
$getsupname=$_POST['thissupplier'];
$getsku=$_POST['prod_sku'];
$getsup=$_POST['prod_sup'];
$getprice=$_POST['prod_price'];

//query
$sql="INSERT INTO tbl_product(name,qty,price,sku,supplier_id) VALUES ('$getproductname','$getqty','$getprice','$getsku',$getsup)";
//execute

if (!mysqli_query($connection,$sql)){
	die("Error: " . mysqli_error($connection));
} 
else{
$_SESSION['success_message']="Successfully added";
header("Location:../products.php");
}

?>