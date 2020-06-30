
<?php 
session_start();
if(!$_SESSION['userId']) {

	//header('location: login1.php');	
	header('location: ../index.html');	
} 

$axusuario =  $_SESSION['userId'];
$axcodmovcz=$_GET['id'];

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
// Cabecera de página

protected $col = 0; // Columna actual
protected $y0;      // Ordenada de comienzo de la columna

function Header()

{



	global $con;
	global $fechapedido;
	global $horapedido;
	global $tipocomprobante;
	global $axcodmovcz;


	$SQLCabecera ="SELECT * from PEDIDOS_DETALLE  WHERE ID_PEDIDO_CZ='$axcodmovcz'";
	$RSCabecera=odbc_exec($con,$SQLCabecera);
	$filaRes=odbc_fetch_array($RSCabecera);

	$fechapedido= date("d-m-Y",strtotime($filaRes["FECHA_PEDIDO"]));
	$horapedido= date("H:i:s",strtotime($filaRes["HORA_PEDIDO"]));
	$tipocomprobante= "NOTA DE SALIDA";
	$cliente=$filaRes["NOM_PROVEEDOR"];
	$razonsocial  =$filaRes['RAZON_SOCIAL'];
	$ruc  =$filaRes['RUC_EMPRESA'];
	$direccion=$filaRes['DIRECCION'];

	$nomcliente=$filaRes['NOM_PROVEEDOR'];
	$dir_cliente=$filaRes['DIR_PROVEEDOR'];
	$ruc_cliente=$filaRes['RUC_BENEF'];
	
	$telefoncliente='Telefonos :'.$filaRes['TELEF_PROVEEDOR'];
	$emailcliente='Email: '.$filaRes['EMAIL_PROVEEDOR'];
	//$fechaentrega=date("d-m-Y",strtotime($filaRes["FECHA_ENTREGA"]));
	//$lugarentrega=$filaRes['LUGAR_ENTREGA'];

	/*********************************************************/
		
		
		$this->Image('../img/logodurlen.PNG',95,8,35,'C');
	    $this->SetFont('Arial','B',12);
	    $this->SetXY(5,20);
		$this->Cell(28,6,$ruc,0,0,'L');
		$this->Cell(83,6,$razonsocial,0,0,'L');
		$this->Cell(86,6,'# Pedido: '.$axcodmovcz,0,1,'R');
		$this->SetX(5);
		$this->SetFont('Arial','B',10);
		$this->Cell(152,6,$direccion,0,0,'L');	
		$this->Cell(150,5,'Fecha Pedido: '.$fechapedido,0,1,'L');	
		$this->Line(200,35,5,35);
		$this->Ln(8);
		//$this->SetXY(5,20);
		
		$this->SetFont('Arial','B',12);
	    $this->Cell(28,6,"Comprobante a nombre de:",0,1,'L');
	    $this->SetFont('Arial','',8);
	    $this->Cell(18,4,$ruc_cliente,0,0,'L');	
	    $this->Cell(28,4,utf8_decode($nomcliente),0,1,'L');		    
	    $this->Cell(28,4,utf8_decode($dir_cliente),0,1,'L');		    
	    $this->Cell(28,4,$telefoncliente,0,1,'L');	
	    $this->Cell(28,4,utf8_decode($emailcliente),0,1,'L');	
	/*
	  	$this->SetFont('Arial','B',11);
	    $this->Cell(55,7,'Fecha Entrega: '.$fechaentrega,0,0,'L');	   
	    $this->Cell(140,7,'Lugar Entrega: '.$lugarentrega,0,1,'L');
	*/	
		$this->SetFont('Arial','B',10);
	    $this->Ln(5);
	    $this->Cell(15,5,"ITEM",'TB',0,'C');
	    $this->Cell(130,5,"DETALLE DE PRODUCTO",'TB',0,'L');
	    $this->Cell(20,5,"UND",'TB',0,'C');
	    $this->Cell(25,5,"CANTIDAD",'TB',0,'R');
	  /*
	    $this->Cell(25,5,"PRECIO",'TB',0,'R');
	    $this->Cell(25,5,"SUB TOTAL",'TB',0,'R');
		*/
}

function Footer()
{
 
 /*
    $this->SetY(-15);
    $this->SetFont('Arial','I',8);
    $this->SetDrawColor(188,188,188);
	$this->Line(10,195,290,195);
    $this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'C');
*/
}


function detalle_general(){


global $axcodmovcz;
global $axitem;
global $con;


$sqldetalleventa ="SELECT * from PEDIDOS_DETALLE  WHERE ID_PEDIDO_CZ=$axcodmovcz ";
$rsdtalleventa=odbc_exec($con,$sqldetalleventa);
//$row=odbc_fetch_array($rsdtalleventa);
$this->Ln(8);
while ($row=odbc_fetch_array($rsdtalleventa)){

	$axitem = $axitem+1;

	$this->SetFont('Arial','',10);
	
	$this->Cell(15,6,$axitem,0,0,'C');	
	$this->Cell(130,6,utf8_decode($row['NOM_COMERCIAL']),0,0,'L');	
	$this->Cell(20,6,utf8_decode($row['UNIDAD']),0,0,'C');	
	$this->Cell(25,6,number_format($row['CANT_SALIDA'],2,".",","),0,1,'R');
	/*
	$this->Cell(25,5,number_format($row['PRECIO_V'],2,".",","),0,0,'R');
	$this->Cell(25,5,number_format($row['TOTAL_SALIDA'],2,".",","),0,1,'R');
	*/
}

}


function detalle_general_totales() {

	global $axcodmovcz;
	global $con;
	global $fechaentrega_1;
	global $lugarentrega_1;

	$sqltotales ="SELECT SUM(TOTAL_SALIDA) AS TT from PEDIDOS_DETALLE  WHERE ID_PEDIDO_CZ=$axcodmovcz ";
	$rstotales=odbc_exec($con,$sqltotales);

	//echo "$sqltotales";

	$this->ln(2);

	while ($row1=odbc_fetch_array($rstotales)){

		$this->SetFont('Arial','B',10);
		$this->SetX(5);
		$this->Cell(180,8,"",'T',0,'R');
		//$this->Cell(15,8,number_format($row1['TT'],2,".",","),'T',1,'R');
		$this->Cell(15,8,"",'T',1,'R');
		
		
	}

	$SQLCabecera ="SELECT * from PEDIDOS_DETALLE  WHERE ID_PEDIDO_CZ='$axcodmovcz'";
	$RSCabecera=odbc_exec($con,$SQLCabecera);
	$filaRes=odbc_fetch_array($RSCabecera);

	$fechaentrega_1=date("d-m-Y",strtotime($filaRes["FECHA_ENTREGA"]));
	$lugarentrega_1=$filaRes['LUGAR_ENTREGA'];
	$contactocliente=$filaRes['CONTACTO'];
	
	$this->SetFont('Arial','B',11);
	$this->Cell(55,6,'Fecha Entrega: '.$fechaentrega_1,0,1,'L');	   
	$this->Cell(140,6,'Lugar Entrega: '.$lugarentrega_1,0,1,'L');
	$this->Cell(140,6,'Vendedor: '.$contactocliente,0,1,'L');
}

}

// Creación del objeto de la clase heredada

//$pdf = new PDF($orientation='P',$unit='mm', array(110,160));
$pdf = new PDF('P','mm','A4');
$pdf->skipHeader = false;
$pdf->skipFooter = false;
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','B',10);
$pdf->detalle_general();
$pdf->detalle_general_totales();
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

