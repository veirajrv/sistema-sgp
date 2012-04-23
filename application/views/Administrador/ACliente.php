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
		$( "#Vendedor, #Vendedor2, #Vendedor3" ).combobox();
		$( "#toggle" ).click(function() {
			$( "#Vendedor, #Vendedor2, #Vendedor3" ).toggle();
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
			<a href="<?php echo base_url();?>index.php/Control_Inicio/cerrar_sesion">Cerrar Sesion </a> | <a id="tabe" href="">Ayuda</a>		</div>
	</div>
	<!-- END tagline -->

<!-- BEGIN tabs -->
<div id="navcontainer">
	<ul id="navlist">
		<li><a id="tabb" href="<?php echo base_url();?>index.php/Control_Inicio/a_principal" title="Inicio">Inicio</a></li>
		<li><a id="tabb" href="<?php echo base_url();?>index.php/Control_Negociacion/buscar_vendedores" title="Gestionar Negociaciones">Negociaciones</a></li>
		<li><a id="taba" class="active" href="<?php echo base_url();?>index.php/Control_Cliente/buscar_vendedores" title="Clientes">Clientes</a></li>
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
      <table width="424" border="0">
        <tr>
          <td width="225" valign="middle"><h2 style="font-size:30px">Mis vendedores</h2> </td>
          <td width="173" valign="middle"><h2>( <font color="#0099FF">Buscar Cliente</font> )</h2></td>
          <td width="33" align="right" valign="top">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="3"><font style="font-size:12px"><a href="<?php echo base_url();?>index.php/Control_Cliente/buscar_vendedores">Cliente</a></font> | <font style="font-size:12px"><a href="<?php echo base_url();?>index.php/Control_Cliente/buscar_vendedores_i/<?php echo $Usuario ?>">Institucion</a></font></td>
        </tr>
        <tr>
          <td colspan="3"><hr align="left" style="width:435px;" /></td>
        </tr>
        <tr>
          <td colspan="3">
              <table width="439" border="0">
                <tr>
                  <td width="120" align="right"><font style="font-size:12px">Nombre:</font></td>
                  <td width="307">
                    <form id="form1" method="post" action="<?php echo base_url();?>index.php/Control_Cliente/ver_clientes">
                      
					  <select name="Vendedor" id="Vendedor" style="width:200px; font-size-adjust:inherit; height:30px; font-size:15px;" onfocus="CambiaColor(this,'#FFCC00','#000000')" onblur="CambiaColor(this,'','#000000')" required="required">
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
                    </form>                  </td>
                </tr>
                <tr>
                  <td width="120" align="right"><font style="font-size:12px">Apellido:</font></td>
                  <td>
                      <form id="form2" method="post" action="<?php echo base_url();?>index.php/Control_Cliente/ver_clientes">
                        <select name="Vendedor" id="Vendedor2" style="width:200px; font-size-adjust:inherit; height:30px; font-size:15px;" onfocus="CambiaColor(this,'#FFCC00','#000000')" onblur="CambiaColor(this,'','#000000')" required="required">
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
                      </form>                    </td>
                </tr>
                <tr>
                  <td width="120" align="right"><font style="font-size:12px">Cedula:</font></td>
                  <td>
                      <form id="form3" method="post" action="<?php echo base_url();?>index.php/Control_Cliente/ver_clientes">
                        <select name="Vendedor" id="Vendedor3" style="width:200px; font-size-adjust:inherit; height:30px; font-size:15px;" onfocus="CambiaColor(this,'#FFCC00','#000000')" onblur="CambiaColor(this,'','#000000')" required="required">
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
                      </form>                    </td>
                </tr>
              </table>            </td>
          </tr>
        <tr>
          <td colspan="3"><hr align="left" style="width:435px;" /></td>
        </tr>
        <tr>
          <td colspan="2" valign="middle"><h2 style="font-size:30px">Listado general de clientes</h2></td>
          <td align="right" valign="top"><a href="<?php echo base_url();?>index.php/Control_Cliente/ver_clientes_lista"><img src="<?php echo base_url();?>files/images/List.png" alt="e" width="25" height="25" title="Lista de clientes"/></a></td>
        </tr>
        <tr>
          <td colspan="3"><table width="440" border="0">
            <tr>
              <td width="120" align="right"><font style="font-size:12px">Nombre y Apellido:</font></td>
              <td width="295"><form id="form4" method="post" action="<?php echo base_url();?>index.php/Control_Cliente/ver_detalle3">
                <select name="Vendedor" id="Vendedor" style="width:200px; font-size-adjust:inherit; height:30px; font-size:15px;" onfocus="CambiaColor(this,'#FFCC00','#000000')" onblur="CambiaColor(this,'','#000000')" required="required">
                  <option></option>
                  <?php
						foreach ($Clientes as $row) {
				  ?>
                  <option value="<?php echo $row['Cedula']; ?>" <?php echo set_select('Hola',$row['Cedula']); ?> ><?php echo $row['Nombre']; echo ' '; echo $row['Apellido'];?></option>
                  <?php
					}
					?>
                </select>
                <input type="submit" name="Submit" value="Buscar" />
              </form></td>
              <td width="11">&nbsp;</td>
            </tr>
          </table></td>
          </tr>
        <tr>
          <td colspan="3">&nbsp;</td>
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