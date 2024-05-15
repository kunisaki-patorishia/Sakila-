<?php 
  // ======================================================
  $conn = mysqli_connect('localhost','mike','PCLC1712','entertainment');

  // chk connection
  if (!$conn) {
  	echo 'Connection Error : ' . mysqli_connect_error();
  }
  // ======================================================
//  this is to link the new film to its actor(s)
  
  $actor_id = $film_id = 0;
  $error = array('actor_id'=>'','film_id'=>'');

  if (isset($_POST ['submit'])){
  	// chk any error
		if(!empty($_POST['actor_id'])){		
			$actor_id = $_POST['actor_id'];
			if (!preg_match('/^[0-9\s]+$/',$actor_id)){
				$error['actor_id'] = 'Only numeric';
			}
		}
  	// chk film_id
  		if (!empty($_POST['film_id'])){
  			$film_id = $_POST['film_id'];
			if (!preg_match('/^[0-9\s]+$/',$film_id)){
				$error['film_id'] = 'Only numeric';
			}  			
  		}
		if (array_filter($error)){
			// there r errors in the form
		} else {
			$actor_id = mysqli_real_escape_string($conn, $_POST['actor_id']);
			$film_id = mysqli_real_escape_string($conn, $_POST['film_id']);

			// create sql code
			$sql = "INSERT INTO film_actor (actor_id, film_id) VALUES('$actor_id', '$film_id')";

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
 	<section class="container grey-text">
 		<h4 class="center">Link New Film to its actors</h4>
 		<form class="white" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
 			<label>Enter the New Film ID :</label>
 			<input type="number" name="film_id" min=1 max=5000 required value="<?php echo htmlspecialchars($film_id); ?>">
 			<div class="red-text"><?php echo $error['film_id']; ?></div>

 			<!-- Should do a while loop here -->

 			<label>Enter the Actor ID :</label>
 			<input type="number" name="actor_id" min=1 max=20000 required value="<?php echo htmlspecialchars($actor_id); ?>">
 			<div class="red-text"><?php echo $error['actor_id']; ?></div>

			<div class="center">
				<input type="submit" name="submit" value="submit" class="btn brand z-depth-0">
			</div>			
 		</form>
 	</section>

 	<?php include('templates/footer.php'); ?>

 </html>