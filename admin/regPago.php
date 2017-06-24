<?php 
//session_start();


/*
	echo $idcomprovante = $_POST['idcomprovante'].'<br>';
	echo $metodpago = $_POST['metodpago'].'<br>';
	echo $txtcodigobol = $_POST['txtcodigobol'].'<br>';
	echo $txtabonado = $_POST['txtabonado'].'<br>';
*/

	//variables
	$idcomprovante = $_POST['idcomprovante'];
	$metodpago = $_POST['metodpago'];
	$txtcodigobol = $_POST['txtcodigobol'];
	$txtabonado = $_POST['txtabonado'];

	//serverdata
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "db_tiendastock";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 

	$sql = "INSERT INTO tbpagos (intCodComprobante, intMetodoPago, nvchCodigoBol, fltMontoAbonado)
	VALUES ($idcomprovante, $metodpago, $txtcodigobol, $txtabonado)";

	if ($conn->query($sql) === TRUE) {
	    //echo "New record created successfully";
	    header("Location: comprobante.php");
	} else {
	    echo "Error: " . $sql . "<br>" . $conn->error;
	}

	$conn->close();

 ?>