<?
	include("../includes/global_cliente.php");
	include("../includes/global_funciones.php");
	include("../includes/global_conexion.php");
	
	$merror = "";
	$data = "";
	if (@$_REQUEST["accion"]=="guardar"){
	
		$header .= "Regalo" . "\t";

		$vsql = "select * from regalo order by regalo";
		$rs = mysql_query($vsql, $db);
		$num_rows = mysql_num_rows($rs);
		if ($num_rows>0){
			while($row=mysql_fetch_array($rs)) {
				$line = ''; 
				if(($row["codregalo"]=="5") || ($row["codregalo"]=="10")) {
					$vsql2 = "select * from regalo re, subregalo sr where re.codregalo=sr.codregalo";
					$rs2 = mysql_query($vsql2, $db);
					while($row2=mysql_fetch_array($rs2)) {
						$line .= $row2["subregalo"]." (".$row2["tipo"].")"."\t";
					}
				} else {
					$line .= $row["regalo"]."\t";
				}	

				$data .= trim($line)."\n"; 			
			}
			$data = str_replace("\r","",$data);
		}
		if ($data == "") { 
			$data = "\nNo se encontraron registros!\n";                         
		} 
		header("Content-type: application/x-msdownload; charset=ISO-8859-1"); 
		header("Content-Disposition: attachment; filename=regalos.xls"); 
		header("Pragma: no-cache"); 
		header("Expires: 0"); 
		print "$header\n$data";  		
	}
?>