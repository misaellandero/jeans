//  Sistema de Inventarios Para la empresa Tynno Jeans
// Tec. en Informática Francisco Misael Landero Ychante
// Versión 3. ultima actualización 21/11/2014

$(document).ready(function() {


setTimeout(function(){
		$('body').addClass('loaded');
		$('h1').css('color','#222222');
	}, 3000);


function ImageExist(url)
{
   var image = new Image();
image.src = "" + url;
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

		$('#titleContent').text('Movimientos de Inventario');

	})
//Fin

		$.ajax({
			url: './includes/process.php',
			type: 'post',
			data: { },
			dataType: 'json',
			success:  function (data) { 
				if (data.success) {
					var totalDocenas = 0.00, totalUnidades = 0;
					$.each(data, function (index, record) {
						if ($.isNumeric(index)) {
							var row = $("<tr />");
							$("<td />").text(record.Id).appendTo(row);
							$("<td />").text(record.Producto).appendTo(row);
							$("<td />").text(record.Tipo).appendTo(row);
							$("<td />").text(record.Descripcion).appendTo(row);
							$("<td />").text(record.NC).appendTo(row);
							$("<td />").text(record.Cantidad).appendTo(row);
							$("<td />").text(record.Docenas).appendTo(row);
							$("<td />").text(record.Talla).appendTo(row);
							$("<td />").text(record.Tela).appendTo(row);
							$("<td />").text(record.img).appendTo(row);
							$("<td />").text(record.Corte).appendTo(row);
							row.appendTo("#tSearch");
						}

						if ($.isNumeric(record.Docenas) && $.isNumeric(record.Cantidad)) {
							totalDocenas += parseFloat(record.Docenas);
							totalUnidades += parseInt(record.Cantidad);
						}

					});

					$("#suma-busqueda-stock").html('Totales: ' + totalDocenas.toFixed(2) + ' Docenas || ' + totalUnidades + ' Unidades');

				}


	var table = $('table').dataTable({
			"bJQueryUI" : true,
			"bRetrieve" : true,
			"iDisplayLength": 20,
			"dom": 'T<"clear">lfrtip',
 "aaSorting": [[ 5, "desc" ]]
		})



	$('#tSearch_filter > label > input[type="text"]').keyup(function(){
		var totalDocenas = 0.00, totalUnidades = 0;
		$('table > tbody > tr').each(function(){
			if ($.isNumeric($(this).find('td:eq(6)').html()) && $.isNumeric($(this).find('td:eq(5)').html())){
				totalDocenas += parseFloat($(this).find('td:eq(6)').html());
				totalUnidades += parseInt($(this).find('td:eq(5)').html());
			}
		});

		$("#suma-busqueda-stock").html('Totales: ' + totalDocenas.toFixed(2) + ' Docenas || ' + totalUnidades + ' Unidades');
	});
				$("	#tSearch > tbody")
					.on( 'mouseover', 'tr', function () {
			            $(this).attr('style' , 'background-color: whitesmoke');
			        } )
			        .on( 'mouseleave','tr', function () {
			            $(this).attr('style' , '');
			        } );

				$("#tSearch > tbody").on('click','tr',function(){
					var tr = $(this);

					var nombreArchivo = tr.find("td:eq(9)").html();
					nombreArchivo = nombreArchivo.substr(nombreArchivo.indexOf('/') + 1);
					nombreArchivo = nombreArchivo.substr(0, nombreArchivo.indexOf('.'));

					$("#nombrer-update-image").val(nombreArchivo);
					$("#nombre-image-anterior-update").val(tr.find("td:eq(9)").html());
					$("#id-art-update-image").val(tr.find("td:eq(0)").html());

					$('#aSearch .row-fluid').show();

					$("#img_destino_articulo_imprimir").attr("src","" + tr.find("td:eq(9)").html()).error(function() {
    					$(this).attr("src","images/ind.jpg");
					});


					var text = tr.find("td:eq(0)").html(),
					filtered = "",
					c = '';
					for(var i=0; i<text.length; i++){
						c = text.charAt(i);
						if ( (c >= '0') && (c <= '9') ){
							filtered += c;
						}
					}

					if (filtered.length >= 12){
						$("#ean13Target2").barcode(filtered, "ean13");
					} else {
						$("#ean13Target2").html("");
					}

					var datos = "<div id='producto-imprimir'><h4 id='producto-h4'>Producto</h4>" + tr.find("td:eq(1)").html() + "</div>"
					+"<div id='codigo-imprimir'><h4>ID</h4>" + tr.find("td:eq(0)").html() + "</div>"
					+"<div id='tipo-imprimir'><h4>Tipo</h4>" + tr.find("td:eq(2)").html() + "</div>"
					+"<div id='descripcion-imprimir'><h4>Descripcion</h4>" + tr.find("td:eq(3)").html()+ "</div>"
					+"<div id='unidad-imprimir'><h4>Docenas</h4>" + tr.find("td:eq(6)").html()+ "</div>"
					+"<div id='cantidad-imprimir'><h4>Cantidad</h4>" + tr.find("td:eq(5)").html()+ "</div>"
					+"<div id='talla-imprimir'><h4>Talla</h4>" + tr.find("td:eq(7)").html()+ "</div>"
					+"<div id='tela-imprimir'><h4>Tela</h4>" + tr.find("td:eq(8)").html()+ "</div>"
					+"<div id='corte-imprimir'><h4>Corte</h4>" + tr.find("td:eq(4)").html()+ "</div>"
+"<div id='NC-imprimir'><h4>NC</h4>" + tr.find("td:eq(10)").html()+ "</div>";;

					$("#datos-codigo").html(datos);

					$("#suma-busqueda-stock").html('Totales: ' + tr.find("td:eq(6)").html() + ' Docenas || ' + tr.find("td:eq(5)").html() + ' Unidades');

					//RevisarImagenesRotas();
				});

			}
		});

	$("#ver-codigo").click(function(){
		w=window.open();
		w.document.write($("head").html());
		w.document.write("<div style='margin-left:20px;margin-top:50px;'><input type='button'  value='Imprimir' class='btn btn-success' onclick='window.print();'></div>")
		w.document.write($('#contenido-imprimir-codigo').html());

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

		w.document.write("<table style='text-align:center;margin-top:-50px'><tr><td style='overflow:hidden;white-space:nowrap'>"+ "<h4>"+producto.html()+ "<br>" + tipo.html() + "<br>" + tela.html() + "<br>" + descripcion.html()+" TALLA:" + talla.html()+ "<br>"+ "Corte:" + corte.html() +". #:" + NC.html() +"<div style='margin-left:45'>" +"</h4>"+ codigoB.html() + "</div><select style='width:150px;'><option>DOCENA</option><option>UNIDAD</option></select><p> www.TynnosJeans.com </td></tr></table>");
		w.document.write("<div><input type='button' value='Imprimir' class='btn btn-success' onclick='window.print();'></div>");

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
        fd.append("producto", $(this).find('#producto option:selected').html());
        fd.append("tipo", $(this).find('#tipo option:selected').html());
        fd.append("Descripcion", $(this).find('#Descripcion option:selected').html());
        fd.append("talla", $(this).find('#talla option:selected').html());
        fd.append("tela", $(this).find('#tela option:selected').html());
        fd.append("Unidad", $(this).find('#unidad-registro').val());
        fd.append("Corte", $(this).find('#Corte').val());

        $.ajax({
		    url: 'registro.php',
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
