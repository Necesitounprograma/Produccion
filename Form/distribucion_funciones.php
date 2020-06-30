<?php  

require('../Imprimir/pdf_js.php');
require_once '../core2.php';


$param=$_POST['param'];


switch ($param) {

case '0': // listar usuarios

	$axidlocal = $_POST['txtidlocal']; 
	$axbuscar = $_POST['txtbuscar'];
	$axordenar = $_POST['txtordenar']; 
	$axsubcategoria = $_POST['txtsubcategoria']; 
	
		
	if($axbuscar ==""){

		if($axordenar==0){

			$sql6 ="SELECT  * FROM INSUMOS_LISTA WHERE  ID_LOCAL='$axidlocal' AND ID_CATEGORIAS='$axsubcategoria'  ORDER BY STOCK_ACTUAL ASC";	

		}else{

			$sql6 ="SELECT  * FROM INSUMOS_LISTA WHERE  ID_LOCAL='$axidlocal' AND ID_CATEGORIAS='$axsubcategoria' ORDER BY STOCK_ACTUAL DESC";	

		}
		
	} else {

		if($axordenar==0){
			$sql6 ="SELECT  * FROM INSUMOS_LISTA WHERE  ID_LOCAL='$axidlocal' AND ID_CATEGORIAS='$axsubcategoria' AND NOM_COMERCIAL LIKE '%".$axbuscar."%' ORDER BY STOCK_ACTUAL ASC";	
		}else{
			$sql6 ="SELECT  * FROM INSUMOS_LISTA WHERE  ID_LOCAL='$axidlocal' AND ID_CATEGORIAS='$axsubcategoria' AND NOM_COMERCIAL LIKE '%".$axbuscar."%' ORDER BY STOCK_ACTUAL DESC";
		}

		
	}
	//echo $sql6;
	$result6=odbc_exec($con,$sql6);	
	if ($result6){ 	
		
	echo '
		<div id="div3">
		<table class="table table-hover table-sm">
		
		<thead class="thead-dark">
		
		<tr>
			<th scope="col" style="text-align: center;">IT</th>
			<th scope="col" style="text-align: center;">CODIGO</th>
			<th scope="col" style="text-align: left;">DESCRIPCION PRODUCTO | INSUMO</th>
			<th scope="col" style="text-align: center;">UNIDAD</th>
			<th scope="col" style="text-align: right;">STOCK INICIAL</th>
			<th scope="col" style="text-align: right;">INGRESOS</th>
			<th scope="col" style="text-align: right;">SALIDAS</th>
			<th scope="col" style="text-align: right;">STOCK ACTUAL</th>
			<th scope="col" style="text-align: right;">STOCK MINIMO</th>
			<th scope="col" style="text-align: center;">ACCION</th>

		</tr>
		</thead>';
	

 	while ($row=odbc_fetch_array($result6)){  	
 	$axit=$axit+1;
 	$id_insumos = str_pad($row['ID_INSUMO'], 6, "0", STR_PAD_LEFT);
 	$ingresos = 0;
 	$salidas=0;
 	$axstock_actual= $row['STOCK_ACTUAL'];
 	$axstock_minimo= $row['STOCK_MINIMO'];

 	$ingresos = get_row('STOCK_ACTUAL','INGRESO','ID_INSUMO',$id_insumos);
 	$salidas = get_row('STOCK_ACTUAL','SALIDA','ID_INSUMO',$id_insumos);
 		

	echo'<tr>
		<td style="text-align: center;">'.$axit.'</td>
		<td style="text-align: center;">'.$id_insumos.'</td>
		<td style="text-align: left;">'.$row["NOM_COMERCIAL"].'</td>
		<td style="text-align: center;">'.$row["UNIDAD"].'</td>		
		<!--td class="text-primary" style="text-align: right;">'.number_format($row["STOCK_INICIAL"],2,".",",").'</td-->
		<td contenteditable class="text-primary" style="text-align: right;" id="btmodificar_stock_inicial" data-id_insumo='.$row['ID_INSUMO'].'>'.number_format($row["STOCK_INICIAL"],2,".",",").'</td>
		<td class="text-primary" style="text-align: right;">'.number_format($ingresos,2,".",",").'</td>
		<td class="text-danger" style="text-align: right;">'.number_format($salidas,2,".",",").'</td>';

	if($axstock_actual < $axstock_minimo || $axstock_actual==0 ){

		echo '<td class="text-danger" style="text-align: right;">'.number_format($row["STOCK_ACTUAL"],2,".",",").'</td>';
	}else{
		echo '<td class="text-success" style="text-align: right;">'.number_format($row["STOCK_ACTUAL"],2,".",",").'</td>';
	}
	
	

	echo'
		<td contenteditable class="text-primary" style="text-align: right;" id="btmodificar_stock_minimo" data-id_insumo='.$row['ID_INSUMO'].'>'.number_format($row["STOCK_MINIMO"],2,".",",").'</td>
		<td style="text-align: center;">
			<button class="btn btn-outline-danger btn-sm" type="button" id="btkardex_insumo" data-id_insumo='.$row['ID_INSUMO'].'> Kardex</button>
    	</td>			
		
		</tr>';
	};
  	
	echo'
	</table>
	</div>';

} else {

	echo 0;
	//echo $output;
}

	
break;

case '1':
	
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

case '2':
	
	$axid_insumo_in = $_POST['axid_insumo_in']; 
	$axstock_inicial = $_POST['axstock_inicial']; 
	$axidlocal = $_POST['txtidlocal']; 

	$sqlbuscar = "SELECT * FROM STOCK_ACTUAL WHERE ID_LOCAL = '$axidlocal' AND ID_INSUMO='$axid_insumo_in'";
	$rsbuscar=odbc_exec($con,$sqlbuscar);
	//echo $sqlbuscar;

	if(odbc_num_rows($rsbuscar) > 0){

		while ($row=odbc_fetch_array($rsbuscar)){

			$axstock = $row['STOCK'];
			$axstock_actual = $axstock+$axstock_inicial;

			$SQLActualizar = "UPDATE INSUMOS SET STOCK_INICIAL='$axstock_inicial',STOCK_ACTUAL='$axstock_actual' WHERE ID_INSUMO='$axid_insumo_in' AND ID_LOCAL='$axidlocal'";
			$RSActualizar = odbc_exec($con, $SQLActualizar);

			//echo $SQLActualizar;

		}
			
	} else{

			$axstock = 0;
			$axstock_actual = $axstock+$axstock_inicial;

			$SQLActualizar = "UPDATE INSUMOS SET STOCK_INICIAL='$axstock_inicial',STOCK_ACTUAL='$axstock_actual' WHERE ID_INSUMO='$axid_insumo_in' AND ID_LOCAL='$axidlocal'";
			$RSActualizar = odbc_exec($con, $SQLActualizar);

			//echo $SQLActualizar;
	}


break;

case '3':
	

	$axid_insumo_mi = $_POST['axid_insumo_mi']; 
	$axstock_minimo = $_POST['axstock_minimo']; 
	$axidlocal = $_POST['txtidlocal']; 

	$SQLActualizar = "UPDATE INSUMOS SET STOCK_MINIMO='$axstock_minimo' WHERE ID_INSUMO='$axid_insumo_mi' AND ID_LOCAL='$axidlocal'";
	$RSActualizar = odbc_exec($con, $SQLActualizar);

	if($RSActualizar){

		$respuesta = 0;
		echo"$respuesta"; // ACTUALIZADO

	}else{

		$respuesta = 1;
		echo"$respuesta"; // ACTUALIZADO

	}


break;

case '4':
	
	$axbuscarcliente = $_POST["txtnom_proveedor"];
	
	if(isset($_POST["txtnom_proveedor"])){

	$output ='';
	$idprov ='';

	$sql9 = "SELECT TOP 5 * FROM BENEFICIARIO WHERE RUC_BENEF+NOM_PROVEEDOR LIKE  '%".$axbuscarcliente."%' AND TIPO_PROV_CLIE='PROVEEDOR'";
	//echo "$sql9";

	$result1=odbc_exec($con,$sql9);
	$output ='<ul id="ulclientes" class="list-unstyled ul">';

	if(odbc_num_rows($result1) > 0){
		 while ($row=odbc_fetch_array($result1)){

		 	$output .='<li id="liclientes" class="li" data-idbenef='.$row["ID_BENEFICIARIO"].'>'.$row["RUC_BENEF"].' | '.$row["NOM_PROVEEDOR"].'</li>';

		 }

	}else{
		$output .='';
		//$output .='<li id="linuevoregistro" class="li" data-toggle="modal" data-target=".bd-example-modal-xl">'.$_POST["txtnom_cliente"]. '(Registrar)</li>';

		
		
	}

	$output .='</ul>';
	echo $output;


}

break;

case '5':
	
	$axid_logistica_cz = $_POST["txtid_logistica_cz"];
	$axidlocal = $_POST["txtidlocal"];
	$axtipodoc = $_POST["txttipo_doc"];
	$axnum_documento = $_POST["txtnum_documento"];
	$axidbeneficiario = $_POST["txtidbeneficiario"];
	$axfecha_emision = $_POST["txtfecha_emision"];
	$axfecha_entrega = $_POST["txtfecha_entrega"];
	$axhora_entrega = $_POST["txthora_entrega"];
	$axforma_pago = $_POST["txtforma_pago"];
	$axdias_pago = $_POST["txtdias_pago"];
	$axfecha_pago = $_POST["txtfecha_pago"];
	$axmedio_pago = $_POST["txtmedio_pago"];
	$axestado_forma_pago = $_POST["txtestado_pago"];
	$axsolicitante = $_POST["txtsolicitado_por"];
	$axparametros = $_POST["txtparametro"];

	if($axparametros==0){

		$SQLGrabar = "INSERT INTO LOGISTICA_CZ (ID_LOGISTICA_CZ,ID_LOCAL,TIPO_DOCUMENTO,NUM_DOCUMENTO,ID_BENEFICIARIO,FECHA_EMISION,FECHA_ENTREGA,HORA_ENTREGA,FORMA_PAGO,DIAS_PAGO,FECHA_PAGO,MEDIO_PAGO,ESTADO_FORMA_PAGO,SOLICITADO_POR) VALUES ('$axid_logistica_cz','$axidlocal','$axtipodoc','$axnum_documento','$axidbeneficiario','$axfecha_emision','$axfecha_entrega','$axhora_entrega','$axforma_pago','$axdias_pago','$axfecha_pago','$axmedio_pago','$axestado_forma_pago','$axsolicitante')";

	}else{

		$SQLGrabar = "UPDATE LOGISTICA_CZ SET ID_LOCAL='$axidlocal',TIPO_DOCUMENTO='$axtipodoc',NUM_DOCUMENTO='$axnum_documento',ID_BENEFICIARIO='$axidbeneficiario',FECHA_EMISION='$axfecha_emision',FECHA_ENTREGA='$axfecha_entrega',HORA_ENTREGA='$axhora_entrega',FORMA_PAGO='$axforma_pago',DIAS_PAGO='$axdias_pago',FECHA_PAGO='$axfecha_pago',MEDIO_PAGO='$axmedio_pago',ESTADO_FORMA_PAGO='$axestado_forma_pago',SOLICITADO_POR='$axsolicitante' WHERE ID_LOGISTICA_CZ='$axid_logistica_cz'";

	}

		$RSGrabar = odbc_exec($con, $SQLGrabar);

		if($RSGrabar){

			$respuesta = 0;
			echo"$respuesta"; // se graBO

		}else{

			$respuesta = 1;
			echo"$respuesta"; // NO SE GRABO

		}




break;

case '6':
	
	$axidlocal = $_POST['txtidlocal']; 
	$axbuscar = $_POST['txtbuscar_insumo_comprar'];
	$axordenar = $_POST['txtordenar']; 
		
	if($axbuscar ==""){

		$sql6 ="SELECT TOP 10 * FROM INSUMOS_LISTA WHERE  ID_LOCAL='$axidlocal'  ORDER BY STOCK_ACTUAL ASC";	

		
	} else {

		$sql6 ="SELECT TOP 10 * FROM INSUMOS_LISTA WHERE  ID_LOCAL='$axidlocal'  AND NOM_COMERCIAL LIKE '%".$axbuscar."%' ORDER BY STOCK_ACTUAL DESC";
		
	}
	//echo $sql6;
	$result6=odbc_exec($con,$sql6);	
	if ($result6){ 	
		
	echo '
		<div id="div3">
		<table class="table table-hover table-sm">
		
		<thead class="thead-default">
		
		<tr>
			<th scope="col" style="text-align: center;">CODIGO</th>
			<th scope="col" style="text-align: left;">DESCRIPCION PRODUCTO | INSUMO</th>
			<th scope="col" style="text-align: center;">UND</th>
			<th scope="col" style="text-align: center;">ACCION</th>

		</tr>
		</thead>';
	

 	while ($row=odbc_fetch_array($result6)){  	
 	$axit=$axit+1;
 	$id_insumos = str_pad($row['ID_INSUMO'], 6, "0", STR_PAD_LEFT);
 	//$id_insumos = $row['COD_INSUMO'];
 	
 	echo'<tr>
		<td style="text-align: center;">'.$id_insumos.'</td>
		<td style="text-align: left;">'.$row["NOM_COMERCIAL"].'</td>
		<td style="text-align: center;">'.$row["UNIDAD"].'</td>		
		<td style="text-align: center;">
			<button class="btn btn-outline-primary btn-sm" type="button" id="btagregar_insumo_comprar" data-id_insumo='.$row['ID_INSUMO'].' data-pr_compra='.$row['P_COMPRA'].'> <i class="far fa-hand-point-right"></i> </button>
    	</td>			
		
		</tr>';
	};

	
	echo'
	</table>
	</div>';

} 
break;

case '7':
	
	$axid_logistica_cz = $_POST['txtid_logistica_cz']; 
	$axid_insumo = $_POST['axid_insumo']; 
	$axcant_compra = $_POST['txtcant_insumo_comprar']; 
	$axprecio_compra = $_POST['axprecio_compra']; 
	$axvalor_compra = $_POST['axvalor_compra']; 
	$axigv_compra = $_POST['axigv_compra']; 
	$axtotal_compra= $_POST['axtotal_compra']; 

	$SQLAgregar = "INSERT INTO LOGISTICA_DT (ID_LOGISTICA_CZ,ID_INSUMO,CANT_COMPRA,PRECIO_C,VALOR_INGRESO,IGV_INGRESO,TOTAL_INGRESO)VALUES('$axid_logistica_cz','$axid_insumo','$axcant_compra','$axprecio_compra','$axvalor_compra','$axigv_compra','$axtotal_compra')";
	$RSAgregar = odbc_exec($con, $SQLAgregar);

	if($RSAgregar){

		$respuesta=0;
		echo $respuesta;

	}else{

		$respuesta=1;
		echo $respuesta;

	}

break;

case '8':
	
	$axidlocal = $_POST['txtidlocal']; 
	$axid_logistica_cz = $_POST['txtid_logistica_cz'];
	
	$sql6 ="SELECT * FROM LOGISTICA_DOCUMENTOS WHERE  ID_LOCAL='$axidlocal' AND ID_LOGISTICA_CZ='$axid_logistica_cz'  ORDER BY NOM_COMERCIAL ASC";	
	//echo $sql6;

	$result6=odbc_exec($con,$sql6);	
	if ($result6){ 	
		
	echo '
		<div id="div3">
		
		<div class="form-row" >		  
		  	<div  class="col-sm-6" >
			  	<div class="input-group mb-3">
				  <!--input type="text" class="form-control" placeholder="Asignar Cod. Producción" id="txtcod_produccion">
				  <div class="input-group-append">
					  <button class="btn btn-outline-success" type="button" id="btasignar_cod_produccion">Asignar</button>
				  </div-->
				  	<button class="btn btn-outline-primary" type="button" data-id_log_cz='.$axid_logistica_cz.' id="btimprimir_docu">Imprimir</button>
				  	<button class="btn btn-outline-danger" type="button" id="btcancelar_2">Retornar</button>
				  	
				</div>
			</div>
		</div>
		

		<table class="table table-hover table-sm">
		
		<thead class="thead-default">
		
		<tr>
			<th scope="col" style="text-align: center;">No</th>
			<th scope="col" style="text-align: center;">CODIGO</th>
			<th scope="col" style="text-align: left;">DESCRIPCION PRODUCTO | INSUMO</th>
			<th scope="col" style="text-align: center;">UND</th>
			<th scope="col" style="text-align: right;">CANTIDAD <i class="fas fa-pencil-alt"></i></th>
			<th scope="col" style="text-align: right;">PRECIO <i class="fas fa-pencil-alt"></i></th>
			<th scope="col" style="text-align: right;">PARCIAL</th>
			<th scope="col" style="text-align: center;">ACCION</th>

		</tr>
		</thead>';
	

 	while ($row=odbc_fetch_array($result6)){  	
 	$axit=$axit+1;
 	$id_insumos = str_pad($row['ID_INSUMO'], 6, "0", STR_PAD_LEFT);
 	//$id_insumos = $row['COD_INSUMO'];
 	
 	echo'<tr>

 		<td style="text-align: center;">'.$axit.'</td>
		<td style="text-align: center;">'.$id_insumos.'</td>
		<td style="text-align: left;">'.$row["NOM_COMERCIAL"].'</td>
		<td style="text-align: center;">'.$row["PRES_ABREV"].'</td>		
		<td contenteditable class="text-danger" style="text-align: right;" data-id_insumo='.$row['ID_INSUMO'].' id="cant_modificar">'.number_format($row["CANT_COMPRA"],2,".",",").'</td>
		<td contenteditable class="text-danger" style="text-align: right;" data-id_insumo='.$row['ID_INSUMO'].' id="precio_modificar">'.number_format($row["PRECIO_C"],2,".",",").'</td>
		<td style="text-align: right;">'.number_format($row["VALOR_INGRESO"],2,".",",").'</td>
		<td style="text-align: center;">
			<button class="btn btn-outline-primary btn-sm" type="button" id="btquitar_insumo_comprar" data-id_insumo='.$row['ID_INSUMO'].'> <i class="fas fa-trash"></i> </button>
    	</td>			
		
		</tr>';
	};

	$SQLTotales ="SELECT SUM(VALOR_INGRESO) AS VV, SUM(IGV_INGRESO) AS IG, SUM(TOTAL_INGRESO) AS TC FROM LOGISTICA_DT WHERE  ID_LOGISTICA_CZ='$axid_logistica_cz'";
	$RSTotales=odbc_exec($con,$SQLTotales);

	while ($row1=odbc_fetch_array($RSTotales)){

		$axvalor_compra = number_format($row1["VV"],2,".",",");
		$axigv_compra = number_format($row1["IG"],2,".",",");		
		$axtotal_compra = number_format($row1["TC"],2,".",",");

	}

	echo "

		<tr>	
 		<th style='text-align: right;' colspan='6'><b>VALOR VENTA</b></th>
 		<th style='text-align: right;'><b>$axvalor_compra</b></th>
 		</tr>
 		<tr>	
 		<th style='text-align: right;' colspan='6'><b>IGV</b></th>
 		<th style='text-align: right;'><b>$axigv_compra</b></th>
 		</tr>
 		<tr>	
 		<th style='text-align: right;' colspan='6'><b>TOTAL</b></th>
 		<th style='text-align: right;'><b>$axtotal_compra</b></th>
 		</tr>


	";
  	
  	
	echo'
	</table>
	</div>';

} 

break;

case '9':

	$axid_insumo = $_POST['axid_insumo']; 
	$axid_logistica_cz = $_POST['txtid_logistica_cz'];
	
	$sql6 ="DELETE FROM LOGISTICA_DT WHERE ID_INSUMO='$axid_insumo' and ID_LOGISTICA_CZ='$axid_logistica_cz'";	
	$result6=odbc_exec($con,$sql6);	
	
	if ($result6){

		$respuesta=0;
		echo $respuesta;
	}else{

		$respuesta=1;
		echo $respuesta;
	}


break;

case '10':
	
	$axidlocal = $_POST['txtidlocal']; 
	$axbuscar_documento = $_POST['txtbuscar_documento']; 
	//$axid_logistica_cz = $_POST['txtid_logistica_cz'];

	if($axbuscar_documento==""){

		$sql6 ="SELECT * FROM LOGISTICA_DOCUMENTOS_CZ WHERE  ID_LOCAL='$axidlocal'  ORDER BY FECHA_EMISION ASC";		

	}else{

		$sql6 ="SELECT * FROM LOGISTICA_DOCUMENTOS_CZ WHERE  ID_LOCAL='$axidlocal'  AND RUC_BENEF+NOM_PROVEEDOR+NUM_DOCUMENTO LIKE '%".$axbuscar_documento."%' ORDER BY FECHA_EMISION ASC";		

	}

	
	//echo $sql6;

	$result6=odbc_exec($con,$sql6);	
	if ($result6){ 	
		
	echo '
		<div id="div3">
		<p><hr></p>
		<table class="table table-hover table-sm">
		<thead class="thead-default">
		<tr>
			<th scope="col" style="text-align: center;">No</th>
			<th scope="col" style="text-align: center;">TIPO</th>
			<th scope="col" style="text-align: center;">NUMERO</th>
			<th scope="col" style="text-align: center;">FEC. EMISION</th>
			<th scope="col" style="text-align: center;">RUC | DNI</th>
			<th scope="col" style="text-align: left;">PROVEEDOR</th>
			<th scope="col" style="text-align: right;">MONTO</th>
			<th scope="col" style="text-align: center;">ACCION</th>

		</tr>
		</thead>';
	

 	while ($row=odbc_fetch_array($result6)){  	
 	$axit=$axit+1;
 	$axid_logistica_cz = $row['ID_LOGISTICA_CZ'];
 	
 	$SQLSumar = "SELECT SUM(TOTAL_INGRESO) as TT FROM LOGISTICA_DT WHERE ID_LOGISTICA_CZ='$axid_logistica_cz'";
 	$RSSumar = odbc_exec($con, $SQLSumar);
 	$fila = odbc_fetch_array($RSSumar);
 	$total_doc= $fila['TT'];

 	echo'<tr>

 		<td style="text-align: center;">'.$axit.'</td>
		<td style="text-align: center;">'.$row["TIPO_DOCUMENTO"].'</td>
		<td style="text-align: center;">'.$row["NUM_DOCUMENTO"].'</td>
		<td style="text-align: center;">'.$row["FECHA_EMISION"].'</td>
		<td style="text-align: center;">'.$row["RUC_BENEF"].'</td>
		<td style="text-align: left;">'.$row["NOM_PROVEEDOR"].'</td>

		<td style="text-align: right;"><b>'.number_format($total_doc,2,".",",").'</b></td>
		<td style="text-align: center;">
			<div class="btn-group">
			  <button class="btn btn-outline-success btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			   Acción </button>
			 <div class="dropdown-menu">
			 	<button class="btn-sm dropdown-item" type="button" id="bteditar_documento" data-id_log_cz='.$axid_logistica_cz.'><i class="far fa-folder-open"></i> Editar</button>
			  	<button class="btn-sm dropdown-item" type="button" id="bteliminar_documento" data-id_log_cz='.$axid_logistica_cz.'><i class="far fa-trash-alt"></i> Eliminar</button>
			  	<button class="btn-sm dropdown-item" type="button" id="btimprimir_documento" data-id_log_cz='.$axid_logistica_cz.'><i class="fas fa-print"></i> Imprimir</button>
    		 </div>
			</div>
    	</td>			
		
		</tr>';
	};


  	
	echo'
	</table>
	</div>';

} 

break;

case '11':
	
	$axidlocal = $_POST['txtidlocal']; 
	$axid_logistica_cz = $_POST['axid_logistica_cz']; 

	$sqlbuscar = "SELECT * FROM LOGISTICA_DOCUMENTOS_CZ WHERE ID_LOGISTICA_CZ ='$axid_logistica_cz' AND ID_LOCAL='$axidlocal'";
	$RSBuscar=odbc_exec($con,$sqlbuscar);

	
	if(odbc_num_rows($RSBuscar) > 0) {
    
      $axlistajson = odbc_fetch_object($RSBuscar);
      $axlistajson ->status =200;
      echo json_encode($axlistajson);
      
	  } else {

	  	$error = array('status'=> 400);
	  	echo json_encode((object) $error);

	  }

break;

case '12':

	$axidlocal = $_POST['txtidlocal']; 
	$axid_logistica_cz = $_POST['txtid_logistica_cz']; 
	$axcant_modificar = $_POST['axcant_modificar']; 
	$axid_insumo = $_POST['axid_insumo']; 
	$axporc_igv = $_POST['txtigv']; 


	$SQLBuscar = "SELECT * FROM LOGISTICA_DOCUMENTOS WHERE ID_LOGISTICA_CZ='$axid_logistica_cz' AND ID_INSUMO='$axid_insumo' AND ID_LOCAL='$axidlocal'";
	$RSBuscar = odbc_exec($con, $SQLBuscar);

	while ($row = odbc_fetch_array($RSBuscar)) {
		
		$axprecio_compra = $row['PRECIO_C'];
		$axvalor_compra =$axprecio_compra*$axcant_modificar;
		$axigv_compra = ($axvalor_compra*$axporc_igv)/100;
		$axtotal_compra =$axvalor_compra+$axigv_compra;

		$SQLActualizar = "UPDATE LOGISTICA_DT SET CANT_COMPRA='$axcant_modificar',VALOR_INGRESO='$axvalor_compra',IGV_INGRESO='$axigv_compra',TOTAL_INGRESO='$axtotal_compra' WHERE ID_LOGISTICA_CZ='$axid_logistica_cz' AND ID_INSUMO='$axid_insumo'";
		$RSActualizar = odbc_exec($con, $SQLActualizar);

		if($RSActualizar){

			$respuesta=0;
			echo $respuesta;

		}else{

			$respuesta=1;
			echo $respuesta;

		}

	}	

break;

case '13':
	
	$axidlocal = $_POST['txtidlocal']; 
	$axid_logistica_cz = $_POST['txtid_logistica_cz']; 
	$axprecio_modificar = $_POST['axprecio_modificar']; 
	$axid_insumo = $_POST['axid_insumo']; 
	$axporc_igv = $_POST['txtigv']; 


	$SQLBuscar = "SELECT * FROM LOGISTICA_DOCUMENTOS WHERE ID_LOGISTICA_CZ='$axid_logistica_cz' AND ID_INSUMO='$axid_insumo' AND ID_LOCAL='$axidlocal'";
	$RSBuscar = odbc_exec($con, $SQLBuscar);

	while ($row = odbc_fetch_array($RSBuscar)) {
		
		$axcant_compra = $row['CANT_COMPRA'];
		$axvalor_compra =$axprecio_modificar*$axcant_compra;
		$axigv_compra = ($axvalor_compra*$axporc_igv)/100;
		$axtotal_compra =$axvalor_compra+$axigv_compra;

		$SQLActualizar = "UPDATE LOGISTICA_DT SET PRECIO_C='$axprecio_modificar',VALOR_INGRESO='$axvalor_compra',IGV_INGRESO='$axigv_compra',TOTAL_INGRESO='$axtotal_compra' WHERE ID_LOGISTICA_CZ='$axid_logistica_cz' AND ID_INSUMO='$axid_insumo'";
		$RSActualizar = odbc_exec($con, $SQLActualizar);

		if($RSActualizar){

			$respuesta=0;
			echo $respuesta;

		}else{

			$respuesta=1;
			echo $respuesta;

		}

	}

break;

case '14':
	
	$axidlocal = $_POST['txtidlocal']; 
	$axid_logistica_cz = $_POST['axid_logistica_cz']; 

	$SQLEliminar = "SELECT * FROM LOGISTICA_CZ WHERE ID_LOGISTICA_CZ ='$axid_logistica_cz' AND ID_LOCAL='$axidlocal'";
	$RSEliminar=odbc_exec($con,$SQLEliminar);

	//echo $SQLEliminar;
	
	if(odbc_num_rows($RSEliminar) > 0) {
    
     $SQLEliminar_DT = "DELETE FROM LOGISTICA_DT WHERE ID_LOGISTICA_CZ ='$axid_logistica_cz'";
     $RSEliminar_DT=odbc_exec($con,$SQLEliminar_DT);

	    if($RSEliminar_DT){

			$SQLEliminar_CZ = "DELETE FROM LOGISTICA_CZ WHERE ID_LOGISTICA_CZ ='$axid_logistica_cz' AND ID_LOCAL='$axidlocal'";
	     	$RSEliminar_CZ=odbc_exec($con,$SQLEliminar_CZ);     	

	    }
      
	} 


break;

case '15':
	
		$axidempresa= $_POST['txtidempresa'];
		

		$SQLProductosListar = "SELECT * FROM CATEGORIAS WHERE ID_EMPRESA ='$axidempresa'";
		$RSProductosListar=odbc_exec($con,$SQLProductosListar);

		
		echo "<select class='form-control custom-select mr-sm-2' id='txtsubcategoria' name='txtsubcategoria'>";
		echo "<option value=''";
		echo "></option>";
		while($Ubig1=odbc_fetch_array($RSProductosListar)){

	    echo "<option value='".$Ubig1["ID_CATEGORIAS"]."'";
	    echo ">".$Ubig1["NOM_CATEGORIA"]."</option>";

		}
	    
	    echo "</select>";


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

function redondeado ($numero, $decimales) { 
   $factor = pow(10, $decimales); 
   return (round($numero*$factor)/$factor); 
}


?>


