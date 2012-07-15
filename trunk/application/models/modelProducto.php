<?php

class ModelProducto extends CI_Model {

	function __construct()
	{
     	parent::__construct();
    }
	
	## INSERT ##
	
	function AgregarEquipo($datos) 
	{
		$this->db->insert('Historial_Np', $datos);
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
		$this->db->insert('Historial_Np', $datos);
	}
	
	function AgregarNuevoOrden($datos) 
	{
		$this->db->insert('Historial_Npf', $datos);
	}
	
	## SELECT ##

	function ConsultarNombreA($row) 
	{
		$query = $this->db->where("Id_Accesorio", $row);
		$query = $this->db->get('Accesorio');
		return $query->result_array();			
	} 
	
	function ConsultarNombreO($row) 
	{
		$query = $this->db->where("Id_Producto", $row);
		$query = $this->db->get('historial_np');
		return $query->result_array();			
	} 
	
	function SeleccionarH($Negociacion) 
	{
		$query = $this->db->query('SELECT Id_Producto, Id_Negociacion, Codigo, Nombre, Descripcion, Cantidad FROM  historial_npf WHERE Id_Negociacion = '.$Negociacion.'');	
		return $query->result_array();			
	} 
	
	function BuscarAccesorios($equipo) 
	{
		$query = $this->db->query('SELECT a.Id_Accesorio, a.Codigo, a.Nombre, a.Precio, a.Descripcion, a.Descripcion2
								   FROM accesorio AS a, aequipo AS ae, equipo AS e
								   WHERE ae.Id_Equipo = e.Id_Equipo
								   AND e.Id_Equipo = "'.$equipo.'"
								   AND ae.Id_Accesorio = a.Id_Accesorio
								   ORDER BY a.Codigo');	
		
		return $query->result_array();		
	} 
	
	function BuscarDatosEquipo($Id) 
	{
		$query = $this->db->where("Id_Equipo", $Id);
		$query = $this->db->get('equipo');
		return $query->result_array();			
	} 
	
	function BuscarIdEquipo($codigoE) 
	{
		$query = $this->db->select("Id_Equipo");
		$query = $this->db->where("Codigo", $codigoE);
		$query = $this->db->get("Equipo");
		foreach ($query->result_array() as $row)
		{
			$id = $row['Id_Equipo'];
			if($id == NULL)
			{
				return false;
			}
			else
			{
				return $id;
			}	
		}	
	}
	
	function BuscarIdAccesorio($codigoA) 
	{
		$query = $this->db->select("Id_Accesorio");
		$query = $this->db->where("Codigo", $codigoA);
		$query = $this->db->get("Accesorio");
		foreach ($query->result_array() as $row)
		{
			$id = $row['Id_Accesorio'];
			if($id == NULL)
			{
				return false;
			}
			else
			{
				return $id;
			}	
		}	
	}
	
	function BuscarDatosEquipo2($codigoE) 
	{
		$query = $this->db->where("Codigo", $codigoE);
		$query = $this->db->get('equipo');
		return $query->result_array();			
	} 
	
	function BuscarDatosAccesorio($Id) 
	{
		$query = $this->db->where("Id_Accesorio", $Id);
		$query = $this->db->get('accesorio');
		return $query->result_array();			
	} 
	
	function BuscarDatosAccesorio2($codigoA) 
	{
		$query = $this->db->where("Codigo", $codigoA);
		$query = $this->db->get('accesorio');
		return $query->result_array();			
	}
		
	function CambiarDatosEquipo($equipo, $datos) 
	{				
		$id = $datos['ID2'];
		$this->db->where("Id_Equipo", $id);
		$this->db->update('Equipo', $equipo);
	}
	
	function CambiarDatosEquipo2($equipo2, $datos2) 
	{	
		$id2 = $datos2['ID2'];
		$this->db->where("Id_Producto", $id2);
		$this->db->update('historial_np', $equipo2);
	}
	
	function CambiarDatosAccesorio($accesorio, $datos) 
	{				
		$id = $datos['ID2'];
		$this->db->where("Id_Accesorio", $id);
		$this->db->update('Accesorio', $accesorio);
	}
	
	function CambiarDatosAccesorio2($accesorio2, $datos2) 
	{				
		$id2 = $datos2['ID2'];
		$this->db->where("Id_Producto", $id2);
		$this->db->update('historial_np', $accesorio2);
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
	
	function ConsultarCodigoE($Equipo) 
	{
		$query = $this->db->select("Codigo");
		$query = $this->db->where("Id_Equipo", $Equipo);
		$query = $this->db->get("Equipo");
		foreach ($query->result_array() as $row)
	{
		$Codigo = $row['Codigo'];
	}
		return $Codigo;
	}
	
	function ConsultarNombreE($Equipo) 
	{
		$query = $this->db->select("Nombre");
		$query = $this->db->where("Id_Equipo", $Equipo);
		$query = $this->db->get("Equipo");
		foreach ($query->result_array() as $row)
	{
		$Nombre = $row['Nombre'];
	}
		return $Nombre;
	}
	
	function ConsultarDescripcionE($Equipo) 
	{
		$query = $this->db->select("Descripcion2");
		$query = $this->db->where("Id_Equipo", $Equipo);
		$query = $this->db->get("Equipo");
		foreach ($query->result_array() as $row)
	{
		$Descripcion = $row['Descripcion2'];
	}
		return $Descripcion;
	}
	
	function ConsultarDescuento2($Id_Negociacion) 
	{
		$query = $this->db->select("Descuento");
		$query = $this->db->where("Id_Negociacion", $Id_Negociacion);
		$query = $this->db->get("Negociacion");
		foreach ($query->result_array() as $row)
		{
			$Descuento = $row['Descuento'];
		}
		return $Descuento;
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
		$query = $this->db->query('SELECT DISTINCT (H.Id_Historial_Np), E.Id_Equipo, E.Nombre, E.Descripcion, H.Cantidad
								   FROM Equipo AS E, Historial_Np AS H, Negociacion AS N
								   WHERE E.Id_Equipo = H.Id_Producto
								   AND H.Id_Negociacion = N.Id_Negociacion
								   AND H.Id_Negociacion = '.$Negociacion.'
								   ORDER BY H.Id_Historial_Np ASC');	
		
		return $query->result_array();		
	} 
	
	function ConsultarListaB($Negociacion) 
	{
		$query = $this->db->query('SELECT DISTINCT(H.Id_Historial_Np), A.Id_Accesorio, A.Nombre, A.Descripcion, H.Cantidad
								   FROM Accesorio AS A, Historial_Np AS H, Negociacion AS N
								   WHERE A.Id_Accesorio = H.Id_Producto
								   AND H.Id_Negociacion = N.Id_Negociacion
								   AND H.Id_Negociacion = '.$Negociacion.'
								   ORDER BY H.Id_Historial_Np ASC');	
		
		return $query->result_array();		
	} 
	
	function ConsultarLista($Negociacion) 
	{
		$query = $this->db->query('SELECT Id_Historial_Np, Codigo, Nombre, Descripcion, Cantidad
								   FROM historial_np
								   WHERE Id_Negociacion = '.$Negociacion.' ORDER BY Id_Historial_Np ASC');	
		
		return $query->result_array();		
	} 
	
	function ConsultarListaAprobacion($Negociacion) 
	{
		$query = $this->db->query('SELECT Id_Historial_Np, Id_Producto, Codigo, Nombre, Descripcion, Cantidad
								   FROM historial_np
								   WHERE Id_Negociacion = '.$Negociacion.' ORDER BY Id_Historial_Np ASC');	
		
		return $query->result_array();		
	} 
	
	function NumeroRegistros($Negociacion) 
	{
		$query = $this->db->query('SELECT COUNT( Id_Historial_Np ) FROM historial_np WHERE Id_Negociacion = '.$Negociacion.'');	
		
		foreach ($query->result_array() as $row)
	{
		$id = $row['Id_Historial_Np'];
	}
		return $id;
    }
	
	function ConsultarLista2($Negociacion) 
	{
		$query = $this->db->query('SELECT H.Id_HistorialNP2, E.Codigo, E.Nombre, E.Descripcion2, E.Precio, H.Cantidad, (
E.Precio * H.Cantidad) AS Monto
								   FROM Equipo AS E, HistorialNP2 AS H, Negociacion AS N
								   WHERE H.Id_Equipo = E.Id_Equipo
								   AND H.Id_Negociacion = N.Id_Negociacion
								   AND H.Id_Negociacion = '.$Negociacion.'
								   GROUP BY H.Id_HistorialNP2
								   ORDER BY H.Id_HistorialNP2 ASC');	
		
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
		$query = $this->db->query('SELECT SUM( A.Precio * H.Cantidad ) AS TotalA
								   FROM Accesorio AS A, Historial_Np AS H, Negociacion AS N
								   WHERE H.Id_Producto = A.Id_Accesorio
								   AND H.Id_Negociacion = N.Id_Negociacion
								   AND H.Id_Negociacion = '.$Negociacion.'');	
		
		foreach ($query->result_array() as $row)
	{
		$totala = $row['TotalA'];
	}
		return $totala;
	} 
	
	function Neto2($Negociacion) 
	{
		$query = $this->db->query('SELECT SUM( E.Precio * H.Cantidad ) AS TotalE
								   FROM Equipo AS E, Historial_NP AS H, Negociacion AS N
								   WHERE H.Id_Producto = E.Id_Equipo
								   AND H.Id_Negociacion = N.Id_Negociacion
								   AND H.Id_Negociacion = '.$Negociacion.'');	
		
		foreach ($query->result_array() as $row)
	{
		$totale = $row['TotalE'];
	}
		return $totale;
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
		$query = $this->db->query('SELECT DISTINCT(E.Id_Equipo), E.Codigo, E.Nombre AS Equipo, E.Precio, E.Descripcion, M.Nombre AS Marca 				FROM Equipo AS E, Marca_Linea AS ML, ML_Equipo AS ME, Marca AS M WHERE M.Id_Marca = ML.Id_Marca AND ME.Id_Marca_Linea = 		ML.Id_Marca_Linea AND ME.Id_Equipo = E.Id_Equipo ORDER BY E.Codigo');		
		return $query->result_array();
	}
	
	function ConsultarAcce()
	{
		$query = $this->db->query('SELECT DISTINCT(A.Id_Accesorio), A.Codigo, A.Nombre AS Accesorio, A.Precio, A.Descripcion, E.Nombre AS Equipo FROM Equipo AS E, ACCESORIO AS A, AEQUIPO AS AE WHERE AE.Id_Accesorio = A.Id_Accesorio AND E.Id_Equipo = AE.Id_Equipo ORDER BY A.Codigo');		
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
	
	function BorrarOrden($Negociacion) 
	{
		$this->db->where("Id_Negociacion", $Negociacion);
		$this->db->delete("Historial_Np");				
	}
	
	function BorrarOrden2($Negociacion) 
	{
		$this->db->where("Id_Negociacion", $Negociacion);
		$this->db->delete("Historial_Npf");				
	}
	
}