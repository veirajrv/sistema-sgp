<?php

class ModelReporte extends CI_Model 
{

	function __construct()
	{
     	parent::__construct();
    }
	
	function BuscarClientes()
	{
		$query = $this->db->query('SELECT C.Nombre, C.Apellido, C.Cedula, C.Rif, C.Email, C.CPostal, C.Telefono, C.Telefono2, C.Especialidad, C.Web, C.Departamento, C.Twitter, C.Facebook, C.Googleplus, C.Direccion
								   FROM CLIENTE AS C
								   ORDER BY C.Nombre ASC ');	
		
		return $query->result_array();	
	} 
	
	function BuscarClientesTipo($tipo)
	{
		$query = $this->db->query('SELECT E.Nombre_1, E.Apellido_1, C.Nombre, C.Apellido, C.Email, C.Telefono, N.Id_Negociacion, N.FechaP, S.Status
								   FROM CLIENTE AS C, EMPLEADO AS E, NEGOCIACION AS N, SEGUIMIENTO AS S, NS AS NS
								   WHERE N.Id_Cliente = C.Id_Cliente
								   AND N.Id_Empleado = E.Cedula
								   AND N.Id_Negociacion = NS.Id_Negociacion
								   AND NS.Id_Seguimiento = S.Id_Seguimiento
								   AND C.Tipo_C =  "'.$tipo.'"');	
		
		return $query->result_array();	
	}
	
	function BuscarInstitucionesTipo($tipo)
	{
		$query = $this->db->query('SELECT E.Nombre_1, E.Apellido_1, I.Nombre, I.Web, I.Telefono1, N.Id_Negociacion, N.FechaP, S.Status
								   FROM INSTITUCION AS I, EMPLEADO AS E, NEGOCIACION AS N, SEGUIMIENTO AS S, NS AS NS
								   WHERE N.Id_Institucion = I.Id_Institucion
								   AND N.Id_Empleado = E.Cedula
								   AND N.Id_Negociacion = NS.Id_Negociacion
								   AND NS.Id_Seguimiento = S.Id_Seguimiento
								   AND I.Tipo_I =  "'.$tipo.'"');	
		
		return $query->result_array();	
	}
	
	function BuscarClientesTipoStatus($tipo)
	{
		$query = $this->db->query('SELECT E.Nombre_1, E.Apellido_1, C.Nombre, C.Apellido, C.Email, C.Telefono, C.Tipo_C, N.Id_Negociacion, N.FechaP, S.Status
								   FROM CLIENTE AS C, EMPLEADO AS E, NEGOCIACION AS N, SEGUIMIENTO AS S, NS AS NS
								   WHERE N.Id_Cliente = C.Id_Cliente
								   AND N.Id_Empleado = E.Cedula
								   AND N.Id_Negociacion = NS.Id_Negociacion
								   AND NS.Id_Seguimiento = S.Id_Seguimiento
								   AND S.Porcentaje =  "'.$tipo.'"
								   ORDER BY C.Tipo_C');		
		
		return $query->result_array();	
	}
	
	function BuscarInstitucionesTipoStatus($tipo)
	{
		$query = $this->db->query('SELECT E.Nombre_1, E.Apellido_1, I.Nombre, I.Web, I.Telefono1, I.Tipo_I, N.Id_Negociacion, N.FechaP, S.Status
								   FROM INSTITUCION AS I, EMPLEADO AS E, NEGOCIACION AS N, SEGUIMIENTO AS S, NS AS NS
								   WHERE N.Id_Institucion = I.Id_Institucion
								   AND N.Id_Empleado = E.Cedula
								   AND N.Id_Negociacion = NS.Id_Negociacion
								   AND NS.Id_Seguimiento = S.Id_Seguimiento
								   AND S.Porcentaje =  "'.$tipo.'"
								   ORDER BY I.Tipo_I');		
		
		return $query->result_array();	
	}
	
	function BuscarInstituciones()
	{
		$query = $this->db->query('SELECT I.Nombre, I.Rif, I.Web, I.CodigoP, I.Telefono1, I.Telefono2, I.Twitter, I.Facebook, I.Googleplus, I.Direccion1
								   FROM INSTITUCION AS I
								   ORDER BY I.Nombre ASC ');	
		
		return $query->result_array();	
	} 
	
	function BuscarMarcas()
	{
		$query = $this->db->query('SELECT M.Nombre
								   FROM MARCA AS M
								   ORDER BY M.Nombre ASC ');	
		
		return $query->result_array();	
	} 
	
	function BuscarLineas()
	{
		$query = $this->db->query('SELECT M.Nombre as Marca, L.Nombre as Linea
								   FROM MARCA AS M, LINEA AS L, MARCA_LINEA AS ML
								   WHERE M.Id_Marca = ML.Id_Marca
								   AND L.Id_Linea = ML.Id_Linea
								   ORDER BY L.Nombre ASC ');	
		
		return $query->result_array();	
	} 
	
	function BuscarEquipos()
	{
		$query = $this->db->query('SELECT M.Nombre as Marca, L.Nombre as Linea, E.Nombre as Equipo, E.Precio, E.Descripcion
								   FROM MARCA AS M, LINEA AS L, MARCA_LINEA AS ML, EQUIPO AS E, ML_EQUIPO AS ME
								   WHERE M.Id_Marca = ML.Id_Marca
								   AND ML.Id_Marca_Linea = ME.Id_Marca_Linea
								   AND ME.Id_Equipo = E.Id_Equipo
								   AND L.Id_Linea = ML.Id_Linea
								   ORDER BY L.Nombre ASC ');	
		
		return $query->result_array();	
	} 
	
	function BuscarAccesorios()
	{
		$query = $this->db->query('SELECT M.Nombre as Marca, L.Nombre as Linea, E.Nombre as Equipo, A.Nombre as Accesorio, A.Precio, A.Descripcion
								   FROM MARCA AS M, LINEA AS L, MARCA_LINEA AS ML, EQUIPO AS E, ML_EQUIPO AS ME, AEQUIPO AS AE, ACCESORIO AS A
								   WHERE M.Id_Marca = ML.Id_Marca
								   AND ML.Id_Marca_Linea = ME.Id_Marca_Linea
								   AND ME.Id_Equipo = E.Id_Equipo
								   AND L.Id_Linea = ML.Id_Linea
								   AND AE.Id_Equipo = ME.Id_Equipo
								   AND AE.Id_Accesorio = A.Id_Accesorio
								   ORDER BY E.Nombre ASC');	
		
		return $query->result_array();	
	} 
	
	function BuscarEmpleados()
	{
		$query = $this->db->query('SELECT E.Usuario, E.Nombre_1, E.Apellido_1, E.Apellido_2, E.Fecha_Ingreso, E.Correo, E.Telf_Casa, E.Telf_Ofi, E.Telf_Cel
								   FROM EMPLEADO AS E
								   ORDER BY E.Nombre_1 ASC ');	
		
		return $query->result_array();	
	} 
	
	function BuscarNegociaciones()
	{
		$query = $this->db->query('SELECT N.Id_Negociacion, N.FechaP, N.NumeroODC, N.FechaODC, N.Banco, N.PagoInicial, N.CondicionesPago, N.FechaPago, N.NDeposito, N.Total, S.Status, E.Nombre_1, E.Apellido_1
								   FROM NEGOCIACION AS N, SEGUIMIENTO AS S, NS AS NS, EMPLEADO AS E
								   WHERE NS.Id_Negociacion = N.Id_Negociacion
								   AND NS.Id_Seguimiento = S.Id_Seguimiento
								   AND E.Cedula = N.Id_Empleado
								   ORDER BY N.Id_Negociacion ASC ');	
		
		return $query->result_array();	
	} 
	
	function BuscarClientesEspecial($especialidad)
	{
		$query = $this->db->query('SELECT C.Nombre, C.Apellido, C.Cedula, C.Rif, C.Email, C.CPostal, C.Telefono, C.Telefono2, C.Especialidad, C.Web, C.Departamento, C.Twitter, C.Facebook, C.Googleplus, C.Direccion
								   FROM CLIENTE AS C
								   WHERE C.Especialidad = "'.$especialidad.'"
								   ORDER BY C.Nombre ASC ');	
		
		return $query->result_array();	
	} 
	
	function BuscarInstitucionesEspecial($especialidad)
	{
		$query = $this->db->query('SELECT I.Nombre, I.Rif, I.Web, I.CodigoP, I.Telefono1, I.Telefono2, I.Twitter, I.Facebook, I.Googleplus, I.Direccion1
								   FROM INSTITUCION AS I
								   WHERE I.Especialidad = "'.$especialidad.'"
								   ORDER BY I.Nombre ASC ');	
		
		return $query->result_array();	
	} 
	
	function BuscarClientesSexo($sexo)
	{
		$query = $this->db->query('SELECT C.Nombre, C.Apellido, C.Cedula, C.Rif, C.Email, C.CPostal, C.Telefono, C.Telefono2, C.Especialidad, C.Web, C.Departamento, C.Twitter, C.Facebook, C.Googleplus, C.Direccion
								   FROM CLIENTE AS C
								   WHERE C.Sexo = "'.$sexo.'"
								   ORDER BY C.Nombre ASC ');	
		
		return $query->result_array();	
	} 
	
	function NumeroNegociaciones()
	{
		$query = $this->db->query('SELECT MAX(Cuenta) as Max FROM (SELECT COUNT( N.Id_Negociacion ) AS Cuenta, N.Id_Cliente AS id
								   FROM NEGOCIACION AS N
								   WHERE N.Id_Cliente IS NOT NULL 
								   GROUP BY N.Id_Cliente) AS Maximo');	
		
		foreach ($query->result_array() as $row)
	{
		$max = $row['Max'];
	}
		return $max;
	} 
	
	function NumeroNegociacionesIns()
	{
		$query = $this->db->query('SELECT MAX(Cuenta) as Max FROM (SELECT COUNT( N.Id_Negociacion ) AS Cuenta, N.Id_Institucion AS id
								   FROM NEGOCIACION AS N
								   WHERE N.Id_Institucion IS NOT NULL 
								   GROUP BY N.Id_Institucion) AS Maximo');	
		
		foreach ($query->result_array() as $row)
	{
		$max = $row['Max'];
	}
		return $max;
	} 
	
	function NumeroNegociaciones2()
	{
		$query = $this->db->query('SELECT MIN(Cuenta) as Min FROM (SELECT COUNT( N.Id_Negociacion ) AS Cuenta, N.Id_Cliente AS id
								   FROM NEGOCIACION AS N
								   WHERE N.Id_Cliente IS NOT NULL 
								   GROUP BY N.Id_Cliente) AS Minimo');	
		
		foreach ($query->result_array() as $row)
	{
		$min = $row['Min'];
	}
		return $min;
	} 
	
	function NumeroNegociaciones2Ins()
	{
		$query = $this->db->query('SELECT MIN(Cuenta) as Min FROM (SELECT COUNT( N.Id_Negociacion ) AS Cuenta, N.Id_Institucion AS id
								   FROM NEGOCIACION AS N
								   WHERE N.Id_Institucion IS NOT NULL 
								   GROUP BY N.Id_Institucion) AS Minimo');	
		
		foreach ($query->result_array() as $row)
	{
		$min = $row['Min'];
	}
		return $min;
	} 
	
	function BuscarNegoClientes($Id)
	{
		$query = $this->db->query('SELECT COUNT( N.Id_Negociacion ) AS Cuenta, N.Id_Cliente, C.Nombre, C.Apellido, C.Cedula, C.Rif, C.Email, C.CPostal, C.Telefono, C.Telefono2, C.Especialidad, C.Web, C.Departamento, C.Twitter, C.Facebook, C.Googleplus, C.Direccion
								   FROM CLIENTE AS C, NEGOCIACION AS N
								   WHERE N.Id_Cliente = C.Id_Cliente
								   GROUP BY N.Id_Cliente
								   HAVING Cuenta = '.$Id.'');	
		
		return $query->result_array();	
	} 
	
	function BuscarNegoInstituciones($Id)
	{
		$query = $this->db->query('SELECT COUNT( N.Id_Negociacion ) AS Cuenta, N.Id_Institucion, I.Nombre, I.Rif, I.Web, I.CodigoP, I.Telefono1, I.Telefono2, I.Twitter, I.Facebook, I.Googleplus, I.Direccion1
								   FROM INSTITUCION AS I, NEGOCIACION AS N
								   WHERE N.Id_Institucion = I.Id_Institucion
								   GROUP BY N.Id_Institucion
								   HAVING Cuenta = '.$Id.'');	
		
		return $query->result_array();	
	} 
	
	function BuscarNegoClientesBAGCP($Porcentaje)
	{
		$query = $this->db->query('SELECT COUNT( N.Id_Negociacion ) AS Cuenta, N.Id_Cliente, C.Nombre, C.Apellido, C.Cedula, C.Rif, C.Email, C.CPostal, C.Telefono, C.Telefono2, C.Especialidad, C.Web, C.Departamento, C.Twitter, C.Facebook, C.Googleplus, C.Direccion
								   FROM CLIENTE AS C, NEGOCIACION AS N, NS AS NS, SEGUIMIENTO AS S
								   WHERE N.Id_Cliente = C.Id_Cliente
								   AND NS.Id_Negociacion = N.Id_Negociacion
								   AND NS.Id_Seguimiento = S.Id_Seguimiento
								   AND S.Porcentaje =  '.$Porcentaje.'
								   GROUP BY N.Id_Cliente
								   ORDER BY Cuenta');	
		
		return $query->result_array();	
	} 
	
	function BuscarNegoInstitucionesBAGCP($Porcentaje)
	{
		$query = $this->db->query('SELECT COUNT( N.Id_Negociacion ) AS Cuenta, N.Id_Institucion, I.Nombre, I.Rif, I.Web, I.CodigoP, I.Telefono1, I.Telefono2, I.Twitter, I.Facebook, I.Googleplus, I.Direccion1
								   FROM INSTITUCION AS I, NEGOCIACION AS N, NS AS NS, SEGUIMIENTO AS S
								   WHERE N.Id_Institucion = I.Id_Institucion
								   AND NS.Id_Negociacion = N.Id_Negociacion
								   AND NS.Id_Seguimiento = S.Id_Seguimiento
								   AND S.Porcentaje =  '.$Porcentaje.'
								   GROUP BY N.Id_Institucion
								   ORDER BY Cuenta');	
		
		return $query->result_array();	
	} 
	
	function BuscarNegoEmpleadoTipo($Porcentaje)
	{
		$query = $this->db->query('SELECT E.Nombre_1, E.Apellido_1, C.Email, C.Telefono, N.Id_Negociacion, N.Id_Empleado, N.FechaP, N.Total, S.Status
								   FROM EMPLEADO AS E, NEGOCIACION AS N, NS AS NS, SEGUIMIENTO AS S, CLIENTE AS C
								   WHERE N.Id_Empleado = E.Cedula
								   AND NS.Id_Negociacion = N.Id_Negociacion
								   AND NS.Id_Seguimiento = S.Id_Seguimiento
								   AND C.Id_Cliente = N.Id_Cliente
								   AND S.Porcentaje = '.$Porcentaje.'
								   ORDER BY N.Id_Negociacion');	
		
		return $query->result_array();	
	} 
	
	function BuscarNegociacionesEspecial($especialidad)
	{
		$query = $this->db->query('SELECT C.Nombre, C.Apellido, C.Telefono, C.Email, S.Status, N.Id_Negociacion, E.Nombre_1, E.Apellido_1, N.Total
								   FROM EMPLEADO AS E, NEGOCIACION AS N, NS AS NS, SEGUIMIENTO AS S, CLIENTE AS C
								   WHERE C.Id_Cliente = N.Id_Cliente
								   AND NS.Id_Negociacion = N.Id_Negociacion
								   AND NS.Id_Seguimiento = S.Id_Seguimiento
								   AND E.Cedula = N.Id_Empleado
								   AND C.Especialidad =  "'.$especialidad.'"
								   ORDER BY N.Id_Negociacion');	
		
		return $query->result_array();	
	} 
	
	function BuscarNegociacionesEspecialI($especialidad)
	{
		$query = $this->db->query('SELECT I.Nombre, I.Telefono1, I.Web, S.Status, N.Id_Negociacion, E.Nombre_1, E.Apellido_1, N.Total
								   FROM EMPLEADO AS E, NEGOCIACION AS N, NS AS NS, SEGUIMIENTO AS S, INSTITUCION AS I
								   WHERE I.Id_Institucion = N.Id_Institucion
								   AND NS.Id_Negociacion = N.Id_Negociacion
								   AND NS.Id_Seguimiento = S.Id_Seguimiento
								   AND E.Cedula = N.Id_Empleado
								   AND I.Especialidad =  "'.$especialidad.'"
								   ORDER BY N.Id_Negociacion');	
		
		return $query->result_array();	
	} 
	
	
}