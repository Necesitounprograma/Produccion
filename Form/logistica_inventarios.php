<?php require_once '../includes/header.php'; ?>


<!DOCTYPE html>
	<html>
	<head>
	</head>

	<style type="text/css">

	.ul{
    background-color: #000;
    cursor: pointer;;
    }

  .li{
    /*padding: 10px;*/
      display:block; 
      width:100%;
      padding: 3px 0px;
      color:#000;
      background-color:#DBEBF6;
      text-decoration:none;
  }

  .li:hover{
    /*padding: 10px;*/
      display:block; 
      width:100%;
      padding: 3px 0px;
      color:#000;
      background-color:#DBEBF6;
      text-decoration:none;
  }
		
		#ulclientes{
	    background-color: #000;
	    cursor: pointer;
	    }

		#liclientes{
		   /* padding: 10px;*/
		    display:block; 
		  width:100%;
		  padding: 3px 0px;
		  color:#000;
		  background-color:#DBEBF6;
		  text-decoration:none;
		  }


		#liclientes:hover{
		   /* padding: 10px;*/
		    display:block; 
		  width:100%;
		  padding: 3px 0px;
		  color:#000;
		  background-color:#356AA0;
		  text-decoration:none;
		  }
		  

	</style>


<body onload="mueveReloj()">
<br>

<input type="hidden" name="txtidempresa" id="txtidempresa" value="<?php echo "$axidempresa";?>">
<input type="hidden" name="txtcodusuario" id="txtcodusuario" value="<?php echo "$axcoduser";?>">
<input type="hidden" name="txtano_actual" id="txtano_actual" value="<?php echo "$anoactual";?>">
<input type="hidden" class="form-control" id="txtidbeneficiario">		
<input type="hidden" name="txtcodmovcz" id="txtcodmovcz" >
<input type="hidden" name="txtidinsumo" id="txtidinsumo" >
<input type="hidden" name="txtparametro" id="txtparametro" value="0">
<input type="hidden" name="txtid_logistica_cz" id="txtid_logistica_cz">

<input type="hidden" name="txtordenar" id="txtordenar" value="0">
<input type="hidden" name="txtparametro_lista" id="txtparametro_lista" value="I">
<input type="hidden" name="txtparametro_lista_doc" id="txtparametro_lista_doc" value="SI_VER">


