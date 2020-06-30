<?php require_once '../includes/header.php'; 

$axidlocal=$_GET['id'];


?>


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
<input type="hidden" name="txtcodusuario" id="txtcodusuario" value="<?php echo "$axiduser";?>">
<input type="hidden" name="txtidusuario" id="txtidusuario" value="<?php echo "$axcoduser";?>">
<input type="hidden" name="txtidlocal" id="txtidlocal" value="<?php echo "$axidlocal";?>">
<input type="hidden" name="txtcodmovcz" id="txtcodmovcz" >
<input type="hidden" name="txtidinsumo" id="txtidinsumo" >
<input type="hidden" name="txtestado_pedido" id="txtestado_pedido">
<!--input type="hidden" name="txttipopedido" id="txttipopedido" value="PEDIDOS"-->
<input type="hidden" name="txtano_actual" id="txtano_actual" value="<?php echo "$anoactual";?>">


<div class="container-fluid" id="divcontenedor1" >
<div class="card-body" id="divcabecera_1" >
<div class="row">
	<div class="col-12">

	<div class="card border-primary">	

		<div class="card-header text-danger" >
			<div id="divbotonnuevo" style="display: none;">
			<h3><b>Generar Pedido</b> <button  id='btnuevodocumento' type='button' class='btn btn-danger' > Nuevo <span id='btcontador' class='badge badge-light'></span></button>	</h3>
			</div>	

			<div class="form-row">
				<div  class="col-sm-4">
				<label for=""><b>Fecha Emisión</b></label>				
				<input type="date" class="form-control" name="txtfechaactual" id="txtfechaactual" value="<?php echo "$diaactual";?>" style="text-align: center;">
				<!--input type="date" class="form-control" name="txtfechaactual" id="txtfechaactual" value="2019-08-28" style="text-align: center;"-->
				</div>

				<div  class="col-sm-4">
				<label for=""><b>Fecha Entrega</b></label>				
				<input type="date" class="form-control" name="txtfechaentrega" id="txtfechaentrega" value="<?php echo "$diaactual";?>" style="text-align: center;">
				<!--input type="date" class="form-control" name="txtfechaactual" id="txtfechaactual" value="2019-08-28" style="text-align: center;"-->
				</div>
			
				<div  class="col-sm-2">
				<label for="reloj"><b>Hora</b></label>
				<form name="form_reloj">
				<b><input type="text" style="text-align: center;" class="form-control" id="reloj" name="reloj" aria-describedby="	basic-addon3"></b>
				<input type="hidden" name="txthoraactual" id="txthoraactual">
				</form>
				</div>

				<div class="form-group col-md-2">
				    <label for="txttipodoc"><b>Tipo</b></label>
					<select class="form-control custom-select mr-sm-2"id="txttipopedido">
						<option value="PEDIDOS">PEDIDOS</option>
						<option value="PRODUCCION">PRODUCCION</option>
					</select>
			    </div>
			</div>

			<div class="form-row">		
				<div  class="col-sm-4">
				<label for=""><b>RUC|RAZON SOCIAL</b></label>				
				<input type="hidden" class="form-control" name="txtdnivendedor" id="txtdnivendedor" value="0" >
				<input type="hidden" class="form-control" name="txtidbeneficiario" id="txtidbeneficiario">
				<input type="hidden" class="form-control" name="txtcliente" id="txtcliente" style="text-align: center;">
				<input type="text" class="form-control" id="txtnom_cliente">

				<div id="div_listarclientes"></div>
				</div>

				<div  class="col-sm-6">
				<label for=""><b>Lugar Entrega</b></label>				
				<input type="text" class="form-control" name="txtlugarentrega" id="txtlugarentrega" value="0" style="text-align: center;">
				<input type="hidden" class="form-control" name="txtdireccionvendedor" id="txtdireccionvendedor" style="text-align: center;" disabled>
				</div>

				<div class="form-group col-md-2">
				    <label for="txttipodoc"><b>Comprobante</b></label>
					<select class="form-control custom-select mr-sm-2"id="txttipodoc">
						<option value="FACTURA">FACTURA</option>
						<option value="BOLETA DE VENTA">BOLETA DE VENTA</option>
					</select>
			    </div>

			</div>	
		</div><!--div class="card-header text-danger"-->

		<div class="card-body text-dark" >

			<div class="row">
				<div class="col-12 col-sm-12 col-md-12 col-lg-5 col-xl-5" id="divlistaproductos" style="display: none;">	
					<div class="card border-danger" >
				
					
					<div class="card-header">
						
						<div class="form-row">
							<div  class="col-sm-8">
							<label for=""><b>Buscar</b></label>				
							<input type="text" class="form-control" name="txtbuscar" id="txtbuscar" placeholder="Productos" style="text-align: center;" >
							</div>
							
							<div  class="col-sm-4">
							<label for="txtcant_venta"><b>Cantidad</b></label>				
							<input type="number" class="form-control" name="txtcant_venta" id="txtcant_venta" Value="1" style="text-align: center;" >
							<input type="hidden" class="form-control" name="txtprecio_venta" id="txtprecio_venta" Value="0" style="text-align: center;" >
							<input type="hidden" class="form-control" name="txtdscto_venta" id="txtdscto_venta" Value="0" style="text-align: center;" >
							<input type="hidden" class="form-control" name="txtvalorventa_venta" id="txtvalorventa_venta" Value="0" style="text-align: center;" >
							<input type="hidden" class="form-control" name="txtigv_venta" id="txtigv_venta" Value="0" style="text-align: center;" >

							<input type="hidden" class="form-control" name="txtgravadas_venta" id="txtgravadas_venta" Value="0" style="text-align: center;" >
							<input type="hidden" class="form-control" name="txtinafectas_venta" id="txtinafectas_venta" Value="0" style="text-align: center;" >
							<input type="hidden" class="form-control" name="txtexonerada_venta" id="txtexonerada_venta" Value="0" style="text-align: center;" >
							<input type="hidden" class="form-control" name="txttotal_venta" id="txttotal_venta" Value="0" style="text-align: center;" >
							</div>
						</div>
					</div>
					<div id="bodylistarproductos"></div>
				
					</div>

					

				</div><!--div class="col-12 col-sm-4 col-md-8 col-lg-4 col-xl-5" id="divlistaproductos" style="display: none;"-->	

				<div class="col-12 col-sm-12 col-md-12 col-lg-7 col-xl-7" id="divlistaproductospedidos" style="display: none;" >
					<div class="card border-danger">
					<div id="bodylistarpedidodetallar"></div>
					</div>

					<p><hr/><p>
					
					<div id='divbtprocesar'> 
					<button type='button' class='btn btn-outline-danger btn-sm' id='btprocesar'>Procesar y cerrar</button> 
					</div>

					<div id='divimprimir' style="display: none;"> 
					<button type='button' class='btn btn-outline-info btn-sm' id='btimprimirdespacho'>Imprimir</button> 
					<a href='javascript:cerrar()'class='btn btn-outline-danger btn-sm' id='btcerrar'>Cerrar</a> 
					</div>

				</div><!--div class="col-12 col-sm-8 col-md-4 col-lg-7 col-xl-7" id="divlistaproductospedidos" style="display: none;" -->

			</div><!--div class="row"-->



		</div><!--div class="card-body text-dark" -->




	</div><!--div class="card border-primary"-->
	</div><!--div class="col-12"-->
