<!-- valid xhtml 1.1, but this is just something that makes the author proud =D -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<script src="<?php echo base_url();?>files/js/jquery-1.6.2.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>files/js/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>

<head>
	
<script> 
function sumar() { 
var n1 = parseInt(document.MyForm.numero2.value); 
var n2 = (n1/100) * (<?php foreach ($Total as $row){echo $row['Total'];}?>);
var n3 = <?php foreach ($Total as $row){echo $row['Total'];}?>;
document.MyForm.resultado2.value = n3 - n2; 
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
		$( "input:submit, input:button, input:reset").button();
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
		<a href="index.html" title="Home"><img src="<?php echo base_url();?>files/images/Portada/logo2.gif" alt="Your logo here" width="45" height="40" /> <span id="logo-text">YOMA
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
    <form id="form1" method="post" action="<?php echo base_url();?>index.php/Control_Negociacion/agregar_otro_accesorios2">
      <table width="441" border="0">
        <tr>
          <td><h2 style="font-size:30px">Codigo Negociaci&oacute;n (<?php echo $Id_Negociacion; ?>)</h2></td>
          </tr>
        <tr>
          <td><hr align="left" style="width:435px;" /></td>
        </tr>
      </table>
    </form>
      <table width="441" border="0">
        <tr>
          <td><fieldset><legend style="font-size:15px">Vista previa <a href="<?php echo base_url();?>index.php/Control_Negociacion/cambio_status_3a/<?php echo $Id_Negociacion; ?>"><img src="<?php echo base_url();?>files/images/icono_filtro.png" alt="" width="16" height="16" title="Cambio de estatus"/></a> <a href="<?php echo base_url();?>index.php/Control_Negociacion/historial_status_a/<?php echo $Id_Negociacion; ?>"><img src="<?php echo base_url();?>files/images/Status.png" alt="e" width="16" height="16" title="Historial negociacion"/></a></legend>
              <form name="MyForm" method="post" action="<?php echo base_url();?>index.php/Control_Negociacion/aprobar">
                <table width="410" border="0">
                  <tr>
                    <td width="270" rowspan="2"><img src="<?php echo base_url();?>files/images/Logo_Formato.png" alt="" width="147" height="69" /></td>
                    <td width="130"><div align="right"><strong>R.I.F.</strong> J-00190554-5</div></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td colspan="2"><strong>Cliente: </strong>
                    <?php foreach ($DatosCliente as $row){
							echo $row['Nombre']; 
							     }?></td>
                  </tr>
                  <tr>
                    <td colspan="2"><strong>Direcci&oacute;n: </strong>
                    <?php foreach ($DatosCliente as $row){
							echo $row['Direccion1'];
							     }?></td>
                  </tr>
                  <tr>
                    <td><strong>R.I.F: </strong>
                    <?php foreach ($DatosCliente as $row){
							echo $row['Rif'];
							     }?></td>
                    <td><strong>EJECUTIVO DE VENTAS: </strong></td>
                  </tr>
                  <tr>
                    <td><strong>Telefonos: </strong>
                    <?php foreach ($DatosCliente as $row){
							echo $row['Telefono1']; echo '&nbsp/&nbsp'; echo $row['Telefono2'];
							     }?></td>
                    <td><?php foreach ($DatosVendedor as $row){
							echo $row['Nombre_1']; echo '&nbsp'; echo $row['Apellido_1']; echo '&nbsp'; echo $row['Apellido_2'];
							     }?></td>
                  </tr>
                  <tr>
                    <td><strong>Fax: </strong>
                    <?php foreach ($DatosCliente as $row){
							echo $row['Telefono3']; 
							     }?></td>
                    <td><strong>Fecha: </strong>
                    <?php foreach ($DatosVendedor as $row){
							echo $row['FechaP']; 
							     }?></td>
                  </tr>
                  <tr>
                    <td colspan="2"><strong>Web: </strong>
                      <?php foreach ($DatosCliente as $row){
							echo $row['Web']; 
							     }?></td>
                  </tr>
                  <tr>
                    <td colspan="2"><strong>Atenci&oacute;n: </strong></td>
                  </tr>
                  <tr>
                    <td colspan="2"><hr align="left" style="width:400px;" /></td>
                  </tr>
                </table>
              </form>
              <table width="409" border="0">
                <tr>
                  <td width="105"><b>Nombre</b></td>
                  <td width="60"><b>Cantidad</b></td>
                  <td colspan="2"><b>Descripci&oacute;n</b></td>
                </tr>
                <tr>
                  <td><?php $j=0; foreach ($Lista as $row){ echo $row['Nombre']; echo "<br />"; $j++;}?> <?php $j=0; foreach ($Lista2 as $row){ echo $row['Nombre']; echo "<br />"; $j++;}?></td>
                  <td><?php $j=0; foreach ($Lista as $row){ echo $row['Cantidad']; echo "<br />"; $j++;}?>
                  <?php $j=0; foreach ($Lista2 as $row){ echo $row['Cantidad']; echo "<br />"; $j++;}?></td>
                  <td colspan="2"><?php $j=0; foreach ($Lista as $row){ echo $row['Descripcion']; echo "<br />"; $j++;}?>
                  <?php $j=0; foreach ($Lista2 as $row){ echo $row['Descripcion']; echo "<br />"; $j++;}?></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td width="191" align="right"><b>Neto:</b></td>
                  <td width="35"><?php echo $Neto; ?></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td align="right"><b>I.V.A 12%:</b></td>
                  <td><?php foreach ($Descuento as $row){
							echo substr($row['Total']*0.12,0,8); 
							     }?></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td align="right"><b>Descuento:</b></td>
                  <td><?php foreach ($Descuento as $row){
							echo $row['Descuento']; 
							     }?></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td align="right"><b>TOTAL:</b></td>
                  <td bgcolor="#FFFF00"><?php foreach ($Descuento as $row){
							echo substr($row['Total'] + ($row['Total']*0.12),0,8); 
							     }?></td>
                </tr>
              </table>
          </fieldset></td>
        </tr>
        <tr>
          <td valign="top"><form id="form3" method="post" action="<?php echo base_url();?>index.php/Control_Negociacion/atras_avista_previa">
              <input name="Submit" type="image" src="<?php echo base_url();?>files/images/FlechaI.png" id="Submit" value="Atras" />
          </form>		  </td>
          </tr>
      </table>
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