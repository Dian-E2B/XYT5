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

            $sqlshow_suppliers="Select supplier_id,company_name,email,phone,address,status_id from tbl_supplier
            where supplier_id='$var';";

            $sqlshow_status="Select status_id,status_name from tbl_status";
            $resultstats = $conn->query($sqlshow_status);


            $result = $conn->query($sqlshow_suppliers);
            $rowsupps=mysqli_fetch_assoc($result);

            // $sqlshow_allsupplier2="select supplier_id,company_name from tbl_supplier;";
            // $resultsupps2 = $conn->query($sqlshow_allsupplier2);

             //$sqlshow_allstatus2="select status_id,status_name from tbl_status;";
             //$resultstats2 = $conn->query($sqlshow_allstatus2);

            // $sqlshow_allprice_type="select unit_id,unit_type from tbl_pricing;";
            // $resultpricetype = $conn->query($sqlshow_allprice_type);
        }



?>

<head>


</head>

<body>
    <!-- Modal content-->
    <div class="modal-body">

        <form action="z_execute/update_supplier.php" >
            <fieldset id="homeFieldset" disabled>

                <div class="row">
                    <div class="col-md-6">
                        <div style="margin-bottom: 5px; display: none;" class="form-group">
                            <label for="exampleInputEmail1">ID</label>
                            <input style="border-radius: 15px;" name="thissid" required class="form-control" value="<?php echo  $rowsupps['supplier_id'];    ?>">
                        </div>
                        <div style="margin-bottom: 5px;" class="form-group">
                            <label for="exampleInputEmail1">Name</label>
                            <input style="border-radius: 15px;" name="thissname" type="text"  class="form-control" value="<?php echo $rowsupps['company_name'];?>">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div style="margin-bottom: 5px;" class="form-group">
                            <label>Email</label>
                            <input style="border-radius: 15px;" type="email" class="form-control" name="thisemail"
                                placeholder="Created by ID" value="<?php echo  $rowsupps['email'];?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div style="margin-bottom: 5px;" class="form-group">
                            <label>Phone</label>
                            <input id="phonenumber" style="border-radius: 15px;"   class="form-control" name="thisphone"
                                placeholder="Created by ID" pattern="[0-9]{10}" title="Invalid format. eg. 9218321121" required value="<?php echo  $rowsupps['phone'];?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div  style="margin-bottom: 5px;" class="form-group">
                            <label>Status</label>
                            <select class="form-control" name="thisstatus">
                                <?php
										            while($row4=mysqli_fetch_assoc($resultstats))
											            {
											            ?>
                                <option value="<?php echo $row4['status_id']; ?>"><?php echo $row4['status_name']; ?>
                                </option>
                                <?php
									                    }
								                        ?>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Address</label>
                            <textarea    rows="3"
                                class="form-control" name="thisaddress" pattern="[A-Za-z]+" title="No special characters." required><?php echo $rowsupps['address'] ?></textarea>
                        </div>
                    </div>
                </div>

            </fieldset>
            <button  type="submit" style="display:none;" id="btnupdate"
                class="col-md-3 btn btn-success btn-fill pull-right">Update Supplier</button>
        </form>



        <button id="editbtn1" onclick="EditButton()" class="col-md-3 btn btn-info btn-fill editbutton"><i
                style="font-size:20px;" readonly id="editbtn" style="display: block" class="fas fa-edit"></i></button>

        <button id="btndelete" style="margin-left:20px; display:none;" class="small btn btn-danger btn-fill"><i
                style="font-size:20px; " readonly class="fas fa-user-slash"></i></button>
        <div class="clearfix"></div>
    </div>
</body>

<!--   Core JS Files   -->

</body>
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
$(".editbutton").click(function() {
    var x = document.getElementById("btnupdate"); //btnupdate
    //var y = document.getElementById("editbtn"); //icon
    //var z = document.getElementById("editbtn1"); //button
    if (x.style.display === "block") {
        x.style.display = "none"; //edit
        $("#editbtn").removeClass('fas fa-ban');
        $("#homeFieldset").prop('disabled', true)
        $("#editbtn").addClass('fas fa-edit');
        $("#editbtn1").removeClass('btn-default');
        $("#editbtn1").addClass('btn-info');
        //$("#btndelete").show();
    } else {
        x.style.display = "block"; //cancel
        $("#editbtn1").removeClass('btn-info');
        $("#editbtn").removeClass('fas fa-edit');
        $("#editbtn1").addClass('btn-default');
        $("#editbtn").addClass('fas fa-ban');
        $("#homeFieldset").prop('disabled', false);
        //$("#btndelete").hide();
    }
});


</script>

</html>
