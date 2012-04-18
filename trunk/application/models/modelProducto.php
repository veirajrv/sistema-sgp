<?php

class ModelProducto extends CI_Model {

	function __construct()
	{
     	parent::__construct();
    }
	
	## INSERT ##
	
	function AgregarEquipo($datos) 
	{
		$this->db->insert('HistorialNP2', $datos);
	}
	
	function InsertarMarca($Marca) 
	{
		$this->db->insert('Marca', $Marca);
	}
	
	function InsertarLinea($Linea) 
	{
		$this->db->insert('Linea', $Linea);
	}
	
	function InsertarMarcaLinea($MarcaLinea) 
	{
		$this->db->insert('Marca_Linea', $MarcaLinea);
	}
	
	function InsertarEquipo($Equipo) 
	{
		$this->db->insert('Equipo', $Equipo);
	}
	
	function InsertarMLE($MLE) 
	{
		$this->db->insert('ML_Equipo', $MLE);
	}
	
	function InsertarAccesorio($Accesorio) 
	{
		$this->db->insert('Accesorio', $Accesorio);
	}
	
	function InsertarAE($AE) 
	{
		$this->db->insert('AEquipo', $AE);
	}
	
	function AgregarAccesorio($datos) 
	{
		$this->db->insert('HistorialNP', $datos);
	}
	
	## SELECT ##
	
	function BuscarDatosEquipo($Id) 
	{
		$query = $this->db->where("Id_Equipo", $Id);
		$query = $this->db->get('equipo');
		return $query->result_array();			
	} 
	
	function BuscarDatosAccesorio($Id) 
	{
		$query = $this->db->where("Id_Accesorio", $Id);
		$query = $this->db->get('accesorio');
		return $query->result_array();			
	} 
	
	function CambiarDatosEquipo($equipo, $datos) 
	{	
		$equipo->Codigo = $_POST['Codigo'];
		$equipo->Nombre = $_POST['Nombre'];
		$equipo->Precio = $_POST['Precio'];
		$equipo->Descripcion = $_POST['Descripcion'];
		$equipo->Descripcion2 = $_POST['Descripcion2'];
			
		$id = $datos['ID2'];
		$this->db->where("Id_Equipo", $id);
		$this->db->update('Equipo', $equipo);
	}
	
	function CambiarDatosAccesorio($accesorio, $datos) 
	{	
		$accesorio->Codigo = $_POST['Codigo'];
		$accesorio->Nombre = $_POST['Nombre'];
		$accesorio->Precio = $_POST['Precio'];
		$accesorio->Descripcion = $_POST['Descripcion'];
		$accesorio->Descripcion2 = $_POST['Descripcion2'];
			
		$id = $datos['ID2'];
		$this->db->where("Id_Accesorio", $id);
		$this->db->update('Accesorio', $accesorio);
	}
	
	function ConsultarAccesorio($Equipo) 
	{
		$query = $this->db->where("NombreEquipo", $Equipo);
		$query = $this->db->get('Accesorio');
		return $query->result_array();			
	} 
	
	function BuscarId($id) 
	{
		$query = $this->db->select("Id_Accesorio");
		$query = $this->db->where("CodReferencia", $id);
		$query = $this->db->get("Accesorio");
		foreach ($query->result_array() as $row)
	{
		$id = $row['Id_Accesorio'];
	}
		return $id;
	}
	
	function UltimaLinea() 
	{
		$this->db->select_max('Id_Linea'); 
		$query =  $this->db->get('Linea');
		foreach ($query->result_array() as $row)
	{
		$id = $row['Id_Linea'];
	}
		return $id;
    }
	
	function UltimoEquipo() 
	{
		$this->db->select_max('Id_Equipo'); 
		$query =  $this->db->get('Equipo');
		foreach ($query->result_array() as $row)
	{
		$id = $row['Id_Equipo'];
	}
		return $id;
    }
	
	function UltimoAccesorio() 
	{
		$this->db->select_max('Id_Accesorio'); 
		$query =  $this->db->get('Accesorio');
		foreach ($query->result_array() as $row)
	{
		$id = $row['Id_Accesorio'];
	}
		return $id;
    }

