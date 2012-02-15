<!-- valid xhtml 1.1, but this is just something that makes the author proud =D -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<script src="http://elp21.no-ip.info:4085/SGP/files/js/jquery-1.6.2.min.js" type="text/javascript"></script>
<script src="http://elp21.no-ip.info:4085/SGP/files/js/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>

<head>

<script> 
function sumar() { 
var n1 = parseInt(document.MyForm.numero2.value); 
var n2 = (n1/100) * (<?php foreach ($Total as $row){echo $row['Total'];}?>);
var n3 = <?php foreach ($Total as $row){echo $row['Total'];}?>;
document.MyForm.resultado2.value = n3 - n2; 
} 
</script> 

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
		$( "input:submit, input:button, input:reset").button();
		$( "a", ".demoo" ).click(function() { return false; });
	});
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
			<a href="<?php echo base_url();?>index.php/Control_Inicio/cerrar_sesion">Cerrar Sesion </a> | <a id="tabe" href="">Ayuda</a>		</div>
  </div>
	<!-- END tagline -->

<!-- BEGIN tabs -->
<div id="navcontainer">
	<ul id="navlist">
		<li><a id="taba" class="active" href="<?php echo base_url();?>index.php/Control_Inicio/d_principal" title="Inicio">Inicio</a></li>
		<li><a id="tabb" href="<?php echo base_url();?>index.php/Control_Venta/consultar_negociaciones" title="Gestionar Ventas">Ventas</a></li>
		<li></li>
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
		
	</div>
</div>

</div>
	<p>&nbsp;</p>
</div><!-- END lc -->
</div><!-- END left -->

<!-- BEGIN center column -->
<div id="center">
  <div id="cc">
    <form id="form1" method="post" action="<?php echo base_url();?>index.php/Control_Venta/mandar_orden_compra/<?php echo $Id_Negociacion; ?>">
      <table width="441" border="0">
        <tr>
          <td width="406"><h2 style="font-size:30px">Codigo Negociaci&oacute;n (<?php echo $Id_Negociacion; ?>)</h2></td>
          <td width="25" align="right" valign="middle"><input type="image" src="<?php echo base_url();?>files/images/cancel.png" name="Submit2" style="width:25px;" title="Generar Pedido" /></td>
          </tr>
        <tr>
          <td colspan="2"><hr align="left" style="width:435px;" /></td>
        </tr>
      </table>
    </form>
      <table width="441" border="0">
        <tr>
          <td><fieldset>
            <legend style="font-size:15px"><b>Vista previa</b></legend>
              <form name="MyForm" method="post" action="">
                <table width="410" border="0">
                  <tr>
                    <td width="270" rowspan="2"><img src="<?php echo base_url();?>files/images/Logo_Formato.png" alt="" width="147" height="69" /></td>
                    <td width="130"><div align="right"><strong>R.I.F.</strong> J-00190554-5</div></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td colspan="2"><hr align="left" style="width:400px;" /></td>
                  </tr>
                </table>
              </form>
              <table width="410" border="0">
                <tr>
                  <td><b>Nombre</b></td>
                  <td><b>Cantidad</b></td>
                  <td width="227"><b>Descripci&oacute;n</b></td>
                </tr>
                <tr>
                  <td width="105"><?php $j=0; foreach ($Lista as $row){ echo $row['Nombre']; echo "<br />"; $j++;}?> <?php $j=0; foreach ($Lista2 as $row){ echo $row['Nombre']; echo "<br />"; $j++;}?></td>
                  <td width="60"><?php $j=0; foreach ($Lista as $row){ echo $row['Cantidad']; echo "<br />"; $j++;}?>
                  <?php $j=0; foreach ($Lista2 as $row){ echo $row['Cantidad']; echo "<br />"; $j++;}?></td>
                  <td><?php $j=0; foreach ($Lista as $row){ echo $row['Descripcion']; echo "<br />"; $j++;}?>
                  <?php $j=0; foreach ($Lista2 as $row){ echo $row['Descripcion']; echo "<br />"; $j++;}?></td>
                </tr>
                <tr>
                  <td colspan="3" align="right"><form id="form2" method="post" action="<?php echo base_url();?>index.php/Control_Venta/mandar_facturar/<?php echo $Id_Negociacion; ?>">
                    <input type="image" src="<?php echo base_url();?>files/images/aprobar.png" title="Aprobar Negociación" onclick="return confirm('Usted desea mandar a facturar esta negociaci&oacute;n?');" />
                  </form></td>
                  </tr>
              </table>
          </fieldset></td>
        </tr>
        <tr>
          <td valign="top"><form id="form3" method="post" action="<?php echo base_url();?>index.php/Control_Inicio/d_principal">
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