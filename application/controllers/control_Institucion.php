<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Control_Institucion extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('modelInstitucion');
		$this->load->model('modelCliente');
		$this->load->model('modelNegociacion');
		$this->load->helper('form');
	}
	
	// Funcion que me permite consultar todas las instituciones.
	public function index()
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario;
		$usuario['Institucion'] = $this->modelNegociacion->BuscarInstitucion();
		$usuario['Instituciones2'] = $this->modelCliente->BuscarInstituciones();
		
		$this->load->view('Vendedor/Institucion/VVerInstitucion', $usuario);
	}
	
	// Funcion que me lleva a la pantalla en donde introduzco los datos
	// de una institucion para ser creada por por primera vez en mi sistema.
	public function agregar_institucion()
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario;
		$usuario['Pais'] = $this->modelInstitucion->BuscarPais();
		$this->load->view('Vendedor/Institucion/VInstitucion', $usuario);
	}
	
	// Funcion que se encarga de obtener los datos que fueron introducidos 
	// por el usuario para poder agregar una institucion nueva al sistema.
	public function crear_institucion() 
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario;
		
		##  DATOS CLIENTE ##
		$Institucion['Tipo_I'] = $_POST['select'];
		$Institucion['Nombre'] = $_POST['Nombre'];
		$Institucion['Pais'] = $_POST['subgroup'];
		$Institucion['Estado'] = $_POST['account'];
		$Institucion['Ciudad'] = $_POST['equipo'];
		$Institucion['CodigoP'] = $_POST['CPostal'];
		$letra = $_POST['Letra'];
		$Institucion['Rif'] = $letra.'-'.$_POST['Rif'];
		$datos['Web'] = $_POST['Web'];
		$Institucion['Telefono1'] = $_POST['Telefono'];
		$Institucion['Telefono2'] = $_POST['Telefono2'];
		$Institucion['Telefono3'] = $_POST['Telefono3'];
		
		##  DATOS DE REDES SOCIALES ##
		$Institucion['Twitter'] = $_POST['Twitter'];
		$Institucion['Facebook'] = $_POST['Facebook'];
		$Institucion['GooglePlus'] = $_POST['GoogleP'];
		
		##  DATOS DE LAS DIRECCIONES PERSONALES ##
		$Institucion['Direccion1'] = $_POST['Direccion'];
		$Institucion['Direccion2'] = $_POST['Direccion2'];
		$Institucion['Direccion3'] = $_POST['Direccion3'];
		
		$this->modelInstitucion->InsertarInstitucion($Institucion);
		
		$usuario['Mensaje'] = 'Se agrego la instituci&oacute;n con &eacute;xito!';
		
		$usuario['Pais'] = $this->modelInstitucion->BuscarPais();
		
		$this->load->view('Vendedor/Institucion/VInstitucion', $usuario);
	}
	
	// Funcion que nos permite ver el perfil de una institucion que a sido creada 
	public function ver_perfil()
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario;
		$id_cliente = $_POST['Cliente'];
		$usuario['id_cliente'] = $id_cliente;
		$usuario['Nombre'] = $this->modelInstitucion->BuscarNombreI($id_cliente);
		$usuario['CodigoP'] = $this->modelInstitucion->BuscarCodigoPI($id_cliente);
		$usuario['Web'] = $this->modelInstitucion->BuscarWebI($id_cliente);
		$usuario['Telefono1'] = $this->modelInstitucion->BuscarTelf1I($id_cliente);
		$usuario['Telefono2'] = $this->modelInstitucion->BuscarTelf2I($id_cliente);
		$usuario['Telefono3'] = $this->modelInstitucion->BuscarTelf3I($id_cliente);
		
		$usuario['Twitter'] = $this->modelInstitucion->BuscarTwitterI($id_cliente);
		$usuario['Facebook'] = $this->modelInstitucion->BuscarFacebookI($id_cliente);
		$usuario['GoogleP'] = $this->modelInstitucion->BuscarGooglePlusI($id_cliente);
		
		$usuario['Direccion1'] = $this->modelInstitucion->BuscarDireccion1I($id_cliente);
		$usuario['Direccion2'] = $this->modelInstitucion->BuscarDireccion2I($id_cliente);
		$usuario['Direccion3'] = $this->modelInstitucion->BuscarDireccion3I($id_cliente);
	
		$this->load->view('Vendedor/Institucion/VVerPerfilInstitucion', $usuario);
	}
	
	// Funcion que nos permite modificar los datos de una institucion.
	public function modificar_perfil()
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario;
		$id_cliente = $_POST['Cliente'];
		
		$datos['ID2'] = $id_cliente;
		$institucion = new ModelInstitucion;
		$this->modelInstitucion->ModificarCliente($institucion, $datos);
		
		$usuario['id_cliente'] = $id_cliente;
		$usuario['Nombre'] = $this->modelInstitucion->BuscarNombreI($id_cliente);
		$usuario['CodigoP'] = $this->modelInstitucion->BuscarCodigoPI($id_cliente);
		$usuario['Web'] = $this->modelInstitucion->BuscarWebI($id_cliente);
		$usuario['Telefono1'] = $this->modelInstitucion->BuscarTelf1I($id_cliente);
		$usuario['Telefono2'] = $this->modelInstitucion->BuscarTelf2I($id_cliente);
		$usuario['Telefono3'] = $this->modelInstitucion->BuscarTelf3I($id_cliente);
		
		$usuario['Twitter'] = $this->modelInstitucion->BuscarTwitterI($id_cliente);
		$usuario['Facebook'] = $this->modelInstitucion->BuscarFacebookI($id_cliente);
		$usuario['GoogleP'] = $this->modelInstitucion->BuscarGooglePlusI($id_cliente);
		
		$usuario['Direccion1'] = $this->modelInstitucion->BuscarDireccion1I($id_cliente);
		$usuario['Direccion2'] = $this->modelInstitucion->BuscarDireccion2I($id_cliente);
		$usuario['Direccion3'] = $this->modelInstitucion->BuscarDireccion3I($id_cliente);
		
		$usuario['Mensaje'] = 'Se modificaron los datos de la instituci&oacute;n con &eacute;xito!';
		
		$this->load->view('Vendedor/Institucion/VVerPerfilInstitucion', $usuario);
	}
	
	// Funcion que nos devuelve a la pagina principal de la busqueda
	// de instituciones.
	public function atras_index() 
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario;
		$usuario['Institucion'] = $this->modelNegociacion->BuscarInstitucion();
		$usuario['Instituciones2'] = $this->modelCliente->BuscarInstituciones();
		
		$this->load->view('Vendedor/Institucion/VVerInstitucion', $usuario);
	}
	
	// Funcion que se usan para activar los combobox de pais, estado y ciudad.
	public function ajax_get_accounts() 
	{
		$id = $this->uri->rsegment(3);
		$idpais = $this->modelInstitucion->IdPais($id);
		$accounts_list = $this->modelInstitucion->BuscarEstado($idpais);
		$result = '<option value=" ">- Selecciona -</option>';
		foreach($accounts_list as $account)
		{
			$result .= '<option value="'.$account['Nombre'].'">'.$account['Nombre'].'</option>';
		}
		echo $result;
	}
	
	public function ajax_get_accounts2() 
	{
		$id = $this->uri->rsegment(3);
		$idestado = $this->modelInstitucion->IdEstado($id);
		$accounts_list = $this->modelInstitucion->BuscarCiudad($idestado);
		$result2 = '<option value=" ">- Selecciona -</option>';
		foreach($accounts_list as $equipo)
		{
			$result2 .= '<option value="'.$equipo['Nombre'].'">'.$equipo['Nombre'].'</option>';
		}
		echo $result2;
	}
}