	function ConsultarListaA($Negociacion) 
	{
		$query = $this->db->query('SELECT DISTINCT(H.Id_HistorialNP2), E.Id_Equipo, E.Nombre, E.Descripcion, E.Precio, H.Cantidad
								   FROM Equipo AS E, HistorialNP2 AS H, Negociacion AS N
								   WHERE E.Id_Equipo = H.Id_Equipo
								   AND H.Id_Negociacion = N.Id_Negociacion
								   AND H.Id_Negociacion =  '.$Negociacion.'
								   ORDER BY H.Id_HistorialNP2 ASC');	
		
		return $query->result_array();		
	} 
	
	function ConsultarListaB($Negociacion) 
	{
		$query = $this->db->query('SELECT DISTINCT(H.Id_HistorialNP), A.Id_Accesorio, A.Nombre, A.Descripcion, A.Precio, H.Cantidad
								   FROM Accesorio AS A, HistorialNP AS H, Negociacion AS N
								   WHERE A.Id_Accesorio = H.Id_Accesorio
								   AND H.Id_Negociacion = N.Id_Negociacion
								   AND H.Id_Negociacion =  '.$Negociacion.'
								   ORDER BY H.Id_HistorialNP ASC');	
		
		return $query->result_array();		
	} 
	
	function ConsultarLista($Negociacion) 
	{
		$query = $this->db->query('SELECT H.Id_HistorialNP, A.Nombre, A.Descripcion, A.Precio, H.Cantidad, (
A.Precio * H.Cantidad) AS Monto
								   FROM Accesorio AS A, HistorialNP AS H, Negociacion AS N
								   WHERE H.Id_Accesorio = A.Id_Accesorio
								   AND H.Id_Negociacion = N.Id_Negociacion
								   AND H.Id_Negociacion = '.$Negociacion.'
								   GROUP BY H.Id_HistorialNP');	
		
		return $query->result_array();		
	} 
	
	function ConsultarLista2($Negociacion) 
	{
		$query = $this->db->query('SELECT H.Id_HistorialNP2, E.Nombre, E.Descripcion, E.Precio, H.Cantidad, (
E.Precio * H.Cantidad) AS Monto
								   FROM Equipo AS E, HistorialNP2 AS H, Negociacion AS N
								   WHERE H.Id_Equipo = E.Id_Equipo
								   AND H.Id_Negociacion = N.Id_Negociacion
								   AND H.Id_Negociacion = '.$Negociacion.'
								   GROUP BY H.Id_HistorialNP2');	
		
		return $query->result_array();		
	} 
	
	function ConsultarListaI($Negociacion) 
	{
		$query = $this->db->query('SELECT H.Id_HistorialNP, A.CodReferencia, A.Descripcion, A.Precio, H.Cantidad, (
A.Precio * H.Cantidad) AS Monto
								   FROM Accesorio AS A, HistorialNP AS H, Negociacion AS N
								   WHERE H.Id_Accesorio = A.Id_Accesorio
								   AND H.Id_Negociacion = N.Id_Negociacion
								   AND H.Id_Negociacion = '.$Negociacion.'
								   GROUP BY H.Id_HistorialNP');	
		
		return $query->result_array();		
	} 
	
	function Total($Negociacion) 
	{
		$query = $this->db->query('SELECT COUNT( H.Id_HistorialNP), ((SUM( A.Precio * H.Cantidad )) * 0.12) + SUM( A.Precio * H.Cantidad ) AS Total
								   FROM Accesorio AS A, HistorialNP AS H, Negociacion AS N
								   WHERE H.Id_Accesorio = A.Id_Accesorio
								   AND H.Id_Negociacion = N.Id_Negociacion
								   AND H.Id_Negociacion = '.$Negociacion.'');	
		
		return $query->result_array();		
	} 
	
	function Neto($Negociacion) 
	{
		$query = $this->db->query('SELECT SUM( A.Precio * H.Cantidad ) AS Total
								   FROM Accesorio AS A, HistorialNP AS H, Negociacion AS N
								   WHERE H.Id_Accesorio = A.Id_Accesorio
								   AND H.Id_Negociacion = N.Id_Negociacion
								   AND H.Id_Negociacion = '.$Negociacion.'');	
		
		foreach ($query->result_array() as $row)
	{
		$total = $row['Total'];
	}
		return $total;
	} 
	
	function Neto2($Negociacion) 
	{
		$query = $this->db->query('SELECT SUM( E.Precio * H.Cantidad ) AS Total
								   FROM Equipo AS E, HistorialNP2 AS H, Negociacion AS N
								   WHERE H.Id_Equipo = E.Id_Equipo
								   AND H.Id_Negociacion = N.Id_Negociacion
								   AND H.Id_Negociacion = '.$Negociacion.'');	
		
		foreach ($query->result_array() as $row)
	{
		$total = $row['Total'];
	}
		return $total;
	} 
	
	function ConsultarDescuento($Negociacion) 
	{
		$query = $this->db->query('SELECT N.Id_Negociacion, N.Descuento, N.Total
								   FROM Negociacion AS N
								   WHERE N.Id_Negociacion = '.$Negociacion.'');	
		
		return $query->result_array();		
	} 
	
	function TotalI($Negociacion) 
	{
		$query = $this->db->query('SELECT COUNT( H.Id_HistorialNP ) , ((SUM( A.Precio * H.Cantidad )) * 0.12) + SUM( A.Precio * H.Cantidad ) AS Total
								   FROM Accesorio AS A, HistorialNP AS H, Negociacion AS N
								   WHERE H.Id_Accesorio = A.Id_Accesorio
								   AND H.Id_Negociacion = N.Id_Negociacion
								   AND H.Id_Negociacion = '.$Negociacion.'');	
		
		return $query->result_array();		
	} 	
	
	function MarcaProducto() 
	{
		$query = $this->db->query('SELECT DISTINCT(M.Id_Marca), Nombre
								   FROM Marca AS M, Marca_Linea AS ML, ML_Equipo AS ME
								   WHERE M.Id_Marca = ML.Id_Marca
								   AND ML.Id_Marca_Linea = ME.Id_Marca_Linea
								   ORDER BY M.Nombre');	
		
		return $query->result_array();		
	} 
	
	function ListaEquipo($prueba) 
	{
		$query = $this->db->query('SELECT DISTINCT(A.NombreLinea)
								   FROM Accesorio AS A
								   WHERE A.NombreMarca = '.$prueba.'
								   ORDER BY A.NombreMarca');	
		
		return $query->result_array();		
	} 
	
	function ConsultarMarcas() 
	{
		$query = $this->db->query('SELECT DISTINCT(Id_Marca), Nombre
								   FROM Marca
								   ORDER BY Id_Marca');	
		
		return $query->result_array();		
	} 
	
	function ConsultarEquipo() 
	{
		$query = $this->db->query('SELECT DISTINCT(Id_Equipo), Nombre
								   FROM Equipo
								   ORDER BY Id_Equipo');	
		
		return $query->result_array();		
	} 
	
	function ConsultarA() 
	{
		$query = $this->db->query('SELECT DISTINCT(Id_Accesorio), Nombre
								   FROM Accesorio
								   ORDER BY Id_Accesorio');	
		
		return $query->result_array();		
	} 
	
	function ConsultarLineas() 
	{
		$query = $this->db->query('SELECT DISTINCT(ML.Id_Marca_Linea), L.Id_Linea, L.Nombre as Linea, M.Nombre as Marca
								   FROM Linea as L, Marca as M, Marca_Linea as ML
								   WHERE ML.Id_Marca = M.Id_Marca
								   AND ML.Id_Linea = L.Id_Linea
								   ORDER BY Marca');	
		
		return $query->result_array();		
	} 
	
	function ConsultarLinea() 
	{
		$query = $this->db->query('SELECT DISTINCT(L.Id_Linea), L.Nombre
								   FROM Linea as L
								   ORDER BY Id_Linea');	
		
		return $query->result_array();		
	} 
	
	function ConsultarMarcaLinea($id)
	{
		$query = $this->db->query('SELECT DISTINCT(ML.Id_Marca_Linea), L.Nombre, ML.Id_Linea FROM Linea as L, Marca_Linea as ML WHERE ML.Id_Marca = '.$id.' AND ML.Id_Linea = L.Id_Linea');		
		return $query->result_array();
	}
	
	function ConsultarEquipos()
	{
		$query = $this->db->query('SELECT DISTINCT(E.Id_Equipo), E.Nombre AS Equipo, E.Precio, E.Descripcion, M.Nombre AS Marca 				FROM Equipo AS E, Marca_Linea AS ML, ML_Equipo AS ME, Marca AS M WHERE M.Id_Marca = ML.Id_Marca AND ME.Id_Marca_Linea = 		ML.Id_Marca_Linea AND ME.Id_Equipo = E.Id_Equipo ORDER BY Marca');		
		return $query->result_array();
	}
	
	function ConsultarAcce()
	{
		$query = $this->db->query('SELECT DISTINCT(A.Id_Accesorio), A.Nombre AS Accesorio, A.Precio, A.Descripcion, E.Nombre AS Equipo FROM Equipo AS E, ACCESORIO AS A, AEQUIPO AS AE WHERE AE.Id_Accesorio = A.Id_Accesorio AND E.Id_Equipo = AE.Id_Equipo ORDER BY Equipo');		
		return $query->result_array();
	}
	
	function ConsultarTotal($id) 
	{
		$query = $this->db->select("Total");
		$query = $this->db->where("Id_Negociacion", $id);
		$query = $this->db->get("negociacion");
		foreach ($query->result_array() as $row)
	{
		$total = $row['Total'];
	}
		return $total;
	}
	
}