<div class="container-fluid" id="divcontenedor1">
	<div class="card-body" id="divcabecera_1" >
		<div class="row" >
			<div class="col-12">

			<div class="card border-info">
				<div class="card-header text-white bg-info" id="divcabecer" >
					<b>
						<h4 class="text-white">
							<img src="../icon/logistica.png" style="width: 30px; height: 30px;"> Inventarios y Logistica
								
						</h4>
					</b>

					<div class="form-row">
						
						<div  class="col-sm-3">
							<label for="txtidlocal"><b>Local</b></label>
							<select class="form-control custom-select mr-sm-2" id="txtidlocal">
							<option value="SELECCIONAR">SELECCIONAR</option>
							<?php while($fila=odbc_fetch_array($rslocales)) {?>
					    	<option value="<?php echo $fila['ID_LOCAL'];?>"><?php echo $fila['DESCRICION_LC'];?></option><?php } ?>
					    	</select>
						</div>

						<!--div  class="col-sm-3">
							<label for=""><b>Estado</b></label>				
							
							<select id="txtestado_pedido" class="form-control">
								<option value="PENDIENTE">PENDIENTE</option>
								<option value="PROCESADO">PROCESADO</option>
								
							</select>

						</div-->

						<div  class="col-sm-3">
							<label for=""><b>Fecha</b></label>				
							<input type="date" class="form-control" name="txtfechaactual" id="txtfechaactual" value="<?php echo "$diaactual";?>" style="text-align: center;">
						</div>

						<div  class="col-sm-3">
							<label for="reloj"><b>Hora</b></label>
							<form name="form_reloj">
							<b><input type="text" style="text-align: center;" class="form-control" id="reloj" name="reloj" aria-describedby="	basic-addon3"></b>
							<input type="hidden" name="txthoraactual" id="txthoraactual">
							</form>
						</div>
					</div>

				</div>

				<div class="card-body text-dark" >
				<div class="col-12" id="divlistaproductospedidos">				
					
					<div class="card border-info">
					  <div class="card-header text-white bg-info">
					    <ul class="nav nav-tabs card-header-tabs">
					      <li class="nav-item">
					        <a class="nav-link active text-dark" id="pninventarios" href="#">Inventario actual</a>
					      </li>
					      <li class="nav-item">
					        <a class="nav-link text-white" href="#" id="pnlogistica" >Listado de documentos</a>
					      </li>
					    </ul>
					  </div>
					  <div class="card-body">
							<div id="divform_busqueda">

								<div class="form-row" >									
									<div  class="col-sm-3">
									<label for=""><b>Categorias</b> </a></label>		
									<select id="txtsubcategoria" class="form-control"></select>	
									</div>
									<div  class="col-sm-4">
									<label for=""><b>Buscar | Ordenar</b> <a href="#" id="btordenar"><i class="fas fa-sort-numeric-up"></i></a></label>		
									<input type="text" class="form-control" id="txtbuscar" style="text-align: center;" placeholder="Descripción Insumos | Producto terminado o fraccionado">
									</div>
								</div>
								<p><hr></p>
								<div id="divinventarios"></div>
								
							</div>

							<div id="divlogistica" style="display: none;">

								<div class="row">
									<div class="col-12">
										<div class="form-row">

										  	<div  class="col-sm-3">
											
											<div class="input-group mb-3">
											  <select id="txttipo_doc" class="form-control">
												<option value="ORDEN COMPRA">ORDEN COMPRA</option>
												<option value="ORDEN SERVICIO">ORDEN SERVICIO</option>
											</select>	
											  <div class="input-group-append">
											     <a href="#"  class='btn btn-outline-success' id='bnuevo_documento'>Nuevo documento </a> 
											  </div>
											</div>

											</div>

											<div  class="col-sm-5">
											
											<div class="input-group mb-3">
											  <input type="text" class="form-control" id="txtbuscar_documento" style="text-align: center;" placeholder="Ruc | Proveedor | Num. Orden ">
											  <div class="input-group-append">
											     <a href="#"  class='btn btn-outline-info' id='btbuscar_documento'>Buscar</a> 
											  </div>
											</div>

											</div>

										</div>

									</div>
									<p><hr></p>			


								</div>
								<div id="divlistardocumentos" ></div>	

							<div id="divform_ordenes" style="display: none;">
								<div class="row">
								<div class="col-12 col-lg-6">
								    <div class="card border-danger">
								      <div class="card-body">
								        <h5 class="card-title"></h5>
								        
											<div class="form-row">
												
												<div  class="col-sm-3">
												<label for=""><b>No Docum</b></label>		
												<input type="text" class="form-control" id="txtnum_documento" style="text-align: center;" disabled="true">
												</div>

												<div  class="col-sm-7">
												<label for=""><b>Proveedor</b></label>
												
												<input type="text" class="form-control" id="txtnom_proveedor" style="text-align: center;">
												<div id="div_listarclientes"></div>
												</div>

												<div  class="col-sm-2">
												<label for=""><b>IGV</b></label>												
												<input type="text" class="form-control" id="txtigv" style="text-align: center;" value="18">
												</div>


											</div>

											<div class="form-row">
												
												<div  class="col-sm-4">
												<label for=""><b>Fec. Emisión</b></label>		
												<input type="date" class="form-control" id="txtfecha_emision" value="<?php echo "$diaactual";?>" style="text-align: center;">
												</div>

												<div  class="col-sm-4">
												<label for=""><b>Fec. Entrega</b></label>		
												<input type="date" class="form-control" id="txtfecha_entrega" value="<?php echo "$diaactual";?>" style="text-align: center;">
												</div>

												<div  class="col-sm-4">
												<label for=""><b>Hora Entrega</b></label>		
												<input type="text" class="form-control" id="txthora_entrega" style="text-align: center;">
												</div>

											</div>

								      </div>
								    </div>
								  </div>
								  <div class="col-12 col-lg-6">
								    <div class="card border-danger">
								      <div class="card-body">
								        <h5 class="card-title"></h5>
								        
								        	<div class="form-row">
												
												<div  class="col-sm-6">
												<label for=""><b>Forma Pago</b></label>		
												<select id="txtforma_pago" class="form-control">
													<option value="">SELECCIONAR</option>
													<option value="CONTADO">CONTADO</option>
													<option value="CREDITO">CREDITO</option>
												</select>
												</div>

												<div  class="col-sm-3">
												<label for=""><b>No dias</b></label>		
												<input type="text" class="form-control" id="txtdias_pago" style="text-align: center;">
												</div>

												<div  class="col-sm-3">
												<label for=""><b>F.Pago</b></label>		
												<input type="text" class="form-control" id="txtfecha_pago" value="<?php echo "$diaactual";?>" style="text-align: center;">
												</div>

											</div>

											<div class="form-row">
												
												<div  class="col-sm-3">
												<label for=""><b>Medio Pago</b></label>		
												<select id="txtmedio_pago" class="form-control">
													<option value="">SELECCIONAR</option>
													<option value="EFECTIVO">EFECTIVO</option>
													<option value="TRANSFERENCIA">TRANSFERENCIA</option>
													<option value="DEPOSITO">DEPOSITO</option>
													<option value="CHEQUE">CHEQUE</option>
													<option value="LETRAS">LETRAS</option>
													<option value="PAGARE">PAGARE</option>

												</select>
												</div>

												<div  class="col-sm-3">
												<label for=""><b>Estado</b></label>		
												<select id="txtestado_pago" class="form-control">
													<option value="PENDIENTE">PENDIENTE</option>
													<option value="CANCELADO">CANCELADO</option>
												</select>
												</div>

												<div  class="col-sm-6">
												<label for=""><b>Solicitado</b></label>		
												<input type="text" class="form-control" id="txtsolicitado_por" style="text-align: center;">
												</div>
	
											</div>

								      </div>
								    </div>
								  </div>
								  
								</div>
							
								<div style="text-align: right; padding: 5px;">
								<a href="#"  class='btn btn-outline-success btn-sm' id='btgrabar_cabecera'>Detallar</a>
								<a href="#"  class='btn btn-outline-danger btn-sm' id="btcancelar_1" >Cancelar</a>
								</div>

								</div>


								<div id="divform_ordenes_detalle" style="display: none;">
									
									<div class="row">
									  <div class="col-sm-5">
									    <div class="card border-info">
									      <div class="card-body">

									        <div class="form-row" >
											  	<div  class="col-sm-10">
											  	<label for=""><b>Buscar</b></label>		
												<input type="text" class="form-control" id="txtbuscar_insumo_comprar" style="text-align: center;" placeholder="Descripción Insumos | Producto terminado o fraccionado">
												</div>

												<div  class="col-sm-2">
											  	<label for=""><b>Cant</b></label>		
												<input type="text" class="form-control" id="txtcant_insumo_comprar" style="text-align: center;" value="0">
												</div>

											</div>
											<p><hr></p>
									        <div id="divlistar_insumos_comprar"></div>

									      </div>
									    </div>
									  </div>
									  <div class="col-sm-7">
									    <div class="card border-info">
									      <div class="card-body" id="divdetalle_compras"></div>
									    </div>
									  </div>
									</div>

								</div>	<!--div id="divform_ordenes_detalle" style="display: none;"-->

						
							</div>					
					  </div>
					</div>

				</div>	
				</div>		


				</div>

			</div>
			</div>
		</div>
	</div>
