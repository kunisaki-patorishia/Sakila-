<?php
// Connect to the database
$conn = mysqli_connect('localhost', 'mike', 'PCLC1712', 'entertainment');

// Check connection
if (!$conn) {
    die('Connection Error: ' . mysqli_connect_error());
}

// Write query for all customers
$sql = 'SELECT * FROM customer ORDER BY first_name ASC';

// Execute query and get result
$result = mysqli_query($conn, $sql);

// Check if query was successful
if (!$result) {
    die('Query Error: ' . mysqli_error($conn));
}

// Fetch resulting rows as an array
$customers = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Free result from memory
mysqli_free_result($result);

// Close database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<?php include('templates/header.php'); ?>

<h5 class="grey-text center">List of Customers by Order of First Name</h5>

<h4 class="center grey-text">
    <a href="add_customer.php" class="btn brand z-depth-0">Add New Customer</a>
</h4>

<div class="container">
    <div class="row">
        <?php foreach ($customers as $customer): ?>
            <div class="col s12 m6">
                <div class="card z-depth-0">
                    <div class="card-content left-align">
                        <h6><?php echo 'Customer ID: ' . htmlspecialchars($customer['customer_id']); ?></h6>
                        <div><?php echo 'Name: ' . htmlspecialchars($customer['first_name'] . ' ' . $customer['last_name']); ?></div>
                        <div><?php echo 'Email: ' . htmlspecialchars($customer['email']); ?></div>
                        <div><?php echo 'Phone: ' . htmlspecialchars($customer['phone']); ?></div>
                        <div><?php echo 'Deposit: $ ' . htmlspecialchars($customer['deposit']); ?></div>
                    </div>
                    <div class="card-action right-align">
                        <a class="brand-text" href="details_customer.php?customer_id=<?php echo $customer['customer_id'] ?>">More Info</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php include('templates/footer.php'); ?>
</html>
