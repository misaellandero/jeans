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
		$('#titleContent').text('Buscar Articulo');
	})

	$('.nav li:eq(1)').on('click', function(e) {
		e.preventDefault();

	$(this).addClass('active').prevAll('li').removeClass('active');
		$(this).addClass('active').nextAll('li').removeClass('active');
		
		$('section article').hide();
		$('section article:eq(1)').show();

		$('#titleContent').text('Registrar Articulo');

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
//Fin
		
		$.ajax({
			url: './includes/process.php',
			type: 'post',
			data: { tag: 'getData'},
			dataType: 'json',
			success: function (data) {
				if (data !== null && data.success) {
					$.each(data, function (index, record) {
						if ($.isNumeric(index)) { 
							var row = $("<tr data-id=" + record.id + " />");
							$("<td />").text(record.codigo).appendTo(row);
							$("<td data-id-proveedor = " + record.num_proveedor + " />").text(record.proveedor).appendTo(row);
							$("<td />").text(record.tipo).appendTo(row);
							$("<td />").text(record.nombre).appendTo(row);
							$("<td />").text(record.metros).appendTo(row);
							$("<td />").text(record.composicion).appendTo(row);
							$("<td />").text(record.campo1).appendTo(row);
							$("<td />").text(record.img).appendTo(row);
							$("<td />").text(record.date).appendTo(row);
							row.appendTo("#tSearch");
						}
					})
				}

				$('#tSearch').dataTable({
					   "bJQueryUI": true ,
					 "iDisplayLength": 20,
					 "order": [[ 5, "desc" ]]
				});
					
					/*$('#tp').dataTable({
					 "paging":   false,
        "ordering": false,
        "info":     false
                     
				})*/

				$("#tSearch > tbody")
					.on( 'mouseover', 'tr', function () {
			            $(this).attr('style' , 'background-color: whitesmoke');
			        } )
			        .on( 'mouseleave','tr', function () {
			            $(this).attr('style' , '');   
			        } );

				$("#tSearch > tbody").on('click','tr',function(){
					var tr = $(this);

					var nombreArchivo = tr.find("td:eq(7)").html();
					nombreArchivo = nombreArchivo.substr(nombreArchivo.indexOf('/') + 1);
					nombreArchivo = nombreArchivo.substr(0, nombreArchivo.indexOf('.'));

					$("#nombrer-update-image").val(nombreArchivo);
					$("#nombre-image-anterior-update").val(tr.find("td:eq(7)").html());
					$("#id-art-update-image").val(tr.find("td:eq(0)").html());

					$('#aSearch .row-fluid').show();
					$("#img_destino_articulo_imprimir").attr("src","/PC/fabrics/" + tr.find("td:eq(7)").html()).error(function() {
    					$(this).attr("src","images/ind.jpg");
					});

					var tit = "<h2>Tela " + tr.find("td:eq(0)").html() + "</h2>" 
					+ "<h4>" + tr.find("td:eq(5)").html()
					+ "<h4>" + tr.find("td:eq(1)").html() + " " + tr.find("td:eq(2)").html() + "</h4>"
					+ "<h4>" + tr.find("td:eq(3)").html() + " " + tr.find("td:eq(4)").html() + "</h4>";

					$("#titulo-telas-busqueda").html(tit);

					$.ajax({
						url: './includes/process.php',
						type: 'post',
						data: { 'id-tela' : tr.data('id'), 'tag' : 'busqueda' },
						dataType: 'json',
						success: function(data) {
							var rollo = '';
							$.each(data, function(i, item){
								rollo += '<hr style="border:1px dashed black;"><div class="rollos-busqueda" style="width:100%;">'
									+ '<div class="contenedor">'
									+ '<div>Rollo</div>'
									+ '<div><span class="tipo" style="display:none"> ' + tr.find("td:eq(2)").html() + '</span></div>'
									+ '<div><span class="tipo" style="display:none"> ' + tr.find("td:eq(3)").html() + '</span></div>'
									+ '<div class="item-metros"><span>' + item.metros + '</span> Metros <span class="tipo" style="display:none"> #np:' + tr.find("td:eq(1)").data('idProveedor') + '</span></div>'
									+ '<span class="codigo">' + item.codigo + '</span>'
									+ '<div class="rollo-codigo-busqueda"></div>'
									+ '<div class="item-compo" style="display:none"><span>' + tr.find("td:eq(5)").html() + '</span></div>'
									+ '<input type="button" class="btn btn-success imprimir" value="Imprimir"></div></div>';
							});

							$('#rollos-telas-busqueda').html(rollo);

							$('.rollos-busqueda').each(function(){
								var codigo = $(this).find('.codigo').html();
								$(this).find('.rollo-codigo-busqueda').barcode(codigo, 'ean13');
								$(this).find('.imprimir').click(function(){
									var ob = $(this).closest('.rollos-busqueda').clone();
									ob.find(".contenedor").attr("style", "text-align:center;font-size:19px;margin-top:-90px;")
									ob.find('.imprimir').remove();
									ob.find(".tipo").show();
									ob.find('.rollo-codigo-busqueda').attr("style", "width:7%;margin-left:45%");
									ob.find(".item-compo").attr("style", "");
									w=window.open();
									w.document.write($("head").html());
									w.document.write("<div style='margin-left:20px;margin-top:50px;'></div>")
									w.document.write(ob.html());
									w.document.write("<div><input type='button' value='Imprimir' class='btn btn-success' onclick='window.print();'></div>");
								})
							});

						},
						error: function (jqXHR, textStatus, errorThrown){
	                      alert(JSON.stringify(jqXHR));
	                  }
					});

				});

			}
		});

	$("#ver-codigo").click(function(){

		var cod = $('#rollos-telas-busqueda').clone()
		cod.find("hr").remove();
		cod.find(".tipo").show();
		cod.find('.imprimir').remove();
		cod.find(".contenedor").attr("style", "text-align:center;font-size:19px;margin-top:-90px;")
		cod.find('.rollo-codigo-busqueda').attr("style", "width:7%;margin-left:45%");
		cod.find(".item-compo").attr("style", "");

		w=window.open();		
		w.document.write($("head").html());
		// w.document.write("<div style='margin-left:20px;margin-top:50px;'></div>")
		w.document.write(cod.html() + '<hr style="border:1px dashed black;">');
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

		w.document.write("<table style='text-align:center;font-size:20px;margin-top:-8px'><tr><td style='overflow:hidden;white-space:nowrap;'>" + producto.html() + "<br>" + tipo.html() + "<br>" + tela.html() + "<br>" + descripcion.html() + " TALLA:" + talla.html()+ "<br>"+ "Corte:" + corte.html() +". #:" + NC.html() +"<div style='margin-left:45'>" + codigoB.html() + "</div><select style='width:150px;'><option>DOCENA</option><option>UNIDAD</option></select><p> www.TynnosJeans.com </td></tr></table>");
		w.document.write("<div><input type='button' value='Imprimir' class='btn btn-success' onclick='window.print();'></div>");

		//w.document.write("<table style='width:389px;height:287px;float:left;text-align:center;font-size:10px;table-layout:fixed;'><tr style='height:287px'><td style='overflow:hidden;white-space:nowrap;'>" + producto.html() + "<br>" + tipo.html() + "<br>" + tela.html() + "<br>" + corte.html() + "<br>" + "<div style='margin-left:135px'>" + codigoB.html() + "</div></td></tr></table>");

	});

	var MYVALOR = $("#Id").val();



$("#searchBarcode").barcode(MYVALOR, "ean13",{barWidth:1, barHeight:50, output: "canvas"}); 


	/* Incluir en los eventos de la TAB Search */

	$('form').on('submit', function() {
		
		
	})

})