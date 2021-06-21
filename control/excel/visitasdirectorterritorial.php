<?
	include("../includes/global_cliente.php");
	include("../includes/global_funciones.php");
	include("../includes/global_conexion.php");
	
	$vsql = "select s.sede, s.codsede, dt.coddirectorterritorial, dt.nombre from directorterritorial dt, sede s where s.codsede = dt.codsede and dt.coddirectorterritorial='$_REQUEST[coddirectorterritorial]'";
	$rs = mysql_query($vsql, $db);
	$row=mysql_fetch_array($rs);
	
	$inicio = "Código Director Territorial: ".$row["coddirectorterritorial"]."\n";
	$inicio .= "Nombre Director Territorial: ".$row["nombre"]."\n";
	$inicio .= "Territorial: ".$row["sede"]."\n";
	
	$merror = "";
	$data = "";
	if (@$_REQUEST["accion"]=="guardar"){
	
		$header .= "Fecha visita" . "\t";
		$header .= "Página visitada" . "\t";
		
		$vsql = "select pagina, fecha from visitas_directorterritorial where coddirectorterritorial='$_REQUEST[coddirectorterritorial]'";
		$rs = mysql_query($vsql, $db);
		$num_rows = mysql_num_rows($rs);
		
		$i=0;
		$distintas=0;
		$fecha="";
		$fecha_ant="";
		if ($num_rows>0){
			while($row=mysql_fetch_array($rs)) {
				$i++;
				$fecha_ant=$fecha;
				if($row["fecha"] != $fecha_ant) {
					$fecha=$row["fecha"];
					$distintas++;
				}
				
				$line = ''; 
				$line .= $row["fecha"]."\t";
				$line .= $row["pagina"]."\t";

				$data .= trim($line)."\n"; 			
			}
			$data = str_replace("\r","",$data);
		}
		
		$fin .= "Días con visitas: ".$distintas."\n";
		$fin .= "Total páginas visitadas: ".$i."\n";
		
		if ($data == "") { 
			$data = "\nNo se encontraron registros!\n";                         
		} 
		header("Content-type: application/x-msdownload; charset=ISO-8859-1"); 
		header("Content-Disposition: attachment; filename=visitasdirectorterritorial".$_REQUEST["coddirectorterritorial"].".xls"); 
		header("Pragma: no-cache"); 
		header("Expires: 0"); 
		print "$inicio\n\n$header\n$data\n\n$fin";  		
	}
?>