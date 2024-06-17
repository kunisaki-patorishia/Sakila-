<?php 
include('config/db_connect.php');

// Function to sanitize input
function sanitize($conn, $input) {
    return mysqli_real_escape_string($conn, htmlspecialchars($input));
}

// Initialize variables for form fields
$staff_first_n = $staff_last_n = $address = $address2 = $district = $city_name = $postal_code = $staff_phone = $staff_email = $store_id = $active = $username = $password = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize input data
    $staff_first_n = sanitize($conn, $_POST['staff_first_n']);
    $staff_last_n = sanitize($conn, $_POST['staff_last_n']);
    $address = sanitize($conn, $_POST['address']);
    $address2 = sanitize($conn, $_POST['address2']);
    $district = sanitize($conn, $_POST['district']);
    $city_name = sanitize($conn, $_POST['city_name']);
    $postal_code = sanitize($conn, $_POST['postal_code']);
    $staff_phone = sanitize($conn, $_POST['staff_phone']);
    $staff_email = sanitize($conn, $_POST['staff_email']);
    $store_id = sanitize($conn, $_POST['store_id']);
    $active = isset($_POST['active']) ? 1 : 0; // Checkbox value
    $username = sanitize($conn, $_POST['username']);
    $password = sanitize($conn, $_POST['password']);

    // Insert data into database
    $sql = "INSERT INTO staff (staff_first_n, staff_last_n, address, address2, district, city_name, postal_code, staff_phone, staff_email, store_id, active, username, password) 
            VALUES ('$staff_first_n', '$staff_last_n', '$address', '$address2', '$district', '$city_name', '$postal_code', '$staff_phone', '$staff_email', $store_id, $active, '$username', '$password')";

    if(mysqli_query($conn, $sql)){
        $_SESSION['msg'] = "New staff member added successfully";
        header('Location: index_staff.php'); // Redirect after successful addition
        exit();
    } else {
        echo 'Query error: ' . mysqli_error($conn);
    }
}

mysqli_close($conn); // Close database connection
?>

<!DOCTYPE html>
<html>
    <?php include('templates/header.php'); ?>
    <div class="container">
        <h4 class="center">Add New Staff Member</h4>
        <form method="POST" action="add_staff.php">
            <div class="input-field">
                <input type="text" name="staff_first_n" id="staff_first_n" value="<?php echo htmlspecialchars($staff_first_n); ?>" required>
                <label for="staff_first_n">First Name</label>
            </div>
            <div class="input-field">
                <input type="text" name="staff_last_n" id="staff_last_n" value="<?php echo htmlspecialchars($staff_last_n); ?>" required>
                <label for="staff_last_n">Last Name</label>
            </div>
            <div class="input-field">
                <input type="text" name="address" id="address" value="<?php echo htmlspecialchars($address); ?>" required>
                <label for="address">Address Line 1</label>
            </div>
            <div class="input-field">
                <input type="text" name="address2" id="address2" value="<?php echo htmlspecialchars($address2); ?>">
                <label for="address2">Address Line 2</label>
            </div>
            <div class="input-field">
                <input type="text" name="district" id="district" value="<?php echo htmlspecialchars($district); ?>" required>
                <label for="district">District</label>
            </div>
            <div class="input-field">
                <input type="text" name="city_name" id="city_name" value="<?php echo htmlspecialchars($city_name); ?>" required>
                <label for="city_name">City & Country</label>
            </div>
            <div class="input-field">
                <input type="text" name="postal_code" id="postal_code" value="<?php echo htmlspecialchars($postal_code); ?>">
                <label for="postal_code">Postal Code</label>
            </div>
            <div class="input-field">
                <input type="text" name="staff_phone" id="staff_phone" value="<?php echo htmlspecialchars($staff_phone); ?>" required>
                <label for="staff_phone">Phone</label>
            </div>
            <div class="input-field">
                <input type="email" name="staff_email" id="staff_email" value="<?php echo htmlspecialchars($staff_email); ?>">
                <label for="staff_email">Email</label>
            </div>
            <div class="input-field">
                <input type="number" name="store_id" id="store_id" value="<?php echo htmlspecialchars($store_id); ?>" required>
                <label for="store_id">Store Id</label>
            </div>
            <div class="input-field">
                <p>
                    <label>
                        <input type="checkbox" name="active" id="active" <?php echo $active == 1 ? 'checked' : ''; ?>>
                        <span>Active</span>
                    </label>
                </p>
            </div>
            <div class="input-field">
                <input type="text" name="username" id="username" value="<?php echo htmlspecialchars($username); ?>" required>
                <label for="username">Username</label>
            </div>
            <div class="input-field">
                <input type="password" name="password" id="password" value="<?php echo htmlspecialchars($password); ?>">
                <label for="password">Password</label>
            </div>
            <div class="center">
                <button type="submit" class="btn waves-effect waves-light">Add Staff</button>
            </div>
        </form>
    </div>
    <?php include('templates/footer.php'); ?>
</html>
