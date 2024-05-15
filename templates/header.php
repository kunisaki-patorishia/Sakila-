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