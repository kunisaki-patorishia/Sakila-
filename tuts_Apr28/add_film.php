<?php 

	//include('config/db_connect.php');
	// connect to db
  $conn = mysqli_connect('localhost','mike','test1234','sakila');

  // chk connection
  if (!$conn) {
  	echo 'Connection Error : ' . mysqli_connect_error();
  }


	$title = $description = $release_year = '' ;

	$language_id =  'English';
	$original_language_id = '';

	$rental_duration = '3';
	$rental_rate = '4.99';
	$length = '';	

	$replacement_cost = '19.99';

	$category = 'NEW';
	$rating = 'G';

	$special_features = '';


	$error = array('title'=>'', 'description'=>'', 'release_year'=>'', 'language_id'=>'', 'original_language_id'=>'', 'rental_duration'=>'', 'rental_rate'=>'', 'length'=>'', 'replacement_cost'=>'', 'category'=>'', 'rating'=>'','special_features'=>'');
//	if (isset($_GET['submit'])) {
//		echo $_GET['title'];
//		echo $_GET['description'];
//		echo $_GET['release_year'];
//	}

	if (isset($_POST ['submit'])) {

		// chk title
		if(empty($_POST['title'])){
			$error['title'] =  'Pls enter the title of the film <br />';
		} else {
			//echo htmlspecialchars($_POST['title']);
			$title = $_POST['title'];
			if (!preg_match('/^[a-zA-Z0-9!?&-+,.\s]+$/',$title)){
				$error['title'] = 'Film title must be letters and spaces only';
			}
		}

		// chk description
		if(empty($_POST['description'])){
			$error['description'] =  'Pls enter some description about the film <br />';
		} else {
			//echo htmlspecialchars($_POST['description']);
			$description = $_POST['description'];
			if (!preg_match('/^[a-zA-Z0-9!?&-+,."\'\(\)\s]+$/',$description)){
				$error['description'] = 'Film description must be letters and spaces only';
			}
		}

		// chk release year
		if(empty($_POST['release_year'])){
			$error['release_year'] =  'Pls enter the release_year of the film <br />';
		} else {
			$release_year = $_POST['release_year'];
			if (!preg_match('/^[0-9\s]+$/',$release_year)){
				$error['release_year'] = 'Release year should be in year format';
			}
		}

		// chk rental_duration - shd be >0 but less than 10??
		if(empty($_POST['rental_duration'])){
			$error['rental_duration'] =  'Compulsory field shd not be left empty<br />';
		} else {
			$rental_duration = $_POST['rental_duration'];
			if (!preg_match('/^[0-9\s]+$/',$rental_duration)){
				$error['rental_duration'] = 'Only numbers allowed';
			}
		}

		// chk rental_rate - minimum 2.99, maxi 12.99
		if(empty($_POST['rental_rate'])){
			$error['rental_rate'] =  'Compulsory field shd not be left empty<br />';
		} else {
			$rental_rate = $_POST['rental_rate'];
			if (!preg_match('/^[0-9.\s]+$/',$rental_rate)){
				$error['rental_rate'] = 'Only numbers allowed';
			} else {
				if ($rental_rate < 2.99) {
				// echo $deposit > 100 ? 'Deposit amount entered too high !' : 'Deposit amount entered successfully';
				//echo $rental_rate < 2.99 ? 'Rental rate is too low !' : '';
				//echo $rental_rate > 19.99 ? 'Rental rate is too high !' : '';
	 			 $error['rental_rate'] = 'Rental rate shd be between 2.99 to 20.99 !';
	 			// echo $error;
	 			} else {
	 				if ($rental_rate > 20.99) {
	 					$error['rental_rate'] = 'Rental rate shd be between 2.99 to 20.99 !';

	 				}

	 			}
			}
		}		
		// chk length - between 60 to 180 minutes
		if(empty($_POST['length'])){
			$error['length'] =  'Compulsory field shd not be left empty<br />';
		} else {
			$length = $_POST['length'];
			if (!preg_match('/^[0-9\s]+$/',$length)){
				$error['length'] = 'Only numbers allowed';
			} else {
				echo $length > 240 ? 'Film length is too long !' : '';	 		
			}
		}		

		// chk replacement_cost - 19.99 minimum to 49.99 maxi
		if(empty($_POST['replacement_cost'])){
			$error['replacement_cost'] =  'Compulsory field shd not be left empty<br />';
		} else {
			$replacement_cost = $_POST['replacement_cost'];
			if (!preg_match('/^[0-9.\s]+$/',$replacement_cost)){
				$error['replacement_cost'] = 'Only numbers allowed';
			} else {
				echo $replacement_cost > 49.99 ? 'Replacement cost is too high !' : '';	 			
			}
		}	
		// chk category - need ? - drop down list shdnt hv a lot of problem
		// chk rating - need ??
		// chk special_features ?? - chk box - shd hv no prob


		if (array_filter($error)) {
			//echo 'There are errors in the form';
		} else {

			$title = mysqli_real_escape_string($conn, $_POST['title']);
			$description = mysqli_real_escape_string($conn, $_POST['description']);
			$release_year = mysqli_real_escape_string($conn, $_POST['release_year']);
			// language
			$rental_duration = mysqli_real_escape_string($conn, $_POST['rental_duration']);
			$rental_rate = mysqli_real_escape_string($conn, $_POST['rental_rate']);
			$length = mysqli_real_escape_string($conn, $_POST['length']);
			$replacement_cost = mysqli_real_escape_string($conn, $_POST['replacement_cost']);
			$category = mysqli_real_escape_string($conn, $_POST['category']);
			$rating = mysqli_real_escape_string($conn, $_POST['rating']);
			$special_features = mysqli_real_escape_string($conn, $_POST['special_features']);
			

			// $special_features = mysqli_real_escape_string($conn, $_POST['special_features']);
			 

			// create sql code
			$sql = "INSERT INTO film (title, description, release_year, language_id, original_language_id,  rental_duration, rental_rate, length, replacement_cost, category, rating, special_features) VALUES('$title', '$description', '$release_year', '$language_id', '$original_language_id', '$rental_duration', '$rental_rate', '$length', '$replacement_cost', '$category', '$rating', '$special_features') " ;

			// save to db and chk
			if(mysqli_query($conn, $sql)){
				// success
				header('Location: index.php');
			} else {
				// error
				echo 'query error: ' . mysqli_error($conn);
			}
		
		}

	} // end of POST check

 ?>

 <!DOCTYPE html>
 <html>

	<?php include('templates/header.php'); ?>

	<!-- <section class="container grey-text"> -->
		<h4 class="center">Add New Film and New Inventories</h4>
		<!--<form class="white" action="add_film.php" method="POST">-->
		<form class="white" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">	

			<label>Film Title :</label>
			<input type="text" name="title" maxlength="60" size="60" required value="<?php echo htmlspecialchars($title); ?>">
			<div class="red-text"><?php echo $error['title']; ?>  </div>

			<label>Description :</label>
			<input type="text" name="description" size="180" required value="<?php echo htmlspecialchars($description); ?>">
			<div class="red-text"><?php echo $error['description']; ?>  </div>

			<label>Release year :</label>
			<input type="text" name="release_year" maxlength="4" size="4" required value="<?php echo htmlspecialchars($release_year); ?>">
			<div class="red-text"><?php echo $error['release_year']; ?>  </div>

			<label>Rental Duration (0-14) :</label>
			<input type="number" name="rental_duration" min="0" max="14" required size="6" length="6" value="<?php echo htmlspecialchars($rental_duration); ?>">
			<div class="red-text"><?php echo $error['rental_duration']; ?>  </div>

			<label>Rental rate (0.99-14.99) :</label>
			<input type="numeric" name="rental_rate" min="0.99" max="14.99" required size="6" length="6" value="<?php echo htmlspecialchars($rental_rate); ?>">
			<div class="red-text"><?php echo $error['rental_rate']; ?>  </div>

			<label>Length of Film (0-600): (in minutes)</label>
			<input type="numeric" name="length"  min="0" max="600" required size="7" length="7" value="<?php echo htmlspecialchars($length); ?>">
			<div class="red-text"><?php echo $error['length']; ?>  </div>			

			<label>Replacement cost (10.99-49.99):</label>
			<input type="numeric" name="replacement_cost"  min="10.99" max="49.99" required size="7" length="7" value="<?php echo htmlspecialchars($replacement_cost); ?>">
			<div class="red-text"><?php echo $error['replacement_cost']; ?>  </div>

			<label>Category :</label><br>
			<input type="radio" id="Action" name="category" value="Action">
			<label for="Action">Action</label><br>

			<input type="radio" id="Animation" name="category" value="Animation">
			<label for="Animation">Animation</label>
			<input type="radio" id="Children" name="category" value="Children">
			<label for="Children">Children</label><br>
