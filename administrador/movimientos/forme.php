<script language="javascript"> 

    function sumatoriaEntradasStock() {
        var totalDocenas = 0, totalUnidades = 0;
        $("#ingreso-datos > tbody > tr").each(function(key, value) {
            valor = parseInt($(this).find("td:eq(6) input").val());
            if (valor === 12) {
                totalDocenas++;
            } else if(valor === 1) {
                totalUnidades++;
            }
        });
        $("#suma-entradas-stock").html('Totales: ' + totalDocenas + ' Docenas || ' + totalUnidades + ' Unidades');
    }

    function eliminarEntrada(obj){
        obj.closest("tr").remove();
        sumatoriaEntradasStock();
    }

    function iniciarCapturaEntrada(){
        var statesDemos = {
            state0: {
                title: 'Capture Docenas',
                html:'<label><input type="text" id="codigo-a-buscar" onkeyup="busquedaCodigoEntrada(event.keyCode, $(this) ,12)">Codigo</label>',
                buttons: { OK: 1 },
                focus: 1,
                submit:function(e,v,m,f){

                    $.prompt.goToState("state1");

                    e.preventDefault();
                    
                }
            },
            state1:{
                title: 'Productos Sueltos',
                html:'<p>Existe algun producto Suelto?</p><label><input type="text" id="codigo-a-buscar-suelto" onkeyup="busquedaCodigoEntrada(event.keyCode, $(this),1)">Codigo</label>',
                buttons: { TerminarCaptura: 1 },
                focus: 1,
                submit:function(e,v,m,f){
                    
                    $.prompt.close();

                    e.preventDefault();
                    
                }  
            }

        }

        $.prompt(statesDemos, {
            loaded: function(){
                $("#codigo-a-buscar").focus();
            }
        });

    }
    

    function busquedaCodigoEntrada(tecla, obj, cantidad){        

            var $this = obj;
            if ($this.val() !== "" && $this.val().length == 13 && tecla != 17){
                $.ajax({
                    url: 'administrador/movimientos/registroAjax.php',
                    type: 'post',
                    data: { 'codigoBarras': $this.val(),'action' : 'entradasKeyUp'},
                    dataType: 'json',
                    success: function (data) {
                        if (data.success) {

                            campos = "<tr>"
                            +"<td><button type='button' class='btn btn-danger' onclick=eliminarEntrada($(this))>Eliminar</button><p></td>"
                            +"<td><input type='hidden' placeholder='Codigo' name='Id[]' value='" +  $this.val() + "' />" + $this.val() + "</td>"
                            +"<td><input type='hidden' placeholder='Producto' name='Producto[]' value='" +  data.Producto + "' />" +  data.Producto + "</td>"
                            +"<td><input type='hidden' placeholder='tipo' name='tipo[]' value='" +  data.Tipo + "' />" +  data.Tipo + "</td>"
                            +"<td><input type='hidden' placeholder='Descripcion' name='Descripcion[]' value='" +  data.Descripcion + "' />" +  data.Descripcion + "</td>"
                            +"<td><input type='hidden' placeholder='talla' name='talla[]' value='" +  data.Talla + "' />" +  data.Talla + "</td>"
                            +"<td><input type='hidden' placeholder='cantidad' name='cantidad[]' value='" +  cantidad + "' />" +  cantidad + "</td>"
                            +"</tr>";

                            if ($("#form-datos").find("#ingreso-datos > tbody > tr:eq(0) > td:eq(0)").attr('class') === 'dataTables_empty') {
                                $("#form-datos").find("#ingreso-datos > tbody > tr:eq(0)").remove();
                            }

                            $("#form-datos").find("#ingreso-datos > tbody").append(campos);

                            $("#error-registro").html('');

                            sumatoriaEntradasStock();
                        }

                        $this.val('');

                    },
                    error: function (jqXHR, textStatus, errorThrown){
                        $("#error-registro").html(JSON.stringify(jqXHR));
                        //alert(textStatus);
                    }
                });

            }
        
    }

</script>


<div id="error-registro">

</div>

<form id="form-datos" action="administrador/movimientos/registro.php" method="POST">

    <input type="hidden" name="tipo-movimiento" class='tipo-movimiento' id="tipo-movimiento" value='entrada' />

    <div class="datos">
        <table id="ingreso-datos" class='table'>
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

    <p id='acciones-form-datos'><input type="button" onclick="iniciarCapturaEntrada();" class="btn btn-primary" value="Agregar" /><p align="right">
      <input type="submit" value="cargar datos" class="btn btn-success" name="nuevoprod" />
    </p>
</form>

<h3 id="suma-entradas-stock">Totales: 0 Docenas || 0 Unidades</h3>

