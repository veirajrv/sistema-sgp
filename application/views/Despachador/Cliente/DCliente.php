<!-- valid xhtml 1.1, but this is just something that makes the author proud =D -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<script src="http://elp21.no-ip.info:4085/SGP/files/js/jquery-1.6.2.min.js" type="text/javascript"> </script>
<script src="http://elp21.no-ip.info:4085/SGP/files/js/jquery-ui-1.8.16.custom.min.js" type="text/javascript"> </script>
<script src="http://elp21.no-ip.info:4085/SGP/files/js/livevalidation_standalone.js" type="text/javascript"> </script>

<head>

<script>
function confirmar()
{
	if(confirm("Usted quiere agregar este cliente al sistema?"))
		return true;
	else
		return false;
}
</script>

<script type="text/javascript">
function CambiaColor(esto,borde,texto)
 {
    esto.style.borderColor=borde;
	esto.style.color=texto;
 }
</script>

<script>
	$(function() {
		$( "#accordion" ).accordion({
			autoHeight: false,
			navigation: true
		});
	});
</script>

<script>
	// increase the default animation speed to exaggerate the effect
	$.fx.speeds._default = 1000;
	$(function() {
		$( "#dialog" ).dialog({
			autoOpen: false,
			show: "blind",
			hide: "explode"
		});

		$( "#opener" ).click(function() {
			$( "#dialog" ).dialog( "open" );
			return false;
		});
	});
</script>

<script>
	$(function() {
		$( "input:submit, input:reset").button();
		$( "a", ".demoo" ).click(function() { return false; });
	});
</script>

<script>
function confirmar()
{
	if(confirm("Quieres agregar esta institucion?"))
		return true;
	else
		return false;
}
</script>

<script>
function soloNumeros(evt){
//asignamos el valor de la tecla a keynum
if(window.event){// IE
keynum = evt.keyCode;
}else{
keynum = evt.which;
}
//comprobamos si se encuentra en el rango
if(keynum>7 && keynum<58){
return true;
}else{
return false;
}
}
</script>

<script type="text/javascript">
function validar(e) { // 1
    tecla = (document.all) ? e.keyCode : e.which; // 2
    if (tecla==8) return true; // 3
    patron =/[A-Za-z\s]/; // 4
    te = String.fromCharCode(tecla); // 5
    return patron.test(te); // 6
} 
</script>

<style type="text/css">
.LV_validation_message{
    font-weight:bold;
    margin:0 0 0 5px;
}

.LV_valid {
    color:#1fa0dc;
}
	
.LV_invalid {
    color:#CC0000;
}
    
.LV_valid_field,
input.LV_valid_field:hover, 
input.LV_valid_field:active,
textarea.LV_valid_field:hover, 
textarea.LV_valid_field:active {
    border: 1px solid #1fa0dc;
}
    
.LV_invalid_field, 
input.LV_invalid_field:hover, 
input.LV_invalid_field:active,
textarea.LV_invalid_field:hover, 
textarea.LV_invalid_field:active {
    border: 1px solid #CC0000;
}
</style>
	
<!-- meta tags begin -->
	<!-- vital meta tags -->
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>SISTEMA DE GESTION DE PROCESOS</title>
	<!-- defining stylesheet, rss feed and shortcut icon to use -->
	<link rel="stylesheet" href="http://elp21.no-ip.info:4085/SGP/files/css/styling.css" type="text/css" media="screen" />
	<link href="http://elp21.no-ip.info:4085/SGP/files/css/flick/jquery-ui-1.8.16.custom.css" rel="stylesheet" type="text/css"/>
	<!-- secondary meta tags -->
	<meta name="Autor" content="LP21" />
<!-- meta tags end -->
<!--[if IE]>
	<style type="text/css">
		#search {height:46px}
	</style>
<![endif]-->
</head>
<body>

<!-- BEGIN global wrapper -->
<!-- BEGIN header -->
<div id="monster">

  <div id="tagline">
		<a href="index.html" title="Home"><img src="http://elp21.no-ip.info:4085/SGP/files/images/Portada/logo2.gif" alt="Your logo here" width="45" height="40" /> <span id="logo-text">YOMA
		</span></a>
		<div id="userbar">
			<a href="<?php echo base_url();?>index.php/Control_Inicio/cerrar_sesion/">Cerrar Sesion </a> | <a id="tabe" href="">Ayuda</a>		</div>
  </div>
	<!-- END tagline -->

