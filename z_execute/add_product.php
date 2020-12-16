<?php
include 'connection.php';
session_start();



$getproductname=$_POST['thispname'];
$getdesc=$_POST['thisdesc'];
$getsupname=$_POST['thissupplier'];
$getstocks=$_POST['thisstocks'];
$getprice=$_POST['thisprice'];
$getunitp=$_POST['thisunits'];
$getsku=$_POST['thissku'];
//dateadded
date_default_timezone_set("Singapore");
$date_today=date('Y-m-d');
//addedby
$getidsession=$_SESSION['username'];
$getstats=$_POST['thisstatus'];
//query_to_get_id
$sql="select user_id from tbl_login where username='$getidsession'";


$result = $connection->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc(); //fetch_id
    $holdid=$row['user_id'];//hold_id

    $sql2="INSERT INTO tbl_product(name,description,stocks,price,price_type,sku,date_added,addedby_id,supplier_id,status_id) VALUES ('$getproductname','$getdesc','$getstocks','$getprice','$getunitp','$getsku','$date_today','$holdid','$getsupname','$getstats')";

    if ($connection->query($sql2) === TRUE) {
        $_SESSION['success_added']="Product added";
        header("Location:../table.php");
        exit();
      } else {
        echo "Error:2 " . $sql2 . "<br>" . $connection->error;
      }
}
else{
    echo "Error:1 " . $sql . "<br>" . $connection->error;





}

?>
