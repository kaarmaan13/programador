<?
	include("../includes/global_cliente.php");
	include("../includes/global_funciones.php");
	include("../includes/global_conexion.php");
	
	$merror = "";
	if (@$_REQUEST["accion"]=="guardar"){
		$line = ''; 

		// MEDIADORES
/*		$vsql = "SELECT * FROM mediador";
		$rs = mysql_query($vsql, $db);
		while($row=mysql_fetch_array($rs)) {
			if(($row["movil"]!="") && (substr($row["movil"], 0, 1)=="6")) {
				$line .= $row["nombremediador"].";".$row["movil"]."\r\n";
			}
		}*/
		// AGENTES
		$vsql = "SELECT * FROM agente";     
		$rs = mysql_query($vsql, $db);      
		while($row=mysql_fetch_array($rs)) {		
			if(($row["movil"]!="") && (substr($row["movil"], 0, 1)=="6")) {
				$line .= $row["nombreagente"].";".$row["movil"]."\r\n";
			}
		}
		
		// ESPECIALES
		$line .= "DAVID GONZÁLEZ SÁNCHEZ;637225151"."\r\n";
		$line .= "MANOLO GARCÍA BALLESTER;686453246"."\r\n";
/*		$line .= "FRANCISCO CABRERO HIDALGO;620018269"."\r\n";*/
		$line .= "MARIA DOMARCO;639154678"."\r\n";
/*		$line .= "JAVIER TORRES;646494100"."\r\n";*/
		$line .= "TOÑI ROMERO SAMBADE;659164317"."\r\n";
	}
	
	$data = str_replace("\r\n","",$data);
	
	if ($line == "") { 
		$line = "\r\nNo se encontraron registros!\r\n";                         
	} 
	header("Content-type: application/x-msdownload; charset=ISO-8859-1"); 
	header("Content-Disposition: attachment; filename=sms.txt"); 
	header("Pragma: no-cache"); 
	header("Expires: 0"); 
	print "$line";  
?>