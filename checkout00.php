<?php
include 'z_execute/connection.php';

session_start();
date_default_timezone_set("Singapore");
$date_today=date('Y-m-d h:m:s');

if (isset($_POST['paymentradio'])){
  $var_payment=$_POST['paymentradio'];
  $var_total=$_POST['thistotal'];
  $var_lastee=$_POST['thislastinsertedid'];
  echo $var_lastee."<br>";

  $sqlmax="select max(order_log_id) as  maxlogid from tbl_orderdetails";
  $resultmax = mysqli_query($connection, $sqlmax);
  $sqlmax = mysqli_fetch_assoc($resultmax);

    if  (empty($sqlmax['maxlogid'])) {
        $var_lastid1=1;
      }
    else {
        $var_lastid1=$sqlmax['maxlogid']+1;
      }

  $var_lastid2=$var_lastid1;

  if($var_payment=="cash1"){
    $var_thiscash=$_POST['thiscash'];
    $sql_insertINSERT="insert INTO tbl_orderdetails(order_log_id,total,payment_id,customer_id,Date) Value ('$var_lastid2','$var_total','402','$var_lastee','$date_today');";
            if (mysqli_query($connection, $sql_insertINSERT)) {
                echo "New record created successfully";

              //INSERT INTO TBL_ORDERLINE AFTER

              $sqlappendorders="INSERT into tbl_orderline(order_log_id,product_id,qty) SELECT order_log_id,product_id,qty from tbl_cart;";
                if (!mysqli_query($connection, $sqlappendorders)) {
                  echo "Error: " . $sqlappendorders . "<br>" . mysqli_error($connection);
                }
                else{

                    $sqlclear="TRUNCATE TABLE tbl_cart";
                    if (!mysqli_query($connection, $sqlclear)) {
                      echo "Error: " . $sqlclear . "<br>" . mysqli_error($connection);
                    }else {
                       header("Location:./ordersummary.php");
                    }

                }

            } else {
              echo "Error: " . $sql_insertINSERT . "<br>" . mysqli_error($connection);
            }
  }
  else{
    $var_chequenum=$_POST['thischequenum'];
    $var_chequebank=$_POST['thisbankcheque'];
    $var_chequebranch=$_POST['thisbranchcheque'];
    $var_chequeamount=$_POST['thisamountcheque'];

    $sql_insertINSERT="insert INTO tbl_orderdetails(order_log_id,total,payment_id,customer_id,Date) Value ('$var_lastid2',$var_total,'401','$var_lastee','$date_today');";
              if (mysqli_query($connection, $sql_insertINSERT)) {
                  echo "New record created successfully";

                          $sqlappendorders="INSERT into tbl_orderline(order_log_id,product_id,qty) SELECT order_log_id,product_id,qty from tbl_cart;";

                          if (!mysqli_query($connection, $sqlappendorders)) {
                            echo "Error: " . $sqlappendorders . "<br>" . mysqli_error($connection);
                          }
                  $sql_insertcheque="insert INTO tbl_cheque(cheque_no,bank,amount,Branch,customer_id) Value ('$var_chequenum','$var_chequebank','$var_chequeamount','$var_chequebranch','$var_lastee');";
                    if (!mysqli_query($connection, $sql_insertcheque)) {
                        echo "Error: " . $sql_insertcheque . "<br>" . mysqli_error($connection);
                    }
                    else{

                        $sqlclear="TRUNCATE TABLE tbl_cart";
                        if (!mysqli_query($connection, $sqlclear)) {
                          echo "Error: " . $sqlclear . "<br>" . mysqli_error($connection);
                        }else{
                             header("Location:./ordersummary.php");
                        }

                    }

              } else {
                echo "Error: " . $sql_insertINSERT . "<br>" . mysqli_error($connection);
              }

  }

}


?>
