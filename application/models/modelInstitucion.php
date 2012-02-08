<?php

class ModelInstitucion extends CI_Model {

	function __construct()
	{
     	parent::__construct();
    }
	
	## INSERT ##

	function InsertarInstitucion($datos)
	{		
		$this->db->insert('Institucion', $datos);
	}
	
	## SELECT ##
	
	function BuscarInstituciones() 
	{
		$query =  $this->db->get('Institucion');
		return $query->result_array();		
	} 

	function BuscarNombreI($Id)
	{
		$query = $this->db->select("Nombre");
		$query = $this->db->where("Id_Institucion", $Id);
		$query = $this->db->get("Institucion");
		foreach ($query->result_array() as $row)
	{
		$nombre = $row['Nombre'];
	}
		return $nombre;
	}
	
	function BuscarCodigoPI($Id)
	{
		$query = $this->db->select("CodigoP");
		$query = $this->db->where("Id_Institucion", $Id);
		$query = $this->db->get("Institucion");
		foreach ($query->result_array() as $row)
	{
		$codigo = $row['CodigoP'];
	}
		return $codigo;
	}
	
	function BuscarWebI($Id)
	{
		$query = $this->db->select("Web");
		$query = $this->db->where("Id_Institucion", $Id);
		$query = $this->db->get("Institucion");
		foreach ($query->result_array() as $row)
	{
		$web = $row['Web'];
	}
		return $web;
	}
	
	function BuscarTelf1I($Id)
	{
		$query = $this->db->select("Telefono1");
		$query = $this->db->where("Id_Institucion", $Id);
		$query = $this->db->get("Institucion");
		foreach ($query->result_array() as $row)
	{
		$telefono = $row['Telefono1'];
	}
		return $telefono;
	}
	
	function BuscarTelf2I($Id)
	{
		$query = $this->db->select("Telefono2");
		$query = $this->db->where("Id_Institucion", $Id);
		$query = $this->db->get("Institucion");
		foreach ($query->result_array() as $row)
	{
		$telefono = $row['Telefono2'];
	}
		return $telefono;
	}
	
	function BuscarTelf3I($Id)
	{
		$query = $this->db->select("Telefono3");
		$query = $this->db->where("Id_Institucion", $Id);
		$query = $this->db->get("Institucion");
		foreach ($query->result_array() as $row)
	{
		$telefono = $row['Telefono3'];
	}
		return $telefono;
	}
	
	function BuscarTwitterI($Id)
	{
		$query = $this->db->select("Twitter");
		$query = $this->db->where("Id_Institucion", $Id);
		$query = $this->db->get("Institucion");
		foreach ($query->result_array() as $row)
	{
		$twitter = $row['Twitter'];
	}
		return $twitter;
	}
	
	function BuscarFacebookI($Id)
	{
		$query = $this->db->select("Facebook");
		$query = $this->db->where("Id_Institucion", $Id);
		$query = $this->db->get("Institucion");
		foreach ($query->result_array() as $row)
	{
		$facebook = $row['Facebook'];
	}
		return $facebook;
	}
	
	function BuscarGooglePlusI($Id)
	{
		$query = $this->db->select("GooglePlus");
		$query = $this->db->where("Id_Institucion", $Id);
		$query = $this->db->get("Institucion");
		foreach ($query->result_array() as $row)
	{
		$google = $row['GooglePlus'];
	}
		return $google;
	}
	
	function BuscarDireccion1I($Id)
	{
		$query = $this->db->select("Direccion1");
		$query = $this->db->where("Id_Institucion", $Id);
		$query = $this->db->get("Institucion");
		foreach ($query->result_array() as $row)
	{
		$direccion = $row['Direccion1'];
	}
		return $direccion;
	}
	
	function BuscarDireccion2I($Id)
	{
		$query = $this->db->select("Direccion2");
		$query = $this->db->where("Id_Institucion", $Id);
		$query = $this->db->get("Institucion");
		foreach ($query->result_array() as $row)
	{
		$direccion = $row['Direccion2'];
	}
		return $direccion;
	}
	
	function BuscarDireccion3I($Id)
	{
		$query = $this->db->select("Direccion3");
		$query = $this->db->where("Id_Institucion", $Id);
		$query = $this->db->get("Institucion");
		foreach ($query->result_array() as $row)
	{
		$direccion = $row['Direccion3'];
	}
		return $direccion;
	}
	
	function BuscarTelfI($Id) 
	{
		$query = $this->db->select("Telefono1");
		$query = $this->db->where("Id_Institucion", $Id);
		$query = $this->db->get("Institucion");
		foreach ($query->result_array() as $row)
	{
		$telefono = $row['Telefono1'];
	}
		return $telefono;
	}
	
	function BuscarPais() 
	{
		$query = $this->db->query('SELECT DISTINCT Id_Pais, Nombre FROM Pais ORDER BY Nombre');	
		return $query->result_array();	
	} 
	
	function IdPais($Id) 
	{
		$query = $this->db->select("Id_Pais");
		$query = $this->db->where("Nombre", $Id);
		$query = $this->db->get("Pais");
		foreach ($query->result_array() as $row)
	{
		$id = $row['Id_Pais'];
	}
		return $id;
	} 
	
	function BuscarEstado($Id) 
	{
		$query = $this->db->query('SELECT DISTINCT Id_Estado, Nombre FROM Estado WHERE Id_Pais = '.$Id.' ORDER BY Nombre');	
		return $query->result_array();	
	} 
	
	function IdEstado($Id) 
	{
		$query = $this->db->select("Id_Estado");
		$query = $this->db->where("Nombre", $Id);
		$query = $this->db->get("Estado");
		foreach ($query->result_array() as $row)
	{
		$id = $row['Id_Estado'];
	}
		return $id;
	} 
	
	function BuscarCiudad($Id) 
	{
		$query = $this->db->query('SELECT DISTINCT Id_Ciudad, Nombre FROM Ciudad WHERE Id_Estado = '.$Id.' ORDER BY Nombre');	
		return $query->result_array();	
	} 
	
	## UPDATE ##

	function ModificarCliente($institucion, $datos) 
	{
		if(isset($_POST['checkbox']))
		{
			$institucion->CodigoP = $_POST['CPostal'];
		}
		
		if(isset($_POST['checkbox2']))
		{
			$institucion->Web = $_POST['Web'];
		}
		
		if(isset($_POST['checkbox3']))
		{
			$institucion->Telefono1 = $_POST['Telefono'];
		}
		
		if(isset($_POST['checkbox4']))
		{
			$institucion->Telefono2 = $_POST['Telefono2'];
		}
		
		if(isset($_POST['checkbox5']))
		{
			$institucion->Telefono3 = $_POST['Telefono3'];
		}
		
		if(isset($_POST['checkbox6']))
		{
			$institucion->Twitter = $_POST['Twitter'];
		}
		
		if(isset($_POST['checkbox7']))
		{
			$institucion->Facebook = $_POST['Facebook'];
		}
		
		if(isset($_POST['checkbox8']))
		{
			$institucion->GooglePlus = $_POST['GoogleP'];
		}
		
		if(isset($_POST['checkbox9']))
		{
			$institucion->Direccion1 = $_POST['Direccion'];
		}
		
		if(isset($_POST['checkbox10']))
		{
			$institucion->Direccion2 = $_POST['Direccion2'];
		}
		
		if(isset($_POST['checkbox11']))
		{
			$institucion->Direccion3 = $_POST['Direccion3'];
		}
		
		$id_cliente = $datos['ID2'];
		$this->db->where("Id_Institucion", $id_cliente);
		$this->db->update('Institucion', $institucion);
	}
	
	
}