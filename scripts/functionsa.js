$(document).ready(function() {

	$('.nav li:first').on('click', function(e) {
		e.preventDefault();

		$(this).addClass('active').next('li').removeClass('active');

		$('section article').hide();
		$('section article:first').show();

		$('#titleContent').text('Registrar articulo');
	})

	$('.nav li:last').on('click', function(e) {
		e.preventDefault();

		$(this).addClass('active').prev('li').removeClass('active');

		$('section article').hide();
		$('section article:last').show();

		$('#titleContent').text('Buscar articulo');

	})
	

	/* Incluir en los eventos de la TAB Search */

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
							$("<td />").text(record.ID).appendTo(row);
							$("<td />").text(record.Descripsion).appendTo(row);
								$("<td />").text(record.Unidad).appendTo(row);
									$("<td />").text(record.Cantidad).appendTo(row);
							row.appendTo("table");
						}
					})
				}
				
				var table = $('table').dataTable({
			"bJQueryUI" : true,
			"bRetrieve" : true,
			"sPaginationType" : "full_numbers"
		})
				
			}
		});

	$('table tr').on('click', function() {
		$('#aSearch .row-fluid').show();
	})

	$('#searchBarcode').barcode("1234567890128","ean13",{barWidth:1, barHeight:50, output: "canvas"});
	/* Incluir en los eventos de la TAB Search */

	$('form').on('submit', function() {

		
	})

})