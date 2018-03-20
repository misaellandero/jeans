

	<input type="hidden" name="data_img" class="data_img" value="" />
	<input type="hidden" name="name_img" class="name_img" value="" />
 
   <p> <label>Numero de corte </label><p> 
		<input type="text" id="nombre" name="nombre" placeholder="Numero de corte" required>
        
        <p><label>Ubicacion Archivo Original</label> 	<p>
		<input type="file"  id="archivo" name="archivo">
 		
 		<p> <label>Rotacion de imagen (grados 45, 90, 180)</label><p> 
				<input type="button" class="btn btn-default rotar-imagen" data-rotar="45" value="Rotar 45" />
				<input type="button" class="btn btn-default rotar-imagen" data-rotar="90" value="Rotar 90" />
				<input type="button" class="btn btn-default rotar-imagen" data-rotar="180" value="Rotar 180" />
				<input type="button" class="btn btn-default rotar-imagen" data-rotar="270" value="Rotar 270" />
		<p>
			<input type="submit" id="cargar" name="cargar" value="Registrar" class="btn btn-success" >
            <input class="btn btn-danger" type="reset" value="limpiar"/>
	</form>
      
