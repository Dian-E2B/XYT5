<!doctype html>
<html lang="en">
<?php
include 'z_execute/connection.php';

$sql="select p.product_id,p.name,c.qty,c.price from tbl_product p join tbl_cart c using(product_id);";//LOAD DATA
$result = mysqli_query($connection, $sql);

$sql4="select subtotal from tbl_cart";
$result4 = mysqli_query($connection, $sql4);  //get subtoal
$row4 = mysqli_fetch_assoc($result4);
$var_subtotal=$row4['subtotal'];
$var_vat= $var_subtotal*0.12; //VAT TIMES Subtotal = VAT


$sql5="select sum(subtotal) as total from tbl_cart";
$result5 = mysqli_query($connection, $sql5);  //get total
$row5 = mysqli_fetch_assoc($result5);
$var= $row5['total'];
$var_total= $var+$var_vat; //total plus vat



$sql3="select  as total from tbl_cart;";//get TOTAL
$result3 = mysqli_query($connection, $sql3);

//LOAD COMBOBOX TYPE
$sql2="select ordertype_id,customer_type  from tbl_ordertype;";
$execute = mysqli_query($connection, $sql2);



if(isset($_POST['thisclientname'])){
        $sql6="select max(customer_id) as maxcusid from tbl_customer;";
        $result6 = mysqli_query($connection, $sql6);
        $row6 = mysqli_fetch_assoc($result6);//get max

        $var_clientname = $_POST["thisclientname"];
        $var_clientphone = $_POST["thisphone"];
         $var_clienttype = $_POST["thisclienttype"];
        $var_clientadd = $_POST["thisaddress"];
        if  (empty($row6['maxcusid'])) { //MAX ID IS ZERO

            $var_lastid=1; // zero id

              if(isset($_POST['discountsradio']))

              {
                $var_discount=$_POST['discountsradio'];

                        if ($var_discount=="senior1") { //IF SENIOR IS CLICKED
                          $var_seniorname = $_POST["thisaccount"];//GET VALUES
                          $var_cardid = $_POST["thiscardid"];//GET VALUES

                          $sql_insert1="insert into tbl_customer(customer_id,Name,Phone,Address,Ordertype_ID,Customertype_ID)
                          values ('$var_lastid','$var_clientname','$var_clientphone','$var_clientadd','$var_clienttype','301');";
                          $execute_insert = mysqli_query($connection, $sql_insert1);//EXECUTE INSERT
                              if(!$execute_insert){
                                die("Error: " . mysqli_error($connection));
                                }
                                  $var_discountload00=$var*0.20;
                                    $var_customertype00="Senior";
                              }


                      else{ //else if none
                        $sql_insert1="insert into tbl_customer(customer_id,Name,Phone,Address,Ordertype_ID,Customertype_ID)
                        values ('$var_lastid','$var_clientname','$var_clientphone','$var_clientadd','$var_clienttype','302');";
                        $execute_insert = mysqli_query($connection, $sql_insert1);//EXECUTE INSERT
                            if(!$execute_insert)  {
                              die("Error: " . mysqli_error($connection));
                              }
                            }
                            $var_discountload00=0;
                            $var_customertype00="None";
                    }

                    $var_lastidreal00=$var_lastid;
              }

            else {

                $var_lastid=$row6['maxcusid']+1;


                    if(isset($_POST['discountsradio']))
                    {
                      $var_discount=$_POST['discountsradio'];

                      if ($var_discount=="senior1") { //IF SENIOR IS CLICKED
                        $var_seniorname = $_POST["thisaccount"];//GET VALUES
                        $var_cardid = $_POST["thiscardid"];//GET VALUES

                        $sql_insert1="insert into tbl_customer(customer_id,Name,Phone,Address,Ordertype_ID,Customertype_ID)
                        values ('$var_lastid','$var_clientname','$var_clientphone','$var_clientadd','$var_clienttype','301');";
                        $execute_insert = mysqli_query($connection, $sql_insert1);//EXECUTE INSERT

                            if(!$execute_insert){
                              die("Error: " . mysqli_error($connection));
                              }

                              $var_discountload00=$var*0.20;
                                $var_customertype00="Senior";
                            }
                     else{
                      $var_seniorname = $_POST["thisaccount"];//GET VALUES
                      $var_cardid = $_POST["thiscardid"];//GET VALUES
                      $sql_insert1="insert into tbl_customer(customer_id,Name,Phone,Address,Ordertype_ID,Customertype_ID)
                      values ('$var_lastid','$var_clientname','$var_clientphone','$var_clientadd','$var_clienttype','302');";
                      $execute_insert = mysqli_query($connection, $sql_insert1);//EXECUTE INSERT
                          if(!$execute_insert)  {
                            die("Error: " . mysqli_error($connection));
                            }
                            $var_discountload00=0;
                            $var_customertype00="None";
                    }
                  }

}
}
$sql7="select max(customer_id) as maxcusid from tbl_customer;";
$result7 = mysqli_query($connection, $sql7);
$row7 = mysqli_fetch_assoc($result7);//get max

