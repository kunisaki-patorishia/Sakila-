    <?php
    session_start();

    // Initialize variables
    $rental_id = 0;
    $customer_id = 0;
    $inventory_id = 0;
    $rental_date = date("Y-m-d H:i:s");
    $return_date = null;
    $staff_id = 0;
    $edit_state = false;

    // Connect to the database
    $db = mysqli_connect('localhost', 'mike', 'PCLC1712', 'entertainment');
    if (!$db) {
        die('Connection Error: ' . mysqli_connect_error());
    }

    // Handle form submissions for saving, updating, and deleting rental records
    if (isset($_POST['save'])) {
        $inventory_id = $_POST['inventory_id'];
        $customer_id = $_POST['customer_id'];
        $staff_id = $_POST['staff_id'];
        $rental_date = $_POST['rental_date'];

        $query = "INSERT INTO rental (rental_date, inventory_id, customer_id, return_date, staff_id) 
                  VALUES ('$rental_date', '$inventory_id', '$customer_id', NULL, '$staff_id')";
        if (mysqli_query($db, $query)) {
            $_SESSION['msg'] = "Rental Record saved";
            header('location: view_rentals.php');
        } else {
            echo 'Error: ' . mysqli_error($db);
        }
    }

    if (isset($_POST['update'])) {
        $rental_id = $_POST['rental_id'];
        $return_date = date("Y-m-d H:i:s");
        $staff_id = $_POST['staff_id'];

        $query = "UPDATE rental SET return_date='$return_date', staff_id='$staff_id' WHERE rental_id=$rental_id";
        if (mysqli_query($db, $query)) {
            $_SESSION['msg'] = "Rental updated";
            header('location: view_rentals.php');
        } else {
            echo 'Error: ' . mysqli_error($db);
        }
    }

    if (isset($_GET['del'])) {
        $rental_id = $_GET['del'];
        $query = "DELETE FROM rental WHERE rental_id='$rental_id'";
        if (mysqli_query($db, $query)) {
            $_SESSION['msg'] = "Rental deleted";
            header('location: view_rentals.php');
        } else {
            echo 'Error: ' . mysqli_error($db);
        }
    }

    // Retrieve all rental records
    $results = mysqli_query($db, "SELECT * FROM rental WHERE return_date IS NULL");

    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>View Rental Records - Sakila DVD Renting Company</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
        <style type="text/css">
            .brand {
                background: #cbb09c !important;
            }
            .brand-text {
                color: #cbb09c !important;
            }
            .sidenav-trigger i {
                color: #cbb09c !important;
            }
            .nav-wrapper {
                position: relative;
            }
            .brand-logo {
                position: absolute;
                top: 50%;
                transform: translateY(-50%);
                left: 10px;
            }
            .sidenav-trigger {
                position: absolute;
                top: 50%;
                transform: translateY(-50%);
                right: 10px;
            }
            table {
                width: 90%;
                margin: 20px auto;
                border-collapse: collapse;
            }
            th, td {
                padding: 10px;
                text-align: left;
                border-bottom: 1px solid #ddd;
            }
            th {
                background: #f2f2f2;
            }
            footer {
                background: #cbb09c;
                color: white;
                padding: 20px 0;
            }
        </style>
    </head>
    <body class="grey lighten-4">

    <nav class="white z-depth-0">
        <div class="container nav-wrapper">
            <a href="Homepage.php" class="brand-logo brand-text">Sakila Database</a>
            <a href="#" class="sidenav-trigger" data-target="mobile-links">
                <i class="material-icons brand-text">menu</i>
            </a>
            <ul id="nav-mobile" class="right hide-on-med-and-down">
                <li>
                    <select onchange="location = this.value;">
                        <option value="" disabled selected>Choose an option</option>
                        <option value="test_rental.php">Placing/Closing Rental</option>
                        <option value="index_customer.php">Manage Customers</option>
                        <option value="index_store.php">Manage Business</option>
                        <option value="index_film.php">Manage Films</option>
                    </select>
                </li>
            </ul>
        </div>
    </nav>

    <ul id="mobile-links" class="sidenav">
        <li><a href="test_rental.php">Placing/Closing Rental</a></li>
        <li><a href="index_customer.php">Manage Customers</a></li>
        <li><a href="index_store.php">Manage Business</a></li>
        <li><a href="index_film.php">Manage Films</a></li>
    </ul>

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
            </form>
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
