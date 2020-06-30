
<?php 

require_once '../includes/core.php'; 

//$ruc = $_GET['rucempresa'];

//echo $ruc;

$axusuario =  $_SESSION['userId'];
$diaactual =$_SESSION["diaactual"];
$horaactual = date("g");
$anoactual = date("Y");
$ruc= $_SESSION['rucempresa'];

$query = "SELECT top 1 * FROM usuarios_c WHERE usuario= '".$axusuario."' and RUC_EMPRESA='".$ruc."'";
$result=odbc_exec($con,$query);

//echo "$query";

if(odbc_num_rows($result) == 1) {
   $value = odbc_fetch_array($result);
   $axiduser= $value['COD_USER'];
   $axidempresa = $value['ID_EMPRESA'];
   $axrazonsocial = $value['RAZON_SOCIAL'];
   $axnombreusuario = $value['NOM_USUARIO'];
   $axrucempresa = $value['RUC_EMPRESA'];
   $axcoduser= $value['ID_USUARIO'];
   $axtiponegocio= $value['TIPO_NEGOCIO'];
   
 }


$sqligv = "SELECT * FROM PARAMETROS WHERE ID_EMPRESA= '". $axidempresa."'";
$rsigv=odbc_exec($con,$sqligv);
if(odbc_num_rows($rsigv) == 1) {
   
   $value = odbc_fetch_array($rsigv);
   $axigvgeneral= $value['IGV_GENERAL'];
      
   
 }

$sqlcajeros = "SELECT * FROM CAJEROS ORDER BY NOM_USUARIO";
$rscajeros=odbc_exec($con,$sqlcajeros);

$sqlcargos = "SELECT * FROM CARGOS ORDER BY DESC_CARGO";
$rscargos=odbc_exec($con,$sqlcargos);

$sqletapas = "SELECT * FROM LOCALES WHERE ID_EMPRESA='$axidempresa' ORDER BY ID_LOCAL";
$rsetapas=odbc_exec($con,$sqletapas);

$sqllocales = "SELECT ID_LOCAL,DESCRICION_LC FROM LOCAL_ASIGNADO WHERE ID_USUARIO='$axcoduser' ORDER BY ID_LOCAL";
$rslocales=odbc_exec($con,$sqllocales);


$sqlcategorias = "SELECT * FROM CATEGORIAS WHERE ID_EMPRESA='$axidempresa' ORDER BY NOM_CATEGORIA";
$rscategorias=odbc_exec($con,$sqlcategorias);


$sqltipodocidentida = "SELECT * FROM TB2_DOCIDENTIDAD ORDER BY ID_DOC";
$rstipodocidentida=odbc_exec($con,$sqltipodocidentida);


$sqltipodoc = "SELECT ID_TD,DETALLE_DOC FROM TIPO_DOCUMENTOS ORDER BY ID_TD";
$rstipodoc=odbc_exec($con,$sqltipodoc);


$sqldepas = "SELECT * FROM UBIGEO_DEPARTAMENTO ORDER BY DEPARTAMENTO";
$rsdepa=odbc_exec($con,$sqldepas);


$sqlpaises = "SELECT COD_PAIS,NOM_PAIS FROM PAISES ORDER BY NOM_PAIS";
$rspaises=odbc_exec($con,$sqlpaises);

$sqlctas = "SELECT ID_CTA,NUM_CUENTA FROM CUENTA_BANCARIAS ORDER BY ID_CTA";
$rsctas=odbc_exec($con,$sqlctas);

$sqlctasDestino = "SELECT ID_CTA,NUM_CUENTA FROM CUENTA_BANCARIAS ORDER BY ID_CTA";
$rsctasDestino=odbc_exec($con,$sqlctasDestino);

$sqlpresentacion = "SELECT  ID_PRES,PRES_DESCRIPCION FROM PRESENTACION ORDER BY ID_PRES";
$rspresentacion=odbc_exec($con,$sqlpresentacion);

$sqlnumproceso = "SELECT  DISTINCT(NUM_PROCESO) AS NP FROM PEDIDOS_PROGRAMAR";
$rsnumproceso=odbc_exec($con,$sqlnumproceso);



