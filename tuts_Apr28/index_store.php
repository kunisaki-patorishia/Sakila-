<?php 
include('config/db_connect.php');

  // write query for all stores
  $sql = 'SELECT * FROM store ORDER BY store_id';

  // mk query & get result
  $result = mysqli_query($conn, $sql);

  // fetch the rows as array
  $stores = mysqli_fetch_all($result, MYSQLI_ASSOC);

  // free result from memory
  mysqli_free_result($result);

  // close connection to db
  mysqli_close($conn);

?>

<!DOCTYPE html>
<html>
 	<?php include('templates/header.php'); ?>
 	<h5 class="grey-text center">List of Stores</h5>
 	<div class="container">
 		<div class="row">
 			<?php foreach($stores as $store): ?>
 				<div class="col s6 md3">
 					<div class="card z-depth-0">
 						<div class="card-content">
 							<h6><?php echo htmlspecialchars($store['store_id']); ?></h6>
 							<div><?php echo htmlspecialchars($store['manager_staff_id']); ?></div>
 							<div><?php echo htmlspecialchars($store['address']); ?></div>
  							<div><?php echo htmlspecialchars($store['address2']); ?></div>
  							<div><?php echo htmlspecialchars($store['district']); ?></div>
  							<div><?php echo htmlspecialchars($store['city_name']); ?></div>
  							<div><?php echo htmlspecialchars($store['postal_code']); ?></div>
  							<div><?php echo htmlspecialchars($store['phone']); ?></div>						
 						</div>
						<div class="card-action right-align">
							<a class="brand-text" href="details_store.php?store_id=<?php echo $store['store_id'] ?>">Edit Info</a>
						</div>	
 					</div> 					
 				</div>
 			<?php endforeach; ?>
 			
 		</div>
 		
 	</div>


	<?php include('templates/footer.php'); ?>
</html>