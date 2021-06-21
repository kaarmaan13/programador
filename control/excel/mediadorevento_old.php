<?
	include("../includes/global_cliente.php");
	include("../includes/global_funciones.php");
	include("../includes/global_conexion.php");
	
	$merror = "";
	$data = "";
	if (@$_REQUEST["accion"]=="guardar"){
	
		$header .= "Territorial" . "\t"; 
		$header .= "Código mediador" . "\t"; 
		$header .= "Nombre mediador" . "\t"; 
		$header .= "Obj. trimestral auto" . "\t"; 
		$header .= "Obj. trimestral diversos" . "\t"; 
		$header .= "Obj. trimestral vida" . "\t"; 
		$header .= "Min. mensual auto" . "\t"; 
		$header .= "Min. mensual diversos" . "\t"; 
		$header .= "Res. trimestral auto" . "\t"; 
		$header .= "Res. trimestral diversos" . "\t"; 
		$header .= "Res. trimestral vida" . "\t"; 
		if (@$_REQUEST["mes"]=="1"){
			$header .= "Res. Feb. auto" . "\t"; 
			$header .= "Res. Feb. diversos" . "\t"; 
			$header .= "Res. Mar. auto" . "\t"; 
			$header .= "Res. Mar. diversos" . "\t"; 
			$header .= "Res. Abr. auto" . "\t"; 
			$header .= "Res. Abr. diversos" . "\t"; 
		} else {
			$header .= "Res. May. auto" . "\t"; 
			$header .= "Res. May. diversos" . "\t"; 
			$header .= "Res. Jun. auto" . "\t"; 
			$header .= "Res. Jun. diversos" . "\t"; 
			$header .= "Res. Jul. auto" . "\t"; 
			$header .= "Res. Jul. diversos" . "\t"; 
		}
		$header .= "Cumplido" . "\t"; 
		
		
		$vsql = "select distinct * from mediador m, sede s, mediadorobjetivosevento o where m.codsede = s.codsede and m.codsede = o.codsede ";
		if (@$_REQUEST["codsede"]!="-1"){
			$vsql .= "and m.codsede = ".@$_REQUEST["codsede"];
		}
		$vsql .= " and o.trimestre = ".@$_REQUEST["mes"];
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
				$line .= $row["triauto"]."\t";
				$line .= $row["tridiversos"]."\t";
				$line .= $row["trivida"]."\t";
				$line .= $row["minauto"]."\t";
				$line .= $row["mindiversos"]."\t";

				$total = 0;

				$vsql = "select sum(altapolizaauto) as auto, sum(altapolizadiversos) as diversos, sum(altapolizavida) as vida FROM mediadordatos where codmediador = '".$row["codmediador"]."'";
				if (@$_REQUEST["mes"]=="1"){
					$vsql .= " and mes in (2,3,4)";
				} else {
					$vsql .= " and mes in (5,6,7)";
				}
				$rstri = mysql_query($vsql, $db);
				$num_rowst = mysql_num_rows($rstri);
				if ($num_rowst==0){
					$line .= "0\t";
					$line .= "0\t";
					$line .= "0\t";
				} else {
					$rowtri=mysql_fetch_array($rstri);
					$line .= round($rowtri["auto"])."\t";
					$line .= round($rowtri["diversos"])."\t";
					$line .= round($rowtri["vida"])."\t";
				}
				mysql_free_result($rstri);
				
				if (@$_REQUEST["mes"]=="1"){
					$busca = array(2,3,4);
				} else {
					$busca = array(5,6,7);
				}
				$auto = array(0,0,0);
				$diversos = array(0,0,0);
				for ($i=0;$i<sizeof($busca);$i++){
					$vsql = "select altapolizaauto, altapolizadiversos FROM mediadordatos where codmediador = ".$row["codmediador"];
					$vsql .= " and mes = ".$busca[$i];
					$rsmes = mysql_query($vsql, $db);
					$num_rowsm = mysql_num_rows($rsmes);
					if ($num_rowsm==0){
						$line .= "0\t";
						$line .= "0\t";
						$auto[$i] = 0;
						$diversos[$i] = 0;
					} else {
						$rowmes=mysql_fetch_array($rsmes);
						$line .= $rowmes["altapolizaauto"]."\t";
						$line .= $rowmes["altapolizadiversos"]."\t";
						$auto[$i] = $rowmes["altapolizaauto"];
						$diversos[$i] = $rowmes["altapolizadiversos"];
					}
					mysql_free_result($rsmes);
				}
				$cumplido = "No";
				if ($rowtri["auto"]>=$row["triauto"]){
					if (($auto[0]>=$row["minauto"]) && ($auto[1]>=$row["minauto"]) && ($auto[2]>=$row["minauto"])){
						if (($diversos[0]>=$row["mindiversos"]) && ($diversos[1]>=$row["mindiversos"]) && ($diversos[2]>=$row["mindiversos"])){
							$cumplido = "Si";
						} 
					} 
				}
				$line .= $cumplido."\t";

				$data .= trim($line)."\n"; 			
			}
			$data = str_replace("\r","",$data);
		}
		if ($data == "") { 
			$data = "\nNo se encontraron registros!\n";                         
		} 
		header("Content-type: application/x-msdownload; charset=ISO-8859-1"); 
		header("Content-Disposition: attachment; filename=mediadorregalo.xls"); 
		header("Pragma: no-cache"); 
		header("Expires: 0"); 
		print "$header\n$data";  		
	}
?>