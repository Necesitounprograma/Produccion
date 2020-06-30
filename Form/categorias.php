<?php require_once '../includes/header.php'; ?>


<!DOCTYPE html>
	<html>
	<head>
		    
	</head>
	
	<!--img src="../img/categorias.jpg" style="opacity: 0.2;"-->

	<!--body style="margin: 3; padding: 3; background: url(../img/categorias.PNG) no-repeat center top;  background-size: cover;  font-family: sans-serif;  height: 100vh;"-->
   <body>
       
    <br>
    <div class="container-fluid">
      
       <input type="hidden" name="txtidempresa" id="txtidempresa" value="<?php echo "$axidempresa";?>">
		<input type="hidden" name="txtidcategoria" id="txtidcategoria">
		<input type="hidden" name="txtparametros" id="txtparametros">
		<input type="hidden" name="txtcodusuario" id="txtcodusuario" value="<?php echo "$axiduser";?>">

		<input type="hidden" name="txttiponegocio" id="txttiponegocio" value="<?php echo "$axtiponegocio";?>">
   
           
        <div class="row">
        <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h5><img src="../icon/categoria.png" style="width: 30px; height: 30px;"> Categorias <button type="button" id="bnNuevo"  class="btn btn-outline-danger" data-toggle="modal" data-target=".bd-example-modal-xl">Nuevo</button></h5>
                
                 <div class="input-group mb-3" style="padding: 2px;">
  				    <div class="input-group-prepend">
    				    <span class="input-group-text" id="basic-addon3">Buscar</span>
  				    </div>
  				    <input type="text" class="form-control" id="txtbuscarcategorias" name="txtbuscarcategorias" aria-describedby="basic-addon3">	
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
		<input type="hidden" name="txtidcategoria" id="txtidcategoria">
		<input type="hidden" name="txtparametros" id="txtparametros">

		<br>
		<div class="centrar">
			<div class="div500" style="padding: 2px;">
				<h5>Listado de categorias <button type="button" id="bnNuevo"  class="btn btn-outline-danger" data-toggle="modal" data-target=".bd-example-modal-xl">Nuevo</button></h5>	
			</div>
			
		</div>
		
		<div class="centrar">
		<div class="div500" style="padding: 2px;">
			<div class="input-group mb-3" style="padding: 2px;">
  				<div class="input-group-prepend">
    				<span class="input-group-text" id="basic-addon3">Buscar</span>
  				</div>
  				<input type="text" class="form-control" id="txtbuscarcategorias" name="txtbuscarcategorias" aria-describedby="basic-addon3">	
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
    				<h4>Registro de categorias</h4>
   					<!--img src="../img/ajax.gif" style="width: 20; height: 20;" class="ajaxgif hide"-->

   					

    			<div class="card">
					 
					
					  <div class="card-body">
					 	
					  	<div id="divdatos" style="padding: 5px;">

					  	<form>
						<div class="form-group row">
						    <label style="text-align: left;" for="txtcodcatgo" class="col-sm-2 col-form-label">Código</label>
						    <div class="col-sm-10">
						      <input type="text" class="form-control" id="txtcodcatgo" >
						    </div>
						  </div>

						  <div class="form-group row">
						    <label style="text-align: left;" for="txtnomcategoria" class="col-sm-2 col-form-label">Nom. Categoria</label>
						    <div class="col-sm-10">
						      <input type="text" class="form-control" id="txtnomcategoria">
						    </div>
						  </div>
 							
 						  <div class="form-group row">
						    <label style="text-align: left;" for="txtsubcategoria" class="col-sm-2 col-form-label">SubCategoria</label>
						    <div class="col-sm-10">
						        <select class="custom-select mr-sm-2" id="txtsubcategoria">
						        <option value=""></option>
						        <option value="MERCADERIA">MERCADERIA</option>
						        <option value="PRODUCTO TERMINADO">PRODUCTO TERMINADO</option>
						        <option value="GASTOS FIJOS">GASTOS FIJOS</option>
						        <option value="SERVICIOS">SERVICIOS</option>
						        <option value="TRANSFERENCIAS">TRANSFERENCIAS</option>
						        <option value="INSUMOS">INSUMOS</option>
						      </select>
						    </div>
						  </div>

						  <div class="form-group row">
						    <label style="text-align: left;" for="txtdetallecategoria" class="col-sm-2 col-form-label">Detallar</label>
						    <div class="col-sm-10">
						          <!--input type="text" class="form-control" id="txtdetallecategoria"-->
						          <textarea class="form-control rounded-0" id="txtdetallecategoria" rows="3"></textarea>
						    </div>


						    
  							
						  </div>

					
						</form>

						<div class="centrar" style="text-align: right; padding: 5px;">							
    					<button type="button" class="btn btn-outline-info" id="btgrabarcategoria" data-dismiss="modal">Grabar</button>
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
	listarcategorias();
	Verifica_permiso();
});

