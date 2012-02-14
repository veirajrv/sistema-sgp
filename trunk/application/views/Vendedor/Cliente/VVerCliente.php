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
			<a href="<?php echo base_url();?>index.php/Control_Inicio/cerrar_sesion/">Cerrar Sesion </a> | <a id="tabe" href="http://elp21.no-ip.info:4085/SGP/index.php/Control_Pdf">Ayuda</a>		</div>
	</div>
	<!-- END tagline -->

<!-- BEGIN tabs -->
<div id="navcontainer">
	<ul id="navlist">
		<li><a id="tabb" href="<?php echo base_url();?>index.php/Control_Inicio/v_principal" title="Inicio">Inicio</a></li>
		<li><a id="tabb" href="<?php echo base_url();?>index.php/Control_Negociacion" title="Gestionar Negociaciones">Negociaciones</a></li>
		<li><a id="taba" class="active" href="<?php echo base_url();?>index.php/Control_Cliente" title="Crear Clientes">Clientes</a></li>
		<li><a id="tabd" href="<?php echo base_url();?>index.php/Control_Institucion" title="Visualizar Reportes">Instituci&oacute;n</a></li>
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
		<li>- <a href="<?php echo base_url();?>index.php/Control_Institucion/agregar_institucion">Institucion</a></li>
		<li>- <a href="<?php echo base_url();?>index.php/Control_Negociacion">Negociacion</a></li>
	</div>
	<h3><a href="#">Ver</a></h3>
	<div>
		<li>- <a href="<?php echo base_url();?>index.php/Control_Negociacion/ver_negociacion">Negociacion</a></li>
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
      <table width="441" border="0">
        <tr>
          <td width="378"><h2 style="font-size:30px">Mis Clientes </h2></td>
          <td width="53" align="right" valign="middle"><a href="<?php echo base_url();?>index.php/Control_Cliente/agregar_cliente"><img src="<?php echo base_url();?>files/images/agregar.png" alt="a" width="30" height="30" title="Agregar nuevo cliente" /></a></td>
        </tr>
        <tr>
          <td colspan="2"><hr align="left" style="width:435px;" /></td>
        </tr>
        <tr>
          <td colspan="2"><fieldset><legend style="font-size:15px">Lista de clientes</legend>
              <table width="410" border="0">
                <tr>
                  <td align="right"><font style="font-size:12px">Buscador:</font></td>
                  <td><form id="form4" method="post" action="<?php echo base_url();?>index.php/Control_Cliente/buscar_cualquiera">
                        <input name="Buscar" type="text" id="Buscar" onkeypress="return validar(event)" style="width:195px; font-size-adjust:inherit; height:30px; font-size:15px;" maxlength="150" required="required" onfocus="CambiaColor(this,'#FFCC00','#000000')" onblur="CambiaColor(this,'','#000000')" placeholder="Nombre / Apellido Cliente"/>    
                        <input type="submit" name="Submit" value="Buscar" />
                  </form>                  
				  </td>
                </tr>
                <tr>
                  <td width="110" align="right"><font style="font-size:12px">Nombre:</font></td>
                  <td width="284">
                    <form id="form1" method="post" action="<?php echo base_url();?>index.php/Control_Cliente/ver_perfil">
                      
					  <select class="ui-widget" name="Cliente" id="Cliente" style="width:200px; font-size-adjust:inherit; height:30px; font-size:15px;" onfocus="CambiaColor(this,'#FFCC00','#000000')" onblur="CambiaColor(this,'','#000000')" required="required">
                        <option></option>
                        <?php
						foreach ($Clientes as $row) {
				  ?>
                        <option value="<?php echo $row['Id_Cliente']; ?>" <?php echo set_select('Hola',$row['Id_Cliente']); ?> ><?php echo $row['Nombre']; ?></option>
                        <?php
					}
					?>
                      </select>
					  <input type="submit" name="Submit2" value="Buscar" />
                    </form>                   </td>
                </tr>
                <tr>
                  <td width="110" align="right"><font style="font-size:12px">Apellido:</font></td>
                  <td>
                    
                      <form id="form2" method="post" action="<?php echo base_url();?>index.php/Control_Cliente/ver_perfil">
                        <select class="ui-widget" name="Cliente" id="Cliente" style="width:200px; font-size-adjust:inherit; height:30px; font-size:15px;" onfocus="CambiaColor(this,'#FFCC00','#000000')" onblur="CambiaColor(this,'','#000000')" required="required">
                          <option></option>
                          <?php
						foreach ($Clientes as $row) {
				  ?>
                          <option value="<?php echo $row['Id_Cliente']; ?>" <?php echo set_select('Hola',$row['Id_Cliente']); ?> ><?php echo $row['Apellido']; ?></option>
                          <?php
					}
					?>
                        </select>
                        <input type="submit" name="Submit22" value="Buscar" />
                      </form>                       </td>
                </tr>
                <tr>
                  <td width="110" align="right"><font style="font-size:12px">Cedula:</font></td>
                  <td>
                    
                      <form id="form3" method="post" action="<?php echo base_url();?>index.php/Control_Cliente/ver_perfil">
                        <select class="ui-widget" name="Cliente" id="Cliente" style="width:200px; font-size-adjust:inherit; height:30px; font-size:15px;" onfocus="CambiaColor(this,'#FFCC00','#000000')" onblur="CambiaColor(this,'','#000000')" required="required">
                          <option></option>
                          <?php
						foreach ($Clientes as $row) {
				  ?>
                          <option value="<?php echo $row['Id_Cliente']; ?>" <?php echo set_select('Hola',$row['Id_Cliente']); ?> ><?php echo $row['Cedula']; ?></option>
                          <?php
					}
					?>
                        </select>
                        <input type="submit" name="Submit23" value="Buscar" />
                      </form>                       </td>
                </tr>
              </table>
              </fieldset></td>
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