<!-- valid xhtml 1.1, but this is just something that makes the author proud =D -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<script src="http://elp21.no-ip.info:4085/SGP/files/js/jquery-1.6.2.min.js" type="text/javascript"></script>
<script src="http://elp21.no-ip.info:4085/SGP/files/js/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>

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
		<li><a id="tabb" href="<?php echo base_url();?>index.php/Control_Venta/ver_negociacion" title="Gestionar Ventas">Negociaciones</a></li>
		<li></li>
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
		<li>- <a href="">Calendario</a></li>
	</div>
</div>


</div>
	<p>&nbsp;</p>
</div><!-- END lc -->
</div><!-- END left -->

<!-- BEGIN center column -->
<div id="center">
  <div id="cc">
      <table width="441" border="0">
        <tr>
          <td><h2 style="font-size:30px"><?php echo $NombreC; ?> <?php echo $ApellidoC; ?></h2></td>
          </tr>
        <tr>
          <td><hr align="left" style="width:435px;" /></td>
        </tr>
        <tr>
          <td><fieldset><legend style="font-size:15px"><b>Lista de Negociaciones</b></legend>
              <table width="410" border="0">
                <tr>
                  <td width="110" align="right"><font style="font-size:12px">Borradores:</font></td>
                  <td width="284"><form id="form1" method="post" action="<?php echo base_url();?>index.php/Control_Venta/ver_negociacion_tipo">
				  <select class="ui-widget" name="Nego" id="Nego" style="width:200px; font-size-adjust:inherit; height:30px; font-size:15px;" onfocus="CambiaColor(this,'#FFCC00','#000000')" onblur="CambiaColor(this,'','#000000')" required="required">
                       <option></option>
					   <?php
						foreach ($NBorrador as $row) {
				  ?>
                        <option value="<?php echo $row['Id_Negociacion']; ?>" <?php echo set_select('Hola',$row['Id_Negociacion']); ?> ><?php echo $row['Id_Negociacion']; ?><?php echo ' - ' ?><?php echo $row['FechaP']; ?></option>
                        <?php
					}
					?>
                    </select>
                    <input type="submit" name="Submit2" value="Ir" /><input type="hidden" name="IdCliente" id="IdCliente" value="<?php echo $Cliente; ?>" />
				  
                    <input type="hidden" name="Nombre" id="Nombre" value="<?php echo $NombreC; ?>" />
                    <input type="hidden" name="Apellido" id="Apellido" value="<?php echo $ApellidoC; ?>" />
                  </form>                  </td>
                </tr>
                <tr>
                  <td align="right"><font style="font-size:12px">Activas:</font></td>
                  <td><form id="form2" method="post" action="<?php echo base_url();?>index.php/Control_Venta/ver_negociacion_tipo">
				  <select class="ui-widget" name="Nego" id="Nego" style="width:200px; font-size-adjust:inherit; height:30px; font-size:15px;" onfocus="CambiaColor(this,'#FFCC00','#000000')" onblur="CambiaColor(this,'','#000000')" required="required">
                      <option></option>
                      <?php
						foreach ($NActiva as $row) {
				  ?>
                      <option value="<?php echo $row['Id_Negociacion']; ?>" <?php echo set_select('Hola',$row['Id_Negociacion']); ?> ><?php echo $row['Id_Negociacion']; ?><?php echo ' - ' ?><?php echo $row['FechaP']; ?></option>
                      <?php
					}
					?>
                    </select>
					<input type="submit" name="Submit2" value="Ir" /><input type="hidden" name="IdCliente" id="IdCliente" value="<?php echo $Cliente; ?>" />
                    <input type="hidden" name="Nombre" id="Nombre" value="<?php echo $NombreC; ?>" />
                    <input type="hidden" name="Apellido" id="Apellido" value="<?php echo $ApellidoC; ?>" />
                  </form>                  </td>
                </tr>
                <tr>
                  <td align="right"><font style="font-size:12px">Ganadas:</font></td>
                  <td><form id="form3" method="post" action="<?php echo base_url();?>index.php/Control_Venta/cerrada">
				  <select class="ui-widget" name="Nego" id="Nego" style="width:200px; font-size-adjust:inherit; height:30px; font-size:15px;" onfocus="CambiaColor(this,'#FFCC00','#000000')" onblur="CambiaColor(this,'','#000000')" required="required">
                      <option></option>
                      <?php
						foreach ($NGanada as $row) {
				  ?>
                      <option value="<?php echo $row['Id_Negociacion']; ?>" <?php echo set_select('Hola',$row['Id_Negociacion']); ?> ><?php echo $row['Id_Negociacion']; ?><?php echo ' - ' ?><?php echo $row['FechaP']; ?></option>
                      <?php
					}
					?>
                    </select>
					<input type="submit" name="Submit2" value="Ir" /><input type="hidden" name="IdCliente" id="IdCliente" value="<?php echo $Cliente; ?>" />
                    <input type="hidden" name="Nombre" id="Nombre" value="<?php echo $NombreC; ?>" />
                    <input type="hidden" name="Apellido" id="Apellido" value="<?php echo $ApellidoC; ?>" />
                  </form>                  </td>
                </tr>
                <tr>
                  <td align="right"><font style="font-size:12px">Cerradas:</font></td>
                  <td><form id="form4" method="post" action="<?php echo base_url();?>index.php/Control_Venta/cerrada">
				  <select class="ui-widget" name="Nego" id="Nego" style="width:200px; font-size-adjust:inherit; height:30px; font-size:15px;" onfocus="CambiaColor(this,'#FFCC00','#000000')" onblur="CambiaColor(this,'','#000000')" required="required">
                      <option></option>
                      <?php
						foreach ($NCerrada as $row) {
				  ?>
                      <option value="<?php echo $row['Id_Negociacion']; ?>" <?php echo set_select('Hola',$row['Id_Negociacion']); ?> ><?php echo $row['Id_Negociacion']; ?><?php echo ' - ' ?><?php echo $row['FechaP']; ?></option>
                      <?php
					}
					?>
                    </select>
					<input type="submit" name="Submit2" value="Ir" /><input type="hidden" name="IdCliente" id="IdCliente" value="<?php echo $Cliente; ?>" />
                    <input type="hidden" name="Nombre" id="Nombre" value="<?php echo $NombreC; ?>" />
                    <input type="hidden" name="Apellido" id="Apellido" value="<?php echo $ApellidoC; ?>" />
                  </form>                  </td>
                </tr>
                <tr>
                  <td align="right"><font style="font-size:12px">Perdidas:</font></td>
                  <td width="284"><form id="form5" method="post" action="<?php echo base_url();?>index.php/Control_Venta/cerrada">
				  <select class="ui-widget" name="Nego" id="Nego" style="width:200px; font-size-adjust:inherit; height:30px; font-size:15px;" onfocus="CambiaColor(this,'#FFCC00','#000000')" onblur="CambiaColor(this,'','#000000')" required="required">
                      <option></option>
                      <?php
						foreach ($NPerdida as $row) {
				  ?>
                      <option value="<?php echo $row['Id_Negociacion']; ?>" <?php echo set_select('Hola',$row['Id_Negociacion']); ?> ><?php echo $row['Id_Negociacion']; ?><?php echo ' - ' ?><?php echo $row['FechaP']; ?></option>
                      <?php
					}
					?>
                    </select>
					<input type="submit" name="Submit2" value="Ir" /><input type="hidden" name="IdCliente" id="IdCliente" value="<?php echo $Cliente; ?>" />
                    <input type="hidden" name="Nombre" id="Nombre" value="<?php echo $NombreC; ?>" />
                    <input type="hidden" name="Apellido" id="Apellido" value="<?php echo $ApellidoC; ?>" />
                  </form>                  </td>
                </tr>
              </table>
              </fieldset></td>
          </tr>
        <tr>
          <td><form id="form6" method="post" action="<?php echo base_url();?>index.php/Control_Venta/atras_negociacion">
              <p align="left" style="margin-left:-10px"><input type="image" name="Submit" src="<?php echo base_url();?>files/images/FlechaI.png" title="Atras"/><input type="hidden" name="IdCliente" id="IdCliente" value="<?php echo $Cliente; ?>" />
              </p>
            </form>            </td>
          </tr>
      </table>
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
