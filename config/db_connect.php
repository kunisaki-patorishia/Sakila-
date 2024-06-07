<?php 

  // connect to db
  $conn = mysqli_connect('localhost','mike','test1234','sakila');

  // chk connection
  if (!$conn){
  	echo 'Connection Error : '. mysqli_connect_error();
  }

?>