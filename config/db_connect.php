<?php 

  // connect to db
<<<<<<< HEAD
  $conn = mysqli_connect('localhost','mike','test1234','sakila');
=======
  $conn = mysqli_connect('localhost', 'mike', 'PCLC1712', 'entertainment');
>>>>>>> da12d4a3991d2a067910c64d05e709ce4b3465c6

  // chk connection
  if (!$conn){
  	echo 'Connection Error : '. mysqli_connect_error();
  }

?>