</div><!--div class="row"-->
</div><!--div class="card-body" id="divcabecera_1"-->
</div><!--<div class="container-fluid" id="divcontenedor1"-->   



</body>

<script type="text/javascript">

$(document).ready(function() {	
	Verifica_permiso();
});

$('#txtnom_cliente').keyup(function(){

  var axbuscarcliente = $("#txtnom_cliente").val();
  
  if (axbuscarcliente != '') {

    $.ajax({
      url:"pedidos_gestion_funciones.php",
      method: "POST",
      data: {param:14,txtnom_cliente:axbuscarcliente},
      success : function(data){

        $('#div_listarclientes').fadeIn();
        $('#div_listarclientes').html(data);
        
      }
    });
  } 
});

$(document).on("click","#liclientes",function(){

	$("#txtnom_cliente").val($(this).text());
	$("#txtidbeneficiario").val($(this).data("idbenef"));
	$("#txtdnivendedor").val($(this).data("ruccliente"));

	Buscar_pedidos_existentes()

	//$("#liclientes").fadeOut();
	$('#div_listarclientes').fadeOut();

})





$(document).on("click","#btimprimirdespacho",function(){

	var axcodmovcz = $("#txtcodmovcz").val();
	
  	$.ajax({

 		url:"pedidos_gestion_funciones.php",
		method: "POST",
		data: {param:10,txtcodmovcz:axcodmovcz },
		success : function(imprimir){
		}
 	})

	Reporte_despacho();

})

