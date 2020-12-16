<html>
<?php
include 'z_execute/connection.php';
$id=$_GET['deleteID'];

//GET QTY FIRST
$sql1="SELECT QTY FROM TBL_CART WHERE PRODUCT_ID='$id';";
$sql_result=mysqli_query($connection,$sql1);
$row = mysqli_fetch_assoc($sql_result);
$var_stocks=$row['QTY'];
echo $var_stocks;

$sql2="UPDATE TBL_PRODUCT SET STOCKS=STOCKS+'$var_stocks' WHERE PRODUCT_ID='$id'";
$sql_result2=mysqli_query($connection,$sql2);
if(!$sql_result2){
  echo "ERROR";
}
else{
  $sql3="DELETE FROM TBL_CART WHERE PRODUCT_ID='$id'";
  $sql_result3=mysqli_query($connection,$sql3);
  if(!$sql_result3){
    echo "ERROR";
  }
  else{
        header("Location:./yourcart.php");
  }

}


?>
