<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script src="<?php echo base_url();?>files/js/jquery-1.6.2.min.js" type="text/javascript"> </script>
<script src="<?php echo base_url();?>files/js/jquery-ui-1.8.16.custom.min.js" type="text/javascript"> </script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Imprimir Negociacion</title>
<link href="<?php echo base_url();?>files/css/flick/jquery-ui-1.8.16.custom.css" rel="stylesheet" type="text/css"/>

<script>
	$(function() {
		$( "input:submit").button();
		$( "a", ".demoo" ).click(function() { return false; });
	});
</script>

</head>


<body>
<table width="851" border="0">
  <tr>
    <td width="380"><form id="form1" name="form1" method="post" action="<?php echo base_url();?>index.php/Control_Inicio/v_principal">
      <input type="submit" name="Submit" value="Salir" />
    </form></td>
    <td width="370"><form id="form3" method="post" action="<?php echo base_url();?>index.php/Control_Negociacion/atras_vista_previai">
      <div align="right">
        <input type="hidden" name="Negociacion" id="Negociacion" style="width:20px" value="<?php echo $Id_Negociacion; ?>" />
        <input type="hidden" name="idcliente" id="idcliente" style="width:20px" value="<?php echo $idcliente; ?>" />
        <input type="hidden" name="Status" id="Status" style="width:20px" value="<?php echo $Status; ?>" />
        <input name="submit" type="submit" value="Ir Negociaci&oacute;n" />
      </div>
    </form></td>
    <td align="left">
    <a title="Actualidad" href="javascript:void(0);" onclick="javascript:window.open('<?php echo base_url();?>index.php/Control_Negociacion/imprimir_cliente/<?php echo $Id_Negociacion; ?>/<?php echo $idcliente; ?>', '_blank');
window.open('<?php echo base_url();?>files/pdf/<?php echo $condiciones;?>.pdf', '_blank');">Imprimir</a>
    </td>
  </tr>
  <tr>
    <td colspan="3"><hr align="left" style="width:810px;" /></td>
  </tr>
  <tr>
    <td colspan="3">
      
      <table width="810" border="0">
          <tr>
            <td width="518" rowspan="2"><img src="<?php echo base_url();?>files/images/Logo_Formato.png" alt="a" width="147" height="69" /></td>
            <td width="282"><div align="right"><strong>R.I.F.</strong> J-00190554-5</div></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td colspan="2"><strong>Cliente: </strong>
            <?php foreach ($DatosCliente as $row){
							echo $row['Nombre']; 
							     }?></td>
          </tr>
          <tr>
            <td><strong>Direcci&oacute;n: </strong>
            <?php foreach ($DatosCliente as $row){
							echo $row['Direccion1'];
							     }?></td>
            <td><strong>COTIZACI&Oacute;N: </strong>NEGO<?php echo $Id_Negociacion; ?></td>
          </tr>
          <tr>
            <td><strong>R.I.F: </strong>
            <?php foreach ($DatosCliente as $row){
							echo $row['Rif'];
							     }?></td>
            <td><b>EJECUTIVO DE VENTAS:</b>
              <?php foreach ($DatosVendedor as $row){
							echo $row['Nombre_1']; echo '&nbsp'; echo $row['Apellido_1']; echo '&nbsp'; echo $row['Apellido_2'];
							     }?>            </td>
          </tr>
          <tr>
            <td><strong>Telefonos: </strong>
            <?php foreach ($DatosCliente as $row){
							echo $row['Telefono1']; echo '&nbsp/&nbsp'; echo $row['Telefono2'];
							     }?></td>
            <td><strong>Fecha: </strong>
              <?php foreach ($DatosVendedor as $row){
							echo $row['FechaP']; 
							     }?></td>
          </tr>
          <tr>
            <td colspan="2"><strong>Fax: </strong>
            <?php foreach ($DatosCliente as $row){
							echo $row['Telefono3']; 
							     }?></td>
          </tr>
          <tr>
            <td colspan="2"><strong>Web: </strong>
            <?php foreach ($DatosCliente as $row){
							echo $row['Web']; 
							     }?></td>
          </tr>
          <tr>
            <td colspan="2"><strong>Atenci&oacute;n: </strong><input type="text" name="textfield" style="border:none" /></td>
          </tr>
          <tr>
            <td colspan="2"><hr align="left" style="width:810px;" /></td>
          </tr>
        </table>
        <table width="811" border="0" cellspacing="0">
          <tr bgcolor="#CFCFCF">
            <td width="100">CANTIDAD</td>
            <td width="151">CODIGO</td>
            <td width="339">DESCRIPCI&Oacute;N</td>
            <td colspan="2">&nbsp;</td>
          </tr>
          <tr bgcolor="#F2F2F2">
            <td><?php $j=0; foreach ($Lista2 as $row){
			
							echo $row['Cantidad']; 
							echo "</br>";
							
							$j++;}?>
              <?php $j=0; foreach ($Lista as $row){
			
							echo $row['Cantidad']; 
							echo "</br>";
							
							$j++;}?></td>
            <td><?php $j=0; foreach ($Lista2 as $row){
			
							echo $row['Nombre']; 
							echo "</br>";
							
							$j++;}?>
              <?php $j=0; foreach ($Lista as $row){
			
							echo $row['Nombre'];
							echo "</br>";
							
							$j++;}?></td>
            <td colspan="3"><?php $j=0; foreach ($Lista2 as $row){
			
							echo $row['Descripcion']; 
							echo "</br>";
							
							$j++;}?>
              <?php $j=0; foreach ($Lista as $row){
			
							echo $row['Descripcion'];
							echo "</br>";
							
							$j++;}?></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td width="173" align="right"><?php if($Total <> NULL){ echo "<b>Neto:</b>"; 
							     }?></td>
            <td width="38"><?php if($Total <> NULL){ echo $Neto; }?></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td align="right"><?php if($Total <> NULL){ echo "<b>I.V.A. 12%:</b>"; 
							     }?></td>
            <td><?php if($Total <> NULL){foreach ($Descuento as $row){
							echo substr($row['Total']*0.12,0,8); 
							     }}?></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td align="right"><?php if($Total <> NULL) { foreach ($Descuento as $row){
							echo "<b>Descuento:</b>"; 
							     }}?></td>
            <td><?php if($Total <> NULL) { foreach ($Descuento as $row){
							echo $row['Descuento']; echo "%";
							     }}?></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td align="right"><b>TOTAL:</b></td>
            <td bgcolor="#FFFF00"><?php foreach ($Descuento as $row){
							echo substr($row['Total'] + ($row['Total']*0.12),0,8); 
							     }?></td>
          </tr>
          <tr>
            <td colspan="5">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="5" align="center">&nbsp;</td>
          </tr>
        </table>
    </td>
  </tr>
  <tr>
    <td colspan="3"></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  <td width="87">  
  </tr>
</table>
</body>
</html>
