<?
	if ($_REQUEST["submitchange"]=="true"){
		crearformulario($tabla,$indice,$contenido,$titulo,$action,$tipoindice,$site,"submit",$size);
	}
	else {		
		if ($_REQUEST["accion"]=="deleteimg"){
			// Borramos la imagen seleccionada
			@unlink('../' . $contenido[$i][8] . '/'.@$_REQUEST["fieldimg"]);
			$vsql="update ".$tabla." set ".@$_REQUEST["fieldimg"]." = '' ";
			$vsql.=" where ".@$_REQUEST["fieldimg"];
			$vsql .= " = '".@$_REQUEST["idimg"]."'";
			mysql_query($vsql,$db);
			post(array("site","action","ok"),array(@$_REQUEST["site"],@$_REQUEST["action"],"true"));
		}
	
		$global_ayuda = " ".$titulo;
		if (@$_REQUEST[$indice]!="") $idx = @$_REQUEST[$indice];
		if ($action=="insert") $idx = "-1";
		if ($idx==""){
			if (@$_REQUEST["fieldimg"]!=""){
				$vsql="update ".$tabla." set ".@$_REQUEST["fieldimg"]." = '' ";
				$vsql.=" where ".@$_REQUEST["fieldimg"];
				$vsql .= " = '".@$_REQUEST["idimg"]."'";
				//print $vsql;
				mysql_query($vsql,$db);
				post(array("site","action","ok"),array(@$_REQUEST["site"],@$_REQUEST["action"],"true"));
	
			} else {
				crearconsulta($sqlconsulta, $consulta, $titulo, $action, $site, $indice, $global_paginacion);
			}
		} else {
			if (@$_REQUEST["accion"]=="guardar"){
				/* Creación inicial de tablas */
				$vsql = "CREATE TABLE IF NOT EXISTS `".$tabla."` ( ";
				for ($i=0;$i<sizeof($contenido);$i++){
					if ($i>0) $vsql.=", ";
					$vsql .= "`".$contenido[$i][0]."`";
					switch($contenido[$i][1]) {
						case "a":	$vsql .= " int(".$contenido[$i][10].") auto_increment";
									break;
						case "n":	$vsql .= " int(".$contenido[$i][10].")";
									break;
						case "f":	$vsql .= " float";
									break;
						case "do":	$vsql .= " double";
									break;
						case "s":	if(($contenido[$i][2] == "i") || ($contenido[$i][2] == "cp") || ($contenido[$i][2] == "f") || ($contenido[$i][2] == "tp")) {
										$vsql .= " varchar(".$contenido[$i][10].")";
									} else if(($contenido[$i][2] == "t") || ($contenido[$i][2] == "ck") || ($contenido[$i][2] == "ck2") || ($contenido[$i][2] == "ck3") || ($contenido[$i][2] == "fck") || ($contenido[$i][2] == "fck2")) {
										$vsql .= " text";
									}								
									break;
						case "d":	$vsql .= " date default '0000-00-00'";
									break;
						case "dt":	$vsql .= " datetime default '0000-00-00 00:00:00'";
									break;
					}
					switch($contenido[$i][4]){
						case "*":	$vsql .= " NOT NULL";
									break;
						case "":	if($indice != $contenido[$i][0])$vsql .= " DEFAULT NULL";
					}
					if($indice == $contenido[$i][0]) $vsql .= " NOT NULL";
				}
				$vsql .=", PRIMARY KEY  (`".$indice."`) )";		
				mysql_query($vsql) or die( "Error en $vsql, error: " . mysql_error() );
				/* /Creación inicial de tablas */
	
				if ($action=="insert"){
					$vsql="insert into ".$tabla."(";
					for ($i=0;$i<sizeof($contenido);$i++){
						if ($i>0) $vsql.=",";
						$vsql .= $contenido[$i][0];
					}
					$vsql.=") values (";
					for ($i=0;$i<sizeof($contenido);$i++){
						if ($i>0) $vsql.=",";
						if ($contenido[$i][2]=="f"){
							if (@$_FILES[$contenido[$i][0]]["tmp_name"]!=""){
								$nom_img = $tabla."_".$contenido[$i][0];
								$vsql .= "'".$nom_img."'";	
							}
							else {
								$vsql .= "''";
							}
						} else {
							if (@$_REQUEST[$contenido[$i][0]].""==""){
								$vsql .= $contenido[$i][1]=="n" ? "0" : "null";	
							} else {
								if ($contenido[$i][1]!="n") $vsql .= "'";
								if ($contenido[$i][1]=="i") $vsql .= str_replace("'", "\'", @$_REQUEST[$contenido[$i][0]]);
								else $vsql .= str_replace("'", "\'", @$_REQUEST[$contenido[$i][0]]);
								if ($contenido[$i][1]!="n") $vsql .= "'";
							}
						}
					}
					$vsql .=")";
					//print $vsql."<br>";
					mysql_query($vsql,$db);
					$codinsertado = mysql_insert_id();
					//Solución al "bug" con la primera inserción en árboles
					if($codinsertado == 0) $codinsertado=$_REQUEST[$contenido[0][0]];
					
					for ($i=0;$i<sizeof($contenido);$i++){
						if ($contenido[$i][2]=="f"){
							$nomfile = $tabla."_".$contenido[$i][0]."_".$codinsertado;
							if (storefile($contenido[$i][0],$contenido[$i][9],$nomfile,$contenido[$i][12])){
								$temp_filename = $_FILES[$contenido[$i][0]]['name'];
								$ext = explode('.',$temp_filename);
								$ext = strtolower($ext[count($ext)-1]);
			
								$vsql = "update ".$tabla." set ".$contenido[$i][0]."='".$nomfile.".".$ext."'";
								$vsql .= " where ".$indice."=";
								if ($tipoindice=="s"){
									$vsql .= "'".$codinsertado."'";
								}else {
									$vsql .= $codinsertado;
								}
								//print $vsql."<br>";
								mysql_query($vsql,$db);
							}
						}
					}	
					post(array("site","action","ok"),array(@$_REQUEST["site"],@$_REQUEST["action"],"true"));
				}
				if ($action=="update"){
					$vsql="update ".$tabla." set ";
					for ($i=0;$i<sizeof($contenido);$i++){
						if($contenido[$i][2] != "f") {
							if ($i>0) $vsql.=",";						
							$vsql .= $contenido[$i][0]."=";
							if (@$_REQUEST[$contenido[$i][0]].""==""){
								$vsql .= $contenido[$i][1]=="n" ? "0" : "null";	
							} else {
								if ($contenido[$i][1]!="n") $vsql .= "'";
								$vsql .= str_replace("'", "\'", @$_REQUEST[$contenido[$i][0]]);														
								if ($contenido[$i][1]!="n") $vsql .= "'";
							}
						}
					}
					$vsql.=" where ".$indice;
					if ($ptipoindice=="s"){
						$vsql .= " = '".@$_REQUEST[$indice]."'";
					} else {
						$vsql .= " = ".@$_REQUEST[$indice];
					}
					//echo $vsql;
					mysql_query($vsql,$db);
					
					$codinsertado = @$_REQUEST[$indice];
					for ($i=0;$i<sizeof($contenido);$i++){
						if ($contenido[$i][2]=="f"){
							$nomfile = $tabla."_".$contenido[$i][0]."_".$codinsertado;
							if (storefile($contenido[$i][0],$contenido[$i][9],$nomfile,$contenido[$i][12])){
								$temp_filename = $_FILES[$contenido[$i][0]]['name'];
								$ext = explode('.',$temp_filename);
								$ext = strtolower($ext[count($ext)-1]);
			
								$vsql = "update ".$tabla." set ".$contenido[$i][0]."='".$nomfile.".".$ext."'";
								$vsql .= " where ".$indice."=";
								if ($tipoindice=="s"){
									$vsql .= "'".$codinsertado."'";
								}else {
									$vsql .= $codinsertado;
								}
								mysql_query($vsql,$db);
							}
						}
					}				
					post(array("site","action","ok"),array(@$_REQUEST["site"],@$_REQUEST["action"],"true"));
				}
				if ($action=="delete"){
					// Borramos las imágenes que hubiese en el registro seleccionado
					for ($i=0;$i<sizeof($contenido);$i++){
						if ($contenido[$i][2]=="f"){
							$vsql="select ". $contenido[$i][0] ." from ".$tabla;
							$vsql.=" where ".$indice;
							if ($ptipoindice=="s"){
								$vsql .= " = '".@$_REQUEST[$indice]."'";
							} else {
								$vsql .= " = ".@$_REQUEST[$indice];
							}
							$result=mysql_query($vsql,$db);
							$row=mysql_fetch_array($result);
							
							if(mysql_num_rows($result) > 0)
								@unlink('../' . $contenido[$i][9] . '/'.$row[$contenido[$i][0]]);
						}
					}	
					// Borramos el registro
					$vsql="delete from ".$tabla;
					$vsql.=" where ".$indice;
					if ($ptipoindice=="s"){
						$vsql .= " = '".@$_REQUEST[$indice]."'";
					} else {
						$vsql .= " = ".@$_REQUEST[$indice];
					}
					mysql_query($vsql,$db);
					post(array("site","action","ok"),array(@$_REQUEST["site"],"update","true"));
				}			
			} else {
				crearformulario($tabla,$indice,$contenido,$titulo,$action,$tipoindice,$site,@$_REQUEST["ok"],$size);
			}
		}
	}
?>