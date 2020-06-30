<?php require_once '../includes/header.php'; ?>


<!DOCTYPE html>
	<html>
	<head>

<style type="text/css">
  	
  .ul{
    background-color: #000;
    cursor: pointer;
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
		
		#listar{
	    background-color: #000;
	    cursor: pointer;
	    }


	     #listar_marca{
		   /* padding: 10px;*/
		  display:block; 
		  width:100%;
		  padding: 3px 0px;
		  color:#000;
		  background-color:#DBEBF6;
		  text-decoration:none;
		  }


		#listar_marca:hover{
		   /* padding: 10px;*/
		  display:block; 
		  width:100%;
		  padding: 3px 0px;
		  color:#000;
		  background-color:#356AA0;
		  text-decoration:none;
		  }

		   #listar_sabor{
		   /* padding: 10px;*/
		  display:block; 
		  width:100%;
		  padding: 3px 0px;
		  color:#000;
		  background-color:#DBEBF6;
		  text-decoration:none;
		  }


		#listar_sabor:hover{
		   /* padding: 10px;*/
		  display:block; 
		  width:100%;
		  padding: 3px 0px;
		  color:#000;
		  background-color:#356AA0;
		  text-decoration:none;
		  }

	

		  
  </style>	
	</head>
	
	<!--img src="../img/productos.jpg" style="opacity: 0.2;"-->

	<!--body style="margin: 3; padding: 3; background: url(../img/productos.PNG) no-repeat center top;  background-size: cover;  font-family: sans-serif;  height: 100vh;"-->
    <body>
           
    <br>
    <div class="container-fluid">
      
      <input type="hidden" name="txtidempresa" id="txtidempresa" value="<?php echo "$axidempresa";?>">
      <input type="hidden" name="txttiponegocio" id="txttiponegocio" value="<?php echo "$axtiponegocio";?>">
		<input type="hidden" name="txtidinsumo" id="txtidinsumo">
		<input type="hidden" name="txtcodigo" id="txtcodigo">
		<input type="hidden" name="txtparametros" id="txtparametros">
		<input type="hidden" name="txtdestinocontable" id="txtdestinocontable" value="0">
		<input type="hidden" name="txtcodusuario" id="txtcodusuario" value="<?php echo "$axiduser";?>">
   
           
        <div class="row">
        <div class="col-12">
            <div class="card">
              <div class="card-header">
               <h5><img src="../icon/producto.png" style="width: 30px; height: 30px;">Productos  <button type="button" id="bnNuevo"  class="btn btn-outline-danger" data-toggle="modal" data-target=".bd-example-modal-xl">Nuevo</button> </h5>	
                
               <div class="form-row">

               		<div class="form-group col-md-4">
					   	<label for="txtidlocal"><B>Local</B></label>
						<select class="form-control custom-select mr-sm-2" id="txtidlocal">
						<?php while($fila=odbc_fetch_array($rslocales)) {?>
	    				<option value="<?php echo $fila['ID_LOCAL'];?>"><?php echo $fila['DESCRICION_LC'];?></option><?php } ?>
	    				</select>
					</div>

					<div class="form-group col-md-4">
				    	<label for="txtidcategoria"><b>Categorias</b></label>
						<select class="custom-select mr-sm-2" id="txtsubcategoria">
						    <!--option value="MERCADERIA">MERCADERIA</option>
						    <option value="PRODUCTO TERMINADO">PRODUCTO TERMINADO</option>
						    <option value="GASTOS FIJOS">GASTOS FIJOS</option>
						    <option value="SERVICIOS">SERVICIOS</option>
						    <option value="TRANSFERENCIAS">TRANSFERENCIAS</option>
						    <option value="INSUMOS">INSUMOS</option-->
					    </select>
				    </div>

				</div>

				<div class="form-row">
					
					<div  class="col-sm-4">
			  			<label for="txtidetapa"><b>Buscar</b></label>
			  			<div class="input-group mb-3">
						<input type="text" class="form-control" id="txtbuscar"  placeholder="Nombre Comercial" aria-label="Recipient's username" aria-describedby="basic-addon2">
						<div class="input-group-append">
						<button class="btn btn-outline-danger" id="Btbuscar" type="button">Buscar</button>
						</div>
						</div>
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
               
                       
    
	<div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  		<div class="modal-dialog modal-xl">
    		<div class="modal-content">
      			
      			<div class="centrar" style="padding: 5px; margin: 5px ">
    				<h4>Registro de productos</h4>
   					<div class="card">
					  <div class="card-body">
					  	<form>
					  	<div class="form-row">
				    		<div class="form-group col-md-3">
				      		<label for="txtcodinsumo">Código</label>
							<input type="text" class="form-control" id="txtcodinsumo" disabled >
				        	</div>
				        		    
				    		<div class="form-group col-md-3">
				      		<label for="txtcodbarra">Cod. Barra</label>
				      		<input type="text" class="form-control" id="txtcodbarra" >
				      	    </div>
				      	    
				      	    <div class="form-group col-md-6">
				      		<label for="txtidcategoria">Categorias</label>
							   <select class="custom-select mr-sm-2" id="txtidcategoria">
						     	<?php while($fila=odbc_fetch_array($rscategorias)) {?>
      							<option value="<?php echo $fila['ID_CATEGORIAS'];?>"><?php echo $fila['NOM_CATEGORIA'];?></option><?php } ?>
						      </select>
				        	</div>
					  	</div>
					  	
					  	<div class="form-row">

					  		<div class="form-group col-md-4">
				      		<label for="txtlaboratorio">Marca | Proveedor</label>
				      		<input type="text" onblur="Mayuscula(this.value,this.id)" class="form-control" id="txtlaboratorio">
				      		<div id="divlistarmarcas"></div>
				      	    </div>	

				      	    <div class="form-group col-md-4">
				      		<label for="txtcomposicion">Sabor | Color</label>
				      		<input type="text" onblur="Mayuscula(this.value,this.id)" class="form-control" id="txtcomposicion">
				      		<div id="divsabor"></div>
				      	    </div>

				      	    <div class="form-group col-md-2">
				      		<label for="txtunidad">Presentación</label>
							   <select class="custom-select mr-sm-2" id="txtunidad">
						     	<?php while($fila=odbc_fetch_array($rspresentacion)) {?>
      							<option value="<?php echo $fila['ID_PRES'];?>"><?php echo utf8_encode($fila['PRES_DESCRIPCION']);?></option><?php } ?>
						      </select>
				      	    </div>

				      	    <div class="form-group col-md-2">
				      		<label for="txtcomposicion">Cant</label>
				      		<input type="text" onblur="Mayuscula(this.value,this.id)" class="form-control" id="txtpresentacion_C" value="0">
				      	    </div>
				    		
				      	    
					  	</div>

					  	<div class="form-row">
					  		
					  		<div class="form-group col-md-8">
				      		<label for="txtnombreinsumo"><a href="#" id="lblnombreinsumo">Nombre Comercial</a></label>
							 <input type="text" onblur="Mayuscula(this.value,this.id)" class="form-control" id="txtnombreinsumo">
							 <input type="hidden" class="form-control" id="txtnomgenerico" value="0">
				        	</div>

				        	<div class="form-group col-md-4">
				      		<label for="txttipocondicion">Condición Tributaria</label>
							   <select class="custom-select mr-sm-2" id="txttipocondicion">
						        <option value="GRAVADA">GRAVADA</option>
						        <option value="EXONERADA">EXONERADA</option>
						        <option value="INAFECTO">INAFECTO</option>
						        <option value="GRATUITO">GRATUITO</option>
						      </select>
				        	</div> 
				        	
				        	
				      	</div>    

				      	<div class="form-row">
				    		
                            <div class="form-group col-md-4">
				      		<label for="txtprscompra">Prs. Compra</label>
							 <input type="text" class="form-control" id="txtprscompra" value="0">
				        	</div>
                                    
                            <div class="form-group col-md-4">
				      		<label for="txtprscotxtprsventampra">Prs. Venta</label>
							 <input type="text" class="form-control" id="txtprsventa" value="0">
				        	</div>

				        		<div class="form-group col-md-4">
				      		<label for="txtporc_dscto">Porc. Dscto</label>
							 <input type="text" class="form-control" id="txtporc_dscto" value="0">
				        	</div>
				            
				            
				          	    
					  	</div>
						
						<div class="form-row">
						
							<div class="form-group col-md-4">
				      		<label for="txtstock_minimo">Stock Minimo</label>
							<input type="text" class="form-control" id="txtstock_minimo" value="0">
				        	</div>

				        	<div class="form-group col-md-4">
				      		<label for="txtstockinicial">Stock Inicial</label>
							 <input type="text" class="form-control" id="txtstockinicial" value="0">
				        	</div>

				        	<div class="form-group col-md-4">
				      		<label for="txtstockactual">Stock Actual</label>
							 <input type="text" class="form-control" id="txtstockactual" disabled="true" value="0">
							  <input type="hidden" class="form-control" id="txtcondventa" value="NINGUNA">
				        	</div>
				         	
				         
	
						</div>

					 
				        
					</form>

						<div class="centrar" style="text-align: right; padding: 5px;">							
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
	listar_categorias();
	listar();
	

});

