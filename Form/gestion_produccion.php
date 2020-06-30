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
		
		#ulproductos{
	    background-color: #000;
	    cursor: pointer;
	    }

		#liproductos{
		   /* padding: 10px;*/
		    display:block; 
		  width:100%;
		  padding: 3px 0px;
		  color:#000;
		  background-color:#DBEBF6;
		  text-decoration:none;
		  }


		#liproductos:hover{
		   /* padding: 10px;*/
		    display:block; 
		  width:100%;
		  padding: 3px 0px;
		  color:#000;
		  background-color:#356AA0;
		  text-decoration:none;
		  }


		#linuevoregistro{

		 
		  display:block; 
		  width:100%;
		  padding: 3px 0px;
		  color:#000;
		  background-color:#DBEBF6;
		  text-decoration:none;
		  }

		#linuevoregistro:hover{
		 
		  display:block; 
		  width:100%;
		  padding: 3px 0px;
		  color:#000;
		  background-color:#356AA0;
		  text-decoration:none;

		  }
			
		  #libeneficiarios{
		   /* padding: 10px;*/
		    display:block; 
		  width:100%;
		  padding: 3px 0px;
		  color:#000;
		  background-color:#DBEBF6;
		  text-decoration:none;
		  }


		#libeneficiarios:hover{
		   /* padding: 10px;*/
		    display:block; 
		  width:100%;
		  padding: 3px 0px;
		  color:#000;
		  background-color:#356AA0;
		  text-decoration:none;
		  }


		   #litransportista{
		   /* padding: 10px;*/
		    display:block; 
		  width:100%;
		  padding: 3px 0px;
		  color:#000;
		  background-color:#DBEBF6;
		  text-decoration:none;
		  }


		#litransportista:hover{
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

<input type="hidden" name="txtcodmovcz" id="txtcodmovcz" >
<input type="hidden" name="txtidinsumo" id="txtidinsumo" >
<input type="hidden" name="txtparametro" id="txtparametro" value="0">
<input type="hidden" name="txtidbeneficiario" id="txtidbeneficiario">
<input type="hidden" name="txtordenar" id="txtordenar" value="0">
<input type="hidden" name="txtordenar_1" id="txtordenar_1" value="0">

<div class="container-fluid" id="divcontenedor1">
	<div class="card-body" id="divcabecera_1" >
		<div class="row">
			<div class="col-12">

			<div class="card border-danger">
				<div class="card-header text-white bg-danger" id="divcabecer" >
					<b>
						<h4 class="text-white">
							<img src="../icon/produc_1.png" style="width: 30px; height: 30px;"> Gestión Producción 
								<a href="#"  class='btn btn-outline-dark btn-sm' id='btnuevo_produccion'>Nuevo </a> 
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

						<div  class="col-sm-3">
							<label for=""><b>Lote Prod.</b></label>				
							<input type="text" class="form-control" name="txtlote_produccion" id="txtlote_produccion" style="text-align: center;">
						</div>

						<div  class="col-sm-2">
							<label for=""><b>Estado</b></label>				
							
							<select id="txtestado_pedido" class="form-control">
								<option value="PENDIENTE">PENDIENTE</option>
								<option value="PROCESADO">PROCESADO</option>
								
							</select>

						</div>

						<div  class="col-sm-2">
							<label for=""><b>Fecha</b></label>				
							<input type="date" class="form-control" name="txtfechaactual" id="txtfechaactual" value="<?php echo "$diaactual";?>" style="text-align: center;">
						</div>

						<div  class="col-sm-2">
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
					
					<div class="card border-danger">
					  <div class="card-header text-white bg-danger">
					    <ul class="nav nav-tabs card-header-tabs">
					      <li class="nav-item">
					        <a class="nav-link active" id="pnlistar_produccion" href="#">Listado Producción</a>
					      </li>
					      <!--li class="nav-item">
					        <a class="nav-link disabled" href="#" id="pngestionar_pedidos" >Gestionar Produccion</a>
					      </li-->
					    </ul>
					  </div>
					  <div class="card-body">
							<div id="divlistar_produccion"></div>

							<div id="divform_produccion" style="display: none;">
								
								<div class="row">
								  
								  <div class="col-sm-4">
								    <div class="card" style="padding: 4px; margin: 0px;">
								    
								    <div class="form-row">
								    	<input type="hidden" name="txtid_prod_cz" id="txtid_prod_cz">

								    	<div  class="col-sm-10">
										<label for="">
											<b>Buscar | Ordenar</b> <a href="#" id="btordenar"><i class="fas fa-sort-numeric-up"></i></a>
										</label>				
										<input type="text" class="form-control" id="txtbuscar_prod_terminado" style="text-align: center;" placeholder="Producto terminado o fraccionado">
										</div>

										<div  class="col-sm-2">
										<label for=""><b>Cant.</b></label>				
										<input type="text" class="form-control" id="txtcant_pt" style="text-align: center;" value="0">
										</div>
									</div>
																
								    <div class="card-body" id="divprod_terminado"></div>
								    
								    </div>

								  </div>
								  <div class="col-sm-8">
								    <div class="card">
										
										<div class="card-header text-white bg-primary">
									    <ul class="nav nav-tabs card-header-tabs">
									      <li class="nav-item">
									        <a class="nav-link active text-dark" id="pnlistar_prod_terminado_producir" href="#">Producto Terminado Producir</a>
									      </li>
									      <li class="nav-item">
									        <a class="nav-link text-white" href="#" id="pndetalle_insumos_utilizar" >Detalle Insumos Utilizar</a>
									      </li>
									    </ul>
									  </div>

										<div class="card-body">
											<div class="card-body" id="divlistar_prod_terminado_producir" ></div>
											<div class="card-body" id="divdetalle_insumos_utilizar" style="display: none;"></div>
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
			<div class="form-row">
				<div  class="col-sm-12">
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
//	lista_produccion_procesados();
	

});


