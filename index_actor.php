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
	                <h4 class="center grey-text">
	                <a href="add_film.php" class="btn brand z-depth-0">Add New Film</a>
	                    <a href="add_actor.php" class="btn brand z-depth-0">Add New Actor</a>
	                	<a href="add_film_actor.php" class="btn brand z-depth-0">Link Film and Actors</a>
	                </h4> 	
 	<h5 class="grey-text center">List of Actors in ascending order of first name</h5>
	<div class="container">
		<div class="row">
			<?php foreach($actors as $actor): ?>
				<div class="col s3 md1">
					<div class="card z-depth-0">
						<div class="card-content">
							<h6><?php echo htmlspecialchars($actor['actor_first_n']); ?></h6>
							<h6><?php echo htmlspecialchars($actor['actor_last_n']); ?></h6>
							
							<div><?php echo htmlspecialchars($actor['actor_id']) ?></div>
						</div>						
						<div class="card-action right-align">
							<a class="brand-text" href="details_actor.php?actor_id=<?php echo $actor['actor_id'] ?>">More Info</a>	
						</div>							
					</div>
				</div>

			<?php endforeach; ?>
		</div>
	</div>

	<?php include('templates/footer.php'); ?>

 </html>