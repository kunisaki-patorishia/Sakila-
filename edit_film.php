<?php
// Connect to the database
$conn = mysqli_connect('localhost', 'mike', 'PCLC1712', 'entertainment');

// Check connection
if (!$conn) {
    die('Connection Error : ' . mysqli_connect_error());
}

$update_success = false;
$update_error = '';

// Check if form is submitted for editing film
if (isset($_POST['edit'])) {
    $film_id = mysqli_real_escape_string($conn, $_POST['film_id']);
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $release_year = mysqli_real_escape_string($conn, $_POST['release_year']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $language_id = mysqli_real_escape_string($conn, $_POST['language_id']);
    $original_language_id = mysqli_real_escape_string($conn, $_POST['original_language_id']);

    // SQL query to update film details
    $sql = "UPDATE film SET 
            title = '$title', 
            release_year = '$release_year', 
            description = '$description', 
            language_id = '$language_id', 
            original_language_id = '$original_language_id' 
            WHERE film_id = $film_id";

    // Execute query
    if (mysqli_query($conn, $sql)) {
        $update_success = true;
    } else {
        $update_error = 'Query error: ' . mysqli_error($conn);
    }
}

// Initialize $film variable
$film = null;

// Check GET request for film_id param
if (isset($_GET['film_id'])) {
    $film_id = mysqli_real_escape_string($conn, $_GET['film_id']);

    // Fetch film details for pre-populating the form
    $sql = "SELECT * FROM film WHERE film_id = $film_id";

    // Debug: Echo SQL query for verification
    // echo $sql;

    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $film = mysqli_fetch_assoc($result);
    } else {
        echo 'No such film exists';
        // Optionally redirect or handle this case as per your application flow
        exit; // Terminate further execution
    }

    mysqli_free_result($result);
}

?>

<!DOCTYPE html>
<html>

<?php include('templates/header.php'); ?>

<style>
    .container {
        text-align: left;
    }

    h4,
    h5,
    p {
        font-size: 18px; /* Adjust font size as needed */
    }
</style>

<div class="container center">
    <h3 class="center">Edit Film</h3>

    <?php if ($film) : ?>
    <form action="edit_film.php" method="POST">
        <input type="hidden" name="film_id" value="<?php echo $film['film_id']; ?>">
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($film['title']); ?>">

        <label for="release_year">Release Year:</label>
        <input type="text" id="release_year" name="release_year" value="<?php echo htmlspecialchars($film['release_year']); ?>">

        <label for="description">Description:</label>
        <textarea id="description" name="description"><?php echo htmlspecialchars($film['description']); ?></textarea>

        <label for="language_id">Language ID:</label>
        <input type="text" id="language_id" name="language_id" value="<?php echo htmlspecialchars($film['language_id']); ?>">

        <label for="original_language_id">Original Language ID:</label>
        <input type="text" id="original_language_id" name="original_language_id" value="<?php echo htmlspecialchars($film['original_language_id']); ?>">

        <button type="submit" name="edit" class="btn brand z-depth-0">Save Changes</button>
    </form>

    <?php else : ?>
    <!-- if($film): -->
    <h5><?php echo 'No such film exists'; ?></h5>
    <?php endif; ?>
    <!-- if($film): -->
</div>

<?php include('templates/footer.php'); ?>

</html>
