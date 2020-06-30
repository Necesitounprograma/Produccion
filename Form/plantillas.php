<?php require_once '../includes/header.php';
 
$anoactual =date("Y");

$fecha_actual =  date("d-m-Y"); 
$fecha_inicial =  date("d-m-Y",strtotime($fecha_actual."- 4 days")); 

//echo $fecha_actual .'|'. $fecha_inicial;

 

 ?>

<!DOCTYPE html>
  <html>
  <head>

  <script src="../js/bootstrap-input-spinner.js"></script>	

  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  </head>
  <body>
  <br>
  	<div class="container-fluid" id="divcontenedor1" >
  	   	<input type="hidden" name="txtidempresa" id="txtidempresa" value="<?php echo "$axidempresa";?>">
      	<input type="hidden" name="txtcodusuario" id="txtcodusuario" value="<?php echo "$axiduser";?>">
      	<input type="hidden" name="txtfecharegistro" id="txtfecharegistro" value="<?php echo "$diaactual";?>">
      	<input type="hidden" name="txtfecha_actual" id="txtfecha_actual" value="<?php echo "$diaactual";?>">
      	<input type="hidden" name="txtfechainicio" id="txtfechainicio" value="<?php echo "$fecha_inicial";?>">
      	<input type="hidden" name="txtusuario" id="txtusuario" class="form-control" value="<?php echo "$axiduser";?>" style="text-align: center;">
      	
		<input type="hidden" name="txttipocuenta" id="txttipocuenta" value="0">
		<input type="hidden" name="txtfechainicio" id="txtfechainicio">
		<input type="hidden" name="txtcodmovcz" id="txtcodmovcz">	
		<input type="hidden" name="txtcodcontable" id="txtcodcontable">	
		<input type="hidden" name="tipocorrelativo" id="tipocorrelativo">	
		<input type="hidden" name="txtvertodos" id="txtvertodos">		

		<input type="hidden" name="txtidinsumo_p" id="txtidinsumo_p">			
		<input type="hidden" name="txtnom_comercial_p" id="txtnom_comercial_p">	
		<input type="hidden" name="txtunidad_d" id="txtunidad_d">
				
	
			
		<div class="row">
	        <div class="col-12">
		        <div class="card">
			        <div class="card-header">
			        <h5><img src="../icon/plantilla.png" style="width: 30px; height: 30px;"> Planillas de producción</h5>
			        
				        <div class="form-row">
							<div class="col-sm-6">
							<label for="txtlocales"><b>Local</b></label>
							<select class="form-control custom-select mr-sm-2" id="txtlocales">
							<?php while($fila=odbc_fetch_array($rslocales)) {?>
					    	<option value="<?php echo $fila['ID_LOCAL'];?>"><?php echo $fila['DESCRICION_LC'];?></option><?php } ?>
					    	</select>				
							</div>
							
							<div  class="col-sm-3">
							<label for=""><b>Fecha Cierre</b></label>
							<input type="date" id="txtfechaproduccion" name="txtfechaproduccion"  class="form-control" value=<?php echo $_SESSION["diaactual"] ?>>
							</div>	

						</div>

					</div>
				
					<div class="card-body text-info">

					<div class="row">
				
						<div class="col-12 col-sm-12 col-md-12 col-lg-5 col-xl-5">
						<div class="card border-info">
						<div class="card-header"><b>Productos | Servicios</b>

							<div class="form-row">

								<div  class="col-sm-12">				  					
				  					<div class="input-group mb-3">
								  	<input type="text" class="form-control" id="txtbuscar"  placeholder="Seleccionar criterio de busqueda" aria-label="Recipient's username" aria-describedby="basic-addon2">
								  	<div class="input-group-append">
								    <button class="btn btn-outline-info" id="Btbuscar" type="button">Buscar</button>
								  	</div>
									</div>
			  					</div>


							</div>
						</div>
						<div class="card-body text-primary" id="divlistaproductos"></div>
						</div>
						</div>
						<br>
						<div class="col-12 col-sm-12 col-md-12 col-lg-7 col-xl-7">
						<div class="card border-primary">
						<div class="card-header" id="tituloanalisis"><b>Análisis de Costo</b></div>
						<div class="card-body text-primary">
							<div class="form-row">

								<div class="col-sm-10">
								<label for="txtidinsumo_d"><b>Insumos</b></label>
								<select class="form-control custom-select mr-sm-2" id="txtidinsumo_d"></select>	
								<input type="hidden" class="form-control" id="txtnom_comercial_d">	
								<div id="divlistarinsumos"></div>		
								</div>

								<div class="col-sm-2">
								<label for="txtporc_ggut"><b><a id="actulizarutilidad" href="#">% Utilidad</a></b></label>
								<input type="text" class="form-control" id="txtporc_ggut" style="text-align: center;" value="0">
								</div>
								


							</div>
							<div class="form-row">
								<div class="col-sm-4">
								<label for="txtcant_insumo"><b>Cant</b></label>
								<input type="text" class="form-control" id="txtcant_insumo" style="text-align: center;" value="0">
								</div>
								
								<div class="col-sm-4">
								<label for="txtprecio_insumo"><b>Precio</b></label>
								<input type="text" class="form-control" id="txtprecio_insumo" style="text-align: center;" value="0">
								</div>

								<div class="col-sm-4">
								<label for="txtparcial_insumo"><b>Total</b></label>
								<input type="text" class="form-control" id="txtparcial_insumo" style="text-align: center;" value="0">
								</div>
							</div>
							<br>
							
				        	
				        	<div id="divtablaPU" ></div>    		


						</div><!--div class="card-body text-primary"-->
						</div><!--div class="card border-primary"-->
						</div><!--div class="col-12 col-sm-12 col-md-12 col-lg-7 col-xl-7"-->
			
					</div><!--div class="row"-->

					</div><!--div class="card-body text-primary"-->
			</div>	
			</div><!--div class="col-12"-->
		</div><!--div class="row"-->
		


</div>		
	
  </body>
  </html>  

  <script type="text/javascript">
  	
	$(document).ready(function() {	

		Verifica_permiso();
		Listar_Producto_Terminado();
		Listar_Insumos()

		$("input[type='number']").inputSpinner()
	
	});

	
$(document).on("click","#btquitar",function(){

	var axidplantilla = $(this).data("id_plantilla");
	var axidlocal = $("#txtlocales").val();

	$.ajax({
		
		url:"plantillas_funciones.php",
		method: "POST",
		data: {param:7,txtlocales:axidlocal,axidplantilla:axidplantilla},
		success : function(dataeliminar){
			ver_analisis();			
		}
	})

	})

$(document).on("click","#actulizarutilidad",function(){

	var axid_insumo_p = $("#txtidinsumo_p").val();
	var axidlocal = $("#txtlocales").val();
	var axporc_ggut= $("#txtporc_ggut").val();

	$.ajax({

	url:"plantillas_funciones.php",
	method: "POST",
	data: {param:6,

		txtlocales:axidlocal,
		txtidinsumo_p:axid_insumo_p,
		txtporc_ggut:axporc_ggut
		
	},
	
	success : function(grabar){
		if(grabar==0){
			ver_analisis();
      	} else {
			swal("Aviso", "No se grabo el registro...", "warning");
		}
	}
})


})

$(document).on("click","#btagregar",function(){
	
	var axidlocal = $("#txtlocales").val();
	var axid_insumo_p = $("#txtidinsumo_p").val();
	var axnom_comerial_p = $("#txtnom_comercial_p").val();
	var axid_insumo_d = $("#txtidinsumo_d").val();
	var axnom_comerial_d = $("#txtnom_comercial_d").val();
	var axcant_insumo = $("#txtcant_insumo").val();
	var axprecio_insumo = $("#txtprecio_insumo").val();
	var axparcial_insumo = $("#txtparcial_insumo").val();
	var axunidad_d = $("#txtunidad_d").val();
	var axporc_ggut = $("#txtporc_ggut").val();
	
	/*
	var axprecio_costo = $("#txttotal_costo").val();
	
	var axgg_utilidad = $("#txtgg_ut").val();
	var axprecio_venta = $("#txtprecio_venta").val();
	*/

	$.ajax({

	url:"plantillas_funciones.php",
	method: "POST",
	data: {param:5,

		txtlocales:axidlocal,
		txtidinsumo_p:axid_insumo_p,
		txtnom_comercial_p:axnom_comerial_p,
		txtidinsumo_d:axid_insumo_d,
		txtnom_comercial_d:axnom_comerial_d,
		txtcant_insumo:axcant_insumo,
		txtprecio_insumo:axprecio_insumo,
		txtparcial_insumo:axparcial_insumo,
		txtunidad_d:axunidad_d,
		txtporc_ggut:axporc_ggut
		
	},
	
	success : function(grabar){
		if(grabar==0){
			ver_analisis();
      	} else {
			swal("Aviso", "No se grabo el registro...", "warning");
		}
	}
})




})