function Verifica_permiso(){

var axiduser =$("#txtcodusuario").val();
var axpermiso ="CATEGORIAS";

$.ajax({

	url:"categorias_funciones.php",
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


$(document).on("keyup","#txtbuscarcategorias",function(){
	listarcategorias();
})



$(document).on("click","#bteditarcatego",function(){

var axidcodcatego = $(this).data("idcatego");
$("#txtparametros").val(2);


$.ajax({

	url:"categorias_funciones.php",
	method: "POST",
	data: {param:2,
		axidcodcatego:axidcodcatego

		
	},
	
	success : function(editarcatego){

		var json = JSON.parse(editarcatego);

		  			if (json.status == 200){

						$("#txtidempresa").val(json.ID_EMPRESA);
						$("#txtidcategoria").val(json.ID_CATEGORIAS);
						$("#txtcodcatgo").val(json.COD_CATEGO);
						$("#txtnomcategoria").val(json.NOM_CATEGORIA);
						$("#txtsubcategoria").val(json.NOM_SUBCATEGORIA);
						$("#txtdetallecategoria").val(json.DETALLE_CATEGORIA);
						$("#txttiponegocio").val(json.TIPO_NEGOCIO);

						
						
		  			}

	}
})

})


$(document).on("click","#btgrabarcategoria",function(){

var axidcatego = $("#txtidcategoria").val();
var axidempresa = $("#txtidempresa").val();
var axcodcatego = $("#txtcodcatgo").val();
var axnomcategoria = $("#txtnomcategoria").val();
var axnomsucategoria = $("#txtsubcategoria").val();
var axdetallecateg = $("#txtdetallecategoria").val();
var axtiponegocio = $("#txttiponegocio").val();
var axparamentro = $("#txtparametros").val();

$.ajax({

	url:"categorias_funciones.php",
	method: "POST",
	data: {param:1,
		txtidcategoria:axidcatego,
		txtidempresa:axidempresa,
		txtcodcatgo:axcodcatego,
		txtnomcategoria:axnomcategoria,
		txtsubcategoria:axnomsucategoria,
		txtdetallecategoria:axdetallecateg,
		txttiponegocio:axtiponegocio,
		txtparametros:axparamentro
	},
	
	success : function(grabarcatego){

		if(grabarcatego==0){
           			
			window.location="categorias.php";
			//listarcategorias();

      	} else {
			swal("Aviso", "No se grabo el registro...", "warning");

		}
	}
})


})


function listarcategorias(){

		var axidempresa = $("#txtidempresa").val();	
		var axbuscarcategorias = $("#txtbuscarcategorias").val();	

		$.ajax({

			url:"categorias_funciones.php",
			method: "POST",
			data: {param:0,txtidempresa:axidempresa,txtbuscarcategorias:axbuscarcategorias},
				
				success : function(listactegor){

					$("#lista1").html(listactegor);
			}
		})
	}


</script>