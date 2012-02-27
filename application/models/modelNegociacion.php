<?php

class modelNegociacion extends CI_Model {

	function __construct()
	{
       // Call the Model constructor
       parent::__construct();
    }
	
	## INSERT ##
	
	function NuevaNegociacion($datos)
	{
		$this->db->insert('Negociacion', $datos);
	} 
	
	function NuevaAlerta($Alerta)
	{
		$this->db->insert('Alerta', $Alerta);
	} 
	
	function NuevaAlerta2($Alerta) 
	{
		$this->db->insert('AlertaMod', $Alerta);
	} 
	
	function NuevoSeguimiento($datos) 
	{
		$this->db->insert('Seguimiento', $datos);
	} 
	
	function NuevaNS($datos) 
	{
		$this->db->insert('NS', $datos);
	} 
	
	function NuevaNS2($NS2) 
	{
		$this->db->insert('Historial_Ns', $NS2);
	} 
	
	function HistorialStatus($Seguimiento, $datos) 
	{
		$id = $datos['ID2'];
		$Seguimiento->Id_Negociacion = $id;
		$Seguimiento->Id_Seguimiento = $id;
		$Seguimiento->FechaS = $_POST['FechaC'];
		$Seguimiento->TipoS = $_POST['TipoC'];
		$Seguimiento->Resumen = $_POST['ResumenC'];
		$Seguimiento->Status = $_POST['StatusC'];
		$this->db->insert('Historial_Ns', $Seguimiento);
	}
	
	function HistorialRechazos($Seguimiento, $datos) 
	{
		$id = $datos['ID2'];
		$Seguimiento->Id_Negociacion = $id;
		$Seguimiento->Id_Seguimiento = $id;
		$Seguimiento->FechaS = date("d/m/Y");
		$Seguimiento->Resumen = $_POST['ResumenC'];
		$Seguimiento->Status = $this->modelNegociacion->StatusNegociacion($id); 
		$this->db->insert('Historial_Ns', $Seguimiento);
	}
	
	## SELECT ##
	
	function BuscarClientes() 
	{
		$query = $this->db->query('SELECT DISTINCT C.Id_Cliente, c.Cedula, C.Nombre, C.Apellido FROM CLIENTE AS C ORDER BY C.Cedula ASC');	
		
		return $query->result_array();	
	} 
	
	function BuscarInstitucion()
	{
		$query = $this->db->query('SELECT DISTINCT I.Id_Institucion, I.Nombre, I.Rif FROM INSTITUCION AS I ORDER BY I.Rif ASC');	
		
		return $query->result_array();	
	} 
	
	function UltimaNegociacion() 
	{
		$this->db->select_max('Id_Negociacion'); 
		$query =  $this->db->get('Negociacion');
		foreach ($query->result_array() as $row)
	{
		$id = $row['Id_Negociacion'];
	}
		return $id;
    }
	
	function UltimoSeguimiento() 
	{
		$this->db->select_max('Id_Seguimiento'); 
		$query =  $this->db->get('Seguimiento');
		foreach ($query->result_array() as $row)
	{
		$id = $row['Id_Seguimiento'];
	}
		return $id;
    }
	
	function IdMaxStatus($IdNegociacion) 
	{
		$this->db->select_max('Id_NS'); 
		$query = $this->db->where("Id_Negociacion", $IdNegociacion);
		$query =  $this->db->get('NS');
		foreach ($query->result_array() as $row)
	{
		$id = $row['Id_NS'];
	}
		return $id;
    }
	
	function Idseguimiento($statusmax) 
	{
		$query = $this->db->select("Id_Seguimiento");
		$query = $this->db->where("Id_NS", $statusmax);
		$query = $this->db->get("NS");
		foreach ($query->result_array() as $row)
	{
		$id = $row['Id_Seguimiento'];
	}
		return $id;
	}
	
	function status($idSeguimiento) 
	{
		$query = $this->db->select("Status");
		$query = $this->db->where("Id_Seguimiento", $idSeguimiento);
		$query = $this->db->get("Seguimiento");
		foreach ($query->result_array() as $row)
	{
		$status = $row['Status'];
	}
		return $status;
	}
	
