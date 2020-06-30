
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


		$SQLCabecera ="SELECT * from PRODUCCION_CZ  WHERE ID_PRODUCCION_CZ='$axidprod_cz'";
		$RSCabecera=odbc_exec($con,$SQLCabecera);
		$filaRes=odbc_fetch_array($RSCabecera);

		$fechaproducion= 'Fecha Producción: '.date("d-m-Y",strtotime($filaRes["FECHA_PROD"]));
		$titulo= "INFORME DE PRODUCCION - ".$axidprod_cz;
		$loteproducion='Lote de producción No '.$filaRes['LOTE_PROD'];

		//Logo
		$this->Image("../img/logodurlen.PNG" , 80 ,8, 50 , 20 , "PNG" );
		$this->Ln(20);
		//Arial bold 15
		$this->SetFont('Arial','B',15);
		//Movernos a la derecha
		//$this->Cell(3);
		//Título
		$this->Cell(190,10,$titulo,0,1,'L');
		$this->SetFont('Arial','B',12);
		$this->Cell(190,5,utf8_decode($fechaproducion),0,1,'L');
		$this->Cell(190,5,utf8_decode($loteproducion),0,1,'L');
		$this->Ln(5);
		$this->SetFont('Arial','B',12);
		$this->Cell(15,7,'INGRESOS',0,1,'L');
		$this->Cell(15,7,'IT','TB',0,'C');
		$this->Cell(130,7,'PRODUCTO TERMINADO','TB',0,'L');
		$this->Cell(25,7,'PRODUCIR','TB',0,'R');
		$this->Cell(15,7,'UND','TB',1,'C');
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


		$SQLCabecera ="SELECT * from PRODUCCION_PROD_TERMINADO WHERE ID_PRODUCCION_CZ='$axidprod_cz'";
		$RSCabecera=odbc_exec($con,$SQLCabecera);

		while ($fila_pt=odbc_fetch_array($RSCabecera)) {
			
			$it = $it+1;
			$axnomb_pt = $fila_pt['NOM_COMERCIAL'];
			$axund_pt = $fila_pt['PRES_ABREV'];
			$axcant_pt = $fila_pt['CANT_PT'];

			
			$this->SetFont('Arial','',12);
			$this->Cell(15,6,$it,0,0,'C');
			$this->Cell(130,6,utf8_decode($axnomb_pt),0,0,'L');
			$this->Cell(25,6,number_format($axcant_pt,2,".",","),0,0,'R');
			$this->Cell(15,6,$axund_pt,0,1,'C');
			

		} 
	}

	function insumos_para_producir(){

		global $con;
		global $fechaproducion;
		global $axidprod_cz,$its ;


		$SQLInsumos ="SELECT * from PRODUCCION_INSUMOS WHERE ID_PRODUCCION_CZ='$axidprod_cz'";
		$RSInsumos=odbc_exec($con,$SQLInsumos);

		$this->Ln(10);
		$this->SetFont('Arial','B',15);
		//$this->Cell(190,10,'DETALLE DE INSUMOS REQUERIDOS PARA LA PRODUCCION',0,1,'L');
		//$this->Ln(5);
		$this->SetFont('Arial','B',10);
		$this->Cell(15,6,'SALIDAS',0,1,'C');
		$this->Cell(15,6,'IT','TB',0,'C');
		$this->Cell(135,6,'DESCRIPCION DE INSUMOS NECESARIOS','TB',0,'L');
		$this->Cell(20,6,'REQUERIDO','TB',0,'R');
		$this->Cell(15,6,'UND','TB',1,'C');
		//Salto de línea
		$this->Ln(3);

		while ($fila_in=odbc_fetch_array($RSInsumos)) {
			
			$its = $its+1;
			$axid_insumo= $fila_in['ID_INSUMO'];
			$axnomb_in = $fila_in['NOM_COMERCIAL'];
			$axund_in =  get_row('INSUMOS_LISTA','UNIDAD','ID_INSUMO',$axid_insumo);
			$axcant_in = $fila_in['CANT_REQUERIDA'];
			//$this->Cell(15,8,number_format($row1['TT'],2,".",","),'T',1,'R');
			
			$this->SetFont('Arial','',10);
			$this->Cell(15,5,$its,0,0,'C');
			$this->Cell(135,5,utf8_decode($axnomb_in),0,0,'L');
			$this->Cell(20,5,number_format($axcant_in,2,".",","),0,0,'R');
			$this->Cell(15,5,$axund_in,0,1,'C');

		} 
	}

	function aprobacion_prod(){

		$this->Ln(20);
		$this->SetFont('Arial','B',15);
		$this->SetFont('Arial','B',10);
		$this->Cell(5);
		$this->Cell(40,6,'APROBADO POR','T',1,'C');
				
		//Salto de línea
		$this->Ln(3);


	}

}

$pdf = new PDF('P','mm','A4');
$pdf->skipHeader = false;
$pdf->skipFooter = false;
$title=utf8_decode('Reporte de producción');
$pdf->SetTitle($title);
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->producto_terminado();
$pdf->insumos_para_producir();
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

