<?php
//db_con
include 'connection.php';

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
	session_start();

	$_SESSION['username']=$getusername;
	$_SESSION['user_id']=$getuserid;
	header("Location:../table.php");
}
else {
	$_SESSION['error_message']="Incorrect username or password";
	header("Location:../index.php");

}
	//$sql2="SELECT  *from student_info WHERE student_id='$userid'";
	//$result2=mysqli_query($connection,$sql2);
	//$users2=mysqli_fetch_assoc($result2);
	//$_SESSION['student_id']=$userid;

//	$getusername=$confirm_result['username'];
//	$_SESSION['username']=$getusername;

//	header("Location:../tables.php");
//else{
//		 echo "ERROR!";
//	 }

?>
