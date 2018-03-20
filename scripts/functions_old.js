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
				if (data.success) {
					$.each(data, function (index, record) {
						if ($.isNumeric(index)) { 
							var row = $("<tr />");
							$("<td />").text(record.Id).appendTo(row);
							$("<td />").text(record.Producto).appendTo(row);
							$("<td />").text(record.Tipo).appendTo(row);
							$("<td />").text(record.Descripcion).appendTo(row);
							$("<td />").text(record.Unidad).appendTo(row);
							$("<td />").text(record.Cantidad).appendTo(row);
							$("<td />").text(record.Talla).appendTo(row);
							$("<td />").text(record.Tela).appendTo(row);
							$("<td />").text(record.img).appendTo(row);
							$("<td />").text(record.Corte).appendTo(row);	
							row.appendTo("#tSearch");
						}
					})
				}

				$('#tSearch').dataTable({
					"bJQueryUI": true,
				})

				$("#tSearch > tbody")
					.on( 'mouseover', 'tr', function () {
			            $(this).attr('style' , 'background-color: whitesmoke');
			        } )
			        .on( 'mouseleave','tr', function () {
			            $(this).attr('style' , '');   
			        } );

				$("#tSearch > tbody").on('click','tr',function(){
					var tr = $(this);
					$('#aSearch .row-fluid').show();
										
					$("#img_destino_articulo_imprimir").attr("src","/stock/" + tr.find("td:eq(8)").html()).error(function() {
    					$(this).attr("src","images/ind.jpg");
					});

					$("#valor-codigo").html(tr.find("td:eq(0)").html());
					var datos = "<div id='producto-imprimir'><h4 id='producto-h4'>Producto</h4>" + tr.find("td:eq(1)").html() + "</div>"
					+"<div id='tipo-imprimir'><h4>Tipo</h4>" + tr.find("td:eq(2)").html() + "</div>"
					+"<div id='descripcion-imprimir'><h4>Descripcion</h4>" + tr.find("td:eq(3)").html()+ "</div>"
					+"<div id='unidad-imprimir'><h4>Unidad</h4>" + tr.find("td:eq(4)").html()+ "</div>"
					+"<div id='cantidad-imprimir'><h4>Cantidad</h4>" + tr.find("td:eq(5)").html()+ "</div>"
					+"<div id='talla-imprimir'><h4>Talla</h4>" + tr.find("td:eq(6)").html()+ "</div>"
					+"<div id='corte-imprimir'><h4>Corte</h4>" + tr.find("td:eq(9)").html()+ "</div>";

					$("#datos-codigo").html(datos);

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

	$("#ver-codigo-solo").click(function(){
		w=window.open();
		w.document.write($("head").html());
		w.document.write("<div style='margin-left:20px;margin-top:50px;margin-left:100px;'><input type='button' value='Imprimir' class='btn btn-success' onclick='window.print();'></div>")
		var cod = $('#contenido-imprimir-codigo').clone();
		cod.find("#producto-imprimir").remove();
		cod.find("#tipo-imprimir").remove();
		cod.find("#unidad-imprimir").remove();
		cod.find("#cantidad-imprimir").remove();
		cod.find("#corte-imprimir").remove();
		cod.find("#img_destino_articulo_imprimir").remove();

		w.document.write(cod.html());

	});

	var MYVALOR = $("#Id").val();

$("#searchBarcode").barcode(MYVALOR, "ean13",{barWidth:1, barHeight:50, output: "canvas"}); 

	/* Incluir en los eventos de la TAB Search */

	$('form').on('submit', function() {
		
		
	})

})
