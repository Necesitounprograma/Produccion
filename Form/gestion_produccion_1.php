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
<!--input type="hidden" name="txtidlocal" id="txtidlocal" value="<?php echo "$axidlocal";?>"-->

<input type="hidden" name="txtcodmovcz" id="txtcodmovcz" >
<input type="hidden" name="txtidinsumo" id="txtidinsumo" >
<input type="hidden" name="txtparametro" id="txtparametro" value="0">
<input type="hidden" name="txtidbeneficiario" id="txtidbeneficiario">

<div class="container-fluid" id="divcontenedor1">
	<div class="card-body" id="divcabecera_1" >
		<div class="row">
			<div class="col-12">

			<div class="card border-danger">
				<div class="card-header text-white bg-danger" ><b><h4 class="text-white"><img src="../icon/produc_1.png" style="width: 30px; height: 30px;"> Gestión Producción </h4></b>
					<div class="form-row">
						
						<div  class="col-sm-2">
							<label for="txtidlocal"><b>Local</b></label>
							<select class="form-control custom-select mr-sm-2" id="txtidlocal">
							<option value="SELECCIONAR">SELECCIONAR</option>
							<?php while($fila=odbc_fetch_array($rslocales)) {?>
					    	<option value="<?php echo $fila['ID_LOCAL'];?>"><?php echo $fila['DESCRICION_LC'];?></option><?php } ?>
					    	</select>
						</div>

						<div  class="col-sm-3">
							<label for=""><b>Num. Proceso</b></label>				
							<select class="form-control custom-select mr-sm-2" id="txtidlocal">
							<option value="SELECCIONAR">SELECCIONAR</option>
							<?php while($fila=odbc_fetch_array($rsnumproceso)) {?>
					    	<option value="<?php echo $fila['NP'];?>"><?php echo $fila['NP'];?></option><?php } ?>
					    	</select>
						</div>

						<div  class="col-sm-3">
							<label for=""><b>Estado</b></label>				
							
							<select id="txtestado_pedido" class="form-control">
								<option value="PROCESADO">PROCESADO</option>
								<option value="ATENDIDO">ATENDIDO</option>
								<option value="PENDIENTE">PENDIENTE</option>
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
					        <a class="nav-link active" id="pnlistar_pedidos" href="#">Listar pedidos</a>
					      </li>
					      <li class="nav-item">
					        <a class="nav-link" href="#" id="pngestionar_pedidos" >Gestionar Produccion</a>
					      </li>
					    </ul>
					  </div>
					  <div class="card-body">
							<div id="divlistar_pedidos"></div>					    
							<div id="divgestionar_pedidos">
								
								<div class="row">
								  
								  <div class="col-sm-6">
								    <div class="card">
								      <div class="card-body" id="divgestionar_pedidos_1"></div>
								    </div>
								  </div>

								  <div class="col-sm-6">
								    <div class="card">
								      <div class="card-body" id="divgestionar_pedidos_2">
								      	
								      	

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


<!---------------------------------------------------------------------------->



</body>
</html>	

<script type="text/javascript">

$(document).ready(function() {	
	
	Verifica_permiso();
//	lista_pedidos_procesar();
	

});





/***********************************************/

$(document).on("click","#btenviar_logistica",function(){

	var axnum_proceso = $("#txtnum_proceso").val();
	var axestado_pedido="ATENDIDO";
	var axestado_pedido_prog="PROCESADO";
	var axidlocal = $("#txtidlocal").val();
	var axparametro= $("#txtparametro").val();

	if(axparametro==1){
		
		Swal.fire('INFORMACION!','Este proceso ya fue enviado a LOGISTICA','warning');

	} else{

		$.ajax({
		url:"gestion_produccio_funciones.php",
		method: "POST",
		data: {param:14,txtnum_proceso:axnum_proceso,txtidlocal:axidlocal,axestado_pedido:axestado_pedido,axestado_pedido_prog:axestado_pedido_prog},	
		success : function(data){
			
			if(data==0){
				
				Swal.fire('INFORMACION!','SE DEBERAN GENERAR LA ORD. COMPRA Y NOTAS DE SALIDAD EN EL MODULO DE LOGISTICA','success')
				//Grilla_Pedidos_Programar()
				//window.open("gestion_produccion.php");	// cuando envias a logistica o anulas deberia actualizar toda la pagina
			}else{
				Swal.fire('ADVERTENCIA!','No se genero el proceso','error')
			}
					
		}
	})


	}

	
})


