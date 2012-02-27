<?php

class ModelInicio extends CI_Model 
{

	function __construct()
	{
     	parent::__construct();
    }
	
	## INSERT ##
	
	## SELECT ##
	
	function ConsultarNombre($usuario) 
	{
		$query = $this->db->select("Nombre_1");
		$query = $this->db->where("Usuario", $usuario);
		$query = $this->db->get("Empleado");
		foreach ($query->result_array() as $row)
	{
		$nombre = $row['Nombre_1'];
	}
		return $nombre;
	}
	
	function ConsultarApellido($usuario) 
	{
		$query = $this->db->select("Apellido_1");
		$query = $this->db->where("Usuario", $usuario);
		$query = $this->db->get("Empleado");
		foreach ($query->result_array() as $row)
	{
		$apellido = $row['Apellido_1'];
	}
		return $apellido;
	}
	
	function ConsultarUsuario($usuario) 
	{
		$query = $this->db->select("Usuario");
		$query = $this->db->where("Usuario", $usuario);
		$query = $this->db->get("Empleado");
		foreach ($query->result_array() as $row)
	{
		$usuario = $row['Usuario'];
	}
		return $usuario;
	}
	
	function VerificarClave($usuario) 
	{
		$query = $this->db->select("Clave");
		$query = $this->db->where("Usuario", $usuario);
		$query = $this->db->get("Empleado");
		foreach ($query->result_array() as $row)
	{
		$clave = $row['Clave'];
	}
		return $clave;
	}
	
	function VerificarUsuario($usuario) 
	{
		$query = $this->db->select("Usuario");
		$query = $this->db->where("Usuario", $usuario);
		$query = $this->db->get("Empleado");
		foreach ($query->result_array() as $row)
	{
		$usuario = $row['Usuario'];
	}
		return $usuario;
	}
	
	function VerificarTipo($usuario) 
	{
		$query = $this->db->select("Tipo_Empleado");
		$query = $this->db->where("Usuario", $usuario);
		$query = $this->db->get("Empleado");
		foreach ($query->result_array() as $row)
	{
		$tipo = $row['Tipo_Empleado'];
	}
		return $tipo;
	}
	
