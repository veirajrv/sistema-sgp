<?php

class ModelVenta extends CI_Model 
{

	function __construct()
	{
     	parent::__construct();
    }
	
	function NegoGanadas()
	{
		$query = $this->db->query('SELECT N.Id_Negociacion
								   FROM NEGOCIACION AS N, SEGUIMIENTO AS S, NS AS NS 
								   WHERE NS.Id_Negociacion = N.Id_Negociacion
								   AND NS.Id_Seguimiento = S.Id_Seguimiento
								   AND S.Status = "Ganada"
								   ORDER BY N.Id_Negociacion');	
		
		return $query->result_array();	
	} 
	
	function CrearOrden($venta)
	{
		$this->db->insert('ventanego', $venta);
	} 
	
	function ConsultarNego($Id_Negociacion) 
	{
		$query = $this->db->select("Id_VentaNego");
		$query = $this->db->where("Id_Negociacion", $Id_Negociacion);
		$query = $this->db->get("ventanego");
		foreach ($query->result_array() as $row)
	{
		$id = $row['Id_VentaNego'];
	}
		return $id;
	}
	
}