$(document).on("click","#btanular_proceso",function(){

	var axnum_proceso = $("#txtnum_proceso").val();
	var axidlocal = $("#txtidlocal").val();
	var axcoduser= $("#txtcodusuario").val();
	var axparametro= $("#txtparametro").val();

	if(axparametro==1){
		
		Swal.fire('INFORMACION!','Este proceso NO PUEDE SER ELIMINADO, ya fue enviado a LOGISTICA','warning');

	} else{

		$.ajax({
		url:"gestion_produccio_funciones.php",
		method: "POST",
		data: {param:12,txtnum_proceso:axnum_proceso,txtidlocal:axidlocal,txtcodusuario:axcoduser},	
		success : function(data){
			
			if(data==0){
				Swal.fire('ADVERTENCIA!','SE ELIMINO EL PROCESO','warning')
				Grilla_Pedidos_Programar()
				//window.open("gestion_produccion.php");	// cuando envias a logistica o anulas deberia actualizar toda la pagina
			}else{
				Swal.fire('ADVERTENCIA!','NO SE ELIMINO EL PROCESO','error')
			}
	
			
		}
	})

	}

	
})

function Grilla_Pedidos_Programar(){

	var axnum_proceso = $("#txtnum_proceso").val();
	var axidlocal = $("#txtidlocal").val();
	var axcoduser= $("#txtcodusuario").val();


	$.ajax({
		url:"gestion_produccio_funciones.php",
		method: "POST",
		data: {param:11,txtnum_proceso:axnum_proceso,txtidlocal:axidlocal,txtcodusuario:axcoduser},	
			success : function(data){
			
			$("#divgestionar_pedidos_2").html(data);			
		}
	})


}



$(document).on("click","#btver_proceso",function(){

	var axnum_proceso=$("#txtnum_proceso").val();
	var axidlocal = $("#txtidlocal").val();
	 $("#txtparametro").val(1);

	if(axnum_proceso==""){

		document.getElementById('txtnum_proceso').focus();
		Swal.fire('ADVERTENCIA!','Ingrese el NUMERO DE PROCESO','warning')

	}else{

		Grilla_Pedidos_Programar();
	}


})


$(document).on("click","#btgenerar_proceso",function(){

var axnum_proceso=$("#txtnum_proceso").val();
var axidlocal = $("#txtidlocal").val();

if(axnum_proceso==""){

	document.getElementById('txtnum_proceso').focus();
	Swal.fire('ADVERTENCIA!','Ingrese el NUMERO DE PROCESO','warning')

}else{

	$.ajax({
		url:"gestion_produccio_funciones.php",
		method: "POST",
		data: {param:13,txtnum_proceso:axnum_proceso,txtidlocal:axidlocal},	
		success : function(data){

			if(data==0){
				verificar_plantillas()			
			}else if(data==1){

				Swal.fire({
				  title: 'No existe?',
				  text: "El proceso,  desea GENERARLO!",
				  icon: 'question',
				  showCancelButton: true,
				  confirmButtonColor: '#3085d6',
				  cancelButtonColor: '#d33',
				  confirmButtonText: 'Si, Generar..!'
				}).then((result) => {
				  
				  if (result.value) {
				    Swal.fire('GENERAR!','El proceso ha iniciado...','success')
				    verificar_plantillas()			
				  }

				})

			}
						
		}
	})


	
}

	
})

function verificar_plantillas(){

	var axnum_proceso = $("#txtnum_proceso").val();
	var axidlocal = $("#txtidlocal").val();
	var axcoduser= $("#txtcodusuario").val();
	var axfecha_proceso= $("#txtfechaactual").val();
	var axestado_pedido='PROCESADO';
	

	$.ajax({
		url:"gestion_produccio_funciones.php",
		method: "POST",
		data: {param:10,
			txtnum_proceso:axnum_proceso,
			txtidlocal:axidlocal,
			txtcodusuario:axcoduser,
			txtfechaactual:axfecha_proceso,
			axestado_pedido:axestado_pedido

		},	
		success : function(data){

			if(data==0){
				Grilla_Pedidos_Programar();
				//$("#divgestionar_pedidos_2").html(data);	
			}else{
				Grilla_Pedidos_Programar();
			}
			
			
			
		}
	})

}