function Reporte_despacho() {

	
	var axcodmovcz = $("#txtcodmovcz").val();
	window.open("pedido_despacho.php?id="+axcodmovcz);	

	
	

}

function contar_pedidos_procesados(){

	var axidbeneficiario= $("#txtidbeneficiario").val();
	var axfechapedido = $("#txtfechaactual").val();	
	var axidlocal =$("#txtidlocal").val();
		$.ajax({ // verifica si existen pedidos de este vendedor y los contare
			url:"pedidos_gestion_funciones.php",
			method: "POST",
			data: {param:2,txtfechaactual:axfechapedido,txtidbeneficiario:axidbeneficiario,txtidlocal:axidlocal},
									
			success : function(muestra_pedido){
				var json = JSON.parse(muestra_pedido);
					if (json.status == 200){
						$("#divbotonnuevo").css({'display':'block'});	
						$("#btcontador").html(json.NUMERO);
						
					} else if(json.status == 400){ 

						$("#btcontador").html('');
						$("#divbotonnuevo").css({'display':'block'});	
					}
			}
		})
}

function Detalle_Cabecera_Pedido(){

	var axidempresa= $("#txtidempresa").val();
	var axidbeneficiario= $("#txtidbeneficiario").val();
	var axfechapedido= $("#txtfechaactual").val();
	

	$.ajax({

		url:"pedidos_gestion_funciones.php",
			method: "POST",
			data: {param:13,txtidempresa:axidempresa,txtidbeneficiario:axidbeneficiario,txtfechaactual:axfechapedido},
						
			success : function(datos_benef_cabec){

				var json = JSON.parse(datos_benef_cabec);

				if (json.status == 200){

					$("#txtfechaentrega").val(json.FECHA_ENTREGA);
					$("#txttipodoc").val(json.TIPO_COMPROBANTE);
					$("#txtlugarentrega").val(json.LUGAR_ENTREGA);

				}


			}

	})

}

function Buscar_pedidos_existentes(){

	//var axcodusuario = $("#txtcodusuario").val();
		var axdnivendedor= $("#txtdnivendedor").val();

		$.ajax({
			url:"pedidos_gestion_funciones.php",
			method: "POST",
			data: {param:1,txtdnivendedor:axdnivendedor},
						
			success : function(datos_benef){
			
			var json = JSON.parse(datos_benef);

				if (json.status == 200){

					$("#txtcliente").val(json.NOM_PROVEEDOR);
					$("#txtidbeneficiario").val(json.ID_BENEFICIARIO);
					$("#txtdireccionvendedor").val(json.DIR_PROVEEDOR);

					contar_pedidos_procesados()
					
					var axidbeneficiario= $("#txtidbeneficiario").val();
					var axfechapedido = $("#txtfechaactual").val();	
					var axidlocal =$("#txtidlocal").val();

				
					$.ajax({ // verifica si existen pedidos de este vendedor y los contare

						url:"pedidos_gestion_funciones.php",
						method: "POST",
						data: {param:11,txtfechaactual:axfechapedido,txtidbeneficiario:axidbeneficiario,txtidlocal:axidlocal},
									
						success : function(muestra_pedido){

							var json = JSON.parse(muestra_pedido);
					
							if (json.status == 200){

								$("#txtestado_pedido").val(json.ESTADO_PEDIDO);
								$("#txtcodmovcz").val(json.ID_PEDIDO_CZ);
				
								ListarProductos();
								ListarPedidoDetalles();
								Detalle_Cabecera_Pedido();

							} else if(json.status == 400){ 

							//	$("#divbotonnuevo").css({'display':'block'});	
								ListarProductos();
							

							}

				
							
						}
					
					})
					

				} else {


					$("#btcontador").html('');
					$("#txtcliente").val("-");
					$("#txtidbeneficiario").val("-");
					$("#txtdireccionvendedor").val("-");
					$("#divbotonnuevo").css({'display':'none'});	

					Swal.fire('INFORMACION!','Vendedor no se encuentra registrado','warning');

				}
				
			}
		})


}


