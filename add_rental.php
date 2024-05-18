<?php
    // Start session if not already started
    session_start();

    // Initialize variables
    $rental_id = 0;
    $customer_id = 0;
    $inventory_id = 0;
    $rental_date = date("Y-m-d H:i:s");
    $return_date = null;
    $staff_id = 0;

    // Connect to the database
    $db = mysqli_connect('localhost', 'mike', 'PCLC1712', 'entertainment');
    if (!$db) {
        die('Connection Error : ' . mysqli_connect_error());
    }

    // Check if the form is submitted
    if (isset($_POST['submit'])) {
        // Extract form data
        $inventory_id = $_POST['inventory_id'];
        $customer_id = $_POST['customer_id'];
        $staff_id = $_POST['staff_id'];

        // Perform any validation here

        // Insert the rental record into the database
        $query = "INSERT INTO rental (rental_date, inventory_id, customer_id, return_date, staff_id) VALUES ('$rental_date', '$inventory_id', '$customer_id', NULL, '$staff_id')";
        if (mysqli_query($db, $query)) {
            $_SESSION['msg'] = "Rental Record saved";
            header('location: view_rental.php');  // Redirect to view_rental.php after successful insertion
            exit();
        } else {
            echo 'query error: ' . mysqli_error($db);
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Rental - Sakila DVD Renting Company</title>
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <style type="text/css">
        <!-- Your CSS styles here -->
    </style>
</head>
<body class="grey lighten-4">
    <?php include('templates/header.php'); ?>

    <div class="container">
        <h5>Add New Rental</h5>
        <form method="post" action="view_rentals.php">
            <label for="inventory_id">Inventory ID</label>
            <input type="number" name="inventory_id" id="inventory_id" required>

            <label for="customer_id">Customer ID</label>
            <input type="number" name="customer_id" id="customer_id" required>

            <label for="staff_id">Staff ID</label>
            <input type="number" name="staff_id" id="staff_id" required>

            <input type="hidden" name="rental_date" value="<?php echo $rental_date; ?>">
            <input type="hidden" name="return_date" value="<?php echo $return_date; ?>">

            <button type="submit" name="save" class="btn">Save</button>
        </form>
    </div>

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

    <?php include('templates/footer.php'); ?>
</body>
</html>
