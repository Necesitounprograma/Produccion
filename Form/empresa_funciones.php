<?php  

require('../Imprimir/pdf_js.php');
require_once '../core2.php';


$param=$_POST['param'];


switch ($param) {

case '0': // listar usuarios

	$axbuscaregistro = $_POST['txtbuscarusuario']; 

	if($axbuscaregistro==""){
		
		$sql6 ="SELECT * FROM EMPRESA ORDER BY RAZON_SOCIAL";

	}else{

		$sql6 ="SELECT * FROM EMPRESA WHERE RAZON_SOCIAL like '%".$axbuscaregistro."%' ";

	}
	
	//echo "$sql6";

	echo "
		<table class='table table-hover'>
		<thead>			
		<tr>
			<th scope='col'>RAZON SOCIAL</th>
			<th scope='col'>ACCION</th>
		</tr>
		</thead>";
	
	$result6=odbc_exec($con,$sql6);
	
	if ($result6){
 	
 	while ($row=odbc_fetch_array($result6)){ 
 		$idempresa = $row["ID_EMPRESA"];
 	echo "
 		<tr> 		
 			<td >".$row["RAZON_SOCIAL"]."</td> 
 			<td ><a href='#' class='btn btn-outline-info' id='bteditarempresa' name='bteditarempresa' data-idempresa='$idempresa' data-toggle='modal' data-target='.bd-example-modal-xl'>Editar</a></td> 
 		</tr>
 	";

}
echo "</table>";
}


	
break;

case '1':
	

	$axruc = $_POST['txtruc']; 
	$axrazonsocial = $_POST['txtrazonsocial']; 
	$axdireccion = $_POST['txtdireccion']; 
	$axtelefono = $_POST['txttelefono']; 
	$axreplegal = $_POST['txtrepresentante']; 
	$axparametros = $_POST['txtparametros']; 

	if($axparametros==1){

		$Insertar = "INSERT INTO EMPRESA (RUC_EMPRESA,RAZON_SOCIAL,DIRECCION,TELEFONO,REP_LEGAL) VALUES ('$axruc','$axrazonsocial','$axdireccion','$axtelefono','$axreplegal')";
//echo "$Insertar";
		
	} else {

		$Insertar ="UPDATE EMPRESA SET RUC_EMPRESA='$axruc',RAZON_SOCIAL='$axrazonsocial',DIRECCION='$axdireccion',TELEFONO='$axtelefono',REP_LEGAL='$axreplegal' WHERE RUC_EMPRESA='$axruc'";
			
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
	
$axidempresa= $_POST['axidempresa'];
	
	$sql6 = "SELECT * FROM EMPRESA WHERE ID_EMPRESA = '$axidempresa'";
	
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