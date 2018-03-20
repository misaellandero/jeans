<?php
require_once('funciones.php');
conectar('localhost', 'u722193362_date','03032014','u722193362_root');
?>

<form id="registro-producto" action="registroi.php" method="POST" enctype="multipart/form-data" >
  
    <label>Numero de corte</label><p> 
        <input type="text" id="nombre" name="nombre" placeholder="Numero de corte" required>
        <label>Ubicacion Archivo Original</label>   <p>
        <input type="file"  id="archivo" name="archivo">
            <input type="submit" id="cargar" name="cargar" value="Registrar" class="btn btn-success">
    </form>