
<?php 
session_start();
if(!$_SESSION['userId']) {

	//header('location: login1.php');	
	header('location: ../index.html');	
} 

$axusuario = $_SESSION['userId'];
$axidprod_cz=$_GET['idprodcz'];
$axidlocal=$_GET['idlocal'];


require('../Imprimir/fpdf.php');

define('DB_HOST', 'SOFTCAT2020\SQLEXPRESS');//DB_HOST:  generalmente suele ser "127.0.0.1"
define('DB_USER', 'sa');//Usuario de tu base de datos
define('DB_PASS', '123456');//Contraseña del usuario de la base de datos
define('DB_NAME', 'ProduccionSJL');//Nombre de la base de datos

/*
define('DB_HOST', 'www.evolean.pro');//DB_HOST:  generalmente suele ser "127.0.0.1"
define('DB_USER', 'sa');//Usuario de tu base de datos
define('DB_PASS', 'auditek*1');//Contrase�a del usuario de la base de datos
define('DB_NAME', 'ProduccionSJL');//Nombre de la base de datos
*/

$connection_string = "DRIVER={SQL Server};SERVER=".DB_HOST.";DATABASE=".DB_NAME; 
$con = odbc_connect($connection_string,DB_USER,DB_PASS);


class PDF extends FPDF {
   //Columna actual
   var $col=0;
   //Ordenada de comienzo de la columna
   var $y=0;
   //Cabecera de página
	function Header(){

		global $con;
		global $fechaproducion;
		global $axidprod_cz;
		global $axidlocal;


		$SQLCabecera ="SELECT * from LOGISTICA_DOCUMENTOS_CZ  WHERE ID_LOGISTICA_CZ='$axidprod_cz' AND ID_LOCAL ='$axidlocal'";
		$RSCabecera=odbc_exec($con,$SQLCabecera);
		$filaRes=odbc_fetch_array($RSCabecera);

		$axnum_orden = $filaRes['TIPO_DOCUMENTO'].' - '.$filaRes['NUM_DOCUMENTO'];
		$axruc = 'RUC: '.$filaRes['RUC_EMPRESA'];
		$axrazon_social= $filaRes['RAZON_SOCIAL'];
		$axdireccion_empresa= $filaRes['DIRECCION'];
		$axtelefonos_empresa='Telefonos: '.$filaRes['TELEFONO'];
		$axemail_empresa= 'Email: '.$filaRes['EMAIL_EMPRESA'];
		$axfecha_emision = 'Fecha Emisión: '.date("d-m-Y",strtotime($filaRes['FECHA_EMISION']));
		$axfecha_entrega = 'Fecha Entrega: '.date("d-m-Y",strtotime($filaRes['FECHA_ENTREGA']));
		$axhora_entrega = 'Hora Entrega: '.$filaRes['HORA_ENTREGA'];
		$axlugar_entrega = 'Lugar Entrega: '.$filaRes['LUGAR_ENTREGA'];

		$axproveedor = 'RUC :'.$filaRes['RUC_BENEF'].' '.$filaRes['NOM_PROVEEDOR'];
		$axdirproveedor_1 = 'Dirección :'.$filaRes['DIR_PROVEEDOR'];
		$axtelef_proveedor = 'Telefonos :'.$filaRes['TELEF_PROVEEDOR'];
		$axemail_proveedor = 'Email :'.$filaRes['EMAIL_PROVEEDOR'];
		$axvendedor= 'Vendedor :'.$filaRes['NOM_VENDEDOR'];
		//echo $filaRes['FORMA_PAGO'];

		if(strlen($axdirproveedor_1) > 100){
			 //echo strlen($axdirproveedor_1);
			 $axdirproveedor = substr($axdirproveedor_1,0,55).'...';

		}else{

			 $axdirproveedor = $axdirproveedor_1;
		}

		if($filaRes['FORMA_PAGO']=='CONTADO'){
			$axforma_pago= 'Forma pago: '.$filaRes['FORMA_PAGO'];		
			//echo $axforma_pago;
		}else{
			
			//$axforma_pago= 'Forma pago: '.$filaRes['FORMA_PAGO'].' | '.$filaRes['MEDIO_PAGO'].' | '.$filaRes['DIAS_PAGO'] ;		
			$axforma_pago= 'Forma pago: '.$filaRes['MEDIO_PAGO'].' '.$filaRes['DIAS_PAGO'] ;		
			//echo $axforma_pago;
		}

		//Logo
		$this->Image("../img/logodurlen.PNG" , 8 ,5, 50 , 20 , "PNG" );
		$this->Ln(15);
		//Arial bold 15
		$this->SetFont('Arial','B',15);
		//Movernos a la derecha
		//$this->Cell(3);
		//Título
		$this->Cell(190,8,$axnum_orden,0,1,'R');
		$this->Cell(100,6,$axruc,0,0,'L');		
		$this->Cell(90,6,utf8_decode($axfecha_emision),0,1,'R');
		$this->SetFont('Arial','B',7.5);
		//$this->Cell(190,5,utf8_decode($axdireccion_empresa),0,1,'L');
		
		$this->MultiCell(100,4,utf8_decode($axdireccion_empresa), 0, 'L', 0, 1, '', '', true);
		$this->Cell(100,4,utf8_decode($axtelefonos_empresa),0,1,'L');
		$this->Cell(190,6,utf8_decode($axemail_empresa),'B',1,'L');
		$this->Ln(1);
		
		$this->SetFont('Arial','B',13);
		$this->Cell(120,7,utf8_decode('PROVEEDOR'),'B',0,'L');
		$this->Cell(70,7,utf8_decode('ENVIE A'),'B',1,'L');
		
		$this->SetFont('Arial','B',10);
		$this->Cell(120,5,utf8_decode($axproveedor),0,0,'L');
		$this->Cell(70,5,utf8_decode($axlugar_entrega),0,1,'L');

		$this->Cell(120,5,utf8_decode($axvendedor),0,0,'L');
		$this->Cell(70,5,utf8_decode($axfecha_entrega),0,1,'L');

		$this->Cell(120,5,utf8_decode($axtelef_proveedor),0,0,'L');
		$this->Cell(70,5,utf8_decode($axhora_entrega),0,1,'L');

		$this->Cell(120,5,utf8_decode($axemail_proveedor),0,0,'L');
		$this->Cell(70,5,utf8_decode($axforma_pago),0,1,'L');

		$this->MultiCell(120,5,utf8_decode($axdirproveedor), 0, 'L', 0, 0, '', '', true);
		

		$this->Ln(3);
		$this->SetFont('Arial','B',10);
		$this->Cell(10,6,'IT','TB',0,'C');
		$this->Cell(15,6,'CODIGO','TB',0,'C');
		$this->Cell(90,6,'DESCRIPCION','TB',0,'L');
		$this->Cell(15,6,'UND','TB',0,'C');
		$this->Cell(20,6,'CANT','TB',0,'R');
		$this->Cell(20,6,'PRECIO','TB',0,'R');
		$this->Cell(20,6,'PARCIAL','TB',1,'R');
		
		//Salto de línea
		$this->Ln(3);
	
		   
	}

//Pie de página
	function Footer() {
	//Posición: a 1,5 cm del final
	$this->SetY(-15);
	//Arial italic 8
	$this->SetFont('Arial','I',8);
	//Número de página
	$this->Cell(0,10,'Page '.$this->PageNo(),0,0,'C');
	}


