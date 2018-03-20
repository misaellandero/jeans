<form action="registro.php" method="POST">  
 

 <p>
      <label>Clave Principal</label>
        <input name="ID" type="int(11)">
      	  
 </p>
  <p>
        <label> Descripsion </label>
        <input  name="Descripsion" type="text">
      	  


 <p>
       <label> Unidad</label>
        <input name="Unidad" type="text">
      	  
 </p>

 <p>
<label>Cantidad </label>
        <input  name="Cantidad" type="int(11)"> <p>
<input class="btn btn-danger" type="reset" value="limpiar"/>
	<input id="doRegister"  type="submit" value="Registrar" class="btn btn-success"> 
	</p>
	<div class="alert"/></div>
</form>  	
<label> En caso de requerirlo puede cargar una imagen del producto, el nombre de la imagen debe ser el mismo que el del Codigo de la clave principal.

 <?php include('upload.php'); ?>
 