?>






<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->

    <style type="text/css">
      
    .isDisabled { 
      cursor: not-allowed; 
      opacity: 0.5; 
      } 

      a[aria-disabled="true"] { 
        color: currentColor; 
        display: inline-block;
         /* For IE11/ MS Edge bug */
         pointer-events: none; 
         text-decoration: none; 
       }

      .isEnable{




      }

    </style>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name = "viewport" content = "initial-scale = 1.0, user-scalable = no,  width=device-width">
    <meta name="description" content="Consulta de Ruc SUNAT Perú sin captcha, descarga este codigo desde demos.geekdev.ml"/>
    <meta name="keywords" content="buscar ruc, consultar ruc peru, api rest consulta ruc peru, ruc perú, consulta ruc sin captcha, ruc sunat 2017"/>
    <meta property="og:locale" content="es_PE" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="Consulta de RUC SUNAT sin Captcha Perú - GeekDev" />
    <meta property="og:description" content="Consulta de Ruc SUNAT Perú sin captcha, descarga este codigo desde demos.geekdev.ml" />
    <meta property="og:image" content="https://drive.google.com/uc?id=0BxTe_c1GIOkoaFpkZlNrR0tta0E&export=view" />

    

    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <link rel="stylesheet" href="../css/bootstrap.min.css" >
    <link rel="stylesheet" href="../css/bootstrap.css" >
    <link rel="stylesheet" href="../css/bootstrap.min.css" >
    <link rel="stylesheet" href="../css/bootstrap-grid.css" >
    <link rel="stylesheet" href="../css/bootstrap-grid.min.css" >
    <link rel="stylesheet" href="../css/bootstrap-reboot.css" >
    <link rel="stylesheet" href="../css/bootstrap-reboot.min.css" >
    <link rel="stylesheet" href="../css/bootstrap-responsive.css">
    <link rel="stylesheet" href="../css/bootstrap-responsive.min.css">
    <link rel="stylesheet" href="../css/font-awesome.min.css">
    <!--link rel="stylesheet" href="../css/sweetalert2.min.css"-->
    <link rel="stylesheet" href="../css/dark.css">


    
    <link rel="stylesheet" href="../estilos/estiloindex.css">



    
    
    <title><?php echo "$axrazonsocial";?></title>
    
    <!--link rel="shortcut icon" href="favicon.ico"/-->
    <link rel="shortcut icon" href="../icon/favicon.ico"/>
    <script src="../js/6703f7586f.js"></script>

   
    

  </head>
  <body>
   
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="principal.php" ><img src="../icon/sistem_produc.png" style="width: 30px; height: 30px;"> PRC</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
     
      <ul class="navbar-nav">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#"  role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><b>Pedidos</b></a>
          <div class="dropdown-menu" >
              <div class="dropdown-divider"></div>
              <a id="mngestion_pedidos" class="dropdown-item"  href="gestion_pedidos_listar.php"><img src="../icon/pedidos_gestion.png" style="width: 30px; height: 30px;"> Gestion de Pedidos</a>
              <a id="mnpedidos_cliente" class="dropdown-item"  href="pedidos_clientes.php?tipo=Pedidos"><img src="../icon/pedidos_clientes.png" style="width: 30px; height: 30px;"> Pedidos de Clientes</a>              
              <div class="dropdown-divider"></div>
            </div>
        </li>
        
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#"  role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><b>Producción</b></a>
            <div class="dropdown-menu" >
              <div class="dropdown-divider"></div>
              <a id="mnproduccion" class="dropdown-item"  href="../Form/gestion_produccion.php"><img src="../icon/produc_1.png" style="width: 30px; height: 30px;"> Gestión Producción</a>
              <a id="mnlogistica" class="dropdown-item"  href="../Form/logistica_inventarios.php"><img src="../icon/logistica.png" style="width: 30px; height: 30px;"> Inventarios y Logistica</a>              
              <a id="mndistribuir" class="dropdown-item"  href="#"><img src="../icon/distribuir.png" style="width: 30px; height: 30px;"> Distribución</a>              
              <div class="dropdown-divider"></div>
            </div>
        </li>

         <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#"  role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><b>Administración</b></a>
            <div class="dropdown-menu" >
              <div class="dropdown-divider"></div>
              <a id="mnfacturacion" class="dropdown-item"  href="#"><img src="../icon/facturas.png" style="width: 30px; height: 30px;" > Facturación</a>
              <a id="mncxcobrar" class="dropdown-item"  href="#"><img src="../icon/cobrar.png" style="width: 30px; height: 30px;" > Cuentas por cobrar</a>              
              <a id="mncxpagar" class="dropdown-item"  href="#"><img src="../icon/pagar.png" style="width: 30px; height: 30px;" > Cuentas por pagar</a>              
              <div class="dropdown-divider"></div>
            </div>
        </li>
        
        <!--li class="nav-item active">
          <a class="nav-link" id="mninventarios" href="#"><b>Inventarios</b><span class="sr-only">(current)</span></a>
        </li-->
      
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><b>Mantenimiento</b></a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <div class="dropdown-divider"></div>
              <a class="dropdown-item " id="mnempresas" href="empresa.php"><img src="../icon/empresas.png" style="width: 30px; height: 30px;"> Empresa</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item " id="mnlocales" href="locales.php"><img src="../icon/local.png" style="width: 30px; height: 30px;"> Locales</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item "  id="mncategorias" href="categorias.php"><img src="../icon/categoria.png" style="width: 30px; height: 30px;"> Categorias</a>
              <a class="dropdown-item "  id="mnproductos" href="productos.php"><img src="../icon/producto.png" style="width: 30px; height: 30px;"> Productos</a>
              <a class="dropdown-item "  id="mnplantillas" href="plantillas.php"><img src="../icon/plantilla.png" style="width: 30px; height: 30px;"> Planillas Producción</a>
               <div class="dropdown-divider"></div>
              <a class="dropdown-item "  id="mncuentasbancarias" href="cuentas.php"><img src="../icon/bank.png" style="width: 30px; height: 30px;"> Caja - Bancos</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item "  id="mncliente" href="beneficiarios.php?id=CLIENTE"><img src="../icon/cliente.png" style="width: 30px; height: 30px;"> Clientes</a>
              <a class="dropdown-item "  id="mnproveedor" href="beneficiarios.php?id=PROVEEDOR"><img src="../icon/proveedor.png" style="width: 30px; height: 30px;"> Proveedores</a>
              <div class="dropdown-divider"></div>
              <!--a class="dropdown-item"  id="mnusuarios" href="tipocambio.php"><img src="../icon/tipocambio.png"> Tipo de cambio</a-->
              <a class="dropdown-item"  id="mnusuarios" href="usuarios_listado.php"><img src="../icon/user.png" style="width: 30px; height: 30px;"> Control usuarios </a>
            </div>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="../form/salir.php"><b>Salir</b> <span class="sr-only">(current)</span></a>
        </li>

       </ul>
    

  </div>


  <span class="navbar-text"><b id="txtusuarioactual" style="color:#6D8FDC;">Usuario: <?php echo "$axnombreusuario" ?></b></span>

  
</nav>





    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="../js/Chart.min.js"></script>
    <script src="../js/bootstrap.bundle.js"></script>
    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="../js/bootstrap.js"></script>
    <script src="../js/main.js"></script>
    

    <!--script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script-->
    <script src="../js/sweetalert2.all.min.js"></script>
    <script src="../js/sweetalert2@8.js"></script>
    <script src="../js/sweetalert.min.js"></script>
    <script src="../js/sweetalert2.js"></script>
    <script src="../js/validaruc.js"></script>

    
    <script src="../js/moment.js"></script>
    <script src="../js/sweetalert2.min.js"></script>
    


    <!--script src="../js/jquery-3.2.1.min.js"></script-->
    <!--script src="../js/popper.min.js"></script-->
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/ajaxview.js"></script>
    


    

    
    
    <!--script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script-->
    <!--script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script-->



  </body>
</html>

<script type="text/javascript">
/*
$(document).on("click","#mnproduccion",function(){
  alert("Modulo se desarrollara en base al giro del negocio...");
})
*/
</script>
