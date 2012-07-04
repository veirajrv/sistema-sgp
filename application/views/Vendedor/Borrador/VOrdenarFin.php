<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<script src="<?php echo base_url();?>files/js/jquery-1.6.2.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>files/js/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>

<head>

<script language="JavaScript">

function cerrar() {
var ventana = window.self;
ventana.opener = window.self;
parent.close();
}

</script>


<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Ordenar productos</title>

<link href="<?php echo base_url();?>files/css/flick/jquery-ui-1.8.16.custom.css" rel="stylesheet" type="text/css"/>

</head>

<body>
<table width="430" border="0">
  <tr>
    <td align="center"><b>Listo! Ya fueron ordenados sus productos exitosamente presione <a href="#" onclick="javascript:cerrar();">Aqui </a> Para cerrar esta ventana</b></td>
  </tr>
</table>
</body>
</html>