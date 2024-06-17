<?php
include('config/db_connect.php');

$update_success = false;
$update_error = '';

// Function to sanitize input
function sanitize($conn, $input) {
    return mysqli_real_escape_string($conn, htmlspecialchars($input));
}

// Handle delete operation
if (isset($_POST['delete'])){
    $film_id_to_delete = sanitize($conn, $_POST['film_id_to_delete']);

    $sql = "DELETE FROM film WHERE film_id = $film_id_to_delete";

    if(mysqli_query($conn, $sql)){
        header('Location: index.php'); // Redirect after successful delete
        exit();
    } else {
        echo 'Query error: ' . mysqli_error($conn);
    }
}

// Handle update operation
if (isset($_POST['update'])) {
    $film_id = sanitize($conn, $_POST['film_id']);
    $title = sanitize($conn, $_POST['title']);
    $release_year = sanitize($conn, $_POST['release_year']);
    $description = sanitize($conn, $_POST['description']);
    $language_id = sanitize($conn, $_POST['language_id']);
    $original_language_id = sanitize($conn, $_POST['original_language_id']);

    // SQL query to update film details
    $sql = "UPDATE film SET 
            title = '$title', 
            release_year = '$release_year', 
            description = '$description', 
            language_id = $language_id, 
            original_language_id = $original_language_id 
            WHERE film_id = $film_id";

    if(mysqli_query($conn, $sql)){
        $update_success = true;
    } else {
        $update_error = 'Query error: ' . mysqli_error($conn);
    }
}

// Fetch film details based on film_id
$film = null;
if (isset($_GET['film_id'])){
    $film_id = sanitize($conn, $_GET['film_id']);

    $sql = "SELECT film.*, language.name AS language_name 
            FROM film 
            LEFT JOIN language ON film.language_id = language.language_id 
            WHERE film.film_id = $film_id";

    $result = mysqli_query($conn, $sql);

    if($result && mysqli_num_rows($result) > 0){
        $film = mysqli_fetch_assoc($result);

        // Fetch actors associated with the film
        $sql_actors = "SELECT actor.first_name, actor.last_name 
                       FROM actor 
                       INNER JOIN film_actor ON actor.actor_id = film_actor.actor_id 
                       WHERE film_actor.film_id = $film_id";

        $result_actors = mysqli_query($conn, $sql_actors);
        $actors = mysqli_fetch_all($result_actors, MYSQLI_ASSOC);
    } else {
        $film = null;
        echo 'No such film exists.';
    }

    mysqli_free_result($result);
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html>
    <?php include('templates/header.php'); ?>
    <div class="container">
        <?php if($film): ?>
            <h4 class="center"><?php echo htmlspecialchars($film['title']); ?></h4>
            <ul class="collection">
                <li class="collection-item"><strong>Release Year:</strong> <?php echo htmlspecialchars($film['release_year']); ?></li>
                <li class="collection-item"><strong>Language:</strong> <?php echo htmlspecialchars($film['language_name']); ?></li>
                <li class="collection-item"><strong>Original Language:</strong> <?php echo htmlspecialchars($film['original_language_id']); ?></li>
                <li class="collection-item"><strong>Synopsis:</strong> <?php echo htmlspecialchars($film['description']); ?></li>
                <?php if (!empty($actors)): ?>
                    <li class="collection-item"><strong>Actors:</strong>
                        <ul>
                            <?php foreach ($actors as $actor): ?>
                                <li><?php echo htmlspecialchars($actor['first_name'] . ' ' . $actor['last_name']); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                <?php else: ?>
                    <li class="collection-item">No Actors linked yet!</li>
                <?php endif; ?>
            </ul>
            <div class="center">
                <a href="edit_film.php?film_id=<?php echo $film['film_id']; ?>" class="btn waves-effect waves-light">Edit Film</a>
                <form method="POST" action="details.php" style="display: inline;">
                    <input type="hidden" name="film_id_to_delete" value="<?php echo $film['film_id'] ?>">
                    <button type="submit" name="delete" class="btn red waves-effect waves-light">Delete Film</button>
                </form>
            </div>
        <?php else: ?>  
            <h5 class="center">No such film exists.</h5>
        <?php endif ?> 
    </div>
    <?php include('templates/footer.php'); ?>
</html>
