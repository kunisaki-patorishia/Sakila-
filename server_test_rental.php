<<<<<<< HEAD
<?php 
	//session_start();
	// Initialize variables
		$rental_id =  0;
		$customer_id = 0;
		$inventory_id = 0;
		//$customer_id = 600;
		//$rental_id =  16050;

		$rental_date = date("Y-m-d H:i:s");

		$return_date = null;
		$staff_id = 0;

		$edit_state = false;
// if(isset($_POST['submit'])){

// 	if($_SERVER['QUERY_STRING'] == 'noname'){
// 		unset($_SESSION['name']); // unset  or clear single variable
// 		// unset or clear all superglobal variables tuto #36
// 		//session_unset();
// 	}
// 	$name = $_SESSION['name'];	

// 	$_SESSION['name'] = $_POST['name'];
// 	$_SESSION['inventroty_id'] = $_POST['inventory_id'];
// 	$_SESSION['customer_id'] = $_POST['customer_id'];


// }
	// connect to database
	$db = mysqli_connect('localhost', 'mike', 'PCLC1712', 'entertainment');
	if (!$db) {
	 	echo 'Connection Error : ' . mysqli_connect_error();
	}

	$error = array('rental_id'=>'', 'rental_date'=>'', 'inventory_id'=>'', 'customer_id'=>'', 'return_date'=>'', 'staff_id'=>'');
	$rental_vital_info = array('film_title'=>'','customer_first_n'=>'', 'customer_last_n'=>'', 'staff_first_n'=>'', 'staff_last_n'=>'');

	// if save button is clicked (CREATION OF NEW RENTAL RECORDS)
	if (isset($_POST['save'])) {
		// check if inventory_id, customer_id and staff_id exists
		if (!empty($_POST['inventory_id'])){
			$inventory_id = $_POST['inventory_id'];  // shd be selected  based on film name and store id			
			$sql_get_inventory = "SELECT film.title FROM film, inventory WHERE film.film_id = inventory.film_id && inventory_id=$inventory_id";
			// execute query for inventory and chk
			// if false - error {
			if (!mysqli_query($db, $sql_get_inventory))	{	
				echo 'query error: ' . mysqli_error($db);					
				$error['inventory_id'] = 'Inventory does not exist';
				//echo $error['inventory_id']; 
			} else { 
				// $rental_vital_info['film_title'] = array();
			}

			
		}
		if(!empty($_POST['customer_id'])){
			$customer_id = $_POST['customer_id'];	// shd be selected based on customer name			
			$sql_get_customer = "SELECT * FROM customer WHERE customer_id=$customer_id";
			// execute query
			// if false - error	{
				$error['customer_id'] = 'customer does not exist';
				//	echo $error['customer_id']; 
			// } else { echo 'customer_first_n'}			
		}
		if(!empty($_POST['staff_id'])){
			$staff_id = $_POST['staff_id'];   // shd be defaulted to staff_id of login session			
			$sql_get_staff = "SELECT * FROM staff WHERE staff_id=$staff_id";

			// execute query for staff and chk
			if (!mysqli_query($db, $sql_get_staff))	{
				//	echo $error['staff_id']; 
				echo 'query error: ' . mysqli_error($db);
				$error['staff_id'] = 'staff does not exist';				
			} else { 
				// success
				// $rental_vital_info['staff_first_n'] = ...;
				// $rental_vital_info['staff_last_n'] = ...;
				// echo 'staff_first_n';
			}		
			
			// execute query and chk
			if (mysqli_query($db, $sql_get_staff))	{
				// success
				echo 'staff_first_n';
			} else { 
				//	echo $error['staff_id']; 
				echo 'query error: ' . mysqli_error($db);
				$error['staff_id'] = 'staff does not exist';
			}					
		}		
		$rental_date = $_POST['rental_date'];  // shd be default to today's date and no change allowed
		$return_date = $_POST['return_date']; // shd be default to null and not  displayed /no change allowed

		if (array_filter($error)) {
			// there are errors in form
		} else {
			$inventory_id = mysqli_real_escape_string($db, $_POST['inventory_id']);
			$customer_id = mysqli_real_escape_string($db, $_POST['customer_id']);
			$staff_id = mysqli_real_escape_string($db, $_POST['staff_id']);

			$rental_date = mysqli_real_escape_string($db, $_POST['rental_date']);  
			$return_date = mysqli_real_escape_string($db, $_POST['return_date']); 
		}

		$query = "INSERT INTO rental (rental_date, inventory_id, customer_id, return_date, staff_id) VALUES ('$rental_date', '$inventory_id', '$customer_id', NULL, '$staff_id')";		
		if (mysqli_query($db, $query)) {
			// INSERT success, get the rental_id auto-assigned
			$results = mysqli_query($db, "SELECT * FROM rental order by rental_id desc limit 1");
			$rental_added = mysqli_fetch_array($results);
			$rental_id = $rental_added['rental_id'];
			// Get the duration and rental_rate for payment amount
			// $sql = "SELECT * FROM film, inventory WHERE film.film_id=inventory.film_id && inventory.inventory_id=$inventory_id";
			$sql = "SELECT * FROM film WHERE film.film_id=inventory.film_id && inventory.inventory_id=$inventory_id";
			mysqli_query($db, $sql);
			//$amount = echo "SELECT rental_rate FROM film, inventory WHERE film.film_id=inventory.film_id && inventory.inventory_id=$inventory_id";";

		
			
			$_SESSION['msg'] = "Rental Record saved";
			header('location: test_rental.php');  // redirect to index page after inserting
		} else {
			//$_SESSION['msg'] = "Rental Record not saved (ERROR)";
			header('location: test_rental.php');  // redirect to index page
		}  
		// $results = mysqli_query($db, "SELECT * FROM rental WHERE return_date is NULL && customer_id=$customer_id"); 		
	}  // endif if (isset($_POST['save']))

	// update record -- if edit & update buttons are clicked
	// for rental - it means returning DVD or reversing wrongly entered trx
	if (isset($_POST['update'])) {
		$rental_id = $_POST['rental_id'];
		$rental_date = $_POST['rental_date'];  // no change allowed
		$inventory_id = $_POST['inventory_id'];  // no change allowed
		$customer_id = $_POST['customer_id'];	// no change allowed
		$return_date = date("Y-m-d H:i:s");		// set return_date = today's data
		$return_date = $_POST['return_date'];;  // no change allowed
		$staff_id = $_POST['staff_id'];   // shd be defaulted to staff_id of login session and no change allowed

		$query = "UPDATE rental SET return_date='$return_date', staff_id='$staff_id' WHERE rental_id=$rental_id";
		if (mysqli_query($db, $query)) {				
			$results = mysqli_query($db, "SELECT * FROM rental WHERE rental_id=$rental_id");
			$_SESSION['msg'] = "Rental Trx closed (Inventory returned)";
			// $edit_state = false;
			header('location: test_rental.php');  // redirect to index page after updating
		} else {
			echo 'query error: ' . mysqli_error($conn);
			// $_SESSION['msg'] = "Rental Trx not closed (ERROR)";
			// header('location: test_rental.php');  // redirect to index page 
		}
	}  // endif if (isset($_POST['update']))

	// delete record -- if delete button is clicked
	// for rental - can provide the function but no old rental records will be deleted successfully
	if (isset($_GET['del'])) {
		$rental_id = $_GET['del'];
		
		$query = "DELETE FROM rental WHERE rental_id='$rental_id'";	
		if (mysqli_query($db, $query)) {
		  	//success
			$_SESSION['msg'] = "Staff Record deleted";
			header('location: index.php');  // redirect to index page after deleting	
		} {
			// failure
			echo 'query error: ' . mysqli_error($db);			
		}	// endif for if (mysqli_query($db, $query))

	} // endif for if (isset($_GET['del']))


	// retrieve records
	// for rental - it means ENTER the rental_id and display the ONE & ONLY rental record concerned
	// or  - 				 ENTER the customer_id and display those rental records belonging to the customer 
	//						 and have NULL for return_date
	// can't get the above working - temporary solution ... display all rental records that are outstanding
	//														i.e. have return_date that is NULL
	//$results = mysqli_query($db, "SELECT * FROM rental WHERE customer_id=$customer_id && return_date=null"); 	
	if ($edit_state == false) {
		$results = mysqli_query($db, "SELECT * FROM rental WHERE return_date is NULL" ); 	
	} 
	//$results = mysqli_query($db, "SELECT * FROM rental WHERE return_date=null"); 

	// OR ....
	// $results = mysqli_query($db, "SELECT * FROM rental WHERE rental_id=$rental_id && return_date=null"); 				

