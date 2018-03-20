<?php


require '../conexionp.php';
	return new PDO('mysql:host='.$host.';dbname='.$db,$user,$pw);
?>
