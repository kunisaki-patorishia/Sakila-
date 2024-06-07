<?php 
	// ternary operators, tut #34
	// e.g. chk figure enter for customer.deposit
	//$deposit = 500;

	// if($deposit >100){
	// 	echo 'Deposit amount entered too high !';
	// } else {
	// 	echo 'Deposit amount entered successfully';
	// }

	 // $val = $deposit > 100 ? 'Deposit amount entered too high !' : 'Deposit amount entered successfully';
	 // echo $val;

	// echo $deposit > 100 ? 'Deposit amount entered too high !' : 'Deposit amount entered successfully';

// superglobals, tut #35'
// $_GET['name'], $_POST['name']

echo $_SERVER['SERVER_NAME'] . '<br />';        // localhost
echo $_SERVER['REQUEST_METHOD'] . '<br />';		// GET
echo $_SERVER['SCRIPT_FILENAME'] . '<br />';	// C:/xampp/htdocs/tuts/sandbox.php
echo $_SERVER['PHP_SELF'] . '<br />';			// /tuts/sandbox.php

// session superglobals, tut #36
if(isset($_POST['submit'])){

	session_start();

	if($_SERVER['QUERY_STRING'] == 'noname'){
		unset($_SESSION['name']); // unset  or clear single variable
		// unset or clear all superglobal variables tuto #36
		//session_unset();
	}
	$name = $_SESSION['name'];

	$_SESSION['name'] = $_POST['name'];
	$_SESSION['staff_id'] = $_POST['staff_id'];
	$_SESSION['store_id'] = $_POST['store_id'];


	echo $_SESSION['name'];
	header('Location: index.php');
}


?>

<!DOCTYPE html>
<html>
<head>
	<title>php tutorials</title>
</head>
<body>
	<!--Tutorial #34 -->
<!--<p><?php echo $deposit > 100 ? 'Deposit amount entered too high !' : 'Deposit amount entered successfully'; ?></p>-->

<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
<!-- 	<input type="text" name="name">
	<input type="submit" name="submit" value="submit"> -->
	<input type="text" name="staff_id">
	<input type="text" name="store_id">
	<input type="submit" name="submit" value="submit"> 

</form>
</body>
</html>