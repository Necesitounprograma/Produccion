<?php 
require_once 'Conexion/conexion.php';

//$axlocales = $_POST["txtlocales"];
$axrucempresa = $_POST["txtRuc"];


$sqlrucempresa = "SELECT top 1 RUC_EMPRESA FROM EMPRESA WHERE RUC_EMPRESA = '$axrucempresa'";
//echo "$sqlrucempresa";
$rsrucempresa=odbc_exec($con,$sqlrucempresa);


if(odbc_num_rows($rsrucempresa) > 0){

	$sqlrucusuario = "SELECT RUC_EMPRESA FROM USUARIOS_C WHERE RUC_EMPRESA = '$axrucempresa'";
	

	$rsrucusuario=odbc_exec($con,$sqlrucusuario);
	if(odbc_num_rows($rsrucusuario) > 0){

		$data = 1;
		echo "$data";//SI HAY USUARIOS ASIGNADOS		 

	} else {

		$data = 0;
		echo "$data"; //NO HAY USUARIOS ASIGNADOS
		
	}

		 
}else{

	   $data = 2;
		echo "$data";//EL RUC NO ESTA REGISTRADO EN LA BASE DATOS
	
}

//echo $output;


?>


