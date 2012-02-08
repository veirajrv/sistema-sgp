<?php

class ModelCliente extends CI_Model {

	function __construct()
	{
     	parent::__construct();
    }
	
	## INSERT ##

	function InsertarCliente($Cliente)
	{		
		$this->db->insert('Cliente', $Cliente);
	}
	
	function InsertarAgenda($EIC) 
	{
		$this->db->insert('EIC', $EIC);
	} 
	
	function InsertarAgenda2($EIC2) 
	{
		$this->db->insert('EIC', $EIC2);
	} 
	
	## SELECT ##

	function DetalleCliente($Id) 
	{
		$query = $this->db->where("Cedula", $Id);
		$query = $this->db->get('Cliente');
		return $query->result_array();			
	} 
	
	function BuscarInstituciones() 
	{
		$query =  $this->db->get('Institucion');
		return $query->result_array();		
	} 
	
	function BuscarId($usuario) 
	{
		$query = $this->db->select("Cedula");
		$query = $this->db->where("Usuario", $usuario);
		$query = $this->db->get("Empleado");
		foreach ($query->result_array() as $row)
	{
		$cedula = $row['Cedula'];
	}
		return $cedula;
	}
	
	function BuscarMaxId() 
	{
		$this->db->select_max('Id_Cliente'); 
		$query =  $this->db->get('Cliente');
		foreach ($query->result_array() as $row)
	{
		$id = $row['Id_Cliente'];
	}
		return $id;
	}
	
	function BuscarNombreC($Id) 
	{
		$query = $this->db->select("Nombre");
		$query = $this->db->where("Id_Cliente", $Id);
		$query = $this->db->get("Cliente");
		foreach ($query->result_array() as $row)
	{
		$nombre = $row['Nombre'];
	}
		return $nombre;
	}
	
	function BuscarApellidoC($Id) 
	{
		$query = $this->db->select("Apellido");
		$query = $this->db->where("Id_Cliente", $Id);
		$query = $this->db->get("Cliente");
		foreach ($query->result_array() as $row)
	{
		$apellido = $row['Apellido'];
	}
		return $apellido;
	}
	
	function BuscarMailC($Id) 
	{
		$query = $this->db->select("Email");
		$query = $this->db->where("Id_Cliente", $Id);
		$query = $this->db->get("Cliente");
		foreach ($query->result_array() as $row)
	{
		$email = $row['Email'];
	}
		return $email;
	}
	
