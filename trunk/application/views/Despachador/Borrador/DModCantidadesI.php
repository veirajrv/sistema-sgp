<!-- valid xhtml 1.1, but this is just something that makes the author proud =D -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<script src="<?php echo base_url();?>files/js/jquery-1.6.2.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>files/js/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>

<head>

<script language="JavaScript" type="text/javascript">
<!--
function PopWindow()
{
window.open('<?php echo base_url();?>index.php/Control_Negociacion/aprobar_orden/<?php echo $Id_Negociacion; ?>','Aprobar','width=450,height=500,menubar=no,scrollbars=yes,toolbar=no,location=no,directories=no,resizable=no,top=50,left=50');
}
//-->
</script>

<script language="JavaScript" type="text/javascript">
<!--
function PopWindow2()
{ <?php $j=0; foreach ($Lista as $row){?>
window.open("<?php echo base_url();?>index.php/Control_Negociacion/modificar_cantidad/<?php echo $row['Nombre']?>/<?php echo $Id_Negociacion?>",'Aprobar','width=230,height=130,menubar=no,scrollbars=yes,toolbar=no,location=no,directories=no,resizable=no,top=50,left=50');<?php 
$j++;}?>
}
//-->
</script>

<script type="text/javascript">
	 $(document).ready(function(){
            $("#subgroup").click(function () {
			var id = $('#subgroup').val();
			console.log(id);
                $.ajax({
                    type: "GET",
                    url: "<?php echo base_url().'index.php/Control_Combox/ajax_get_accounts/'?>" + id,
					dataType: 'html',
					success: function(data)
					{
					$('#account').replaceWith("<select name='account' id='account' style='width:200px; font-size-adjust:inherit; height:30px; font-size:15px;' onfocus='CambiaColor(this,'#FFCC00','#000000')' onblur='CambiaColor(this,'','#000000')'>" + data + "</select>");
					}
                });
            });
			
			$("#account").live("click", function () {
			var id = $('#account').val();
			console.log(id);
                $.ajax({
                    type: "GET",
                    url: "<?php echo base_url().'index.php/Control_Combox/ajax_get_accounts2/'?>" + id,
					dataType: 'html',
					success: function(data)
					{
					$('#equipo').replaceWith("<select name='equipo' id='equipo' style='width:200px; font-size-adjust:inherit; height:30px; font-size:15px;' onfocus='CambiaColor(this,'#FFCC00','#000000')' onblur='CambiaColor(this,'','#000000')'>" + data + "</select>");
					}
                });
            });
        });
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
		$( "input:submit").button();
		$( "a", ".demoo" ).click(function() { return false; });
	});
</script>
	
