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
	
	function NoFacturadas()
	{
		$query = $this->db->query('SELECT N.Id_Negociacion
								   FROM NEGOCIACION AS N, SEGUIMIENTO AS S, NS AS NS, VENTANEGO AS VN
								   WHERE NS.Id_Negociacion = N.Id_Negociacion
								   AND NS.Id_Seguimiento = S.Id_Seguimiento
								   AND VN.Id_Negociacion = N.Id_Negociacion
								   AND S.Status = "Ganada"
								   AND VN.Final = 0
								   ORDER BY N.Id_Negociacion');	
		
		return $query->result_array();	
	} 
	
	function NumNoFacturadas()
	{
		$query = $this->db->query('SELECT COUNT(N.Id_Negociacion) AS NumeroNoF
								   FROM NEGOCIACION AS N, SEGUIMIENTO AS S, NS AS NS, VENTANEGO AS VN
								   WHERE NS.Id_Negociacion = N.Id_Negociacion
								   AND NS.Id_Seguimiento = S.Id_Seguimiento
								   AND VN.Id_Negociacion = N.Id_Negociacion
								   AND S.Status = "Ganada"
								   AND VN.Final = 0
								   ORDER BY N.Id_Negociacion');	
		
		foreach ($query->result_array() as $row)
	{
		$num = $row['NumeroNoF'];
	}
		return $num;
	} 
	
	function NumFacturadas()
	{
		$query = $this->db->query('SELECT COUNT(N.Id_Negociacion) AS NumeroSiF
								   FROM NEGOCIACION AS N, SEGUIMIENTO AS S, NS AS NS, VENTANEGO AS VN
								   WHERE NS.Id_Negociacion = N.Id_Negociacion
								   AND NS.Id_Seguimiento = S.Id_Seguimiento
								   AND VN.Id_Negociacion = N.Id_Negociacion
								   AND S.Status = "Cerrada"
								   AND VN.Final = 1
								   ORDER BY N.Id_Negociacion');	
		
		foreach ($query->result_array() as $row)
	{
		$num = $row['NumeroSiF'];
	}
		return $num;
	} 
	
	function NumNegoGanadas()
	{
		$query = $this->db->query('SELECT COUNT(N.Id_Negociacion) AS NumeroF
								   FROM NEGOCIACION AS N, SEGUIMIENTO AS S, NS AS NS
								   WHERE NS.Id_Negociacion = N.Id_Negociacion
								   AND NS.Id_Seguimiento = S.Id_Seguimiento
								   AND S.Status = "Ganada"');	
		
		foreach ($query->result_array() as $row)
	{
		$num = $row['NumeroF'];
	}
		return $num;
	} 
	
	function IdSeguimiento($Id_Negociacion)
	{
		$query = $this->db->query('SELECT S.Id_Seguimiento
								   FROM NEGOCIACION AS N, SEGUIMIENTO AS S, NS AS NS 
								   WHERE NS.Id_Negociacion = N.Id_Negociacion
								   AND NS.Id_Seguimiento = S.Id_Seguimiento
								   AND N.Id_Negociacion = '.$Id_Negociacion.'
								   ORDER BY N.Id_Negociacion');	
		
		foreach ($query->result_array() as $row)
	{
		$id = $row['Id_Seguimiento'];
	}
		return $id;
	} 
	
	function CrearOrden($venta)
	{
		$this->db->insert('ventanego', $venta);
	} 
	
	function Facturar($venta)
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
			if($row['Id_VentaNego'] == NULL)
			{
				return TRUE;
			}
			else
			{
				$id = $row['Id_VentaNego'];	
				return $id;
			}
		}
	}
	
	function ModificarStatus($Facturar, $datos) 
	{
		$Facturar->Status = "Cerrada";
		
		$IdSegui = $datos['ID2'];
		$this->db->where("Id_Seguimiento", $IdSegui);
		$this->db->update('Seguimiento', $Facturar);
	}
	
	function ModificarStatus2($Facturar2, $datos) 
	{
		$Facturar2->Status = "Facturada";
		$Facturar2->Final = "1";
		
		$Id = $datos['ID2'];
		$this->db->where("Id_VentaNego", $Id);
		$this->db->update('VentaNego', $Facturar2);
	}
	
	function ConsultarLista()
	{
		$query = $this->db->query('SELECT V.Id_VentaNego, V.Id_Negociacion
								   FROM VENTANEGO AS V
								   WHERE V.Status = "Enviada a compra"
								   ORDER BY V.Id_VentaNego');	
		
		return $query->result_array();	
	} 
	
	function ConsultarLista2()
	{
		$query = $this->db->query('SELECT V.Id_VentaNego, V.Id_Negociacion
								   FROM VENTANEGO AS V
								   WHERE V.Status = "Facturada"
								   ORDER BY V.Id_VentaNego');	
		
		return $query->result_array();	
	} 
	
}