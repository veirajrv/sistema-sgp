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

<script language="javascript">
$(document).ready(function(){
	// Parametros para e combo1
   $("#combo1").change(function () {
   		$("#combo1 option:selected").each(function () {
			//alert($(this).val());
				elegido=$(this).val();
				$.post("<?php echo base_url();?>index.php/ControlCombox/Combo3", { elegido: elegido }, function(data){
				$("#combo2").html(data);
			});			
        });
   })
	// Parametros para el combo2
	$("#combo2").change(function () {
   		$("#combo2 option:selected").each(function () {
			//alert($(this).val());
				elegido=$(this).val();
				$.post("<?php echo base_url();?>index.php/ControlCombox/Combo4", { elegido: elegido }, function(data){
				$("#combo3").html(data);
			});			
        });
   })
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
      <table width="441" border="0">
        <tr>
          <td><h2 style="font-size:30px">Mis Vendedores</h2></td>
          </tr>
        <tr>
          <td><hr align="left" style="width:435px;" /></td>
        </tr>
        <tr>
          <td>
              <table width="437" border="0">
                <tr>
                  <td width="100"><b><font style="font-size:12px;" color="#FF0000">TOTALES</font></b></td>
                  <td width="48" rowspan="3" align="right"><font style="font-size:12px">Nombre:</font></td>
                  <td width="275" rowspan="3">
                    <form id="form1" method="post" action="<?php echo base_url();?>index.php/Control_Negociacion/ver_negociacion_vendedor">
					  <select class="ui-widget" name="Cliente" id="Cliente" style="width:200px; font-size-adjust:inherit; height:30px; font-size:15px;" onfocus="CambiaColor(this,'#FFCC00','#000000')" onblur="CambiaColor(this,'','#000000')" required="required">
                        <option></option>
                        <?php
						foreach ($Vendedores as $row) {
				  ?>
                        <option value="<?php echo $row['Cedula']; ?>" <?php echo set_select('Hola',$row['Cedula']); ?> ><?php echo $row['Nombre_1']; ?></option>
                        <?php
					}
					?>
                      </select>
					  <input type="submit" name="Submit2" value="Buscar" />
                    </form>
                  </td>
                </tr>
                <tr>
                  <td>Borradores <font color="#FF0000"><?php echo $NumeroBorrador; ?></font></td>
                </tr>
                <tr>
                  <td>Activas <font color="#FF0000"><?php echo $NumeroActiva; ?></font></td>
                </tr>
                <tr>
                  <td width="100">Ganadas <font color="#FF0000"><?php echo $NumeroGanada; ?></font></td>
                  <td width="48" rowspan="3" align="right"><font style="font-size:12px">Apellido:</font></td>
                  <td rowspan="3">
                      <form id="form2" method="post" action="<?php echo base_url();?>index.php/Control_Negociacion/ver_negociacion_vendedor">
                        <select class="ui-widget" name="Cliente" id="Cliente" style="width:200px; font-size-adjust:inherit; height:30px; font-size:15px;" onfocus="CambiaColor(this,'#FFCC00','#000000')" onblur="CambiaColor(this,'','#000000')" required="required">
                          <option></option>
                          <?php
						foreach ($Vendedores as $row) {
				  ?>
                          <option value="<?php echo $row['Cedula']; ?>" <?php echo set_select('Hola',$row['Cedula']); ?> ><?php echo $row['Apellido_1']; ?></option>
                          <?php
					}
					?>
                        </select>
                        <input type="submit" name="Submit22" value="Buscar" />
                      </form>
                  </td>
                </tr>
                <tr>
                  <td>Cerradas <font color="#FF0000"><?php echo $NumeroCerrada; ?></font></td>
                </tr>
                <tr>
                  <td>Perdidas <font color="#FF0000"><?php echo $NumeroPerdida; ?></font></td>
                </tr>
                <tr>
                  <td width="100">&nbsp;</td>
                  <td width="48" rowspan="3" align="right"><font style="font-size:12px">Cedula:</font></td>
                  <td rowspan="3">
                      <form id="form3" method="post" action="<?php echo base_url();?>index.php/Control_Negociacion/ver_negociacion_vendedor">
                        <select class="ui-widget" name="Cliente" id="Cliente" style="width:200px; font-size-adjust:inherit; height:30px; font-size:15px;" onfocus="CambiaColor(this,'#FFCC00','#000000')" onblur="CambiaColor(this,'','#000000')" required="required">
                          <option></option>
                          <?php
						foreach ($Vendedores as $row) {
				  ?>
                          <option value="<?php echo $row['Cedula']; ?>" <?php echo set_select('Hola',$row['Cedula']); ?> ><?php echo $row['Cedula']; ?></option>
                          <?php
					}
					?>
                        </select>
                        <input type="submit" name="Submit23" value="Buscar" />
                      </form>
                  </td>
                </tr>
                <tr>
                  <td>Alertas Estatus <font color="#FF0000"><?php echo $ConModTotal; ?></font></td>
                </tr>
                <tr>
                  <td>Alertas Borrador <font color="#FF0000"><?php echo $ConAlertaTotal; ?></font></td>
                </tr>
              </table>
            </td>
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