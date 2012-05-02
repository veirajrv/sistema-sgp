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
			$usuario['Ganadas2'] = $this->modelventa->NumNegoGanadas(); 
				
			$usuario['NoFacturadas'] = $this->modelventa->NoFacturadas(); 
			$usuario['NoFacturadas2'] = $this->modelventa->NumNoFacturadas();
				
			$usuario['SiFacturadas'] = $this->modelventa->NumFacturadas();
			
			$this->load->view('Despachador/DPrincipal', $usuario);
		}
		else 
		{
			$usuario['Ganadas'] = $this->modelventa->NegoGanadas(); 
			$usuario['Ganadas2'] = $this->modelventa->NumNegoGanadas(); 
				
			$usuario['NoFacturadas'] = $this->modelventa->NoFacturadas(); 
			$usuario['NoFacturadas2'] = $this->modelventa->NumNoFacturadas();
				
			$usuario['SiFacturadas'] = $this->modelventa->NumFacturadas();
			
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
			$usuario['Ganadas2'] = $this->modelventa->NumNegoGanadas(); 
		
			$usuario['NoFacturadas'] = $this->modelventa->NoFacturadas(); 
			$usuario['NoFacturadas2'] = $this->modelventa->NumNoFacturadas();
		
			$usuario['SiFacturadas'] = $this->modelventa->NumFacturadas();
		
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
			$usuario['Ganadas2'] = $this->modelventa->NumNegoGanadas(); 
		
			$usuario['NoFacturadas'] = $this->modelventa->NoFacturadas(); 
			$usuario['NoFacturadas2'] = $this->modelventa->NumNoFacturadas();
		
			$usuario['SiFacturadas'] = $this->modelventa->NumFacturadas();
			
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
	
	public function ver_negociacion_tipo() 
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario;
		$usuario2 = $Usuario;
		$Id = $this->modelCliente->BuscarId($usuario2);
		$usuario['Cliente'] = $_POST['IdCliente']; // id del cliente //
		$usuario['NombreC'] = $_POST['Nombre']; 
		$usuario['Nego'] = $_POST['Nego']; 
		$usuario['ApellidoC'] = $_POST['Apellido']; 
		$this->load->view('Despachador/DOpcionesTipo', $usuario);
	}
	
	public function ver_negociacion_tipo2() 
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario;
		$usuario2 = $Usuario;
		$Id = $this->modelCliente->BuscarId($usuario2);
		$usuario['Cliente'] = $_POST['IdCliente']; // id del cliente //
		$usuario['NombreI'] = $_POST['Nombre']; 
		$usuario['Nego'] = $_POST['Nego']; 
		$this->load->view('Despachador/DOpcionesTipo2', $usuario);
	}
	
	// FUNCION QUE INICIA LA PANTALLA PRINCIPAL DE CADA VISTA DE NEGOCIACION //
	public function borrador_equipo($cliente, $IdNegoBorrador)
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario; 
		$usuario['Id_Negociacion'] = $IdNegoBorrador; 
		$Id = $this->modelCliente->BuscarId($Usuario); 
		$status = $this->modelNegociacion->StatusNegociacion($IdNegoBorrador); 
		$porcentaje = $this->modelNegociacion->PorcentajeNegociacion($IdNegoBorrador); 
		$usuario['Status'] = $status;
		$usuario['Porcentaje'] = $porcentaje;
		
		// DATOS DE LA NEGOCIACION //
		$usuario['FechaP'] = $this->modelNegociacion->FechaPresupuesto($IdNegoBorrador);
		$usuario['NumeroODC'] = $this->modelNegociacion->NumeroOrdenDC($IdNegoBorrador);
		$usuario['FechaODC'] = $this->modelNegociacion->FechaOrdenDC($IdNegoBorrador);
		$usuario['Banco'] = $this->modelNegociacion->Banco($IdNegoBorrador);
		$usuario['PagoInicial'] = $this->modelNegociacion->PagoInicial($IdNegoBorrador);
		$usuario['CondicionesPago'] = $this->modelNegociacion->CondicionesPago($IdNegoBorrador);
		$usuario['FechaPago'] = $this->modelNegociacion->FechaDePago($IdNegoBorrador);
		$usuario['NDeposito'] = $this->modelNegociacion->NumeroDeposito($IdNegoBorrador);
		
		// DATOS DEL CLIENTE //
		$usuario['Id'] = $cliente;
		$usuario['NombreC'] = $this->modelNegociacion->NombreCliente($cliente);
		$usuario['ApellidoC'] = $this->modelNegociacion->ApellidoCliente($cliente);
		$usuario['EMailC'] = $this->modelNegociacion->MailCliente($cliente);
		$usuario['TelefonoC'] = $this->modelNegociacion->TelefonoCliente($cliente);
		
		$usuario['Marca'] = $this->modelProducto->MarcaProducto();
		
		$usuario['Lista'] = $this->modelProducto->ConsultarListaA($IdNegoBorrador);
		
		$this->load->view('Despachador/Borrador/DConsultarBorrador', $usuario);
	}
	
	// FUNCION QUE INICIA LA PANTALLA PRINCIPAL DE CADA VISTA DE NEGOCIACION //
	public function borrador_accesorio($cliente, $IdNegoBorrador)
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario; 
		$usuario['Id_Negociacion'] = $IdNegoBorrador; 
		$Id = $this->modelCliente->BuscarId($Usuario); 
		$status = $this->modelNegociacion->StatusNegociacion($IdNegoBorrador); 
		$porcentaje = $this->modelNegociacion->PorcentajeNegociacion($IdNegoBorrador); 
		$usuario['Status'] = $status;
		$usuario['Porcentaje'] = $porcentaje;
		
		// DATOS DE LA NEGOCIACION //
		$usuario['FechaP'] = $this->modelNegociacion->FechaPresupuesto($IdNegoBorrador);
		$usuario['NumeroODC'] = $this->modelNegociacion->NumeroOrdenDC($IdNegoBorrador);
		$usuario['FechaODC'] = $this->modelNegociacion->FechaOrdenDC($IdNegoBorrador);
		$usuario['Banco'] = $this->modelNegociacion->Banco($IdNegoBorrador);
		$usuario['PagoInicial'] = $this->modelNegociacion->PagoInicial($IdNegoBorrador);
		$usuario['CondicionesPago'] = $this->modelNegociacion->CondicionesPago($IdNegoBorrador);
		$usuario['FechaPago'] = $this->modelNegociacion->FechaDePago($IdNegoBorrador);
		$usuario['NDeposito'] = $this->modelNegociacion->NumeroDeposito($IdNegoBorrador);
		
		// DATOS DEL CLIENTE //
		$usuario['Id'] = $cliente;
		$usuario['NombreC'] = $this->modelNegociacion->NombreCliente($cliente);
		$usuario['ApellidoC'] = $this->modelNegociacion->ApellidoCliente($cliente);
		$usuario['EMailC'] = $this->modelNegociacion->MailCliente($cliente);
		$usuario['TelefonoC'] = $this->modelNegociacion->TelefonoCliente($cliente);
		
		$usuario['Marca'] = $this->modelProducto->MarcaProducto();
		$usuario['Lista'] = $this->modelProducto->ConsultarListaB($IdNegoBorrador);
		
		$this->load->view('Despachador/Borrador/DConsultarBorrador2', $usuario);
	}
	
	public function borrador_i_equipo($cliente, $IdNegoBorrador) 
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario; // Usuario //
		$usuario['Id_Negociacion'] = $IdNegoBorrador; // Id negociacion //
		$Id = $this->modelCliente->BuscarId($Usuario); // Id del usuario //
		$status = $this->modelNegociacion->StatusNegociacion($IdNegoBorrador); 
		$porcentaje = $this->modelNegociacion->PorcentajeNegociacion($IdNegoBorrador); 
		$usuario['Porcentaje'] = $porcentaje;
		$usuario['Status'] = $status;
		
		// DATOS DE LA NEGOCIACION //
		$usuario['FechaP'] = $this->modelNegociacion->FechaPresupuesto($IdNegoBorrador);
		$usuario['NumeroODC'] = $this->modelNegociacion->NumeroOrdenDC($IdNegoBorrador);
		$usuario['FechaODC'] = $this->modelNegociacion->FechaOrdenDC($IdNegoBorrador);
		$usuario['Banco'] = $this->modelNegociacion->Banco($IdNegoBorrador);
		$usuario['PagoInicial'] = $this->modelNegociacion->PagoInicial($IdNegoBorrador);
		$usuario['CondicionesPago'] = $this->modelNegociacion->CondicionesPago($IdNegoBorrador);
		$usuario['FechaPago'] = $this->modelNegociacion->FechaDePago($IdNegoBorrador);
		$usuario['NDeposito'] = $this->modelNegociacion->NumeroDeposito($IdNegoBorrador);
		
		// DATOS DEL CLIENTE //
		$usuario['Id'] = $cliente;
		$usuario['NombreI'] = $this->modelNegociacion->NombreInstitucion($cliente);
		$usuario['TelefonoI'] = $this->modelNegociacion->TelefonoInstitucion($cliente);
		
		$usuario['Marca'] = $this->modelProducto->MarcaProducto();
		$usuario['Lista'] = $this->modelProducto->ConsultarListaA($IdNegoBorrador);
		
		$this->load->view('Despachador/Borrador/DConsultarBorradorI', $usuario);
	}
	
	public function borrador_i_accesorio($cliente, $IdNegoBorrador) 
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario; // Usuario //
		$usuario['Id_Negociacion'] = $IdNegoBorrador; // Id negociacion //
		$Id = $this->modelCliente->BuscarId($Usuario); // Id del usuario //
		$status = $this->modelNegociacion->StatusNegociacion($IdNegoBorrador); 
		$porcentaje = $this->modelNegociacion->PorcentajeNegociacion($IdNegoBorrador); 
		$usuario['Porcentaje'] = $porcentaje;
		$usuario['Status'] = $status;
		
		// DATOS DE LA NEGOCIACION //
		$usuario['FechaP'] = $this->modelNegociacion->FechaPresupuesto($IdNegoBorrador);
		$usuario['NumeroODC'] = $this->modelNegociacion->NumeroOrdenDC($IdNegoBorrador);
		$usuario['FechaODC'] = $this->modelNegociacion->FechaOrdenDC($IdNegoBorrador);
		$usuario['Banco'] = $this->modelNegociacion->Banco($IdNegoBorrador);
		$usuario['PagoInicial'] = $this->modelNegociacion->PagoInicial($IdNegoBorrador);
		$usuario['CondicionesPago'] = $this->modelNegociacion->CondicionesPago($IdNegoBorrador);
		$usuario['FechaPago'] = $this->modelNegociacion->FechaDePago($IdNegoBorrador);
		$usuario['NDeposito'] = $this->modelNegociacion->NumeroDeposito($IdNegoBorrador);
		
		// DATOS DEL CLIENTE //
		$usuario['Id'] = $cliente;
		$usuario['NombreI'] = $this->modelNegociacion->NombreInstitucion($cliente);
		$usuario['TelefonoI'] = $this->modelNegociacion->TelefonoInstitucion($cliente);
		
		$usuario['Marca'] = $this->modelProducto->MarcaProducto();
		$usuario['Lista'] = $this->modelProducto->ConsultarListaB($IdNegoBorrador);
		
		$this->load->view('Despachador/Borrador/DConsultarBorradorI2', $usuario);
	}
	
	public function cambio_status($Id_Negociacion, $Id) 
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario; 
		$usuario['Id_Negociacion'] = $Id_Negociacion;
		$usuario['Cliente'] = $Id;
		$this->load->view('Despachador/DCambioStatus', $usuario);
	}
	
	public function cambio_status2($Id_Negociacion, $Id) 
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario; 
		$usuario['Id_Negociacion'] = $Id_Negociacion;
		$usuario['Cliente'] = $Id;
		$this->load->view('Despachador/DCambioStatus2', $usuario);
	}
	
	public function cambio_status_i($Id_Negociacion, $Id) 
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario; 
		$usuario['Id_Negociacion'] = $Id_Negociacion;
		$usuario['Cliente'] = $Id;
		$this->load->view('Despachador/DCambioStatusI', $usuario);
	}
	
	public function cambio_status_i3($Id_Negociacion, $Id) 
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario; 
		$usuario['Id_Negociacion'] = $Id_Negociacion;
		$usuario['Cliente'] = $Id;
		$this->load->view('Despachador/DCambioStatusI2', $usuario);
	}
	
	public function ir_negociacion($Id_Negociacion)
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario; // Id Negociacion //
		$usuario['Id_Negociacion'] = $Id_Negociacion;
		$Id_Negociacion = $Id_Negociacion;
		$Id_Cliente = $this->modelCliente->BuscarIdCliente($Id_Negociacion);
		$Id_ClienteI = $this->modelNegociacion->BuscarClienteI($Id_Negociacion); // Id cliente institucion //
		
		$status = $this->modelNegociacion->StatusNegociacion($Id_Negociacion); 
		if($status == 'Borrador' or $status == 'Activa')
		{
			if ($Id_Cliente == NULL) // Aqui entra si el cliente es una institucion //
			{
				$status = $this->modelNegociacion->StatusNegociacion($Id_Negociacion); 
				$porcentaje = $this->modelNegociacion->PorcentajeNegociacion($Id_Negociacion); 
				$usuario['Status'] = $status;
				$usuario['Porcentaje'] = $porcentaje;
			
				$usuario['FechaP'] = $this->modelNegociacion->FechaPresupuesto($Id_Negociacion);
				$usuario['NumeroODC'] = $this->modelNegociacion->NumeroOrdenDC($Id_Negociacion);
				$usuario['FechaODC'] = $this->modelNegociacion->FechaOrdenDC($Id_Negociacion);
				$usuario['Banco'] = $this->modelNegociacion->Banco($Id_Negociacion);
				$usuario['PagoInicial'] = $this->modelNegociacion->PagoInicial($Id_Negociacion);
				$usuario['CondicionesPago'] = $this->modelNegociacion->CondicionesPago($Id_Negociacion);
				$usuario['FechaPago'] = $this->modelNegociacion->FechaDePago($Id_Negociacion);
				$usuario['NDeposito'] = $this->modelNegociacion->NumeroDeposito($Id_Negociacion);
				
				$usuario['Id'] = $Id_ClienteI;
				$usuario['NombreI'] = $this->modelNegociacion->NombreInstitucion($Id_ClienteI);
				$usuario['TelefonoI'] = $this->modelNegociacion->TelefonoInstitucion($Id_ClienteI);
				
				$usuario['Marca'] = $this->modelProducto->MarcaProducto();
				$usuario['Lista'] = $this->modelProducto->ConsultarListaA($Id_Negociacion);
				
				$usuario['Total'] = $this->modelProducto->TotalI($Id_Negociacion);
				$usuario['Marca'] = $this->modelProducto->MarcaProducto();
				
				$this->load->view('Despachador/Borrador/DConsultarBorradorI', $usuario);
			}
			else // Aqui entra si el cliente es una persona //
			{
				$status = $this->modelNegociacion->StatusNegociacion($Id_Negociacion); 
				$porcentaje = $this->modelNegociacion->PorcentajeNegociacion($Id_Negociacion); 
				$usuario['Status'] = $status;
				$usuario['Porcentaje'] = $porcentaje;
			
				$usuario['FechaP'] = $this->modelNegociacion->FechaPresupuesto($Id_Negociacion);
				$usuario['NumeroODC'] = $this->modelNegociacion->NumeroOrdenDC($Id_Negociacion);
				$usuario['FechaODC'] = $this->modelNegociacion->FechaOrdenDC($Id_Negociacion);
				$usuario['Banco'] = $this->modelNegociacion->Banco($Id_Negociacion);
				$usuario['PagoInicial'] = $this->modelNegociacion->PagoInicial($Id_Negociacion);
				$usuario['CondicionesPago'] = $this->modelNegociacion->CondicionesPago($Id_Negociacion);
				$usuario['FechaPago'] = $this->modelNegociacion->FechaDePago($Id_Negociacion);
				$usuario['NDeposito'] = $this->modelNegociacion->NumeroDeposito($Id_Negociacion);
				
				$usuario['Id'] = $Id_Cliente;
				$usuario['NombreC'] = $this->modelNegociacion->NombreCliente($Id_Cliente);
				$usuario['ApellidoC'] = $this->modelNegociacion->ApellidoCliente($Id_Cliente);
				$usuario['EMailC'] = $this->modelNegociacion->MailCliente($Id_Cliente);
				$usuario['TelefonoC'] = $this->modelNegociacion->TelefonoCliente($Id_Cliente);
				
				$usuario['Marca'] = $this->modelProducto->MarcaProducto();
				$usuario['Lista'] = $this->modelProducto->ConsultarListaA($Id_Negociacion);
				$usuario['Total'] = $this->modelProducto->Total($Id_Negociacion);
				
				$this->load->view('Despachador/Borrador/DConsultarBorrador', $usuario);
			}
		}
		else
		{
			if ($Id_Cliente == NULL) // Aqui entra si el cliente es una institucion //
			{
				$status = $this->modelNegociacion->StatusNegociacion($Id_Negociacion); 
				$porcentaje = $this->modelNegociacion->PorcentajeNegociacion($Id_Negociacion); 
				$usuario['Porcentaje'] = $porcentaje;
				$usuario['Status'] = $status;
			
				$usuario['FechaP'] = $this->modelNegociacion->FechaPresupuesto($Id_Negociacion);
				$usuario['NumeroODC'] = $this->modelNegociacion->NumeroOrdenDC($Id_Negociacion);
				$usuario['FechaODC'] = $this->modelNegociacion->FechaOrdenDC($Id_Negociacion);
				$usuario['Banco'] = $this->modelNegociacion->Banco($Id_Negociacion);
				$usuario['PagoInicial'] = $this->modelNegociacion->PagoInicial($Id_Negociacion);
				$usuario['CondicionesPago'] = $this->modelNegociacion->CondicionesPago($Id_Negociacion);
				$usuario['FechaPago'] = $this->modelNegociacion->FechaDePago($Id_Negociacion);
				$usuario['NDeposito'] = $this->modelNegociacion->NumeroDeposito($Id_Negociacion);
				
				$usuario['Id'] = $Id_ClienteI;
				$usuario['NombreI'] = $this->modelNegociacion->NombreInstitucion($Id_ClienteI);
				$usuario['TelefonoI'] = $this->modelNegociacion->TelefonoInstitucion($Id_ClienteI);
				
				$usuario['Marca'] = $this->modelProducto->MarcaProducto();
				$usuario['Lista'] = $this->modelProducto->ConsultarListaA($Id_Negociacion);
				
				$usuario['Total'] = $this->modelProducto->TotalI($Id_Negociacion);
				
				$this->load->view('Vendedor/Cerrada/VConsultaCerradaI', $usuario);
			}
			else // Aqui entra si el cliente es una persona //
			{
				$status = $this->modelNegociacion->StatusNegociacion($Id_Negociacion); 
				$porcentaje = $this->modelNegociacion->PorcentajeNegociacion($Id_Negociacion); 
				$usuario['Porcentaje'] = $porcentaje;
				$usuario['Status'] = $status;
			
				$usuario['FechaP'] = $this->modelNegociacion->FechaPresupuesto($Id_Negociacion);
				$usuario['NumeroODC'] = $this->modelNegociacion->NumeroOrdenDC($Id_Negociacion);
				$usuario['FechaODC'] = $this->modelNegociacion->FechaOrdenDC($Id_Negociacion);
				$usuario['Banco'] = $this->modelNegociacion->Banco($Id_Negociacion);
				$usuario['PagoInicial'] = $this->modelNegociacion->PagoInicial($Id_Negociacion);
				$usuario['CondicionesPago'] = $this->modelNegociacion->CondicionesPago($Id_Negociacion);
				$usuario['FechaPago'] = $this->modelNegociacion->FechaDePago($Id_Negociacion);
				$usuario['NDeposito'] = $this->modelNegociacion->NumeroDeposito($Id_Negociacion);
				
				$usuario['Id'] = $Id_Cliente;
				$usuario['NombreC'] = $this->modelNegociacion->NombreCliente($Id_Cliente);
				$usuario['ApellidoC'] = $this->modelNegociacion->ApellidoCliente($Id_Cliente);
				$usuario['EMailC'] = $this->modelNegociacion->MailCliente($Id_Cliente);
				$usuario['TelefonoC'] = $this->modelNegociacion->TelefonoCliente($Id_Cliente);
			
				$usuario['Lista'] = $this->modelProducto->ConsultarListaA($Id_Negociacion);
				$usuario['Total'] = $this->modelProducto->Total($Id_Negociacion);
				$usuario['Marca'] = $this->modelProducto->MarcaProducto();
				
				$this->load->view('Vendedor/Cerrada/VConsultaCerrada', $usuario);
			}
		}
	}
	
	public function ir_negociacion2($Id_Negociacion)
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario; // Id Negociacion //
		$usuario['Id_Negociacion'] = $Id_Negociacion;
		$Id_Negociacion = $Id_Negociacion;
		$Id_Cliente = $this->modelCliente->BuscarIdCliente($Id_Negociacion);
		$Id_ClienteI = $this->modelNegociacion->BuscarClienteI($Id_Negociacion); // Id cliente institucion //
		
		$status = $this->modelNegociacion->StatusNegociacion($Id_Negociacion); 
		if($status == 'Borrador' or $status == 'Activa')
		{
			if ($Id_Cliente == NULL) // Aqui entra si el cliente es una institucion //
			{
				$status = $this->modelNegociacion->StatusNegociacion($Id_Negociacion); 
				$porcentaje = $this->modelNegociacion->PorcentajeNegociacion($Id_Negociacion); 
				$usuario['Status'] = $status;
				$usuario['Porcentaje'] = $porcentaje;
			
				$usuario['FechaP'] = $this->modelNegociacion->FechaPresupuesto($Id_Negociacion);
				$usuario['NumeroODC'] = $this->modelNegociacion->NumeroOrdenDC($Id_Negociacion);
				$usuario['FechaODC'] = $this->modelNegociacion->FechaOrdenDC($Id_Negociacion);
				$usuario['Banco'] = $this->modelNegociacion->Banco($Id_Negociacion);
				$usuario['PagoInicial'] = $this->modelNegociacion->PagoInicial($Id_Negociacion);
				$usuario['CondicionesPago'] = $this->modelNegociacion->CondicionesPago($Id_Negociacion);
				$usuario['FechaPago'] = $this->modelNegociacion->FechaDePago($Id_Negociacion);
				$usuario['NDeposito'] = $this->modelNegociacion->NumeroDeposito($Id_Negociacion);
				
				$usuario['Id'] = $Id_ClienteI;
				$usuario['NombreI'] = $this->modelNegociacion->NombreInstitucion($Id_ClienteI);
				$usuario['TelefonoI'] = $this->modelNegociacion->TelefonoInstitucion($Id_ClienteI);
				
				$usuario['Lista'] = $this->modelProducto->ConsultarListaB($Id_Negociacion);
				$usuario['Marca'] = $this->modelProducto->MarcaProducto();
				
				$usuario['Total'] = $this->modelProducto->TotalI($Id_Negociacion);
				$usuario['Marca'] = $this->modelProducto->MarcaProducto();
				
				$this->load->view('Despachador/Borrador/DConsultarBorradorI2', $usuario);
			}
			else // Aqui entra si el cliente es una persona //
			{
				$status = $this->modelNegociacion->StatusNegociacion($Id_Negociacion); 
				$porcentaje = $this->modelNegociacion->PorcentajeNegociacion($Id_Negociacion); 
				$usuario['Status'] = $status;
				$usuario['Porcentaje'] = $porcentaje;
			
				$usuario['FechaP'] = $this->modelNegociacion->FechaPresupuesto($Id_Negociacion);
				$usuario['NumeroODC'] = $this->modelNegociacion->NumeroOrdenDC($Id_Negociacion);
				$usuario['FechaODC'] = $this->modelNegociacion->FechaOrdenDC($Id_Negociacion);
				$usuario['Banco'] = $this->modelNegociacion->Banco($Id_Negociacion);
				$usuario['PagoInicial'] = $this->modelNegociacion->PagoInicial($Id_Negociacion);
				$usuario['CondicionesPago'] = $this->modelNegociacion->CondicionesPago($Id_Negociacion);
				$usuario['FechaPago'] = $this->modelNegociacion->FechaDePago($Id_Negociacion);
				$usuario['NDeposito'] = $this->modelNegociacion->NumeroDeposito($Id_Negociacion);
				
				$usuario['Id'] = $Id_Cliente;
				$usuario['NombreC'] = $this->modelNegociacion->NombreCliente($Id_Cliente);
				$usuario['ApellidoC'] = $this->modelNegociacion->ApellidoCliente($Id_Cliente);
				$usuario['EMailC'] = $this->modelNegociacion->MailCliente($Id_Cliente);
				$usuario['TelefonoC'] = $this->modelNegociacion->TelefonoCliente($Id_Cliente);
				
				$usuario['Lista'] = $this->modelProducto->ConsultarListaB($Id_Negociacion);
				$usuario['Marca'] = $this->modelProducto->MarcaProducto();
				$usuario['Total'] = $this->modelProducto->Total($Id_Negociacion);
				
				$this->load->view('Despachador/Borrador/DConsultarBorrador2', $usuario);
			}
		}
		else
		{
			if ($Id_Cliente == NULL) // Aqui entra si el cliente es una institucion //
			{
				$status = $this->modelNegociacion->StatusNegociacion($Id_Negociacion); 
				$porcentaje = $this->modelNegociacion->PorcentajeNegociacion($Id_Negociacion); 
				$usuario['Porcentaje'] = $porcentaje;
				$usuario['Status'] = $status;
			
				$usuario['FechaP'] = $this->modelNegociacion->FechaPresupuesto($Id_Negociacion);
				$usuario['NumeroODC'] = $this->modelNegociacion->NumeroOrdenDC($Id_Negociacion);
				$usuario['FechaODC'] = $this->modelNegociacion->FechaOrdenDC($Id_Negociacion);
				$usuario['Banco'] = $this->modelNegociacion->Banco($Id_Negociacion);
				$usuario['PagoInicial'] = $this->modelNegociacion->PagoInicial($Id_Negociacion);
				$usuario['CondicionesPago'] = $this->modelNegociacion->CondicionesPago($Id_Negociacion);
				$usuario['FechaPago'] = $this->modelNegociacion->FechaDePago($Id_Negociacion);
				$usuario['NDeposito'] = $this->modelNegociacion->NumeroDeposito($Id_Negociacion);
				
				$usuario['Id'] = $Id_ClienteI;
				$usuario['NombreI'] = $this->modelNegociacion->NombreInstitucion($Id_ClienteI);
				$usuario['TelefonoI'] = $this->modelNegociacion->TelefonoInstitucion($Id_ClienteI);
				
				$usuario['Marca'] = $this->modelProducto->MarcaProducto();
				$usuario['Lista'] = $this->modelProducto->ConsultarListaA($Id_Negociacion);
				
				$usuario['Total'] = $this->modelProducto->TotalI($Id_Negociacion);
				
				$this->load->view('Despachador/Cerrada/DConsultaCerradaI', $usuario);
			}
			else // Aqui entra si el cliente es una persona //
			{
				$status = $this->modelNegociacion->StatusNegociacion($Id_Negociacion); 
				$porcentaje = $this->modelNegociacion->PorcentajeNegociacion($Id_Negociacion); 
				$usuario['Porcentaje'] = $porcentaje;
				$usuario['Status'] = $status;
			
				$usuario['FechaP'] = $this->modelNegociacion->FechaPresupuesto($Id_Negociacion);
				$usuario['NumeroODC'] = $this->modelNegociacion->NumeroOrdenDC($Id_Negociacion);
				$usuario['FechaODC'] = $this->modelNegociacion->FechaOrdenDC($Id_Negociacion);
				$usuario['Banco'] = $this->modelNegociacion->Banco($Id_Negociacion);
				$usuario['PagoInicial'] = $this->modelNegociacion->PagoInicial($Id_Negociacion);
				$usuario['CondicionesPago'] = $this->modelNegociacion->CondicionesPago($Id_Negociacion);
				$usuario['FechaPago'] = $this->modelNegociacion->FechaDePago($Id_Negociacion);
				$usuario['NDeposito'] = $this->modelNegociacion->NumeroDeposito($Id_Negociacion);
				
				$usuario['Id'] = $Id_Cliente;
				$usuario['NombreC'] = $this->modelNegociacion->NombreCliente($Id_Cliente);
				$usuario['ApellidoC'] = $this->modelNegociacion->ApellidoCliente($Id_Cliente);
				$usuario['EMailC'] = $this->modelNegociacion->MailCliente($Id_Cliente);
				$usuario['TelefonoC'] = $this->modelNegociacion->TelefonoCliente($Id_Cliente);
			
				$usuario['Lista'] = $this->modelProducto->ConsultarListaA($Id_Negociacion);
				$usuario['Total'] = $this->modelProducto->Total($Id_Negociacion);
				$usuario['Marca'] = $this->modelProducto->MarcaProducto();
				
				$this->load->view('Despachador/Cerrada/DConsultaCerrada', $usuario);
			}
		}
	}
	
	// CAMBIO DE ESTATUS DE UNA NEGOCIACION //
	public function cambio_status_2($Id_Negociacion)
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario; 
		$usuario2 = $Usuario;
		$Id = $this->modelCliente->BuscarId($usuario2);
		$usuario['Id_Negociacion'] = $Id_Negociacion;
		$datos['ID2'] = $Id_Negociacion;
		$IdSeguimiento = $this->modelNegociacion->BuscarSeguimiento($Id_Negociacion);
		$cedula = $this->modelCliente->BuscarId($Usuario);
		$nombre = $this->modelCliente->NombreVendedor($cedula);
		$apellido = $this->modelCliente->ApellidoVendedor($cedula);
		
		$Seguimiento = new ModelNegociacion;
		$this->modelNegociacion->ModificarStatus($Seguimiento, $datos);
		$this->modelNegociacion->HistorialStatus($Seguimiento, $datos);
		
		$cliente = $_POST['Cliente']; // id del cliente //
		$status = $this->modelNegociacion->StatusNegociacion($Id_Negociacion); 
		
		//$this->load->library('email');  
		//$this->email->from('jrodriguezv.11@gmail.com','Sistema de gestion SGP');  
		//$this->email->to("jrodriguezv.11@gmail.com"); // Mail de la jefa de YOMA //
		//$this->email->subject(''.$nombre.' '.$apellido.' a cambiado la negociacion ( '.$Id_Negociacion.' ) a '.$status.'');  
		//$this->email->message("Para acceder a dicha notificacion, haga clic en el siguiente link elp21.no-ip.info:4085/SGP");  
		//$this->email->send(); 
		
		$usuario['NombreC'] = $this->modelNegociacion->NombreCliente($cliente);
		$usuario['ApellidoC'] = $this->modelNegociacion->ApellidoCliente($cliente);
		$usuario['NBorrador'] = $this->modelNegociacion->NegociacionBorrador($cliente, $Id);
		$usuario['NActiva'] = $this->modelNegociacion->NegociacionActiva($cliente, $Id);
		$usuario['NGanada'] = $this->modelNegociacion->NegociacionGanada($cliente, $Id);
		$usuario['NCerrada'] = $this->modelNegociacion->NegociacionCerrada($cliente, $Id);
		$usuario['NPerdida'] = $this->modelNegociacion->NegociacionPerdida($cliente, $Id);
		$usuario['Cliente'] = $_POST['Cliente'];
		
		$usuario['Mensaje'] = 'Se cambio el status con &eacute;xito!';
		
		$Lista = $this->modelNegociacion->HistorialLista($Id_Negociacion);
		
		$this->load->library('table');
		$this->table->set_empty("&nbsp;");
		$this->table->set_heading('<font style="font-size:12px" color="#369"><b>Status</b></font>', '<font style="font-size:12px" color="#369"><b>Fecha</b></font>', '<font style="font-size:12px" color="#369"><b>Tipo de contacto</b></font>', '<font style="font-size:12px" color="#369"><b>Resumen</b></font>');
		
	
		foreach ($Lista as $row)
		{
			$status = $row['Status'];
			$fecha = $row['FechaS'];
			$tipo = $row['TipoS'];
			$resumen = $row['Resumen'];
			$this->table->add_row($status, $fecha, $tipo, $resumen);
		}
			
		$usuario['table'] = $this->table->generate();
		
		$this->load->view('Despachador/Borrador/DHistorialStatus', $usuario);
	}
	
	public function cambio_status_22($Id_Negociacion)
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario; 
		$usuario2 = $Usuario;
		$Id = $this->modelCliente->BuscarId($usuario2);
		$usuario['Id_Negociacion'] = $Id_Negociacion;
		$datos['ID2'] = $Id_Negociacion;
		$IdSeguimiento = $this->modelNegociacion->BuscarSeguimiento($Id_Negociacion);
		$cedula = $this->modelCliente->BuscarId($Usuario);
		$nombre = $this->modelCliente->NombreVendedor($cedula);
		$apellido = $this->modelCliente->ApellidoVendedor($cedula);
		
		$Seguimiento = new ModelNegociacion;
		$this->modelNegociacion->ModificarStatus($Seguimiento, $datos);
		$this->modelNegociacion->HistorialStatus($Seguimiento, $datos);
		
		$cliente = $_POST['Cliente']; // id del cliente //
		$status = $this->modelNegociacion->StatusNegociacion($Id_Negociacion); 
		
		//$this->load->library('email');  
		//$this->email->from('jrodriguezv.11@gmail.com','Sistema de gestion SGP');  
		//$this->email->to("jrodriguezv.11@gmail.com"); // Mail de la jefa de YOMA //
		//$this->email->subject(''.$nombre.' '.$apellido.' a cambiado la negociacion ( '.$Id_Negociacion.' ) a '.$status.'');  
		//$this->email->message("Para acceder a dicha notificacion, haga clic en el siguiente link elp21.no-ip.info:4085/SGP");  
		//$this->email->send(); 
		
		$usuario['NombreC'] = $this->modelNegociacion->NombreCliente($cliente);
		$usuario['ApellidoC'] = $this->modelNegociacion->ApellidoCliente($cliente);
		$usuario['NBorrador'] = $this->modelNegociacion->NegociacionBorrador($cliente, $Id);
		$usuario['NActiva'] = $this->modelNegociacion->NegociacionActiva($cliente, $Id);
		$usuario['NGanada'] = $this->modelNegociacion->NegociacionGanada($cliente, $Id);
		$usuario['NCerrada'] = $this->modelNegociacion->NegociacionCerrada($cliente, $Id);
		$usuario['NPerdida'] = $this->modelNegociacion->NegociacionPerdida($cliente, $Id);
		$usuario['Cliente'] = $_POST['Cliente'];
		
		$usuario['Mensaje'] = 'Se cambio el status con &eacute;xito!';
		
		$Lista = $this->modelNegociacion->HistorialLista($Id_Negociacion);
		
		$this->load->library('table');
		$this->table->set_empty("&nbsp;");
		$this->table->set_heading('<font style="font-size:12px" color="#369"><b>Status</b></font>', '<font style="font-size:12px" color="#369"><b>Fecha</b></font>', '<font style="font-size:12px" color="#369"><b>Tipo de contacto</b></font>', '<font style="font-size:12px" color="#369"><b>Resumen</b></font>');
		
	
		foreach ($Lista as $row)
		{
			$status = $row['Status'];
			$fecha = $row['FechaS'];
			$tipo = $row['TipoS'];
			$resumen = $row['Resumen'];
			$this->table->add_row($status, $fecha, $tipo, $resumen);
		}
			
		$usuario['table'] = $this->table->generate();
		
		$this->load->view('Despachador/Borrador/DHistorialStatus2', $usuario);
	}
	
	public function cambio_status_i2($Id_Negociacion)
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario; 
		$usuario2 = $Usuario;
		$Id = $this->modelCliente->BuscarId($usuario2);
		$usuario['Id_Negociacion'] = $Id_Negociacion;
		$datos['ID2'] = $Id_Negociacion;
		$IdSeguimiento = $this->modelNegociacion->BuscarSeguimiento($Id_Negociacion);
		$cedula = $this->modelCliente->BuscarId($Usuario);
		$nombre = $this->modelCliente->NombreVendedor($cedula);
		$apellido = $this->modelCliente->ApellidoVendedor($cedula);
		
		$Seguimiento = new ModelNegociacion;
		$this->modelNegociacion->ModificarStatus($Seguimiento, $datos);
		$this->modelNegociacion->HistorialStatus($Seguimiento, $datos);
		
		$cliente = $_POST['Cliente']; // id del cliente //
		$status = $this->modelNegociacion->StatusNegociacion($Id_Negociacion); 
		
		//$this->load->library('email');  
		//$this->email->from('jrodriguezv.11@gmail.com','Sistema de gestion SGP');  
		//$this->email->to("jrodriguezv.11@gmail.com"); // Mail de la jefa de YOMA //
		//$this->email->subject(''.$nombre.' '.$apellido.' a cambiado la negociacion ( '.$Id_Negociacion.' ) a '.$status.'');  
		//$this->email->message("Para acceder a dicha notificacion, haga clic en el siguiente link elp21.no-ip.info:4085/SGP");  
		//$this->email->send(); 
		
		$usuario['NombreC'] = $this->modelNegociacion->NombreCliente($cliente);
		$usuario['ApellidoC'] = $this->modelNegociacion->ApellidoCliente($cliente);
		$usuario['NBorrador'] = $this->modelNegociacion->NegociacionBorrador($cliente, $Id);
		$usuario['NActiva'] = $this->modelNegociacion->NegociacionActiva($cliente, $Id);
		$usuario['NGanada'] = $this->modelNegociacion->NegociacionGanada($cliente, $Id);
		$usuario['NCerrada'] = $this->modelNegociacion->NegociacionCerrada($cliente, $Id);
		$usuario['NPerdida'] = $this->modelNegociacion->NegociacionPerdida($cliente, $Id);
		$usuario['Cliente'] = $_POST['Cliente'];
		
		$usuario['Mensaje'] = 'Se cambio el status con &eacute;xito!';
		
		$Lista = $this->modelNegociacion->HistorialLista($Id_Negociacion);
		
		$this->load->library('table');
		$this->table->set_empty("&nbsp;");
		$this->table->set_heading('<font style="font-size:12px" color="#369"><b>Status</b></font>', '<font style="font-size:12px" color="#369"><b>Fecha</b></font>', '<font style="font-size:12px" color="#369"><b>Tipo de contacto</b></font>', '<font style="font-size:12px" color="#369"><b>Resumen</b></font>');
		
	
		foreach ($Lista as $row)
		{
			$status = $row['Status'];
			$fecha = $row['FechaS'];
			$tipo = $row['TipoS'];
			$resumen = $row['Resumen'];
			$this->table->add_row($status, $fecha, $tipo, $resumen);
		}
			
		$usuario['table'] = $this->table->generate();
		
		$this->load->view('Despachador/Borrador/DHistorialStatusI', $usuario);
	}
	
	public function cambio_status_i4($Id_Negociacion)
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario; 
		$usuario2 = $Usuario;
		$Id = $this->modelCliente->BuscarId($usuario2);
		$usuario['Id_Negociacion'] = $Id_Negociacion;
		$datos['ID2'] = $Id_Negociacion;
		$IdSeguimiento = $this->modelNegociacion->BuscarSeguimiento($Id_Negociacion);
		$cedula = $this->modelCliente->BuscarId($Usuario);
		$nombre = $this->modelCliente->NombreVendedor($cedula);
		$apellido = $this->modelCliente->ApellidoVendedor($cedula);
		
		$Seguimiento = new ModelNegociacion;
		$this->modelNegociacion->ModificarStatus($Seguimiento, $datos);
		$this->modelNegociacion->HistorialStatus($Seguimiento, $datos);
		
		$cliente = $_POST['Cliente']; // id del cliente //
		$status = $this->modelNegociacion->StatusNegociacion($Id_Negociacion); 
		
		//$this->load->library('email');  
		//$this->email->from('jrodriguezv.11@gmail.com','Sistema de gestion SGP');  
		//$this->email->to("jrodriguezv.11@gmail.com"); // Mail de la jefa de YOMA //
		//$this->email->subject(''.$nombre.' '.$apellido.' a cambiado la negociacion ( '.$Id_Negociacion.' ) a '.$status.'');  
		//$this->email->message("Para acceder a dicha notificacion, haga clic en el siguiente link elp21.no-ip.info:4085/SGP");  
		//$this->email->send(); 
		
		$usuario['NombreC'] = $this->modelNegociacion->NombreCliente($cliente);
		$usuario['ApellidoC'] = $this->modelNegociacion->ApellidoCliente($cliente);
		$usuario['NBorrador'] = $this->modelNegociacion->NegociacionBorrador($cliente, $Id);
		$usuario['NActiva'] = $this->modelNegociacion->NegociacionActiva($cliente, $Id);
		$usuario['NGanada'] = $this->modelNegociacion->NegociacionGanada($cliente, $Id);
		$usuario['NCerrada'] = $this->modelNegociacion->NegociacionCerrada($cliente, $Id);
		$usuario['NPerdida'] = $this->modelNegociacion->NegociacionPerdida($cliente, $Id);
		$usuario['Cliente'] = $_POST['Cliente'];
		
		$usuario['Mensaje'] = 'Se cambio el status con &eacute;xito!';
		
		$Lista = $this->modelNegociacion->HistorialLista($Id_Negociacion);
		
		$this->load->library('table');
		$this->table->set_empty("&nbsp;");
		$this->table->set_heading('<font style="font-size:12px" color="#369"><b>Status</b></font>', '<font style="font-size:12px" color="#369"><b>Fecha</b></font>', '<font style="font-size:12px" color="#369"><b>Tipo de contacto</b></font>', '<font style="font-size:12px" color="#369"><b>Resumen</b></font>');
		
	
		foreach ($Lista as $row)
		{
			$status = $row['Status'];
			$fecha = $row['FechaS'];
			$tipo = $row['TipoS'];
			$resumen = $row['Resumen'];
			$this->table->add_row($status, $fecha, $tipo, $resumen);
		}
			
		$usuario['table'] = $this->table->generate();
		
		$this->load->view('Despachador/Borrador/DHistorialStatusI2', $usuario);
	}
	
	// Funcion que verifica el historial de todos los status que a tenido una negociacion //
	public function historial_status($Id_Negociacion, $Id) 
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario; 
		$usuario['Id_Negociacion'] = $Id_Negociacion;
		$usuario['Cliente'] = $Id;
		$Lista = $this->modelNegociacion->HistorialLista($Id_Negociacion);
		
		$this->load->library('table');
		$this->table->set_empty("&nbsp;");
		$this->table->set_heading('<font style="font-size:12px" color="#369"><b>Status</b></font>', '<font style="font-size:12px" color="#369"><b>Fecha</b></font>', '<font style="font-size:12px" color="#369"><b>Tipo de contacto</b></font>', '<font style="font-size:12px" color="#369"><b>Resumen</b></font>');
		
	
		foreach ($Lista as $row)
		{
			$status = $row['Status'];
			$fecha = $row['FechaS'];
			$tipo = $row['TipoS'];
			$resumen = $row['Resumen'];
			$this->table->add_row($status, $fecha, $tipo, $resumen);
		}
			
		$usuario['table'] = $this->table->generate();
		
		$this->load->view('Despachador/Borrador/DHistorialStatus', $usuario);
	}
	
	public function historial_status2($Id_Negociacion, $Id) 
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario; 
		$usuario['Id_Negociacion'] = $Id_Negociacion;
		$usuario['Cliente'] = $Id;
		$Lista = $this->modelNegociacion->HistorialLista($Id_Negociacion);
		
		$this->load->library('table');
		$this->table->set_empty("&nbsp;");
		$this->table->set_heading('<font style="font-size:12px" color="#369"><b>Status</b></font>', '<font style="font-size:12px" color="#369"><b>Fecha</b></font>', '<font style="font-size:12px" color="#369"><b>Tipo de contacto</b></font>', '<font style="font-size:12px" color="#369"><b>Resumen</b></font>');
		
	
		foreach ($Lista as $row)
		{
			$status = $row['Status'];
			$fecha = $row['FechaS'];
			$tipo = $row['TipoS'];
			$resumen = $row['Resumen'];
			$this->table->add_row($status, $fecha, $tipo, $resumen);
		}
			
		$usuario['table'] = $this->table->generate();
		
		$this->load->view('Despachador/Borrador/DHistorialStatus2', $usuario);
	}
	
	public function historial_status_i($Id_Negociacion, $Id) 
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario; 
		$usuario['Id_Negociacion'] = $Id_Negociacion;
		$usuario['Cliente'] = $Id;
		$Lista = $this->modelNegociacion->HistorialLista($Id_Negociacion);
		
		$this->load->library('table');
		$this->table->set_empty("&nbsp;");
		$this->table->set_heading('<font style="font-size:12px" color="#369"><b>Status</b></font>', '<font style="font-size:12px" color="#369"><b>Fecha</b></font>', '<font style="font-size:12px" color="#369"><b>Tipo de contacto</b></font>', '<font style="font-size:12px" color="#369"><b>Resumen</b></font>');
		
	
		foreach ($Lista as $row)
		{
			$status = $row['Status'];
			$fecha = $row['FechaS'];
			$tipo = $row['TipoS'];
			$resumen = $row['Resumen'];
			$this->table->add_row($status, $fecha, $tipo, $resumen);
		}
			
		$usuario['table'] = $this->table->generate();
		
		$this->load->view('Despachador/Borrador/DHistorialStatusI', $usuario);
	}
	
	// Funcion que actualiza los datos de las negociaciones que estan en borrador o activas //
	public function actualizar_datos_c($Id) 
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario; 
		$usuario2 = $Usuario;
		$Id = $this->modelCliente->BuscarId($usuario2);
		$usuario['Id_Negociacion'] = $_POST['Negociacion'];
		$IdNegoBorrador = $_POST['Negociacion'];
		$datos['ID2'] = $IdNegoBorrador;
		$IdSeguimiento = $this->modelNegociacion->BuscarSeguimiento($IdNegoBorrador);
		$status = $this->modelNegociacion->StatusNegociacion($IdNegoBorrador); 
		$porcentaje = $this->modelNegociacion->PorcentajeNegociacion($IdNegoBorrador); 
		$usuario['Porcentaje'] = $porcentaje;
		$usuario['Status'] = $status;
		
		$negociacion = new ModelNegociacion;
		$negociacion2 = new ModelNegociacion;
		$this->modelNegociacion->ModificarDatos($negociacion, $datos);
		$this->modelNegociacion->ModificarA($negociacion2, $datos);
		
		$usuario['FechaP'] = $this->modelNegociacion->FechaPresupuesto($IdNegoBorrador);
		$usuario['NumeroODC'] = $this->modelNegociacion->NumeroOrdenDC($IdNegoBorrador);
		$usuario['FechaODC'] = $this->modelNegociacion->FechaOrdenDC($IdNegoBorrador);
		$usuario['Banco'] = $this->modelNegociacion->Banco($IdNegoBorrador);
		$usuario['PagoInicial'] = $this->modelNegociacion->PagoInicial($IdNegoBorrador);
		$usuario['CondicionesPago'] = $this->modelNegociacion->CondicionesPago($IdNegoBorrador);
		$usuario['FechaPago'] = $this->modelNegociacion->FechaDePago($IdNegoBorrador);
		$usuario['NDeposito'] = $this->modelNegociacion->NumeroDeposito($IdNegoBorrador);
		
		// DATOS DEL CLIENTE //
		$usuario['Id'] = $_POST['idcliente3'];
		$cliente = $_POST['idcliente3'];
		$usuario['NombreC'] = $this->modelNegociacion->NombreCliente($cliente);
		$usuario['ApellidoC'] = $this->modelNegociacion->ApellidoCliente($cliente);
		$usuario['EMailC'] = $this->modelNegociacion->MailCliente($cliente);
		$usuario['TelefonoC'] = $this->modelNegociacion->TelefonoCliente($cliente);
		
		$usuario['Marca'] = $this->modelProducto->MarcaProducto();
		$usuario['Lista'] = $this->modelProducto->ConsultarListaA($IdNegoBorrador);
	
		$this->load->view('Despachador/Borrador/DConsultarBorrador', $usuario);
	}
	
	public function actualizar_datos_c2($Id) 
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario; 
		$usuario2 = $Usuario;
		$Id = $this->modelCliente->BuscarId($usuario2);
		$usuario['Id_Negociacion'] = $_POST['Negociacion'];
		$IdNegoBorrador = $_POST['Negociacion'];
		$datos['ID2'] = $IdNegoBorrador;
		$IdSeguimiento = $this->modelNegociacion->BuscarSeguimiento($IdNegoBorrador);
		$status = $this->modelNegociacion->StatusNegociacion($IdNegoBorrador); 
		$porcentaje = $this->modelNegociacion->PorcentajeNegociacion($IdNegoBorrador); 
		$usuario['Porcentaje'] = $porcentaje;
		$usuario['Status'] = $status;
		
		$negociacion = new ModelNegociacion;
		$negociacion2 = new ModelNegociacion;
		$this->modelNegociacion->ModificarDatos($negociacion, $datos);
		$this->modelNegociacion->ModificarA($negociacion2, $datos);
		
		$usuario['FechaP'] = $this->modelNegociacion->FechaPresupuesto($IdNegoBorrador);
		$usuario['NumeroODC'] = $this->modelNegociacion->NumeroOrdenDC($IdNegoBorrador);
		$usuario['FechaODC'] = $this->modelNegociacion->FechaOrdenDC($IdNegoBorrador);
		$usuario['Banco'] = $this->modelNegociacion->Banco($IdNegoBorrador);
		$usuario['PagoInicial'] = $this->modelNegociacion->PagoInicial($IdNegoBorrador);
		$usuario['CondicionesPago'] = $this->modelNegociacion->CondicionesPago($IdNegoBorrador);
		$usuario['FechaPago'] = $this->modelNegociacion->FechaDePago($IdNegoBorrador);
		$usuario['NDeposito'] = $this->modelNegociacion->NumeroDeposito($IdNegoBorrador);
		
		// DATOS DEL CLIENTE //
		$usuario['Id'] = $_POST['idcliente3'];
		$cliente = $_POST['idcliente3'];
		$usuario['NombreC'] = $this->modelNegociacion->NombreCliente($cliente);
		$usuario['ApellidoC'] = $this->modelNegociacion->ApellidoCliente($cliente);
		$usuario['EMailC'] = $this->modelNegociacion->MailCliente($cliente);
		$usuario['TelefonoC'] = $this->modelNegociacion->TelefonoCliente($cliente);
		
		$usuario['Marca'] = $this->modelProducto->MarcaProducto();
		$usuario['Lista'] = $this->modelProducto->ConsultarListaA($IdNegoBorrador);
	
		$this->load->view('Despachador/Borrador/DConsultarBorrador2', $usuario);
	}
	
	public function agregar_equipo() 
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario;
		$Negociacion = $_POST['Negociacion22'];
		$usuario['Id_Negociacion'] = $_POST['Negociacion22'];
		$status = $this->modelNegociacion->StatusNegociacion($Negociacion); 
		$porcentaje = $this->modelNegociacion->PorcentajeNegociacion($Negociacion); 
		$usuario['Porcentaje'] = $porcentaje;
		$usuario['Status'] = $status;
		
		// PRODUCTO //
		$Equipo = $_POST['equipo'];
		$HistorialNP2['Id_Equipo'] = $Equipo; // Id Accesorio //
		$HistorialNP2['Id_Negociacion'] = $_POST['Negociacion22'];
		$HistorialNP2['Cantidad'] = $_POST['Cantidad'];
		
		// DATOS DE LA NEGOCIACION //
		$usuario['FechaP'] = $this->modelNegociacion->FechaPresupuesto($Negociacion);
		$usuario['NumeroODC'] = $this->modelNegociacion->NumeroOrdenDC($Negociacion);
		$usuario['FechaODC'] = $this->modelNegociacion->FechaOrdenDC($Negociacion);
		$usuario['Banco'] = $this->modelNegociacion->Banco($Negociacion);
		$usuario['PagoInicial'] = $this->modelNegociacion->PagoInicial($Negociacion);
		$usuario['CondicionesPago'] = $this->modelNegociacion->CondicionesPago($Negociacion);
		$usuario['FechaPago'] = $this->modelNegociacion->FechaDePago($Negociacion);
		$usuario['NDeposito'] = $this->modelNegociacion->NumeroDeposito($Negociacion);
		
		$usuario['Id'] = $_POST['idcliente2'];
		$cliente = $_POST['idcliente2'];
		$usuario['NombreC'] = $this->modelNegociacion->NombreCliente($cliente);
		$usuario['ApellidoC'] = $this->modelNegociacion->ApellidoCliente($cliente);
		$usuario['EMailC'] = $this->modelNegociacion->MailCliente($cliente);
		$usuario['TelefonoC'] = $this->modelNegociacion->TelefonoCliente($cliente);
		
		$this->modelProducto->AgregarEquipo($HistorialNP2);
		$usuario['Marca'] = $this->modelProducto->MarcaProducto();
		$usuario['Lista'] = $this->modelProducto->ConsultarListaA($Negociacion);
		
		$this->load->view('Despachador/Borrador/DConsultarBorrador', $usuario);
		
	}
	
	// Funcion que se encarga de mostrar la vista previa de las negociaciones de un cliente persona //
	public function vista_previa($Id_Negociacion, $Id) 
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario; // Id Usuario //
		$usuario['Id_Negociacion'] = $Id_Negociacion; // Id Negociacion //
		$usuario['idcliente'] = $Id; // Id Cliente
		
		$usuario['Permiso'] = $this->modelNegociacion->ConsultarPermiso($Id_Negociacion); 
		
		$status = $this->modelNegociacion->StatusNegociacion($Id_Negociacion); 
		$usuario['Status'] = $status;
		
		$usuario['DatosCliente'] = $this->modelCliente->DatosCliente($Id_Negociacion, $Id); 
		$cedula = $this->modelCliente->BuscarId($Usuario); 
		$usuario['DatosVendedor'] = $this->modelCliente->DatosVendedor($Id_Negociacion, $cedula); 
		$usuario['Lista'] = $this->modelProducto->ConsultarLista($Id_Negociacion);
		$usuario['Lista2'] = $this->modelProducto->ConsultarLista2($Id_Negociacion);
		
		$usuario['Descuento'] = $this->modelProducto->ConsultarDescuento($Id_Negociacion);
		$Neto = $this->modelProducto->Neto($Id_Negociacion);
		$Neto2 = $this->modelProducto->Neto2($Id_Negociacion);
		$Neto3 = $Neto+$Neto2;
		$usuario['Neto'] = $Neto3;
		$usuario['Iva'] = $Neto3*0.12;
		$Iva = $Neto3*0.12;
		$usuario['Total'] = $Neto3 + $Iva;
		
		$this->load->view('Despachador/Borrador/DVistaPreviaPrueba', $usuario);
	}
	
	public function vista_previa2($Id_Negociacion, $Id) 
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario; // Id Usuario //
		$usuario['Id_Negociacion'] = $Id_Negociacion; // Id Negociacion //
		$usuario['idcliente'] = $Id; // Id Cliente
		
		$usuario['Permiso'] = $this->modelNegociacion->ConsultarPermiso($Id_Negociacion); 
		$usuario['condiciones'] = $this->modelNegociacion->CondicionesPagos($Id_Negociacion); 
		
		$status = $this->modelNegociacion->StatusNegociacion($Id_Negociacion); 
		$usuario['condiciones'] = $this->modelNegociacion->CondicionesPagos($Id_Negociacion); 
		$usuario['Status'] = $status;
		
		$usuario['DatosCliente'] = $this->modelCliente->DatosCliente($Id_Negociacion, $Id); 
		$cedula = $this->modelCliente->BuscarId($Usuario); 
		$usuario['DatosVendedor'] = $this->modelCliente->DatosVendedor($Id_Negociacion, $cedula); 
		$usuario['Lista'] = $this->modelProducto->ConsultarLista($Id_Negociacion);
		$usuario['Lista2'] = $this->modelProducto->ConsultarLista2($Id_Negociacion);
		
		$usuario['Descuento'] = $this->modelProducto->ConsultarDescuento($Id_Negociacion);
		$Neto = $this->modelProducto->Neto($Id_Negociacion);
		$Neto2 = $this->modelProducto->Neto2($Id_Negociacion);
		$Neto3 = $Neto+$Neto2;
		$usuario['Neto'] = $Neto3;
		$usuario['Iva'] = $Neto3*0.12;
		$Iva = $Neto3*0.12;
		$usuario['Total'] = $Neto3 + $Iva;
		
		$this->load->view('Despachador/Borrador/DVistaPreviaPrueba2', $usuario);
	}
	
	// Funcion que nos saca de la vista previa //
	public function atras_vista_previa() 
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario;
		$Negociacion = $_POST['Negociacion'];
		$usuario['Id_Negociacion'] = $_POST['Negociacion'];
		$status = $_POST['Status'];
		$porcentaje = $this->modelNegociacion->PorcentajeNegociacion($Negociacion); 
	
		if(($status == "Perdida") || ($status == "Cerrada") || ($status == "Ganada"))
		{
			$usuario['Porcentaje'] = $porcentaje;
			$usuario['Status'] = $_POST['Status'];
			$usuario['FechaP'] = $this->modelNegociacion->FechaPresupuesto($Negociacion);
			$usuario['NumeroODC'] = $this->modelNegociacion->NumeroOrdenDC($Negociacion);
			$usuario['FechaODC'] = $this->modelNegociacion->FechaOrdenDC($Negociacion);
			$usuario['Banco'] = $this->modelNegociacion->Banco($Negociacion);
			$usuario['PagoInicial'] = $this->modelNegociacion->PagoInicial($Negociacion);
			$usuario['CondicionesPago'] = $this->modelNegociacion->CondicionesPago($Negociacion);
			$usuario['FechaPago'] = $this->modelNegociacion->FechaDePago($Negociacion);
			$usuario['NDeposito'] = $this->modelNegociacion->NumeroDeposito($Negociacion);
				
			$usuario['Id'] = $_POST['idcliente'];
			$cliente = $_POST['idcliente'];
			$usuario['NombreC'] = $this->modelNegociacion->NombreCliente($cliente);
			$usuario['ApellidoC'] = $this->modelNegociacion->ApellidoCliente($cliente);
			$usuario['EMailC'] = $this->modelNegociacion->MailCliente($cliente);
			$usuario['TelefonoC'] = $this->modelNegociacion->TelefonoCliente($cliente);
				
			$usuario['Marca'] = $this->modelProducto->MarcaProducto();
			$usuario['Lista'] = $this->modelProducto->ConsultarListaA($Negociacion);
				
			$this->load->view('Vendedor/Cerrada/VConsultaCerrada', $usuario);
		}
		else
		{
			$usuario['Porcentaje'] = $porcentaje;
			$usuario['Status'] = $_POST['Status'];
			$usuario['FechaP'] = $this->modelNegociacion->FechaPresupuesto($Negociacion);
			$usuario['NumeroODC'] = $this->modelNegociacion->NumeroOrdenDC($Negociacion);
			$usuario['FechaODC'] = $this->modelNegociacion->FechaOrdenDC($Negociacion);
			$usuario['Banco'] = $this->modelNegociacion->Banco($Negociacion);
			$usuario['PagoInicial'] = $this->modelNegociacion->PagoInicial($Negociacion);
			$usuario['CondicionesPago'] = $this->modelNegociacion->CondicionesPago($Negociacion);
			$usuario['FechaPago'] = $this->modelNegociacion->FechaDePago($Negociacion);
			$usuario['NDeposito'] = $this->modelNegociacion->NumeroDeposito($Negociacion);
			
			$usuario['Id'] = $_POST['idcliente'];
			$cliente = $_POST['idcliente'];
			$usuario['NombreC'] = $this->modelNegociacion->NombreCliente($cliente);
			$usuario['ApellidoC'] = $this->modelNegociacion->ApellidoCliente($cliente);
			$usuario['EMailC'] = $this->modelNegociacion->MailCliente($cliente);
			$usuario['TelefonoC'] = $this->modelNegociacion->TelefonoCliente($cliente);
				
			$usuario['Marca'] = $this->modelProducto->MarcaProducto();
			$usuario['Lista'] = $this->modelProducto->ConsultarListaA($Negociacion);
			
			$this->load->view('Despachador/Borrador/DConsultarBorrador', $usuario);
		}
	}
	
	// Funcion que nos saca de la vista previa //
	public function atras_vista_previa2() 
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario;
		$Negociacion = $_POST['Negociacion'];
		$usuario['Id_Negociacion'] = $_POST['Negociacion'];
		$status = $_POST['Status'];
		$porcentaje = $this->modelNegociacion->PorcentajeNegociacion($Negociacion); 
	
		if(($status == "Perdida") || ($status == "Cerrada") || ($status == "Ganada"))
		{
			$usuario['Porcentaje'] = $porcentaje;
			$usuario['Status'] = $_POST['Status'];
			$usuario['FechaP'] = $this->modelNegociacion->FechaPresupuesto($Negociacion);
			$usuario['NumeroODC'] = $this->modelNegociacion->NumeroOrdenDC($Negociacion);
			$usuario['FechaODC'] = $this->modelNegociacion->FechaOrdenDC($Negociacion);
			$usuario['Banco'] = $this->modelNegociacion->Banco($Negociacion);
			$usuario['PagoInicial'] = $this->modelNegociacion->PagoInicial($Negociacion);
			$usuario['CondicionesPago'] = $this->modelNegociacion->CondicionesPago($Negociacion);
			$usuario['FechaPago'] = $this->modelNegociacion->FechaDePago($Negociacion);
			$usuario['NDeposito'] = $this->modelNegociacion->NumeroDeposito($Negociacion);
				
			$usuario['Id'] = $_POST['idcliente'];
			$cliente = $_POST['idcliente'];
			$usuario['NombreC'] = $this->modelNegociacion->NombreCliente($cliente);
			$usuario['ApellidoC'] = $this->modelNegociacion->ApellidoCliente($cliente);
			$usuario['EMailC'] = $this->modelNegociacion->MailCliente($cliente);
			$usuario['TelefonoC'] = $this->modelNegociacion->TelefonoCliente($cliente);
				
			$usuario['Marca'] = $this->modelProducto->MarcaProducto();
			$usuario['Lista'] = $this->modelProducto->ConsultarListaA($Negociacion);
				
			$this->load->view('Vendedor/Cerrada/VConsultaCerrada', $usuario);
		}
		else
		{
			$usuario['Porcentaje'] = $porcentaje;
			$usuario['Status'] = $_POST['Status'];
			$usuario['FechaP'] = $this->modelNegociacion->FechaPresupuesto($Negociacion);
			$usuario['NumeroODC'] = $this->modelNegociacion->NumeroOrdenDC($Negociacion);
			$usuario['FechaODC'] = $this->modelNegociacion->FechaOrdenDC($Negociacion);
			$usuario['Banco'] = $this->modelNegociacion->Banco($Negociacion);
			$usuario['PagoInicial'] = $this->modelNegociacion->PagoInicial($Negociacion);
			$usuario['CondicionesPago'] = $this->modelNegociacion->CondicionesPago($Negociacion);
			$usuario['FechaPago'] = $this->modelNegociacion->FechaDePago($Negociacion);
			$usuario['NDeposito'] = $this->modelNegociacion->NumeroDeposito($Negociacion);
			
			$usuario['Id'] = $_POST['idcliente'];
			$cliente = $_POST['idcliente'];
			$usuario['NombreC'] = $this->modelNegociacion->NombreCliente($cliente);
			$usuario['ApellidoC'] = $this->modelNegociacion->ApellidoCliente($cliente);
			$usuario['EMailC'] = $this->modelNegociacion->MailCliente($cliente);
			$usuario['TelefonoC'] = $this->modelNegociacion->TelefonoCliente($cliente);
				
			$usuario['Lista'] = $this->modelProducto->ConsultarListaB($Negociacion);
			$usuario['Marca'] = $this->modelProducto->MarcaProducto();
			
			$this->load->view('Despachador/Borrador/DConsultarBorrador2', $usuario);
		}
	}
	
	public function agregar_otro_accesorios2() 
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario;
		$Negociacion = $_POST['Negociacion22'];
		$usuario['Id_Negociacion'] = $_POST['Negociacion22'];
		$status = $this->modelNegociacion->StatusNegociacion($Negociacion); 
		$usuario['Status'] = $status;
		$porcentaje = $this->modelNegociacion->PorcentajeNegociacion($Negociacion); 
		$usuario['Porcentaje'] = $porcentaje;
		
		// PRODUCTO //
		$HistorialNP['Id_Accesorio'] = $_POST['Accesorio']; // Id Accesorio //
		$HistorialNP['Id_Negociacion'] = $Negociacion;
		$HistorialNP['Cantidad'] = $_POST['Cantidad'];
		
		$this->modelProducto->AgregarAccesorio($HistorialNP);
		
		// DATOS DE LA NEGOCIACION //
		$usuario['FechaP'] = $this->modelNegociacion->FechaPresupuesto($Negociacion);
		$usuario['NumeroODC'] = $this->modelNegociacion->NumeroOrdenDC($Negociacion);
		$usuario['FechaODC'] = $this->modelNegociacion->FechaOrdenDC($Negociacion);
		$usuario['Banco'] = $this->modelNegociacion->Banco($Negociacion);
		$usuario['PagoInicial'] = $this->modelNegociacion->PagoInicial($Negociacion);
		$usuario['CondicionesPago'] = $this->modelNegociacion->CondicionesPago($Negociacion);
		$usuario['FechaPago'] = $this->modelNegociacion->FechaDePago($Negociacion);
		$usuario['NDeposito'] = $this->modelNegociacion->NumeroDeposito($Negociacion);
		
		$usuario['Id'] = $_POST['idcliente2'];
		$cliente = $_POST['idcliente2'];
		$usuario['NombreC'] = $this->modelNegociacion->NombreCliente($cliente);
		$usuario['ApellidoC'] = $this->modelNegociacion->ApellidoCliente($cliente);
		$usuario['EMailC'] = $this->modelNegociacion->MailCliente($cliente);
		$usuario['TelefonoC'] = $this->modelNegociacion->TelefonoCliente($cliente);
		
		//////////////////////////////////////////////////////
		
		$usuario['Lista'] = $this->modelProducto->ConsultarListaB($Negociacion);
		$usuario['Marca'] = $this->modelProducto->MarcaProducto();
		
		$this->load->view('Despachador/Borrador/DConsultarBorrador2', $usuario);
	}
	
	public function eliminar_producto_2($Equipo, $cliente, $Id_Negociacion) 
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario; // Id Negociacion //
		$usuario['Id_Negociacion'] = $Id_Negociacion;
		$usuario['idcliente'] = $cliente;
		$usuario['Id'] = $cliente;
		$status = $this->modelNegociacion->StatusNegociacion($Id_Negociacion); 
		$porcentaje = $this->modelNegociacion->PorcentajeNegociacion($Id_Negociacion); 
		$usuario['Porcentaje'] = $porcentaje;
		$usuario['Status'] = $status;
		
		$usuario['NombreC'] = $this->modelNegociacion->NombreCliente($cliente);
		$usuario['ApellidoC'] = $this->modelNegociacion->ApellidoCliente($cliente);
		$usuario['EMailC'] = $this->modelNegociacion->MailCliente($cliente);
		$usuario['TelefonoC'] = $this->modelNegociacion->TelefonoCliente($cliente);
		
		$usuario['FechaP'] = $this->modelNegociacion->FechaPresupuesto($Id_Negociacion);
		$usuario['NumeroODC'] = $this->modelNegociacion->NumeroOrdenDC($Id_Negociacion);
		$usuario['FechaODC'] = $this->modelNegociacion->FechaOrdenDC($Id_Negociacion);
		$usuario['Banco'] = $this->modelNegociacion->Banco($Id_Negociacion);
		$usuario['PagoInicial'] = $this->modelNegociacion->PagoInicial($Id_Negociacion);
		$usuario['CondicionesPago'] = $this->modelNegociacion->CondicionesPago($Id_Negociacion);
		$usuario['FechaPago'] = $this->modelNegociacion->FechaDePago($Id_Negociacion);
		$usuario['NDeposito'] = $this->modelNegociacion->NumeroDeposito($Id_Negociacion);
		
		$this->modelNegociacion->EliminarP($Equipo);
		
		$usuario['Marca'] = $this->modelProducto->MarcaProducto();
		$usuario['Lista'] = $this->modelProducto->ConsultarListaA($Id_Negociacion);
		
		$this->load->view('Despachador/Borrador/DConsultarBorrador', $usuario);
	}
	
	public function eliminar_producto($Equipo, $cliente, $Id_Negociacion)
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario; // Id Negociacion //
		$usuario['Id_Negociacion'] = $Id_Negociacion;
		$usuario['idcliente'] = $cliente;
		$status = $this->modelNegociacion->StatusNegociacion($Id_Negociacion); 
		$usuario['Status'] = $status;
		$porcentaje = $this->modelNegociacion->PorcentajeNegociacion($Id_Negociacion); 
		$usuario['Porcentaje'] = $porcentaje;
		
		$this->modelNegociacion->EliminarP2($Equipo);
		
		// DATOS DE LA NEGOCIACION //
		$usuario['FechaP'] = $this->modelNegociacion->FechaPresupuesto($Id_Negociacion);
		$usuario['NumeroODC'] = $this->modelNegociacion->NumeroOrdenDC($Id_Negociacion);
		$usuario['FechaODC'] = $this->modelNegociacion->FechaOrdenDC($Id_Negociacion);
		$usuario['Banco'] = $this->modelNegociacion->Banco($Id_Negociacion);
		$usuario['PagoInicial'] = $this->modelNegociacion->PagoInicial($Id_Negociacion);
		$usuario['CondicionesPago'] = $this->modelNegociacion->CondicionesPago($Id_Negociacion);
		$usuario['FechaPago'] = $this->modelNegociacion->FechaDePago($Id_Negociacion);
		$usuario['NDeposito'] = $this->modelNegociacion->NumeroDeposito($Id_Negociacion);
		
		$usuario['Id'] = $cliente;
		$usuario['NombreC'] = $this->modelNegociacion->NombreCliente($cliente);
		$usuario['ApellidoC'] = $this->modelNegociacion->ApellidoCliente($cliente);
		$usuario['EMailC'] = $this->modelNegociacion->MailCliente($cliente);
		$usuario['TelefonoC'] = $this->modelNegociacion->TelefonoCliente($cliente);
		
		//////////////////////////////////////////////////////
		
		$usuario['Lista'] = $this->modelProducto->ConsultarListaB($Id_Negociacion);
		$usuario['Marca'] = $this->modelProducto->MarcaProducto();
		$this->load->view('Despachador/Borrador/DConsultarBorrador2', $usuario);
	}
	
	// Funcion que actualiza los datos de las negociaciones que estan en borrador o activas //
	public function actualizar_datos_i($Id) 
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario; 
		$usuario2 = $Usuario;
		$Id = $this->modelCliente->BuscarId($usuario2);
		$usuario['Id_Negociacion'] = $_POST['Negociacion2'];
		$IdNegoBorrador = $_POST['Negociacion2'];
		$datos['ID2'] = $IdNegoBorrador;
		$IdSeguimiento = $this->modelNegociacion->BuscarSeguimiento($IdNegoBorrador);
		$status = $this->modelNegociacion->StatusNegociacion($IdNegoBorrador); 
		$porcentaje = $this->modelNegociacion->PorcentajeNegociacion($IdNegoBorrador); 
		$usuario['Porcentaje'] = $porcentaje;
		$usuario['Status'] = $status;
		
		$negociacion = new ModelNegociacion;
		$negociacion2 = new ModelNegociacion;
		$this->modelNegociacion->ModificarDatos($negociacion, $datos);
		$this->modelNegociacion->ModificarA($negociacion2, $datos);
		
		$usuario['FechaP'] = $this->modelNegociacion->FechaPresupuesto($IdNegoBorrador);
		$usuario['NumeroODC'] = $this->modelNegociacion->NumeroOrdenDC($IdNegoBorrador);
		$usuario['FechaODC'] = $this->modelNegociacion->FechaOrdenDC($IdNegoBorrador);
		$usuario['Banco'] = $this->modelNegociacion->Banco($IdNegoBorrador);
		$usuario['PagoInicial'] = $this->modelNegociacion->PagoInicial($IdNegoBorrador);
		$usuario['CondicionesPago'] = $this->modelNegociacion->CondicionesPago($IdNegoBorrador);
		$usuario['FechaPago'] = $this->modelNegociacion->FechaDePago($IdNegoBorrador);
		$usuario['NDeposito'] = $this->modelNegociacion->NumeroDeposito($IdNegoBorrador);
		
		// DATOS DEL CLIENTE //
		$usuario['Id'] = $_POST['idcliente3'];
		$cliente = $_POST['idcliente3'];
		$usuario['NombreI'] = $this->modelNegociacion->NombreInstitucion($cliente);
		$usuario['TelefonoI'] = $this->modelNegociacion->TelefonoInstitucion($cliente);
		
		$usuario['Marca'] = $this->modelProducto->MarcaProducto();
		$usuario['Lista'] = $this->modelProducto->ConsultarListaA($IdNegoBorrador);
		
		$this->load->view('Despachador/Borrador/DConsultarBorradorI', $usuario);
	}
	
	public function actualizar_datos_i2($Id) 
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario; 
		$usuario2 = $Usuario;
		$Id = $this->modelCliente->BuscarId($usuario2);
		$usuario['Id_Negociacion'] = $_POST['Negociacion2'];
		$IdNegoBorrador = $_POST['Negociacion2'];
		$datos['ID2'] = $IdNegoBorrador;
		$IdSeguimiento = $this->modelNegociacion->BuscarSeguimiento($IdNegoBorrador);
		$status = $this->modelNegociacion->StatusNegociacion($IdNegoBorrador); 
		$porcentaje = $this->modelNegociacion->PorcentajeNegociacion($IdNegoBorrador); 
		$usuario['Porcentaje'] = $porcentaje;
		$usuario['Status'] = $status;
		
		$negociacion = new ModelNegociacion;
		$negociacion2 = new ModelNegociacion;
		$this->modelNegociacion->ModificarDatos($negociacion, $datos);
		$this->modelNegociacion->ModificarA($negociacion2, $datos);
		
		$usuario['FechaP'] = $this->modelNegociacion->FechaPresupuesto($IdNegoBorrador);
		$usuario['NumeroODC'] = $this->modelNegociacion->NumeroOrdenDC($IdNegoBorrador);
		$usuario['FechaODC'] = $this->modelNegociacion->FechaOrdenDC($IdNegoBorrador);
		$usuario['Banco'] = $this->modelNegociacion->Banco($IdNegoBorrador);
		$usuario['PagoInicial'] = $this->modelNegociacion->PagoInicial($IdNegoBorrador);
		$usuario['CondicionesPago'] = $this->modelNegociacion->CondicionesPago($IdNegoBorrador);
		$usuario['FechaPago'] = $this->modelNegociacion->FechaDePago($IdNegoBorrador);
		$usuario['NDeposito'] = $this->modelNegociacion->NumeroDeposito($IdNegoBorrador);
		
		// DATOS DEL CLIENTE //
		$usuario['Id'] = $_POST['idcliente3'];
		$cliente = $_POST['idcliente3'];
		$usuario['NombreI'] = $this->modelNegociacion->NombreInstitucion($cliente);
		$usuario['TelefonoI'] = $this->modelNegociacion->TelefonoInstitucion($cliente);
		
		$usuario['Lista'] = $this->modelProducto->ConsultarListaB($IdNegoBorrador);
		$usuario['Marca'] = $this->modelProducto->MarcaProducto();
		
		$this->load->view('Despachador/Borrador/DConsultarBorradorI2', $usuario);
	}
	
	public function agregar_equipo_i() 
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario;
		$Negociacion = $_POST['Negociacion3'];
		$usuario['Id_Negociacion'] = $_POST['Negociacion3'];
		$IdNegoBorrador = $_POST['Negociacion3'];
		$status = $this->modelNegociacion->StatusNegociacion($IdNegoBorrador); 
		$porcentaje = $this->modelNegociacion->PorcentajeNegociacion($IdNegoBorrador); 
		$usuario['Porcentaje'] = $porcentaje;
		$usuario['Status'] = $status;
		
		// PRODUCTO //
		$Equipo = $_POST['equipo'];
		$HistorialNP2['Id_Equipo'] = $Equipo; // Id Accesorio //
		$HistorialNP2['Id_Negociacion'] = $_POST['Negociacion3'];
		$HistorialNP2['Cantidad'] = $_POST['Cantidad'];
		
		// DATOS DE LA NEGOCIACION //
		$usuario['FechaP'] = $this->modelNegociacion->FechaPresupuesto($IdNegoBorrador);
		$usuario['NumeroODC'] = $this->modelNegociacion->NumeroOrdenDC($IdNegoBorrador);
		$usuario['FechaODC'] = $this->modelNegociacion->FechaOrdenDC($IdNegoBorrador);
		$usuario['Banco'] = $this->modelNegociacion->Banco($IdNegoBorrador);
		$usuario['PagoInicial'] = $this->modelNegociacion->PagoInicial($IdNegoBorrador);
		$usuario['CondicionesPago'] = $this->modelNegociacion->CondicionesPago($IdNegoBorrador);
		$usuario['FechaPago'] = $this->modelNegociacion->FechaDePago($IdNegoBorrador);
		$usuario['NDeposito'] = $this->modelNegociacion->NumeroDeposito($IdNegoBorrador);
		
		$usuario['Id'] = $_POST['idcliente2'];
		$cliente = $_POST['idcliente2'];
		$usuario['NombreI'] = $this->modelNegociacion->NombreInstitucion($cliente);
		$usuario['TelefonoI'] = $this->modelNegociacion->TelefonoInstitucion($cliente);
		
		$this->modelProducto->AgregarEquipo($HistorialNP2);
		$usuario['Marca'] = $this->modelProducto->MarcaProducto();
		$usuario['Lista'] = $this->modelProducto->ConsultarListaA($IdNegoBorrador);
		
		$this->load->view('Despachador/Borrador/DConsultarBorradorI', $usuario);
		
	}
	
	public function agregar_otro_accesorios2I() 
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario;
		$Negociacion = $_POST['Negociacion22'];
		$usuario['Id_Negociacion'] = $_POST['Negociacion22'];
		$status = $this->modelNegociacion->StatusNegociacion($Negociacion); 
		$usuario['Status'] = $status;
		$porcentaje = $this->modelNegociacion->PorcentajeNegociacion($Negociacion); 
		$usuario['Porcentaje'] = $porcentaje;
		
		// PRODUCTO //
		$HistorialNP['Id_Accesorio'] = $_POST['Accesorio']; // Id Accesorio //
		$HistorialNP['Id_Negociacion'] = $Negociacion;
		$HistorialNP['Cantidad'] = $_POST['Cantidad'];
		
		$this->modelProducto->AgregarAccesorio($HistorialNP);
		
		// DATOS DE LA NEGOCIACION //
		$usuario['FechaP'] = $this->modelNegociacion->FechaPresupuesto($Negociacion);
		$usuario['NumeroODC'] = $this->modelNegociacion->NumeroOrdenDC($Negociacion);
		$usuario['FechaODC'] = $this->modelNegociacion->FechaOrdenDC($Negociacion);
		$usuario['Banco'] = $this->modelNegociacion->Banco($Negociacion);
		$usuario['PagoInicial'] = $this->modelNegociacion->PagoInicial($Negociacion);
		$usuario['CondicionesPago'] = $this->modelNegociacion->CondicionesPago($Negociacion);
		$usuario['FechaPago'] = $this->modelNegociacion->FechaDePago($Negociacion);
		$usuario['NDeposito'] = $this->modelNegociacion->NumeroDeposito($Negociacion);
		
		$usuario['Id'] = $_POST['idcliente2'];
		$cliente = $_POST['idcliente2'];
		$usuario['NombreI'] = $this->modelNegociacion->NombreInstitucion($cliente);
		$usuario['TelefonoI'] = $this->modelNegociacion->TelefonoInstitucion($cliente);
		//////////////////////////////////////////////////////
		
		$usuario['Lista'] = $this->modelProducto->ConsultarListaB($Negociacion);
		$usuario['Marca'] = $this->modelProducto->MarcaProducto();
		
		$this->load->view('Despachador/Borrador/DConsultarBorradorI2', $usuario);
	}
	
	public function eliminar_producto_i2($Equipo, $cliente, $Id_Negociacion) 
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario; // Id Negociacion //
		$usuario['Id_Negociacion'] = $Id_Negociacion;
		$usuario['idcliente'] = $cliente;
		$usuario['Id'] = $cliente;
		$status = $this->modelNegociacion->StatusNegociacion($Id_Negociacion); 
		$porcentaje = $this->modelNegociacion->PorcentajeNegociacion($Id_Negociacion); 
		$usuario['Porcentaje'] = $porcentaje;
		$usuario['Status'] = $status;
		
		$usuario['FechaP'] = $this->modelNegociacion->FechaPresupuesto($Id_Negociacion);
		$usuario['NumeroODC'] = $this->modelNegociacion->NumeroOrdenDC($Id_Negociacion);
		$usuario['FechaODC'] = $this->modelNegociacion->FechaOrdenDC($Id_Negociacion);
		$usuario['Banco'] = $this->modelNegociacion->Banco($Id_Negociacion);
		$usuario['PagoInicial'] = $this->modelNegociacion->PagoInicial($Id_Negociacion);
		$usuario['CondicionesPago'] = $this->modelNegociacion->CondicionesPago($Id_Negociacion);
		$usuario['FechaPago'] = $this->modelNegociacion->FechaDePago($Id_Negociacion);
		$usuario['NDeposito'] = $this->modelNegociacion->NumeroDeposito($Id_Negociacion);
		
		$this->modelNegociacion->EliminarP($Equipo);
		
		$usuario['NombreI'] = $this->modelNegociacion->NombreInstitucion($cliente);
		$usuario['TelefonoI'] = $this->modelNegociacion->TelefonoInstitucion($cliente);
		
		$usuario['Marca'] = $this->modelProducto->MarcaProducto();
		$usuario['Lista'] = $this->modelProducto->ConsultarListaA($Id_Negociacion);
		$this->load->view('Despachador/Borrador/DConsultarBorradorI', $usuario);
	}
	
	public function vista_previa_i($Id_Negociacion, $Id) // Vendedor //
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario; // Id Usuario //
		$usuario['Id_Negociacion'] = $Id_Negociacion; // Id Negociacion //
		$usuario['idcliente'] = $Id; // Id Cliente
		
		$status = $this->modelNegociacion->StatusNegociacion($Id_Negociacion); 
		$usuario['Status'] = $status;
		
		$usuario['DatosCliente'] = $this->modelCliente->DatosClienteI($Id_Negociacion, $Id); 
		$cedula = $this->modelCliente->BuscarId($Usuario); 
		$usuario['DatosVendedor'] = $this->modelCliente->DatosVendedorI($Id_Negociacion, $cedula); 
		$usuario['Lista'] = $this->modelProducto->ConsultarLista($Id_Negociacion);
		$usuario['Lista2'] = $this->modelProducto->ConsultarLista2($Id_Negociacion);
		
		$usuario['Descuento'] = $this->modelProducto->ConsultarDescuento($Id_Negociacion);
		$Neto = $this->modelProducto->Neto($Id_Negociacion);
		$Neto2 = $this->modelProducto->Neto2($Id_Negociacion);
		$Neto3 = $Neto+$Neto2;
		$usuario['Neto'] = $Neto3;
		$usuario['Iva'] = $Neto3*0.12;
		$Iva = $Neto3*0.12;
		$usuario['Total'] = $Neto3 + $Iva;
		
		$this->load->view('Despachador/Borrador/DVistaPreviaPruebaI', $usuario);
	}
	
	public function vista_previa_i2($Id_Negociacion, $Id) // Vendedor //
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario; // Id Usuario //
		$usuario['Id_Negociacion'] = $Id_Negociacion; // Id Negociacion //
		$usuario['idcliente'] = $Id; // Id Cliente
		
		$status = $this->modelNegociacion->StatusNegociacion($Id_Negociacion); 
		$usuario['condiciones'] = $this->modelNegociacion->CondicionesPagos($Id_Negociacion); 
		$usuario['Status'] = $status;
		
		$usuario['DatosCliente'] = $this->modelCliente->DatosClienteI($Id_Negociacion, $Id); 
		$cedula = $this->modelCliente->BuscarId($Usuario); 
		$usuario['DatosVendedor'] = $this->modelCliente->DatosVendedorI($Id_Negociacion, $cedula); 
		$usuario['Lista'] = $this->modelProducto->ConsultarLista($Id_Negociacion);
		$usuario['Lista2'] = $this->modelProducto->ConsultarLista2($Id_Negociacion);
		
		$usuario['Descuento'] = $this->modelProducto->ConsultarDescuento($Id_Negociacion);
		$Neto = $this->modelProducto->Neto($Id_Negociacion);
		$Neto2 = $this->modelProducto->Neto2($Id_Negociacion);
		$Neto3 = $Neto+$Neto2;
		$usuario['Neto'] = $Neto3;
		$usuario['Iva'] = $Neto3*0.12;
		$Iva = $Neto3*0.12;
		$usuario['Total'] = $Neto3 + $Iva;
		
		$this->load->view('Despachador/Borrador/DVistaPreviaPruebaI2', $usuario);
	}
	
	public function atras_vista_previai() 
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario;
		$Negociacion = $_POST['Negociacion'];
		$usuario['Id_Negociacion'] = $_POST['Negociacion'];
		$status = $_POST['Status'];
		$porcentaje = $this->modelNegociacion->PorcentajeNegociacion($Negociacion); 
		
		if(($status == "Perdida") || ($status == "Cerrada") || ($status == "Ganada"))
		{
			$usuario['Status'] = $_POST['Status'];
			$usuario['Porcentaje'] = $porcentaje;
			$usuario['FechaP'] = $this->modelNegociacion->FechaPresupuesto($Negociacion);
			$usuario['NumeroODC'] = $this->modelNegociacion->NumeroOrdenDC($Negociacion);
			$usuario['FechaODC'] = $this->modelNegociacion->FechaOrdenDC($Negociacion);
			$usuario['Banco'] = $this->modelNegociacion->Banco($Negociacion);
			$usuario['PagoInicial'] = $this->modelNegociacion->PagoInicial($Negociacion);
			$usuario['CondicionesPago'] = $this->modelNegociacion->CondicionesPago($Negociacion);
			$usuario['FechaPago'] = $this->modelNegociacion->FechaDePago($Negociacion);
			$usuario['NDeposito'] = $this->modelNegociacion->NumeroDeposito($Negociacion);
			
			$usuario['Id'] = $_POST['idcliente'];
			$cliente = $_POST['idcliente'];
			$usuario['NombreI'] = $this->modelNegociacion->NombreInstitucion($cliente);
			$usuario['TelefonoI'] = $this->modelNegociacion->TelefonoInstitucion($cliente);
			
			$usuario['Lista'] = $this->modelProducto->ConsultarListaA($Negociacion);
			
			$usuario['Marca'] = $this->modelProducto->MarcaProducto();
			$this->load->view('Vendedor/Cerrada/VConsultaCerradaI', $usuario);
		}
		else
		{
			$usuario['Status'] = $_POST['Status'];
			$usuario['Porcentaje'] = $porcentaje;
			$usuario['FechaP'] = $this->modelNegociacion->FechaPresupuesto($Negociacion);
			$usuario['NumeroODC'] = $this->modelNegociacion->NumeroOrdenDC($Negociacion);
			$usuario['FechaODC'] = $this->modelNegociacion->FechaOrdenDC($Negociacion);
			$usuario['Banco'] = $this->modelNegociacion->Banco($Negociacion);
			$usuario['PagoInicial'] = $this->modelNegociacion->PagoInicial($Negociacion);
			$usuario['CondicionesPago'] = $this->modelNegociacion->CondicionesPago($Negociacion);
			$usuario['FechaPago'] = $this->modelNegociacion->FechaDePago($Negociacion);
			$usuario['NDeposito'] = $this->modelNegociacion->NumeroDeposito($Negociacion);
			
			$usuario['Id'] = $_POST['idcliente'];
			$cliente = $_POST['idcliente'];
			$usuario['NombreI'] = $this->modelNegociacion->NombreInstitucion($cliente);
			$usuario['TelefonoI'] = $this->modelNegociacion->TelefonoInstitucion($cliente);
			
			$usuario['Lista'] = $this->modelProducto->ConsultarListaA($Negociacion);
			
			$usuario['Marca'] = $this->modelProducto->MarcaProducto();
			$this->load->view('Despachador/Borrador/DConsultarBorradorI', $usuario);
		}
		
	}
	
	public function atras_vista_previai2() 
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario;
		$Negociacion = $_POST['Negociacion'];
		$usuario['Id_Negociacion'] = $_POST['Negociacion'];
		$status = $_POST['Status'];
		$porcentaje = $this->modelNegociacion->PorcentajeNegociacion($Negociacion); 
		
		if(($status == "Perdida") || ($status == "Cerrada") || ($status == "Ganada"))
		{
			$usuario['Status'] = $_POST['Status'];
			$usuario['Porcentaje'] = $porcentaje;
			$usuario['FechaP'] = $this->modelNegociacion->FechaPresupuesto($Negociacion);
			$usuario['NumeroODC'] = $this->modelNegociacion->NumeroOrdenDC($Negociacion);
			$usuario['FechaODC'] = $this->modelNegociacion->FechaOrdenDC($Negociacion);
			$usuario['Banco'] = $this->modelNegociacion->Banco($Negociacion);
			$usuario['PagoInicial'] = $this->modelNegociacion->PagoInicial($Negociacion);
			$usuario['CondicionesPago'] = $this->modelNegociacion->CondicionesPago($Negociacion);
			$usuario['FechaPago'] = $this->modelNegociacion->FechaDePago($Negociacion);
			$usuario['NDeposito'] = $this->modelNegociacion->NumeroDeposito($Negociacion);
			
			$usuario['Id'] = $_POST['idcliente'];
			$cliente = $_POST['idcliente'];
			$usuario['NombreI'] = $this->modelNegociacion->NombreInstitucion($cliente);
			$usuario['TelefonoI'] = $this->modelNegociacion->TelefonoInstitucion($cliente);
			
			$usuario['Lista'] = $this->modelProducto->ConsultarListaA($Negociacion);
			
			$usuario['Marca'] = $this->modelProducto->MarcaProducto();
			$this->load->view('Vendedor/Cerrada/VConsultaCerradaI', $usuario);
		}
		else
		{
			$usuario['Status'] = $_POST['Status'];
			$usuario['Porcentaje'] = $porcentaje;
			$usuario['FechaP'] = $this->modelNegociacion->FechaPresupuesto($Negociacion);
			$usuario['NumeroODC'] = $this->modelNegociacion->NumeroOrdenDC($Negociacion);
			$usuario['FechaODC'] = $this->modelNegociacion->FechaOrdenDC($Negociacion);
			$usuario['Banco'] = $this->modelNegociacion->Banco($Negociacion);
			$usuario['PagoInicial'] = $this->modelNegociacion->PagoInicial($Negociacion);
			$usuario['CondicionesPago'] = $this->modelNegociacion->CondicionesPago($Negociacion);
			$usuario['FechaPago'] = $this->modelNegociacion->FechaDePago($Negociacion);
			$usuario['NDeposito'] = $this->modelNegociacion->NumeroDeposito($Negociacion);
			
			$usuario['Id'] = $_POST['idcliente'];
			$cliente = $_POST['idcliente'];
			$usuario['NombreI'] = $this->modelNegociacion->NombreInstitucion($cliente);
			$usuario['TelefonoI'] = $this->modelNegociacion->TelefonoInstitucion($cliente);
			
			$usuario['Lista'] = $this->modelProducto->ConsultarListaB($Negociacion);
			$usuario['Marca'] = $this->modelProducto->MarcaProducto();
		
			$this->load->view('Despachador/Borrador/DConsultarBorradorI2', $usuario);
		}
		
	}
	
	public function historial_status_i2($Id_Negociacion, $Id) 
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario; 
		$usuario['Id_Negociacion'] = $Id_Negociacion;
		$usuario['Cliente'] = $Id;
		$Lista = $this->modelNegociacion->HistorialLista($Id_Negociacion);
		
		$this->load->library('table');
		$this->table->set_empty("&nbsp;");
		$this->table->set_heading('<font style="font-size:12px" color="#369"><b>Status</b></font>', '<font style="font-size:12px" color="#369"><b>Fecha</b></font>', '<font style="font-size:12px" color="#369"><b>Tipo de contacto</b></font>', '<font style="font-size:12px" color="#369"><b>Resumen</b></font>');
		
	
		foreach ($Lista as $row)
		{
			$status = $row['Status'];
			$fecha = $row['FechaS'];
			$tipo = $row['TipoS'];
			$resumen = $row['Resumen'];
			$this->table->add_row($status, $fecha, $tipo, $resumen);
		}
			
		$usuario['table'] = $this->table->generate();
		
		$this->load->view('Despachador/Borrador/DHistorialStatusI2', $usuario);
	}
	
	public function cerrada() 
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario; // Usuario //
		$cliente = $_POST['IdCliente']; // Id cliente //
		$IdNegoBorrador = $_POST['Nego']; // Id negociacion //
		$usuario['Id_Negociacion'] = $_POST['Nego']; // Id negociacion //
		$Id = $this->modelCliente->BuscarId($Usuario); // Id del usuario //
		$status = $this->modelNegociacion->StatusNegociacion($IdNegoBorrador); 
		$porcentaje = $this->modelNegociacion->PorcentajeNegociacion($IdNegoBorrador); 
		$usuario['Status'] = $status;
		$usuario['Porcentaje'] = $porcentaje;
		
		// DATOS DE LA NEGOCIACION //
		$IdNegoBorrador = $_POST['Nego'];
		$usuario['FechaP'] = $this->modelNegociacion->FechaPresupuesto($IdNegoBorrador);
		$usuario['NumeroODC'] = $this->modelNegociacion->NumeroOrdenDC($IdNegoBorrador);
		$usuario['FechaODC'] = $this->modelNegociacion->FechaOrdenDC($IdNegoBorrador);
		$usuario['Banco'] = $this->modelNegociacion->Banco($IdNegoBorrador);
		$usuario['PagoInicial'] = $this->modelNegociacion->PagoInicial($IdNegoBorrador);
		$usuario['CondicionesPago'] = $this->modelNegociacion->CondicionesPago($IdNegoBorrador);
		$usuario['FechaPago'] = $this->modelNegociacion->FechaDePago($IdNegoBorrador);
		$usuario['NDeposito'] = $this->modelNegociacion->NumeroDeposito($IdNegoBorrador);
		
		// DATOS DEL CLIENTE //
		$usuario['Id'] = $_POST['IdCliente'];
		$usuario['NombreC'] = $this->modelNegociacion->NombreCliente($cliente);
		$usuario['ApellidoC'] = $this->modelNegociacion->ApellidoCliente($cliente);
		$usuario['EMailC'] = $this->modelNegociacion->MailCliente($cliente);
		$usuario['TelefonoC'] = $this->modelNegociacion->TelefonoCliente($cliente);
		
		$this->load->view('Despachador/Cerrada/DConsultaCerrada', $usuario);
	}
	
	public function cerrada_i() 
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario; // Usuario //
		$cliente = $_POST['IdCliente']; // Id cliente //
		$IdNegoBorrador = $_POST['Nego']; // Id negociacion //
		$usuario['Id_Negociacion'] = $_POST['Nego']; // Id negociacion //
		$Id = $this->modelCliente->BuscarId($Usuario); // Id del usuario //
		$status = $this->modelNegociacion->StatusNegociacion($IdNegoBorrador);
		$porcentaje = $this->modelNegociacion->PorcentajeNegociacion($IdNegoBorrador);  
		$usuario['Status'] = $status;
		$usuario['Porcentaje'] = $porcentaje;
		
		// DATOS DE LA NEGOCIACION //
		$IdNegoBorrador = $_POST['Nego'];
		$usuario['FechaP'] = $this->modelNegociacion->FechaPresupuesto($IdNegoBorrador);
		$usuario['NumeroODC'] = $this->modelNegociacion->NumeroOrdenDC($IdNegoBorrador);
		$usuario['FechaODC'] = $this->modelNegociacion->FechaOrdenDC($IdNegoBorrador);
		$usuario['Banco'] = $this->modelNegociacion->Banco($IdNegoBorrador);
		$usuario['PagoInicial'] = $this->modelNegociacion->PagoInicial($IdNegoBorrador);
		$usuario['CondicionesPago'] = $this->modelNegociacion->CondicionesPago($IdNegoBorrador);
		$usuario['FechaPago'] = $this->modelNegociacion->FechaDePago($IdNegoBorrador);
		$usuario['NDeposito'] = $this->modelNegociacion->NumeroDeposito($IdNegoBorrador);
		
		// DATOS DEL CLIENTE //
		$usuario['Id'] = $_POST['IdCliente'];
		$usuario['NombreI'] = $this->modelNegociacion->NombreInstitucion($cliente);
		$usuario['TelefonoI'] = $this->modelNegociacion->TelefonoInstitucion($cliente);
		
		$this->load->view('Despachador/Cerrada/DConsultaCerradaI', $usuario);
	}
	
	// Funcion que abre la pantalla de clientes del usuario en donde consultamos 
	// clientes en el sistema.
	public function clientes()
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario;
		$usuario['Clientes'] = $this->modelNegociacion->BuscarClientes();
		$usuario['Clientes2'] = $this->modelCliente->BuscarClientesTodos();
		
		$this->load->view('Despachador/Cliente/DVerCliente', $usuario);
	}
	
	
	// Funcion que nos abre la pantalla en donde el usuario podra crear clientes
	// nuevos al sistema.  
	public function agregar_cliente()
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario;
		$usuario['Institucion'] = $this->modelInstitucion->BuscarInstituciones();
		$this->load->view('Despachador/Cliente/DCliente', $usuario);
	}
	
	// Funcion que nos devuelve a la pantalla en donde esta la lista de clientes
	// de un usuario en el sistema.
	public function atras_index() 
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario;
		$usuario['Clientes'] = $this->modelNegociacion->BuscarClientes();
		$usuario['Clientes2'] = $this->modelCliente->BuscarClientesTodos();
		
		$this->load->view('Despachador/Cliente/DVerCliente', $usuario);		
	}
	
	// Funcion que se encarga de recibir los campos que el usuario coloco para 
	// poder hacer la agregacion de un cliente al sistema.
	public function crear_cliente() 
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario;
			
		##  DATOS CLIENTE ##
		$Cliente['Tipo_C'] = $_POST['select'];
		$Cliente['Nombre'] = $_POST['Nombre'];
		$Cliente['Apellido'] = $_POST['Apellido'];
		$tipo = $_POST['Tipo'];
		$Cliente['Cedula'] = $tipo.'-'.$_POST['Cedula'];
		$Cliente['Sexo'] = $_POST['Sexo'];
		$Cliente['Dia'] = $_POST['Dia'];
		$Cliente['Mes'] = $_POST['Mes'];
		$tipo2 = $_POST['Tipo2'];
		$codigo = $_POST['Codigo'];
		$Cliente['Rif'] = $tipo2.'-'.$_POST['Rif'].'-'.$codigo;
		$Cliente['Email'] = $_POST['Email'];
		$Cliente['CPostal'] = $_POST['CPostal'];
		$Cliente['Telefono'] = $_POST['Telefono'];
		$Cliente['Telefono2'] = $_POST['Telefono2'];
		$Cliente['Telefono3'] = $_POST['Telefono3'];
		$Cliente['Especialidad'] = $_POST['Especialidad'];
		$Cliente['Subespecial'] = $_POST['Subespecial'];
		$Cliente['Web'] = $_POST['Web'];
		$Cliente['Departamento'] = $_POST['Departamento'];
			
		##  DATOS DE REDES SOCIALES ##
		$Cliente['Twitter'] = $_POST['Twitter'];
		$Cliente['Facebook'] = $_POST['Facebook'];
		$Cliente['Googleplus'] = $_POST['GoogleP'];
			
		##  DATOS DE LAS DIRECCIONES PERSONALES ##
		$Cliente['Direccion'] = $_POST['Direccion'];
		$Cliente['Direccion2'] = $_POST['Direccion2'];
		$Cliente['Direccion3'] = $_POST['Direccion3'];
			
		$this->modelCliente->InsertarCliente($Cliente);
			
		$maxcliente = $this->modelCliente->BuscarMaxId();
			
		if(isset($_POST['checkbox']))
		{
			$usuario2 = $Usuario;
			$EIC['Id_Empleado'] = $this->modelCliente->BuscarId($usuario2);
			$EIC['Id_Institucion'] = $_POST['Instituto'];
			$EIC['Id_Cliente'] = $maxcliente;
			$this->modelCliente->InsertarAgenda($EIC);
		}
			
		if(isset($_POST['checkbox2']))
		{
				$usuario3 = $Usuario;
				$EIC2['Id_Empleado'] = $this->modelCliente->BuscarId($usuario3);
				$EIC2['Id_Institucion'] = $_POST['Instituto2'];
				$EIC2['Id_Cliente'] = $maxcliente;
				$this->modelCliente->InsertarAgenda2($EIC2);
			}
			
		$usuario['Institucion'] = $this->modelInstitucion->BuscarInstituciones();
			
		$usuario['Mensaje'] = 'Se agrego el cliente con &eacute;xito!';
			
		$this->load->view('Despachador/Cliente/DCliente', $usuario);	
	}
	
	// Funcion que me busca cualquier cliente que sea en el sistema
	public function buscar_cualquiera()
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario;
		$cadena = $_POST['Buscar'];
		$respuesta = $this->modelCliente->BuscarTodo($cadena);
		$Lista = $this->modelCliente->BuscarTodo($cadena);
		
		$this->load->library('table');
		$this->table->set_empty("&nbsp;");
		$this->table->set_heading('<font style="font-size:12px" color="#369"><b>Nombre</b></font>', '<font style="font-size:12px" color="#369"><b>Apellido</b></font>', '<font style="font-size:12px" color="#369"><b>Email</b></font>', '<font style="font-size:12px" color="#369"><b>Telefono</b></font>');
		
	
		foreach ($Lista as $row)
		{
			$id = $row['Id_Cliente'];
			$nombre = $row['Nombre'];
			$apellido = $row['Apellido'];
			$email = $row['Email'];
			$telefono = $row['Telefono'];
			$this->table->add_row($nombre, $apellido, $email, $telefono, anchor('Control_Venta/ver_perfil/'.$id.'','Ver Detalle'));
		}
			
		$usuario['table'] = $this->table->generate();
		
		$this->load->view('Despachador/Cliente/DBusquedaCliente', $usuario);
	}
	
	// Funcion que nos permite ver el perfil de el cliente que nosotros 
	// queramos dentro de el sistema. 
	public function ver_perfil()
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario;
		$usuario['id_cliente'] = $_POST['Cliente'];
		$id_cliente = $_POST['Cliente'];
		$usuario['Nombre'] = $this->modelCliente->NombreCliente($id_cliente);
		$usuario['Apellido'] = $this->modelCliente->ApellidoCliente($id_cliente);
		$usuario['Email'] = $this->modelCliente->EmailCliente($id_cliente);
		$usuario['Telefono1'] = $this->modelCliente->TelfCliente($id_cliente);
		$usuario['Telefono2'] = $this->modelCliente->Telf2Cliente($id_cliente);
		$usuario['Telefono3'] = $this->modelCliente->Telf3Cliente($id_cliente);
		$usuario['Web'] = $this->modelCliente->WebCliente($id_cliente);
		$usuario['Departamento'] = $this->modelCliente->DepartamentoCliente($id_cliente);
			
		$usuario['Twitter'] = $this->modelCliente->TwitterCliente($id_cliente);
		$usuario['Facebook'] = $this->modelCliente->FacebookCliente($id_cliente);
		$usuario['Google'] = $this->modelCliente->GoogleplusCliente($id_cliente);
			
		$usuario['Direccion1'] = $this->modelCliente->DireccionCliente($id_cliente);
		$usuario['Direccion2'] = $this->modelCliente->Direccion2Cliente($id_cliente);
		$usuario['Direccion3'] = $this->modelCliente->Direccion3Cliente($id_cliente);
		
		$this->load->view('Despachador/Cliente/DVerPerfilCliente', $usuario);
	}
	
	// Funcion que nos lleva a la pantalla en donde nosotros cambiaremos
	// los datos que queramos cambiar de un cliente. 
	public function modificar_perfil()
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario;
		$id_cliente = $_POST['Cliente'];
			
		$datos['ID2'] = $id_cliente;
		$cliente = new ModelCliente;
		$this->modelCliente->ModificarCliente($cliente, $datos);
			
		$usuario['id_cliente'] = $id_cliente;
		$usuario['Nombre'] = $this->modelCliente->NombreCliente($id_cliente);
		$usuario['Apellido'] = $this->modelCliente->ApellidoCliente($id_cliente);
		$usuario['Email'] = $this->modelCliente->EmailCliente($id_cliente);
		$usuario['Telefono1'] = $this->modelCliente->TelfCliente($id_cliente);
		$usuario['Telefono2'] = $this->modelCliente->Telf2Cliente($id_cliente);
		$usuario['Telefono3'] = $this->modelCliente->Telf3Cliente($id_cliente);
		$usuario['Web'] = $this->modelCliente->WebCliente($id_cliente);
		$usuario['Departamento'] = $this->modelCliente->DepartamentoCliente($id_cliente);
			
		$usuario['Twitter'] = $this->modelCliente->TwitterCliente($id_cliente);
		$usuario['Facebook'] = $this->modelCliente->FacebookCliente($id_cliente);
		$usuario['Google'] = $this->modelCliente->GoogleplusCliente($id_cliente);
			
		$usuario['Direccion1'] = $this->modelCliente->DireccionCliente($id_cliente);
		$usuario['Direccion2'] = $this->modelCliente->Direccion2Cliente($id_cliente);
		$usuario['Direccion3'] = $this->modelCliente->Direccion3Cliente($id_cliente);
			
		$usuario['Mensaje'] = 'Se modificaron los datos del cliente con &eacute;xito!';
			
		$this->load->view('Despachador/Cliente/DVerPerfilCliente', $usuario);
	}
	
}