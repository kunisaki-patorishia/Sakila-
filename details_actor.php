<?php 
  $conn = mysqli_connect('localhost','mike','test1234','sakila');

  // chk connection
  if (!$conn) {
  	echo 'Connection Error : ' . mysqli_connect_error();
  }

  if(isset($_POST['delete'])){
  	$actor_id_to_delete = mysqli_real_escape_string($conn, $_POST['actor_id_to_delete']);

  	$sql = "DELETE FROM actor WHERE actor_id = $actor_id_to_delete";

  	if(mysqli_query($conn, $sql)){
  		//success
  		header('Location: index_actor.php');
  	} {
  		// failure
  		echo 'query error: ' . mysqli_error($conn);
  	}
  }

  // if(isset($_POST['update'])){
       //success    
    // echo 'Still under construction ... ';
        //   $actor_id_to_update = mysqli_real_escape_string($conn, $_POST['actor_id_to_update']);

        //   $sql = "UPDATE actor SET actor_first_n = '$actor_first_n', actor_last_n = '$actor_last_n' WHERE actor_id = $actor_id_to_update";

        //   if(mysqli_query($conn, $sql)){

         //     header('Location: index_actor.php');
  // } {
       // failure
       // echo 'query error: ' . mysqli_error($conn);
  // }
   
  	// chk GET request id param
	if (isset($_GET['actor_id'])){
		//print_r($actor_id);
		$actor_id = mysqli_real_escape_string($conn, $_GET['actor_id']);
		// mk sql
		$sql = "SELECT * from actor WHERE actor_id = $actor_id";
		// get the query result
		$result = mysqli_query($conn, $sql);
		// fetch result in array format
		$actor = mysqli_fetch_assoc($result);

		mysqli_free_result($result);
		mysqli_close($conn);
	}
?>

<!DOCTYPE html>
<html>
   <?php include('templates/header.php'); ?>  
   <div class="container center">
   <?php if($actor): ?>
       <h4><?php echo htmlspecialchars($actor['actor_first_n']); ?></h4>
       <h4><?php echo htmlspecialchars($actor['actor_last_n']); ?></h4>

       <!-- UPDATE FORM --> <!-- DELETE FORM -->
       <FORM action="details_actor.php" method="POST">
<!--          <input type="hidden" name="actor_id_to_update" value="<?php echo $actor['actor_id'] ?>">
         <input type="submit" name="update" value="Update" class="btn brand z-depth-0"> -->
         <input type="hidden" name="actor_id_to_delete" value="<?php echo $actor['actor_id'] ?>">
         <input type="submit" name="delete" value="Delete" class="btn brand z-depth-0">
       </FORM>
   <?php else: ?>  <!-- if($actors):  -->
      <h5><?php echo 'query error: ' . mysqli_error($conn); ?></h5>    
   <?php endif ?>  <!-- if($actors):  -->    

   </div>

<?php include('templates/footer.php'); ?>
</html>
