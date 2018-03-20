//  Sistema de Inventarios Para la empresa Tynno Jeans
// Tec. en Informática Francisco Misael Landero Ychante
// Versión 3. ultima actualización 21/11/2014

$(document).ready(function() {


function ImageExist(url)
{
   var image = new Image();
image.src = "http://localhost:81/stock/" + url;
if (image.width === 0) {
  alert("no image");
}
}

// Imagenes Rotas o link caido

// Script para sustituir imágenes rotas con una imagen por defaul
function ImagenOk(img) {
if (!img.complete) return false;
if (typeof img.naturalWidth != "undefined" && img.naturalWidth == 0) return false;
return true;
}
function RevisarImagenesRotas() {
// Dirección de la Imagen por default que remplaza link caido
var replacementImg = "images/ind.jpg";
for (var i = 0; i < document.images.length; i++) {
if (!ImagenOk(document.images[i])) {
document.images[i].src = replacementImg;
}}}
window.onload=RevisarImagenesRotas;

// Fin

// Previsualización de La imagen cargada
// Para generar una vista previa en el formulario de carga

           function mostrarImagen(input) {
 if (input.files && input.files[0]) {
  var reader = new FileReader();
  reader.onload = function (e) {
//Etiqueta Destino
   $('#img_destino').attr('src', e.target.result);
  }
  reader.readAsDataURL(input.files[0]);
 }
}
//Etiqueta origen

$("#archivo").change(function(){
 mostrarImagen(this);
});


// Fin

// Scrip Generador de Codigos de Barra ean13

var menuTimer = [];
						var menuLocked = [];
						function menuHideAndLockYoyo($this){
							var id = $this.attr("id");
							menuLocked[id] = true;
							clearTimeout(menuTimer[id]);
							$(".menu-item-block", $this).slideUp("fast", function(){setTimeout("menuLocked['"+$(this).parent().attr("id")+"'] = false;", 20);});
						}
function computeEAN13(value){
			var sum = 0,
				odd = true;
			for(i=11; i>-1; i--){
				sum += (odd ? 3 : 1) * parseInt(value.charAt(i));
				odd = ! odd;
			}
			return (10 - sum % 10) % 10;
		}
$(function(){
$(".menu-item").each(function(){
									menuLocked[$(this).attr("id")] = false;
									$(this).hover(
										function(){
											var $this = $(this);
											var id = $this.attr("id");
											if ( menuLocked[id] ) return;
											$(".menu-item-block", $this).slideDown("fast");
											menuTimer[id] = setTimeout("menuHideAndLockYoyo($(\"#" + id + "\"));", 15000);
										},
										function(){
											menuHideAndLockYoyo($(this));
										}
									);
								});

								$(".menu-item-block-item")
									.click(function(){ window.location.href = $("a", $(this)).attr("href"); })
									.hover(function(){$(this).addClass("hover");}, function(){$(this).removeClass("hover");});


								$(".language")
								    .each(function(){
								        var $this = $(this);
								        var url = $("a", $this).attr("href");
								        $this.click(function(){ window.location.href = url });
								        $this.html("");
								    });
$("#ean13Message")
			.keyup(function(){
				var $this = $(this),
					text = $this.val(),
					filtered = "",
					c = '';
				for(var i=0; i<text.length; i++){
					c = text.charAt(i);
					if ( (c >= '0') && (c <= '9') ){
						filtered += c;
					}
				}
				$this.val(filtered);
				if (filtered.length == 12){
					$("#ean13Checksum").html( computeEAN13(filtered) );
				} else {
					$("#ean13Checksum").html("");
				}
			});

		//$("#ean13Target").barcode("2109876543210", "ean13");

//Selección de la Etiquete que contiene el codigo en numero de 12 digitos
		$("#Id")
			.keyup(function(){
				var $this = $(this),
					text = $this.val(),
					filtered = "",
					c = '';
				for(var i=0; i<text.length; i++){
					c = text.charAt(i);
					if ( (c >= '0') && (c <= '9') ){
						filtered += c;
					}
				}
				$this.val(filtered);
				if (filtered.length >= 12){
					$("#ean13Target").barcode(filtered, "ean13");
					$("#registro-producto").find("#Id").val($("#ean13Target").find("div").last().html());
					$("#registro-producto").find("#id-hidden").val($("#registro-producto").find("#id-hidden").val());
				} else {
					$("#ean13Target").html("");
				}
			});

		});

	$('.nav li:eq(0)').on('click', function(e) {
		e.preventDefault();

		fnClaveSugerida();

		$(this).addClass('active').nextAll('li').removeClass('active');

		$('section article').hide();
		$('section article:eq(0)').show();
// Etiqueta de Destino
		$('#titleContent').text('Registrar Articulo');
	})

	$('.nav li:eq(1)').on('click', function(e) {
		e.preventDefault();

	$(this).addClass('active').prevAll('li').removeClass('active');
		$(this).addClass('active').nextAll('li').removeClass('active');

		$('section article').hide();
		$('section article:eq(1)').show();

		$('#titleContent').text('Buscar Articulo');

	})
	$('.nav li:eq(2)').on('click', function(e) {
		e.preventDefault();

		$(this).addClass('active').prevAll('li').removeClass('active');
		$(this).addClass('active').nextAll('li').removeClass('active');

		$('section article').hide();
		$('section article:eq(2)').show();

		$('#titleContent').text('Editar o Agregar Datos');

	})
	$('.nav li:eq(3)').on('click', function(e) {
		e.preventDefault();

		$(this).addClass('active').prevAll('li').removeClass('active');
		$(this).addClass('active').nextAll('li').removeClass('active');

		$('section article').hide();
		$('section article:eq(3)').show();

		$('#titleContent').text('Entradas al Inventario');

	})
	$('.nav li:eq(4)').on('click', function(e) {
		e.preventDefault();

		$(this).addClass('active').prevAll('li').removeClass('active');
		$(this).addClass('active').nextAll('li').removeClass('active');

		$('section article').hide();
		$('section article:eq(4)').show();

		$('#titleContent').text('Salidas al Inventario');
			})

	$('.nav li:eq(5)').on('click', function(e) {
		e.preventDefault();

		$(this).addClass('active').prevAll('li').removeClass('active');
		$(this).addClass('active').nextAll('li').removeClass('active');

		$('section article').hide();
		$('section article:eq(5)').show();

		$('#titleContent').text('Rollos');
		})

			$('.nav li:eq(6)').on('click', function(e) {
		e.preventDefault();

		$(this).addClass('active').prevAll('li').removeClass('active');
		$(this).addClass('active').nextAll('li').removeClass('active');

		$('section article').hide();
		$('section article:eq(6)').show();

		$('#titleContent').text('Movimientos');


	})
//Fin

		$.ajax({
			url: './includes/process.php',
			type: 'post',
			data: { tag: 'getData'},
			dataType: 'json',
			success: function (data) {
				if (data !== null && data.success) {
					var totalRollos = 0, totalMetros = 0;
					$.each(data, function (index, record) {
						if ($.isNumeric(index)) {
							var row = $("<tr data-rollos='" + record.rollos + "' data-id=" + record.id + " />");
							$("<td />").text(record.codigo).appendTo(row);
							$("<td data-id-proveedor = " + record.num_proveedor + " />").text(record.proveedor).appendTo(row);
							$("<td />").text(record.tipo).appendTo(row);
							$("<td />").text(record.nombre).appendTo(row);
							$("<td />").text(record.metros).appendTo(row);
							$("<td />").text(record.composicion).appendTo(row);
							$("<td />").text(record.campo1).appendTo(row);
							$("<td />").text(record.ancho).appendTo(row);
							$("<td />").text(record.color).appendTo(row);
							$("<td />").text(record.img).appendTo(row);
							$("<td />").text(record.date).appendTo(row);
							row.appendTo("#tSearch");

							if ($.isNumeric(record.metros) && $.isNumeric(record.rollos)) {
								totalMetros += parseInt(record.metros);
								totalRollos += parseInt(record.rollos);
							}
						}
					})
					$("#totales-busqueda-fabrics").html('Totales: ' + totalRollos + ' Rollos || ' + totalMetros + ' Metros');
				}


	var table = $('table').dataTable({
			"bJQueryUI" : true,
			"bRetrieve" : true,
			"iDisplayLength": 20,
 			"aaSorting": [[ 4, "desc" ]]
		})

	$('#tSearch_filter > label > input[type="text"]').keyup(function(){
		var totalRollos = 0, totalMetros = 0;
		$('table > tbody > tr').each(function(){
			if ($.isNumeric($(this).find('td:eq(4)').html()) && $.isNumeric($(this).data('rollos'))) {
				totalMetros += parseFloat($(this).find('td:eq(4)').html());
				totalRollos += parseInt($(this).data('rollos'));
			}
		});

		$("#totales-busqueda-fabrics").html('Totales: ' + totalRollos + ' Rollos || ' + totalMetros + ' Metros');
	});

		/*$.ajax({
			url: './includes/processr.php',
			type: 'post',
			data: { tag: 'getData'},
			dataType: 'json',
			success: function (data) {
				if (data !== null && data.success) {
					$.each(data, function (index, record) {
						if ($.isNumeric(index)) {
							var row = $("<tr data-id=" + record.id + " />");
							$("<td />").text(record.id).appendTo(row);
							$("<td />").text(record.codigo).appendTo(row);
							$("<td />").text(record.id_art_telas).appendTo(row);
							$("<td />").text(record.metros).appendTo(row);
							$("<td />").text(record.fecha_creacion).appendTo(row);
							row.appendTo("#tSearchr");
						}
					})
				}

/*$('#tp').dataTable({
					 "paging":   false,
        "ordering": false,
        "info":     false

				})*/

				var etiquetas = function(fecha){
					fecha = fecha || 'Todos';
					$.ajax({
						url: './includes/process.php',
						type: 'post',
						data: { 'id-tela' : tr.data('id'), 'fecha' : fecha, 'tag' : 'busqueda' },
						dataType: 'json',
						success: function(data) {
							var fechas = [];
							var rollo = '';
							var options = '<option value="Todos">Todos</option>';

							var totalRollos = 0, totalMetros = 0;
							if (data !== null) {
								$.each(data, function(i, item){
									rollo += '<hr style="border:1px dashed black;"><div class="rollos-busqueda" style="width:100%;">'
										+ '<div class="contenedor">'
										+ '<div>Rollo</div>'
										+ '<div><span class="tipo" style="display:none"> ' + tr.find("td:eq(2)").html() + '</span></div>'
										+ '<div><span class="tipo" style="display:none"> ' + tr.find("td:eq(3)").html() + '</span></div>'
										+ '<div><span class="tipo"> ' + item.fecha_creacion +'</span> </div>'
										+ '<div class="item-metros"><span>' + item.metros + '</span> Metros <span class="tipo" style="display:none"> #np:' + tr.find("td:eq(1)").data('idProveedor') + '</span></div>'
										+ '<div class="color" style="display:none"><span>' + tr.find("td:eq(8)").html() + '</span></div>'
										+ '<span class="codigo">' + item.codigo + '</span>'
										+ '<div class="rollo-codigo-busqueda"></div>'
										+ '<div class="item-compo" style="display:none"><span>' + tr.find("td:eq(5)").html() + '</span></div>'
										+ '<div class="item-anchura" style="display:none">' + tr.find("td:eq(7)").html() + ' de Anchura</span></div>'
										+ '<input type="button" class="btn btn-success imprimir" value="Imprimir"></div></div>';

									if (fecha === 'Todos' && $.inArray(item.fecha_creacion, fechas) < 0) {
										fechas.push(item.fecha_creacion);
										options += '<option value="' + item.fecha_creacion + '">' + item.fecha_creacion + '</option>';
									}

									totalMetros += parseInt(item.metros);
									totalRollos++;

								});
							}

							$("#totales-busqueda-fabrics").html('Totales: ' + totalRollos + ' Rollos || ' + totalMetros + ' Metros');

							if (fecha === 'Todos') {
								$("#fechas-imprimir").html(options);
							}

							$('#rollos-telas-busqueda').html(rollo);

							$('.rollos-busqueda').each(function(){
								var codigo = $(this).find('.codigo').html();
								$(this).find('.rollo-codigo-busqueda').barcode(codigo, 'ean13');
								$(this).find('.imprimir').click(function(){
									var ob = $(this).closest('.rollos-busqueda').clone();

									ob.find('.imprimir').remove();
									ob.find(".tipo").show();
									ob.find(".color").show();
									ob.find(".item-anchura").show();
									// ob.find('.rollo-codigo-busqueda').attr("style", "width:10%;margin-left:45%");
									ob.find(".item-compo").attr("style", "");
									w=window.open();
									w.document.write($("head").html());
									w.document.write("<div style='margin-left:20px;margin-top:-60px;'></div>")
                  w.document.write("<table style='text-align:center;margin-top:-50px'><tr><td style='height:288px;white-space:nowrap'>" + ob.html() + "</td></tr></table>");

									w.document.write("<table style='text-align:center;margin-top:-50px'><tr><td style='height:288px;white-space:nowrap'>" + ob.html() + "</td></tr></table>");
									w.document.write("<div><input type='button' value='Imprimir' class='btn btn-success' onclick='window.print();'></div>");
								})
							});

						},
						error: function (jqXHR, textStatus, errorThrown){
	                      alert(JSON.stringify(jqXHR));
	                  }
					});
				}

				$("#tSearch > tbody")
					.on( 'mouseover', 'tr', function () {
			            $(this).attr('style' , 'background-color: whitesmoke');
			        } )
			        .on( 'mouseleave','tr', function () {
			            $(this).attr('style' , '');
			        } );

			    var tr;
				$("#tSearch > tbody").on('click','tr',function(){
					tr = $(this);

					var nombreArchivo = tr.find("td:eq(9)").html();
					nombreArchivo = nombreArchivo.substr(nombreArchivo.indexOf('/') + 1);
					nombreArchivo = nombreArchivo.substr(0, nombreArchivo.indexOf('.'));

					$("#nombrer-update-image").val(nombreArchivo);
					$("#nombre-image-anterior-update").val(tr.find("td:eq(9)").html());
					$("#id-art-update-image").val(tr.find("td:eq(0)").html());

					$("#ancho-update-ancho").val(tr.find("td:eq(7)").html());
					$("#color-update-color").val(tr.find("td:eq(8)").html());



					$('#aSearch .row-fluid').show();
					$("#img_destino_articulo_imprimir").attr("src","/PC/fabrics/" + tr.find("td:eq(9)").html()).error(function() {
    					$(this).attr("src","images/ind.jpg");
					});

					var tit = "<h2>Tela " + tr.find("td:eq(0)").html() + "</h2>"
					+ "<h4>" + tr.find("td:eq(5)").html()
					+ "<h4>" + tr.find("td:eq(1)").html() + " " + tr.find("td:eq(2)").html() + "</h4>"
					+ "<h4>" + tr.find("td:eq(3)").html() + " " + tr.find("td:eq(4)").html() + "</h4>";

					$("#titulo-telas-busqueda").html(tit);

					etiquetas();

				});

				$("#fechas-imprimir").change(function(event) {
					etiquetas($(this).val());
				});

			}
		});

	$("#ver-codigo").click(function(){

		var cod = $('#rollos-telas-busqueda').clone()
		cod.find(".rollos-busqueda").attr("style", "height:280px");
		cod.find(".tipo").show();
		cod.find(".color").show();
		cod.find(".item-anchura").show();
		cod.find('.imprimir').remove();

		cod.find(".item-compo").attr("style", "");

		w=window.open();
		w.document.write($("head").html());
		w.document.write("<div style='margin-left:20px;margin-top:-60px;'></div>")
		w.document.write("<table style='text-align:center;margin-top:-50px'><tr><td style='white-space:nowrap'>" + cod.html() + '<hr style="border:1px dashed black;"></td></tr></table>');
		w.document.write("<div><input type='button' value='Imprimir' class='btn btn-success' onclick='window.print();'></div>");

		RevisarImagenesRotas();

	});

$("#cambiar").click(function(){
		w=window.open();
		w.document.write($("head").html());
		w.document.write("<?php include 'upload.php'?>")

		RevisarImagenesRotas();

	});

	$("#ver-codigo-solo").click(function(){
		w=window.open();
		w.document.write($("head").html());
w.document.write("<div style='margin-left:20px;margin-top:-60px;'></div>")

		var cod = $('#contenido-imprimir-codigo').clone();
		var codigoB = cod.find("#ean13Target2").parent().parent().clone();
		codigoB.find("img").remove();
		codigoB.find("header").remove();

		cod.find("#ean13Target2").parent().parent().find("header").remove();
		cod.find("#ean13Target2").parent().remove();

		var talla = cod.find("#talla-imprimir");
		talla.find("h4").remove();

		var producto = cod.find("#producto-imprimir");
		producto.find("h4").remove();

		var tipo = cod.find("#tipo-imprimir");
		tipo.find("h4").remove();

		var descripcion = cod.find("#descripcion-imprimir");
		descripcion.find("h4").remove();

		var tela = cod.find("#tela-imprimir");
		tela.find("h4").remove();

		var corte = cod.find("#corte-imprimir");
		corte.find("h4").remove();

	var NC = cod.find("#NC-imprimir");
		NC.find("h4").remove();

		cod.find("#talla-imprimir").remove();
		cod.find("#unidad-imprimir").remove();
		cod.find("#cantidad-imprimir").remove();
		cod.find("#corte-imprimir").remove();
		cod.find("#img_destino_articulo_imprimir").remove();

		w.document.write("<table style='margin-left:20px;margin-top:-60px;'><tr><td style='overflow:hidden;white-space:nowrap;'>" + producto.html() + "<br>" + tipo.html() + "<br>" + tela.html() + "<br>" + descripcion.html() + " TALLA:" + talla.html()+ "<br>"+ "Corte:" + corte.html() +". #:" + NC.html() +"<div style='margin-left:45'>" + codigoB.html() + "</div><select style='width:150px;'><option>DOCENA</option><option>UNIDAD</option></select><p> www.TynnosJeans.com </td></tr></table>");
		w.document.write("<div><input type='button' value='Imprimir' class='btn btn-success' onclick='window.print();'></div>");

		//w.document.write("<table style='width:389px;height:287px;float:left;text-align:center;font-size:10px;table-layout:fixed;'><tr style='height:287px'><td style='overflow:hidden;white-space:nowrap;'>" + producto.html() + "<br>" + tipo.html() + "<br>" + tela.html() + "<br>" + corte.html() + "<br>" + "<div style='margin-left:135px'>" + codigoB.html() + "</div></td></tr></table>");

	});

	var MYVALOR = $("#Id").val();



$("#searchBarcode").barcode(MYVALOR, "ean13",{barWidth:1, barHeight:50, output: "canvas"});

	function changeImage(input, form, divContent, rotar) {

		file = input.files[0];

		canvasResize(file, {
	        width: 400,
	        height: 400,
	        crop: false,
	        quality: 50,
	        rotate: rotar,
	        callback: function(data, width, height) {

	        	form.find('.data_img').val(data);
	        	form.find('.name_img').val(file.name);

	            $("#" + divContent).attr("src", data).error(function() {
					$(this).attr("src","images/ind.jpg");
				});

	        }
	    });
	}

	$('#registro-producto').find('.rotar-imagen').click(function(event) {

		var form = $(this).closest('form');
		var input = form.find('#archivo')[0];
		var divContent = "img_destino";
		var rotacion = $(this).data('rotar');

		if(input.files.length > 0) {
			changeImage(input, form, divContent, rotacion);
		} else {
			alert("Por favor agrega una imagen primero");
		}
	});

	$('#archivo').change(function(e) {

		var input = this;
		var form = $(this).closest('form');
		var divContent = "img_destino";

		changeImage(input, form, divContent, 0);

	});

	$('#archivo-update').change(function(e) {

		var input = this;
		var form = $(this).closest('form');
		var divContent = "img_destino_articulo_imprimir";

		changeImage(input, form, divContent, 0);

	});

	$('#registroi').find('.rotar-imagen').click(function(event) {

		var form = $(this).closest('form');
		var input = form.find('#archivo-update')[0];
		var divContent = "img_destino_articulo_imprimir";
		var rotacion = $(this).data('rotar');

		if(input.files.length > 0) {
			changeImage(input, form, divContent, rotacion);
		} else {
			alert("Por favor agrega una imagen primero");
		}
	});

	$('#registro-producto').submit(function(event) {

		var data = $(this).find('.data_img').val();
		var name = $(this).find('.name_img').val();
		var action = $(this).data('action');

		var fd = new FormData();
        var f = canvasResize('dataURLtoBlob', data);
        f.name = name;
        fd.append("nombre", $(this).find('#nombre').val());
        fd.append("archivo", f);
        fd.append("name_image", name);

        fd.append("id-hidden", $(this).find('#id-hidden').val());
        fd.append("proveedor", $(this).find('#proveedor option:selected').html());
        fd.append("tipo", $(this).find('#tipo option:selected').html());
        fd.append("tela", $(this).find('#tela option:selected').html());
        fd.append("metros-ancho", $(this).find('#metros-ancho').val());
        fd.append("color-visible", $(this).find('#color-visible').val());
        fd.append("campo1", $(this).find('#campo1').val());

        fd.append("compo-telap1", $(this).find('#compo-telap1').val());
        fd.append("compo-tela-s1", $(this).find('#compo-tela-s1 option:selected').html());

        fd.append("compo-telap2", $(this).find('#compo-telap2').val());
        fd.append("compo-tela-s2", $(this).find('#compo-tela-s2 option:selected').html());

        fd.append("compo-telap3", $(this).find('#compo-telap3').val());
        fd.append("compo-tela-s3", $(this).find('#compo-tela-s3 option:selected').html());

        fd.append("compo-telap4", $(this).find('#compo-telap4').val());
        fd.append("compo-tela-s4", $(this).find('#compo-tela-s4 option:selected').html());

        $.each($(this).find(".rollos-registro"), function(i, obj) {
		    fd.append('id-rollo-hidden['+i+']', $(this).find('.id-rollo-hidden').val());
		    fd.append('metros-rollo['+i+']', $(this).find('.metros-rollos-registro').val());
		});

        $.ajax({
		    url: 'registro.php',
		    data: fd,
		    cache: false,
		    contentType: false,
		    processData: false,
		    type: 'POST',
		    success: function(data){
		        alert(data);
		        window.location='entrar.php'
				// event.preventDefault();
		    },
		    error: function (jqXHR, textStatus, errorThrown){
                alert(JSON.stringify(jqXHR));
            }
		});
		event.preventDefault();
	});

	$('#registroi').submit(function(event) {

		var data = $(this).find('.data_img').val();
		var name = $(this).find('.name_img').val();
		var action = $(this).data('action');

		var fd = new FormData();
        var f = canvasResize('dataURLtoBlob', data);
        f.name = name;
        fd.append("nombre", $(this).find('#nombre').val());
        fd.append("archivo", f);
        fd.append("name_image", name);

        fd.append("id-art", $(this).find('#id-art-update-image').val());
        fd.append("nombre-image-anterior", $(this).find('#nombre-image-anterior-update').val());
        fd.append("nombrer", $(this).find('#nombrer-update-image').val());

        fd.append("ancho", $(this).find('#ancho-update-ancho').val());
        fd.append("color", $(this).find('#color-update-color').val());

        $.ajax({
		    url: 'registroi.php',
		    data: fd,
		    cache: false,
		    contentType: false,
		    processData: false,
		    type: 'POST',
		    success: function(data){
		        window.print();
		        alert(data);
		        window.location='entrar.php'
				// event.preventDefault();
		    },
		    error: function (jqXHR, textStatus, errorThrown){
                alert(JSON.stringify(jqXHR));
            }
		});
		event.preventDefault();
	});

})