/***********************************************/

$(document).on("click","#bteliminar_produccion",function(){

	var axestado_prod= $(this).data("estado");
	var axidprod_cz_1 = $(this).data("idprodcz");
	$("#txtid_prod_cz").val(axidprod_cz_1);
	var axidprod_cz = $("#txtid_prod_cz").val();
	var axidlocal = $("#txtidlocal").val();	

	if(axestado_prod=="PROCESADO"){

		Swal.fire({
	
		title: 'ADVERTENCIA',
		text: "Desea eliminar la producción la cual se encuentra PROCESADA...?",
		icon: 'question',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Si, Eliminar..!'
		
		}).then((result) => {
			
			if (result.value) {
				
				$.ajax({
					url:"gestion_produccio_funciones.php",
					method: "POST",
					data: {param:9,txtidlocal:axidlocal,txtid_prod_cz:axidprod_cz},	
					success : function(data){
						
						if(data==0){

							lista_produccion_procesados();
							Swal.fire('INFORMACION!','El registro fue eliminado','success');
						}else{
							Swal.fire('ADVERTENCIA','El registro NO fue eliminado','error');
						}

														
					}
				})
			}
		})

	} else {

		$.ajax({
		
			url:"gestion_produccio_funciones.php",
			method: "POST",
			data: {param:9,txtidlocal:axidlocal,txtid_prod_cz:axidprod_cz},	
			success : function(data){
				
				lista_produccion_procesados();
				Swal.fire('INFORMACION!','El registro fue eliminado','success');
				
			}
		})

	}

	

})


$(document).on("click","#btimprimir_produccion",function(){

var axestado_prod = "PROCESADO";
var axidprod_cz_1 = $(this).data("idprodcz");

$("#txtid_prod_cz").val(axidprod_cz_1);
var axidprod_cz = $("#txtid_prod_cz").val();

var axidlocal = $("#txtidlocal").val();	

Swal.fire({
	
	title: 'PRODUCCION',
	text: "Imprimir Reporte de producción...?",
	icon: 'question',
	showCancelButton: true,
	confirmButtonColor: '#3085d6',
	cancelButtonColor: '#d33',
	confirmButtonText: 'Si, Generar..!'
	
	}).then((result) => {
		
		if (result.value) {
			
			$.ajax({
				url:"gestion_produccio_funciones.php",
				method: "POST",
				data: {param:8,txtidlocal:axidlocal,txtid_prod_cz:axidprod_cz,axestado_prod:axestado_prod},	
				success : function(data){
					
					window.open("gestion_produccion_reporte.php?idprodcz="+axidprod_cz+"&idlocal="+axidlocal);		
				
				}
			})


		}
	})

})



