<!-- valid xhtml 1.1, but this is just something that makes the author proud =D -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<script src="<?php echo base_url();?>files/js/jquery-1.6.2.min.js" type="text/javascript"> </script>
<script src="<?php echo base_url();?>files/js/jquery-ui-1.8.16.custom.min.js" type="text/javascript"> </script>
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
		<a href="index.html" title="Home"><img src="http://elp21.no-ip.info:4085/SGP/files/images/Portada/logo2.gif" alt="Your logo here" width="45" height="40" /> <span id="logo-text">YOMA</span></a>
		<div id="userbar">
			<a href="http://elp21.no-ip.info:4085/SGP/index.php/ControlInicio/CerrarSesion/">Cerrar Sesion </a> | <a id="tabe" href="http://elp21.no-ip.info:4085/SGP/index.php/ControlPdf">Ayuda</a>		</div>
	</div><!-- END tagline -->

<!-- BEGIN tabs -->
<div id="navcontainer">
	<ul id="navlist">
		<li><a id="taba" class="active" href="<?php echo base_url();?>index.php/Control_Inicio/v_principal" title="Inicio">Inicio</a></li>
		<li><a id="tabb" href="<?php echo base_url();?>index.php/Control_Negociacion/ver_negociacion" title="Gestionar Negociaciones">Negociaciones</a></li>
		<li><a id="tabb" href="<?php echo base_url();?>index.php/Control_Cliente" title="Gestionar Clientes">Clientes</a></li>
		<li><a id="tabd" href="<?php echo base_url();?>index.php/Control_Institucion" title="Gestionar Instituciones">Instituci&oacute;n</a></li>
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
		<li>- <a href="<?php echo base_url();?>index.php/Control_Cliente/agregar_cliente">Clientes</a></li>
		<li>- <a href="<?php echo base_url();?>index.php/Control_Institucion">Institucion</a></li>
		<li>- <a href="<?php echo base_url();?>index.php/Control_Negociacion">Negociacion</a></li>
		<li>- <a href="#">Venta</a></li>
		<li>- <a href="#">Orden de Compra</a></li>
		<li>- <a href="#">Importacion</a></li>
	</div>
	<h3><a href="#">Ver</a></h3>
	<div>
		<li>- <a href="<?php echo base_url();?>index.php/Control_Negociacion/ver_negociacion">Negociacion</a></li>
		<li>- <a href="#">Venta</a></li>
		<li>- <a href="#">Orden de Compra</a></li>
		<li>- <a href="#">Importacion</a></li>
	</div>
	<h3><a href="#">Herramientas</a></h3>
	<div>
		<li>- <a href="#">Notificacion</a></li>
		<li>- <a href="#">Almacen</a></li>
		<li>- <a href="#">Usuarios</a></li>
		<li>- <a href="#">Productos</a></li>
		<li>- <a href="#">Facturacion</a></li>
		<li>- <a href="#">Visitas</a></li>
	</div>
</div>

</div>
	<p>&nbsp;</p>
</div><!-- END lc -->
</div><!-- END left -->

<!-- BEGIN center column -->
<div id="center">
  <div id="cc">
    <table width="106" border="0">
      <tr>
        <td width="100"><h2 style="font-size:30px">Manuales</h2></td>
        </tr>
      <tr>
        <td><a href="http://elp21.no-ip.info:4085/SGP/files/pdf/MANUAL DE USUARIO SGP GRUPOYOMA.pdf">Manual Preventa</a></td>
        </tr>
      <tr>
        <td><a href="http://elp21.no-ip.info:4085/SGP/files/pdf/MANUAL DE USUARIO SGP VENTAS GRUPOYOMA.pdf">Manual Venta</a></td>
        </tr>
      <tr>
        <td><a href="http://elp21.no-ip.info:4085/SGP/files/pdf/MANUAL DE USUARIO SGP COMPRA GRUPOYOMA.pdf">Manual Compra</a></td>
        </tr>
      <tr>
        <td><a href="http://elp21.no-ip.info:4085/SGP/files/pdf/MANUAL DE USUARIO SGP IMPORTACION GRUPOYOMA.pdf">Manual Importacion</a></td>
        </tr>
      <tr>
        <td><a href="http://elp21.no-ip.info:4085/SGP/files/pdf/MANUAL DE USUARIO SGP ALMACEN GRUPOYOMA.pdf">Manual Almacen</a></td>
        </tr>
      <tr>
        <td><a href="http://elp21.no-ip.info:4085/SGP/files/pdf/MANUAL DE USUARIO SGP FACTURACION GRUPOYOMA.pdf">Manual Facturacion </a></td>
        </tr>
      <tr>
        <td><a href="http://elp21.no-ip.info:4085/SGP/files/pdf/Accesos_Web_a_Serv_Intranet_SGP.pdf">Manual de Acceso</a></td>
        </tr>
    </table>
  </div>
  <!-- END cc -->
</div><!-- END center -->

<!-- BEGIN right column -->
<div id="right">
<div id="rc">
  <h2>Bienvenido</h2>
	<p><font style="font-size:12px;"><a href="<?php echo base_url();?>index.php/Control_Perfil"><?php echo $Usuario ?></a></font></p>
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