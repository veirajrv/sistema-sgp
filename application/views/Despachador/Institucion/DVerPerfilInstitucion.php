<!-- valid xhtml 1.1, but this is just something that makes the author proud =D -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<script src="<?php echo base_url();?>files/js/jquery-1.6.2.min.js" type="text/javascript"> </script>
<script src="<?php echo base_url();?>files/js/jquery-ui-1.8.16.custom.min.js" type="text/javascript"> </script>
<script src="<?php echo base_url();?>files/js/livevalidation_standalone.js" type="text/javascript"> </script>

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
				$.post("<?php echo base_url();?>index.php/ControlCombox/Combo1", { elegido: elegido }, function(data){
				$("#combo2").html(data);
				$("#combo3").html("");
			});			
        });
   })
	// Parametros para el combo2
	$("#combo2").change(function () {
   		$("#combo2 option:selected").each(function () {
			//alert($(this).val());
				elegido=$(this).val();
				$.post("<?php echo base_url();?>index.php/ControlCombox/Combo2", { elegido: elegido }, function(data){
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
		$( "input:submit, input:reset").button();
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

<script type="text/javascript">
function validar(e) { // 1
    tecla = (document.all) ? e.keyCode : e.which; // 2
    if (tecla==8) return true; // 3
    patron =/[A-Za-z\s]/; // 4
    te = String.fromCharCode(tecla); // 5
    return patron.test(te); // 6
} 
</script>

<style type="text/css">
.LV_validation_message{
    font-weight:bold;
    margin:0 0 0 5px;
}

.LV_valid {
    color:#1fa0dc;
}
	
.LV_invalid {
    color:#CC0000;
}
    
.LV_valid_field,
input.LV_valid_field:hover, 
input.LV_valid_field:active,
textarea.LV_valid_field:hover, 
textarea.LV_valid_field:active {
    border: 1px solid #1fa0dc;
}
    
.LV_invalid_field, 
input.LV_invalid_field:hover, 
input.LV_invalid_field:active,
textarea.LV_invalid_field:hover, 
textarea.LV_invalid_field:active {
    border: 1px solid #CC0000;
}
</style>
	
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
      <div></div>
    </div>
  </div>
  <p>&nbsp;</p>
</div><!-- END lc -->
</div><!-- END left -->

<!-- BEGIN center column -->
<div id="center">
  <div id="cc">
  <form id="form2" method="post" action="<?php echo base_url();?>index.php/Control_Venta/atras_index2">
    <table width="437" border="0">
      <tr>
        <td colspan="2" align="center"><?php if(isset($Mensaje))
		{
			echo '<font color="#00FF00" style="font-size:20px;"><b>'.$Mensaje.'</b></font>';
		}?></td>
        </tr>
      <tr>
        <td><h2 style="font-size:30px"><?php echo $Nombre; ?></h2></td>
        <td align="right" valign="middle"><input name="Buttom" type="image" id="Buttom" title="Atras" src="<?php echo base_url();?>files/images/FlechaI.png"/></td>
      </tr>
      <tr>
        <td colspan="2" align="right" valign="middle"><hr align="left" style="width:435px;" /></td>
        </tr>
    </table>
  </form>
  <form id="form1" method="post" action="<?php echo base_url();?>index.php/Control_Venta/modificar_perfil_2">
      <table width="441" border="0">
        <tr>
          <td width="435">
            <table width="422" border="0">
              <tr>
                <td colspan="2" align="right"><font style="font-size:12px">RIF:</font></td>
                <td><input name="RIF" type="text" disabled="disabled" id="RIF" style="width:200px; font-size-adjust:inherit; height:30px; font-size:15px;" title="Coloque la direccion web en caso de tener una (http://www.ejemplo.com)" onfocus="CambiaColor(this,'#FFCC00','#000000')" onblur="CambiaColor(this,'','#000000')" value="<?php echo $RIF; ?>" maxlength="200" /></td>
              </tr>
              <tr>
                <td align="right"><font style="font-size:12px">Nombre:</font></td>
                <td valign="middle"><input type="checkbox" name="checkbox12" value="checkbox" onclick="document.getElementById('Nombre').disabled = !this.checked" /></td>
                <td><input name="Nombre" type="text" disabled="disabled" id="Nombre" style="width:200px; font-size-adjust:inherit; height:30px; font-size:15px;" title="Coloque la direccion web en caso de tener una (http://www.ejemplo.com)" onfocus="CambiaColor(this,'#FFCC00','#000000')" onblur="CambiaColor(this,'','#000000')" value="<?php echo $Nombre; ?>" maxlength="200" /></td>
              </tr>
              <tr>
                <td width="106" align="right"><font style="font-size:12px">Codigo Postal:</font></td>
                <td width="20" valign="middle"><input type="checkbox" name="checkbox" value="checkbox" onclick="document.getElementById('CPostal').disabled = !this.checked" /></td>
                <td width="282">
                    <input name="CPostal" type="text" disabled="disabled" id="CPostal" style="width:200px; font-size-adjust:inherit; height:30px; font-size:15px;" onfocus="CambiaColor(this,'#FFCC00','#000000')" onblur="CambiaColor(this,'','#000000')" onkeypress="return soloNumeros(event)" value="<?php echo $CodigoP; ?>" maxlength="5" required="required"/></td>
              </tr>
              <tr>
                <td align="right"><font style="font-size:12px">Direccion Web:</font></td>
                <td valign="middle"><input type="checkbox" name="checkbox2" value="checkbox" onclick="document.getElementById('Web').disabled = !this.checked" /></td>
                <td>
                    <input name="Web" type="text" disabled="disabled" id="Web" style="width:200px; font-size-adjust:inherit; height:30px; font-size:15px;" title="Coloque la direccion web en caso de tener una (http://www.ejemplo.com)" onfocus="CambiaColor(this,'#FFCC00','#000000')" onblur="CambiaColor(this,'','#000000')" value="<?php echo $Web; ?>" maxlength="200" />                </td>
              </tr>
              <tr>
                <td align="right"><font style="font-size:12px">N&deg; telefono:</font></td>
                <td valign="middle"><input type="checkbox" name="checkbox3" value="checkbox" onclick="document.getElementById('Telefono').disabled = !this.checked" /></td>
                <td>
                  <input name="Telefono" type="text" disabled="disabled" id="Telefono" style="width:200px; font-size-adjust:inherit; height:30px; font-size:15px;" title="Introduzca su numero telefonico colocando el numero de area correspondiente (0212xxxxxxx, 0241xxxxxxx)" onfocus="CambiaColor(this,'#FFCC00','#000000')" onblur="CambiaColor(this,'','#000000')" onkeypress="return soloNumeros(event)" value="<?php echo $Telefono1; ?>" maxlength="11" required="required"/><script>var f10 = new LiveValidation('Telefono');
f10.add( Validate.Length, { is: 11 } );</script>                </td>
              </tr>
              <tr>
                <td align="right"><font style="font-size:12px">N&deg; telefono 2:</font></td>
                <td valign="middle"><input type="checkbox" name="checkbox4" value="checkbox" onclick="document.getElementById('Telefono2').disabled = !this.checked" /></td>
                <td>
                  <input name="Telefono2" type="text" disabled="disabled" id="Telefono2" style="width:200px; font-size-adjust:inherit; height:30px; font-size:15px;" title="Introduzca su numero telefonico colocando el numero de area correspondiente (0212xxxxxxx, 0241xxxxxxx)" onfocus="CambiaColor(this,'#FFCC00','#000000')" onblur="CambiaColor(this,'','#000000')" onkeypress="return soloNumeros(event)" value="<?php echo $Telefono2; ?>" maxlength="11"/><script>var f10 = new LiveValidation('Telefono2');
f10.add( Validate.Length, { is: 11 } );</script>                </td>
              </tr>
              <tr>
                <td align="right"><font style="font-size:12px">N&deg; fax:</font></td>
                <td valign="middle"><input type="checkbox" name="checkbox5" value="checkbox" onclick="document.getElementById('Telefono3').disabled = !this.checked" /></td>
                <td>
                  <input name="Telefono3" type="text" disabled="disabled" id="Telefono3" style="width:200px; font-size-adjust:inherit; height:30px; font-size:15px;" title="Introduzca su numero telefonico colocando el numero de area correspondiente (0212xxxxxxx, 0241xxxxxxx)" onfocus="CambiaColor(this,'#FFCC00','#000000')" onblur="CambiaColor(this,'','#000000')" onkeypress="return soloNumeros(event)" value="<?php echo $Telefono3; ?>" maxlength="11"/><script>var f10 = new LiveValidation('Telefono3');
f10.add( Validate.Length, { is: 11 } );</script>                </td>
              </tr>
              <tr>
                <td align="right"><img src="<?php echo base_url();?>files/images/twitter.png" alt="t" width="34" height="34" /></td>
                <td valign="middle"><input type="checkbox" name="checkbox6" value="checkbox" onclick="document.getElementById('Twitter').disabled = !this.checked" /></td>
                <td>
                  <input name="Twitter" type="text" disabled="disabled" id="Twitter" style="width:200px; font-size-adjust:inherit; height:30px; font-size:15px;" title="Coloque su nombre de usuario ejemplo (@grupoyoma)" onfocus="CambiaColor(this,'#FFCC00','#000000')" onblur="CambiaColor(this,'','#000000')" value="<?php echo $Twitter; ?>" maxlength="20"/>                </td>
              </tr>
              <tr>
                <td align="right"><img src="<?php echo base_url();?>files/images/facebook.png" alt="f" width="34" height="34" /></td>
                <td valign="middle"><input type="checkbox" name="checkbox7" value="checkbox" onclick="document.getElementById('Facebook').disabled = !this.checked" /></td>
                <td>
                  <input name="Facebook" type="text" disabled="disabled" id="Facebook" style="width:200px; font-size-adjust:inherit; height:30px; font-size:15px;" onfocus="CambiaColor(this,'#FFCC00','#000000')" onblur="CambiaColor(this,'','#000000')" value="<?php echo $Facebook; ?>" maxlength="20" />               </td>
              </tr>
              <tr>
                <td align="right"><img src="<?php echo base_url();?>files/images/googleplusbadge.png" alt="g" width="34" height="34" /></td>
                <td valign="middle"><input type="checkbox" name="checkbox8" value="checkbox" onclick="document.getElementById('GoogleP').disabled = !this.checked" /></td>
                <td>
                  <input name="GoogleP" type="text" disabled="disabled" id="GoogleP" style="width:200px; font-size-adjust:inherit; height:30px; font-size:15px;" onfocus="CambiaColor(this,'#FFCC00','#000000')" onblur="CambiaColor(this,'','#000000')" value="<?php echo $GoogleP; ?>" maxlength="20"/>              </td>
              </tr>
              <tr>
                <td align="right"><font style="font-size:12px">Direccion Fiscal:</font></td>
                <td valign="middle"><input type="checkbox" name="checkbox9" value="checkbox" onclick="document.getElementById('Direccion').disabled = !this.checked" /></td>
                <td>
                  <textarea name="Direccion" id="Direccion" style="width:200px; font-size-adjust:inherit; height:50px; font-size:15px;" onfocus="CambiaColor(this,'#FFCC00','#000000')" onblur="CambiaColor(this,'','#000000')" required="required" disabled="disabled"><?php echo $Direccion1; ?></textarea>                </td>
              </tr>
              <tr>
                <td align="right"><font style="font-size:12px">Direccion Despacho:</font></td>
                <td valign="middle"><input type="checkbox" name="checkbox10" value="checkbox" onclick="document.getElementById('Direccion2').disabled = !this.checked" /></td>
                <td>
                  <textarea name="Direccion2" id="Direccion2" style="width:200px; font-size-adjust:inherit; height:50px; font-size:15px;" onfocus="CambiaColor(this,'#FFCC00','#000000')" onblur="CambiaColor(this,'','#000000')" required="required" disabled="disabled"><?php echo $Direccion2; ?></textarea>                </td>
              </tr>
              <tr>
                <td align="right"><font style="font-size:12px">Direccion Extra:</font></td>
                <td valign="middle"><input type="checkbox" name="checkbox11" value="checkbox" onclick="document.getElementById('Direccion3').disabled = !this.checked" /></td>
                <td>
                  <textarea name="Direccion3" id="Direccion3" style="width:200px; font-size-adjust:inherit; height:50px; font-size:15px;" onfocus="CambiaColor(this,'#FFCC00','#000000')" onblur="CambiaColor(this,'','#000000')" disabled="disabled"><?php echo $Direccion3; ?></textarea>               </td>
              </tr>
            </table>          </td>
        </tr>
        <tr>
          <td><hr align="left" style="width:435px;" /></td>
        </tr>
        <tr>
          <td><div align="right">
		  <input type="hidden" name="Cliente" id="Cliente" style="width:20px" value="<?php echo $id_cliente; ?>" />
            <input type="reset" name="Submit2" value="Borrar informaci&oacute;n" />
            <input type="submit" name="Submit" value="Actualizar datos" OnClick="return confirm('Usted desea actualizar los datos de esta institucion?');"/>
          </div></td>
        </tr>
      </table>
    </form>
</div><!-- END cc -->
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