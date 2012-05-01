<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Control_Pdf extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper('form');
		$this->load->model('modelCombox');
	}
	
	// Funcion que nos lleva a la pantalla en donde encontraremos
	// todos los manuales del sistema en pdf en donde podran ser 
	// descargados
	public function index() 
	{	
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario;
		$usuario['error'] = " ";	
		
		$this->load->view('ArchivoPDF', $usuario);
	}
	
	public function index2() 
	{	
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario;
		$usuario['error'] = " ";	
		
		$Lista = $this->modelCombox->ConsultarDirectorio();
		
		$this->load->library('table');
		$this->table->set_empty("&nbsp;");
		$this->table->set_heading('<font style="font-size:12px" color="#369"><b>Nombre</b></font>');
	
		foreach ($Lista as $row)
		{
			$id = $row['Id_Database'];
			$nombre = $row['Nombre'];
			$directorio = $row['Directorio'];
			$direccion = $directorio.$nombre;
			
			$this->table->add_row($nombre, anchor($direccion,'Ver PDF'));
		}
			
		$usuario['table'] = $this->table->generate();
		
		$this->load->view('Administrador/AArchivoPdf', $usuario);
	}
	
	
}