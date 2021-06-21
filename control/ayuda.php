<?
if ($global_ayuda!=""){
	print "<div id=\"ayuda\">";
	print "<div class=\"encab\">Ayuda de".$global_ayuda."</div>";
	print "<div id=\"textoayuda\">";
	if ($global_ayuda_texto=="") $global_ayuda_texto = "Desde aqu&iacute; puede gestionar ".@$titulo.".<br><br>Si est&aacute; insertando o modificando cumplimente los datos y pulse el bot&oacute;n Guardar.<br><br>Si est&aacute; eliminando aseg&uacute;rese que es el registro que desea borrar y pulse el bot&oacute;n Eliminar.<br><br>Si tiene dudas sobre el funcionamiento de alg&uacute;n elemento, pulse el bot&oacute;n de Ayuda correspondiente.";
	print $global_ayuda_texto;
	print "</div>";
	print "</div>";
}
?>