<?php  

require('../Imprimir/pdf_js.php');
require_once '../core2.php';


$param=$_POST['param'];


switch ($param) {

case '0': // listar usuarios

	$axidlocal = $_POST['txtidlocal']; 
	$axbuscar = $_POST['txtbuscar'];
	$axestado_pedido = $_POST['txtestado_pedido'];
	
	if($axbuscar ==""){

		$sql6 ="SELECT * FROM PRODUCCION_PRG WHERE  ID_LOCAL='$axidlocal' AND ESTADO_PROD='$axestado_pedido' ORDER BY ESTADO_PROD ASC";

	} else {
		$sql6 ="SELECT * FROM PRODUCCION_PRG WHERE  ID_LOCAL='$axidlocal' AND ESTADO_PROD='$axestado_pedido'  AND ID_PRODUCCION_CZ LIKE '%".$axbuscar."%' ORDER BY ESTADO_PROD ASC";
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
			<th scope="col" style="text-align: center;">NUM. PRODUCCION</th>
			<th scope="col" style="text-align: center;">FECHA</th>
			<th scope="col" style="text-align: center;">ESTADO</th>
			<th scope="col" style="text-align: center;">ACCION</th>
		</tr>
		</thead>';
	

 	while ($row=odbc_fetch_array($result6)){  	
 	$axit=$axit+1;
 	$id = $row['ID_PRODUCCION_CZ'];
 	$axfecha = date("d-m-Y",strtotime($row["FECHA_PROD"])); 		
 	
	echo'<tr>
		<td style="text-align: center;">'.$axit.'</td>
		<td style="text-align: center;">'.$row["ID_PRODUCCION_CZ"].'</td>
		<td style="text-align: center;">'.$axfecha.'</td>';

	if($row["ESTADO_PROD"]=="PENDIENTE"){
		echo '<td class="text-danger"style="text-align: center;"><b>'.$row["ESTADO_PROD"].'</b></td>';
	}else{
		echo '<td class="text-success"style="text-align: center;"><b>'.$row["ESTADO_PROD"].'</b></td>';
	}

	
							
	echo'
		<td style="text-align: center;">
			<div class="btn-group">
			  <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			   Acción </button>
			 <div class="dropdown-menu">
			 	<button class="btn-sm dropdown-item" type="button" id="bteditar_produccion" data-idprodcz='.$id.'><i class="far fa-folder-open"></i> Editar</button>
			  	<button class="btn-sm dropdown-item" type="button" id="bteliminar_produccion" data-idprodcz='.$id.' data-estado='.$row['ESTADO_PROD'].'><i class="far fa-trash-alt"></i> Eliminar</button>
			  	<button class="btn-sm dropdown-item" type="button" id="btimprimir_produccion" data-idprodcz='.$id.'><i class="fas fa-print"></i> Imprimir</button>
    		 </div>
			</div>
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
	
	$axidlocal = $_POST['txtidlocal']; 	
	$axbuscar = $_POST['txtbuscar_prod_terminado']; 
	$axordenar = $_POST['txtordenar']; 


	if($axbuscar == ''){

		if($axordenar==0){
			$SQLInsumos = "SELECT TOP 12 * FROM INSUMOS_LISTA WHERE ID_LOCAL = '$axidlocal' and NOM_SUBCATEGORIA='PRODUCTO TERMINADO' ORDER BY STOCK_ACTUAL ASC";					
		}else{
			$SQLInsumos = "SELECT TOP 12 * FROM INSUMOS_LISTA WHERE ID_LOCAL = '$axidlocal' and NOM_SUBCATEGORIA='PRODUCTO TERMINADO' ORDER BY STOCK_ACTUAL DESC";					
		}

	} else {
		
		if($axordenar==0){
			$SQLInsumos = "SELECT TOP 12 * FROM INSUMOS_LISTA WHERE ID_LOCAL = '$axidlocal' and NOM_SUBCATEGORIA='PRODUCTO TERMINADO' AND NOM_COMERCIAL LIKE '%".$axbuscar."%' ORDER BY STOCK_ACTUAL ASC";		
		}else{
			$SQLInsumos = "SELECT TOP 12 * FROM INSUMOS_LISTA WHERE ID_LOCAL = '$axidlocal' and NOM_SUBCATEGORIA='PRODUCTO TERMINADO' AND NOM_COMERCIAL LIKE '%".$axbuscar."%' ORDER BY STOCK_ACTUAL DESC";	
		}
		
	}
	//echo $SQLInsumos;
	$RSInsumos=odbc_exec($con,$SQLInsumos);	

	echo '<div class="list-group">
		
		<a href="#" id="btordernar" class="list-group-item list-group-item-action active">
		 <h6>PRODUCTO TERMINADO </h6>
		 
		 </a>

		<!--table class="table table-hover table-sm">
		<tr>
			<th class="list-group-item list-group-item-action active" style="text-align: center;">Producto terminado</th>
			<th class="list-group-item list-group-item-action active" scope="col" style="text-align: center;">Acción</th>
		</tr-->';

	if(odbc_num_rows($RSInsumos) > 0){

		while ($fila = odbc_fetch_array($RSInsumos)) {

			$id_insumo = $fila['ID_INSUMO'];
			$axstock_actual= $fila['STOCK_ACTUAL'];
			$axstock_minimo= $fila['STOCK_MINIMO'];

			if($axstock_actual <=$axstock_minimo){

				echo'
			<a href="#" class="list-group-item list-group-item-action" id="btasig_prod_term" data-idinsumo='.$id_insumo.'>'.$fila['NOM_COMERCIAL'].' <span class="badge badge-danger badge-pill">'.$axstock_actual.'</span></a>			
			<!--tr>
			<td class="list-group-item list-group-item-action" style="text-align: left;">'.$fila['NOM_COMERCIAL'].'</td>
			<td class="list-group-item list-group-item-action" style="text-align: center;"></td>
			</tr-->';
					
			} else{

				echo'
			<a href="#" class="list-group-item list-group-item-action" id="btasig_prod_term" data-idinsumo='.$id_insumo.'>'.$fila['NOM_COMERCIAL'].' <span class="badge badge-info badge-pill">'.$axstock_actual.'</span></a>			
			<!--tr>
			<td class="list-group-item list-group-item-action" style="text-align: left;">'.$fila['NOM_COMERCIAL'].'</td>
			<td class="list-group-item list-group-item-action" style="text-align: center;"></td>
			</tr-->';

			}

			//echo $id_insumo;
			
			
		}

	}

	echo "
	<!--/table-->
	</div>";

break;

case '3':
	
	$axparametros = $_POST['txtparametro']; 	
	$axidprod_cz = $_POST['axidprod_cz']; 	

	$axidlocal = $_POST['txtidlocal']; 	
	$axfecha_prod = $_POST['txtfechaactual']; 	
	$axano_actual = $_POST['txtano_actual']; 	
	$axlote_produccion = $_POST['txtlote_produccion']; 	
	$axestado_prod = $_POST['axestado_prod']; 	
	
	if($axparametros==0){

		
		$SQLInsertar = "INSERT INTO PRODUCCION_CZ (ID_PRODUCCION_CZ,ID_LOCAL,FECHA_PROD,ESTADO_PROD,ANO_PROD,LOTE_PROD) VALUES ('$axidprod_cz','$axidlocal','$axfecha_prod','$axestado_prod','$axano_actual','$axlote_produccion')";
		
	}else if($axparametros==1){

		$SQLInsertar ="UPDATE PRODUCCION_CZ SET ID_LOCAL='$axidlocal',FECHA_PROD='$axfecha_prod',ESTADO_PROD='$axestado_prod',ANO_PROD='$axano_actual',LOTE_PROD='$axlote_produccion' WHERE ID_PRODUCCION_CZ ='$axidprod_cz'";

	}
	
	$RSInsertar = odbc_exec($con, $SQLInsertar);	
	if($RSInsertar){

		$respuesta = 0;
		echo"$respuesta"; // GRABADO

	}else{

		$respuesta = 1;
		echo"$respuesta"; // NO GRABADO

	}

break;

case '4':
	
	$axidprod_cz = $_POST['txtid_prod_cz']; 
	$axidinsumo_p = $_POST['axidinsumo']; 
	$axcant_prod = $_POST['txtcant_pt']; 
	$axidlocal = $_POST['txtidlocal']; 
	$axfecha_prod= $_POST['txtfechaactual']; 

	$axstock_actual = get_row('INSUMOS','STOCK_ACTUAL','ID_INSUMO',$axidinsumo_p);

	$SQLInsertar = "INSERT INTO PRODUCCION_DT (ID_PRODUCCION_CZ,ID_INSUMO_PT,CANT_PT,STOCK_ACTUAL) VALUES ('$axidprod_cz','$axidinsumo_p','$axcant_prod','$axstock_actual')";
	$RSInsertar = odbc_exec($con, $SQLInsertar);

	if($RSInsertar){

		//VERIFICO SI TIENE PLANTILLA
		$SQLPlantilla = "SELECT * FROM PLANTILLAS WHERE ID_INSUMO_P='$axidinsumo_p'";
		$RSPlanilla = odbc_exec($con, $SQLPlantilla);

		if($RSPlanilla){

			while ($fila_plantilla=odbc_fetch_array($RSPlanilla)) {

				$axcant_plantilla = $fila_plantilla['CANT_INSUMO'];
				$axid_insumo_d= $fila_plantilla['ID_INSUMO_D'];
				//$axnom_insumo_d= $fila_plantilla['NOM_COMERCIAL_D'];
				//$axstock_insumo= $fila_plantilla['STOCK_ACTUAL'];
				$axstock_insumo = get_row('INSUMOS','STOCK_ACTUAL','ID_INSUMO',$axid_insumo_d);
				$axnom_insumo_d = get_row('INSUMOS','NOM_COMERCIAL','ID_INSUMO',$axid_insumo_d);
				$axcant_producir = $axcant_prod*$axcant_plantilla;



				$SQLInsertar_pg = "INSERT INTO PRODUCCION_PG (ID_PRODUCCION_CZ,ID_LOCAL,FECHA_ACTUAL,ID_INSUMO,NOM_COMERCIAL,CANT_REQUERIDA,STOCK_ACTUAL) VALUES ('$axidprod_cz','$axidlocal','$axfecha_prod','$axid_insumo_d','$axnom_insumo_d','$axcant_producir','$axstock_insumo')";
				$RSInsertar_pg = odbc_exec($con, $SQLInsertar_pg);
				//echo $SQLInsertar_pg;

			}
			
		}

	}else{

		$respuesta = 1;
		echo"$respuesta"; // NO GRABADO

	}
break;

case '5':
	
	$axidlocal = $_POST['txtidlocal']; 	
	$axidprod_cz = $_POST['txtid_prod_cz']; 
	$axtitulo_proceso = 'INSUMOS REQUERIDOS PARA EL PROCESO No '.$axidprod_cz;


	$SQLDetalle_Insumos ="SELECT * FROM PRODUCCION_INSUMOS WHERE ID_LOCAL='$axidlocal' AND ID_PRODUCCION_CZ = '$axidprod_cz' ORDER BY NOM_COMERCIAL ASC";
	$RSDetalle_Insumos=odbc_exec($con,$SQLDetalle_Insumos);	
	//echo $SQLDetalle_Insumos;

	echo '			
		<div id=div3>
		<table class="table table-sm table-hover">
		<thead class="thead-light">
		<tr>
			<th scope="col" style="text-align: center;" colspan="8"> 
				<h6><b>'.$axtitulo_proceso.'</b></h6>
			</th>
		</tr>
		<tr>
			<th scope="col" style="text-align: center;">IT</th>
			<th scope="col" style="text-align: left;">DESCRIPCION DE INSUMOS</th>
			<th scope="col" style="text-align: center;">UND</th>
			<th scope="col" style="text-align: right;">CANT REQ.</th>
			<th scope="col" style="text-align: right;">STOCK</th>
			<th scope="col" class="text-danger" style="text-align: right;">COMPRAR</th>
			<th scope="col" class="text-success" style="text-align: right;">ALMACEN</th>
			<th scope="col" style="text-align: center;"></th>
		</tr>
		</thead>';

		while ($row=odbc_fetch_array($RSDetalle_Insumos)){

			$axit= $axit+1;
			$axid_insumo= $row["ID_INSUMO"];
			$axidprod_cz = $row['ID_PRODUCCION_CZ'];
			$axstock_actual_insumo =$row["STOCK_ACTUAL"];
			$axcant_requerida =$row["CANT_REQUERIDA"];
			$axund_insumo = get_row('INSUMOS_LISTA','UNIDAD','ID_INSUMO',$axid_insumo);
			$nom_insumo=$row["NOM_COMERCIAL"];

			if($axstock_actual_insumo > $axcant_requerida){
				$axcant_comprar = 0;
				$axcant_almacen =$axcant_requerida;
			} else{
				$axcant_comprar =$axcant_requerida;
				$axcant_almacen =0;
			}

			$axcant_requiere=$row["CANT_REQUERIDA"]-$row["STOCK_ACTUAL"];

 			echo'<tr>
 			<td style="text-align: center;">'.$axit.'</td>			
			<td style="text-align: left;">'.$row["NOM_COMERCIAL"].'</td>			
			<td style="text-align: center;">'.$axund_insumo.'</td>
			<td style="text-align: right;">'.number_format($row["CANT_REQUERIDA"],2,".",",").'</td>				
			<td style="text-align: right;">'.number_format($row["STOCK_ACTUAL"],2,".",",").'</td>
			<td class="text-danger" style="text-align: right;"><b>'.number_format($axcant_comprar,2,".",",").'</b></td>
			<td class="text-success" style="text-align: right;"><b>'.number_format($axcant_almacen,2,".",",").'</b></td>
			<td style="text-align: center;">
			<a href="#" class="btn btn-outline-info btn-sm" data-toggle="modal" data-target="#exampleModal" id="btcambiar_producto" data-nominsumo_cambiar='.$nom_insumo.' data-idinsumo='.$axid_insumo.'><i class="far fa-folder-open"></i></a></td>

			
			';
			echo "</tr>";
		}
	
	echo "
	</table>
	</div>";	

break;

case '6':
	
	$axidlocal = $_POST['txtidlocal']; 	
	$axidprod_cz = $_POST['axidprod_cz']; 
	
	$sql6 = "SELECT * FROM PRODUCCION_CZ WHERE ID_PRODUCCION_CZ ='$axidprod_cz'";
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

case '7':
	
	$axidlocal = $_POST['txtidlocal']; 	
	$axidprod_cz = $_POST['txtid_prod_cz']; 
	$axtitulo_proceso = 'PRODUCTOS TERMINADO A PRODUCIR No '.$axidprod_cz;
	
	$SQLDetalle_Insumos ="SELECT * FROM PRODUCCION_PROD_TERMINADO WHERE ID_LOCAL='$axidlocal' AND ID_PRODUCCION_CZ = '$axidprod_cz' ORDER BY NOM_COMERCIAL ASC";
	$RSDetalle_Insumos=odbc_exec($con,$SQLDetalle_Insumos);	
	//echo $SQLDetalle_Insumos;

	echo '			
		<div id=div3>
		<div class="input-group mb-4">
		<a href="#" class="btn btn-outline-danger btn-sm" id="btretornar"> Regresar <i class="fas fa-undo"></i></a>
		<a href="#" class="btn btn-outline-success btn-sm" id="btreporte_produccion"> Enviar Producción <i class="fas fa-print"></i></a>
		</div>
		
		<p></hr></p>
		<table class="table table-sm table-hover">
		<thead class="thead-light">
		<tr>
			<th scope="col" style="text-align: center;" colspan="7"> 
				<h6><b>'.$axtitulo_proceso.'</b></h6>
			</th>
		</tr>
		<tr>
			<th scope="col" style="text-align: center;">IT</th>
			<th scope="col" style="text-align: left;">PRODUCTOS TERMINADO</th>
			<th scope="col" style="text-align: center;">UND</th>
			<th scope="col" style="text-align: right;">PRODUCIR</th>
			<th scope="col" style="text-align: right;">STOCK ACTUAL</th>
			<th scope="col" style="text-align: right;">STOCK MINIMO</th>
			<!--th scope="col" style="text-align: right;">REQUIERE</th-->
		</tr>
		</thead>';

		while ($row=odbc_fetch_array($RSDetalle_Insumos)){

			$axit= $axit+1;
			$axid_insumo= $row["ID_INSUMO"];
			$axcant_requiere = $row["CANT_PT"]-$row["STOCK_PT"];
 			echo'<tr>
 			
			<td style="text-align: center;">'.$axit.'</td>
			<td style="text-align: left;">'.$row["NOM_COMERCIAL"].'</td>
			<td style="text-align: center;">'.$row["PRES_ABREV"].'</td>
			<td style="text-align: right;">'.number_format($row["CANT_PT"],2,".",",").'</td>		
			<td style="text-align: right;">'.number_format($row["STOCK_PT"],2,".",",").'</td>		
			<td style="text-align: right;">'.number_format($row["STOCK_MN"],2,".",",").'</td>		
			<!--td style="text-align: right;">'.number_format($axcant_requiere,2,".",",").'</td-->		

  			<!--td style="text-align: center;">	  			
	  			<a href="#" class="btn btn-light btn-sm" id="btver_detalle_pt" data-idinsumo='.$axid_insumo.'><i class="far fa-eye"></i></a>
	  		</td-->
    	</tr>';
		
		}
	
	echo "
	</table>
	</div>";	

break;

case '8':
	
	$axidlocal = $_POST['txtidlocal']; 	
	$axidprod_cz = $_POST['txtid_prod_cz']; 
	$axestado_prod = $_POST['axestado_prod']; 

	$SQLEstado_Prod ="SELECT * FROM PRODUCCION_CZ WHERE ID_LOCAL='$axidlocal' AND ID_PRODUCCION_CZ = '$axidprod_cz' AND ESTADO_PROD='PENDIENTE'";
	$RSEstado_Prod=odbc_exec($con,$SQLEstado_Prod);	

	if(odbc_num_rows($RSEstado_Prod) > 0) {

		$SQLActualizar_estado ="UPDATE PRODUCCION_CZ SET ESTADO_PROD='PROCESADO' WHERE ID_PRODUCCION_CZ='$axidprod_cz'";
		$RSActualizar_estado = odbc_exec($con, $SQLActualizar_estado);

		$respuesta = 0;
		echo"$respuesta"; // GRABADO


	}else{

		$respuesta = 1;
		echo"$respuesta"; // GRABADO


	}
	

break;

case '9':
	
	$axidlocal = $_POST['txtidlocal']; 	
	$axidprod_cz = $_POST['txtid_prod_cz'];

	$SQLEliminar_pg = "DELETE FROM PRODUCCION_PG WHERE ID_LOCAL='$axidlocal' AND ID_PRODUCCION_CZ = '$axidprod_cz'";
	$RSEliminar_pg= odbc_exec($con, $SQLEliminar_pg);

	if($RSEliminar_pg){

		$SQLEliminar_dt = "DELETE FROM PRODUCCION_DT WHERE ID_PRODUCCION_CZ = '$axidprod_cz'";
		$RSEliminar_dt= odbc_exec($con, $SQLEliminar_dt);

		if($RSEliminar_dt){

			$SQLEliminar_cz = "DELETE FROM PRODUCCION_CZ WHERE ID_LOCAL='$axidlocal' AND ID_PRODUCCION_CZ = '$axidprod_cz'";
			$RSEliminar_cz= odbc_exec($con, $SQLEliminar_cz);

			$respuesta = 0;
			echo"$respuesta"; // ELIMINADOS

		} else {

			$respuesta = 1;
			echo"$respuesta"; // NO ELIMINADOS
		}

	} else{

		$respuesta = 1;
		echo"$respuesta"; // NO ELIMINADOS
	}


break;

case '10':
	
	$axidlocal = $_POST['txtidlocal']; 	

	$axlote = get_row('LOCALES','ID_LOTE','ID_LOCAL',$axidlocal);
	echo $axlote;
break;

case '11':
	
	$axidlocal = $_POST['txtidlocal']; 	
	$axbuscar = $_POST['txtbuscar_insumo']; 
	$axordenar = $_POST['txtordenar_1']; 


	if($axbuscar == ''){

		if($axordenar==0){
			$SQLInsumos = "SELECT TOP 6 * FROM INSUMOS_LISTA WHERE ID_LOCAL = '$axidlocal' and NOM_SUBCATEGORIA='INSUMOS' ORDER BY STOCK_ACTUAL ASC";					
		}else{
			$SQLInsumos = "SELECT TOP 6 * FROM INSUMOS_LISTA WHERE ID_LOCAL = '$axidlocal' and NOM_SUBCATEGORIA='INSUMOS' ORDER BY STOCK_ACTUAL DESC";					
		}

	} else {
		
		if($axordenar==0){
			$SQLInsumos = "SELECT TOP 6 * FROM INSUMOS_LISTA WHERE ID_LOCAL = '$axidlocal' and NOM_SUBCATEGORIA='INSUMOS' AND NOM_COMERCIAL LIKE '%".$axbuscar."%' ORDER BY STOCK_ACTUAL ASC";		
		}else{
			$SQLInsumos = "SELECT TOP 6 * FROM INSUMOS_LISTA WHERE ID_LOCAL = '$axidlocal' and NOM_SUBCATEGORIA='INSUMOS' AND NOM_COMERCIAL LIKE '%".$axbuscar."%' ORDER BY STOCK_ACTUAL DESC";	
		}
		
	}
	//echo $SQLInsumos;
	$RSInsumos=odbc_exec($con,$SQLInsumos);	

	echo '<div class="list-group">
		
		<a href="#" id="btordernar" class="list-group-item list-group-item-action active">
		 <h6>DESCRIPCION DE INSUMOS </h6>
		</a>';

	if(odbc_num_rows($RSInsumos) > 0){

		while ($fila = odbc_fetch_array($RSInsumos)) {

			$id_insumo = $fila['ID_INSUMO'];
			$nom_insumo = $fila['NOM_COMERCIAL'];
			$axstock_actual= $fila['STOCK_ACTUAL'];
			$axstock_minimo= $fila['STOCK_MINIMO'];

			if($axstock_actual <=$axstock_minimo){

			echo'<a href="#" class="list-group-item list-group-item-action" id="btasig_insumos_nuevo" data-idinsumo_nuevo='.$id_insumo.' data-nominsumo_nuevo='.$nom_insumo.'>'.$fila['NOM_COMERCIAL'].' <span class="badge badge-danger badge-pill">'.$axstock_actual.'</span></a>';
					
			} else{
			echo'<a href="#" class="list-group-item list-group-item-action" id="btasig_insumos_nuevo" data-idinsumo_nuevo='.$id_insumo.' data-nominsumo_nuevo='.$nom_insumo.'>'.$fila['NOM_COMERCIAL'].' <span class="badge badge-info badge-pill">'.$axstock_actual.'</span></a>';
			}

			//echo $id_insumo;
		}

	}

	echo "</div>";

break;

case '12':

	$axidlocal = $_POST['txtidlocal']; 	
	$axid_insumo_nuevo = $_POST['axid_insumo_nuevo']; 
	$axid_insumo_cambiar = $_POST['txtid_insumo_cambiar']; 
	$axidprod_cz = $_POST['txtid_prod_cz'];	
	
	$SQLInsumos = "SELECT * FROM INSUMOS_LISTA WHERE ID_INSUMO ='$axid_insumo_nuevo' AND ID_LOCAL='$axidlocal'";
	$RSInsumos=odbc_exec($con,$SQLInsumos);

	while ($fila=odbc_fetch_array($RSInsumos)) {
		
		$axnom_insumo_nuevo = $fila['NOM_COMERCIAL'];
		$axstock_insumo_nuevo = $fila['STOCK_ACTUAL'];

		$SQLActualizar_insumos = "UPDATE PRODUCCION_PG SET ID_INSUMO='$axid_insumo_nuevo',NOM_COMERCIAL='$axnom_insumo_nuevo',STOCK_ACTUAL='$axstock_insumo_nuevo' WHERE ID_PRODUCCION_CZ='$axidprod_cz' AND ID_INSUMO='$axid_insumo_cambiar'";
		$RSActualizar_insumos = odbc_exec($con, $SQLActualizar_insumos);

		//echo $SQLActualizar_insumos;

		if($RSActualizar_insumos){

			$respuesta = 0;
			echo"$respuesta"; // ACTUALIZO
		}else{

			$respuesta = 1;
			echo"$respuesta"; // NO ACTUALIZO
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

function redondeado ($numero, $decimales) { 
   $factor = pow(10, $decimales); 
   return (round($numero*$factor)/$factor); 
}


?>


