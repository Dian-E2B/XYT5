<?php

include 'z_execute/connection.php';
session_start();

$sqlclearcart="truncate table tbl_cart;";


if ($resultcart = $connection->query($sqlclearcart)) {
    header("Location:./table.php");
}
else{
  echo "Error:1 " . $sql . "<br>" . $connection->error;   
  
}

?>