	function MisClientes($Id) 
	{
		$query = $this->db->query('SELECT DISTINCT C.Id_Cliente, C.Cedula, C.Nombre, C.Apellido
								   FROM CLIENTE AS C, NEGOCIACION AS N, EMPLEADO AS E
								   WHERE N.Id_Cliente = C.Id_Cliente
								   AND E.Cedula = N.Id_Empleado
								   AND N.Id_Empleado = '.$Id.'
                                   ORDER BY C.Cedula ASC ');	
		
		return $query->result_array();	
	} 
	
	function MisInstituciones($Id) 
	{
		$query = $this->db->query('SELECT DISTINCT I.Id_Institucion, I.Rif, I.Nombre
								   FROM INSTITUCION AS I, NEGOCIACION AS N, EMPLEADO AS E
								   WHERE N.Id_Institucion = I.Id_Institucion
								   AND E.Cedula = N.Id_Empleado
								   AND N.Id_Empleado = '.$Id.'
                                   ORDER BY I.Rif ASC ');	
		
		return $query->result_array();	
	} 
	
	function NegociacionBorrador($cliente, $Id) 
	{
		$query = $this->db->query('SELECT DISTINCT N.Id_Negociacion, NS.Id_NS, N.FechaP
								   FROM CLIENTE AS C, NEGOCIACION AS N, EMPLEADO AS E, NS AS NS, SEGUIMIENTO AS S
								   WHERE N.Id_Cliente = C.Id_Cliente
								   AND E.Cedula = N.Id_Empleado
								   AND NS.Id_Negociacion = N.Id_Negociacion
								   AND S.Id_Seguimiento = NS.Id_Seguimiento
								   AND N.Id_Empleado = '.$Id.'
								   AND N.Id_Cliente = '.$cliente.'
								   AND S.Status = "Borrador"
								   AND N.Status <> 2
								   ORDER BY N.Id_Negociacion ASC');	
		
		return $query->result_array();	
	} 
	
	function NegociacionActiva($cliente, $Id)
	{
		$query = $this->db->query('SELECT DISTINCT N.Id_Negociacion, NS.Id_NS, N.FechaP
								   FROM CLIENTE AS C, NEGOCIACION AS N, EMPLEADO AS E, NS AS NS, SEGUIMIENTO AS S
								   WHERE N.Id_Cliente = C.Id_Cliente
								   AND E.Cedula = N.Id_Empleado
								   AND NS.Id_Negociacion = N.Id_Negociacion
								   AND S.Id_Seguimiento = NS.Id_Seguimiento
								   AND N.Id_Empleado = '.$Id.'
								   AND N.Id_Cliente = '.$cliente.'
								   AND S.Status = "Activa"
								   AND N.Status <> 2
								   ORDER BY N.Id_Negociacion ASC');	
		
		return $query->result_array();	
	} 
	
	function NegociacionGanada($cliente, $Id)
	{
		$query = $this->db->query('SELECT DISTINCT N.Id_Negociacion, NS.Id_NS, N.FechaP
								   FROM CLIENTE AS C, NEGOCIACION AS N, EMPLEADO AS E, NS AS NS, SEGUIMIENTO AS S
								   WHERE N.Id_Cliente = C.Id_Cliente
								   AND E.Cedula = N.Id_Empleado
								   AND NS.Id_Negociacion = N.Id_Negociacion
								   AND S.Id_Seguimiento = NS.Id_Seguimiento
								   AND N.Id_Empleado = '.$Id.'
								   AND N.Id_Cliente = '.$cliente.'
								   AND S.Status = "Ganada"
								   AND N.Status <> 2
								   ORDER BY N.Id_Negociacion ASC');	
		
		return $query->result_array();	
	} 
	
	function NegociacionCerrada($cliente, $Id)
	{
		$query = $this->db->query('SELECT DISTINCT N.Id_Negociacion, NS.Id_NS, N.FechaP
								   FROM CLIENTE AS C, NEGOCIACION AS N, EMPLEADO AS E, NS AS NS, SEGUIMIENTO AS S
								   WHERE N.Id_Cliente = C.Id_Cliente
								   AND E.Cedula = N.Id_Empleado
								   AND NS.Id_Negociacion = N.Id_Negociacion
								   AND S.Id_Seguimiento = NS.Id_Seguimiento
								   AND N.Id_Empleado = '.$Id.'
								   AND N.Id_Cliente = '.$cliente.'
								   AND S.Status = "Cerrada"
								   AND N.Status <> 2
								   ORDER BY N.Id_Negociacion ASC');	
		
		return $query->result_array();	
	} 
	
	function NegociacionPerdida($cliente, $Id)
	{
		$query = $this->db->query('SELECT DISTINCT N.Id_Negociacion, NS.Id_NS, N.FechaP
								   FROM CLIENTE AS C, NEGOCIACION AS N, EMPLEADO AS E, NS AS NS, SEGUIMIENTO AS S
								   WHERE N.Id_Cliente = C.Id_Cliente
								   AND E.Cedula = N.Id_Empleado
								   AND NS.Id_Negociacion = N.Id_Negociacion
								   AND S.Id_Seguimiento = NS.Id_Seguimiento
								   AND N.Id_Empleado = '.$Id.'
								   AND N.Id_Cliente = '.$cliente.'
								   AND S.Status = "Perdida"
								   AND N.Status <> 2
								   ORDER BY N.Id_Negociacion ASC');	
		
		return $query->result_array();	
	} 
	
	function NombreCliente($cliente)
	{
		$query = $this->db->select("Nombre");
		$query = $this->db->where("Id_Cliente", $cliente);
		$query = $this->db->get("Cliente");
		foreach ($query->result_array() as $row)
	{
		$nombre = $row['Nombre'];
	}
		return $nombre;
	}
	
	function ApellidoCliente($cliente) 
	{
		$query = $this->db->select("Apellido");
		$query = $this->db->where("Id_Cliente", $cliente);
		$query = $this->db->get("Cliente");
		foreach ($query->result_array() as $row)
	{
		$apellido = $row['Apellido'];
	}
		return $apellido;
	}
	
	function MailCliente($cliente)
	{
		$query = $this->db->select("Email");
		$query = $this->db->where("Id_Cliente", $cliente);
		$query = $this->db->get("Cliente");
		foreach ($query->result_array() as $row)
	{
		$mail = $row['Email'];
	}
		return $mail;
	}
	
	function TelefonoCliente($cliente) 
	{
		$query = $this->db->select("Telefono");
		$query = $this->db->where("Id_Cliente", $cliente);
		$query = $this->db->get("Cliente");
		foreach ($query->result_array() as $row)
	{
		$telefono = $row['Telefono'];
	}
		return $telefono;
	}
	
	function FechaPresupuesto($IdNegoBorrador)
	{
		$query = $this->db->select("FechaP");
		$query = $this->db->where("Id_Negociacion", $IdNegoBorrador);
		$query = $this->db->get("NEGOCIACION");
		foreach ($query->result_array() as $row)
	{
		$fechap = $row['FechaP'];
	}
			return $fechap;	
	}
	
	function NumeroOrdenDC($IdNegoBorrador)
	{
		$query = $this->db->select("NumeroODC");
		$query = $this->db->where("Id_Negociacion", $IdNegoBorrador);
		$query = $this->db->get("NEGOCIACION");
		foreach ($query->result_array() as $row)
	{
		$numerodc = $row['NumeroODC'];
	}
			return $numerodc;	
	}
	
	function FechaOrdenDC($IdNegoBorrador)
	{
		$query = $this->db->select("FechaODC");
		$query = $this->db->where("Id_Negociacion", $IdNegoBorrador);
		$query = $this->db->get("NEGOCIACION");
		foreach ($query->result_array() as $row)
	{
		$fechaodc = $row['FechaODC'];
	}
			return $fechaodc;	
	}
	
	function Banco($IdNegoBorrador)
	{
		$query = $this->db->select("Banco");
		$query = $this->db->where("Id_Negociacion", $IdNegoBorrador);
		$query = $this->db->get("NEGOCIACION");
		foreach ($query->result_array() as $row)
	{
		$banco = $row['Banco'];
	}
			return $banco;	
	}
	
	function PagoInicial($IdNegoBorrador)
	{
		$query = $this->db->select("PagoInicial");
		$query = $this->db->where("Id_Negociacion", $IdNegoBorrador);
		$query = $this->db->get("NEGOCIACION");
		foreach ($query->result_array() as $row)
	{
		$pinicial = $row['PagoInicial'];
	}
			return $pinicial;	
	}
	
	function CondicionesPago($IdNegoBorrador)
	{
		$query = $this->db->select("CondicionesPago");
		$query = $this->db->where("Id_Negociacion", $IdNegoBorrador);
		$query = $this->db->get("NEGOCIACION");
		foreach ($query->result_array() as $row)
	{
		$condicionpago = $row['CondicionesPago'];
	}
			return $condicionpago;	
	}
	
	function FechaDePago($IdNegoBorrador)
	{
		$query = $this->db->select("FechaPago");
		$query = $this->db->where("Id_Negociacion", $IdNegoBorrador);
		$query = $this->db->get("NEGOCIACION");
		foreach ($query->result_array() as $row)
	{
		$fechapago = $row['FechaPago'];
	}
			return $fechapago;	
	}
	
	function NumeroDeposito($IdNegoBorrador)
	{
		$query = $this->db->select("NDeposito");
		$query = $this->db->where("Id_Negociacion", $IdNegoBorrador);
		$query = $this->db->get("NEGOCIACION");
		foreach ($query->result_array() as $row)
	{
		$ndeposito = $row['NDeposito'];
	}
			return $ndeposito;	
	}
	
	function StatusNegociacion($IdNegoBorrador)
	{
		$query = $this->db->query('SELECT S.Status
								   FROM NEGOCIACION AS N, NS AS NS, SEGUIMIENTO AS S
								   WHERE S.Id_Seguimiento = NS.Id_Seguimiento
								   AND NS.Id_Negociacion = N.Id_Negociacion
								   AND N.Id_Negociacion = '.$IdNegoBorrador.'');	
		foreach ($query->result_array() as $row)
	{
		$status = $row['Status'];
	}
		return $status;
	}
	
	function PorcentajeNegociacion($IdNegoBorrador)
	{
		$query = $this->db->query('SELECT S.Porcentaje
								   FROM NEGOCIACION AS N, NS AS NS, SEGUIMIENTO AS S
								   WHERE S.Id_Seguimiento = NS.Id_Seguimiento
								   AND NS.Id_Negociacion = N.Id_Negociacion
								   AND N.Id_Negociacion = '.$IdNegoBorrador.'');	
		foreach ($query->result_array() as $row)
	{
		$porcentaje = $row['Porcentaje'];
	}
		return $porcentaje;
	}
	
	function BuscarSeguimiento($Id_Negociacion)
	{
		$query = $this->db->select("Id_Seguimiento");
		$query = $this->db->where("Id_Negociacion", $Id_Negociacion);
		$query = $this->db->get("NS");
		foreach ($query->result_array() as $row)
	{
		$idseguimiento = $row['Id_Seguimiento'];
	}
			return $idseguimiento;	
	}
	
	function NombreInstitucion($cliente) 
	{
		$query = $this->db->select("Nombre");
		$query = $this->db->where("Id_Institucion", $cliente);
		$query = $this->db->get("Institucion");
		foreach ($query->result_array() as $row)
	{
		$nombre = $row['Nombre'];
	}
		return $nombre;
	}
	
	function TelefonoInstitucion($cliente) 
	{
		$query = $this->db->select("Telefono1");
		$query = $this->db->where("Id_Institucion", $cliente);
		$query = $this->db->get("Institucion");
		foreach ($query->result_array() as $row)
	{
		$telefono = $row['Telefono1'];
	}
		return $telefono;
	}
	
	function NegociacionBorradorI($cliente, $Id) 
	{
		$query = $this->db->query('SELECT DISTINCT N.Id_Negociacion, NS.Id_NS, N.FechaP
								   FROM INSTITUCION AS I, NEGOCIACION AS N, EMPLEADO AS E, NS AS NS, SEGUIMIENTO AS S
								   WHERE N.Id_Institucion = I.Id_Institucion
								   AND E.Cedula = N.Id_Empleado
								   AND NS.Id_Negociacion = N.Id_Negociacion
								   AND S.Id_Seguimiento = NS.Id_Seguimiento
								   AND N.Id_Empleado = '.$Id.'
								   AND N.Id_Institucion = '.$cliente.'
								   AND S.Status = "Borrador"
								   AND N.Status <> 2
								   ORDER BY N.Id_Negociacion ASC');	
		
		return $query->result_array();	
	} 
	
	function NegociacionActivaI($cliente, $Id)
	{
		$query = $this->db->query('SELECT DISTINCT N.Id_Negociacion, NS.Id_NS, N.FechaP
								   FROM INSTITUCION AS I, NEGOCIACION AS N, EMPLEADO AS E, NS AS NS, SEGUIMIENTO AS S
								   WHERE N.Id_Institucion = I.Id_Institucion
								   AND E.Cedula = N.Id_Empleado
								   AND NS.Id_Negociacion = N.Id_Negociacion
								   AND S.Id_Seguimiento = NS.Id_Seguimiento
								   AND N.Id_Empleado = '.$Id.'
								   AND N.Id_Institucion = '.$cliente.'
								   AND S.Status = "Activa"
								   AND N.Status <> 2
								   ORDER BY N.Id_Negociacion ASC');	
		
		return $query->result_array();	
	} 
	
	function NegociacionGanadaI($cliente, $Id)
	{
		$query = $this->db->query('SELECT DISTINCT N.Id_Negociacion, NS.Id_NS, N.FechaP
								   FROM INSTITUCION AS I, NEGOCIACION AS N, EMPLEADO AS E, NS AS NS, SEGUIMIENTO AS S
								   WHERE N.Id_Institucion = I.Id_Institucion
								   AND E.Cedula = N.Id_Empleado
								   AND NS.Id_Negociacion = N.Id_Negociacion
								   AND S.Id_Seguimiento = NS.Id_Seguimiento
								   AND N.Id_Empleado = '.$Id.'
								   AND N.Id_Institucion = '.$cliente.'
								   AND S.Status = "Ganada"
								   AND N.Status <> 2
								   ORDER BY N.Id_Negociacion ASC');	
		
		return $query->result_array();	
	} 
	
	function NegociacionCerradaI($cliente, $Id)
	{
		$query = $this->db->query('SELECT DISTINCT N.Id_Negociacion, NS.Id_NS, N.FechaP
								   FROM INSTITUCION AS I, NEGOCIACION AS N, EMPLEADO AS E, NS AS NS, SEGUIMIENTO AS S
								   WHERE N.Id_Institucion = I.Id_Institucion
								   AND E.Cedula = N.Id_Empleado
								   AND NS.Id_Negociacion = N.Id_Negociacion
								   AND S.Id_Seguimiento = NS.Id_Seguimiento
								   AND N.Id_Empleado = '.$Id.'
								   AND N.Id_Institucion = '.$cliente.'
								   AND S.Status = "Cerrada"
								   AND N.Status <> 2
								   ORDER BY N.Id_Negociacion ASC');	
		
		return $query->result_array();	
	} 
	
	function NegociacionPerdidaI($cliente, $Id)
	{
		$query = $this->db->query('SELECT DISTINCT N.Id_Negociacion, NS.Id_NS, N.FechaP
								   FROM INSTITUCION AS I, NEGOCIACION AS N, EMPLEADO AS E, NS AS NS, SEGUIMIENTO AS S
								   WHERE N.Id_Institucion = I.Id_Institucion
								   AND E.Cedula = N.Id_Empleado
								   AND NS.Id_Negociacion = N.Id_Negociacion
								   AND S.Id_Seguimiento = NS.Id_Seguimiento
								   AND N.Id_Empleado = '.$Id.'
								   AND N.Id_Institucion = '.$cliente.'
								   AND S.Status = "Perdida"
								   AND N.Status <> 2
								   ORDER BY N.Id_Negociacion ASC');	
		
		return $query->result_array();	
	} 
	
	function ConsultarMaxId() 
	{
		$this->db->select_max('Id_HistorialNP'); 
		$query =  $this->db->get('historialnp');
		foreach ($query->result_array() as $row)
	{
		$id = $row['Id_HistorialNP'];
	}
		return $id;
    }
	
	function ConsultarPermiso($IdNegoBorrador) 
	{
		$query = $this->db->select("Status");
		$query = $this->db->where("Id_Negociacion", $IdNegoBorrador);
		$query = $this->db->get("NEGOCIACION");
		foreach ($query->result_array() as $row)
	{
		$status = $row['Status'];
	}
			return $status;
    }
	
	function NegociacionBorradorA($Cedula) 
	{
		$query = $this->db->query('SELECT DISTINCT (N.Id_Negociacion)
								   FROM NEGOCIACION AS N, SEGUIMIENTO AS S, NS AS NS
								   WHERE N.Id_Empleado = '.$Cedula.'
								   AND NS.Id_Seguimiento = S.Id_Seguimiento
							       AND NS.Id_Negociacion = N.Id_Negociacion
								   AND S.Status =  "Borrador"
								   AND N.Status <> 2
								   ORDER BY N.Id_Negociacion ASC');	
		
		return $query->result_array();	
	} 
	
	function NumeroBorradoresA($Cedula)
	{
		$query = $this->db->query('SELECT Count(N.Id_Negociacion) AS Numero
							       FROM NEGOCIACION AS N, SEGUIMIENTO AS S, NS AS NS
								   WHERE N.Id_Empleado = '.$Cedula.'
								   AND NS.Id_Seguimiento = S.Id_Seguimiento
							       AND NS.Id_Negociacion = N.Id_Negociacion
								   AND S.Status =  "Borrador"
								   AND N.Status <> 2
								   ORDER BY N.Id_Negociacion ASC');	
		
		foreach ($query->result_array() as $row)
	{
		$tipo = $row['Numero'];
	}
		return $tipo;
	}

	function NegociacionActivaA($Cedula)
	{
		$query = $this->db->query('SELECT DISTINCT (N.Id_Negociacion)
								   FROM NEGOCIACION AS N, SEGUIMIENTO AS S, NS AS NS
								   WHERE N.Id_Empleado = '.$Cedula.'
								   AND NS.Id_Seguimiento = S.Id_Seguimiento
							       AND NS.Id_Negociacion = N.Id_Negociacion
								   AND S.Status =  "Activa"
								   AND N.Status <> 2
								   ORDER BY N.Id_Negociacion ASC');	
		
		return $query->result_array();	
	} 
	
	function NegociacionActivaA2($Cedula)
	{
		$query = $this->db->query('SELECT DISTINCT (N.Id_Negociacion)
								   FROM NEGOCIACION AS N, SEGUIMIENTO AS S, NS AS NS
								   WHERE N.Id_Empleado = '.$Cedula.'
								   AND NS.Id_Seguimiento = S.Id_Seguimiento
							       AND NS.Id_Negociacion = N.Id_Negociacion
								   AND S.Status =  "Activa"
								   AND N.Status <> 2
								   AND ((S.Porcentaje = 75) || (S.Porcentaje = 90))
								   ORDER BY N.Id_Negociacion ASC');	
		
		return $query->result_array();	
	} 
	
	function NumeroActivasA($Cedula)
	{
		$query = $this->db->query('SELECT Count(N.Id_Negociacion) AS Numero
							       FROM NEGOCIACION AS N, SEGUIMIENTO AS S, NS AS NS
								   WHERE N.Id_Empleado = '.$Cedula.'
								   AND NS.Id_Seguimiento = S.Id_Seguimiento
							       AND NS.Id_Negociacion = N.Id_Negociacion
								   AND S.Status =  "Activa"
								   AND N.Status <> 2
								   ORDER BY N.Id_Negociacion ASC');	
		
		foreach ($query->result_array() as $row)
	{
		$tipo = $row['Numero'];
	}
		return $tipo;
	}
	
	function NegociacionGanadaA($Cedula)
	{
		$query = $this->db->query('SELECT DISTINCT (N.Id_Negociacion)
								   FROM NEGOCIACION AS N, SEGUIMIENTO AS S, NS AS NS
								   WHERE N.Id_Empleado = '.$Cedula.'
								   AND NS.Id_Seguimiento = S.Id_Seguimiento
							       AND NS.Id_Negociacion = N.Id_Negociacion
								   AND S.Status =  "Ganada"
								   AND N.Status <> 2
								   ORDER BY N.Id_Negociacion ASC');	
		
		return $query->result_array();	
	} 
	
	function NumeroGanadasA($Cedula)
	{
		$query = $this->db->query('SELECT Count(N.Id_Negociacion) AS Numero
							       FROM NEGOCIACION AS N, SEGUIMIENTO AS S, NS AS NS
								   WHERE N.Id_Empleado = '.$Cedula.'
								   AND NS.Id_Seguimiento = S.Id_Seguimiento
							       AND NS.Id_Negociacion = N.Id_Negociacion
								   AND S.Status =  "Ganada"
								   AND N.Status <> 2
								   ORDER BY N.Id_Negociacion ASC');	
		
		foreach ($query->result_array() as $row)
	{
		$tipo = $row['Numero'];
	}
		return $tipo;
	}
	
	function NegociacionCerradaA($Cedula)
	{
		$query = $this->db->query('SELECT DISTINCT (N.Id_Negociacion)
								   FROM NEGOCIACION AS N, SEGUIMIENTO AS S, NS AS NS
								   WHERE N.Id_Empleado = '.$Cedula.'
								   AND NS.Id_Seguimiento = S.Id_Seguimiento
							       AND NS.Id_Negociacion = N.Id_Negociacion
								   AND S.Status =  "Cerrada"
								   AND N.Status <> 2
								   ORDER BY N.Id_Negociacion ASC');	
		
		return $query->result_array();	
	} 
	
	function NumeroCerradasA($Cedula)
	{
		$query = $this->db->query('SELECT Count(N.Id_Negociacion) AS Numero
							       FROM NEGOCIACION AS N, SEGUIMIENTO AS S, NS AS NS
								   WHERE N.Id_Empleado = '.$Cedula.'
								   AND NS.Id_Seguimiento = S.Id_Seguimiento
							       AND NS.Id_Negociacion = N.Id_Negociacion
								   AND S.Status =  "Cerrada"
								   AND N.Status <> 2
								   ORDER BY N.Id_Negociacion ASC');	
		
		foreach ($query->result_array() as $row)
	{
		$tipo = $row['Numero'];
	}
		return $tipo;
	}

	function NegociacionPerdidaA($Cedula)
	{
		$query = $this->db->query('SELECT DISTINCT (N.Id_Negociacion)
								   FROM NEGOCIACION AS N, SEGUIMIENTO AS S, NS AS NS
								   WHERE N.Id_Empleado = '.$Cedula.'
								   AND NS.Id_Seguimiento = S.Id_Seguimiento
							       AND NS.Id_Negociacion = N.Id_Negociacion
								   AND S.Status =  "Perdida"
								   AND N.Status <> 2
								   ORDER BY N.Id_Negociacion ASC');	
		
		return $query->result_array();	
	} 
	
	function NumeroPerdidasA($Cedula)
	{
		$query = $this->db->query('SELECT Count(N.Id_Negociacion) AS Numero
							       FROM NEGOCIACION AS N, SEGUIMIENTO AS S, NS AS NS
								   WHERE N.Id_Empleado = '.$Cedula.'
								   AND NS.Id_Seguimiento = S.Id_Seguimiento
							       AND NS.Id_Negociacion = N.Id_Negociacion
								   AND S.Status =  "Perdida"
								   AND N.Status <> 2
								   ORDER BY N.Id_Negociacion ASC');	
		
		foreach ($query->result_array() as $row)
	{
		$tipo = $row['Numero'];
	}
		return $tipo;
	}
	
	function BuscarCliente($Id_Negociacion) 
	{
		$query = $this->db->select("Id_Cliente");
		$query = $this->db->where("Id_Negociacion", $Id_Negociacion);
		$query = $this->db->get("negociacion");
		foreach ($query->result_array() as $row)
	{
		$Id = $row['Id_Cliente'];
	}
		return $Id;
	}
	
	function BuscarClienteI($Id_Negociacion)
	{
		$query = $this->db->select("Id_Institucion");
		$query = $this->db->where("Id_Negociacion", $Id_Negociacion);
		$query = $this->db->get("negociacion");
		foreach ($query->result_array() as $row)
	{
		$Id = $row['Id_Institucion'];
	}
		return $Id;
	}
	
	function HistorialLista($Negociacion) 
	{
		$query = $this->db->query('SELECT H.FechaS, H.TipoS, H.Resumen, H.Status
								   FROM Historial_Ns AS H
								   WHERE H.Id_Negociacion = '.$Negociacion.'
								   ORDER BY H.FechaS DESC');	
		
		return $query->result_array();		
	} 
	
	function UltimaAlerta($IdNegoBorrador) 
	{	
		$query = $this->db->select("Contador");
		$query = $this->db->where("Id_Negociacion", $IdNegoBorrador);
		$query = $this->db->get("Alerta");
		foreach ($query->result_array() as $row)
	{
		$contador = $row['Contador'];
	}
		return $contador;
	}
	
	function UltimaMod($IdNegoBorrador) 
	{	
		$query = $this->db->select("Contador");
		$query = $this->db->where("Id_Negociacion", $IdNegoBorrador);
		$query = $this->db->get("AlertaMod");
		foreach ($query->result_array() as $row)
	{
		$contador = $row['Contador'];
	}
		return $contador;
	}
	
	function BuscarExiste($Id_Negociacion2) 
	{
		$query = $this->db->select("Id_Negociacion");
		$query = $this->db->where("Id_Negociacion", $Id_Negociacion2);
		$query = $this->db->get("Negociacion");
		foreach ($query->result_array() as $row)
		{
			$status = $row['Id_Negociacion'];
			
			if ($status == NULL)
			{
				return false;
			}
			else
			{
				return $status;
			}
		}	
	}	
	
	## UPDATE ##
	
	function ModificarStatus($Seguimiento, $datos) 
	{	
		$Seguimiento->FechaS = $_POST['FechaC'];
		$Seguimiento->TipoS = $_POST['TipoC'];
		$Seguimiento->Resumen = $_POST['ResumenC'];
		$Seguimiento->Status = $_POST['StatusC'];
		$id = $datos['ID2'];
		$this->db->where("Id_Seguimiento", $id);
		$this->db->update('Seguimiento', $Seguimiento);
		
		$Status = $_POST['StatusC'];
		if($Status == "Borrador")
		{
			$Seguimiento2 = new ModelNegociacion;
			$Seguimiento2->Porcentaje = '25';
			$this->db->where("Id_Seguimiento", $id);
			$this->db->update('Seguimiento', $Seguimiento2);
		}
		if($Status == "Activa")
		{
			$Seguimiento2 = new ModelNegociacion;
			$Seguimiento2->Porcentaje = $_POST['SubStatus'];
			$this->db->where("Id_Seguimiento", $id);
			$this->db->update('Seguimiento', $Seguimiento2);
		}
		if($Status == "Ganada")
		{
			$Seguimiento2 = new ModelNegociacion;
			$Seguimiento2->Porcentaje = '100';
			$this->db->where("Id_Seguimiento", $id);
			$this->db->update('Seguimiento', $Seguimiento2);
		}
		if($Status == "Perdida")
		{
			$Seguimiento2 = new ModelNegociacion;
			$Seguimiento2->Porcentaje = '0';
			$this->db->where("Id_Seguimiento", $id);
			$this->db->update('Seguimiento', $Seguimiento2);
		}
	}
	
	function RechazoStatus($Negociacion, $datos) 
	{
		$Negociacion->Status = 4;
		
		$IdNegoBorrador = $datos['ID2'];
		$this->db->where("Id_Negociacion", $IdNegoBorrador);
		$this->db->update('Negociacion', $Negociacion);
	}
	
	function Desbloqueo($Negociacion, $datos) 
	{
		$Negociacion->Status = 1;
		
		$IdNegoBorrador = $datos['ID2'];
		$this->db->where("Id_Negociacion", $IdNegoBorrador);
		$this->db->update('Negociacion', $Negociacion);
	}
	
	function ModificarDatos($negociacion, $datos) 
	{
		if(isset($_POST['checkbox']))
		{
			$negociacion->FechaP = $_POST['FechaP'];
		}
		
		if(isset($_POST['checkbox2']))
		{
			$negociacion->NumeroODC = $_POST['NumeroODC'];
		}
		
		if(isset($_POST['checkbox3']))
		{
			$negociacion->FechaODC = $_POST['FechaODC'];
		}
		
		if(isset($_POST['checkbox4']))
		{
			$negociacion->Banco = $_POST['Banco'];
		}
		
		if(isset($_POST['checkbox5']))
		{
			$negociacion->PagoInicial = $_POST['PagoInicial'];
		}
		
		if(isset($_POST['checkbox6']))
		{
			$negociacion->CondicionesPago = $_POST['CondicionesPago'];
		}
		
		if(isset($_POST['checkbox7']))
		{
			$negociacion->FechaPago = $_POST['FechaPago'];
		}
		
		if(isset($_POST['checkbox8']))
		{
			$negociacion->NDeposito = $_POST['NDeposito'];
		}
		
		$id = $datos['ID2'];
		$this->db->where("Id_Negociacion", $id);
		$this->db->update('Negociacion', $negociacion);
	}
	
	function ModificarEstatus($negociacion, $datos) 
	{
		$negociacion->Status = 2;
		
		$Id_Negociacion = $datos['ID2'];
		$this->db->where("Id_Negociacion", $Id_Negociacion);
		$this->db->update('Negociacion', $negociacion);
	}
	
	function ModificarEstatus2($negociacion, $datos) 
	{
		$negociacion->Status = 3;
		if($_POST['numero2'] == NULL)
		{
			$negociacion->Descuento = NULL;
		}
		else
		{
			$negociacion->Descuento = $_POST['numero2'];
		}
		$negociacion->Total = $_POST['resultado2'];
		
		$Id_Negociacion = $datos['ID2'];
		$this->db->where("Id_Negociacion", $Id_Negociacion);
		$this->db->update('Negociacion', $negociacion);
	}
	
	function ModificarEstatus3($negociacion, $datos) 
	{
		$negociacion->Status = 1;
		
		$Id_Negociacion = $datos['ID2'];
		$this->db->where("Id_Negociacion", $Id_Negociacion);
		$this->db->update('Negociacion', $negociacion);
	}
	
	function ModificarAlerta($Alerta, $datos) 
	{	
		$IdNegoBorrador = $datos['ID2'];
		$Alerta->Status = 1;
		$Alerta->Contador = $this->modelNegociacion->UltimaAlerta($IdNegoBorrador) + 1;
		
		$this->db->where("Id_Negociacion", $IdNegoBorrador);
		$this->db->update('Alerta', $Alerta);
	}
	
	function ModificarA($Alerta, $datos) 
	{	
		$Alerta->Status = 0;
		
		$IdNegoBorrador = $datos['ID2'];
		$this->db->where("Id_Negociacion", $IdNegoBorrador);
		$this->db->update('Alerta', $Alerta);
	}
	
	function ModificarAlertaM($Alerta, $datos) 
	{	
		$IdNegoBorrador = $datos['ID2'];
		$Alerta->Contador = $this->modelNegociacion->UltimaMod($IdNegoBorrador) + 1;
		
		$this->db->where("Id_Negociacion", $IdNegoBorrador);
		$this->db->update('AlertaMod', $Alerta);
	}
	
	## DELETE ##
	
	function EliminarP($Equipo) 
	{
		$this->db->where("Id_HistorialNP2", $Equipo);
		$this->db->delete("historialnp2");				
	}
	
	function EliminarP2($Equipo) 
	{
		$this->db->where("Id_HistorialNP", $Equipo);
		$this->db->delete("historialnp");				
	}
	
}