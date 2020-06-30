<?php  

require('../Imprimir/pdf_js.php');
require_once '../core2.php';


$param=$_POST['param'];


switch ($param) {

case '0': // listar usuarios

	$axidlocal = $_POST['txtlocales']; 
	$axidempresa = $_POST['txtidempresa']; 
	$axbuscar = $_POST['txtbuscar']; 

	if($axbuscar==""){

		$SQLProductotermiando ="SELECT TOP 12 * FROM INSUMOS_LISTA WHERE ID_EMPRESA='$axidempresa' AND ID_LOCAL ='$axidlocal' AND NOM_SUBCATEGORIA='PRODUCTO TERMINADO' ORDER BY NOM_COMERCIAL ASC";
	} else {

		$SQLProductotermiando ="SELECT TOP 12 * FROM INSUMOS_LISTA WHERE ID_EMPRESA='$axidempresa' AND ID_LOCAL ='$axidlocal' AND NOM_SUBCATEGORIA='PRODUCTO TERMINADO' AND NOM_COMERCIAL LIKE '%".$axbuscar."%' ORDER BY NOM_COMERCIAL ASC";
	}

	
	//echo $sql6;

	echo "
	<div id='div3'>
		<table class='table table-sm table-hover'>
		<thead class='thead-dark'>
		<tr>
			<th scope='col' style='text-align: center;'>It</th>
			<th scope='col' style='text-align: left;'>Descripción</th>
			<th scope='col' style='text-align: center;'>Accion</th>

		</tr>
		</thead>";
	
	$RSProductotermiando=odbc_exec($con,$SQLProductotermiando);	
	if ($RSProductotermiando){
 	
 	while ($row=odbc_fetch_array($RSProductotermiando)){ 
 		$it = $it+1;
 		$id_p= $row['ID_INSUMO'];
 		$insumo_p= $row['NOM_COMERCIAL'];
  	echo "

  		<tr>

 		<td style='text-align: center;'>".$it."</td>
 		<td style='text-align: left;'>".$row["NOM_COMERCIAL"]."</td>  			
 		<td style='text-align: center;'><button type='button' class='btn btn-outline-dark btn-sm' id='btver' data-nom_com_p='$insumo_p' data-id='$id_p' >Ver</button></td>

 		</tr>
 	";

}
echo "</table>
	
</div>

";
}

	
break;

case '1':
	
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

case '2':

	$axidlocal = $_POST['txtlocales']; 
	$axidempresa = $_POST['txtidempresa']; 


	$SQLInsumos ="SELECT * FROM INSUMOS_LISTA WHERE ID_EMPRESA='$axidempresa' AND ID_LOCAL ='$axidlocal' AND NOM_SUBCATEGORIA='INSUMOS' ORDER BY NOM_COMERCIAL ASC";
	$RSInsumos=odbc_exec($con,$SQLInsumos);
	
	echo "<select class='form-control custom-select mr-sm-2' id='txtidinsumo' name='txtidinsumo'>";
	echo "<option value='Seleccionar'>Seleccionar</option>";
	while($Ubig1=odbc_fetch_array($RSInsumos)){

    echo "<option value='".$Ubig1["ID_INSUMO"]."'";
    echo ">".$Ubig1["NOM_COMERCIAL"].' | '.$Ubig1['UNIDAD']."</option>";

	}
    
    echo "</select>";

break;

case '3':
	
	$axidlocal = $_POST['txtlocales']; 
	$axidinsumo_P = $_POST['axidinsumo']; 

	$SQLInsumosB ="SELECT * FROM PLANTILLAS WHERE ID_LOCAL ='$axidlocal' AND ID_INSUMO_P='$axidinsumo_P'";
	$RSInsumosB=odbc_exec($con,$SQLInsumosB);

	echo "

	<div class='form-row' style='float:right; align-content: right;'>
       	<div id='divbotonagregar' class='col-sm-12'>
		<button type='button' class='btn btn-outline-dark' id='btagregar'>Agregar</button>
		</div>
  	</div>
  	<br>
  	<p><hr/><p>	
	<div id='div3'>

		<table class='table table-sm table-hover'>
		<thead class='thead-dark'>
		<tr>
			<th scope='col' style='text-align: center;'>It</th>
			<th scope='col' style='text-align: left;'>Descripción</th>
			<th scope='col' style='text-align: center;'>Und</th>
			<th scope='col' style='text-align: right;'>Cant</th>
			<th scope='col' style='text-align: right;'>Precio</th>
			<th scope='col' style='text-align: right;'>Parcial</th>
			<th scope='col' style='text-align: center;'>Accion</th>

		</tr>
		</thead>";
	
		
 	while ($row=odbc_fetch_array($RSInsumosB)){ 
 		$it = $it+1;
 		$id_D= $row['ID_INSUMO_D'];
 		$id_P= $row['ID_INSUMO_P'];
 		$id_pl= $row['ID_PLANTILLA'];
  	echo "

  		<tr>
		<td style='text-align: center;'>".$it."</td>
 		<td style='text-align: left;'>".$row["NOM_COMERCIAL_D"]."</td>  			
 		<td style='text-align: center;'>".$row["UND_INSUMO"]."</td> 
 		<td style='text-align: right;'>".number_format($row["CANT_INSUMO"],2,".",",")."</td> 
 		<td style='text-align: right;'>".number_format($row["PRECIO_INSUMO"],2,".",",")."</td> 
 		<td style='text-align: right;'>".number_format($row["PARCIAL_INSUMO"],2,".",",")."</td> 
 		<td style='text-align: center;'><button type='button' class='btn btn-outline-dark btn-sm' id='btquitar' data-id='$id' data-id_plantilla='$id_pl' >Quitar</button></td>

 		</tr>

 		
 	";

}

	$SQLInsumosB1 ="SELECT SUM(PARCIAL_INSUMO) AS PC, MAX(PORC_GG_UT) AS GG FROM PLANTILLAS WHERE ID_LOCAL ='$axidlocal' AND ID_INSUMO_P='$axidinsumo_P'";
	$RSInsumosB1=odbc_exec($con,$SQLInsumosB1);
	while ($row1=odbc_fetch_array($RSInsumosB1)){

		$axprecio_costo = number_format($row1["PC"],2,".",",");
		$axporcentaje = $row1["GG"];
		$axporcentaje_1 = $row1["GG"] .'% Utilidad y Gastos' ;
		$axggut_1 = ($row1["PC"]*$axporcentaje)/100;
		$axggut = number_format($axggut_1,2,".",",");
		$axprecio_venta_1 = ($row1["PC"]+$axggut_1);
		$axprecio_venta =  number_format($axprecio_venta_1,2,".",",");
	}


	$SQLActualizainsumo_p = "UPDATE INSUMOS SET P_VENTA='$axprecio_venta_1', P_COMPRA='$axprecio_venta_1' WHERE ID_INSUMO = '$axidinsumo_P'";
	$RSActualizainsumo_p=odbc_exec($con,$SQLActualizainsumo_p);

echo "
		<tr>	
 		<th style='text-align: right;' colspan='5'><b>Precio Costo</b></th>
 		<th style='text-align: right;'>$axprecio_costo</th>
 		</tr>
 		<tr>	
 		<th style='text-align: right;' colspan='5'><b>$axporcentaje_1</b></th>
 		<th style='text-align: right;'>$axggut</th>
 		</tr>
 		<tr>	
 		<th style='text-align: right;' colspan='5'><b>Precio Venta</b></th>
 		<th style='text-align: right;'>$axprecio_venta</th>
 		</tr>


";
echo "</table>
	
</div>";



break;

case '4':

	$axidlocal = $_POST['txtlocales']; 
	$axid_insumo_d = $_POST['txtidinsumo_d']; 
	$axidempresa = $_POST['txtidempresa']; 

	$SQLInsumosB ="SELECT * FROM INSUMOS_LISTA WHERE ID_EMPRESA='$axidempresa' AND ID_LOCAL ='$axidlocal' AND NOM_SUBCATEGORIA='INSUMOS' AND ID_INSUMO ='$axid_insumo_d' ORDER BY NOM_COMERCIAL ASC";

	$RSInsumosB=odbc_exec($con,$SQLInsumosB);

	if(odbc_num_rows($RSInsumosB) > 0) {
    
      $axlistaprov1 = odbc_fetch_object($RSInsumosB);
      $axlistaprov1 ->status =200;
      echo json_encode($axlistaprov1);
      
  } else {

  		$error = array('status'=> 400);
  		echo json_encode((object) $error);
  }
	
break;

case '5':

	$axidlocal = $_POST['txtlocales']; 
	$axid_insumo_p = $_POST['txtidinsumo_p']; 
	$axnom_comerial_p = $_POST['txtnom_comercial_p']; 
	$axid_insumo_d = $_POST['txtidinsumo_d']; 
	$axnom_comerial_d = $_POST['txtnom_comercial_d']; 
	$axcant_insumo = $_POST['txtcant_insumo']; 
	$axprecio_insumo = $_POST['txtprecio_insumo']; 
	$axparcial_insumo = $_POST['txtparcial_insumo']; 
	$axunidad_d = $_POST['txtunidad_d']; 
	$axporc_ggut = $_POST['txtporc_ggut']; 
	
	

	$Insertar = "INSERT INTO PLANTILLAS (ID_LOCAL,ID_INSUMO_P,NOM_COMERCIAL_P,ID_INSUMO_D,NOM_COMERCIAL_D,CANT_INSUMO,PRECIO_INSUMO,PARCIAL_INSUMO,UND_INSUMO,PORC_GG_UT) VALUES ('$axidlocal','$axid_insumo_p','$axnom_comerial_p','$axid_insumo_d','$axnom_comerial_d','$axcant_insumo','$axprecio_insumo','$axparcial_insumo','$axunidad_d','$axporc_ggut')";
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

case '6':
	$axidlocal = $_POST['txtlocales']; 
	$axid_insumo_p = $_POST['txtidinsumo_p']; 
	$axporc_ggut = $_POST['txtporc_ggut']; 
	
	$sqlactual = "UPDATE PLANTILLAS SET PORC_GG_UT='$axporc_ggut' WHERE ID_LOCAL ='$axidlocal' AND ID_INSUMO_P='$axid_insumo_p'";

	$result6=odbc_exec($con,$sqlactual); 
	if($result6){
		$respuesta = 0;
		echo"$respuesta"; // grabado
	}else{
		$respuesta = 1;
		echo"$respuesta"; // no grabado
	}
break;

case '7':
	$axidlocal = $_POST['txtlocales']; 
	$axidplantilla = $_POST['axidplantilla']; 
		
	$SQLDelete = "DELETE FROM PLANTILLAS WHERE ID_PLANTILLA='$axidplantilla' AND ID_LOCAL='$axidlocal'";

	$RSDelete=odbc_exec($con,$SQLDelete); 
	if($RSDelete){
		$respuesta = 0;
		echo"$respuesta"; // Borrado
	}else{
		$respuesta = 1;
		echo"$respuesta"; // no borrado
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


function number_pad($number,$n) {
return str_pad((int) $number,$n,"0",STR_PAD_LEFT);
}

?>





