<?php 
$conn = mysqli_connect('localhost','mike','PCLC1712','entertainment');

// Check connection
if (!$conn) {
    echo 'Connection Error : ' . mysqli_connect_error();
}

// Write query for all actors and their films, ordered by actor's first name
$sql = 'SELECT film_actor.actor_id, actor.first_name, actor.last_name, GROUP_CONCAT(film.title SEPARATOR ", ") AS film_titles
        FROM film_actor 
        INNER JOIN film ON film_actor.film_id = film.film_id 
        INNER JOIN actor ON film_actor.actor_id = actor.actor_id
        GROUP BY film_actor.actor_id
        ORDER BY actor.first_name ASC';

// Make query and get result
$result = mysqli_query($conn, $sql);

// Fetch the rows as array
$film_actors = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Free result from memory
mysqli_free_result($result);

// Close connection to db
mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
    <?php include('templates/header.php'); ?>
    <h5 class="grey-text center">List of Films and Actors</h5>
    <h4 class="center grey-text">
        <a href="add_actor.php" class="btn brand z-depth-0">Add New Actor</a>
        <a href="add_film_actor.php" class="btn brand z-depth-0">Link Film and Actors</a>
    </h4>
    <div class="container">
        <div class="row">
            <?php foreach($film_actors as $film_actor): ?>
                <div class="col s12">
                    <div class="card z-depth-0">
                        <div class="card-content">
                            <h6><?php echo "Actor's Name: " . htmlspecialchars($film_actor['first_name'] . " " . $film_actor['last_name']); ?></h6>
                            <p><?php echo "Films: " . htmlspecialchars($film_actor['film_titles']); ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php include('templates/footer.php'); ?>
</html>
