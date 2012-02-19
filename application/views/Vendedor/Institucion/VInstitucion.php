<!-- valid xhtml 1.1, but this is just something that makes the author proud =D -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<script src="http://elp21.no-ip.info:4085/SGP/files/js/jquery-1.6.2.min.js" type="text/javascript"> </script>
<script src="http://elp21.no-ip.info:4085/SGP/files/js/jquery-ui-1.8.16.custom.min.js" type="text/javascript"> </script>
<script src="http://elp21.no-ip.info:4085/SGP/files/js/livevalidation_standalone.js" type="text/javascript"> </script>

<head>

<script type="text/javascript">
function CambiaColor(esto,borde,texto)
 {
    esto.style.borderColor=borde;
	esto.style.color=texto;
 }
</script>

<script type="text/javascript">
	 $(document).ready(function(){
            $("#subgroup").click(function () {
			var id = $('#subgroup').val();
			console.log(id);
                $.ajax({
                    type: "GET",
                    url: "<?php echo base_url().'index.php/control_Institucion/ajax_get_accounts/'?>" + id,
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
                    url: "<?php echo base_url().'index.php/control_Institucion/ajax_get_accounts2/'?>" + id,
					dataType: 'html',
					success: function(data)
					{
					$('#equipo').replaceWith("<select name='equipo' id='equipo' style='width:200px; font-size-adjust:inherit; height:30px; font-size:15px;' onfocus='CambiaColor(this,'#FFCC00','#000000')' onblur='CambiaColor(this,'','#000000')'>" + data + "</select>");
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
			<a href="<?php echo base_url();?>index.php/Control_Inicio/cerrar_sesion/">Cerrar Sesion </a> | <a id="tabe" href="<?php echo base_url();?>index.php/Control_Pdf">Ayuda</a>		</div>
	</div>
	<!-- END tagline -->

<!-- BEGIN tabs -->
<div id="navcontainer">
	<ul id="navlist">
		<li><a id="tabb" href="<?php echo base_url();?>index.php/Control_Inicio/v_principal" title="Inicio">Inicio</a></li>
		<li><a id="tabb" href="<?php echo base_url();?>index.php/Control_Negociacion" title="Gestionar Negociaciones">Negociaciones</a></li>
		<li><a id="tabb" href="<?php echo base_url();?>index.php/Control_Cliente" title="Crear Clientes">Clientes</a></li>
		<li><a id="taba" class="active" href="<?php echo base_url();?>index.php/Control_Institucion" title="Visualizar Reportes">Instituci&oacute;n</a></li>
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
  <form id="form2" method="post" action="<?php echo base_url();?>index.php/Control_Institucion/atras_index">
    <table width="441" border="0">
      <tr>
        <td colspan="2" align="center"><?php if(isset($Mensaje))
		{
			echo '<font color="#00FF00" style="font-size:20px;"><b>'.$Mensaje.'</b></font>';
		}?></td>
        </tr>
      <tr>
        <td width="381"><h2 style="font-size:30px">Nueva Instituci&oacute;n</h2></td>
        <td width="50" align="right" valign="middle"><input name="Buttom" type="image" id="Buttom" title="Atras" src="<?php echo base_url();?>files/images/FlechaI.png"/></td>
      </tr>
      <tr>
        <td colspan="2"><hr align="left" style="width:435px;" /></td>
        </tr>
    </table>
  </form>
  <form id="form1" method="post" action="<?php echo base_url();?>index.php/Control_Institucion/crear_institucion">
      <table width="200" border="0">
        <tr>
          <td><fieldset><legend style="font-size:15px"><b>Datos Instituci&oacute;n</b></legend>
            <table width="410" border="0">
              <tr>
                <td width="140" align="right"><font style="font-size:12px">Tipo de institucion:</font></td>
                <td width="260">
                    <select name="select" size="1" style="width:200px; font-size-adjust:inherit; height:30px; font-size:15px;" onfocus="CambiaColor(this,'#FFCC00','#000000')" onblur="CambiaColor(this,'','#000000')">
                      <option>- Selecciona -</option>
                      <option>Privado</option>
                      <option>Publico</option>
                    </select>
                </td>
              </tr>
              <tr>
                <td align="right"><font style="font-size:12px">Nombre:</font></td>
                <td>
                    <input name="Nombre" type="text" id="Nombre" style="width:200px; font-size-adjust:inherit; height:30px; font-size:15px;" onfocus="CambiaColor(this,'#FFCC00','#000000')" onblur="CambiaColor(this,'','#000000')" maxlength="150" required="required"/>
                </td>
              </tr>
              <tr>
                <td align="right"><font style="font-size:12px">Pais:</font></td>
                <td><select name="subgroup" id="subgroup" style="width:200px; font-size-adjust:inherit; height:30px; font-size:15px;" onfocus="CambiaColor(this,'#FFCC00','#000000')" onblur="CambiaColor(this,'','#000000')">
                  <option value="-1">- Selecciona -</option>
                  <?php
						foreach ($Pais as $row) {
				  ?>
                  <option value="<?php echo $row['Nombre']; ?>" <?php echo set_select('Hola',$row['Nombre']); ?> ><?php echo $row['Nombre']; ?></option>
                  <?php
					}
					?>
                  </select></td>
              </tr>
              <tr>
                <td align="right"><font style="font-size:12px">Estado:</font></td>
                <td><select name="account" id="account" style="width:200px; font-size-adjust:inherit; height:30px; font-size:15px;" onfocus="CambiaColor(this,'#FFCC00','#000000')" onblur="CambiaColor(this,'','#000000')">
                  <option value=" " <?php echo set_select('account',' ', TRUE); ?> >- Selecciona -</option>
                </select></td>
              </tr>
              <tr>
                <td align="right"><font style="font-size:12px">Ciudad:</font></td>
                <td><select name="equipo" id="equipo" style="width:200px; font-size-adjust:inherit; height:30px; font-size:15px;" onfocus="CambiaColor(this,'#FFCC00','#000000')" onblur="CambiaColor(this,'','#000000')">
                  <option value=" " <?php echo set_select('equipo',' ', TRUE); ?> >- Selecciona -</option>
                </select></td>
              </tr>
              <tr>
                <td align="right"><font style="font-size:12px">Codigo Postal:</font></td>
                <td>
                    <input name="CPostal" type="text" id="CPostal" style="width:200px; font-size-adjust:inherit; height:30px; font-size:15px;" onfocus="CambiaColor(this,'#FFCC00','#000000')" onblur="CambiaColor(this,'','#000000')" onkeypress="return soloNumeros(event)" maxlength="5" required="required"/>
                </td>
              </tr>
              <tr>
                <td align="right"><font style="font-size:12px">R.I.F:</font></td>
                <td>
                    <select name="Letra" size="1" id="Letra" style="font-size-adjust:inherit; height:30px; font-size:15px;" onfocus="CambiaColor(this,'#FFCC00','#000000')" onblur="CambiaColor(this,'','#000000')">
                      <option selected="selected">J</option>
                      <option>G</option>
                    </select> - <input name="Rif" type="text" id="Rif" style="width:150px; font-size-adjust:inherit; height:30px; font-size:15px;" onfocus="CambiaColor(this,'#FFCC00','#000000')" onblur="CambiaColor(this,'','#000000')" onkeypress="return soloNumeros(event)" maxlength="10" required="required"/>
                </td>
              </tr>
              <tr>
                <td align="right"><font style="font-size:12px">Direccion Web <b><font color="#FF0000">(Opcional)</font></b>:</font></td>
                <td>
                    <input name="Web" type="text" id="Web" style="width:200px; font-size-adjust:inherit; height:30px; font-size:15px;" onfocus="CambiaColor(this,'#FFCC00','#000000')" onblur="CambiaColor(this,'','#000000')" maxlength="200" title="Coloque la direccion web en caso de tener una (http://www.ejemplo.com)" />
                </td>
              </tr>
              <tr>
                <td align="right"><font style="font-size:12px">N&deg; telefono:</font></td>
                <td>
                  <input name="Telefono" type="text" id="Telefono" style="width:200px; font-size-adjust:inherit; height:30px; font-size:15px;" onfocus="CambiaColor(this,'#FFCC00','#000000')" onblur="CambiaColor(this,'','#000000')" onkeypress="return soloNumeros(event)" maxlength="11" required="required" title="Introduzca su numero telefonico colocando el numero de area correspondiente (0212xxxxxxx, 0241xxxxxxx)"/><script>var f10 = new LiveValidation('Telefono');
f10.add( Validate.Length, { is: 11 } );</script>
                </td>
              </tr>
              <tr>
                <td align="right"><font style="font-size:12px">N&deg; telefono 2 <b><font color="#FF0000">(Opcional)</font></b>:</font></td>
                <td>
                  <input name="Telefono2" type="text" id="Telefono2" style="width:200px; font-size-adjust:inherit; height:30px; font-size:15px;" onfocus="CambiaColor(this,'#FFCC00','#000000')" onblur="CambiaColor(this,'','#000000')" onkeypress="return soloNumeros(event)" maxlength="11" title="Introduzca su numero telefonico colocando el numero de area correspondiente (0212xxxxxxx, 0241xxxxxxx)"/><script>var f10 = new LiveValidation('Telefono2');
f10.add( Validate.Length, { is: 11 } );</script>
                </td>
              </tr>
              <tr>
                <td align="right"><font style="font-size:12px">N&deg; fax <b><font color="#FF0000">(Opcional)</font></b>:</font></td>
                <td>
                  <input name="Telefono3" type="text" id="Telefono3" style="width:200px; font-size-adjust:inherit; height:30px; font-size:15px;" onfocus="CambiaColor(this,'#FFCC00','#000000')" onblur="CambiaColor(this,'','#000000')" onkeypress="return soloNumeros(event)" maxlength="11" title="Introduzca su numero telefonico colocando el numero de area correspondiente (0212xxxxxxx, 0241xxxxxxx)"/><script>var f10 = new LiveValidation('Telefono3');
f10.add( Validate.Length, { is: 11 } );</script>
                </td>
              </tr>
            </table>
          </fieldset></td>
        </tr>
        <tr>
          <td><fieldset><legend style="font-size:15px"><b>Redes Sociales <font color="#FF0000">(Opcional)</font></b></legend>
              <table width="410" border="0">
                <tr>
                  <td width="140" align="right"><img src="<?php echo base_url();?>files/images/twitter.png" alt="t" width="34" height="34" /></td>
                  <td width="260">
                    
                      <input name="Twitter" type="text" id="Twitter" style="width:200px; font-size-adjust:inherit; height:30px; font-size:15px;" onfocus="CambiaColor(this,'#FFCC00','#000000')" onblur="CambiaColor(this,'','#000000')" maxlength="20" title="Coloque su nombre de usuario ejemplo (@grupoyoma)"/>
                   </td>
                </tr>
                <tr>
                  <td align="right"><img src="<?php echo base_url();?>files/images/facebook.png" alt="f" width="34" height="34" /></td>
                  <td>
                    <input name="Facebook" type="text" id="Facebook" style="width:200px; font-size-adjust:inherit; height:30px; font-size:15px;" onfocus="CambiaColor(this,'#FFCC00','#000000')" onblur="CambiaColor(this,'','#000000')" maxlength="20" />
                  </td>
                </tr>
                <tr>
                  <td align="right"><img src="<?php echo base_url();?>files/images/googleplusbadge.png" alt="g" width="34" height="34" /></td>
                  <td>
                    <input name="GoogleP" type="text" id="GoogleP" style="width:200px; font-size-adjust:inherit; height:30px; font-size:15px;" onfocus="CambiaColor(this,'#FFCC00','#000000')" onblur="CambiaColor(this,'','#000000')" maxlength="20"/>
                  </td>
                </tr>
              </table>
              </fieldset></td>
        </tr>
        <tr>
          <td><fieldset><legend style="font-size:15px"><b>Direcciones</b></legend>
            <table width="410" border="0">
              <tr>
                <td width="140" align="right"><font style="font-size:12px">Direccion Fiscal:</font></td>
                <td width="260">
                    <textarea name="Direccion" id="Direccion" style="width:200px; font-size-adjust:inherit; height:50px; font-size:15px;" onfocus="CambiaColor(this,'#FFCC00','#000000')" onblur="CambiaColor(this,'','#000000')" required="required"></textarea>
                </td>
              </tr>
              <tr>
                <td align="right"><font style="font-size:12px">Direccion Despacho:</font></td>
                <td>
                    <textarea name="Direccion2" id="Direccion2" style="width:200px; font-size-adjust:inherit; height:50px; font-size:15px;" onfocus="CambiaColor(this,'#FFCC00','#000000')" onblur="CambiaColor(this,'','#000000')" required="required"></textarea>
                </td>
              </tr>
              <tr>
                <td align="right"><font style="font-size:12px">Direccion Extra <b><font color="#FF0000">(Opcional)</font></b>:</font></td>
                <td>
                    <textarea name="Direccion3" id="Direccion3" style="width:200px; font-size-adjust:inherit; height:50px; font-size:15px;" onfocus="CambiaColor(this,'#FFCC00','#000000')" onblur="CambiaColor(this,'','#000000')"></textarea>
               </td>
              </tr>
            </table>
          </fieldset></td>
        </tr>
        <tr>
          <td><div align="right">
            <input type="reset" name="Submit2" value="Borrar informaci&oacute;n" />
            <input type="submit" name="Submit" value="Agregar instituci&oacute;n" OnClick="return confirm('Usted desea agregar esta nueva institucion al sistema?');"/>
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

</html>
