<?php require_once '../includes/header.php';

$tipo = $_GET['id'];

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
		
		#ulvendedor{
	    background-color: #000;
	    cursor: pointer;
	    }

		#livendedor{
		   /* padding: 10px;*/
		    display:block; 
		  width:100%;
		  padding: 3px 0px;
		  color:#000;
		  background-color:#DBEBF6;
		  text-decoration:none;
		  }


		#livendedor:hover{
		   /* padding: 10px;*/
		    display:block; 
		  width:100%;
		  padding: 3px 0px;
		  color:#000;
		  background-color:#356AA0;
		  text-decoration:none;
		  }

		  #ulsector{
	    background-color: #000;
	    cursor: pointer;
	    }

		#lisector{
		   /* padding: 10px;*/
		    display:block; 
		  width:100%;
		  padding: 3px 0px;
		  color:#000;
		  background-color:#DBEBF6;
		  text-decoration:none;
		  }


		#lisector:hover{
		   /* padding: 10px;*/
		    display:block; 
		  width:100%;
		  padding: 3px 0px;
		  color:#000;
		  background-color:#356AA0;
		  text-decoration:none;
		  }


	</style>

	
	<!--img src="../img/proveedores.jpg" style="opacity: 0.2;"-->

	<!--body style="margin: 3; padding: 3; background: url(../img/proveedores.PNG) no-repeat center top;  background-size: cover;  font-family: sans-serif;  height: 100vh;"-->

