<?
	$titulo = "Portfolio";

	$tabla = "trabajos";
	$indice = "idtrabajo";
	$tipoindice = "a"; //s:string n:number a:autonumerico
	$sqlconsulta = "select * from trabajos t, clientes c where t.idcliente=c.idcliente order by t.orden";
	
	$contenido = array(	
		array("idcliente","n","s","Nombre Cliente","*","select * from clientes order by cliente","cliente","","*","","2","Seleccione, el cliente para el que se ha realizado el trabajo",""),
		array("idtrabajo","n","s","Nombre Trabajo","*","select * from trabajos where idcliente=idcliente","trabajo","","","","2","Seleccione, el trabajo",""),
		array("fechafin","s","fck","Fecha Finalizaci&oacute;n","","","","","","","","Fecha de finalizaci&oacute;n del trabajo","")
	);
	
	$consulta = array(
		array("trabajo","Nombre Trabajo"),
		array("cliente","Nombre Cliente"),
		array("url","URL Web")
	);
?>