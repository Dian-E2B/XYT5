<!doctype html>
<?php
session_start();
include 'z_execute/connection.php';
//LOAD DATA
if (isset($_GET['id'])) {
		$var= $_GET['id'];
$sql1="SELECT d.order_log_id,d.total,f.payment_type,a.name,a.customer_id,a.phone,a.address,b.type_name,c.customer_type,e.product_id,e.qty,g.Name
from tbl_orderdetails d
left join tbl_customer a using(customer_id)
left join tbl_customertype b using(customertype_id)
left join tbl_ordertype c using(ordertype_id)
left join tbl_orderline e using(order_log_id)
left join tbl_payment f using(payment_id)
left join tbl_product g using(product_id)
WHERE order_log_id='$var'";
$sql_result1=mysqli_query($connection,$sql1);
$sql_result2=mysqli_query($connection,$sql1);//WHILE LOOP
$row2 = mysqli_fetch_assoc($sql_result1);

}
else{
	echo "NONE";
}
?>
<html lang="en">
<head></head>
<body>
	 <div class="modal-body">

		 <table class="table">

					 <tr>
						 <th style="" >Name: </th>
						 <td style="" ><?php echo $row2['name']; ?></td>
					 </tr>
					 <tr>
						<th style="" >Address: </th>
						<td style="" ><?php echo $row2['address']; ?></td>
					</tr>
					<tr>
					 <th style="" >Phone:</th>
					 <td style="" ><?php echo $row2['phone']; ?> </td>
				 </tr>
				 <tr>
					<th style="" >Cient Type:</th>
					<td style="" ><?php echo $row2['type_name']; ?> </td>
				</tr>
				<tr>
				 <th style="" >Customer Type:</th>
				 <td style="" ><?php echo $row2['customer_type']; ?> </td>
			 </tr>
			 <tr>
				<th style="" >Payment: </th>
				<td style="" ><?php echo $row2['payment_type']; ?> </td>
			</tr>
			 <tr>
			 <th style="background-color:	#DCDCDC" >Products</th>
			 <th style="background-color:	#DCDCDC" >Quantity</th>

		 </tr>
		 <?php
		 while ($row = mysqli_fetch_assoc($sql_result2)) {
		 ?>
			 <tr>
				<td style="background-color:	#E8E8E8" ><?php echo $row['Name']; ?> </td>
				<td style="background-color:	#E8E8E8" ><?php echo $row['qty']; ?> </td>
			</tr>
	 <?php }?>
	 <tr>
		<th style="" >Total:</th>
		<td style="" ><?php echo $row2['total']; ?>  ₱</td>
	</tr>

		 </table>

<form id="myForm" action="return.php" method="POST" >
<input style="display:none;" name="thisorderlog" value="<?php echo $row2['order_log_id']; ?>">
</form >

	 </div>
	 <div class="modal-footer">
			 <button style="border:none;" type="button" class="btn btn-fill btn-secondary" data-dismiss="modal">Close</button>
			  <button onclick="myFunction()" type="button" form="form1" value="Submit" style="float:left; background-color: #FF4500 ; color: white; border: none;" class="btn btn-secondary">Tagged as Returned</button>
	 </div>



	 <!-- MODAL -->

</body>

	<script>
	function myFunction() {
	  var txt;
	  if (confirm("Press OK to confirm.")) {
	    txt = "You pressed OK!";
			   document.getElementById("myForm").submit();
	  } else {
	    txt = "You pressed Cancel!";
	  }

	}
	$('#exampleModals').on('hide.bs.modal', function() {
	    $('#exampleModals').removeData();
	})

	</script>



</html>
