<?php 
  $conn = mysqli_connect('localhost','mike','test1234','sakila');

  // chk connection
  if (!$conn) {
  	echo 'Connection Error : ' . mysqli_connect_error();
  }

  // write query for all actors
  $sql = 'SELECT * FROM actor ORDER BY actor_first_n';

  // mk query & get result
  $result = mysqli_query($conn, $sql);

  // fetch the rows as array
  $actors = mysqli_fetch_all($result, MYSQLI_ASSOC);

  // free result from memory
  mysqli_free_result($result);

  // close connection to db
  mysqli_close($conn);
 ?>

 <!DOCTYPE html>
 <html>

 	<?php include('templates/header.php'); ?>
 	<h4 class="center grey-text">List of Actors in ascending order of first name</h4>
	<div class="container">
		<div class="row">
			<?php foreach($actors as $actor): ?>
				<div class="col s12 md6">
					<div class="card z-depth-0">
						<div class="card-content">
							<h6>
							<?php 
							echo htmlspecialchars($actor['actor_first_n']); 
							echo htmlspecialchars($actor['actor_last_n']);
							?>
							</h6>
							<div><?php echo htmlspecialchars($actor['actor_id']) ?></div>
							<div class="card-action right-align">
								<a class="brand-text" href="details_actor.php?actor_id=<?php echo $actor['actor_id'] ?>">Edit Info</a>	
							</div>							

						</div>
						
					</div>
				</div>

			<?php endforeach; ?>


 </html>