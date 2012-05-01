<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Control_Perfil extends CI_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('modelInicio');
		$this->load->model('modelCliente');
		$this->load->model('modelPerfil');
		$this->load->helper('form');
	}
	
	// Funcion que nos lleva a la pantalla del perfil del usuario que se encuentra
	// logeado en el sistema.
	public function index()
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario;
		$usuario['Cedula'] = $this->modelPerfil->CedulaLogeado($Usuario);
		$usuario['Nombre'] = $this->modelPerfil->NombreLogeado($Usuario);
		$usuario['Apellido'] = $this->modelPerfil->ApellidoLogeado($Usuario);
		
		$usuario['Correo'] = $this->modelPerfil->CorreoLogeado($Usuario);
		$usuario['Telefono1'] = $this->modelPerfil->Telefono1Logeado($Usuario);
		$usuario['Telefono2'] = $this->modelPerfil->Telefono2Logeado($Usuario);
		$usuario['Telefono3'] = $this->modelPerfil->Telefono3Logeado($Usuario);
		
		$this->load->view('Vendedor/VPerfil', $usuario);
	}
	
	// Funcion que se utiliza en caso de querer modificar algun dato personal
	// de la persona que se encuentra logeada en el sistema.
	public function modificar_perfil()
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario;
		$Cedula = $this->modelPerfil->CedulaLogeado($Usuario);
		
		$datos['ID2'] = $Cedula;
		$vendedor = new ModelPerfil;
		$this->modelPerfil->ModificarVendedor($vendedor, $datos);
		
		$usuario['Nombre'] = $this->modelPerfil->NombreLogeado($Usuario);
		$usuario['Apellido'] = $this->modelPerfil->ApellidoLogeado($Usuario);
		
		$usuario['Correo'] = $this->modelPerfil->CorreoLogeado($Usuario);
		$usuario['Telefono1'] = $this->modelPerfil->Telefono1Logeado($Usuario);
		$usuario['Telefono2'] = $this->modelPerfil->Telefono2Logeado($Usuario);
		$usuario['Telefono3'] = $this->modelPerfil->Telefono3Logeado($Usuario);
		
		$usuario['Mensaje'] = 'Sus datos han sido actualizados con &eacute;xito!';
		
		$this->load->view('Vendedor/VPerfil', $usuario);
	}
	
	public function calendario()
	{
		$prefs = array ('show_next_prev' => TRUE, 'next_prev_url' => 'http://ejemplo.com/index.php/calendar/show/');
		
		$this->load->library('calendar');
		$usuario['Calendario'] = $this->calendar->generate();
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario;
		
		$this->load->view('Vendedor/VCalendario', $usuario);
	}
}