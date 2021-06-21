<?
	include("../includes/global_cliente.php");
	include("../includes/global_funciones.php");
	include("../includes/global_conexion.php");
	
	$merror = "";
	$data = "";
	if (@$_REQUEST["accion"]=="guardar"){
		$otro = array("Cuenca","Toledo","Teruel","Segovia");
	
		$header .= "Territorial" . "\t"; 
		$header .= "Código Gerencia" . "\t"; 
		$header .= "Código Mediador" . "\t"; 
		$header .= "Nombre Mediador" . "\t"; 
		if (@$_REQUEST["mes"]=="1") $header .= "Resultado ENERO" . "\t"; 
		if (@$_REQUEST["mes"]=="2") $header .= "Resultado FEBRERO" . "\t"; 
		if (@$_REQUEST["mes"]=="3") $header .= "Resultado MARZO" . "\t"; 
		if (@$_REQUEST["mes"]=="4") $header .= "Resultado ABRIL" . "\t"; 
		if (@$_REQUEST["mes"]=="5") $header .= "Resultado MAYO" . "\t"; 
		if (@$_REQUEST["mes"]=="6") $header .= "Resultado JUNIO" . "\t"; 
		if (@$_REQUEST["mes"]=="7") $header .= "Resultado JULIO" . "\t"; 
		if (@$_REQUEST["mes"]=="8") $header .= "Resultado AGOSTO" . "\t"; 
		if (@$_REQUEST["mes"]=="9") $header .= "Resultado SEPTIEMBRE" . "\t"; 
		if (@$_REQUEST["mes"]=="10") $header .= "Resultado OCTUBRE" . "\t"; 
		if (@$_REQUEST["mes"]=="11") $header .= "Resultado NOVIEMBRE" . "\t"; 
		if (@$_REQUEST["mes"]=="12") $header .= "Resultado DICIEMBRE" . "\t"; 
		$header .= "Objetivo" . "\t"; 
		$header .= "Porcentaje" . "\t"; 

		$vsql = "select distinct m.codmediador, m.codsede, s.sede, m.nombremediador, o.altapolizaautoobjetivo, g.codgerencia from mediador m, gerente g, sede s, mediadorobjetivos o where m.codgerencia=g.codgerencia and m.codsede = s.codsede and m.codmediador = o.codmediador ";
		if (@$_REQUEST["codsede"]!="-1"){
			if (@$_REQUEST["codsede"]=="100"){
				$vsql .= "and m.provincia in ('Cuenca','Toledo','Teruel','Segovia') ";
			}else{
				$vsql .= "and m.codsede = ".@$_REQUEST["codsede"];
			}
			if ((@$_REQUEST["codgerencia"]) && (@$_REQUEST["codgerencia"]!="-1")){
					$vsql .= " and g.codgerencia = ".@$_REQUEST["codgerencia"];
			}
		}
		$vsql .= " and o.mes = ".@$_REQUEST["mes"];
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
				$total = 0;

				$vsql = "select sum(altapolizaauto) as total FROM mediadordatos ";
				$vsql .= "WHERE mes = ".@$_REQUEST["mes"]." and codmediador = ".$row["codmediador"];
				$rsmes = mysql_query($vsql, $db);
				$rowmes=mysql_fetch_array($rsmes);
				$total .= round($rowmes["total"]);
				if ($rowmes["total"]==""){
					$line .= "0\t";
				}else{
					$line .= $rowmes["total"]."\t";
				}
				mysql_free_result($rsmes);

				$obj = round($row["altapolizaautoobjetivo"]);
				$line .= $obj."\t";
				if (($total>0)&&($obj>0)){
					$por = round((($total * 100) / $obj),2);
				} else {
					$por = 0;
				}
				$line .= $por."\t";
				
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