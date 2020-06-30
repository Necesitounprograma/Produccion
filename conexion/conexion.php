<?php
  //error_reporting(0);
  error_reporting(E_ALL ^ E_NOTICE);


/*
define('DB_HOST', 'www.evolean.pro');//DB_HOST:  generalmente suele ser "127.0.0.1"
define('DB_USER', 'sa');//Usuario de tu base de datos
define('DB_PASS', 'auditek*1');//Contraseña del usuario de la base de datos
define('DB_NAME', 'ProduccionSJL');//Nombre de la base de datos
*/


define('DB_HOST', 'SOFTCAT2020\SQLEXPRESS');//DB_HOST:  generalmente suele ser "127.0.0.1"
define('DB_USER', 'sa');//Usuario de tu base de datos
define('DB_PASS', '123456');//Contraseña del usuario de la base de datos
define('DB_NAME', 'ProduccionSJL');//Nombre de la base de datos


$connection_string = "DRIVER={SQL Server};SERVER=".DB_HOST.";DATABASE=".DB_NAME; 
$con = odbc_connect($connection_string,DB_USER,DB_PASS);

if ($con) {
  //  echo "Connection established.";
} else{
    die("Connection could not be established.");
}
?>