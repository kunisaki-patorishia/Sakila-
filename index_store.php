<?php 
include('config/db_connect.php');

// Fetch all stores from the database
$sql = 'SELECT s.*, st.staff_first_n AS manager_first_n, st.staff_last_n AS manager_last_n 
        FROM store s
        LEFT JOIN staff st ON s.manager_staff_id = st.staff_id
        ORDER BY s.store_id';

$result = mysqli_query($conn, $sql);
$stores = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_free_result($result);
mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
    <?php include('templates/header.php'); ?>

<main>
    <div class="container">
        <h5 class="center grey-text">List of Stores</h5>
        
        <?php if (isset($_SESSION['msg'])): ?>
            <div class="card-panel green lighten-4">
                <?php
                echo $_SESSION['msg'];
                unset($_SESSION['msg']);
                ?>
            </div>
        <?php endif ?>

        <!-- Add Store button -->
        <div class="row">
            <div class="col s12 center">
                <a href="add_store.php" class="btn brand z-depth-0">Add New Store</a>
            </div>
        </div>

        <div class="row">
            <?php foreach($stores as $store): ?>
                <div class="col s12 m6">
                    <div class="card z-depth-0">
                        <div class="card-content left-align">
                            <h6>Store Id: <?php echo htmlspecialchars($store['store_id']); ?></h6>
                            <div>Managing Staff: <?php echo htmlspecialchars($store['manager_first_n'] . ' ' . $store['manager_last_n']); ?></div>
                            <div>Store Address: <?php echo htmlspecialchars($store['address'] . ' ' . $store['address2']); ?></div>
                            <div>District: <?php echo htmlspecialchars($store['district']); ?></div>
                            <div>City: <?php echo htmlspecialchars($store['city_name']); ?></div>
                            <div>Postal Code: <?php echo htmlspecialchars($store['postal_code']); ?></div>
                            <div>Phone: <?php echo htmlspecialchars($store['phone']); ?></div>
                        </div>
                        <div class="card-action right-align">
                            <a class="brand-text" href="details_store.php?store_id=<?php echo $store['store_id'] ?>">More Info</a>
                        </div>  
                    </div>          
                </div>
            <?php endforeach; ?>
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
