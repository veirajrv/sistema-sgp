<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Control_Pdf extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper('form');
	}
	
	// Funcion que nos lleva a la pantalla en donde encontraremos
	// todos los manuales del sistema en pdf en donde podran ser 
	// descargados
	public function index() 
	{	
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario;
		$this->load->view('ArchivoPDF', $usuario);
	}
}