	function DatosCliente($IdNegoBorrador, $Id)
	{
		$query = $this->db->query('SELECT C.Nombre, C.Apellido, C.Direccion, C.Rif, C.Telefono, C.Telefono2, C.Telefono3, C.Email
								   FROM NEGOCIACION AS N, CLIENTE AS C
								   WHERE N.Id_Cliente = C.Id_Cliente
								   AND N.Id_Negociacion = '.$IdNegoBorrador.'
								   AND N.Id_Cliente = '.$Id.'');	
								   
		return $query->result_array();	
	}
	
	function DatosClienteI($IdNegoBorrador, $Id)
	{
		$query = $this->db->query('SELECT I.Nombre, I.Rif, I.Telefono1, I.Telefono2, I.Telefono3, I.Web, I.Direccion1
								   FROM NEGOCIACION AS N, INSTITUCION AS I
								   WHERE N.Id_Institucion = I.Id_Institucion
								   AND N.Id_Negociacion = '.$IdNegoBorrador.'
								   AND N.Id_Institucion = '.$Id.'');	
								   
		return $query->result_array();	
	}

	function DatosVendedor($IdNegoBorrador, $cedula)
	{
		$query = $this->db->query('SELECT E.Nombre_1, E.Apellido_1, E.Apellido_2, N.FechaP
								   FROM NEGOCIACION AS N, EMPLEADO AS E
								   WHERE N.Id_Empleado = E.Cedula
								   AND N.Id_Negociacion = '.$IdNegoBorrador.'
								   AND N.Id_Empleado = '.$cedula.'');	
								   
		return $query->result_array();	
	}
	
	function DatosVendedorI($IdNegoBorrador, $cedula)
	{
		$query = $this->db->query('SELECT E.Nombre_1, E.Apellido_1, E.Apellido_2, N.FechaP
								   FROM NEGOCIACION AS N, EMPLEADO AS E
								   WHERE N.Id_Empleado = E.Cedula
								   AND N.Id_Negociacion = '.$IdNegoBorrador.'
								   AND N.Id_Empleado = '.$cedula.'');	
								   
		return $query->result_array();	
	}
	
	function BuscarIdCliente($Id_Negociacion)
	{
		$query = $this->db->select("Id_Cliente");
		$query = $this->db->where("Id_Negociacion", $Id_Negociacion);
		$query = $this->db->get("Negociacion");
		foreach ($query->result_array() as $row)
	{
		$id = $row['Id_Cliente'];
	}
		return $id;
	}
	
	function BuscarIdVendedor($Id_Negociacion) 
	{
		$query = $this->db->select("Id_Empleado");
		$query = $this->db->where("Id_Negociacion", $Id_Negociacion);
		$query = $this->db->get("Negociacion");
		foreach ($query->result_array() as $row)
	{
		$id = $row['Id_Empleado'];
	}
		return $id;
	}
	
	function NombreCliente($Id_Cliente)
	{
		$query = $this->db->select("Nombre");
		$query = $this->db->where("Id_Cliente", $Id_Cliente);
		$query = $this->db->get("cliente");
		foreach ($query->result_array() as $row)
	{
		$nombre = $row['Nombre'];
	}
		return $nombre;
	}
	
	function ApellidoCliente($Id_Cliente) 
	{
		$query = $this->db->select("Apellido");
		$query = $this->db->where("Id_Cliente", $Id_Cliente);
		$query = $this->db->get("cliente");
		foreach ($query->result_array() as $row)
	{
		$apellido = $row['Apellido'];
	}
		return $apellido;
	}
	
	function DireccionCliente($Id_Cliente) 
	{
		$query = $this->db->select("Direccion");
		$query = $this->db->where("Id_Cliente", $Id_Cliente);
		$query = $this->db->get("cliente");
		foreach ($query->result_array() as $row)
	{
		$direccion = $row['Direccion'];
	}
		return $direccion;
	}
	
	function Direccion2Cliente($Id_Cliente) 
	{
		$query = $this->db->select("Direccion2");
		$query = $this->db->where("Id_Cliente", $Id_Cliente);
		$query = $this->db->get("cliente");
		foreach ($query->result_array() as $row)
	{
		$direccion = $row['Direccion2'];
	}
		return $direccion;
	}
	
	function Direccion3Cliente($Id_Cliente) 
	{
		$query = $this->db->select("Direccion3");
		$query = $this->db->where("Id_Cliente", $Id_Cliente);
		$query = $this->db->get("cliente");
		foreach ($query->result_array() as $row)
	{
		$direccion = $row['Direccion3'];
	}
		return $direccion;
	}
	
	function RifCliente($Id_Cliente) 
	{
		$query = $this->db->select("Rif");
		$query = $this->db->where("Id_Cliente", $Id_Cliente);
		$query = $this->db->get("cliente");
		foreach ($query->result_array() as $row)
	{
		$rif = $row['Rif'];
	}
		return $rif;
	}
	
	function TelfCliente($Id_Cliente) 
	{
		$query = $this->db->select("Telefono");
		$query = $this->db->where("Id_Cliente", $Id_Cliente);
		$query = $this->db->get("cliente");
		foreach ($query->result_array() as $row)
	{
		$telf = $row['Telefono'];
	}
		return $telf;
	}
	
	function Telf2Cliente($Id_Cliente) 
	{
		$query = $this->db->select("Telefono2");
		$query = $this->db->where("Id_Cliente", $Id_Cliente);
		$query = $this->db->get("cliente");
		foreach ($query->result_array() as $row)
	{
		$telf = $row['Telefono2'];
	}
		return $telf;
	}
	
	function Telf3Cliente($Id_Cliente) 
	{
		$query = $this->db->select("Telefono3");
		$query = $this->db->where("Id_Cliente", $Id_Cliente);
		$query = $this->db->get("cliente");
		foreach ($query->result_array() as $row)
	{
		$telf = $row['Telefono3'];
	}
		return $telf;
	}

	function EmailCliente($Id_Cliente) 
	{
		$query = $this->db->select("Email");
		$query = $this->db->where("Id_Cliente", $Id_Cliente);
		$query = $this->db->get("cliente");
		foreach ($query->result_array() as $row)
	{
		$mail = $row['Email'];
	}
		return $mail;
	}
	
	function WebCliente($Id_Cliente) 
	{
		$query = $this->db->select("Web");
		$query = $this->db->where("Id_Cliente", $Id_Cliente);
		$query = $this->db->get("cliente");
		foreach ($query->result_array() as $row)
	{
		$web = $row['Web'];
	}
		return $web;
	}
	
	function DepartamentoCliente($Id_Cliente) 
	{
		$query = $this->db->select("Departamento");
		$query = $this->db->where("Id_Cliente", $Id_Cliente);
		$query = $this->db->get("cliente");
		foreach ($query->result_array() as $row)
	{
		$departamento = $row['Departamento'];
	}
		return $departamento;
	}
	
	function TwitterCliente($Id_Cliente) 
	{
		$query = $this->db->select("Twitter");
		$query = $this->db->where("Id_Cliente", $Id_Cliente);
		$query = $this->db->get("cliente");
		foreach ($query->result_array() as $row)
	{
		$twitter = $row['Twitter'];
	}
		return $twitter;
	}
	
	function FacebookCliente($Id_Cliente) 
	{
		$query = $this->db->select("Facebook");
		$query = $this->db->where("Id_Cliente", $Id_Cliente);
		$query = $this->db->get("cliente");
		foreach ($query->result_array() as $row)
	{
		$facebook = $row['Facebook'];
	}
		return $facebook;
	}
	
	function GoogleplusCliente($Id_Cliente) 
	{
		$query = $this->db->select("Googleplus");
		$query = $this->db->where("Id_Cliente", $Id_Cliente);
		$query = $this->db->get("cliente");
		foreach ($query->result_array() as $row)
	{
		$google = $row['Googleplus'];
	}
		return $google;
	}
	
	function NombreVendedor($Id_Vendedor) 
	{
		$query = $this->db->select("Nombre_1");
		$query = $this->db->where("Cedula", $Id_Vendedor);
		$query = $this->db->get("empleado");
		foreach ($query->result_array() as $row)
	{
		$nombre = $row['Nombre_1'];
	}
		return $nombre;
	}
	
	function ApellidoVendedor($Id_Vendedor) 
	{
		$query = $this->db->select("Apellido_1");
		$query = $this->db->where("Cedula", $Id_Vendedor);
		$query = $this->db->get("empleado");
		foreach ($query->result_array() as $row)
	{
		$nombre = $row['Apellido_1'];
	}
		return $nombre;
	}
	
	function FPresupuesto($Id_Negociacion)
	{
		$query = $this->db->select("FechaP");
		$query = $this->db->where("Id_Negociacion", $Id_Negociacion);
		$query = $this->db->get("negociacion");
		foreach ($query->result_array() as $row)
	{
		$fecha = $row['FechaP'];
	}
		return $fecha;
	}
	
	function Vendedores() 
	{
		$query = $this->db->query('SELECT DISTINCT E.Cedula, E.Nombre_1, E.Apellido_1
								   FROM EMPLEADO AS E, NEGOCIACION AS N
								   WHERE E.Cedula = N.Id_Empleado
								   AND E.Tipo_Empleado = "Vendedor"
                                   ORDER BY E.Cedula ASC ');	
		
		return $query->result_array();	
	} 
	
	function Vendedores2($Cedula) 
	{
		$query = $this->db->query('SELECT DISTINCT E.Cedula, E.Nombre_1, E.Apellido_1
								   FROM EMPLEADO AS E, NEGOCIACION AS N
								   WHERE E.Cedula = N.Id_Empleado
								   AND E.Tipo_Empleado = "Vendedor"
								   AND E.Cedula = '.$Cedula.'
                                   ORDER BY E.Cedula ASC ');	
		
		return $query->result_array();	
	} 
	
	function BuscarVendedor($Id_Negociacion) 
	{
		$query = $this->db->select("Id_Empleado");
		$query = $this->db->where("Id_Negociacion", $Id_Negociacion);
		$query = $this->db->get("Negociacion");
		foreach ($query->result_array() as $row)
	{
		$cedula = $row['Id_Empleado'];
	}
		return $cedula;
	}
	
	function DatosVendedor2($IdNegoBorrador, $cedula)
	{
		$query = $this->db->query('SELECT E.Nombre_1, E.Apellido_1, E.Apellido_2, N.FechaP
								   FROM NEGOCIACION AS N, EMPLEADO AS E
								   WHERE N.Id_Empleado = E.Cedula
								   AND N.Id_Negociacion = '.$IdNegoBorrador.'
								   AND N.Id_Empleado = '.$cedula.'');	
								   
		return $query->result_array();	
	}
	
	function DatosVendedorI2($IdNegoBorrador, $cedula)
	{
		$query = $this->db->query('SELECT E.Nombre_1, E.Apellido_1, E.Apellido_2, N.FechaP
								   FROM NEGOCIACION AS N, EMPLEADO AS E
								   WHERE N.Id_Empleado = E.Cedula
								   AND N.Id_Negociacion = '.$IdNegoBorrador.'
								   AND N.Id_Empleado = '.$cedula.'');	
								   
		return $query->result_array();	
	}
	
	function BuscarTodo($cadena)
	{
		$query = $this->db->query('SELECT C.Id_Cliente, C.Nombre, C.Apellido, C.Cedula, C.Email, C.Telefono, C.Telefono2
								   FROM CLIENTE AS C
								   WHERE C.Nombre LIKE "%'.$cadena.'%" OR C.Apellido LIKE "%'.$cadena.'%"
								   ORDER BY C.Nombre ASC ');	
		
		return $query->result_array();	
	} 
		
	function BuscarClientes($Vendedor)
	{
		$query = $this->db->query('SELECT DISTINCT(C.Nombre), C.Apellido, C.Cedula, C.Email, C.Telefono, C.Telefono2
								   FROM CLIENTE AS C, NEGOCIACION AS N
								   WHERE N.Id_Cliente = C.Id_Cliente
								   AND N.Id_Empleado = '.$Vendedor.'
								   ORDER BY C.Nombre ASC ');	
		
		return $query->result_array();	
	} 
	
	function BuscarClientesTodos() 
	{
		$query = $this->db->query('SELECT DISTINCT(C.Nombre), C.Apellido, C.Cedula, C.Email, C.Telefono, C.Telefono2
								   FROM CLIENTE AS C
								   ORDER BY C.Nombre ASC ');	
		
		return $query->result_array();	
	} 
	
	function BuscarInstitucion($Vendedor)
	{
		$query = $this->db->query('SELECT DISTINCT(I.Nombre), I.Rif, I.Web, I.Telefono1, I.Telefono2
								   FROM INSTITUCION AS I, NEGOCIACION AS N
								   WHERE N.Id_Institucion = I.Id_Institucion
								   AND N.Id_Empleado = '.$Vendedor.'
								   ORDER BY I.Nombre ASC ');	
		
		return $query->result_array();	
	} 
	
	function BuscarInstitucionTodos() 
	{
		$query = $this->db->query('SELECT DISTINCT(I.Nombre), I.Rif, I.Web, I.Telefono1, I.Telefono2
								   FROM INSTITUCION AS I
								   ORDER BY I.Nombre ASC ');	
		
		return $query->result_array();	
	} 
	
	## UPDATE ##
	
	function ModificarCliente($cliente, $datos) 
	{
		if(isset($_POST['checkbox']))
		{
			$cliente->Email = $_POST['Email'];
		}
		
		if(isset($_POST['checkbox2']))
		{
			$cliente->Telefono = $_POST['Telefono'];
		}
		
		if(isset($_POST['checkbox3']))
		{
			$cliente->Telefono2 = $_POST['Telefono2'];
		}
		
		if(isset($_POST['checkbox4']))
		{
			$cliente->Telefono3 = $_POST['Telefono3'];
		}
		
		if(isset($_POST['checkbox5']))
		{
			$cliente->Web = $_POST['Web'];
		}
		
		if(isset($_POST['checkbox6']))
		{
			$cliente->Departamento = $_POST['Departamento'];
		}
		
		if(isset($_POST['checkbox7']))
		{
			$cliente->Twitter = $_POST['Twitter'];
		}
		
		if(isset($_POST['checkbox8']))
		{
			$cliente->Facebook = $_POST['Facebook'];
		}
		
		if(isset($_POST['checkbox9']))
		{
			$cliente->Googleplus = $_POST['GoogleP'];
		}
		
		if(isset($_POST['checkbox10']))
		{
			$cliente->Direccion = $_POST['Direccion'];
		}
		
		if(isset($_POST['checkbox11']))
		{
			$cliente->Direccion2 = $_POST['Direccion2'];
		}
		
		if(isset($_POST['checkbox12']))
		{
			$cliente->Direccion3 = $_POST['Direccion3'];
		}
		
		$id_cliente = $datos['ID2'];
		$this->db->where("Id_Cliente", $id_cliente);
		$this->db->update('Cliente', $cliente);
	}
	
}