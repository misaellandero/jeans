<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"

require 'conexionp.php';


$hostname_conexion_usuarios = $host;
$database_conexion_usuarios = $db;
$username_conexion_usuarios = $user;
$password_conexion_usuarios = $pw;
$conexion_usuarios = @mysql_pconnect($hostname_conexion_usuarios, $username_conexion_usuarios, $password_conexion_usuarios) or trigger_error(mysql_error(),E_USER_ERROR);
?>
