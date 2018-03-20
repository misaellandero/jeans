<script language="javascript"> 

    function agregarSalida() { 
        campos = "<div class='datos'>"
        +"<a href='#' onclick=eliminarSalida($(this))>Eliminar</a><br />"
        +"<input type='text' placeholder='Codigo' name='Id[]' onkeyup='busquedaCodigoSalida($(this))' /> "
        +"<input type='text' placeholder='Producto' name='Producto[]' /> "
        +"<input type='text' placeholder='tipo' name='tipo[]' />"
        +"<input type='text' placeholder='Descripcion' name='Descripcion[]' />"
        +"<input type='text' placeholder='talla' name='talla[]' />"
        +"<input type='text' placeholder='Cantidad' name='Cantidad[]' />"
        +"<hr class='soften'/><p></div>"

        $("#form-datos-salida").find("#acciones-form-datos-salida").before(campos);
    } 

    function eliminarSalida(obj){
        obj.closest("div.datos").remove();
    }

    function busquedaCodigoSalida(obj){

        var $this = obj;
        $.ajax({
            url: 'administrador/movimientos/registroAjax.php',
            type: 'post',
            data: { 'codigoBarras': $this.val(),'action' : 'entradasKeyUp'},
            dataType: 'json',
            success: function (data) {
                if (data.success) {
                    var datos = $this.closest("div.datos");
                    datos.find("[name='Producto[]']").val(data.Producto);
                    datos.find("[name='tipo[]']").val(data.Tipo);
                    datos.find("[name='Descripcion[]']").val(data.Descripcion);
                    datos.find("[name='talla[]']").val(data.Talla);
                    //datos.find("[name='Cantidad[]']").val(data.Cantidad);
                    $("#error-registro").html('');
                }
            },
            error: function (jqXHR, textStatus, errorThrown){
                $("#error-registro").html(JSON.stringify(jqXHR));
            }
        });      

    }

</script>


<div id="error-registro">

</div>

<form id="form-datos-salida" action="administrador/movimientos/registro.php" method="POST">

    <input type="hidden" name="tipo-movimiento" class='tipo-movimiento' id="tipo-movimiento" value='salida' />

    <div class="datos">
        <input type="text" placeholder="Codigo" name="Id[]" onkeyup="busquedaCodigoSalida($(this))" required/>
        <input type="text" placeholder="Producto" name="Producto[]"/>
        <input type="text" placeholder="tipo" name="tipo[]"/>
        <input type="text" placeholder="Descripcion" name="Descripcion[]" />  
        <input type="text" placeholder="talla" name="talla[]" />  
        <input type="text" placeholder="Cantidad" name="Cantidad[]" required/><hr class="soften"/><p> 
    </div>

    <p id='acciones-form-datos-salida'><input type="button" onclick="agregarSalida();" class="btn btn-primary" value="Agregar" />            
        <input type="submit" value="cargar datos" class="btn btn-success" name="nuevoprod" /> <input class="btn btn-danger" type="reset" value="limpiar"/>
    </p>
</form>