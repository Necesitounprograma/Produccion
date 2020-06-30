<?php require_once '../includes/header.php'; ?>


<!DOCTYPE html>
	<html>
	<head>
		    
	</head>
	
	<!--img src="../img/productos.jpg" style="opacity: 0.2;"-->

	<!--body style="margin: 3; padding: 3; background: url(../img/productos.PNG) no-repeat center top;  background-size: cover;  font-family: sans-serif;  height: 100vh;"-->
    <body>
           
    <br>
    <div class="container-fluid">
      
      <input type="hidden" name="txtidempresa" id="txtidempresa" value="<?php echo "$axidempresa";?>">
		<input type="hidden" name="txtidcta" id="txtidcta">
		<input type="hidden" name="txtparametros" id="txtparametros">
		<input type="hidden" name="txtcodusuario" id="txtcodusuario" value="<?php echo "$axiduser";?>">
   	   
        <div class="row">

	        <div class="col-12">
	            <div class="card">
	              <div class="card-header">
	               <h5><img src="../icon/bank.png" style="width: 30px; height: 30px;"> Caja - Bancos <button type="button" id="bnNuevo"  class="btn btn-outline-danger" data-toggle="modal" data-target=".bd-example-modal-xl">Nuevo</button></h5>	

	               <div class="form-row">
						<div class="form-group col-md-4">
							<label for="txtidlocal">Local</label>
								<select class="form-control custom-select mr-sm-2" id="txtidlocal">
								<?php while($fila=odbc_fetch_array($rslocales)) {?>
			    				<option value="<?php echo $fila['ID_LOCAL'];?>"><?php echo $fila['DESCRICION_LC'];?></option><?php } ?>
			    				</select>
						</div>
						<div class="form-group col-md-3">
							<label for="txtbuscar">Buscar</label>
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
               
                       
    
	<div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  		<div class="modal-dialog modal-xl">
    		<div class="modal-content">
      			
      			<div class="centrar" style="padding: 5px; margin: 5px ">
    				<h4>Registro de cuentas</h4>
   					<div class="card">
					  <div class="card-body">
				
					  	<div class="form-row">

				    		<div class="form-group col-md-3">
				      		<label for="txtnumcuenta">Num. Cuenta</label>
							<input type="text" class="form-control" id="txtnumcuenta" value="0" style="text-align: center;" >
				        	</div>

				        	<div class="form-group col-md-3">
				      		<label for="txtcci">TIPO</label>
							<!--input type="text" class="form-control" id="txtcci" value="0" style="text-align: center;" -->
							<select id="txtcci" class="form-control custom-select mr-sm-2">
							<option value="EFECTIVO">EFECTIVO</option>
					        <option value="BANCOS">BANCOS</option>
					        <!--option value="VISA CREDITO">VISA CREDITO</option>
					        <option value="VISA DEBITO">VISA DEBITO</option>
					        <option value="MASTERCARD CREDITO">MASTERCARD CREDITO</option>
					        <option value="MASTERCARD DEBITO">MASTERCARD DEBITO</option-->
					    </select>
				        	</div>
				        		    
				    		<div class="form-group col-md-3">
				      		<label for="txtnombanco">Nom. Banco</label>
				      		<input type="text" class="form-control" id="txtnombanco" style="text-align: center;"  >
				      	    </div>

				      	    <div class="form-group col-md-2">
				      		<label for="txtmoneda">Moneda</label>
				      		<select id="txtmoneda" class="form-control custom-select mr-sm-2">
							<option value="SOLES">SOLES</option>
					    	<option value="DOLARES">DOLARES</option>
					    	</select>	
				      	    </div>
				      	    
				      	 
					  	</div>
					  	
					  	<div class="form-row">
				    		
				    						    		
				    		<div class="form-group col-md-2">
				      		<label for="txtfechainicio">Fecha Inicio</label>
							 <input type="date" class="form-control" id="txtfechainicio" value="<?php echo "$diaactual";?>">
				        	</div>

				    		<div class="form-group col-md-2">
				      		<label for="txtsaldoinicial">Saldo inicial</label>
							 <input type="text" class="form-control" id="txtsaldoinicial" value="0"style="text-align: right;" >
				        	</div>

				        	<div class="form-group col-md-2">
				      		<label for="txtsaldoinicial">Saldo Actual</label>
							 <input type="text" class="form-control" id="txtsaldoactual" value="0" style="text-align: right;" disabled="true">
				        	</div>				        	
				        	
				        	<div class="form-group col-md-2">
				      		<label for="txtcorrelativoconta">Num. Registro Contab.</label>
							 <input type="text" class="form-control" id="txtcorrelativoconta" value="00000" style="text-align: center;" disabled="true"	 >
				        	</div>		
				      	    
				      	    				      	    
					  	</div>
				
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
	listar();

});


function Verifica_permiso(){

var axiduser =$("#txtcodusuario").val();
var axpermiso ="CUENTAS BANCARIAS";

$.ajax({

	url:"cuentas_funciones.php",
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


$(document).on("keyup","#txtbuscar",function(){
	listar();
})



$(document).on("click","#bteditar",function(){

var axidcta = $(this).data("id");
$("#txtparametros").val(2);


$.ajax({

	url:"cuentas_funciones.php",
	method: "POST",
	data: {param:2,axidcta:axidcta},
	
	success : function(editarcatego){

		var json = JSON.parse(editarcatego);

		  			if (json.status == 200){
						$("#txtidcta").val(json.ID_CTA);
						$("#txtnumcuenta").val(json.NUM_CUENTA);
						$("#txtnombanco").val(json.BANCO_CUENTA);
						$("#txtmoneda").val(json.MONEDA_CTA);
						$("#txtcci").val(json.CCI_CUENTA);
						$("#txtsaldoinicial").val(json.SALDO_INICIAL);
						$("#txtsaldoactual").val(json.SALDO_ACTUAL);
						$("#txtidlocal").val(json.ID_LOCAL);
						$("#txtcorrelativoconta").val(json.CORR_CONTABLE);
						$("#txtfechainicio").val(json.FECHA_INICIO);
		  			}

	}
})

})


$(document).on("click","#btgrabar",function(){


var anumcuenta = $("#txtnumcuenta").val();
var axidcta = $("#txtidcta").val();
var axbanco = $("#txtnombanco").val();
var axmoneda = $("#txtmoneda").val();
var axcci = $("#txtcci").val();
var axsaldoinicial = $("#txtsaldoinicial").val();
var axsaldoactual = $("#txtsaldoactual").val();
var axidlocal = $("#txtidlocal").val();

var axcorrelativo = $("#txtcorrelativoconta").val();
var axfechainicio = $("#txtfechainicio").val();

var axparamentro = $("#txtparametros").val();

$.ajax({

	url:"cuentas_funciones.php",
	method: "POST",
	data: {param:1,

		txtnumcuenta:anumcuenta,
		txtidcta:axidcta,
		txtbanco:axbanco,
		txtmoneda:axmoneda,
		txtcci:axcci,
		txtsaldoinicial:axsaldoinicial,
		txtsaldoactual:axsaldoactual,
		txtidlocal:axidlocal,
		txtcorrelativoconta:axcorrelativo,
		txtfechainicio:axfechainicio,
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


function listar(){

		var axidempresa = $("#txtidempresa").val();	
		var axidlocal = $("#txtidlocal").val();	
		var axbuscar = $("#txtbuscar").val();	

		$.ajax({

			url:"cuentas_funciones.php",
			method: "POST",
			data: {param:0,txtidempresa:axidempresa,txtbuscar:axbuscar,txtidlocal:axidlocal},
				
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


</script>