$(document).on("click","#btcambiar_estado",function(){

	var id = $(this).data("idpedidocz");
	var axidlocal= $("#txtidlocal").val();

	$.ajax({

		url:"gestion_produccio_funciones.php",
			method: "POST",
			data: {param:8,id:id,txtidlocal:axidlocal},
			success : function(data){

					lista_pedidos_procesar();
				
			}
	})	

})

$(document).on("click","#bteliminar_producto",function(){

var id = $(this).data("idpedidodt");

$("#txtcodmovconta").val(id);
var axcodmovcz = $("#txtcodmovcz").val();
var axidlocal= $("#txtidlocal").val();	


$.ajax({

		url:"gestion_produccio_funciones.php",
			method: "POST",
			data: {param:7,id:id,txtcodmovcz:axcodmovcz,txtidlocal:axidlocal},
			success : function(data){

				if(data==0) {
					actualizar_detalle_pedido()
				}else if(data==1 ){
					Swal.fire(
					      'ADVERTENCIA!',
					      'El registro no pudo ser ELIMINADO',
					      'warning'
					    )
				}
				
				
			}
	})



})


$(document).on("blur","#axprecio_modificar_1",function(){

var id = $(this).data("idpedidodt");
var cant_nueva=$(this).text();
$("#txtcodmovconta").val(id);
var axcodmovcontable = $("#txtcodmovconta").val();	

if( isNaN(cant_nueva) ) {
  
  Swal.fire('ADVERTENCIA!','El dato registrado NO ES UN NUMERO...','warning')
  
}else{

	$.ajax({

		url:"gestion_produccio_funciones.php",
			method: "POST",
			data: {param:6,id:id,cant_nueva:cant_nueva},
				success : function(data){
					if(data==0) {
					
					actualizar_detalle_pedido()
					
					}else if(data==1 ){
					
					Swal.fire('ADVERTENCIA!','La Cantidad no pudo ser modificada','warning')

				}
			}
	})

}

})

$(document).on("blur","#axcant_modificar",function(){

var id = $(this).data("idpedidodt");
var cant_nueva=$(this).text();
$("#txtcodmovconta").val(id);
var axcodmovcontable = $("#txtcodmovconta").val();	

//alert(cant_nueva)

if( isNaN(cant_nueva) ) {
  
  Swal.fire('ADVERTENCIA!','El dato registrado NO ES UN NUMERO...','warning')
  
}else{

	$.ajax({

		url:"gestion_produccio_funciones.php",
		method: "POST",
		data: {param:4,id:id,cant_nueva:cant_nueva},
			success : function(data){
				if(data==0) {
					actualizar_detalle_pedido();
				}else if(data==1 ){
					Swal.fire('ADVERTENCIA!','La Cantidad no pudo ser modificada','warning')
				}
			}
	})
}

})




$(document).on("click","#btretornar",function(){
lista_pedidos_procesar();	
})

function actualizar_detalle_pedido(){

var axcodmovcz = $("#txtcodmovcz").val();	
var axidlocal= $("#txtidlocal").val();	
var axidbeneficiario = $("#txtidbeneficiario").val();	

//alert(axnomcliente);

	$.ajax({
		url:"gestion_produccio_funciones.php",
		method: "POST",
		data: {param:3,txtcodmovcz:axcodmovcz,txtidlocal:axidlocal,axidbeneficiario:axidbeneficiario},
		success : function(data){
			$("#divlistar_pedidos").html(data);	
		}
	})
	

}

$(document).on("click","#bteditar_pedido",function(){

var axcodmovcz = $(this).data("idpedcz");	
var axidbeneficiario = $(this).data("idbenf");
var axidlocal= $("#txtidlocal").val();	

$("#txtidbeneficiario").val(axidbeneficiario);
$("#txtcodmovcz").val(axcodmovcz);

//alert(axnomcliente);

	$.ajax({
		url:"gestion_produccio_funciones.php",
		method: "POST",
		data: {param:3,axcodmovcz:axcodmovcz,txtidlocal:axidlocal,axidbeneficiario:axidbeneficiario},
		success : function(data){
			$("#divlistar_pedidos").html(data);	
		}
	})
	
})