</div>



<!---------------------------------------------------------------------------->
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="titulo_modal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="titulo_modal">Relación de Insumos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
		<div class="modal-body" >
			<input type="hidden" name="txtid_insumo_cambiar" id="txtid_insumo_cambiar">
		
			<div class="form-row" >
				<div  class="col-sm-12" >
					<label for="">
					<b>Buscar | Ordenar</b> <a href="#" id="btordenar_insumos"><i class="fas fa-sort-numeric-up"></i></a>
					</label>				
					<input type="text" class="form-control" id="txtbuscar_insumo" style="text-align: center;" placeholder="Descripción de Insumo">
				</div>
			</div>

			<div class="modal-body" id="divlistar_insumos"></div>


		</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cerrar</button>       
      </div>
    </div>
  </div>
</div>

<!---------------------------------------------------------------------------->



</body>
</html>	

<script type="text/javascript">

$(document).ready(function() {	
	
	Verifica_permiso();
	//listar_categorias()
	

});

/***********************************************/

function listar_categorias() {
		
	var axidempresa = $("#txtidempresa").val();	
		
	$.ajax({

		url:"logistica_inventarios_funciones.php",
		method: "POST",
		data: {param:15,txtidempresa:axidempresa},
		success : function(lsitarcatego){
			$("#txtsubcategoria").html(lsitarcatego);
		}
	})
}


$(document).on("click","#btimprimir_docu",function(){
	
	var axidlocal = $("#txtidlocal").val();
	var axid_logistica_cz = $(this).data("id_log_cz");

	window.open("logistica_inventarios_reporte.php?idprodcz="+axid_logistica_cz+"&idlocal="+axidlocal);			
})


$(document).on("click","#btimprimir_documento",function(){
	
	var axidlocal = $("#txtidlocal").val();
	var axid_logistica_cz = $(this).data("id_log_cz");

	window.open("logistica_inventarios_reporte.php?idprodcz="+axid_logistica_cz+"&idlocal="+axidlocal);			
})