<script>
			$(function() {
				$( "#FechaODC, #FechaPago, #FechaP" ).datepicker({
					changeMonth: true,
					changeYear: true,
					yearRange: "-1:+1"
				});		
				
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
		<a href="../index.html" title="Home"><img src="<?php echo base_url();?>files/images/Portada/logo2.gif" alt="Your logo here" width="45" height="40" /> <span id="logo-text">YOMA
		</span></a>
		<div id="userbar">
			<a href="<?php echo base_url();?>index.php/Control_Inicio/cerrar_sesion/">Cerrar Sesion </a> | <a id="tabe" href="<?php echo base_url();?>index.php/Control_Pdf">Ayuda</a>		</div>
  </div>
	<!-- END tagline -->

<!-- BEGIN tabs -->
<div id="navcontainer">
	<ul id="navlist">
		<li><a id="taba" class="active" href="<?php echo base_url();?>index.php/Control_Inicio/d_principal" title="Inicio">Inicio</a></li>
		<li><a id="tabb" href="<?php echo base_url();?>index.php/Control_Venta/consultar_negociaciones" title="Gestionar Ventas">Ventas</a></li>
		<li><a id="tabb" href="<?php echo base_url();?>index.php/Control_Venta/ver_negociacion" title="Gestionar Negociaciones">Negociaciones</a></li>
		<li><a id="tabb" href="<?php echo base_url();?>index.php/Control_Venta/clientes" title="Gestionar Clientes">Clientes</a></li>
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
		<li>- <a href="<?php echo base_url();?>index.php/Control_Venta/ver_negociacion">Negociaciones</a></li>
		<li>- <a href="<?php echo base_url();?>index.php/Control_Venta/consultar_negociaciones">Venta</a></li>
	</div>
	<h3><a href="#">Herramientas</a></h3>
	<div>
		<li>- <a href="">Calendario</a></li>
	</div>
    
	</div>
</div>

</div>
	<p>&nbsp;</p>
</div><!-- END lc -->
</div><!-- END left -->

<!-- BEGIN center column -->
<div id="center">
  <div id="cc">
      <table width="438" border="0">
        <tr></tr>
        <tr>
          <td width="364" valign="top"><h2 style="font-size:30px">Codigo Negociaci&oacute;n (<?php echo $Id_Negociacion; ?>)</h2>            </td>
          <td width="34" align="right" valign="top">&nbsp;</td>
          <td width="29" align="right" valign="top">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="3"><hr align="left" style="width:435px;" /></td>
        </tr>
        <tr>
          <td colspan="3" align="center"><font style="font-size:15px; height:8px"><?php if ($Status == 'Borrador') { echo "<b><font color='#FF9900'>$Status $Porcentaje %</font></b>";} if ($Status == 'Activa') { echo "<b><font color='#51335C'>$Status $Porcentaje %</font></b>";} if ($Status == 'Ganada') { echo "<b><font color='#00CC00'>$Status $Porcentaje %</font></b>";} if ($Status == 'Perdida') { echo "<b><font color='#FF0000'>$Status $Porcentaje %</font></b>";} if ($Status == 'Cerrada') { echo "<b><font color='#0033FF'>$Status $Porcentaje %</font></b>";}?></font></td>
        </tr>
        <tr>
          <td colspan="3"><hr align="left" style="width:435px;" /></td>
        </tr>
        <tr>
          <td colspan="3"></td>
          </tr>
      </table>
    <form id="form2" method="post" action="<?php echo base_url();?>index.php/Control_Negociacion/dmodificar_cantidad2I">
      <table width="441" border="0">
        <tr>
          <td width="427"><fieldset>
            <legend style="font-size:15px"><b>Modificar Cantidad</b></legend>
            <table width="410" border="0">
              <tr>
                <td width="120" align="right"><font style="font-size:12px">Codigo:</font></td>
                <td colspan="2"><input name="Codigo" type="text" id="Codigo" style="width:200px; font-size-adjust:inherit; height:30px; font-size:15px;" onfocus="CambiaColor(this,'#FFCC00','#000000')" onblur="CambiaColor(this,'','#000000')" value="<?php echo $Codigo; ?>" maxlength="5" readonly="readonly"/></td>
              </tr>
              <tr>
                <td align="right"><font style="font-size:12px">Nombre:</font></td>
                <td colspan="2"><input name="Nombre" type="text" id="Nombre" style="width:200px; font-size-adjust:inherit; height:30px; font-size:15px;" onfocus="CambiaColor(this,'#FFCC00','#000000')" onblur="CambiaColor(this,'','#000000')" value="<?php echo $Nombre; ?>" maxlength="5" readonly="readonly"/></td>
              </tr>
              <tr>
                <td align="right"><font style="font-size:12px">Cantidad:</font></td>
                <td colspan="2">
                  <input name="Cantidad" type="text" id="Cantidad" style="width:50px; font-size-adjust:inherit; height:30px; font-size:15px;" onfocus="CambiaColor(this,'#FFCC00','#000000')" onblur="CambiaColor(this,'','#000000')" value="<?php echo $Cantidad; ?>" maxlength="5" required="required"/></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td width="245">
                  <input name="Submit2" type="submit" value="Cambiar cantidad" OnClick="return confirm('Usted desea modificar la cantidad de este producto?');"/>
                  <input type="hidden" name="Negociacion" id="Negociacion" style="width:20px" value="<?php echo $Id_Negociacion; ?>" />
                  <input type="hidden" name="Historial" id="Historial" style="width:20px" value="<?php echo $Historial; ?>" />
                  <input type="hidden" name="idcliente" id="idcliente" style="width:20px" value="<?php echo $Id; ?>" />
                  <input type="hidden" name="Sta" id="Sta" style="width:20px" value="<?php echo $Status; ?>" />
                  <input type="hidden" name="Porcen" id="Porcen" style="width:20px" value="<?php echo $Porcentaje; ?>" /></td>
                <td width="31">&nbsp;</td>
              </tr>
              <tr></tr>
            </table>
            </fieldset></td>
        </tr>
      </table>
      </form>
    <form id="form3" method="post" action="<?php echo base_url();?>index.php/Control_Venta/atras_vista_previai2">
      <table width="440" border="0">
        <tr>
          <td width="434" align="left" valign="top">
              <input type="image" name="Submit" src="<?php echo base_url();?>files/images/FlechaI.png" title="Paso Anterior" />
              <input type="hidden" name="Status" id="Status" style="width:20px" value="<?php echo $Status; ?>" />
              <input type="hidden" name="idcliente" id="idcliente" style="width:20px" value="<?php echo $Id; ?>" />
              <input type="hidden" name="Negociacion" id="Negociacion" style="width:20px" value="<?php echo $Id_Negociacion; ?>" /></td>
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