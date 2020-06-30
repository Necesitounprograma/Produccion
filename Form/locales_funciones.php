 <?php  

require('../Imprimir/pdf_js.php');
require_once '../core2.php';


$param=$_POST['param'];


switch ($param) {

case '0': // listar usuarios

	$axidempresa = $_POST['txtidempresa']; 
	$axbuscaregistro = $_POST['txtbuscarlocal']; 

	if($axbuscaregistro==""){
		
		$sql6 ="SELECT * FROM LOCALES WHERE ID_EMPRESA='$axidempresa' ORDER BY DESCRICION_LC";

	}else{

		$sql6 ="SELECT * FROM LOCALES WHERE ID_EMPRESA='$axidempresa' AND DESCRICION_LC like '%".$axbuscaregistro."%' ";

	}
	
	//echo "$sql6";

	echo "
		<table class='table table-sm'>
		<thead>			
		<tr>
			<th scope='col'>Descripción</th>
			<th scope='col'>Ubicación</th>
			<th scope='col'>Acción</th>
		</tr>
		</thead>";
	
	$result6=odbc_exec($con,$sql6);
	
	if ($result6){
 	
 	while ($row=odbc_fetch_array($result6)){ 
 		$idlocal = $row["ID_LOCAL"];
 	echo "
 		<tr> 		
 			<td >".$row["DESCRICION_LC"]."</td> 
 			<td >".$row["UBICACION_LC"]."</td> 
 			<td ><a href='#' class='btn btn-outline-info btn-sm' id='bteditarlocal' name='bteditarlocal' data-idlocal='$idlocal' data-toggle='modal' data-target='.bd-example-modal-xl'>Editar</a></td> 
 		</tr>
 	";

}
echo "</table>";
}


	
break;

case '1':
	
	$axidlocal = $_POST['txtidlocal']; 
	$axidempresa = $_POST['txtidempresa']; 
	$axnomlocal = $_POST['txtnombrelocal']; 
	$axubicacion = $_POST['txtubicacion']; 
	$axlote = $_POST['txtlote_local']; 
	$axparametros = $_POST['txtparametros']; 

	if($axparametros==1){

		$Insertar = "INSERT INTO LOCALES (ID_EMPRESA,DESCRICION_LC,UBICACION_LC,ID_LOTE) VALUES ('$axidempresa','$axnomlocal','$axubicacion','$axlote')";
//echo "$Insertar";
		
	} else {

		$Insertar ="UPDATE LOCALES SET ID_EMPRESA='$axidempresa',DESCRICION_LC='$axnomlocal',UBICACION_LC='$axubicacion',ID_LOTE='$axlote' WHERE ID_LOCAL='$axidlocal'";
			
	}

	//echo "$Insertar";

	$result6=odbc_exec($con,$Insertar); 

	if($result6){

		$respuesta = 0;
		echo"$respuesta"; // grabado



	}else{
		
		$respuesta = 1;
		echo"$respuesta"; // no grabado

	}





break;


case '2':
	
$axidlocal= $_POST['axidlocal'];
	
	$sql6 = "SELECT * FROM LOCALES WHERE ID_LOCAL = '$axidlocal'";
	
	$result1=odbc_exec($con,$sql6);
	if(odbc_num_rows($result1) > 0) {
    
      $axlistaprov1 = odbc_fetch_object($result1);
      $axlistaprov1 ->status =200;
      echo json_encode($axlistaprov1);
      
  } else {

  		$error = array('status'=> 400);
  		echo json_encode((object) $error);
  }
	


break;

case '3':
	
	$axiduser = $_POST['txtcodusuario']; 	
	$axpermiso = $_POST['axpermiso']; 
	

	$sql6 = "SELECT * FROM MENU_ASIGNADO WHERE ID_USUARIO = '$axiduser' and NOM_MENU='TOTAL'";
	$rspermisos=odbc_exec($con,$sql6);
	//echo $sql6;

	if(odbc_num_rows($rspermisos) == 1){

		$respuesta = 0;
		echo"$respuesta"; // ACCESO TOTAL

	} else {

		$sql7 = "SELECT * FROM MENU_ASIGNADO WHERE ID_USUARIO = '$axiduser' and NOM_MENU='$axpermiso'";
		$rspermisos7=odbc_exec($con,$sql7);
		//echo $sql7;

		if(odbc_num_rows($rspermisos7) == 1){

			$respuesta = 0;
			echo"$respuesta"; // ACCESO TOTAL

		} else{

			$respuesta = 1;
			echo"$respuesta"; // NO TIENE ACCESO A ESTE MODULO
		}		

	}

	
break;


}
?>