$('#txtcomposicion').keyup(function(){

	  var axbuscaremisor = $("#txtcomposicion").val();
	  var axidetapa = $("#txtidlocal").val();
	  
	  if (axbuscaremisor != '') {

	    $.ajax({
	      url:"productos_funciones.php",
	      method: "POST",
	      data: {param:9,txtcomposicion:axbuscaremisor,txtidlocal:axidetapa},
	      success : function(traer_emisor){


	      	$('#divsabor').fadeIn();
	        $('#divsabor').html(traer_emisor);
	      	
        
	      }
	    });
	  } 
	});


	$(document).on("click","#listar_sabor",function(){
		
	$("#txtcomposicion").val($(this).text());
	$("#divsabor").fadeOut();


	})


$('#txtlaboratorio').keyup(function(){

	  var axbuscaremisor = $("#txtlaboratorio").val();
	  var axidetapa = $("#txtidlocal").val();
	  
	  if (axbuscaremisor != '') {

	    $.ajax({
	      url:"productos_funciones.php",
	      method: "POST",
	      data: {param:8,txtlaboratorio:axbuscaremisor,txtidlocal:axidetapa},
	      success : function(traer_emisor){


	      	$('#divlistarmarcas').fadeIn();
	        $('#divlistarmarcas').html(traer_emisor);
	      	
        
	      }
	    });
	  } 
	});


	$(document).on("click","#listar_marca",function(){
		
	$("#txtlaboratorio").val($(this).text());
	$("#divlistarmarcas").fadeOut();


	})

