<?php include('server.php');  

	// fetch the record to be updated
	if (isset($_GET['edit'])) {
		$staff_id = $_GET['edit'];
		//	print_r($staff_id);
		//	print_r($staff_first_n);
		$edit_state = true;

		$rec = mysqli_query($db, "SELECT * FROM staff WHERE staff_id=$staff_id");
		$record = mysqli_fetch_array($rec);

		//$staff_id =  $record['staff_id'];
		$staff_first_n = $record['staff_first_n'];
		$staff_last_n = $record['staff_last_n'];
		$address = $record['address'];
		$address2 = $record['address2'];
		$district = $record['district'];
		$city_name = $record['city_name'];
		$postal_code = $record['postal_code'];
		$staff_phone = $record['staff_phone'];
		$picture = $record['picture'];
		$staff_email = $record['staff_email'];
		$store_id = $record['store_id'];
		$active = $record['active'];
		$username = $record['username'];
		$password = $record['password'];

		//	print_r($staff_id);
				
	}


?>
<!DOCTYPE html>
<html>
<head>
	<title>Staff Records Maintenance</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
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
				<th>Staff First Name</th>
				<th>Staff Last Name </th>
				<!-- <th>Address Line 1</th>
				<th>Address Line 2</th> -->
				<th>District</th>
				<!-- <th>City & Country :</th> -->
				<!-- <th>Postal Code :</th> -->
				<th>Phone</th>
				<!-- <th>Picture :</th> -->
				<!-- <th>Email :</th> -->
				<th>Store Id </th>
				<th>Active (Y/N)</th>
				<!-- <th>Username</th> -->
				<!-- <th>Password :</th>  -->
				<th colspan="2">Action</th>
			</tr>

		</thead>
		<tbody>

			<?php while ($row = mysqli_fetch_array($results)) { ?>
				<tr>
					<td><?php echo $row['staff_first_n']; ?></td>
					<td><?php echo $row['staff_last_n']; ?></td>
					<td><?php echo $row['district']; ?></td>
					<!-- <td><?php echo $row['city_name']; ?></td> -->
					<td><?php echo $row['staff_phone']; ?></td>
					<td><?php echo $row['store_id']; ?></td>
					<td><?php echo $row['active']; ?></td>
					<!-- <td><?php echo $row['username']; ?></td> -->
					<td></td>
					<td>
						<a class="edit_btn" href="index_staff.php?edit=<?php echo $row['staff_id']; ?>">Edit</a>
					</td>
					<td>
						<a class="del_btn" href="server.php?del=<?php echo $row['staff_id']; ?>">Delete</a>
					</td>
				</tr>				

			<?php } ?>

		</tbody>
	</table>
	<form method="post" action="server.php">
	<input type="hidden" name="staff_id" value="<?php echo $staff_id; ?>">
		<!-- <div class="input-group"> -->
			<label>Staff First Name</label>
			<input type="text" name="staff_first_n" maxlength="45" size="45" required value="<?php echo $staff_first_n; ?>"><br>
		<!-- </div> -->		

		<!-- <div class="input-group"> -->
			<label>Staff Last Name</label>
			<input type="text" name="staff_last_n" maxlength="45" size="45" required value="<?php echo $staff_last_n; ?>"><br>
		<!-- </div> -->

		<!-- <div class="input-group"> -->
			<label>Address Line 1</label>
			<input type="text" name="address" maxlength="50" size="50" required value="<?php echo $address; ?>"><br>
		<!-- </div> -->

		<!-- <div class="input-group"> -->
			<label>Address Line 2</label>
			<input type="text" name="address2" maxlength="50" size="50" value="<?php echo $address2; ?>"><br>
		<!-- </div> -->

		<!-- <div class="input-group"> -->
			<label>District</label>
			<input type="text" name="district" maxlength="20" required value="<?php echo $district; ?>">
		<!-- </div> -->

		<!-- <div class="input-group"> -->
			<label>City & Country</label>
			<input type="text" name="city_name" maxlength="40" required value="<?php echo $city_name; ?>"><br>
		<!-- </div> -->

		<!-- <div class="input-group"> -->
			<label>Postal Code</label>
			<input type="text" name="postal_code" maxlength="5" size="5" value="<?php echo $postal_code; ?>">
		<!-- </div> -->

		<!-- <div class="input-group"> -->
			<label>Phone</label>
			<input type="text" name="staff_phone" maxlength="20" size="10" required value="<?php echo $staff_phone; ?>"><br>
		<!-- </div>			 -->

			<!-- <th>Picture :</th> -->		
		<!-- <div class="input-group"> -->
			<label>Email</label>
			<input type="email" name="staff_email" maxlength="50" value="<?php echo $staff_email; ?>">
		<!-- </div> -->

		<!-- <div class="input-group"> -->
			<label>Store Id</label>
			<input type="number" name="store_id" min="1" max="2" size="2" required value="<?php echo $store_id; ?>">
		<!-- </div> -->

		<!-- <div class="input-group"> -->
			<label>Active</label>
			<input type="radio" name="active" value="1">
			<label for="1">Y</label>
			<input type="radio" name="active" value="0">
			<label for="0">N</label><br>
			<!-- <input type="radio" name="active" value="<?php echo $active; ?>"><br> -->
			<!-- PROBLEM PROBLEMPROBLEMPROBLEMPROBLEM-->
		<!-- </div>	 -->

		<!-- <div class="input-group"> -->
			<label>Username</label>
			<input type="text" name="username" maxlength="16" size="8" required value="<?php echo $username; ?>">
		<!-- </div>			 -->

		<!-- <div class="input-group"> -->
			<label>Password</label>
			<input type="password" name="password" maxlength="40" size="20" value="<?php echo $password; ?>">
		<!-- </div>	 -->

		<div class="input-group">
			<?php if ($edit_state == false): ?>
				<button type="submit" name="save" class="btn">Save</button>
			<?php else: ?>
				<button type="submit" name="update" class="btn">Update</button>
			<?php endif ?>
			
		</div>
	</form>
</body>
</html>