<?php 
include('config/db_connect.php');
  if(isset($_POST['delete'])){
  	$store_id_to_delete = mysqli_real_escape_string($conn, $_POST['store_id_to_delete']);

  	$sql = "DELETE FROM store WHERE store_id = $store_id_to_delete";

  	if(mysqli_query($conn, $sql)){
  		//success
  		header('Location: index_store.php');
  	} {
  		// failure - echo in below HTML section
  		// echo 'query error: ' . mysqli_error($conn);
  	}
  }

	// chk GET request id param
	if (isset($_GET['store_id'])){
		//print_r($store_id);
		$store_id = mysqli_real_escape_string($conn, $_GET['store_id']);
		// mk sql
		//$sql = "SELECT store_id, manager_staff_id, staff_first_n, staff_last_n, address, address2, district, city_name, postal_code, phonefrom store, staff WHERE store_id = $store_id && staff.staff_id=manager_staff_id";
		$sql = "SELECT store.store_id, manager_staff_id, staff_first_n, staff_last_n, store.address, store.address2, store.district, store.city_name, store.postal_code, store.phone from store, staff WHERE staff.staff_id=store.manager_staff_id";
		// SELECT store.store_id, manager_staff_id, staff_first_n, staff_last_n, store.address, store.address2, store.district, store.city_name, store.postal_code, store.phone from store, staff WHERE staff.staff_id=store.manager_staff_id

		// get the query result
		$result = mysqli_query($conn, $sql);
		// fetch result in array format
		$store = mysqli_fetch_assoc($result);

		mysqli_free_result($result);
		mysqli_close($conn);
	}  



?>
<!DOCTYPE html>
<html>
	<?php include('templates/header.php'); ?>
	<div class="container center">
    <?php if($store): ?>
		<h6>Store Id : <?php echo htmlspecialchars($store['store_id']); ?></h6>
		<div>Managing Staff Id : 
            
              <?php echo htmlspecialchars($store['manager_staff_id']); ?>
            <h5><?php echo '( ' . htmlspecialchars($store['staff_first_n'] . ' '); ?>
              <?php echo htmlspecialchars($store['staff_last_n'] . ')'); ?></h5>
    </div>     
		<div>Address : </div>
    <div><h5><?php echo htmlspecialchars($store['address']); ?></h5></div>		
    <div><?php echo htmlspecialchars($store['address2']); ?></div>

		<div>District : </div>
    <div><h5><?php echo htmlspecialchars($store['district']); ?></h5></div>
		
    <div>City, State and/or Country : </div>
    <div><h5><?php echo htmlspecialchars($store['city_name']); ?></h5></div>

		<div>Postal Code : <?php echo htmlspecialchars($store['postal_code']); ?></div>
		<div>Store Phone : <?php echo htmlspecialchars($store['phone']); ?></div>						

        <!-- UPDATE FORM --> <!-- DELETE FORM -->
        <FORM action="details_store.php" method="POST">
            <!--<input type="hidden" name="store_id_to_update" value="<?php echo $store['store_id'] ?>">
            <input type="submit" name="update" value="Update" class="btn brand z-depth-0"> -->
            <input type="hidden" name="store_id_to_delete" value="<?php echo $store['store_id'] ?>">
            <input type="submit" name="delete" value="Delete" class="btn brand z-depth-0">
        </FORM>
    <?php else: ?>  <!-- if($stores):  -->
        <h5><?php echo 'query error: ' . mysqli_error($conn); ?></h5>    
    <?php endif ?>  <!-- if($stores):  -->    

	</div>

<?php include('templates/footer.php'); ?>
</html>