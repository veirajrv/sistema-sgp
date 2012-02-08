<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Control_Combox extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('modelCombox');
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	// Funcion que cierra la sesion que se encuentra abierta //
	public function CerrarSesion() 
	{
		$this->session->sess_destroy();
		$this->load->view('index');
	}    
	
	// FUNCIONES DEL JAVASCRIPT DE LOS COMBO DE EQUIPOS //
	public function ajax_get_accounts() 
	{
		$id = $this->uri->rsegment(3);
		$accounts_list = $this->modelCombox->ComboLineas($id);
		$result = '<option value=" ">Seleccione una linea</option>';
		foreach($accounts_list as $account)
		{
			$result .= '<option value="'.$account['Id_Linea'].'">'.$account['Nombre'].'</option>';
		}
		echo $result;
	}
	
	public function ajax_get_accounts2() 
	{
		$id = $this->uri->rsegment(3);
		$accounts_list = $this->modelCombox->ComboEquipos($id);
		$result2 = '<option value=" ">Seleccione un equipo</option>';
		foreach($accounts_list as $equipo)
		{
			$result2 .= '<option value="'.$equipo['Id_Equipo'].'">'.$equipo['Nombre'].'</option>';
		}
		echo $result2;
	}
	
	public function ajax_get_accounts3() 
	{
		$id = $this->uri->rsegment(3);
		$accounts_list = $this->modelCombox->ComboAccesorios($id);
		$result3 = '<option value=" ">Seleccione un equipo</option>';
		foreach($accounts_list as $Accesorio)
		{
			$result3 .= '<option value="'.$Accesorio['Id_Accesorio'].'">'.$Accesorio['Nombre'].'</option>';
		}
		echo $result3;
	}
	
	public function combo_box() // Inicio de session al sistema //
	{
		$this->load->view('ComboBox'); // Clave del usuario en la base de datos //
	}
}
