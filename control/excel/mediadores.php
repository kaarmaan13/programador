<?
	include("../includes/global_cliente.php");
	include("../includes/global_funciones.php");
	include("../includes/global_conexion.php");
	
	$merror = "";
	$data = "";
	if (@$_REQUEST["accion"]=="guardar"){
	
		$header .= "Código Mediador" . "\t";
		$header .= "Código Territorial" . "\t";
		$header .= "Nombre" . "\t";
		$header .= "Código Gerencia" . "\t";
		$header .= "Persona Contacto" . "\t";
		$header .= "Dirección" . "\t";
		$header .= "Código Postal" . "\t";
		$header .= "Poblacion" . "\t";
		$header .= "Provincia" . "\t";
		$header .= "Teléfono" . "\t";
		$header .= "FAX" . "\t";
		$header .= "Movil" . "\t";
		$header .= "DNI" . "\t";
		$header .= "E-mail" . "\t";
		$header .= "Oficina" . "\t";
		
		$vsql = "select * from mediador me, sede se where se.codsede=me.codsede ";
		// Territorial
		if (@$_REQUEST["codsede"]!="-1"){
			if (@$_REQUEST["codsede"]=="100"){
				$vsql .= " and me.provincia in ('Cuenca','Toledo','Teruel','Segovia') ";
			} else {
				$vsql .= " and me.codsede = ".@$_REQUEST["codsede"];
			}
		}
		// Inscritos/No inscritos
		if (@$_REQUEST["numvisita"]!="-1"){
			$vsql .= " and me.numvisita = ".@$_REQUEST["numvisita"];
		}
		$vsql .=  " order by me.codsede, me.codmediador";
		$rs = mysql_query($vsql, $db);
		$num_rows = mysql_num_rows($rs);
		if ($num_rows>0){
			while($row=mysql_fetch_array($rs)) {
				$line = ''; 
				$line .= "".$row["codmediador"]."\t";
				$line .= $row["codsede"]."\t";
				$line .= $row["nombremediador"]."\t";
				$line .= $row["codgerencia"]."\t";
				$line .= $row["personacontacto"]."\t";
				$line .= $row["direccion"]."\t";
				$line .= $row["codigopostal"]."\t";
				$line .= $row["poblacion"]."\t";
				$line .= $row["provincia"]."\t";
				$line .= $row["telefono"]."\t";
				$line .= $row["fax"]."\t";
				$line .= $row["movil"]."\t";
				$line .= $row["dni"]."\t";
				$line .= $row["email"]."\t";
				$line .= $row["oficina"]."\t";

				$data .= trim($line)."\n"; 			
			}
			$data = str_replace("\r","",$data);
		}
		if ($data == "") { 
			$data = "\nNo se encontraron registros!\n";                         
		} 
		header("Content-type: application/x-msdownload; charset=ISO-8859-1"); 
		header("Content-Disposition: attachment; filename=mediadores.xls"); 
		header("Pragma: no-cache"); 
		header("Expires: 0"); 
		print "$header\n$data";  		
	}
?>