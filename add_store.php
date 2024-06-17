<?php
include('config/db_connect.php');

$address = $address2 = $district = $city_name = $postal_code = $phone = '';

if (isset($_POST['add_store'])) {
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $address2 = mysqli_real_escape_string($conn, $_POST['address2']);
    $district = mysqli_real_escape_string($conn, $_POST['district']);
    $city_name = mysqli_real_escape_string($conn, $_POST['city_name']);
    $postal_code = mysqli_real_escape_string($conn, $_POST['postal_code']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);

    $query = "INSERT INTO store (address, address2, district, city_name, postal_code, phone) VALUES ('$address', '$address2', '$district', '$city_name', '$postal_code', '$phone')";
    
    if (mysqli_query($conn, $query)) {
        $_SESSION['msg'] = "Store added successfully";
        header('Location: index_store.php');
        exit();
    } else {
        echo 'Query error: ' . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
    <?php include('templates/header.php'); ?>
    <main>
        <div class="container">
            <h4 class="center">Add New Store</h4>
            <form method="post" action="add_store.php">
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
                    <label for="city_name">City Name</label>
                </div>
                <div class="input-field">
                    <input type="text" name="postal_code" id="postal_code" value="<?php echo htmlspecialchars($postal_code); ?>" required>
                    <label for="postal_code">Postal Code</label>
                </div>
                <div class="input-field">
                    <input type="text" name="phone" id="phone" value="<?php echo htmlspecialchars($phone); ?>" required>
                    <label for="phone">Phone</label>
                </div>
                <button type="submit" name="add_store" class="btn waves-effect waves-light">Add Store</button>
            </form>
        </div>
    </main>
    <?php include('templates/footer.php'); ?>
</html>