$(document).on("click","#btreporte_produccion",function(){

var axestado_prod = "PROCESADO";
var axidprod_cz = $("#txtid_prod_cz").val();
var axidlocal = $("#txtidlocal").val();	

Swal.fire({
	
	title: 'PRODUCCION',
	text: "Desea generar el reporte de producción...?",
	icon: 'question',
	showCancelButton: true,
	confirmButtonColor: '#3085d6',
	cancelButtonColor: '#d33',
	confirmButtonText: 'Si, Generar..!'
	
	}).then((result) => {
		
		if (result.value) {
			
			$.ajax({
				url:"gestion_produccio_funciones.php",
				method: "POST",
				data: {param:8,txtidlocal:axidlocal,txtid_prod_cz:axidprod_cz,axestado_prod:axestado_prod},	
				success : function(data){
					
					window.open("gestion_produccion_reporte.php?idprodcz="+axidprod_cz+"&idlocal="+axidlocal);		
				
				}
			})


		}
	})


})


$(document).on("click","#btretornar",function(){

	$("#divcabecer").css({'pointer-events':'auto'}); 			
 	$("#divlistar_produccion").css({'display':'block'});
 	$("#divform_produccion").css({'display':'none'});

 	lista_produccion_procesados();

})

$(document).on("click","#bteditar_produccion",function(){
	
	var axidprod_cz = $(this).data("idprodcz");
	$("#txtid_prod_cz").val(axidprod_cz);
	var axidlocal = $("#txtidlocal").val();	

	$("#divcabecer").css({'pointer-events':'none'}); 			
 	$("#divlistar_produccion").css({'display':'none'});
	$("#divform_produccion").css({'display':'block'});

	$.ajax({
		url:"gestion_produccio_funciones.php",
		method: "POST",
		data: {param:6,txtidlocal:axidlocal,axidprod_cz:axidprod_cz},	
		success : function(data){
			
			var json = JSON.parse(data);
				if (json.status == 200){

					$("#axidprod_cz").html(json.ID_PRODUCCION_CZ);
					$("#txtlote_produccion").val(json.LOTE_PROD);
					$("#txtfechaactual").html(json.FECHA_PROD);

					listar_prod_terminado();
					listar_prod_terminado_producir();

				}

			
		
		}
	})

})

$(document).on("click","#btordenar_insumos",function(){

	//$("#txtordenar").val(1);
	var axordenar = $("#txtordenar_1").val();
	
	if(axordenar==0){

		//alert(axordenar)
		$("#txtordenar_1").val(1);
		listar_insumos()

	}else{
		//alert(axordenar)
		$("#txtordenar_1").val(0);
		listar_insumos()
	}

	 
	 
})


$(document).on("click","#btordenar",function(){

	//$("#txtordenar").val(1);
	var axordenar = $("#txtordenar").val();
	
	if(axordenar==0){

		//alert(axordenar)
		$("#txtordenar").val(1);
		listar_prod_terminado()

	}else{
		//alert(axordenar)
		$("#txtordenar").val(0);
		listar_prod_terminado();
	}

	 
	 
})

$(document).on("click","#btasig_prod_term",function(){
	
	var axidinsumo = $(this).data("idinsumo");
	var axidprod_cz = $("#txtid_prod_cz").val();
	var axcant_prod = $("#txtcant_pt").val();
	var axidlocal = $("#txtidlocal").val();	
	var axfecha_prod = $("#txtfechaactual").val();	


	if(axcant_prod==0){

		document.getElementById('txtcant_pt').focus()
		Swal.fire('INFORMACION!','Ingrese la cantidad a producir..','warning');	

	}else{

		$.ajax({
		url:"gestion_produccio_funciones.php",
		method: "POST",
		data: {param:4,
				txtid_prod_cz:axidprod_cz,
				axidinsumo:axidinsumo,
				txtcant_pt:axcant_prod,
				txtidlocal:axidlocal,
				txtfechaactual:axfecha_prod
			},	
			success : function(data){
				
				if(data==0){
					listar_prod_terminado_producir();
					listar_insumos_detallados();	
					//listar_prod_terminado_producir()
				}else{
					Swal.fire('ADVERTENCIA!','No se grabo el registro..','error');	
				}
			}
		})

	}
})