$(document).on("change","#txtdnivendedor",function(){
	
	//var axcodusuario = $("#txtcodusuario").val();
		var axdnivendedor= $("#txtdnivendedor").val();

		$.ajax({
			url:"pedidos_gestion_funciones.php",
			method: "POST",
			data: {param:1,txtdnivendedor:axdnivendedor},
						
			success : function(datos_benef){
			
			var json = JSON.parse(datos_benef);

				if (json.status == 200){

					$("#txtcliente").val(json.NOM_PROVEEDOR);
					$("#txtidbeneficiario").val(json.ID_BENEFICIARIO);
					$("#txtdireccionvendedor").val(json.DIR_PROVEEDOR);

					contar_pedidos_procesados()
					
					var axidbeneficiario= $("#txtidbeneficiario").val();
					var axfechapedido = $("#txtfechaactual").val();	
					var axidlocal =$("#txtidlocal").val();

				
					$.ajax({ // verifica si existen pedidos de este vendedor y los contare

						url:"pedidos_gestion_funciones.php",
						method: "POST",
						data: {param:11,txtfechaactual:axfechapedido,txtidbeneficiario:axidbeneficiario,txtidlocal:axidlocal},
									
						success : function(muestra_pedido){

							var json = JSON.parse(muestra_pedido);
					
							if (json.status == 200){

								$("#txtestado_pedido").val(json.ESTADO_PEDIDO);
								$("#txtcodmovcz").val(json.ID_PEDIDO_CZ);
				
								ListarProductos();
								ListarPedidoDetalles();
								Detalle_Cabecera_Pedido();

							} else if(json.status == 400){ 

							//	$("#divbotonnuevo").css({'display':'block'});	
								ListarProductos();
							

							}

				
							
						}
					
					})
					

				} else {


					$("#btcontador").html('');
					$("#txtcliente").val("-");
					$("#txtidbeneficiario").val("-");
					$("#txtdireccionvendedor").val("-");
					$("#divbotonnuevo").css({'display':'none'});	

					Swal.fire('INFORMACION!','Vendedor no se encuentra registrado','warning');

				}
				
			}
		})



	

})


