<?php
include 'connection.php';
session_start();

$getsupid=$_GET['thissid'];
$getsupname=$_GET['thissname'];
$getsemail=$_GET['thisemail'];
$getsupphone=$_GET['thisphone'];
$getsupstatus=$_GET['thisstatus'];
$get_sup_address=$_GET['thisaddress'];

//dateadded
//$date_today=date('Y-m-d h:i:s');
//addedby
$getstats=$_GET['thisstatus'];

echo $getsupid."/";
echo $getsupname."/";
echo $getsemail."/";
echo $getsupphone."/";
echo $getsupstatus."/";
echo $get_sup_address."/";


$sql= "UPDATE tbl_supplier
  SET company_name = '$getsupname',
          email = '$getsemail',
          phone = '$getsupphone',
        address = '$get_sup_address',
        status_id = '$getsupstatus'
  WHERE supplier_id = '$getsupid'";


if ($result = $connection->query($sql)) {
  $_SESSION['success_message']="Supplier Successfully added";
  header("Location:../supplier_table.php");
  exit();
}
else{
    echo "Error:1 " . $sql . "<br>" . $connection->error;
}

?>