	function producto_terminado(){

		global $con;
		global $fechaproducion;
		global $axidprod_cz,$it ;


		$SQLCabecera ="SELECT * from LOGISTICA_DOCUMENTOS WHERE ID_LOGISTICA_CZ='$axidprod_cz'";
		$RSCabecera=odbc_exec($con,$SQLCabecera);

		while ($fila_pt=odbc_fetch_array($RSCabecera)) {
			
			$it = $it+1;
			$id_insumos = str_pad($fila_pt['ID_INSUMO'], 6, "0", STR_PAD_LEFT);
			$axnomb_pt = $fila_pt['NOM_COMERCIAL'];
			$axund_pt = $fila_pt['PRES_ABREV'];
			$axcant_pt = $fila_pt['CANT_COMPRA'];
			$axprecio = $fila_pt['PRECIO_C'];
			$axvalor_compra = $fila_pt['VALOR_INGRESO'];

			
			$this->SetFont('Arial','',10);
			$this->Cell(10,5,$it,0,0,'C');
			$this->Cell(15,5,$id_insumos,0,0,'C');
			$this->Cell(90,5,utf8_decode($axnomb_pt),0,0,'L');
			$this->Cell(15,5,$axund_pt,0,0,'C');
			$this->Cell(20,5,number_format($axcant_pt,2,".",","),0,0,'R');
			$this->Cell(20,5,number_format($axprecio,2,".",","),0,0,'R');
			$this->Cell(20,5,number_format($axvalor_compra,2,".",","),0,1,'R');
		} 
	}

