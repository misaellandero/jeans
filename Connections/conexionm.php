<?php
			$query = "SELECT * FROM modelo";
			$resultado = mysql_query($query);

			while ($fila = mysql_fetch_array($resultado)) {
				echo " <tr>";
				echo "<td> $fila[Id]  </td> <td> $fila[descripsion] </td>";
				echo " </tr>";
		
	}
?>