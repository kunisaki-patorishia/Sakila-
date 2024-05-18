<<<<<<< HEAD
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
				
	} // endif fetch the record to be updated


?>
<!DOCTYPE html>
<html>
<head>
	<title>Sakila DVD Renting Company</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	
	<center><h3>Staff Records Maintenace</h3></center>
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
				<th>District</th>
				<th>Phone</th>
				<th>Store Id </th>
				<th>Active (Y/N)</th>
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
<footer>
	 <center><div><h6>Copyright 2021 Group_3__10_4_Sakila DVD Renting</h6></div></center>
</footer>
</html>
=======
<?php
$db = mysqli_connect('localhost','mike','PCLC1712','entertainment');

if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}


include('server.php');

// Initialize variables
$staff_id = $staff_first_n = $staff_last_n = $address = $address2 = $district = $city_name = $postal_code = $staff_phone = $picture = $staff_email = $store_id = $active = $username = $password = '';
$edit_state = false;

// Fetch the record to be updated
if (isset($_GET['edit'])) {
    $staff_id = $_GET['edit'];
    $edit_state = true;

    $rec = mysqli_query($db, "SELECT * FROM staff WHERE staff_id=$staff_id");
    if (!$rec) {
        die("Error: " . mysqli_error($db));
    }

    $record = mysqli_fetch_array($rec);
    if (!$record) {
        die("No record found for staff ID: $staff_id");
    }

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
}

// Retrieve all staff records
$results = mysqli_query($db, "SELECT * FROM staff");

?>

<!DOCTYPE html>
<html>
<head>
    <title>Sakila DVD Renting Company</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

    <!-- Include header -->
    <?php include('templates/header.php'); ?>

    <center><h3>Staff Records Maintenance</h3></center>
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
                <th>Staff Last Name</th>
                <th>Address 1</th>
                <th>Address 2</th>
                <th>District</th>
                <th>City Name</th>
                <th>Postal Code</th>
                <th>Phone</th>
                <th>Staff Email</th>
                <th>Store Id</th>
                <th>Active (Y/N)</th>
                <th colspan="2">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            if ($results && mysqli_num_rows($results) > 0) {
                while ($row = mysqli_fetch_array($results)) { ?>
                    <tr>
                        <td><?php echo $row['staff_first_n']; ?></td>
                        <td><?php echo $row['staff_last_n']; ?></td>
                        <td><?php echo $row['address']; ?></td>
                        <td><?php echo $row['address2']; ?></td>
                        <td><?php echo $row['district']; ?></td>
                        <td><?php echo $row['city_name']; ?></td>
                        <td><?php echo $row['postal_code']; ?></td>
                        <td><?php echo $row['staff_phone']; ?></td>
                        <td><?php echo $row['staff_email']; ?></td>
                        <td><?php echo $row['store_id']; ?></td>
                        <td><?php echo $row['active']; ?></td>
                        <td>
                            <a class="edit_btn" href="index_staff.php?edit=<?php echo $row['staff_id']; ?>">Edit</a>
                        </td>
                        <td>
                            <a class="del_btn" href="server.php?del=<?php echo $row['staff_id']; ?>">Delete</a>
                        </td>
                    </tr>
                <?php }
            } else {
                echo "<tr><td colspan='12'>No staff records found</td></tr>";
            }
            ?>
        </tbody>
    </table>
    
    <form method="post" action="server.php">
        <input type="hidden" name="staff_id" value="<?php echo $staff_id; ?>">
        <label>Staff First Name</label>
        <input type="text" name="staff_first_n" maxlength="45" size="45" required value="<?php echo $staff_first_n; ?>"><br>
        
        <label>Staff Last Name</label>
        <input type="text" name="staff_last_n" maxlength="45" size="45" required value="<?php echo $staff_last_n; ?>"><br>      

        <label>Address 1</label>
        <input type="text" name="address" maxlength="100" size="100" required value="<?php echo $address; ?>"><br>

        <label>Address 2</label>
        <input type="text" name="address2" maxlength="100" size="100" value="<?php echo $address2; ?>"><br>

        <label>District</label>
        <input type="text" name="district" maxlength="20" size="20" value="<?php echo $district; ?>"><br>

        <label>City Name</label>
        <input type="text" name="city_name" maxlength="50" size="50" value="<?php echo $city_name; ?>"><br>

        <label>Postal Code</label>
        <input type="text" name="postal_code" maxlength="10" size="10" value="<?php echo $postal_code; ?>"><br>

        <label>Phone</label>
        <input type="text" name="staff_phone" maxlength="20" size="20" value="<?php echo $staff_phone; ?>"><br>

        <label>Staff Email</label>
        <input type="email" name="staff_email" maxlength="50" size="50" value="<?php echo $staff_email; ?>"><br>

        <label>Store Id</label>
        <input type="text" name="store_id" value="<?php echo $store_id; ?>"><br>

        <div class="input-group">
            <?php if ($edit_state == false): ?>
                <button type="submit" name="save" class="btn">Add</button>
            <?php else: ?>
                <button type="submit" name="update" class="btn">Update</button>
            <?php endif ?>
        </div>
    </form>

    <!-- Include footer -->
    <?php include('templates/footer.php'); ?>

</body>
</html>
>>>>>>> 79b11c2 (Add new folder)
