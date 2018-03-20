<?php
			$query = "SELECT * FROM tela";
			$resultado = mysql_query($query);

			while ($fila = mysql_fetch_array($resultado)) {
				echo " <tr>";
				echo "<td> $fila[Id]  </td> <td> $fila[Descripcion] </td>";
				echo " </tr>";
		
	}
?>