$(document).on("click","#bteliminar_documento",function(){

	var axidlocal = $("#txtidlocal").val();
	var axid_logistica_cz = $(this).data("id_log_cz");
	//alert(axid_logistica_cz);

	Swal.fire({
		  title: 'Esta seguro de eliminar el registro?',
		  text: "Una vez eliminado, no podrá recuperarlo!",
		  type: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  confirmButtonText: 'Si eliminar!'
		}).then((result) => {

		  if (result.value) {
				  	
			$.ajax({

				url:"logistica_inventarios_funciones.php",
				method: "POST",
				data: {	param:14,axid_logistica_cz:axid_logistica_cz,txtidlocal:axidlocal},	
				success : function(data){

					listar_documentos_emitidos();
								
				}
			})

		  }

	})

})



$(document).on("blur","#precio_modificar",function(){

var axidlocal = $("#txtidlocal").val();
var axprecio_modificar = $(this).text();
var axid_insumo = $(this).data('id_insumo');
var axid_logistica_cz = $("#txtid_logistica_cz").val();
var axporc_igv= $("#txtigv").val();

//alert(axcant_modificar);

if(isNaN(axprecio_modificar)){
	
	Swal.fire("Aviso", "No es un número el dato que desea registrar", "error");

} else{

	$.ajax({

		url:"logistica_inventarios_funciones.php",
		method: "POST",
		
		data: {param:13,
			txtid_logistica_cz:axid_logistica_cz,
			axprecio_modificar:axprecio_modificar,
			axid_insumo:axid_insumo,
			txtidlocal:axidlocal,
			txtigv:axporc_igv

			},	
			success : function(data){
			
				if(data==0){
					listar_insumos_comprados()	
				}else{
					Swal.fire("Aviso", "No se actualizo el registro...", "error");
				}
			}
		})


}


})


$(document).on("blur","#cant_modificar",function(){

var axidlocal = $("#txtidlocal").val();
var axcant_modificar = $(this).text();
var axid_insumo = $(this).data('id_insumo');
var axid_logistica_cz = $("#txtid_logistica_cz").val();
var axporc_igv= $("#txtigv").val();

//alert(axcant_modificar);

if(isNaN(axcant_modificar)){
	
	Swal.fire("Aviso", "No es un número el dato que desea registrar", "error");

} else{

	$.ajax({

		url:"logistica_inventarios_funciones.php",
		method: "POST",
		
		data: {param:12,
			txtid_logistica_cz:axid_logistica_cz,
			axcant_modificar:axcant_modificar,
			axid_insumo:axid_insumo,
			txtidlocal:axidlocal,
			txtigv:axporc_igv

			},	
			success : function(data){
			
				if(data==0){
					listar_insumos_comprados()	
				}else{
					Swal.fire("Aviso", "No se actualizo el registro...", "error");
				}
			}
		})


}


})



$(document).on("click","#bteditar_documento",function(){

	var axidlocal = $("#txtidlocal").val();
	var axid_logistica_cz = $(this).data("id_log_cz");
	//alert(axid_logistica_cz);
	$.ajax({

		url:"logistica_inventarios_funciones.php",
		method: "POST",
		data: {	param:11,
			
			axid_logistica_cz:axid_logistica_cz,
			txtidlocal:axidlocal						
		},	

		success : function(data){
			
			var json = JSON.parse(data);

			if (json.status == 200){

				$("#divform_ordenes").css({'display':'block'});
				$("#divlistardocumentos").css({'display':'none'});
				$("#txtparametro").val(1);
				$("#txtparametro_lista_doc").val("NO_VER");
				$("#bnuevo_documento").css({'pointer-events':'none'});
				$("#txttipo_doc").css({'pointer-events':'none'});
				$("#txtbuscar_documento").css({'pointer-events':'none'});
				$("#btbuscar_documento").css({'pointer-events':'none'});


				$("#txtid_logistica_cz").val(json.ID_LOGISTICA_CZ);		
				$("#txtidlocal").val(json.ID_LOCAL);
				$("#txttipo_doc").val(json.TIPO_DOCUMENTO);
				$("#txtnum_documento").val(json.NUM_DOCUMENTO);
				$("#txtidbeneficiario").val(json.ID_BENEFICIARIO);	
				$("#txtnom_proveedor").val(json.PROVEEDOR);	
				$("#txtfecha_emision").val(json.FECHA_EMISION);
				$("#txtfecha_entrega").val(json.FECHA_ENTREGA);
				$("#txthora_entrega").val(json.HORA_ENTREGA);
				$("#txtforma_pago").val(json.FORMA_PAGO);
				$("#txtdias_pago").val(json.DIAS_PAGO);
				$("#txtfecha_pago").val(json.FECHA_PAGO);
				$("#txtmedio_pago").val(json.MEDIO_PAGO);
				$("#txtestado_pago").val(json.ESTADO_FORMA_PAGO);
				$("#txtsolicitado_por").val(json.SOLICITADO_POR);
				
				
			}
				
		}
	})

})