<!-- 			<input type="radio" name="category" value="Classics">
			<label for="Classics">Classics</label>
			<input type="radio" name="category" value="Comedy">
			<label for="Comedy">Comedy</label>
			<input type="radio" name="category" value="Documentary">
			<label for="Documentary">Documentary</label><br>
			<input type="radio" name="category" value="Drama">
			<label for="Drama">Drama</label>
			<input type="radio" name="category" value="Family">
			<label for="Family">Family</label>
			<input type="radio" name="category" value="Foreign">
			<label for="Foreign">Foreign</label>
			<input type="radio" name="category" value="Games">
			<label for="Games">Games</label><br>
			<input type="radio" name="category" value="Horror">
			<label for="Horror">Horror</label>
			<input type="radio" name="category" value="Music">
			<label for="Music">Music</label>
			<input type="radio" name="category" value="New">
			<label for="New">New</label>
			<input type="radio" name="category" value="Sci-Fi">
			<label for="Sci-Fi">Sci-Fi</label><br>
			<input type="radio" name="category" value="Sports">
			<label for="Sports">Sports</label>
			<input type="radio" name="category" value="Travel">
			<label for="Travel">Travel</label> -->
			<!-- <div class="red-text"><?php echo $error['category']; ?>  </div> -->
			<div></div>

			<label>Rating :</label><br>
			<input type="radio" name="rating" value="G">
			<label for="G">G</label>
			<input type="radio" name="rating" value="PG">
			<label for="PG">PG</label>
			<input type="radio" name="rating" value="PG-13">
			<label for="PG-13">PG-13</label>
			<input type="radio" name="rating" value="R">
			<label for="R">R</label>
			<input type="radio" name="rating" value="NC-17">
			<label for="NC-17">NC-17</label>						
			<div></div>			

			<label>Special Features :</label><br>
			<input type="checkbox" name="special_features" value="Trailers">
			<label for="Trailers">Trailers</label>
			<input type="checkbox" name="special_features" value="Commentaries">
			<label for="Commentaries">Commentaries</label>
			<input type="checkbox" name="special_features" value="Deleted Scenes">
			<label for="Deleted Scenes">Deleted Scenes</label><br>
			<input type="checkbox" name="special_features" value="Behind the Scenes">
			<label for="Behind the Scenes">Behind the Scenes</label>			


			<div class="center">
				<input type="submit" name="submit" value="submit" class="btn brand z-depth-0">
			</div>			
		</form>
	<!-- </section> -->

	<?php include('templates/footer.php'); ?>

 </html>