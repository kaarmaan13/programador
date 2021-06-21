<?
	include("../includes/global_cliente.php");
	include("../includes/global_funciones.php");
	include("../includes/global_conexion.php");
	
	$merror = "";
	$data = "";
	if (@$_REQUEST["accion"]=="guardar"){
	
		$header .= "Código Director Territorial" . "\t";
		$header .= "Código Territorial" . "\t";
		$header .= "Territorial" . "\t";
		$header .= "Nombre" . "\t";
		$header .= "Dirección" . "\t";
		$header .= "Código Postal" . "\t";
		$header .= "Poblacion" . "\t";
		$header .= "Provincia" . "\t";
		$header .= "Teléfono" . "\t";
		$header .= "Email" . "\t";
		
		$vsql = "select * from directorterritorial dt, sede se where se.codsede=dt.codsede order by dt.coddirectorterritorial ";
		$rs = mysql_query($vsql, $db);
		$num_rows = mysql_num_rows($rs);
		if ($num_rows>0){
			while($row=mysql_fetch_array($rs)) {
				$line = ''; 
				$line .= $row["coddirectorterritorial"]."\t";
				$line .= $row["codsede"]."\t";
				$line .= $row["sede"]."\t";
				$line .= $row["nombre"]."\t";
				$line .= $row["direccion"]."\t";
				$line .= $row["codigopostal"]."\t";
				$line .= $row["poblacion"]."\t";
				$line .= $row["provincia"]."\t";
				$line .= $row["telefono"]."\t";
				$line .= $row["email"]."\t";

				$data .= trim($line)."\n"; 			
			}
			$data = str_replace("\r","",$data);
		}
		if ($data == "") { 
			$data = "\nNo se encontraron registros!\n";                         
		} 
		header("Content-type: application/x-msdownload; charset=ISO-8859-1"); 
		header("Content-Disposition: attachment; filename=directoresterritoriales.xls"); 
		header("Pragma: no-cache"); 
		header("Expires: 0"); 
		print "$header\n$data";  		
	}
?>