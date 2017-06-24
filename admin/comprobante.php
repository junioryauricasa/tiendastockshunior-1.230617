<?php
require_once 'controller/comprobante.entidad.php';
require_once 'model/comprobante.model.php';

include_once('connection.php');
// Logica
$gam = new Comprobante();
$model = new ComprobanteModel();

if(isset($_REQUEST['action']))
{
	switch($_REQUEST['action'])
	{
		case 'actualizar':

			$IVA = 18;

			$gam->__SET('idcomprobante',$_REQUEST['idcomprobante']);
			$gam->__SET('dtPeriodo',$_REQUEST['dtPeriodo']);
			$gam->__SET('bitTipoCP',$_REQUEST['bitTipoCP']);
            $gam->__SET('nvchCUD', $_REQUEST['nvchCUD']);

            $gam->__SET('bitTipoDocCliente',$_REQUEST['bitTipoDocCliente']);
			$gam->__SET('nvchNombreRazonSocial',$_REQUEST['nvchNombreRazonSocial']);
			$gam->__SET('dtEmision',$_REQUEST['dtEmision']);
            $gam->__SET('bitTipoCambio', $_REQUEST['bitTipoCambio']);

            $gam->__SET('inttelefono',$_REQUEST['inttelefono']);
			$gam->__SET('intIgvIva',$IVA);
			$gam->__SET('intImporteTotal',$_REQUEST['intImporteTotal']);
            $gam->__SET('intTipoPago', $_REQUEST['intTipoPago']);

            $gam->__SET('bitEstado',$_REQUEST['bitEstado']);

            //$alm->__SET('foto', $_REQUEST['foto']);
			$model->Actualizar($gam);
			header('Location: comprobante.php');
			break;

		case 'registrar':

			$IVA = 18;
			$cod = date("dmyHis",time()-25200);
			//$gam->__SET('idcomprobante',$_REQUEST['idcomprobante']);

			$gam->__SET('intCodComprob',$cod);

			$gam->__SET('dtPeriodo',$_REQUEST['dtPeriodo']);
			$gam->__SET('bitTipoCP',$_REQUEST['bitTipoCP']);
            $gam->__SET('nvchCUD', $_REQUEST['nvchCUD']);

            $gam->__SET('bitTipoDocCliente',$_REQUEST['bitTipoDocCliente']);
			$gam->__SET('nvchNombreRazonSocial',$_REQUEST['nvchNombreRazonSocial']);
			$gam->__SET('dtEmision',$_REQUEST['dtEmision']);
            $gam->__SET('bitTipoCambio', $_REQUEST['bitTipoCambio']);

            $gam->__SET('inttelefono',$_REQUEST['inttelefono']);
			$gam->__SET('intIgvIva',$IVA);
			$gam->__SET('intImporteTotal',$_REQUEST['intImporteTotal']);
            $gam->__SET('intTipoPago', $_REQUEST['intTipoPago']);

            $gam->__SET('bitEstado',$_REQUEST['bitEstado']);


			$model->Registrar($gam);
			header('Location: comprobante.php');
			break;

		case 'eliminar':
			$model->Eliminar($_REQUEST['idcomprobante']);
			header('Location: comprobante.php');
			break;

		case 'editar':
			$gam = $model->Obtener($_REQUEST['idcomprobante']);
			break;
	}
}
include('panelheader.php');
?>
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
			<div class="row">
				<ol class="breadcrumb">
					<li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
					<li class="active">Registro de Comprobante</li>
				</ol>
			</div>
			<br>

			<div class="row">
				<div class="col-lg-12">
					<div class="panel panel-default">
						<div class="panel-heading">Lista de Comprobante</div>
						<div class="panel-body">
							<table data-toggle="table" data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc">
							    <thead>
								    <tr>
								        <th style="text-transform: uppercase">#Cod</th>
								        <!--th style="text-transform: uppercase">Periodo</th-->
								        <th style="text-transform: uppercase">Tipo / CUD / Razon Social</th>
								        <th style="text-transform: uppercase">Modificación</th>
								        <th style="text-transform: uppercase">Monto / Total + IGV / Pago</th>
								        <th style="text-transform: uppercase">IGV</th>
								        <th style="text-transform: uppercase">Estado</th>
								        <th style="text-transform: uppercase">Opciones</th>
								    </tr>
							    </thead>
								<?php foreach($model->Listar() as $r): ?>
			                        <tr style="text-transform: uppercase">
			                            <td>
			                            	<?php 
			                                	echo $r->__GET('intCodComprob'); 
			                                ?>
			                            </td>
			                            <!--td>
			                                <?php 
			                                	echo $r->__GET('dtPeriodo');
			                                ?>
			                            </td-->
			                            <td>
			                                <?php 
			                                	
			                                	if($r->__GET('bitTipoCP') == 1){
			                            			echo 'Boleta ';
			                            		}else
			                            		if($r->__GET('bitTipoCP') == 2){
			                            			echo 'Factura ';
			                            		}

			                                	echo ' / '.$r->__GET('nvchCUD').' / ';
			                                
			                            		/*
			                            		if($r->__GET('bitTipoDocCliente') == 1){
			                            			echo 'DNI - ';
			                            		}else
			                            		if($r->__GET('bitTipoDocCliente') == 2){
			                            			echo 'RUC - ';
			                            		}
			                            		*/
		                                	    $codprov = $r->__GET('nvchNombreRazonSocial'); 

		                                	    $consulta_mysql="
												    SELECT 
														*
													from 
													tbproveedor
													where intidproveedor = $codprov
											    ";
											    $resultado_consulta_mysql=mysql_query($consulta_mysql);
											    while($registro = mysql_fetch_array($resultado_consulta_mysql)){
											        echo "
											              ".$registro['nvchnombre']." - ".$registro['nvchrazon_social']."
											        ";
											    }
			                            	?>
											
			                            </td>
			                            <td>
											<?php 
												echo $r->__GET('dtEmision');
											 ?>
			                            </td>
			                            <td>
											<?php
												$mtotal = $r->__GET('intImporteTotal');
												$iva = $r->__GET('intIgvIva');
												$totaligv = $mtotal + ($mtotal*$iva/100);

												echo $mtotal.' / '.$totaligv.' / ';											

												if($r->__GET('intTipoPago') == 1){
													echo 'Efectivo';
												}else
												if($r->__GET('intTipoPago') == 2){
													echo 'Tarjeta';
												}
											 ?>
			                            </td>
			                            <td>
			                            	<?php 

												if($r->__GET('bitTipoCambio') == 1){
													echo 'Soles / '.$r->__GET('intIgvIva').'%';
												}else
												if($r->__GET('bitTipoCambio') == 2){
													echo 'Dolares / '.$r->__GET('intIgvIva').'%';;
												}
			                            	?>
			                            </td>

			                            <td>
			                            	<?php 
			                            		if($r->__GET('bitEstado') == 1){
													echo 'Pendiente';
												}else
												if($r->__GET('bitEstado') == 2){
													echo 'Cancelado';
												}
			                            	 ?>
			                            </td>

			                            <td>
			                            	<?php  
				                            	if($r->__GET('bitEstado') == 1){
				                            		?>
				                            		<a href="pagos.php?cod=<?php echo $r->idcomprobante; ?>" class="btn btn-default btn-xs" data-toggle="tooltip" title="Pagar">Pagar</a>
				                            		<?php 
				                            	}
			                            	?>

											<a href="?action=editar&idcomprobante=<?php echo $r->idcomprobante; ?>" class="btn btn-primary btn-xs" data-toggle="tooltip" title="Editar"> <span class='glyphicon glyphicon-pencil'></span></a>
			                                <a href="?action=eliminar&idcomprobante=<?php echo $r->idcomprobante; ?>"  class="btn btn-danger btn-xs" data-toggle="tooltip" title="Eliminar"><span class="glyphicon glyphicon-trash"></span></a>
			                            </td>
			                        </tr>
			                    <?php endforeach; ?>
							</table>
						</div>
					</div>
				</div>
			</div>
			
			<!--registro comprobante form-->
			<div class="row">
				<div class="col-lg-12">
					<div class="panel panel-default">
						<div class="panel-heading">Registro Comprobante</div>
						<div class="panel-body">
							<div class="col-md-12">
				                <form action="?action=<?php echo $gam->idcomprobante > 0 ? 'actualizar' : 'registrar'; ?>" method="POST" class="pure-form pure-form-stacked" style="margin-bottom:30px;" enctype="multipart/form-data">
				                    <input type="HIDDEN" name="idcomprobante" value="<?php echo $gam->__GET('idcomprobante'); ?>" />
									
									<div class="col-md-4">
						                    <label for="">Periodo</label>
						                    <input class="form-control" type="date" name="dtPeriodo" value="<?php echo $gam->__GET('dtPeriodo'); ?>" style="width:100%;" placeholder='Seleccione un periodo' required/>
											<br>

						                    <label for="">Tipo comprobante</label>
						                    <select class="form-control" type="text" name="bitTipoCP" value="<?php echo $gam->__GET('bitTipoCP'); ?>" >
						                    	<option value="2">Factura</option>
						                    	<option value="1">Boleta</option>
						                    </select>
											<br>

						                    <label for="">CUD</label>
						                    <input class="form-control" type="text" name="nvchCUD" value="<?php echo $gam->__GET('nvchCUD'); ?>" placeholder='Ingrese distribuidor' style="width:100%;" pattern="[0-9]{8,12}" title="Ingresa un valor válido" required/>
						                    <br>

						                    <label for="">Tipo documento</label>
						                    <select class="form-control" type="text" name="bitTipoDocCliente" value="<?php echo $gam->__GET('bitTipoDocCliente'); ?>" >
						                    	<option value="">DNI</option>
						                    	<option value="">RUC</option>
						                    </select>
						                    <br>
						            </div>

						            <div class="col-md-4">
						                    <label for="">Razon Social / Nombre</label>
						                    <!--input class="form-control" type="text" name="nvchNombreRazonSocial" value="<?php echo $gam->__GET('nvchNombreRazonSocial'); ?>" placeholder='Ingrese distribuidor' style="width:100%;" required/-->
						                    <select name="nvchNombreRazonSocial" id="" class="form-control" style="width:100%;" >
											<?php 
												dameproveedor();
						                     ?>
						                     </select>
						                    <br>

						                    <label for="">Fecha Emision / Modificacion </label>
						                    <input class="form-control" type="text" name="dtEmision" value="<?php echo date('Y/m/d', time()); ?>" placeholder='Ingrese distribuidor' style="width:100%;" readonly/>
						                    <br>

						                    <label for="">Cambio</label>
						                    <select  class="form-control"  name="bitTipoCambio" id="" value="<?php echo $gam->__GET('bitTipoCambio'); ?>">
						                    	<option value="1">Soles</option>
						                    	<option value="2">Dolares</option>
						                    </select>

						                    <br>				
						                    <label for="">Teléfono</label>
						                    <input class="form-control" type="text" name="inttelefono" value="<?php echo $gam->__GET('inttelefono'); ?>" style="width:100%;" pattern="[0-9]{6,8}" title="Ingresa un Teléfono válido" placeholder='Ingrese un telefono valido' required/>
											<br>

						            </div>


						            <div class="col-md-4">
						                    <label for="">IGV/IVA</label>
						                    <input class="form-control" type="text" name="intIgvIva" value="18" style="width:100%;" placeholder='Ingrese el IGV/ IVA' pattern="[0-9]{1,2}" title="Ingresa un Teléfono válido" readonly disabled="" />
											<br>
						                    <label for="">Importe</label>
						                    <input class="form-control" type="text" name="intImporteTotal" value="<?php echo $gam->__GET('intImporteTotal'); ?>" placeholder='Ingrese distribuidor' style="width:100%;" onkeyup="var pattern = /[^0-9\.]/g; // cualquier cosa que no sea numero y punto;
												this.value = this.value.replace(pattern, '');
												" required/>
						                    <br>

						                    <label for="">Tipo de Pago</label>
						                    <select name="intTipoPago" style='text-transform:uppercase' class="form-control" id="" value="<?php echo $gam->__GET('intTipoPago'); ?>">
		                                          <option value="1">Efectivo</option>
		                                          <option value="2">Tarjeta</option>
		                                    </select>
						                    <br>

						                    <label for="">Estado</label>
						                    <select name="bitEstado" style='text-transform:uppercase' class="form-control" id="" value="<?php echo $gam->__GET('bitEstado'); ?>">
		                                          <option value="1">Pendiente</option>
		                                          <option value="2">Cancelado</option>
		                                    </select>
						                    <br>
						            </div>

									<button type="submit" class="btn btn-primary">Guardar</button>
									<button type="reset" class="btn btn-danger">Limpiar</button>
				                </form>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!--end registro form-->
			<form action="?action=<?php echo $gam->idcomprobante > 0 ? 'actualizar' : 'registrar'; ?>" method="post" class="pure-form pure-form-stacked" style="margin-bottom:30px;" enctype="multipart/form-data">
                <input type="hidden" name="idcomprobante" value="<?php echo $gam->__GET('idcomprobante'); ?>" />
            </form> 

		</form>
	</div><!--/.main-->

<?php include_once('panelfooter.php'); ?>