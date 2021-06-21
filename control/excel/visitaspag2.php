<?
	include("../includes/global_cliente.php");
	include("../includes/global_funciones.php");
	include("../includes/global_conexion.php");
	
	// Páginas distintas
	if($_REQUEST["grupo"] == "") { $sql_fecha = "select DISTINCT(fecha) as fecha from visitas_mediador order by fecha "; $grupomostrar=""; }
	if($_REQUEST["grupo"] == "me") { $sql_fecha = "select DISTINCT(fecha) as fecha from visitas_mediador order by fecha "; $grupomostrar="mediadores"; }
	if($_REQUEST["grupo"] == "ge") { $sql_fecha = "select DISTINCT(fecha) as fecha from visitas_gerente order by fecha "; $grupomostrar="gerentes"; }
	if($_REQUEST["grupo"] == "dc") { $sql_fecha = "select DISTINCT(fecha) as fecha from visitas_directorcanal order by fecha "; $grupomostrar="directoresdecanal"; }
	if($_REQUEST["grupo"] == "dt") { $sql_fecha = "select DISTINCT(fecha) as fecha from visitas_directorterritorial order by fecha "; $grupomostrar="directoresterritoriales"; }
	if($_REQUEST["grupo"] == "es") { $sql_fecha = "select DISTINCT(fecha) as fecha from visitas_especiales order by fecha "; $grupomostrar="especiales"; }

	$inicio = "Grupo: ".$grupomostrar."\n";
	$inicio .= "Página: ".$_REQUEST["pagina"]."\n";
	
	$merror = "";
	$data = "";
	if (@$_REQUEST["accion"]=="guardar"){
		$header .= "Día" . "\t";
		$header .= "Visitas" . "\t";
	
		$rs_fecha = mysql_query($sql_fecha, $db);
		$i=0;
		while($row_fecha=mysql_fetch_array($rs_fecha)) {
			$line = '';
			$i++;
			if($i==1) $dia1=substr($row_fecha["fecha"],8,2)."/".substr($row_fecha["fecha"],5,2)."/".substr($row_fecha["fecha"],0,4);
			$diafin=substr($row_fecha["fecha"],8,2)."/".substr($row_fecha["fecha"],5,2)."/".substr($row_fecha["fecha"],0,4);
			// Todos
			if(($_REQUEST["grupo"] == "") || ($_REQUEST["grupo"] == "-1"))
				$sql="select COUNT(pagina) as numvisitas from visitas_mediador where fecha='$row_fecha[fecha]' UNION select COUNT(pagina) as numvisitas from visitas_gerente where fecha='$row_fecha[fecha]' UNION select COUNT(pagina) as numvisitas from visitas_directorcanal where fecha='$row_fecha[fecha]' UNION select COUNT(pagina) as numvisitas from visitas_directorterritorial where fecha='$row_fecha[fecha]' UNION select COUNT(pagina) as numvisitas from visitas_especiales where fecha='$row_fecha[fecha]' ";
			// Mediadores
			if($_REQUEST["grupo"] == "me")
				$sql="select COUNT(pagina) as numvisitas from visitas_mediador where fecha='$row_fecha[fecha]' and pagina='$_REQUEST[pagina]' ";
			// Gerentes
			if($_REQUEST["grupo"] == "ge")
				$sql="select COUNT(pagina) as numvisitas from visitas_gerente where fecha='$row_fecha[fecha]' and pagina='$_REQUEST[pagina]' "; 
			// Directores de Canal
			if($_REQUEST["grupo"] == "dc")
				$sql="select COUNT(pagina) as numvisitas from visitas_directorcanal where fecha='$row_fecha[fecha]' and pagina='$_REQUEST[pagina]' ";
			// Directores Territoriales
			if($_REQUEST["grupo"] == "dt")
				$sql="select COUNT(pagina) as numvisitas from visitas_directorterritorial where fecha='$row_fecha[fecha]' and pagina='$_REQUEST[pagina]' ";
			// Especiales
			if($_REQUEST["grupo"] == "es")
				$sql="select COUNT(pagina) as numvisitas from visitas_especiales where fecha='$row_fecha[fecha]' and pagina='$_REQUEST[pagina]' ";
			$rs = mysql_query($sql, $db);
			while($row=mysql_fetch_array($rs)) {
				if($row["numvisitas"] > 0) {
					$line .= substr($row_fecha["fecha"],8,2)."/".substr($row_fecha["fecha"],5,2)."/".substr($row_fecha["fecha"],0,4)."\t";
					$line .= $row["numvisitas"]."\t";
					$data .= trim($line)."\n";
					
					$numvisitas += $row["numvisitas"];
				} else {
					$i--;	
				}
			} 
		}
	}
	$data = str_replace("\r","",$data);

	$fin .= "VISITAS DEL ".$dia1." AL ".$diafin."\n";
	$fin .= "TOTAL DÍAS CON VISITA: ".$i."\n";
	$fin .= "TOTAL VISITAS A PÁGINAS: ".$numvisitas."\n";
	
	if ($data == "") { 
		$data = "\nNo se encontraron registros!\n";                         
	} 
	header("Content-type: application/x-msdownload; charset=ISO-8859-1");
	header("Content-Disposition: attachment; filename=visitasdia".$grupomostrar.".xls"); 
	header("Pragma: no-cache"); 
	header("Expires: 0"); 
	print "$inicio\n\n$header\n$data\n\n$fin";
?>