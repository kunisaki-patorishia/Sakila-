<?php 
include('config/db_connect.php');

// Function to sanitize input
function sanitize($conn, $input) {
    return mysqli_real_escape_string($conn, htmlspecialchars($input));
}

// Handle delete operation
if (isset($_POST['delete'])){
    $staff_id_to_delete = sanitize($conn, $_POST['staff_id_to_delete']);

    $sql = "DELETE FROM staff WHERE staff_id = $staff_id_to_delete";

    if(mysqli_query($conn, $sql)){
        header('Location: index_staff.php');
    } else {
        echo 'Query error: ' . mysqli_error($conn);
    }
}

// Handle update operation
if (isset($_POST['update'])) {
    $staff_id = sanitize($conn, $_POST['staff_id']);
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
    $active = isset($_POST['active']) ? 1 : 0;
    $username = sanitize($conn, $_POST['username']);
    $password = sanitize($conn, $_POST['password']);

    $sql = "UPDATE staff SET 
            staff_first_n = '$staff_first_n', 
            staff_last_n = '$staff_last_n', 
            address = '$address', 
            address2 = '$address2', 
            district = '$district', 
            city_name = '$city_name', 
            postal_code = '$postal_code', 
            staff_phone = '$staff_phone', 
            staff_email = '$staff_email', 
            store_id = $store_id, 
            active = $active, 
            username = '$username', 
            password = '$password' 
            WHERE staff_id = $staff_id";

    if(mysqli_query($conn, $sql)){
        $_SESSION['msg'] = "Staff details updated";
        header('Location: details_staff.php?staff_id=' . $staff_id);
        exit();
    } else {
        echo 'Query error: ' . mysqli_error($conn);
    }
}

// Fetch staff details based on staff_id
if (isset($_GET['staff_id'])){
    $staff_id = sanitize($conn, $_GET['staff_id']);

    $sql = "SELECT * FROM staff WHERE staff_id = $staff_id";

    $result = mysqli_query($conn, $sql);

    if($result && mysqli_num_rows($result) > 0){
        $staff = mysqli_fetch_assoc($result);
    } else {
        $staff = null;
        echo 'No such staff exists.';
    }

    mysqli_free_result($result);
    mysqli_close($conn);
} else {
    $staff = null;
}  
?>

<!DOCTYPE html>
<html>
    <?php include('templates/header.php'); ?>
    <div class="container">
        <?php if($staff): ?>
            <h4 class="center">Staff Details</h4>
            <form method="POST" action="details_staff.php">
                <input type="hidden" name="staff_id" value="<?php echo $staff['staff_id']; ?>">
                <div class="input-field">
                    <input type="text" name="staff_first_n" id="staff_first_n" value="<?php echo htmlspecialchars($staff['staff_first_n']); ?>" required>
                    <label for="staff_first_n">First Name</label>
                </div>
                <div class="input-field">
                    <input type="text" name="staff_last_n" id="staff_last_n" value="<?php echo htmlspecialchars($staff['staff_last_n']); ?>" required>
                    <label for="staff_last_n">Last Name</label>
                </div>
                <div class="input-field">
                    <input type="text" name="address" id="address" value="<?php echo htmlspecialchars($staff['address']); ?>" required>
                    <label for="address">Address Line 1</label>
                </div>
                <div class="input-field">
                    <input type="text" name="address2" id="address2" value="<?php echo htmlspecialchars($staff['address2']); ?>">
                    <label for="address2">Address Line 2</label>
                </div>
                <div class="input-field">
                    <input type="text" name="district" id="district" value="<?php echo htmlspecialchars($staff['district']); ?>" required>
                    <label for="district">District</label>
                </div>
                <div class="input-field">
                    <input type="text" name="city_name" id="city_name" value="<?php echo htmlspecialchars($staff['city_name']); ?>" required>
                    <label for="city_name">City & Country</label>
                </div>
                <div class="input-field">
                    <input type="text" name="postal_code" id="postal_code" value="<?php echo htmlspecialchars($staff['postal_code']); ?>">
                    <label for="postal_code">Postal Code</label>
                </div>
                <div class="input-field">
                    <input type="text" name="staff_phone" id="staff_phone" value="<?php echo htmlspecialchars($staff['staff_phone']); ?>" required>
                    <label for="staff_phone">Phone</label>
                </div>
                <div class="input-field">
                    <input type="email" name="staff_email" id="staff_email" value="<?php echo htmlspecialchars($staff['staff_email']); ?>">
                    <label for="staff_email">Email</label>
                </div>
                <div class="input-field">
                    <input type="number" name="store_id" id="store_id" value="<?php echo htmlspecialchars($staff['store_id']); ?>" required>
                    <label for="store_id">Store Id</label>
                </div>
                <div class="input-field">
                    <p>
                        <label>
                            <input type="checkbox" name="active" id="active" <?php echo $staff['active'] == 1 ? 'checked' : ''; ?>>
                            <span>Active</span>
                        </label>
                    </p>
                </div>
                <div class="input-field">
                    <input type="text" name="username" id="username" value="<?php echo htmlspecialchars($staff['username']); ?>" required>
                    <label for="username">Username</label>
                </div>
                <div class="input-field">
                    <input type="password" name="password" id="password" value="<?php echo htmlspecialchars($staff['password']); ?>">
                    <label for="password">Password</label>
                </div>
                <div class="center">
                    <button type="submit" name="update" class="btn waves-effect waves-light">Update Staff</button>
                </div>
            </form>
            <form method="POST" action="details_staff.php" class="center">
                <input type="hidden" name="staff_id_to_delete" value="<?php echo $staff['staff_id'] ?>">
                <button type="submit" name="delete" class="btn red waves-effect waves-light">Delete Staff</button>
            </form>
        <?php else: ?>  
            <h5 class="center">No such staff exists.</h5>
        <?php endif ?> 
    </div>
    <?php include('templates/footer.php'); ?>
</html>
