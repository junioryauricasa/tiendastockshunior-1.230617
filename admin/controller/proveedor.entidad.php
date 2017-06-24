<?php 

class Proveedor
{
	private $intidproveedor;
	private $intcodigo;
	private $nvchnombre;
	private $nvchrazon_social;

	private $nvchdomicilio;
	private $nvchlocalidad;
	private $intfax;
	private $inttelefono;

	private $intcelular;
	private $nvchsitio_web;
	private $nvchemail_1;
	private $nvchemail_2;
	
	private $inttipo_doc;
	private $intcod_doc;

	public function __GET($k){ return $this->$k; }
	public function __SET($k, $v){ return $this->$k = $v; }
}

?>