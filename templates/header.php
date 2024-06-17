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
  <li><a href="index_staff.php">Manage Staff</a></li>
  <li><a href="index_film.php">Manage Films</a></li>
  <li><a href="index_actor.php">View Actors & Actress</a></li>
  <li><a href="index_film_actor.php">View Actor & Actoress's filmography </a></li>
</ul>

<!-- Mobile Dropdown Structure -->
<ul id="mobile-links" class="sidenav">
    <li><a href="rentals.php">Placing/Closing Rental</a></li>
    <li><a href="index_customer.php">Manage Customers</a></li>
    <li><a href="index_store.php">Manage Business</a></li>
    <li><a href="index_staff.php">Manage Staff</a></li>
    <li><a href="index_film.php">Manage Films</a></li>
    <li><a href="index_actor.php">View Actors & Actress</a></li>
    <li><a href="index_film_actor.php">View Actor & Actoress's filmography </a></li>

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
