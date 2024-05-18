<<<<<<< HEAD
<?php 
include('config/db_connect.php');

  // write query for all stores
  $sql = 'SELECT * FROM store ORDER BY store_id';

  // mk query & get result
  $result = mysqli_query($conn, $sql);

  // fetch the rows as array
  $stores = mysqli_fetch_all($result, MYSQLI_ASSOC);

  // free result from memory
  mysqli_free_result($result);

  // close connection to db
  mysqli_close($conn);

?>

<!DOCTYPE html>
<html>
 	<?php include('templates/header.php'); ?>
    <h4 class="center grey-text">
    <a href="add_store.php" class="btn brand z-depth-0">Add New Store</a>
    <a href="index_staff.php" class="btn brand z-depth-0">Manage Staff</a></li> 
  </h4>

 	<h5 class="grey-text center">List of Stores</h5>
 	<div class="container">
 		<div class="row">
 			<?php foreach($stores as $store): ?>
 				<div class="col s6 md3">
 					<div class="card z-depth-0">
            <div class="card-content">
              <h6>Store Id : <?php echo htmlspecialchars($store['store_id']); ?></h6>
              <div>Managing Staff Id : <?php echo htmlspecialchars($store['manager_staff_id']); ?></div>
              <div>Store Address : <?php echo htmlspecialchars($store['address']); ?></div>
                <!-- <div><?php echo htmlspecialchars($store['address2']); ?></div> -->
                <div>District : <?php echo htmlspecialchars($store['district']); ?></div>
                <div>City, State and/or Country : <?php echo htmlspecialchars($store['city_name']); ?></div>
                <div><?php echo htmlspecialchars($store['postal_code']); ?></div>
                <div><?php echo htmlspecialchars($store['phone']); ?></div>           
            </div>
            <div class="card-action right-align">
              <a class="brand-text" href="details_store.php?store_id=<?php echo $store['store_id'] ?>">More Info</a>
            </div>  
          </div>          
        </div>
      <?php endforeach; ?>
      
    </div>
    
  </div>


  <?php include('templates/footer.php'); ?>
</html>
=======
<?php
// Initialize variables
$manager_staff_id = '';
$address_id = isset($address_id) ? $address_id : '';
$store_id = isset($store_id) ? $store_id : 0;
$edit_state = isset($edit_state) ? $edit_state : false;

// Database connection
$db = mysqli_connect('localhost', 'mike', 'PCLC1712', 'entertainment');

// Check connection
if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if $store_id is valid (not 0)
if ($store_id != 0) {
    // Fetch the manager_staff_id from the store table
    $sql = "SELECT manager_staff_id FROM store WHERE store_id = $store_id";
    $result = mysqli_query($db, $sql);

    // Check if the query was successful
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $manager_staff_id = $row['manager_staff_id'];
    } else {
        // Handle error if no rows were returned
        echo "Error: " . $sql . "<br>" . mysqli_error($db);
    }
}
// Initialize variables
// $manager_staff_id = "";
// $address_id = "";
// $store_id = 0;
// $edit_state = false;

// If the save_store button is clicked
if (isset($_POST['save_store'])) {
    $manager_staff_id = $_POST['manager_staff_id'];
    $address_id = $_POST['address_id'];

    // Insert data into store table
    $sql = "INSERT INTO store (manager_staff_id, address_id) VALUES ('$manager_staff_id', '$address_id')";
    if (mysqli_query($db, $sql)) {
        $_SESSION['msg'] = "Record saved";
        header('location: index_store.php');
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($db);
    }
}

// If the update_store button is clicked
if (isset($_POST['update_store'])) {
    $store_id = $_POST['store_id'];
    $manager_staff_id = $_POST['manager_staff_id'];
    $address_id = $_POST['address_id'];

    // Update store table
    $sql = "UPDATE store SET manager_staff_id='$manager_staff_id', address_id='$address_id' WHERE store_id=$store_id";
    if (mysqli_query($db, $sql)) {
        $_SESSION['msg'] = "Record updated";
        header('location: index_store.php');
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($db);
    }
}

// If the del_store button is clicked
if (isset($_GET['del_store'])) {
    $store_id = $_GET['del_store'];

    // Delete record from store table
    $sql = "DELETE FROM store WHERE store_id=$store_id";
    if (mysqli_query($db, $sql)) {
        $_SESSION['msg'] = "Record deleted";
        header('location: index_store.php');
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($db);
    }
}

// Retrieve records from store table
$results = mysqli_query($db, "SELECT store_id, manager_staff_id, address_id FROM store");

?>

<?php 
include('server.php');

// Fetch the record to be updated
if (isset($_GET['edit'])) {
    $store_id = $_GET['edit'];
    $edit_state = true;

    $rec = mysqli_query($db, "SELECT * FROM store WHERE store_id=$store_id");
    $record = mysqli_fetch_array($rec);

    // Check if the keys exist in the fetched record
    if(isset($record['manager_staff_id'])) {
        $manager_staff_id = $record['manager_staff_id'];
    }
    if(isset($record['address_id'])) {
        $address_id = $record['address_id'];
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Sakila DVD Renting Company</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <!-- Include header -->
    <?php include('templates/header.php'); ?>

    <center><h3>Store Records Maintenance</h3></center>
    <?php if (isset($_SESSION['msg'])): ?>
        <div class="msg">
            <?php 
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
            ?>
        </div>
    <?php endif ?>
    <table>
        <thead>
            <tr>
                <th>Manager Staff ID</th>
                <th>Address ID</th>
                <th colspan="2">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_array($results)) { ?>
                <tr>
                    <td><?php echo isset($row['manager_staff_id']) ? $row['manager_staff_id'] : ''; ?></td>
                    <td><?php echo isset($row['address_id']) ? $row['address_id'] : ''; ?></td>
                    <td>
                        <a class="edit_btn" href="index_store.php?edit=<?php echo $row['store_id']; ?>">Edit</a>
                    </td>
                    <td>
                        <a class="del_btn" href="server.php?del_store=<?php echo $row['store_id']; ?>">Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <form method="post" action="server.php">
        <input type="hidden" name="store_id" value="<?php echo isset($store_id) ? $store_id : ''; ?>">
        <label>Manager Staff ID</label>
        <input type="text" name="manager_staff_id" required value="<?php echo $manager_staff_id; ?>"><br>

        <label>Address ID</label>
        <input type="text" name="address_id" required value="<?php echo $address_id; ?>"><br>

        <div class="input-group">
            <?php if ($edit_state == false): ?>
                <button type="submit" name="save_store" class="btn">Save</button>
            <?php else: ?>
                <button type="submit" name="update_store" class="btn">Update</button>
            <?php endif ?>
        </div>
    </form>
    
    <!-- Include footer -->
    <?php include('templates/footer.php'); ?>
</body>
</html>
>>>>>>> 79b11c2 (Add new folder)
