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
}