 <?php 

  //include('config/db_connect.php');
	// connect to db
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

  //print_r($films);
  //print_r(explode(',', $films[0]['special_features']));
  //explode(',', $films[0]['special_features']);

 ?>

 <!DOCTYPE html>
 <html>

	<?php include('templates/header.php'); ?>
	<h4 class="center grey-text">List of Films by order of title</h4>
	<div class="container">
		<div class="row">
			
			<?php foreach($films as $film): ?>

				<div class="col s6 md3 ">
					<div class="card z-depth-0">
						<div class="card-content center">
							<h6><?php echo htmlspecialchars($film['title']); ?></h6>
							<div><?php echo htmlspecialchars($film['release_year']); ?></div>
							
							<!--<div><?php echo htmlspecialchars($film['language_id']); ?></div>-->
							
							<div><?php echo htmlspecialchars($film['rental_duration']); ?></div>
							<div><?php echo htmlspecialchars($film['rental_rate']); ?></div>
							<div><?php echo htmlspecialchars($film['length']); ?></div>
							<div><?php echo htmlspecialchars($film['category']); ?></div>
							<div><?php echo htmlspecialchars($film['rating']); ?></div>
									
							<!--<div><?php echo htmlspecialchars($film['film_id']); ?></div>-->		
							<ul>
								<?php foreach(explode(',', $film['special_features']) as $spec_fea): ?>
									<li><?php echo htmlspecialchars($spec_fea); ?></li>
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