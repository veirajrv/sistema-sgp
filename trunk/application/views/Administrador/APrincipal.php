<!-- valid xhtml 1.1, but this is just something that makes the author proud =D -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<script src="<?php echo base_url();?>files/js/jquery-1.6.2.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>files/js/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>

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
	
<!-- meta tags begin -->
	<!-- vital meta tags -->
	<meta http-equiv="refresh" content="15; url=<?php echo base_url();?>index.php/Control_Inicio/a_principal" />
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
		<a href="index.html" title="Home"><img src="<?php echo base_url();?>files/images/Portada/logo2.gif" alt="Your logo here" width="45" height="40" /> <span id="logo-text">YOMA</span></a>
		<div id="userbar">
			<a href="<?php echo base_url();?>index.php/Control_Inicio/cerrar_sesion">Cerrar Sesion </a> | <a href="<?php echo base_url();?>index.php/Control_Pdf/index2">Ayuda</a>		</div>
	</div><!-- END tagline -->

<!-- BEGIN tabs -->
<div id="navcontainer">
	<ul id="navlist">
		<li><a id="taba" class="active" href="<?php echo base_url();?>index.php/Control_Inicio/a_principal" title="Inicio">Inicio</a></li>
		<li><a id="tabb" href="<?php echo base_url();?>index.php/Control_Negociacion/buscar_vendedores" title="Gestionar Negociaciones">Negociaciones</a></li>
		<li><a id="tabb" href="<?php echo base_url();?>index.php/Control_Cliente/buscar_vendedores" title="Clientes">Clientes</a></li>
		<li><a id="tabb" href="<?php echo base_url();?>index.php/Control_Reporte" title="Visualizar Reportes">Reportes</a></li>
	</ul>
</div><!-- END navcontainer -->

<div id="tabbar"></div>
<!-- END header -->

