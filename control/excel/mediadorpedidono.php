<?
	function formatomes($month) {
		switch ($month) {
			case 1: "ENERO"; break;
			case 2: "FEBRERO"; break;
			case 3: "MARZO"; break;
			case 4: "ABRIL"; break;
			case 5: "MAYO"; break;
			case 6: "JUNIO"; break;
			case 7: "JULIO"; break;
			case 8: "AGOSTO"; break;
			case 9: "SEPTIEMBRE"; break;
			case 10: "OCTUBRE"; break;
			case 11: "NOVIEMBRE"; break;
			case 12: "DICIEMBRE"; break;
		}
	}
	
	include("../../control/includes/global_cliente.php");
	include("../../control/includes/global_funciones.php");
	include("../../control/includes/global_conexion.php");

	$merror = "";
	$data = "";
	
	$inicio = "Mes: ".formatomes($_REQUEST["mes"])."\n";
	
	if (@$_REQUEST["accion"]=="guardar"){
		$header .= "Código Mediador" . "\t";
		$header .= "Nombre Mediador" . "\t"; 

		$sql="SELECT * FROM mediador order by nombremediador";
		$rs = mysql_query($sql, $db);
		$cont=0;
		while($row=mysql_fetch_array($rs)) {
			if(($_REQUEST["mes"] == 4) OR ($_REQUEST["mes"] == 5)) { $mes[1]=2; $mes[2]=3; }
			if(($_REQUEST["mes"] == 6) OR ($_REQUEST["mes"] == 7)) { $mes[1]=4; $mes[2]=5; }
			if(($_REQUEST["mes"] == 8) OR ($_REQUEST["mes"] == 9)) { $mes[1]=6; $mes[2]=7; }
			if(($_REQUEST["mes"] == 10) OR ($_REQUEST["mes"] == 11)) { $mes[1]=9; $mes[2]=10; }
			if($_REQUEST["mes"] == 12) { $mes[1]=11; $mes[2]=12; }
			$sql_datos="SELECT * FROM mediador med, mediadordatos md, mediadorobjetivos mo WHERE md.codmediador=mo.codmediador AND md.mes=mo.mes AND med.codmediador=md.codmediador AND med.codmediador='$row[codmediador]' AND (md.mes=$mes[1] OR md.mes=$mes[2])";
			$rs_datos = mysql_query($sql_datos, $db);
			$i=0;
			$objetivo=0;
			while($row_datos=mysql_fetch_array($rs_datos)) {
				$i++;
				if( ($row_datos["altapolizaautoobjetivo"] <= $row_datos["altapolizaauto"]) && (($objetivo==0) && ($i==1)) ) { $objetivo=1; }
				if($row_datos["altapolizaautoobjetivo"] > $row_datos["altapolizaauto"]) { $objetivo=0; }
				$sql_pedido="SELECT p.codregalo as codigoregalo, p.codpedido, p.codsubregalo, r.regalo FROM pedido p, regalo r WHERE p.codregalo=r.codregalo AND p.codmediador='$row_datos[codmediador]' AND p.mes=$_REQUEST[mes]";
				$rs_pedido = mysql_query($sql_pedido, $db);
				$row_pedido=mysql_fetch_array($rs_pedido);
				if( (($i==2) && ($objetivo==1)) && ($row_pedido["codpedido"] == "") ) { 
					$cont ++;
					$line = '';
					$line .= $row["codmediador"]."\t";
					$line .= $row["nombremediador"]."\t";
					
					$data .= trim($line)."\n";
				}
				$data = str_replace("\r","",$data);
			}
		}
		if ($data == "") { 
			$data = "\nNo se encontraron registros!\n";                         
		} 
		$fin .= "Mediadores que no han realizados su pedido: ".$cont."\n";

		header("Content-type: application/x-msdownload; charset=ISO-8859-1"); 
		header("Content-Disposition: attachment; filename=mediadorpedidono.xls"); 
		header("Pragma: no-cache"); 
		header("Expires: 0"); 
		print "$inicio\n$header\n$data\n$fin";  		
	}
?>