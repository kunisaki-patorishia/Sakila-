<?php 
$conn = mysqli_connect('localhost', 'mike', 'PCLC1712', 'entertainment');

// Check connection
if (!$conn) {
    echo 'Connection Error : ' . mysqli_connect_error();
}

// Initialize variables for form handling
$update_success = false;
$update_error = '';

// Handle form submission for update
if (isset($_POST['update'])) {
    $actor_id = mysqli_real_escape_string($conn, $_POST['actor_id']);
    $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);

    // SQL query to update actor details
    $sql = "UPDATE actor SET first_name = '$first_name', last_name = '$last_name' WHERE actor_id = $actor_id";

    // Execute query
    if (mysqli_query($conn, $sql)) {
        $update_success = true;
    } else {
        $update_error = 'Query error: ' . mysqli_error($conn);
    }
}

// Check GET request for actor_id
if (isset($_GET['actor_id'])) {
    $actor_id = mysqli_real_escape_string($conn, $_GET['actor_id']);

    // SQL query to fetch actor details
    $sql = "SELECT * FROM actor WHERE actor_id = $actor_id";

    // Execute query
    $result = mysqli_query($conn, $sql);

    // Fetch result as an associative array
    $actor = mysqli_fetch_assoc($result);

    // Free result set
    mysqli_free_result($result);

    // Close connection
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html>
<?php include('templates/header.php'); ?>

<div class="container">
    <h3 class="center">Actor Details</h3>
    <div class="row">
        <?php if($actor): ?>
            <div class="col s6">
                <div class="card blue-grey darken-1">
                    <div class="card-content white-text">
                        <span class="card-title">Actor ID: <?php echo htmlspecialchars($actor['actor_id']); ?></span>
                        <form action="details_actor.php" method="POST">
                            <div class="input-field">
                                <input type="hidden" name="actor_id" value="<?php echo $actor['actor_id']; ?>">
                                <input type="text" name="first_name" id="first_name" value="<?php echo htmlspecialchars($actor['first_name']); ?>" required>
                                <label for="first_name">First Name</label>
                            </div>
                            <div class="input-field">
                                <input type="text" name="last_name" id="last_name" value="<?php echo htmlspecialchars($actor['last_name']); ?>" required>
                                <label for="last_name">Last Name</label>
                            </div>
                            <div class="card-action">
                                <button type="submit" name="update" class="btn blue">Update</button>
                                <a href="index_actor.php" class="btn grey">Cancel</a>
                            </div>
                        </form>
                    </div>
                    <div class="card-action">
                        <!-- DELETE FORM -->
                        <form action="details_actor.php" method="POST">
                            <input type="hidden" name="actor_id_to_delete" value="<?php echo $actor['actor_id'] ?>">
                            <input type="submit" name="delete" value="Delete" class="btn red">
                        </form>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <h5 class="center">Actor not found</h5>
        <?php endif; ?>
    </div>
</div>

<?php include('templates/footer.php'); ?>
</html>
