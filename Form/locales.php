<?php require_once '../includes/header.php'; ?>


<!DOCTYPE html>
	<html>
	<head>
		    
	</head>
	
	<!--img src="../img/empresa.PNG" style="opacity: 0.2;"-->

	<!--body style="margin: 3; padding: 3; background: url(../img/locales.PNG) no-repeat center top;  background-size: cover;  font-family: sans-serif;  height: 100vh;"-->
    
    <body>
    <br>
    <div class="container-fluid">
       
        <input type="hidden" name="txtidempresa" id="txtidempresa" value="<?php echo "$axidempresa";?>">
		<input type="hidden" name="txtidlocal" id="txtidlocal">
		<input type="hidden" name="txtparametros" id="txtparametros">
		<input type="hidden" name="txtcodusuario" id="txtcodusuario" value="<?php echo "$axcoduser";?>">
           
        <div class="row">
        
            <div class="col-12">
                
            
			      
            <div class="card">
              <div class="card-header">
                <h5><img src="../icon/local.png" style="width: 30px; height: 30px;"> Locales <button type="button" id="bnNuevo"  class="btn btn-outline-danger" data-toggle="modal" data-target=".bd-example-modal-xl">Nuevo</button></h5>	
                
                 <div class="input-group mb-3" style="padding: 2px;">
  				    <div class="input-group-prepend">
    				    <span class="input-group-text" id="basic-addon3">Buscar</span>
  				    </div>
  				    <input type="text" class="form-control" id="txtbuscarlocal" name="txtbuscarlocal" aria-describedby="basic-addon3">	
  			        </div> 
  			        
              </div>
                <div class="card-body">
                <div id="lista1" style="font-size:10pt;"></div>	  
                </div>
                
                </div>    
          	
          			
        </div>
       </div>
   
    </div>

	<div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  		<div class="modal-dialog modal-xl">
    		<div class="modal-content">
      			
      			<div class="centrar" style="padding: 5px; margin: 5px ">
    				<h4>Registro de locales</h4>
   					<!--img src="../img/ajax.gif" style="width: 20; height: 20;" class="ajaxgif hide"-->

   					

    			<div class="card">
					 
					
					  <div class="card-body">
					 	
					  	<div id="divdatos" style="padding: 5px;">

					  	<form>
						<div class="form-group row">
						    <label style="text-align: left;" for="txtnombrelocal" class="col-sm-2 col-form-label">Descripción</label>
						    <div class="col-sm-10">
						      <input type="text" class="form-control" id="txtnombrelocal" >
						    </div>
						  </div>

						  <div class="form-group row">
						    <label style="text-align: left;" for="txtubicacion" class="col-sm-2 col-form-label">Ubicación</label>
						    <div class="col-sm-10">
						      <input type="text" class="form-control" id="txtubicacion">
						    </div>
						  </div>

						  <div class="form-group row">
						    <label style="text-align: left;" for="" class="col-sm-2 col-form-label">Lote Local</label>
						    <div class="col-sm-10">
						      <input type="text" class="form-control" id="txtlote_local">
						    </div>
						  </div>
					
						</form>

						<div class="centrar" style="text-align: right; padding: 5px;">							
    					<button type="button" class="btn btn-outline-info" id="btgrabarlocal" data-dismiss="modal">Grabar</button>
    					<!--button type="button" id="btgrabar" name="btgrabar" class="btn btn-info" data-dismiss="modal" >Grabar</button-->
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
	listarlocales();
});


function Verifica_permiso(){

var axiduser =$("#txtcodusuario").val();
var axpermiso ="LOCALES";

$.ajax({

	url:"locales_funciones.php",
	method: "POST",
	data: {param:3,txtcodusuario:axiduser,axpermiso:axpermiso},
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




$(document).on("click","#bnNuevo",function(){
	$("#txtparametros").val(1);
	

})

$(document).on("keyup","#txtbuscarlocal",function(){
	listarlocales();
})



$(document).on("click","#bteditarlocal",function(){
	$("#txtparametros").val(2);

var axidlocal = $(this).data("idlocal");

$.ajax({

	url:"locales_funciones.php",
	method: "POST",
	data: {param:2,
		axidlocal:axidlocal	
		
	},
	
	success : function(editarlocal){

		var json = JSON.parse(editarlocal);

		  			if (json.status == 200){

						$("#txtidempresa").val(json.ID_EMPRESA);
						$("#txtidlocal").val(json.ID_LOCAL);
						$("#txtnombrelocal").val(json.DESCRICION_LC);
						$("#txtubicacion").val(json.UBICACION_LC);
						$("#txtlote_local").val(json.ID_LOTE);
						
						
		  			}

	}
})

})


$(document).on("click","#btgrabarlocal",function(){

var axidlocal = $("#txtidlocal").val();
var axidempresa = $("#txtidempresa").val();
var axnomlocal = $("#txtnombrelocal").val();
var axubicacion = $("#txtubicacion").val();
var axlote = $("#txtlote_local").val();
var axparamentro= $("#txtparametros").val();
$.ajax({

	url:"locales_funciones.php",
	method: "POST",
	data: {param:1,
		txtidlocal:axidlocal,
		txtidempresa:axidempresa,
		txtnombrelocal:axnomlocal,
		txtubicacion:axubicacion,
		txtlote_local:axlote,
		txtparametros:axparamentro
	},
	
	success : function(grabarlocal){

		if(grabarlocal==0){
           			
			listarlocales();

      	} else {
			swal("Aviso", "No se grabo el registro...", "warning");

		}
	}
})


})


function listarlocales(){

		var axidempresa = $("#txtidempresa").val();	
		var axbuscaregistro = $("#txtbuscarlocal").val();	

		$.ajax({

			url:"locales_funciones.php",
			method: "POST",
			data: {param:0,txtidempresa:axidempresa,txtbuscarlocal:axbuscaregistro},
				
				success : function(listalocales){

					$("#lista1").html(listalocales);
			}
		})
	}


</script>