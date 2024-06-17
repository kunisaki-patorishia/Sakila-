<?php 
  $conn = mysqli_connect('localhost','mike','PCLC1712','entertainment');
  
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
       <div><?php echo 'Store id : ' . htmlspecialchars($customer['store_id']); ?></div>
       <div><?php echo 'Customer id : ' . htmlspecialchars($customer['customer_id']); ?></div>
       <div>First Name : <?php echo htmlspecialchars($customer['first_name']); ?></div>
       <div>Last Name :  <?php echo htmlspecialchars($customer['last_name']); ?></div>
              <div><?php echo 'Email : ' . htmlspecialchars($customer['email']);  ?></div>

              <div><?php echo 'Phone : ' . htmlspecialchars($customer['phone']); ?></div>
              <div><?php echo 'Deposit : $ ' . htmlspecialchars($customer['deposit']);  ?></div>
              <!--<div><?php echo 'Phone : ' . htmlspecialchars($customer['phone']); ?></div>-->
              <!--<div><?php echo 'Deposit : $ ' . htmlspecialchars($customer['deposit']);  ?></div>-->

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