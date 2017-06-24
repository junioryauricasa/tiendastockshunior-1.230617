<?php
class ProveedorModel
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

			$stm = $this->pdo->prepare("SELECT * FROM tbproveedor");
			$stm->execute();

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$gam = new Proveedor();
			
				$gam->__SET('intidproveedor', $r->intidproveedor);
				$gam->__SET('intcodigo', $r->intcodigo);
				$gam->__SET('nvchnombre', $r->nvchnombre);
				$gam->__SET('nvchrazon_social', $r->nvchrazon_social);

				$gam->__SET('nvchdomicilio', $r->nvchdomicilio);
				$gam->__SET('nvchlocalidad', $r->nvchlocalidad);
				$gam->__SET('intfax', $r->intfax);
				$gam->__SET('inttelefono', $r->inttelefono);

				$gam->__SET('intcelular', $r->intcelular);
				$gam->__SET('nvchsitio_web', $r->nvchsitio_web);
				$gam->__SET('nvchemail_1', $r->nvchemail_1);
				$gam->__SET('nvchemail_2', $r->nvchemail_2);

				$gam->__SET('inttipo_doc', $r->inttipo_doc);
				$gam->__SET('intcod_doc', $r->intcod_doc);

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
		$codig = $_GET['intidproveedor'];

		$databaseHost = 'localhost';
		$databaseName = 'db_tiendastock';
		$databaseUsername = 'root';
		$databasePassword = '';

		$mysqli = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName); 
		$sql = "SELECT * FROM tbproveedor WHERE intidproveedor=$codig";
		$result = $mysqli->query($sql);

		if ($result->num_rows >= 1) {
		    //echo "Si existe.";
		} else {
		    //echo "No existe registro alguno.";
			 header("Location: proveedor.php"); 
		}
		
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM tbproveedor WHERE intidproveedor = ?");
			          

			$stm->execute(array($id));
			$r = $stm->fetch(PDO::FETCH_OBJ);

			$gam = new Proveedor();

			$gam->__SET('intidproveedor', $r->intidproveedor);
			$gam->__SET('intcodigo', $r->intcodigo);
			$gam->__SET('nvchnombre', $r->nvchnombre);
			$gam->__SET('nvchrazon_social', $r->nvchrazon_social);

			$gam->__SET('nvchdomicilio', $r->nvchdomicilio);
			$gam->__SET('nvchlocalidad', $r->nvchlocalidad);
			$gam->__SET('intfax', $r->intfax);
			$gam->__SET('inttelefono', $r->inttelefono);

			$gam->__SET('intcelular', $r->intcelular);
			$gam->__SET('nvchsitio_web', $r->nvchsitio_web);
			$gam->__SET('nvchemail_1', $r->nvchemail_1);
			$gam->__SET('nvchemail_2', $r->nvchemail_2);

			$gam->__SET('inttipo_doc', $r->inttipo_doc);
			$gam->__SET('intcod_doc', $r->intcod_doc);

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
			          ->prepare("DELETE FROM tbproveedor WHERE intidproveedor = ?");			          

			$stm->execute(array($id));
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Actualizar(Proveedor $data)
	{
		try 
		{
			$sql = "UPDATE tbproveedor SET 
						nvchnombre  = ?,
						nvchrazon_social  = ?,
						
						nvchdomicilio  = ?,
						nvchlocalidad  = ?,
						intfax  = ?,
						inttelefono  = ?,

						intcelular  = ?,
						nvchsitio_web  = ?,
						nvchemail_1  = ?,
						nvchemail_2  = ?,

						inttipo_doc  = ?,
						intcod_doc  = ? 

				    WHERE intidproveedor = ?";

			$this->pdo->prepare($sql)
			     ->execute(
				array(

					$data->__GET('nvchnombre'),
					$data->__GET('nvchrazon_social'),

					$data->__GET('nvchdomicilio'),
					$data->__GET('nvchlocalidad'),
					$data->__GET('intfax'),
					$data->__GET('inttelefono'),

					$data->__GET('intcelular'),
					$data->__GET('nvchsitio_web'),
					$data->__GET('nvchemail_1'),
					$data->__GET('nvchemail_2'),

					$data->__GET('inttipo_doc'),
					$data->__GET('intcod_doc'),

					$data->__GET('intidproveedor')

					)
				);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Registrar(Proveedor $data)
	{

		try 
		{
		$sql = "INSERT INTO tbproveedor (
					intcodigo,
					nvchnombre,
					nvchrazon_social,
					nvchdomicilio,
					nvchlocalidad,
					intfax,
					inttelefono,
					intcelular,
					nvchsitio_web,
					nvchemail_1,
					nvchemail_2,
					inttipo_doc,
					intcod_doc
					) 
		        VALUES (?, ?, ?,?, ?, ?,?, ?, ?,?, ?, ?,?)";

		$this->pdo->prepare($sql)
		     ->execute(
			array(
					//$data->__GET('intidproveedor');
					$data->__GET('intcodigo'),
					$data->__GET('nvchnombre'),
					$data->__GET('nvchrazon_social'),

					$data->__GET('nvchdomicilio'),
					$data->__GET('nvchlocalidad'),
					$data->__GET('intfax'),
					$data->__GET('inttelefono'),

					$data->__GET('intcelular'),
					$data->__GET('nvchsitio_web'),
					$data->__GET('nvchemail_1'),
					$data->__GET('nvchemail_2'),

					$data->__GET('inttipo_doc'),
					$data->__GET('intcod_doc')
				)
			);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
}

