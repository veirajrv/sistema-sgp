<!-- valid xhtml 1.1, but this is just something that makes the author proud =D -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<script src="<?php echo base_url();?>files/js/jquery-1.6.2.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>files/js/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>

<style>
	.ui-button { margin-left: -1px; }
	.ui-button-icon-only .ui-button-text { padding: 0.35em; } 
	.ui-autocomplete-input { margin: 0; padding: 0.48em 0 0.47em 0.45em; }
</style>

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
			$(function() {
				$( "#FechaODC, #FechaPago, #FechaP" ).datepicker({
					changeMonth: true,
					changeYear: true,
					yearRange: "-0:+0"
				});		
				
			});			
</script>

<script>
	(function( $ ) {
		$.widget( "ui.combobox", {
			_create: function() {
				var self = this,
					select = this.element.hide(),
					selected = select.children( ":selected" ),
					value = selected.val() ? selected.text() : "";
				var input = this.input = $( "<input>" )
					.insertAfter( select )
					.val( value )
					.autocomplete({
						delay: 0,
						minLength: 0,
						source: function( request, response ) {
							var matcher = new RegExp( $.ui.autocomplete.escapeRegex(request.term), "i" );
							response( select.children( "option" ).map(function() {
								var text = $( this ).text();
								if ( this.value && ( !request.term || matcher.test(text) ) )
									return {
										label: text.replace(
											new RegExp(
												"(?![^&;]+;)(?!<[^<>]*)(" +
												$.ui.autocomplete.escapeRegex(request.term) +
												")(?![^<>]*>)(?![^&;]+;)", "gi"
											), "<strong>$1</strong>" ),
										value: text,
										option: this
									};
							}) );
						},
						select: function( event, ui ) {
							ui.item.option.selected = true;
							self._trigger( "selected", event, {
								item: ui.item.option
							});
						},
						change: function( event, ui ) {
							if ( !ui.item ) {
								var matcher = new RegExp( "^" + $.ui.autocomplete.escapeRegex( $(this).val() ) + "$", "i" ),
									valid = false;
								select.children( "option" ).each(function() {
									if ( $( this ).text().match( matcher ) ) {
										this.selected = valid = true;
										return false;
									}
								});
								if ( !valid ) {
									// remove invalid value, as it didn't match anything
									$( this ).val( "" );
									select.val( "" );
									input.data( "autocomplete" ).term = "";
									return false;
								}
							}
						}
					})
					.addClass( "ui-widget ui-widget-content ui-corner-left" );

				input.data( "autocomplete" )._renderItem = function( ul, item ) {
					return $( "<li></li>" )
						.data( "item.autocomplete", item )
						.append( "<a>" + item.label + "</a>" )
						.appendTo( ul );
				};

				this.button = $( "<button type='button'>&nbsp;</button>" )
					.attr( "tabIndex", -1 )
					.attr( "title", "Show All Items" )
					.insertAfter( input )
					.button({
						icons: {
							primary: "ui-icon-triangle-1-s"
						},
						text: false
					})
					.removeClass( "ui-corner-all" )
					.addClass( "ui-corner-right ui-button-icon" )
					.click(function() {
						// close if already visible
						if ( input.autocomplete( "widget" ).is( ":visible" ) ) {
							input.autocomplete( "close" );
							return;
						}

						// work around a bug (likely same cause as #5265)
						$( this ).blur();

						// pass empty string as value to search for, displaying all results
						input.autocomplete( "search", "" );
						input.focus();
					});
			},

			destroy: function() {
				this.input.remove();
				this.button.remove();
				this.element.show();
				$.Widget.prototype.destroy.call( this );
			}
		});
	})( jQuery );

	$(function() {
		$( "#Vendedor" ).combobox();
		$( "#toggle" ).click(function() {
			$( "#Vendedor" ).toggle();
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
    <form id="form1" method="post" action="<?php echo base_url();?>index.php/Control_Venta/actualizar_datos_i2/<?php echo $Id; ?>">
      <table width="441" border="0">
        <tr>
          <td colspan="3"><?php if(isset($Error))
		{
			echo '<font color="#F00" style="font-size:12px;"><b>'.$Error.'</b></font>';
		}?></td>
          </tr>
        <tr>
          <td width="366"><h2 style="font-size:30px">Codigo Negociaci&oacute;n (<?php echo $Id_Negociacion; ?>)</h2>                        </td>
          <td width="35" align="right" valign="top"><a href="<?php echo base_url();?>index.php/Control_Venta/historial_status_i2/<?php echo $Id_Negociacion; ?>/<?php echo $Id; ?>"><img src="<?php echo base_url();?>files/images/List.png" alt="e" width="25" height="25" title="Historial negociacion"/></a></td>
          <td width="26" align="right" valign="top"><a href="<?php echo base_url();?>index.php/Control_Venta/cambio_status_i3/<?php echo $Id_Negociacion; ?>/<?php echo $Id; ?>"><img src="<?php echo base_url();?>files/images/icono_filtro.png" alt="" width="25" height="25" title="Cambio de estatus" /></a></td>
        </tr>
        <tr>
          <td colspan="3"><h4 style="color:#0066FF">PASO I</h4></td>
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
          <td colspan="3"><fieldset><legend style="font-size:15px"><b>Datos Cliente</b></legend>
              <table width="410" border="0">
                <tr>
                  <td width="60" align="right"><font style="font-size:12px">Institucion:</font></td>
                  <td width="216">
                    <input name="Cliente" type="text" id="Cliente" style="width:200px; font-size-adjust:inherit; height:30px; font-size:15px;" onfocus="CambiaColor(this,'#FFCC00','#000000')" onblur="CambiaColor(this,'','#000000')" value="<?php echo $NombreI; ?>" readonly="readonly" />                    </td>
                  <td width="120" rowspan="2"><div align="center"><a href="<?php echo base_url();?>index.php/Control_Venta/vista_previa_i2/<?php echo $Id_Negociacion; ?>/<?php echo $Id; ?>"><img src="<?php echo base_url();?>files/images/698634678.png" alt="" width="42" height="42" title="Vista previa" /></a><br />
                    Vista Previa </div></td>
                </tr>
                <tr>
                  <td align="right"><font style="font-size:12px">Telefono:</font></td>
                  <td>
                    <input name="Telefono" type="text" id="Telefono" style="width:200px; font-size-adjust:inherit; height:30px; font-size:15px;" onfocus="CambiaColor(this,'#FFCC00','#000000')" onblur="CambiaColor(this,'','#000000')" value="<?php echo $TelefonoI; ?>" readonly="readonly" />
                    <input type="hidden" name="Negociacion2" id="Negociacion2" style="width:20px" value="<?php echo $Id_Negociacion; ?>" /><input type="hidden" name="idcliente3" id="idcliente3" style="width:20px" value="<?php echo $Id; ?>" />                  </td>
                  </tr>
              </table>
              </fieldset></td>
          </tr>
        <tr>
          <td colspan="3"><fieldset><legend style="font-size:15px"><b>Datos Negociacion</b></legend>
            <table width="410" border="0">
              <tr>
                <td align="right"><font style="font-size:12px">Condiciones de pago <b><font color="#FF0000">(OBLIGATORIO):</font></b></font></td>
                <td align="center"><input type="checkbox" name="checkbox6" value="checkbox" onclick="document.getElementById('CondicionesPago').disabled = !this.checked"/></td>
                <td><select name="CondicionesPago" id="CondicionesPago" style="width:200px; font-size-adjust:inherit; height:30px; font-size:15px;" onfocus="CambiaColor(this,'#FFCC00','#000000')" onblur="CambiaColor(this,'','#000000')" disabled="disabled">
                  <option value="-1"><?php echo $CondicionesPago ?></option>
                  <option>Pago Contado - Entrega Inmediata</option>
                  <option>Financiamiento Yoma</option>
                  <option>Financiamiento Yoma Stock</option>
                  <option>Pago 30-70 Bco - Entrega 180 Dias</option>
                  <option>Pago Contado - Entrega 180 Dias</option>
                </select></td>
              </tr>
              <tr>
                <td width="121" align="right"><font style="font-size:12px">Fecha presupuesto:</font></td>
                <td width="20" align="center"><input type="checkbox" name="checkbox" value="checkbox" onclick="document.getElementById('FechaP').disabled = !this.checked"/></td>
                <td width="255">
                  <input name="FechaP" type="text" id="FechaP" style="width:200px; font-size-adjust:inherit; height:30px; font-size:15px;" onfocus="CambiaColor(this,'#FFCC00','#000000')" onblur="CambiaColor(this,'','#000000')" disabled="disabled" maxlength="10" value="<?php echo $FechaP ?>"/></td>
              </tr>
              <tr>
                <td align="right"><font style="font-size:12px">N&deg; O/C Cliente:</font></td>
                <td align="center"><input type="checkbox" name="checkbox2" value="checkbox" onclick="document.getElementById('NumeroODC').disabled = !this.checked"/></td>
                <td>
                  <input name="NumeroODC" type="text" id="NumeroODC" style="width:200px; font-size-adjust:inherit; height:30px; font-size:15px;" onfocus="CambiaColor(this,'#FFCC00','#000000')" onblur="CambiaColor(this,'','#000000')" maxlength="10" value="<?php echo $NumeroODC ?>" disabled="disabled"/>                </td>
              </tr>
              <tr>
                <td align="right"><font style="font-size:12px">Fecha de O/C:</font></td>
                <td align="center"><input type="checkbox" name="checkbox3" value="checkbox" onclick="document.getElementById('FechaODC').disabled = !this.checked"/></td>
                <td>
                  <input name="FechaODC" type="text" id="FechaODC" style="width:200px; font-size-adjust:inherit; height:30px; font-size:15px;" onfocus="CambiaColor(this,'#FFCC00','#000000')" onblur="CambiaColor(this,'','#000000')" maxlength="10" value="<?php echo $FechaODC ?>" disabled="disabled"/>                </td>
              </tr>
              <tr>
                <td align="right"><font style="font-size:12px">Banco:</font></td>
                <td align="center"><input type="checkbox" name="checkbox4" value="checkbox" onclick="document.getElementById('Banco').disabled = !this.checked"/></td>
                <td>
                  <input name="Banco" type="text" id="Banco" style="width:200px; font-size-adjust:inherit; height:30px; font-size:15px;" onfocus="CambiaColor(this,'#FFCC00','#000000')" onblur="CambiaColor(this,'','#000000')" maxlength="20" disabled="disabled" value="<?php echo $Banco ?>"/>                </td>
              </tr>
              <tr>
                <td align="right"><font style="font-size:12px">Pago Inicial:</font></td>
                <td align="center"><input type="checkbox" name="checkbox5" value="checkbox" onclick="document.getElementById('PagoInicial').disabled = !this.checked"/></td>
                <td>
                  <input name="PagoInicial" type="text" id="PagoInicial" disabled="disabled" style="width:200px; font-size-adjust:inherit; height:30px; font-size:15px;" onfocus="CambiaColor(this,'#FFCC00','#000000')" onblur="CambiaColor(this,'','#000000')" maxlength="10" value="<?php echo $PagoInicial ?>"/>                </td>
              </tr>
              <tr>
                <td align="right"><font style="font-size:12px">Fecha de pago:</font></td>
                <td align="center"><input type="checkbox" name="checkbox7" value="checkbox" onclick="document.getElementById('FechaPago').disabled = !this.checked"/></td>
                <td>
                  <input name="FechaPago" type="text" id="FechaPago" disabled="disabled" style="width:200px; font-size-adjust:inherit; height:30px; font-size:15px;" onfocus="CambiaColor(this,'#FFCC00','#000000')" onblur="CambiaColor(this,'','#000000')" maxlength="10" value="<?php echo $FechaPago ?>"/>                </td>
              </tr>
              <tr>
                <td align="right"><font style="font-size:12px">N&deg; de deposito:</font></td>
                <td align="center"><input type="checkbox" name="checkbox8" value="checkbox" onclick="document.getElementById('NDeposito').disabled = !this.checked"/></td>
                <td>
                  <input name="NDeposito" type="text" id="NDeposito" disabled="disabled" style="width:200px; font-size-adjust:inherit; height:30px; font-size:15px;" onfocus="CambiaColor(this,'#FFCC00','#000000')" onblur="CambiaColor(this,'','#000000')" maxlength="20" value="<?php echo $NDeposito ?>"/>                </td>
              </tr>
            </table>
            </fieldset></td>
        </tr>
        <tr>
          <td colspan="3" align="right"><input name="Submit" type="submit" value="Actualizar Datos" onclick="return confirm('Usted desea actualizar los datos de esta negociaci&oacute;n?');"/></td>
          </tr>
      </table>
    </form>
    <form id="form2" method="post" action="<?php echo base_url();?>index.php/Control_Venta/agregar_accesorio_telemetria_I/<?php echo $Id_Negociacion?>/<?php echo $Status; ?>/<?php echo $Id; ?>">
      <table width="440" border="0">
        <tr>
          <td><fieldset>
            <legend style="font-size:15px"><b>Accesorio</b></legend>
            <table width="410" border="0">
              <tr>
                <td align="right"><font style="font-size:12px">Accesorio:</font></td>
                <td colspan="2"><select name="Vendedor" id="Vendedor" style="width:200px; font-size-adjust:inherit; height:30px; font-size:15px;" onfocus="CambiaColor(this,'#FFCC00','#000000')" onblur="CambiaColor(this,'','#000000')" required="required">
                  <option></option>
                  <?php
						foreach ($Lista2 as $row) {
				  ?>
                  <option value="<?php echo $row['Id_Accesorio']; ?>" <?php echo set_select('Hola',$row['Id_Accesorio']); ?> ><?php echo $row['Codigo']; echo " - "; echo $row['Accesorio']; ?></option>
                  <?php
					}
					?>
                </select>
                  <input type="hidden" name="Negociacion22" id="Negociacion22" style="width:20px" value="<?php echo $Id_Negociacion; ?>" />
                  <input type="hidden" name="idcliente2" id="idcliente2" style="width:20px" value="<?php echo $Id; ?>" /></td>
              </tr>
              <tr>
                <td align="right"><font style="font-size:12px">Cantidad:</font></td>
                <td align="left"><input type="text" name="Cantidad" id="Cantidad" style="width:40px; font-size-adjust:inherit; height:30px; font-size:15px;" onkeypress="return soloNumeros(event)" maxlength="5" required="required"/></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td align="right">&nbsp;</td>
                <td align="right"><input type="submit" name="Buscar" id="Buscar" value="Agregar" onclick="return confirm('Usted desea agregar este accesorio a la lista de compras?');"/></td>
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
        <td><fieldset>
          <legend style="font-size:15px"><b>Accesorios</b></legend>
          <form id="form4" method="post" action="<?php echo base_url();?>index.php/Control_Negociacion/eliminar_producto_2">
            <table width="410" border="0">
              <tr>
                <td>Nombre</td>
                <td>Descripcion</td>
                <td>Cantidad</td>
                <td colspan="2" align="right"><?php echo '<a href="'.base_url().'index.php/Control_Negociacion/eliminar_todo2/'.$Id.'/'.$Id_Negociacion.'">ELIMINAR TODO</a>'; echo '</br>';?></td>
              </tr>
              <tr>
                <td><?php $j=0; foreach ($Lista as $row){
							
							echo $row['Nombre']; echo '</br>';
							
							$j++;}?></td>
                <td><?php $j=0; foreach ($Lista as $row){
							
							echo $row['Descripcion']; echo '</br>';
							
							$j++;}?></td>
                <td><?php $j=0; foreach ($Lista as $row){
							
							echo $row['Cantidad']; echo '</br>';
							
							$j++;}?></td>
                <td><a href="sdfsdf">
                  <?php $j=0; foreach ($Lista as $row){
							
							echo '<a href="'.base_url().'index.php/Control_Negociacion/d2modificar_cantidad/'.$row['Id_Historial_Np'].'/'.$Id_Negociacion.'/'.$Id.'">Modificar</a>'; echo '</br>';
							
							$j++;}?>
                </a></td>
                <td><a href="sdfsdf">
                  <?php $j=0; foreach ($Lista as $row){
							
							echo '<a href="'.base_url().'index.php/Control_Venta/eliminar_producto/'.$row['Id_Historial_Np'].'/'.$Id.'/'.$Id_Negociacion.'">ELIMINAR</a>'; echo '</br>';
							
							$j++;}?>
                </a></td>
              </tr>
            </table>
          </form>
        </fieldset></td>
      </tr>
    </table>
	<form id="form3" method="post" action="<?php echo base_url();?>index.php/Control_Inicio/d_principal">
      <table width="440" border="0">
        <tr>
          <td width="434" align="right" valign="top">
              <input type="hidden" name="Status" id="Status" style="width:20px" value="<?php echo $Status; ?>" />
			  <input type="hidden" name="idcliente" id="idcliente" style="width:20px" value="<?php echo $Id; ?>" />
              <input type="hidden" name="Negociacion" id="Negociacion" style="width:20px" value="<?php echo $Id_Negociacion; ?>" />
              <input type="submit" name="button" id="button" value="Finalizar" /></td>
        </tr>
      </table>
    </form>
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