<?php 
<<<<<<< HEAD
  $conn = mysqli_connect('localhost','mike','test1234','sakila');

=======
  $conn = mysqli_connect('localhost','mike','PCLC1712','entertainment');
  
>>>>>>> da12d4a3991d2a067910c64d05e709ce4b3465c6
  // chk connection
  if (!$conn) {
  	echo 'Connection Error : ' . mysqli_connect_error();
  }

  // write query for all actors
<<<<<<< HEAD
  $sql = 'SELECT * FROM customer ORDER BY customer_First_n';
=======
  $sql = 'SELECT * FROM customer ORDER BY first_name';
>>>>>>> da12d4a3991d2a067910c64d05e709ce4b3465c6

  // mk query & get result
  $result = mysqli_query($conn, $sql);

  // fetch the rows as array
  $customers = mysqli_fetch_all($result, MYSQLI_ASSOC);

  // free result from memory
  mysqli_free_result($result);

  // close connection to db
  mysqli_close($conn);
 ?>

 <!DOCTYPE html>
 <html>

 	<?php include('templates/header.php'); ?>
			 	<h4 class="center grey-text">
			 		<a href="add_customer.php" class="btn brand z-depth-0">Add New Customer</a>
			 	</h4>
 	<h5 class="grey-text center">List of Customers in ascending order of first name</h5>
	<div class="container">
		<div class="row">
			<?php foreach($customers as $customer): ?>
				<div class="col s6 md3">
					<div class="card z-depth-0">
						<div class="card-content">
														
							<div><?php echo 'Store ID : ' . htmlspecialchars($customer['store_id']); ?></div>
							<div><h5><?php echo 'Customer id : ' . htmlspecialchars($customer['customer_id']); ?></h5></div>
<<<<<<< HEAD
							<div><?php echo 'Name : ' . htmlspecialchars($customer['customer_First_n'] . ' ');  ?>
								 <?php echo htmlspecialchars($customer['customer_Last_n']);	?></div>
							<!-- <div><?php echo 'Email : ' . htmlspecialchars($customer['email']);	?></div> -->
							<div><?php echo 'Phone : ' . htmlspecialchars($customer['customer_phone']);	?></div>
							<!-- <div><?php echo 'Deposit : $ ' . htmlspecialchars($customer['deposit']);	?></div> -->
=======
							<div><?php echo 'Name : ' . htmlspecialchars($customer['first_name'] . ' ');  ?>
								 <?php echo htmlspecialchars($customer['last_name']);	?></div>
							<div><?php echo 'Email : ' . htmlspecialchars($customer['email']);	?></div> 
							<div><?php echo 'Phone : ' . htmlspecialchars($customer['phone']);	?></div>
							<div><?php echo 'Phone : ' . htmlspecialchars($customer['phone']);	?></div>
							<div><?php echo 'Deposit : $ ' . htmlspecialchars($customer['deposit']);	?></div>
>>>>>>> da12d4a3991d2a067910c64d05e709ce4b3465c6
							<!-- <div><?php echo 'Active(1), Inactive(0) :  ' . htmlspecialchars($customer['active']);	?></div> -->
							<!-- <div><?php echo 'Create date : ' . htmlspecialchars($customer['create_date']);	?></div>		 -->
						</div>
						<!-- <div><?php print_r($customer['customer_id']); ?></div> -->
						<div class="card-action right-align">
<<<<<<< HEAD
							<a class="brand-text" href="details_customer.php?customer_id=<?php echo $customer['customer_id'] ?>">More Info</a>	
=======
							<!--<a class="brand-text" href="details_customer.php?customer_id=<?php echo $customer['customer_id'] ?>">More Info</a>-->	
>>>>>>> da12d4a3991d2a067910c64d05e709ce4b3465c6
						</div>							
					</div>
				</div>

			<?php endforeach; ?>
		</div>
	</div>

	<?php include('templates/footer.php'); ?>

 </html>