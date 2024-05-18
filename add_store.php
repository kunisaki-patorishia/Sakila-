<?php include('header.php'); ?>

<main>
    <div class="container">
        <h4 class="center">Rental Records</h4>
        <?php if (isset($_SESSION['msg'])): ?>
            <div class="card-panel green lighten-4">
                <?php
                echo $_SESSION['msg'];
                unset($_SESSION['msg']);
                ?>
            </div>
        <?php endif ?>

        <!-- Add Rental button -->
        <div class="row">
            <div class="col s12">
                <a href="add_rental.php" class="btn waves-effect waves-light">Add Rental</a>
            </div>
        </div>

        <table class="striped">
            <thead>
                <tr>
                    <th>Rental ID</th>
                    <th>Rental Date</th>
                    <th>Inventory ID</th>
                    <th>Customer ID</th>
                    <th>Return Date</th>
                    <th>Staff ID</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($results)): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['rental_id']); ?></td>
                        <td><?php echo htmlspecialchars($row['rental_date']); ?></td>
                        <td><?php echo htmlspecialchars($row['inventory_id']); ?></td>
                        <td><?php echo htmlspecialchars($row['customer_id']); ?></td>
                        <td><?php echo htmlspecialchars($row['return_date']); ?></td>
                        <td><?php echo htmlspecialchars($row['staff_id']); ?></td>
                        <td>
                            <a class="btn green" href="edit_rental.php?edit=<?php echo $row['rental_id']; ?>">Edit</a>
                            <a class="btn red" href="view_rentals.php?del=<?php echo $row['rental_id']; ?>">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</main>

<?php include('templates/footer.php'); ?>