$(document).on("click","#btbuscar_documento",function(){
	listar_documentos_emitidos();
})


$(document).on("click","#btcancelar_1",function(){

	$("#divform_ordenes").css({'display':'none'});
	$("#divlistardocumentos").css({'display':'block'});
	$("#bnuevo_documento").css({'pointer-events':'auto'});
	$("#txttipo_doc").css({'pointer-events':'auto'});
	$("#txtbuscar_documento").css({'pointer-events':'auto'});
	$("#btbuscar_documento").css({'pointer-events':'auto'});

	listar_documentos_emitidos()
})


$(document).on("click","#btcancelar_2",function(){

	$("#divform_ordenes").css({'display':'none'});
	$("#divlistardocumentos").css({'display':'block'});
	//$("#txtparametro_lista_doc").val("NO_VER");
	$("#bnuevo_documento").css({'pointer-events':'auto'});
	$("#txttipo_doc").css({'pointer-events':'auto'});
	$("#txtbuscar_documento").css({'pointer-events':'auto'});
	$("#btbuscar_documento").css({'pointer-events':'auto'});

	listar_documentos_emitidos()
})

$(document).on("click","#btquitar_insumo_comprar",function(){

	var axid_insumo = $(this).data('id_insumo');
	var axid_logistica_cz= $("#txtid_logistica_cz").val();

		$.ajax({

				url:"logistica_inventarios_funciones.php",
				method: "POST",
				data: {	param:9,
						
						txtid_logistica_cz:axid_logistica_cz,
						axid_insumo:axid_insumo						
					},	

				success : function(data){
					
					if(data==0){
						listar_insumos_comprados()	
					}else{
						Swal.fire("Aviso", "No se elimino el registro...", "error");
					}
				}
			})



})

$(document).on("click","#btagregar_insumo_comprar",function(){

	var axid_insumo = $(this).data('id_insumo');
	var axprecio_compra = $(this).data('pr_compra');
	var axid_logistica_cz= $("#txtid_").val();
	var axcant_compra = $("#txtcant_insumo_comprar").val();
	var axid_logistica_cz= $("#txtid_logistica_cz").val();

	if(isNaN(axcant_compra)){

		Swal.fire("Aviso", "No es un número el dato que desea registrar", "error");

	}else{

		if(axcant_compra==0){

			document.getElementById('txtcant_insumo_comprar').focus();
			Swal.fire("Aviso", "Ingrese la cantidad a registrar...", "error");

		}else{

			var axvalor_compra = axprecio_compra*axcant_compra;
			var axporc_igv = $("#txtigv").val();
			var axigv_compra = (axvalor_compra*axporc_igv)/100;
			var axtotal_compra = axvalor_compra+axigv_compra;

			$.ajax({

				url:"logistica_inventarios_funciones.php",
				method: "POST",
				data: {	param:7,
						
						txtid_logistica_cz:axid_logistica_cz,
						axid_insumo:axid_insumo,
						txtcant_insumo_comprar:axcant_compra,
						axprecio_compra:axprecio_compra,
						axvalor_compra:axvalor_compra,
						axigv_compra:axigv_compra,
						axtotal_compra:axtotal_compra
					},	

				success : function(data){
					
					if(data==0){
						$("#txtcant_insumo_comprar").val(0);
						listar_insumos_comprados()	
					}else{
						Swal.fire("Aviso", "No se grabo el registro...", "error");
					}
				}
			})
		}
		
	}

})

function listar_insumos_comprados() {
	
	var axidlocal = $("#txtidlocal").val();	
	var axid_logistica_cz= $("#txtid_logistica_cz").val();
		
		$.ajax({
		url:"logistica_inventarios_funciones.php",
		method: "POST",
		data: {param:8,txtidlocal:axidlocal,txtid_logistica_cz:axid_logistica_cz},	
		success : function(data){
			
			$("#divdetalle_compras").html(data);	
			
		}
	})
}


$(document).on("keyup","#txtbuscar_insumo_comprar",function(){

	
		listar_insumo_comprar();		

	
})

function listar_insumo_comprar() {
	
	var axidlocal = $("#txtidlocal").val();	
	var axbuscar= $("#txtbuscar_insumo_comprar").val();
	
	
		$.ajax({
		url:"logistica_inventarios_funciones.php",
		method: "POST",
		data: {param:6,txtidlocal:axidlocal,txtbuscar_insumo_comprar:axbuscar},	
		success : function(data){
			
			$("#divlistar_insumos_comprar").html(data);	
			
		}
	})

	
}

