<?php

include 'z_execute/connection.php';
session_start();

if(isset($_POST['submit'])){
  $getcustomername=$_POST['thiscname'];
  $getcustomerphone=$_POST['thiscpone'];
  $getcustomeradd=$_POST['thiscaddress'];
  $getcustomerammount=$_POST['thisamount'];
  $getitemtotal=$_POST['thistotal'];

  //  $sqlcutomerid="select max(customer_id)+1 as maxcustid from tbl_customer;";
  //  $resultmaxid = $connection->query($sqlcutomerid);
  //  $rowid = $resultmaxid->fetch_assoc();
  //  $rowidget=$rowid['maxcustid'];
  // $changevar=$getcustomerammount-$getitemtotal;
  // $getcustomerammount=$_POST['thisamount'];
  // echo $getcustomername." -name. ";
  // echo $getcustomerphone." -phone. ";
  // echo $getcustomeradd." -address. ";
  // echo $getcustomerammount." -ammount. ";
  // echo $changevar." -sukli. ";
  // echo $rowidget." -customerid. ";
  // echo $getitemtotal." -total. ";


  if($getcustomerammount < $getitemtotal === true){//IF CASH IS LOWER
      $_SESSION['error_message']="Cash cannot be lower than total cost!";
      //echo "<script type='text/javascript'>alert('wrong');</script>";
      header("Location:./yourcart.php");
      exit();
  }else{
    echo "OK!";
    $sql ="Insert into tbl_customer(Customer_id,Name,Phone,Address) Values('$rowidget','$getcustomername','$getcustomerphone','$getcustomeradd');";
    $sql .="Insert into tbl_orderdetails(customer_ID,Total,Cash,cashafter) Values('$rowidget','$getitemtotal','$getcustomerammount','$changevar');";
    if (mysqli_multi_query($connection, $sql)) {
        // $sqlclearcart="truncate table tbl_cart;";
        // $resultcart = $connection->query($sqlclearcart);
        header("Location:./order_details.php");
      } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($connection);
      }
  }

}

//
//
//
// if (!empty($_POST['thiscname'])){
//     // $sqlcutomerid2="select max(customer_id) as maxcustidd from tbl_customer;";
//     // $resultmaxid2 = $connection->query($sqlcutomerid2);
//     // $rowid2 = $resultmaxid2->fetch_assoc();
//     // $rowidget2=$rowid2['maxcustidd'];
//
//
//
//     }


      ?>
