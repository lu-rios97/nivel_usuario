<?php 
$contrasena = "NjvzGhmtO0ZofkpbhxDU";
$usuario = "uun4px2mbuhzl48d";
$nombre_bd = "bzqzhoqbxlmptdjilu8c";

try {
	$bd = new PDO (
		'mysql:host=bzqzhoqbxlmptdjilu8c-mysql.services.clever-cloud.com;
		dbname='.$nombre_bd,
		$usuario,
		$contrasena,
		array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
	);
} catch (Exception $e) {
	echo "Problema con la conexion: ".$e->getMessage();
}
?>