function listar_prod_terminado_producir(){

var axidprod_cz = $("#txtid_prod_cz").val();
var axidlocal = $("#txtidlocal").val();	

	$.ajax({
		url:"gestion_produccio_funciones.php",
		method: "POST",
		data: {param:7,txtidlocal:axidlocal,txtid_prod_cz:axidprod_cz},	
		success : function(data){
			
			$("#divlistar_prod_terminado_producir").html(data);	
		
		}
	})
}

function listar_insumos_detallados(){

var axidprod_cz = $("#txtid_prod_cz").val();
var axidlocal = $("#txtidlocal").val();	

	$.ajax({
		url:"gestion_produccio_funciones.php",
		method: "POST",
		data: {param:5,txtidlocal:axidlocal,txtid_prod_cz:axidprod_cz},	
		success : function(data){
			
			$("#divdetalle_insumos_utilizar").html(data);	
		
		}
	})
}

$(document).on("keyup","#txtbuscar_prod_terminado",function(){
	listar_prod_terminado();	
})

$(document).on("click","#btcambiar_producto",function(){
	
	//var axnom_insumo_cambiar = $(this).data("nominsumo_cambiar");
	var axidinsumo = $(this).data("idinsumo");
		
	//alert(axnom_insumo_cambiar)

	$("#txtid_insumo_cambiar").val(axidinsumo);
	//$("#titulo_modal").html(axnom_insumo_cambiar);

	listar_insumos()
})

$(document).on("click","#btasig_insumos_nuevo",function(){

	var axid_insumo_nuevo = $(this).data("idinsumo_nuevo");
	var axnom_insumo_nuevo = $(this).data("nominsumo_nuevo");
	var axid_insumo_cambiar= $("#txtid_insumo_cambiar").val();	
	var axidlocal = $("#txtidlocal").val();	
	var axidprod_cz = $("#txtid_prod_cz").val();	

	$.ajax({
		url:"gestion_produccio_funciones.php",
		method: "POST",
		data: {param:12,txtidlocal:axidlocal,axid_insumo_nuevo:axid_insumo_nuevo,axnom_insumo_nuevo:axnom_insumo_nuevo,txtid_prod_cz:axidprod_cz,txtid_insumo_cambiar:axid_insumo_cambiar},	

			success : function(data){			
				
				listar_insumos_detallados();
			}
		
		})
})



$(document).on("keyup","#txtbuscar_insumo",function(){
listar_insumos()
})

function listar_insumos(){

	var axidlocal = $("#txtidlocal").val();	
	var axbuscar_insumos= $("#txtbuscar_insumo").val();
	var axordenar = $("#txtordenar_1").val();
	
		$.ajax({
		url:"gestion_produccio_funciones.php",
		method: "POST",
		data: {param:11,txtidlocal:axidlocal,txtbuscar_insumo:axbuscar_insumos,txtordenar_1:axordenar},	

			success : function(data){			
				$("#divlistar_insumos").html(data);			
			}
		
		})
}



function listar_prod_terminado(){

	var axidlocal = $("#txtidlocal").val();	
	var axbuscar_prod_terminado= $("#txtbuscar_prod_terminado").val();
	var axordenar = $("#txtordenar").val();
	
		$.ajax({
		url:"gestion_produccio_funciones.php",
		method: "POST",
		data: {param:2,txtidlocal:axidlocal,txtbuscar_prod_terminado:axbuscar_prod_terminado,txtordenar:axordenar},	
		success : function(data){
			
			$("#divprod_terminado").html(data);	

			
		}
		})

	
}


$(document).on("click","#pnlistar_prod_terminado_producir",function(){

	$("#divlistar_prod_terminado_producir").css({'display':'block'});
	$("#divdetalle_insumos_utilizar").css({'display':'none'});
			
	var elemento1 = document.getElementById("pnlistar_prod_terminado_producir");
	var elemento2 = document.getElementById("pndetalle_insumos_utilizar");
			
	elemento1.className = "nav-link text-dark active";
	elemento2.className = "nav-link text-white";
	
})


