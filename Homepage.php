<?php include('templates/header.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Sakila DVD Renting Company</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <main>
    <div class="container">
      <h1 class="center grey-text">Welcome to Sakila DVD Renting Company</h1>
      <div class="center">
      </div>
      <div class="center">
        <h3>Our Services</h3>
        <p>We offer a wide variety of DVDs for rent. Browse our collection and find the perfect movie for your night in!</p>
        <div class="links">
          <a href="index_store.php" class="btn brand z-depth-0">Add New Store</a>
          <a href="index_staff.php" class="btn brand z-depth-0">Manage Staff</a>
          <a href="rentals.php" class="btn brand z-depth-0">View Rentals</a>
          <a href="index_film.php" class="btn brand z-depth-0">Manage Films</a> </div>
      </div>
    </div>
  </main>

  <style>
    /* Option 1: Using line-height (adjust button height and line-height as needed) */
    .btn {
      line-height: 15px;
      text-align: center;
    }

    /* Option 2: Using Flexbox */
    /*.btn {
      display: flex;
      align-items: center;
      justify-content: center;
      text-align: center;
    }*/

    main {
      margin-bottom: 50px; /* Adjust the margin value as needed */
    }
  </style>

  <?php include('templates/footer.php'); ?>
</body>
</html>
