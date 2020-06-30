

<?php 

session_start();

if(isset($_SESSION['userId'])) {
  header('location: principal.php');  

}



$errors = array();

if(isset($_POST['txtUsuario'])) {

  require_once('../Conexion/conexion.php');


  $ruc=$_POST['txtRuc'];
  $ausuario=$_POST['txtUsuario'];
  $apassword=$_POST['txtContrasena'];
  //$diaactual =$_SESSION["diaactual"];

  $query = "SELECT top 1 RUC_EMPRESA,USUARIO,CLAVE,ID_EMPRESA,RAZON_SOCIAL FROM USUARIOS_C WHERE  RUC_EMPRESA= '".$ruc."' AND USUARIO= '".$ausuario."' AND CLAVE = '".$apassword."'";
  echo($query);

  $result=odbc_exec($con,$query);
  
  if(odbc_num_rows($result) == 1) {

        $value = odbc_fetch_array($result);
        $user_id = $value['USUARIO'];
        $_SESSION['userId'] = $user_id;
        $_SESSION['diaactual']= date('Y-m-d');
        $_SESSION['rucempresa'] = $ruc;
         header('location: principal.php');  
         
        //header("Location: principal.php?rucempresa=".urlencode($ruc));

       //  <a class='btn btn-outline-success btn-sm' href='Exportar_Excel.php?param=1&axano=$axanoreporte&axlocal=$axlocal'>Exportar a Excel</a>

  }  else {
    
      header('location: ../index.html');  

  }

} 

?>
