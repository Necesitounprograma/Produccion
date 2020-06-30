<?php  

require('../Imprimir/pdf_js.php');
require_once '../core2.php';


$param=$_POST['param'];


switch ($param) {

case '0': // listar usuarios

	$axidempresa = $_POST['txtidempresa']; 
	$axtipobenef = $_POST['txttipobeneficiario']; 
	$axbuscar = $_POST['txtbuscar']; 
	$axestado_radio = $_POST['estado_radio']; 

	if($axestado_radio=="TODOS"){

		if($axbuscar==""){

			$sql6 ="SELECT ID_BENEFICIARIO,RUC_BENEF,NOM_PROVEEDOR,TIPO_PROV_CLIE,TELEF_PROVEEDOR,DIR_PROVEEDOR,ID_DOC  FROM BENEFICIARIO WHERE TIPO_PROV_CLIE ='$axtipobenef'  ORDER BY TIPO_PROV_CLIE";

		}else{

			$sql6 ="SELECT ID_BENEFICIARIO,RUC_BENEF,NOM_PROVEEDOR,TIPO_PROV_CLIE,TELEF_PROVEEDOR,DIR_PROVEEDOR,ID_DOC FROM BENEFICIARIO WHERE TIPO_PROV_CLIE ='$axtipobenef' AND RUC_BENEF+' '+NOM_PROVEEDOR  like '%".$axbuscar."%' ";
		}

	} else {

		if($axbuscar==""){

			$sql6 ="SELECT TOP 10 ID_BENEFICIARIO,RUC_BENEF,NOM_PROVEEDOR,TIPO_PROV_CLIE,TELEF_PROVEEDOR,DIR_PROVEEDOR,ID_DOC  FROM BENEFICIARIO WHERE TIPO_PROV_CLIE ='$axtipobenef'  ORDER BY TIPO_PROV_CLIE";

		}else{

			$sql6 ="SELECT ID_BENEFICIARIO,RUC_BENEF,NOM_PROVEEDOR,TIPO_PROV_CLIE,TELEF_PROVEEDOR,DIR_PROVEEDOR,ID_DOC FROM BENEFICIARIO WHERE TIPO_PROV_CLIE ='$axtipobenef' AND RUC_BENEF+' '+NOM_PROVEEDOR  like '%".$axbuscar."%' ";
		}


	}

	

	//echo "$axestado_radio";
	//echo "$sql6";

	echo "
		<table class='table table-sm table-hover'>
		<thead>			
		<tr>
			<!--th class='ver' scope='col' style='text-align: center;'>Cód</th-->
			<th class='ver' scope='col' style='text-align: center;'>RUC / DNI</th>
			<th scope='col'>Razón Social</th>
			<!--th class='ver' scope='col'>Dirección</th-->
			<th class='ver' scope='col' style='text-align: center;'>Telefonos</th>
			<th scope='col'style='text-align: center;'>Acción</th>
		</tr>
		</thead>";
	
	$result6=odbc_exec($con,$sql6);
	
	if ($result6){
 	
 	while ($row=odbc_fetch_array($result6)){ 
 		$id = $row["ID_BENEFICIARIO"];
 	echo "
 		<tr> 		
 			<!--td class='ver' style='text-align: center;'>".$row["ID_BENEFICIARIO"]."</td--> 
 			<td class='ver' style='text-align: center;'>".$row['ID_DOC'].' | '.$row["RUC_BENEF"]."</td> 
 			<td >".$row["NOM_PROVEEDOR"]."</td> 
 			<!--td class='ver' >".$row["DIR_PROVEEDOR"]."</td--> 
 			<td class='ver' style='text-align: center;' >".$row["TELEF_PROVEEDOR"]."</td>
 			<td style='text-align: center;' ><a href='#' class='btn btn-outline-info btn-sm' id='bteditar' name='bteditar' data-id='$id' data-toggle='modal' data-target='.bd-example-modal-xl'>Editar</a></td> 
 		</tr>
 	";

}
echo "</table>";
}


	
break;

case '1':
	
	$axidbeneficiario = $_POST['txtidbeneficiario']; 
	$axtipobenef = $_POST['txttipobeneficiario']; 
	$axcalificacion = $_POST['txtcalificar']; 
	$axiddoc = $_POST['txttipodoc']; 
	$axruc = $_POST['txtruc1']; 
	$axnombenefi = $_POST['txtnombeneficiario1']; 
	$axdirbenefi = $_POST['txtdireccion1']; 	
	$axcodubig = $_POST['txtdistrito']; 	
	$axtelefbenefi = $_POST['txttelefonos']; 	
	$axemailbenefi = $_POST['txtemail']; 	
	$axgirobenefi = $_POST['txtgiro']; 	
	
	$axcondicionb = 0;
	$axcontabenef = 0;
	$axvenedbenefi = 0;
	$axsector = 0;
	$axcumple = ""; 	
	$axclave = 0;	
	$axprofesion= 0; 	
	$axtrabajo = 0; 	

	$axpais = $_POST['txtpais']; 	

	$axparametros = $_POST['txtparametros']; 

	if($axparametros==1){

		

			$Insertar = "INSERT INTO BENEFICIARIO (TIPO_PROV_CLIE,CALIFIC_PROVEEDOR,ID_DOC,RUC_BENEF,NOM_PROVEEDOR,DIR_PROVEEDOR,COD_UBI,TELEF_PROVEEDOR,EMAIL_PROVEEDOR,GIRO_PROVEEDOR,CONDICION_B,CONTACTO,NOM_VENDEDOR,SECTOR,CUMPLE,CLAVE_VENTA,PROFESION,CENTRO_LABORAL,PAIS) VALUES ('$axtipobenef','$axcalificacion','$axiddoc','$axruc','$axnombenefi','$axdirbenefi','$axcodubig','$axtelefbenefi','$axemailbenefi','$axgirobenefi','$axcondicionb','$axcontabenef','$axvenedbenefi','$axsector','$axcumple','$axclave','$axprofesion','$axtrabajo','$axpais')";

		

		
	} else {
		$Insertar ="UPDATE BENEFICIARIO SET TIPO_PROV_CLIE='$axtipobenef',CALIFIC_PROVEEDOR='$axcalificacion',ID_DOC='$axiddoc',RUC_BENEF='$axruc',NOM_PROVEEDOR='$axnombenefi',DIR_PROVEEDOR='$axdirbenefi',COD_UBI='$axcodubig',TELEF_PROVEEDOR='$axtelefbenefi',EMAIL_PROVEEDOR='$axemailbenefi',GIRO_PROVEEDOR='$axgirobenefi',CONDICION_B='$axcondicionb',CONTACTO='$axcontabenef',NOM_VENDEDOR='$axvenedbenefi',SECTOR='$axsector',CUMPLE='$axcumple',CLAVE_VENTA='$axclave',PROFESION='$axprofesion',CENTRO_LABORAL='$axtrabajo',PAIS='$axpais' WHERE ID_BENEFICIARIO='$axidbeneficiario'";
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
	
$axidbeneficiario= $_POST['axidbeneficiario'];
	
	$sql6 = "SELECT * FROM BENEFICIARIO WHERE ID_BENEFICIARIO = '$axidbeneficiario'";
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

case '3':

	$axdistrito= $_POST['codubi'];

	 $sql6 = "SELECT COD_UBI,UBIGEO FROM UBIGEO WHERE COD_UBI like'$axdistrito%'" ;
	 
	 //echo "$sql6";
	      
	    $result6=odbc_exec($con,$sql6);
	    echo "<select class='form-control custom-select mr-sm-2' id='txtdistrito' name='txtdistrito'>";
	    while($Ubig1=odbc_fetch_array($result6)){

	        echo "<option value='".$Ubig1["COD_UBI"]."'";
	        echo ">".utf8_encode($Ubig1["UBIGEO"])."</option>";

	       
    }
    echo "</select>";




break;

case '4':
	

	 $axiddepa= $_POST['txtdepartamento'];

	 $sql6 = "SELECT ID_PROV,PROVINCIA FROM UBIGEO_PROVINCIAS WHERE ID_PROV like'$axiddepa%'" ;
	 
	 //echo "$sql6";
	      
	    $result6=odbc_exec($con,$sql6);
	    echo "<select class='form-control custom-select mr-sm-2' id='txtprovincia' name='txtprovincia'>";
	    while($Ubig1=odbc_fetch_array($result6)){

	        echo "<option value='".$Ubig1["ID_PROV"]."'";
	        echo ">".utf8_encode($Ubig1["PROVINCIA"])."</option>";

	       
    }
    echo "</select>";


break;

case '5':
	
	$axidprov= $_POST['txtprovincia'];
 	$sql6 = "SELECT COD_UBI,UBIGEO FROM UBIGEO WHERE COD_UBI like'$axidprov%'" ;
 
 //echo "$sql6";
      
    $result6=odbc_exec($con,$sql6);
    echo "<select class='form-control custom-select mr-sm-2' id='txtdistrito' name='txtdistrito'>";
    while($Ubig1=odbc_fetch_array($result6)){

        echo "<option value='".$Ubig1["COD_UBI"]."'";
        echo ">".utf8_encode($Ubig1["UBIGEO"])."</option>";

       
    }
    echo "</select>";



break;




case '6':
	
	$axiddepa= $_POST['txtdepartamento'];

	 $sql6 = "SELECT ID_DEPA,DEPARTAMENTO FROM UBIGEO_DEPARTAMENTO WHERE ID_DEPA like'$axiddepa%'" ;
	 
	 //echo "$sql6";
	      
	    $result6=odbc_exec($con,$sql6);
	    echo "<select class='form-control custom-select mr-sm-2' id='txtdepartamento' name='txtdepartamento'>";
	    while($Ubig1=odbc_fetch_array($result6)){

	        echo "<option value='".$Ubig1["ID_DEPA"]."'";
	        echo ">".utf8_encode($Ubig1["DEPARTAMENTO"])."</option>";

	    }
	
	    echo "</select>";


break;

case '7':
	
	$axidprov= $_POST['axidprov'];

	 $sql6 = "SELECT ID_PROV,PROVINCIA FROM UBIGEO_PROVINCIAS WHERE ID_PROV like'$axidprov%'" ;
 
	    $result6=odbc_exec($con,$sql6);
    	echo "<select class='form-control custom-select mr-sm-2' id='txtprovincia' name='txtprovincia'>";
	    while($Ubig1=odbc_fetch_array($result6)){

	        echo "<option value='".$Ubig1["ID_PROV"]."'";
	        echo ">".utf8_encode($Ubig1["PROVINCIA"])."</option>";

	       
    }
    echo "</select>";

	

break;

case '8':
	
	$axiddepa= $_POST['txtdepartamento'];

	 $sql6 = "SELECT ID_DEPA,DEPARTAMENTO FROM UBIGEO_DEPARTAMENTO ";
	 
	 //echo "$sql6";
	      
	    $result6=odbc_exec($con,$sql6);
	    echo "<select class='form-control custom-select mr-sm-2' id='txtdepartamento' name='txtdepartamento'>";
	    while($Ubig1=odbc_fetch_array($result6)){

	        echo "<option value='".$Ubig1["ID_DEPA"]."'";
	        echo ">".utf8_encode($Ubig1["DEPARTAMENTO"])."</option>";

	    }
	
	    echo "</select>";



break;

case '9':
	
	$axbuscarvendedor = $_POST["txtvendedor"];
	$axtipo = $_POST["txttipobeneficiario"];

	if(isset($_POST["txtvendedor"])){
	$output ='';
	$idprov ='';

	$sql9 = "SELECT DISTINCT(NOM_VENDEDOR) AS VENDEDOR FROM BENEFICIARIO WHERE TIPO_PROV_CLIE ='$axtipo' AND  NOM_VENDEDOR like '%".$axbuscarvendedor."%' ORDER BY NOM_VENDEDOR";

	//echo "$sql9";

	$result1=odbc_exec($con,$sql9);
	$output ='<ul id="ulvendedor" class="list-unstyled ul">';

	if(odbc_num_rows($result1) > 0){
		 while ($row=odbc_fetch_array($result1)){
		 	$output .='<li id="livendedor" class="li" data-idarti='.$row["VENDEDOR"].'>'.$row["VENDEDOR"].'</li>';
		 }
	}else{
		$output .='<li id="livendedorregistro" class="li">'.$axbuscarvendedor. '(Registrar)</li>';

	}

	$output .='</ul>';
	echo $output;

}


break;

case '10':

	$axbuscarvendedor = $_POST["txtsector"];
	$axtipo = $_POST["txttipobeneficiario"];

	if(isset($_POST["txtsector"])){
	$output ='';
	$idprov ='';

	$sql9 = "SELECT DISTINCT(SECTOR) AS SECTOR FROM BENEFICIARIO WHERE TIPO_PROV_CLIE ='$axtipo' AND  SECTOR like '%".$axbuscarvendedor."%' ORDER BY SECTOR";

	//echo "$sql9";

	$result1=odbc_exec($con,$sql9);
	$output ='<ul id="ulsector" class="list-unstyled ul">';

	if(odbc_num_rows($result1) > 0){
		 while ($row=odbc_fetch_array($result1)){
		 	$output .='<li id="lisector" class="li" data-idarti='.$row["SECTOR"].'>'.$row["SECTOR"].'</li>';
		 }
	}else{
		$output .='<li id="lisectorregistro" class="li">'.$axbuscarvendedor. '(Registrar)</li>';

	}

	$output .='</ul>';
	echo $output;

}

break;

case '12':

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

case '13':
	
	$axidbeneficiario = $_POST['txtidbeneficiario']; 
	$axtipobenef = $_POST['txttipobeneficiario']; 
	$axcalificacion = $_POST['txtcalificar']; 
	$axiddoc = $_POST['txttipodoc']; 
	$axruc = $_POST['txtruc']; 
	$axnombenefi = $_POST['txtnombeneficiario']; 
	$axdirbenefi = $_POST['txtdireccion']; 	
	$axcodubig = $_POST['txtdistrito']; 	
	$axtelefbenefi = $_POST['txttelefonos']; 	
	$axemailbenefi = $_POST['txtemail']; 	
	$axgirobenefi = $_POST['txtgiro']; 	
	$axcondicionb = $_POST['txttipocondicion']; 
	$axcontabenef = $_POST['txtcontacto']; 
	$axvenedbenefi = $_POST['txtvendedor']; 	
	$axsector = $_POST['txtsector']; 	
	$axcumple = $_POST['txtfechanac']; 	
	$axclave = $_POST['txtclave']; 	

	$axprofesion = $_POST['txtprofesion']; 	
	$axtrabajo = $_POST['txtcentrolaboral']; 	
	$axpais = $_POST['txtpais']; 	

	$axparametros = $_POST['txtparametros']; 

	$axctadetraccion = $_POST['txtctadetraccion']; 
	$axctapago = $_POST['axctapago']; 
	$axccipago = $_POST['axccipago']; 
	$axbancopago = $_POST['axbancopago']; 

	if($axparametros==1){

		$Insertar = "INSERT INTO BENEFICIARIO (TIPO_PROV_CLIE,CALIFIC_PROVEEDOR,ID_DOC,RUC_BENEF,NOM_PROVEEDOR,DIR_PROVEEDOR,COD_UBI,TELEF_PROVEEDOR,EMAIL_PROVEEDOR,GIRO_PROVEEDOR,CONDICION_B,CONTACTO,NOM_VENDEDOR,SECTOR,CUMPLE,CLAVE_VENTA,PROFESION,CENTRO_LABORAL,PAIS,CTA_DETRACCION,CTA_PAGOS,CCI_PAGOS,BANCO_PAGOS) VALUES ('$axtipobenef','$axcalificacion','$axiddoc','$axruc','$axnombenefi','$axdirbenefi','$axcodubig','$axtelefbenefi','$axemailbenefi','$axgirobenefi','$axcondicionb','$axcontabenef','$axvenedbenefi','$axsector','$axcumple','$axclave','$axprofesion','$axtrabajo','$axpais','$axctadetraccion','$axctapago','$axccipago','$axbancopago')";
	} else {
		$Insertar ="UPDATE BENEFICIARIO SET TIPO_PROV_CLIE='$axtipobenef',CALIFIC_PROVEEDOR='$axcalificacion',ID_DOC='$axiddoc',RUC_BENEF='$axruc',NOM_PROVEEDOR='$axnombenefi',DIR_PROVEEDOR='$axdirbenefi',COD_UBI='$axcodubig',TELEF_PROVEEDOR='$axtelefbenefi',EMAIL_PROVEEDOR='$axemailbenefi',GIRO_PROVEEDOR='$axgirobenefi',CONDICION_B='$axcondicionb',CONTACTO='$axcontabenef',NOM_VENDEDOR='$axvenedbenefi',SECTOR='$axsector',CUMPLE='$axcumple',CLAVE_VENTA='$axclave',PROFESION='$axprofesion',CENTRO_LABORAL='$axtrabajo',PAIS='$axpais',CTA_DETRACCION='$axctadetraccion',CTA_PAGOS='$axctapago',CCI_PAGOS='$axccipago',BANCO_PAGOS='$axbancopago' WHERE ID_BENEFICIARIO='$axidbeneficiario'";
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

case '14':
	$axruc = $_POST['txtruc']; 

	$slqduplicado="SELECT * FROM BENEFICIARIO WHERE RUC_BENEF='$axruc'";
	$rsduplicado = odbc_exec($con, $slqduplicado);

		if(odbc_num_rows($rsduplicado) > 0) {

			$respuesta = 0;
			echo"$respuesta"; // existe
		} else{

			$respuesta = 1;
			echo"$respuesta"; // no existe

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