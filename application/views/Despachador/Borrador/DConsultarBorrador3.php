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
			
			$("#equipo").live("click", function () {
			var id = $('#equipo').val();
			console.log(id);
                $.ajax({
                    type: "GET",
                    url: "<?php echo base_url().'index.php/Control_Combox/ajax_get_accounts3/'?>" + id,
					dataType: 'html',
					success: function(data)
					{
					$('#Accesorio').replaceWith("<select name='Accesorio' id='Accesorio' style='width:200px; font-size-adjust:inherit; height:30px; font-size:15px;' onfocus='CambiaColor(this,'#FFCC00','#000000')' onblur='CambiaColor(this,'','#000000')'>" + data + "</select>");
					}
                });
            });
        });
</script>
	
<script>
			$(function() {
				$( "#FechaODC, #FechaPago, #FechaP" ).datepicker({
					changeMonth: true,
					changeYear: true,
					yearRange: "-0:+0"
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
			<a href="<?php echo base_url();?>index.php/Control_Inicio/cerrar_sesion/">Cerrar Sesion </a> | <a id="tabe" href="">Ayuda</a>		</div>
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
</div>
<!-- END navcontainer -->

<div id="tabbar"></div>
<!-- END header -->

<!-- BEGIN search -->
<div id="search">

	
	
  </div>
<!-- END search -->

<!-- BEGIN container -->
<div id="container">
<!-- BEGIN left column -->
<div id="container2">
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
  </div>
  <!-- END lc -->
</div>
<!-- END left -->

<!-- BEGIN center column -->
<div id="center">
  <div id="cc">
    <form id="form1" method="post" action="">
      <table width="441" border="0">
        <tr>
          <td valign="top"><h2 style="font-size:30px">Codigo Negociaci&oacute;n (<?php echo $Id_Negociacion; ?>)</h2></td>
          </tr>
        <tr>
          <td valign="top"><h4 style="color:#0066FF">PASO II</h4></td>
        </tr>
        <tr>
          <td><hr align="left" style="width:435px;" /></td>
        </tr>
        <tr>
          <td align="center"><font style="font-size:15px; height:8px"><?php if ($Status == 'Borrador') { echo "<b><font color='#FF9900'>$Status $Porcentaje %</font></b>";} if ($Status == 'Activa') { echo "<b><font color='#6600FF'>$Status $Porcentaje %</font></b>";} if ($Status == 'Ganada') { echo "<b><font color='#00CC00'>$Status $Porcentaje %</font></b>";} if ($Status == 'Perdida') { echo "<b><font color='#FF0000'>$Status $Porcentaje %</font></b>";} if ($Status == 'Cerrada') { echo "<b><font color='#0033FF'>$Status $Porcentaje %</font></b>";}?></font></td>
        </tr>
        <tr>
          <td><hr align="left" style="width:435px;" /></td>
        </tr>
      </table>
    </form>
    <form id="form3" method="post" action="<?php echo base_url();?>index.php/Control_Venta/agregar_accesorio_telemetria/<?php echo $Id_Negociacion?>/<?php echo $Status; ?>/<?php echo $Id; ?>">
      <table width="440" border="0">
        <tr>
          <td width="434"><fieldset><legend style="font-size:15px"><b>Accesorio de un equipo</b></legend>
            <table width="430" border="0">
  <tr>
    <td width="424"><table><?php foreach($Lista2 as $row)
						{?>
							<tr>
							  <td><input type="checkbox" name="checkbox[]" id="checkbox" value="<?php echo $row['Id_Accesorio'];?>" onclick="document.getElementById('<?php echo $row['Id_Accesorio'];?>').disabled = !this.checked"/></td>
							<td><?php echo $row['Codigo'];?></td>
							<td><?php echo $row['Nombre'];?></td>
							<td><?php echo $row['Descripcion'];?></td>
                            <td><input type="text" name="<?php echo $row['Id_Accesorio'];?>" id="<?php echo $row['Id_Accesorio'];?>" style="width:40px;" onkeypress="return soloNumeros(event)" maxlength="5" disabled="disabled" required="required"/></td>
                            </tr><?php 
						}?></table>
      </td>
  </tr>
  <tr>
    <td><input type="submit" name="button" id="button" value="Agregar" /></td>
  </tr>
            </table>

          </fieldset></td>
        </tr>
      </table>
    </form>
    <table width="437" border="0">
      <tr>
        <td width="254" valign="top"><form id="form3" method="post" action="<?php echo base_url();?>index.php/Control_Venta/atras_paso_extrai" style="width:200px">
          
            <input name="Submit" type="image" id="Submit" src="<?php echo base_url();?>files/images/FlechaI.png" title="Paso Anterior"/>
            <input type="hidden" name="Negociacion" id="Negociacion" style="width:20px" value="<?php echo $Id_Negociacion; ?>" />
            <input type="hidden" name="idcliente" id="idcliente" style="width:20px" value="<?php echo $Id; ?>" />
            <input type="hidden" name="Status" id="Status" style="width:20px" value="<?php echo $Status; ?>" />
           
        </form></td>
        <td width="173" align="right" valign="top"><form id="form2" method="post" action="<?php echo base_url();?>index.php/Control_Inicio/d_principal">
          <span style="width:200px">
          <input type="hidden" name="Negociacion2" id="Negociacion2" style="width:20px" value="<?php echo $Id_Negociacion; ?>" />
          <input type="hidden" name="idcliente2" id="idcliente2" style="width:20px" value="<?php echo $Id; ?>" />
          <input type="hidden" name="Status2" id="Status2" style="width:20px" value="<?php echo $Status; ?>" />
          </span>
          <input type="submit" name="Submit2" value="Finalizar" onclick="return confirm('Al finalizar esta negociaci&oacute;n la misma sera enviada a la lista de negociaciones por aprobar');"/>
        </form></td>
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