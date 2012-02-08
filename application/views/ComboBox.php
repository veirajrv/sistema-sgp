<?php
$rpta="";
if ($_POST["elegido"]=="Activa") {
	$rpta= '
	<option value="50">Se entrega cotizaci&oacute;n</option>
	<option value="75">Busca financiamiento</option>
	<option value="75">Decide forma de pago</option>
	<option value="90">Espero orden de compra</option>	
	';	
}
echo $rpta;	
?>