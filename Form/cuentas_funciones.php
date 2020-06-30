<?php  

require('../Imprimir/pdf_js.php');
require_once '../core2.php';


$param=$_POST['param'];


switch ($param) {

case '0': // listar usuarios

	$axidempresa = $_POST['txtidempresa']; 
	$axidlocal = $_POST['txtidlocal']; 
	$axbuscar = $_POST['txtbuscar']; 

	if($axbuscar==""){
		
		$sql6 ="SELECT NUM_CUENTA,BANCO_CUENTA,MONEDA_CTA,ID_CTA FROM CUENTA_BANCARIAS WHERE ID_LOCAL='$axidlocal' ORDER BY NUM_CUENTA";

	}else{

		$sql6 ="SELECT NUM_CUENTA,BANCO_CUENTA,MONEDA_CTA,ID_CTA FROM CUENTA_BANCARIAS WHERE ID_LOCAL='$axidlocal' AND  NUM_CUENTA  like '%".$axbuscar."%'";

	}
	
	//echo "$sql6";

	echo "
		<table class='table table-sm'>
		<thead>			
		<tr>
			<th scope='col' style='text-align: left;'>Cta. Numero</th>
			<th scope='col' style='text-align: left;'>Banco</th>
			<th scope='col' style='text-align: center;'>Moneda</th>
			<th scope='col'style='text-align: center;'>Acción</th>
		</tr>
		</thead>";
	
	$result6=odbc_exec($con,$sql6);
	
	if ($result6){
 	
 	while ($row=odbc_fetch_array($result6)){ 
 		$id = $row["ID_CTA"];
 	echo "
 		<tr> 		
 			<td  style='text-align: left;'>".$row["NUM_CUENTA"]."</td> 
 			<td  style='text-align: left;'>".$row["BANCO_CUENTA"]."</td> 
 			<td  style='text-align: center;'>".$row["MONEDA_CTA"]."</td> 
 			<td style='text-align: center;' ><a href='#' class='btn btn-outline-info btn-sm' id='bteditar' name='bteditar' data-id='$id' data-toggle='modal' data-target='.bd-example-modal-xl'>Editar</a></td> 
 		</tr>
 	";

}
echo "</table>";
}


	
break;

case '1':
	
	$axidcta = $_POST['txtidcta']; 
	$anumcuenta = $_POST['txtnumcuenta']; 
	$axbanco = $_POST['txtbanco']; 
	$axmoneda = $_POST['txtmoneda']; 
	$axcci = $_POST['txtcci']; 
	$axsaldoinicial = $_POST['txtsaldoinicial']; 
	$axsaldoactual = $_POST['txtsaldoactual']; 
	$axidlocal = $_POST['txtidlocal']; 
	$axcorrelativo = $_POST['txtcorrelativoconta']; 
	$axfechainicio = $_POST['txtfechainicio']; 
	$axparametros = $_POST['txtparametros']; 

	if($axparametros==1){

		$Insertar = "INSERT INTO CUENTA_BANCARIAS (NUM_CUENTA,BANCO_CUENTA,MONEDA_CTA,CCI_CUENTA,SALDO_INICIAL,SALDO_ACTUAL,ID_LOCAL,CORR_CONTABLE,FECHA_INICIO) VALUES 
			('$anumcuenta','$axbanco','$axmoneda','$axcci','$axsaldoinicial','$axsaldoactual','$axidlocal','$axcorrelativo','$axfechainicio')";
//echo "$Insertar";
		
	} else {

		$Insertar ="UPDATE CUENTA_BANCARIAS SET NUM_CUENTA='$anumcuenta',BANCO_CUENTA='$axbanco',MONEDA_CTA='$axmoneda',CCI_CUENTA='$axcci',SALDO_INICIAL='$axsaldoinicial',SALDO_ACTUAL='$axsaldoactual',ID_LOCAL='$axidlocal',CORR_CONTABLE='$axcorrelativo',FECHA_INICIO='$axfechainicio' WHERE ID_CTA='$axidcta'";
			
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
	
$axidcta= $_POST['axidcta'];
	
	$sql6 = "SELECT * FROM CUENTA_BANCARIAS WHERE ID_CTA = '$axidcta'";
	
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
	

	$sql6 = "SELECT * FROM MENU_ASIGNADO WHERE COD_USER = '$axiduser' and NOM_MENU='TOTAL'";
	$rspermisos=odbc_exec($con,$sql6);
	//echo $sql6;

	if(odbc_num_rows($rspermisos) == 1){

		$respuesta = 0;
		echo"$respuesta"; // ACCESO TOTAL

	} else {

		$sql7 = "SELECT * FROM MENU_ASIGNADO WHERE COD_USER = '$axiduser' and NOM_MENU='$axpermiso'";
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

function get_row($table,$col, $id, $equal){
	global $con;
	$querysql="select top 1 $col from $table where $id='$equal' order by $col desc";
	$query=odbc_exec($con,$querysql);
	$rw=odbc_fetch_array($query);
	$value=$rw[$col];
	return $value;
}


?>