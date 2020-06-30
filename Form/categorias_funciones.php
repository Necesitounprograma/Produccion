<?php  

require('../Imprimir/pdf_js.php');
require_once '../core2.php';


$param=$_POST['param'];


switch ($param) {

case '0': // listar usuarios

	$axidempresa = $_POST['txtidempresa']; 
	$axbuscarcategorias = $_POST['txtbuscarcategorias']; 

	if($axbuscarcategorias==""){
		
		$sql6 ="SELECT ID_CATEGORIAS,COD_CATEGO+' '+NOM_CATEGORIA AS CATEGO,NOM_SUBCATEGORIA FROM CATEGORIAS WHERE ID_EMPRESA='$axidempresa' ORDER BY COD_CATEGO";

	}else{

		$sql6 ="SELECT ID_CATEGORIAS,COD_CATEGO+' '+NOM_CATEGORIA AS CATEGO,NOM_SUBCATEGORIA FROM CATEGORIAS WHERE ID_EMPRESA='$axidempresa' AND COD_CATEGO+' '+NOM_CATEGORIA  like '%".$axbuscarcategorias."%' ";

	}
	
	//echo "$sql6";

	echo "
		<table class='table table-sm table-hover'>
        <!--table class='table table-sm'-->
		<thead>			
		<tr>
			<th scope='col'>Categoria</th>
			<th scope='col'>Sub Categoria</th>
			<th scope='col'>Acción</th>
		</tr>
		</thead>";
	
	$result6=odbc_exec($con,$sql6);
	
	if ($result6){
 	
 	while ($row=odbc_fetch_array($result6)){ 
 		$idcatego = $row["ID_CATEGORIAS"];
 	echo "
 		<tr> 		
 			<td >".$row["CATEGO"]."</td> 
 			<td >".$row["NOM_SUBCATEGORIA"]."</td> 
 			<td ><a href='#' class='btn btn-outline-info btn-sm' id='bteditarcatego' name='bteditarcatego' data-idcatego='$idcatego' data-toggle='modal' data-target='.bd-example-modal-xl'>Editar</a></td> 
 		</tr>
 	";

}
echo "</table>";
}


	
break;

case '1':
	
	$axidcatego = $_POST['txtidcategoria']; 
	$axidempresa = $_POST['txtidempresa']; 
	$axcodcatego = $_POST['txtcodcatgo']; 
	$axnomcategoria = $_POST['txtnomcategoria']; 
	$axnomsucategoria = $_POST['txtsubcategoria']; 
	$axdetallecateg = $_POST['txtdetallecategoria']; 
	$axtiponegocio = $_POST['txttiponegocio']; 
	
	$axparametros = $_POST['txtparametros']; 

	if($axparametros==1){

		$Insertar = "INSERT INTO CATEGORIAS (COD_CATEGO,ID_EMPRESA,NOM_CATEGORIA,NOM_SUBCATEGORIA,DETALLE_CATEGORIA,TIPO_NEGOCIO) VALUES ('$axcodcatego','$axidempresa','$axnomcategoria','$axnomsucategoria','$axdetallecateg','$axtiponegocio')";
//echo "$Insertar";
		
	} else {

		$Insertar ="UPDATE CATEGORIAS SET COD_CATEGO='$axcodcatego',ID_EMPRESA='$axidempresa',NOM_CATEGORIA='$axnomcategoria',NOM_SUBCATEGORIA='$axnomsucategoria',DETALLE_CATEGORIA='$axdetallecateg',TIPO_NEGOCIO='$axtiponegocio' WHERE ID_CATEGORIAS='$axidcatego'";
			
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
	
$axidcodcatego= $_POST['axidcodcatego'];
	
	$sql6 = "SELECT * FROM CATEGORIAS WHERE ID_CATEGORIAS = '$axidcodcatego'";
	
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
?>