 <?php 
  // list and display films and actors 
  // work with add_film.php and details.php
  // connect to db  ===================================================================
  // include('C:/xampp/htdocs/tuts/config/db_connect.php');
  $conn = mysqli_connect('localhost','mike','test1234','sakila');

  // chk connection
  if (!$conn) {
  	echo 'Connection Error : ' . mysqli_connect_error();
  }


  // write query for all films
  $sql = "SELECT * from film ORDER BY title";

  // mk query & get result
  $result = mysqli_query($conn, $sql);

  // fetch the resulting rows as array
  $films = mysqli_fetch_all($result, MYSQLI_ASSOC);

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
	                	<a href="add_inventory.php" class="btn brand z-depth-0">Add New Inventories</a>
	            </h4>
	<h4 class="center grey-text">List of Films by order of title</h4>
	<div class="container">
		<div class="row">
			
			<?php foreach($films as $film): ?>

				<div class="col s6 md3 ">
					<div class="card z-depth-0">
						<div class="card-content center">
							<h6><?php echo 'Film title :   ' . htmlspecialchars($film['title']); ?></h6>
							<div><?php echo 'Release year : ' . htmlspecialchars($film['release_year']); ?></div>
							
							<div><?php echo 'Language : ' . htmlspecialchars($film['language_id']); ?></div>
							<div><?php echo htmlspecialchars($film['original_language_id']); ?></div>
							
							<div><?php echo 'Rental Duration : ' . htmlspecialchars($film['rental_duration']) . ' days'; ?></div>
							<div><?php echo 'Rental rate : $ ' . htmlspecialchars($film['rental_rate']); ?></div>
							<div><?php echo 'Length of film : ' . htmlspecialchars($film['length']) . ' minutes'; ?></div>
							<div><?php echo 'Category : ' . htmlspecialchars($film['category']); ?></div>
							<div><?php echo 'Rating : ' . htmlspecialchars($film['rating']); ?></div>
									
							<!--<div><?php echo htmlspecialchars($film['film_id']); ?></div>-->	
								
							<ul>
								<?php echo 'Special features : ' ?>
								<?php foreach(explode(',', $film['special_features']) as $spec_fea): ?>
									<li><?php echo '' . htmlspecialchars($spec_fea); ?></li>
								<?php endforeach; ?>
							</ul>
							<div><?php echo htmlspecialchars($film['description']); ?></div>
						</div><!--<div class="card-content center">-->
						<div><?php print_r($film['film_id']); ?></div>
						<div class="card-action right-align">
							<a class="brand-text" href="details.php?film_id=<?php echo $film['film_id'] ?>">more info</a>
						</div>						
					</div><!--<div class="card z-depth-0">-->
				</div><!-- <div class="col s6 md3 "> -->
			<?php endforeach; ?>
		</div><!-- <div class="row"> -->		
	</div><!-- <div class="container"> -->

	<?php include('templates/footer.php'); ?>

 </html>