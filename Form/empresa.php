<?php require_once '../includes/header.php'; ?>


<!DOCTYPE html>
	<html>
	<head>
		    
	</head>
	
	<!--img src="../img/empresa.PNG" style="opacity: 0.2;"-->

	<body style="margin: 3; padding: 3; background: url(../img/empresa.PNG) no-repeat center top;  background-size: cover;  font-family: sans-serif;  height: 100vh;">

		

	<div class="contenedor">
		<input type="hidden" name="txtparametros" id="txtparametros">
		<input type="hidden" name="txtcodusuario" id="txtcodusuario" value="<?php echo "$axcoduser";?>">

		<br>
		<div class="centrar">
			<div class="div500" style="padding: 2px;">
				<h5><img src="../icon/empresas.png" style="width: 30px; height: 30px;"> Empresas <button type="button" id="bnNuevo"  class="btn btn-outline-danger" data-toggle="modal" data-target=".bd-example-modal-xl">Nuevo</button></h5>	
			</div>
			
		</div>
		
		<div class="centrar">
		<div class="div500" style="padding: 2px;">
			<div class="input-group mb-3" style="padding: 2px;">
  				<div class="input-group-prepend">
    				<span class="input-group-text" id="basic-addon3">Buscar</span>
  				</div>
  				<input type="text" class="form-control" id="txtbuscarusuario" name="txtbuscarusuario" aria-describedby="basic-addon3">	
  			</div>	
		</div>
		</div>	

		<div class="centrar">
			<div id="lista1"></div>			
		</div>
	
	</div>


	<div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  		<div class="modal-dialog modal-xl">
    		<div class="modal-content">
      			
      			<div class="centrar" style="padding: 5px; margin: 5px ">
    				<h4>Registro de empresas</h4>
   					<!--img src="../img/ajax.gif" style="width: 20; height: 20;" class="ajaxgif hide"-->

   					

    			<div class="card">
					 
					
					  <div class="card-body">
					 	
					  	<div id="divdatos" style="padding: 5px;">

					  	<form>
						  <div class="form-group row">
						    <label style="text-align: left;"  for="txtruc" class="col-sm-2 col-form-label">RUC</label>
						    <div class="col-sm-10">
						      <input type="text" class="form-control" id="txtruc" >
						    </div>
						  </div>

						  <div class="form-group row">
						    <label style="text-align: left;" for="txtrazonsocial" class="col-sm-2 col-form-label">Razón Social</label>
						    <div class="col-sm-10">
						      <input type="text" class="form-control" id="txtrazonsocial" >
						    </div>
						  </div>

						  <div class="form-group row">
						    <label style="text-align: left;" for="txtdireccion" class="col-sm-2 col-form-label">Dirección</label>
						    <div class="col-sm-10">
						      <input type="text" class="form-control" id="txtdireccion">
						    </div>
						  </div>

						  <div class="form-group row">
						    <label style="text-align: left;" for="txttelefono" class="col-sm-2 col-form-label">Telefonos</label>
						    <div class="col-sm-10">
						      <input type="text" class="form-control" id="txttelefono" >
						    </div>
						  </div>

						  <div class="form-group row">
						    <label style="text-align: left;" for="txtrepresentante" class="col-sm-2 col-form-label">Rep. Legal</label>
						    <div class="col-sm-10">
						      <input type="text" class="form-control" id="txtrepresentante" >
						    </div>
						  </div>
					   	 
											
						</form>

						<div class="centrar" style="text-align: right; padding: 5px;">
							<div id="ajaxgif" class="spinner-border text-primary" role="status" style="display: none;">
  							<span class="sr-only">Loading...</span>
							</div>
    					<button type="button" class="btn btn-outline-info" id="btgrabarempresa" data-dismiss="modal">Grabar</button>
  						<button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target=".bd-example-modal-xl">Cerrar</button>	
    					</div>
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
	listarempresas();
});



function Verifica_permiso(){

var axiduser =$("#txtcodusuario").val();
var axpermiso ="EMPRESAS";

//alert(axiduser);

$.ajax({

	url:"empresa_funciones.php",
	method: "POST",
	data: {param:3,txtcodusuario:axiduser,axpermiso:axpermiso},
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






$(document).on("click","#bnNuevo",function(){
	$("#txtparametros").val(1);
})


$(document).on("click","#bteditarempresa",function(){

var axidempresa = $(this).data("idempresa");

$.ajax({

	url:"empresa_funciones.php",
	method: "POST",
	data: {param:2,
		axidempresa:axidempresa,	
		
	},
	
	success : function(editarempresa){

		var json = JSON.parse(editarempresa);

		  			if (json.status == 200){

						$("#txtidempresa").val(json.ID_EMPRESA);
						$("#txtruc").val(json.RUC_EMPRESA);
						$("#txtrazonsocial").val(json.RAZON_SOCIAL);
						$("#txttelefono").val(json.TELEFONO);
						$("#txtdireccion").val(json.DIRECCION);
						$("#txtrepresentante").val(json.REP_LEGAL);
						
		  			}

	}
})

})


$(document).on("click","#btgrabarempresa",function(){

var axruc = $("#txtruc").val();
var axrazonsocial = $("#txtrazonsocial").val();
var axdireccion = $("#txtdireccion").val();
var axtelefono = $("#txttelefono").val();
var axreplegal = $("#txtrepresentante").val();
var axparamentro = $("#txtparametros").val();

$.ajax({

	url:"empresa_funciones.php",
	method: "POST",
	data: {param:1,
		txtruc:axruc,
		txtrazonsocial:axrazonsocial,
		txtdireccion:axdireccion,
		txttelefono:axtelefono,
		txtrepresentante:axreplegal,
		txtparametros:axparamentro
	},
	
	success : function(grabrempresa){

		if(grabrempresa==0){
           			
			listarempresas();

      	} else {
			swal("Aviso", "No se grabo el registro...", "warning");

		}
	}
})


})

	
$(document).on("change","#txtruc",function(){


	var ruc = $("#txtruc").val();
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

     				$("#txtrazonsocial").val("");
     				$("#txtdireccion").val("");

     			}else{

     				$("#txtrazonsocial").val(datos[1]);
     				$("#txtdireccion").val(datos[2]);
     				//$("#txtcontacto").val(datos[4]);
     				$("#txtrepresentante").text(datos[4]);

     				
     			}
		      	
		     }
		  });
		    return false;
		} 

})

function listarempresas(){

		var axbuscaregistro = $("#txtbuscarusuario").val();	
		$.ajax({

			url:"empresa_funciones.php",
			method: "POST",
			data: {param:0,txtbuscarusuario:axbuscaregistro},
				
				success : function(listaempresas){

					$("#lista1").html(listaempresas);
			}
		})
	}


</script>