	function totales(){

		global $con;
		global $fechaproducion;
		global $axidprod_cz,$its ;


		$SQLInsumos ="SELECT SUM(VALOR_INGRESO) AS VV, SUM(IGV_INGRESO) AS IG, SUM(TOTAL_INGRESO) AS TC from LOGISTICA_DOCUMENTOS WHERE ID_LOGISTICA_CZ='$axidprod_cz'";
		$RSInsumos=odbc_exec($con,$SQLInsumos);

			$this->Ln(3);
			

		while ($fila_in=odbc_fetch_array($RSInsumos)) {
			
			$axvalor_venta = $fila_in['VV'];
			$axigv = $fila_in['IG'];
			$axtotal_venta = $fila_in['TC'];

			$this->SetFont('Arial','B',10);
			$this->Cell(190,6,'','B',1,'C');
			$this->Cell(170,6,'VALOR VENTA',0,0,'R');
			$this->Cell(20,6,number_format($axvalor_venta,2,".",","),0,1,'R');

			$this->Cell(170,6,'IGV',0,0,'R');
			$this->Cell(20,6,number_format($axigv,2,".",","),0,1,'R');

			$this->Cell(170,6,'IMPORTE TOTAL','B',0,'R');
			$this->Cell(20,6,number_format($axtotal_venta,2,".",","),'B',1,'R');
			
		} 
	}

	function aprobacion_prod(){
		
		global $axidprod_cz,$its;
		
		$this->Ln(10);
		$this->SetFont('Arial','B',10);
		$solicitado = get_row('LOGISTICA_CZ','SOLICITADO_POR','ID_LOGISTICA_CZ',$axidprod_cz);
		$this->Cell(40,6,'SOLICITADO POR: ',0,0,'L');
		$this->Cell(90,6,$solicitado,0,1,'L');
			
		$this->Cell(40,6,'APROBADO POR: ',0,0,'L');
		$this->Cell(90,6,'CANGALAYA ISLA ELITA ALEJANDRINA',0,1,'L');

		//Salto de línea
		$this->Ln(3);


	}

}

$tipo = get_row('LOGISTICA_CZ','TIPO_DOCUMENTO','ID_LOGISTICA_CZ',$axidprod_cz);
$numero = get_row('LOGISTICA_CZ','NUM_DOCUMENTO','ID_LOGISTICA_CZ',$axidprod_cz);


$pdf = new PDF('P','mm','A4');
$pdf->skipHeader = false;
$pdf->skipFooter = false;
$title=utf8_decode($tipo.' '.$numero);
$pdf->SetTitle($title);
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->producto_terminado();
$pdf->totales();
$pdf->aprobacion_prod();

//$pdf->detalle_general_totales();
$pdf->skipHeader = true;


$pdf->Output();




 
function get_row($table,$col, $id, $equal){
	global $con;
	$querysql="select top 1 $col from $table where $id='$equal' order by $col desc";
	$query=odbc_exec($con,$querysql);
	$rw=odbc_fetch_array($query);
	$value=$rw[$col];
	return $value;
}


?>

