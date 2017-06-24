<?php

include_once('connection.php');
include('panelheader.php');


/*
	Consultar existencia de codigo
	----------------------------
*/
$codig = $_GET['cod'];

$databaseHost = 'localhost';
$databaseName = 'db_tiendastock';
$databaseUsername = 'root';
$databasePassword = '';

$mysqli = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName); 
$sql = "SELECT * FROM tbcomprobante WHERE idcomprobante=$codig";
$result = $mysqli->query($sql);

if ($result->num_rows >= 1) {
    //echo "Si existe.";
} else {
    //echo "No existe registro alguno.";
	 header("Location: comprobante.php"); 
}



?>
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
			<div class="row">
				<ol class="breadcrumb">
					<li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
					<li class="active">Transferencias - Abonos - Pagos</li>
				</ol>
			</div>
			<br>

			<div class="row">

				<div class="col-lg-4">
					<div class="panel panel-default">
						<div class="panel-heading">
							Factura
						</div>
						<div class="panel-body">
							<div class="col-md-12">
								<form action="regPago.php" method="post" class="pure-form pure-form-stacked" style="margin-bottom:30px;" enctype="">
				                    <!--input class="form-control" type="hidden" name="intidstock" value="" /-->
									
									<?php 
										/*
											consulta de pago
										*/
										$comprob = $_GET['cod'];
										$consulta_mysql="
											SELECT 
												tbcomprobante.idcomprobante,
												tbcomprobante.intCodComprob,
												tbcomprobante.intImporteTotal+tbcomprobante.intImporteTotal*(tbcomprobante.intIgvIva/100) as 'totalconigv',
												tbproveedor.intcod_doc,
												tbproveedor.nvchrazon_social 
												from tbcomprobante 
												inner join tbproveedor
												on tbcomprobante.nvchNombreRazonSocial = tbproveedor.intidproveedor
												WHERE tbcomprobante.idcomprobante = $comprob;
										";
										$resultado_consulta_mysql=mysql_query($consulta_mysql);
										while($registro = mysql_fetch_array($resultado_consulta_mysql)){
											$intCodComprob = $registro['intCodComprob']; //Codigo
											$intcod_doc = $registro['intcod_doc']; //RUC
										    $nvchrazon_social = $registro['nvchrazon_social']; //razon social
										    $totalconigv = $registro['totalconigv'];
										    
										}
										    
									?>
									
									<input type="hidden" name="idcomprovante" value="<?php echo $comprob ; ?>">

									<label for="">Cod. Comprobante</label>
				                    <input type="text" class="form-control" value="<?php echo $intCodComprob; ?>" required="" readonly="" disabled="">
				                    <br>

				                    <label for="">RUC / Razon Social</label>
				                    <input type="text" class="form-control" required="" value="<?php echo $intcod_doc.' / '.$nvchrazon_social; ?>" readonly="" disabled="">
				                    <br>

				                    <label for="">Monto Total (+ IGV)</label>
				                    <input type="text" class="form-control" value="<?php echo $totalconigv; ?>" required="" readonly="" disabled="">
				                    <br>

				                    <label for="">Metodo de pago </label>
				                    <select name="metodpago" id="" class="form-control">
				                    	<option value="1">Transferencia en cuenta</option>
				                    	<option value="2">Abono en Tarjeta de crédito</option>
				                    	<option value="3">Pago en Cheque</option>
				                    </select>
				                    <br>

				                    <label for="">Código (Opcional)</label>
				                    <input type="text" name="txtcodigobol" minlength="6" maxlength="10" class="form-control" value="" required="">
				                    <br>

				                    <label for="">Monto abonado</label>
				                    <input type="text" name="txtabonado" class="form-control" maxlength="6" onkeyup="var pattern = /[^0-9\.]/g; // cualquier cosa que no sea numero y punto;
												this.value = this.value.replace(pattern, '');
												" required >
				                    <br>

				                    <button type="submit" class="btn btn-primary">Guardar</button>
				                </form>
							</div>
						</div>
					</div>
				</div>
			</div>

			</div>
	</div>

<?php include_once('panelfooter.php'); ?>