<?php
//Conneccion a la base de dato
$con = mysqli_connect("localhost", "root", "", "db_tiendastock") or die("Error " . mysqli_error($con));

/*
	------------------------------
	Autor: junior yauricasa
	fecha: 23-06-2017
	descripcion: est coneccion db
	------------------------------

if(!$con){
	echo 'sucedio un problema con la Conneccion';
}else if($con){
	echo 'Conneccion exitosa';
}

*/

?>