$(document).on("click","#btgrabar_cabecera",function(){


const div_campos = document.getElementById('divform_ordenes');
const inputs = Array.from(div_campos.querySelectorAll('input'));
const select = Array.from(div_campos.querySelectorAll('select'));

const num_inputs = inputs.length;
const num_select = select.length;

//console.log(num_inputs)
//console.log(num_select)

	s=0;
	for ( var el of select ) {

		val_select = el.value
		if(val_select===null || val_select==''){

			el.style.border = '1px solid red';
			
		}else{
		
			s=s+1;
			el.style.border = '';
			
		}
	}

//	alert(s)

	if(s==num_select){

		i=0;
		for ( var el of inputs ) {
		val_input = el.value
		if(val_input===null || val_input==''){
			el.style.border = '1px solid red';
		}else{
			i=i+1;
			el.style.border = '';
			
		}
		
		}
		if(i==num_inputs){

			var axidlocal = $("#txtidlocal").val();
			var axtipodoc= $("#txttipo_doc").val();
			var axnum_documento= $("#txtnum_documento").val();
			var axidbeneficiario= $("#txtidbeneficiario").val();	
			var axfecha_emision= $("#txtfecha_emision").val();
			var axfecha_entrega= $("#txtfecha_entrega").val();
			var axhora_entrega= $("#txthora_entrega").val();
			var axforma_pago= $("#txtforma_pago").val();
			var axdias_pago= $("#txtdias_pago").val();
			var axfecha_pago= $("#txtfecha_pago").val();
			var axmedio_pago= $("#txtmedio_pago").val();
			var axestado_forma_pago= $("#txtestado_pago").val();
			var axsolicitante= $("#txtsolicitado_por").val();
			var axparametros= $("#txtparametro").val();
			var axid_logistica_cz= $("#txtid_logistica_cz").val();

			$.ajax({

				url:"logistica_inventarios_funciones.php",
				method: "POST",
				data: {param:5,
					
					txtidlocal:axidlocal,
					txttipo_doc:axtipodoc,
					txtnum_documento:axnum_documento,
					txtidbeneficiario:axidbeneficiario,
					txtfecha_emision:axfecha_emision,
					txtfecha_entrega:axfecha_entrega,
					txthora_entrega:axhora_entrega,
					txtforma_pago:axforma_pago,
					txtdias_pago:axdias_pago,
					txtfecha_pago:axfecha_pago,
					txtmedio_pago:axmedio_pago,
					txtestado_pago:axestado_forma_pago,
					txtsolicitado_por:axsolicitante,
					txtparametro:axparametros,
					txtid_logistica_cz:axid_logistica_cz
					
				},

				success : function(grabar){

					if(grabar==0){
					
					 	$("#divform_ordenes").css({'pointer-events':'none'});
						$("#divform_ordenes_detalle").css({'display':'block'});
						listar_insumo_comprar();
						listar_insumos_comprados();
					}else{

						Swal.fire("Aviso", "No se grabo el registro...", "error");
					}

				}	

			})
	
		}else{

			Swal.fire("Aviso", "Existe campos incompletos", "error");
		}
	}else{
		Swal.fire("Aviso", "Existe selectores incompletos", "error");
	}



	



})

$(document).on("change","#txtdias_pago",function(){

	var axdias_trabajo = $("#txtdias_pago").val();
	var axfecha_pago_1 = moment().add(axdias_trabajo,"days");
	var axfecha_pago = moment(axfecha_pago_1).format('DD/MM/y');
	//alert(axfecha_pago);
	$("#txtfecha_pago").val(axfecha_pago);


})



$(document).on("change","#txtforma_pago",function(){

	var axforma_pago = $("#txtforma_pago").val()
	
	
	if(axforma_pago=="CONTADO"){


		$("#txtdias_pago").prop('disabled', true);	
		$("#txtfecha_pago").prop('disabled', true);	
		$("#txtdias_pago").val(0);	

	}else{
		//alert(axforma_pago)
		$("#txtdias_pago").prop('disabled', false);
		$("#txtfecha_pago").prop('disabled', false);	

	}


})

$('#txtnom_proveedor').keyup(function(){

  var axbuscarcliente = $("#txtnom_proveedor").val();
  
  if (axbuscarcliente != '') {

    $.ajax({
      url:"logistica_inventarios_funciones.php",
      method: "POST",
      data: {param:4,txtnom_proveedor:axbuscarcliente},
      success : function(data){

        $('#div_listarclientes').fadeIn();
        $('#div_listarclientes').html(data);
        
      }
    });
  } 
});

