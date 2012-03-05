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
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
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
			<a href="<?php echo base_url();?>index.php/Control_Inicio/cerrar_sesion">Cerrar Sesion </a> | <a href="">Ayuda</a>		</div>
	</div><!-- END tagline -->

<!-- BEGIN tabs -->
<div id="navcontainer">
	<ul id="navlist">
		<li><a id="tabb" href="<?php echo base_url();?>index.php/Control_Inicio/a_principal" title="Inicio">Inicio</a></li>
		<li><a id="tabb" href="<?php echo base_url();?>index.php/Control_Negociacion/buscar_vendedores" title="Gestionar Negociaciones">Negociaciones</a></li>
		<li><a id="tabb" href="<?php echo base_url();?>index.php/Control_Cliente/buscar_vendedores" title="Clientes">Clientes</a></li>
		<li><a id="taba" class="active" href="<?php echo base_url();?>index.php/Control_Reporte" title="Visualizar Reportes">Reportes</a></li>
	</ul>
</div><!-- END navcontainer -->

<div id="tabbar"></div>
<!-- END header -->

<!-- BEGIN search -->
<div id="search"></div>
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
        <td width="127"><h2 style="font-size:30px">Reportes</h2></td>
        <td width="234"><h2>( <font color="#0099FF">Instituciones</font> )</h2></td>
        <td width="66" align="right"><form id="form1" method="post" action="<?php echo base_url();?>index.php/Control_Reporte">
          <input type="image" src="<?php echo base_url();?>files/images/FlechaI.png" name="Submit" value="Enviar" />
                </form></td>
      </tr>
      <tr>
        <td colspan="3"><hr align="left" style="width:435px;" /></td>
      </tr>
    </table>
    <table width="441" border="0">
      <tr>
        <td colspan="3">- <a style="color:#0099FF" onclick="javascript:window.open('<?php echo base_url();?>index.php/Control_Reporte/lista_institucion')"><b>Lista de Instituciones</b></a></td>
      </tr>
      <tr>
        <td colspan="3">- <a style="color:#0099FF" onclick="javascript:window.open('<?php echo base_url();?>index.php/Control_Reporte/lista_institucion_maxnego')"><b>Institucion con mas negociaciones abiertas</b></a></td>
      </tr>
      <tr>
        <td colspan="3">- <a style="color:#0099FF" onclick="javascript:window.open('<?php echo base_url();?>index.php/Control_Reporte/lista_institucion_minnego')"><b>Institucion con menos negociaciones abiertas</b></a></td>
      </tr>
      <tr>
        <td colspan="2">- Total de negociaciones por Institucion segun su status:</td>
        <td width="167"><a style="color:#0099FF" onclick="javascript:window.open('<?php echo base_url();?>index.php/Control_Reporte/lista_institucion_bagcp/25/1')"><b>Borrador</b></a></td>
      </tr>
      <tr>
        <td colspan="2">&nbsp;</td>
        <td><a style="color:#0099FF" onclick="javascript:window.open('<?php echo base_url();?>index.php/Control_Reporte/lista_institucion_bagcp/50/2')"><b>Activa</b></a></td>
      </tr>
      <tr>
        <td colspan="2">&nbsp;</td>
        <td><a style="color:#0099FF" onclick="javascript:window.open('<?php echo base_url();?>index.php/Control_Reporte/lista_institucion_bagcp/75/3')"><b>&gt; 75%</b></a></td>
      </tr>
      <tr>
        <td colspan="2">&nbsp;</td>
        <td><a style="color:#0099FF" onclick="javascript:window.open('<?php echo base_url();?>index.php/Control_Reporte/lista_institucion_bagcp/90/4')"><b>&gt; 90%</b></a></td>
      </tr>
      <tr>
        <td colspan="2">&nbsp;</td>
        <td><a style="color:#0099FF" onclick="javascript:window.open('<?php echo base_url();?>index.php/Control_Reporte/lista_institucion_bagcp/100/5')"><b>Ganada</b></a></td>
      </tr>
      <tr>
        <td colspan="2">&nbsp;</td>
        <td><a style="color:#0099FF" onclick="javascript:window.open('<?php echo base_url();?>index.php/Control_Reporte/lista_institucion_bagcp/100/6')"><b>Cerrada</b></a></td>
      </tr>
      <tr>
        <td colspan="2">&nbsp;</td>
        <td><a style="color:#0099FF" onclick="javascript:window.open('<?php echo base_url();?>index.php/Control_Reporte/lista_institucion_bagcp/0/7')"><b>Perdida</b></a></td>
      </tr>
      <tr>
        <td colspan="3">- Instituciones por tipo: <a style="color:#0099FF" onclick="javascript:window.open('<?php echo base_url();?>index.php/Control_Reporte/lista_instituciones_tipo/Publico')"><b>Publico</b></a> o <a style="color:#0099FF" onclick="javascript:window.open('<?php echo base_url();?>index.php/Control_Reporte/lista_instituciones_tipo/Privado')"><b>Privado</b></a></td>
        </tr>
      <tr>
        <td width="206">- Instituciones publicas y privadas por status:</td>
        <td width="54"><a style="color:#0099FF" onclick="javascript:window.open('<?php echo base_url();?>index.php/Control_Reporte/lista_instituciones_tstatus/25/1')"><b>Borrador</b></a></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><a style="color:#0099FF" onclick="javascript:window.open('<?php echo base_url();?>index.php/Control_Reporte/lista_instituciones_tstatus/50/2')"><b>Activa</b></a></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><a style="color:#0099FF" onclick="javascript:window.open('<?php echo base_url();?>index.php/Control_Reporte/lista_instituciones_tstatus/75/3')"><b>&gt; 75%</b></a></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><a style="color:#0099FF" onclick="javascript:window.open('<?php echo base_url();?>index.php/Control_Reporte/lista_instituciones_tstatus/90/4')"><b>&gt; 90%</b></a></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><a style="color:#0099FF" onclick="javascript:window.open('<?php echo base_url();?>index.php/Control_Reporte/lista_instituciones_tstatus/100/5')"><b>Ganada</b></a></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><a style="color:#0099FF" onclick="javascript:window.open('<?php echo base_url();?>index.php/Control_Reporte/lista_instituciones_tstatus/100/6')"><b>Cerrada</b></a></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><a style="color:#0099FF" onclick="javascript:window.open('<?php echo base_url();?>index.php/Control_Reporte/lista_instituciones_tstatus/0/7')"><b>Perdida</b></a></td>
        <td>&nbsp;</td>
      </tr>
    </table>
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