<body>
	 <br>
    <div class="container-fluid">
      
      <input type="hidden" name="txtidempresa" id="txtidempresa" value="<?php echo "$axidempresa";?>">
		<input type="hidden" name="txtidbeneficiario" id="txtidbeneficiario">
		<input type="hidden" name="txttipobeneficiario" id="txttipobeneficiario" value="<?php echo "$tipo";?>">
		<input type="hidden" name="txtparametros" id="txtparametros">
		<input type="hidden" name="codubi" id="codubi">
		<input type="hidden" name="txtcodusuario" id="txtcodusuario" value="<?php echo "$axiduser";?>">
           
        <div class="row">
        <div class="col-12">
            <div class="card">
	            <div class="card-header">
             	<div id="titulo" class="div500" style="padding: 2px;"></div>
              	  <div class="input-group mb-3" style="padding: 2px;">
  				    <!--div class="input-group-prepend">
    				   <span class="input-group-text" id="basic-addon3">Buscar</span>
  				    </div-->

  				    <div class="input-group mb-3">
  							<div class="input-group-prepend">

    						<span class="input-group-text" id="basic-addon3">

    						<div class="custom-control custom-radio custom-control-inline">
							  <input type="radio" class="custom-control-input" onclick="valor_radio(this.value)" id="radio_disponible" name="radios_estado"  value="TODOS">
							  <label class="custom-control-label" for="radio_disponible">Todos</label>
							</div>

							<div class="custom-control custom-radio custom-control-inline">
							  <input type="radio" class="custom-control-input" checked="true" onclick="valor_radio(this.value)" id="radio_vendido" checked="true" name="radios_estado" value="BUSCAR">
							  <label class="custom-control-label" for="radio_vendido">Buscar</label>
							  <input type="hidden" name="estado_radio" id="estado_radio">	
							</div>

							</span>


  							</div>
  							<input type="text" class="form-control" id="txtbuscar" name="txtbuscar" aria-describedby="basic-addon3">
  							
  							
  						</div>


	
  			        </div> 
  			        
              </div>
                <div class="card-body">
                <div id="lista1" style="font-size:10pt;"></div>	  
                </div>
                
            </div>    
          	
          			
        </div>
       </div>
   
    </div>




	<!--div class="contenedor">
		<input type="hidden" name="txtidempresa" id="txtidempresa" value="<?php echo "$axidempresa";?>">
		<input type="hidden" name="txtidbeneficiario" id="txtidbeneficiario">
		<input type="hidden" name="txttipobeneficiario" id="txttipobeneficiario" value="<?php echo "$tipo";?>">
		<input type="hidden" name="txtparametros" id="txtparametros">
		<input type="hidden" name="codubi" id="codubi">
		

		<br>
		<div class="centrar">
			<div id="titulo" class="div500" style="padding: 2px;">
			
			</div>
			
		</div>
		
		<div class="centrar">
		<div class="div500" style="padding: 2px;">
			<div class="input-group mb-3" style="padding: 2px;">
  				<div class="input-group-prepend">
    				<span class="input-group-text" id="basic-addon3">Buscar</span>
  				</div>
  				<input type="text" class="form-control" id="txtbuscar" name="txtbuscar" aria-describedby="basic-addon3">	
  			</div>	
		</div>
		</div>	

		<div class="centrar">
			<div id="lista1"></div>			
		</div>
	
	</div-->


	<div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  		<div class="modal-dialog modal-xl">
    		<div class="modal-content">
      			
      			<div class="centrar" style="padding: 5px; margin: 5px ">
    				<h4 id="rgtitulo"></h4>
    			<div class="card">
				<div class="card-body">
				  	
				<form>

				  <div class="form-row">
				    <div class="form-group col-md-4">
				      <label for="txttipodoc">Tipo documento</label>
						<select class="form-control custom-select mr-sm-2" id="txttipodoc">
							<?php while($fila=odbc_fetch_array($rstipodocidentida)) {?>
      						<option value="<?php echo $fila['ID_DOC'];?>"><?php echo $fila['DOC_IDENTIDAD'];?></option><?php } ?>
						</select>

				    </div>
				    
				    <div class="form-group col-md-4">
				      <label for="txtruc">No Documento</label>
				      <input type="text" class="form-control" id="txtruc" >
				      
				    </div>

				    <div class="form-group col-md-4">
				    <label for="txtcalificar">Calificación</label>
				    <select id="txtcalificar" class="form-control custom-select mr-sm-2">
				        <option value="BUENO">BUENO</option>
				        <option value="MALO">MALO</option>
				        
				    </select>
				    </div>


				  </div>

				   <div class="form-row">
				    <div class="form-group col-md-6">
				      <label for="txtnombeneficiario">Razón Social</label>
				      <input type="text" class="form-control" id="txtnombeneficiario">
					</div>
				    
				    <div class="form-group col-md-6">
				      <label for="txtdireccion">Dirección</label>
				    <input type="text" class="form-control" id="txtdireccion">
				      
				    </div>

				    <!--div class="form-group col-md-4"-->
				      <input type="hidden" class="form-control" id="txtpais" value="PERU">
				      <!--label for="txtpais">Pais</label>
				    	<select class="form-control custom-select mr-sm-2" id="txtpais">
							<?php while($fila=odbc_fetch_array($rspaises)) {?>
      						<option value="<?php echo $fila['NOM_PAIS'];?>"><?php echo $fila['NOM_PAIS'];?></option><?php } ?>
						</select>
				      
				    </div-->



				  </div>

				  <!--div class="form-row">
				    <div class="form-group col-md-6">
				      <label for="txtprofesion">Profesión</label-->
				      <input type="hidden" class="form-control" id="txtprofesion" value="0">
					<!--/div>
				    
				    <div class="form-group col-md-6">
				      <label for="txtcentrolaboral">Centro Labora</label-->
				    <input type="hidden" class="form-control" id="txtcentrolaboral" value="0">
				    <input type="hidden" class="form-control" id="txtdistrito" value="120606">
				      
				    <!--/div>
				  </div-->

				  <!--div  id="divubigeo" style="display: none;">

				  	<div class="form-row"  >
				    <div class="form-group col-md-4">
				      <label for="txtdepartamento">Región</label>
				      <select class="form-control custom-select mr-sm-2" id="txtdepartamento">
							<?php while($fila=odbc_fetch_array($rsdepa)) {?>
      						<option value="<?php echo $fila['ID_DEPA'];?>"><?php echo $fila['DEPARTAMENTO'];?></option><?php } ?>
						</select>
				    </div>
				    
				    <div class="form-group col-md-4">
				      <label for="txtprovincia">Provincia</label>
				      <select id="txtprovincia" name="txtprovincia" class="form-control custom-select mr-sm-2"></select>
				    </div>

				    <div class="form-group col-md-4">
				      <label for="txtdistrito">Distrito <a href="#" id="actualizar"></a> </label>
				      <select id="txtdistrito" name="txtdistrito" class="form-control custom-select mr-sm-2"></select>
				    </div>
				  </div>
				  </div-->
				  


				   <div class="form-row">
				    <div class="form-group col-md-3">
				      <label for="txttelefonos">Telefonos</label>				      
				      <input type="text" class="form-control" id="txttelefonos" >
				    </div>
				    
				    <div class="form-group col-md-3">
				      <label for="txtemail">Email</label>
				      <input type="text" class="form-control" id="txtemail" >
				    </div>

				    <div class="form-group col-md-3">
				      <label for="txtgiro">Giro</label>
				      <input type="text" class="form-control" id="txtgiro" >
				    </div>

				     <div class="form-group col-md-3">
				      <label for="txtcontacto">Contacto</label>
				      <input type="text" class="form-control" id="txtcontacto" >
				    </div>
				  </div>


				  <div class="form-row">

				  	<div class="form-group col-md-3">
				    	<label for="txtctadetraccion">Cta Detracción</label>
				  		<input type="text" class="form-control" id="txtctadetraccion" value="0">
				    </div>

				    <div class="form-group col-md-3">
				      <label for="txtctapagos">Cta Pago</label>
				      <input type="text" class="form-control" id="txtctapagos" value="0">
				    </div>
				    
				    <div class="form-group col-md-3">
				      <label for="txtccipago">CCI Pago</label>
				      <input type="text" class="form-control" id="txtccipago" value="0">
				    </div>
					
					<div class="form-group col-md-3">
				      <label for="txtnombrebanco">Banco</label>
				      <input type="text" class="form-control" id="txtnombrebanco" value="0">
				    </div>
				  	
				  </div>



				</form>


					<div class="centrar" style="text-align: right; padding: 5px;">	
						<div id="ajaxgif" class="spinner-border text-primary" role="status" style="display: none;">
  							<span class="sr-only">Loading...</span>
						</div>						
    					<button type="button" class="btn btn-outline-info" id="btgrabar" data-dismiss="modal">Grabar</button>
    					<button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target=".bd-example-modal-xl">Cerrar</button>	
    				</div>
								  	
					  	
				</div>
				</div>
    		</div>
    	</div>
    </div>
