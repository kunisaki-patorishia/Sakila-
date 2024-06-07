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


  if(isset($_POST['delete'])){
  	$customer_id_to_delete = mysqli_real_escape_string($conn, $_POST['customer_id_to_delete']);

  	$sql = "DELETE FROM customer WHERE customer_id = $customer_id_to_delete";

  	if(mysqli_query($conn, $sql)){
  		//success
  		header('Location: index_customer.php');
  	} {
  		// failure
  		// echo 'query error: ' . mysqli_error($conn);
  	}
  }

  	// chk GET request id param
	if (isset($_GET['customer_id'])){
		// print_r($customer_id);
		$customer_id = mysqli_real_escape_string($conn, $_GET['customer_id']);
		// mk sql
		$sql = "SELECT * from customer WHERE customer_id = $customer_id";

		// get the query result
		$result = mysqli_query($conn, $sql);
		// fethc result in array format
		$customer = mysqli_fetch_assoc($result);

		mysqli_free_result($result);
		mysqli_close($conn);

		// print_r($customer);
	}
?>
<!DOCTYPE html>
<html>
   <?php include('templates/header.php'); ?>  
   <div class="container center">
   <?php if($customer): ?>
       <h4><?php echo 'Store id : ' . htmlspecialchars($customer['store_id']); ?></h4>
       <h4><?php echo 'Customer id : ' . htmlspecialchars($customer['customer_id']); ?></h4>
<<<<<<< HEAD
       <h4>First Name : <?php echo htmlspecialchars($customer['customer_First_n']); ?></h4>
       <h4>Last Name :  <?php echo htmlspecialchars($customer['customer_Last_n']); ?></h4>
              <div><?php echo 'Email : ' . htmlspecialchars($customer['email']);  ?></div>
              <div><?php echo 'Phone : ' . htmlspecialchars($customer['customer_phone']); ?></div>
              <div><?php echo 'Deposit : $ ' . htmlspecialchars($customer['deposit']);  ?></div>
=======
       <h4>First Name : <?php echo htmlspecialchars($customer['first_name']); ?></h4>
       <h4>Last Name :  <?php echo htmlspecialchars($customer['last_name']); ?></h4>
              <div><?php echo 'Email : ' . htmlspecialchars($customer['email']);  ?></div>
<<<<<<< HEAD
              <div><?php echo 'Phone : ' . htmlspecialchars($customer['customer_phone']); ?></div>
              <div><?php echo 'Deposit : $ ' . htmlspecialchars($customer['deposit']);  ?></div>
=======
              <!--<div><?php echo 'Phone : ' . htmlspecialchars($customer['customer_phone']); ?></div>-->
              <!--<div><?php echo 'Deposit : $ ' . htmlspecialchars($customer['deposit']);  ?></div>-->
>>>>>>> 79b11c2 (Add new folder)
>>>>>>> da12d4a3991d2a067910c64d05e709ce4b3465c6
              <div><?php echo 'Active(1), Inactive(0) :  ' . htmlspecialchars($customer['active']); ?></div>
              <div><?php echo 'Create date : ' . htmlspecialchars($customer['create_date']);  ?></div>
       <!-- UPDATE FORM --> <!-- DELETE FORM -->
       <FORM action="details_customer.php" method="POST">
<!--          <input type="hidden" name="customer_id_to_update" value="<?php echo $customer['customer_id'] ?>">
         <input type="submit" name="update" value="Update" class="btn brand z-depth-0"> -->
         <input type="hidden" name="customer_id_to_delete" value="<?php echo $customer['customer_id'] ?>">
         <input type="submit" name="delete" value="Delete" class="btn brand z-depth-0">
       </FORM>
   <?php else: ?>  <!-- if($customers):  -->
      <h5><?php echo 'query error: ' . mysqli_error($conn); ?></h5>    
   <?php endif ?>  <!-- if($customers):  -->    

   </div>

<?php include('templates/footer.php'); ?>
</html>