<?
	include("../includes/global_cliente.php");
	include("../includes/global_funciones.php");
	include("../includes/global_conexion.php");
	
	$merror = "";
	$data = "";
	if (@$_REQUEST["accion"]=="guardar"){
		$otro = array("Cuenca","Toledo","Teruel","Segovia");
	
		$header .= "Terriotorial" . "\t"; 
		$header .= "Código mediador" . "\t"; 
		$header .= "Nombre mediador" . "\t"; 
		$header .= "Enero" . "\t"; 
		$header .= "Febrero" . "\t"; 
		$header .= "Marzo" . "\t"; 
		$header .= "Abril" . "\t"; 
		$header .= "Mayo" . "\t"; 
		$header .= "Junio" . "\t"; 
		$header .= "Julio" . "\t"; 
		$header .= "Agosto" . "\t"; 
		$header .= "Septiembre" . "\t"; 
		$header .= "Octubre" . "\t"; 
		$header .= "Noviembre" . "\t"; 
		$header .= "Diciembre" . "\t"; 
		$header .= "Total Acumulado" . "\t"; 
		$header .= "Objetivo" . "\t"; 
		$header .= "Porcentaje" . "\t"; 


		$vsql = "select * from mediador m, sede s where m.codsede = s.codsede ";
		if (@$_REQUEST["codsede"]!="-1"){
			if (@$_REQUEST["codsede"]=="100"){
				$vsql .= "and m.provincia in ('Cuenca','Toledo','Teruel','Segovia') ";
			}else{
				$vsql .= "and m.codsede = ".@$_REQUEST["codsede"];
			}
		}
		$vsql .= " order by m.nombremediador ";

		$meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
		$rs = mysql_query($vsql, $db);
		$num_rows = mysql_num_rows($rs);
		if ($num_rows>0){
			while($row=mysql_fetch_array($rs)) {
				$line = ''; 
				$line .= $row["codsede"]."\t";
				$line .= $row["codmediador"]."\t";
				$line .= $row["nombremediador"]."\t";
				$total = 0;
				for ($i=0;$i<sizeof($meses);$i++){
					$vsql = "select altaprimaauto - bajaprimaauto + altaprimadiversos - bajaprimadiversos + altaprimavida - bajaprimavida as total FROM mediadordatos ";
					$vsql .= "WHERE mes = ".($i+1)." and codmediador = ".$row["codmediador"];
					$rsmes = mysql_query($vsql, $db);
					$rowmes=mysql_fetch_array($rsmes);
					$total .= $rowmes["total"];
					if ($rowmes["total"]==""){
						$line .= "0\t";
					}else{
						$line .= $rowmes["total"]."\t";
					}
					mysql_free_result($rsmes);
				}
				$line .= $total."\t";

				$obj = 0;
				if (in_array($row["provincia"],$otro)){
				   $obj = 120000;
				} else {
					switch ($row["codsede"]) {
					   case 22:
						   $obj = 140000;
					   case 32:
						   $obj = 122000;
					   case 42:
						   $obj = 120000;
					   case 52:
						   $obj = 127000;
					}
				}				
				$line .= $obj."\t";
				
				$por = round((($total * 100) / $obj),2);
				$line .= $por."\t";
				
				$data .= trim($line)."\n"; 			
			}
			$data = str_replace("\r","",$data);
		}
		if ($data == "") { 
			$data = "\nNo se encontraron registros!\n";                         
		} 
		header("Content-type: application/x-msdownload; charset=ISO-8859-1"); 
		header("Content-Disposition: attachment; filename=mediadorviaje.xls"); 
		header("Pragma: no-cache"); 
		header("Expires: 0"); 
		print "$header\n$data";  		
	}
?>