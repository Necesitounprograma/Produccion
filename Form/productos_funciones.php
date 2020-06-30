<?php  

require('../Imprimir/pdf_js.php');
require_once '../core2.php';


$param=$_POST['param'];


switch ($param) {

case '0': // listar array_uintersect_uassoc(array1, array2)rios

	$axidlocal = $_POST['txtidlocal']; 
	$axbuscar = $_POST['txtbuscar']; 
	$axcategoria = $_POST['txtsubcategoria']; 

	if($axcategoria==""){

		if($axbuscar==""){

			$sql6 ="SELECT TOP 20 ID_INSUMO,COD_INSUMO,NOM_COMERCIAL,P_COMPRA,P_VENTA,STOCK_INICIAL,STOCK_ACTUAL,MARCA FROM INSUMOS_LISTA WHERE ID_LOCAL='$axidlocal'  ORDER BY NOM_COMERCIAL";

		} else{

			$sql6 ="SELECT ID_INSUMO,COD_INSUMO,NOM_COMERCIAL,P_COMPRA,P_VENTA,STOCK_INICIAL,STOCK_ACTUAL,MARCA FROM INSUMOS_LISTA WHERE  ID_LOCAL='$axidlocal' AND NOM_COMERCIAL  like '%".$axbuscar."%' ";


		}

	}else{

		if($axbuscar==""){

			$sql6 ="SELECT TOP 20 ID_INSUMO,COD_INSUMO,NOM_COMERCIAL,P_COMPRA,P_VENTA,STOCK_INICIAL,STOCK_ACTUAL FROM INSUMOS_LISTA WHERE ID_LOCAL='$axidlocal' AND ID_CATEGORIAS='$axcategoria'  ORDER BY NOM_COMERCIAL";

		} else {
				$sql6 ="SELECT ID_INSUMO,COD_INSUMO,NOM_COMERCIAL,P_COMPRA,P_VENTA,STOCK_INICIAL,STOCK_ACTUAL FROM INSUMOS_LISTA WHERE  ID_LOCAL='$axidlocal' AND ID_CATEGORIAS='$axcategoria' AND NOM_COMERCIAL  like '%".$axbuscar."%' ";

		}

		

	}

	
	//
	//echo $sql6;

	echo "
	<div id='div3'>
		<table class='table table-sm table-hover'>
		<thead>			
		<tr>
			<th scope='col' style='text-align: center;'>Código</th>
			<th scope='col'>Descripción</th>
			<th scope='col'style='text-align: left;'>Marca</th>
			<th scope='col' style='text-align: right;' >Prs. Compra</th>
			<th scope='col' style='text-align: right;' >Prs. Venta</th>
			<th scope='col' style='text-align: right;' >Stock Inicial</th>
			<th scope='col' style='text-align: right;' >Stock Actual</th>			
			<th scope='col'style='text-align: center;'>Acción</th>
		</tr>
		</thead>";
	
	$result6=odbc_exec($con,$sql6);
	
	if ($result6){
 	
 	while ($row=odbc_fetch_array($result6)){ 
 		$id = $row["ID_INSUMO"];
 		$descripcion = $row["NOM_COMERCIAL"].' | '.$row["MARCA"];
 	echo "
 		<tr> 		
 			<td style='text-align: center;'>".$row["COD_INSUMO"]."</td> 
 			<td >".$row["NOM_COMERCIAL"]."</td> 
 			<td style='text-align: left;'>".$row["MARCA"]."</td> 
 			<td style='text-align: right;' >".number_format($row["P_COMPRA"],4,".",",")."</td>
 			<td style='text-align: right;' >".number_format($row["P_VENTA"],4,".",",")."</td>
 			<td style='text-align: right;' >".number_format($row["STOCK_INICIAL"],4,".",",")."</td>
 			<td style='text-align: right;' >".number_format($row["STOCK_ACTUAL"],4,".",",")."</td>
 			<td style='text-align: center;' >
 			
 		
 				<button type='button' class='btn btn-outline-info btn-sm' id='bteditar' name='bteditar' data-id='$id' data-toggle='modal' data-target='.bd-example-modal-xl'>Editar</button>

 				<button type='button' class='btn btn-outline-danger btn-sm' id='bteliminar' name='bteliminar' data-id='$id' >Eliminar</button>
 			
 			</td> 
 		</tr>
 	";

}
echo "</table>
</div>";
}


	
break;

case '1':
	
	$axidinsumo = $_POST['txtidinsumo']; 
	$axcodinsumo = $_POST['txtcodinsumo']; 
	$axidcatego = $_POST['txtidcategoria']; 
	$axcodbarra = $_POST['txtcodbarra']; 

	$axnominsumo = $_POST['txtnombreinsumo']; 
	$axunidad = $_POST['txtunidad']; 
	$axtipocond = $_POST['txttipocondicion']; 

	$axprscompra = $_POST['txtprscompra']; 
	$axprsventa = $_POST['txtprsventa']; 

	$axidempresa = $_POST['txtidempresa']; 
    
   	$axnomgenerico = $_POST['txtnomgenerico']; 
	$axcomposicion = $_POST['txtcomposicion']; 
	$axlaboratorio =$_POST['txtlaboratorio']; 
	$axcondventa = $_POST['txtcondventa']; 
	$axdestinocontable = $_POST['txtdestinocontable']; 
	$axidlocal = $_POST['txtidlocal']; 
	$axparametros = $_POST['txtparametros']; 
	$axstockinicial= $_POST['txtstockinicial']; 
    $axstockactual= $_POST['txtstockactual']; 
    $axtiponegocio= $_POST['txttiponegocio']; 
    $axpresentacion_C= $_POST['txtpresentacion_C']; 
    $axstock_minimo= $_POST['txtstock_minimo']; 
    $axporc_dscto= $_POST['txtporc_dscto']; 

	if($axparametros==1){

		$Insertar = "INSERT INTO INSUMOS (COD_INSUMO,ID_CATEGORIAS,COD_BARRA,NOM_COMERCIAL,NOM_GENERICO,COMPOSICION,ID_PRES,CONDICION_VENTA,TIPO_CONDICION,P_COMPRA,P_VENTA,ID_EMPRESA,DESTINO_CONTABLE,LABORATORIO,STOCK_ACTUAL,STOCK_INICIAL,ID_LOCAL,TIPO_NEGOCIO,PRESENTACION_C,STOCK_MINIMO,PORC_DSCTO) VALUES ('$axcodinsumo','$axidcatego','$axcodbarra','$axnominsumo','$axnomgenerico','$axcomposicion','$axunidad','$axcondventa','$axtipocond','$axprscompra','$axprsventa','$axidempresa','$axdestinocontable','$axlaboratorio','$axstockactual','$axstockinicial','$axidlocal','$axtiponegocio','$axpresentacion_C','$axstock_minimo','$axporc_dscto')";
//echo "$Insertar";
		
	} else {

		$Insertar ="UPDATE INSUMOS SET COD_INSUMO='$axcodinsumo',ID_CATEGORIAS='$axidcatego',COD_BARRA='$axcodbarra',NOM_COMERCIAL='$axnominsumo',NOM_GENERICO='$axnominsumo',COMPOSICION='$axcomposicion',ID_PRES='$axunidad',CONDICION_VENTA='$axcondventa',TIPO_CONDICION='$axtipocond',P_COMPRA='$axprscompra',P_VENTA='$axprsventa',ID_EMPRESA='$axidempresa',DESTINO_CONTABLE='$axdestinocontable',LABORATORIO='$axlaboratorio',STOCK_ACTUAL='$axstockactual',STOCK_INICIAL='$axstockinicial',ID_LOCAL='$axidlocal',TIPO_NEGOCIO='$axtiponegocio',PRESENTACION_C='$axpresentacion_C',STOCK_MINIMO='$axstock_minimo',PORC_DSCTO='$axporc_dscto' WHERE ID_INSUMO='$axidinsumo'";
			
	}

	//echo "$Insertar";

	$result6=odbc_exec($con,$Insertar); 

	if($result6){

		$actualizaparamentro ="UPDATE PARAMETROS SET COD_IN=COD_IN+1 WHERE ID_EMPRESA='$axidempresa'";
		$rsparametros=odbc_exec($con,$actualizaparamentro);

		$respuesta = 0;
		echo"$respuesta"; // grabado




	}else{
		
		$respuesta = 1;
		echo"$respuesta"; // no grabado

	}





break;


case '2':
	
$axidinsumo= $_POST['axidinsumo'];
	
	$sql6 = "SELECT * FROM INSUMOS WHERE ID_INSUMO = '$axidinsumo'";
	
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

$axidcatego= $_POST['txtidcategoria'];
$axidempresa= $_POST['txtidempresa'];
	
$axcodcatego=get_row('CATEGORIAS','COD_CATEGO','ID_CATEGORIAS',$axidcatego);

//$axnum1= get_row('PARAMETROS','COD_IN','ID_EMPRESA',$axidempresa);
$axnum1 = $_POST['txtcodigo'];

$axnum = str_pad($axnum1+1, 5, "0", STR_PAD_LEFT);

$axcodinsumo = $axcodcatego.$axnum;
echo "$axcodinsumo";

break;

case '4':
	
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

case '5':

$axidempresa= $_POST['txtidempresa'];

$sql6 = "SELECT * FROM CATEGORIAS WHERE ID_EMPRESA = '$axidempresa' ORDER BY ID_CATEGORIAS";
$rspermisos=odbc_exec($con,$sql6);
//echo "$sql6";
while ($row=odbc_fetch_array($rspermisos)){

	$axcod = $row['COD_CATEGO'];
	$idcatego= $row['ID_CATEGORIAS'];
	//echo "$idcatego";

	$sqlconsulta = "SELECT * FROM INSUMOSDATA WHERE ID_CATEGORIAS= '$idcatego' ORDER BY ID_INSUMO";
	$rsconsulta=odbc_exec($con,$sqlconsulta);

	//echo "$sqlconsulta";

	while ($row_1=odbc_fetch_array($rsconsulta)){

		$axidinsumo = $row_1['ID_INSUMO'];
		$contador = $contador+1;
		$numero = str_pad($contador, 4, "0", STR_PAD_LEFT);
		$codnuevo= $axidempresa.$axcod.$numero;

		//echo $codnuevo .'|';

		$actual = "UPDATE INSUMOSDATA SET COD_INSUMO='$codnuevo',COD_BARRA='$codnuevo' WHERE ID_INSUMO='$axidinsumo'";
		$rsactual=odbc_exec($con,$actual);

		//echo "$actual";

	}

		$contador = 0;
		$numero = 0;
		$codnuevo =0;
}

break;

case '6':

$axidinsumo= $_POST['txtidinsumo'];
$axidlocal= $_POST['txtidlocal'];

$sqlbuscar = "SELECT * FROM STOCK_ACTUAL WHERE ID_LOCAL = '$axidlocal' AND ID_INSUMO='$axidinsumo'";
$rsbuscar=odbc_exec($con,$sqlbuscar);
//echo $sqlbuscar;

if(odbc_num_rows($rsbuscar) > 0){

	while ($row=odbc_fetch_array($rsbuscar)){

		$respuesta = $row['STOCK'];
		echo"$respuesta"; // Si existe
	}
		
} else {
	
	$respuesta ="NO";
	echo"$respuesta"; // No existe existe

}

break;

case '7':	

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

case '8':
  $axbuscaremisor =$_POST['txtlaboratorio'];
    $axidetapa =$_POST['txtidlocal'];
		
	if(isset($_POST["txtlaboratorio"])){

	$output ='';
	$idprov ='';

	$sqlemisor = "SELECT DISTINCT(LABORATORIO) FROM INSUMOS WHERE ID_LOCAL ='$axidetapa' and LABORATORIO LIKE  '%".$axbuscaremisor."%' ORDER BY LABORATORIO";
	//echo $sqlemisor;

	$rsemisor=odbc_exec($con,$sqlemisor);
	$output ='<ul id="listar" class="list-unstyled ul">';

	if(odbc_num_rows($rsemisor) > 0){
		 while ($row=odbc_fetch_array($rsemisor)){

		 	$output .='<li id="listar_marca" class="li" data-nom_emisor='.$row["LABORATORIO"].'>'.$row["LABORATORIO"].'</li>';
		 }

	}else{
		$output .='';
		//$output .='<li id="linuevoregistro" class="li" data-toggle="modal" data-target=".bd-example-modal-xl">'.$_POST["txtnom_cliente"]. '(Registrar)</li>';
	
	}

	$output .='</ul>';
	echo $output;

}
break;

case '9':
	
$axbuscaremisor =$_POST['txtcomposicion'];
    $axidetapa =$_POST['txtidlocal'];
		
	if(isset($_POST["txtcomposicion"])){

	$output ='';
	$idprov ='';

	$sqlemisor = "SELECT DISTINCT(COMPOSICION) FROM INSUMOS WHERE ID_LOCAL ='$axidetapa' and COMPOSICION LIKE  '%".$axbuscaremisor."%' ORDER BY COMPOSICION";
	//echo $sqlemisor;

	$rsemisor=odbc_exec($con,$sqlemisor);
	$output ='<ul id="listar" class="list-unstyled ul">';

	if(odbc_num_rows($rsemisor) > 0){
		 while ($row=odbc_fetch_array($rsemisor)){

		 	$output .='<li id="listar_sabor" class="li" data-nom_emisor='.$row["COMPOSICION"].'>'.$row["COMPOSICION"].'</li>';
		 }

	}else{
		$output .='';
		//$output .='<li id="linuevoregistro" class="li" data-toggle="modal" data-target=".bd-example-modal-xl">'.$_POST["txtnom_cliente"]. '(Registrar)</li>';
	
	}

	$output .='</ul>';
	echo $output;

}

break;

case '10':

	$axcodmovcz =$_POST['axidinsumo'];
	
	$sql6 = "DELETE FROM INSUMOS WHERE ID_INSUMO = '$axcodmovcz'";
	$result1=odbc_exec($con,$sql6);

	 if ($result1){

		 	$respuesta = 0; // ELIMINADO
		 	echo "$respuesta";

		 } else {

		 	$respuesta = 1; // NO ELIMINADO
		 	echo "$respuesta";

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