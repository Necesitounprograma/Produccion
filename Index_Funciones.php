<?php 
require_once 'Conexion/conexion.php';

//$axlocales = $_POST["txtlocales"];


$param=$_POST['param'];

/*


*/

switch ($param) {

case '0': //verifica NUM DE RUC EN INDEX.HTML

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



break;

case '1': // VERIFICA DUPLICIDAD DE RUC EN EMPRESA

$sqlduplicidad = "SELECT top 1 RUC_EMPRESA FROM EMPRESA WHERE RUC_EMPRESA = '$axrucempresa'";
$rsduplicidad=odbc_exec($con,$sqlduplicidad);

if(odbc_num_rows($rsduplicidad) == 1){
	
		$data = 0;
		echo "$data"; //EXISTE

	} else {
		$data = 1;
		echo "$data"; //NO EXISTE	
	}


break;

case '2': // GRABAR USUARIOS

	$axrucempresa=$_POST['txtrucempresa'];
	$axidempresa =$_POST['txtidempresa'];
	$axdniuser= $_POST['txtdni'];
	$axapellidos= $_POST['txtapellidos'];
	$axusuario= $_POST['txtuser'];
	$axclave= $_POST['txtclave'];
	$axclargo= $_POST['txtcargo'];
	//$axfecharegistro= getdate();

	$axfecharegistro = date('j-n-Y');

   $sqlgrabarusuario = "INSERT INTO USUARIO (ID_EMPRESA,COD_USER,NOM_USUARIO,USUARIO,CLAVE,CARGO,F_REGISTRO,CONDICION) VALUES ('$axidempresa','$axdniuser','$axapellidos','$axusuario','$axclave','$axclargo','$axfecharegistro',1)";
  //  echo "$sqlgrabarusuario";
    $rsgrabarusuario=odbc_exec($con,$sqlgrabarusuario);

    if($rsgrabarusuario){

    	$sqlusuario1 = "INSERT INTO USUARIO_MODULO (COD_USER,MODULO,ID_EMPRESA) VALUES ('$axdniuser','ARTICULOS','$axidempresa')";
    	$rsusuarios1=odbc_exec($con,$sqlusuario1); 

    	$sqlusuario2 = "INSERT INTO USUARIO_MODULO (COD_USER,MODULO,ID_EMPRESA) VALUES ('$axdniuser','CATEGORIAS','$axidempresa')";
    	$rsusuarios2=odbc_exec($con,$sqlusuario2); 

    	//$sqlusuario5 = "INSERT INTO USUARIO_MODULO (COD_USER,MODULO,ID_EMPRESA) VALUES ('$axdniuser','CATEGORIAS','$axidempresa')";
    	//$rsusuarios5=odbc_exec($con,$sqlusuario5); 

    	$sqllocales = "INSERT INTO TIENDAS (RUC_EMPRESA,NOM_ALMACEN,UBICACION,CONDICION,ID_EMPRESA) VALUES ('$axrucempresa','LOCAL DE PRUEBA','0',1,'$axidempresa')";
		$rslocales=odbc_exec($con,$sqllocales); 


		$sqllocales1 = "SELECT top 1 * FROM TIENDAS WHERE NOM_ALMACEN = 'LOCAL DE PRUEBA'";
		$rslocales1=odbc_exec($con,$sqllocales1);

    	if(odbc_num_rows($rslocales1) == 1) {

    		$value1 = odbc_fetch_array($rslocales1);
      		$axcodlocal = $value1['COD_ALMACEN'];	
      		$axnomlocal = $value1['NOM_ALMACEN'];	

      		$sqlusuario3 = "INSERT INTO USUARIO_DT (COD_USER,COD_ALMACEN,NOM_ALMACEN) VALUES ('$axdniuser','$axcodlocal','$axnomlocal')";
    		$rsusuarios3=odbc_exec($con,$sqlusuario3); 
    	}
      
      	$data =0;
    	echo "$data"; //GRABADO	


	
	} else {

		$data =1;
    	echo "$data"; //NO GRABADO	

	}

    	


break;

case '3' :
$axrucempresa1 = $_POST["txtrucempresa"];

$sqlrucempresa = "SELECT top 1 * FROM EMPRESA WHERE RUC_EMPRESA = '$axrucempresa1'";
$rsrucempresa=odbc_exec($con,$sqlrucempresa);
	
	if(odbc_num_rows($rsrucempresa) > 0) {
      $axlistaprov1 = odbc_fetch_object($rsrucempresa);
      $axlistaprov1 ->status =200;
      echo json_encode($axlistaprov1);
      
  } else {

  		$error = array('status'=> 400);
  		echo json_encode((object) $error);
  	

  }


break;


}

?>


