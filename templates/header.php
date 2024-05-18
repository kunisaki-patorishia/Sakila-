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
            display: flex; /* Enable flexbox */
            justify-content: space-between; /* Space items evenly */
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
          <option value="rentals.php">Placing/Closing Rental</option>
          <option value="index_customer.php">Manage Customers</option>
          <option value="index_store.php">Manage Business</option>
          <option value="index_film.php">Manage Films</option>
        </select>
      </li>
    </ul>
  </div>
</nav>

<!-- Dropdown Structure -->
<ul id="mobile-links" class="sidenav">
    <li><a href="rentals.php">Placing/Closing Rental</a></li>
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
