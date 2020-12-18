<?php
include 'connection.php';
date_default_timezone_set("Singapore");
$date_today=date('Y-m-d');
$date_today1=date('Y-m-d');


//FIXED ALL!
$getproductid=$_GET['thispid'];
$getproductname=$_GET['thispname'];
$getdesc=$_GET['thisdesc'];
$getsupname=$_GET['thissupplier'];
$getstocks=$_GET['thisstocks'];
$getprice=$_GET['thisprice'];
$getunitp=$_GET['thisunit'];
$getsku=$_GET['thissku'];
//dateadded
//$date_today=date('Y-m-d h:i:s');
//addedby
$getadmin=$_GET['thisadmin'];
$getstats=$_GET['thisstatus'];

echo $getproductid."<br>";
echo $getproductname."<br>";
echo $getdesc."<br>";
echo $getsupname."<br>";
echo $getstocks."<br>";
echo $getprice."<br>";
echo $getunitp."<br>";
echo $getsku."<br>";
echo $getadmin."<br>";
echo $getstats."<br>";

$sql= "UPDATE tbl_product
   SET Name = '$getproductname',
       Description = '$getdesc',
       Stocks = '$getstocks',
       Price = '$getprice',
       Price_type = '$getunitp',
       SKU = '$getsku',
       Supplier_ID = '$getsupname',
       Status_ID = '$getstats'
 WHERE product_id = '$getproductid'";


if ($result = $connection->query($sql)) {

  $sqlr="SELECT *FROM TBL_LOGIN WHERE username='$getadmin';";
  $resultr = mysqli_query($connection, $sqlr);
  if (!$resultr) {
    echo "Error: 2" . $sqlr . "<br>" . mysqli_error($connection);
  }else {
        $row = mysqli_fetch_assoc($resultr);
        $val_adminid=$row['User_ID'];
        $sql2="INSERT into tbl_records(actions,date,user_id) values('Number $getproductid Product has been updated','$date_today1','$val_adminid')";
    	if (!mysqli_query($connection, $sql2)) {
    		echo "Error: 2" . $sql2 . "<br>" . mysqli_error($connection);
    	}else {
        session_start();
        $_SESSION['success_message']=".";
        header("Location:../table.php");
        exit();
    	}
  }


}
else{
    echo "Error:1 " . $sql . "<br>" . $connection->error;

}

?>
