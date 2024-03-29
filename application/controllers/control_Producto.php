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
		$usuario['Equipos'] = $this->modelProducto->ConsultarEquipos();
		
		$this->load->library('table');
		$this->table->set_empty("&nbsp;");
		$this->table->set_heading('<font style="font-size:12px" color="#369"><b>Codigo</b></font>', '<font style="font-size:12px" color="#369"><b>Marca</b></font>', '<font style="font-size:12px" color="#369"><b>Equipo</b></font>', '<font style="font-size:12px" color="#369"><b>Precio Bs.F</b></font>');
	
		foreach ($Lista as $row)
		{
			$id2 = $row['Id_Equipo'];
			$id = $row['Codigo'];
			$marca = $row['Marca'];
			$equipo = $row['Equipo'];
			$precio = $row['Precio'];
			$this->table->add_row($id, $marca, $equipo, $precio, anchor('Control_Producto/modificar_equipo/'.$id2.'','Ver Detalle'));
		}
			
		$usuario['table'] = $this->table->generate();
		
		
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario;
		$usuario['Codigo'] = $id;
		$usuario['Marca'] = $marca;
		
		$this->load->view('Administrador/Producto/ConsultarEquipo', $usuario);
	}	
	
	// Funcion que nos carga la pantalla en donde agregamos accesorios nuevos
	// al sistema.
	public function index4()
	{
		$Lista = $this->modelProducto->ConsultarAcce();
		$usuario['Equipos'] = $this->modelProducto->ConsultarAcce();
		
		$this->load->library('table');
		$this->table->set_empty("&nbsp;");
		$this->table->set_heading('<font style="font-size:12px" color="#369"><b>Codigo</b></font>', '<font style="font-size:12px" color="#369"><b>Equipo</b></font>', '<font style="font-size:12px" color="#369"><b>Accesorio</b></font>', '<font style="font-size:12px" color="#369"><b>Precio Bs.F</b></font>');
	
		foreach ($Lista as $row)
		{
			$id2 = $row['Id_Accesorio'];
			$id = $row['Codigo'];
			$equipo = $row['Equipo'];
			$accesorio = $row['Accesorio'];
			$precio = $row['Precio'];
			$this->table->add_row($id, $equipo, $accesorio, $precio, anchor('Control_Producto/modificar_accesorio/'.$id2.'','Ver Detalle'));
		}
			
		$usuario['table'] = $this->table->generate();
		
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario;
		
		$this->load->view('Administrador/Producto/ConsultarAccesorio', $usuario);
	}
	
	public function index5()
	{
		$Lista = $this->modelProducto->DConsultarAcce();
		$usuario['Equipos'] = $this->modelProducto->DConsultarAcce();
		
		$this->load->library('table');
		$this->table->set_empty("&nbsp;");
		$this->table->set_heading('<font style="font-size:12px" color="#369"><b>Codigo</b></font>','<font style="font-size:12px" color="#369"><b>Accesorio</b></font>', '<font style="font-size:12px" color="#369"><b>Precio Bs.F</b></font>');
	
		foreach ($Lista as $row)
		{
			$id2 = $row['Id_Accesorio'];
			$id = $row['Codigo'];
			$accesorio = $row['Accesorio'];
			$precio = $row['Precio'];
			$this->table->add_row($id, $accesorio, $precio, anchor('Control_Producto/dmodificar_accesorio/'.$id2.'','Ver Detalle'));
		}
			
		$usuario['table'] = $this->table->generate();
		
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario;
		
		$this->load->view('Despachador/Producto/DConsultarAccesorio', $usuario);
	}
	
	public function buscar_accesorio()
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario;
		$usuario['accesorio'] = $_POST['Vendedor'];
		$codigoA = $_POST['Vendedor'];
		$id = $this->modelProducto->BuscarIdAccesorio($codigoA);
		if($id == FALSE)
		{
			$Lista = $this->modelProducto->ConsultarAcce();
		
			$this->load->library('table');
			$this->table->set_empty("&nbsp;");
			$this->table->set_heading('<font style="font-size:12px" color="#369"><b>Codigo</b></font>', '<font style="font-size:12px" color="#369"><b>Equipo</b></font>', '<font style="font-size:12px" color="#369"><b>Accesorio</b></font>', '<font style="font-size:12px" color="#369"><b>Precio Bs.F</b></font>');
		
			foreach ($Lista as $row)
			{
				$id2 = $row['Id_Accesorio'];
				$id = $row['Codigo'];
				$equipo = $row['Equipo'];
				$accesorio = $row['Accesorio'];
				$precio = $row['Precio'];
				$this->table->add_row($id, $equipo, $accesorio, $precio, anchor('Control_Producto/modificar_accesorio/'.$id2.'','Ver Detalle'));
			}
				
			$usuario['table'] = $this->table->generate();
			$usuario['Mensaje'] = "El codigo no existe!";
			
			$this->load->view('Administrador/Producto/ConsultarAccesorio', $usuario);
		}
		else
		{
			$usuario['Datos'] = $this->modelProducto->BuscarDatosAccesorio2($codigoA);
			$this->load->view('Administrador/Producto/ModPrecioAccesorio', $usuario);
		}
	}
	
	public function dbuscar_accesorio()
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario;
		$usuario['Equipos'] = $this->modelProducto->DConsultarAcce();
		$usuario['accesorio'] = $_POST['Vendedor'];
		$codigoA = $_POST['Vendedor'];
		$id = $this->modelProducto->BuscarIdAccesorio($codigoA);
		if($id == FALSE)
		{
			$Lista = $this->modelProducto->DConsultarAcce();
		
			$this->load->library('table');
			$this->table->set_empty("&nbsp;");
			$this->table->set_heading('<font style="font-size:12px" color="#369"><b>Codigo</b></font>','<font style="font-size:12px" color="#369"><b>Accesorio</b></font>', '<font style="font-size:12px" color="#369"><b>Precio Bs.F</b></font>');
		
			foreach ($Lista as $row)
			{
				$id2 = $row['Id_Accesorio'];
				$id = $row['Codigo'];
				$accesorio = $row['Accesorio'];
				$precio = $row['Precio'];
				$this->table->add_row($id, $accesorio, $precio, anchor('Control_Producto/dmodificar_accesorio/'.$id2.'','Ver Detalle'));
			}
				
			$usuario['table'] = $this->table->generate();
			$usuario['Mensaje'] = "El codigo no existe!";
			
			$this->load->view('Despachador/Producto/DConsultarAccesorio', $usuario);
		}
		else
		{
			$usuario['Datos'] = $this->modelProducto->BuscarDatosAccesorio2($codigoA);
			$this->load->view('Despachador/Producto/DModPrecioAccesorio', $usuario);
		}
	}
	
	public function buscar_equipo()
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario;
		$usuario['Equipo'] = $_POST['Vendedor'];
		$codigoE = $_POST['Vendedor'];
		$id = $this->modelProducto->BuscarIdEquipo($codigoE);
		if($id == FALSE)
		{
			$Lista = $this->modelProducto->ConsultarEquipos();
		
			$this->load->library('table');
			$this->table->set_empty("&nbsp;");
			$this->table->set_heading('<font style="font-size:12px" color="#369"><b>Codigo</b></font>', '<font style="font-size:12px" color="#369"><b>Marca</b></font>', '<font style="font-size:12px" color="#369"><b>Equipo</b></font>', '<font style="font-size:12px" color="#369"><b>Precio Bs.F</b></font>');
		
			foreach ($Lista as $row)
			{
				$id2 = $row['Id_Equipo'];
				$id = $row['Codigo'];
				$marca = $row['Marca'];
				$equipo = $row['Equipo'];
				$precio = $row['Precio'];
				$this->table->add_row($id, $marca, $equipo, $precio, anchor('Control_Producto/modificar_equipo/'.$id2.'','Ver Detalle'));
			}
				
			$usuario['table'] = $this->table->generate();
			$usuario['Mensaje'] = "El codigo no existe!";
			
			$this->load->view('Administrador/Producto/ConsultarEquipo', $usuario);
		}
		else
		{
		$usuario['Datos'] = $this->modelProducto->BuscarDatosEquipo2($codigoE);
		$this->load->view('Administrador/Producto/ModPrecioEquipo', $usuario);
		}
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
		$id = $_POST['CBD'];
		$id2 = $_POST['CBD'];
		
		// Modifica en el maestro de productos //
		$datos['ID2'] = $id;
		$equipo['Codigo'] = $_POST['Codigo'];
		$equipo['Nombre'] = $_POST['Nombre'];
		$equipo['Precio'] = $_POST['Precio'];
		$equipo['Descripcion'] = $_POST['Descripcion'];
		$equipo['Descripcion2'] = $_POST['Descripcion2'];
		$this->modelProducto->CambiarDatosEquipo($equipo, $datos);
		
		// Modifica en el historial de productos que se venden //
		$datos2['ID2'] = $id2;
		$equipo2['Codigo'] = $_POST['Codigo'];
		$equipo2['Nombre'] = $_POST['Nombre'];
		$equipo2['Descripcion'] = $_POST['Descripcion2'];
		$this->modelProducto->CambiarDatosEquipo2($equipo2, $datos2);
		
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
	
	// Funcion que nos permite modificar el nombre o precio de un accesorio dentro del sistema.
	public function dmodificar_accesorio($id)
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario;
		$usuario['accesorio'] = $id;
		$usuario['Datos'] = $this->modelProducto->BuscarDatosAccesorio($id);
		$this->load->view('Despachador/Producto/DModPrecioAccesorio', $usuario);
	}
	
	public function modificar_accesorio2()
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario;
		$id = $_POST['CBD'];
		$id2 = $_POST['CBD'];
		
		// Modifica en el historial de productos que se venden //
		$datos['ID2'] = $id;
		$accesorio['Codigo'] = $_POST['Codigo'];
		$accesorio['Nombre'] = $_POST['Nombre'];
		$accesorio['Precio'] = $_POST['Precio'];
		$accesorio['Descripcion'] = $_POST['Descripcion'];
		$accesorio['Descripcion2'] = $_POST['Descripcion2'];
		$this->modelProducto->CambiarDatosAccesorio($accesorio, $datos);
		
		// Modifica en el historial de productos que se venden //
		$datos2['ID2'] = $id2;
		$accesorio2['Codigo'] = $_POST['Codigo'];
		$accesorio2['Nombre'] = $_POST['Nombre'];
		$accesorio2['Descripcion'] = $_POST['Descripcion2'];
		$this->modelProducto->CambiarDatosAccesorio2($accesorio2, $datos2);
		
		$usuario['Datos'] = $this->modelProducto->BuscarDatosAccesorio($id);
		$usuario['Mensaje'] = 'Se modificaron los datos del accesorio con &eacute;xito!';
		
		$this->load->view('Administrador/Producto/ModPrecioAccesorio', $usuario);
	}
	
	public function dmodificar_accesorio2()
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario;
		$id = $_POST['CBD'];
		$id2 = $_POST['CBD'];
		
		// Modifica en el historial de productos que se venden //
		$datos['ID2'] = $id;
		$accesorio['Codigo'] = $_POST['Codigo'];
		$accesorio['Nombre'] = $_POST['Nombre'];
		$accesorio['Precio'] = $_POST['Precio'];
		$accesorio['Descripcion'] = $_POST['Descripcion'];
		$accesorio['Descripcion2'] = $_POST['Descripcion2'];
		$this->modelProducto->CambiarDatosAccesorio($accesorio, $datos);
		
		// Modifica en el historial de productos que se venden //
		$datos2['ID2'] = $id2;
		$accesorio2['Codigo'] = $_POST['Codigo'];
		$accesorio2['Nombre'] = $_POST['Nombre'];
		$accesorio2['Descripcion'] = $_POST['Descripcion2'];
		$this->modelProducto->CambiarDatosAccesorio2($accesorio2, $datos2);
		
		$usuario['Datos'] = $this->modelProducto->BuscarDatosAccesorio($id);
		$usuario['Mensaje'] = 'Se modificaron los datos del accesorio con &eacute;xito!';
		
		$this->load->view('Despachador/Producto/DModPrecioAccesorio', $usuario);
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
	
	public function dnuevo_accesorio()
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario;
		$usuario['Equipo'] = $this->modelProducto->ConsultarEquipo();
		$usuario['Accesorio'] = $this->modelProducto->ConsultarA();
		$this->load->view('Despachador/Producto/DAccesorio', $usuario);
	}
	
	// Funcion que toma los datos de un accesorio y lo creo.
	public function crear_accesorio()
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario;
		$Identificador = "A10";
		$Accesorio['Id_Accesorio'] = $Identificador.$_POST['Codigo'];
		$Accesorio['Codigo'] = $_POST['Codigo'];
		$Accesorio['Nombre'] = $_POST['Accesorio'];
		$Accesorio['Precio'] = $_POST['Precio'];
		$Accesorio['Descripcion'] = $_POST['Descripcion'];
		$Accesorio['Descripcion2'] = $_POST['Descripcion2'];
		$this->modelProducto->InsertarAccesorio($Accesorio);
		
		$AE['Id_Equipo'] = $_POST['Equipo'];
		$AE['Id_Accesorio'] = $this->modelProducto->UltimoAccesorio();
		$this->modelProducto->InsertarAE($AE);
		
		$usuario['Equipo'] = $this->modelProducto->ConsultarEquipo();
		$usuario['Accesorio'] = $this->modelProducto->ConsultarA();
		$usuario['Mensaje'] = 'Se agrego el nuevo Accesorio con &eacute;xito!';
		
		$this->load->view('Administrador/Producto/Accesorio', $usuario);
	}
	
	// Funcion que toma los datos de un accesorio y lo creo.
	public function dcrear_accesorio()
	{
		$Usuario = $this->session->userdata('Usuario');
		$usuario['Usuario'] = $Usuario;
		$Identificador = "A10";
		$Accesorio['Id_Accesorio'] = $Identificador.$_POST['Codigo'];
		$Accesorio['Codigo'] = $_POST['Codigo'];
		$Accesorio['Nombre'] = $_POST['Accesorio'];
		$Accesorio['Precio'] = $_POST['Precio'];
		$Accesorio['Descripcion'] = $_POST['Descripcion'];
		$Accesorio['Descripcion2'] = $_POST['Descripcion2'];
		$this->modelProducto->InsertarAccesorio($Accesorio);
		
		$usuario['Accesorio'] = $this->modelProducto->ConsultarA();
		$usuario['Mensaje'] = 'Se agrego el nuevo Accesorio con &eacute;xito!';
		
		$this->load->view('Despachador/Producto/DAccesorio', $usuario);
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
		$Identificador = "E20";
		$Equipo['Id_Equipo	'] = $Identificador.$_POST['Codigo'];
		$Equipo['Codigo'] = $_POST['Codigo'];
		$Equipo['Nombre'] = $_POST['Equipo'];
		$Equipo['Precio'] = $_POST['Precio'];
		$Equipo['Descripcion'] = $_POST['Descripcion'];
		$Equipo['Descripcion2'] = $_POST['Descripcion2'];
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

