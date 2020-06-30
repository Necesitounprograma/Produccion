<?php  

require('../Imprimir/pdf_js.php');
require_once '../core2.php';


$param=$_POST['param'];


switch ($param) {

case '0': // listar usuarios

	$axidempresa = $_POST['txtidempresa']; 
	$axbuscar = $_POST['txtbuscar']; 
	$axidlocal = $_POST['txtidlocal']; 
 

	if($axbuscar==""){
		
		$SqlStock = "SELECT TOP 5 ID_INSUMO,NOM_COMERCIAL,NOM_CATEGORIA,P_VENTA FROM INSUMOS_VENDEDORES WHERE NOM_CATEGORIA='PRODUCTO TERMINADO' AND ID_EMPRESA='$axidempresa' ORDER BY NOM_COMERCIAL";

	}else{

		$SqlStock = "SELECT TOP 5 ID_INSUMO,NOM_COMERCIAL,NOM_CATEGORIA,P_VENTA FROM INSUMOS_VENDEDORES WHERE NOM_CATEGORIA='PRODUCTO TERMINADO' AND ID_EMPRESA='$axidempresa' AND NOM_COMERCIAL like '%".$axbuscar."%' ORDER BY NOM_COMERCIAL";			
	}
	
	//echo $SqlStock;

	$RSStock=odbc_exec($con,$SqlStock);
	
	$output ='
		<ul class="list-group list-group-flush">
	';
	if ($RSStock){

 		while ($row=odbc_fetch_array($RSStock)){ 
 		$id = $row["ID_INSUMO"];		
 		$pr = $row["P_VENTA"];		

 		//echo $archivo;

 		$output .='
				
 			<li class="list-group-item" id="btagregar_carro" name="btagregar_carro" data-id='.$id.' data-prs='.$pr.'>
 				<p><b>'.' '.$row["NOM_COMERCIAL"].'</b></p> 				
 				<a href="#" class="btn btn-outline-danger btn-sm"> <img src="../icon/vender.png"> Agregar al carro</a>
 			</li>

 			<!--li class="list-group-item" id="btagregar_carro" name="btagregar_carro" data-id='.$id.' data-prs='.$pr.'>
 				<p><img class="avatar" src="../img/Productos/'.$row["MOM_DIGITAL"].'"><b>'.' '.$row["NOM_COMERCIAL"].'</b></p> 				
 				<a href="#" class="btn btn-outline-danger btn-sm"> <img src="../icon/vender.png"> Agregar al carro</a>
 			</li-->

	 		';
		}	

		$output .='</ul>';

	} else {

		$output='No se encontrarón registros';
	}


	echo $output;
break;

case '1':
	
	$axdnivendedor = $_POST['txtdnivendedor']; 

	$sql6 = "SELECT * FROM BENEFICIARIO WHERE RUC_BENEF = '$axdnivendedor'";
	
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

case '2': //BUSCA PEDIDOS PROCESADOS Y LOS CUENTA

	$axfechapedido = $_POST['txtfechaactual']; 
	$axidbeneficiario = $_POST['txtidbeneficiario']; 
	$axidlocal = $_POST['txtidlocal']; 
	

	$SqlBuscarPeidos ="SELECT * FROM PEDIDOS_CONTAR WHERE FECHA_PEDIDO='$axfechapedido' AND ID_BENEFICIARIO='$axidbeneficiario'AND ID_LOCAL='$axidlocal' AND ESTADO_PEDIDO='PROCESADO'";
	$result1=odbc_exec($con,$SqlBuscarPeidos);

	//echo "$SqlBuscarPeidos";
	
	if(odbc_num_rows($result1) > 0) {

	//	$respuesta = 0; // SI HAY REGISTROS EN EL PEDIDO DEL DIA 
	//	echo $respuesta;

	$axlistaprov1 = odbc_fetch_object($result1);
    $axlistaprov1 ->status =200;
    echo json_encode($axlistaprov1);

	} else{

		$error = array('status'=> 400);
  		echo json_encode((object) $error);

	//	$respuesta = 1;// SI HAY REGISTROS PERO ESTAN PROCESADOS
	//	echo $respuesta;
	}
	
break;

case '3':
	
	$axcodmovcz = $_POST['txtcodmovcz']; 
	$axfechapedido = $_POST['txtfechaactual']; 
	$axhorapedidio = $_POST['txthoraactual']; 
	$axidbeneficiario = $_POST['txtidbeneficiario']; 
	$axidlocal = $_POST['txtidlocal']; 
	$axcodusuario = $_POST['txtcodusuario']; 
	$axfechaentrega= $_POST['txtfechaentrega']; 
	$axlugarentrega= $_POST['txtlugarentrega']; 
	$axtipopedido= $_POST['txttipopedido']; 
	$axtipocomprobante= $_POST['txttipodoc']; 
	$axidempresa= $_POST['txtidempresa'];

	
			
	$SQLGrabar = "INSERT INTO PEDIDOS_CZ (ID_PEDIDO_CZ,FECHA_PEDIDO,HORA_PEDIDO,ID_BENEFICIARIO,ID_LOCAL,COD_USER,ESTADO_PEDIDO,FECHA_ENTREGA,LUGAR_ENTREGA,TIPO_PEDIDO,TIPO_COMPROBANTE,ID_EMPRESA) VALUES ('$axcodmovcz','$axfechapedido','$axhorapedidio','$axidbeneficiario','$axidlocal','$axcodusuario','PENDIENTE','$axfechaentrega','$axlugarentrega','$axtipopedido','$axtipocomprobante','$axidempresa')";

	$RSGrabar=odbc_exec($con,$SQLGrabar);

	//echo "$SQLGrabar";

	if($RSGrabar){

		$respuesta = 0; // SI GRABO
		echo $respuesta;

	} else {

		$respuesta = 1;// NO GRABO
		echo $respuesta;

	}

break;

case '4':
	
	$axcodmovcz = $_POST['txtcodmovcz']; 
	$axidinsumo = $_POST['txtidinsumo']; 
	$axcant_venta = $_POST['txtcant_venta']; 
	$axprec_venta = $_POST['txtprecio_venta']; 
	$axdscto_venta = $_POST['txtdscto_venta']; 
	$axvalor_venta = $_POST['txtvalorventa_venta']; 
	$axigv_venta = $_POST['txtigv_venta']; 
	$axgravada_venta = $_POST['txtgravadas_venta']; 
	$axinafecta_venta = $_POST['txtinafectas_venta']; 
	$axexonerada_venta = $_POST['txtexonerada_venta']; 
	$axtotal_venta = $_POST['txttotal_venta']; 


	$SQLGrabar = "INSERT INTO PEDIDOS_DT (ID_PEDIDO_CZ,ID_INSUMO,CANT_SALIDA,PRECIO_V,DSCTOS_SALIDA,VALOR_SALIDA,IGV_SALIDA,GRAVADAS_SALIDA,INAFECTO_SALIDA,EXONERADO_SALIDA,TOTAL_SALIDA) VALUES ('$axcodmovcz','$axidinsumo','$axcant_venta','$axprec_venta','$axdscto_venta','$axvalor_venta','$axigv_venta','$axgravada_venta','$axinafecta_venta','$axexonerada_venta','$axtotal_venta')";

	$RSGrabar=odbc_exec($con,$SQLGrabar);

	//echo "$SQLGrabar";

	if($RSGrabar){

		$respuesta = 0; // SI GRABO
		echo $respuesta;

	} else {

		$respuesta = 1;// NO GRABO
		echo $respuesta;

	}

break;

case '5':

	$axidlocal = $_POST['txtidlocal']; 
	$axidbeneficiario = $_POST['txtidbeneficiario']; 
	$axfechapedido = $_POST['txtfechaactual']; 

	$SQTraerDatosPedido ="SELECT * FROM PEDIDOS_DETALLE WHERE ID_LOCAL='$axidlocal' AND ID_BENEFICIARIO ='$axidbeneficiario' AND FECHA_PEDIDO='$axfechapedido' ORDER BY NOM_COMERCIAL DESC";
	
	$RSTraerDatosPedido=odbc_exec($con,$SQTraerDatosPedido);	
	
	if(odbc_num_rows($RSTraerDatosPedido) > 0) {
    
	    $axlistaprov1 = odbc_fetch_object($RSTraerDatosPedido);
	    $axlistaprov1 ->status =200;
	    echo json_encode($axlistaprov1);
      
	  } else {

	  	$error = array('status'=> 400);
	  	echo json_encode((object) $error);
	  }	

break;

case '6':
	
	$axidlocal = $_POST['txtidlocal']; 
	$axcodmovcz = $_POST['txtcodmovcz']; 
	$axidbeneficiario = $_POST['txtidbeneficiario']; 
	$axfechapedido = $_POST['txtfechaactual']; 
		
	$sql6 ="SELECT * FROM PEDIDOS_DETALLE WHERE ID_LOCAL='$axidlocal' AND ID_PEDIDO_CZ='$axcodmovcz' AND ID_BENEFICIARIO ='$axidbeneficiario' AND FECHA_PEDIDO='$axfechapedido' ORDER BY NOM_COMERCIAL ASC";
	//echo $sql6;
	$result6=odbc_exec($con,$sql6);	
	if ($result6){ 	
		
	
	echo '
	
		<table class="table table-sm" id="tbregcompras">
		<thead class="thead-dark">
		
		<tr>
			<th scope="col" style="text-align: center;">Item</th>
			<th scope="col" style="text-align: left;">Nombre producto</th>
			<th scope="col" style="text-align: right;">Cantidad</th>
			<th scope="col" style="text-align: center;">Accion</th>
		</tr>
		</thead>';
	

 	while ($row=odbc_fetch_array($result6)){  	
 	$idelim = $row['ID_INSUMO'];
 	$it = $it+1;
 	echo'	
  	
  		<tr>

		<td style="text-align: center;">'.$it.'</td> 		
 		<td style="text-align: left;">'.$row['NOM_COMERCIAL'].'</td>
 		<td style="text-align: right;">'.number_format($row["CANT_SALIDA"],2,".",",").'</td>
 		<td style="text-align: center;" ><a href="#" data-id='.$idelim.' id="bteliminar"><img src="../icon/borrar.png"></td>
		
 		
 		</tr>';

	};

	//$total_pedidos = 'Total Pedido S/. '.get_row('TOTAL_PEDIDOS','TOTALES','ID_PEDIDO_CZ',$axcodmovcz);

	echo'

		<!--tr>
			<th scope="col" style="text-align: right;" colspan="3" id="tbtotales">'.$total_pedidos.'</th>
			
		</tr>
	 	<tr>
			<th scope="col" style="text-align: center;" colspan="4"></th>
	 	</tr-->

	</table>';

} else {

	echo 0;
	//echo $output;
}

break;

case '7':

$axcodmovcz = $_POST['txtcodmovcz']; 
$axidlocal = $_POST['txtidlocal']; 

$sqlprocesar = "UPDATE PEDIDOS_CZ SET ESTADO_PEDIDO='PROCESADO' WHERE ID_PEDIDO_CZ='$axcodmovcz' AND ID_LOCAL='$axidlocal'";
$rsprocesar=odbc_exec($con,$sqlprocesar);

if($rsprocesar){

		$respuesta = 0; // SI GRABO
		echo $respuesta;

	} else {

		$respuesta = 1;// NO GRABO
		echo $respuesta;

	}

break;

case '8':
	
$axcodmovcz = $_POST['txtcodmovcz']; 
$axidlocal = $_POST['txtidlocal'];
$axidinsumo = $_POST['axidinsumo']; 


$sqlprocesar = "SELECT * FROM PEDIDOS_CZ WHERE ESTADO_PEDIDO='PENDIENTE'AND ID_PEDIDO_CZ='$axcodmovcz' AND ID_LOCAL='$axidlocal'";
$rsprocesar=odbc_exec($con,$sqlprocesar);

if(odbc_num_rows($rsprocesar) > 0) {

		$sqleliminar ="DELETE FROM PEDIDOS_DT WHERE ID_PEDIDO_CZ='$axcodmovcz'  AND ID_INSUMO='$axidinsumo'";
		$rseliminar=odbc_exec($con,$sqleliminar);

		$respuesta = 0; // SI GRABO
		echo $respuesta;

	} else {

		$respuesta = 1;// NO GRABO
		echo $respuesta;

	}









break;

case '9': //traer cliente den clientes_pedidos

	$ruc = $_POST['txtruc']; 
	
	$sqlclientes ="SELECT RUC_BENEF,NOM_PROVEEDOR,DIR_PROVEEDOR,EMAIL_PROVEEDOR FROM BENEFICIARIO WHERE RUC_BENEF='$ruc'";
	//echo "$sqlclientes";
	
	$RSClientes=odbc_exec($con,$sqlclientes);	
	
	if(odbc_num_rows($RSClientes) > 0) {
    
	    $axlistaprov1 = odbc_fetch_object($RSClientes);
	    $axlistaprov1 ->status =200;
	    echo json_encode($axlistaprov1);
      
	  } else {

	  	$error = array('status'=> 400);
	  	echo json_encode((object) $error);
	  }	



break;

case '10': //imprimir

//$axcodmovcz = $_POST['txtcodmovcz']; 
//$total_pedidos = 'Total Pedido S/. '.get_row('TOTAL_PEDIDOS','TOTALES','ID_PEDIDO_CZ',$axcodmovcz);


break;


case '11': //BUSCA PEDIDOS PENDIENTES PARA MOSTRARLO

	$axfechapedido = $_POST['txtfechaactual']; 
	$axidbeneficiario = $_POST['txtidbeneficiario']; 
	$axidlocal = $_POST['txtidlocal']; 
	

	$SqlBuscarPeidos ="SELECT * FROM PEDIDOS_CZ WHERE FECHA_PEDIDO='$axfechapedido' AND ID_BENEFICIARIO='$axidbeneficiario'AND ID_LOCAL='$axidlocal' AND ESTADO_PEDIDO='PENDIENTE'";
	$result1=odbc_exec($con,$SqlBuscarPeidos);

	//echo "$SqlBuscarPeidos";
	
	if(odbc_num_rows($result1) > 0) {

	//	$respuesta = 0; // SI HAY REGISTROS EN EL PEDIDO DEL DIA 
	//	echo $respuesta;

	$axlistaprov1 = odbc_fetch_object($result1);
    $axlistaprov1 ->status =200;
    echo json_encode($axlistaprov1);

	} else{

		$error = array('status'=> 400);
  		echo json_encode((object) $error);

	//	$respuesta = 1;// SI HAY REGISTROS PERO ESTAN PROCESADOS
	//	echo $respuesta;
	}
	break;

case '12':
	
	$axiduser = $_POST['txtidusuario']; 	
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

case '13':
	
	
	$axidempresa = $_POST['txtidempresa']; 
	$axidbeneficiario = $_POST['txtidbeneficiario']; 
	$axfechapedido = $_POST['txtfechaactual']; 

	$sql6 = "SELECT * FROM PEDIDOS_CZ WHERE ID_BENEFICIARIO = '$axidbeneficiario' AND FECHA_PEDIDO='$axfechapedido' AND ID_EMPRESA='$axidempresa '";
	
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


