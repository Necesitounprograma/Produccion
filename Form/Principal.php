<?php 
	
//$ruc = $_GET['rucempresa'];
//echo $ruc;
require_once '../includes/header.php'; 



?>


<!DOCTYPE html>
	<html>
	<head>
		
	</head>
	<body style="margin: 0; padding: 0;  background: url(../img/fondo.jpg) no-repeat center top;  background-size: cover;  font-family: sans-serif;  height: 100vh;">
	<br>
	<input type="hidden" name="txtcodusuario" id="txtcodusuario" value="<?php echo "$axiduser";?>">
	<div class="container" id="divresumen">

		<!--div class="card border-danger">

	  		<h5 class="card-header text-white bg-danger mb-3">Resumen de ventas Entradas y Cursos</h5>

	  		<div class="card-body">

	  			<div class="form-row">

	  					<div class="form-group col-md-10">
					    	<label for="txtidlocal">Congreso</label>
							<select class="form-control custom-select mr-sm-2" id="txtidlocal">
							<?php while($fila=odbc_fetch_array($rslocales)) {?>
	    					<option value="<?php echo $fila['ID_LOCAL'];?>"><?php echo $fila['DESCRICION_LC'];?></option><?php } ?>
	    					</select>
						</div>

						<div class="form-group col-md-2">
							<label for="txtbuscar">Fecha actual</label>
							<input type="text" class="form-control" id="txtfechactual" name="txtfechactual" aria-describedby="basic-addon3"  value="<?php echo "$diaactual";?>" style="text-align: center;" disabled>
						</div>

	  			</div>

	
				<br>
		    	<div class="row">
				<div class="col-sm-6">
				<div class="card border-danger">
				<div class="card-body">
			    <h5 class="card-title text-primary"><b>Entradas</b></h5>
			    
				<div id="divlistarentradas"></div>
				</div>
				</div>
				</div>
				<br>
				<div class="col-sm-6">
				<div class="card border-danger">
				<div class="card-body">
				<h5 class="card-title text-primary"><b>Cursos Pre-Congreso</b></h5>
				
				<div id="divlistarcursos"></div>
				</div>
				</div>
				</div>
				</div>
				<br>
				<div class="row">
				<div class="col-sm-12">
				<div class="card border-danger">
				<div class="card-body">
			    <h5 class="card-title text-primary"><b>Gastos realizados</b></h5>
			    
				<div id="divlistartotalgastos"></div>
				</div>
				</div>
				</div>
				</div>

			</div>

		</div-->




	</div>


	</body>
	</html>	

	
