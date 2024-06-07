<?php 
include('config/db_connect.php');

$manager_staff_id = 0;
$address = $address2 = $district = $city_name = $postal_code = $phone = '';

$error = array('manager_staff_id'=>'', 'address'=>'', 'address2'=>'', 'district'=>'', 'city_name'=>'', 'postal_code'=>'', 'phone'=>'');

	if (isset($_POST ['submit'])){		
		if(!empty($_POST['manager_staff_id'])){
			$manager_staff_id = $_POST['manager_staff_id'];

			// $sql3 = "SELECT count(*) from staff Where staff_id=$manager_staff_id";
			// echo '';
			// $result3 = mysqli_query($conn,$sql3);
			// print_r($result3);
			// $no_of_rows = mysqli_fetch_all($result3,MYSQLI_ASSOC);
			// print_r($no_of_rows);

			// if(mysqli_query($conn,$sql3)){}

		}

		// chk address
		if(empty($_POST['address'])){
			$error['address'] =  'Pls enter address <br />';
		} else {
			$address = $_POST['address'];
			if (!preg_match('/^[a-zA-Z0-9&-,.\s]+$/',$address)){
				$error['address'] = 'No special characters except space and &-,.';
			}
		}

		// chk address2 - allow NULL
		if(empty($_POST['address2'])){
			$address2 = $_POST['address2'];
		} else {
			$address2 = $_POST['address2'];
			if (!preg_match('/^[a-zA-Z0-9&-,.\s]+$/',$address2)){
				$error['address2'] = 'No special characters except space and &-,.';
			}
		}

		// chk district
		if(empty($_POST['district'])){
			$error['district'] =  'Please enter district <br />';
		} else {
			$district = $_POST['district'];
			if (!preg_match('/^[a-zA-Z0-9&-,.\s]+$/',$district)){
				$error['district'] = 'No special characters except space and &-,.';
			}
		}

		// chk city_name
		if(empty($_POST['city_name'])){
			$error['city_name'] =  'Please enter city_name <br />';
		} else {
			$city_name = $_POST['city_name'];
			if (!preg_match('/^[a-zA-Z0-9&-,.\s]+$/',$city_name)){
				$error['city_name'] = 'No special characters except space and &-,.';
			}
		}

		// chk postal_code - allow NULL
		if(empty($_POST['postal_code'])){
			$postal_code = $_POST['postal_code'];
		} else {
			$postal_code = $_POST['postal_code'];
			if (!preg_match('/^[0-9\s]+$/',$postal_code)){
				$error['postal_code'] = 'Only 5 numeric allowed';
			}
		}

		// chk phone 
		if(empty($_POST['phone'])){
			$error['phone'] =  'Please enter phone no <br />';
		} else {
			$phone = $_POST['phone'];
			if (!preg_match('/^[0-9-\s]+$/',$phone)){
				$error['phone'] = 'Only 20 numeric and - allowed';
			}
		}

		if (array_filter($error)){
			// there are errors in the form
		} else {
			$manager_staff_id = mysqli_real_escape_string($conn, $_POST['manager_staff_id']);
			//$address_id = mysqli_real_escape_string($conn, $_POST['address_id']);
			$address = mysqli_real_escape_string($conn, $_POST['address']);
			$address2 = mysqli_real_escape_string($conn, $_POST['address2']);
			$district = mysqli_real_escape_string($conn, $_POST['district']);
			$city_name = mysqli_real_escape_string($conn, $_POST['city_name']);
			$postal_code = mysqli_real_escape_string($conn, $_POST['postal_code']);
			$phone = mysqli_real_escape_string($conn, $_POST['phone']);

			// create sql code
			$sql = "INSERT INTO store (manager_staff_id, address, address2, district, city_name, postal_code, phone) VALUES('$manager_staff_id', '$address', '$address2', '$district', '$city_name', '$postal_code', '$phone')";

			// save to db and chk
			if(mysqli_query($conn, $sql)){
				// success
				header('Location: index_store.php');
			} else {
				// error - to be commented when code is ready
				echo 'query error: ' . mysqli_error($conn);
			}			
		} // end of if (array_filter($error))

	}  //end of POST check --- if (isset($_POST ['submit'])){


?>

 <!DOCTYPE html>
 <html>

 	<?php include('templates/header.php'); ?>
 	<section class="container grey-text">
 		<h4 class="center">Add New Store</h4>
 		<form class="white" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
 			<label>Managing Staff ID :</label>
 			<input type="number" name="manager_staff_id" min=1 max=10 required value="<?php echo htmlspecialchars($manager_staff_id); ?>">
 			<div class="red-text"><?php echo $error['manager_staff_id']; ?></div>
 			
 			<label>Store Address Line 1 :</label>
 			<input type="text" name="address" maxlength="50" required value="<?php echo htmlspecialchars($address); ?>">
 			<div class="red-text"><?php echo $error['address']; ?></div>

 			<label>Store Address Line 2 :</label>
 			<input type="text" name="address2" maxlength="50" value="<?php echo htmlspecialchars($address2); ?>">
 			<div class="red-text"><?php echo $error['address2']; ?></div>

 			<label>District :</label>
 			<input type="text" name="district" maxlength="20" required value="<?php echo htmlspecialchars($district); ?>">
 			<div class="red-text"><?php echo $error['district']; ?></div>

 			<label>Store city_name :</label>
 			<input type="text" name="city_name" maxlength="40" required value="<?php echo htmlspecialchars($city_name); ?>">
 			<div class="red-text"><?php echo $error['city_name']; ?></div>

 			<label>Store postal_code :</label>
 			<input type="text" name="postal_code" maxlength="5" value="<?php echo htmlspecialchars($postal_code); ?>">
 			<div class="red-text"><?php echo $error['postal_code']; ?></div>

 			<label>Store phone :</label>
 			<input type="text" name="phone" maxlength="20" required value="<?php echo htmlspecialchars($phone); ?>">
 			<div class="red-text"><?php echo $error['phone']; ?></div> 			

			<div class="center">
				<input type="submit" name="submit" value="submit" class="btn brand z-depth-0">
			</div>			
 		</form>
 	</section>

 	<?php include('templates/footer.php'); ?>

 </html>
