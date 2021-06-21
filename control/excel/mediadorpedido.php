<?
include "../../php/conexion.php";
	include("../../control/includes/global_cliente.php");
	include("../../control/includes/global_funciones.php");
	include("../../control/includes/global_conexion.php");

	$inicio = "Mes: ".$_REQUEST["mestexto"]."\n";

	$merror = "";
	$data = "";
	if (@$_REQUEST["accion"]=="guardar"){
		$header .= "Fecha Pedido" . "\t"; 
		$header .= "Regalo" . "\t"; 
		$header .= "Nombre Mediador" . "\t"; 
		$header .= "Código Mediador" . "\t";
		$header .= "Nombre Gerente" . "\t"; 
		$header .= "Código Gerente" . "\t";
		$header .= "Dirección Gerente" . "\t";
		$header .= "Estado" . "\t"; 

		$result=mysql_query("SELECT p.codpedido, p.fecha, p.codregalo, p.codsubregalo, r.regalo, m.nombremediador, m.codgerencia, m.codmediador, g.nombre, g.codgerente, g.direccion AS direcciongerente, g.codigopostal as codigopostalgerente, g.poblacion as poblaciongerente, g.provincia as provinciagerente, p.estadopedido FROM pedido p, regalo r, mediador m, gerente g WHERE p.codregalo = r.codregalo AND m.codmediador = p.codmediador AND g.codgerencia = m.codgerencia AND mes=$_REQUEST[mes] ORDER BY codpedido ASC", $conexion);
		if (mysql_num_rows($result)>0){
			$i=0;
			while($row=mysql_fetch_array($result)) {
				$i++;
				$line = '';
				$line .= substr($row["fecha"],8,2)."/".substr($row["fecha"],5,2)."/".substr($row["fecha"],0,4)."\t";
				
				if($row["codsubregalo"]!="") {
					$result_sub=mysql_query("SELECT * FROM subregalo WHERE codsubregalo=$row[codsubregalo]", $conexion);
					$row_sub=mysql_fetch_array($result_sub);
					if($row_sub["codregalo"]=="10") { $line .= $row_sub["subregalo"]." (". $row_sub["tipo"].")"."\t"; }
					else $line .= $row_sub["subregalo"]."\t";
				}
				else $line .= $row["regalo"]."\t";
				
				$line .= $row["nombremediador"]."\t";
				$line .= $row["codmediador"]."\t";
				$line .= $row["nombre"]."\t";
				$line .= $row["codgerencia"]."\t";
				$line .= $row["direcciongerente"].". ".$row["codigopostalgerente"].". ".$row["poblaciongerente"].". ".$row["provinciagerente"]."\t";
				$line .= $row["estadopedido"]."\t";
				
				$data .= trim($line)."\n"; 			
			}
			$data = str_replace("\r","",$data);
		}
		
		$fin .= "Total pedidos realizados: ".$i."\n";
		
		if ($data == "") { 
			$data = "\nNo se encontraron registros!\n";                         
		} 
		header("Content-type: application/x-msdownload; charset=ISO-8859-1"); 
		header("Content-Disposition: attachment; filename=mediadorpedido_".$_REQUEST["mestexto"].".xls"); 
		header("Pragma: no-cache"); 
		header("Expires: 0"); 
		print "$inicio\n\n$header\n$data\n\n$fin";  
	}
	
include "../../php/cerrar_conexion.php";
?>