$sqlordertype="select customer_type from tbl_ordertype where ordertype_id = '$var_clienttype';";
$sqlshow = mysqli_query($connection, $sqlordertype);
$rowappend = mysqli_fetch_assoc($sqlshow);//get value if senior or not

      // echo $var_lastid."<br>";
      // echo $var_clientname."<br>";
      // echo $var_clientphone."<br>";
      // echo $var_clienttype."<br>";
      // echo $var_clientadd."<br>";
      // echo "$var_discount"."<br>";
      // echo "$var_cardid"."<br>";
      // echo "$var_seniorname"."<br>";
      // $var_lastid=$row6['maxcusid'];
      // $var_lastid1=$var_lastid+1; //add one
$var_discountload=$var_discountload00;
$var_customertype=$var_customertype00;
$var_lastidreal=$row7['maxcusid'];
$var_supertotal=$var_total-$var_discountload;

 ?>


<head>
  <?php include 'z_otherUI/mainhead.php'; ?>


</head>
<style>
  ::placeholder {
    color: #505050 !important;
    opacity: 1; /* Firefox */
  }

  :-ms-input-placeholder { /* Internet Explorer 10-11 */
   color: #505050 !important;
  }

  ::-ms-input-placeholder { /* Microsoft Edge */
   color: #505050 !important;
  }
  </style>
  <body>

  <div class="wrapper">


      <div style="float:none; width:80%; margin: auto;"  class="main-panel">


          <div class="content">
              <div class="container-fluid">
                  <div class="row">
                      <div class="col-md-12">
                          <div class="card">
                              <div class="header">
                                  <h4 class="title">Checkout form</h4>

                              </div>
                              <div class="content">
                                <div class="content table-responsive">
                              <table class="table table-hover table-striped">
                                  <thead>
                                    <tr>
                                      <th>ID</th>
                                      <th>Client Name</th>
                                      <th>Phone</th>
                                      <th>Address</th>
                                      <th>Ordertype_ID</th>
                                      <th>Customertype_ID</th>
                                    </tr>
                                  </thead>
                                    <tr>
                                    <td><?php echo $var_lastidreal ?></td>
                                    <td><?php echo $var_clientname ?></td>
                                      <td><?php echo $var_clientphone ?></td>
                                      <td><?php echo $var_clientadd ?></td>
                                      <td><?php echo $rowappend['customer_type']; ?></td>
                                      <td><?php echo  $var_customertype ?></td>
                                  </tr>
                              </table>
                                    <!-- FORM1 -->
                              </div>
                          </div>
                      </div>


                      <div class="col-md-12">
                          <div class="card">
                            <div class="content">

                              <!-- FORM2 -->
                              <form  id="myForm" method="POST" action="checkout00.php">
                              <h4>Payment</h4>

                                  <fieldset id="paymentradio"  >

                                  <input class="paymentradioclass" onclick="show3();" id="cashradio1" type="radio" name="paymentradio" value="cash1" class="radiobtn" checked> Cash<br>
                                  <div style="padding:5px"></div>
                                        <!-- thiscash --><input  id="paymentinput1" style="width:200px;" name="thiscash"  autofill="off" type="number" size="50"  class="cashinput form-control" placeholder="Enter Cash">
                                  <div style="padding:5px"></div>

                                  <input onclick="show4();" id="chequeradio1"  type="radio" name="paymentradio" value="cheque1" > Cheque

                                  <div id="paymentinput" style="display:none;">
                                  <input name="thischequenum" style="width:200px;" autocomplete="off" autofill="off" type="text" width="10"  class="chequeinput form-control" placeholder="Check Number">
                                  <div style="padding:5px"></div>
                                  <input name="thisbankcheque" style="width:200px;" autocomplete="off" autofill="off" type="text" width="10" class="chequeinput form-control"  placeholder="Bank">
                                    <div style="padding:5px"></div>
                                    <input name="thisbranchcheque" style="width:200px;" autocomplete="off" autofill="off" type="text" width="10" class="chequeinput form-control"  placeholder="Branch">
                                      <div style="padding:5px"></div>
                                    <input id="paymentinputcheque1" name="thisamountcheque" style="width:200px;" autocomplete="on" autofill="off" type="text" width="10" class="chequeinput form-control"  placeholder="Amount">
                                  </div>
                                </fieldset>

                                  <input id="totalvalue" name="thistotal" style="display:none" value="<?php echo $var_supertotal ?>">
                                  <input  name="thissubtotal" style="display:none" value="<?php echo $var ?>">
                                    <input  name="thisvat" style="display:none" value="<?php echo $var_vat ?>">
                                    <input  name="thislastinsertedid" style="display:none" value="<?php echo $var_lastidreal ?>">
                                <button type="button" class="btn btn-info btn-fill pull-right" onclick="getInputValue();")>Confirm</button>
                                 <div class="clearfix"></div>
                                 <div class="clearfix"></div>
                              <!-- FORM2 -->
                            </form>

                                  </div>
                          </div>
                      </div>



                      <div class="col-md-12">
                          <div class="card">
                              <div class="header">
                                  <h4 class="title">Oder Details</h4>

                              </div>

                            <form name="orderform" method="post" onsubmit="return validateForm()">  <!-- FORM3-->
                              <div class="content table-responsive">
                            <table class="table table-hover table-striped">
                                <thead>
                                  <tr>
                                    <th>ID</th>
                                    <th>Product</th>
                                    <th>QTY</th>
                                    <th> </th>
                                    <th>Price</th>
                                  </tr>
                                </thead>

                                <?php
                                while($row = mysqli_fetch_assoc($result)) {
                                ?>

                                  <tr>

                                  <td><?php echo $row['product_id'] ?></td>

                                    <td><?php echo $row['name'] ?></td>
                                    <td><?php echo $row['qty'] ?></td>
                                    <td ></td>
                                    <td><?php echo $row['price'] ?></td>

                                </tr>
                                <?php
                                }
                                 ?>

                               <tr style="background-color:LightYellow">

                               <td></td>

                                 <td></td>
                                 <td></td>
                                 <td>Subtotal</td>
                                  <td><?php echo $var ?></td>

                             </tr>
                             <tr style="background-color:LightYellow ">

                             <td></td>

                               <td></td>
                               <td> </td>
                               <td >Discount</td>
                                <td><?php echo $var_discountload ?></td>

                           </tr>
                             <tr style="background-color:LightYellow ">

                             <td></td>

                               <td></td>
                               <td> </td>
                               <td >12% Vat</td>
                                <td><?php echo $var_vat ?></td>

                           </tr>
                             <tr style="background-color:LightYellow">

                             <td></td>

                               <td></td>
                               <td></td>
                               <td>Total</td>
                                <td><?php echo $var_supertotal ?></td>

                           </tr>
                              </table>
                          </div>

                        </form>
                          <!-- FORm3 -->
                      </div>
                  </div>




              </div>
          </div>




      </div>
  </div><!--wrapper-->


  </body>
  <script src="assets/js/jquery-3.5.1.min.js" type="text/javascript"></script>
  <script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
  <!--  Charts Plugin -->
  <script src="assets/js/chartist.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="assets/js/bootstrap-notify.js"></script>

  <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
  <script src="assets/js/light-bootstrap-dashboard.js?v=1.4.0"></script>
  <!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
  <script src="assets/js/demo.js"></script>
  <script>

  function show1  (){
    document.getElementById("showseniorinput").style.display ='none';
  }
  function show2(){
    document.getElementById("showseniorinput").style.display = 'block';
    document.getElementById("showseniorinput").style.display = 'block';
    document.getElementById("output").value = " ";
  }

  function show3(){
    document.getElementById("paymentinput").style.display ='none';
      document.getElementById("paymentinput1").style.display = 'block';
  }
  function show4(){
    document.getElementById("paymentinput").style.display = 'block';
      document.getElementById("paymentinput1").style.display = 'none';
  }



  function getInputValue(){
    if(document.getElementById('cashradio1').checked) {

    var inputVal = document.getElementById("paymentinput1").value;
    var inputVal2 = document.getElementById("totalvalue").value;
    var integer1 = parseInt(inputVal, 10);
    var intege2 = parseInt(inputVal2, 10);
    if (integer1<intege2){
      alert("Invalid Cash. Must be higher than total ammount");
    }
    else {
       document.getElementById("myForm").submit();
    }
}else if(document.getElementById('chequeradio1').checked) {


  var inputVal = document.getElementById("paymentinputcheque1").value;
  var inputVal2 = document.getElementById("totalvalue").value;
  var integer1 = parseInt(inputVal, 10);
  var intege2 = parseInt(inputVal2, 10);

  if (integer1<intege2){
    alert("Invalid Cash. Must be higher than total amount");
  }
  else {
     document.getElementById("myForm").submit();
  }
}
            // Selecting the input element and get its value


        }

  </script>


  </html>
