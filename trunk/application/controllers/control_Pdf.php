<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Control_Pdf extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('fpdf');
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
		
		$usuario['Lista'] = $this->modelCombox->ConsultarDirectorio();
		
		$this->load->view('Administrador/AArchivoPdf', $usuario);
	}
	
	function Header()
	{
   		$this->fpdf->Open();
		$this->fpdf->AddPage();
		//dibuja rectangulo
		$this->fpdf->Rect(20,10,180,137,'D');
		//finaliza y muestra en pantalla pdf
		$this->fpdf->Output();
	}
	
}

