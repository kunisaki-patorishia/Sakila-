<?php 
	// DISPLAY(shd chg to UPDATE) & DELETE film
	//include('c:/xampp/htdocs/tuts/config/db_connect.php');
  // include('C:/xampp/htdocs/tuts/config/db_connect.php');
	// connect to db
  $conn = mysqli_connect('localhost','mike','test1234','sakila');

  // chk connection
  if (!$conn) {
  	echo 'Connection Error : ' . mysqli_connect_error();
  }

  if(isset($_POST['delete'])){
  	$film_id_to_delete = mysqli_real_escape_string($conn, $_POST['film_id_to_delete']);

  	$sql = "DELETE FROM film WHERE film_id = $film_id_to_delete";

  	if(mysqli_query($conn, $sql)){
  		//success
  		header('Location: index.php');
  	} {
  		// failure -- display the following error msg in HTML part
  		echo 'query error: ' . mysqli_error($conn);
  	}
  }

  //print_r($film);
  //print_r($film['film_id']); 

  	// chk GET request id param
	if (isset($_GET['film_id'])){
		//print_r($film_id);
		$film_id = mysqli_real_escape_string($conn, $_GET['film_id']);
		// mk sql
    $sql = "SELECT * FROM film_actor WHERE film_id = $film_id";
    // get the query result
    $result = mysqli_query($conn, $sql);
    //print_r (mysqli_query($conn, $sql));
    //print_r($result);
    //print_r('$sql');
    if ($result) {
        $sql1 = "SELECT * from film, film_actor 
               INNER JOIN actor on film_actor.actor_id = actor.actor_id  
               WHERE film.film_id = $film_id && film.film_id=film_actor.film_id";
        // get the query result
        $result = mysqli_query($conn, $sql1);

        // fethc result in array format
        $film = mysqli_fetch_assoc($result);
        // print_r($film);
        $actors = mysqli_fetch_all($result, MYSQLI_ASSOC);

        //print_r($actors);

    } else {
        $sql1 = "SELECT * FROM film WHERE film_id = $film_id";      
        // get the query result
        $result = mysqli_query($conn, $sql1);

        // fethc result in array format
        $film = mysqli_fetch_assoc($result);
        // $actors = mysqli_fetch_all($result, MYSQLI_ASSOC);

        print_r($film);
    }

		// get the query result
		//$result = mysqli_query($conn, $sql1);
		// fethc result in array format
		// $film = mysqli_fetch_assoc($result);
  //   $actors = mysqli_fetch_all($result, MYSQLI_ASSOC);

		mysqli_free_result($result);
		mysqli_close($conn);

		//print_r($film);
    //print_r($actors);
	}

 ?>

 <!DOCTYPE html>
 <html>
	
 <?php include('templates/header.php'); ?>
 <div class="container center">
 	<?php if($film): ?>
 		<h4><?php echo htmlspecialchars($film['title']); ?></h4>
 		<p>Release year : <?php echo htmlspecialchars($film['release_year']); ?>   Language : <?php echo htmlspecialchars($film['language_id']); ?>    Original Language : <?php echo htmlspecialchars($film['original_language_id']); ?></p>
 		<h5>Synosis of the film :</h5>
 		<p><?php echo htmlspecialchars($film['description']); ?></p>
    <?php if($actors): ?>
      <h5>Actors:</h5>
        <div class="container">
          <div class="row">
            <?php foreach($actors as $actor): ?><!-- Got error here - display 1 less actor-->
            
               <?php echo htmlspecialchars($actor['actor_first_n']);
                     echo ' ';
                     echo htmlspecialchars($actor['actor_last_n']); 
                     echo ', '; ?>
          
            <?php endforeach; ?>
          </div>      
        </div>
    <?php else: ?> <!-- if($actors):  -->
        <h5>No Actors linked yet!</h5>
    <?php endif; ?>  <!-- if($actors):  -->


 		<!-- DELETE FORM	-->
 		<FORM action="details.php" method="POST">
 			<input type="hidden" name="film_id_to_delete" value="<?php echo $film['film_id'] ?>">
 			<input type="submit" name="delete" value="Delete" class="btn brand z-depth-0">
 		</FORM>
 	<?php else: ?>  <!-- if($film): -->
    <h5><?php echo 'query error: ' . mysqli_error($conn); ?></h5>
 		<!--<h5>No such film exists</h5>-->
 	<?php endif; ?>  <!-- if($film): -->
 </div>

 <?php include('templates/footer.php'); ?>

 </html>