$(document).on("click","#btnuevodocumento",function(){


	$("#txtestado_pedido").val("PENDIENTE");

	var axhorapedidio_1= $("#reloj").val();
	$("#txthoraactual").val(axhorapedidio_1);
	var axhorapedidio = $("#txthoraactual").val();

	var axidlocal =$("#txtidlocal").val();
	var axcodusuario=$("#txtcodusuario").val();

	momentoActual = new Date() 
	hora = addZero(momentoActual.getHours());
	minuto = addZero(momentoActual.getMinutes()); 
	segundo = addZero(momentoActual.getSeconds()); 
	var axcodmovcz1  = axidlocal+axcodusuario.substr(0,3)+hora+minuto+segundo;

	$("#txtcodmovcz").val(axcodmovcz1);

	var axcodmovcz = $("#txtcodmovcz").val();
	var axfechapedido = $("#txtfechaactual").val();
	var axidbeneficiario= $("#txtidbeneficiario").val();
	var axfechaentrega= $("#txtfechaentrega").val();
	var axlugarentrega= $("#txtlugarentrega").val();
	var axtipopedido= $("#txttipopedido").val();
	var axtipocomprobante= $("#txttipodoc").val();
	var axidempresa= $("#txtidempresa").val();
	var axano_actual= $("#txtano_actual").val();

	
	$.ajax({
		url:"pedidos_gestion_funciones.php",
		method: "POST",
		data: {param:3,
			txtcodmovcz:axcodmovcz,
			txtfechaactual:axfechapedido,
			txthoraactual:axhorapedidio,
			txtidbeneficiario:axidbeneficiario,
			txtidlocal:axidlocal,
			txtcodusuario:axcodusuario,
			txtfechaentrega:axfechaentrega,
			txtlugarentrega:axlugarentrega,
			txttipopedido:axtipopedido,
			txttipodoc:axtipocomprobante,
			txtidempresa:axidempresa,
			txtano_actual:axano_actual
		},						
			success : function(grabar_nuevo){
			
				if(grabar_nuevo==0){

					//alert("Entreee");

					//document.getElementById("divbotonnuevo").innerHTML = "<b >Pedido PENDIENTE </b>";
					//$("#divlistaproductos").css({'display':'block'});	
					//$("#divlistaproductospedidos").css({'display':'block'});
					
					ListarProductos();
					ListarPedidoDetalles();


				}else{

					//alert("PROCESADO");

					$("#divlistaproductos").css({'display':'none'});	
					$("#divlistaproductospedidos").css({'display':'none'});

				}


			}
	})
})

function ListarProductos(){

	var axidempresa = $("#txtidempresa").val();	
	var axbuscar = $("#txtbuscar").val();
	var axestado_pedido = $("#txtestado_pedido").val();

	//alert(axestado_pedido);

	$.ajax({

		
		url:"pedidos_gestion_funciones.php",
		method: "POST",
		data: {param:0,txtidempresa:axidempresa,txtbuscar:axbuscar},
			
		success : function(listar_productos){

			if(axestado_pedido=="PENDIENTE"){
				
				//alert("Entree a pendiente");
				
				$("#divlistaproductos").css({'display':'block'});	
				$("#divlistaproductospedidos").css({'display':'block'});
				$("#divbotonnuevo").css({'display':'block'});
				
				document.getElementById("divbotonnuevo").innerHTML = "<h3><b>Pedido PENDIENTE</b></h3>";

				//$('#divlistaproductos *').attr("disabled", true);
				$('#divlistaproductos *').fadeTo('slow', 1); 
 				$("#divlistaproductos").css({'pointer-events':'auto'});

				$("#bodylistarproductos").html(listar_productos);	
				$("#divbtprocesar").css({'display':'block'});	


			} else if(axestado_pedido=="PROCESADO"){

				//alert("Entree a prcesados");

				$('#divlistaproductos *').attr("disabled", false);
 				$('#divlistaproductos *').fadeTo('slow', .9); 
 				$("#divlistaproductos").css({'pointer-events':'none'});
 				$("#divbtprocesar").css({'display':'none'});
 				$("#bodylistarproductos").html(listar_productos);
			}

			

		}
	})
}




function ListarPedidoDetalles(){

	var axidlocal = $("#txtidlocal").val();	
	var axidbeneficiario= $("#txtidbeneficiario").val();	
	var axfechapedido= $("#txtfechaactual").val();
	var axcodmovcz = $("#txtcodmovcz").val();

	//alert(axcodmovcz);

		$.ajax({
		url:"pedidos_gestion_funciones.php",
			method: "POST",
			data: {param:6,txtidlocal:axidlocal,txtcodmovcz:axcodmovcz,txtfechaactual:axfechapedido,txtidbeneficiario:axidbeneficiario},	
			success : function(listar_productos_pedido_1){
				
				//alert(listar_productos_pedido_1);
					$("#bodylistarpedidodetallar").html(listar_productos_pedido_1);	
				

			
				
			}
		})
	
}



