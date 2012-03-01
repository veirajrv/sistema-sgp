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
		<li><a id="tabb" href="<?php echo base_url();?>index.php/Control_Inicio/v_principal" title="Inicio">Inicio</a></li>
		<li><a id="taba" class="active" href="<?php echo base_url();?>index.php/Control_Negociacion/ver_negociacion" title="Gestionar Negociaciones">Negociaciones</a></li>
		<li><a id="tabb" href="<?php echo base_url();?>index.php/Control_Cliente" title="Gestionar Clientes">Clientes</a></li>
		<li><a id="tabd" href="<?php echo base_url();?>index.php/Control_Institucion" title="Gestionar Instituciones">Instituci&oacute;n</a></li>
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
    <form id="form3" method="post" action="<?php echo base_url();?>index.php/Control_Negociacion/agregar_otro_accesorios2/<?php echo $Id_Negociacion?>/<?php echo $Status; ?>/<?php echo $idcliente; ?>">
      <table width="440" border="0">
        <tr>
          <td width="434"><fieldset><legend style="font-size:15px"><b>Accesorio de un equipo</b></legend>
            <table width="410" border="0">
  <tr>
    <td width="120" align="right"><font style="font-size:12px">Marca:</font></td>
    <td colspan="2"><select name="subgroup" id="subgroup" style="width:200px; font-size-adjust:inherit; height:30px; font-size:15px;" onfocus="CambiaColor(this,'#FFCC00','#000000')" onblur="CambiaColor(this,'','#000000')">
      <option value="-1">Seleccione una marca</option>
      <?php
						foreach ($Marca as $row) {
				  ?>
      <option value="<?php echo $row['Id_Marca']; ?>" <?php echo set_select('Hola',$row['Id_Marca']); ?> ><?php echo $row['Nombre']; ?></option>
      <?php
					}
					?>
    </select></td>
  </tr>
  <tr>
    <td align="right"><font style="font-size:12px">Linea de producto:</font></td>
    <td colspan="2"><select name="account" id="account" style="width:200px; font-size-adjust:inherit; height:30px; font-size:15px;" onfocus="CambiaColor(this,'#FFCC00','#000000')" onblur="CambiaColor(this,'','#000000')">
      <option value=" " <?php echo set_select('account',' ', TRUE); ?> >Seleccione una linea</option>
    </select></td>
  </tr>
  <tr>
    <td align="right"><font style="font-size:12px">Equipo:</font></td>
    <td colspan="2"><select name="equipo" id="equipo" style="width:200px; font-size-adjust:inherit; height:30px; font-size:15px;" onfocus="CambiaColor(this,'#FFCC00','#000000')" onblur="CambiaColor(this,'','#000000')">
      <option value=" " <?php echo set_select('equipo',' ', TRUE); ?> >Seleccione un equipo</option>
    </select></td>
  </tr>
  <tr>
    <td align="right"><font style="font-size:12px">Accesorio:</font></td>
    <td width="200"><select name="Accesorio" id="Accesorio" style="width:200px; font-size-adjust:inherit; height:30px; font-size:15px;" onfocus="CambiaColor(this,'#FFCC00','#000000')" onblur="CambiaColor(this,'','#000000')">
      <option value=" " <?php echo set_select('Accesorio',' ', TRUE); ?> >Seleccione un accesorio</option>
    </select></td>
    <td width="76">&nbsp;</td>
  </tr>
  <tr>
    <td align="right"><font style="font-size:12px">Cantidad:</font></td>
    <td align="right"><input name="Cantidad" type="text" id="Cantidad" style="width:200px; font-size-adjust:inherit; height:30px; font-size:15px;" onfocus="CambiaColor(this,'#FFCC00','#000000')" onblur="CambiaColor(this,'','#000000')" required="required"/></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td align="right"><input type="submit" name="Buscar" id="Buscar" value="Agregar" OnClick="return confirm('Usted desea agregar este accesorio a la lista de compras?');"/></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3"><cite>Nota: Esta opcion es solo para agregar accesorios de un equipo en particular</cite></td>
    </tr>
</table>

          </fieldset></td>
        </tr>
      </table>
    </form>
	<table width="441" border="0">
      <tr>
        <td width="435"><fieldset><legend style="font-size:15px"><b>Accesorios</b></legend>
            <table width="410" border="0">
              <tr>
                <td>Codigo/Nombre</td>
                <td>Descripcion</td>
                <td>Cantidad</td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td width="114"><?php $j=0; foreach ($Lista as $row){
							
							echo $row['Id_Accesorio']; echo '&nbsp;'; echo $row['Nombre']; echo '</br>';
							
							$j++;}?></td>
                <td><?php $j=0; foreach ($Lista as $row){
							
							echo $row['Descripcion']; echo '</br>';
							
							$j++;}?></td>
                <td width="51"><?php $j=0; foreach ($Lista as $row){
							
							echo $row['Cantidad']; echo '</br>';
							
							$j++;}?></td>
                <td width="20"><a href="sdfsdf">
                  <?php $j=0; foreach ($Lista as $row){
							
							echo '<a href="elp21.no-ip.info:4085/SGP/index.php/Control_Negociacion/eliminar_producto/'.$row['Id_HistorialNP'].'/'.$idcliente.'/'.$Id_Negociacion.'">ELIMINAR</a>'; echo '</br>';
							
							$j++;}?>
                </a></td>
              </tr>
            </table>
            </fieldset></td>
      </tr>
    </table>
	<table width="437" border="0">
      <tr>
        <td width="314" valign="top"><form id="form3" method="post" action="<?php echo base_url();?>index.php/Control_Negociacion/atras_paso_extra" style="width:200px">
          
            <input name="Submit" type="image" id="Submit" src="<?php echo base_url();?>files/images/FlechaI.png" title="Paso Anterior"/>
            <input type="hidden" name="Negociacion2" id="Negociacion2" style="width:20px" value="<?php echo $Id_Negociacion; ?>" />
            <input type="hidden" name="idcliente" id="idcliente" style="width:20px" value="<?php echo $idcliente; ?>" />
            <input type="hidden" name="Status2" id="Status2" style="width:20px" value="<?php echo $Status; ?>" />
           
        </form></td>
        <td width="113" align="right" valign="top"><form id="form2" method="post" action="<?php echo base_url();?>index.php/Control_Negociacion/fin_negociacion">
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