<!-- BEGIN tabs -->
<div id="navcontainer">
	<ul id="navlist">
		<li><a id="taba" class="active" href="<?php echo base_url();?>index.php/Control_Inicio/d_principal" title="Inicio">Inicio</a></li>
		<li><a id="tabb" href="<?php echo base_url();?>index.php/Control_Venta/consultar_negociaciones" title="Gestionar Ventas">Ventas</a></li>
		<li><a id="tabb" href="<?php echo base_url();?>index.php/Control_Venta/ver_negociacion" title="Gestionar Negociaciones">Negociaciones</a></li>
		<li><a id="tabb" href="<?php echo base_url();?>index.php/Control_Venta/clientes" title="Gestionar Clientes">Clientes</a></li>
	</ul>
</div><!-- END navcontainer -->

<div id="tabbar"></div>
<!-- END header -->

<!-- BEGIN search -->
<div id="search">

	
	
  </div>
<!-- END search -->

<!-- BEGIN container -->
<div id="container">
<!-- BEGIN left column -->
<div id="left">
<div id="lc">
	<div class="demo">

<div id="accordion">
	<h3><a href="#">Ver</a></h3>
	<div>
		<li>- <a href="<?php echo base_url();?>index.php/Control_Venta/consultar_negociaciones">Venta</a></li>
	</div>
	<h3><a href="#">Herramientas</a></h3>
	<div>
		
	</div>
</div>

</div>

</div>
	<p>&nbsp;</p>
</div><!-- END lc -->
</div><!-- END left -->

