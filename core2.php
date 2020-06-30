<?php 

session_start();

require_once '../conexion/conexion.php';

// echo $_SESSION['userId'];

if(!$_SESSION['userId']) {
	header('location: index.html');	
} 



?>