$(document).on("change","#txtfechaactual",function(){
	
var axidbeneficiario= $("#txtidbeneficiario").val();
var axfechapedido = $("#txtfechaactual").val();	
var axidlocal =$("#txtidlocal").val();

	$.ajax({
		url:"pedidos_funciones.php",
		method: "POST",
		data: {param:2,txtfechaactual:axfechapedido,txtidbeneficiario:axidbeneficiario,txtidlocal:axidlocal},
									
		success : function(muestra_pedido){
			var json = JSON.parse(muestra_pedido);
			if (json.status == 200){

				$("#txtestado_pedido").val(json.ESTADO_PEDIDO);		
				var axestado_pedido = $("#txtestado_pedido").val();

				$("#txtcodmovcz").val(json.ID_PEDIDO_CZ);
				var axcodmovcz = $("#txtcodmovcz").val();

				if(axestado_pedido=="PENDIENTE"){


					document.getElementById("divbotonnuevo").innerHTML = "<b >Pedido PENDIENTE </b>";
					$("#divlistaproductos").css({'display':'block'});	
					$("#divlistaproductospedidos").css({'display':'block'});
					$("#divbtprocesar").css({'display':'block'});
					ListarProductos()
					ListarPedidoDetalles();
		
				} else {

					$("#divlistaproductos").css({'display':'block'});	
					$("#divlistaproductospedidos").css({'display':'block'});
					$("#divbtprocesar").css({'display':'none'});

					document.getElementById("divbotonnuevo").innerHTML = "<b class='text-primary'>Pedido PROCESADO</b>";
					ListarProductos();
					ListarPedidoDetalles();
										
				}
		
			} else {

				$("#txtcodmovcz").val("");

				document.getElementById("divbotonnuevo").innerHTML = "<b class='text-danger'>Generar pedido </b><button type='button' id='btnuevodocumento' class='btn btn-outline-danger btn-sm' data-toggle='modal' data-target='#'><b> Nuevo </b></button>";
				ListarProductos();
				ListarPedidoDetalles();
			}
		}
	})

})



$(document).on("click","#bteliminar",function(){

var axidinsumo = $(this).data("id");	
var axestado_pedido = $("#txtestado_pedido").val();
var axcodmovcz= $("#txtcodmovcz").val();
var axidlocal= $("#txtidlocal").val();	

//alert(axestado_pedido);

if(axestado_pedido=="PENDIENTE"){

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
				url:"pedidos_gestion_funciones.php",
				method: "POST",
				data: {param:8,axidinsumo:axidinsumo,txtcodmovcz:axcodmovcz,txtidlocal:axidlocal},
				success : function(eliminar){

					if(eliminar==0){
						//swal("El registro ha sido eliminado!", {icon: "success",});	

						Swal.fire(
					      'ELIMINADO!',
					      'Su registro ha sido eliminado',
					      'success'
					    )
					    ListarPedidoDetalles();
					} else {		
						//swal("El registro no se elimino!", {icon: "success",});					
						Swal.fire(
					      'PROCESADO!',
					      'El registro no puede ser eliminado, por estar ya PROCESADO',
					      'error'
					    )

						
					}
				
				}
			})
			/*
	     	  Swal.fire(
		      'Eliminado!',
		      'Su archivo ha sido eliminado',
		      'success'
		    ) */
		  }

	})
		
	}else {

		Swal.fire(
			'ADVERTENCIA!',
			'No puede eliminar registros de un pedido PROCESADO',
			'success'
		)

	
}

})


