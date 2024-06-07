<?php 
  $conn = mysqli_connect('localhost','mike','test1234','sakila');

  // chk connection
  if (!$conn) {
  	echo 'Connection Error : ' . mysqli_connect_error();
  }


  if(isset($_POST['delete'])){
  	$actor_id_to_delete = mysqli_real_escape_string($conn, $_POST['actor_id_to_delete']);

  	$sql = "DELETE FROM actor WHERE actor_id = $actor_id_to_delete";

  	if(mysqli_query($conn, $sql)){
  		//success
  		header('Location: index_actor.php');
  	} {
  		// failure
  		echo 'query error: ' . mysqli_error($conn);
  	}
  }

  	// chk GET request id param
	if (isset($_GET['actor_id'])){
		//print_r($actor_id);
		$actor_id = mysqli_real_escape_string($conn, $_GET['actor _id']);
		// mk sql
		//$sql = "SELECT * FROM film WHERE film_id = $film_id";

		$sql = "SELECT * from actor WHERE actor_id = $actor_id";

		// get the query result
		$result = mysqli_query($conn, $sql);
		// fethc result in array format
		$actor = mysqli_fetch_assoc($result);

		mysqli_free_result($result);
		mysqli_close($conn);

		//print_r($actor);
	}
?>

<!DOCTYPE html>
<html>
 <?php include('templates/header.php'); ?>




</html>
