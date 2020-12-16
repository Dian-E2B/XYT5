<!doctype html>
<html lang="en">
<?php
include 'z_execute/connection.php';
$sql="select p.product_id,p.name,c.qty,c.price from tbl_product p join tbl_cart c using(product_id);";//LOAD DATA
$result = mysqli_query($connection, $sql);

$sqlcleandelete="DELETE FROM TBL_CART WHERE QTY=0";//LOAD DATA
$resultdelete = mysqli_query($connection, $sqlcleandelete);

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
                        <!-- FORM1 --><form method="POST" action="checkout0.php">
                                          <div class="row">
                                              <div class="col-md-4">
                                                  <div style="margin-bottom: 3px;" class="form-group">
                                                      <label>Client Name</label>
                                                      <input name="thisclientname" required autocomplete="on" autofill="on"
                                                          class="form-control" placeholder="Name">
                                                  </div>
                                              </div>

                                              <div class="col-md-4">
                                                  <div style="margin-bottom: 3px;" class="form-group">
                                                      <label for="exampleInputEmail1">Phone</label>
                                                      <input required name="thisphone" autocomplete="on" autofill="off" type="phone"
                                                          class="form-control" placeholder="Phone">
                                                  </div>
                                              </div>

                                              <div class="col-md-4">
                                                  <div style="margin-bottom: 3px;" class="form-group">
                                                      <label for="exampleInputEmail1">Type</label>
                                                      <select name="thisclienttype" class="form-control">

                                                          <?PHP
                                                          while($row2 = mysqli_fetch_assoc($execute)) {
                                                          ?>
                                                        <option value="<?php echo $row2['ordertype_id']  ?>"><?php echo $row2['customer_type']  ?></option>
                                                      <?php
                                                        }
                                                       ?>
                                                       </select>
                                                  </div>
                                              </div>
                                          </div>

                                          <div class="row">
                                           <div class="col-md-3">
                                               <div class="form-group">
                                                   <label>address</label>
                                                   <textarea required rows="2" class="form-control"
                                                       placeholder="Here can be your description" autofill="on"
                                                       value="Mike" name="thisaddress" autocomplete="on" ></textarea>
                                               </div>
                                           </div>
                                       </div>

                                       <h4>Discounts</h4>
                                         <div class="row">
                                           <div class="col-md-3">
                                             <fieldset id="discountsradio">
                                           <input  onclick="show1();" type="radio" name="discountsradio"  value="None1" checked> None<!-- NONE RADIO -->
                                           <div style="padding:5px"></div>


                                           <input type="radio" onclick="show2();" name="discountsradio" value="senior1" clas> I am a senior citizen <br> <!-- SENIOR RADIO -->
                                           <div id="showseniorinput" style="display:none;">
                                             <input name="thisaccount" style="width:200px;" autocomplete="off" autofill="on" type="text"  class="setizeninput form-control"  placeholder="Name">
                                             <div style="padding:5px"></div>
                                              <input name="thiscardid" style="width:200px;" autocomplete="on" autofill="on" type="text"  class="setizeninput form-control"  placeholder="Senior Citizen Card ID">
                                            </div>
                                         </fieldset>
                                         </div>
                                       </div>
    <!-- SUBMIT FORM1 -->               <button name="submitcustomer" type="submit" class="btn btn-info btn-fill pull-right")>Apply</button>
                                         <div class="clearfix"></div>
                                  </form>
                                  <!-- FORM1 -->
                            </div>
                        </div>
                    </div>


                    <div class="col-md-12">
                        <div class="card">
                          <div class="content">

                            <!-- FORM2 -->
                            <form >
                            <h4>Payment</h4>

                                <fieldset id="paymentradio" disabled >

                                <input class="paymentradioclass" onclick="show3();" type="radio" name="paymentradio" value="cash1" class="radiobtn" checked> Cash<br>
                                <div style="padding:5px"></div>

                                      <!-- thiscash --><input style="width:200px;" name="thiscash" autocomplete="on"  autofill="on" type="number" size="50"  class="cashinput form-control" placeholder="Enter Cash">
                                      <div style="padding:5px"></div>

                                <input onclick="show4();"  type="radio" name="paymentradio" value="cheque1" > Cheque

                                <div id="paymentinput" style="display:none;">
                                <input name="thischeque" style="width:200px;" autocomplete="on" autofill="on" type="text" width="10"  class="chequeinput form-control" placeholder="Check Number">
                                <div style="padding:5px"></div>
                                <input name="thischeque" style="width:200px;" autocomplete="on" autofill="on" type="text" width="10" class="chequeinput form-control"  placeholder="Bank">
                                  <div style="padding:5px"></div>
                                  <input name="thischeque" style="width:200px;" autocomplete="on" autofill="on" type="text" width="10" class="chequeinput form-control"  placeholder="Branch">
                                    <div style="padding:5px"></div>
                                  <input name="thischeque" style="width:200px;" autocomplete="on" autofill="on" type="text" width="10" class="chequeinput form-control"  placeholder="Amount">
                                </div>
                              </fieldset>

                              <button type="submit" class="btn btn-info btn-fill pull-right" onclick="diplaynotof('top','center')" disabled>TEST</button>
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

                          <form>  <!-- FORM3-->
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
                             <td >12% Vat</td>
                              <td><?php echo $var_vat ?></td>

                         </tr>
                           <tr style="background-color:LightYellow">

                           <td></td>

                             <td></td>
                             <td></td>
                             <td>Total</td>
                              <td><?php echo $var_total ?></td>

                         </tr>
                            </table>


                            <button type="submit" class="btn btn-info btn-fill pull-right" onclick="diplaynotof('top','center')">TEST</button>
                             <div class="clearfix"></div>

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
}

function show3(){
  document.getElementById("paymentinput").style.display ='none';
}
function show4(){
  document.getElementById("paymentinput").style.display = 'block';
}



</script>


</html>
