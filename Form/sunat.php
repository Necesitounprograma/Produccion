
<?php 

	$ruc = $_POST['txtruc'];
	$data = file_get_contents("https://api.sunat.cloud/ruc/".$ruc);
	//$data = file_get_contents("https://cors-anywhere.herokuapp.com/wmtechnology.org/Consultar-RUC/?modo=1&btnBuscar=Buscar&nruc=".$ruc);
	

	$info = json_decode($data,true);

	if($data==='[]' || $info['fecha_inscripcion']==='--'){
		$datos = array(0 => 'nada');
		echo json_encode($datos);
	}else{
		$datos =array(
			0 => $info['ruc'],
			1 => $info['razon_social'],
			2 => $info['domicilio_fiscal'],
			3 => $info['contribuyente_estado'],
			4 => $info['representante_legal'],
			5 => $info['contribuyente_condicion']	

			
		);

		echo json_encode($datos);

	}

?>