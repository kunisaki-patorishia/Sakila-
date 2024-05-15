<?php 
	// connect to db
	include('C:/xampp/htdocs/tuts/config/db_connect.php');

	$title = $description = '' ;

	$release_year = date("Y");

	$language_id =  'English';
	$original_language_id = '';

	$rental_duration = '3';
	$rental_rate = '4.99';
	$length = '';	

	$replacement_cost = '19.99';

	$category = 'NEW';
	$rating = 'G';

	$special_features = NULL;


	$error = array('title'=>'', 'description'=>'', 'release_year'=>'', 'language_id'=>'', 'original_language_id'=>'', 'rental_duration'=>'', 'rental_rate'=>'', 'length'=>'', 'replacement_cost'=>'', 'category'=>'', 'rating'=>'','special_features'=>'');

	if (isset($_POST ['submit'])) {

		// chk title
		if(empty($_POST['title'])){
			$error['title'] =  'Pls enter the title of the film <br />';
		} else {
			//echo htmlspecialchars($_POST['title']);
			$title = $_POST['title'];
			if (!preg_match('/^[a-zA-Z0-9!?&\-+,.\:\"\'\(\)\s]+$/',$title)){
				$error['title'] = 'Film title must be letters and spaces only';
			}
		}

		// chk description
		if(empty($_POST['description'])){
			$error['description'] =  'Pls enter some description about the film <br />';
		} else {
			//echo htmlspecialchars($_POST['description']);
			$description = $_POST['description'];
			if (!preg_match('/^[a-zA-Z0-9!?&\-+,.\:\"\'\(\)\s]+$/',$description)){
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

		//language - allow null
		//original_language




		// chk rental_duration - shd be >0 but less than 10??
		if(empty($_POST['rental_duration'])){
			$error['rental_duration'] =  'Compulsory field shd not be left empty<br />';
		} else {
			$rental_duration = $_POST['rental_duration'];
			if (!preg_match('/^[0-9\s]+$/',$rental_duration)){
				$error['rental_duration'] = 'Only numbers allowed';
			}
		}

		// chk rental_rate - minimum 2.99, maxi 20.99
		if(empty($_POST['rental_rate'])){
			$error['rental_rate'] =  'Compulsory field shd not be left empty<br />';
		} else {
			$rental_rate = $_POST['rental_rate'];
			if (!preg_match('/^[0-9.\s]+$/',$rental_rate)){
				$error['rental_rate'] = 'Only numbers allowed';
			} else {
				// if ($rental_rate < 2.99) {
				// echo $deposit > 100 ? 'Deposit amount entered too high !' : 'Deposit amount entered successfully';
				//echo $rental_rate < 2.99 ? 'Rental rate is too low !' : '';
				//echo $rental_rate > 19.99 ? 'Rental rate is too high !' : '';
	 			 // $error['rental_rate'] = 'Rental rate shd be between 2.99 to 20.99 !';
	 			// echo $error;
	 			// } else {
	 			// 	if ($rental_rate > 20.99) {
	 			// 		$error['rental_rate'] = 'Rental rate shd be between 2.99 to 20.99 !';

	 			// 	}

	 			// }
			}
		}		
		// chk length - between 60 to 240 minutes
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
			$language_id = mysqli_real_escape_string($conn, $_POST['language_id']);
			$original_language_id = mysqli_real_escape_string($conn, $_POST['original_language_id']);



			$rental_duration = mysqli_real_escape_string($conn, $_POST['rental_duration']);
			$rental_rate = mysqli_real_escape_string($conn, $_POST['rental_rate']);
			$length = mysqli_real_escape_string($conn, $_POST['length']);
			$replacement_cost = mysqli_real_escape_string($conn, $_POST['replacement_cost']);
			$category = mysqli_real_escape_string($conn, $_POST['category']);
			$rating = mysqli_real_escape_string($conn, $_POST['rating']);
			$special_features = mysqli_real_escape_string($conn, $_POST['special_features']);

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
		
		} // enfif for if (array_filter($error)) 

	} // end of POST check

 ?>

 <!DOCTYPE html>
 <html>

	<?php include('templates/header.php'); ?>

	<section class="container grey-text">
		<h4 class="center">Add New Film and New Inventories</h4>
		<!--<form class="white" action="add_film.php" method="POST">-->
		<form class="white" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">	

			<label>Film Title :</label>
			<input type="text" name="title" required value="<?php echo htmlspecialchars($title); ?>">
			<div class="red-text"><?php echo $error['title']; ?>  </div>

			<label>Description :</label>
			<input type="text" name="description" required value="<?php echo htmlspecialchars($description); ?>">
			<div class="red-text"><?php echo $error['description']; ?>  </div>

			<label>Release year (between 1995 to 2025) :</label>
			<input type="number" name="release_year" min="1995" max="2025" required value="<?php echo htmlspecialchars($release_year); ?>">
			<div class="red-text"><?php echo $error['release_year']; ?>  </div>

			<label>Language:</label>
			<p>

    			<label>
      				<input class="with-gap" name="language_id" type="radio" value="English" />
      				<span>English</span>
    			</label>

    			<label>
        			<input class="with-gap" name="language_id" type="radio" value="Italian" />
      				<span>Italian</span> 	
    			</label>

    			<label>
        			<input class="with-gap" name="language_id" type="radio" value="Japanese" />
      				<span>Japanese</span> 	
    			</label>
				</p>
				<p>	
    			<label>
        			<input class="with-gap" name="language_id" type="radio" value="Mandarin" />
      				<span>Mandarin</span> 	
    			</label>

    			<label>
        			<input class="with-gap" name="language_id" type="radio" value="French" />
      				<span>French</span> 	
    			</label>

    			<label>
        			<input class="with-gap" name="language_id" type="radio" value="German" />
      				<span>German</span> 	
    			</label>    			
  			</p>

			<label>Original Language:</label>
			<p>

    			<label>
      				<input class="with-gap" name="original_language_id" type="radio" value="English" />
      				<span>English</span>
    			</label>

    			<label>
        			<input class="with-gap" name="original_language_id" type="radio" value="Italian" />
      				<span>Italian</span> 	
    			</label>

    			<label>
        			<input class="with-gap" name="original_language_id" type="radio" value="Japanese" />
      				<span>Japanese</span> 	
    			</label>
				</p>
				<p>	
    			<label>
        			<input class="with-gap" name="original_language_id" type="radio" value="Mandarin" />
      				<span>Mandarin</span> 	
    			</label>

    			<label>
        			<input class="with-gap" name="original_language_id" type="radio" value="French" />
      				<span>French</span> 	
    			</label>

    			<label>
        			<input class="with-gap" name="original_language_id" type="radio" value="German" />
      				<span>German</span> 	
    			</label>    			
  			</p>


			<label>Rental Duration (3 - 7 days ) :</label>
			<input type="text" name="rental_duration" min=3 max=7 required value="<?php echo htmlspecialchars($rental_duration); ?>">
			<div class="red-text"><?php echo $error['rental_duration']; ?>  </div>

			<label>Rental rate ($0.99 -$4.99) :</label>
			<input type="number" name="rental_rate" min=0.99 max=4.99 required value="<?php echo htmlspecialchars($rental_rate); ?>">
			<div class="red-text"><?php echo $error['rental_rate']; ?>  </div>

			<label>Length of Film 30-200 min :</label>
			<input type="text" name="length" min=30 max=200 required value="<?php echo htmlspecialchars($length); ?>">
			<div class="red-text"><?php echo $error['length']; ?>  </div>			

			<label>Replacement cost $9.99 to $29.99 :</label>
			<input type="text" name="replacement_cost" min = 9.99 max=29.99 required value="<?php echo htmlspecialchars($replacement_cost); ?>">
			<div class="red-text"><?php echo $error['replacement_cost']; ?>  </div>

			<label>Category (default=new) :</label><br>			
			<p>
    			<label>
      				<input class="with-gap" name="category" type="radio" value="Action" />
      				<span>Action</span>
    			</label>

    			<label>
        			<input class="with-gap" name="category" type="radio" value="Animation" />
      				<span>Animation</span> 	
    			</label>

    			<label>
        			<input class="with-gap" name="category" type="radio" value="Children" />
      				<span>Children</span> 	
    			</label>

    			<label>
        			<input class="with-gap" name="category" type="radio" value="Classics" />
      				<span>Classics</span> 	
    			</label>
  			</p>			
			<p>
				<label>
        			<input class="with-gap" name="category" type="radio" value="Comedy" />
      				<span>Comedy</span> 	
    			</label>

    			<label>
        			<input class="with-gap" name="category" type="radio" value="Documentary" />
      				<span>Documentary</span> 	
    			</label>

    			<label>
        			<input class="with-gap" name="category" type="radio" value="Drama" />
      				<span>Drama</span> 	
    			</label>

    			<label>
        			<input class="with-gap" name="category" type="radio" value="Family" />
      				<span>Family</span> 	
    			</label>
 			</p>
			<p>
    			<label>
      				<input class="with-gap" name="category" type="radio" value="Foreign" />
      				<span>Foreign</span>
    			</label>

    			<label>
        			<input class="with-gap" name="category" type="radio" value="Games" />
      				<span>Games</span> 	
    			</label>

    			<label>
        			<input class="with-gap" name="category" type="radio" value="Horror" />
      				<span>Horror</span> 	
    			</label>

    			<label>
        			<input class="with-gap" name="category" type="radio" value="Music" />
      				<span>Music</span> 	
    			</label>
  			</p> 
			<p>
    			<label>
      				<input class="with-gap" name="category" type="radio" value="New" />
      				<span>New</span>
    			</label>

    			<label>
        			<input class="with-gap" name="category" type="radio" value="Sci-Fi" />
      				<span>Sci-Fi</span> 	
    			</label>

    			<label>
        			<input class="with-gap" name="category" type="radio" value="Sports" />
      				<span>Sports</span> 	
    			</label>

    			<label>
        			<input class="with-gap" name="category" type="radio" value="Travel" />
      				<span>Travel</span> 	
    			</label>
  			</p>
			<div class="red-text"><?php echo $error['category']; ?>  </div>

			<label>Rating (default=G) :</label>
			<p>
    			<label>
      				<input class="with-gap" name="rating" type="radio" value="G" />
      				<span>G</span>
    			</label>
    			<label>
        			<input class="with-gap" name="rating" type="radio" value="PG" />
      				<span>PG</span> 	
    			</label>
    			<label>
        			<input class="with-gap" name="rating" type="radio" value="PG-13"  />
      				<span>PG-13</span> 	
    			</label>
    			<label>
        			<input class="with-gap" name="rating" type="radio" value="R"  />
      				<span>R</span> 	
    			</label>
    			<label>
        			<input class="with-gap" name="rating" type="radio" value="NC-17"  />
      				<span>NC-17</span> 	
    			</label>
  			</p>

			<label>Special Features :</label><br>

    		<p>
      			<label>
        			<input name="special_features" type="checkbox" value="Trailers" />
        			<span>Trailers</span>
      			</label>
      		</p>
      		<p>	
      			<label>
        			<input name="special_features" type="checkbox" value="Commentaries" />
        			<span>Commentaries</span>
      			</label>
      		</p>
      		<p>		
      			<label>
        			<input name="special_features" type="checkbox" value="Deleted Scenes" />
        			<span>Deleted Scenes</span>
      			</label>
      		</p>
      		<p>	
      			<label>
        			<input name="special_features" type="checkbox" value="Behind the Scenes" />
        			<span>Behind the Scenes</span>
      			</label>
    		</p>
			
			<div class="center">
				<input type="submit" name="submit" value="submit" class="btn brand z-depth-0">
			</div>			
		</form>
	</section>

	<?php include('templates/footer.php'); ?>

 </html>