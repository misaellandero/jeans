<script language="javascript"> 

    function sumatoriaSalidasStock() {
        var totalDocenas = 0, totalUnidades = 0;
        $("#ingreso-datos-salida > tbody > tr").each(function(key, value) {
            valor = parseInt($(this).find("td:eq(6) input").val());
            if (valor === 12) {
                totalDocenas++;
            } else if(valor === 1) {
                totalUnidades++;
            }
        });
        $("#suma-salidas-stock").html('Totales: ' + totalDocenas + ' Docenas || ' + totalUnidades + ' Unidades');
    }

    function eliminarSalida(obj){
        obj.closest("tr").remove();
        sumatoriaSalidasStock();
    }

    function iniciarCapturaSalida(){
        var statesDemos = {
            state0: {
                title: 'Capture Docenas',
                html:'<label><input type="text" id="codigo-a-buscar-salida" onkeyup="busquedaCodigoSalida(event.keyCode, $(this) ,12)" autofocus>Codigo</label>',
                buttons: { OK: 1 },
                focus: 1,
                submit:function(e,v,m,f){

                    $.prompt.goToState("state1");

                    e.preventDefault();
                    
                }
            },
            state1:{
                title: 'Productos Sueltos',
                html:'<p>Existe algun producto Suelto?</p><label><input type="text" id="codigo-a-buscar-suelto-salida" onkeyup="busquedaCodigoSalida(event.keyCode, $(this),1)">Codigo</label>',
                buttons: { TerminarCaptura: 1 },
                focus: 1,
                submit:function(e,v,m,f){
                    
                    $.prompt.close();

                    e.preventDefault();
                    
                }  
            }

        }

        $.prompt(statesDemos,{
            loaded: function(){
                $("#codigo-a-buscar-salida").focus();
            }
        });

    }
    

    function busquedaCodigoSalida(tecla, obj,cantidad){
            
            var $this = obj;
            if ($this.val() !== "" && $this.val().length >= 13 && tecla != 17){
                $.ajax({
                    url: 'administrador/movimientos/registroAjax.php',
                    type: 'post',
                    data: { 'codigoBarras': $this.val(),'action' : 'entradasKeyUp'},
                    dataType: 'json',
                    success: function (data) {
                        console.log(data);
                        if (data.success) {
                            campos = "<tr>"
                                +"<td><button type='button' class='btn btn-danger' onclick=eliminarSalida($(this))>Eliminar</button><p></td>"
                                +"<td><input type='hidden' placeholder='Codigo' name='Id[]' value='" +  $this.val() + "' />" + $this.val() + "</td>"
                                +"<td><input type='hidden' placeholder='Producto' name='Producto[]' value='" +  data.Producto + "' />" +  data.Producto + "</td>"
                                +"<td><input type='hidden' placeholder='tipo' name='tipo[]' value='" +  data.Tipo + "' />" +  data.Tipo + "</td>"
                                +"<td><input type='hidden' placeholder='Descripcion' name='Descripcion[]' value='" +  data.Descripcion + "' />" +  data.Descripcion + "</td>"
                                +"<td><input type='hidden' placeholder='talla' name='talla[]' value='" +  data.Talla + "' />" +  data.Talla + "</td>"
                                +"<td><input type='hidden' placeholder='cantidad' name='cantidad[]' value='" +  cantidad + "' />" +  cantidad + "</td>"
                                +"</tr>";

                                if ($("#form-datos-salidas").find("#ingreso-datos-salidas > tbody > tr:eq(0) > td:eq(0)").attr('class') === 'dataTables_empty') {
                                    $("#form-datos-salidas").find("#ingreso-datos-salidas > tbody > tr:eq(0)").remove();
                                }

                                $("#form-datos-salidas").find("#ingreso-datos-salida > tbody").append(campos);                                

                                $("#error-registro-salida").html('');

                                sumatoriaSalidasStock();
                        }

                        $this.val('');

                    },
                    error: function (jqXHR, textStatus, errorThrown){
                        $("#error-registro-salida").html(JSON.stringify(jqXHR));
                    }
                });    

                
            }
        
    }

</script>


<div id="error-registro-salida">

</div>

<form id="form-datos-salidas" action="administrador/movimientos/registro.php" method="POST">

    <input type="hidden" name="tipo-movimiento" class='tipo-movimiento' id="tipo-movimiento" value='salida' />

    <div class="datos">
         <table id="ingreso-datos-salida" class='table'>
            <thead>
                <tr>
                    <th>Acciones</th>
                    <th>Codigo</th>
                    <th>Producto</th>
                    <th>Tipo</th>
                    <th>Descripcion</th>
                    <th>Talla</th>
                    <th>Cantidad</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>

  <p id='acciones-form-datos-salida'><input type="button" onclick="iniciarCapturaSalida();" class="btn btn-primary" value="Agregar" /><p align="right">
    <input type="submit" value="cargar datos" class="btn btn-success" name="nuevoprod" />
    </p>
</form>

<h3 id="suma-salidas-stock">Totales: 0 Docenas || 0 Unidades</h3>