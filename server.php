<?php 
	// for index_staff.php
	// INSERT, UPDATE & DELETE staff
	session_start();
		// Initialize variables
		$staff_first_n = $staff_last_n = "";
		$address = $address2 = $district = "";
		$city_name = "";
		$postal_code = $staff_phone = "";
		$picture = "";
		$staff_email = "";
		$store_id = $active = 1;
		$username = $password = "";
		$staff_id =  0;
		$edit_state = false;

		//INSERT INTO 
		//staff(staff_first_n, staff_last_n, address, address2, district, city_name, postal_code, staff_phone, picture, staff_email, store_id, active, username, password) 
		//VALUES ('$staff_first_n', '$staff_last_n', '$address', '$address2', '$district', '$city_name', '$postal_code', '$staff_phone', '$picture', '$staff_email', '$store_id', '$active', '$username', '$password')


	// connect to database
	//	CREATE USER 'mike'@'localhost' IDENTIFIED VIA mysql_native_password USING '***';GRANT ALL PRIVILEGES ON *.* TO 'mike'@'localhost' REQUIRE NONE WITH GRANT OPTION MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0;
	$db = mysqli_connect('localhost', 'mike', 'PCLC1712', 'entertainment');

	// if save button is clicked
	if (isset($_POST['save'])) {
		$staff_first_n = $_POST['staff_first_n'];
		$staff_last_n = $_POST['staff_last_n'];
		$address = $_POST['address']; 
		$address2 = $_POST['address2']; 
		$district = $_POST['district']; 
		$city_name = $_POST['city_name'];
		//$postal_code = $_POST['postal_code']; 
		$staff_phone = $_POST['staff_phone']; 
		//$picture = $_POST['picture'];
		//$staff_email = $_POST['staff_email'];
		$store_id  = $_POST['store_id']; 
		$active = $_POST['active']; 
		$username = $_POST['username']; 
		//$password = $_POST['password'];

		$query = "INSERT INTO staff(staff_first_n, staff_last_n, address, address2, district, city_name, postal_code, staff_phone, picture, staff_email, store_id, active, username, password) VALUES ('$staff_first_n', '$staff_last_n', '$address', '$address2', '$district', '$city_name', '$postal_code', '$staff_phone', '$picture', '$staff_email', '$store_id', '$active', '$username', '$password')";
		mysqli_query($db, $query);
		$_SESSION['msg'] = "Staff Record saved";
		header('location: index_staff.php');  // redirect to index page after inserting
	}  // endif if (isset($_POST['save']))

	// update records
	if (isset($_POST['update'])) {
		$staff_first_n = mysqli_real_escape_string($db, $_POST['staff_first_n']);
		$staff_last_n = mysqli_real_escape_string($db, $_POST['staff_last_n']);
		$address = mysqli_real_escape_string($db, $_POST['address']); 
		$address2 = mysqli_real_escape_string($db, $_POST['address2']); 
		$district = mysqli_real_escape_string($db, $_POST['district']); 
		$city_name = mysqli_real_escape_string($db, $_POST['city_name']);
		//$postal_code = mysqli_real_escape_string($_POST['postal_code']); 
		$staff_phone = mysqli_real_escape_string($db, $_POST['staff_phone']); 
		//$picture = mysqli_real_escape_string($_POST['picture']);
		//$staff_email = mysqli_real_escape_string($_POST['staff_email']);
		$store_id  = mysqli_real_escape_string($db, $_POST['store_id']); 
		$active = mysqli_real_escape_string($db, $_POST['active']); 
		$username = mysqli_real_escape_string($db, $_POST['username']); 
		//$password = mysqli_real_escape_string($_POST['password']);
		$staff_id = mysqli_real_escape_string($db, $_POST['staff_id']); 		
		
		//mysqli_query($db,"UPDATE staff SET staff_first_n='$staff_first_n', staff_last_n='$staff_last_n', address='$address', address2='$address2', district='$district', city_name='$city_name', postal_code='$postal_code', staff_phone='$staff_phone', picture='$picture', staff_email='$staff_email', store_id='$store_id', active='$active', username='$username', password= '$password' WHERE staff_id=$staff_id");

		$query = "UPDATE staff SET staff_first_n='$staff_first_n', staff_last_n='$staff_last_n', address='$address', address2='$address2', district='$district', city_name='$city_name',  staff_phone='$staff_phone', store_id='$store_id', active='$active', username='$username' WHERE staff_id=$staff_id";
		
		mysqli_query($db, $query);


		//mysqli_query($db,"UPDATE staff SET staff_first_n='$staff_first_n', staff_last_n='$staff_last_n', address='$address', address2='$address2', district='$district', city_name='$city_name',  staff_phone='$staff_phone', store_id='$store_id', active='$active', username='$username' WHERE staff_id=$staff_id");
		// mysqli_query($db,"UPDATE staff SET staff_first_n='$staff_first_n', staff_last_n='$staff_last_n', address='$address' WHERE staff_id=$staff_id");

		$_SESSION['msg'] = "Staff Record updated";
		header('location: index_staff.php');  // redirect to index page after updating
	} // endif  of update

	// delete records
	if (isset($_GET['del'])) {

		$staff_id = $_GET['del'];
		//mysqli_query($db, "DELETE FROM staff WHERE staff_id='$staff_id'");
		$query = "DELETE FROM staff WHERE staff_id='$staff_id'";

		// mysqli_query($db, $query);

		  	if (mysqli_query($db, $query)) {
		  		//success
				$_SESSION['msg'] = "Staff Record deleted";
				header('location: index_staff.php');  // redirect to index page after deleting		  		
		  	} {
		  		// failure
		  		echo 'query error: ' . mysqli_error($db);
		  	}
	}



	// retrieve records
	$results = mysqli_query($db, "SELECT * FROM staff"); 
	//print_r($results);

 ?>