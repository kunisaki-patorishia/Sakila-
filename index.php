<?php
// Connect to the database
$conn = mysqli_connect('localhost', 'mike', 'PCLC1712', 'entertainment');

// Check connection
if (!$conn) {
    echo 'Connection Error: ' . mysqli_connect_error();
}

// Write query for all films
$sql = 'SELECT * FROM film Order By title ASC';

// Execute query and get result
$result = mysqli_query($conn, $sql);

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
    <h4 class="center grey-text">
        <a href="add_film.php" class="btn brand z-depth-0">Add New Film</a>
        <a href="add_actor.php" class="btn brand z-depth-0">Add New Actor</a>
        <a href="add_film_actor.php" class="btn brand z-depth-0">Link Film and Actors</a>
        <a href="add_inventory.php" class="btn brand z-depth-0">Add New Inventories</a>
    </h4>
    <h4 class="center grey-text">List of Films by Order of Title</h4>
    <div class="container">
        <div class="row">
            <?php foreach ($films as $film): ?>
                <div class="col s6 md3">
                    <div class="card z-depth-0">
                        <div class="card-content center">
                            <h6><?php echo 'Film title: ' . htmlspecialchars($film['title']); ?></h6>
                            <div><?php echo 'Release year: ' . htmlspecialchars($film['release_year']); ?></div>
                            <div><?php echo 'Language: ' . htmlspecialchars($film['language_id']); ?></div>
                            <div><?php echo 'Original language: ' . htmlspecialchars($film['original_language_id']); ?></div>
                            <div><?php echo 'Rental Duration: ' . htmlspecialchars($film['rental_duration']) . ' days'; ?></div>
                            <div><?php echo 'Rental rate: $' . htmlspecialchars($film['rental_rate']); ?></div>
                            <div><?php echo 'Length of film: ' . htmlspecialchars($film['length']) . ' minutes'; ?></div>
                            <div><?php echo 'Category: ' . htmlspecialchars($film['category']); ?></div>
                            <div><?php echo 'Rating: ' . htmlspecialchars($film['rating']); ?></div>
                            <ul>
                                <?php echo 'Special features: ' ?>
                                <?php foreach (explode(',', $film['special_features']) as $spec_fea): ?>
                                    <li><?php echo htmlspecialchars($spec_fea); ?></li>
                                <?php endforeach; ?>
                            </ul>
                            <div><?php echo htmlspecialchars($film['description']); ?></div>
                        </div>
                        <div><?php print_r($film['film_id']); ?></div>
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
