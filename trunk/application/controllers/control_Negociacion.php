<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class control_Negociacion extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('modelNegociacion');
		$this->load->model('modelCliente');
		$this->load->model('modelProducto');
		$this->load->model('modelInstitucion');
		$this->load->model('modelInicio');
		$this->load->model('modelventa');
		$this->load->helper('form');
		$this->load->library('email');
	}
	
	public function index()
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario;
		$usuario2 = $Usuario;
		$Id = $this->modelCliente->BuscarId($usuario2);
		$usuario['Clientes'] = $this->modelNegociacion->BuscarClientes();
		$this->load->view('Vendedor/VNegociacion', $usuario);
	}
	
	public function index2()
	{
		$Usuario = $this->session->userdata('Usuario');
	    $usuario['Usuario'] = $Usuario;
		$usuario2 = $Usuario;
		$Id = $this->modelCliente->BuscarId($usuario2);
		$usuario['Institucion'] = $this->modelNegociacion->BuscarInstitucion($Id);
		$this->load->view('Vendedor/VNegociacion2', $usuario);
	}
	
	// CAMBIO DE ESTATUS DE UNA NEGOCIACION //
	public function cambio_status_4a($Id_Negociacion)
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario; 
		$usuario2 = $Usuario;
		$usuario['Id_Negociacion'] = $Id_Negociacion;
		$datos['ID2'] = $Id_Negociacion;
		$IdSeguimiento = $this->modelNegociacion->BuscarSeguimiento($Id_Negociacion);
		
		$Seguimiento = new ModelNegociacion;
		$this->modelNegociacion->ModificarStatus($Seguimiento, $datos);
		$this->modelNegociacion->HistorialStatus($Seguimiento, $datos);
		
		$status = $this->modelNegociacion->StatusNegociacion($Id_Negociacion); 
		
		//$this->load->library('email');  
		//$this->email->from('jrodriguezv.11@gmail.com','Sistema de gestion SGP');  
		//$this->email->to("jrodriguezv.11@gmail.com"); // Mail de la jefa de YOMA //
		//$this->email->subject('Usted a cambiado la negociacion ( '.$Id_Negociacion.' ) a '.$status.'');  
		//$this->email->message("Para acceder a dicha notificacion, haga clic en el siguiente link elp21.no-ip.info:4085/SGP");  
		//$this->email->send(); 
		
		$cedula = $this->modelCliente->BuscarId($Usuario);
		$usuario['NumeroBorrador'] = $this->modelInicio->NumeroBorradores();
		$usuario['NumeroActiva'] = $this->modelInicio->NumeroActivas();
		$usuario['NumeroGanada'] = $this->modelInicio->NumeroGanadas();
		$usuario['NumeroCerrada'] = $this->modelInicio->NumeroCerradas();
		$usuario['NumeroPerdida'] = $this->modelInicio->NumeroPerdidas();
		$usuario['NumeroTotal'] = $this->modelInicio->NumeroTotal();
		
		$usuario['NumeroPorAprobar'] = $this->modelInicio->NumeroPorAprobar();
		$usuario['SinAutorizar'] = $this->modelInicio->SinAutorizar2($cedula);
		
		$this->load->view('Administrador/APrincipal', $usuario);
	}
	
	public function ir_negociacion_atras($Id_Negociacion) 
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario; 
		$usuario['Id_Negociacion'] = $Id_Negociacion;
		$Id_Negociacion = $Id_Negociacion;
		$Id_Cliente = $this->modelCliente->BuscarIdCliente($Id_Negociacion);
		$Id_ClienteI = $this->modelNegociacion->BuscarClienteI($Id_Negociacion); // Id cliente institucion //
		
		if ($Id_Cliente == NULL) // Aqui entra si el cliente es una institucion //
		{
			$usuario['idcliente'] = $Id_ClienteI; // Id Cliente
			
			$status = $this->modelNegociacion->StatusNegociacion($Id_Negociacion); 
			$usuario['Status'] = $status;
			
			$usuario['DatosCliente'] = $this->modelCliente->DatosClienteI($Id_Negociacion, $Id_ClienteI); 
			$cedula = $this->modelCliente->BuscarId($Usuario); 
			$Vendedor = $this->modelCliente->BuscarVendedor($Id_Negociacion); 
			
			$usuario['DatosVendedor'] = $this->modelCliente->DatosVendedorI2($Id_Negociacion, $Vendedor); 
			$usuario['Lista'] = $this->modelProducto->ConsultarLista($Id_Negociacion);
			$usuario['Lista2'] = $this->modelProducto->ConsultarLista2($Id_Negociacion);
			
			$usuario['Descuento'] = $this->modelProducto->ConsultarDescuento($Id_Negociacion);
			$Neto = $this->modelProducto->Neto($Id_Negociacion);
			$Neto2 = $this->modelProducto->Neto2($Id_Negociacion);
			$Neto3 = $Neto+$Neto2;
			$usuario['Neto'] = $Neto3;
			$usuario['Iva'] = $Neto3*0.12;
			
			$this->load->view('Administrador/AVistaPreviaI2', $usuario);
		}
		else // Aqui entra si el cliente es una persona //
		{
			$usuario['idcliente'] = $Id_Cliente; // Id Cliente
		
			$usuario['Permiso'] = $this->modelNegociacion->ConsultarPermiso($Id_Negociacion); 
			
			$status = $this->modelNegociacion->StatusNegociacion($Id_Negociacion); 
			$usuario['Status'] = $status;
			$usuario['DatosCliente'] = $this->modelCliente->DatosCliente($Id_Negociacion, $Id_Cliente); 
			$cedula = $this->modelCliente->BuscarId($Usuario); 
			$Vendedor = $this->modelCliente->BuscarVendedor($Id_Negociacion); 
			
			$usuario['DatosVendedor'] = $this->modelCliente->DatosVendedor2($Id_Negociacion, $Vendedor); 
			$usuario['Lista'] = $this->modelProducto->ConsultarLista($Id_Negociacion);
			$usuario['Lista2'] = $this->modelProducto->ConsultarLista2($Id_Negociacion);
			
			$usuario['Descuento'] = $this->modelProducto->ConsultarDescuento($Id_Negociacion);
			$Neto = $this->modelProducto->Neto($Id_Negociacion);
			$Neto2 = $this->modelProducto->Neto2($Id_Negociacion);
			$Neto3 = $Neto+$Neto2;
			$usuario['Neto'] = $Neto3;
			$usuario['Iva'] = $Neto3*0.12;
			
			$this->load->view('Administrador/AVistaPrevia2', $usuario);
		}
	}
	
	public function cambio_status_2a($Id_Negociacion) 
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario; 
		$usuario2 = $Usuario;
		$usuario['Id_Negociacion'] = $Id_Negociacion;
		$datos['ID2'] = $Id_Negociacion;
		$IdSeguimiento = $this->modelNegociacion->BuscarSeguimiento($Id_Negociacion);
		
		$Seguimiento = new ModelNegociacion;
		$this->modelNegociacion->ModificarStatus($Seguimiento, $datos);
		$this->modelNegociacion->HistorialStatus($Seguimiento, $datos);
		
		$status = $this->modelNegociacion->StatusNegociacion($Id_Negociacion); 
		
		//$this->load->library('email');  
		//$this->email->from('jrodriguezv.11@gmail.com','Sistema de gestion SGP');  
		//$this->email->to("jrodriguezv.11@gmail.com"); // Mail de la jefa de YOMA //
		//$this->email->subject('El estatus de la negociacion '.$Id_Negociacion.' a sido cambiada a '.$status.'');  
		//$this->email->message("Acceso rapido elp21.no-ip.info:4085/SGP");  
		//$this->email->send(); 
		
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
		
		$this->load->view('Administrador/APrincipal', $usuario);
	}
	
	// Funcion que verifica el historial de todos los status que a tenido una negociacion //
	public function historial_status_a($Id_Negociacion) 
	{
		$Lista = $this->modelNegociacion->HistorialLista($Id_Negociacion);
		
		$this->load->library('table');
		$this->table->set_empty("&nbsp;");
		$this->table->set_heading('<font style="font-size:12px" color="#369"><b>Status</b></font>', '<font style="font-size:12px" color="#369"><b>Fecha del status</b></font>', '<font style="font-size:12px" color="#369"><b>Tipo de contacto</b></font>', '<font style="font-size:12px" color="#369"><b>Resumen</b></font>');
		
	
		foreach ($Lista as $row)
		{
			$status = $row['Status'];
			$fecha = $row['FechaS'];
			$tipo = $row['TipoS'];
			$resumen = $row['Resumen'];
			$this->table->add_row($status, $fecha, $tipo, $resumen);
		}
			
		$usuario['table'] = $this->table->generate();
		
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario; 
		$usuario['Id_Negociacion'] = $Id_Negociacion;
		
		
		$this->load->view('Administrador/AHistorialStatus', $usuario);
	}
	
	// Funcion que verifica el historial de todos los status que a tenido una negociacion //
	public function historial_status_a2($Id_Negociacion) 
	{
		$Lista = $this->modelNegociacion->HistorialLista($Id_Negociacion);
		
		$this->load->library('table');
		$this->table->set_empty("&nbsp;");
		$this->table->set_heading('<font style="font-size:12px" color="#369"><b>Status</b></font>', '<font style="font-size:12px" color="#369"><b>Fecha del status</b></font>', '<font style="font-size:12px" color="#369"><b>Tipo de contacto</b></font>', '<font style="font-size:12px" color="#369"><b>Resumen</b></font>');
		
	
		foreach ($Lista as $row)
		{
			$status = $row['Status'];
			$fecha = $row['FechaS'];
			$tipo = $row['TipoS'];
			$resumen = $row['Resumen'];
			$this->table->add_row($status, $fecha, $tipo, $resumen);
		}
			
		$usuario['table'] = $this->table->generate();
		
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario; 
		$usuario['Id_Negociacion'] = $Id_Negociacion;
		
		
		$this->load->view('Administrador/AHistorialStatus2', $usuario);
	}
	
	// Funcion que me separa las negociaciones de clientes y de instituciones que hay q aprobar //
	public function sin_aprobar_2() 
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario; // Id Negociacion //
		$usuario['Id_Negociacion'] = $_POST['SinAprobar'];
		$Id_Negociacion = $_POST['SinAprobar'];
		$Id_Cliente = $this->modelCliente->BuscarIdCliente($Id_Negociacion);
		$Id_ClienteI = $this->modelNegociacion->BuscarClienteI($Id_Negociacion); // Id cliente institucion //
		
		if ($Id_Cliente == NULL) // Aqui entra si el cliente es una institucion //
		{
			$usuario['idcliente'] = $Id_ClienteI; // Id Cliente
			
			$status = $this->modelNegociacion->StatusNegociacion($Id_Negociacion); 
			$usuario['Status'] = $status;
			
			$usuario['DatosCliente'] = $this->modelCliente->DatosClienteI($Id_Negociacion, $Id_ClienteI); 
			$cedula = $this->modelCliente->BuscarId($Usuario); 
			$Vendedor = $this->modelCliente->BuscarVendedor($Id_Negociacion); 
			
			$usuario['DatosVendedor'] = $this->modelCliente->DatosVendedorI2($Id_Negociacion, $Vendedor); 
			$Lista = $this->modelProducto->ConsultarLista($Id_Negociacion);
			$Lista2 = $this->modelProducto->ConsultarLista2($Id_Negociacion);
			
			$this->load->library('table');
			$this->table->set_empty("&nbsp;");
			$this->table->set_heading('<font style="font-size:12px" color="#369"><b>CODIGO</b></font>', '<font style="font-size:12px" color="#369"><b>CANTIDAD</b></font>', '<font style="font-size:12px" color="#369"><b>DESCRIPCI&Oacute;N</b></font>');
				
			foreach ($Lista as $row)
			{
				$codigo = $row['Codigo'];
				$cantidad = $row['Cantidad'];
				$descripcion = $row['Descripcion2'];
				$this->table->add_row($codigo, $cantidad, $descripcion);
			}
				
			foreach ($Lista2 as $row)
			{
				$codigo2 = $row['Codigo'];
				$cantidad2 = $row['Cantidad'];
				$descripcion2 = $row['Descripcion2'];
				$this->table->add_row($codigo2, $cantidad2, $descripcion2);
			}
					
			$usuario['table'] = $this->table->generate();
			
			$usuario['Descuento'] = $this->modelProducto->ConsultarDescuento($Id_Negociacion);
			$Neto = $this->modelProducto->Neto($Id_Negociacion);
			$Neto2 = $this->modelProducto->Neto2($Id_Negociacion);
			$Neto3 = $Neto+$Neto2;
			$usuario['Neto'] = $Neto3;
			//$usuario['Iva'] = $Neto3*0.12;
			
			$this->load->view('Administrador/AVistaPreviaI', $usuario);
		}
		else // Aqui entra si el cliente es una persona //
		{
			$usuario['idcliente'] = $Id_Cliente; // Id Cliente
		
			$usuario['Permiso'] = $this->modelNegociacion->ConsultarPermiso($Id_Negociacion); 
			
			$status = $this->modelNegociacion->StatusNegociacion($Id_Negociacion); 
			$usuario['Status'] = $status;
			$usuario['DatosCliente'] = $this->modelCliente->DatosCliente($Id_Negociacion, $Id_Cliente); 
			$cedula = $this->modelCliente->BuscarId($Usuario); 
			$Vendedor = $this->modelCliente->BuscarVendedor($Id_Negociacion); 
			
			$usuario['DatosVendedor'] = $this->modelCliente->DatosVendedor2($Id_Negociacion, $Vendedor); 
			$Lista = $this->modelProducto->ConsultarLista($Id_Negociacion);
			$Lista2 = $this->modelProducto->ConsultarLista2($Id_Negociacion);
			
			$this->load->library('table');
			$this->table->set_empty("&nbsp;");
			$this->table->set_heading('<font style="font-size:12px" color="#369"><b>CODIGO</b></font>', '<font style="font-size:12px" color="#369"><b>CANTIDAD</b></font>', '<font style="font-size:12px" color="#369"><b>DESCRIPCI&Oacute;N</b></font>');
				
			foreach ($Lista as $row)
			{
				$codigo = $row['Codigo'];
				$cantidad = $row['Cantidad'];
				$descripcion = $row['Descripcion2'];
				$this->table->add_row($codigo, $cantidad, $descripcion);
			}
				
			foreach ($Lista2 as $row)
			{
				$codigo2 = $row['Codigo'];
				$cantidad2 = $row['Cantidad'];
				$descripcion2 = $row['Descripcion2'];
				$this->table->add_row($codigo2, $cantidad2, $descripcion2);
			}
					
			$usuario['table'] = $this->table->generate();
			
			$usuario['Descuento'] = $this->modelProducto->ConsultarDescuento($Id_Negociacion);
			$Neto = $this->modelProducto->Neto($Id_Negociacion);
			$Neto2 = $this->modelProducto->Neto2($Id_Negociacion);
			$Neto3 = $Neto+$Neto2;
			$usuario['Neto'] = $Neto3;
			//$usuario['Iva'] = $Neto3*0.12;
			
			$this->load->view('Administrador/AVistaPrevia', $usuario);
		}
	}
	
	public function todas_vistas() 
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario; // Id Negociacion //
		$usuario['Id_Negociacion'] = $_POST['Buscar'];
		$Id_Negociacion2 = $_POST['Buscar'];
		$Id_Negociacion = $this->modelNegociacion->BuscarExiste($Id_Negociacion2);
		if ($Id_Negociacion == NULL)
		{
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
			
			$this->load->view('Administrador/APrincipal', $usuario);
		}
		else
		{
			$Id_Cliente = $this->modelCliente->BuscarIdCliente($Id_Negociacion);
			$Id_ClienteI = $this->modelNegociacion->BuscarClienteI($Id_Negociacion); // Id cliente institucion //
			
			if ($Id_Cliente == NULL) // Aqui entra si el cliente es una institucion //
			{
				$usuario['idcliente'] = $Id_ClienteI; // Id Cliente
				
				$status = $this->modelNegociacion->StatusNegociacion($Id_Negociacion); 
				$usuario['Status'] = $status;
				
				$usuario['DatosCliente'] = $this->modelCliente->DatosClienteI($Id_Negociacion, $Id_ClienteI); 
				$cedula = $this->modelCliente->BuscarId($Usuario); 
				$Vendedor = $this->modelCliente->BuscarVendedor($Id_Negociacion); 
				
				$usuario['DatosVendedor'] = $this->modelCliente->DatosVendedorI2($Id_Negociacion, $Vendedor); 
				$Lista = $this->modelProducto->ConsultarLista($Id_Negociacion);
				$Lista2 = $this->modelProducto->ConsultarLista2($Id_Negociacion);
				
				$this->load->library('table');
				$this->table->set_empty("&nbsp;");
				$this->table->set_heading('<font style="font-size:12px" color="#369"><b>CODIGO</b></font>', '<font style="font-size:12px" color="#369"><b>CANTIDAD</b></font>', '<font style="font-size:12px" color="#369"><b>DESCRIPCI&Oacute;N</b></font>');
					
				foreach ($Lista as $row)
				{
					$codigo = $row['Codigo'];
					$cantidad = $row['Cantidad'];
					$descripcion = $row['Descripcion2'];
					$this->table->add_row($codigo, $cantidad, $descripcion);
				}
					
				foreach ($Lista2 as $row)
				{
					$codigo2 = $row['Codigo'];
					$cantidad2 = $row['Cantidad'];
					$descripcion2 = $row['Descripcion2'];
					$this->table->add_row($codigo2, $cantidad2, $descripcion2);
				}
						
				$usuario['table'] = $this->table->generate();
						
				$usuario['Descuento'] = $this->modelProducto->ConsultarDescuento($Id_Negociacion);
				$Neto = $this->modelProducto->Neto($Id_Negociacion);
				$Neto2 = $this->modelProducto->Neto2($Id_Negociacion);
				$Neto3 = $Neto+$Neto2;
				$usuario['Neto'] = $Neto3;
				$usuario['Iva'] = $Neto3*0.12;
				
				$this->load->view('Administrador/AVistaPreviaI2', $usuario);
			}
			else // Aqui entra si el cliente es una persona //
			{
				$usuario['idcliente'] = $Id_Cliente; // Id Cliente
		
				$usuario['Permiso'] = $this->modelNegociacion->ConsultarPermiso($Id_Negociacion); 
			
				$status = $this->modelNegociacion->StatusNegociacion($Id_Negociacion); 
				$usuario['Status'] = $status;
				$usuario['DatosCliente'] = $this->modelCliente->DatosCliente($Id_Negociacion, $Id_Cliente); 
				$cedula = $this->modelCliente->BuscarId($Usuario); 
				$Vendedor = $this->modelCliente->BuscarVendedor($Id_Negociacion); 
			
				$usuario['DatosVendedor'] = $this->modelCliente->DatosVendedor2($Id_Negociacion, $Vendedor); 
				$Lista = $this->modelProducto->ConsultarLista($Id_Negociacion);
				$Lista2 = $this->modelProducto->ConsultarLista2($Id_Negociacion);
				
				$this->load->library('table');
				$this->table->set_empty("&nbsp;");
				$this->table->set_heading('<font style="font-size:12px" color="#369"><b>CODIGO</b></font>', '<font style="font-size:12px" color="#369"><b>CANTIDAD</b></font>', '<font style="font-size:12px" color="#369"><b>DESCRIPCI&Oacute;N</b></font>');
					
				foreach ($Lista as $row)
				{
					$codigo = $row['Codigo'];
					$cantidad = $row['Cantidad'];
					$descripcion = $row['Descripcion2'];
					$this->table->add_row($codigo, $cantidad, $descripcion);
				}
					
				foreach ($Lista2 as $row)
				{
					$codigo2 = $row['Codigo'];
					$cantidad2 = $row['Cantidad'];
					$descripcion2 = $row['Descripcion2'];
					$this->table->add_row($codigo2, $cantidad2, $descripcion2);
				}
						
				$usuario['table'] = $this->table->generate();
				
				$usuario['Descuento'] = $this->modelProducto->ConsultarDescuento($Id_Negociacion);
				$Neto = $this->modelProducto->Neto($Id_Negociacion);
				$Neto2 = $this->modelProducto->Neto2($Id_Negociacion);
				$Neto3 = $Neto+$Neto2;
				$usuario['Neto'] = $Neto3;
				$usuario['Iva'] = $Neto3*0.12;
				
				$this->load->view('Administrador/AVistaPrevia2', $usuario);
			}
		}
	}
	
	// Funcion para el boton de atras que se encuentra cobre la vista previa de las negociaciones por aprobar //
	public function atras_avista_previa() 
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario; // Id Negociacion //
		$cedula = $this->modelCliente->BuscarId($Usuario);
		$usuario['NumeroPorAprobar'] = $this->modelInicio->NumeroPorAprobar();
		$usuario['SinAutorizar'] = $this->modelInicio->SinAutorizar2($cedula);
		$usuario['NumeroBorrador'] = $this->modelInicio->NumeroBorradores();
		$usuario['NumeroActiva'] = $this->modelInicio->NumeroActivas();
		$usuario['NumeroGanada'] = $this->modelInicio->NumeroGanadas();
		$usuario['NumeroCerrada'] = $this->modelInicio->NumeroCerradas();
		$usuario['NumeroPerdida'] = $this->modelInicio->NumeroPerdidas();
		$usuario['NumeroTotal'] = $this->modelInicio->NumeroTotal();
		
		$usuario['ConAlertaTotal'] = $this->modelInicio->ConAlertaTotal();
		$usuario['ConModTotal'] = $this->modelInicio->ConModTotal();
		$usuario['NegociacionesEx'] = $this->modelInicio->NegociacionesEx();
		
		$this->load->view('Administrador/APrincipal', $usuario);
	}
	
	// Funcion que se encarga de la aprobacion de las negociaciones //
	public function aprobar()
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario; 
		$Id_Negociacion = $_POST['Negociacion']; // Id Negociacion //
		$cedula = $this->modelCliente->BuscarId($Usuario);
		$usuario['SinAutorizar'] = $this->modelInicio->SinAutorizar2($cedula);
		$cedulaempleado = $this->modelInicio->CedEmpleado($Id_Negociacion);
		$datos['ID2'] = $Id_Negociacion;
		
		// Modifica el estatus de la negociacion //
		$negociacion = new ModelNegociacion;
		$this->modelNegociacion->ModificarEstatus2($negociacion, $datos);
		
		$usuario['NumeroBorrador'] = $this->modelInicio->NumeroBorradores();
		$usuario['NumeroActiva'] = $this->modelInicio->NumeroActivas();
		$usuario['NumeroGanada'] = $this->modelInicio->NumeroGanadas();
		$usuario['NumeroCerrada'] = $this->modelInicio->NumeroCerradas();
		$usuario['NumeroPerdida'] = $this->modelInicio->NumeroPerdidas();
		$usuario['NumeroTotal'] = $this->modelInicio->NumeroTotal();
		
		$usuario['SinAutorizar'] = $this->modelInicio->SinAutorizar2($cedula); 
		$usuario['NumeroPorAprobar'] = $this->modelInicio->NumeroPorAprobar();
		$mail = $this->modelInicio->MailEmpleado($cedulaempleado);
		
		//$this->load->library('email');  
		//$this->email->from('jrodriguezv.11@gmail.com','Sistema de gestion SGP');  
		//$this->email->to($mail);  
		//$this->email->subject('Su negociacion con el Nro ( '.$Id_Negociacion.' ), ha sido aprobada exitosamente');  
		//$this->email->message("Para acceder a dicha notificacion, haga clic en el siguiente link elp21.no-ip.info:4085/SGP");  
		//$this->email->send(); 
		
		$Alerta = new ModelNegociacion;
		$this->modelNegociacion->ModificarAlertaM($Alerta, $datos);
		$usuario['ConAlertaTotal'] = $this->modelInicio->ConAlertaTotal();
		$usuario['ConModTotal'] = $this->modelInicio->ConModTotal();
		$usuario['NegociacionesEx'] = $this->modelInicio->NegociacionesEx();
		
		$this->load->view('Administrador/APrincipal', $usuario);
	}
	
	// Funcion que me trae una lista con todos los vendedores que trabajan en mi sistema //
	public function buscar_vendedores() 
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario; // Id Negociacion //
		$usuario['Vendedores'] = $this->modelCliente->Vendedores();
		$usuario['NumeroBorrador'] = $this->modelInicio->NumeroBorradores();
		$usuario['NumeroActiva'] = $this->modelInicio->NumeroActivas();
		$usuario['NumeroGanada'] = $this->modelInicio->NumeroGanadas();
		$usuario['NumeroCerrada'] = $this->modelInicio->NumeroCerradas();
		$usuario['NumeroPerdida'] = $this->modelInicio->NumeroPerdidas();
		$usuario['ConAlertaTotal'] = $this->modelInicio->ConAlertaTotal();
		$usuario['ConModTotal'] = $this->modelInicio->ConModTotal();
		
		$this->load->view('Administrador/AVerVendedores', $usuario);
	}
	
	// Funcion que me muestra las cantidades y las negociaciones con sus respectivos estatus //
	public function ver_negociacion_vendedor()
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario;
		$Cedula = $_POST['Cliente'];
		$usuario['Cliente'] = $_POST['Cliente'];
		$usuario['Vendedores'] = $this->modelCliente->Vendedores2($Cedula);
		$usuario['NBorrador'] = $this->modelNegociacion->NegociacionBorradorA($Cedula);
		$usuario['NumeroBorradorA'] = $this->modelNegociacion->NumeroBorradoresA($Cedula);
			
		$usuario['NActiva'] = $this->modelNegociacion->NegociacionActivaA($Cedula);
		$usuario['NActiva2'] = $this->modelNegociacion->NegociacionActivaA2($Cedula);
		$usuario['NumeroActivaA'] = $this->modelNegociacion->NumeroActivasA($Cedula);
		
		$usuario['NGanada'] = $this->modelNegociacion->NegociacionGanadaA($Cedula);
		$usuario['NumeroGanadaA'] = $this->modelNegociacion->NumeroGanadasA($Cedula);
		
		$usuario['NCerrada'] = $this->modelNegociacion->NegociacionCerradaA($Cedula);
		$usuario['NumeroCerradaA'] = $this->modelNegociacion->NumeroCerradasA($Cedula);
		
		$usuario['NPerdida'] = $this->modelNegociacion->NegociacionPerdidaA($Cedula);
		$usuario['NumeroPerdidaA'] = $this->modelNegociacion->NumeroPerdidasA($Cedula);
		
		$this->load->view('Administrador/AVerNegociacion', $usuario);
	}
	
	// Funcion que muestra las vista previa de todas la negociaciones que quiera ver el supervisor //
	public function vista_negociacion() 
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario; 
		$usuario['Id_Negociacion'] = $_POST['Nego'];
		$Id_Negociacion = $_POST['Nego'];
		$usuario['Cliente'] = $_POST['Cliente'];
		$Id_Cliente = $this->modelCliente->BuscarIdCliente($Id_Negociacion);
		$Id_ClienteI = $this->modelNegociacion->BuscarClienteI($Id_Negociacion); // Id cliente institucion //
		$usuario['condiciones'] = $this->modelNegociacion->CondicionesPagos($Id_Negociacion); 
		
		if ($Id_Cliente == NULL) // Aqui entra si el cliente es una institucion //
		{
			$usuario['idcliente'] = $Id_ClienteI; // Id Cliente
			
			$status = $this->modelNegociacion->StatusNegociacion($Id_Negociacion); 
			$usuario['Status'] = $status;
			
			$usuario['DatosCliente'] = $this->modelCliente->DatosClienteI($Id_Negociacion, $Id_ClienteI); 
			$cedula = $this->modelCliente->BuscarId($Usuario); 
			$Vendedor = $this->modelCliente->BuscarVendedor($Id_Negociacion); 
			
			$usuario['DatosVendedor'] = $this->modelCliente->DatosVendedorI2($Id_Negociacion, $Vendedor); 
			
			$Lista = $this->modelProducto->ConsultarLista($Id_Negociacion);
			$Lista2 = $this->modelProducto->ConsultarLista2($Id_Negociacion);
		
			$this->load->library('table');
			$this->table->set_empty("&nbsp;");
			$this->table->set_heading('<font style="font-size:12px" color="#369"><b>CODIGO</b></font>', '<font style="font-size:12px" color="#369"><b>CANTIDAD</b></font>', '<font style="font-size:12px" color="#369"><b>DESCRIPCI&Oacute;N</b></font>');
				
			foreach ($Lista as $row)
			{
				$codigo = $row['Codigo'];
				$cantidad = $row['Cantidad'];
				$descripcion = $row['Descripcion2'];
				$this->table->add_row($codigo, $cantidad, $descripcion);
			}
				
			foreach ($Lista2 as $row)
			{
				$codigo2 = $row['Codigo'];
				$cantidad2 = $row['Cantidad'];
				$descripcion2 = $row['Descripcion2'];
				$this->table->add_row($codigo2, $cantidad2, $descripcion2);
			}
					
			$usuario['table'] = $this->table->generate();
		
			$usuario['Descuento'] = $this->modelProducto->ConsultarDescuento($Id_Negociacion);
			$Neto = $this->modelProducto->Neto($Id_Negociacion);
			$Neto2 = $this->modelProducto->Neto2($Id_Negociacion);
			$Neto3 = $Neto+$Neto2;
			$usuario['Neto'] = $Neto3;
			//$usuario['Iva'] = $Neto3*0.12;
			
			$this->load->view('Administrador/AVistaPreviaI2', $usuario);
		}
		else // Aqui entra si el cliente es una persona //
		{
			$usuario['idcliente'] = $Id_Cliente; // Id Cliente
		
			$usuario['Permiso'] = $this->modelNegociacion->ConsultarPermiso($Id_Negociacion); 
			
			$status = $this->modelNegociacion->StatusNegociacion($Id_Negociacion); 
			$usuario['Status'] = $status;
			$usuario['DatosCliente'] = $this->modelCliente->DatosCliente($Id_Negociacion, $Id_Cliente); 
			$cedula = $this->modelCliente->BuscarId($Usuario); 
			$Vendedor = $this->modelCliente->BuscarVendedor($Id_Negociacion); 
			
			$usuario['DatosVendedor'] = $this->modelCliente->DatosVendedor2($Id_Negociacion, $Vendedor); 
			$Lista = $this->modelProducto->ConsultarLista($Id_Negociacion);
			$Lista2 = $this->modelProducto->ConsultarLista2($Id_Negociacion);
			
			$this->load->library('table');
			$this->table->set_empty("&nbsp;");
			$this->table->set_heading('<font style="font-size:12px" color="#369"><b>CODIGO</b></font>', '<font style="font-size:12px" color="#369"><b>CANTIDAD</b></font>', '<font style="font-size:12px" color="#369"><b>DESCRIPCI&Oacute;N</b></font>');
				
			foreach ($Lista as $row)
			{
				$codigo = $row['Codigo'];
				$cantidad = $row['Cantidad'];
				$descripcion = $row['Descripcion2'];
				$this->table->add_row($codigo, $cantidad, $descripcion);
			}
				
			foreach ($Lista2 as $row)
			{
				$codigo2 = $row['Codigo'];
				$cantidad2 = $row['Cantidad'];
				$descripcion2 = $row['Descripcion2'];
				$this->table->add_row($codigo2, $cantidad2, $descripcion2);
			}
					
			$usuario['table'] = $this->table->generate();
		
			$usuario['Descuento'] = $this->modelProducto->ConsultarDescuento($Id_Negociacion);
			$Neto = $this->modelProducto->Neto($Id_Negociacion);
			$Neto2 = $this->modelProducto->Neto2($Id_Negociacion);
			$Neto3 = $Neto+$Neto2;
			$usuario['Neto'] = $Neto3;
			//$usuario['Iva'] = $Neto3*0.12;
			
			$this->load->view('Administrador/AVistaPrevia2', $usuario);
		}
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
				
				$this->load->view('Vendedor/Borrador/VConsultarBorradorI', $usuario);
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
				
				$this->load->view('Vendedor/Borrador/VConsultaBorrador', $usuario);
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
	
	// Funcion que manda las negociaciones a los supervisores para que sean aprobadas //
	public function sin_aprobar() 
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario; // Id Negociacion //
		$usuario['Id_Negociacion'] = $_POST['SinAprobar'];
		$Id_Negociacion = $_POST['SinAprobar'];
		$datos['ID2'] = $Id_Negociacion;
		$cedula = $this->modelCliente->BuscarId($Usuario);
		$nombre = $this->modelCliente->NombreVendedor($cedula);
		$apellido = $this->modelCliente->ApellidoVendedor($cedula);
	
		$negociacion = new ModelNegociacion;
		$this->modelNegociacion->ModificarEstatus($negociacion, $datos); 
		
		$usuario['SinAutorizar'] = $this->modelInicio->SinAutorizar($cedula);
		$usuario['NumeroAprobadas'] = $this->modelInicio->NumeroAprobadas($cedula);
		$usuario['ConAutorizar'] = $this->modelInicio->ConAutorizar($cedula);
		//$usuario['NumeroPorAprobar'] = $this->modelInicio->NumeroPorAprobar();
		$usuario['ConAlerta'] = $this->modelInicio->ConAlerta($cedula);
		
		$usuario['NumeroPorAprobar'] = $this->modelInicio->NumeroPorAprobar2($cedula);
		$usuario['NumeroRechazadas'] = $this->modelInicio->NumeroRechazadas();
		
		//$this->load->library('email');  
		//$this->email->from('jrodriguezv.11@gmail.com','Sistema de gestion SGP');  
		//$this->email->to("jrodriguezv.11@gmail.com"); // mail de la jefa de YOMA //
		//$this->email->subject(''.$nombre.' '.$apellido.' ha enviado la negociacion Nro ( '.$Id_Negociacion.' ) para su aprobacion');  
		//$this->email->message("Para acceder a dicha notificacion, haga clic en el siguiente link elp21.no-ip.info:4085/SGP");  
		//$this->email->send(); 
		
		$this->load->view('Vendedor/VPrincipal', $usuario);
	}
	
	public function desbloquear()
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario; // Id Negociacion //
		$usuario['Id_Negociacion'] = $_POST['Bloqueada'];
		$Id_Negociacion = $_POST['Bloqueada'];
		$datos['ID2'] = $Id_Negociacion;
		$cedula = $this->modelCliente->BuscarId($Usuario);
	
		$negociacion = new ModelNegociacion;
		$this->modelNegociacion->Desbloqueo($negociacion, $datos); 
		
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
		
		$this->load->view('Vendedor/Borrador/VHistorialStatus', $usuario);
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
		$this->table->set_heading('<font style="font-size:12px" color="#369"><b>Status</b></font>', '<font style="font-size:12px" color="#369"><b>Fecha del status</b></font>', '<font style="font-size:12px" color="#369"><b>Tipo de contacto</b></font>', '<font style="font-size:12px" color="#369"><b>Resumen</b></font>', '<font style="font-size:12px" color="#369"><b>Fecha de Acceso</b></font>');
		
	
		foreach ($Lista as $row)
		{
			$status = $row['Status'];
			$fecha = $row['FechaS'];
			$tipo = $row['TipoS'];
			$resumen = $row['Resumen'];
			$fechacreacion = $row['FechaCreacion'];
			$this->table->add_row($status, $fecha, $tipo, $resumen, $fechacreacion);
			
		}
			
		$usuario['table'] = $this->table->generate();
		
		$this->load->view('Vendedor/Borrador/VHistorialStatus', $usuario);
	}
	
	// Funcion que me permite ver las negociaciones que fueron aprobadas por el supervisor //
	public function ver_vista_nego() 
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario; // Id Usuario //
		$usuario['Id_Negociacion'] = $_POST['Nego']; // Id Negociacion //
		$Id_Negociacion2 = $_POST['Nego'];
		$Id_Negociacion = $this->modelNegociacion->BuscarExiste($Id_Negociacion2);
		
		$vendedor = $this->modelNegociacion->BuscarVendedor($Id_Negociacion2);
		$vendedor2 = $this->modelNegociacion->BuscarVendedor2($Usuario);
		
		$stado = $this->modelNegociacion->BuscarEstado($Id_Negociacion2);
		if (($Id_Negociacion == NULL) || ($stado == 2) || ($vendedor <> $vendedor2))
		{
			$usuario['condiciones'] = $this->modelNegociacion->CondicionesPagos($Id_Negociacion);
			$cedula = $this->modelCliente->BuscarId($Usuario);
			$usuario['SinAutorizar'] = $this->modelInicio->SinAutorizar($cedula);
			$usuario['Rechazadas'] = $this->modelInicio->Rechazadas($cedula);
			$usuario['NumeroAprobadas'] = $this->modelInicio->NumeroAprobadas($cedula);
			$usuario['ConAutorizar'] = $this->modelInicio->ConAutorizar($cedula);    	
			$usuario['ConAlerta'] = $this->modelInicio->ConAlerta($cedula); 
			
			$usuario['NumeroPorAprobar'] = $this->modelInicio->NumeroPorAprobar2($cedula);
			$usuario['NumeroRechazadas'] = $this->modelInicio->NumeroRechazadas();
		
			$this->load->view('Vendedor/VPrincipal', $usuario);
		}
		else
		{
			$Cliente = $this->modelNegociacion->BuscarCliente($Id_Negociacion); // Id cliente persona //
			$ClienteI = $this->modelNegociacion->BuscarClienteI($Id_Negociacion); // Id cliente institucion //
		if ($ClienteI == NULL) // Si entre en el if significa que el empleado es una persona //
		{
			$usuario['condiciones'] = $this->modelNegociacion->CondicionesPagos($Id_Negociacion);
			$usuario['idcliente'] = $Cliente; // Id Cliente
			$usuario['Permiso'] = $this->modelNegociacion->ConsultarPermiso($Id_Negociacion); 
			
			$datos['ID2'] = $Id_Negociacion;	
			$negociacion = new ModelNegociacion;
			$this->modelNegociacion->ModificarEstatus3($negociacion, $datos); 
		
			$status = $this->modelNegociacion->StatusNegociacion($Id_Negociacion); 
			$usuario['Status'] = $status;
			
			$usuario['DatosCliente'] = $this->modelCliente->DatosCliente($Id_Negociacion, $Cliente); 
			$cedula = $this->modelCliente->BuscarId($Usuario); 
			$usuario['DatosVendedor'] = $this->modelCliente->DatosVendedor($Id_Negociacion, $cedula); 
			$Lista = $this->modelProducto->ConsultarLista($Id_Negociacion);
			$Lista2 = $this->modelProducto->ConsultarLista2($Id_Negociacion);
			
			$this->load->library('table');
			$this->table->set_empty("&nbsp;");
			$this->table->set_heading('<font style="font-size:12px" color="#369"><b>CODIGO</b></font>', '<font style="font-size:12px" color="#369"><b>CANTIDAD</b></font>', '<font style="font-size:12px" color="#369"><b>DESCRIPCI&Oacute;N</b></font>');
				
			foreach ($Lista as $row)
			{
				$codigo = $row['Codigo'];
				$cantidad = $row['Cantidad'];
				$descripcion = $row['Descripcion2'];
				$this->table->add_row($codigo, $cantidad, $descripcion);
			}
				
			foreach ($Lista2 as $row)
			{
				$codigo2 = $row['Codigo'];
				$cantidad2 = $row['Cantidad'];
				$descripcion2 = $row['Descripcion2'];
				$this->table->add_row($codigo2, $cantidad2, $descripcion2);
			}
					
			$usuario['table'] = $this->table->generate();

			$usuario['Descuento'] = $this->modelProducto->ConsultarDescuento($Id_Negociacion);
			$Neto = $this->modelProducto->Neto($Id_Negociacion);
			$Neto2 = $this->modelProducto->Neto2($Id_Negociacion);
			$Neto3 = $Neto+$Neto2;
			$usuario['Neto'] = $Neto3;
			$usuario['Total'] = $this->modelProducto->ConsultarTotal($Id_Negociacion);
			
			$this->load->view('Vendedor/Borrador/VVistaPreviaPrueba', $usuario);
		}
		else // Si entre en el else significa que el empleado es una institucion //
		{
			$usuario['condiciones'] = $this->modelNegociacion->CondicionesPagos($Id_Negociacion);
			$usuario['idcliente'] = $ClienteI; // Id Cliente
			
			$datos['ID2'] = $Id_Negociacion;	
			$negociacion = new ModelNegociacion;
			$this->modelNegociacion->ModificarEstatus3($negociacion, $datos); 
			
			$status = $this->modelNegociacion->StatusNegociacion($Id_Negociacion); 
			$usuario['Status'] = $status;
			
			$usuario['DatosCliente'] = $this->modelCliente->DatosClienteI($Id_Negociacion, $ClienteI); 
			$cedula = $this->modelCliente->BuscarId($Usuario); 
			$usuario['DatosVendedor'] = $this->modelCliente->DatosVendedorI($Id_Negociacion, $cedula); 
			$Lista = $this->modelProducto->ConsultarLista($Id_Negociacion);
			$Lista2 = $this->modelProducto->ConsultarLista2($Id_Negociacion);
			
			$this->load->library('table');
			$this->table->set_empty("&nbsp;");
			$this->table->set_heading('<font style="font-size:12px" color="#369"><b>CODIGO</b></font>', '<font style="font-size:12px" color="#369"><b>CANTIDAD</b></font>', '<font style="font-size:12px" color="#369"><b>DESCRIPCI&Oacute;N</b></font>');
				
			foreach ($Lista as $row)
			{
				$codigo = $row['Codigo'];
				$cantidad = $row['Cantidad'];
				$descripcion = $row['Descripcion2'];
				$this->table->add_row($codigo, $cantidad, $descripcion);
			}
				
			foreach ($Lista2 as $row)
			{
				$codigo2 = $row['Codigo'];
				$cantidad2 = $row['Cantidad'];
				$descripcion2 = $row['Descripcion2'];
				$this->table->add_row($codigo2, $cantidad2, $descripcion2);
			}
					
			$usuario['table'] = $this->table->generate();

			$usuario['Descuento'] = $this->modelProducto->ConsultarDescuento($Id_Negociacion);
			$Neto = $this->modelProducto->Neto($Id_Negociacion);
			$Neto2 = $this->modelProducto->Neto2($Id_Negociacion);
			$Neto3 = $Neto+$Neto2;
			$usuario['Neto'] = $Neto3;
			$usuario['Total'] = $this->modelProducto->ConsultarTotal($Id_Negociacion);
			
			$this->load->view('Vendedor/Borrador/VVistaPreviaPruebaI', $usuario);
		}		
		}
	}
	
	public function ver_vista_nego2() 
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario; // Id Usuario //
		$usuario['Id_Negociacion'] = $_POST['Nego']; // Id Negociacion //
		$Id_Negociacion2 = $_POST['Nego'];
		$Id_Negociacion = $this->modelNegociacion->BuscarExiste($Id_Negociacion2);
		
		$vendedor = $this->modelNegociacion->BuscarVendedor($Id_Negociacion2);
		$vendedor2 = $this->modelNegociacion->BuscarVendedor2($Usuario);
		
		$stado = $this->modelNegociacion->BuscarEstado($Id_Negociacion2);
		if (($Id_Negociacion == NULL) || ($stado == 2) || ($vendedor <> $vendedor2))
		{
			$usuario['Ganadas'] = $this->modelventa->NegoGanadas(); 
			$usuario['Ganadas2'] = $this->modelventa->NumNegoGanadas(); 
		
			$usuario['NoFacturadas'] = $this->modelventa->NoFacturadas(); 
			$usuario['NoFacturadas2'] = $this->modelventa->NumNoFacturadas();
		
			$usuario['SiFacturadas'] = $this->modelventa->NumFacturadas();
		
			$this->load->view('Despachador/DPrincipal', $usuario);
		}
		else
		{
		$Cliente = $this->modelNegociacion->BuscarCliente($Id_Negociacion); // Id cliente persona //
		$ClienteI = $this->modelNegociacion->BuscarClienteI($Id_Negociacion); // Id cliente institucion //
		if ($ClienteI == NULL) // Si entre en el if significa que el empleado es una persona //
		{
			$usuario['idcliente'] = $Cliente; // Id Cliente
			$usuario['Permiso'] = $this->modelNegociacion->ConsultarPermiso($Id_Negociacion); 
			$usuario['condiciones'] = $this->modelNegociacion->CondicionesPagos($Id_Negociacion);
			
			$datos['ID2'] = $Id_Negociacion;	
			$negociacion = new ModelNegociacion;
			$this->modelNegociacion->ModificarEstatus3($negociacion, $datos); 
		
			$status = $this->modelNegociacion->StatusNegociacion($Id_Negociacion); 
			$usuario['Status'] = $status;
			
			$usuario['DatosCliente'] = $this->modelCliente->DatosCliente($Id_Negociacion, $Cliente); 
			$cedula = $this->modelCliente->BuscarId($Usuario); 
			$usuario['DatosVendedor'] = $this->modelCliente->DatosVendedor($Id_Negociacion, $cedula); 
			$Lista = $this->modelProducto->ConsultarLista($Id_Negociacion);
			$Lista2 = $this->modelProducto->ConsultarLista2($Id_Negociacion);
			
			$this->load->library('table');
			$this->table->set_empty("&nbsp;");
			$this->table->set_heading('<font style="font-size:12px" color="#369"><b>CODIGO</b></font>', '<font style="font-size:12px" color="#369"><b>CANTIDAD</b></font>', '<font style="font-size:12px" color="#369"><b>DESCRIPCI&Oacute;N</b></font>');
				
			foreach ($Lista as $row)
			{
				$codigo = $row['Codigo'];
				$cantidad = $row['Cantidad'];
				$descripcion = $row['Descripcion2'];
				$this->table->add_row($codigo, $cantidad, $descripcion);
			}
				
			foreach ($Lista2 as $row)
			{
				$codigo2 = $row['Codigo'];
				$cantidad2 = $row['Cantidad'];
				$descripcion2 = $row['Descripcion2'];
				$this->table->add_row($codigo2, $cantidad2, $descripcion2);
			}
					
			$usuario['table'] = $this->table->generate();

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
		else // Si entre en el else significa que el empleado es una institucion //
		{
			$usuario['idcliente'] = $ClienteI; // Id Cliente
			$usuario['condiciones'] = $this->modelNegociacion->CondicionesPagos($Id_Negociacion);
			
			$datos['ID2'] = $Id_Negociacion;	
			$negociacion = new ModelNegociacion;
			$this->modelNegociacion->ModificarEstatus3($negociacion, $datos); 
			
			$status = $this->modelNegociacion->StatusNegociacion($Id_Negociacion); 
			$usuario['Status'] = $status;
			
			$usuario['DatosCliente'] = $this->modelCliente->DatosClienteI($Id_Negociacion, $ClienteI); 
			$cedula = $this->modelCliente->BuscarId($Usuario); 
			$usuario['DatosVendedor'] = $this->modelCliente->DatosVendedorI($Id_Negociacion, $cedula); 
			$Lista = $this->modelProducto->ConsultarLista($Id_Negociacion);
			$Lista2 = $this->modelProducto->ConsultarLista2($Id_Negociacion);
			
			$this->load->library('table');
			$this->table->set_empty("&nbsp;");
			$this->table->set_heading('<font style="font-size:12px" color="#369"><b>CODIGO</b></font>', '<font style="font-size:12px" color="#369"><b>CANTIDAD</b></font>', '<font style="font-size:12px" color="#369"><b>DESCRIPCI&Oacute;N</b></font>');
				
			foreach ($Lista as $row)
			{
				$codigo = $row['Codigo'];
				$cantidad = $row['Cantidad'];
				$descripcion = $row['Descripcion2'];
				$this->table->add_row($codigo, $cantidad, $descripcion);
			}
				
			foreach ($Lista2 as $row)
			{
				$codigo2 = $row['Codigo'];
				$cantidad2 = $row['Cantidad'];
				$descripcion2 = $row['Descripcion2'];
				$this->table->add_row($codigo2, $cantidad2, $descripcion2);
			}
					
			$usuario['table'] = $this->table->generate();

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
		}
	}
	
	// Funciones que eliminar productos que estan en la factura //
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
		
		$usuario['Marca'] = $this->modelProducto->MarcaProducto();
		$usuario['Lista'] = $this->modelProducto->ConsultarListaB($Id_Negociacion);
		$this->load->view('Vendedor/Borrador/VTelemetria', $usuario);
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
		
		$this->load->view('Vendedor/Borrador/VConsultaBorrador', $usuario);
	}
	
	public function eliminar_producto_i($Equipo, $cliente, $Id_Negociacion)
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
		
		$usuario['Marca'] = $this->modelProducto->MarcaProducto();
		$usuario['Lista'] = $this->modelProducto->ConsultarListaB($Id_Negociacion);
		$this->load->view('Vendedor/Borrador/VConsultarBorradorI0', $usuario);
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
		$this->load->view('Vendedor/Borrador/VConsultarBorradorI', $usuario);
	}
	
	// Funciones que le dan utilidad al boton de atras recuperando los datos de las pantallas anteriores //
	public function atras_paso_extra()
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario;
		$Negociacion = $_POST['Negociacion2'];
		$usuario['Id_Negociacion'] = $_POST['Negociacion2'];
		$porcentaje = $this->modelNegociacion->PorcentajeNegociacion($Negociacion); 
		$usuario['Porcentaje'] = $porcentaje;
		$usuario['Status'] = $_POST['Status2'];
		
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
		
		$this->load->view('Vendedor/Borrador/VConsultaBorrador', $usuario);
	}
	
	public function atras_paso_extrai() 
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario;
		$Negociacion = $_POST['Negociacion2'];
		$usuario['Id_Negociacion'] = $_POST['Negociacion2'];
		$porcentaje = $this->modelNegociacion->PorcentajeNegociacion($Negociacion); 
		$usuario['Porcentaje'] = $porcentaje;
		$usuario['Status'] = $_POST['Status2'];
		
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
		
		$usuario['Marca'] = $this->modelProducto->MarcaProducto();
		$usuario['Lista'] = $this->modelProducto->ConsultarListaA($Negociacion);
		
		$this->load->view('Vendedor/Borrador/VConsultarBorradorI', $usuario);
	}
	
	public function atras_paso_extra2() 
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario;
		$Negociacion = $_POST['Negociacion'];
		$usuario['Id_Negociacion'] = $_POST['Negociacion'];
		$usuario['Status'] = $_POST['Status'];
		
		$usuario['idcliente'] = $_POST['idcliente'];
		$cliente = $_POST['idcliente'];
		
		$this->load->view('Vendedor/Borrador/VConsultaBorrador0', $usuario);
	}
	
	public function atras_paso_extrai2() 
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario;
		$Negociacion = $_POST['Negociacion'];
		$usuario['Id_Negociacion'] = $_POST['Negociacion'];
		$usuario['Status'] = $_POST['Status'];
		
		$usuario['idcliente'] = $_POST['idcliente'];
		$cliente = $_POST['idcliente'];
		
		$this->load->view('Vendedor/Borrador/VConsultarBorradorI0', $usuario);
	}
	
	// Funcion que nos lleva a un paso antes de la insercion de accesorios a la factura //
	public function paso_extra() 
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario; // Id Negociacion //
		$usuario['Id_Negociacion'] = $_POST['Negociacion'];
		$Id_Negociacion = $_POST['Negociacion'];
		$usuario['Status'] = $_POST['Status'];
		$usuario['idcliente'] = $_POST['idcliente'];
		$porcentaje = $this->modelNegociacion->PorcentajeNegociacion($Id_Negociacion); 
		$usuario['Porcentaje'] = $porcentaje;
		
		$usuario['Marca'] = $this->modelProducto->MarcaProducto();
		$usuario['Lista'] = $this->modelProducto->ConsultarListaB($Id_Negociacion);
		$this->load->view('Vendedor/Borrador/VConsultaBorrador0', $usuario);
	}
	
	// Funcion que nos lleva a un paso antes de la insercion de accesorios a la factura //
	public function telemetria() 
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario; // Id Negociacion //
		$usuario['Id_Negociacion'] = $_POST['Negociacion'];
		$Id_Negociacion = $_POST['Negociacion'];
		$usuario['Status'] = $_POST['Status'];
		$usuario['idcliente'] = $_POST['idcliente'];
		$porcentaje = $this->modelNegociacion->PorcentajeNegociacion($Id_Negociacion); 
		$usuario['Porcentaje'] = $porcentaje;
		
		$usuario['Marca'] = $this->modelProducto->MarcaProducto();
		$usuario['Lista'] = $this->modelProducto->ConsultarListaB($Id_Negociacion);
		$this->load->view('Vendedor/Borrador/VTelemetria', $usuario);
	}
	
	// Funcion que nos lleva a un paso antes de la insercion de accesorios a la factura //
	public function telemetria_institucion() 
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario; // Id Negociacion //
		$usuario['Id_Negociacion'] = $_POST['Negociacion'];
		$Id_Negociacion = $_POST['Negociacion'];
		$usuario['Status'] = $_POST['Status'];
		$usuario['idcliente'] = $_POST['idcliente'];
		$porcentaje = $this->modelNegociacion->PorcentajeNegociacion($Id_Negociacion); 
		$usuario['Porcentaje'] = $porcentaje;
		
		$usuario['Marca'] = $this->modelProducto->MarcaProducto();
		$usuario['Lista'] = $this->modelProducto->ConsultarListaB($Id_Negociacion);
		$this->load->view('Vendedor/Borrador/VTelemetriaI', $usuario);
	}
	
		public function eliminar_producto2($Equipo, $cliente, $Id_Negociacion)
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario; // Id Negociacion //
		$usuario['Id_Negociacion'] = $Id_Negociacion;
		$status = $this->modelNegociacion->StatusNegociacion($Id_Negociacion); 
		$usuario['Status'] = $status;
		$usuario['idcliente'] = $cliente;
		$porcentaje = $this->modelNegociacion->PorcentajeNegociacion($Id_Negociacion); 
		$usuario['Porcentaje'] = $porcentaje;
		
		$this->modelNegociacion->EliminarP2($Equipo);
		
		$usuario['Marca'] = $this->modelProducto->MarcaProducto();
		$usuario['Lista'] = $this->modelProducto->ConsultarListaB($Id_Negociacion);
		$this->load->view('Vendedor/Borrador/VTelemetriaI', $usuario);
	}
	
	public function paso_extra_i()
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario; // Id Negociacion //
		$usuario['Id_Negociacion'] = $_POST['Negociacion'];
		$Id_Negociacion = $_POST['Negociacion'];
		$usuario['Status'] = $_POST['Status'];
		$usuario['idcliente'] = $_POST['idcliente'];
		$porcentaje = $this->modelNegociacion->PorcentajeNegociacion($Id_Negociacion); 
		$usuario['Porcentaje'] = $porcentaje;
		
		$usuario['Marca'] = $this->modelProducto->MarcaProducto();
		$usuario['Lista'] = $this->modelProducto->ConsultarListaB($Id_Negociacion);
		$this->load->view('Vendedor/Borrador/VConsultarBorradorI0', $usuario);
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
		$usuario['condiciones'] = $this->modelNegociacion->CondicionesPagos($Id_Negociacion); 
		$usuario['Status'] = $status;
		
		$usuario['DatosCliente'] = $this->modelCliente->DatosCliente($Id_Negociacion, $Id); 
		$cedula = $this->modelCliente->BuscarId($Usuario); 
		$usuario['DatosVendedor'] = $this->modelCliente->DatosVendedor($Id_Negociacion, $cedula); 
		$Lista = $this->modelProducto->ConsultarLista($Id_Negociacion);
		$Lista2 = $this->modelProducto->ConsultarLista2($Id_Negociacion);
		
		$this->load->library('table');
		$this->table->set_empty("&nbsp;");
		$this->table->set_heading('<font style="font-size:12px" color="#369"><b>CODIGO</b></font>', '<font style="font-size:12px" color="#369"><b>CANTIDAD</b></font>', '<font style="font-size:12px" color="#369"><b>DESCRIPCI&Oacute;N</b></font>');
			
		foreach ($Lista as $row)
		{
			$codigo = $row['Codigo'];
			$cantidad = $row['Cantidad'];
			$descripcion = $row['Descripcion2'];
			$this->table->add_row($codigo, $cantidad, $descripcion);
		}
			
		foreach ($Lista2 as $row)
		{
			$codigo2 = $row['Codigo'];
			$cantidad2 = $row['Cantidad'];
			$descripcion2 = $row['Descripcion2'];
			$this->table->add_row($codigo2, $cantidad2, $descripcion2);
		}
				
		$usuario['table'] = $this->table->generate();
		
		$usuario['Descuento'] = $this->modelProducto->ConsultarDescuento($Id_Negociacion);
		$usuario['Total'] = $this->modelProducto->ConsultarTotal($Id_Negociacion);
		
		$Neto = $this->modelProducto->Neto($Id_Negociacion);
		$Neto2 = $this->modelProducto->Neto2($Id_Negociacion);
		$Neto3 = $Neto+$Neto2;
		$usuario['Neto'] = $Neto3;
		//$usuario['Iva'] = $Neto3*0.12;
		
		$this->load->view('Vendedor/Borrador/VVistaPreviaPrueba', $usuario);
	}
	
	public function vista_previa_i($Id_Negociacion, $Id) // Vendedor //
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
		$Lista = $this->modelProducto->ConsultarLista($Id_Negociacion);
		$Lista2 = $this->modelProducto->ConsultarLista2($Id_Negociacion);
		
		$this->load->library('table');
		$this->table->set_empty("&nbsp;");
		$this->table->set_heading('<font style="font-size:12px" color="#369"><b>CODIGO</b></font>', '<font style="font-size:12px" color="#369"><b>CANTIDAD</b></font>', '<font style="font-size:12px" color="#369"><b>DESCRIPCI&Oacute;N</b></font>');
			
		foreach ($Lista as $row)
		{
			$codigo = $row['Codigo'];
			$cantidad = $row['Cantidad'];
			$descripcion = $row['Descripcion2'];
			$this->table->add_row($codigo, $cantidad, $descripcion);
		}
			
		foreach ($Lista2 as $row)
		{
			$codigo2 = $row['Codigo'];
			$cantidad2 = $row['Cantidad'];
			$descripcion2 = $row['Descripcion2'];
			$this->table->add_row($codigo2, $cantidad2, $descripcion2);
		}
				
		$usuario['table'] = $this->table->generate();
		
		$usuario['Descuento'] = $this->modelProducto->ConsultarDescuento($Id_Negociacion);
		$Neto = $this->modelProducto->Neto($Id_Negociacion);
		$Neto2 = $this->modelProducto->Neto2($Id_Negociacion);
		$Neto3 = $Neto+$Neto2;
		$usuario['Neto'] = $Neto3;
		$usuario['Total'] = $this->modelProducto->ConsultarTotal($Id_Negociacion);
		
		$this->load->view('Vendedor/Borrador/VVistaPreviaPruebaI', $usuario);
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
			
			$this->load->view('Vendedor/Borrador/VConsultaBorrador', $usuario);
		}
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
			$this->load->view('Vendedor/Borrador/VConsultarBorradorI', $usuario);
		}
		
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
		
		$this->load->view('Vendedor/Borrador/VConsultarBorradorI', $usuario);
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
	
		$this->load->view('Vendedor/Borrador/VConsultaBorrador', $usuario);
	}
	
	// Funciones para ver los datos de las negociaciones que estan ganadas, cerradas o perdidas //
	public function actualizar_datos_i2($Id) 
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
		$usuario['Status'] = $status;
		
		$negociacion = new ModelNegociacion;
		$this->modelNegociacion->ModificarDatos($negociacion, $datos);
		
		$usuario['FechaP'] = $this->modelNegociacion->FechaPresupuesto($IdNegoBorrador);
		$usuario['NumeroODC'] = $this->modelNegociacion->NumeroOrdenDC($IdNegoBorrador);
		$usuario['FechaODC'] = $this->modelNegociacion->FechaOrdenDC($IdNegoBorrador);
		$usuario['Banco'] = $this->modelNegociacion->Banco($IdNegoBorrador);
		$usuario['PagoInicial'] = $this->modelNegociacion->PagoInicial($IdNegoBorrador);
		$usuario['CondicionesPago'] = $this->modelNegociacion->CondicionesPago($IdNegoBorrador);
		$usuario['FechaPago'] = $this->modelNegociacion->FechaDePago($IdNegoBorrador);
		$usuario['NDeposito'] = $this->modelNegociacion->NumeroDeposito($IdNegoBorrador);
		
		// DATOS DEL CLIENTE //
		$usuario['Id'] = $_POST['idcliente2'];
		$cliente = $_POST['idcliente2'];
		$usuario['NombreI'] = $this->modelNegociacion->NombreInstitucion($cliente);
		$usuario['TelefonoI'] = $this->modelNegociacion->TelefonoInstitucion($cliente);
		
		$this->load->view('Vendedor/Cerrada/VConsultaCerradaI', $usuario);
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
		$usuario['Status'] = $status;
		
		$negociacion = new ModelNegociacion;
		$this->modelNegociacion->ModificarDatos($negociacion, $datos);
		
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
		
		$this->load->view('Vendedor/Cerrada/VConsultaCerrada', $usuario);
	}
	
	// Funcion que nos trae toda la informacion de una negociacion CERRADA, PERDIDA O GANADA //
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
		
		$this->load->view('Vendedor/Cerrada/VConsultaCerradaI', $usuario);
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
		
		$this->load->view('Vendedor/Cerrada/VConsultaCerrada', $usuario);
	}
	
	// Funcion que nos trae toda la informacion de una negociacion BORRADOR O ACTIVA //
	public function borrador_i() 
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario; // Usuario //
		$cliente = $_POST['IdCliente']; // Id cliente //
		$IdNegoBorrador = $_POST['Nego']; // Id negociacion //
		$usuario['Id_Negociacion'] = $_POST['Nego']; // Id negociacion //
		$Id = $this->modelCliente->BuscarId($Usuario); // Id del usuario //
		$status = $this->modelNegociacion->StatusNegociacion($IdNegoBorrador); 
		$porcentaje = $this->modelNegociacion->PorcentajeNegociacion($IdNegoBorrador); 
		$usuario['Porcentaje'] = $porcentaje;
		$usuario['Status'] = $status;
		
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
		
		$usuario['Marca'] = $this->modelProducto->MarcaProducto();
		$usuario['Lista'] = $this->modelProducto->ConsultarListaA($IdNegoBorrador);
		
		$this->load->view('Vendedor/Borrador/VConsultarBorradorI', $usuario);
	}
	
	// FUNCION QUE INICIA LA PANTALLA PRINCIPAL DE CADA VISTA DE NEGOCIACION //
	public function borrador()
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario; 
		$cliente = $_POST['IdCliente']; 
		$IdNegoBorrador = $_POST['Nego']; 
		$usuario['Id_Negociacion'] = $_POST['Nego']; 
		$Id = $this->modelCliente->BuscarId($Usuario); 
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
		
		$usuario['Marca'] = $this->modelProducto->MarcaProducto();
		
		$usuario['Lista'] = $this->modelProducto->ConsultarListaA($IdNegoBorrador);
		
		$this->load->view('Vendedor/Borrador/VConsultaBorrador', $usuario);
	}
	
	public function agregar_equipo_2() 
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
		
		$this->load->view('Vendedor/Borrador/VConsultarBorradorI', $usuario);
		
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
		
		$this->load->view('Vendedor/Borrador/VConsultaBorrador', $usuario);
		
	}
	
	public function agregar_otro_accesorios3() 
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario;
		$Negociacion = $_POST['Negociacion']; // Id Negociacion //
		$usuario['Id_Negociacion'] = $_POST['Negociacion'];
		$usuario['Equipo'] = $_POST['combo6'];
		$usuario['Status'] = $_POST['Status'];
		
		$Equipo = $_POST['combo6'];
		$cliente = $_POST['idcliente'];
		$usuario['idcliente'] = $_POST['idcliente'];
		$usuario['Accesorio'] = $this->modelProducto->ConsultarAccesorio($Equipo);
		$usuario['Lista'] = $this->modelProducto->ConsultarListaA($Negociacion);
		$this->load->view('Vendedor/Borrador/VConsultarBorradorI2', $usuario);
	}
	
	public function agregar_otro_accesorios()
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario;
		$Negociacion = $_POST['Negociacion']; // Id Negociacion //
		$usuario['Id_Negociacion'] = $_POST['Negociacion'];
		$usuario['Equipo'] = $_POST['combo6'];
		$usuario['Status'] = $_POST['Status'];
		
		$Equipo = $_POST['combo6'];
		$cliente = $_POST['idcliente'];
		$usuario['idcliente'] = $_POST['idcliente'];
		$usuario['Accesorio'] = $this->modelProducto->ConsultarAccesorio($Equipo);
		$usuario['Lista'] = $this->modelProducto->ConsultarListaA($Negociacion);
		$this->load->view('Vendedor/Borrador/VConsultaBorrador2', $usuario);
	}
	
	public function agregar_otro_accesorios4($Negociacion, $Status, $Cliente) 
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario;
		$usuario['Id_Negociacion'] = $Negociacion;
		$usuario['Status'] = $Status;
		$porcentaje = $this->modelNegociacion->PorcentajeNegociacion($Negociacion); 
		$usuario['Porcentaje'] = $porcentaje;
		
		// PRODUCTO //
		$HistorialNP['Id_Accesorio'] = $_POST['Accesorio']; // Id Accesorio //
		$HistorialNP['Id_Negociacion'] = $Negociacion;
		$HistorialNP['Cantidad'] = $_POST['Cantidad'];
		
		$this->modelProducto->AgregarAccesorio($HistorialNP);
		
		//////////////////////////////////////////////////////
		
		$usuario['idcliente'] = $Cliente;
		$usuario['Marca'] = $this->modelProducto->MarcaProducto();
		$usuario['Lista'] = $this->modelProducto->ConsultarListaB($Negociacion);
		$this->load->view('Vendedor/Borrador/VConsultarBorradorI0', $usuario);
	}
	
	public function agregar_accesorio_telemetria($Negociacion, $Status, $Cliente) 
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario;
		
		if(isset($_POST['checkbox']))
		foreach($_POST['checkbox'] as $row)
		{
			$HistorialNP['Id_Accesorio'] = $row;
			$HistorialNP['Id_Negociacion'] = $Negociacion;
			$HistorialNP['Cantidad'] = $_POST[$row];	
			
			$this->modelProducto->AgregarAccesorio($HistorialNP);
		}
		
		$usuario['Id_Negociacion'] = $Negociacion;
		$usuario['Status'] = $Status;
		$porcentaje = $this->modelNegociacion->PorcentajeNegociacion($Negociacion); 
		$usuario['Porcentaje'] = $porcentaje;
		
		$usuario['idcliente'] = $Cliente;
		$usuario['Marca'] = $this->modelProducto->MarcaProducto();
		$usuario['Lista'] = $this->modelProducto->ConsultarListaB($Negociacion);

		$this->load->view('Vendedor/Borrador/VTelemetria', $usuario);

	}
	
	public function agregar_accesorio_telemetria_I($Negociacion, $Status, $Cliente) 
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario;
		
		foreach($_POST['checkbox'] as $row)
		{
			$HistorialNP['Id_Accesorio'] = $row;
			$HistorialNP['Id_Negociacion'] = $Negociacion;
			$HistorialNP['Cantidad'] = $_POST[$row];	
			
			$this->modelProducto->AgregarAccesorio($HistorialNP);
		}
		
		$usuario['Id_Negociacion'] = $Negociacion;
		$usuario['Status'] = $Status;
		$porcentaje = $this->modelNegociacion->PorcentajeNegociacion($Negociacion); 
		$usuario['Porcentaje'] = $porcentaje;
		
		$usuario['idcliente'] = $Cliente;
		$usuario['Marca'] = $this->modelProducto->MarcaProducto();
		$usuario['Lista'] = $this->modelProducto->ConsultarListaB($Negociacion);

		$this->load->view('Vendedor/Borrador/VTelemetriaI', $usuario);

	}
	
	public function agregar_otro_accesorios2($Negociacion, $Status, $Cliente) 
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario;
		$usuario['Id_Negociacion'] = $Negociacion;
		$usuario['Status'] = $Status;
		$porcentaje = $this->modelNegociacion->PorcentajeNegociacion($Negociacion); 
		$usuario['Porcentaje'] = $porcentaje;
		
		// PRODUCTO //
		$HistorialNP['Id_Accesorio'] = $_POST['Accesorio']; // Id Accesorio //
		$HistorialNP['Id_Negociacion'] = $Negociacion;
		$HistorialNP['Cantidad'] = $_POST['Cantidad'];
		
		$this->modelProducto->AgregarAccesorio($HistorialNP);
		
		//////////////////////////////////////////////////////
		
		$usuario['idcliente'] = $Cliente;
		$usuario['Lista'] = $this->modelProducto->ConsultarListaB($Negociacion);
		
		$usuario['Marca'] = $this->modelProducto->MarcaProducto();
		
		$this->load->view('Vendedor/Borrador/VConsultaBorrador0', $usuario);
	}
	
	public function telemetria_accesorios($Negociacion, $Status, $Cliente) 
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario;
		$usuario['Id_Negociacion'] = $Negociacion;
		$usuario['Status'] = $Status;
		$equipo = $_POST['equipo'];
		$usuario['idcliente'] = $Cliente;
		$porcentaje = $this->modelNegociacion->PorcentajeNegociacion($Negociacion); 
		$usuario['Porcentaje'] = $porcentaje;
		$usuario['Marca'] = $this->modelProducto->MarcaProducto();
		$usuario['Lista'] = $this->modelProducto->ConsultarListaB($Negociacion);
		if($equipo == " ")
		{
			$usuario['Error'] = "Por favor seleccione un equipo para poder buscar su respectivo accesorio!";
			$this->load->view('Vendedor/Borrador/VTelemetria', $usuario);
		}
		else
		{
			$usuario['Lista2'] = $this->modelProducto->BuscarAccesorios($equipo); 		
			$this->load->view('Vendedor/Borrador/VTelemetria2', $usuario);
		}
		
	}
	
	public function telemetria_accesorios_institucion($Negociacion, $Status, $Cliente) 
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario;
		$usuario['Id_Negociacion'] = $Negociacion;
		$usuario['Status'] = $Status;
		$equipo = $_POST['equipo'];
		$porcentaje = $this->modelNegociacion->PorcentajeNegociacion($Negociacion); 
		$usuario['Porcentaje'] = $porcentaje;
		$usuario['idcliente'] = $Cliente;
		$usuario['Marca'] = $this->modelProducto->MarcaProducto();
		$usuario['Lista'] = $this->modelProducto->ConsultarListaB($Negociacion);
		if($equipo == " ")
		{
			$usuario['Error'] = "Por favor seleccione un equipo para poder buscar su respectivo accesorio!";
			$this->load->view('Vendedor/Borrador/VTelemetriaI', $usuario);
		}
		else
		{
			$usuario['Lista2'] = $this->modelProducto->BuscarAccesorios($equipo); 
			$this->load->view('Vendedor/Borrador/VTelemetriaI2', $usuario);
		}
	}
	
	public function atras_agregar_otro_accesorios4() 
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario;
		$Negociacion = $_POST['Negociacion'];
		$usuario['Id_Negociacion'] = $_POST['Negociacion'];
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
		$usuario['NombreI'] = $this->modelNegociacion->NombreInstitucion($cliente);
		$usuario['TelefonoI'] = $this->modelNegociacion->TelefonoInstitucion($cliente);
		
		$this->load->view('Vendedor/Borrador/VConsultarBorradorI', $usuario);
	}
	
	public function atras_agregar_otro_accesorios2() 
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario;
		$Negociacion = $_POST['Negociacion'];
		$usuario['Id_Negociacion'] = $_POST['Negociacion'];
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
		
		$this->load->view('Vendedor/Borrador/VConsultaBorrador', $usuario);
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
		
		$this->load->view('Vendedor/VNegociacion4', $usuario);
	}
	
	// Funciones que se encargar de cambiarle el estatus a una negociacion //
	public function cambio_status($Id_Negociacion, $Id) 
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario; 
		$usuario['Id_Negociacion'] = $Id_Negociacion;
		$usuario['Cliente'] = $Id;
		$this->load->view('Vendedor/VCambioStatus', $usuario);
	}
	
	public function rechazo($Id_Negociacion)
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario; 
		$usuario['Id_Negociacion'] = $Id_Negociacion;
		$this->load->view('Administrador/ARechazos', $usuario);
	}
	
	public function rechazo_2($Id_Negociacion) 
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario; 
		$usuario2 = $Usuario;
		$usuario['Id_Negociacion'] = $Id_Negociacion;
		$datos['ID2'] = $Id_Negociacion;
		$IdSeguimiento = $this->modelNegociacion->BuscarSeguimiento($Id_Negociacion);
		
		$Seguimiento = new ModelNegociacion;
		$this->modelNegociacion->HistorialRechazos($Seguimiento, $datos);
		
		$Negociacion = new ModelNegociacion;
		$this->modelNegociacion->RechazoStatus($Negociacion, $datos);
		
		//$this->load->library('email');  
		//$this->email->from('jrodriguezv.11@gmail.com','Sistema de gestion SGP');  
		//$this->email->to('jrodriguezv.11@gmail.com'); // Mail de la jefa de YOMA //
		//$this->email->subject('Su negociacion con el Nro ( '.$Id_Negociacion.' ) ha sido RECHAZADA');  
		//$this->email->message("Para acceder a dicha notificacion, haga clic en el siguiente link elp21.no-ip.info:4085/SGP");  
		//$this->email->send(); 
		
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
		
		$this->load->view('Administrador/APrincipal', $usuario);
	}
	
	public function cambio_status_a($Id_Negociacion) 
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario; 
		$usuario['Id_Negociacion'] = $Id_Negociacion;
		$this->load->view('Administrador/ACambioStatus', $usuario);
	}
	
	public function cambio_status_3($Id_Negociacion, $Id) 
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario; 
		$usuario['Id_Negociacion'] = $Id_Negociacion;
		$usuario['Cliente'] = $Id;
		$this->load->view('Vendedor/VCambioStatus2', $usuario);
	}
	
	public function cambio_status_3a($Id_Negociacion) 
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario; 
		$usuario['Id_Negociacion'] = $Id_Negociacion;
		$this->load->view('Administrador/ACambioStatus2', $usuario);
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
		$this->table->set_heading('<font style="font-size:12px" color="#369"><b>Status</b></font>', '<font style="font-size:12px" color="#369"><b>Fecha</b></font>', '<font style="font-size:12px" color="#369"><b>Tipo de contacto</b></font>', '<font style="font-size:12px" color="#369"><b>Resumen</b></font>', '<font style="font-size:12px" color="#369"><b>Fecha de Acceso</b></font>');
		
	
		foreach ($Lista as $row)
		{
			$status = $row['Status'];
			$fecha = $row['FechaS'];
			$tipo = $row['TipoS'];
			$resumen = $row['Resumen'];
			$fechacreacion = $row['FechaCreacion'];
			$this->table->add_row($status, $fecha, $tipo, $resumen, $fechacreacion);
		}
			
		$usuario['table'] = $this->table->generate();
		
		$this->load->view('Vendedor/Borrador/VHistorialStatus', $usuario);
	}
	
	public function cambio_status_4($Id_Negociacion) 
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
		
		$usuario['NombreI'] = $this->modelNegociacion->NombreInstitucion($cliente);
		$usuario['NBorrador'] = $this->modelNegociacion->NegociacionBorradorI($cliente, $Id);
		$usuario['NActiva'] = $this->modelNegociacion->NegociacionActivaI($cliente, $Id);
		$usuario['NGanada'] = $this->modelNegociacion->NegociacionGanadaI($cliente, $Id);
		$usuario['NCerrada'] = $this->modelNegociacion->NegociacionCerradaI($cliente, $Id);
		$usuario['NPerdida'] = $this->modelNegociacion->NegociacionPerdidaI($cliente, $Id);
		$usuario['Cliente'] = $_POST['Cliente'];
		
		$usuario['Mensaje'] = 'Se cambio el status con &eacute;xito!';
		
		$Lista = $this->modelNegociacion->HistorialLista($Id_Negociacion);
		
		$this->load->library('table');
		$this->table->set_empty("&nbsp;");
		$this->table->set_heading('<font style="font-size:12px" color="#369"><b>Status</b></font>', '<font style="font-size:12px" color="#369"><b>Fecha</b></font>', '<font style="font-size:12px" color="#369"><b>Tipo de contacto</b></font>', '<font style="font-size:12px" color="#369"><b>Resumen</b></font>', '<font style="font-size:12px" color="#369"><b>Fecha de Acceso</b></font>');
		
	
		foreach ($Lista as $row)
		{
			$status = $row['Status'];
			$fecha = $row['FechaS'];
			$tipo = $row['TipoS'];
			$resumen = $row['Resumen'];
			$fechacreacion = $row['FechaCreacion'];
			$this->table->add_row($status, $fecha, $tipo, $resumen, $fechacreacion);
		}
			
		$usuario['table'] = $this->table->generate();
		
		$this->load->view('Vendedor/Borrador/VHistorialStatus', $usuario);
	}
	
	// Funciones que consultan negociaciones por cliente //
	public function ver_negociacion() 
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario;
		$usuario2 = $Usuario;
		$Id = $this->modelCliente->BuscarId($usuario2);
		$usuario['Clientes'] = $this->modelNegociacion->MisClientes($Id);
		$this->load->view('Vendedor/VVerNegociacion', $usuario);
	}
	
	public function ver_negociacion_2()
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario;
		$usuario2 = $Usuario;
		$Id = $this->modelCliente->BuscarId($usuario2);
		$usuario['Institucion'] = $this->modelNegociacion->MisInstituciones($Id);
		$this->load->view('Vendedor/VVerNegociacionI', $usuario);
	}
	
	public function atras_negociacion() 
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario;
		$usuario2 = $Usuario;
		$Id = $this->modelCliente->BuscarId($usuario2);
		$usuario['Clientes'] = $this->modelNegociacion->MisClientes($Id);
		$this->load->view('Vendedor/VVerNegociacion', $usuario);
	}
	
	public function atras_negociacion_2() 
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario;
		$usuario2 = $Usuario;
		$Id = $this->modelCliente->BuscarId($usuario2);
		$usuario['Institucion'] = $this->modelNegociacion->MisInstituciones($Id);
		$this->load->view('Vendedor/VVerNegociacionI', $usuario);
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
		$this->load->view('Vendedor/VVerNegociacion2', $usuario);
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
		$this->load->view('Vendedor/VVerNegociacionI2', $usuario);
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
		
		$this->load->view('Vendedor/VNegociacion3', $usuario);
	}
	
	public function agregar_accesorios()
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario;
		$Negociacion = $_POST['Negociacion'];
		$usuario['Id_Negociacion'] = $_POST['Negociacion'];
		$usuario['Equipo'] = $_POST['combo3'];
		
		// PRODUCTO //
		$Equipo = $_POST['combo3'];
		$Id = $this->modelProducto->BuscarId($Equipo);
		$HistorialNP['Id_Accesorio'] = $Id; // Id Accesorio //
		$HistorialNP['Id_Negociacion'] = $_POST['Negociacion'];
		$HistorialNP['Cantidad'] = $_POST['Cantidad'];
		
		$this->modelProducto->AgregarEquipo($HistorialNP);
		
		//////////////////////////////////////////////////////
		
		$usuario['Accesorio'] = $this->modelProducto->ConsultarAccesorio($Equipo);
		$usuario['Lista'] = $this->modelProducto->ConsultarListaA($Negociacion);
		$this->load->view('Vendedor/VAccesorioCliente', $usuario);
	}
	
	public function agregar_accesorios_2() 
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario;
		$Negociacion = $_POST['Negociacion'];
		$usuario['Id_Negociacion'] = $_POST['Negociacion'];
		$usuario['Equipo'] = $_POST['combo3'];
		
		// PRODUCTO //
		$Equipo = $_POST['combo3'];
		$HistorialNP['Id_Accesorio'] = $_POST['Accesorio']; // Id Accesorio //
		$HistorialNP['Id_Negociacion'] = $_POST['Negociacion'];
		$HistorialNP['Cantidad'] = $_POST['Cantidad'];
		
		$this->modelProducto->AgregarAccesorio($HistorialNP);
		
		//////////////////////////////////////////////////////
		
		$usuario['Accesorio'] = $this->modelProducto->ConsultarAccesorio($Equipo);
		$usuario['Lista'] = $this->modelProducto->ConsultarListaA($Negociacion);
		$this->load->view('Vendedor/VAccesorioCliente', $usuario);
	}
	
	public function fin_negociacion() 
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario;
		$cedula = $this->modelCliente->BuscarId($Usuario);
		$usuario['SinAutorizar'] = $this->modelInicio->SinAutorizar($cedula);
		$usuario['Rechazadas'] = $this->modelInicio->Rechazadas($cedula);
		$usuario['NumeroAprobadas'] = $this->modelInicio->NumeroAprobadas($cedula);
		$usuario['ConAutorizar'] = $this->modelInicio->ConAutorizar($cedula);    	
		$usuario['ConAlerta'] = $this->modelInicio->ConAlerta($cedula); 
		
		$usuario['NumeroPorAprobar'] = $this->modelInicio->NumeroPorAprobar2($cedula);
		$usuario['NumeroRechazadas'] = $this->modelInicio->NumeroRechazadas();
		
		$this->load->view('Vendedor/VPrincipal', $usuario);
	}
	
	// Funcion que me permite ver las negociaciones que estan en alerta //
	public function ver_vista_alertas() 
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario; // Id Usuario //
		$usuario['Id_Negociacion'] = $_POST['Nego']; // Id Negociacion //
		$Id_Negociacion = $_POST['Nego'];
		$Cliente = $this->modelNegociacion->BuscarCliente($Id_Negociacion); // Id cliente persona //
		$ClienteI = $this->modelNegociacion->BuscarClienteI($Id_Negociacion); // Id cliente institucion //
		
		if ($ClienteI == NULL) // Si entre en el if significa que el empleado es una persona //
		{
			$usuario['idcliente'] = $Cliente; // Id Cliente
			$usuario['Permiso'] = $this->modelNegociacion->ConsultarPermiso($Id_Negociacion); 
			
			$datos['ID2'] = $Id_Negociacion;	
		
			$status = $this->modelNegociacion->StatusNegociacion($Id_Negociacion); 
			$usuario['Status'] = $status;
			
			$usuario['DatosCliente'] = $this->modelCliente->DatosCliente($Id_Negociacion, $Cliente); 
			$cedula = $this->modelCliente->BuscarId($Usuario); 
			$usuario['DatosVendedor'] = $this->modelCliente->DatosVendedor($Id_Negociacion, $cedula); 
			$usuario['Lista'] = $this->modelProducto->ConsultarLista($Id_Negociacion);
			$usuario['Descuento'] = $this->modelProducto->ConsultarDescuento($Id_Negociacion);
			$usuario['Total'] = $this->modelProducto->Total($Id_Negociacion);
			$Neto = $this->modelProducto->Neto($Id_Negociacion);
			$usuario['Neto'] = $this->modelProducto->Neto($Id_Negociacion);
			$usuario['Iva'] = $Neto*0.12;
			
			$this->load->view('Vendedor/Borrador/VVistaPreviaPrueba', $usuario);
		}
		else // Si entre en el else significa que el empleado es una institucion //
		{
			$usuario['idcliente'] = $ClienteI; // Id Cliente
			
			$datos['ID2'] = $Id_Negociacion;	
			$status = $this->modelNegociacion->StatusNegociacion($Id_Negociacion); 
			$usuario['Status'] = $status;
			
			$usuario['DatosCliente'] = $this->modelCliente->DatosClienteI($Id_Negociacion, $ClienteI); 
			$cedula = $this->modelCliente->BuscarId($Usuario); 
			$usuario['DatosVendedor'] = $this->modelCliente->DatosVendedorI($Id_Negociacion, $cedula); 
			$usuario['Lista'] = $this->modelProducto->ConsultarListaI($Id_Negociacion);
			$usuario['Descuento'] = $this->modelProducto->ConsultarDescuento($Id_Negociacion);
			$usuario['Total'] = $this->modelProducto->TotalI($Id_Negociacion);
			$Neto = $this->modelProducto->Neto($Id_Negociacion);
			$usuario['Neto'] = $this->modelProducto->Neto($Id_Negociacion);
			$usuario['Iva'] = $Neto*0.12;
			
			$this->load->view('Vendedor/Borrador/VVistaPreviaPruebaI', $usuario);
		}		
	}
	
	public function imprimir_persona($Id_Negociacion, $Id, $condiciones) 
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario; // Id Usuario //
		$usuario['Id_Negociacion'] = $Id_Negociacion; // Id Negociacion //
		$usuario['idcliente'] = $Id; // Id Cliente
		$usuario['condiciones'] = $condiciones; // Id Cliente
		
		$usuario['Permiso'] = $this->modelNegociacion->ConsultarPermiso($Id_Negociacion); 
		
		$status = $this->modelNegociacion->StatusNegociacion($Id_Negociacion); 
		$usuario['Status'] = $status;
		
		$usuario['DatosCliente'] = $this->modelCliente->DatosCliente($Id_Negociacion, $Id); 
		$cedula = $this->modelCliente->BuscarId($Usuario); 
		$usuario['DatosVendedor'] = $this->modelCliente->DatosVendedor($Id_Negociacion, $cedula); 
		$Lista = $this->modelProducto->ConsultarLista($Id_Negociacion);
		$Lista2 = $this->modelProducto->ConsultarLista2($Id_Negociacion);
		
		$this->load->library('table');
		$this->table->set_empty("&nbsp;");
		$this->table->set_heading('<font style="font-size:12px" color="#369"><b>NOMBRE</b></font>', '<font style="font-size:12px" color="#369"><b>CANTIDAD</b></font>', '<font style="font-size:12px" color="#369"><b>DESCRIPCI&Oacute;N</b></font>');
			
		foreach ($Lista as $row)
		{
			$nombre = $row['Nombre'];
			$cantidad = $row['Cantidad'];
			$descripcion = $row['Descripcion2'];
			$this->table->add_row($nombre, $cantidad, $descripcion);
		}
			
		foreach ($Lista2 as $row)
		{
			$nombre2 = $row['Nombre'];
			$cantidad2 = $row['Cantidad'];
			$descripcion2 = $row['Descripcion2'];
			$this->table->add_row($nombre2, $cantidad2, $descripcion2);
		}
				
		$usuario['table'] = $this->table->generate();
		
		$usuario['Descuento'] = $this->modelProducto->ConsultarDescuento($Id_Negociacion);
		$Neto = $this->modelProducto->Neto($Id_Negociacion);
		$Neto2 = $this->modelProducto->Neto2($Id_Negociacion);
		$Neto3 = $Neto+$Neto2;
		$usuario['Neto'] = $Neto3;
		$usuario['Iva'] = $Neto3*0.12;
		
		$usuario['Total'] = $this->modelProducto->ConsultarTotal($Id_Negociacion);
		
		$this->load->view('Vendedor/Borrador/VImprecion', $usuario);
	}
	
	public function atencion($Id_Negociacion, $Id, $condiciones) 
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario; // Id Usuario //
		$usuario['Id_Negociacion'] = $Id_Negociacion; // Id Negociacion //
		$usuario['idcliente'] = $Id; // Id Cliente
		$usuario['condiciones'] = $condiciones; // Id Cliente
		
		$this->load->view('Vendedor/Borrador/VAtencion', $usuario);
	}
	
	public function imprimir_cliente($Id_Negociacion, $Id, $condiciones) // Vendedor //
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario; // Id Usuario //
		$usuario['Id_Negociacion'] = $Id_Negociacion; // Id Negociacion //
		$usuario['idcliente'] = $Id; // Id Cliente
		$usuario['condiciones'] = $condiciones; // Id Cliente
		
		$status = $this->modelNegociacion->StatusNegociacion($Id_Negociacion); 
		$usuario['Status'] = $status;
		
		$usuario['DatosCliente'] = $this->modelCliente->DatosClienteI($Id_Negociacion, $Id); 
		$cedula = $this->modelCliente->BuscarId($Usuario); 
		$usuario['DatosVendedor'] = $this->modelCliente->DatosVendedorI($Id_Negociacion, $cedula); 
		$Lista = $this->modelProducto->ConsultarLista($Id_Negociacion);
		$Lista2 = $this->modelProducto->ConsultarLista2($Id_Negociacion);
		
		$this->load->library('table');
		$this->table->set_empty("&nbsp;");
		$this->table->set_heading('<font style="font-size:12px" color="#369"><b>NOMBRE</b></font>', '<font style="font-size:12px" color="#369"><b>CANTIDAD</b></font>', '<font style="font-size:12px" color="#369"><b>DESCRIPCI&Oacute;N</b></font>');
			
		foreach ($Lista as $row)
		{
			$nombre = $row['Nombre'];
			$cantidad = $row['Cantidad'];
			$descripcion = $row['Descripcion2'];
			$this->table->add_row($nombre, $cantidad, $descripcion);
		}
			
		foreach ($Lista2 as $row)
		{
			$nombre2 = $row['Nombre'];
			$cantidad2 = $row['Cantidad'];
			$descripcion2 = $row['Descripcion2'];
			$this->table->add_row($nombre2, $cantidad2, $descripcion2);
		}
				
		$usuario['table'] = $this->table->generate();
		
		$usuario['Descuento'] = $this->modelProducto->ConsultarDescuento($Id_Negociacion);
		$Neto = $this->modelProducto->Neto($Id_Negociacion);
		$Neto2 = $this->modelProducto->Neto2($Id_Negociacion);
		$Neto3 = $Neto+$Neto2;
		$usuario['Neto'] = $Neto3;
		$usuario['Iva'] = $Neto3*0.12;
		
		$usuario['Total'] = $this->modelProducto->ConsultarTotal($Id_Negociacion);
		
		$this->load->view('Vendedor/Borrador/VImprecion2', $usuario);
	}

}

