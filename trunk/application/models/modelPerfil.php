<?php

class ModelPerfil extends CI_Model 
{

	function __construct()
	{
     	parent::__construct();
    }
	
	## INSERT ##
	
	
	## SELECT ##
	
	function NombreLogeado($usuario) 
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
	
	function ApellidoLogeado($usuario) 
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
	
	function CorreoLogeado($usuario) 
	{
		$query = $this->db->select("Correo");
		$query = $this->db->where("Usuario", $usuario);
		$query = $this->db->get("Empleado");
		foreach ($query->result_array() as $row)
	{
		$correo = $row['Correo'];
	}
		return $correo;
	}
	
	function Telefono1Logeado($usuario) 
	{
		$query = $this->db->select("Telf_Casa");
		$query = $this->db->where("Usuario", $usuario);
		$query = $this->db->get("Empleado");
		foreach ($query->result_array() as $row)
	{
		$telf = $row['Telf_Casa'];
	}
		return $telf;
	}
	
	function Telefono2Logeado($usuario) 
	{
		$query = $this->db->select("Telf_Ofi");
		$query = $this->db->where("Usuario", $usuario);
		$query = $this->db->get("Empleado");
		foreach ($query->result_array() as $row)
	{
		$telf = $row['Telf_Ofi'];
	}
		return $telf;
	}
	
	function Telefono3Logeado($usuario) 
	{
		$query = $this->db->select("Telf_Cel");
		$query = $this->db->where("Usuario", $usuario);
		$query = $this->db->get("Empleado");
		foreach ($query->result_array() as $row)
	{
		$telf = $row['Telf_Cel'];
	}
		return $telf;
	}
	
	function CedulaLogeado($usuario) 
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
	
	## UPDATE ##
	
	function ModificarVendedor($vendedor, $datos) 
	{
		if(isset($_POST['checkbox']))
		{
			$vendedor->Correo = $_POST['Correo'];
		}
		
		if(isset($_POST['checkbox2']))
		{
			$vendedor->Telf_Casa = $_POST['Telefono'];
		}
		
		if(isset($_POST['checkbox3']))
		{
			$vendedor->Telf_Ofi = $_POST['Telefono2'];
		}
		
		if(isset($_POST['checkbox4']))
		{
			$vendedor->Telf_Cel = $_POST['Telefono3'];
		}
		
		$Cedula = $datos['ID2'];
		$this->db->where("Cedula", $Cedula);
		$this->db->update('Empleado', $vendedor);
	}
	
}