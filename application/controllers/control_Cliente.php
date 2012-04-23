<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Control_Cliente extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('modelCliente');
		$this->load->model('modelInstitucion');
		$this->load->model('modelNegociacion');
		$this->load->helper('form');
	}
	
	// Funcion que abre la pantalla de clientes del usuario en donde consultamos 
	// clientes en el sistema.
	public function index()
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario;
		$usuario['Clientes'] = $this->modelNegociacion->BuscarClientes();
		$this->load->view('Vendedor/Cliente/VVerCliente', $usuario);
	}
	
	// Funcion que nos abre la pantalla en donde el usuario podra crear clientes
	// nuevos al sistema.  
	public function agregar_cliente()
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario;
		$usuario['Institucion'] = $this->modelInstitucion->BuscarInstituciones();
		$this->load->view('Vendedor/Cliente/VCliente', $usuario);
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
			
		$this->load->view('Vendedor/Cliente/VCliente', $usuario);	
	}
	
	// Funcion que nos permite ver el perfil de el cliente que nosotros 
	// queramos dentro de el sistema. 
	public function ver_perfil()
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario;
		$id_cliente = $_POST['Cliente'];
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
		
		$usuario['Institucion'] = $this->modelInstitucion->BuscarInstituciones();
		
		$this->load->view('Vendedor/Cliente/VVerPerfilCliente', $usuario);
	}
	
	public function ver_perfil_2($cliente)
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario;
		$usuario['id_cliente'] = $cliente;
		$usuario['Nombre'] = $this->modelCliente->NombreCliente($cliente);
		$usuario['Apellido'] = $this->modelCliente->ApellidoCliente($cliente);
		$usuario['Email'] = $this->modelCliente->EmailCliente($cliente);
		$usuario['Telefono1'] = $this->modelCliente->TelfCliente($cliente);
		$usuario['Telefono2'] = $this->modelCliente->Telf2Cliente($cliente);
		$usuario['Telefono3'] = $this->modelCliente->Telf3Cliente($cliente);
		$usuario['Web'] = $this->modelCliente->WebCliente($cliente);
		$usuario['Departamento'] = $this->modelCliente->DepartamentoCliente($cliente);
			
		$usuario['Twitter'] = $this->modelCliente->TwitterCliente($cliente);
		$usuario['Facebook'] = $this->modelCliente->FacebookCliente($cliente);
		$usuario['Google'] = $this->modelCliente->GoogleplusCliente($cliente);
			
		$usuario['Direccion1'] = $this->modelCliente->DireccionCliente($cliente);
		$usuario['Direccion2'] = $this->modelCliente->Direccion2Cliente($cliente);
		$usuario['Direccion3'] = $this->modelCliente->Direccion3Cliente($cliente);
		
		$this->load->view('Vendedor/Cliente/VVerPerfilCliente', $usuario);
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
		
		$usuario['Institucion'] = $this->modelInstitucion->BuscarInstituciones();
			
		$this->load->view('Vendedor/Cliente/VVerPerfilCliente', $usuario);
	}
	
	// Funcion que nos devuelve a la pantalla en donde esta la lista de clientes
	// de un usuario en el sistema.
	public function atras_index() 
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario;
		$usuario['Clientes'] = $this->modelNegociacion->BuscarClientes();
		$this->load->view('Vendedor/Cliente/VVerCliente', $usuario);		
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
			$this->table->add_row($nombre, $apellido, $email, $telefono, anchor('Control_Cliente/ver_perfil_2/'.$id.'','Ver Detalle'));
		}
			
		$usuario['table'] = $this->table->generate();
		
		$this->load->view('Vendedor/Cliente/VBusquedaCliente', $usuario);
	}
	
	// Funcion que me busca clientes en el sistema de el vendedor que yo desee
	public function buscar_vendedores() 
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario; 
		$usuario['Vendedores'] = $this->modelCliente->Vendedores();
		$usuario['Clientes'] = $this->modelCliente->BuscarClientesTodos();
		
		$this->load->view('Administrador/ACliente', $usuario);
	}

	public function buscar_vendedores_I()
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario;
		$usuario['Vendedores'] = $this->modelCliente->Vendedores();
		
		$this->load->view('Administrador/AInstitucion', $usuario);
	}
	
	// Funcion que me trae la lista de los cliente de un empleado en particular
	// solo personas.
	public function ver_clientes() 
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario; 
		$Vendedor = $_POST['Vendedor'];
		$usuario['Vendedor'] = $Vendedor; 
		
		$Lista = $this->modelCliente->BuscarClientes($Vendedor);
		
		$this->load->library('table');
		$this->table->set_empty("&nbsp;");
		$this->table->set_heading('<font style="font-size:12px" color="#369"><b>Cedula</b></font>', '<font style="font-size:12px" color="#369"><b>Nombre</b></font>', '<font style="font-size:12px" color="#369"><b>Apellido</b></font>', '<font style="font-size:12px" color="#369"><b>Email</b></font>');
		
	
		foreach ($Lista as $row)
		{
			$cedula = $row['Cedula'];
			$nombre = $row['Nombre']; 
			$apellido = $row['Apellido']; 
			$email = $row['Email'];
			$this->table->add_row($cedula, $nombre, $apellido, $email, anchor('Control_Cliente/ver_detalle/'.$cedula.'/'.$Vendedor.'','Ver Detalle'));
		}
			
		$usuario['table'] = $this->table->generate();
		
		$this->load->view('Administrador/AListaClientes', $usuario);
	}
	
	// Funcion que me trae la lista de los cliente de un empleado en particular
	// en este caso todos sin exclucion.
	public function ver_clientes_lista() 
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario; 
		$Lista = $this->modelCliente->BuscarClientesTodos();
		
		$this->load->library('table');
		$this->table->set_empty("&nbsp;");
		$this->table->set_heading('<font style="font-size:12px" color="#369"><b>Cedula</b></font>', '<font style="font-size:12px" color="#369"><b>Nombre</b></font>', '<font style="font-size:12px" color="#369"><b>Apellido</b></font>', '<font style="font-size:12px" color="#369"><b>Email</b></font>');
		
	
		foreach ($Lista as $row)
		{
			$cedula = $row['Cedula'];
			$nombre = $row['Nombre'];
			$apellido = $row['Apellido'];
			$email = $row['Email'];
			$this->table->add_row($cedula, $nombre, $apellido, $email, anchor('Control_Cliente/ver_detalle2/'.$cedula.'','Ver Detalle'));
		}
			
		$usuario['table'] = $this->table->generate();
		
		$this->load->view('Administrador/AListaClientesTodos', $usuario);
	}
	
	// Funcion que me trae la lista de las instituciones de un empleado en particular
	// solo instituciones.
	public function ver_institucion() 
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario; 
		$Vendedor = $_POST['Vendedor'];
		$Lista = $this->modelCliente->BuscarInstitucion($Vendedor);
		
		$this->load->library('table');
		$this->table->set_empty("&nbsp;");
		$this->table->set_heading('<font style="font-size:12px" color="#369"><b>R.I.F</b></font>', '<font style="font-size:12px" color="#369"><b>Nombre</b></font>', '<font style="font-size:12px" color="#369"><b>Web</b></font>', '<font style="font-size:12px" color="#369"><b>Telefono</b></font>');
		
	
		foreach ($Lista as $row)
		{
			$rif = $row['Rif'];
			$nombre = $row['Nombre'];
			$web = $row['Web'];
			$telefono = $row['Telefono1'];
			$this->table->add_row($rif, $nombre, $web, $telefono);
		}
			
		$usuario['table'] = $this->table->generate();
		
		$this->load->view('Administrador/AListaInstitucion', $usuario);
	}
	
	// Funcion que me trae la lista de las instituciones de un empleado en particular
	// en este caso todos sin exclucion.
	public function ver_institucion_lista() 
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario; 
		$Lista = $this->modelCliente->BuscarInstitucionTodos();
		
		$this->load->library('table');
		$this->table->set_empty("&nbsp;");
		$this->table->set_heading('<font style="font-size:12px" color="#369"><b>R.I.F</b></font>', '<font style="font-size:12px" color="#369"><b>Nombre</b></font>', '<font style="font-size:12px" color="#369"><b>Web</b></font>', '<font style="font-size:12px" color="#369"><b>Telefono</b></font>');
		
	
		foreach ($Lista as $row)
		{
			$rif = $row['Rif'];
			$nombre = $row['Nombre'];
			$web = $row['Web'];
			$telefono = $row['Telefono1'];
			$this->table->add_row($rif, $nombre, $web, $telefono);
		}
			
		$usuario['table'] = $this->table->generate();
		
		$this->load->view('Administrador/AListaInstitucionTodos', $usuario);
	}
	
	// Funcion que me busca clientes en el sistema de el vendedor que yo desee
	public function ver_detalle($id, $Vendedor) 
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario; 
		$usuario['Vendedor'] = $Vendedor; 
		$usuario['Datos'] = $this->modelCliente->DetalleCliente($id);
		
		$this->load->view('Administrador/ADetalleCliente', $usuario);
	}
	
	public function ver_detalle3() 
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario; 
		$id = $_POST['Vendedor'];
		$usuario['Datos'] = $this->modelCliente->DetalleCliente($id);
		
		$this->load->view('Administrador/ADetalleCliente3', $usuario);
	}
	
	public function ver_detalle2($id) 
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario; 
		$usuario['Datos'] = $this->modelCliente->DetalleCliente($id);
		
		$this->load->view('Administrador/ADetalleCliente2', $usuario);
	}
	
	public function vinculaciones($id_cliente)
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario;
		$usuario['Cliente'] = $id_cliente;
		
		$usuario['Institucion'] = $this->modelInstitucion->BuscarInstituciones();
			
		$this->load->view('Vendedor/Cliente/VVinculacion', $usuario);
	}
	
	public function vinculaciones2()
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario;
		$usuario['Cliente'] = $_POST['Cliente'];
		
		if(isset($_POST['checkbox']))
		{
			$usuario2 = $Usuario;
			$EIC['Id_Empleado'] = $this->modelCliente->BuscarId($usuario2);
			$EIC['Id_Institucion'] = $_POST['Instituto'];
			$EIC['Id_Cliente'] = $_POST['Cliente'];
			$this->modelCliente->InsertarAgenda($EIC);
		}
			
		if(isset($_POST['checkbox2']))
		{
			$usuario3 = $Usuario;
			$EIC2['Id_Empleado'] = $this->modelCliente->BuscarId($usuario3);
			$EIC2['Id_Institucion'] = $_POST['Instituto2'];
			$EIC2['Id_Cliente'] = $_POST['Cliente'];
			$this->modelCliente->InsertarAgenda2($EIC2);
		}
		
		$usuario['Mensaje'] = 'Se vinculo al cliente con &eacute;xito!';
		
		$usuario['Institucion'] = $this->modelInstitucion->BuscarInstituciones();
			
		$this->load->view('Vendedor/Cliente/VVinculacion', $usuario);
	}
}
