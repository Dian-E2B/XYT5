<?php
include 'connection.php';
session_start();

date_default_timezone_set("Singapore");
$date_today=date('Y-m-d h:m:s');

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


$sqlr="INSERT into tbl_records(actions,date,user_id) values('New Supplier company added.','$date_today','1')";
    	if (!mysqli_query($connection, $sqlr)) {
    		echo "Error: 2" . $sqlr . "<br>" . mysqli_error($connection);
    	}else {
				$_SESSION['success_added']="Successfully Registered";
 		  header("Location:../supplier_table.php");
 			exit();
    	}


}
else{
    echo "Error:1 " . $sql . "<br>" . $connection->error;

}

?>
