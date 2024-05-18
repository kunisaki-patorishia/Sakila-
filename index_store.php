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
    <h4 class="center grey-text">
    <a href="add_store.php" class="btn brand z-depth-0">Add New Store</a>
    <a href="index_staff.php" class="btn brand z-depth-0">Manage Staff</a></li> 
  </h4>

 	<h5 class="grey-text center">List of Stores</h5>
 	<div class="container">
 		<div class="row">
 			<?php foreach($stores as $store): ?>
 				<div class="col s6 md3">
 					<div class="card z-depth-0">
            <div class="card-content">
              <h6>Store Id : <?php echo htmlspecialchars($store['store_id']); ?></h6>
              <div>Managing Staff Id : <?php echo htmlspecialchars($store['manager_staff_id']); ?></div>
              <div>Store Address : <?php echo htmlspecialchars($store['address']); ?></div>
                <!-- <div><?php echo htmlspecialchars($store['address2']); ?></div> -->
                <div>District : <?php echo htmlspecialchars($store['district']); ?></div>
                <div>City, State and/or Country : <?php echo htmlspecialchars($store['city_name']); ?></div>
                <div><?php echo htmlspecialchars($store['postal_code']); ?></div>
                <div><?php echo htmlspecialchars($store['phone']); ?></div>           
            </div>
            <div class="card-action right-align">
              <a class="brand-text" href="details_store.php?store_id=<?php echo $store['store_id'] ?>">More Info</a>
            </div>  
          </div>          
        </div>
      <?php endforeach; ?>
      
    </div>
    
  </div>


  <?php include('templates/footer.php'); ?>
</html>