<?php 
include('config/db_connect.php');

// Fetch all staff members from the database
$sql = 'SELECT * FROM staff ORDER BY staff_id';
$result = mysqli_query($conn, $sql);
$staff = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_free_result($result);
mysqli_close($conn);
?>

<!DOCTYPE html>
<html>

<?php include('templates/header.php'); ?>

<main>
    <div class="container">
        <h5 class="center grey-text">List of Staff Members</h5>
        
        <?php if (isset($_SESSION['msg'])): ?>
            <div class="card-panel green lighten-4">
                <?php
                echo $_SESSION['msg'];
                unset($_SESSION['msg']);
                ?>
            </div>
        <?php endif ?>

        <!-- Add Staff button -->
        <div class="row">
            <div class="col s12 center">
                <a href="add_staff.php" class="btn brand z-depth-0">Add New Staff</a>
            </div>
        </div>

        <div class="row">
            <?php foreach($staff as $staff_member): ?>
                <div class="col s12 m6">
                    <div class="card z-depth-0">
                        <div class="card-content left-align">
                            <h6>Name: <?php echo htmlspecialchars($staff_member['staff_first_n'] . ' ' . $staff_member['staff_last_n']); ?></h6>
                            <div>District: <?php echo htmlspecialchars($staff_member['district']); ?></div>
                            <div>Phone: <?php echo htmlspecialchars($staff_member['staff_phone']); ?></div>
                            <div>Store Id: <?php echo htmlspecialchars($staff_member['store_id']); ?></div>
                            <div>Active: <?php echo $staff_member['active'] == 1 ? 'Yes' : 'No'; ?></div>
                        </div>
                        <div class="card-action right-align">
                            <a class="brand-text" href="details_staff.php?staff_id=<?php echo $staff_member['staff_id'] ?>">More Info</a>
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
