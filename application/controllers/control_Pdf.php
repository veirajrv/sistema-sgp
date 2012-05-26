<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Control_Pdf extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('fpdf');
		$this->load->library('PDF_Generator');
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
	
	function printPDF()
	{

         $data = 0;
		$this->load->plugin('to_pdf');
$html = $this->load->view( 'welcome_message' , $data , true );

pdf_create ($html,'pruebas');
        }
}

