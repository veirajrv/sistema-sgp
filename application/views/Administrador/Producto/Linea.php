<!-- valid xhtml 1.1, but this is just something that makes the author proud =D -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<script src="<?php echo base_url();?>files/js/jquery-1.6.2.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>files/js/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>

<head>

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
		$( "a", ".demo" ).click(function() { return false; });
	});
</script>

<script type="text/javascript">
function CambiaColor(esto,borde,texto)
 {
    esto.style.borderColor=borde;
	esto.style.color=texto;
 }
</script>
	
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
		<a href="../index.html" title="Home"><img src="<?php echo base_url();?>files/images/Portada/logo2.gif" alt="Your logo here" width="45" height="40" /> <span id="logo-text">YOMA</span></a>
		<div id="userbar">
			<a href="<?php echo base_url();?>index.php/Control_Inicio/cerrar_sesion">Cerrar Sesion </a> | <a id="tabe" href="">Ayuda</a>		</div>
	</div><!-- END tagline -->

<!-- BEGIN tabs -->
<div id="navcontainer">
	<ul id="navlist">
		<li><a id="taba" class="active" href="<?php echo base_url();?>index.php/Control_Inicio/a_principal" title="Inicio">Inicio</a></li>
		<li><a id="tabb" href="<?php echo base_url();?>index.php/Control_Negociacion/buscar_vendedores" title="Gestionar Negociaciones">Negociaciones</a></li>
		<li><a id="tabb" href="<?php echo base_url();?>index.php/Control_Cliente/buscar_vendedores" title="Clientes">Clientes</a></li>
		<li><a id="tabd" href="<?php echo base_url();?>index.php/Control_Reporte" title="Visualizar Reportes">Reportes</a></li>
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
  <form id="form3" method="post" action="<?php echo base_url();?>index.php/Control_Producto/index2">
    <table width="440" border="0">
      <tr>
        <td width="220"><h2 style="font-size:30px">Nueva Linea </h2></td>
        <td width="210" align="right"><input type="image" src="<?php echo base_url();?>files/images/FlechaI.png" name="Submit" title="Atras" /></td>
      </tr>
      <tr>
        <td colspan="2"><hr align="left" style="width:435px;"></td>
        </tr>
    </table>
  </form>
  <form id="form1" method="post" action="<?php echo base_url();?>index.php/Control_Producto/crear_linea">
    <table width="440" border="0">
      <tr>
        <td colspan="3" align="center"><?php if(isset($Mensaje))
		{
			echo '<font color="#00FF00" style="font-size:20px;"><b>'.$Mensaje.'</b></font>';
		}?></td>
      </tr>
      <tr>
        <td colspan="3" align="center"><cite>"Aqui creamos lineas que no han sido creadas anteriormente en el sistema"</cite></td>
      </tr>
      <tr>
        <td align="right"><font style="font-size:12px">Marca:</font></td>
        <td colspan="2"><select class="ui-widget" name="Marca" id="Marca" style="width:200px; font-size-adjust:inherit; height:30px; font-size:15px;" onfocus="CambiaColor(this,'#FFCC00','#000000')" onblur="CambiaColor(this,'','#000000')" required="required">
            <option></option>
            <?php
						foreach ($Marca as $row) {
				  ?>
            <option value="<?php echo $row['Id_Marca']; ?>" <?php echo set_select('Hola',$row['Id_Marca']); ?> ><?php echo $row['Nombre']; ?></option>
            <?php
					}
					?>
        </select></td>
      </tr>
      <tr>
        <td align="right"><font style="font-size:12px">Nombre:</font></td>
        <td width="200"><input name="Linea" type="text" id="Linea" onkeypress="return validar(event)" style="width:200px; font-size-adjust:inherit; height:30px; font-size:15px;" maxlength="150" required="required" onfocus="CambiaColor(this,'#FFCC00','#000000')" onblur="CambiaColor(this,'','#000000')"/></td>
        <td width="106">&nbsp;</td>
      </tr>
      <tr>
        <td width="120">&nbsp;</td>
        <td align="right"><input type="submit" name="Submit2" value="Agregar" /></td>
        <td align="right">&nbsp;</td>
      </tr>
    </table>
  </form>
  <form id="form2" method="post" action="<?php echo base_url();?>index.php/Control_Producto/crear_linea_2">
    <table width="441" border="0">
      <tr>
        <td colspan="3" align="center"><?php if(isset($Mensaje2))
		{
			echo '<font color="#00FF00" style="font-size:20px;"><b>'.$Mensaje2.'</b></font>';
		}?></td>
      </tr>
      <tr>
        <td colspan="3" align="center"><hr align="left" style="width:435px;"></td>
      </tr>
      <tr>
        <td colspan="3" align="center"><font color="#369" style="font-size:20px">Relaci&oacute;n</font></td>
        </tr>
      <tr>
        <td colspan="3" align="center"><cite>"Esta opcion de relacionar nos sirve para asignar lineas ya previamente creadas a marcas que tambien ya han sido creadas anteriormente"</cite></td>
      </tr>
      <tr>
        <td width="120" align="right"><font style="font-size:12px">Marca:</font></td>
        <td colspan="2"><select class="ui-widget" name="Marca" id="Marca" style="width:200px; font-size-adjust:inherit; height:30px; font-size:15px;" onfocus="CambiaColor(this,'#FFCC00','#000000')" onblur="CambiaColor(this,'','#000000')" required="required">
          <option></option>
          <?php
						foreach ($Marca as $row) {
				  ?>
          <option value="<?php echo $row['Id_Marca']; ?>" <?php echo set_select('Hola',$row['Id_Marca']); ?> ><?php echo $row['Nombre']; ?></option>
          <?php
					}
					?>
        </select></td>
      </tr>
      <tr>
        <td align="right"><font style="font-size:12px">Linea:</font></td>
        <td width="200"><select class="ui-widget" name="Linea" id="Linea" style="width:200px; font-size-adjust:inherit; height:30px; font-size:15px;" onfocus="CambiaColor(this,'#FFCC00','#000000')" onblur="CambiaColor(this,'','#000000')" required="required">
          <option></option>
          <?php
						foreach ($Lista as $row) {
				  ?>
          <option value="<?php echo $row['Id_Linea']; ?>" <?php echo set_select('Hola',$row['Id_Linea']); ?> ><?php echo $row['Nombre']; ?></option>
          <?php
					}
					?>
        </select></td>
        <td width="107">&nbsp;</td>
      </tr>
      <tr>
        <td align="right">&nbsp;</td>
        <td width="200" align="right"><input type="submit" name="Submit22" value="Relacionar" /></td>
        <td>&nbsp;</td>
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
