<?php

require_once 'controller/proveedor.entidad.php';
require_once 'model/proveedor.model.php';


// Logica
$gam = new Proveedor();
$model = new ProveedorModel();

if(isset($_REQUEST['action']))
{
	switch($_REQUEST['action'])
	{
		case 'actualizar':


			$gam->__SET('intidproveedor',$_REQUEST['intidproveedor']);
			//$gam->__SET('intcodigo',$_REQUEST['intcodigo']);
			$gam->__SET('nvchnombre',$_REQUEST['nvchnombre']);
            $gam->__SET('nvchrazon_social', $_REQUEST['nvchrazon_social']);

            $gam->__SET('nvchdomicilio',$_REQUEST['nvchdomicilio']);
			$gam->__SET('nvchlocalidad',$_REQUEST['nvchlocalidad']);
			$gam->__SET('intfax',$_REQUEST['intfax']);
            $gam->__SET('inttelefono', $_REQUEST['inttelefono']);

            $gam->__SET('intcelular',$_REQUEST['intcelular']);
			$gam->__SET('nvchsitio_web',$_REQUEST['nvchsitio_web']);
			$gam->__SET('nvchemail_1',$_REQUEST['nvchemail_1']);
            $gam->__SET('nvchemail_2', $_REQUEST['nvchemail_2']);

            $gam->__SET('inttipo_doc',$_REQUEST['inttipo_doc']);
			$gam->__SET('intcod_doc',$_REQUEST['intcod_doc']);

            //$alm->__SET('foto', $_REQUEST['foto']);
			$model->Actualizar($gam);
			header('Location: proveedor.php');
			break;

		case 'registrar':
			//$gam->__SET('intidproveedor',$_REQUEST['intidproveedor']);
			$cod = date("dmyHis",time()-25200);

			$gam->__SET('intcodigo',$cod);
			$gam->__SET('nvchnombre',$_REQUEST['nvchnombre']);
            $gam->__SET('nvchrazon_social', $_REQUEST['nvchrazon_social']);

            $gam->__SET('nvchdomicilio',$_REQUEST['nvchdomicilio']);
			$gam->__SET('nvchlocalidad',$_REQUEST['nvchlocalidad']);
			$gam->__SET('intfax',$_REQUEST['intfax']);
            $gam->__SET('inttelefono', $_REQUEST['inttelefono']);

            $gam->__SET('intcelular',$_REQUEST['intcelular']);
			$gam->__SET('nvchsitio_web',$_REQUEST['nvchsitio_web']);
			$gam->__SET('nvchemail_1',$_REQUEST['nvchemail_1']);
            $gam->__SET('nvchemail_2', $_REQUEST['nvchemail_2']);

            $gam->__SET('inttipo_doc',$_REQUEST['inttipo_doc']);
			$gam->__SET('intcod_doc',$_REQUEST['intcod_doc']);

			$model->Registrar($gam);
			header('Location: proveedor.php');
			break;

		case 'eliminar':
			$model->Eliminar($_REQUEST['intidproveedor']);
			header('Location: proveedor.php');
			break;

		case 'editar':
			$gam = $model->Obtener($_REQUEST['intidproveedor']);
			break;
	}
}
include('panelheader.php');
?>
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
			<div class="row">
				<ol class="breadcrumb">
					<li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
					<li class="active">Registro de Proveedor</li>
				</ol>
			</div>
			<br>

			<div class="row">
				<div class="col-lg-12">
					<div class="panel panel-default">
						<div class="panel-heading">Lista de Proveedor</div>
						<div class="panel-body">
							<table data-toggle="table" data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc">
							    <thead>
								    <tr>
								        <th style="text-transform: uppercase">#Cod</th>
								        <th style="text-transform: uppercase">Documento / PIN</th>
								        <th style="text-transform: uppercase">Nombre / Razón Social</th>

								        <th style="text-transform: uppercase">Domicilio / Localidad</th>
								        <th style="text-transform: uppercase">Telefono / Cel.</th>

								        <th style="text-transform: uppercase">WebPage / e-Mail</th>

								        <th style="text-transform: uppercase">Opciones</th>
								    </tr>
							    </thead>
								<?php foreach($model->Listar() as $r): ?>
			                        <tr style="text-transform: uppercase">
			                            <td>
			                            	<?php 
			                                	echo $r->__GET('intcodigo'); 
			                                ?>
			                            </td>
			                            <td>
			                            	<?php 
			                            		if($r->__GET('inttipo_doc') == 1){
			                            			echo 'DNI';
			                            		}else
			                            		if($r->__GET('inttipo_doc') == 2){
			                            			echo 'RUC';
			                            		}
			                            		echo ' - '.$r->__GET('intcod_doc'); 
			                            	?>
			                            </td>
			                            <td>
			                                <?php 
			                                	echo $r->__GET('nvchnombre').' / '.$r->__GET('nvchrazon_social');
			                                ?>
			                            </td>
			                            <td>
			                                <?php 
			                                	echo $r->__GET('nvchdomicilio').' / '.$r->__GET('nvchlocalidad');
			                                ?>
			                            </td>

			                            <td>
			                            	
			                            	<a href="callto:<?php echo $r->__GET('intcelular'); ?>" target="_blank" class="btn btn-default btn-xs">
												<span class="glyphicon glyphicon-phone" aria-hidden="true"> </span> Cel
											</a>
			                            	<a href="callto:<?php echo $r->__GET('inttelefono'); ?>" target="_blank" class="btn btn-default btn-xs">
												<span class="glyphicon glyphicon-earphone" aria-hidden="true"> </span> Telf
											</a>
											
			                            </td>
			                            <td>
											<a href="<?php echo $r->__GET('nvchsitio_web'); ?>" target="_blank" class="btn btn-default btn-xs">
												<span class="glyphicon glyphicon-globe" aria-hidden="true"></span> Web
											</a>
											
											<a href="https://mail.google.com/mail/?view=cm&fs=1&to=<?php echo $r->__GET('nvchemail_1'); ?>" target="_blank" class="btn btn-default btn-xs">
												<span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> Mail
											</a>
			                            </td>

			                            <td>
											<a href="?action=editar&intidproveedor=<?php echo $r->intidproveedor; ?>" class="btn btn-primary btn-xs" data-toggle="tooltip" title="Editar Producto"> <span class='glyphicon glyphicon-pencil'></span></a>
			                                <!--a href="?action=eliminar&intidproveedor=<?php echo $r->intidproveedor; ?>" style="background-color: red; padding: 5px; border-radius: 5px;color: white; font-size:12px" data-toggle="tooltip" title="Eliminar Producto"><span class="glyphicon glyphicon-trash"></span></a-->
			                            </td>
			                        </tr>
			                    <?php endforeach; ?>
							</table>
						</div>
					</div>
				</div>
			</div>
			
			<!--registro Proveedor form-->
			<div class="row">
				<div class="col-lg-12">
					<div class="panel panel-default">
						<div class="panel-heading">Registro Proveedor</div>
						<div class="panel-body">
							<div class="col-md-12">
				                <form action="?action=<?php echo $gam->intidproveedor > 0 ? 'actualizar' : 'registrar'; ?>" method="POST" class="pure-form pure-form-stacked" style="margin-bottom:30px;" enctype="multipart/form-data">
				                    <input type="HIDDEN" name="intidproveedor" value="<?php echo $gam->__GET('intidproveedor'); ?>" />
									
									<div class="col-md-4">

						                    <label for="">Proveedor</label>
						                    <input class="form-control" type="text" name="nvchnombre" value="<?php echo $gam->__GET('nvchnombre'); ?>" style="width:100%;" placeholder='Ingrese el nombre del proveedor' pattern="[A-Za-z\s]{3,25}" title="Ingrese un nombre valido" required/>
											<br>

						                    <label for="">Razon Social</label>
						                    <input class="form-control" type="text" name="nvchrazon_social" value="<?php echo $gam->__GET('nvchrazon_social'); ?>" placeholder='Ingrese razón social' style="width:100%;" pattern="[A-Za-z\s]{3,25}" title="Ingresa una razon social valida" required/>
						                    <br>

						                    <label for="">Domicilio</label>
						                    <input class="form-control" type="text" name="nvchdomicilio" value="<?php echo $gam->__GET('nvchdomicilio'); ?>" placeholder='Ingrese Domicilio' style="width:100%;" pattern="[A-Za-z0-9\s]{3,50}" title="Ingresa un domicilio valido" required/>
						                    <br>

						                    <label for="">Nacionalidad</label>
						                    <input class="form-control" type="text" name="nvchlocalidad" value="<?php echo $gam->__GET('nvchlocalidad'); ?>" placeholder='Ingrese una Nacionalidad' style="width:100%;" pattern="[A-Za-z]{3,50}" title="Ingresa una Nacionalidad valida" required/>
						                    <br>
						            </div>

						            <div class="col-md-4">
						                    <label for="">Fax</label>
						                    <input class="form-control" type="text" name="intfax" value="<?php echo $gam->__GET('intfax'); ?>" placeholder='Ingrese Numero de FAX' style="width:100%;" pattern="[0-9\s]{3,50}" title="Ingresa número de FAX valido" required/>
						                    <br>

						                    <label for="">Teléfono</label>
						                    <input class="form-control" type="text" name="inttelefono" value="<?php echo $gam->__GET('inttelefono'); ?>" placeholder='Ingrese numero de teléfono' style="width:100%;" pattern="[0-9]{6,8}" title="Ingresa un Teléfono válido" required/>
						                    <br>				
						                    <label for="">Celular</label>
						                    <input class="form-control" type="text" name="intcelular" value="<?php echo $gam->__GET('intcelular'); ?>" style="width:100%;" placeholder='Ingrese numero de celular'  pattern="[0-9]{6,8}" title="Ingresa un Teléfono válido"  required/>
											<br>
						                    
						                    <label for="">Pagina Web</label>
						                    <input class="form-control" type="text" name="nvchsitio_web" value="<?php echo $gam->__GET('nvchsitio_web'); ?>" style="width:100%;" placeholder='Ingrese el nombre del producto' pattern="https?://.+" title="Incluir http://" required/>
											<br>

						            </div>


						            <div class="col-md-4">

						                    <label for="">Mail 1</label>
						                    <input class="form-control" type="text" name="nvchemail_1" value="<?php echo $gam->__GET('nvchemail_1'); ?>" placeholder='Ingrese distribuidor' style="width:100%;"  pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" required/>
						                    <br>

						                    <label for="">Mail 2</label>
						                    <input class="form-control" type="text" name="nvchemail_2" value="<?php echo $gam->__GET('nvchemail_2'); ?>" placeholder='Ingrese distribuidor' style="width:100%;"  pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" required/>
						                    <br>

						                    <label for="">Tipo documento</label>
						                    <!--input class="form-control" type="text" name="inttipo_doc" value="<?php echo $gam->__GET('inttipo_doc'); ?>" placeholder='Ingrese distribuidor' style="width:100%;" required/-->
						                    <!--select persona-->
						                    <select name="inttipo_doc" style='text-transform:uppercase' class="form-control" id="" value="<?php echo $gam->__GET('inttipo_doc'); ?>">
		                                          <option value="1">DNI</option>
		                                          <option value="2">RUC</option>
		                                    </select>
						                    <br>

						                    <label for="">PIN Documento</label>
						                    <input class="form-control" type="text" name="intcod_doc" value="<?php echo $gam->__GET('intcod_doc'); ?>" placeholder='Ingrese distribuidor' style="width:100%;" pattern="[0-9]{9,12}" title="Ingresa un valor valido" required/>
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
			<form action="?action=<?php echo $gam->intidproveedor > 0 ? 'actualizar' : 'registrar'; ?>" method="post" class="pure-form pure-form-stacked" style="margin-bottom:30px;" enctype="multipart/form-data">
                <input type="hidden" name="intidproveedor" value="<?php echo $gam->__GET('intidproveedor'); ?>" />
            </form> 

		</form>
	</div><!--/.main-->

<?php include_once('panelfooter.php'); ?>