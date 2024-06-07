<<<<<<< HEAD
<?php 
    session_start();
    if($_SERVER['QUERY_STRING'] == 'noname'){
        unset($_SESSION['name']); // unset  or clear single variable
        // unset or clear all superglobal variables tuto #36
        //session_unset();
    }
    $name = $_SESSION['name'] ?? 'Guest';
    // $staff_id = $_SESSION['staff_id'];
    // $store_id = $_SESSION['store_id'];
?>
<head>
	<title>Sakila DVD Renting Company</title>
	 <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <style type="text/css">
    	.brand{
    		background: #cbb09c !important;
    	}
    	.brand-text{
    		color: #cbb09c !important;
    	}
    	form {
    		max-width: 460px;
    		margin: 20px auto;
    		padding: 20px;
    	}
    </style>
</head>
	<body class="grey lighten-4">
		<nav class="white z-depth-0">
			<div class="container">
				<a href="index.php" class="brand-logo brand-text">Sakila Database</a>
				<ul id="nav-mobile" class="right hide-on-small-down">
                    <!-- <li class="grey-text">Hello <?php echo htmlspecialchars($name); ?></li> -->
<!-- 					<li class="grey-text">Hello <?php echo htmlspecialchars($staff_id); 
                                                     echo (' of ');
                                                     echo htmlspecialchars($store_id); 
                                        ?>
                    </li> -->
                    <!-- <li class="grey-text">Hello <?php echo htmlspecialchars(($name)); ?></li> -->
                    <li><a href="test_rental.php" class="btn brand z-depth-0">Placing/Closing Rental</a></li>
                    <li><a href="index_customer.php" class="btn brand z-depth-0">Manage Customers</a></li>
                    <li><a href="index_store.php" class="btn brand z-depth-0">Manage Business</a></li>
                    <!-- <li><a href="add_actor.php" class="btn brand z-depth-0">Add New Actor</a></li> -->
				</ul>
			</div>
		</nav>
=======
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sakila DVD Renting Company</title>
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <style type="text/css">
        .brand{
            background: #cbb09c !important;
        }
        .brand-text{
            color: #cbb09c !important;
        }
        form {
            max-width: 460px;
            margin: 20px auto;
            padding: 20px;
        }

        /* Hamburger/menu icon color */
        .sidenav-trigger i {
            color: #cbb09c !important;
        }

        /* Adjustments to the navigation */
        .nav-wrapper {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .brand-logo {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
        }

        .sidenav-trigger {
            position: absolute;
            right: 10px;
        }

        .dropdown-button {
            background-color: #ffffff;
            color: #000;
            border: none;
            outline: none;
            padding: 0 15px;
            font-size: 16px;
            cursor: pointer;
        }

        .dropdown-content {
            min-width: 200px; /* Adjust width as needed */
        }
    </style>
</head>
<body class="grey lighten-4">

<nav class="white z-depth-0">
  <div class="container nav-wrapper">
    <a href="Homepage.php" class="brand-logo center brand-text">Sakila Database</a>
    
    <a href="#" class="sidenav-trigger" data-target="mobile-links">
      <i class="material-icons brand-text">menu</i>
    </a>
    
    <ul id="nav-mobile" class="right hide-on-med-and-down">
      <li>
        <a class="dropdown-trigger btn dropdown-button" href="#" data-target="dropdown1">Manage</a>
      </li>
    </ul>
  </div>
</nav>

<!-- Dropdown Structure -->
<ul id="dropdown1" class="dropdown-content">
  <li><a href="rentals.php">Placing/Closing Rental</a></li>
  <li><a href="index_customer.php">Manage Customers</a></li>
  <li><a href="index_store.php">Manage Business</a></li>
  <li><a href="index_film.php">Manage Films</a></li>
</ul>

<!-- Mobile Dropdown Structure -->
<ul id="mobile-links" class="sidenav">
    <li><a href="rentals.php">Placing/Closing Rental</a></li>
    <li><a href="index_customer.php">Manage Customers</a></li>
    <li><a href="index_store.php">Manage Business</a></li>
    <li><a href="index_film.php">Manage Films</a></li>
</ul>

<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('.sidenav');
        var instances = M.Sidenav.init(elems);

        var dropdowns = document.querySelectorAll('.dropdown-trigger');
        M.Dropdown.init(dropdowns, {
            coverTrigger: false, // Displays dropdown below the button
            constrainWidth: false // Optionally constrains dropdown width to button width
        });
    });
</script>

</body>
</html>
>>>>>>> da12d4a3991d2a067910c64d05e709ce4b3465c6
