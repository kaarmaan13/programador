<?
	include("../includes/global_cliente.php");
	include("../includes/global_funciones.php");
	include("../includes/global_conexion.php");
	
	$merror = "";
	$data = "";
	if (@$_REQUEST["accion"]=="guardar"){
	
		$header .= "Código Gerente" . "\t";
		$header .= "Código Territorial" . "\t";
		$header .= "Territorial" . "\t";
		$header .= "Código Gerencia" . "\t";
		$header .= "Nombre" . "\t";
		$header .= "Dirección" . "\t";
		$header .= "Código Postal" . "\t";
		$header .= "Poblacion" . "\t";
		$header .= "Provincia" . "\t";
		$header .= "Teléfono" . "\t";
		$header .= "Email" . "\t";
		
		$vsql = "select * from gerente ge, sede se where se.codsede=ge.codsede ";
		if (@$_REQUEST["codsede"]!="-1"){
			if (@$_REQUEST["codsede"]=="100"){
				$vsql .= "and ge.provincia in ('Cuenca','Toledo','Teruel','Segovia') ";
			} else {
				$vsql .= "and ge.codsede = ".@$_REQUEST["codsede"];
			}
		}
		$vsql .=  " order by ge.codsede, ge.codgerente";
		$rs = mysql_query($vsql, $db);
		$num_rows = mysql_num_rows($rs);
		if ($num_rows>0){
			while($row=mysql_fetch_array($rs)) {
				$line = ''; 
				$line .= $row["codgerente"]."\t";
				$line .= $row["codsede"]."\t";
				$line .= $row["sede"]."\t";
				$line .= $row["codgerencia"]."\t";
				$line .= $row["nombre"]."\t";
				$line .= $row["direccion"]."\t";
				$line .= $row["codigopostal"]."\t";
				$line .= $row["poblacion"]."\t";
				$line .= $row["provincia"]."\t";
				$line .= $row["telefono"]."\t";
				$line .= $row["email"]."\t";

				$data .= trim($line)."\n"; 			
			}
			$data = str_replace("\r","",$data);
		}
		if ($data == "") { 
			$data = "\nNo se encontraron registros!\n";                         
		} 
		header("Content-type: application/x-msdownload; charset=ISO-8859-1"); 
		header("Content-Disposition: attachment; filename=gerentes.xls"); 
		header("Pragma: no-cache"); 
		header("Expires: 0"); 
		print "$header\n$data";  		
	}
?>