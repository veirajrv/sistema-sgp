<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Control_Venta extends CI_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('modelventa');
		$this->load->model('modelProducto');
		$this->load->model('modelCliente');
		$this->load->model('modelNegociacion');
		$this->load->model('modelInstitucion');
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
	
		// Funciones que consultan negociaciones por cliente //
	public function ver_negociacion() 
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario;
		$usuario2 = $Usuario;
		$Id = $this->modelCliente->BuscarId($usuario2);
		$usuario['Clientes'] = $this->modelNegociacion->MisClientes($Id);
		$this->load->view('Despachador/DVerNegociacion', $usuario);
	}
	
	public function ver_negociacion_2()
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario;
		$usuario2 = $Usuario;
		$Id = $this->modelCliente->BuscarId($usuario2);
		$usuario['Institucion'] = $this->modelNegociacion->MisInstituciones($Id);
		$this->load->view('Despachador/DVerNegociacionI', $usuario);
	}
	
	public function atras_negociacion() 
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario;
		$usuario2 = $Usuario;
		$Id = $this->modelCliente->BuscarId($usuario2);
		$usuario['Clientes'] = $this->modelNegociacion->MisClientes($Id);
		$this->load->view('Despachador/DVerNegociacion', $usuario);
	}
	
	public function index2()
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario;
		$usuario2 = $Usuario;
		$Id = $this->modelCliente->BuscarId($usuario2);
		$usuario['Clientes'] = $this->modelNegociacion->BuscarClientes();
		$this->load->view('Despachador/DNegociacion', $usuario);
	}
	
	public function index3()
	{
		$Usuario = $this->session->userdata('Usuario');
	    $usuario['Usuario'] = $Usuario;
		$usuario2 = $Usuario;
		$Id = $this->modelCliente->BuscarId($usuario2);
		$usuario['Institucion'] = $this->modelNegociacion->BuscarInstitucion($Id);
		$this->load->view('Despachador/DNegociacion2', $usuario);
	}
	
	// Funcion que agrega una negociacion de clientes //
	public function agregar_negociacion() 
	{
		$Usuario = $this->session->userdata('Usuario');
		// NEGOCIACION //
		$user = $Usuario;
		$id = $_POST['select2'];
		$Negociacion['Id_Cliente'] = $_POST['select2']; // Id Cliente //
		$Negociacion['Id_Empleado'] =  $this->modelCliente->BuscarId($user); // Id Vendedor //
		$Negociacion['FechaP'] = date("d/m/Y");
		$Negociacion['Status'] = 1;
		
		$this->modelNegociacion->NuevaNegociacion($Negociacion);
		
		// SEGUIMIENTO //
		$Seguimiento['FechaS'] = date("d/m/Y");
		$Seguimiento['TipoS'] = 'Inicial';
		$Seguimiento['Status'] = 'Borrador';
		$Seguimiento['Porcentaje'] = '25';
		
		$this->modelNegociacion->NuevoSeguimiento($Seguimiento);
		
		// NS (Tabla interseccion entre Negociacion y Seguimiento) //
		
		$IdNegociacion = $this->modelNegociacion->UltimaNegociacion();
		$NS['Id_Negociacion'] = $IdNegociacion;
		$IdSeguimiento = $this->modelNegociacion->UltimoSeguimiento();
		$NS['Id_Seguimiento'] = $IdNegociacion;
		$NS['FechaS'] = date("d/m/Y");
		$NS['TipoS'] = 'Inicial';
		$NS['Status'] = 'Borrador';
		
		$this->modelNegociacion->NuevaNS($NS);
		
		$NS2['Id_Negociacion'] = $IdNegociacion;
		$IdSeguimiento = $this->modelNegociacion->UltimoSeguimiento();
		$NS2['Id_Seguimiento'] = $IdNegociacion;
		$NS2['FechaS'] = date("d/m/Y");
		$NS2['TipoS'] = 'Inicial';
		$NS2['Status'] = 'Borrador';
		
		$this->modelNegociacion->NuevaNS2($NS2);
		
		$usuario['Usuario'] = $Usuario;
		$usuario['Id_Negociacion'] = $IdNegociacion;
		
		// ALERTA //
		$Alerta['Id_Negociacion'] = $IdNegociacion;
		$Alerta['Status'] = 0;
		$Alerta['Contador'] = 0;
		
		$this->modelNegociacion->NuevaAlerta($Alerta);
		
		// ALERTA MODIFICACION //
		$Alerta2['Id_Negociacion'] = $IdNegociacion;
		$Alerta2['Contador'] = 0;
		
		$this->modelNegociacion->NuevaAlerta2($Alerta2);
		
		// Buscar ultimo status de una negociacion //
		$statusmax = $this->modelNegociacion->IdMaxStatus($IdNegociacion);
		$idSeguimiento = $this->modelNegociacion->Idseguimiento($statusmax);
		$status = $this->modelNegociacion->status($idSeguimiento);
		
		$usuario['Status'] = $status;
		$usuario['NCliente'] = $this->modelCliente->BuscarNombreC($id);
		$usuario['ACliente'] = $this->modelCliente->BuscarApellidoC($id);
		$usuario['MailCliente'] = $this->modelCliente->BuscarMailC($id);
		
		$usuario['Mensaje'] = 'Se creo esta nueva negociaci&oacute;n con &eacute;xito!';
		
		$this->load->view('Despachador/DNegociacion3', $usuario);
	}
	
	// Funcion que agrega una negociacion de Instituciones //
	public function agregar_negociacion_2() 
	{
		$Usuario = $this->session->userdata('Usuario');
		$user = $Usuario;
		$id = $_POST['select2'];
		$Negociacion['Id_Institucion'] = $_POST['select2']; // Id Institucion //
		
		$Negociacion['Id_Empleado'] =  $this->modelCliente->BuscarId($user); // Id Vendedor //
		$Negociacion['FechaP'] = date("d/m/Y");
		$Negociacion['Status'] = 1;
		
		$this->modelNegociacion->NuevaNegociacion($Negociacion);
		
		// SEGUIMIENTO //
		$Seguimiento['FechaS'] = date("d/m/Y");
		$Seguimiento['TipoS'] = 'Inicial';
		$Seguimiento['Status'] = 'Borrador';
		$Seguimiento['Porcentaje'] = '25';
		
		$this->modelNegociacion->NuevoSeguimiento($Seguimiento);
		
		// NS (Tabla interseccion entre Negociacion y Seguimiento) //
		$IdNegociacion = $this->modelNegociacion->UltimaNegociacion();
		$NS['Id_Negociacion'] = $IdNegociacion;
		$IdSeguimiento = $this->modelNegociacion->UltimoSeguimiento();
		$NS['Id_Seguimiento'] = $IdNegociacion;
		$NS['FechaS'] = date("d/m/Y");
		$NS['TipoS'] = 'Inicial';
		$NS['Status'] = 'Borrador';
		
		$this->modelNegociacion->NuevaNS($NS);
		
		$NS2['Id_Negociacion'] = $IdNegociacion;
		$IdSeguimiento = $this->modelNegociacion->UltimoSeguimiento();
		$NS2['Id_Seguimiento'] = $IdNegociacion;
		$NS2['FechaS'] = date("d/m/Y");
		$NS2['TipoS'] = 'Inicial';
		$NS2['Status'] = 'Borrador';
		
		$this->modelNegociacion->NuevaNS2($NS2);
		
		$usuario['Usuario'] = $Usuario;
		$usuario['Id_Negociacion'] = $IdNegociacion;
		
		// ALERTA //
		$Alerta['Id_Negociacion'] = $IdNegociacion;
		$Alerta['Status'] = 0;
		$Alerta['Contador'] = 0;
		
		$this->modelNegociacion->NuevaAlerta($Alerta);
		
		// ALERTA MODIFICACION //
		$Alerta2['Id_Negociacion'] = $IdNegociacion;
		$Alerta2['Contador'] = 0;
		
		$this->modelNegociacion->NuevaAlerta2($Alerta2);
		
		// Buscar ultimo status de una negociacion //
		$statusmax = $this->modelNegociacion->IdMaxStatus($IdNegociacion);
		$idSeguimiento = $this->modelNegociacion->Idseguimiento($statusmax);
		$status = $this->modelNegociacion->status($idSeguimiento);
		
		$usuario['Status'] = $status;
		$usuario['Nombre'] = $this->modelInstitucion->BuscarNombreI($id);
		$usuario['TelfIns'] = $this->modelInstitucion->BuscarTelfI($id);
		
		$usuario['Mensaje'] = 'Se creo esta nueva negociaci&oacute;n con &eacute;xito!';
		
		$this->load->view('Despachador/DNegociacion4', $usuario);
	}
	
	public function ver_negociacion_asociadas() 
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario;
		$usuario2 = $Usuario;
		$Id = $this->modelCliente->BuscarId($usuario2);
		$cliente = $_POST['Cliente']; // id del cliente //
		$usuario['NombreC'] = $this->modelNegociacion->NombreCliente($cliente);
		$usuario['ApellidoC'] = $this->modelNegociacion->ApellidoCliente($cliente);
		$usuario['NBorrador'] = $this->modelNegociacion->NegociacionBorrador($cliente, $Id);
		$usuario['NActiva'] = $this->modelNegociacion->NegociacionActiva($cliente, $Id);
		$usuario['NGanada'] = $this->modelNegociacion->NegociacionGanada($cliente, $Id);
		$usuario['NCerrada'] = $this->modelNegociacion->NegociacionCerrada($cliente, $Id);
		$usuario['NPerdida'] = $this->modelNegociacion->NegociacionPerdida($cliente, $Id);
		$usuario['Cliente'] = $_POST['Cliente']; // id del cliente //
		$this->load->view('Despachador/DVerNegociacion2', $usuario);
	}
	
	public function atras_negociacion_2() 
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario;
		$usuario2 = $Usuario;
		$Id = $this->modelCliente->BuscarId($usuario2);
		$usuario['Institucion'] = $this->modelNegociacion->MisInstituciones($Id);
		$this->load->view('Despachador/DVerNegociacionI', $usuario);
	}
	
	public function ver_negociacion_asociadas2() 
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario;
		$usuario2 = $Usuario;
		$Id = $this->modelCliente->BuscarId($usuario2);
		$cliente = $_POST['Cliente']; // id del cliente //
		$usuario['NombreI'] = $this->modelNegociacion->NombreInstitucion($cliente);
		$usuario['NBorrador'] = $this->modelNegociacion->NegociacionBorradorI($cliente, $Id);
		$usuario['NActiva'] = $this->modelNegociacion->NegociacionActivaI($cliente, $Id);
		$usuario['NGanada'] = $this->modelNegociacion->NegociacionGanadaI($cliente, $Id);
		$usuario['NCerrada'] = $this->modelNegociacion->NegociacionCerradaI($cliente, $Id);
		$usuario['NPerdida'] = $this->modelNegociacion->NegociacionPerdidaI($cliente, $Id);
		$usuario['Cliente'] = $_POST['Cliente']; // id del cliente //
		$this->load->view('Despachador/DVerNegociacionI2', $usuario);
	}
	
	
}