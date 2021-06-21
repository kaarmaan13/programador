<?
	include("../includes/global_cliente.php");
	include("../includes/global_funciones.php");
	include("../includes/global_conexion.php");
	
	$merror = "";
	$data = "";
	if (@$_REQUEST["accion"]=="guardar"){
		$otro = array("Cuenca","Toledo","Teruel","Segovia","CUENCA","TOLEDO","TERUEL","SEGOVIA");
	
		$header .= "Territorial" . "\t"; 
		$header .= "Código Gerencia" . "\t"; 
		$header .= "Código Mediador" . "\t"; 
		$header .= "Nombre Mediador" . "\t"; 
		$header .= "Objetivo Anual" . "\t"; 
		$header .= "Resultado ENERO" . "\t"; 
		$header .= "Resultado FEBRERO" . "\t"; 
		$header .= "Resultado MARZO" . "\t"; 
		$header .= "Resultado ABRIL" . "\t"; 
		$header .= "Resultado MAYO" . "\t"; 
		$header .= "Resultado JUNIO" . "\t"; 
		$header .= "Resultado JULIO" . "\t"; 
		$header .= "Resultado AGOSTO" . "\t"; 
		$header .= "Resultado SEPTIEMBRE" . "\t"; 
		$header .= "Resultado OCTUBRE" . "\t"; 
		$header .= "Resultado NOVIEMBRE" . "\t"; 
		$header .= "Resultado DICIEMBRE" . "\t"; 
		$header .= "Total Acumulado" . "\t"; 
		$header .= "Porcentaje" . "\t"; 


		$vsql = "select s.sede, s.codsede, m.provincia as provincia, m.codgerencia, m.codmediador, m.nombremediador from mediador m, gerente g, sede s where m.codgerencia=g.codgerencia and m.codsede = s.codsede ";
		if (@$_REQUEST["codsede"]!="-1"){
			if (@$_REQUEST["codsede"]=="100"){
				$vsql .= "and m.provincia in ('Cuenca','Toledo','Teruel','Segovia','CUENCA','TOLEDO','TERUEL','SEGOVIA') ";
			}else{
				$vsql .= "and m.codsede = ".@$_REQUEST["codsede"];
			}
		}
		if ((@$_REQUEST["codgerencia"]) && (@$_REQUEST["codgerencia"]!="-1")){
				$vsql .= " and g.codgerencia = ".@$_REQUEST["codgerencia"];
		}
		$vsql .= " order by s.codsede, g.codgerencia, m.nombremediador";

		$meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
		$rs = mysql_query($vsql, $db);
		$num_rows = mysql_num_rows($rs);
		if ($num_rows>0){
			while($row=mysql_fetch_array($rs)) {
				$line = ''; 
				$line .= $row["sede"]."\t";
				$line .= $row["codgerencia"]."\t";
				$line .= $row["codmediador"]."\t";
				$line .= $row["nombremediador"]."\t";

				$obj = 0;
				if (in_array($row["provincia"],$otro)){
				   $obj = 120000;
				} else {
					switch ($row["codsede"]) {
					   case 22: $obj = 140000; break;
					   case 32: $obj = 122000; break;
					   case 42: $obj = 120000; break;
					   case 52: $obj = 127000; break;
					}
				}				
				$line .= $obj."\t";
				
				$total = 0;
				for ($i=0;$i<sizeof($meses);$i++){
					$vsql = "select altaprimaauto - bajaprimaauto + altaprimadiversos - bajaprimadiversos + altaprimavida - bajaprimavida as total FROM mediadordatos ";
					$vsql .= "WHERE mes = ".($i+1)." and codmediador = ".$row["codmediador"];
					$rsmes = mysql_query($vsql, $db);
					$rowmes=mysql_fetch_array($rsmes);
					$total = $total + $rowmes["total"];
					if ($rowmes["total"]==""){
						$line .= "0\t";
					}else{
						$line .= $rowmes["total"]."\t";
					}
					mysql_free_result($rsmes);
				}
				$line .= $total."\t";
			
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