<!-- BEGIN center column -->
<div id="center">
  <div id="cc">
  <form id="form2" method="post" action="<?php echo base_url();?>index.php/Control_Venta/atras_index">
    <table width="441" border="0">
      <tr>
        <td colspan="2" align="center"><?php if(isset($Mensaje))
		{
			echo '<font color="#00FF00" style="font-size:20px;"><b>'.$Mensaje.'</b></font>';
		}?></td>
        </tr>
      <tr>
        <td width="381"><h2 style="font-size:30px">Nuevo Cliente</h2></td>
        <td width="50" align="right"><input name="Buttom" type="image" id="Buttom" title="Atras" src="<?php echo base_url();?>files/images/FlechaI.png"/></td>
      </tr>
      <tr>
        <td colspan="2"><hr align="left" style="width:435px;" /></td>
        </tr>
    </table>
  </form>
  <form id="form1" method="post" action="<?php echo base_url();?>index.php/Control_Venta/crear_cliente">
      <table width="200" border="0">
        <tr>
          <td><fieldset><legend style="font-size:15px"><b>Datos Personales</b></legend>
              <table width="410" border="0">
                <tr>
                  <td width="147" align="right"><font style="font-size:12px">Tipo de cliente:</font></td>
                  <td colspan="2">
                    <select name="select" size="1" style="width:200px; font-size-adjust:inherit; height:30px; font-size:15px;" onfocus="CambiaColor(this,'#FFCC00','#000000')" onblur="CambiaColor(this,'','#000000')" required="required">
                      <option>- Selecciona -</option>
                      <option>Privado</option>
                      <option>Publico</option>
                    </select>                 </td>
                </tr>
                <tr>
                  <td align="right"><font style="font-size:12px">Nombre:</font></td>
                  <td colspan="2">
                    <input name="Nombre" type="text" id="Nombre" onkeypress="return validar(event)" style="width:200px; font-size-adjust:inherit; height:30px; font-size:15px;" maxlength="150" required="required" onfocus="CambiaColor(this,'#FFCC00','#000000')" onblur="CambiaColor(this,'','#000000')"/>                  </td>
                </tr>
                <tr>
                  <td align="right"><font style="font-size:12px">Apelidos:</font></td>
                  <td colspan="2">
                    <input name="Apellido" type="text" id="Apellido" onkeypress="return validar(event)" style="width:200px; font-size-adjust:inherit; height:30px; font-size:15px;" onfocus="CambiaColor(this,'#FFCC00','#000000')" onblur="CambiaColor(this,'','#000000')" maxlength="150" required="required"/>                  </td>
                </tr>
                <tr>
                  <td align="right"><font style="font-size:12px">Cedula:</font></td>
                  <td colspan="2">
                    <select name="Tipo" id="Tipo" style="font-size-adjust:inherit; height:30px; font-size:15px;" onfocus="CambiaColor(this,'#FFCC00','#000000')" onblur="CambiaColor(this,'','#000000')">
                      <option selected="selected">V</option>
                      <option>E</option>
                      </select> - <input name="Cedula" type="text" id="Cedula" style="width:150px; font-size-adjust:inherit; height:30px; font-size:15px;" onfocus="CambiaColor(this,'#FFCC00','#000000')" onblur="CambiaColor(this,'','#000000')" onkeypress="return soloNumeros(event)" maxlength="8" required="required"/>                 </td>
                </tr>
                <tr>
                  <td align="right"><font style="font-size:12px">Sexo:</font></td>
                  <td colspan="2">
                    <select name="Sexo" size="1" id="Sexo" style="width:200px; font-size-adjust:inherit; height:30px; font-size:15px;" onfocus="CambiaColor(this,'#FFCC00','#000000')" onblur="CambiaColor(this,'','#000000')" required="required">
                      <option selected="selected">- Selecciona -</option>
                      <option>Hombre</option>
                      <option>Mujer</option>
                    </select>                 </td>
                </tr>
                <tr>
                  <td align="right"><font style="font-size:12px">Fecha de nacimiento:</font></td>
                  <td colspan="2">
                    <select name="Dia" id="Dia" style="font-size-adjust:inherit; height:30px; font-size:15px;" onfocus="CambiaColor(this,'#FFCC00','#000000')" onblur="CambiaColor(this,'','#000000')" required="required">
                      <option selected="selected">- Dia -</option>
                      <option>1</option>
                      <option>2</option>
                      <option>3</option>
                      <option>4</option>
                      <option>5</option>
                      <option>6</option>
                      <option>7</option>
                      <option>8</option>
                      <option>9</option>
                      <option>10</option>
                      <option>11</option>
                      <option>12</option>
                      <option>13</option>
                      <option>14</option>
                      <option>15</option>
                      <option>16</option>
                      <option>17</option>
                      <option>18</option>
                      <option>19</option>
                      <option>20</option>
                      <option>21</option>
                      <option>22</option>
                      <option>23</option>
                      <option>24</option>
                      <option>25</option>
                      <option>26</option>
                      <option>27</option>
                      <option>28</option>
                      <option>29</option>
                      <option>30</option>
                      <option>31</option>
                        </select> - <select name="Mes" id="Mes" style="width:120px; font-size-adjust:inherit; height:30px; font-size:15px;" onfocus="CambiaColor(this,'#FFCC00','#000000')" onblur="CambiaColor(this,'','#000000')" required="required">
                                                              <option selected="selected">- Mes -</option>
                                                              <option>Enero</option>
                                                              <option>Febrero</option>
                                                              <option>Marzo</option>
                                                              <option>Abril</option>
                                                              <option>Mayo</option>
                                                              <option>Junio</option>
                                                              <option>Julio</option>
                                                              <option>Agosto</option>
                                                              <option>Septiembre</option>
                                                              <option>Octubre</option>
                                                              <option>Noviembre</option>
                                                              <option>Diciembre</option>
                                                                                                                                            </select>                 </td>
                </tr>
                <tr>
                  <td align="right"><font style="font-size:12px">R.I.F:</font></td>
                  <td colspan="2">
                    <select name="Tipo2" id="Tipo2" style="font-size-adjust:inherit; height:30px; font-size:15px;" onfocus="CambiaColor(this,'#FFCC00','#000000')" onblur="CambiaColor(this,'','#000000')">
                      <option selected="selected">V</option>
                    </select> - <input name="Rif" type="text" id="Rif" style="width:103px; font-size-adjust:inherit; height:30px; font-size:15px;" onfocus="CambiaColor(this,'#FFCC00','#000000')" onblur="CambiaColor(this,'','#000000')" onkeypress="return soloNumeros(event)" maxlength="8" required="required"/> - <select name="Codigo" id="Codigo" style="font-size-adjust:inherit; height:30px; font-size:15px;" onfocus="CambiaColor(this,'#FFCC00','#000000')" onblur="CambiaColor(this,'','#000000')">
  <option selected="selected">0</option>
  <option>1</option>
  <option>2</option>
  <option>3</option>
  <option>4</option>
  <option>5</option>
  <option>6</option>
  <option>7</option>
  <option>8</option>
  <option>9</option>
