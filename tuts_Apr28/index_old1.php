<?php 
//	echo "Hello, ninjas";
// define constant 
	define('COMPANY_NAME', 'Sakila DVD Renting Company');
// define variables by initialising a value to it
	$store_id = 1;
	$staff_id =1;
// string - tutorial #5
	$stringOne = "Store Name ";
	$stringTwo = "Staff Name  ";

 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title>My First PHP
 	</title>
 </head>
 <body>
 	<h1>SAKILLA DVD RENTING SYSTEM</h1>
 	<div><?php echo COMPANY_NAME; ?></div>
	<div><?php echo $stringOne.$store_id; ?></div>
	<div><?php echo 'Store Name(single quote) '.$store_id; ?></div>
	<div><?php echo "Store Name(double quote) $store_id"; ?></div>
	<div><?php echo "Store Name(escape character) \"Sakila Canada !\""; ?></div>
	<div><?php echo $stringTwo[0] . $stringTwo[1] . $stringTwo[2] . $stringTwo[3]; ?></div>
 	<div><?php echo $stringTwo . $staff_id; ?></div>
 	<div><?php 
 	echo strlen($stringOne);
 	echo strlen($stringTwo);
 	$radius = 25;
 	$pi = 3.14;
 	// order of operation (B I D M A S)
 	// order of operation (Bracket Indices Divide Mulitiply Addition Subtraction)
 	$radius++;
 	echo $radius;
 	?></div>
 	<div><?php 
 	$p_amount = 3.99;
 	echo "Payment amount = $p_amount\n";
 	$overdue = 3;
 	echo "Overdue = $overdue\n";
 	//$p_amount = $p_amount + ($overdue*1);
	//echo "New Payment amount = $p_amount\n";
	$p_amount += ($overdue*1);
	echo "New Payment amount2 = $p_amount\n";
 	
 	// overdue=floor (return_date - rental_date)
 	//$rental_date = datetime(2021-04-01 22:00:00);
 	//echo "rental_date = $rental_date";



 	 ?></div>
 </body>
 </html>