$(document).on("change","#txtcant_insumo",function(){
	operaciones();
})

$(document).on("change","#txtprecio_insumo",function(){
	operaciones();
})

function operaciones() {

	var axcant_insumo = $("#txtcant_insumo").val();
	var axprecio_insumo = $("#txtprecio_insumo").val();

	var axtotal_insumo = (axcant_insumo*axprecio_insumo);
	$("#txtparcial_insumo").val(axtotal_insumo);

}


$(document).on("change","#txtidinsumo_d",function(){

	var axid_insumo_d = $("#txtidinsumo_d").val();
	var axidlocal =$("#txtlocales").val();
	var axidempresa =$("#txtidempresa").val();

	//alert(axid_insumo_p);

	$.ajax({
		
		url:"plantillas_funciones.php",
		method: "POST",
		data: {param:4,txtlocales:axidlocal,txtidinsumo_d:axid_insumo_d,txtidempresa:axidempresa},

		success : function(data_insumos){

			var json = JSON.parse(data_insumos);

		  			if (json.status == 200){


						$("#txtprecio_insumo").val(json.P_COMPRA);
						$("#txtnom_comercial_d").val(json.NOM_COMERCIAL);
						$("#txtunidad_d").val(json.UNIDAD);

		  			}

			
		}
	})


})




$(document).on("click","#Btbuscar",function(){

Listar_Producto_Terminado();

})

function ver_analisis(){

	var axidinsumo = $("#txtidinsumo_p").val();
	var axidlocal =$("#txtlocales").val();
	
	//alert(axidinsumo+'|'+axnom_comerial_p);

	$.ajax({
		
		url:"plantillas_funciones.php",
		method: "POST",
		data: {param:3,txtlocales:axidlocal,axidinsumo:axidinsumo},
		success : function(plantilla){

			$("#divtablaPU").html(plantilla);
		}
	})
}

$(document).on("click","#btver",function(){
	
	var axidinsumo = $(this).data("id");
	var axnom_comerial_p = $(this).data("nom_com_p");

	$("#txtidinsumo_p").val(axidinsumo);
	$("#txtnom_comercial_p").val(axnom_comerial_p);
	//$("#tituloanalisis").html('Análisis de Costo - '+axnom_comerial_p);

	$("#tituloanalisis").html('<h4>Análisis de Costo </h4>'+axnom_comerial_p);

	

	var axidlocal =$("#txtlocales").val();
	
	//alert(axidinsumo+'|'+axnom_comerial_p);

	$.ajax({
		
		url:"plantillas_funciones.php",
		method: "POST",
		data: {param:3,txtlocales:axidlocal,axidinsumo:axidinsumo},
		success : function(plantilla){

			$("#divtablaPU").html(plantilla);
		}
	})

})