</div>
	
</body>
</html>	

<script type="text/javascript">

$(document).ready(function() {	
	Verifica_permiso();
	listar();
});

$(document).on("keyup","#txtbuscar",function(){
	listar();
})


$(document).on("change","#txtpais",function(){

	var axpais = $("#txtpais").val();

	if (axpais=='PERU'){
		$("#divubigeo").css({'display':'block'});
	} else {
		$("#divubigeo").css({'display':'none'});	
	}

	

})

function Verifica_permiso(){

var axiduser =$("#txtcodusuario").val();
var axtitrg = $("#txttipobeneficiario").val();
var axpermiso =axtitrg;

$.ajax({
	url:"beneficiarios_funciones.php",
	method: "POST",
	data: {param:12,txtcodusuario:axiduser,axpermiso:axpermiso},
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



$('#txtsector').keyup(function(){

  var axbuscarvendedor = $("#txtsector").val();
  var axtipo = $("#txttipobeneficiario").val();	
  
  if (axbuscarvendedor != '') {
    $.ajax({
      url:"beneficiarios_funciones.php",
      method: "POST",
      data: {param:10,txtsector:axbuscarvendedor,txttipobeneficiario:axtipo},
      success : function(data){

        $('#listasectores').fadeIn();
        $('#listasectores').html(data);
        
      }
    });
  } 
});


$(document).on("click","#lisector",function(){
  $("#txtsector").val($(this).text());
  $("#listasectores").fadeOut();
});


$(document).on("click","#lisectorregistro",function(){
  $("#txtsector").val($(this).text());
  var axnuevovendedor = $("#txtsector").val();
  var axcontar = axnuevovendedor.length;
  var extraer = axcontar-11;
  var guardar = axnuevovendedor.substr(0,extraer);
  $("#txtsector").val(guardar);
  $("#listasectores").fadeOut();
});







$('#txtvendedor').keyup(function(){

  var axbuscarvendedor = $("#txtvendedor").val();
  var axtipo = $("#txttipobeneficiario").val();	
  
  if (axbuscarvendedor != '') {
    $.ajax({
      url:"beneficiarios_funciones.php",
      method: "POST",
      data: {param:9,txtvendedor:axbuscarvendedor,txttipobeneficiario:axtipo},
      success : function(data){

        $('#listavendedores').fadeIn();
        $('#listavendedores').html(data);
        
      }
    });
  } 
});


$(document).on("click","#livendedor",function(){
  $("#txtvendedor").val($(this).text());
  $("#listavendedores").fadeOut();
});


$(document).on("click","#livendedorregistro",function(){
  $("#txtvendedor").val($(this).text());
  var axnuevovendedor = $("#txtvendedor").val();
  var axcontar = axnuevovendedor.length;
  var extraer = axcontar-11;
  var guardar = axnuevovendedor.substr(0,extraer);
  $("#txtvendedor").val(guardar);
  $("#listavendedores").fadeOut();
});













function tituloregistro() {
	
	var axtitrg = $("#txttipobeneficiario").val();

	if (axtitrg=="CLIENTE"){

		$("#rgtitulo").html("Registro de Clientes");

	} else {

		$("#rgtitulo").html("Registro de Proveedores");
	}

}


function TraerUbigeo() {

var axdistrito = $("#codubi").val();

var axiddep1 = axdistrito.substr(0,2);
$("#txtdepartamento").val(axiddep1);
var axiddepa = $("#txtdepartamento").val();

$.ajax({
	url:"beneficiarios_funciones.php",
	method: "POST",
	data: {param:6,
	txtdepartamento:axiddepa
	},
				
	success : function(datadepa){
		$("#txtdepartamento").html(datadepa);
	}
})


var axdistrito = $("#codubi").val();

var axidprov = axdistrito.substr(0,4);
//alert(axidprov1);



$.ajax({
	
	url:"beneficiarios_funciones.php",
	method: "POST",
	data: {param:7,axidprov:axidprov},
	success : function(dataprov){
		$("#txtprovincia").html(dataprov);
	}
})


$.ajax({

	url:"beneficiarios_funciones.php",
	method: "POST",
	data: {param:3,codubi:axdistrito
	},
	success : function(datadistrito){
		$("#txtdistrito").html(datadistrito);
	}
})

}


$(document).on("click","#actualizar",function(){

	var axiddepa = $("#txtdepartamento").val();
	$.ajax({
	url:"beneficiarios_funciones.php",
	method: "POST",
	data: {param:8,
		txtdepartamento:axiddepa
	},
	
	success : function(datadepa){
		
		$("#txtdepartamento").html(datadepa);
	}
	})
})
	


$(document).on("change","#txtdepartamento",function(){
 var axiddepa = $("#txtdepartamento").val();
	$.ajax({
	url:"beneficiarios_funciones.php",
	method: "POST",
	data: {param:4,
		txtdepartamento:axiddepa
	},
	
	success : function(dataprov){
		
		$("#txtprovincia").html(dataprov);
	}
	})
})

$(document).on("change","#txtprovincia",function(){

 	var axidprov = $("#txtprovincia").val();
	$.ajax({
	url:"beneficiarios_funciones.php",
	method: "POST",
	data: {param:5,
		txtprovincia:axidprov
	},
	
	success : function(datadistrito){
		
		$("#txtdistrito").html(datadistrito);
	}
	})
})


$(document).on("click","#bnNuevo",function(){
	$("#txtparametros").val(1);
	tituloregistro();
})





$(document).on("click","#bteditar",function(){

	tituloregistro();

var axidbeneficiario = $(this).data("id");
$("#txtparametros").val(2);


$.ajax({

	url:"beneficiarios_funciones.php",
	method: "POST",
	data: {param:2,
		axidbeneficiario:axidbeneficiario		
	},
	
	success : function(editar){

		var json = JSON.parse(editar);

		  			if (json.status == 200){

						$("#txtidbeneficiario").val(json.ID_BENEFICIARIO);
						$("#txttipobeneficiario").val(json.TIPO_PROV_CLIE);
						$("#txtcalificar").val(json.CALIFIC_PROVEEDOR);
						$("#txtnombeneficiario").val(json.NOM_PROVEEDOR);
						$("#txttipodoc").val(json.ID_DOC);
						$("#txtruc").val(json.RUC_BENEF);
						
						$("#txtdireccion").val(json.DIR_PROVEEDOR);
						$("#txtdistrito").val(json.COD_UBI);
						//$("#codubi").val(json.COD_UBI);
						//TraerUbigeo();

						$("#txttelefonos").val(json.TELEF_PROVEEDOR);
						$("#txtemail").val(json.EMAIL_PROVEEDOR);
						$("#txtgiro").val(json.GIRO_PROVEEDOR);

						$("#txtctadetraccion").val(json.CTA_DETRACCION);
						$("#txtctapagos").val(json.CTA_PAGOS);
						$("#txtccipago").val(json.CCI_PAGOS);
						$("#txtnombrebanco").val(json.BANCO_PAGOS);
						$("#txtcontacto").val(json.CONTACTO);

						/*
						$("#txttipocondicion").val(json.CONDICION_B);
						
						$("#txtvendedor").val(json.NOM_VENDEDOR);
						$("#txtsector").val(json.SECTOR);
						$("#txtfechanac").val(json.CUMPLE);
						$("#txtclave").val(json.CLAVE_VENTA);

						$("#actualizar").text("(Actualizar)");
					*/
						
		  			}

	}
})

})


$(document).on("click","#btgrabar",function(){

	var axidbeneficiario = $("#txtidbeneficiario").val();
	var axtipobenef = $("#txttipobeneficiario").val();
	var axcalificacion = $("#txtcalificar").val();
	var axnombenefi = $("#txtnombeneficiario").val();
	var axiddoc = $("#txttipodoc").val();
	var axruc = $("#txtruc").val();	
	var axdirbenefi = $("#txtdireccion").val();
	var axcodubig = $("#txtdistrito").val();
	var axtelefbenefi = $("#txttelefonos").val();
	var axemailbenefi = $("#txtemail").val();
	var axgirobenefi = $("#txtgiro").val();
	var axctadetraccion= $("#txtctadetraccion").val();
	var axctapago= $("#txtctapagos").val();
	var axccipago= $("#txtccipago").val();
	var axbancopago= $("#txtnombrebanco").val();
	var axcontabenef = $("#txtcontacto").val();
	/*
	var axcondicionb = $("#txttipocondicion").val();
	
	var axvenedbenefi = $("#txtvendedor").val();
	var axsector = $("#txtsector").val();
	var axcumple = $("#txtfechanac").val();
	var axclave = $("#txtclave").val();
	
	var axprofesion = $("#txtprofesion").val();
	var axtrabajo = $("#txtcentrolaboral").val();
*/
	var axpais = $("#txtpais").val();

	var axparamentro = $("#txtparametros").val();



$.ajax({

	url:"beneficiarios_funciones.php",
	method: "POST",
	data: {param:13,

		txtidbeneficiario:axidbeneficiario,
		txttipobeneficiario:axtipobenef,
		txtcalificar:axcalificacion,
		txtnombeneficiario:axnombenefi,
		txttipodoc:axiddoc,
		txtruc:axruc,
		txtdireccion:axdirbenefi,
		txtdistrito:axcodubig,
		txttelefonos:axtelefbenefi,
		txtemail:axemailbenefi,
		txtgiro:axgirobenefi,
		txtcontacto:axcontabenef,
		//txttipocondicion:axcondicionb,
		
		//txtvendedor:axvenedbenefi,
		//txtsector:axsector,
		//txtfechanac:axcumple,
		//txtclave:axclave,
		///txtprofesion:axprofesion,
		//txtcentrolaboral:axtrabajo,
		txtpais:axpais,
		txtctadetraccion:axctadetraccion,
		txtctapagos:axctapago,
		txtccipago:axccipago,
		txtnombrebanco:axbancopago,
		txtparametros:axparamentro
	},
	
	success : function(grabar){
		if(grabar==0){
			listar();
      	} else {
			swal("Aviso", "No se grabo el registro...", "warning");
		}
	}
})


})


function duplicidad() {
/*
var axruc = $("#txtruc").val();

	$.ajax({
		url:"beneficiarios_funciones.php",
		method: "POST",
		data: {param:14,txtruc:axruc},

		success : function(datadoble){

			if(datadoble)==1{

				swal("Aviso", "El número de RUC ya existe...", "warning");

			}
			
		}
	})
*/
}

function valor_radio(radios_estado) {
    //alert(radios_estado);
    $("#estado_radio").val(radios_estado);
   listar();
}

function listar(){

		var axidempresa = $("#txtidempresa").val();	
		var axtipo = $("#txttipobeneficiario").val();	
		var axbuscar = $("#txtbuscar").val();	
		var axestado_radio= $("#estado_radio").val();	


		$.ajax({

			url:"beneficiarios_funciones.php",
			method: "POST",
			data: {param:0,txtidempresa:axidempresa,txtbuscar:axbuscar,txttipobeneficiario:axtipo,estado_radio:axestado_radio},
				
				success : function(listar){
					$("#lista1").html(listar);

					if(axtipo=="CLIENTE"){

						$("#titulo").html('<img src="../icon/cliente.png" style="width: 30px; height: 30px;"> <h5>Listado de Clientes <button type="button" id="bnNuevo"  class="btn btn-outline-danger" data-toggle="modal" data-target=".bd-example-modal-xl">Nuevo</button></h5>');

						//$('#add-messages').html('<div class="alert alert-success"><strong><i class="glyphicon glyphicon-ok-sign"></i></strong> Registro grabado satisfactoriamente..</div>');



					} else {

						$("#titulo").html('<img src="../icon/proveedor.png" style="width: 30px; height: 30px;"><h5>Listado de Proveedores <button type="button" id="bnNuevo"  class="btn btn-outline-primary" data-toggle="modal" data-target=".bd-example-modal-xl">Nuevo</button></h5>');

					}
			}
		})
	}


$(document).on("change","#txtruc",function(){

	var axtipodoc = $("#txttipodoc").val();
	var ruc = $("#txtruc").val();

$.ajax({

	url:"beneficiarios_funciones.php",
	method: "POST",
	data: {param:14,txtruc:ruc},
	success : function(datadoble){

	if(datadoble==0){

		swal("Aviso", "El número de documento ya existe...", "warning");
		$("#txtruc").val("");


	} else{


		if(axtipodoc==6){
		//$('.ajaxgif').removeClass('hide');
		$("#ajaxgif").css({'display':'block'});

		 	if (ruc != ''){

			    $.ajax({
			      url:"sunat.php",
			      method: "POST",
			      data: {txtruc:ruc},
			      success : function(datos_ruc){
			      	
			      	$("#ajaxgif").css({'display':'none'});
			      	//$('.ajaxgif').addClass('hide');

	     			var datos = eval(datos_ruc);
	     			var nda = 'nada';
	     			if(datos[0]==nda) {

	     				//alert("RUC NO EXISTE EN SUNAT");
	     				swal("Aviso", "El Número de RUC NO EXISTE EN SUANT...", "warning");

	     				$("#txtnombeneficiario").val("");
	     				$("#txtdireccion").val("");

	     			}else{

	     				$("#txtnombeneficiario").val(datos[1]);
	     				$("#txtdireccion").val(datos[2]);
	     				$("#txtcontacto").val(datos[4]);
	     				//$("#txtrepresentante").text(datos[4]);

	     				
	     			}
			      	
			     }
			  });
			    return false;
			} 

		}

	
	}
			
	}
})




})

function zeros( number, width )
{
  width -= number.toString().length;
  if ( width > 0 )
  {
    return new Array( width + (/\./.test( number ) ? 2 : 1) ).join( '0' ) + number;
  }
  return number + ""; // siempre devuelve tipo cadena
}



</script>

