 <title>Sistema De Inventario</title>
    <link rel="stylesheet" type="text/css" href="styles/normalize.css">
	<link rel="stylesheet" type="text/css" href="styles/style.css">
	<link rel="stylesheet" type="text/css" href="styles/jquery-ui-1.10.3.custom.css">
	<link rel="stylesheet" type="text/css" href="styles/jquery.dataTables.css">
	<link rel="stylesheet" type="text/css" href="styles/bootstrap-responsive.css">
	<link rel="stylesheet" type="text/css" href="styles/bootstrap.css">

	<script src="scripts/jquery.dataTables.js"></script>
	<script src="scripts/jquery-ui-1.10.3.custom.js"></script>
	<script src="scripts/jquery.js"></script>
	<script src="scripts/functions.js"></script>
	<script src="scripts/prefixfree.min.js"></script>
	<script src="scripts/datatables.js"></script>
	<script src="scripts/jjquery-ui.js"></script>
	<script src="scripts/jquery-barcode.js"></script>
	
	<?php ob_start(); ?>

 <table id="tSearch" cellspacing="1">
	<caption>Lista de Articulos</caption>
	<thead>
				<tr>
					<th>ID</th>
					<th>Descripcion</th>		
                    	<th>Unidad</th>					
							<th>Cantidad</th>
                            <th>Imagen</th>
                           <th>Ultima Actualizacion</th>     
        </tr>
			</thead>
	<tbody>
	</tbody>
	</table>
<?php
require_once("dompdf/dompdf_config.inc.php");
$dompdf = new DOMPDF();
$dompdf->load_html(ob_get_clean());
$dompdf->render();
$pdf = $dompdf->output();
$filename = "Articulo Registrado el ".time().'.pdf';
file_put_contents($filename, $pdf);
$dompdf->stream($filename);
?>
