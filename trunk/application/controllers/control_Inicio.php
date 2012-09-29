<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Control_Inicio extends CI_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('modelInicio');
		$this->load->model('modelCliente');
		$this->load->model('modelventa');
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->library('session');
	}
	
	// Funcion para inicializar todas las funciones con el fin de no poder 
	// utilizar ningun metodo si la sesion muere en el tiempo de vida del sistema.
	//public function expiracion() 
	//{
	//	if ($this->session->userdata('Usuario') == NULL)
		//{
		//	$url = 'http://elp21.no-ip.info:4085/SGP';
		//	echo '<script type="text/javascript">alert("Su sesion ha expirado'; 
   		//	echo ', vuelva a logearse para continuar"); window.location="'.$url.'";<//script>';
		//}
	//}
	
	// Funcion que se utiliza para iniciar el sistema.
	public function index()
	{
		$this->load->view('index');		
	}
	
	// Funcion que se utiliza para iniciar la sesion en el sistema.
	public function iniciar_sesion() 
	{
		$usuario = $_POST['Nombre'];
		$clave = $_POST['Clave'];
		
		$usuariofalso = $this->modelInicio->VerificarClave($usuario); 
		
		if($usuariofalso == -1)
		{
			$this->load->view('Index2');
		}
		else
		{
		$Tipo_1 = 'Administrador';
		$Tipo_2 = 'Vendedor';
		$Tipo_3 = 'Despachador';
		
		$clavebd = $this->modelInicio->VerificarClave($usuario); // Clave del usuario en la base de datos //
		$tipoemp = $this->modelInicio->VerificarTipo($usuario); // Tipo de usuario //
		if ($clave == $clavebd)
		{
			if($tipoemp == $Tipo_1) // Si se es administrador entra en este if //
			{
				$firstName = $this->modelInicio->ConsultarNombre($usuario); 
				$lastName = $this->modelInicio->ConsultarApellido($usuario); 
				$userEmail = $this->modelInicio->ConsultarUsuario($usuario); 
				$usuario2 = array('nombre' => $firstName,'apellido' => $lastName,'Usuario' => $userEmail);
				$this->session->set_userdata($usuario2);
				
				$usuario2['NumeroBorrador'] = $this->modelInicio->NumeroBorradores();
				$usuario2['NumeroActiva'] = $this->modelInicio->NumeroActivas();
				$usuario2['NumeroGanada'] = $this->modelInicio->NumeroGanadas();
				$usuario2['NumeroCerrada'] = $this->modelInicio->NumeroCerradas();
				$usuario2['NumeroPerdida'] = $this->modelInicio->NumeroPerdidas();
				$usuario2['NumeroTotal'] = $this->modelInicio->NumeroTotal();
				
				$cedula = $this->modelCliente->BuscarId($usuario);
				$usuario2['SinAutorizar'] = $this->modelInicio->SinAutorizar2($cedula);
				$usuario2['NumeroPorAprobar'] = $this->modelInicio->NumeroPorAprobar();
				$usuario2['ConAlertaTotal'] = $this->modelInicio->ConAlertaTotal();
				$usuario2['ConModTotal'] = $this->modelInicio->ConModTotal();
				$usuario2['NegociacionesEx'] = $this->modelInicio->NegociacionesEx();
				
				$this->load->view('Administrador/APrincipal', $usuario2);
			}
			if($tipoemp == $Tipo_2) // Si se es vendedor entra en este if //
			{
				$firstName = $this->modelInicio->ConsultarNombre($usuario); 
				$lastName = $this->modelInicio->ConsultarApellido($usuario); 
				$userEmail = $this->modelInicio->ConsultarUsuario($usuario); 
				$usuario2 = array('nombre' => $firstName,'apellido' => $lastName,'Usuario' => $userEmail);
				$this->session->set_userdata($usuario2);
				
				$cedula = $this->modelCliente->BuscarId($usuario);
				$usuario2['SinAutorizar'] = $this->modelInicio->SinAutorizar($cedula);
				$usuario2['NumeroAprobadas'] = $this->modelInicio->NumeroAprobadas($cedula);
				$usuario2['ConAutorizar'] = $this->modelInicio->ConAutorizar($cedula);
				$usuario2['ConAlerta'] = $this->modelInicio->ConAlerta($cedula); 
				$usuario2['Rechazadas'] = $this->modelInicio->Rechazadas($cedula);
				
				$usuario2['NumeroPorAprobar'] = $this->modelInicio->NumeroPorAprobar2($cedula);
				$usuario2['NumeroRechazadas'] = $this->modelInicio->NumeroRechazadas($cedula);
				
				$this->load->view('Vendedor/VPrincipal', $usuario2);
			}
			if($tipoemp == $Tipo_3) // Si se es vendedor entra en este if //
			{
				$firstName = $this->modelInicio->ConsultarNombre($usuario); 
				$lastName = $this->modelInicio->ConsultarApellido($usuario); 
				$userEmail = $this->modelInicio->ConsultarUsuario($usuario); 
				$usuario2 = array('nombre' => $firstName,'apellido' => $lastName,'Usuario' => $userEmail);
				$this->session->set_userdata($usuario2);
				
				$cedula = $this->modelCliente->BuscarId($userEmail);
				
				$usuario2['NumeroPorAprobar'] = $this->modelInicio->NumeroPorAprobar2($cedula);
				$usuario2['SinAutorizar'] = $this->modelInicio->SinAutorizar($cedula);
				
				$usuario2['Ganadas'] = $this->modelventa->NegoGanadas(); 
				$usuario2['Ganadas2'] = $this->modelventa->NumNegoGanadas(); 
				
				$usuario2['NoFacturadas'] = $this->modelventa->NoFacturadas(); 
				$usuario2['NoFacturadas2'] = $this->modelventa->NumNoFacturadas();
				
				$usuario2['SiFacturadas'] = $this->modelventa->NumFacturadas();
				$usuario2['SiFacturadas2'] = $this->modelventa->Facturadas();
				
				$this->load->view('Despachador/DPrincipal', $usuario2);
			}
		}
		else 
		{	
			$this->load->view('Index2');
		}
		}
	}
	
	// Funcion que se encarga de destruir la sesion que se encuentra abierta y redireccionar
	// a la pagina de iniciar sesion nuevamente.
	public function cerrar_sesion() 
	{
		$this->session->sess_destroy();
		$this->load->view('index');
	}
	
	// Funcion que se utiliza para redireccionar todas las paginas por medio del boton de
	// inicio a la pagina principal del sistema de los vendedores.
	public function v_principal() 
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario;
		$cedula = $this->modelCliente->BuscarId($Usuario);
		$usuario['SinAutorizar'] = $this->modelInicio->SinAutorizar($cedula);
		$usuario['Rechazadas'] = $this->modelInicio->Rechazadas($cedula);
		$usuario['NumeroAprobadas'] = $this->modelInicio->NumeroAprobadas($cedula);
		$usuario['ConAutorizar'] = $this->modelInicio->ConAutorizar($cedula);   
		
		$usuario['NumeroPorAprobar'] = $this->modelInicio->NumeroPorAprobar2($cedula);
		$usuario['NumeroRechazadas'] = $this->modelInicio->NumeroRechazadas($cedula);
		
		$this->load->view('Vendedor/VPrincipal', $usuario);	
	}
	
	// Funcion que se utiliza para redireccionar todas las paginas por medio del boton de
	// inicio a la pagina principal del sistema de los supervisores.
	public function a_principal() 
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario;
		$cedula = $this->modelCliente->BuscarId($Usuario);
			
		$usuario['NumeroBorrador'] = $this->modelInicio->NumeroBorradores();
		$usuario['NumeroActiva'] = $this->modelInicio->NumeroActivas();
		$usuario['NumeroGanada'] = $this->modelInicio->NumeroGanadas();
		$usuario['NumeroCerrada'] = $this->modelInicio->NumeroCerradas();
		$usuario['NumeroPerdida'] = $this->modelInicio->NumeroPerdidas();
		$usuario['NumeroTotal'] = $this->modelInicio->NumeroTotal();
			
		$usuario['NumeroPorAprobar'] = $this->modelInicio->NumeroPorAprobar();
		$usuario['SinAutorizar'] = $this->modelInicio->SinAutorizar2($cedula);
		$usuario['ConAlertaTotal'] = $this->modelInicio->ConAlertaTotal();
		$usuario['ConModTotal'] = $this->modelInicio->ConModTotal();
		$usuario['NegociacionesEx'] = $this->modelInicio->NegociacionesEx();
		$usuario['ConAlerta'] = $this->modelInicio->ConAlerta($cedula); 
		
		$this->load->view('Administrador/APrincipal', $usuario);	
	}
	
	// Funcion que se utiliza para redireccionar todas las paginas por medio del boton de
	// inicio a la pagina principal del sistema de los despachadores o encargados de ventas
	public function d_principal() 
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario;
		
		$cedula = $this->modelCliente->BuscarId($Usuario);
				
		$usuario['NumeroPorAprobar'] = $this->modelInicio->NumeroPorAprobar2($cedula);
		$usuario['SinAutorizar'] = $this->modelInicio->SinAutorizar($cedula);
		
		$usuario['Ganadas'] = $this->modelventa->NegoGanadas(); 
		$usuario['Ganadas2'] = $this->modelventa->NumNegoGanadas(); 
				
		$usuario['NoFacturadas'] = $this->modelventa->NoFacturadas(); 
		$usuario['NoFacturadas2'] = $this->modelventa->NumNoFacturadas();
				
		$usuario['SiFacturadas'] = $this->modelventa->NumFacturadas();
		$usuario['SiFacturadas2'] = $this->modelventa->Facturadas();
		
		$this->load->view('Despachador/DPrincipal', $usuario);	
	}
}
