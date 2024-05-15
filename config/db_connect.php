<?php 

  // connect to db
  $conn = mysqli_connect('localhost', 'mike', 'PCLC1712', 'entertainment');

  // chk connection
  if (!$conn){
  	echo 'Connection Error : '. mysqli_connect_error();
  }

?>