$(document).on("click","#btprocesar",function(){

	var axcodmovcz= $("#txtcodmovcz").val();
	var axidlocal= $("#txtidlocal").val();	

	Swal.fire({
		  title: 'Esta seguro de procesar el pedido?',
		  text: "Una vez procesado, no podrá editarlo!",
		  type: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  confirmButtonText: 'Si Procesar!'
		}).then((result) => {

		  if (result.value) {

		  	$.ajax({
				url:"pedidos_gestion_funciones.php",
				method: "POST",
				data: {param:7,txtcodmovcz:axcodmovcz,txtidlocal:axidlocal},
				success : function(procesar){

					if(procesar==0){
						//swal("El registro ha sido eliminado!", {icon: "success",});	

						Swal.fire(
					      'PROCESADO!',
					      'Su pedido ha sido procesado',
					      'success'
					     )

						$("#divbtprocesar").css({'display':'none'});
					    $("#divimprimir").css({'display':'block'});

					    $('#divlistaproductos *').attr("disabled", false);
		 				$('#divlistaproductos *').fadeTo('slow', .9); 
		 				$("#divlistaproductos").css({'pointer-events':'none'});
		 				$("#divbtprocesar").css({'display':'none'});
						document.getElementById("divbotonnuevo").innerHTML = "<h3><b>Pedido PROCESADO</b></h3>";

						var axcodmovcz = $("#txtcodmovcz").val();
						window.open("pedido_despacho.php?id="+axcodmovcz);	
							

						//listar();
					} else {		
						//swal("El registro no se elimino!", {icon: "success",});					
						Swal.fire(
					      'Cancelado!',
					      'Su pedido aun no ha sido procesado',
					      'success'
					    )

						
					}
				
				}
			})
			/*
	     	  Swal.fire(
		      'Eliminado!',
		      'Su archivo ha sido eliminado',
		      'success'
		    ) */
		  }

	})
		
	
})






$(document).on("click","#btagregar_carro",function(){
	
	
	var axidinsumo_1 = $(this).data("id");	
	var axprec_venta_1 = $(this).data("prs");	
	$("#txtprecio_venta").val(axprec_venta_1);
	var axprec_venta = $("#txtprecio_venta").val();
	$("#txtidinsumo").val(axidinsumo_1);
	var axidinsumo = $("#txtidinsumo").val();


	var axcodmovcz = $("#txtcodmovcz").val();
	var axcant_venta = $("#txtcant_venta").val();
	var axdscto_venta = $("#txtdscto_venta").val();
	
	var axvalor_venta_1 = (axcant_venta)*(axprec_venta);
	$("#txtvalorventa_venta").val(axvalor_venta_1);
	var axvalor_venta = $("#txtvalorventa_venta").val();

	var axigv_venta = $("#txtigv_venta").val();	
	var axgravada_venta = $("#txtgravadas_venta").val();
	var axinafecta_venta = $("#txtinafectas_venta").val();
	var axexonerada_venta = $("#txtexonerada_venta").val();

	$("#txttotal_venta").val(axvalor_venta);
	var axtotal_venta = $("#txttotal_venta").val();
	

	$.ajax({
		url:"pedidos_gestion_funciones.php",
		method: "POST",
		data: {param:4,
								
				txtcodmovcz:axcodmovcz,
				txtidinsumo:axidinsumo,
				txtcant_venta:axcant_venta,
				txtprecio_venta:axprec_venta,
				txtdscto_venta:axdscto_venta,
				txtvalorventa_venta:axvalor_venta,
				txtigv_venta:axigv_venta,
				txtgravadas_venta:axgravada_venta,
				txtinafectas_venta:axinafecta_venta,
				txtexonerada_venta:axexonerada_venta,
				txttotal_venta:axtotal_venta,
			},
				
			success : function(grabar){

				ListarPedidoDetalles();
			}
	})

				
})

$(document).on("keyup","#txtbuscar",function(){
	ListarProductos();
})




function Verifica_permiso(){

var axiduser =$("#txtidusuario").val();
var axpermiso ="PEDIDOS CLIENTES";

$.ajax({
	url:"pedidos_gestion_funciones.php",
	method: "POST",
	data: {param:12,txtidusuario:axiduser,axpermiso:axpermiso},
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

function cerrar() { 
   window.open('','_parent',''); 
   window.close(); 
} 


</script>





