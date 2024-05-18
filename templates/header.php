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
            position: relative; /* Ensure positioning context */
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
            right: 10px; /* Adjusted to the right */
        }

    </style>
</head>
<body class="grey lighten-4">

<nav class="white z-depth-0">
  <div class="container nav-wrapper">
    <a href="Homepage.php" class="brand-logo brand-text">Sakila Database</a>
    
    <a href="#" class="sidenav-trigger" data-target="mobile-links">
      <i class="material-icons brand-text">menu</i> </a>
    
    <ul id="nav-mobile" class="right">
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

<style>
  .nav-wrapper {
    display: flex; /* Enable flexbox */
    justify-content: space-between; /* Space items evenly (alternative: flex-end) */
  }

  /* Maintain original styles (optional) */
  .brand-logo {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    left: 10px;
  }
</style>


<!-- Dropdown Structure -->
<ul id="mobile-links" class="sidenav">
    <li><a href="test_rental.php">Placing/Closing Rental</a></li>
    <li><a href="index_customer.php">Manage Customers</a></li>
    <li><a href="index_store.php">Manage Business</a></li>
    <li><a href="index_film.php">Manage Films</a></li>
</ul>

<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize the dropdown trigger for mobile screens
        var elems = document.querySelectorAll('.sidenav');
        var instances = M.Sidenav.init(elems, {});
    });
</script>

</body>
</html>
>>>>>>> 79b11c2 (Add new folder)
