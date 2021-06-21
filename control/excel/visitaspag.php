<?
	include("../includes/global_cliente.php");
	include("../includes/global_funciones.php");
	include("../includes/global_conexion.php");
	
	$merror = "";
	$data = "";
	if (@$_REQUEST["accion"]=="guardar"){
		$header .= "Página" . "\t";
		$header .= "Visitas" . "\t";
	
		$sql_pag="select DISTINCT(pagina) as pagina from visitas_mediador ";
		$rs_pag = mysql_query($sql_pag, $db);
		$i=0;
		$pag_ant="";
		while($row_pag=mysql_fetch_array($rs_pag)) {
			$line = '';
			$i++;
			if($numvisitas_parcial > 0) {
				$line .= $pag_ant."\t";
				$line .= $numvisitas_parcial."\t";
				$data .= trim($line)."\n";
			} else {
				$i--;
			}
			
			if($pag_ant != $row_pag["pagina"]) {
				$numvisitas_parcial=0;
				$pag_ant=$row_pag["pagina"];
			}
			// Todos
			if(($_REQUEST["grupo"] == "") || ($_REQUEST["grupo"] == "-1"))
				$vsql="select COUNT(pagina) as numvisitas from visitas_mediador where pagina='$row_pag[pagina]' UNION select COUNT(pagina) as numvisitas from visitas_gerente where pagina='$row_pag[pagina]' UNION select COUNT(pagina) as numvisitas from visitas_directorcanal where pagina='$row_pag[pagina]' UNION select COUNT(pagina) as numvisitas from visitas_directorterritorial where pagina='$row_pag[pagina]' UNION select COUNT(pagina) as numvisitas from visitas_especiales where pagina='$row_pag[pagina]' ";
			// Mediadores
			if($_REQUEST["grupo"] == "me") {
				$vsql="select COUNT(pagina) as numvisitas from visitas_mediador where pagina='$row_pag[pagina]' ";
				$grupomostrar="mediadores";
			}
			// Gerentes
			if($_REQUEST["grupo"] == "ge") {
				$vsql="select COUNT(pagina) as numvisitas from visitas_gerente where pagina='$row_pag[pagina]' "; 
				$grupomostrar="gerentes";
			}
			// Directores de Canal
			if($_REQUEST["grupo"] == "dc") {
				$vsql="select COUNT(pagina) as numvisitas from visitas_directorcanal where pagina='$row_pag[pagina]' ";
				$grupomostrar="directoresdecanal";
			}
			// Directores Territoriales
			if($_REQUEST["grupo"] == "dt") {
				$vsql="select COUNT(pagina) as numvisitas from visitas_directorterritorial where pagina='$row_pag[pagina]' ";
				$grupomostrar="directoresterritoriales";
			}
			// Especiales
			if($_REQUEST["grupo"] == "es") {
				$vsql="select COUNT(pagina) as numvisitas from visitas_especiales where pagina='$row_pag[pagina]' ";
				$grupomostrar="especiales";
			}
	
			$rs = mysql_query($vsql, $db);
			while($row=mysql_fetch_array($rs)) {
				$numvisitas_parcial += $row["numvisitas"];
				$numvisitas += $row["numvisitas"];
			} 
		}
	}
	// Último registro
	$i++;
	if($numvisitas_parcial > 0) {
		$line .= $pag_ant."\t";
		$line .= $numvisitas_parcial."\t";
		$data .= trim($line)."\n";
	} else {
		$i--;
	}
	
	$data = str_replace("\r","",$data);
	
	$fin .= "TOTAL PÁGINAS: ".$i."\n";
	$fin .= "TOTAL VISITAS A PÁGINAS: ".$numvisitas."\n";
	
	if ($data == "") { 
		$data = "\nNo se encontraron registros!\n";                         
	} 
	header("Content-type: application/x-msdownload; charset=ISO-8859-1");
	header("Content-Disposition: attachment; filename=visitaspagina".$grupomostrar.".xls"); 
	header("Pragma: no-cache"); 
	header("Expires: 0"); 
	print "$header\n$data\n\n$fin";
?>