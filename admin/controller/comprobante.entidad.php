<?php 

class Comprobante
{
	private $idcomprobante;
	
	private $intCodComprob;

	private $dtPeriodo;
	private $bitTipoCP;
	private $nvchCUD;

	private $bitTipoDocCliente;
	private $nvchNombreRazonSocial;
	private $dtEmision;
	private $bitTipoCambio;

	private $inttelefono;
	private $intIgvIva;
	private $intImporteTotal;
	private $intTipoPago;

	private $bitEstado;

	public function __GET($k){ return $this->$k; }
	public function __SET($k, $v){ return $this->$k = $v; }
}

?>