</select>                  </td>
                </tr>
                <tr>
                  <td align="right"><font style="font-size:12px">EMail:</font></td>
                  <td colspan="2">
                    <input name="Email" type="email" id="Email" style="width:200px; font-size-adjust:inherit; height:30px; font-size:15px;" onfocus="CambiaColor(this,'#FFCC00','#000000')" onblur="CambiaColor(this,'','#000000')" required="required"/>                  </td>
                </tr>
                <tr>
                  <td align="right"><font style="font-size:12px">Codigo postal <b><font color="#FF0000">(Opcional):</font></b></font></td>
                  <td colspan="2"><input name="CPostal" type="text" id="CPostal" style="width:200px; font-size-adjust:inherit; height:30px; font-size:15px;" onfocus="CambiaColor(this,'#FFCC00','#000000')" onblur="CambiaColor(this,'','#000000')" maxlength="5"/></td>
                </tr>
                <tr>
                  <td align="right"><font style="font-size:12px">N&deg; telefono:</font></td>
                  <td colspan="2">
                    <input name="Telefono" type="text" id="Telefono" style="width:200px; font-size-adjust:inherit; height:30px; font-size:15px;" onfocus="CambiaColor(this,'#FFCC00','#000000')" onblur="CambiaColor(this,'','#000000')" onkeypress="return soloNumeros(event)" maxlength="11" required="required" title="Introduzca su numero telefonico colocando el numero de area correspondiente (0212xxxxxxx, 0241xxxxxxx)"/><script>var f10 = new LiveValidation('Telefono');
f10.add( Validate.Length, { is: 11 } );</script>                  </td>
                </tr>
                <tr>
                  <td align="right"><font style="font-size:12px">N&deg; celular:</font></td>
                  <td colspan="2">
                    <input name="Telefono2" type="text" id="Telefono2" style="width:200px; font-size-adjust:inherit; height:30px; font-size:15px;" onfocus="CambiaColor(this,'#FFCC00','#000000')" onblur="CambiaColor(this,'','#000000')" onkeypress="return soloNumeros(event)" maxlength="11" required="required" title="Introduzca su numero telefonico colocando el numero de area correspondiente (0212xxxxxxx, 0241xxxxxxx)"/><script>var f10 = new LiveValidation('Telefono2');
f10.add( Validate.Length, { is: 11 } );</script>                  </td>
                </tr>
                <tr>
                  <td align="right"><font style="font-size:12px">N&deg; fax <b><font color="#FF0000">(Opcional):</font></b></font></td>
                  <td colspan="2">
                    <input name="Telefono3" type="text" id="Telefono3" style="width:200px; font-size-adjust:inherit; height:30px; font-size:15px;" onfocus="CambiaColor(this,'#FFCC00','#000000')" onblur="CambiaColor(this,'','#000000')" onkeypress="return soloNumeros(event)" maxlength="11" title="Introduzca su numero telefonico colocando el numero de area correspondiente (0212xxxxxxx, 0241xxxxxxx)"/><script>var f10 = new LiveValidation('Telefono3');
