<!-- valid xhtml 1.1, but this is just something that makes the author proud =D -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<script src="http://elp21.no-ip.info:4085/SGP/files/js/jquery-1.6.2.min.js" type="text/javascript"> </script>
<script src="http://elp21.no-ip.info:4085/SGP/files/js/jquery-ui-1.8.16.custom.min.js" type="text/javascript"> </script>

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

<script>
	$(function() {
		$( "#datepicker" ).datepicker();
	});
</script>



	
<!-- meta tags begin -->
	<!-- vital meta tags -->
	<meta http-equiv="refresh" content="15; url=<?php echo base_url();?>index.php/Control_Inicio/v_principal" />
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
<body onLoad="cambiar()">

<!-- BEGIN global wrapper -->
<!-- BEGIN header -->
<div id="monster">

  <div id="tagline">
		<a href="index.html" title="Home"><img src="http://elp21.no-ip.info:4085/SGP/files/images/Portada/logo2.gif" alt="Your logo here" width="45" height="40" /> <span id="logo-text">YOMA
		</span></a>
		<div id="userbar">
			<a href="<?php echo base_url();?>index.php/Control_Inicio/cerrar_sesion">Cerrar Sesion </a> | <a id="tabe" href="<?php echo base_url();?>index.php/Control_Pdf">Ayuda</a></div>
	</div>
	<!-- END tagline -->

<!-- BEGIN tabs -->
<div id="navcontainer">
	<ul id="navlist">
		<li><a id="taba" class="active" href="<?php echo base_url();?>index.php/Control_Inicio/v_principal" title="Inicio">Inicio</a></li>
		<li><a id="tabb" href="<?php echo base_url();?>index.php/Control_Negociacion/ver_negociacion" title="Gestionar Negociaciones">Negociaciones</a></li>
		<li><a id="tabb" href="<?php echo base_url();?>index.php/Control_Cliente" title="Gestionar Clientes">Clientes</a></li>
		<li><a id="tabb" href="<?php echo base_url();?>index.php/Control_Institucion" title="Gestionar Instituciones">Instituci&oacute;n</a></li>
	</ul>
</div><!-- END navcontainer -->

<div id="tabbar"></div>
<!-- END header -->

<!-- BEGIN search -->
<div id="search">
  <div align="right">
    <form id="form5" method="post" action="<?php echo base_url();?>index.php/Control_Negociacion/ver_vista_nego">
      <table width="200" border="0" align="right" style="margin-top:-2px">
        <tr>
          <td width="158" align="left"><div align="right">
            <input name="Nego" type="text" id="Buscar" style="width:100px; font-size-adjust:inherit; height:30px; font-size:15px;" onfocus="CambiaColor(this,'#FFCC00','#000000')" onblur="CambiaColor(this,'','#000000')" placeholder="Buscar" required="required" onkeypress="return soloNumeros(event)"/>
          </div></td>
          <td width="32"><input name="image" type="image" value="Buscar" src="<?php echo base_url();?>files/images/lupa-32x32.png"/></td>
        </tr>
      </table>
      </form>
    </div>
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
		<li>- <a href="">Venta</a></li>
		<li>- <a href="">Orden de Compra</a></li>
		<li>- <a href="">Importacion</a></li>
	</div>
	<h3><a href="#">Ver</a></h3>
	<div>
		<li>- <a href="<?php echo base_url();?>index.php/Control_Negociacion/ver_negociacion">Negociacion</a></li>
		<li>- <a href="">Venta</a></li>
		<li>- <a href="">Orden de Compra</a></li>
		<li>- <a href="">Importacion</a></li>
		<li>- <a href="">Reporte</a></li>
	</div>
	<h3><a href="#">Herramientas</a></h3>
	<div>
		<li>- <a href="">Calendario</a></li>
		<li>- <a href="">Almacen</a></li>
		<li>- <a href="">Usuarios</a></li>
		<li>- <a href="">Productos</a></li>
		<li>- <a href="">Facturacion</a></li>
		<li>- <a href="">Visitas</a></li>
	</div>
