<?php
// Connect to the database
$conn = mysqli_connect('localhost', 'mike', 'PCLC1712', 'entertainment');

// Check connection
if (!$conn) {
    die('Connection Error: ' . mysqli_connect_error());
}

// Write query for all films
$sql = 'SELECT * FROM film ORDER BY title ASC';

// Execute query and get result
$result = mysqli_query($conn, $sql);

// Check if query was successful
if (!$result) {
    die('Query Error: ' . mysqli_error($conn));
}

// Fetch resulting rows as an array
$films = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Free result from memory
mysqli_free_result($result);

// Close database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<?php include('templates/header.php'); ?>

<h5 class="center grey-text">List of Films by Order of Title</h5>

<h4 class="center grey-text">
    <a href="add_film.php" class="btn brand z-depth-0">Add New Film</a>
    <a href="add_actor.php" class="btn brand z-depth-0">Add New Actor</a>
    <a href="add_film_actor.php" class="btn brand z-depth-0">Link Film and Actors</a>
</h4>



<div class="container">
    <div class="row">
        <?php foreach ($films as $film): ?>
            <div class="col s12 m6">
                <div class="card z-depth-0">
                    <div class="card-content">
                        <h6 style="text-align: left;"><?php echo 'Film title: ' . htmlspecialchars($film['title']); ?></h6>
                        <div style="text-align: left;"><?php echo 'Release year: ' . htmlspecialchars($film['release_year']); ?></div>
                        <!-- Display other film details here -->
                    </div>
                    <div class="card-action right-align">
                        <a class="brand-text" href="details.php?film_id=<?php echo $film['film_id'] ?>">more info</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php include('templates/footer.php'); ?>
</html>