$(document).on("click","#liclientes",function(){

	$("#txtnom_proveedor").val($(this).text());
	var axidbenef = $(this).data("idbenef");
	$("#txtidbeneficiario").val(axidbenef);
	$('#div_listarclientes').fadeOut();

})



$(document).on("click","#bnuevo_documento",function(){

	$("#divform_ordenes").css({'display':'block'});
	$("#divlistardocumentos").css({'display':'none'});
	$("#txtparametro").val(0);
	$("#txtparametro_lista_doc").val("NO_VER");
	

	const dia = moment().format('D');
	const mes = moment().format('MM');
	const hora = moment().format('HHmmss');

	var axidlocal = $("#txtidlocal").val()
	
	var axcod_doc = axidlocal+dia+mes+hora;
	var axtipodoc = $("#txttipo_doc").val();
	var axid_logistica_cz = axidlocal+dia+mes+hora;
	$("#txtid_logistica_cz").val(axid_logistica_cz);


	if(axtipodoc=="ORDEN COMPRA"){

		var axnum_documento = "OC-"+axcod_doc;
		$("#txtnum_documento").val(axnum_documento)
		$("#bnuevo_documento").css({'pointer-events':'none'});
		$("#txttipo_doc").css({'pointer-events':'none'});
		$("#txtbuscar_documento").css({'pointer-events':'none'});
		$("#btbuscar_documento").css({'pointer-events':'none'});

	}else{

		var axnum_documento = "OS-"+axcod_doc;
		$("#txtnum_documento").val(axnum_documento)
		$("#bnuevo_documento").css({'pointer-events':'none'});
		$("#txttipo_doc").css({'pointer-events':'none'});
		$("#txtbuscar_documento").css({'pointer-events':'none'});
		$("#btbuscar_documento").css({'pointer-events':'none'});

	}

})


$(document).on("click","#pninventarios",function(){

	$("#divlogistica").css({'display':'none'});
	$("#divinventarios").css({'display':'block'});
	$("#divform_busqueda").css({'display':'block'});

	$("#txtparametro_lista").val("I");

	var elemento1 = document.getElementById("pninventarios");
	var elemento2 = document.getElementById("pnlogistica");
			
	elemento1.className = "nav-link active text-dark ";
	elemento2.className = "nav-link text-white";
	
})


$(document).on("click","#pnlogistica",function(){

	$("#divlogistica").css({'display':'block'});
	$("#divinventarios").css({'display':'none'});
	$("#divform_busqueda").css({'display':'none'});
	
	var axparametro_lista_doc = $("#txtparametro_lista_doc").val();
	$("#txtparametro_lista").val("L");

	if(axparametro_lista_doc=="SI_VER"){

		listar_documentos_emitidos(); 	
	}
	
			
	var elemento1 = document.getElementById("pninventarios");
	var elemento2 = document.getElementById("pnlogistica");
			
	elemento1.className = "nav-link text-white";
	elemento2.className = "nav-link active text-dark";
	
})





$(document).on("blur","#btmodificar_stock_inicial",function(){

	var axid_insumo_in = $(this).data("id_insumo");
	var axstock_inicial = $(this).text();
	var axidlocal = $("#txtidlocal").val();

	//alert(axid_insumo_si+'|'+axstock_inicial);

	if(isNaN(axstock_inicial)){

		Swal.fire('ADVERTENCIA!','El dato ingresado no es NUMERICO','error');

	} else{

		$.ajax({
		url:"logistica_inventarios_funciones.php",
		method: "POST",
		data: {param:2,txtidlocal:axidlocal,axstock_inicial:axstock_inicial,axid_insumo_in:axid_insumo_in},	
		success : function(data){
			
			listar_inventario_actual()	
			
		}
	})
		
	}

})



$(document).on("blur","#btmodificar_stock_minimo",function(){

	var axid_insumo_mi = $(this).data("id_insumo");
	var axstock_minimo = $(this).text();
	var axidlocal = $("#txtidlocal").val();

	//alert(axid_insumo_si+'|'+axstock_inicial);

	if(isNaN(axstock_minimo)){

		Swal.fire('ADVERTENCIA!','El dato ingresado no es NUMERICO','error');

	} else{

		$.ajax({
		url:"logistica_inventarios_funciones.php",
		method: "POST",
		data: {param:3,txtidlocal:axidlocal,axstock_minimo:axstock_minimo,axid_insumo_mi:axid_insumo_mi},	
		success : function(data){
			
			if(data==0){
				listar_inventario_actual()	
			}else{
				Swal.fire('ADVERTENCIA!','NO SE GRABO EL REGISTRO...','error');
			}
			
		}
	})
		
	}

	


})




