<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Control_Producto extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('modelProducto');
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	// Funcion que se encarga de abrir la pantalla por primera vez
	// de carga de marcas.
	public function index()
	{
		$Lista = $this->modelProducto->ConsultarMarcas();
		
		$this->load->library('table');
		$this->table->set_empty("&nbsp;");
		$this->table->set_heading('<font style="font-size:12px" color="#369"><b>Codigo</b></font>', '<font style="font-size:12px" color="#369"><b>Marca</b></font>');
	
		foreach ($Lista as $row)
		{
			$id = $row['Id_Marca'];
			$nombre = $row['Nombre'];
			$this->table->add_row($id, $nombre);
		}
			
		$usuario['table'] = $this->table->generate();

		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario;
		$this->load->view('Administrador/Producto/Producto', $usuario);
	}	
	
	// Funcion que nos abre la pantalla para la carga de lineas nuevas 
	// en el sistema.
	public function index2()
	{
		$Lista = $this->modelProducto->ConsultarLineas();
		
		$this->load->library('table');
		$this->table->set_empty("&nbsp;");
		$this->table->set_heading('<font style="font-size:12px" color="#369"><b>Codigo</b></font>', '<font style="font-size:12px" color="#369"><b>Marca</b></font>', '<font style="font-size:12px" color="#369"><b>Linea</b></font>');
	
		foreach ($Lista as $row)
		{
			$id = $row['Id_Linea'];
			$marca = $row['Marca'];
			$linea = $row['Linea'];
			$this->table->add_row($id, $marca, $linea);
		}
			
		$usuario['table'] = $this->table->generate();
		
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario;
		
		$this->load->view('Administrador/Producto/ConsultarLinea', $usuario);
	}	
	
	// Funcion que nos abre la pantalla para la carga de equipos nuevos 
	// en el sistema.
	public function index3()
	{
		$Lista = $this->modelProducto->ConsultarEquipos();
		
		$this->load->library('table');
		$this->table->set_empty("&nbsp;");
		$this->table->set_heading('<font style="font-size:12px" color="#369"><b>Codigo</b></font>', '<font style="font-size:12px" color="#369"><b>Marca</b></font>', '<font style="font-size:12px" color="#369"><b>Equipo</b></font>', '<font style="font-size:12px" color="#369"><b>Precio Bs.F</b></font>');
	
		foreach ($Lista as $row)
		{
			$id = $row['Id_Equipo'];
			$marca = $row['Marca'];
			$equipo = $row['Equipo'];
			$precio = $row['Precio'];
			$this->table->add_row($id, $marca, $equipo, $precio, anchor('Control_Producto/modificar_equipo/'.$id.'','Ver Detalle'));
		}
			
		$usuario['table'] = $this->table->generate();
		
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario;
		
		$this->load->view('Administrador/Producto/ConsultarEquipo', $usuario);
	}	
	
	// Funcion que nos carga la pantalla en donde agregamos accesorios nuevos
	// al sistema.
	public function index4()
	{
		$Lista = $this->modelProducto->ConsultarAcce();
		
		$this->load->library('table');
		$this->table->set_empty("&nbsp;");
		$this->table->set_heading('<font style="font-size:12px" color="#369"><b>Codigo</b></font>', '<font style="font-size:12px" color="#369"><b>Equipo</b></font>', '<font style="font-size:12px" color="#369"><b>Accesorio</b></font>', '<font style="font-size:12px" color="#369"><b>Precio Bs.F</b></font>');
	
		foreach ($Lista as $row)
		{
			$id = $row['Id_Accesorio'];
			$equipo = $row['Equipo'];
			$accesorio = $row['Accesorio'];
			$precio = $row['Precio'];
			$this->table->add_row($id, $equipo, $accesorio, $precio, anchor('Control_Producto/modificar_accesorio/'.$id.'','Ver Detalle'));
		}
			
		$usuario['table'] = $this->table->generate();
		
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario;
		
		$this->load->view('Administrador/Producto/ConsultarAccesorio', $usuario);
	}
	
	// Funcion que nos permite modificar el nombre o precio de un equipo dentro del sistema.
	public function modificar_equipo($id)
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario;
		$usuario['Equipo'] = $id;
		$usuario['Datos'] = $this->modelProducto->BuscarDatosEquipo($id);
		$this->load->view('Administrador/Producto/ModPrecioEquipo', $usuario);
	}	
	
	public function modificar_equipo2()
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario;
		$id = $_POST['Codigo'];
		
		$datos['ID2'] = $id;
		$equipo = new ModelProducto;
		$this->modelProducto->CambiarDatosEquipo($equipo, $datos);
		
		$usuario['Datos'] = $this->modelProducto->BuscarDatosEquipo($id);
		
		$usuario['Mensaje'] = 'Se modificaron los datos del equipo con &eacute;xito!';
		
		$this->load->view('Administrador/Producto/ModPrecioEquipo', $usuario);
	}
	
	// Funcion que nos permite modificar el nombre o precio de un accesorio dentro del sistema.
	public function modificar_accesorio($id)
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario;
		$usuario['accesorio'] = $id;
		$usuario['Datos'] = $this->modelProducto->BuscarDatosAccesorio($id);
		$this->load->view('Administrador/Producto/ModPrecioAccesorio', $usuario);
	}	
	
	public function modificar_accesorio2()
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario;
		$id = $_POST['Codigo'];
		
		$datos['ID2'] = $id;
		$accesorio = new ModelProducto;
		$this->modelProducto->CambiarDatosAccesorio($accesorio, $datos);
		
		$usuario['Datos'] = $this->modelProducto->BuscarDatosAccesorio($id);
		
		$usuario['Mensaje'] = 'Se modificaron los datos del accesorio con &eacute;xito!';
		
		$this->load->view('Administrador/Producto/ModPrecioAccesorio', $usuario);
	}
	
	// Funcion que nos permite agregar marcas nuevas y relaciones entre ellas.
	public function nueva_marca()
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario;
		$this->load->view('Administrador/Producto/Marca', $usuario);
	}	
	
	// Funcion que nos permite agregar lineas nuevas y relaciones entre ellas.
	public function nueva_linea()
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario;
		$usuario['Marca'] = $this->modelProducto->ConsultarMarcas();
		$usuario['Lista'] = $this->modelProducto->ConsultarLinea();
		$this->load->view('Administrador/Producto/Linea', $usuario);
	}	
	
	// Funcion que nos permite agregar equipos nuevos y relaciones entre ellas.
	public function nuevo_equipo()
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario;
		$usuario['Marca'] = $this->modelProducto->ConsultarMarcas();
		$usuario['Equipo'] = $this->modelProducto->ConsultarEquipo();
		$this->load->view('Administrador/Producto/Equipo', $usuario);
	}
	
	// Funcion que nos permite agregar accesorios nuevos y relaciones 
	// entre ellas.
	public function nuevo_accesorio()
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario;
		$usuario['Equipo'] = $this->modelProducto->ConsultarEquipo();
		$usuario['Accesorio'] = $this->modelProducto->ConsultarA();
		$this->load->view('Administrador/Producto/Accesorio', $usuario);
	}
	
	// Funcion que toma los datos de un accesorio y lo creo.
	public function crear_accesorio()
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario;
		$Accesorio['Nombre'] = $_POST['Accesorio'];
		$Accesorio['Precio'] = $_POST['Precio'];
		$Accesorio['Descripcion'] = $_POST['Descripcion'];
		$this->modelProducto->InsertarAccesorio($Accesorio);
		
		$AE['Id_Equipo'] = $_POST['Equipo'];
		$AE['Id_Accesorio'] = $this->modelProducto->UltimoAccesorio();
		$this->modelProducto->InsertarAE($AE);
		
		$usuario['Equipo'] = $this->modelProducto->ConsultarEquipo();
		$usuario['Accesorio'] = $this->modelProducto->ConsultarA();
		$usuario['Mensaje'] = 'Se agrego el nuevo Accesorio con &eacute;xito!';
		
		$this->load->view('Administrador/Producto/Accesorio', $usuario);
	}	
	
	public function crear_accesorio_2()
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario;
		$AE['Id_Equipo'] = $_POST['Equipo'];
		$AE['Id_Accesorio'] = $_POST['Accesorio'];
		$this->modelProducto->InsertarAE($AE);
		
		$usuario['Equipo'] = $this->modelProducto->ConsultarEquipo();
		$usuario['Accesorio'] = $this->modelProducto->ConsultarA();
		$usuario['Mensaje2'] = 'Se agrego la nueva relaci&oacute;n con &eacute;xito!';
		
		$this->load->view('Administrador/Producto/Accesorio', $usuario);
	}	
	
	// Funcion que toma los datos de una marca y la crea.
	public function crear_marca()
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario;
		$Marca['Nombre'] = $_POST['Marca'];
		$this->modelProducto->InsertarMarca($Marca);
		
		$usuario['Mensaje'] = 'Se agrego la nueva marca con &eacute;xito!';
		
		$this->load->view('Administrador/Producto/Marca', $usuario);
	}	
	
	// Funcion que toma los datos de una linea y la crea.
	public function crear_linea()
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario;
		$Linea['Nombre'] = $_POST['Linea'];
		$this->modelProducto->InsertarLinea($Linea);
		
		$MarcaLinea['Id_Marca'] = $_POST['Marca'];
		$MarcaLinea['Id_Linea'] = $this->modelProducto->UltimaLinea();
		$this->modelProducto->InsertarMarcaLinea($MarcaLinea);
		
		$usuario['Mensaje'] = 'Se agrego la nueva linea con &eacute;xito!';
		
		$usuario['Marca'] = $this->modelProducto->ConsultarMarcas();
		$usuario['Lista'] = $this->modelProducto->ConsultarLinea();
		
		$this->load->view('Administrador/Producto/Linea', $usuario);
	}	
	
	public function crear_linea_2()
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario;
		$MarcaLinea['Id_Marca'] = $_POST['Marca'];
		$MarcaLinea['Id_Linea'] = $_POST['Linea'];
		$this->modelProducto->InsertarMarcaLinea($MarcaLinea);
		
		$usuario['Mensaje2'] = 'Se agrego la nueva relaci&oacute;n con &eacute;xito!';
		
		$usuario['Marca'] = $this->modelProducto->ConsultarMarcas();
		$usuario['Lista'] = $this->modelProducto->ConsultarLinea();
		
		$this->load->view('Administrador/Producto/Linea', $usuario);
	}	
	
	// Funcion que tomas los datos de un equipo y lo crea.
	public function crear_equipo()
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario;
		$Equipo['Nombre'] = $_POST['Equipo'];
		$Equipo['Precio'] = $_POST['Precio'];
		$Equipo['Descripcion'] = $_POST['Descripcion'];
		$this->modelProducto->InsertarEquipo($Equipo);
		
		$MLE['Id_Equipo'] = $this->modelProducto->UltimoEquipo();
		$MLE['Id_Marca_Linea'] = $_POST['account'];
		$this->modelProducto->InsertarMLE($MLE);
		
		$usuario['Mensaje'] = 'Se agrego el nuevo equipo con &eacute;xito!';
		
		$usuario['Marca'] = $this->modelProducto->ConsultarMarcas();
		$usuario['Equipo'] = $this->modelProducto->ConsultarEquipo();
		
		$this->load->view('Administrador/Producto/Equipo', $usuario);
	}	
	
	public function crear_equipo_2()
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario;
		$MLE['Id_Equipo'] = $_POST['Equipo'];
		$MLE['Id_Marca_Linea'] = $_POST['account2'];
		$this->modelProducto->InsertarMLE($MLE);
		
		$usuario['Mensaje2'] = 'Se agrego la nueva relaci&oacute;n con &eacute;xito!';
		
		$this->load->view('Administrador/Producto/Equipo', $usuario);
	}
	
	// Funcion que activas los combos dependientes.
	public function ajax_marca_linea() 
	{
		$Usuario = $this->session->userdata('Usuario');
		$id = $this->uri->rsegment(3);
		$accounts_list = $this->modelProducto->ConsultarMarcaLinea($id);
		$result = '<option value=" ">Seleccione una linea</option>';
		foreach($accounts_list as $account)
		{
			$result .= '<option value="'.$account['Id_Marca_Linea'].'">'.$account['Nombre'].'</option>';
		}
		echo $result;
	}

}