$(document).on("click","#pndetalle_insumos_utilizar",function(){


	$("#divlistar_prod_terminado_producir").css({'display':'none'});
	$("#divdetalle_insumos_utilizar").css({'display':'block	'});	
		
	var elemento1 = document.getElementById("pnlistar_prod_terminado_producir");
	var elemento2 = document.getElementById("pndetalle_insumos_utilizar");
			
	elemento1.className = "nav-link text-white";
	elemento2.className = "nav-link active text-dark";

	listar_insumos_detallados();
	
})


$(document).on("click","#btnuevo_produccion",function(){

	
	var axidlocal = $("#txtidlocal").val();
	var axfecha_prod = $("#txtfechaactual").val();
	var axestado_prod = "PENDIENTE";
	var axano_actual = $("#txtano_actual").val();
	var axlote_produccion = $("#txtlote_produccion").val();
	var axparametros = $("#txtparametro").val();
	

	const dia = moment().format('D');
	const mes = moment().format('MM');
	const hora = moment().format('HHmmss');
	
	var axidprod_cz = axidlocal+dia+mes+hora;
	//alert(axidprod_cz)
	$("#txtid_prod_cz").val(axidprod_cz);
	

	if(axidlocal=="SELECCIONAR"){
		document.getElementById('txtidlocal').focus();
		Swal.fire('INFORMACION!','Seleccionar el Local','warning');	

	}else{
		$("#divlistar_produccion").css({'display':'none'});
		$("#divform_produccion").css({'display':'block'});

		$.ajax({
			url:"gestion_produccio_funciones.php",
			method: "POST",
			data: {param:3,

				axidprod_cz:axidprod_cz,
				txtidlocal:axidlocal,
				txtfechaactual:axfecha_prod,
				txtano_actual:axano_actual,
				axestado_prod:axestado_prod,
				txtlote_produccion:axlote_produccion,
				txtparametro:axparametros,

			},	
			success : function(data){
				
					if(data==0){
						listar_prod_terminado();
						//$('#divcabecer *').attr("disabled", true);
 			 			$("#divcabecer").css({'pointer-events':'none'}); 			
 			 			//$("#btnuevo_produccion").css({'display':'none'});
						
						
					}else{
						Swal.fire('ADVERTENCIA!','No se grabo el registro','error');	
					}

				
				
			}
		})


		
	}

})

$(document).on("change","#txtestado_pedido",function(){
	
	lista_produccion_procesados();			

})


$(document).on("change","#txtidlocal",function(){
	
	lista_produccion_procesados();	
	var axidlocal = $("#txtidlocal").val();	

	if(axidlocal=="SELECCIONAR"){
		$("#txtlote_produccion").val('');				
	}else{

		const dia = moment().format('D')
	const mes = moment().format('MM')
	const ano = moment().format('Y')

	var lote = dia+mes+ano;

	$.ajax({
		url:"gestion_produccio_funciones.php",
		method: "POST",
		data: {param:10,txtidlocal:axidlocal},	
		success : function(data){
			
			$("#txtlote_produccion").val(lote+'-'+data);				
			
		}
	})
	}

	

})





$(document).on("keyup","#txtbuscar",function(){
	lista_produccion_procesados();	
})

function lista_produccion_procesados(){

	var axidlocal = $("#txtidlocal").val();	
	var axfechapedido= $("#txtfechaactual").val();
	var axidempresa= $("#txtidempresa").val();
	var axbuscar= $("#txtbuscar").val();
	var axestado_pedido= $("#txtestado_pedido").val();
	//alert(axestado_pedido)
	$("#txtlocal").val(axidlocal);

	if(axidlocal=="SELECCIONAR"){
			
			$("#divlistar_produccion").html(" ");
	
	}else{

		$.ajax({
		url:"gestion_produccio_funciones.php",
		method: "POST",
		data: {param:0,txtidlocal:axidlocal,txtfechaactual:axfechapedido,txtidempresa:axidempresa,txtbuscar:axbuscar,txtestado_pedido:axestado_pedido},	
		success : function(listar_productos_pedido_1){
			
			$("#divlistar_produccion").css({'display':'block'});
			//$("#divpedidos").css({'display':'none'});
			//$("#divdetalles").css({'display':'none'});

			$("#divlistar_produccion").html(listar_productos_pedido_1);	
			
		}
	})

	}
}


function Verifica_permiso(){

var axiduser =$("#txtcodusuario").val();
var axpermiso ="GESTION PEDIDOS";

$.ajax({
	url:"gestion_produccio_funciones.php",
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





