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
		$( "#Cliente, #Cliente2, #Cliente3" ).combobox();
		$( "#toggle" ).click(function() {
			$( "#Cliente, #Cliente2, #Cliente3" ).toggle();
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
		<a href="index.html" title="Home"><img src="<?php echo base_url();?>files/images/Portada/logo2.gif" alt="Your logo here" width="45" height="40" /> <span id="logo-text">YOMA
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
	<p>&nbsp;</p>
</div><!-- END lc -->
</div><!-- END left -->

<!-- BEGIN center column -->
<div id="center">
  <div id="cc">
      <table width="441" border="0">
        <tr>
          <td width="380"><h2 style="font-size:30px">Mis Negociaciones</h2></td>
          <td width="51" align="right" valign="middle"><a href="<?php echo base_url();?>index.php/Control_Venta/index2"><img src="<?php echo base_url();?>files/images/agregar.png" alt="a" width="30" height="30" title="Agregar nuevo cliente" /></a></td>
        </tr>
        <tr>
          <td colspan="2"><font style="font-size:12px"><a href="<?php echo base_url();?>index.php/Control_Venta/ver_negociacion">Cliente</a></font> | <font style="font-size:12px"><a href="<?php echo base_url();?>index.php/Control_Venta/ver_negociacion_2">Institucion</a></font></td>
        </tr>
        <tr>
          <td colspan="2"><hr align="left" style="width:435px;" /></td>
        </tr>
        <tr>
          <td colspan="2"><fieldset><legend style="font-size:15px"><b>Lista de clientes</b></legend>
              <table width="410" border="0">
                <tr>
                  <td width="110" align="right"><font style="font-size:12px">Nombre:</font></td>
                  <td width="284">
                    <form id="form1" method="post" action="<?php echo base_url();?>index.php/Control_Venta/ver_negociacion_asociadas">
                      
					  <select name="Cliente" id="Cliente" style="width:200px; font-size-adjust:inherit; height:30px; font-size:15px;" onfocus="CambiaColor(this,'#FFCC00','#000000')" onblur="CambiaColor(this,'','#000000')" required="required">
                        <option></option>
                        <?php
						foreach ($Clientes as $row) {
				  ?>
                        <option value="<?php echo $row['Id_Cliente']; ?>" <?php echo set_select('Hola',$row['Id_Cliente']); ?> ><?php echo $row['Nombre']; ?></option>
                        <?php
					}
					?>
                      </select>
					  <input type="submit" name="Submit2" value="Buscar" />
                    </form>                    </td>
                </tr>
                <tr>
                  <td width="110" align="right"><font style="font-size:12px">Apellido:</font></td>
                  <td><form id="form2" method="post" action="<?php echo base_url();?>index.php/Control_Negociacion/ver_negociacion_asociadas">
                        <select name="Cliente" id="Cliente2" style="width:200px; font-size-adjust:inherit; height:30px; font-size:15px;" onfocus="CambiaColor(this,'#FFCC00','#000000')" onblur="CambiaColor(this,'','#000000')" required="required">
                          <option></option>
                          <?php
						foreach ($Clientes as $row) {
				  ?>
                          <option value="<?php echo $row['Id_Cliente']; ?>" <?php echo set_select('Hola',$row['Id_Cliente']); ?> ><?php echo $row['Apellido']; ?></option>
                          <?php
					}
					?>
                      </select>
                        <input type="submit" name="Submit22" value="Buscar" />
                      </form>
                       </td>
                </tr>
                <tr>
                  <td width="110" align="right"><font style="font-size:12px">Cedula:</font></td>
                  <td><form id="form3" method="post" action="<?php echo base_url();?>index.php/Control_Negociacion/ver_negociacion_asociadas">
                        <select name="Cliente" id="Cliente3" style="width:200px; font-size-adjust:inherit; height:30px; font-size:15px;" onfocus="CambiaColor(this,'#FFCC00','#000000')" onblur="CambiaColor(this,'','#000000')" required="required">
                          <option></option>
                          <?php
						foreach ($Clientes as $row) {
				  ?>
                          <option value="<?php echo $row['Id_Cliente']; ?>" <?php echo set_select('Hola',$row['Id_Cliente']); ?> ><?php echo $row['Cedula']; ?></option>
                          <?php
					}
					?>
                        </select>
                        <input type="submit" name="Submit23" value="Buscar" />
                      </form>
                        </td>
                </tr>
              </table>
              </fieldset></td>
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