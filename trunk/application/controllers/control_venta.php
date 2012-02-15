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
		$Id = $this->modelventa->ConsultarNego($Id_Negociacion);
		
		if($Id == NULL)
		{
			$venta['Id_Negociacion'] = $Id_Negociacion;
			$venta['Status'] = "Enviada a compra";
			$venta['Final'] = "0";
			$this->modelventa->CrearOrden($venta);
			
			$usuario['Ganadas'] = $this->modelventa->NegoGanadas(); 
			$this->load->view('Despachador/DPrincipal', $usuario);
		}
		else 
		{
			$usuario['Ganadas'] = $this->modelventa->NegoGanadas(); 
			$this->load->view('Despachador/DPrincipal', $usuario);
		}
	}
	
	public function mandar_facturar($Id_Negociacion)
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario;
		$Id = $this->modelventa->ConsultarNego($Id_Negociacion);
		
		if($Id == NULL)
		{
			$venta['Id_Negociacion'] = $Id_Negociacion;
			$venta['Status'] = "Facturada";
			$venta['Final'] = "1";
			$this->modelventa->Facturar($venta);
			
			$IdSegui = $this->modelventa->IdSeguimiento($Id_Negociacion);
			
			$datos['ID2'] = $IdSegui;
			$Facturar = new modelventa;
			$this->modelventa->ModificarStatus($Facturar, $datos);
			
			$usuario['Ganadas'] = $this->modelventa->NegoGanadas(); 
			$this->load->view('Despachador/DPrincipal', $usuario);
		}
		else 
		{
			$datos['ID2'] = $Id;
			$Facturar2 = new modelventa;
			$this->modelventa->ModificarStatus2($Facturar2, $datos);
			
			$IdSegui = $this->modelventa->IdSeguimiento($Id_Negociacion);
			$datos['ID2'] = $IdSegui;
			$Facturar = new modelventa;
			$this->modelventa->ModificarStatus($Facturar, $datos);
			
			$usuario['Ganadas'] = $this->modelventa->NegoGanadas(); 
			$this->load->view('Despachador/DPrincipal', $usuario);
		}
	}
	
	public function consultar_negociaciones()
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario;
		
		$usuario['Lista'] = $this->modelventa->ConsultarLista();
		$usuario['Lista2'] = $this->modelventa->ConsultarLista2();
		
		$this->load->view('Despachador/DConsultaEstado', $usuario);
	}
	
	
}