$(document).on("change","#txtsubcategoria",function(){

	//alert("entreee");
	$("#txtbuscar").val("");

	listar();

})


function JuntarNomre() {


var axparamentro = $("#txtparametros").val();

if(axparamentro==1){
	
	//var axcategoria=($("#txtidcategoria option:selected").text());
	var axpresentar=($("#txtunidad option:selected").text());
	var axmarca = $("#txtlaboratorio").val();
	var axsabor = $("#txtcomposicion").val();
	var axpresentacion_C = $("#txtpresentacion_C").val();
	var axnombrecomercial = axmarca+' SABOR A '+axsabor+' '+axpresentar+' X  '+axpresentacion_C;
	$("#txtnombreinsumo").val(axnombrecomercial);	
}



}

$(document).on("click","#lblnombreinsumo",function(){
JuntarNomre();

})




$(document).on("change","#txtstockinicial",function(){

	var axparamentro = $("#txtparametros").val();
	var axidinsumo = $("#txtidinsumo").val();
	var axidlocal = $("#txtidlocal").val();
	var axstockinicial = $("#txtstockinicial").val();

	//alert(axparamentro);
	
	if(axparamentro==1){
	
		var axstockinicial = $("#txtstockinicial").val();
		$("#txtstockactual").val(axstockinicial);

	} else if(axparamentro==2) {
	
		$.ajax({

		url:"productos_funciones.php",
		method: "POST",
		data: {param:6,txtidinsumo:axidinsumo,txtidlocal:axidlocal},
			success : function(codigo){
				
				if(codigo=="NO"){

					//var axstockinicial = $("#txtstockinicial").val();
					$("#txtstockactual").val(axstockinicial);

				}else{

					 $nstock =(parseInt(codigo) + parseInt(axstockinicial));

					$("#txtstockactual").val($nstock);

				}
			}
	})	
	}

})

function stock_actual(){

	var axidinsumo = $("#txtidinsumo").val();
	var axidlocal = $("#txtidlocal").val();
	var axstockinicial = $("#txtstockinicial").val();


	$.ajax({

		url:"productos_funciones.php",
		method: "POST",
		data: {param:6,txtidinsumo:axidinsumo,txtidlocal:axidlocal},
			success : function(codigo){
				
				if(codigo=="NO"){

					var axstockinicial = $("#txtstockinicial").val();
					$("#txtstockactual").val(axstockinicial);

				}else{

					$("#txtstockactual").val(codigo+axstockinicial);

				}
			}
	})




}

