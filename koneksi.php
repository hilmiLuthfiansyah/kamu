<?php
    $config = [
    'hostname' => 'localhost:3306',
    'username' => 'meiko',
    'password' => 'meiko',
    'database' => 'pudbpr'
    ];
 
	$conn = mysqli_connect($config['hostname'], $config['username'], $config['password'], $config['database']);
	if (!$conn) {
		die('database connection failed');
	}
?>