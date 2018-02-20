<?php
  $config = [
	'hostname' => 'localhost:3307',
	'username' => 'root',
	'password' => 'hilmil',
	'database' => 'bpr'
  ];
 
  $conn = mysqli_connect($config['hostname'], $config['username'], $config['password'], $config['database']);
  if (!$conn) {
	  die('database connection failed');
  }
?>