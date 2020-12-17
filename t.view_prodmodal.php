<?php
$host='localhost';
$username='root';
$password='';
$database='possys';
        $conn = new mysqli($host, $username, $password, $database);

        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }
        session_start();
        if (isset($_GET['id'])) {
            $var= $_GET['id'];

            $sqlshow_products_view="select p.product_id,p.name,p.description,p.stocks,p.price,p.sku,p.date_added,o.username,r.unit_type,s.company_name,a.status_name
            from tbl_product p
            join tbl_supplier s using(supplier_id)
            join tbl_status a on a.status_id=p.status_id
            join tbl_login o on o.user_id=p.addedby_id
            join tbl_pricing r on r.unit_id=p.price_type
            where product_id='$var'";



             if ($result_viewp = $conn->query($sqlshow_products_view)) {
                $row2=mysqli_fetch_assoc($result_viewp);
              }
              else{
                  echo "Error:1 " . $sqlshow_products_view . "<br>" . $conn->error;

              }

             $sqlshow_allsupplier2="select supplier_id,company_name from tbl_supplier where status_id=1;";
             $resultsupps2 = $conn->query($sqlshow_allsupplier2);

             $sqlshow_allstatus2="select status_id,status_name from tbl_status;";
             $resultstats2 = $conn->query($sqlshow_allstatus2);

             $sqlshow_allprice_type="select unit_id,unit_type from tbl_pricing;";
             $resultpricetype = $conn->query($sqlshow_allprice_type);
        }



?>

<head>


</head>
<body>



<!-- Modal content-->
            <div class="modal-body">
                    <form id="add_prod_form" action="z_execute/update_prod.php">
                        <fieldset id="homeFieldset" disabled>
                            <div class="row">
                            <div class="col-md-6">
                                    <div style="margin-bottom: 5px; display: none;" class="form-group">
                                        <label for="exampleInputEmail1">ID</label>
                                        <input style="border-radius: 15px;" name="thispid" class="form-control" value="<?php echo  $row2['product_id'];    ?>">
                                    </div>
                                    <div style="margin-bottom: 5px;" class="form-group">
                                        <label for="exampleInputEmail1">Name</label>
                                        <input style="border-radius: 15px;" name="thispname" type="text" pattern="[A-Za-z\s]+" title="Invalid Input. Must contain letters only" class="form-control" value="<?php echo  $row2['name'];    ?>">
                                    </div>


                                </div>


                                <div class="col-md-6">
                                    <div style="margin-bottom: 5px;" class="form-group">
                                        <label>Supplier</label>
                                            <select class="form-control"  name="thissupplier">
                                                        <?php
										            while($row3=mysqli_fetch_assoc($resultsupps2))
											            {
											            ?>
                                                        <option value="<?php echo $row3['supplier_id']; ?>"><?php echo $row3['company_name']; ?></option>
                                                        <?php
									                    }
								                        ?>
                                                    </select>
                                    </div>
                                </div>


                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div style="margin-bottom: 5px;" class="form-group">
                                        <label>Date Added</label>
                                        <input disabled style="border-radius: 15px;" class="form-control" name="thisdate" value="<?php echo $row2['date_added'];  ?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div style="margin-bottom: 5px;" class="form-group">
                                        <label>Added By</label>
                                        <input readonly style="border-radius: 15px;"  class="form-control" name="thisadmin" placeholder="Created by ID" value="<?php echo  $row2['username'];?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div style="margin-bottom: 5px;" class="form-group">
                                        <label>Status</label>
                                        <select class="form-control"  name="thisstatus">
                                                        <?php
										            while($row4=mysqli_fetch_assoc($resultstats2))
											            {
											            ?>
                                                        <option value="<?php echo $row4['status_id']; ?>"><?php echo $row4['status_name']; ?></option>
                                                        <?php
									                    }
								                        ?>
                                                    </select>
                                    </div>
                                </div>
                            </div>



                            <div class="row">
                                <div class="col-md-4">
                                    <div style="margin-bottom: 5px;" class="form-group">
                                        <label>Price Per Unit</label>
                                        <input style="border-radius: 15px;"  type="text" pattern="[1-9]*[^()/><\][\\\x22,;|]+" title="Must be digits only." class="form-control" placeholder="Price" name="thisprice" value="<?php echo $row2['price'] ?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div style="margin-bottom: 5px;" class="form-group">
                                        <label>Priced</label>
                                        <select class="form-control"  name="thisunit">
                                                        <?php
										            while($row5=mysqli_fetch_assoc($resultpricetype))
											            {
											            ?>
                                                        <option value="<?php echo $row5['unit_id']; ?>"><?php echo $row5['unit_type']; ?></option>
                                                        <?php
									                    }
								                        ?>
                                                    </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div style="margin-bottom: 5px;" class="form-group">
                                        <label>SKU</label>
                                        <input style="border-radius: 15px;"  type="text" class="form-control" required name="thissku" value="<?php echo $row2['sku'] ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                            <div class="col-md-2">
                                    <div style="margin-bottom: 5px;" class="form-group">
                                        <label>Stocks</label>
                                        <input style="border-radius: 15px;"  type="number" class="form-control" name="thisstocks" value="<?php echo $row2['stocks'] ?>">
                                    </div>
                                </div>
                                </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea  pattern="[^()/><\][\\\x22,;|]+" rows="3"  title="No special characters." class="form-control" name="thisdesc"
                                            ><?php echo $row2['description'] ?></textarea>
                                    </div>
                                </div>
                            </div>


                        </fieldset>

                    </form>
                    <button form="add_prod_form" type="submit"  style="display: none" id="btnupdate" class="col-md-3 btn btn-success btn-fill pull-right">Update
                            Product</button>
                    <button id="editbtn1" onclick="EditButton()" class="col-md-3 btn btn-info btn-fill editbutton"><i style="font-size:20px;" readonly  id="editbtn" style="display: block" class="fas fa-edit" ></i></button>

                    <div class="clearfix"></div>
                </div>
                </body>

<!--   Core JS Files   -->


<!--   Core JS Files   -->
<script src="assets/js/jquery-3.5.1.min.js" type="text/javascript"></script>
<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

<!--  Charts Plugin -->
<script src="assets/js/chartist.min.js"></script>

<!--  Notifications Plugin    -->
<script src="assets/js/bootstrap-notify.js"></script>

<!--  Google Maps Plugin    -->

<!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
<script src="assets/js/light-bootstrap-dashboard.js"></script>

<!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
<script src="assets/js/demo.js"></script>
<script>

$(".editbutton").click(function(){
    var x = document.getElementById("btnupdate");//btnupdate
  var y = document.getElementById("editbtn"); //icon
  var z = document.getElementById("editbtn1"); //button
  if (x.style.display === "block" ) {
    x.style.display = "none"; //edit
    $("#editbtn").removeClass('fas fa-ban');
    $("#homeFieldset").prop('disabled', true)
    $("#editbtn").addClass('fas fa-edit');
    $("#editbtn1").removeClass('btn-danger');
    $("#editbtn1").addClass('btn-info');
  } else {
    x.style.display = "block"; //cancel
    $("#editbtn1").removeClass('btn-info');
    $("#editbtn").removeClass('fas fa-edit');
    $("#editbtn1").addClass('btn-danger');
    $("#editbtn").addClass('fas fa-ban');
    $("#homeFieldset").prop('disabled', false)
  }
});
</script>
</html>
