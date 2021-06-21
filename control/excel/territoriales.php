<?
	include("../includes/global_cliente.php");
	include("../includes/global_funciones.php");
	include("../includes/global_conexion.php");
	
	$merror = "";
	$data = "";
	if (@$_REQUEST["accion"]=="guardar"){
	
		$header .= "Código Territorial" . "\t"; 
		$header .= "Territorial" . "\t"; 
		
		$vsql = "select * from sede order by codsede ";
		$rs = mysql_query($vsql, $db);
		$num_rows = mysql_num_rows($rs);
		if ($num_rows>0){
			while($row=mysql_fetch_array($rs)) {
				$line = ''; 
				$line .= $row["codsede"]."\t";
				$line .= $row["sede"]."\t";

				$data .= trim($line)."\n"; 			
			}
			$data = str_replace("\r","",$data);
		}
		if ($data == "") { 
			$data = "\nNo se encontraron registros!\n";                         
		} 
		header("Content-type: application/x-msdownload; charset=ISO-8859-1"); 
		header("Content-Disposition: attachment; filename=territoriales.xls"); 
		header("Pragma: no-cache"); 
		header("Expires: 0"); 
		print "$header\n$data";  		
	}
?>