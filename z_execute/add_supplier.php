<?php
include 'connection.php';
session_start();
$getcompany=$_POST['thissuppliername'];
$getemail=$_POST['thisemail'];
//thisstatus
// $getstatus1=$_POST['thisstatus1'];
$getphone=$_POST['thisphone'];
$getadd=$_POST['thisaddress'];
//thisaddress
// echo $getcompany."/";
// echo $getemail."/";
// echo $getstatus1."/";
// echo $getphone."/";
// echo $getadd."/";

$sql= "INSERT into tbl_supplier(company_name,email,phone,address,status_id)
Values(
	'$getcompany',
	'$getcompany',
	'1',
	'$getphone',
	'$getadd'
	);";

if ($result = $connection->query($sql)) {
	 $_SESSION['success_added']="Successfully Registered";
  header("Location:../supplier_table.php");
	exit();
}
else{
    echo "Error:1 " . $sql . "<br>" . $connection->error;

}

?>
