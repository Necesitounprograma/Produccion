<?php 
session_start();

require_once '../Conexion/conexion.php';

if(!$_SESSION['userId']) {
	
	header('location: ../index.html');	
} 



?>