</div>

</div>
	<p>&nbsp;</p>
</div><!-- END lc -->
</div><!-- END left -->

<!-- BEGIN center column -->
<div id="center">

<div id="cc">
  <table width="440" border="0">
    <tr>
      <td width="160" align="right"><font style="font-size:12px; color:#369"><b>Negociaciones por aprobar:</b></font></td>
      <td width="271"><form id="form1" method="post" action="<?php echo base_url();?>index.php/Control_Negociacion/sin_aprobar">
        
          <select name="SinAprobar" id="SinAprobar" style="width:150px; font-size-adjust:inherit; height:30px; font-size:15px;" onfocus="CambiaColor(this,'#FFCC00','#000000')" onblur="CambiaColor(this,'','#000000')" required="required">
            <option></option>
            <?php
						foreach ($SinAutorizar as $row) {
				  ?>
            <option value="<?php echo $row['Id_Negociacion']; ?>" <?php echo set_select('Hola',$row['Id_Negociacion']); ?> ><?php echo $row['Id_Negociacion']; ?></option>
            <?php
					}
					?>
              </select>
          <input type="submit" name="Submit" value="Enviar" OnClick="return confirm('Quieres mandarle al supervisor esta negociacion?');" />
          
      </form>        </td>
    </tr>
    <tr>
      <td width="160" align="right"><font style="font-size:12px; color:#369"><b>Negociaciones por corregir:</b></font></td>
      <td><form id="form1" method="post" action="<?php echo base_url();?>index.php/Control_Negociacion/desbloquear">
        <select name="Bloqueada" id="Bloqueada" style="width:150px; font-size-adjust:inherit; height:30px; font-size:15px;" onfocus="CambiaColor(this,'#FFCC00','#000000')" onblur="CambiaColor(this,'','#000000')" required="required">
          <option></option>
          <?php
						foreach ($Rechazadas as $row) {
				  ?>
          <option value="<?php echo $row['Id_Negociacion']; ?>" <?php echo set_select('Hola',$row['Id_Negociacion']); ?> ><?php echo $row['Id_Negociacion']; ?></option>
          <?php
					}
					?>
        </select>
        <input type="submit" name="Submit3" value="Desbloquear" onclick="return confirm('Desea desbloquear esta negociacion?');" />
      </form></td>
    </tr>
    <tr>
      <td colspan="2"><hr align="left" style="width:435px;" /></td>
      </tr>
  </table>
  <table width="440" border="0">
    <tr>
      <td colspan="2" align="center"><font style="font-size:12px;">Usted tienes <?php echo "<font style='font-size:18px;' color='#FF0000'><b>$NumeroAprobadas</b></font>" ?> negociaciones aprobadas</font></td>
      </tr>
    <tr>
      <td width="160" align="right"><font style="margin-left:-10px; font-size:12px; color:#369"><b>Negociaciones Aprobadas:</b></font></td>
      <td width="270"><form id="form2" method="post" action="<?php echo base_url();?>index.php/Control_Negociacion/ver_vista_nego">
          <select name="Nego" id="Nego" style="width:150px; font-size-adjust:inherit; height:30px; font-size:15px;" onfocus="CambiaColor(this,'#FFCC00','#000000')" onblur="CambiaColor(this,'','#000000')" required="required">
            <option></option>
            <?php
						foreach ($ConAutorizar as $row) {
				  ?>
            <option value="<?php echo $row['Id_Negociacion']; ?>" <?php echo set_select('Hola',$row['Id_Negociacion']); ?> ><?php echo $row['Id_Negociacion']; ?></option>
            <?php
					}
					?>
          </select>
          <input type="submit" name="Submit2" value="Buscar" />
      </form></td>
    </tr>
  </table>
  <p>&nbsp;</p>
  <p>
</p>
  <p>&nbsp;</p>
  <p>
    <label></label>
  </p>
  <p></p>
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

