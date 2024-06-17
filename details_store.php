<?php
include('config/db_connect.php');

// Function to sanitize input
function sanitize($conn, $input) {
    return mysqli_real_escape_string($conn, htmlspecialchars($input));
}

// Handle delete operation
if (isset($_POST['delete'])) {
    $store_id_to_delete = sanitize($conn, $_POST['store_id_to_delete']);

    $sql = "DELETE FROM store WHERE store_id = $store_id_to_delete";

    if (mysqli_query($conn, $sql)) {
        header('Location: index_store.php');
    } else {
        echo 'Query error: ' . mysqli_error($conn);
    }
}

// Handle update operation
if (isset($_POST['update'])) {
    $store_id = sanitize($conn, $_POST['store_id']);
    $address = sanitize($conn, $_POST['address']);
    $address2 = sanitize($conn, $_POST['address2']);
    $district = sanitize($conn, $_POST['district']);
    $city_name = sanitize($conn, $_POST['city_name']);
    $postal_code = sanitize($conn, $_POST['postal_code']);
    $phone = sanitize($conn, $_POST['phone']);
    $manager_staff_id = sanitize($conn, $_POST['manager_staff_id']); // Capture managing staff ID

    // Construct the SQL query with placeholders
    $sql = "UPDATE store SET 
            address = '$address', 
            address2 = '$address2', 
            district = '$district', 
            city_name = '$city_name', 
            postal_code = '$postal_code', 
            phone = '$phone',
            manager_staff_id = '$manager_staff_id'
            WHERE store_id = $store_id";

    // Execute the SQL query
    if (mysqli_query($conn, $sql)) {
        $_SESSION['msg'] = "Store details updated";
        header('Location: details_store.php?store_id=' . $store_id);
        exit();
    } else {
        echo 'Query error: ' . mysqli_error($conn);
    }
}

// Fetch store details based on store_id
if (isset($_GET['store_id'])) {
    $store_id = sanitize($conn, $_GET['store_id']);

    $sql = "SELECT store_id, manager_staff_id, address, address2, district, city_name, postal_code, phone 
            FROM store 
            WHERE store_id = $store_id";

    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $store = mysqli_fetch_assoc($result);
    } else {
        $store = null;
        echo 'No such store exists.';
    }

    // Fetch all staff members to populate the dropdown for managing staff
    $sql_staff = "SELECT staff_id, CONCAT(staff_first_n, ' ', staff_last_n) AS full_name FROM staff";
    $result_staff = mysqli_query($conn, $sql_staff);
    $staff_members = mysqli_fetch_all($result_staff, MYSQLI_ASSOC);

    mysqli_free_result($result);
    mysqli_free_result($result_staff);
    mysqli_close($conn);
} else {
    $store = null;
    $staff_members = [];
}
?>

<!DOCTYPE html>
<html>
<?php include('templates/header.php'); ?>

<div class="container">
    <?php if ($store): ?>
    <h4 class="center">Store Details</h4>
    <form method="POST" action="details_store.php">
        <input type="hidden" name="store_id" value="<?php echo $store['store_id']; ?>">
        <div class="input-field">
            <input type="text" name="address" id="address"
                value="<?php echo htmlspecialchars($store['address']); ?>" required>
            <label for="address">Address Line 1</label>
        </div>
        <div class="input-field">
            <input type="text" name="address2" id="address2"
                value="<?php echo htmlspecialchars($store['address2']); ?>" required>
            <label for="address2">Address Line 2</label>
        </div>
        <div class="input-field">
            <input type="text" name="district" id="district"
                value="<?php echo htmlspecialchars($store['district']); ?>" required>
            <label for="district">District</label>
        </div>
        <div class="input-field">
            <input type="text" name="city_name" id="city_name"
                value="<?php echo htmlspecialchars($store['city_name']); ?>" required>
            <label for="city_name">City Name</label>
        </div>
        <div class="input-field">
            <input type="text" name="postal_code" id="postal_code"
                value="<?php echo htmlspecialchars($store['postal_code']); ?>" required>
            <label for="postal_code">Postal Code</label>
        </div>
        <div class="input-field">
            <input type="text" name="phone" id="phone" value="<?php echo htmlspecialchars($store['phone']); ?>"
                required>
            <label for="phone">Phone</label>
        </div>
        <!-- Dropdown for managing staff -->
        <div class="input-field">
            <select name="manager_staff_id" id="manager_staff_id" required>
                <option value="" disabled selected>Select Managing Staff</option>
                <?php foreach ($staff_members as $staff): ?>
                <option value="<?php echo $staff['staff_id']; ?>"
                    <?php echo ($staff['staff_id'] == $store['manager_staff_id']) ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($staff['full_name']); ?>
                </option>
                <?php endforeach; ?>
            </select>
            <label for="manager_staff_id">Managing Staff</label>
        </div>
        <div class="center">
            <button type="submit" name="update" class="btn waves-effect waves-light">Update Store</button>
        </div>
    </form>
    <form method="POST" action="details_store.php" class="center">
        <input type="hidden" name="store_id_to_delete" value="<?php echo $store['store_id'] ?>">
        <button type="submit" name="delete" class="btn red waves-effect waves-light">Delete Store</button>
    </form>
    <?php else: ?>
    <h5 class="center">No such store exists.</h5>
    <?php endif ?>
</div>

<?php include('templates/footer.php'); ?>

<!-- Initialize Materialize Select -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('select');
    var instances = M.FormSelect.init(elems, {});
});
</script>

</html>
