<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
</head>

<body onload="window.print()">
<table width="836" border="0">
  <tr>
    <td width="147" rowspan="2"><img src="<?php echo base_url();?>files/images/Logo_Formato.png" alt="" width="147" height="69" /></td>
    <td width="679" align="right" valign="top"><h2 style="font-size:20px; font-family:Arial, Helvetica, sans-serif; color:#369">Lista de instituciones</h2></td>
  </tr>
  <tr>
    <td align="right" valign="top"><?php if(isset($Max)) echo '<font style="font-size:15px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>'.$Max.'</b></font>' ?><?php if(isset($Min)) echo '<font style="font-size:15px; font-family:Arial, Helvetica, sans-serif;" color="#369"><b>'.$Min.'</b></font>' ?></td>
  </tr>
  <tr>
    <td colspan="2"><hr/></td>
  </tr>
</table>
<?php echo $table; ?>
</body>
</html>