function Verifica_permiso(){

	var axiduser =$("#txtcodusuario").val();
	var axpermiso ="PLANTILLAS";

	$.ajax({

	url:"plantillas_funciones.php",
	method: "POST",
	data: {param:1,txtcodusuario:axiduser,axpermiso:axpermiso},
	success : function(permiso){
		if (permiso==1){

			//swal("Usted no tiene acceso al modulo de compras...", {icon: "success",});
			//window.location="principal.php";		
			//setTimeout ("redireccionar()", 5000); //tiempo expresado en milisegundos

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







function Listar_Producto_Terminado(){

	var axidlocal =$("#txtlocales").val();
	var axidempresa =$("#txtidempresa").val();
	var axbuscar =$("#txtbuscar").val();

	$.ajax({
		
		url:"plantillas_funciones.php",
		method: "POST",
		data: {param:0,txtlocales:axidlocal,txtidempresa:axidempresa,txtbuscar:axbuscar},
		success : function(listarproductostermiandos){

			$("#divlistaproductos").html(listarproductostermiandos);
		}
	})

}

function Listar_Insumos() {
	var axidlocal =$("#txtlocales").val();
	var axidempresa =$("#txtidempresa").val();

	$.ajax({
		
		url:"plantillas_funciones.php",
		method: "POST",
		data: {param:2,txtlocales:axidlocal,txtidempresa:axidempresa},
		success : function(listadoInsumos){

			$("#txtidinsumo_d").html(listadoInsumos);
		}
	})
}


/***************************************************************/


$(document).on("click","#pnregistros",function(){

	$("#divinventarios").css({'display':'none'});
	$("#divkardex").css({'display':'none'});
	$("#divregistros").css({'display':'block'});
	
	var elemento1 = document.getElementById("pninventarios");
	var elemento2 = document.getElementById("pnkardex");
	var elemento3 = document.getElementById("pnregistros");
	
	elemento1.className = "nav-link";
	elemento2.className = "nav-link";
	elemento3.className = "nav-link active";

})

$(document).on("click","#pnkardex",function(){

	$("#divinventarios").css({'display':'none'});
	$("#divkardex").css({'display':'block'});
	$("#divregistros").css({'display':'none'});
	
	var elemento1 = document.getElementById("pninventarios");
	var elemento2 = document.getElementById("pnkardex");
	var elemento3 = document.getElementById("pnregistros");
	
	elemento1.className = "nav-link";
	elemento2.className = "nav-link active";
	elemento3.className = "nav-link";

})

$(document).on("click","#pninventarios",function(){

	$("#divinventarios").css({'display':'block'});
	$("#divkardex").css({'display':'none'});
	$("#divregistros").css({'display':'none'});
	
	var elemento1 = document.getElementById("pninventarios");
	var elemento2 = document.getElementById("pnkardex");
	var elemento3 = document.getElementById("pnregistros");
	
	elemento1.className = "nav-link active";
	elemento2.className = "nav-link disabled";
	elemento3.className = "nav-link disabled";

	//Inventario_valorizado();

})

function Inventario_valorizado(){

var axidlocal =$("#txtlocales").val();
var axperiodo =$("#txtperiodoreporte").val();
var axanoreporte =$("#txtanoreporte").val();

	$.ajax({
		
		url:"consultas_funciones.php",
		method: "POST",
		data: {param:41,txtlocales:axidlocal,txtperiodoreporte:axperiodo,txtanoreporte:axanoreporte},
		success : function(inventariovalorizado){

			$("#divinventariovalorizado").html(inventariovalorizado);
		}
	})

}


$(document).on("click","#pncierreporcajero",function(){

	$("#divcierrexcajero").css({'display':'block'});
	$("#divcierregeneral").css({'display':'none'});
	$("#divvertodo").css({'display':'none'});
	
	var elemento1 = document.getElementById("pncierreporcajero");
	var elemento2 = document.getElementById("pncierregeneral");
	var elemento3 = document.getElementById("pnvertodo");
	
	elemento1.className = "nav-link active";
	elemento2.className = "nav-link";
	elemento3.className = "nav-link";

})

$(document).on("click","#pncierregeneral",function(){

	$("#divcierrexcajero").css({'display':'none'});
	$("#divcierregeneral").css({'display':'block'});
	$("#divvertodo").css({'display':'none'});
	
	var elemento1 = document.getElementById("pncierreporcajero");
	var elemento2 = document.getElementById("pncierregeneral");
	var elemento3 = document.getElementById("pnvertodo");
	
	elemento1.className = "nav-link";
	elemento2.className = "nav-link active";
	elemento3.className = "nav-link";

})


$(document).on("click","#pnvertodo",function(){

	$("#divcierrexcajero").css({'display':'none'});
	$("#divcierregeneral").css({'display':'none'});
	$("#divvertodo").css({'display':'block'});
	
	var elemento1 = document.getElementById("pncierreporcajero");
	var elemento2 = document.getElementById("pncierregeneral");
	var elemento3 = document.getElementById("pnvertodo");
	
	elemento1.className = "nav-link";
	elemento2.className = "nav-link";
	elemento3.className = "nav-link active";

})




$(document).on("click","#btimprimirAbierta",function(){

var axiduser = $(this).data("idcierre");
var axidlocal = $("#txtlocales").val();
var axfechacierre = $("#txtfechacierre").val();


//window.open("cierre_reporte.php?id="+axcodmovcz);
window.open("cierre_reporte.php?user="+axiduser+"&local="+axidlocal+"&fecha="+axfechacierre);


})

$(document).on("click","#btimprimirCerrada",function(){

var axiduser = $(this).data("idcierre");
var axidlocal = $("#txtlocales").val();
var axfechacierre = $("#txtfechacierre").val();
window.open("cierre_reporte.php?user="+axiduser+"&local="+axidlocal+"&fecha="+axfechacierre);


})


$(document).on("click","#btvertodos",function(){

	$("#txtvertodos").val(1);
	listar_cierres();

})

$(document).on("click","#bteliminarCerrada",function(){

var axborrar = $(this).data("borrarcierre");
var axestado = $(this).data("axestado");
var axcoduser =$("#txtcajero").val();

if (axestado=="CERRADA"){

	swal("Aviso", "El cuadre de caja esta CERRADO y no puede ser eliminado", "warning");

} else {
	
	$.ajax({
	
	url:"consultas_funciones.php",
	method: "POST",
	data: {param:30,borrarcierre:axborrar,txtcajero:axcoduser},
		success : function(actualizar){

			if(actualizar==0){
				swal("Eliminar", "Registro eliminado...!!", "error");
				listar_cierres();	
			} else {
				swal("Aviso", "No se actualizo el estado...!!", "info");
			}

		}
	})
}

})


$(document).on("click","#bteliminarAbierta",function(){

var axborrar = $(this).data("borrarcierre");
var axestado = $(this).data("axestado");
var axcoduser =$("#txtcajero").val();

if (axestado=="CERRADA"){

	swal("Aviso", "El cuadre de caja esta CERRADO y no puede ser eliminado", "warning");

} else {
	
	$.ajax({
	
	url:"consultas_funciones.php",
	method: "POST",
	data: {param:30,borrarcierre:axborrar,txtcajero:axcoduser},
		success : function(actualizar){

			if(actualizar==0){
				swal("Eliminar", "Registro eliminado...!!", "error");
				listar_cierres();	
			} else {
				swal("Aviso", "No se actualizo el estado...!!", "info");
			}

		}
	})
}

})



$(document).on("click","#btcierrecajaCerrada",function(){

var axidcierre = $(this).data("idcierre");
var axestado = $(this).data("axestado");
var axcoduser =$("#txtcajero").val();

//alert("Button Cerrado");

if (axestado=="ABIERTA"){
	swal("Aviso", "Se cerrara el cuadre de caja", "info");
	axestadoactual = "CERRADA";
} else {
	swal("Aviso", "Se abrira el cuadre de caja", "warning");
	axestadoactual = "ABIERTA";
}

$.ajax({
	
	url:"consultas_funciones.php",
	method: "POST",
	data: {param:29,axidcierre:axidcierre,axestadoactual:axestadoactual,txtcajero:axcoduser},
	success : function(actualizar){

		if(actualizar==0){

			//
			listar_cierres();	

		} else {
			swal("Aviso", "No se actualizo el estado...!!", "info");
		}

		

	}
})

})

$(document).on("click","#btcierrecajaAbierta",function(){

var axidcierre = $(this).data("idcierre");
var axestado = $(this).data("axestado");
var axcoduser =$("#txtcajero").val();

//alert("Botton abierta" + '|' + axestado);

if (axestado=="ABIERTA"){

	swal("Aviso", "Se cerrara el cuadre de caja", "info");
	axestadoactual = "CERRADA";

} else {

	swal("Aviso", "Se abrira el cuadre de caja", "warning");
	axestadoactual = "ABIERTA";
}

$.ajax({
	
	url:"consultas_funciones.php",
	method: "POST",
	data: {param:29,axidcierre:axidcierre,axestadoactual:axestadoactual,txtcajero:axcoduser},
	success : function(actualizar){

		if(actualizar==0){

			//
			listar_cierres();	

		} else {
			swal("Aviso", "No se actualizo el estado...!!", "info");
		}

		

	}
})

})

$(document).on("change","#txtcajero",function(){

	calcular_cierre_cajero();
	listar_cierres();
})

$(document).on("change","#txtfechacierre",function(){

	var axcajero =($("#txtcajero option:selected").text());

	if (axcajero=="Seleccionar") {
		listar_cierres();	
	} else {
		calcular_cierre_cajero();
		listar_cierres();	
	}


	

})



$(document).on("click","#btprocesarcaja",function(){

	var axtotalmonedas = $("#txttotalmonedas").html();	
	var axsaldoactual = $("#txtsaldoactual").val();	

	if (axtotalmonedas == 0 ){
		
		swal("Aviso", "Realizar el conteo de las monedas y billetes...", "info");

	} else {
 

	var axidlocal = $("#txtlocales").val();
	var axfechacierre = $("#txtfechacierre").val();
	var axcoduser = $("#txtcajero").val();

	var axventaefectivo = $("#txtefectivoventas").val();
	var axventatarjeta = $("#txttarjetasventas").val();
	var axventacredito = $("#txtventascredito").val();

	var axgastoefectivo = $("#efectivogastos").val();
	var axgastotarjeta = $("#tarjetasgastos").val();
	var axcomprascredito = $("#txtcomprascredito").val();

	var axsaldoinicial = $("#txtsaldoinicial").val();
	var axsaldoanterios = $("#txtsaldoanterior").val();	
	var axretiros = $("#txtretiros").val();	
	

	var axm01 = $("#txt010c").html();
	var axm02 = $("#txt020c").html();
	var axm05 = $("#txt050c").html();
	var axm1 = $("#txt1c").html();
	var axm2 = $("#txt2c").html();
	var axm5 = $("#txt5c").html();
	var axm10 = $("#txt10c").html();
	var axm20 = $("#txt20c").html();
	var axm50 = $("#txt50c").html();
	var axm100 = $("#txt100c").html();
	var axm200 = $("#txt200c").html();
	var axmotros = $("#txtotrosc").html();
	var axtipocierre = "CUADRE"



	$.ajax({

			url:"consultas_funciones.php",
			method: "POST",
			data: {param:27,
			txtlocales:axidlocal,
			txtfechacierre:axfechacierre,
			txtcajero:axcoduser,
			txtefectivoventas:axventaefectivo,
			txttarjetasventas:axventatarjeta,
			txtventascredito:axventacredito,
			efectivogastos:axgastoefectivo,
			tarjetasgastos:axgastotarjeta,
			txtcomprascredito:axcomprascredito,
			txtsaldoinicial:axsaldoinicial,
			txtsaldoanterior:axsaldoanterios,
			txtretiros:axretiros,
			txtsaldoactual:axsaldoactual,
			txt010c:axm01,
			txt020c:axm02,
			txt050c:axm05,
			txt1c:axm1,
			txt2c:axm2,
			txt5c:axm5,
			txt10c:axm10,
			txt20c:axm20,
			txt50c:axm50,
			txt100c:axm100,
			txt200c:axm200,
			txtotrosc:axmotros,
			txttotalmonedas:axtotalmonedas,
			axtipocierre:axtipocierre
			},

			success : function(grabarcierre){

				if (grabarcierre==0){

					swal("Aviso", "Existe un cierre de caja para este Cajero en esta fecha y en este local..", "warning");
				
				} else {

					listar_cierres();		
				}

			
			}
		})

	
	}

})



$(document).on("click","#btcerrarcajageneral",function(){

	calcular_cierre_general();


	Swal.fire({
	  title: 'Desea Grabar el proceso?',
	  text: "El Proceso se realizo satisfactoriamente",
	  type: 'warning',
	  showCancelButton: true,
	  confirmButtonColor: '#3085d6',
	  cancelButtonColor: '#d33',
	  confirmButtonText: 'Grabar Proceso!'

	}).then((result) => {
	  
	  if (result.value) {

	  	var axtotalmonedas = $("#txttotalmonedas").html();	
		var axsaldoactual = $("#txtsaldoactual").val();	

		var axidlocal = $("#txtlocales").val();
		var axfechacierre = $("#txtfechacierre").val();
		var axcoduser = $("#txtcajero").val();

		var axventaefectivo = $("#txtefectivoventas").val();
		var axventatarjeta = $("#txttarjetasventas").val();
		var axventacredito = $("#txtventascredito").val();

		var axgastoefectivo = $("#efectivogastos").val();
		var axgastotarjeta = $("#tarjetasgastos").val();
		var axcomprascredito = $("#txtcomprascredito").val();

		var axsaldoinicial = $("#txtsaldoinicial").val();
		var axsaldoanterios = $("#txtsaldoanterior").val();	
		var axretiros = $("#txtretiros").val();	
		

		var axm01 = $("#txt010c").html();
		var axm02 = $("#txt020c").html();
		var axm05 = $("#txt050c").html();
		var axm1 = $("#txt1c").html();
		var axm2 = $("#txt2c").html();
		var axm5 = $("#txt5c").html();
		var axm10 = $("#txt10c").html();
		var axm20 = $("#txt20c").html();
		var axm50 = $("#txt50c").html();
		var axm100 = $("#txt100c").html();
		var axm200 = $("#txt200c").html();
		var axmotros = $("#txtotrosc").html();
		var axtipocierre = "GENERAL"

		$.ajax({

			url:"consultas_funciones.php",
			method: "POST",
			data: {param:27,
			txtlocales:axidlocal,
			txtfechacierre:axfechacierre,
			txtcajero:axcoduser,
			txtefectivoventas:axventaefectivo,
			txttarjetasventas:axventatarjeta,
			txtventascredito:axventacredito,
			efectivogastos:axgastoefectivo,
			tarjetasgastos:axgastotarjeta,
			txtcomprascredito:axcomprascredito,
			txtsaldoinicial:axsaldoinicial,
			txtsaldoanterior:axsaldoanterios,
			txtretiros:axretiros,
			txtsaldoactual:axsaldoactual,
			txt010c:axm01,
			txt020c:axm02,
			txt050c:axm05,
			txt1c:axm1,
			txt2c:axm2,
			txt5c:axm5,
			txt10c:axm10,
			txt20c:axm20,
			txt50c:axm50,
			txt100c:axm100,
			txt200c:axm200,
			txtotrosc:axmotros,
			txttotalmonedas:axtotalmonedas,
			axtipocierre:axtipocierre
			},

			success : function(grabarcierre){


			listar_cierres();
	   		Swal.fire('Información!','Proceso Grabado','success' )

			}
		})
	  }

	})




})



function listar_cierres(){

	var axidlocal = $("#txtlocales").val();
	var axfechacierre = $("#txtfechacierre").val();
	var axcoduser = $("#txtcajero").val();
	var axvertodos = $("#txtvertodos").val();

	$.ajax({
			url:"consultas_funciones.php",
			method: "POST",
			data: {param:28,
				txtlocales:axidlocal,
				txtcajero:axcoduser,
				txtfechacierre:axfechacierre,
				txtvertodos:axvertodos
			},

			success : function(listarcierres){
			$("#divreportescierres").html(listarcierres);
			}
		})



}


$(document).on("click","#pncajaybancos",function(){

	$("#divcajabancos").css({'display':'block'});
	$("#divcierrecaja").css({'display':'none'});
	$("#divexistencias").css({'display':'none'});
	$("#divestadisticas").css({'display':'none'});
	$("#divgrafica").css({'display':'none'});
	
		
	
	var elemento1 = document.getElementById("pncajaybancos");
	var elemento2 = document.getElementById("pncierrecaja");
	var elemento3 = document.getElementById("pnexistencia");
	var elemento4 = document.getElementById("pnestadistica");

		
	elemento1.className = "nav-link active";
	elemento2.className = "nav-link";
	elemento3.className = "nav-link";
	elemento4.className = "nav-link disabled";

})


$(document).on("click","#pncierrecaja",function(){

	$("#divcajabancos").css({'display':'none'});
	$("#divcierrecaja").css({'display':'block'});
	$("#divexistencias").css({'display':'none'});
	$("#divestadisticas").css({'display':'none'});
	$("#divgrafica").css({'display':'none'});
	
	var elemento1 = document.getElementById("pncajaybancos");
	var elemento2 = document.getElementById("pncierrecaja");
	var elemento3 = document.getElementById("pnexistencia");
	var elemento4 = document.getElementById("pnestadistica");

		
	elemento1.className = "nav-link";
	elemento2.className = "nav-link active";
	elemento3.className = "nav-link";
	elemento4.className = "nav-link disabled";

	//verificar_cierre_caja();
	listar_cierres();
	
	

})

$(document).on("click","#pnexistencia",function(){

	$("#divcajabancos").css({'display':'none'});
	$("#divcierrecaja").css({'display':'none'});
	$("#divexistencias").css({'display':'block'});
	$("#divestadisticas").css({'display':'none'});
	$("#divgrafica").css({'display':'none'});
	
	var elemento1 = document.getElementById("pncajaybancos");
	var elemento2 = document.getElementById("pncierrecaja");
	var elemento3 = document.getElementById("pnexistencia");
	var elemento4 = document.getElementById("pnestadistica");

		
	elemento1.className = "nav-link";
	elemento2.className = "nav-link";
	elemento3.className = "nav-link active";
	elemento4.className = "nav-link disabled";

})

$(document).on("click","#pnestadistica",function(){

	$("#divcajabancos").css({'display':'none'});
	$("#divcierrecaja").css({'display':'none'});
	$("#divexistencias").css({'display':'none'});
	$("#divestadisticas").css({'display':'block'});
		
	
	var elemento1 = document.getElementById("pncajaybancos");
	var elemento2 = document.getElementById("pncierrecaja");
	var elemento3 = document.getElementById("pnexistencia");
	var elemento4 = document.getElementById("pnestadistica");

		
	elemento1.className = "nav-link";
	elemento2.className = "nav-link";
	elemento3.className = "nav-link";
	elemento4.className = "nav-link active";

})






$(document).on("click","#btglosa",function(){

	var axcodmovczcontable = $(this).data("id");
	//alert(axcodmovczcontable);

})

$(document).on("click","#btactualizacorrelativo",function(){

		var axtipo = $("#tipocorrelativo").val();
		var axcodmovczcontable = $("#txtcodcontable").val();	
		var axcodmovcz = $("#txtcodmovcz").val();	
		var axcorrelativonuevo = $("#txtcorrelactivonuevo").val();	

		$.ajax({

			url:"consultas_funciones.php",
			method: "POST",
			data: {param:18,txtcodcontable:axcodmovczcontable,txtcodmovcz:axcodmovcz,txtcorrelactivonuevo:axcorrelativonuevo,tipocorrelativo:axtipo},
			success : function(editar){
				
				if(editar==0){
					actualizar_grillas();
      			} else {
				 	swal("Aviso", "No se actualizo el registro...", "warning");
				}

	  	
			}
		})



})

function actualizar_grillas() {

		var axidlocal = $("#txtlocales").val();	
		var axcoduser = $("#txtcodusuario").val();	
		var axnuncta = $("#txtnuncta_compra").val();	
		var axperiodo = $("#txtperiodoregistro").val();	
		var axfechainicio = $("#txtfechainicio").val();	
		var axsaldoinicial = $("#txtsaldoinicial").val();	
		var axmonedaefectivo = $("#txtmonenda").val();	
		var axtipo =$("#tipocorrelativo").val();	

		if (axtipo=="BANCO") {

			$.ajax({
			url:"consultas_funciones.php",
			method: "POST",
			data: {param:14,txtlocales:axidlocal,txtnuncta_compra:axnuncta,txtperiodoregistro:axperiodo,txtcodusuario:axcoduser,txtsaldoinicial:axsaldoinicial},
			success : function(bancos){
				$("#lista1").html(bancos);
			}
		})

		} else if (axtipo=="EFECTIVO"){

			$.ajax({
			url:"consultas_funciones.php",
			method: "POST",
			data: {param:16,txtlocales:axidlocal,txtnuncta_compra:axnuncta,txtperiodoregistro:axperiodo,txtcodusuario:axcoduser,txtsaldoinicial:axsaldoinicial},
			success : function(Efectivo){
				$("#lista1").html(Efectivo);
			}
		})

		}

}
	
	$(document).on("click","#bteditarcorrelativoEfectivo",function(){

		var axcodmovczcontable = $(this).data("id");
		$("#txtcodcontable").val(axcodmovczcontable);
		$("#tipocorrelativo").val("EFECTIVO");

		$.ajax({

			url:"consultas_funciones.php",
			method: "POST",
			data: {param:17,axcodmovczcontable:axcodmovczcontable},
			success : function(editar){
			var json = JSON.parse(editar);
	  			if (json.status == 200){

					$("#txtcorrelactivoactual").val(json.COD_CONTABLE);
					$("#txtcodmovcz").val(json.COD_MOV);
					
				}

			}
		})

	})

	$(document).on("click","#bteditarcorrelativo",function(){

		var axcodmovczcontable = $(this).data("id");
		$("#txtcodcontable").val(axcodmovczcontable);
		$("#tipocorrelativo").val("BANCO");

		$.ajax({

			url:"consultas_funciones.php",
			method: "POST",
			data: {param:17,axcodmovczcontable:axcodmovczcontable},
			success : function(editar){
			var json = JSON.parse(editar);
	  			if (json.status == 200){

					$("#txtcorrelactivoactual").val(json.COD_CONTABLE);
					$("#txtcodmovcz").val(json.COD_MOV);
					
				}

			}
		})

	})



	$(document).on("change","#txtnuncta_compra",function(){

		var axidlocal = $("#txtlocales").val();	
		var axcoduser = $("#txtcodusuario").val();	
		var axnuncta = $("#txtnuncta_compra").val();	
		

		$.ajax({
			url:"consultas_funciones.php",
			method: "POST",
			data: {param:13,txtlocales:axidlocal,txtnuncta_compra:axnuncta,txtcodusuario:axcoduser},
			success : function(saldoinicial){
			var json = JSON.parse(saldoinicial);
	  			if (json.status == 200){

	  				$("#txtsaldoinicial").val(json.SALDO_INICIAL);
	  				$("#txttipocuenta").val(json.BANCO_CUENTA);
	  				$("#txtfechainicio").val(json.FECHA_INICIO);
	  				$("#txtmonenda").html(json.MONEDA_CTA);

	  				$("#btexcelRC").css({'display':'none'});
					$("#btexcelRV").css({'display':'none'});

	  				 var axtipocta = $("#txttipocuenta").val();
	  				 if (axtipocta=='EFECTIVO'){
						
						$("#btbancos").css({'display':'none'});
						$("#btefectivo").css({'display':'block'});	

			
	  				 } else {


	  				 	$("#btbancos").css({'display':'block'});
						$("#btefectivo").css({'display':'none'});			
	  				 	

	  				 }

	  				 $("#txtmonenda").css({'display':'block'});	
	  			}



			}
		})

	})

	function verificar_cierre_caja(){

		var axiduser =$("#txtcodusuario").val();
		var axpermiso_proceso ="PROCESAR CAJA";
		var axpermiso_cierre ="CIERRE CAJA";

		$.ajax({

			url:"consultas_funciones.php",
			method: "POST",
			data: {param:31,txtcodusuario:axiduser,axpermiso_cierre:axpermiso_cierre,axpermiso_proceso:axpermiso_proceso},
			success : function(permiso_cierre){

				if (permiso_cierre==1){

					//$("#divcambiouser").css({'display':'none'});	
					Swal.fire({
					  title: 'Acceso Denegado',
					  text: "Ustede no tiene acceso a este modulo¡",
					  type: 'warning',
					  showCancelButton: false,
					  confirmButtonColor: '#3085d6',
					  cancelButtonColor: '#d33',
					  confirmButtonText: 'Modulo se cerrara!'
					}).then((result) => {
					 	  window.location="Consultas.php";
					})

				}
			}
		})



	}


	


	

	$(document).on("click","#mnefectivo",function(){

		var axidlocal = $("#txtlocales").val();	
		var axcoduser = $("#txtcodusuario").val();	
		var axnuncta = $("#txtnuncta_compra").val();	
		var axperiodo = $("#txtperiodoregistro").val();	
		var axfechainicio = $("#txtfechainicio").val();	
		var axsaldoinicial = $("#txtsaldoinicial").val();	
		var axmonedaefectivo = $("#txtmonenda").val();	

		//alert(axmonedaefectivo);


		$.ajax({
			url:"consultas_funciones.php",
			method: "POST",
			data: {param:15,txtlocales:axidlocal,txtnuncta_compra:axnuncta,txtperiodoregistro:axperiodo,txtcodusuario:axcoduser,txtsaldoinicial:axsaldoinicial,txtfechainicio:axfechainicio,txtmonenda:axmonedaefectivo},
			success : function(resumen){
				$("#t_saldos").html(resumen);

				$.ajax({
					url:"consultas_funciones.php",
					method: "POST",
					data: {param:16,txtlocales:axidlocal,txtnuncta_compra:axnuncta,txtperiodoregistro:axperiodo,txtcodusuario:axcoduser,txtsaldoinicial:axsaldoinicial},
					success : function(Efectivo){

						
						$("#lista1").html(Efectivo);

						


					}
				})


			}
		})

	})

	

	$(document).on("click","#mnbancos",function(){

		var axidlocal = $("#txtlocales").val();	
		var axcoduser = $("#txtcodusuario").val();	
		var axnuncta = $("#txtnuncta_compra").val();	
		var axperiodo = $("#txtperiodoregistro").val();	
		var axfechainicio = $("#txtfechainicio").val();	
		var axsaldoinicial = $("#txtsaldoinicial").val();	
		var axmonedaefectivo = $("#txtmonenda").val();	

		$.ajax({
			url:"consultas_funciones.php",
			method: "POST",
			data: {param:12,txtlocales:axidlocal,txtnuncta_compra:axnuncta,txtperiodoregistro:axperiodo,txtcodusuario:axcoduser,txtsaldoinicial:axsaldoinicial,txtfechainicio:axfechainicio,txtmonenda:axmonedaefectivo},
			success : function(resumen){
				$("#t_saldos").html(resumen);

				$.ajax({
					url:"consultas_funciones.php",
					method: "POST",
					data: {param:14,txtlocales:axidlocal,txtnuncta_compra:axnuncta,txtperiodoregistro:axperiodo,txtcodusuario:axcoduser,txtsaldoinicial:axsaldoinicial},
					success : function(bancos){
						$("#lista1").html(bancos);
					}
				})


			}
		})

	})

	$(document).on("click","#mnregventa",function(){

		
		var axidempresa = $("#txtidempresa").val();	
		var axperiodo = $("#txtperiodoregistro").val();	
		var axbuscar = $("#txtbuscar").val();	
		
		$.ajax({

			url:"consultas_funciones.php",
			method: "POST",
			data: {param:19,txtidempresa:axidempresa,txtbuscar:axbuscar,txtperiodoregistro:axperiodo},
				success : function(listar){
				
				$("#btexcelRC").css({'display':'none'});
				$("#btexcelRV").css({'display':'block'});

				$("#btbancos").css({'display':'none'});
				$("#btefectivo").css({'display':'none'});	
				//$("#btmoneda").css({'display':'none'});	
				$("#txtmonenda").css({'display':'none'});	

				$("#lista1").html(listar);
				
			}
		})




	})

	


	$(document).on("click","#mnregcompra",function(){
		
		var axidempresa = $("#txtidempresa").val();	
		var axperiodo = $("#txtperiodoregistro").val();	
		var axbuscar = $("#txtbuscar").val();	
		
		$.ajax({

			url:"consultas_funciones.php",
			method: "POST",
			data: {param:0,txtidempresa:axidempresa,txtbuscar:axbuscar,txtperiodoregistro:axperiodo},
				success : function(listar){
				
				$("#btexcelRC").css({'display':'block'});
				$("#btexcelRV").css({'display':'none'});

				$("#btbancos").css({'display':'none'});
				$("#btefectivo").css({'display':'none'});	
				//$("#btmoneda").css({'display':'none'});	
				$("#txtmonenda").css({'display':'none'});	

				$("#lista1").html(listar);
				
			}
		})

	})



 
	function ExportaRegCompras(tbregcompras, filename = 'registrocompra'){

    var downloadLink;
    var dataType = 'application/vnd.ms-excel';
    var tableSelect = document.getElementById(tbregcompras);
    var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
    
    // Specify file name
    filename = filename?filename+'.xls':'excel_data.xls';
    
    // Create download link element
    downloadLink = document.createElement("a");
    
    document.body.appendChild(downloadLink);
    
    if(navigator.msSaveOrOpenBlob){
        var blob = new Blob(['ufeff', tableHTML], {
            type: dataType
        });
        navigator.msSaveOrOpenBlob( blob, filename);
    }else{
        // Create a link to the file
        downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
    
        // Setting the file name
        downloadLink.download = filename;
        
        //triggering the function
        downloadLink.click();
    }
}

function ExportaRegVentas(tbregventa, filename = 'registroventas'){

    var downloadLink;
    var dataType = 'application/vnd.ms-excel';
    var tableSelect = document.getElementById(tbregventa);
    var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
    
    // Specify file name
    filename = filename?filename+'.xls':'excel_data.xls';
    
    // Create download link element
    downloadLink = document.createElement("a");
    
    document.body.appendChild(downloadLink);
    
    if(navigator.msSaveOrOpenBlob){
        var blob = new Blob(['ufeff', tableHTML], {
            type: dataType
        });
        navigator.msSaveOrOpenBlob( blob, filename);
    }else{
        // Create a link to the file
        downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
    
        // Setting the file name
        downloadLink.download = filename;
        
        //triggering the function
        downloadLink.click();
    }
}



 function ExportaBancos(tblbancos, filename = 'listaBancos'){

    var downloadLink;
    var dataType = 'application/vnd.ms-excel';
    var tableSelect = document.getElementById(tblbancos);
    var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
    
    // Specify file name
    filename = filename?filename+'.xls':'excel_data.xls';
    
    // Create download link element
    downloadLink = document.createElement("a");
    
    document.body.appendChild(downloadLink);
    
    if(navigator.msSaveOrOpenBlob){
        var blob = new Blob(['ufeff', tableHTML], {
            type: dataType
        });
        navigator.msSaveOrOpenBlob( blob, filename);
    }else{
        // Create a link to the file
        downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
    
        // Setting the file name
        downloadLink.download = filename;
        
        //triggering the function
        downloadLink.click();
    }
}


 function ExportaEfectivo(tbefectivo, filename = 'listaefectivo'){

    var downloadLink;
    var dataType = 'application/vnd.ms-excel';
    var tableSelect = document.getElementById(tbefectivo);
    var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
    
    // Specify file name
    filename = filename?filename+'.xls':'excel_data.xls';
    
    // Create download link element
    downloadLink = document.createElement("a");
    
    document.body.appendChild(downloadLink);
    
    if(navigator.msSaveOrOpenBlob){
        var blob = new Blob(['ufeff', tableHTML], {
            type: dataType
        });
        navigator.msSaveOrOpenBlob( blob, filename);
    }else{
        // Create a link to the file
        downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
    
        // Setting the file name
        downloadLink.download = filename;
        
        //triggering the function
        downloadLink.click();
    }
}



  function periodo(){

	var axfechabono = $("#txtfecharegistro").val();
    var axmes = axfechabono.substr(0,4);
    var axano = axfechabono.substr(5,2);
    var axperiodo = axano + "-" +axmes;
    $("#txtperiodoregistro").val(axperiodo);
 
   

}

$(document).on("blur","#txt010c",function(){

	var ax010c = $("#txt010c").html();
	var ax010m = (Number(ax010c)*0.10);
	$("#txt010m").html(ax010m);
	//SumarMonedas();

})


$('#txt020c').blur(function(){
	//document.getElementById('txt050c').focus();
	var ax020c = $("#txt020c").html();
	var ax020m = (Number(ax020c)*0.20);
	$("#txt020m").html(ax020m);
	SumarMonedas();
})

$('#txt050c').blur(function(){
	//document.getElementById('txt1c').focus();
	var ax050c = $("#txt050c").html();
	var ax050m = (Number(ax050c)*0.50);
	$("#txt050m").html(ax050m);
	SumarMonedas();
})


$('#txt1c').blur(function(){
	//document.getElementById('txt2c').focus();
	var ax1c = $("#txt1c").html();
	var ax1m = (Number(ax1c)*1);
	$("#txt1m").html(ax1m);
	SumarMonedas();
})

$('#txt2c').blur(function(){
	//document.getElementById('txt2c').focus();
	var ax2c = $("#txt2c").html();
	var ax2m = (Number(ax2c)*2);
	$("#txt2m").html(ax2m);
	SumarMonedas();
})

$('#txt5c').blur(function(){
	//document.getElementById('txt2c').focus();
	var ax5c = $("#txt5c").html();
	var ax5m = (Number(ax5c)*5);
	$("#txt5m").html(ax5m);
	SumarMonedas();
})

$('#txt10c').blur(function(){
	//document.getElementById('txt2c').focus();
	var ax10c = $("#txt10c").html();
	var ax10m = (Number(ax10c)*10);
	$("#txt10m").html(ax10m);
	SumarMonedas();
})


$('#txt20c').blur(function(){
	//document.getElementById('txt2c').focus();
	var ax20c = $("#txt20c").html();
	var ax20m = (Number(ax20c)*20);
	$("#txt20m").html(ax20m);
	SumarMonedas();
})

$('#txt50c').blur(function(){
	//document.getElementById('txt2c').focus();
	var ax50c = $("#txt50c").html();
	var ax50m = (Number(ax50c)*50);
	$("#txt50m").html(ax50m);
	SumarMonedas();
})

$('#txt100c').blur(function(){
	//document.getElementById('txt2c').focus();
	var ax100c = $("#txt100c").html();
	var ax100m = (Number(ax100c)*100);
	$("#txt100m").html(ax100m);
	SumarMonedas();
})

$('#txt200c').blur(function(){
	//document.getElementById('txt2c').focus();
	var ax200c = $("#txt200c").html();
	var ax200m = (Number(ax200c)*200);
	$("#txt200m").html(ax200m);
	SumarMonedas();
})


$('#txtotrosc').blur(function(){

	var axotros = $("#txtotrosc").html();
	var axotrosm = (Number(axotros)*1);
	$("#txtotrosm").html(axotrosm);
	SumarMonedas();
})

function SumarMonedas(){

	//var axtotalmonedas = (ax010m+ax020m+ax050m+ax1m+ax2m+ax5m+ax10m+ax20m+ax50m+ax100m+ax200m);
	
		var ax010m1= $("#txt010m").html();
		var ax020m1=$("#txt020m").html();
		var ax050m1=$("#txt050m").html();
		var ax1m1=$("#txt1m").html();
		var ax2m1=$("#txt2m").html();
		var ax5m1=$("#txt5m").html();
		var ax10m1=$("#txt10m").html();
		var ax20m1=$("#txt20m").html();
		var ax50m1=$("#txt50m").html();
		var ax100m1=$("#txt100m").html();
		var ax200m1=$("#txt200m").html();
		var axtotalotros=$("#txtotrosc").html();
	var axtotalmonedas = Number(ax010m1)+Number(ax020m1)+Number(ax050m1)+Number(ax1m1)+ Number(ax2m1) + Number(ax5m1) + Number(ax10m1)+ Number(ax20m1) + Number(ax50m1)+ Number(ax100m1)+ Number(ax200m1)+ Number(axtotalotros);
		
	$("#txttotalmonedas").html(axtotalmonedas);

}



function calcular_cierre_general(){

	var axlocal = $("#txtlocales").val();
  	var axidempresa= $("#txtidempresa").val();
  	var axfecha= $("#txtfechacierre").val();
  	var axnuncta=($("#txtnuncta_compra option:selected").text());
  	var axcoduser= $("#txtcajero").val();

  	$.ajax({
 		
  		url:"consultas_funciones.php",
      	method: "POST",    
      	data: {param:32,txtlocales:axlocal,txtfechacierre:axfecha,txtidempresa:axidempresa,txtnuncta_compra:axnuncta},
		success : function(vendido){
			
			if (vendido>1){
				
				$("#txtefectivoventas").val(vendido);
				var axventas = $("#txtefectivoventas").val();
				sumartotal();

			}else{

				$("#txtefectivoventas").val(0);
				var axventas = $("#txtefectivoventas").val();
				sumartotal();
			}
		}
 	})

 	$.ajax({
  		url:"consultas_funciones.php",
      	method: "POST",    
      	data: {param:33,txtlocales:axlocal,txtfechacierre:axfecha,txtidempresa:axidempresa,txtnuncta_compra:axnuncta},
		success : function(ventatajetas){
			
			if (ventatajetas>1){
				
				$("#txttarjetasventas").val(ventatajetas);
				var axcreditos = $("#txttarjetasventas").val();
				sumartotal();

			}else{

				$("#txttarjetasventas").val(0);
				var axcreditos = $("#txttarjetasventas").val();
				sumartotal();
			}

		}
 	})


$.ajax({

  		url:"consultas_funciones.php",
      	method: "POST",    
      	data: {param:34,txtlocales:axlocal,txtfechacierre:axfecha,txtidempresa:axidempresa,txtnuncta_compra:axnuncta},
		success : function(ventascreditos){
			
			if (ventascreditos>1){
				
				$("#txtventascredito").val(ventascreditos);
				var axcreditos = $("#txtventascredito").val();
				sumartotal();

			}else{

				$("#txtventascredito").val(0);
				var axcreditos = $("#txtventascredito").val();
				sumartotal();
			}

		}
 	})



	$.ajax({

  		url:"consultas_funciones.php",
      	method: "POST",    
      	data: {param:35,txtlocales:axlocal,txtfechacierre:axfecha,txtidempresa:axidempresa,txtnuncta_compra:axnuncta},
		success : function(comprascontado){
			
			var axcompraCON = comprascontado;
			
			if (axcompraCON>1){
			
				$("#efectivogastos").val(comprascontado);
				var axcomprascontado = $("#efectivogastos").val();
				sumartotal();

			}else{
				//alert(axcompras);
				$("#efectivogastos").val(0);
				var axcomprascontado = $("#efectivogastos").val();
				sumartotal();

			}

			
		}
 	})



	$.ajax({

  		url:"consultas_funciones.php",
      	method: "POST",    
      	data: {param:36,txtlocales:axlocal,txtfechacierre:axfecha,txtidempresa:axidempresa,txtnuncta_compra:axnuncta},
		success : function(axtarjetasgastos){
			
			var axcomprasC = axtarjetasgastos;
			
			if (axcomprasC>1){
			
				$("#tarjetasgastos").val(axtarjetasgastos);
				var axcomprascredito = $("#tarjetasgastos").val();
			sumartotal();

			}else{
				//alert(axcompras);
				$("#tarjetasgastos").val(0);
				var axcomprascredito = $("#tarjetasgastos").val();
			sumartotal();

			}

			
		}
 	})


$.ajax({

  		url:"consultas_funciones.php",
      	method: "POST",    
      	data: {param:37,txtlocales:axlocal,txtfechacierre:axfecha,txtidempresa:axidempresa,txtnuncta_compra:axnuncta},
		success : function(axtarjetasgastos){
			
			var axcomprasC = axtarjetasgastos;
			
			if (axcomprasC>1){
			
				$("#txtcomprascredito").val(axtarjetasgastos);
				var axcomprascredito = $("#txtcomprascredito").val();
				sumartotal();

			}else{
				//alert(axcompras);
				$("#txtcomprascredito").val(0);
				var axcomprascredito = $("#txtcomprascredito").val();
				sumartotal();

			}

			
		}
 	})



$.ajax({

  		url:"consultas_funciones.php",
      	method: "POST",    
      	data: {param:38,txtlocales:axlocal,txtfechacierre:axfecha,txtidempresa:axidempresa},
		success : function(saldoantes){
			
		var axsaldo = saldoantes
		if (axsaldo > 1) {

			$("#txtsaldoanterior").val(saldoantes);
			var axsaldoanterios = $("#txtsaldoanterior").val();	
			sumartotal();

		} else {

			$("#txtsaldoanterior").val(0);
			var axsaldoanterios = $("#txtsaldoanterior").val();	
			
		sumartotal();
		}
	}

 	})

$.ajax({

  		url:"consultas_funciones.php",
      	method: "POST",    
      	data: {param:39,txtlocales:axlocal,txtfechacierre:axfecha,txtidempresa:axidempresa},
		success : function(aperturas){
			
		var axsaldo = aperturas
		if (axsaldo > 1) {

			$("#txtsaldoinicial").val(aperturas);
			var axsaldoinicial = $("#txtsaldoinicial").val();	
			sumartotal();

		} else {

			$("#txtsaldoinicial").val(0);
			var axsaldoinicial = $("#txtsaldoinicial").val();	
			
		sumartotal();
		}
	}

 	})

$.ajax({

  		url:"consultas_funciones.php",
      	method: "POST",    
      	data: {param:40,txtlocales:axlocal,txtfechacierre:axfecha,txtidempresa:axidempresa},
		success : function(mondeas){
		var json = JSON.parse(mondeas);
	  			
	  		if (json.status == 200){
  		

				var ax010m = (Number(json.M_1)*0.10);
				$("#txt010m").html(ax010m);
				var m1 = json.M_1;
	  			$("#txt010c").html(m1);
	
				var ax020m = (Number(json.M_2)*0.20);
				$("#txt020m").html(ax020m);
				var m2 = json.M_2;
	  			$("#txt020c").html(m2);

				var ax050m = (Number(json.M_3)*0.50);
				$("#txt050m").html(ax050m);
				var m3 = json.M_3;
	  			$("#txt050c").html(m3);

				var ax1m = (Number(json.M_4)*1);
				$("#txt1m").html(ax1m);
				var m4 = json.M_4;
	  			$("#txt1c").html(m4);

				var ax2m = (Number(json.M_5)*2);
				$("#txt2m").html(ax2m);
				var m5 = json.M_5;
	  			$("#txt2c").html(m5);

	  			
				var ax5m = (Number(json.M_6)*5);
				$("#txt5m").html(ax5m);
				var m6 = json.M_6;
	  			$("#txt5c").html(m6);

				var ax10m = (Number(json.M_7)*10);
				$("#txt10m").html(ax10m);
				var m7 = json.M_7;
	  			$("#txt10c").html(m7);

				var ax20m = (Number(json.M_8)*20);
				$("#txt20m").html(ax20m);
				var m8 = json.M_8;
	  			$("#txt20c").html(m8);

				var ax50m = (Number(json.M_9)*50);
				$("#txt50m").html(ax50m);
				var m9 = json.M_9;
	  			$("#txt50c").html(m9);

				var ax100m = (Number(json.M_10)*100);
				$("#txt100m").html(ax100m);
				var m10 = json.M_10;
	  			$("#txt100c").html(m10);

				var ax200m = (Number(json.M_11)*200);
				$("#txt200m").html(ax200m);
				var m11 = json.M_11;
	  			$("#txt200c").html(m11);

				var axotrosm = (Number(json.M_12)*1);
				var m12 = json.M_12;
	  			$("#txtotrosc").html(m12);

				SumarMonedas();
			
			}
		
		}

 	})

}


function calcular_cierre_cajero(){


	var axlocal = $("#txtlocales").val();
  	var axidempresa= $("#txtidempresa").val();
  	var axfecha= $("#txtfechacierre").val();
  	var axnuncta=($("#txtnuncta_compra option:selected").text());
  	var axcoduser= $("#txtcajero").val();

  	$.ajax({
 		
  		url:"consultas_funciones.php",
      	method: "POST",    
      	data: {param:23,txtlocales:axlocal,txtfechacierre:axfecha,txtidempresa:axidempresa,txtnuncta_compra:axnuncta,txtcajero:axcoduser},
		success : function(vendido){
			
			if (vendido>1){
				
				$("#txtefectivoventas").val(vendido);
				var axventas = $("#txtefectivoventas").val();
				sumartotal();

			}else{

				$("#txtefectivoventas").val(0);
				var axventas = $("#txtefectivoventas").val();
				sumartotal();
			}
		}
 	})

 	$.ajax({
  		url:"consultas_funciones.php",
      	method: "POST",    
      	data: {param:24,txtlocales:axlocal,txtfechacierre:axfecha,txtidempresa:axidempresa,txtnuncta_compra:axnuncta,txtcajero:axcoduser},
		success : function(ventatajetas){
			
			if (ventatajetas>1){
				
				$("#txttarjetasventas").val(ventatajetas);
				var axcreditos = $("#txttarjetasventas").val();
				sumartotal();

			}else{

				$("#txttarjetasventas").val(0);
				var axcreditos = $("#txttarjetasventas").val();
				sumartotal();
			}

		}
 	})


$.ajax({

  		url:"consultas_funciones.php",
      	method: "POST",    
      	data: {param:25,txtlocales:axlocal,txtfechacierre:axfecha,txtidempresa:axidempresa,txtnuncta_compra:axnuncta,txtcajero:axcoduser},
		success : function(ventascreditos){
			
			if (ventascreditos>1){
				
				$("#txtventascredito").val(ventascreditos);
				var axcreditos = $("#txtventascredito").val();
				sumartotal();

			}else{

				$("#txtventascredito").val(0);
				var axcreditos = $("#txtventascredito").val();
				sumartotal();
			}

		}
 	})






	$.ajax({

  		url:"consultas_funciones.php",
      	method: "POST",    
      	data: {param:21,txtlocales:axlocal,txtfechacierre:axfecha,txtidempresa:axidempresa,txtnuncta_compra:axnuncta,txtcajero:axcoduser},
		success : function(comprascontado){
			
			var axcompraCON = comprascontado;
			
			if (axcompraCON>1){
			
				$("#efectivogastos").val(comprascontado);
				var axcomprascontado = $("#efectivogastos").val();
				sumartotal();

			}else{
				//alert(axcompras);
				$("#efectivogastos").val(0);
				var axcomprascontado = $("#efectivogastos").val();
				sumartotal();

			}

			
		}
 	})



	$.ajax({

  		url:"consultas_funciones.php",
      	method: "POST",    
      	data: {param:22,txtlocales:axlocal,txtfechacierre:axfecha,txtidempresa:axidempresa,txtnuncta_compra:axnuncta,txtcajero:axcoduser},
		success : function(axtarjetasgastos){
			
			var axcomprasC = axtarjetasgastos;
			
			if (axcomprasC>1){
			
				$("#tarjetasgastos").val(axtarjetasgastos);
				var axcomprascredito = $("#tarjetasgastos").val();
			sumartotal();

			}else{
				//alert(axcompras);
				$("#tarjetasgastos").val(0);
				var axcomprascredito = $("#tarjetasgastos").val();
			sumartotal();

			}

			
		}
 	})


$.ajax({

  		url:"consultas_funciones.php",
      	method: "POST",    
      	data: {param:26,txtlocales:axlocal,txtfechacierre:axfecha,txtidempresa:axidempresa,txtnuncta_compra:axnuncta,txtcajero:axcoduser},
		success : function(axtarjetasgastos){
			
			var axcomprasC = axtarjetasgastos;
			
			if (axcomprasC>1){
			
				$("#txtcomprascredito").val(axtarjetasgastos);
				var axcomprascredito = $("#txtcomprascredito").val();
				sumartotal();

			}else{
				//alert(axcompras);
				$("#txtcomprascredito").val(0);
				var axcomprascredito = $("#txtcomprascredito").val();
				sumartotal();

			}

			
		}
 	})


/*
$.ajax({

  		url:"consultas_funciones.php",
      	method: "POST",    
      	data: {param:20,txtlocales:axlocal,txtfechacierre:axfecha,txtidempresa:axidempresa,txtcajero:axcoduser},
		success : function(saldoantes){
			
		var axsaldo = saldoantes
		if (axsaldo > 1) {

			$("#txtsaldoanterior").val(saldoantes);
			var axsaldoanterios = $("#txtsaldoanterior").val();	
			sumartotal();

		} else {

			$("#txtsaldoanterior").val(0);
			var axsaldoanterios = $("#txtsaldoanterior").val();	
			
sumartotal();
		}
	}

 	})
*/
		

}

function sumartotal(){

	var axsaldoinicial = $("#txtsaldoinicial").val();
	var axsaldoanterios = $("#txtsaldoanterior").val();	

	var axefectivoventas = $("#txtefectivoventas").val();
	var axtarjetasventas = $("#txttarjetasventas").val();
	
	var axefectivogastos = $("#efectivogastos").val();
	
	var axretiros = $("#txtretiros").val();

	//var axsaldoactual = (parseInt(axefectivoventas)+parseInt(axtarjetasventas)+parseInt(axsaldoinicial)+parseInt(axsaldoanterios))-(parseInt(axefectivogastos)+parseInt(axretiros));
	var axsaldoactual = (parseInt(axefectivoventas)+parseInt(axsaldoinicial)+parseInt(axsaldoanterios))-(parseInt(axefectivogastos)+parseInt(axretiros));

	$("#txtsaldoactual").val(axsaldoactual);


}

$(document).on("change","#txtsaldoinicial",function(){
	sumartotal()
})

$(document).on("change","#txtretiros",function(){
	sumartotal()
})

$(document).on("change","#txtanoreporte",function(){
	Inventario_valorizado();
})


function Graficaventas(){

	var axidlocal =$("#txtlocales").val();
	var axfecha_actual =$("#txtfecha_actual").val();
	var axfecha_inicio=$("#txtfechainicio").val();
	var axcoduser=$("#txtcodusuario").val();
	var axanoreporte =$("#txtanoreporte").val();

	$.ajax({
		
		url:"consultas_funciones.php",
		method: "POST",
		data: {param:42,txtlocales:axidlocal,txtfecha_actual:axfecha_actual,txtfechainicio:axfecha_inicio,txtanoreporte:axanoreporte,txtcodusuario:axcoduser},
		success : function(data_reporte){

//*************************************************************//

	var ctx = document.getElementById('myChart').getContext('2d');
	var myChart = new Chart(ctx, {
	type: 'line',
	data: {
		labels: [ 

				<?php

		        	
		        	$SQLVentasGraficaFechas = "SELECT * FROM REPORTE_GRAFICA_VENTAS WHERE FECHA BETWEEN '$fecha_inicial' AND '$fecha_actual' AND COD_USER='$axiduser' ORDER BY FECHA ASC ";
		        	$RSVentasGraficaFechas=odbc_exec($con,$SQLVentasGraficaFechas);
					while ($rowGV=odbc_fetch_array($RSVentasGraficaFechas)){
						$fechaE= date("d-m",strtotime($rowGV['FECHA']));
				?>

					

					'<?php echo $fechaE; ?>',
					
				<?php	} ?>
				],
			
		datasets: [{
 		label: '# Ventas ',
      	data: [			
				<?php
					$anoactual =date("Y");
		        	
		        	$SQLVentasGraficaVentas = "SELECT * FROM REPORTE_GRAFICA_VENTAS WHERE FECHA BETWEEN '$fecha_inicial' AND '$fecha_actual' AND COD_USER='$axiduser' ORDER BY FECHA ASC ";
		        	$RSVentasGraficaVentas=odbc_exec($con,$SQLVentasGraficaVentas);
					while ($rowGV=odbc_fetch_array($RSVentasGraficaVentas)){

				?>
					'<?php echo $rowGV['VENDIDO']; ?>',
					
				<?php 	} 	?>
           	],

		backgroundColor: [
		    'rgba(255, 99, 132, 0.2)',
			'rgba(54, 162, 235, 0.2)',
			'rgba(255, 206, 86, 0.2)',
			'rgba(75, 192, 192, 0.2)',
			'rgba(153, 102, 255, 0.2)',
			'rgba(255, 159, 64, 0.2)'
		],
		borderColor: [
		    'rgba(255, 99, 132, 1)',
		    'rgba(54, 162, 235, 1)',
			'rgba(255, 206, 86, 1)',
			'rgba(75, 192, 192, 1)',
			'rgba(153, 102, 255, 1)',
			'rgba(255, 159, 64, 1)'
		],
		borderWidth: 1
		}]
	},
		options: {
			responsive: true,
			scales: {
				yAxes: [{
					ticks: {
						beginAtZero: true
					}
				}]
			}
		}
	});


//*************************************************************//

		}
	})
}

$(document).on("change","#txtanoreporte_kardex",function(){
	ListarProductosMasusadosenelano();
})

$(document).on("change","#txtproductoslistar",function(){
	KardexPorProducto();
})

function KardexPorProducto(){

	var axidlocal =$("#txtlocales").val();
	var axanoreporte =$("#txtanoreporte_kardex").val();
	var axidinsumo =$("#txtproductoslistar").val();

	$.ajax({
		
		url:"consultas_funciones.php",
		method: "POST",
		data: {param:44,txtlocales:axidlocal,txtanoreporte_kardex:axanoreporte,txtproductoslistar:axidinsumo},
		success : function(listarKardexPorProductos){

			$("#divkardexvalorizado").html(listarKardexPorProductos);
		}
	})

}








  </script>