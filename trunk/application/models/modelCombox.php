<?php

class ModelCombox extends CI_Model {

	function __construct()
	{
     	parent::__construct();
    }
	
	## INSERT ##
	
	function InsertarPdf($data) 
	{
		$this->db->insert('database', $data);
	} 
	
	## SELECT ##
	
	function ConsultarDirectorio()
	{
		$query = $this->db->query('SELECT `Id_Database` , `Nombre` , `Directorio`
FROM `database`');	
		
		return $query->result_array();	
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
	
	function ComboLineas($id)
	{
		$query = $this->db->query('SELECT DISTINCT(L.Id_Linea), L.Nombre FROM Linea AS L, Marca_Linea AS ML, ML_Equipo AS ME, Marca AS M WHERE L.Id_Linea = ML.Id_Linea AND ML.Id_Marca_Linea = ME.Id_Marca_Linea AND M.Id_Marca = ML.Id_Marca AND M.Id_Marca = '.$id.'');		
		return $query->result_array();
	}
	
	function ComboEquipos($id2)
	{
		$query = $this->db->query('SELECT DISTINCT(E.Id_Equipo), E.Nombre
								   FROM Equipo AS E, ML_Equipo AS ME, Marca_Linea AS ML, Linea AS L
								   WHERE E.Id_Equipo = ME.Id_Equipo
								   AND ME.Id_Marca_Linea = ML.Id_Marca_Linea
								   AND L.Id_Linea = ML.Id_Linea
								   AND L.Id_Linea = '.$id2.'');		
		return $query->result_array();
	}
	
	function ComboAccesorios($id)
	{
		$query = $this->db->query('SELECT DISTINCT(A.Id_Accesorio), A.Nombre, A.Descripcion FROM Accesorio AS A, AEquipo AS AE WHERE A.Id_Accesorio = AE.Id_Accesorio AND AE.Id_Equipo = '.$id.'');		
		return $query->result_array();
	}
	
}
