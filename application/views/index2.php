<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Login Box HTML Code - www.PSDGraphics.com</title>

<link rel="stylesheet" href="<?php echo base_url(); ?>files/css/login-box2.css" type="text/css" media="screen" />
</head>

<body>


<div style="padding: 100px 0 0 250px;">


<div id="login-box">


<form id="form1" name="form1" method="post" action="<?php echo base_url(); ?>index.php/Control_Inicio/iniciar_sesion/">
  <h2>Iniciar Sesion </h2>
  Bienvenidos al Sistema de Gestion de Procesos <br />
  <br />
  <div id="login-box-name" style="margin-top:20px;">Nombre:</div>
  <div id="login-box-field" style="margin-top:20px;">
    <input name="Nombre" class="form-login" id="Nombre" title="Usuario" size="30" maxlength="20" required="required"/>
  </div>
  <div id="login-box-name">Clave:</div>
  <div id="login-box-field">
    <input name="Clave" type="Password" class="form-login" id="Clave" title="Clave" size="30" maxlength="20" required="required"/>
  </div>
  <br />
  <span class="login-box-options">
  <input type="checkbox" name="1" value="1" />
Recordar Usuario
<input type="submit" name="Submit" value="INGRESAR" style="height:30px; width:110px;"/> 
<a href="#" style="margin-left:30px;"></a></span><br />
<br />
<a href="#"></a>
<label></label>
</form>
<H2>&nbsp;</H2>
</div>

</div>











</body>
</html>