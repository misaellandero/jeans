<div class="form-control col-md-6 col-sm-12">
   <h4>Numero de corte del producto</h4>

	<div class="contentBarcode">
						 <div class="barCode">
							 <header><h4>Codigo</h4></header>
							 <div><?php include('Codigob.php'); ?></div>
					 </div>
	</div>

	<input class="form-control" type="hidden" name="data_img" class="data_img" value="" />
	<input class="form-control" type="hidden" name="name_img" class="name_img" value="" />
  <label>Numero de corte </label><p>

		<input class="form-control" type="text" id="nombre" name="nombre" placeholder="Numero de corte" required>
<label>Imagen Principal (opcional)</label><p>
		<img id="img_destino" class="img-rounded img-fluid " src="#" alt="Tu imagen">

       <label>Ubicacion Archivo Original</label>
		<input class="form-control" type="file"  id="archivo" name="archivo">

 	 <label>Rotacion de imagen (grados 45, 90, 180)</label>
				<input class="form-control" type="button" class="btn btn-default rotar-imagen" data-rotar="45" value="Rotar 45" />
				<input class="form-control" type="button" class="btn btn-default rotar-imagen" data-rotar="90" value="Rotar 90" />
				<input class="form-control" type="button" class="btn btn-default rotar-imagen" data-rotar="180" value="Rotar 180" />
				<input class="form-control" type="button" class="btn btn-default rotar-imagen" data-rotar="270" value="Rotar 270" />


	</div>

</div> 
 <button   class="btn btn-lg  btn-outline-danger" type="reset">Reiniciar Formulario   </button >

 <button class="btn btn-lg btn-outline-primary" type="submit" id="cargar" name="cargar" >Registrar Producto</button>

	</form>
