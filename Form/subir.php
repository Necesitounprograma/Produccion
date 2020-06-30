
<?php 

	require_once '../core2.php';

 	$nombre_temporal = $_FILES['archivo']['tmp_name'];
 	$nombre = $_FILES['archivo']['name'];
 	move_uploaded_file($nombre_temporal, '../archivos/'.$nombre);
	
	$axcodmovcz= $_POST['txtcodmovczB']; 
	

	$Insertar ="UPDATE MAESTRO_CZ SET BOUCHER_DIGITAL='$nombre' WHERE COD_MOV='$axcodmovcz'";
	$result6=odbc_exec($con,$Insertar); 
	

 ?>

