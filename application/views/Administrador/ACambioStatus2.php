<!-- valid xhtml 1.1, but this is just something that makes the author proud =D -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<script src="<?php echo base_url();?>files/js/jquery-1.6.2.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>files/js/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>files/js/livevalidation_standalone.js" type="text/javascript"></script>

<head>

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
		$( "input:submit").button();
		$( "a", ".demoo" ).click(function() { return false; });
	});
</script>

<script>
			$(function() {
				$( "#FechaC" ).datepicker({
					changeMonth: true,
					changeYear: true,
					yearRange: "-0:+0"
				});		
				
			});			
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
	<link rel="stylesheet" href="<?php echo base_url();?>files/css/styling.css" type="text/css" media="screen" />
	<link href="<?php echo base_url();?>files/css/flick/jquery-ui-1.8.16.custom.css" rel="stylesheet" type="text/css"/>
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
		<a href="../index.html" title="Home"><img src="<?php echo base_url();?>files/images/Portada/logo2.gif" alt="Your logo here" width="45" height="40" /> <span id="logo-text">YOMA
		</span></a>
		<div id="userbar">
			<a href="<?php echo base_url();?>index.php/Control_Inicio/cerrar_sesion">Cerrar Sesion </a> | <a id="tabe" href="">Ayuda</a>		</div>
  </div>
	<!-- END tagline -->

<!-- BEGIN tabs -->
<div id="navcontainer">
	<ul id="navlist">
		<li><a id="tabb" href="<?php echo base_url();?>index.php/Control_Inicio/a_principal" title="Inicio">Inicio</a></li>
		<li><a id="taba" class="active"  href="<?php echo base_url();?>index.php/Control_Negociacion/buscar_vendedores" title="Gestionar Negociaciones">Negociaciones</a></li>
		<li><a id="tabb" href="<?php echo base_url();?>index.php/Control_Cliente/buscar_vendedores" title="Clientes">Clientes</a></li>
		<li><a id="tabb" href="<?php echo base_url();?>index.php/Control_Reporte" title="Visualizar Reportes">Reportes</a></li>
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
	<h3><a href="#">Nuevo</a></h3>
	<div>
	    <li>- <a href="<?php echo base_url();?>index.php/Control_Producto">Producto</a></li>
	</div>
	<h3><a href="#">Ver</a></h3>
	<div>
		<li>- <a href="<?php echo base_url();?>index.php/Control_Negociacion/buscar_vendedores">Negociacion</a></li>
	</div>
	<h3><a href="#">Herramientas</a></h3>
	<div>
		
	</div>
</div>

</div>
	<p>&nbsp;</p>
</div><!-- END lc -->
</div><!-- END left -->

<!-- BEGIN center column -->
<div id="center">
  <div id="cc">
  <form id="form2" method="post" action="<?php echo base_url();?>index.php/Control_Negociacion/ir_negociacion_atras/<?php echo $Id_Negociacion; ?>">
    <table width="439" border="0">
      <tr>
        <td width="381" valign="middle"><h2 style="font-size:30px">Codigo Negociaci&oacute;n (<?php echo $Id_Negociacion; ?>)</h2></td>
        <td width="50" valign="middle"><input type="image" src="<?php echo base_url();?>files/images/FlechaI.png" name="Submit" value="Enviar" /></td>
      </tr>
      <tr>
        <td colspan="2"><hr align="left" style="width:435px;" /></td>
        </tr>
    </table>
  </form>
  <form id="form1" method="post" action="<?php echo base_url();?>index.php/Control_Negociacion/cambio_status_4a/<?php echo $Id_Negociacion; ?>">
      <table width="441" border="0">
        <tr>
          <td><fieldset><legend style="font-size:15px"><b>Seguimiento</b></legend>
              <table width="410" border="0">
                <tr>
                  <td width="140" align="right"><font style="font-size:12px">Fecha de contacto:</font></td>
                  <td width="260">
                    <input name="FechaC" type="text" id="FechaC" style="width:200px; font-size-adjust:inherit; height:30px; font-size:15px;" onfocus="CambiaColor(this,'#FFCC00','#000000')" onblur="CambiaColor(this,'','#000000')" maxlength="10" required="required"/>                    </td>
                </tr>
                <tr>
                  <td align="right"><font style="font-size:12px">Tipo de Contacto:</font></td>
                  <td>
                    <select name="TipoC" id="TipoC" style="width:200px; font-size-adjust:inherit; height:30px; font-size:15px;" onfocus="CambiaColor(this,'#FFCC00','#000000')" onblur="CambiaColor(this,'','#000000')" required="required">
                      <option selected="selected"></option>
                      <option>Correo electronico</option>
                      <option>Mensaje de texto</option>
                      <option>Llamada telefonica</option>
                      <option>Visita</option>
                      <option>Otro</option>
                    </select>                  </td>
                </tr>
                <tr>
                  <td align="right"><font style="font-size:12px">Estatus:</font></td>
                  <td>
                    <select name="StatusC" id="StatusC" style="width:200px; font-size-adjust:inherit; height:30px; font-size:15px;" onfocus="CambiaColor(this,'#FFCC00','#000000')" onblur="CambiaColor(this,'','#000000')" required="required">
                      <option selected="selected"></option>
					  <option>Borrador</option>
                      <option>Cerrada</option>
                    </select>                  </td>
                </tr>
                <tr>
                  <td align="right"><font style="font-size:12px">Resumen:</font></td>
                  <td>
                      <textarea name="ResumenC" id="ResumenC" style="width:240px; font-size-adjust:inherit; height:80px; font-size:15px;" onfocus="CambiaColor(this,'#FFCC00','#000000')" onblur="CambiaColor(this,'','#000000')" required="required"></textarea>
					  <script>var f12 = new LiveValidation('ResumenC');
f12.add( Validate.Length, { maximum: 300 } );</script>
                      <input type="hidden" name="Negociacion" id="Negociacion" style="width:20px" value="<?php echo $Id_Negociacion; ?>" />                    </td>
                </tr>
              </table>
              </fieldset></td>
          </tr>
        <tr>
          <td align="right" valign="top">
              <input name="Submit" type="image" src="<?php echo base_url();?>files/images/Actualizando.png" value="Actualizar Estatus" OnClick="return confirm('Usted desea cambiar de estatus a esta negociaci&oacute;n?');" title="Actualizar Estatus"/>              </td>
          </tr>
      </table>
    </form>
    <p>&nbsp;</p>
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
