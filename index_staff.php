<?php 
include('server.php');

// Fetch the record to be updated
if (isset($_GET['edit'])) {
    $staff_id = $_GET['edit'];
    $edit_state = true;

    $rec = mysqli_query($db, "SELECT * FROM staff WHERE staff_id=$staff_id");
    $record = mysqli_fetch_array($rec);

    $staff_first_n = $record['staff_first_n'];
    $staff_last_n = $record['staff_last_n'];
    $address = $record['address'];
    $address2 = $record['address2'];
    $district = $record['district'];
    $city_name = $record['city_name'];
    $postal_code = $record['postal_code'];
    $staff_phone = $record['staff_phone'];
    $picture = $record['picture'];
    $staff_email = $record['staff_email'];
    $store_id = $record['store_id'];
    $active = $record['active'];
    $username = $record['username'];
    $password = $record['password'];
} else {
    // Set default values
    $edit_state = false;
}

// Retrieve all staff records
$results = mysqli_query($db, "SELECT * FROM staff");
?>

<!DOCTYPE html>
<html>
<?php include('templates/header.php'); ?>
<head>
    <title>Sakila DVD Renting Company - Staff Records Maintenance</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <header>
        <h1 class="center-align">Staff Records Maintenance</h1>
    </header>

    <div class="container">
        <?php if (isset($_SESSION['msg'])): ?>
            <div class="card-panel green lighten-4">
                <?php 
                echo $_SESSION['msg'];
                unset($_SESSION['msg']);
                ?>
            </div>
        <?php endif ?>

        <table class="striped">
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>District</th>
                    <th>Phone</th>
                    <th>Store Id</th>
                    <th>Active</th>
                    <th colspan="2">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_array($results)): ?>
                    <tr>
                        <td><?php echo $row['staff_first_n']; ?></td>
                        <td><?php echo $row['staff_last_n']; ?></td>
                        <td><?php echo $row['district']; ?></td>
                        <td><?php echo $row['staff_phone']; ?></td>
                        <td><?php echo $row['store_id']; ?></td>
                        <td><?php echo $row['active'] == 1 ? 'Yes' : 'No'; ?></td>
                        <td>
                            <a class="btn blue" href="index_staff.php?edit=<?php echo $row['staff_id']; ?>">Edit</a>
                        </td>
                        <td>
                            <a class="btn red" href="server.php?del=<?php echo $row['staff_id']; ?>">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <form class="col s12" method="post" action="server.php">
            <input type="hidden" name="staff_id" value="<?php echo $staff_id; ?>">

            <div class="input-field">
                <input type="text" name="staff_first_n" required value="<?php echo $staff_first_n; ?>">
                <label>First Name</label>
            </div>

            <div class="input-field">
                <input type="text" name="staff_last_n" required value="<?php echo $staff_last_n; ?>">
                <label>Last Name</label>
            </div>

            <div class="input-field">
                <input type="text" name="address" maxlength="50" required value="<?php echo $address; ?>">
                <label>Address Line 1</label>
            </div>

            <div class="input-field">
                <input type="text" name="address2" maxlength="50" value="<?php echo $address2; ?>">
                <label>Address Line 2</label>
            </div>

            <div class="input-field">
                <input type="text" name="district" maxlength="20" required value="<?php echo $district; ?>">
                <label>District</label>
            </div>

            <div class="input-field">
                <input type="text" name="city_name" maxlength="40" required value="<?php echo $city_name; ?>">
                <label>City & Country</label>
            </div>

            <div class="input-field">
                <input type="text" name="postal_code" maxlength="5" value="<?php echo $postal_code; ?>">
                <label>Postal Code</label>
            </div>

            <div class="input-field">
                <input type="text" name="staff_phone" maxlength="20" required value="<?php echo $staff_phone; ?>">
                <label>Phone</label>
            </div>

            <div class="input-field">
                <input type="email" name="staff_email" maxlength="50" value="<?php echo $staff_email; ?>">
                <label>Email</label>
            </div>

            <div class="input-field">
                <input type="number" name="store_id" min="1" max="2" required value="<?php echo $store_id; ?>">
                <label>Store Id</label>
            </div>

            <div>
                <label>Active</label><br>
                <label>
                    <input type="radio" name="active" value="1" <?php if ($active == 1) echo "checked"; ?>>
                    <span>Yes</span>
                </label>
                <label>
                    <input type="radio" name="active" value="0" <?php if ($active == 0) echo "checked"; ?>>
                    <span>No</span>
                </label>
            </div>

            <div class="input-field">
                <input type="text" name="username" maxlength="16" required value="<?php echo $username; ?>">
                <label>Username</label>
            </div>

            <div class="input-field">
                <input type="password" name="password" maxlength="40" value="<?php echo $password; ?>">
                <label>Password</label>
            </div>

            <div class="input-field">
                <?php if ($edit_state == false): ?>
                    <button type="submit" name="save" class="btn green">Save</button>
                <?php else: ?>
                    <button type="submit" name="update" class="btn orange">Update</button>
                <?php endif ?>
            </div>
        </form>
    </div>

     <style>
    /* Option 1: Using line-height (adjust button height and line-height as needed) */
    .btn {
      line-height: 15px;
      text-align: center;
    }
    
    <?php include('templates/footer.php'); ?>
</body>
</html>
