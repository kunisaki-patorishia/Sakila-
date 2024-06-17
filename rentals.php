<?php
session_start();

// Initialize variables
$rental_id = 0;
$customer_id = 0;
$inventory_id = 0;
$rental_date = date("Y-m-d H:i:s");
$return_date = null;
$staff_id = 0;
$edit_state = false;

// Connect to the database
$db = mysqli_connect('localhost', 'mike', 'PCLC1712', 'entertainment');
if (!$db) {
    die('Connection Error: ' . mysqli_connect_error());
}

// Handle form submissions for saving, updating, and deleting rental records
if (isset($_POST['save'])) {
    $inventory_id = $_POST['inventory_id'];
    $customer_id = $_POST['customer_id'];
    $staff_id = $_POST['staff_id'];
    $rental_date = $_POST['rental_date'];

    $query = "INSERT INTO rental (rental_date, inventory_id, customer_id, return_date, staff_id) 
              VALUES ('$rental_date', '$inventory_id', '$customer_id', NULL, '$staff_id')";
    if (mysqli_query($db, $query)) {
        $_SESSION['msg'] = "Rental Record saved";
        header('location: view_rentals.php');
    } else {
        echo 'Error: ' . mysqli_error($db);
    }
}

if (isset($_POST['update'])) {
    $rental_id = $_POST['rental_id'];
    $return_date = date("Y-m-d H:i:s");
    $staff_id = $_POST['staff_id'];

    $query = "UPDATE rental SET return_date='$return_date', staff_id='$staff_id' WHERE rental_id=$rental_id";
    if (mysqli_query($db, $query)) {
        $_SESSION['msg'] = "Rental updated";
        header('location: view_rentals.php');
    } else {
        echo 'Error: ' . mysqli_error($db);
    }
}

if (isset($_GET['del'])) {
    $rental_id = $_GET['del'];
    $query = "DELETE FROM rental WHERE rental_id='$rental_id'";
    if (mysqli_query($db, $query)) {
        $_SESSION['msg'] = "Rental deleted";
        header('location: view_rentals.php');
    } else {
        echo 'Error: ' . mysqli_error($db);
    }
}

// Retrieve all rental records with customer names and staff names
$results = mysqli_query($db, "SELECT rental.rental_id, rental.rental_date, rental.return_date, rental.inventory_id, rental.customer_id, rental.staff_id, customer.first_name AS customer_first_name, customer.last_name AS customer_last_name, staff.staff_first_n AS staff_first_name, staff.staff_last_n AS staff_last_name
                             FROM rental 
                             LEFT JOIN customer ON rental.customer_id = customer.customer_id 
                             LEFT JOIN staff ON rental.staff_id = staff.staff_id
                             WHERE rental.return_date IS NULL");

?>

<!DOCTYPE html>
<html lang="en">
<?php include('templates/header.php'); ?>

<main>
    <div class="container">
        <h5 class="center grey-text">Rental Records</h5>
        <?php if (isset($_SESSION['msg'])): ?>
            <div class="card-panel green lighten-4">
                <?php
                echo $_SESSION['msg'];
                unset($_SESSION['msg']);
                ?>
            </div>
        <?php endif ?>

        <!-- Add Rental button -->
        <div class="row">
            <div class="col s12 center">
                <a href="add_rental.php" class="btn brand z-depth-0">Add Rental</a>
            </div>
        </div>

        <div class="row">
            <?php while ($row = mysqli_fetch_assoc($results)): ?>
                <div class="col s12 m6">
                    <div class="card z-depth-0">
                        <div class="card-content left-align">
                            <h6><?php echo 'Rental ID: ' . htmlspecialchars($row['rental_id']); ?></h6>
                            <div><?php echo 'Rental Date: ' . htmlspecialchars($row['rental_date']); ?></div>
                            <div><?php echo 'Inventory ID: ' . htmlspecialchars($row['inventory_id']); ?></div>
                            <div><?php echo 'Customer Name: ' . htmlspecialchars($row['customer_first_name'] . ' ' . $row['customer_last_name']); ?></div>
                            <div><?php echo 'Return Date: ' . htmlspecialchars($row['return_date']); ?></div>
                            <div><?php echo 'Staff Name: ' . htmlspecialchars($row['staff_first_name'] . ' ' . $row['staff_last_name']); ?></div>
                        </div>
                        <div class="card-action right-align">
                            <a class="brand-text" href="edit_rental.php?edit=<?php echo $row['rental_id']; ?>">Edit</a>
                            <a class="brand-text" href="view_rentals.php?del=<?php echo $row['rental_id']; ?>">Delete</a>
                            <form method="POST" action="view_rentals.php" style="display: inline;">
                                <input type="hidden" name="rental_id" value="<?php echo $row['rental_id']; ?>">
                                <input type="hidden" name="staff_id" value="<?php echo $staff_id; ?>">
                                <button type="submit" name="update" class="btn-small green">Return</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
</main>

<?php include('templates/footer.php'); ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('.sidenav');
        var instances = M.Sidenav.init(elems, {});
    });
</script>

</body>
</html>