?>
=======
	<?php 
		//session_start();
		// Initialize variables
			$rental_id =  0;
			$customer_id = 0;
			$inventory_id = 0;
			//$customer_id = 600;
			//$rental_id =  16050;

			$rental_date = date("Y-m-d H:i:s");

			$return_date = null;
			$staff_id = 0;

			$edit_state = false;
	// if(isset($_POST['submit'])){

	// 	if($_SERVER['QUERY_STRING'] == 'noname'){
	// 		unset($_SESSION['name']); // unset  or clear single variable
	// 		// unset or clear all superglobal variables tuto #36
	// 		//session_unset();
	// 	}
	// 	$name = $_SESSION['name'];	

	// 	$_SESSION['name'] = $_POST['name'];
	// 	$_SESSION['inventroty_id'] = $_POST['inventory_id'];
	// 	$_SESSION['customer_id'] = $_POST['customer_id'];


	// }
		// connect to database
		$db = mysqli_connect('localhost', 'mike', 'PCLC1712', 'entertainment');
		if (!$db) {
		 	echo 'Connection Error : ' . mysqli_connect_error();
		}

		$error = array('rental_id'=>'', 'rental_date'=>'', 'inventory_id'=>'', 'customer_id'=>'', 'return_date'=>'', 'staff_id'=>'');
		$rental_vital_info = array('film_title'=>'','customer_first_n'=>'', 'customer_last_n'=>'', 'staff_first_n'=>'', 'staff_last_n'=>'');

		// if save button is clicked (CREATION OF NEW RENTAL RECORDS)
		if (isset($_POST['save'])) {
			// check if inventory_id, customer_id and staff_id exists
			if (!empty($_POST['inventory_id'])){
				$inventory_id = $_POST['inventory_id'];  // shd be selected  based on film name and store id			
				$sql_get_inventory = "SELECT film.title FROM film, inventory WHERE film.film_id = inventory.film_id && inventory_id=$inventory_id";
				// execute query for inventory and chk
				// if false - error {
				if (!mysqli_query($db, $sql_get_inventory))	{	
					echo 'query error: ' . mysqli_error($db);					
					$error['inventory_id'] = 'Inventory does not exist';
					//echo $error['inventory_id']; 
				} else { 
					// $rental_vital_info['film_title'] = array();
				}

				
			}
			if(!empty($_POST['customer_id'])){
				$customer_id = $_POST['customer_id'];	// shd be selected based on customer name			
				$sql_get_customer = "SELECT * FROM customer WHERE customer_id=$customer_id";
				// execute query
				// if false - error	{
					$error['customer_id'] = 'customer does not exist';
					//	echo $error['customer_id']; 
				// } else { echo 'customer_first_n'}			
			}
			if(!empty($_POST['staff_id'])){
				$staff_id = $_POST['staff_id'];   // shd be defaulted to staff_id of login session			
				$sql_get_staff = "SELECT * FROM staff WHERE staff_id=$staff_id";

				// execute query for staff and chk
				if (!mysqli_query($db, $sql_get_staff))	{
					//	echo $error['staff_id']; 
					echo 'query error: ' . mysqli_error($db);
					$error['staff_id'] = 'staff does not exist';				
				} else { 
					// success
					// $rental_vital_info['staff_first_n'] = ...;
					// $rental_vital_info['staff_last_n'] = ...;
					// echo 'staff_first_n';
				}		
				
				// execute query and chk
				if (mysqli_query($db, $sql_get_staff))	{
					// success
					echo 'staff_first_n';
				} else { 
					//	echo $error['staff_id']; 
					echo 'query error: ' . mysqli_error($db);
					$error['staff_id'] = 'staff does not exist';
				}					
			}		
			$rental_date = $_POST['rental_date'];  // shd be default to today's date and no change allowed
			$return_date = $_POST['return_date']; // shd be default to null and not  displayed /no change allowed

			if (array_filter($error)) {
				// there are errors in form
			} else {
				$inventory_id = mysqli_real_escape_string($db, $_POST['inventory_id']);
				$customer_id = mysqli_real_escape_string($db, $_POST['customer_id']);
				$staff_id = mysqli_real_escape_string($db, $_POST['staff_id']);

				$rental_date = mysqli_real_escape_string($db, $_POST['rental_date']);  
				$return_date = mysqli_real_escape_string($db, $_POST['return_date']); 
			}

			$query = "INSERT INTO rental (rental_date, inventory_id, customer_id, return_date, staff_id) VALUES ('$rental_date', '$inventory_id', '$customer_id', NULL, '$staff_id')";		
			if (mysqli_query($db, $query)) {
				// INSERT success, get the rental_id auto-assigned
				$results = mysqli_query($db, "SELECT * FROM rental order by rental_id desc limit 1");
				$rental_added = mysqli_fetch_array($results);
				$rental_id = $rental_added['rental_id'];
				// Get the duration and rental_rate for payment amount
				// $sql = "SELECT * FROM film, inventory WHERE film.film_id=inventory.film_id && inventory.inventory_id=$inventory_id";
				$sql = "SELECT * FROM film WHERE film.film_id=inventory.film_id && inventory.inventory_id=$inventory_id";
				mysqli_query($db, $sql);
				//$amount = echo "SELECT rental_rate FROM film, inventory WHERE film.film_id=inventory.film_id && inventory.inventory_id=$inventory_id";";

			
				
				$_SESSION['msg'] = "Rental Record saved";
				header('location: test_rental.php');  // redirect to index page after inserting
			} else {
				//$_SESSION['msg'] = "Rental Record not saved (ERROR)";
				header('location: test_rental.php');  // redirect to index page
			}  
			// $results = mysqli_query($db, "SELECT * FROM rental WHERE return_date is NULL && customer_id=$customer_id"); 		
		}  // endif if (isset($_POST['save']))

		// update record -- if edit & update buttons are clicked
		// for rental - it means returning DVD or reversing wrongly entered trx
		if (isset($_POST['update'])) {
			$rental_id = $_POST['rental_id'];
			$rental_date = $_POST['rental_date'];  // no change allowed
			$inventory_id = $_POST['inventory_id'];  // no change allowed
			$customer_id = $_POST['customer_id'];	// no change allowed
			$return_date = date("Y-m-d H:i:s");		// set return_date = today's data
			$return_date = $_POST['return_date'];;  // no change allowed
			$staff_id = $_POST['staff_id'];   // shd be defaulted to staff_id of login session and no change allowed

			$query = "UPDATE rental SET return_date='$return_date', staff_id='$staff_id' WHERE rental_id=$rental_id";
			if (mysqli_query($db, $query)) {				
				$results = mysqli_query($db, "SELECT * FROM rental WHERE rental_id=$rental_id");
				$_SESSION['msg'] = "Rental Trx closed (Inventory returned)";
				// $edit_state = false;
				header('location: test_rental.php');  // redirect to index page after updating
			} else {
				echo 'query error: ' . mysqli_error($conn);
				// $_SESSION['msg'] = "Rental Trx not closed (ERROR)";
				// header('location: test_rental.php');  // redirect to index page 
			}
		}  // endif if (isset($_POST['update']))

		// delete record -- if delete button is clicked
		// for rental - can provide the function but no old rental records will be deleted successfully
		if (isset($_GET['del'])) {
			$rental_id = $_GET['del'];
			
			$query = "DELETE FROM rental WHERE rental_id='$rental_id'";	
			if (mysqli_query($db, $query)) {
			  	//success
				$_SESSION['msg'] = "Staff Record deleted";
				header('location: index.php');  // redirect to index page after deleting	
			} {
				// failure
				echo 'query error: ' . mysqli_error($db);			
			}	// endif for if (mysqli_query($db, $query))

		} // endif for if (isset($_GET['del']))


		// retrieve records
		// for rental - it means ENTER the rental_id and display the ONE & ONLY rental record concerned
		// or  - 				 ENTER the customer_id and display those rental records belonging to the customer 
		//						 and have NULL for return_date
		// can't get the above working - temporary solution ... display all rental records that are outstanding
		//														i.e. have return_date that is NULL
		//$results = mysqli_query($db, "SELECT * FROM rental WHERE customer_id=$customer_id && return_date=null"); 	
		if ($edit_state == false) {
			$results = mysqli_query($db, "SELECT * FROM rental WHERE return_date is NULL" ); 	
		} 
		//$results = mysqli_query($db, "SELECT * FROM rental WHERE return_date=null"); 

		// OR ....
		// $results = mysqli_query($db, "SELECT * FROM rental WHERE rental_id=$rental_id && return_date=null"); 				

	?>
>>>>>>> 79b11c2 (Add new folder)