	function SinAutorizar($cedula)
	{
		$query = $this->db->query('SELECT N.Id_Negociacion
							   FROM NEGOCIACION AS N, EMPLEADO AS E, NS AS NS, SEGUIMIENTO AS S
							   WHERE E.Cedula = N.Id_Empleado
							   AND N.Id_Negociacion = NS.Id_Negociacion
							   AND NS.Id_Seguimiento = S.Id_Seguimiento
							   AND N.Id_Empleado = '.$cedula.'
							   AND ((S.Status = "Borrador") || (S.Status = "Activa"))
							   AND N.Status = 1
							   ORDER BY N.Id_Negociacion ASC');	
		
		return $query->result_array();	
	}
	
	function SinAutorizar2($cedula)
	{
		$query = $this->db->query('SELECT N.Id_Negociacion
							   FROM NEGOCIACION AS N, EMPLEADO AS E
							   WHERE E.Cedula = N.Id_Empleado
							   AND N.Status = 2
							   ORDER BY N.Id_Negociacion ASC');	
		
		return $query->result_array();	
	}
	
	function ConAutorizar($cedula)
	{
		$query = $this->db->query('SELECT N.Id_Negociacion
							   FROM NEGOCIACION AS N, EMPLEADO AS E
							   WHERE E.Cedula = N.Id_Empleado
							   AND N.Id_Empleado = '.$cedula.'
							   AND N.Status = 3
							   ORDER BY N.Id_Negociacion ASC');	
		
		return $query->result_array();	
	}
	
	function NumeroAprobadas($cedula)
	{
		$query = $this->db->query('SELECT Count(N.Id_Negociacion) AS Numero
							   FROM NEGOCIACION AS N, EMPLEADO AS E
							   WHERE E.Cedula = N.Id_Empleado
							   AND N.Id_Empleado = '.$cedula.'
							   AND N.Status = 3
							   ORDER BY N.Id_Negociacion ASC');	
		
		foreach ($query->result_array() as $row)
	{
		$tipo = $row['Numero'];
	}
		return $tipo;
	}
	
	function NumeroPorAprobar()
	{
		$query = $this->db->query('SELECT Count(N.Id_Negociacion) AS Numero
							   FROM NEGOCIACION AS N, EMPLEADO AS E
							   WHERE E.Cedula = N.Id_Empleado
							   AND N.Status = 2
							   ORDER BY N.Id_Negociacion ASC');	
		
		foreach ($query->result_array() as $row)
	{
		$tipo = $row['Numero'];
	}
		return $tipo;
	}
	
	function NumeroBorradores()
	{
		$query = $this->db->query('SELECT Count(S.Id_Seguimiento) AS Numero
							   FROM SEGUIMIENTO AS S
							   WHERE S.Status = "Borrador"
							   ORDER BY S.Id_Seguimiento ASC');	
		
		foreach ($query->result_array() as $row)
	{
		$tipo = $row['Numero'];
	}
		return $tipo;
	}
	
	function NumeroActivas()
	{
		$query = $this->db->query('SELECT Count(S.Id_Seguimiento) AS Numero
							   FROM SEGUIMIENTO AS S
							   WHERE S.Status = "Activa"
							   ORDER BY S.Id_Seguimiento ASC');	
		
		foreach ($query->result_array() as $row)
	{
		$tipo = $row['Numero'];
	}
		return $tipo;
	}
	
	function NumeroGanadas()
	{
		$query = $this->db->query('SELECT Count(S.Id_Seguimiento) AS Numero
							   FROM SEGUIMIENTO AS S
							   WHERE S.Status = "Ganada"
							   ORDER BY S.Id_Seguimiento ASC');	
		
		foreach ($query->result_array() as $row)
	{
		$tipo = $row['Numero'];
	}
		return $tipo;
	}
	
	function NumeroCerradas()
	{
		$query = $this->db->query('SELECT Count(S.Id_Seguimiento) AS Numero
							   FROM SEGUIMIENTO AS S
							   WHERE S.Status = "Cerrada"
							   ORDER BY S.Id_Seguimiento ASC');	
		
		foreach ($query->result_array() as $row)
	{
		$tipo = $row['Numero'];
	}
		return $tipo;
	}
	
	function NumeroPerdidas()
	{
		$query = $this->db->query('SELECT Count(S.Id_Seguimiento) AS Numero
							   FROM SEGUIMIENTO AS S
							   WHERE S.Status = "Perdida"
							   ORDER BY S.Id_Seguimiento ASC');	
		
		foreach ($query->result_array() as $row)
	{
		$tipo = $row['Numero'];
	}
		return $tipo;
	}
	
	function NumeroTotal()
	{
		$query = $this->db->query('SELECT Count(S.Id_Seguimiento) AS Numero
							   FROM SEGUIMIENTO AS S
							   ORDER BY S.Id_Seguimiento ASC');	
		
		foreach ($query->result_array() as $row)
	{
		$tipo = $row['Numero'];
	}
		return $tipo;
	}
	
	function Fecha($IdNegoBorrador) 
	{
		$query = $this->db->select("FechaP");
		$query = $this->db->where("Id_Negociacion", $IdNegoBorrador);
		$query = $this->db->get("negociacion");
		foreach ($query->result_array() as $row)
	{
		$fecha = $row['FechaP'];
	}
		return $fecha;
	}
	
	function MailEmpleado($cedulaempleado) 
	{
		$query = $this->db->select("Correo");
		$query = $this->db->where("Cedula", $cedulaempleado);
		$query = $this->db->get("Empleado");
		foreach ($query->result_array() as $row)
	{
		$mail = $row['Correo'];
	}
		return $mail;
	}
	
	function CedEmpleado($Nego) 
	{
		$query = $this->db->select("Id_Empleado");
		$query = $this->db->where("Id_Negociacion", $Nego);
		$query = $this->db->get("Negociacion");
		foreach ($query->result_array() as $row)
	{
		$id = $row['Id_Empleado'];
	}
		return $id;
	}
	
	function BuscarContador($Nego) 
	{
		$query = $this->db->select("Contador");
		$query = $this->db->where("Id_Negociacion", $Nego);
		$query = $this->db->get("alerta");
		foreach ($query->result_array() as $row)
	{
		$id = $row['Contador'];
	}
		return $id;
	}
	
	function ConAlerta($cedula)
	{
		$query = $this->db->query('SELECT N.Id_Negociacion
							   FROM NEGOCIACION AS N, ALERTA AS A
							   WHERE N.Id_Empleado = '.$cedula.'
							   AND N.Id_Negociacion = A.Id_Negociacion
							   AND A.Status = 1
							   ORDER BY N.Id_Negociacion ASC');	
		
		return $query->result_array();	
	}
	
	function ConAlertaTotal()
	{
		$query = $this->db->query('SELECT Count(N.Id_Negociacion) AS Numero
							   FROM NEGOCIACION AS N, ALERTA AS A
							   WHERE N.Id_Negociacion = A.Id_Negociacion
							   AND A.Status = 1
							   ORDER BY N.Id_Negociacion ASC');	
		
		foreach ($query->result_array() as $row)
	{
		$tipo = $row['Numero'];
	}
		return $tipo;
	}
	
	function ConModTotal()
	{
		$query = $this->db->query('SELECT Count(N.Id_Negociacion) AS Numero
							   FROM NEGOCIACION AS N, ALERTAMOD AS A
							   WHERE N.Id_Negociacion = A.Id_Negociacion
							   AND A.Contador > 5
							   ORDER BY N.Id_Negociacion ASC');	
		
		foreach ($query->result_array() as $row)
	{
		$tipo = $row['Numero'];
	}
		return $tipo;
	}
	
	function NegociacionesEx() 
	{
		$query = $this->db->query('SELECT DISTINCT(A.Id_Negociacion), A.Contador, E.Nombre_1, E.Apellido_1, E.Apellido_2
									FROM EMPLEADO AS E, ALERTAMOD AS A, NEGOCIACION AS N, SEGUIMIENTO AS S, NS AS NS
									WHERE A.Id_Negociacion = N.Id_Negociacion
									AND N.Id_Empleado = E.Cedula
									AND N.Id_Negociacion = NS.Id_Negociacion
									AND NS.Id_Seguimiento = S.Id_Seguimiento
									AND A.Contador >5');	
		
		return $query->result_array();		
	} 
	
	function Rechazadas()
	{
		$query = $this->db->query('SELECT N.Id_Negociacion
							   FROM NEGOCIACION AS N
							   WHERE N.Status = 4
							   ORDER BY N.Id_Negociacion ASC');	
		
		return $query->result_array();	
	}
	
	function NumeroPorAprobar2()
	{
		$query = $this->db->query('SELECT Count(N.Id_Negociacion) AS Numero
							   FROM NEGOCIACION AS N, SEGUIMIENTO AS S, NS AS NS
							   WHERE N.Id_Negociacion = NS.Id_Negociacion
							   AND NS.Id_Seguimiento = S.Id_Seguimiento
							   AND N.Status = 1
							   AND ((S.Status = "Borrador") || (S.Status = "Activa"))');	
		
		foreach ($query->result_array() as $row)
	{
		$tipo = $row['Numero'];
	}
		return $tipo;
	}
	
	function NumeroRechazadas()
	{
		$query = $this->db->query('SELECT Count(N.Id_Negociacion) AS Numero
							   FROM NEGOCIACION AS N, SEGUIMIENTO AS S, NS AS NS
							   WHERE N.Id_Negociacion = NS.Id_Negociacion
							   AND NS.Id_Seguimiento = S.Id_Seguimiento
							   AND N.Status = 4');	
		
		foreach ($query->result_array() as $row)
	{
		$tipo = $row['Numero'];
	}
		return $tipo;
	}
	
}