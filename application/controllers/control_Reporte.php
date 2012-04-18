<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Control_Reporte extends CI_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('modelReporte');
		$this->load->helper('form');
	}
	
	// Funcion que nos lleva a la pantalla de reportes en donde
	// el supervisor podra ver lo que el desee
	public function index()
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario;
		
		$this->load->view('Administrador/Reporte/Reporte', $usuario);
	}
	
	// REPORTES DE CLIENTE //
	public function elegir_vista()
	{
		$Tipo = $_POST['Tipo'];
		
		if($Tipo == 1)
		{
			$Usuario = $this->session->userdata('Usuario');
			$usuario['Usuario'] = $Usuario;
			$this->load->view('Administrador/Reporte/RCliente/RCliente', $usuario);
		}
		if($Tipo == 2)
		{
			$Usuario = $this->session->userdata('Usuario');
			$usuario['Usuario'] = $Usuario;
			$this->load->view('Administrador/Reporte/RInstitucion/RInstitucion', $usuario);
		}
		if($Tipo == 3)
		{
			$Usuario = $this->session->userdata('Usuario');
			$usuario['Usuario'] = $Usuario;
			$this->load->view('Administrador/Reporte/RProducto/RProducto', $usuario);
		}
		if($Tipo == 4)
		{
			$Usuario = $this->session->userdata('Usuario');
			$usuario['Usuario'] = $Usuario;
			$this->load->view('Administrador/Reporte/RNegociacion/RNegociacion', $usuario);
		}
		if($Tipo == 5)
		{
			$Usuario = $this->session->userdata('Usuario');
			$usuario['Usuario'] = $Usuario;
			$this->load->view('Administrador/Reporte/REmpleado/REmpleado', $usuario);
		}
		
	}
	
	public function lista_clientes()
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario;
		$Lista = $this->modelReporte->BuscarClientes();
		
		$this->load->library('table');
		$this->table->set_empty("&nbsp;");
		$this->table->set_heading('<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Nombre</b></font>', '<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Apellido</b></font>', '<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Rif</b></font>', '<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Email</b></font>', '<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Telefono</b></font>', '<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Telefono2</b></font>', '<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Direccion</b></font>');
	
		foreach ($Lista as $row)
		{
			$nombre = $row['Nombre'];
			$apellido = $row['Apellido'];
			$rif = $row['Rif'];
			$email = $row['Email'];
			$telefono = $row['Telefono'];
			$telefono2 = $row['Telefono2'];
			$direccion = $row['Direccion'];
			$this->table->add_row($nombre, $apellido, $rif, $email, $telefono, $telefono2, $direccion);
		}
			
		$usuario['table'] = $this->table->generate();
		
		$usuario['titulo'] = "Lista de clientes";
		
		$this->load->view('Administrador/Reporte/RCliente/RVista_1', $usuario);
	}
	
	public function lista_clientes_tipo($tipo)
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario;
		$Lista = $this->modelReporte->BuscarClientesTipo($tipo);
		
		$this->load->library('table');
		$this->table->set_empty("&nbsp;");
		$this->table->set_heading('<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Empleado</b></font>', '<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Numero Negociaci&oacute;n</b></font>', '<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Status</b></font>', '<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Fecha</b></font>', '<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Cliente</b></font>', '<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Telefono</b></font>', '<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>EMail</b></font>');
	
		foreach ($Lista as $row)
		{
			$empleado = $row['Nombre_1'].' '.$row['Apellido_1'];
			$nego = $row['Id_Negociacion'];
			$status = $row['Status'];
			$fecha = $row['FechaP'];
			$cliente = $row['Nombre'].' '.$row['Apellido'];
			$telefono = $row['Telefono'];
			$email = $row['Email'];
			$this->table->add_row($empleado, $nego, $status, $fecha, $cliente, $telefono, $email);
		}
			
		$usuario['table'] = $this->table->generate();
		
		if($tipo == "Publico"){ $usuario['titulo'] = "Negociaciones con clientes publicos"; }
		if($tipo == "Privado"){ $usuario['titulo'] = "Negociaciones con clientes privados"; }
		
		$this->load->view('Administrador/Reporte/RCliente/RVista_1', $usuario);
	}
	
	public function lista_clientes_tstatus($status, $numero)
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario;
		$Lista = $this->modelReporte->BuscarClientesTipoStatus($status);
		
		$this->load->library('table');
		$this->table->set_empty("&nbsp;");
		$this->table->set_heading('<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Tipo</b></font>', '<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Empleado</b></font>', '<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Numero Negociaci&oacute;n</b></font>', '<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Status</b></font>', '<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Fecha</b></font>', '<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Cliente</b></font>', '<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Telefono</b></font>', '<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>EMail</b></font>');
	
		foreach ($Lista as $row)
		{
			$tipo = $row['Tipo_C'];
			$empleado = $row['Nombre_1'].' '.$row['Apellido_1'];
			$nego = $row['Id_Negociacion'];
			$status = $row['Status'];
			$fecha = $row['FechaP'];
			$cliente = $row['Nombre'].' '.$row['Apellido'];
			$telefono = $row['Telefono'];
			$email = $row['Email'];
			$this->table->add_row($tipo, $empleado, $nego, $status, $fecha, $cliente, $telefono, $email);
		}
			
		$usuario['table'] = $this->table->generate();
		
		if($numero == 1){ $usuario['titulo'] = "Clientes publicos y privados en status borrador"; }
		if($numero == 2){ $usuario['titulo'] = "Clientes publicos y privados en status Activa"; }
		if($numero == 3){ $usuario['titulo'] = "Clientes publicos y privados en status > 75%"; }
		if($numero == 4){ $usuario['titulo'] = "Clientes publicos y privados en status > 90%"; }
		if($numero == 5){ $usuario['titulo'] = "Clientes publicos y privados en status Ganada"; }
		if($numero == 6){ $usuario['titulo'] = "Clientes publicos y privados en status Cerrada"; }
		if($numero == 7){ $usuario['titulo'] = "Clientes publicos y privados en status Perdida"; }
		
		$this->load->view('Administrador/Reporte/RCliente/RVista_1', $usuario);
	}
	
	public function lista_por_especialidad($especialidad, $numero)
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario;
		$Lista = $this->modelReporte->BuscarClientesEspecial($especialidad);
		
		$this->load->library('table');
		$this->table->set_empty("&nbsp;");
		$this->table->set_heading('<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Nombre</b></font>', '<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Apellido</b></font>', '<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Rif</b></font>', '<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Email</b></font>', '<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Telefono</b></font>', '<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Telefono2</b></font>', '<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Direccion</b></font>');
	
		foreach ($Lista as $row)
		{
			$nombre = $row['Nombre'];
			$apellido = $row['Apellido'];
			$rif = $row['Rif'];
			$email = $row['Email'];
			$telefono = $row['Telefono'];
			$telefono2 = $row['Telefono2'];
			$direccion = $row['Direccion'];
			$this->table->add_row($nombre, $apellido, $rif, $email, $telefono, $telefono2, $direccion);
		}
			
		$usuario['table'] = $this->table->generate();
		
		if($numero == 1){ $usuario['titulo'] = "Clientes por la especialidad Cirugia"; }
		if($numero == 2){ $usuario['titulo'] = "Clientes por la especialidad Emergenciologia"; }
		if($numero == 3){ $usuario['titulo'] = "Clientes por la especialidad Fisiatria"; }
		if($numero == 4){ $usuario['titulo'] = "Clientes por la especialidad Fisioterapia"; }
		if($numero == 5){ $usuario['titulo'] = "Clientes por la especialidad Ginecologia"; }
		if($numero == 6){ $usuario['titulo'] = "Clientes por la especialidad Gineco-Obstetricia"; }
		if($numero == 7){ $usuario['titulo'] = "Clientes por la especialidad Imagenologia"; }
		if($numero == 8){ $usuario['titulo'] = "Clientes por la especialidad Intensivista"; }
		if($numero == 9){ $usuario['titulo'] = "Clientes por la especialidad Mastologia"; }
		if($numero == 10){ $usuario['titulo'] = "Clientes por la especialidad Nefrologia"; }
		if($numero == 11){ $usuario['titulo'] = "Clientes por la especialidad Neumonologia"; }
		if($numero == 12){ $usuario['titulo'] = "Clientes por la especialidad Nutricion"; }
		if($numero == 13){ $usuario['titulo'] = "Clientes por la especialidad Nutrologia"; }
		if($numero == 14){ $usuario['titulo'] = "Clientes por la especialidad Obstetricia"; }
		if($numero == 15){ $usuario['titulo'] = "Clientes por la especialidad Oncologia"; }
		if($numero == 16){ $usuario['titulo'] = "Clientes por la especialidad Pediatria"; }
		if($numero == 17){ $usuario['titulo'] = "Clientes por la especialidad Radiologia"; }
		if($numero == 18){ $usuario['titulo'] = "Clientes por la especialidad Traumatologia"; }
		if($numero == 19){ $usuario['titulo'] = "Clientes por la especialidad Medicina Interna"; }
		if($numero == 20){ $usuario['titulo'] = "Clientes por la especialidad Endocrinologia"; }
		if($numero == 21){ $usuario['titulo'] = "Clientes por la especialidad Anestesiologia"; }
		if($numero == 22){ $usuario['titulo'] = "Clientes por la especialidad Multi-Especialidad"; }
		
		$this->load->view('Administrador/Reporte/RCliente/RVista_1', $usuario);
	}
	
	public function lista_por_sexo($sexo)
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario;
		$Lista = $this->modelReporte->BuscarClientesSexo($sexo);
		
		$this->load->library('table');
		$this->table->set_empty("&nbsp;");
		$this->table->set_heading('<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Nombre</b></font>', '<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Apellido</b></font>', '<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Rif</b></font>', '<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Email</b></font>', '<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Telefono</b></font>', '<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Telefono2</b></font>', '<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Direccion</b></font>');
	
		foreach ($Lista as $row)
		{
			$nombre = $row['Nombre'];
			$apellido = $row['Apellido'];
			$rif = $row['Rif'];
			$email = $row['Email'];
			$telefono = $row['Telefono'];
			$telefono2 = $row['Telefono2'];
			$direccion = $row['Direccion'];
			$this->table->add_row($nombre, $apellido, $rif, $email, $telefono, $telefono2, $direccion);
		}
			
		$usuario['table'] = $this->table->generate();
		
		if($sexo == "Hombre"){ $usuario['titulo'] = "Clientes del sexo masculino"; }
		if($sexo == "Mujer"){ $usuario['titulo'] = "Clientes del sexo femenino"; }
		
		$this->load->view('Administrador/Reporte/RCliente/RVista_1', $usuario);
	}
	
	public function lista_max_negociaciones()
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario;
		$Max = $this->modelReporte->NumeroNegociaciones();
		$usuario['Max'] = $this->modelReporte->NumeroNegociaciones(). '&nbsp; Negociaciones';
		$Lista = $this->modelReporte->BuscarNegoClientes($Max);
		
		$this->load->library('table');
		$this->table->set_empty("&nbsp;");
		$this->table->set_heading('<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Nombre</b></font>', '<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Apellido</b></font>', '<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Rif</b></font>', '<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Email</b></font>', '<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Telefono</b></font>', '<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Telefono2</b></font>', '<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Direccion</b></font>');
	
		foreach ($Lista as $row)
		{
			$nombre = $row['Nombre'];
			$apellido = $row['Apellido'];
			$rif = $row['Rif'];
			$email = $row['Email'];
			$telefono = $row['Telefono'];
			$telefono2 = $row['Telefono2'];
			$direccion = $row['Direccion'];
			$this->table->add_row($nombre, $apellido, $rif, $email, $telefono, $telefono2, $direccion);
		}
			
		$usuario['table'] = $this->table->generate();
		
		$usuario['titulo'] = "Clientes con mas negociaciones abiertas";
		
		$this->load->view('Administrador/Reporte/RCliente/RVista_1', $usuario);
	}
	
	public function lista_min_negociaciones()
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario;
		$Min = $this->modelReporte->NumeroNegociaciones2();
		$usuario['Min'] = $this->modelReporte->NumeroNegociaciones2(). '&nbsp; Negociaciones';
		$Lista = $this->modelReporte->BuscarNegoClientes($Min);
		
		$this->load->library('table');
		$this->table->set_empty("&nbsp;");
		$this->table->set_heading('<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Nombre</b></font>', '<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Apellido</b></font>', '<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Rif</b></font>', '<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Email</b></font>', '<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Telefono</b></font>', '<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Telefono2</b></font>', '<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Direccion</b></font>');
	
		foreach ($Lista as $row)
		{
			$nombre = $row['Nombre'];
			$apellido = $row['Apellido'];
			$rif = $row['Rif'];
			$email = $row['Email'];
			$telefono = $row['Telefono'];
			$telefono2 = $row['Telefono2'];
			$direccion = $row['Direccion'];
			$this->table->add_row($nombre, $apellido, $rif, $email, $telefono, $telefono2, $direccion);
		}
			
		$usuario['table'] = $this->table->generate();
		
		$usuario['titulo'] = "Clientes con menos negociaciones abiertas";
		
		$this->load->view('Administrador/Reporte/RCliente/RVista_1', $usuario);
	}
	
	public function lista_clientes_bagcp($Porcentaje, $numero)
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario;
		$Lista = $this->modelReporte->BuscarNegoClientesBAGCP($Porcentaje);
		
		$this->load->library('table');
		$this->table->set_empty("&nbsp;");
		$this->table->set_heading('<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Nombre</b></font>', '<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Apellido</b></font>', '<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Rif</b></font>', '<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Email</b></font>', '<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Telefono</b></font>', '<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Telefono2</b></font>', '<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Direccion</b></font>', '<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Total</b></font>');
	
		foreach ($Lista as $row)
		{
			$nombre = $row['Nombre'];
			$apellido = $row['Apellido'];
			$rif = $row['Rif'];
			$email = $row['Email'];
			$telefono = $row['Telefono'];
			$telefono2 = $row['Telefono2'];
			$direccion = $row['Direccion'];
			$nego = $row['Cuenta'];
			$this->table->add_row($nombre, $apellido, $rif, $email, $telefono, $telefono2, $direccion, $nego);
		}
			
		$usuario['table'] = $this->table->generate();
		
		if($numero == 1){ $usuario['titulo'] = "Total de negociaciones por cliente en status borrador"; }
		if($numero == 2){ $usuario['titulo'] = "Total de negociaciones por cliente en status Activa"; }
		if($numero == 3){ $usuario['titulo'] = "Total de negociaciones por cliente en status > 75%"; }
		if($numero == 4){ $usuario['titulo'] = "Total de negociaciones por cliente en status > 90%"; }
		if($numero == 5){ $usuario['titulo'] = "Total de negociaciones por cliente en status Ganada"; }
		if($numero == 6){ $usuario['titulo'] = "Total de negociaciones por cliente en status Cerrada"; }
		if($numero == 7){ $usuario['titulo'] = "Total de negociaciones por cliente en status Perdida"; }
		
		$this->load->view('Administrador/Reporte/RCliente/RVista_1', $usuario);
	}
	
	
	
	// REPORTES DE INSTITUCION //
	public function lista_institucion()
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario;
		$Lista = $this->modelReporte->BuscarInstituciones();
		
		$this->load->library('table');
		$this->table->set_empty("&nbsp;");
		$this->table->set_heading('<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Nombre</b></font>', '<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Rif</b></font>', '<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Web</b></font>', '<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Telefono</b></font>', '<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Telefono2</b></font>', '<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Direccion</b></font>');
	
		foreach ($Lista as $row)
		{
			$nombre = $row['Nombre'];
			$rif = $row['Rif'];
			$web = $row['Web'];
			$telefono = $row['Telefono1'];
			$telefono2 = $row['Telefono2'];
			$direccion = $row['Direccion1'];
			$this->table->add_row($nombre, $rif, $web, $telefono, $telefono2, $direccion);
		}
			
		$usuario['table'] = $this->table->generate();
		
		$usuario['titulo'] = "Lista de instituciones";
		
		$this->load->view('Administrador/Reporte/RInstitucion/RVista_2', $usuario);
	}
	
	public function lista_instituciones_tipo($tipo)
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario;
		$Lista = $this->modelReporte->BuscarInstitucionesTipo($tipo);
		
		$this->load->library('table');
		$this->table->set_empty("&nbsp;");
		$this->table->set_heading('<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Empleado</b></font>', '<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Numero Negociaci&oacute;n</b></font>', '<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Status</b></font>', '<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Fecha</b></font>', '<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Instituci&oacute;n</b></font>', '<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Telefono</b></font>', '<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Web</b></font>');
	
		foreach ($Lista as $row)
		{
			$empleado = $row['Nombre_1'].' '.$row['Apellido_1'];
			$nego = $row['Id_Negociacion'];
			$status = $row['Status'];
			$fecha = $row['FechaP'];
			$institucion = $row['Nombre'];
			$telefono = $row['Telefono1'];
			$web = $row['Web'];
			$this->table->add_row($empleado, $nego, $status, $fecha, $institucion, $telefono, $web);
		}
			
		$usuario['table'] = $this->table->generate();
		
		if($tipo == "Publico"){ $usuario['titulo'] = "Negociaciones con instituciones publicas"; }
		if($tipo == "Privado"){ $usuario['titulo'] = "Negociaciones con instituciones privadas"; }
		
		$this->load->view('Administrador/Reporte/RInstitucion/RVista_2', $usuario);
	}
	
	public function lista_instituciones_tstatus($status, $numero)
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario;
		$Lista = $this->modelReporte->BuscarInstitucionesTipoStatus($status);
		
		$this->load->library('table');
		$this->table->set_empty("&nbsp;");
		$this->table->set_heading('<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Tipo</b></font>', '<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Empleado</b></font>', '<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Numero Negociaci&oacute;n</b></font>', '<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Status</b></font>', '<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Fecha</b></font>', '<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Instituci&oacute;n</b></font>', '<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Telefono</b></font>', '<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Web</b></font>');
	
		foreach ($Lista as $row)
		{
			$tipo = $row['Tipo_I'];
			$empleado = $row['Nombre_1'].' '.$row['Apellido_1'];
			$nego = $row['Id_Negociacion'];
			$status = $row['Status'];
			$fecha = $row['FechaP'];
			$institucion = $row['Nombre'];
			$telefono = $row['Telefono1'];
			$web = $row['Web'];
			$this->table->add_row($tipo, $empleado, $nego, $status, $fecha, $institucion, $telefono, $web);
		}
			
		$usuario['table'] = $this->table->generate();
		
		if($numero == 1){ $usuario['titulo'] = "Instituciones publicas y privadas en status borrador"; }
		if($numero == 2){ $usuario['titulo'] = "Instituciones publicas y privadas en status Activa"; }
		if($numero == 3){ $usuario['titulo'] = "Instituciones publicas y privadas en status > 75%"; }
		if($numero == 4){ $usuario['titulo'] = "Instituciones publicas y privadas en status > 90%"; }
		if($numero == 5){ $usuario['titulo'] = "Instituciones publicas y privadas en status Ganada"; }
		if($numero == 6){ $usuario['titulo'] = "Instituciones publicas y privadas en status Cerrada"; }
		if($numero == 7){ $usuario['titulo'] = "Instituciones publicas y privadas en status Perdida"; }
		
		$this->load->view('Administrador/Reporte/RInstitucion/RVista_2', $usuario);
	}
	
	public function lista_institucion_especial($especialidad)
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario;
		$Lista = $this->modelReporte->BuscarInstitucionesEspecial($especialidad);
		
		$this->load->library('table');
		$this->table->set_empty("&nbsp;");
		$this->table->set_heading('<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Nombre</b></font>', '<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Rif</b></font>', '<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Web</b></font>', '<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Telefono</b></font>', '<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Telefono2</b></font>', '<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Direccion</b></font>');
	
		foreach ($Lista as $row)
		{
			$nombre = $row['Nombre'];
			$rif = $row['Rif'];
			$web = $row['Web'];
			$telefono = $row['Telefono1'];
			$telefono2 = $row['Telefono2'];
			$direccion = $row['Direccion1'];
			$this->table->add_row($nombre, $rif, $web, $telefono, $telefono2, $direccion);
		}
			
		$usuario['table'] = $this->table->generate();
		
		$this->load->view('Administrador/Reporte/RInstitucion/RVista_2', $usuario);
	}
	
	public function lista_institucion_maxnego()
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario;
		$Max = $this->modelReporte->NumeroNegociacionesIns();
		$usuario['Max'] = $this->modelReporte->NumeroNegociacionesIns(). '&nbsp; Negociaciones';
		$Lista = $this->modelReporte->BuscarNegoInstituciones($Max);
		
		$this->load->library('table');
		$this->table->set_empty("&nbsp;");
		$this->table->set_heading('<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Nombre</b></font>', '<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Rif</b></font>', '<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Web</b></font>', '<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Telefono</b></font>', '<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Telefono2</b></font>', '<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Direccion</b></font>');
	
		foreach ($Lista as $row)
		{
			$nombre = $row['Nombre'];
			$rif = $row['Rif'];
			$web = $row['Web'];
			$telefono = $row['Telefono1'];
			$telefono2 = $row['Telefono2'];
			$direccion = $row['Direccion1'];
			$this->table->add_row($nombre, $rif, $web, $telefono, $telefono2, $direccion);
		}
			
		$usuario['table'] = $this->table->generate();
		
		$usuario['titulo'] = "Lista de Institucion con mas negociaciones abiertas";
		
		$this->load->view('Administrador/Reporte/RInstitucion/RVista_2', $usuario);
	}
	
	public function lista_institucion_minnego()
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario;
		$Min = $this->modelReporte->NumeroNegociaciones2Ins();
		$usuario['Min'] = $this->modelReporte->NumeroNegociaciones2Ins(). '&nbsp; Negociaciones';
		$Lista = $this->modelReporte->BuscarNegoInstituciones($Min);
		
		$this->load->library('table');
		$this->table->set_empty("&nbsp;");
		$this->table->set_heading('<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Nombre</b></font>', '<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Rif</b></font>', '<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Web</b></font>', '<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Telefono</b></font>', '<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Telefono2</b></font>', '<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Direccion</b></font>');
	
		foreach ($Lista as $row)
		{
			$nombre = $row['Nombre'];
			$rif = $row['Rif'];
			$web = $row['Web'];
			$telefono = $row['Telefono1'];
			$telefono2 = $row['Telefono2'];
			$direccion = $row['Direccion1'];
			$this->table->add_row($nombre, $rif, $web, $telefono, $telefono2, $direccion);
		}
			
		$usuario['table'] = $this->table->generate();
		
		$usuario['titulo'] = "Lista de Institucion con menos negociaciones abiertas";
		
		$this->load->view('Administrador/Reporte/RInstitucion/RVista_2', $usuario);
	}
	
	public function lista_institucion_bagcp($Porcentaje, $numero)
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario;
		$Lista = $this->modelReporte->BuscarNegoInstitucionesBAGCP($Porcentaje);
		
		$this->load->library('table');
		$this->table->set_empty("&nbsp;");
		$this->table->set_heading('<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Nombre</b></font>', '<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Rif</b></font>', '<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Web</b></font>', '<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Telefono</b></font>', '<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Telefono2</b></font>', '<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Direccion</b></font>', '<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Total</b></font>');
	
		foreach ($Lista as $row)
		{
			$nombre = $row['Nombre'];
			$rif = $row['Rif'];
			$web = $row['Web'];
			$telefono = $row['Telefono1'];
			$telefono2 = $row['Telefono2'];
			$direccion = $row['Direccion1'];
			$nego = $row['Cuenta'];
			$this->table->add_row($nombre, $rif, $web, $telefono, $telefono2, $direccion, $nego);
		}
			
		$usuario['table'] = $this->table->generate();
		
		if($numero == 1){ $usuario['titulo'] = "Total de negociaciones por Institucion en status borrador"; }
		if($numero == 2){ $usuario['titulo'] = "Total de negociaciones por Institucion en status Activa"; }
		if($numero == 3){ $usuario['titulo'] = "Total de negociaciones por Institucion en status > 75%"; }
		if($numero == 4){ $usuario['titulo'] = "Total de negociaciones por Institucion en status > 90%"; }
		if($numero == 5){ $usuario['titulo'] = "Total de negociaciones por Institucion en status Ganada"; }
		if($numero == 6){ $usuario['titulo'] = "Total de negociaciones por Institucion en status Cerrada"; }
		if($numero == 7){ $usuario['titulo'] = "Total de negociaciones por Institucion en status Perdida"; }
		
		$this->load->view('Administrador/Reporte/RInstitucion/RVista_2', $usuario);
	}
	
	
	
	// REPORTES DE PRODUCTOS //
	public function lista_marca()
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario;
		$Lista = $this->modelReporte->BuscarMarcas();
		
		$this->load->library('table');
		$this->table->set_empty("&nbsp;");
		$this->table->set_heading('<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Marca</b></font>');
	
		foreach ($Lista as $row)
		{
			$nombre = $row['Nombre'];
			$this->table->add_row($nombre);
		}
			
		$usuario['table'] = $this->table->generate();
		
		$usuario['titulo'] = "Lista de marcas";
		
		$this->load->view('Administrador/Reporte/RProducto/RVista_3', $usuario);
	}
	
	public function lista_linea()
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario;
		$Lista = $this->modelReporte->BuscarLineas();
		
		$this->load->library('table');
		$this->table->set_empty("&nbsp;");
		$this->table->set_heading('<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Marca</b></font>', '<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Linea</b></font>');
	
		foreach ($Lista as $row)
		{
			$marca = $row['Marca'];
			$linea = $row['Linea'];
			$this->table->add_row($marca, $linea);
		}
			
		$usuario['table'] = $this->table->generate();
		
		$usuario['titulo'] = "Lista de lineas";
		
		$this->load->view('Administrador/Reporte/RProducto/RVista_3', $usuario);
	}
	
	public function lista_equipo()
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario;
		$Lista = $this->modelReporte->BuscarEquipos();
		
		$this->load->library('table');
		$this->table->set_empty("&nbsp;");
		$this->table->set_heading('<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Marca</b></font>', '<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Linea</b></font>', '<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Equipo</b></font>', '<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Precio Bs.F.</b></font>', '<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Descripci&oacute;n</b></font>');
	
		foreach ($Lista as $row)
		{
			$marca = $row['Marca'];
			$linea = $row['Linea'];
			$equipo = $row['Equipo'];
			$precio = $row['Precio'];
			$descripcion = $row['Descripcion'];
			$this->table->add_row($marca, $linea, $equipo, $precio, $descripcion);
		}
			
		$usuario['table'] = $this->table->generate();
		
		$usuario['titulo'] = "Lista de equipos";
		
		$this->load->view('Administrador/Reporte/RProducto/RVista_3', $usuario);
	}
	
	public function lista_accesorio()
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario;
		$Lista = $this->modelReporte->BuscarAccesorios();
		
		$this->load->library('table');
		$this->table->set_empty("&nbsp;");
		$this->table->set_heading('<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Marca</b></font>', '<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Linea</b></font>', '<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Equipo</b></font>', '<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Accesorio</b></font>', '<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Precio Bs.F.</b></font>', '<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Descripci&oacute;n</b></font>');
	
		foreach ($Lista as $row)
		{
			$marca = $row['Marca'];
			$linea = $row['Linea'];
			$equipo = $row['Equipo'];
			$accesorio = $row['Accesorio'];
			$precio = $row['Precio'];
			$descripcion = $row['Descripcion'];
			$this->table->add_row($marca, $linea, $equipo, $accesorio, $precio, $descripcion);
		}
			
		$usuario['table'] = $this->table->generate();
		
		$usuario['titulo'] = "Lista de accesorios";
		
		$this->load->view('Administrador/Reporte/RProducto/RVista_3', $usuario);
	}
	
	
	
	// REPORTE DE EMPLEADOS //
	public function lista_empleado()
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario;
		$Lista = $this->modelReporte->BuscarEmpleados();
		
		$this->load->library('table');
		$this->table->set_empty("&nbsp;");
		$this->table->set_heading('<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Usuario</b></font>', '<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Nombre</b></font>', '<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Apellido</b></font>', '<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Fecha Ingreso</b></font>', '<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Correo</b></font>', '<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Telf. Casa</b></font>', '<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Telf. Oficina</b></font>', '<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Telf. Celular</b></font>');
	
		foreach ($Lista as $row)
		{
			$usuario2 = $row['Usuario'];
			$nombre = $row['Nombre_1'];
			$apellido = $row['Apellido_1'].' '.$row['Apellido_2'];
			$fingreso = $row['Fecha_Ingreso'];
			$correo = $row['Correo'];
			$tcasa = $row['Telf_Casa'];
			$tofi = $row['Telf_Ofi'];
			$tcel = $row['Telf_Cel'];
			$this->table->add_row($usuario2, $nombre, $apellido, $fingreso, $correo, $tcasa, $tofi, $tcel);
		}
			
		$usuario['table'] = $this->table->generate();
		
		$usuario['titulo'] = "Lista de empleados";
		
		$this->load->view('Administrador/Reporte/REmpleado/RVista_4', $usuario);
	}
	
	public function lista_empleado_status($Porcentaje, $numero)
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario;
		$Lista = $this->modelReporte->BuscarNegoEmpleadoTipo($Porcentaje);
		
		$this->load->library('table');
		$this->table->set_empty("&nbsp;");
		$this->table->set_heading('<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Empleado</b></font>', '<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Cliente</b></font>', '<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Telefono</b></font>', '<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Email</b></font>', '<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Codigo Negociaci&oacute;n</b></font>', '<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Fecha Negociaci&oacute;n</b></font>', '<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Status</b></font>', '<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Total Bs.F.</b></font>');
	
		foreach ($Lista as $row)
		{
			$nombre = $row['Nombre_1'].' '.$row['Apellido_1'];
			$nombre2 = $row['Nombre'].' '.$row['Apellido'];
			$telefono = $row['Telefono'];
			$email = $row['Email'];
			$nego = $row['Id_Negociacion'];
			$fechanego = $row['FechaP'];
			$status = $row['Status'];
			$total = $row['Total'];
			$this->table->add_row($nombre, $nombre2, $telefono, $email, $nego, $fechanego, $status, $total);
		}
			
		$usuario['table'] = $this->table->generate();
		
		if($numero == 1){ $usuario['titulo'] = "Lista de empleados y negociaciones en status borrador"; }
		if($numero == 2){ $usuario['titulo'] = "Lista de empleados y negociaciones en status Activa"; }
		if($numero == 3){ $usuario['titulo'] = "Lista de empleados y negociaciones en status > 75%"; }
		if($numero == 4){ $usuario['titulo'] = "Lista de empleados y negociaciones en status > 90%"; }
		if($numero == 5){ $usuario['titulo'] = "Lista de empleados y negociaciones en status Ganada y Cerrada"; }
		if($numero == 6){ $usuario['titulo'] = "Lista de empleados y negociaciones en status Perdida"; }
		
		$this->load->view('Administrador/Reporte/REmpleado/RVista_4', $usuario);
	}
	
	
	
	
	// REPORTES DE NEGOCIACIONES //
	public function lista_negociacion()
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario;
		$Lista = $this->modelReporte->BuscarNegociaciones();
		
		$this->load->library('table');
		$this->table->set_empty("&nbsp;");
		$this->table->set_heading('<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Codigo</b></font>', '<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Status</b></font>','<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>NumeroODC</b></font>', '<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>FechaODC</b></font>', '<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Banco</b></font>', '<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>PagoInicial</b></font>', '<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>CondicionesPago</b></font>', '<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>FechaPago</b></font>', '<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Numero Deposito</b></font>', '<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Total</b></font>', '<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Vendedor</b></font>');
	
		foreach ($Lista as $row)
		{
			$codigo = $row['Id_Negociacion'];
			$status = $row['Status'];
			$fechap = $row['FechaP'];
			$numeroo = $row['NumeroODC'];
			$fechao = $row['FechaODC'];
			$banco = $row['Banco'];
			$pago = $row['PagoInicial'];
			$condicion = $row['CondicionesPago'];
			$fechapa = $row['FechaPago'];
			$ndeposito = $row['NDeposito'];
			$total = $row['Total'];
			$nvendedor = $row['Nombre_1'];
			$avendedor = $row['Apellido_1'];
			$vendedor = $nvendedor.' '.$avendedor;
			$this->table->add_row($codigo, $status, $numeroo, $fechao, $banco, $pago, $condicion, $fechapa, $ndeposito, $total, $vendedor);
		}
			
		$usuario['table'] = $this->table->generate();
		
		$usuario['titulo'] = "Lista de negociaciones";
		
		$this->load->view('Administrador/Reporte/RNegociacion/RVista_5', $usuario);
	}
	
	public function lista_negociaciones_especial($especialidad, $numero)
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario;
		$Lista = $this->modelReporte->BuscarNegociacionesEspecial($especialidad);
		
		$this->load->library('table');
		$this->table->set_empty("&nbsp;");
		$this->table->set_heading('<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Nombre</b></font>', '<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Apellido</b></font>', '<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Telefono</b></font>', '<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>EMail</b></font>', '<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Status</b></font>', '<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Codigo Negociaci&oacute;n</b></font>', '<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Vendedor</b></font>', '<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Total</b></font>');
	
		foreach ($Lista as $row)
		{
			$nombre = $row['Nombre'];
			$apellido = $row['Apellido'];
			$telefono = $row['Telefono'];
			$email = $row['Email'];
			$status = $row['Status'];
			$nego = $row['Id_Negociacion'];
			$nvendedor = $row['Nombre_1'];
			$avendedor = $row['Apellido_1'];
			$vendedor = $nvendedor.' '.$avendedor;
			$total = $row['Total'];
			$this->table->add_row($nombre, $apellido, $telefono, $email, $status, $nego, $vendedor, $total);
		}
			
		$usuario['table'] = $this->table->generate();
		
		if($numero == 1){ $usuario['titulo'] = "Negociaciones con la especialidad Cirugia"; }
		if($numero == 2){ $usuario['titulo'] = "Negociaciones con la especialidad Emergenciologia"; }
		if($numero == 3){ $usuario['titulo'] = "Negociaciones con la especialidad Fisiatria"; }
		if($numero == 4){ $usuario['titulo'] = "Negociaciones con la especialidad Fisioterapia"; }
		if($numero == 5){ $usuario['titulo'] = "Negociaciones con la especialidad Ginecologia"; }
		if($numero == 6){ $usuario['titulo'] = "Negociaciones con la especialidad Gineco-Obstetricia"; }
		if($numero == 7){ $usuario['titulo'] = "Negociaciones con la especialidad Imagenologia"; }
		if($numero == 8){ $usuario['titulo'] = "Negociaciones con la especialidad Intensivista"; }
		if($numero == 9){ $usuario['titulo'] = "Negociaciones con la especialidad Mastologia"; }
		if($numero == 10){ $usuario['titulo'] = "Negociaciones con la especialidad Nefrologia"; }
		if($numero == 11){ $usuario['titulo'] = "Negociaciones con la especialidad Neumonologia"; }
		if($numero == 12){ $usuario['titulo'] = "Negociaciones con la especialidad Nutricion"; }
		if($numero == 13){ $usuario['titulo'] = "Negociaciones con la especialidad Nutrologia"; }
		if($numero == 14){ $usuario['titulo'] = "Negociaciones con la especialidad Obstetricia"; }
		if($numero == 15){ $usuario['titulo'] = "Negociaciones con la especialidad Oncologia"; }
		if($numero == 16){ $usuario['titulo'] = "Negociaciones con la especialidad Pediatria"; }
		if($numero == 17){ $usuario['titulo'] = "Negociaciones con la especialidad Radiologia"; }
		if($numero == 18){ $usuario['titulo'] = "Negociaciones con la especialidad Traumatologia"; }
		if($numero == 19){ $usuario['titulo'] = "Negociaciones con la especialidad Medicina Interna"; }
		if($numero == 20){ $usuario['titulo'] = "Negociaciones con la especialidad Endocrinologia"; }
		if($numero == 21){ $usuario['titulo'] = "Negociaciones con la especialidad Anestesiologia"; }
		if($numero == 22){ $usuario['titulo'] = "Negociaciones con la especialidad Multi-Especialidad"; }
		
		$this->load->view('Administrador/Reporte/RNegociacion/RVista_5', $usuario);
	}
	
	public function lista_negociaciones_especiali($especialidad, $numero)
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario;
		$Lista = $this->modelReporte->BuscarNegociacionesEspecialI($especialidad);
		
		$this->load->library('table');
		$this->table->set_empty("&nbsp;");
		$this->table->set_heading('<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Nombre</b></font>', '<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Telefono</b></font>', '<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>EMail</b></font>', '<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Status</b></font>', '<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Codigo Negociaci&oacute;n</b></font>', '<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Vendedor</b></font>', '<font style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>Total</b></font>');
	
		foreach ($Lista as $row)
		{
			$nombre = $row['Nombre'];
			$telefono = $row['Telefono1'];
			$email = $row['Web'];
			$status = $row['Status'];
			$nego = $row['Id_Negociacion'];
			$nvendedor = $row['Nombre_1'];
			$avendedor = $row['Apellido_1'];
			$vendedor = $nvendedor.' '.$avendedor;
			$total = $row['Total'];
			$this->table->add_row($nombre, $telefono, $email, $status, $nego, $vendedor, $total);
		}
			
		$usuario['table'] = $this->table->generate();
		
		if($numero == 1){ $usuario['titulo'] = "Negociaciones con la especialidad Cirugia"; }
		if($numero == 2){ $usuario['titulo'] = "Negociaciones con la especialidad Emergenciologia"; }
		if($numero == 3){ $usuario['titulo'] = "Negociaciones con la especialidad Fisiatria"; }
		if($numero == 4){ $usuario['titulo'] = "Negociaciones con la especialidad Fisioterapia"; }
		if($numero == 5){ $usuario['titulo'] = "Negociaciones con la especialidad Ginecologia"; }
		if($numero == 6){ $usuario['titulo'] = "Negociaciones con la especialidad Gineco-Obstetricia"; }
		if($numero == 7){ $usuario['titulo'] = "Negociaciones con la especialidad Imagenologia"; }
		if($numero == 8){ $usuario['titulo'] = "Negociaciones con la especialidad Intensivista"; }
		if($numero == 9){ $usuario['titulo'] = "Negociaciones con la especialidad Mastologia"; }
		if($numero == 10){ $usuario['titulo'] = "Negociaciones con la especialidad Nefrologia"; }
		if($numero == 11){ $usuario['titulo'] = "Negociaciones con la especialidad Neumonologia"; }
		if($numero == 12){ $usuario['titulo'] = "Negociaciones con la especialidad Nutricion"; }
		if($numero == 13){ $usuario['titulo'] = "Negociaciones con la especialidad Nutrologia"; }
		if($numero == 14){ $usuario['titulo'] = "Negociaciones con la especialidad Obstetricia"; }
		if($numero == 15){ $usuario['titulo'] = "Negociaciones con la especialidad Oncologia"; }
		if($numero == 16){ $usuario['titulo'] = "Negociaciones con la especialidad Pediatria"; }
		if($numero == 17){ $usuario['titulo'] = "Negociaciones con la especialidad Radiologia"; }
		if($numero == 18){ $usuario['titulo'] = "Negociaciones con la especialidad Traumatologia"; }
		if($numero == 19){ $usuario['titulo'] = "Negociaciones con la especialidad Medicina Interna"; }
		if($numero == 20){ $usuario['titulo'] = "Negociaciones con la especialidad Endocrinologia"; }
		if($numero == 21){ $usuario['titulo'] = "Negociaciones con la especialidad Anestesiologia"; }
		if($numero == 22){ $usuario['titulo'] = "Negociaciones con la especialidad Multi-Especialidad"; }
		
		$this->load->view('Administrador/Reporte/RNegociacion/RVista_5', $usuario);
	}
		

}