$(document).on("click","#btordenar",function(){

	//$("#txtordenar").val(1);
	var axordenar = $("#txtordenar").val();
	
	if(axordenar==0){

		//alert(axordenar)
		$("#txtordenar").val(1);
		listar_inventario_actual()

	}else{
		//alert(axordenar)
		$("#txtordenar").val(0);
		listar_inventario_actual()
	}

	 
	 
})

$(document).on("keyup","#txtbuscar",function(){
	
	listar_inventario_actual();	
	

})


$(document).on("change","#txtsubcategoria",function(){

	//alert("Entreee");
	listar_inventario_actual()	

})

$(document).on("change","#txtidlocal",function(){

	var axparametro_lista = $("#txtparametro_lista").val()
	var axidlocal = $("#txtidlocal").val();

	if(axidlocal=="SELECCIONAR"){
	Swal.fire('ADVERTENCIA!','Debe seleccionar un local','error');
	}else{

		if(axparametro_lista=="I"){
		//	listar_inventario_actual();		
			listar_categorias();
		}

	}

	

	
})


$(document).on("keyup","#txtbuscar",function(){
	listar_inventario_actual();	
})

function listar_documentos_emitidos() {

	var axidlocal = $("#txtidlocal").val();	
	var axbuscar_documento= $("#txtbuscar_documento").val();	
	
	if(axidlocal=="SELECCIONAR"){
			
		$("#divinventarios").html(" ");
	
	}else{

		$.ajax({
			url:"logistica_inventarios_funciones.php",
			method: "POST",
			data: {param:10,txtidlocal:axidlocal,txtbuscar_documento:axbuscar_documento},	
			success : function(data){
				
				$("#divform_ordenes").css({'display':'none'});
				$("#divform_ordenes_detalle").css({'display':'none'});
				$("#divlistardocumentos").html(data);

				
				
			}
		})

	}

	

}

function listar_inventario_actual(){

	var axidlocal = $("#txtidlocal").val();	
	var axbuscar= $("#txtbuscar").val();
	var axordenar = $("#txtordenar").val();
	var axtxtcagoria= $("#txtsubcategoria").val();
	
	if(axtxtcagoria==null){
			
		//$("#divlistardocumentos").html(" ");
		Swal.fire('ADVERTENCIA!','Debe seleccionar una categoria','error');
	
	}else{

		$.ajax({
		url:"logistica_inventarios_funciones.php",
		method: "POST",
		data: {param:0,txtidlocal:axidlocal,txtbuscar:axbuscar,txtordenar:axordenar,txtsubcategoria:axtxtcagoria},	
		success : function(data){
			
			$("#divinventarios").css({'display':'block'});
			$("#divinventarios").html(data);	
			
		}
	})

	}
}


function Verifica_permiso(){

var axiduser =$("#txtcodusuario").val();
var axpermiso ="LOGISTICA INVENTARIOS";

$.ajax({
	url:"logistica_inventarios_funciones.php",
	method: "POST",
	data: {param:1,txtcodusuario:axiduser,axpermiso:axpermiso},
	success : function(permiso){
		if (permiso==1){

			Swal.fire({
			  title: 'Acceso Denegado',
			  text: "Ustede no tiene acceso a este modulo¡",
			  type: 'warning',
			  showCancelButton: false,
			  confirmButtonColor: '#3085d6',
			  cancelButtonColor: '#d33',
			  confirmButtonText: 'Modulo se cerrara!'
			}).then((result) => {
			 	  window.location="principal.php";
			})

			
			

		} 
	}
	})

}



function zeros( number, width )
{
  width -= number.toString().length;
  if ( width > 0 )
  {
    return new Array( width + (/\./.test( number ) ? 2 : 1) ).join( '0' ) + number;
  }
  return number + ""; // siempre devuelve tipo cadena
}


function mueveReloj(){ 
   	momentoActual = new Date() 
   	hora = addZero(momentoActual.getHours());
   	minuto = addZero(momentoActual.getMinutes()); 
   	segundo = addZero(momentoActual.getSeconds()); 

   	horaImprimible = hora + ":" + minuto + ":" + segundo 
   	//horaImprimible = hora + ":" + minuto 

   	document.form_reloj.reloj.value = horaImprimible 
   	setTimeout("mueveReloj()",1000)
} 


function addZero(i) {
  if (i < 10) {
    i = "0" + i;
  }
  return i;
}

$("input[type=text]").focus(function(){	   
  this.select();
});


</script>





