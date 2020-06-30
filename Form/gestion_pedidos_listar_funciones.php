<?php  

require('../Imprimir/pdf_js.php');
require_once '../core2.php';


$param=$_POST['param'];


switch ($param) {

case '0': // listar usuarios

	$axidlocal = $_POST['txtidlocal']; 
	$axcodmovcz = $_POST['txtcodmovcz']; 
	$axidbeneficiario = $_POST['txtidbeneficiario']; 
	$axfechapedido = $_POST['txtfechaactual']; 
	$axidempresa = $_POST['txtidempresa'];
	$axbuscar = $_POST['txtbuscar'];
	$axestado_pedido = $_POST['txtestado_pedido'];
	
	if($axbuscar ==""){

		$sql6 ="SELECT * FROM PEDIDOS_VENDEDORES WHERE  ID_EMPRESA='$axidempresa' AND LOCAL='$axidlocal' AND ESTADO='$axestado_pedido' ORDER BY ESTADO ASC";

	} else {
		$sql6 ="SELECT * FROM PEDIDOS_VENDEDORES WHERE  ID_EMPRESA='$axidempresa' AND LOCAL='$axidlocal' AND ESTADO='$axestado_pedido' AND VENDEDOR LIKE '%".$axbuscar."%' ORDER BY ESTADO ASC";
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
			<th scope="col" style="text-align: center;"># PEDIDO</th>
			<th scope="col" style="text-align: center;">FECHA PEDIDO</th>
			<th scope="col" style="text-align: center;">FECHA ENTREGAR</th>
			<th scope="col" style="text-align: left;">CLIENTE</th>
			<th scope="col" style="text-align: right;">MONTO S/.</th>
			<th scope="col" style="text-align: center;">ESTADO</th>						
			<th scope="col" style="text-align: center;"></th>
			

		</tr>
		</thead>';
	

 	while ($row=odbc_fetch_array($result6)){  	
 	$id = $row['ID_PEDIDO_CZ'];
 	$axidbeneficiario= $row['ID_BENEFICIARIO'];
 	$idestado= $row['ESTADO'];
 	$axit = $axit+1;
 	$axnombrevendedor = $row['VENDEDOR'];
 	$axfecha = date("d-m-Y",strtotime($row["FECHA"])); 		
 	$axfecha_entregar = date("d-m-Y",strtotime($row["FECHA_ENTREGA"])); 			
 	$axcodpedcz= $row['ID_PEDIDO_CZ'];			


 	$SqlContarPedidos ="SELECT * FROM PEDIDOS_CONTAR WHERE ID_BENEFICIARIO='$axidbeneficiario'AND ID_EMPRESA='$axidempresa' AND ESTADO_PEDIDO='$idestado'";
	$RScontarpedidos=odbc_exec($con,$SqlContarPedidos);
	//echo "$SqlContarPedidos";
	$filaRes=odbc_fetch_array($RScontarpedidos);

	$axcontar = $filaRes['NUMERO'];
 	
 	if ($idestado=="PENDIENTE"){

 			echo'<tr>
			<td class="text-danger"style="text-align: center;"><b>'.$axit.'</b></td>
			<td class="text-danger"style="text-align: center;"><b>'.$row["ID_PEDIDO_CZ"].'</b></td>			
			<td class="text-danger"style="text-align: center;"><b>'.$axfecha.'</b></td>
			<td class="text-danger"style="text-align: center;"><b>'.$axfecha_entregar.'</b></td>
			<td class="text-danger"style="text-align: left;"><b>'.$row["VENDEDOR"].'</b></td>			
  			<td class="text-danger"style="text-align: right;"><b>'.number_format($row["IMPORTE"],2,".",",").'</b></td>
  			<td class="text-danger"style="text-align: center;"><b>'.$row["ESTADO"].'</b></td>
  			<td class="text-danger"style="text-align: center;">
				<div class="btn-group">
				  <button class="btn btn-outline-danger btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				   Acción </button>
				  <div class="dropdown-menu">
				  	<button class="btn-sm dropdown-item" type="button" id="bteditar_pedido" data-idbenf='.$axidbeneficiario.' data-idpedcz='.$axcodpedcz.'><i class="far fa-folder-open"></i> Editar</button>
				  	<button class="btn-sm dropdown-item" type="button" id="bteliminar_pedido" data-idbenf='.$axidbeneficiario.' data-idpedcz='.$axcodpedcz.' ><i class="far fa-trash-alt"></i> Eliminar</button>
    				<button class="btn-sm dropdown-item" type="button" id="btimprimi_pedido" data-idbenf='.$axidbeneficiario.' data-idpedcz='.$axcodpedcz.'><i class="fas fa-print"></i> Imprimir</button>
    			  </div>
				</div>
			</td>

  		</tr>';


 	} else if($idestado=="PROCESADO"){

 			echo'<tr>
			<td class="text-success"style="text-align: center;"><b>'.$axit.'</b></td>
			<td class="text-success"style="text-align: center;"><b>'.$row["ID_PEDIDO_CZ"].'</b></td>			
			<td class="text-success"style="text-align: center;"><b>'.$axfecha.'</b></td>
			<td class="text-success"style="text-align: center;"><b>'.$axfecha_entregar.'</b></td>
			<td class="text-success"style="text-align: left;"><b>'.$row["VENDEDOR"].'</b></td>
  			<td class="text-success"style="text-align: right;"><b>'.number_format($row["IMPORTE"],2,".",",").'</b></td>
  			<td class="text-success"style="text-align: center;"><b>'.$row["ESTADO"].'</b></td>
  			<td class="text-danger"style="text-align: center;">
  				<div class="btn-group">
				  <button class="btn btn-outline-success btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				   Acción </button>
				  <div class="dropdown-menu">
				  	<button class="btn-sm dropdown-item" type="button" id="bteditar_pedido" data-idbenf='.$axidbeneficiario.' data-idpedcz='.$axcodpedcz.'><i class="far fa-folder-open"></i>  Editar</button>
				  	<button class="btn-sm dropdown-item" type="button" id="bteliminar_pedido" data-idbenf='.$axidbeneficiario.' data-idpedcz='.$axcodpedcz.' ><i class="far fa-trash-alt"></i>  Eliminar</button>
    				<button class="btn-sm dropdown-item" type="button" id="btimprimi_pedido" data-idbenf='.$axidbeneficiario.' data-idpedcz='.$axcodpedcz.'><i class="fas fa-print"></i>  Imprimir</button>
    				
    			  </div>
				</div>
    		</td>

  		</tr>';


 	}else if($idestado=="ATENDIDO"){

 			echo'<tr>
			<td class="text-primary"style="text-align: center;"><b>'.$axit.'</b></td>
			<td class="text-primary"style="text-align: center;"><b>'.$row["ID_PEDIDO_CZ"].'</b></td>			
			<td class="text-primary"style="text-align: center;"><b>'.$axfecha.'</b></td>
			<td class="text-primary"style="text-align: center;"><b>'.$axfecha_entregar.'</b></td>
			<td class="text-primary"style="text-align: left;"><b>'.$row["VENDEDOR"].'</b></td>
  			<td class="text-primary"style="text-align: right;"><b>'.number_format($row["IMPORTE"],2,".",",").'</b></td>
  			<td class="text-primary"style="text-align: center;"><b>'.$row["ESTADO"].'</b></td>
  			<td class="text-danger"style="text-align: center;">
  			<div class="btn-group">
				  <button class="btn btn-outline-primary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				   Acción </button>
				  <div class="dropdown-menu">
				  	<!--button class="btn-sm dropdown-item" type="button" id="bteditar_pedido" data-idbenf='.$axidbeneficiario.' data-idpedcz='.$axcodpedcz.'><i class="far fa-folder-open"></i>  Editar</button>
				  	<button class="btn-sm dropdown-item" type="button" id="bteliminar_pedido" data-idbenf='.$axidbeneficiario.' data-idpedcz='.$axcodpedcz.' ><i class="far fa-trash-alt"></i>  Eliminar</button-->
    				<button class="btn-sm dropdown-item" type="button" id="btimprimi_pedido" data-idbenf='.$axidbeneficiario.' data-idpedcz='.$axcodpedcz.'><i class="fas fa-print"></i>  Imprimir</button>
    				
    			  </div>
				</div>
    		</td>

  		</tr>';

 	}

 
 	

};
  	
echo'</table>
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
	
	$axcodmovcz = $_POST['axcodmovcz']; 
	$axidlocal = $_POST['txtidlocal'];
	

	$sqlprocesar = "SELECT * FROM PEDIDOS_CZ WHERE ID_PEDIDO_CZ='$axcodmovcz' AND ID_LOCAL='$axidlocal'";
	$rsprocesar=odbc_exec($con,$sqlprocesar);

	if(odbc_num_rows($rsprocesar) > 0) {

		$sqleliminarCZ ="DELETE FROM PEDIDOS_DT WHERE ID_PEDIDO_CZ='$axcodmovcz'";
		$rseliminarCZ=odbc_exec($con,$sqleliminarCZ);


		$sqleliminar ="DELETE FROM PEDIDOS_CZ WHERE ID_PEDIDO_CZ='$axcodmovcz'";
		$rseliminar=odbc_exec($con,$sqleliminar);

		$respuesta = 0; // SI GRABO
		echo $respuesta;

	} else {

		$respuesta = 1;// NO GRABO
		echo $respuesta;

	}



break;


case '3':
	
	$axidlocal = $_POST['txtidlocal']; 
	$axcodmovcz_1 = $_POST['txtcodmovcz']; 

	if($axcodmovcz_1==""){
		$axcodmovcz = $_POST['axcodmovcz']; 	
	}else{
		$axcodmovcz = $_POST['txtcodmovcz']; 
	}

	
	$axidbeneficiario = $_POST['axidbeneficiario']; 
	$axnomcliente = get_row('BENEFICIARIO','NOM_PROVEEDOR','ID_BENEFICIARIO',$axidbeneficiario);
	
			
	$sqlpedidocz ="SELECT * FROM PEDIDO_1 WHERE ID_LOCAL='$axidlocal' AND ID_PEDIDO_CZ='$axcodmovcz'";
	$rspedidocz=odbc_exec($con,$sqlpedidocz);	
	//echo $sqlpedidocz;
	if ($rspedidocz){ 	
		
	echo '
		
		<div id=div3>
		<p></hr></p>
		<a href="#" class="btn btn-outline-danger btn-sm" id="btretornar"> Regresar <i class="fas fa-undo"></i></a>
		<a href="#" class="btn btn-outline-danger btn-sm" id="btcambiar_estado" data-idpedidocz='.$axcodmovcz.'> Cambiar a PENDIENTE <i class="fab fa-creative-commons-pd-alt"></i></a>
		<p></hr></p>
		<table class="table table-sm table-hover">
		<thead class="thead-light">
		<tr>
		<th scope="col" style="text-align: center;" colspan="6"> 
			<h4>'.$axnomcliente.'</h4>
		</th>
		</tr>
		<tr>
			<th scope="col" style="text-align: center;">IT</th>
			<th scope="col" style="text-align: left;">PRODUCTOS</th>
			<th scope="col" style="text-align: center;">CANTIDAD <i class="fas fa-pencil-alt"></i></th>
			<th scope="col" style="text-align: right;">PRECIO <i class="fas fa-pencil-alt"></i></th>
			<th scope="col" style="text-align: right;">IMPORTE</th>
			<th scope="col" style="text-align: center;">QUITAR</th>
			
		</tr>
		</thead>';
	

 	while ($row=odbc_fetch_array($rspedidocz)){

 		$axit= $axit+1;
 	
 		$axidpedidoDT =$row['ID_PEDIDO_DT'];
 		//echo "$axidpedidoDT";

 		echo'<tr>
 			
			<td style="text-align: center;">'.$axit.'</td>
			<td style="text-align: left;">'.$row["NOM_COMERCIAL"].'</td>
			<td contenteditable style="text-align: center; color:red;" id="axcant_modificar" name="axcant_modificar" data-idpedidodt='.$axidpedidoDT.'><b>'.number_format($row["CANT_SALIDA"],0,".",",").'</b></td>
			<td contenteditable style="text-align: right; color:red;" id="axprecio_modificar_1" name="axprecio_modificar_1" data-idpedidodt='.$axidpedidoDT.'><b>'.number_format($row["PRECIO_V"],2,".",",").'</b></td>
			<td style="text-align: right;">'.number_format($row["TOTAL_SALIDA"],2,".",",").'</td>				
  			<td style="text-align: center;">
	  			
	  			<a href="#" class="btn btn-light btn-sm" id="bteliminar_producto" data-idpedidodt='.$axidpedidoDT.'><i class="far fa-trash-alt"></i></a>
	  									
    		</td>
    	</tr>';

    	
 	} 
 		
 	$SQLTotaldia ="SELECT SUM(TOTAL_SALIDA) AS TT from PEDIDOS_DETALLE WHERE ID_LOCAL='$axidlocal' AND ID_PEDIDO_CZ='$axcodmovcz'";
	$RSTotaldia=odbc_exec($con,$SQLTotaldia);
	$filadia=odbc_fetch_array($RSTotaldia);
	$total_pedidos= number_format($filadia["TT"],2,".",",");

	echo'
		<tr>
		<th scope="col"  style="text-align: right;" colspan="4" ><h5><b>Totales S/.</b></h5></th>
		<th scope="col"  style="text-align: right;" ><h5><b>'.$total_pedidos.'</b></h5></th>
		</tr>
	 	

	</table>
	</div>
	';

	
	}

	

break;

case '4':
	
$axcodmovdt = $_POST['id'];
$axcant_nueva = $_POST['cant_nueva'];

$SQLSelect ="SELECT * FROM PEDIDOS_DT WHERE ID_PEDIDO_DT='$axcodmovdt'";
$RSCodConta=odbc_exec($con,$SQLSelect);

//echo $SQLSelect;

if(odbc_num_rows($RSCodConta) > 0){

	while ($row=odbc_fetch_array($RSCodConta)){

		$axcodmovcz= $row["ID_PEDIDO_CZ"];
		$axprecio= $row["PRECIO_V"];
		$axtotalventa= redondeado($axcant_nueva*$axprecio,2);

		$SQLActualizarMzd ="UPDATE PEDIDOS_DT SET CANT_SALIDA='$axcant_nueva',TOTAL_SALIDA='$axtotalventa' WHERE ID_PEDIDO_CZ='$axcodmovcz'  AND  ID_PEDIDO_DT='$axcodmovdt'";
		$RSActualizar=odbc_exec($con,$SQLActualizarMzd);

		if($RSActualizar){

			$respuesta=0;
			echo "$respuesta";

		}else{

			$respuesta=1;
			echo "$respuesta";
		}


	}


} 

	
break;

case '5':
	# code...
$axidbeneficiario= $_POST['txtidbeneficiario'];
	
	
	$sql6 = "SELECT * FROM BENEFICIARIO WHERE ID_BENEFICIARIO ='$axidbeneficiario'";
	//echo "$sql6";
	
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

case '6':

$axcodmovdt = $_POST['id'];
$axprecio = $_POST['cant_nueva'];

$SQLSelect ="SELECT * FROM PEDIDOS_DT WHERE ID_PEDIDO_DT='$axcodmovdt'";
$RSCodConta=odbc_exec($con,$SQLSelect);

//echo $SQLSelect;

if(odbc_num_rows($RSCodConta) > 0){

	while ($row=odbc_fetch_array($RSCodConta)){

		$axcodmovcz= $row["ID_PEDIDO_CZ"];
		$axcantidad= $row["CANT_SALIDA"];
		$axtotalventa= redondeado($axcantidad*$axprecio,2);

		//echo $axcantidad.'-'.$axprecio;
		//$SQLActualizarMzd ="UPDATE PEDIDOS_DT SET CANT_SALIDA='$axcant_nueva',TOTAL_SALIDA='$axtotalventa' WHERE ID_PEDIDO_CZ='$axcodmovcz'  AND  ID_PEDIDO_DT='$axcodmovdt'";
		//$RSActualizar=odbc_exec($con,$SQLActualizarMzd);

		$SQLActualizarMzd ="UPDATE PEDIDOS_DT SET PRECIO_V='$axprecio',TOTAL_SALIDA='$axtotalventa' WHERE ID_PEDIDO_CZ='$axcodmovcz'  AND  ID_PEDIDO_DT='$axcodmovdt'";
		$RSActualizar=odbc_exec($con,$SQLActualizarMzd);
		//echo $SQLActualizarMzd;

		if($RSActualizar){

			$respuesta=0;
			echo "$respuesta";

		}else{

			$respuesta=1;
			echo "$respuesta";
		}


	}


} 


break;

case '7':

	$axcodmovcz = $_POST['txtcodmovcz']; 
	$axcodmovdt = $_POST['id']; 
	$axidlocal = $_POST['txtidlocal'];

	$sqleliminarCZ ="DELETE FROM PEDIDOS_DT WHERE ID_PEDIDO_CZ='$axcodmovcz' AND ID_PEDIDO_DT='$axcodmovdt'";
	$rseliminarCZ=odbc_exec($con,$sqleliminarCZ);

	if(odbc_num_rows($rseliminarCZ) > 0){

		$respuesta= 0; // PUEDE ELIMINAR EL ITEM
		echo $respuesta;
	} else{

		$respuesta= 1; // NO PUEDE ELIMINAR EL ITEM, POR ESTAR LIQUIDADO
		echo $respuesta;
	}
	

	//echo "$sqleliminarCZ";
	
break;

case '8':
	
	$axcodmovcz = $_POST['id']; 
	$axidlocal = $_POST['txtidlocal'];

	$SQLActualizar ="UPDATE PEDIDOS_CZ  SET ESTADO_PEDIDO='PENDIENTE' WHERE ID_PEDIDO_CZ='$axcodmovcz' AND ID_LOCAL='$axidlocal'";
	$RSActualizar=odbc_exec($con,$SQLActualizar);

	if($RSActualizar){
		$respuesta= 0; // PUEDE ELIMINAR EL ITEM
		echo $respuesta;
	} else{

		$respuesta= 1; // NO PUEDE ELIMINAR EL ITEM, POR ESTAR LIQUIDADO
		echo $respuesta;
	}
	
break;


case '9':
	$axidlocal = $_POST['txtidlocal'];
	$axestado_pedido = $_POST['axestado_pedido'];


	
	$SQLSumarCant = "SELECT * FROM PEDIDOS_COMPARAR WHERE ID_LOCAL ='$axidlocal' AND ESTADO_PEDIDO='$axestado_pedido'";
	$RSSumarCant = odbc_exec($con,$SQLSumarCant);
	//echo $SQLSumarCant;
	if(odbc_num_rows($RSSumarCant) > 0){

		echo '
			
		<div id=div3>
		
			<div class="input-group mb-4">
				<input type="text" class="form-control" id="txtnum_proceso"  placeholder="Ingresar Número Proceso">
				<div class="input-group-append">
				<button class="btn btn-outline-danger" id="btprocesar_pedidos" type="button">Procesar</button>
				</div>
			</div>
		
		<p></hr></p>
		<table class="table table-sm table-hover">
		<thead class="thead-light">
		
		<tr>
			<th scope="col" style="text-align: center;" colspan="6"> 
				<h5>PRODUCTO TERMINADO A PROCESAR</h5>
			</th>
		</tr>
		<tr>
			<th scope="col" style="text-align: center;">IT</th>
			<th scope="col" style="text-align: left;">PRODUCTOS TERMINADO</th>
			<th scope="col" style="text-align: center;">UND</th>
			<th scope="col" style="text-align: right;">CANT</th>
			<th scope="col" style="text-align: right;">STOCK</th>
			<th scope="col" style="text-align: right;">REQUIERE</th>
			<!--th scope="col" style="text-align: center;">VER</th-->
			
		</tr>
		</thead>';

		while ($row=odbc_fetch_array($RSSumarCant)){

			$axit= $axit+1;
			$axid_insumo= $row["ID_INSUMO"];
			$axcant_requiere = $row["CANT"]-$row["STOCK_PT"];
 			echo'<tr>
 			
			<td style="text-align: center;">'.$axit.'</td>
			<td style="text-align: left;">'.$row["NOM_COMERCIAL"].'</td>
			<td style="text-align: center;">'.$row["PRES_ABREV"].'</td>
			<td style="text-align: right;">'.number_format($row["CANT"],2,".",",").'</td>		
			<td style="text-align: right;">'.number_format($row["STOCK_PT"],2,".",",").'</td>		
			<td style="text-align: right;">'.number_format($axcant_requiere,2,".",",").'</td>		

  			<!--td style="text-align: center;">	  			
	  			<a href="#" class="btn btn-light btn-sm" id="btver_detalle_pt" data-idinsumo='.$axid_insumo.'><i class="far fa-eye"></i></a>
	  		</td-->
    	</tr>';



		}
	
	echo "
	</table>
	</div>";

	}else{

		$respuesta = 1;
		echo $respuesta;

	}

break;

case '10':
	
	$axnum_proceso = $_POST['txtnum_proceso'];
	$axidlocal = $_POST['txtidlocal'];	
	$axcoduser = $_POST['txtcodusuario'];	
	$axfecha_proceso = $_POST['txtfechaactual'];	
	$axestado_pedido = $_POST['axestado_pedido'];


	//BUSCO EL NUMERO DE PROCESO EN LA TABLA
	$SQLSumarCant_1 = "SELECT * FROM PEDIDOS_PROGRAMAR WHERE ID_LOCAL ='$axidlocal' AND NUM_PROCESO='$axnum_proceso'";
	$RSSumarCant_1 = odbc_exec($con,$SQLSumarCant_1);
	//echo $SQLSumarCant_1;
	if(odbc_num_rows($RSSumarCant_1) == 0){ // SI EL NUMERO DE PROCESO NO EXISTE, LO GENERO Y LUEGO LO ENVIO EN UNA TABLA

		//HAGO LA CONSULTA  NUEVAMENTE, PQ SE SUPONE QUE EN ESTE PUNTO YA SE HIZO EN EL PROCESO 9
		$SQLSumarCant_2 = "SELECT * FROM PEDIDOS_COMPARAR WHERE ID_LOCAL ='$axidlocal' AND ESTADO_PEDIDO='$axestado_pedido'";
		$RSSumarCant_2 = odbc_exec($con,$SQLSumarCant_2);
		//echo $SQLSumarCant_2;

		while ($fila=odbc_fetch_array($RSSumarCant_2)){

			$axid_prod_terminado = $fila['ID_INSUMO']; //BUSCO LA PLANTILLA DE ESTE PRODUCTO TERMINADO
			$axcant_prod_terminado = $fila['CANT']; //LA CANTIDAD QUE SUMO POR PT
			$axstock_prod_terminado= $fila['STOCK_PT']; // STCOK ACTUAL DEL PT
			$axcant_requiere = $axcant_prod_terminado-$axstock_prod_terminado;

						
			if($axcant_requiere > 0){ // VERIFICO SI SE REQUIERE PRODUCCIOR ESTE PT, OSEA SI NO HA STOCK

				///echo $axcant_requiere.'</br>';

				//BUSCO LA PLANTILLA DE ESTE PRODUCTO TERMINADO
				$SQLPlantilla_PT = "SELECT * FROM PLANTILLAS WHERE ID_LOCAL ='$axidlocal' AND ID_INSUMO_P='$axid_prod_terminado'";
				$RSPlantilla_PT = odbc_exec($con,$SQLPlantilla_PT);	

				if(odbc_num_rows($RSPlantilla_PT) > 0){ 
				//SI ENCUENTRA LA PLANTILLA, TRAE TODOS LOS INSUMOS DE LA PLANTILLA PARA INGRESARLOS A LA TABLA PEDIDOS_PROGRAMAR Y MULTIPLICARLOS POR LA CANTIDAD DEL PRODUCTO TERMINADO
				while ($fila_insumos=odbc_fetch_array($RSPlantilla_PT)){

					$axid_insumo_plantilla = $fila_insumos['ID_INSUMO_D'];
					$axid_nom_comercial_plantilla = $fila_insumos['NOM_COMERCIAL_D'];
					$axcant_producir_insumos = $fila_insumos['CANT_INSUMO']*$axcant_requiere;
					$axunida_insumo = $fila_insumos['UND_INSUMO'];
					$axstock_actual_insumo = get_row('INSUMOS','STOCK_ACTUAL','ID_INSUMO',$axid_insumo_plantilla);
					$axprecio_insumo_plantilla = $fila_insumos['PRECIO_INSUMO'];
					$axtotal_insumo_plantilla =$axcant_producir_insumos*$axprecio_insumo_plantilla;

					$SQLInsertar = "INSERT INTO PEDIDOS_PROGRAMAR (NUM_PROCESO,ID_LOCAL,COD_USER,FECHA_ACTUAL,ID_INSUMO,NOM_COMERCIAL,PRES_ABREV,CANT_REQUERIDA,STOCK_ACTUAL,PRECIO,TOTAL,ESTADO_PROCESO)VALUES('$axnum_proceso','$axidlocal','$axcoduser','$axfecha_proceso','$axid_insumo_plantilla','$axid_nom_comercial_plantilla','$axunida_insumo','$axcant_producir_insumos','$axstock_actual_insumo','$axprecio_insumo_plantilla','$axtotal_insumo_plantilla','PENDIENTE')"; 
					$RSInsertar = odbc_exec($con, $SQLInsertar);			
					//echo $SQLInsertar;
				}	

				}else{ //SI NO ENCUENTRA LA PLANTILLA NO GRABA NADA

					echo $axcant_requiere.'</br>';
				}

			}
			
			
		}
		


	}else{ // SI EL NUMERO DE PROCESO EXISTE, ENVIO UNA TABLA CON LA LISTA DE LOS INSUMOS

		echo '			
		<div id=div3>
			<!--div class="input-group mb-4">
				<input type="text" class="form-control" id="txtnum_proceso"  placeholder="Ingresar Número Proceso">
				<div class="input-group-append">
				<button class="btn btn-outline-danger" id="btprocesar_pedidos" type="button">Procesar</button>
				</div>
			</div>
			<p></hr></p-->

		<table class="table table-sm table-hover">
		<thead class="thead-light">
		
		<tr>
			<th scope="col" style="text-align: center;" colspan="7"> 
				<h5>INSUMOS REQUERIDOS PARA EL DESPACHO TOTAL</h5>
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
			
			
		</tr>
		</thead>';

		while ($row=odbc_fetch_array($RSSumarCant_1)){

			$axit= $axit+1;
			$axid_insumo= $row["ID_INSUMO"];
			$axstock_actual_insumo =$row["STOCK_ACTUAL"];
			$axcant_requerida =$row["CANT_REQUERIDA"];

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
			<td style="text-align: center;">'.$row["PRES_ABREV"].'</td>
			<td style="text-align: right;">'.number_format($row["CANT_REQUERIDA"],2,".",",").'</td>				
			<td style="text-align: right;">'.number_format($row["STOCK_ACTUAL"],2,".",",").'</td>
			<td class="text-danger" style="text-align: right;"><b>'.number_format($axcant_comprar,2,".",",").'</b></td>
			<td class="text-success" style="text-align: right;"><b>'.number_format($axcant_almacen,2,".",",").'</b></td>
			';
			echo "</tr>";
		}
	
	echo "
	</table>
	</div>";

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