$(document).on("click","#bteliminar_pedido",function(){

var axcodmovcz = $(this).data("idpedcz");	
var axidlocal= $("#txtidlocal").val();	
//alert(axcodmovcz);

Swal.fire({
		  title: 'Esta seguro de eliminar los registros?',
		  text: "Una vez eliminado, no podrá recuperarlo!",
		  type: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  confirmButtonText: 'Si eliminar!'
		}).then((result) => {

		  if (result.value) {

		  	$.ajax({
				url:"gestion_produccio_funciones.php",
				method: "POST",
				data: {param:2,axcodmovcz:axcodmovcz,txtidlocal:axidlocal},
				success : function(eliminar){

					if(eliminar==0){
						//swal("El registro ha sido eliminado!", {icon: "success",});	

						Swal.fire(
					      'ELIMINADO!',
					      'El Pedido ha sido ELIMINADO',
					      'success'
					    )
					    
					   	lista_pedidos_procesar();	
						
					} else {		
						//swal("El registro no se elimino!", {icon: "success",});					
						Swal.fire(
					     'ADVERTENCIA!',
					      'El pedido no puede ser eliminado, se encuentra ATENDIDO',
					      'warning'
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

$(document).on("click","#pnlistar_pedidos",function(){

	$("#divlistar_pedidos").css({'display':'block'});
	$("#divgestionar_pedidos").css({'display':'none'});
	
		
	var elemento1 = document.getElementById("pnlistar_pedidos");
	var elemento2 = document.getElementById("pngestionar_pedidos");
			
	elemento1.className = "nav-link active";
	elemento2.className = "nav-link";
	
})


$(document).on("click","#pngestionar_pedidos",function(){


	$("#divlistar_pedidos").css({'display':'none'});
	$("#divgestionar_pedidos").css({'display':'block	'});	
		
	var elemento1 = document.getElementById("pnlistar_pedidos");
	var elemento2 = document.getElementById("pngestionar_pedidos");
			
	elemento1.className = "nav-link";
	elemento2.className = "nav-link active";

	sumar_cant_pedidos()
})




function sumar_cant_pedidos(){

	var axidlocal = $("#txtidlocal").val();
	var axestado_pedido='PROCESADO';

	$.ajax({
		url:"gestion_produccio_funciones.php",
		method: "POST",
		data: {param:9,txtidlocal:axidlocal,axestado_pedido:axestado_pedido},	
		success : function(data){
			
			$("#divgestionar_pedidos_1").html(data);	
			
		}
	})

}



$(document).on("click","#btnuevopedido",function(){

	var axidlocal = $("#txtidlocal").val();
	if(axidlocal=="SELECCIONAR"){
		document.getElementById('txtidlocal').focus();
		Swal.fire('INFORMACION!','Seleccionar el Local','warning');	
	}else{
		window.open("pedidos_gestion.php?id="+axidlocal);		
	}

})


$(document).on("change","#txtidlocal,#txtestado_pedido",function(){
	lista_pedidos_procesar();	
})

$(document).on("keyup","#txtbuscar",function(){
	lista_pedidos_procesar();	
})

function lista_pedidos_procesar(){

	var axidlocal = $("#txtidlocal").val();	
	var axfechapedido= $("#txtfechaactual").val();
	var axidempresa= $("#txtidempresa").val();
	var axbuscar= $("#txtbuscar").val();
	var axestado_pedido= $("#txtestado_pedido").val();
	//alert(axestado_pedido)

	if(axidlocal=="SELECCIONAR"){
			
			$("#divlistar_pedidos").html(" ");
	
	}else{

		$.ajax({
		url:"gestion_produccio_funciones.php",
		method: "POST",
		data: {param:0,txtidlocal:axidlocal,txtfechaactual:axfechapedido,txtidempresa:axidempresa,txtbuscar:axbuscar,txtestado_pedido:axestado_pedido},	
		success : function(listar_productos_pedido_1){
			
			$("#divlistar_pedidos").css({'display':'block'});
			//$("#divpedidos").css({'display':'none'});
			//$("#divdetalles").css({'display':'none'});

			$("#divlistar_pedidos").html(listar_productos_pedido_1);	
			
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





