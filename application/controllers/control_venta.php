<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Control_Venta extends CI_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('modelventa');
		$this->load->model('modelProducto');
		$this->load->helper('form');
	}
	
	// Funcion que nos lleva a la pantalla del ventas.
	public function index()
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario;
		
		$usuario['Ganadas'] = $this->modelventa->NegoGanadas(); 
		
		$this->load->view('Despachador/DPrincipal', $usuario);
	}
	
	public function detalle_ganada()
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario;
		
		$usuario['Id_Negociacion'] = $_POST['Ganadas'];
		$Id_Negociacion = $_POST['Ganadas'];
		$usuario['Lista'] = $this->modelProducto->ConsultarLista($Id_Negociacion);
		$usuario['Lista2'] = $this->modelProducto->ConsultarLista2($Id_Negociacion);
		
		$this->load->view('Despachador/DVistaGanada', $usuario);
	}
	
	public function mandar_orden_compra($Id_Negociacion)
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario;
		$Id = $this->modelVenta->ConsultarNego($Id_Negociacion);
		
		if($Id == NULL)
		{
			$venta['Id_Negociacion'] = $Id_Negociacion;
			$venta['Status'] = "Enviada a compra";
			$venta['Final'] = "0";
			$this->modelVenta->CrearOrden($venta);
		}
		else 
		{
			$this->load->view('Despachador/DPrincipal', $usuario);
		}
		
		$this->load->view('Despachador/DPrincipal', $usuario);
	}
	
	
}