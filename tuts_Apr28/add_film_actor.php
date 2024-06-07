<?php 

  $conn = mysqli_connect('localhost','mike','test1234','sakila');

  // chk connection
  if (!$conn) {
  	echo 'Connection Error : ' . mysqli_connect_error();
  }

//  this shd be called from add_film.php ?? But how ??
  //    lkjfsj
  /// udr construction ....

  
  $actor_id = $film_id = '';

  $error = array('actor_id'=>'','film_id'=>'');





  if (isset($_POST ['submit'])){

  	// chk name
		if(empty($_POST['actor_first_n'])){
			$error['actor_first_n'] =  'Pls enter actor\'s first name <br />';
		} else {
			$actor_first_n = $_POST['actor_first_n'];
			if (!preg_match('/^[a-zA-Z-,.\s]+$/',$actor_first_n)){
				$error['actor_first_n'] = 'Only alphabets allowed';
			}
		}

		if(empty($_POST['actor_last_n'])){
			$error['actor_last_n'] =  'Pls enter actor\'s last name <br />';
		} else {
			$actor_last_n = $_POST['actor_last_n'];
			if (!preg_match('/^[a-zA-Z-,.\s]+$/',$actor_last_n)){
				$error['actor_last_n'] = 'Only alphabets allowed';
			}
		}

		if (array_filter($error)){
			// there r errors in the form
		} else {

			$actor_first_n = mysqli_real_escape_string($conn, $_POST['actor_first_n']);
			$actor_last_n = mysqli_real_escape_string($conn, $_POST['actor_last_n']);

			// create sql code
			$sql = "INSERT INTO actor (actor_first_n, actor_last_n) VALUES('$actor_first_n', '$actor_last_n')";

			// save to db and chk
			if(mysqli_query($conn, $sql)){
				// success
				header('Location: index_actor.php');
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
 		<h4 class="center">Add New Actor</h4>
 		<form class="white" action="add_actor.php" method="POST">
 			<label>Actor First Name :</label>
 			<input type="text" name="actor_first_n" value="<?php echo htmlspecialchars($actor_first_n); ?>">
 			<div class="red-text"><?php echo $error['actor_first_n']; ?></div>
 			
 			<label>Actor Last Name :</label>
 			<input type="text" name="actor_last_n" value="<?php echo htmlspecialchars($actor_last_n); ?>">
 			<div class="red-text"><?php echo $error['actor_last_n']; ?></div>

			<div class="center">
				<input type="submit" name="submit" value="submit" class="btn brand z-depth-0">
			</div>			
 		</form>
 	</section>

 	<?php include('templates/footer.php'); ?>

 </html>