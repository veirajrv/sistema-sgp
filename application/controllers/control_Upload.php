<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Control_Upload extends CI_Controller 
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->model('modelCombox');
	}
	
	function do_upload()
	{		
		$config['upload_path'] = 'C:/Documents and Settings/JRodriguezV/Desktop/Download/';
		$config['allowed_types'] = 'pdf';
		$config['file_name'] = $_POST['Nombre'];
		
		$this->load->library('upload', $config);
		
		if ( ! $this->upload->do_upload())
		{
			$Usuario = $this->session->userdata('Usuario');
			$config['Usuario'] = $Usuario;
			$error = "No se puedo cargar el archivo con exito! Intente de nuevo";
			$config['error'] = $error;
			$this->load->view('Administrador/AArchivoPdf', $config);
		}
		else
		{
			$Usuario = $this->session->userdata('Usuario');
			$config['Usuario'] = $Usuario;
			$error = "Se subio el archivo al sistema con exito!";
			$config['error'] = $error;
			
			$data['Nombre'] = $_POST['Nombre'].'.pdf';
			$data['Directorio'] = "C:/Documents and Settings/JRodriguezV/Desktop/Download/";
			$this->modelCombox->InsertarPdf($data);
			
			$this->load->view('Administrador/AArchivoPdf', $config);
		}
	}
}
?>