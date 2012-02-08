<!-- valid xhtml 1.1, but this is just something that makes the author proud =D -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<script src="http://elp21.no-ip.info:4085/SGP/files/js/jquery-1.6.2.min.js" type="text/javascript"></script>
<script src="http://elp21.no-ip.info:4085/SGP/files/js/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>

<head>

<script type="text/javascript">
	 $(document).ready(function(){
            $("#subgroup").click(function () {
			var id = $('#subgroup').val();
			console.log(id);
                $.ajax({
                    type: "GET",
                    url: "<?php echo base_url().'index.php/Control_Producto/ajax_marca_linea/'?>" + id,
					dataType: 'html',
					success: function(data)
					{
					$('#account').replaceWith("<select style='width:200px; font-size-adjust:inherit; height:30px; font-size:15px;' onfocus='CambiaColor(this,'#FFCC00','#000000')' onblur='CambiaColor(this,'','#000000')' required='required' name='account' id='account'>" + data + "</select>");
					}
                });
            });
        });
</script>

<script type="text/javascript">
	 $(document).ready(function(){
			$("#subgroup2").click(function () {
			var id = $('#subgroup2').val();
			console.log(id);
                $.ajax({
                    type: "GET",
                    url: "<?php echo base_url().'index.php/Control_Producto/ajax_marca_linea/'?>" + id,
					dataType: 'html',
					success: function(data)
					{
					$('#account2').replaceWith("<select style='width:200px; font-size-adjust:inherit; height:30px; font-size:15px;' onfocus='CambiaColor(this,'#FFCC00','#000000')' onblur='CambiaColor(this,'','#000000')' required='required' name='account2' id='account2'>" + data + "</select>");
					}
                });
            });
        });
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
		<a href="../index.html" title="Home"><img src="http://elp21.no-ip.info:4085/SGP/files/images/Portada/logo2.gif" alt="Your logo here" width="45" height="40" /> <span id="logo-text">YOMA</span></a>
		<div id="userbar">
			<a href="<?php echo base_url();?>index.php/Control_Inicio/cerrar_sesion">Cerrar Sesion </a> | <a id="tabe" href="<?php echo base_url();?>index.php/Control_Pdf">Ayuda</a>		</div>
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
	    <li>- <a href="">Venta</a></li>
		<li>- <a href="">Orden de Compra</a></li>
		<li>- <a href="">Importacion</a></li>
	</div>
	<h3><a href="#">Ver</a></h3>
	<div>
		<li>- <a href="<?php echo base_url();?>index.php/Control_Negociacion/buscar_vendedores">Negociacion</a></li>
		<li>- <a href="">Venta</a></li>
		<li>- <a href="">Orden de Compra</a></li>
		<li>- <a href="">Importacion</a></li>
	</div>
	<h3><a href="#">Herramientas</a></h3>
	<div>
		<li>- <a href="">Notificacion</a></li>
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
  <form id="form3" method="post" action="<?php echo base_url();?>index.php/Control_Producto/index3">
    <table width="440" border="0">
      <tr>
        <td width="220"><h2 style="font-size:30px"><?php $j=0; foreach ($Datos as $row){
			
							echo $row['Nombre'];
							
							$j++;}?></h2></td>
        <td width="210" align="right"><input type="image" src="<?php echo base_url();?>files/images/FlechaI.png" name="Submit" title="Atras" /></td>
      </tr>
      <tr>
        <td colspan="2"><hr align="left" style="width:435px;"></td>
        </tr>
    </table>
  </form>
  <form id="form1" method="post" action="<?php echo base_url();?>index.php/Control_Producto/modificar_equipo2">
    <table width="440" border="0">
      <tr>
        <td colspan="3" align="center"><?php if(isset($Mensaje))
		{
			echo '<font color="#00FF00" style="font-size:20px;"><b>'.$Mensaje.'</b></font>';
		}?></td>
      </tr>
      <tr>
        <td align="right"><font style="font-size:12px">Codigo</font></td>
        <td colspan="2"><input name="Codigo" type="text" id="Codigo" onkeypress="return validar(event)" style="width:200px; font-size-adjust:inherit; height:30px; font-size:15px;" maxlength="30" required="required" onfocus="CambiaColor(this,'#FFCC00','#000000')" onblur="CambiaColor(this,'','#000000')" value="<?php $j=0; foreach ($Datos as $row){
			
							echo $row['Id_Equipo'];
							
							$j++;}?>" readonly="readonly"/></td>
      </tr>
      <tr>
        <td align="right"><font style="font-size:12px">Nombre:</font></td>
        <td colspan="2"><input name="Nombre" type="text" id="Nombre" onkeypress="return validar(event)" style="width:200px; font-size-adjust:inherit; height:30px; font-size:15px;" maxlength="30" required="required" onfocus="CambiaColor(this,'#FFCC00','#000000')" onblur="CambiaColor(this,'','#000000')" value="<?php $j=0; foreach ($Datos as $row){
			
							echo $row['Nombre'];
							
							$j++;}?>"/></td>
      </tr>
      <tr>
        <td align="right"><font style="font-size:12px">Precio:</font></td>
        <td colspan="2"><input name="Precio" type="text" id="Precio" onkeypress="return soloNumeros(event)" style="width:60px; font-size-adjust:inherit; height:30px; font-size:15px;" maxlength="7" required="required" onfocus="CambiaColor(this,'#FFCC00','#000000')" onblur="CambiaColor(this,'','#000000')" value="<?php $j=0; foreach ($Datos as $row){
			
							echo $row['Precio'];
							
							$j++;}?>"/> <font style="font-size:12px">Bs.F</font></td>
      </tr>
      <tr>
        <td width="120">&nbsp;</td>
        <td width="200" align="right"><input name="Submit" type="image" src="<?php echo base_url();?>files/images/Actualizando.png" value="Actualizar Equipo" OnClick="return confirm('Usted desea cambiar la informaci&oacute;n de este equipo?');" title="Actualizar Equipo"/></td>
        <td width="106" align="right">&nbsp;</td>
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