<?php  

require('../Imprimir/pdf_js.php');
require_once '../core2.php';


$param=$_POST['param'];


switch ($param) {

case '0': // listar usuarios

	$axidempresa = $_POST['txtidempresa']; 
	$axbuscaregistro = $_POST['txtbuscarusuario']; 

	if($axbuscaregistro==""){
		
		$sql6 ="SELECT ID_USUARIO,ID_EMPRESA,NOM_USUARIO,CARGO,USUARIO FROM USUARIO WHERE ID_EMPRESA='$axidempresa'";

	}else{

		$sql6 ="SELECT ID_USUARIO,ID_EMPRESA,NOM_USUARIO,CARGO,USUARIO FROM USUARIO WHERE ID_EMPRESA='$axidempresa' AND USUARIO like '%".$axbuscaregistro."%' ";

	}
		
	echo "
		<!--table class='table table-hover'-->
		<table class='table table-hover table-sm'>
		<thead>			
		<tr>
			<th scope='col'>NOMBRES</th>
			<th scope='col'>CARGO</th>
			<th scope='col'>ACCION</th>
		</tr>
		</thead>";
	
	$result6=odbc_exec($con,$sql6);
	
	if ($result6){
 	
 	while ($row=odbc_fetch_array($result6)){ 
 		$iduser = $row["ID_USUARIO"];
 	echo "
 		<tr> 		
 			<td >".$row["USUARIO"]."</td>
 			<td >".$row["CARGO"]."</td> 
 			<td ><a href='#' class='btn btn-outline-info btn-sm' id='bteditarusuario' name='bteditarusuario' data-iduser='$iduser' data-toggle='modal' data-target='.bd-example-modal-xl'>Editar</a></td> 
 		</tr>
 	";

}
echo "</table>";
}


	
break;

case '1':
	
	$axidempresa = $_POST['txtidempresa']; 
	$sql6 ="SELECT ID_MENU,NOM_MENU FROM MENU ORDER BY NOM_MENU ASC";
	//echo "$sql6";

	echo "
		
  		
  		<table class='table table-sm table-hover'>
  		<thead>
		<tr>
		  	<th scope='col'>Menu</th>
			<th scope='col'>Acción</th>
		</tr>
		<thead>
		
	";

	$result6=odbc_exec($con,$sql6);
	if ($result6){
 		while ($row=odbc_fetch_array($result6)){ 
 			$id = $row["ID_MENU"];
 		echo "
 			<tr> 		
 				<td >".$row["NOM_MENU"]."</td>
 				<td >
 					<a href='#' class='btn btn-outline-info btn-sm' id='txtasignarpermiso' data-idmenu='$id'>Asignar</a>
 				</td> 
 			</tr>
 		";
}
echo "</table>";
}


break;

case '2':
	
	$axidempresa = $_POST['txtidempresa']; 
	$axidusuario = $_POST['txtidusuario']; 
	$axcoduser = $_POST['txtdniusuario']; 
	$axuser = $_POST['txtusuario']; 
	$axnomusuario = $_POST['txtnombreusuario']; 
	$axclave = $_POST['txtclave']; 
	$axcargo = $_POST['txtcargo']; 
	$axfecharegistro = $_POST['txtfecharegistro'];
	$axcondicion = $_POST['txtcondicion'];
	$axparametros = $_POST['txtparametros']; 

	if($axparametros==1){

		$Insertar = "INSERT INTO USUARIO (ID_EMPRESA,COD_USER,USUARIO,NOM_USUARIO,CLAVE,CARGO,F_REGISTRO,CONDICION) VALUES ('$axidempresa','$axcoduser','$axuser','$axnomusuario','$axclave','$axcargo','$axfecharegistro','$axcondicion')";
//echo "$Insertar";
		
	} else {

		//$Insertar = "UPDATE MAESTRO_DT SET ESTADO_ATENCION='KIOSKO',HORA_INICIO='$axhoractual' WHERE COD_MOV='$axcodmovCZ'";

		$Insertar ="UPDATE USUARIO SET ID_EMPRESA='$axidempresa',COD_USER='$axcoduser',USUARIO='$axuser',NOM_USUARIO='$axnomusuario',CLAVE='$axclave',CARGO='$axcargo',F_REGISTRO='$axfecharegistro',CONDICION='$axcondicion' WHERE ID_USUARIO='$axidusuario'";
			
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

case '3':

	$axcoduser= $_POST['txtdniusuario'];
	
	$sql6 = "SELECT * FROM USUARIO WHERE COD_USER = '$axcoduser'";
	
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

case '4':
	
	$axidusuario = $_POST['txtidusuario']; 
	$axfecharegistro = $_POST['txtfecharegistro']; 
	$axparametros = $_POST['txtparametros']; 
	$axidmenu = $_POST['axidmenu']; 
	$axidpermiso = $_POST['txtidpermiso']; 

//	if($axparametros==1){

		$Insertar = "INSERT INTO USUARIO_MENU (ID_USUARIO,FECHA_ASIGNACION,ID_MENU) VALUES ('$axidusuario','$axfecharegistro','$axidmenu')";
//echo "$Insertar";
		
//	} else {

//		$Insertar ="UPDATE USUARIO_MENU SET ID_USUARIO='$axidempresa',FECHA_ASIGNACION='$axcoduser',ID_MENU='$axuser' WHERE ID_PERMISO='$axidpermiso'";
			
//	}

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

case '5':
	
	$axidusuario = $_POST['txtidusuario']; 

	$sql6 ="SELECT * FROM MENU_ASIGNADO WHERE ID_USUARIO='$axidusuario' ORDER BY NOM_USUARIO ASC";
	//echo "$sql6";

	echo "
		
  		<table class='table table-hover table-sm'>
  		<thead>
		<tr>
		  
			<th scope='col'>Acceso a</th>
			<th scope='col'>Acción</th>

		</tr>
		<thead>
		
	";

	$result6=odbc_exec($con,$sql6);
	if ($result6){
 		while ($row=odbc_fetch_array($result6)){ 
 			$idpermiso = $row["ID_PERMISO"];
 			$idusuario = $row["ID_USUARIO"];
 			$idmenu = $row["ID_MENU"];
 			
 		echo "
 			<tr> 		
 				<td >".$row["NOM_MENU"]."</td>
 				<td >
 					<a href='#' class='btn btn-outline-danger btn-sm' id='btquitarmenu' data-idmenu='$idmenu'>Quitar</a>
 				</td> 
 			</tr>
 		";
}
echo "</table>";
}




break;

case '6':
	
	$axidusuario = $_POST['txtidusuario']; 
	$axfecharegistro = $_POST['txtfecharegistro']; 
	$axparametros = $_POST['txtparametros']; 
	$axidetapa = $_POST['txtetapapy']; 
	$axidasignacion = $_POST['txtidasinacion']; 


	$Insertar = "INSERT INTO USUARIOS_LC (ID_USUARIO,FECHA_ASIGNACION,ID_LOCAL) VALUES ('$axidusuario','$axfecharegistro','$axidetapa')";
	$result6=odbc_exec($con,$Insertar); 

	if($result6){

		$SQLActualizar = "UPDATE USUARIO SET ID_LOCAL='$axidetapa' WHERE ID_USUARIO='$axidusuario'";
		$RSActualizar=odbc_exec($con,$SQLActualizar); 

		$respuesta = 0;
		echo"$respuesta"; // grabado


	}else{
		
		$respuesta = 1;
		echo"$respuesta"; // no grabado

	}



break;

case '7':
	
	$axidusuario = $_POST['txtidusuario']; 

	$sql6 ="SELECT * FROM LOCAL_ASIGNADO WHERE ID_USUARIO='$axidusuario' ORDER BY DESCRICION_LC ASC";
	//echo "$sql6";

	echo "
		
  		<table class='table table-hover'>
  		<thead>
		<tr>
		  
			<th scope='col'>Acceso a</th>
			<th scope='col'>Acción</th>

		</tr>
		<thead>
		
	";

	$result6=odbc_exec($con,$sql6);
	if ($result6){
 		while ($row=odbc_fetch_array($result6)){ 
 			$idasignacion = $row["ID_ASIGNACION"];
 			
 		echo "
 			<tr> 		
 				<td >".$row["DESCRICION_LC"]."</td>
 				<td >
 					<a href='#' class='btn btn-outline-danger btn-sm' id='txtquitaretapa' data-idasignetapa='$idasignacion'>Quitar</a>
 				</td> 
 			</tr>
 		";
}
echo "</table>";
}

break;

case '8':

	$axcoduser= $_POST['axiduser'];
	
	$sql6 = "SELECT * FROM USUARIO WHERE ID_USUARIO = '$axcoduser'";
	
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


case '9':
	
	$axidmenu = $_POST['axidmenu'];
	$axidusuario = $_POST['txtidusuario'];
	

	 $sql ="DELETE FROM USUARIO_MENU WHERE ID_MENU='$axidmenu' AND ID_USUARIO ='$axidusuario' ";
     $result6=odbc_exec($con,$sql); 



break;

case '10':
	
	$idasignetapa = $_POST['idasignetapa'];	
	$axidusuario = $_POST['txtidusuario'];
	
	$sql ="DELETE FROM USUARIOS_LC WHERE ID_ASIGNACION='$idasignetapa' AND ID_USUARIO ='$axidusuario'";
    $result6=odbc_exec($con,$sql); 



break;

case '11':
	
	$axiduser = $_POST['txtcodusuario']; 	
	$axpermiso = $_POST['axpermiso']; 
	

	$sql6 = "SELECT * FROM MENU_ASIGNADO WHERE ID_USUARIO = '$axiduser' and NOM_MENU='TOTAL'";
	$rspermisos=odbc_exec($con,$sql6);
	echo $sql6;

	if(odbc_num_rows($rspermisos) == 1){

		$respuesta = 0;
		echo"$respuesta"; // ACCESO TOTAL

	} else {

		$sql7 = "SELECT * FROM MENU_ASIGNADO WHERE ID_USUARIO = '$axiduser' and NOM_MENU='$axpermiso'";
		$rspermisos7=odbc_exec($con,$sql7);
		echo $sql7;

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