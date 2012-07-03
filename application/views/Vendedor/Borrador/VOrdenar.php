<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<script src="<?php echo base_url();?>files/js/jquery-1.6.2.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>files/js/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>

<head>

<style>
	#sortable { list-style-type: none; margin: 0; padding: 0; width: 60%; }
	#sortable li { margin: 0 5px 5px 5px; padding: 5px; font-size: 1.2em; height: 1.5em; }
	html>body #sortable li { height: 1.5em; line-height: 1.2em; }
	.ui-state-highlight { height: 1.5em; line-height: 1.2em; }
</style>
    
<script>
	$(function() {
		$( "#sortable" ).sortable({
			placeholder: "ui-state-highlight"
		});
		$( "#sortable" ).disableSelection();
	});
</script>
   
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Ordenar Productos</title>


	<link href="<?php echo base_url();?>files/css/flick/jquery-ui-1.8.16.custom.css" rel="stylesheet" type="text/css"/>
    
</head>

<body>

<form id="form3" method="post" action="<?php echo base_url();?>index.php/Control_Negociacion/agregar_orden/<?php echo $Id_Negociacion?>">
  <ul id="sortable">
    <?php foreach($Lista as $row){?>
      <li class="ui-state-default" style="width:400px">
        <table border="0">
          <tr>
            <td><input type="checkbox" name="checkbox[]" id="checkbox" value="<?php echo $row['Id_Historial_Np'];?>" checked/></td>
            <td><?php echo $row['Codigo'];?></td>
            <td><?php echo " ( "; echo $row['Nombre']; echo " )";?></td>
          </tr>
        </table>
    </li>
        <?php }?>
        <table width="400px" border="0">
          <tr>
            <td><input type="submit" name="button" id="button" value="Aprobar Orden" style="width:400px; height:50px; font-size:20px" OnClick="return confirm('Seguro que quiere ordenar estos Productos de esta manera?')"/></td>
          </tr>
        </table>
  </ul>
</form>

</body>
</html>