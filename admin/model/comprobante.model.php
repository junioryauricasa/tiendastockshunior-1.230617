<?php
class ComprobanteModel
{
	private $pdo;

	public function __CONSTRUCT()
	{
		try
		{
			$this->pdo = new PDO('mysql:host=localhost;dbname=db_tiendastock', 'root', '');
			$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);		        
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Listar()
	{
		try
		{
			$result = array();

			$stm = $this->pdo->prepare("SELECT * FROM tbcomprobante");
			$stm->execute();

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$gam = new Comprobante();
			
				$gam->__SET('idcomprobante', $r->idcomprobante);

				$gam->__SET('intCodComprob', $r->intCodComprob);
				
				$gam->__SET('dtPeriodo', $r->dtPeriodo);
				$gam->__SET('bitTipoCP', $r->bitTipoCP);
				$gam->__SET('nvchCUD', $r->nvchCUD);

				$gam->__SET('bitTipoDocCliente', $r->bitTipoDocCliente);
				$gam->__SET('nvchNombreRazonSocial', $r->nvchNombreRazonSocial);
				$gam->__SET('dtEmision', $r->dtEmision);
				$gam->__SET('bitTipoCambio', $r->bitTipoCambio);

				$gam->__SET('inttelefono', $r->inttelefono);
				$gam->__SET('intIgvIva', $r->intIgvIva);
				$gam->__SET('intImporteTotal', $r->intImporteTotal);
				$gam->__SET('intTipoPago', $r->intTipoPago);

				$gam->__SET('bitEstado', $r->bitEstado);

				$result[] = $gam;
			}

			return $result;
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Obtener($id)
	{

		/*
			Consultar existencia de codigo
			----------------------------
		*/
		$codig = $_GET['idcomprobante'];

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

		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM tbcomprobante WHERE idcomprobante = ?");
			          

			$stm->execute(array($id));
			$r = $stm->fetch(PDO::FETCH_OBJ);

			$gam = new Comprobante();

			$gam->__SET('idcomprobante', $r->idcomprobante);			
			$gam->__SET('dtPeriodo', $r->dtPeriodo);
			$gam->__SET('bitTipoCP', $r->bitTipoCP);
			$gam->__SET('nvchCUD', $r->nvchCUD);

			$gam->__SET('bitTipoDocCliente', $r->bitTipoDocCliente);
			$gam->__SET('nvchNombreRazonSocial', $r->nvchNombreRazonSocial);
			$gam->__SET('dtEmision', $r->dtEmision);
			$gam->__SET('bitTipoCambio', $r->bitTipoCambio);

			$gam->__SET('inttelefono', $r->inttelefono);
			$gam->__SET('intIgvIva', $r->intIgvIva);
			$gam->__SET('intImporteTotal', $r->intImporteTotal);
			$gam->__SET('intTipoPago', $r->intTipoPago);

			$gam->__SET('bitEstado', $r->bitEstado);

			return $gam;
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Eliminar($id)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("DELETE FROM tbcomprobante WHERE idcomprobante = ?");			          

			$stm->execute(array($id));
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Actualizar(Comprobante $data)
	{
		try 
		{
			$sql = "UPDATE tbcomprobante SET 
						dtPeriodo = ?,
						bitTipoCP  = ?,
						nvchCUD  = ?,
						
						bitTipoDocCliente  = ?,
						nvchNombreRazonSocial  = ?,
						dtEmision  = ?,
						bitTipoCambio  = ?,

						inttelefono  = ?,
						intIgvIva  = ?,
						intImporteTotal  = ?,
						intTipoPago  = ?,

						bitEstado  = ?

				    WHERE idcomprobante = ?";

			$this->pdo->prepare($sql)
			     ->execute(
				array(

					$data->__GET('dtPeriodo'),
					$data->__GET('bitTipoCP'),
					$data->__GET('nvchCUD'),

					$data->__GET('bitTipoDocCliente'),
					$data->__GET('nvchNombreRazonSocial'),
					$data->__GET('dtEmision'),
					$data->__GET('bitTipoCambio'),

					$data->__GET('inttelefono'),
					$data->__GET('intIgvIva'),
					$data->__GET('intImporteTotal'),
					$data->__GET('intTipoPago'),

					$data->__GET('bitEstado'),

					$data->__GET('idcomprobante')
					)
				);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Registrar(Comprobante $data)
	{

		try 
		{
		$sql = "INSERT INTO tbcomprobante (
						intCodComprob,

						dtPeriodo,
						bitTipoCP,
						nvchCUD,
						
						bitTipoDocCliente,
						nvchNombreRazonSocial,
						dtEmision,
						bitTipoCambio,

						inttelefono,
						intIgvIva,
						intImporteTotal,
						intTipoPago,

						bitEstado
					) 
		        VALUES (?,?, ?, ?,?, ?, ?,?, ?, ?,?, ?, ?)";

		$this->pdo->prepare($sql)
		     ->execute(
			array(
					$data->__GET('intCodComprob'),
					$data->__GET('dtPeriodo'),
					$data->__GET('bitTipoCP'),
					$data->__GET('nvchCUD'),

					$data->__GET('bitTipoDocCliente'),
					$data->__GET('nvchNombreRazonSocial'),
					$data->__GET('dtEmision'),
					$data->__GET('bitTipoCambio'),

					$data->__GET('inttelefono'),
					$data->__GET('intIgvIva'),
					$data->__GET('intImporteTotal'),
					$data->__GET('intTipoPago'),

					$data->__GET('bitEstado')
				)
			);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
}


/*
	Funciones extras
*/


    //dame tareas para el combobox
	function dameproveedor(){
	    $consulta_mysql="
		    SELECT 
				tbproveedor.nvchnombre,
				tbproveedor.intcodigo,
				tbproveedor.nvchrazon_social,
				tbproveedor.intidproveedor
			from 
			tbproveedor
	    ";
	    $resultado_consulta_mysql=mysql_query($consulta_mysql);
	    while($registro = mysql_fetch_array($resultado_consulta_mysql)){
	        echo "
	              <option style='' value='".$registro['intidproveedor']."'>
	              		".$registro['nvchnombre']." - ".$registro['nvchrazon_social']."
	              </option>
	        ";
	    }
	}