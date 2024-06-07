<?php 
  $conn = mysqli_connect('localhost','mike','test1234','sakila');

  // chk connection
  if (!$conn) {
  	echo 'Connection Error : ' . mysqli_connect_error();
  }



  // write query for all actors
  // $sql = 'SELECT film_actor.film_id, film.title, film_actor.actor_id, actor.actor_first_n, actor.actor_last_n FROM film_actor, film INNER JOIN actor on film_actor.actor_d=actor.actor_id where film_actor.film_id=film.film_id ';

  // $sql3 = 'Select film_actor.film_id, film.title, film_actor.actor_id, actor.actor_first_n, actor.actor_last_n FROM film , actor, film_actor Where film.film_id=film_actor.film_id && film_actor.actor_id=actor.actor_id  ';

  $sql = 'SELECT film_actor.film_id, film.title, film_actor.actor_id, actor.actor_first_n, actor.actor_last_n FROM film , actor, film_actor Where film.film_id=film_actor.film_id && film_actor.actor_id=actor.actor_id';

  // mk query & get result
  $result = mysqli_query($conn, $sql);

  // fetch the rows as array
  $film_actors = mysqli_fetch_all($result, MYSQLI_ASSOC);
//print_r($film_actors);
  // free result from memory
  mysqli_free_result($result);

  // close connection to db
  mysqli_close($conn);
 ?>

 <!DOCTYPE html>
 <html>

 	<?php include('templates/header.php'); ?>
	                <li><a href="add_film.php" class="btn brand z-depth-0">Add New Film</a>
	                    <a href="add_actor.php" class="btn brand z-depth-0">Add New Actor</a>
	                	<a href="add_film_actor.php" class="btn brand z-depth-0">Link Film and Actors</a>
	                </li> 	
 	<h5 class="grey-text center">List of Films and Actors</h5>
	<div class="container">
		<div class="row">
			<?php foreach($film_actors as $film_actor): ?>
				<div class="col s6 md3">
					<div class="card z-depth-0">
						<div class="card-content">
							<div><?php echo htmlspecialchars($film_actor['film_id']) ?></div>
							<h6><?php echo htmlspecialchars($film_actor['title']); ?></h6>
							<div><?php echo htmlspecialchars($film_actor['actor_id']); ?></div>
							<h6></h6>
							<h6><?php echo htmlspecialchars($film_actor['actor_first_n']); ?></h6>
							<h6><?php echo htmlspecialchars($film_actor['actor_last_n']); ?></h6>	
						</div>						
<!-- 						<div class="card-action right-align">
							<a class="brand-text" href="details_actor.php?actor_id=<?php echo $film_actor['actor_id'] ?>">More Info</a>	
						</div>	 -->						
					</div>
				</div>

			<?php endforeach; ?>
		</div>
	</div>

	<?php include('templates/footer.php'); ?>

 </html>