f10.add( Validate.Length, { is: 11 } );</script>                  </td>
                </tr>
                <tr>
                  <td align="right"><font style="font-size:12px">Especialidad:</font></td>
                  <td colspan="2">
                    <select name="Especialidad" size="1" id="Especialidad" style="width:200px; font-size-adjust:inherit; height:30px; font-size:15px;" onfocus="CambiaColor(this,'#FFCC00','#000000')" onblur="CambiaColor(this,'','#000000')" required="required">
                      <option selected="selected">- Selecciona -</option>
                      <option>Cardiologia</option>
                      <option>Cirugia</option>
                      <option>Emergenciologia</option>
                      <option>Fisiatria</option>
                      <option>Fisioterapia</option>
                      <option>Ginecologia</option>
                      <option>Gineco-Obstetricia</option>
                      <option>Imagenologia</option>
                      <option>Intensivista</option>
                      <option>Mastologia</option>
                      <option>Nefrologia</option>
                      <option>Neumonologia</option>
                      <option>Nutricion</option>
                      <option>Nutrologia</option>
                      <option>Obstetricia</option>
                      <option>Oncologia</option>
                      <option>Pediatria</option>
                      <option>Radiologia</option>
                      <option>Traumatologia</option>
                      <option>Medicina Interna</option>
                      <option>Endocrinologia</option>
                      <option>Anestesiologia</option>
                      <option>Multi-Especialidad</option>
                    </select>                  </td>
                </tr>
                <tr>
                  <td align="right"><font style="font-size:12px">Instituto de trabajo:</font></td>
                  <td width="206">
                    <select name="Instituto" size="1" id="Instituto" style="width:200px; font-size-adjust:inherit; height:30px; font-size:15px;" onfocus="CambiaColor(this,'#FFCC00','#000000')" onblur="CambiaColor(this,'','#000000')" disabled="disabled">
                      <?php
						foreach ($Institucion as $row) {
				  ?>
                        <option value="<?php echo $row['Id_Institucion']; ?>" <?php echo set_select('Hola',$row['Id_Institucion']); ?> ><?php echo $row['Nombre']; ?></option>
                        <?php
					}
					?>
                    </select>                  </td>
                  <td width="43"><input type="checkbox" name="checkbox" value="checkbox" onclick="document.getElementById('Instituto').disabled = !this.checked" /></td>
                </tr>
                <tr>
                  <td align="right"><font style="font-size:12px">Instituto 2 <b><font color="#FF0000">(Opcional):</font></b></font></td>
                  <td>
                    <select name="Instituto2" size="1" id="Instituto2" style="width:200px; font-size-adjust:inherit; height:30px; font-size:15px;" onfocus="CambiaColor(this,'#FFCC00','#000000')" onblur="CambiaColor(this,'','#000000')" disabled="disabled">
                      <?php
						foreach ($Institucion as $row) {
				  ?>
                      <option value="<?php echo $row['Id_Institucion']; ?>" <?php echo set_select('Hola',$row['Id_Institucion']); ?> ><?php echo $row['Nombre']; ?></option>
                      <?php
					}
					?>
                    </select>                  </td>
                  <td><input type="checkbox" name="checkbox2" value="checkbox" onclick="document.getElementById('Instituto2').disabled = !this.checked" /></td>
                </tr>
                <tr>
                  <td align="right"><font style="font-size:12px">Sub Especialidad <b><font color="#FF0000">(Opcional):</font></b></font></td>
                  <td colspan="2">
                    <input name="Subespecial" type="text" id="Subespecial" onkeypress="return validar(event)" style="width:200px; font-size-adjust:inherit; height:30px; font-size:15px;" onfocus="CambiaColor(this,'#FFCC00','#000000')" onblur="CambiaColor(this,'','#000000')" maxlength="30" />                  </td>
                </tr>
                <tr>
                  <td align="right"><font style="font-size:12px">Direccion Web <b><font color="#FF0000">(Opcional):</font></b></font></td>
                  <td colspan="2">
                    <input name="Web" type="text" id="Web" style="width:200px; font-size-adjust:inherit; height:30px; font-size:15px;" onfocus="CambiaColor(this,'#FFCC00','#000000')" onblur="CambiaColor(this,'','#000000')" maxlength="200" title="Coloque la direccion web en caso de tener una (http://www.ejemplo.com)"/>             </td>
                </tr>
                <tr>
                  <td align="right"><font style="font-size:12px">Departamento:</font></td>
                  <td colspan="2">
                    <input name="Departamento" type="text" id="Departamento" style="width:200px; font-size-adjust:inherit; height:30px; font-size:15px;" onfocus="CambiaColor(this,'#FFCC00','#000000')" onblur="CambiaColor(this,'','#000000')" onkeypress="return validar(event)" maxlength="30" required="required"/>                  </td>
                </tr>
              </table>
              </fieldset></td>
        </tr>
        <tr>
          <td><fieldset><legend style="font-size:15px"><b>Redes Sociales</b> <b><font color="#FF0000">(Opcional)</font></b></legend>
              <table width="410" border="0">
                <tr>
                  <td width="140" align="right">
                    <img src="<?php echo base_url();?>files/images/twitter.png" alt="t" width="34" height="34" />
                    </td>
                  <td width="260">
                    
                      <input name="Twitter" type="text" id="Twitter" style="width:200px; font-size-adjust:inherit; height:30px; font-size:15px;" onfocus="CambiaColor(this,'#FFCC00','#000000')" onblur="CambiaColor(this,'','#000000')" maxlength="20" title="Coloque su nombre de usuario ejemplo (@grupoyoma)"/>
                      </td>
                </tr>
                <tr>
                  <td align="right">
                    <img src="<?php echo base_url();?>files/images/facebook.png" alt="f" width="34" height="34" />
                   </td>
                  <td>
                    <input name="Facebook" type="text" id="Facebook" style="width:200px; font-size-adjust:inherit; height:30px; font-size:15px;" onfocus="CambiaColor(this,'#FFCC00','#000000')" onblur="CambiaColor(this,'','#000000')" maxlength="20" />
                 </td>
                </tr>
                <tr>
                  <td align="right">
                    <img src="<?php echo base_url();?>files/images/googleplusbadge.png" alt="g" width="34" height="34" />
                    </td>
                  <td>
                    <input name="GoogleP" type="text" id="GoogleP" style="width:200px; font-size-adjust:inherit; height:30px; font-size:15px;" onfocus="CambiaColor(this,'#FFCC00','#000000')" onblur="CambiaColor(this,'','#000000')" maxlength="20"/>
                  </td>
                </tr>
              </table>
              </fieldset></td>
        </tr>
        <tr>
          <td><fieldset><legend style="font-size:15px"><b>Direcciones</b></legend>
              <table width="410" border="0">
                <tr>
                  <td width="140" align="right"><font style="font-size:12px">Direccion Fiscal:</font></td>
                  <td width="260">
                    <textarea name="Direccion" id="Direccion" style="width:200px; font-size-adjust:inherit; height:50px; font-size:15px;" onfocus="CambiaColor(this,'#FFCC00','#000000')" onblur="CambiaColor(this,'','#000000')" placeholder="Direccion Fiscal" required="required"></textarea>
                  </td>
                </tr>
                <tr>
                  <td align="right"><font style="font-size:12px">Direccion Despacho:</font></td>
                  <td>
                    <textarea name="Direccion2" id="Direccion2" style="width:200px; font-size-adjust:inherit; height:50px; font-size:15px;" onfocus="CambiaColor(this,'#FFCC00','#000000')" onblur="CambiaColor(this,'','#000000')" placeholder="Direccion Despacho" required="required"></textarea>
                  </td>
                </tr>
                <tr>
                  <td align="right"><font style="font-size:12px">Direccion Extra <b><font color="#FF0000">(Opcional):</font></b></font></td>
                  <td>
                    <textarea name="Direccion3" id="Direccion3" style="width:200px; font-size-adjust:inherit; height:50px; font-size:15px;" onfocus="CambiaColor(this,'#FFCC00','#000000')" onblur="CambiaColor(this,'','#000000')" placeholder="Direccion Extra"></textarea>
                  </td>
                </tr>
              </table>
              </fieldset></td>
        </tr>
        <tr>
          <td><div align="right">
            <input type="reset" name="Submit2" value="Borrar informaci&oacute;n"/>
            <input type="submit" name="Submit" value="Agregar cliente" OnClick="return confirm('Usted desea agregar este nuevo cliente al sistema?');"/>
          </div></td>
        </tr>
      </table>
    </form>
</div>
  <!-- END cc -->
</div><!-- END center -->

<!-- BEGIN right column -->
<div id="right">
<div id="rc">
  <h2>Bienvenido</h2>
	<p><font style="font-size:12px;"><?php echo $Usuario ?></font></p>
</div><!-- END rc -->
</div><!-- END right -->

<br class="clear" />
<!-- clear any float commands left -->
<div class="clear">&nbsp;</div>

</div><!-- END container -->

<!-- BEGIN footer -->
<div id="footer">

	<!-- BEGIN bottomline links -->
	<div id="footmenu"></div>
	<!-- END footmenu -->
	
	<div class="author">
	Copyright &copy;2011 YOMA. 
	Designed by LP21.	</div>
	
</div><!-- END footer -->

<div class="clear">&nbsp;</div>

</div><!-- END monster -->

</body>

</html>