function Verifica_permiso(){

var axiduser =$("#txtcodusuario").val();
var axpermiso ="PRODUCTOS";

$.ajax({

	url:"productos_funciones.php",
	method: "POST",
	data: {param:4,txtcodusuario:axiduser,axpermiso:axpermiso},
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

$(document).on("change","#txtidcategoria",function(){

	var axparamentro = $("#txtparametros").val();
	var axcodusuario = $("#txtcodusuario").val();


	//if(axparamentro==1){

		momentoActual = new Date() 
		//hora = addZero(momentoActual.getHours());
		minuto = addZero(momentoActual.getMinutes()); 
		segundo = addZero(momentoActual.getSeconds()); 
		var axcodigo1  = axcodusuario.substr(0,2)+segundo;

		//alert(axcodigo1);

		$("#txtcodigo").val(axcodigo1);
		var axcodigo = $("#txtcodigo").val();		
		var axidcatego = $("#txtidcategoria").val();
		var axidempresa = $("#txtidempresa").val();
		

		$.ajax({

		url:"productos_funciones.php",
		method: "POST",
		data: {param:3,txtidcategoria:axidcatego,txtcodigo:axcodigo,txtidempresa:axidempresa},
			success : function(codigo){
				$("#txtcodinsumo").val(codigo);
				$("#txtcodbarra").val(codigo);
				//JuntarNomre();
			}
		})

	//}


})



$(document).on("click","#bnNuevo",function(){
	$("#txtparametros").val(1);

/*
	var axidempresa = $("#txtidempresa").val();
	$.ajax({

		url:"productos_funciones.php",
		method: "POST",
		data: {param:5,txtidempresa:axidempresa},
			success : function(codigo){
				
			}
		})
*/
})



$(document).on("change","#txtsubcategoria",function(){
	var axcategoria = $("#txtsubcategoria").val();
	listar();
})


$(document).on("click","#Btbuscar",function(){
	listar();
})

$(document).on("click","#bteliminar",function(){

var axidinsumo = $(this).data("id");

Swal.fire({
		  title: 'Esta seguro de eliminar el registro?',
		  text: "Una vez eliminado, no podrá recuperar este registro!",
		  type: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  confirmButtonText: 'Si, Eliminar!'

		}).then((result) => {

		 if (result.value) {

		 	$.ajax({

				url:"productos_funciones.php",
				method: "POST",
				data: {param:10,axidinsumo:axidinsumo},	
				success : function(eliminar){

					if(eliminar==0){
						 Swal.fire(
					      'Eliminado!',
					      'El registro ha sido eliminado!',
					      'success'
					    )
						listar();
					} else {		
						 Swal.fire(
					      'Información!',
					      'El registro no fue eliminado',
					      'success'
					    )
					}
					
				}
			})

		 }
})




})


$(document).on("click","#bteditar",function(){

var axidinsumo = $(this).data("id");
$("#txtparametros").val(2);


$.ajax({

	url:"productos_funciones.php",
	method: "POST",
	data: {param:2,
		axidinsumo:axidinsumo

		
	},
	
	success : function(editarcatego){

		var json = JSON.parse(editarcatego);

		  			if (json.status == 200){
						$("#txtidempresa").val(json.ID_EMPRESA);
						$("#txtidcategoria").val(json.ID_CATEGORIAS);
						$("#txtidinsumo").val(json.ID_INSUMO);
						$("#txtcodinsumo").val(json.COD_INSUMO);
						$("#txtcodbarra").val(json.COD_BARRA);
						$("#txtnombreinsumo").val(json.NOM_COMERCIAL);
						$("#txtunidad").val(json.ID_PRES);
						$("#txttipocondicion").val(json.TIPO_CONDICION);
						$("#txtprscompra").val(json.P_COMPRA);
						$("#txtprsventa").val(json.P_VENTA);
                        
                        $("#txtdestinocontable").val(json.DESTINO_CONTABLE);
                        
                        $("#txtnomgenerico").val(json.NOM_GENERICO);
                        $("#txtcomposicion").val(json.COMPOSICION);
                        $("#txtlaboratorio").val(json.LABORATORIO);
                        $("#txtcondventa").val(json.CONDICION_VENTA);
                        
                        $("#txtstockinicial").val(json.STOCK_INICIAL);
                        $("#txtstockactual").val(json.STOCK_ACTUAL);
                        $("#txttiponegocio").val(json.TIPO_NEGOCIO);
                        $("#txtidlocal").val(json.ID_LOCAL);
                        $("#txtpresentacion_C").val(json.PRESENTACION_C);

                        $("#txtstock_minimo").val(json.STOCK_MINIMO);
                        $("#txtporc_dscto").val(json.PORC_DSCTO);
                        



                        

						
						
		  			}

	}
})

})


$(document).on("click","#btgrabar",function(){


var axidinsumo = $("#txtidinsumo").val();
var axcodinsumo = $("#txtcodinsumo").val();

if(axcodinsumo==""){
	swal("Aviso", "Seleccionar la categoria...", "warning");

} else {
	



var axcodbarra1 = $("#txtcodbarra").val();

if(axcodbarra1==""){

	$("#txtcodbarra").val(axcodinsumo);
	var axcodbarra = $("#txtcodbarra").val();

} else {

	$("#txtcodbarra").val(axcodbarra1)
	var axcodbarra = $("#txtcodbarra").val();

}


var axnominsumo = $("#txtnombreinsumo").val();
var axunidad = $("#txtunidad").val();
var axtipocond = $("#txttipocondicion").val();
var axprscompra = $("#txtprscompra").val();
var axprsventa = $("#txtprsventa").val();
var axidempresa = $("#txtidempresa").val();
var axidcatego = $("#txtidcategoria").val();

var axnomgenerico = $("#txtnomgenerico").val();
var axcomposicion = $("#txtcomposicion").val();
var axlaboratorio = $("#txtlaboratorio").val();
var axcondventa = $("#txtcondventa").val();
var axdestinocontable = $("#txtdestinocontable").val();
var axparamentro = $("#txtparametros").val();
var axidlocal = $("#txtidlocal").val();
var axstockinicial = $("#txtstockinicial").val();
var axstockactual = $("#txtstockactual").val();
var axtiponegocio = $("#txttiponegocio").val();
var axpresentacion_C = $("#txtpresentacion_C").val();
var axstock_minimo = $("#txtstock_minimo").val();
var axporc_dscto = $("#txtporc_dscto").val();





$.ajax({

	url:"productos_funciones.php",
	method: "POST",
	data: {param:1,

		txtidinsumo:axidinsumo,
		txtcodinsumo:axcodinsumo,
		txtcodbarra:axcodbarra,
		txtnombreinsumo:axnominsumo,
		txtunidad:axunidad,
		txttipocondicion:axtipocond,
		txtprscompra:axprscompra,
		txtprsventa:axprsventa,
		txtidempresa:axidempresa,
		txtidcategoria:axidcatego,
        txtdestinocontable:axdestinocontable,
        txtnomgenerico:axnomgenerico,
        txtcomposicion:axcomposicion,
        txtlaboratorio:axlaboratorio,
        txtcondventa:axcondventa,
        txtidlocal:axidlocal,
        txtstockactual:axstockactual,
        txtstockinicial:axstockinicial,
        txttiponegocio:axtiponegocio,
		txtparametros:axparamentro,
		txtpresentacion_C:axpresentacion_C,
		txtstock_minimo:axstock_minimo,
		txtporc_dscto:axporc_dscto
	},
	
	success : function(grabar){

		if(grabar==0){
           			
			window.location="productos.php";

      	} else {
			swal("Aviso", "No se grabo el registro...", "warning");

		}
	}
})
}

})

function listar_categorias() {
		
	var axidempresa = $("#txtidempresa").val();	
		
	$.ajax({

		url:"productos_funciones.php",
		method: "POST",
		data: {param:7,txtidempresa:axidempresa},
		success : function(lsitarcatego){
			$("#txtsubcategoria").html(lsitarcatego);
		}
	})
}

function listar(){

		var axidlocal = $("#txtidlocal").val();	
		var axcategoria= $("#txtsubcategoria").val();	
		var axbuscar = $("#txtbuscar").val();	

		$.ajax({

			url:"productos_funciones.php",
			method: "POST",
			data: {param:0,txtidlocal:axidlocal,txtbuscar:axbuscar,txtsubcategoria:axcategoria},
				
				success : function(listar){

					$("#lista1").html(listar);
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


function addZero(i) {
  if (i < 10) {
    i = "0" + i;
  }
  return i;
}

function Mayuscula(obj,id){
    obj = obj.toUpperCase();
    document.getElementById(id).value = obj;
}


</script>

