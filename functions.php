<?php 

	$servername = "localhost";
	$username = "id155970_adix";
	$password = "adix2016";

try {
    $conn = new PDO("mysql:host=$servername;dbname=id155970_wims", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
?>