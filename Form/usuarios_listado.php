<?php require_once '../includes/header.php'; ?>


<!DOCTYPE html>
	<html>
	<head>
		    
	</head>
	<body>
	<!--body style="margin: 3; padding: 3; background: url(../img/usuario.PNG) no-repeat center top;  background-size: cover;  font-family: sans-serif;  height: 100vh;"-->
	<br>
	<div class="container-fluid">
      
     <input type="hidden" name="txtidempresa" id="txtidempresa" value="<?php echo "$axidempresa";?>">
		<input type="hidden" name="txtfecharegistro" id="txtfecharegistro" value="<?php echo "$diaactual";?>">
		<input type="hidden" name="txtparametros" id="txtparametros">
		<input type="hidden" name="txtidusuario" id="txtidusuario">
		<input type="hidden" name="txtidpermiso" id="txtidpermiso">
		<input type="hidden" name="txtidasinacion" id="txtidasinacion">
		<input type="hidden" name="txtcodusuario" id="txtcodusuario" value="<?php echo "$axcoduser";?>">
   
           
        <div class="row">
        <div class="col-12">
            <div class="card">
              <div class="card-header">
             <h5><img src="../icon/user.png" style="width: 30px; height: 30px;"> Usuarios <button type="button" id="bnNuevo"  class="btn btn-outline-danger" data-toggle="modal" data-target=".bd-example-modal-xl">Nuevo</button></h5>	
                
                 <div class="input-group mb-3" style="padding: 2px;">
  				    <div class="input-group-prepend">
    				    
    				    <span class="input-group-text" id="basic-addon3">Buscar</span>
  				    </div>
  				     <input type="text" class="form-control" id="txtbuscarusuario" name="txtbuscarusuario" aria-describedby="basic-addon3">	
  			        </div> 
  			        
              </div>
                <div class="card-body">
                <div id="lista1" style="font-size:10pt;"></div>	  
                </div>
                
                </div>    
          	
          			
        </div>
       </div>
   
    </div>
             

	</div>

	<div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  		<div class="modal-dialog modal-xl">
    		<div class="modal-content">
      			
      			<div class="centrar" style="padding: 5px; margin: 5px ">
    				<h4>Registro de usuarios</h4>

    				
    			
    			<div class="card">
					  
					  <div class="card-header">
					    <ul class="nav nav-tabs card-header-tabs">
					      <li class="nav-item">
					        <a class="nav-link active" id="pndatos" href="#">Datos</a>
					      </li>
					      <li class="nav-item">
					        <a class="nav-link" id="pnpermisos" href="#">Permisos</a>
					      </li>
					      <li class="nav-item">
					        <a class="nav-link" id="pnasignar" href="#">Asignación</a>
					      </li>
					    </ul>
					  </div>



					  <div class="card-body">
					 	
					  	<div id="divdatos" style="padding: 5px;">

					  	<form>
						  <div class="form-group row">
						    <label style="text-align: left;"  for="txtdniusuario" class="col-sm-2 col-form-label">DNI</label>
						    <div class="col-sm-10">
						      <input type="text" class="form-control" id="txtdniusuario" >
						    </div>
						  </div>



						  <div class="form-group row">
						    <label style="text-align: left;" for="txtusuario" class="col-sm-2 col-form-label">Usuario</label>
						    <div class="col-sm-10">
						      <input type="text" class="form-control" id="txtusuario" >
						    </div>
						  </div>

						  <div class="form-group row">
						    <label style="text-align: left;" for="txtnombreusuario" class="col-sm-2 col-form-label">Nombres</label>
						    <div class="col-sm-10">
						      <input type="text" class="form-control" id="txtnombreusuario">
						    </div>
						  </div>

						  <div class="form-group row">
						    <label style="text-align: left;" for="txtclave" class="col-sm-2 col-form-label">Clave</label>
						    <div class="col-sm-10">
						      <input type="password" class="form-control" id="txtclave" >
						    </div>
						  </div>

						   <div class="form-group row">
						    <label style="text-align: left;" for="txtcargo" class="col-sm-2 col-form-label">Cargo</label>
						    <div class="col-sm-10">
						        <select class="custom-select mr-sm-2" id="txtcargo">
						        <option value=""></option>
						        <option value="ADMINISTRADOR">ADMINISTRADOR</option>
						        <option value="VENDEDOR">VENDEDOR</option>
						        <option value="SISTEMAS">SISTEMAS</option>
						      </select>
						    </div>
						  </div>

						  <div class="form-group row">
						    <label style="text-align: left;" for="txtcondicion" class="col-sm-2 col-form-label">Condición</label>
						    <div class="col-sm-10">
						        <select class="custom-select mr-sm-2" id="txtcondicion">
						        <option value=""></option>
						        <option value="ALTA">ALTA</option>
						        <option value="BAJA">BAJA</option>
						       </select>
						    </div>
						  </div>		 
											
						</form>

						<div class="centrar" style="text-align: right; padding: 5px;">
    					<button type="button" class="btn btn-outline-info" id="btgrabarusuario" data-dismiss="modal">Grabar Usuario</button>
  						<button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target=".bd-example-modal-xl">Cerrar</button>	
    					</div>
					  	</div>

					  	<div id="divpermisos"  style="display: none;" >

					  		<div class="row">
							  <div class="col-md-4">
							  	<div id="listarpermisos" ></div>	
							  </div>

							  <div class="col-md-8">
							  	<div id="listarpermisosasignados" ></div>	
							  </div>
							  

							</div>


					  	
						</div>
					  

					  	<div id="divasignar" style="display: none;" >

							<div class="form-group row">
						    <label style="text-align: left;" for="txtusuarioasignar" class="col-sm-2 col-form-label"  >Apellidos y Nombres</label>
						    <div class="col-sm-10">
						      <input type="text" class="form-control" id="txtusuarioasignar" disabled>
						    </div>
						  	</div>

					  		<div class="form-group row">			  	

						    <label style="text-align: left;" for="txtetapapy" class="col-sm-2 col-form-label">Locales</label>
						    <div class="col-sm-10">
						     <select class="custom-select mr-sm-2" id="txtetapapy">
						     	<?php while($fila=odbc_fetch_array($rsetapas)) {?>
      							<option value="<?php echo $fila['ID_LOCAL'];?>"><?php echo $fila['DESCRICION_LC'];?></option><?php } ?>
						      </select>

						    </div>
						  </div>



					  		<div class="center" style="text-align: right; padding: 5px;">
						    <button type="button" class="btn btn-outline-info" id="btasignaretapa">Asignar etapa</button>
							</div>

							<div id="listaetapasasignadas" ></div>	
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
		listarusuario();
	});


	function Verifica_permiso(){

	var axiduser =$("#txtcodusuario").val();
	var axpermiso ="CONTROL USUARIOS";

	$.ajax({

	url:"usuarios_funciones.php",
	method: "POST",
	data: {param:11,txtcodusuario:axiduser,axpermiso:axpermiso},
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

	$(document).on("keyup","#txtbuscarusuario",function(){
		listarusuario();
	})

	$(document).on("click","#txtquitaretapa",function(){

		var idasignetapa = $(this).data("idasignetapa");
		var axidusuario= $("#txtidusuario").val();

		Swal.fire({
		  title: 'Esta seguro de eliminar?',
		  text: "Una vez eliminado, no podrá recuperar este registro!",
		  type: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  confirmButtonText: 'Si Eliminar!'
		}).then((result) => {
		  if (result.value) {

		  	$.ajax({
		      	url:"usuarios_funciones.php",
	    	  	method: "POST",
	      		data: {param:10,idasignetapa:idasignetapa,txtidusuario:axidusuario},
	      		success : function(eliminaretapa){      			

	        		listaretapasasignas();
	      		}
	    
	    	});


		    Swal.fire(
		      'Eliminado!',
		      'Su archivo ha sido eliminado',
		      'success'
		    )
		  }
		})


		/*
		swal({
	  	title: "Esta seguro de eliminar?",
	  	text: "Una vez eliminado, no podrá recuperar este registro!",
	  	icon: "warning",
	  	buttons: true,
	  	dangerMode: true,
		})
		.then((willDelete) => {
		if (willDelete) {

	 		$.ajax({
		      	url:"usuarios_funciones.php",
	    	  	method: "POST",
	      		data: {param:10,idasignetapa:idasignetapa,txtidusuario:axidusuario},
	      		success : function(eliminaretapa){      			

	        		listaretapasasignas();
	      		}
	    
	    	});



		} else {
			swal("El registro no se eliminio!");
		}

		});
		*/

	})




	$(document).on("click","#btquitarmenu",function(){

		var axidmenu = $(this).data("idmenu");
		var axidusuario= $("#txtidusuario").val();

		Swal.fire({
		  title: 'Esta seguro de eliminar?',
		  text: "Una vez eliminado, no podrá recuperar este registro!",
		  type: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  confirmButtonText: 'Si Eliminar!'
		}).then((result) => {
		  if (result.value) {

		  	$.ajax({
		      	url:"usuarios_funciones.php",
	    	  	method: "POST",
	      		data: {param:9,axidmenu:axidmenu,txtidusuario:axidusuario},
	      		success : function(eliminarmenu){      			
	        		listapermisosasignadosxusuario();
	      		}
	    
	    	});

		    Swal.fire(
		      'Eliminado!',
		      'Su archivo ha sido eliminado',
		      'success'
		    )
		  }
		})



		/*
		swal({
	  	title: "Esta seguro de eliminar?",
	  	text: "Una vez eliminado, no podrá recuperar este registro!",
	  	icon: "warning",
	  	buttons: true,
	  	dangerMode: true,
		})
		.then((willDelete) => {
		if (willDelete) {

	 		$.ajax({
		      	url:"usuarios_funciones.php",
	    	  	method: "POST",
	      		data: {param:9,axidmenu:axidmenu,txtidusuario:axidusuario},
	      		success : function(eliminarmenu){      			
	        		listapermisosasignadosxusuario();
	      		}
	    
	    	});



		} else {
			swal("El registro no se eliminio!");
		}

		});

		*/

	})



	$(document).on("click","#bteditarusuario",function(){

		var axiduser = $(this).data("iduser");

		$.ajax({

			url:"usuarios_funciones.php",
			method: "POST",
			data: {param:8,axiduser:axiduser},
				
				success : function(traerdatosuser){
					var json = JSON.parse(traerdatosuser);

		  			if (json.status == 200){

						$("#txtidusuario").val(json.ID_USUARIO);
						$("#txtidempresa").val(json.ID_EMPRESA);
						$("#txtdniusuario").val(json.COD_USER);
						$("#txtusuario").val(json.USUARIO);
						$("#txtnombreusuario").val(json.NOM_USUARIO);
						$("#txtusuarioasignar").val(json.NOM_USUARIO);
						$("#txtclave").val(json.CLAVE);
						$("#txtcargo").val(json.CARGO);
						$("#txtfecharegistro").val(json.F_REGISTRO);
						$("#txtcondicion").val(json.CONDICION);

						//$("#txtidpermiso").val(json.ID_USUARIO);
						//$("#txtidasinacion").val(json.ID_USUARIO);
						
						listapermisosasignadosxusuario();
						listaretapasasignas()

		  			}


				}
		})


	})



	function traeridusuario() {
		
		var axcoduser= $("#txtdniusuario").val();

		$.ajax({

			url:"usuarios_funciones.php",
			method: "POST",
			data: {param:3,
				txtdniusuario:axcoduser
				},
				success : function(traerdato){
					var json = JSON.parse(traerdato);
		  			if (json.status == 200){
						
						$("#txtidusuario").val(json.ID_USUARIO);

		  			}


				}
		})

	}
	

	$(document).on("click","#btasignaretapa",function(){

		var idusuario = $("#txtidusuario").val();

		if (idusuario==""){

			swal("Aviso", "Se debe registrar y grabar al usuario antes de asignarle Etapas...", "warning");

		} else {

			var axidusuario = $("#txtidusuario").val();
			var axfecharegistro = $("#txtfecharegistro").val();
			var axparmetro= $("#txtparametros").val();
			var axidasignacion= $("#txtidasinacion").val();
			var axidetapa= $("#txtetapapy").val();
	

		$.ajax({

			url:"usuarios_funciones.php",
			method: "POST",
			data: {param:6,
				txtidusuario:axidusuario,
				txtfecharegistro:axfecharegistro,
				txtparametros:axparmetro,
				txtetapapy:axidetapa,
				txtidasinacion:axidasignacion
		
			},
				success : function(asignaretapa){

					if(asignaretapa==0){
     			   		
						listaretapasasignas()
    
      				} else {
						swal("Aviso", "No se grabo el registro...", "warning");

			      	}
				}
		})
		}
	})


	function listaretapasasignas() {

		var axidusuario = $("#txtidusuario").val();		
		$.ajax({
			url:"usuarios_funciones.php",
			method: "POST",
			data: {param:7,txtidusuario:axidusuario},
			success : function(listadoetapasxusuarios){
				$("#listaetapasasignadas").html(listadoetapasxusuarios);
			}
		})
	}



	$(document).on("click","#txtasignarpermiso",function(){

		var idusuario = $("#txtidusuario").val();

		if (idusuario==""){

			swal("Aviso", "Se debe registrar y grabar al usuario antes de asignarle permisos...", "warning");

		} else {

			var axidmenu = $(this).data("idmenu");
			var axidusuario = $("#txtidusuario").val();
			var axfecharegistro = $("#txtfecharegistro").val();
			var axparmetro= $("#txtparametros").val();
			var axidpermiso= $("#txtidpermiso").val();
	

		$.ajax({

			url:"usuarios_funciones.php",
			method: "POST",
			data: {param:4,
				txtidusuario:axidusuario,
				txtfecharegistro:axfecharegistro,
				txtparametros:axparmetro,
				axidmenu:axidmenu,
				txtidpermiso:axidpermiso
				
			},
				success : function(asignarpermisos){

					if(asignarpermisos==0){
       			   		listapermisosasignadosxusuario();
      				} else {
						swal("Aviso", "No se grabo el registro...", "warning");

			      	}
				}
		})


		}

		



	})
	


	function listapermisosasignadosxusuario() {

		var axidusuario = $("#txtidusuario").val();		
		$.ajax({
			url:"usuarios_funciones.php",
			method: "POST",
			data: {param:5,txtidusuario:axidusuario},
			success : function(listadomenuxusuarios){
				$("#listarpermisosasignados").html(listadomenuxusuarios);
			}
		})
	}





	$(document).on("click","#bnNuevo",function(){

		$("#txtparametros").val(1);

	})

	$(document).on("click","#bteditarusuario",function(){

		$("#txtparametros").val(2);

	})

	$(document).on("click","#btgrabarusuario",function(){

		var axparmetro= $("#txtparametros").val();
		var axidempresa = $("#txtidempresa").val();
		var axcoduser = $("#txtdniusuario").val();
		var axuser = $("#txtusuario").val();
		var axnomusuario = $("#txtnombreusuario").val();
		var axclave = $("#txtclave").val();
		var axcargo = $("#txtcargo").val();
		var axfecharegistro = $("#txtfecharegistro").val();
		var axidusuario= $("#txtidusuario").val();
		var axcondicion= $("#txtcondicion").val();

		$.ajax({

			url:"usuarios_funciones.php",
			method: "POST",
			data: {param:2,
				txtidempresa:axidempresa,
				txtdniusuario:axcoduser,
				txtusuario:axuser,
				txtnombreusuario:axnomusuario,
				txtclave:axclave,
				txtcargo:axcargo,
				txtfecharegistro:axfecharegistro,
				txtparametros:axparmetro,
				txtidusuario:axidusuario,
				txtcondicion:axcondicion
			},
				success : function(grabarusuario){


					if(grabarusuario==0){
         			   	

         			    //$("#listarpermisos").html(grabarusuario);
						$("#divdatos").css({'display':'none'});	
						$("#divpermisos").css({'display':'block'});
						$("#divasignar").css({'display':'none'});

						var elemento1 = document.getElementById("pndatos");
						var elemento2 = document.getElementById("pnpermisos");
						var elemento3 = document.getElementById("pnasignar");
						elemento1.className = "nav-link";
						elemento2.className = "nav-link active";
						elemento3.className = "nav-link";

						listarmenu();
            			
            			traeridusuario();

            			var axnomusuario = $("#txtnombreusuario").val();
            			$("#txtusuarioasignar").val(axnomusuario);
            			


      				} else {
						swal("Aviso", "No se grabo el registro...", "warning");

			      	}
				}
		})

	})

	$(document).on("click","#pndatos",function(){

		$("#divdatos").css({'display':'block'});
		$("#divpermisos").css({'display':'none'});
		$("#divasignar").css({'display':'none'});

		var elemento1 = document.getElementById("pndatos");
		var elemento2 = document.getElementById("pnpermisos");
		var elemento3 = document.getElementById("pnasignar");
		elemento1.className = "nav-link active";
		elemento2.className = "nav-link";
		elemento3.className = "nav-link";

	})

	$(document).on("click","#pnpermisos",function(){

		$("#divdatos").css({'display':'none'});
		$("#divpermisos").css({'display':'block'});
		$("#divasignar").css({'display':'none'});

		var elemento1 = document.getElementById("pndatos");
		var elemento2 = document.getElementById("pnpermisos");
		var elemento3 = document.getElementById("pnasignar");
		elemento1.className = "nav-link";
		elemento2.className = "nav-link active";
		elemento3.className = "nav-link";


		listarmenu();

	})


	function listarmenu() {
		var axidempresa = $("#txtidempresa").val();
		
		$.ajax({

			url:"usuarios_funciones.php",
			method: "POST",
			data: {param:1,txtidempresa:axidempresa},
				success : function(listadomenu){
				$("#listarpermisos").html(listadomenu);
			}
		})
	}


	$(document).on("click","#pnasignar",function(){

		$("#divdatos").css({'display':'none'});
		$("#divpermisos").css({'display':'none'});
		$("#divasignar").css({'display':'block'});

		var elemento1 = document.getElementById("pndatos");
		var elemento2 = document.getElementById("pnpermisos");
		var elemento3 = document.getElementById("pnasignar");
		elemento1.className = "nav-link";
		elemento2.className = "nav-link";
		elemento3.className = "nav-link active";

	})




	function listarusuario(){

		var axidempresa = $("#txtidempresa").val();
		var axbuscaregistro = $("#txtbuscarusuario").val();	


		$.ajax({

			url:"usuarios_funciones.php",
			method: "POST",
			data: {param:0,
				txtidempresa:axidempresa,
				txtbuscarusuario:axbuscaregistro
				},
				
				success : function(listadeusuarios){

					$("#lista1").html(listadeusuarios);
			}
		})
	}

	


	</script>



