<?php
//db_con
include 'connection.php';

//FOR tbl_records
date_default_timezone_set("Singapore");
$date_today=date('Y-m-d h:m:s');


//start session
session_start();

//getvalues
$username=$_POST['user'];
$password=$_POST['pass'];

$sql="SELECT *from tbl_login WHERE username='$username' AND password='$password'";
$result=mysqli_query($connection,$sql);
$confirm_result=mysqli_fetch_assoc($result);

if($confirm_result){

	$getusername=$confirm_result['Username'];
	

	$_SESSION['username']=$getusername;
	$_SESSION['user_id']=$getuserid;

	$sql2="INSERT into tbl_records(actions,date,user_id) values('$getusername Logged in','$date_today','1')";
	if (!mysqli_query($connection, $sql2)) {
		echo "Error: 2" . $sql2 . "<br>" . mysqli_error($connection);
	}else {
		 header("Location:../table.php");
	}

}
else {
	$_SESSION['error_message']="Incorrect username or password";
	header("Location:../index.php");
}

?>