<!-- BEGIN search -->
<div id="search">
  <div align="right">
    <form id="form5" method="post" action="<?php echo base_url();?>index.php/Control_Negociacion/todas_vistas">
      <table width="200" border="0" align="right" style="margin-top:-2px">
        <tr>
          <td width="158" align="left"><div align="right">
            <input name="Buscar" type="text" id="Buscar" style="width:100px; font-size-adjust:inherit; height:30px; font-size:15px;" onfocus="CambiaColor(this,'#FFCC00','#000000')" onblur="CambiaColor(this,'','#000000')" placeholder="Buscar" required="required" onkeypress="return soloNumeros(event)"/>
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
    <table width="440" border="0">
      <tr>
        <td colspan="2" align="center"><font style="font-size:12px;">Usted tienes <?php echo "<font style='font-size:18px;' color='#FF0000'><b>$NumeroPorAprobar</b></font>" ?> negociaciones por aprobar</font></td>
        </tr>
      <tr>
        <td width="140" align="right"><font style="font-size:12px; color:#369"><b>Negociaciones para ser aprobadas:</b></font></td>
        <td width="291"><form id="form1" method="post" action="<?php echo base_url();?>index.php/Control_Negociacion/sin_aprobar_2">
            
              <select name="SinAprobar" id="SinAprobar" style="width:200px; font-size-adjust:inherit; height:30px; font-size:15px;" onfocus="CambiaColor(this,'#FFCC00','#000000')" onblur="CambiaColor(this,'','#000000')" required="required">
                <option></option>
                <?php
						foreach ($SinAutorizar as $row) {
				  ?>
                <option value="<?php echo $row['Id_Negociacion']; ?>" <?php echo set_select('Hola',$row['Id_Negociacion']); ?> ><?php echo $row['Id_Negociacion']; ?></option>
                <?php
					}
					?>
              </select>
              <input type="submit" name="Submit" value="Ver" onclick="confirmar()" />
                
        </form></td>
      </tr>
      <tr>
        <td colspan="2"><hr align="left" style="width:435px;" /></td>
      </tr>
    </table>
    <form id="form2" method="post" action="">
      <table width="440" border="0">
        <tr>
          <td><div align="center"><a href="<?php echo base_url();?>index.php/Control_Negociacion/buscar_vendedores"><img src="<?php echo base_url();?>files/images/Total.png" alt="a" width="40" height="40" title="Total" /></a><br />
          <font style="font-size:18px" color="#FF0000"><?php echo $NumeroTotal; ?></font></div></td>
          <td>&nbsp;</td>
          <td><div align="center"><a href="<?php echo base_url();?>index.php/Control_Negociacion/buscar_vendedores"><img src="<?php echo base_url();?>files/images/Alertas_Status.png" alt="a" width="60" height="50" title="Alerta de negociaciones expiradas a la fecha" /></a><br />
                <font style="font-size:18px" color="#FF0000"><?php echo $ConAlertaTotal; ?></font></div></td>
          <td>&nbsp;</td>
          <td><div align="center"><a href="<?php echo base_url();?>index.php/Control_Negociacion/buscar_vendedores"><img src="<?php echo base_url();?>files/images/Alertas_Borrador.png" alt="a" width="60" height="50" title="Alerta de negociaciones con mas de (5) aprobaciones" /></a><br />
                <font style="font-size:18px" color="#FF0000"><?php echo $ConModTotal; ?></font></div></td>
        </tr>
        <tr>
          <td colspan="5">&nbsp;</td>
        </tr>
        <tr>
          <td width="80"><div align="center"><a href="<?php echo base_url();?>index.php/Control_Negociacion/buscar_vendedores"><img src="<?php echo base_url();?>files/images/Borrador.png" alt="" width="40" height="40" title="Borradores" /></a><br />
          <font style="font-size:18px" color="#FF0000"><?php echo $NumeroBorrador; ?></font></div></td>
          <td width="80"><div align="center"><a href="<?php echo base_url();?>index.php/Control_Negociacion/buscar_vendedores/<?php echo $Usuario ?>"><img src="<?php echo base_url();?>files/images/Activa.png" alt="a" width="40" height="40" title="Activas" /></a><br />
          <font style="font-size:18px" color="#FF0000"><?php echo $NumeroActiva; ?></font></div></td>
          <td width="80"><div align="center"><a href="<?php echo base_url();?>index.php/Control_Negociacion/buscar_vendedores/<?php echo $Usuario ?>"><img src="<?php echo base_url();?>files/images/Ganada.png" alt="a" width="40" height="40" title="Ganadas" /></a><br />
          <font style="font-size:18px" color="#FF0000"><?php echo $NumeroGanada; ?></font></div></td>
          <td width="80"><div align="center"><a href="<?php echo base_url();?>index.php/Control_Negociacion/buscar_vendedores/<?php echo $Usuario ?>"><img src="<?php echo base_url();?>files/images/Cerrada.png" alt="a" width="40" height="40" title="Cerradas" /></a><br />
          <font style="font-size:18px" color="#FF0000"><?php echo $NumeroCerrada; ?></font></div></td>
          <td width="86"><div align="center"><a href="<?php echo base_url();?>index.php/Control_Negociacion/buscar_vendedores/<?php echo $Usuario ?>"><img src="<?php echo base_url();?>files/images/Perdida.png" alt="a" width="40" height="40" title="Perdidas" /></a><br />
          <font style="font-size:18px" color="#FF0000"><?php echo $NumeroPerdida; ?></font></div></td>
        </tr>
      </table>
    </form>
    <form id="form3" method="post" action="<?php echo base_url();?>index.php/Control_Negociacion/ver_vista_alertas">
      <table width="437" border="0">
        <tr align="center">
          <td colspan="2"><hr align="left" style="width:435px;" /></td>
        </tr>
        <tr>
          <td width="140" align="right"><font style="margin-left:-10px; font-size:12px; color:#369"><b>Negociaciones en Alerta:</b></font></td>
          <td width="291"><select name="Nego" id="Nego" style="width:150px; font-size-adjust:inherit; height:30px; font-size:15px;" onfocus="CambiaColor(this,'#FFCC00','#000000')" onblur="CambiaColor(this,'','#000000')" required="required">
            <option></option>
            <?php
						foreach ($ConAlerta as $row) {
				  ?>
            <option value="<?php echo $row['Id_Negociacion']; ?>" <?php echo set_select('Hola',$row['Id_Negociacion']); ?> ><?php echo $row['Id_Negociacion']; ?></option>
            <?php
					}
					?>
          </select>
          <input type="submit" name="Submit22" value="Buscar" /></td>
        </tr>
        <tr>
          <td colspan="2"><hr align="left" style="width:435px;" /></td>
        </tr>
        <tr>
          <td colspan="2"><font style="font-size:12px;">
            <?php $j=0; foreach ($NegociacionesEx as $row){
							
						echo "<font style='font-size:12px; color:#369'><b>Vendedor: </b></font>";
						echo $row['Nombre_1']; echo "&nbsp;"; echo $row['Apellido_1']; echo "&nbsp;"; echo $row['Apellido_2'];
						echo "<b> - <font style='font-size:12px; color:#369'>Nro:</font> </b>"; echo $row['Id_Negociacion'];
						echo " ( "; echo $row['Contador']; echo " Veces )";
						echo "<br />";
						$j++;}?>
          </font></td>
        </tr>
      </table>
    </form>
    <p>&nbsp;</p>
  </div><!-- END cc -->
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

