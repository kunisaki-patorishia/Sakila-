<?php 
  // ======================================================
<<<<<<< HEAD
  $conn = mysqli_connect('localhost','mike','test1234','sakila');
=======
  $conn = mysqli_connect('localhost','mike','PCLC1712','entertainment');
>>>>>>> da12d4a3991d2a067910c64d05e709ce4b3465c6

  // chk connection
  if (!$conn) {
  	echo 'Connection Error : ' . mysqli_connect_error();
  }
  // ======================================================

  	$customer_First_n = $customer_Last_n = $email = $customer_phone = '';
  	$customer_id = $store_id = 0;
	$deposit = 50.00;
	$active = 1;
	$create_date = date("Y-m-d H:i:s");

  $error = array('customer_First_n'=>'','customer_Last_n'=>'','email' => '', 'customer_phone' => '', 'customer_id' => '', 'store_id' => '', 'deposit' => '', 'active' => '', 'create_date' => '');

  if (isset($_POST ['submit'])){
  	// chk store_id
  		if (!empty($_POST['store_id'])){
  			$store_id = $_POST['store_id'];
			if (!preg_match('/^[1-2\s]+$/',$store_id)){
				$error['store_id'] = 'Only Store 1 or 2';
			}  			
  		}

  	// chk name
		if(empty($_POST['customer_First_n'])){
			$error['customer_First_n'] =  'Pls enter customer\'s first name <br />';
		} else {
			$customer_First_n = $_POST['customer_First_n'];
			if (!preg_match('/^[a-zA-Z-,.\s]+$/',$customer_First_n)){
				$error['customer_First_n'] = 'Only alphabets allowed';
			}
		}

		if(empty($_POST['customer_Last_n'])){
			$error['customer_Last_n'] =  'Pls enter customer\'s last name <br />';
		} else {
			$customer_Last_n = $_POST['customer_Last_n'];
			if (!preg_match('/^[a-zA-Z-,.\s]+$/',$customer_Last_n)){
				$error['customer_Last_n'] = 'Only alphabets allowed';
			}
		}

		// check email
		if(empty($_POST['email'])){
			$error['email'] = 'Pls enter customer\'s email <br />';
		} else{
			$email = $_POST['email'];
			if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
				$error['email'] = 'Email must be a valid email address';
			}
		}

		//check phone number
		if(empty($_POST['customer_phone'])){
			$error['customer_phone'] =  'Pls enter the customer\'s phone number <br />';
		} else {
			$customer_phone = $_POST['customer_phone'];
			if (!preg_match('/^[0-9\s]+$/',$customer_phone)){
				$error['customer_phone'] = 'Only accept numeric input';
			}
		}

		if(!empty($_POST['deposit'])){
			$deposit = $_POST['deposit'];
			if (!preg_match('/^[0-9.\s]+$/', $deposit)){
				$error['deposit'] = 'Only numbers allowed';
			}
		}

		if(array_filter($error)) {
			//echo 'There are errors in the form';
		} else {
			$store_id = mysqli_real_escape_string($conn, $_POST['store_id']);
			$customer_First_n = mysqli_real_escape_string($conn, $_POST['customer_First_n']);
			$customer_last_n = mysqli_real_escape_string($conn, $_POST['customer_last_n']);
			$email = mysqli_real_escape_string($conn, $_POST['email']);
			$customer_phone = mysqli_real_escape_string($conn, $_POST['customer_phone']);
			$deposit = mysqli_real_escape_string($conn, $_POST['deposit']);
			$active = mysqli_real_escape_string($conn, $_POST['active']);

			// create sql code
			$sql = "INSERT INTO customer (store_id, customer_First_n, customer_Last_n, email, customer_phone, deposit, active) VALUES('$store_id', '$customer_First_n', '$customer_Last_n', '$email', '$customer_phone', '$deposit', '$active') ";

			// save to db and chk
			if(mysqli_query($conn, $sql)){
				// success
				header('Location: index_customer.php');
			} else {
				// error
				echo 'query error: ' . mysqli_error($conn);
			}
		}  // endifif(array_filter($error))

		// if (array_filter($error)){
		// 	// there r errors in the form
		// } else {
		// 	$customer_First_n = mysqli_real_escape_string($conn, $_POST['customer_First_n']);
		// 	$customer_Last_n = mysqli_real_escape_string($conn, $_POST['customer_Last_n']);
		// 	$email = mysqli_real_escape_string($conn, $_POST['email']);
		// 	$customer_phone = mysqli_real_escape_string($conn, $_POST['customer_phone']);
		// }

  } // end of POST check

 ?>

 <!DOCTYPE html>
 <html>

 	<?php include('templates/header.php'); ?>
 	<section class="container grey-text">
 		<h4 class="center">Add New Customer</h4>
 		<form class="white" action="add_customer.php" method="POST">

			<label>Store Id : </label>
			<input type="number" name="store_id" min="1" max="2" size="2" required value="<?php echo $store_id; ?>">
 			<div class="red-text"><?php echo $error['store_id']; ?></div>

 			<label>Customer First Name :</label>
 			<input type="text" name="customer_First_n" maxlength="45" size="25" required value="<?php echo htmlspecialchars($customer_First_n); ?>">
 			<div class="red-text"><?php echo $error['customer_First_n']; ?></div> 			

 			<label>Customer Last Name :</label>
 			<input type="text" name="customer_Last_n" maxlength="45" size="25" required value="<?php echo htmlspecialchars($customer_Last_n); ?>">
 			<div class="red-text"><?php echo $error['customer_Last_n']; ?></div>

 			<label>Customer Email</label>
			<input type="email" name="email" maxlength="50" required value="<?php echo htmlspecialchars($email) ?>">
			<div class="red-text"><?php echo $error['email']; ?></div>

			<label>Customer Phone  :</label>
			<input type="text" name="customer_phone" maxlength="20" size="10" required value="<?php echo htmlspecialchars($customer_phone) ?>">
			<div class="red-text"><?php echo $error['customer_phone']; ?></div>

			<label>Deposit ($50.00)</label>
			<input type="number" name="deposit" min=50 max=100 required value="<?php echo htmlspecialchars($deposit) ?>">
			<div class="red-text"><?php echo $error['deposit']; ?></div>

			<label>Active (Y/N) :</label>
			<p>
				<label>
					<input class="with-gap" name="active" type="radio" value="1"  />
      				<span>Yes</span>
				</label>
				<label>
					<input class="with-gap" name="active" type="radio" value="0"  />
      				<span>No</span>
				</label>
			</p>


			<div class="center">
				<input type="submit" name="submit" value="submit" class="btn brand z-depth-0">
			</div>			
 		</form>
 	</section>

 	<?php include('templates/footer.php'); ?>

 </html>