<?php 
$conn = mysqli_connect('localhost', 'mike', 'PCLC1712', 'entertainment');

// Check connection
if (!$conn) {
    echo 'Connection Error : ' . mysqli_connect_error();
}

// Write query for all actors
$sql = 'SELECT * FROM actor ORDER BY first_name';

// Make query & get result
$result = mysqli_query($conn, $sql);

// Fetch the rows as array
$actors = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Free result from memory
mysqli_free_result($result);

// Close connection to db
mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<?php include('templates/header.php'); ?>

<h5 class="grey-text center">List of Actors in ascending order of first name</h5>

<h4 class="center grey-text">
    <a href="add_actor.php" class="btn brand z-depth-0">Add New Actor</a>
    <a href="add_film_actor.php" class="btn brand z-depth-0">Link Film and Actors</a>
</h4>



<div class="container">
    <div class="row">
        <?php foreach($actors as $actor): ?>
        <div class="col s12 m6">
            <div class="card z-depth-0">
                <div class="card-content">
                    <p><strong>Actor ID:</strong> <?php echo htmlspecialchars($actor['actor_id']); ?></p>
                    <p><strong>First Name:</strong> <?php echo htmlspecialchars($actor['first_name']); ?></p>
                    <p><strong>Last Name:</strong> <?php echo htmlspecialchars($actor['last_name']); ?></p>
                </div>
                <div class="card-action right-align">
                    <a class="brand-text" href="details_actor.php?actor_id=<?php echo $actor['actor_id']; ?>">More Info</a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<?php include('templates/footer.php'); ?>

</html>
