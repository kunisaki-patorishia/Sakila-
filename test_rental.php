<?php include('server_test_rental.php');
	// fetch record to be updated
	if (isset($_GET['edit'])) {
		$rental_id = $_GET['edit'];
		$edit_state = true;

		$rec = mysqli_query($db, "SELECT * FROM rental WHERE rental_id=$rental_id");
		$results = mysqli_query($db, "SELECT * FROM rental WHERE rental_id=$rental_id");

		$record = mysqli_fetch_array($rec);

		$rental_date = $record['rental_date'];
		$inventory_id = $record['inventory_id'];
		$customer_id = $record['customer_id'];
		$return_date = $record['return_date'];
		$staff_id = $record['staff_id'];
	}  // endif fetch the record to be updated

?>

<!DOCTYPE html>
<html>
<head>
	<title>Sakila DVD Renting Company</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

	<!-- <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST"> -->
	<!-- 	<input type="text" name="name">
		<input type="submit" name="submit" value="submit"> -->
<!-- 		<input type="number" name="inventory_id">
		<input type="customer_id" name="customer_id">
		<input type="submit" name="submit" value="submit"> 

	</form> -->

	
	<center><h4>List of outstanding rental</h4></center>

		<!-- <h3 >Sakila DVD Renting Company ==> Rental Records Maintenance</h3> -->
		<!-- <div center><h4>List of outstanding rental ==> Click "Return" then "Update" to close rental transaction</h4></div> -->
		<!-- <div center><h4>List of outstanding rental</h4></div> -->
	
	<h4>
	<?php if (isset($_SESSION['msg'])): ?>
		<div class="msg">
			<?php 
				echo $_SESSION['msg'];
				unset($_SESSION['msg']);
			?>
		</div>
	<?php endif ?>	
	<table>
		<thead>
			<tr>
				<th>Rental ID</th>
				<th>Rental Date</th>
				<th>Inventory Id</th>
				<th>Customer Id</th>
				<th>Return Date</th>
				<th>Staff Id</th>
				<th colspan="2">Action</th>
			</tr>
		</thead>
		<tbody>
			<?php while ($row = mysqli_fetch_array($results)) {  ?>
				<tr>
					<td><?php echo $row['rental_id'] ?></td>
					<td><?php echo $row['rental_date']; ?></td>
					<td><?php echo $row['inventory_id']; ?></td>
					<td><?php echo $row['customer_id']; ?></td>
					<td><?php echo $row['return_date']; ?></td>
					<td><?php echo $row['staff_id']; ?></td>
					<td></td>
					<td>
						<a class="edit_btn" href="test_rental.php?edit=<?php echo $row['rental_id']; ?>">Return</a>
					</td>
					<td>
						<a class="del_btn" href="server_test_rental.php?del=<?php echo $row['rental_id']; ?>">Delete</a>
					</td>
				</tr>
			<?php } ?>
		</tbody>		
	</table> 
	</h4>
	

	<form method="post" action="server_test_rental.php">
		
		<?php if ($edit_state == false):  ?>		
			<input type="hidden" name="rental_id" value="<?php echo $rental_id ?>">
			<!-- if new record, no data entry required;  IF old record, need to prompt for rental_id fr user -->
			<label>Rental Date : </label>
			<input type="text" name="rental_date" value="<?php echo $rental_date; ?>" readonly><br>

			<label>Inventory Id: </label>
			<input type="number" name="inventory_id" min=1 max= 10000 required value="<?php echo $inventory_id; ?>"><br>

			<label>Customer Id: </label>
			<input type="number" name="customer_id" min=1 max= 1000 required value="<?php echo $customer_id; ?>"><br>

<!-- 			<label>Return Date: </label>
			<input type="text" name="return_date" value="<?php echo $return_date; ?>" readonly> -->

			<label>Staff ID: </label>
			<input type="number" name="staff_id" min=1 max= 2 required value="<?php echo $staff_id; ?>"><br>

		<?php else: ?>

			<!-- <input type="hidden" name="rental_id" value="<?php echo $rental_id ?>"> -->
			<label>Rental ID : </label>
			<input type="number" name="rental_id" value="<?php echo $rental_id ?>" readonly><br>
			<!-- if new record, no data entry required;  IF old record, need to prompt for rental_id fr user -->
			<label>Rental Date : </label>
			<input type="text" name="rental_date" value="<?php echo $rental_date; ?>" readonly><br>

			<label>Inventory Id: </label>
			<input type="number" name="inventory_id" value="<?php echo $inventory_id; ?>" readonly><br>

			<label>Customer Id: </label>
			<input type="number" name="customer_id" value="<?php echo $customer_id; ?>" readonly><br>

			<label>Return Date: </label>
			<?php $return_date = date("Y-m-d H:i:s"); ?>
			<input type="text" name="return_date" value="<?php echo $return_date; ?> "readonly>

			<label>Staff ID: </label>
			<input type="number" name="staff_id" min=1 max= 2 required value="<?php echo $staff_id; ?>"><br>			

		<?php endif ?>

		<div class="input-group">	
			<?php if ($edit_state == false): ?>
				<button type="submit" name="save" class="btn">Save</button>
			<?php else: ?>
				<button type="submit" name="update" class="btn">Update</button>
			<?php endif ?>		
		</div>	
		<h6>Placing Rental -- Fill in the form and Click "Save"</h6>
		<h6>Closing Rental -- Click "Return" at top section, then "Update", only staff id changable</h6>
	</form>
</body>
<footer>
	<center><div><h6>Copyright 2021 Group_3__10_4_Sakila DVD Renting</h6></div></center>
</footer>
</html>