<?
	$global_ayuda = "";
	$global_ayuda_texto = "";

	function crearconsulta($psql,$ptree,$ptitle,$paction,$psite,$pindex,$ppaginacion){
		// Listados
		if($paction=="listado") {
			print "<div class=\"esta\">Est&aacute; en: <strong>".$ptitle." / ".$paccion." Listados ".$ptitle."</strong></div>";
			print "<div id=\"contenido\">";
		
			print "<div>Listado Excel de ".$ptitle."<br>";
			print "</div>";
			
			if (@$merror!=""){
				print "<div class=\"ok\">".@$merror."</div>";
			}
			print("<form id=\"formu\" method=\"post\" action=\"excel/".strtolower(str_replace(" ","",$ptitle)).".php\" enctype=\"multipart/form-data\" />");
			print("<input type=\"hidden\" name=\"accion\" value=\"guardar\" />");
			print("<input type=\"hidden\" name=\"action\" value=\"custom\" />");
			print("<script type=\"text/javascript\">");
			print("function enviar(){");
			print("document.getElementById('formu').submit();");
			print("}");
			print("</script>");
			print("<div class=\"fondointro\"><input type=\"button\" name=\"Submit\" onclick=\"javascript:enviar();\" value=\"Consultar\" /></div>");
			print("</form>");
			print("</div>");
		}
		else {
			// Contenidos de árbol: volvemos al mismo
			if($pindex=="nodo") print "<script type=\"text/javascript\">window.location = \"index.php?site=arbol&accion=".$psite."&action=".$_REQUEST["action"]."\"</script>";

			if ($paction=="insert") $paccion = "insertar";
			if ($paction=="update") $paccion = "modificar";
			if ($paction=="delete") $paccion = "eliminar";
			if ($paction=="") $paccion = "consultar";
			print "<div class=\"esta\">Est&aacute; en: <strong>".$ptitle." / ".ucwords($paccion)." ".$ptitle."</strong></div>";
			print "<div id=\"contenido\" style=\"font-weight:normal\">";
?>
			<div class="filtro">
                <form id="formubusqueda" method="post" action="index.php?site=<? echo $psite ?>&action=<? echo $paction ?>">
				<strong>Filtro:</strong> 
                <select name="filtro">
<?			if($_REQUEST["limpiar"]) $_REQUEST["filtro"]="";
			for ($i=0;$i<sizeof($ptree);$i++){ ?>
                	<option value="<? echo $ptree[$i][0] ?>"<? if($_REQUEST["filtro"] == $ptree[$i][0]) { ?> selected="selected"<? } ?>><? echo $ptree[$i][1] ?></option>					
<?			}
?>
                </select>
                <input type="text" name="textofiltro" value="<? if(($_REQUEST["textofiltro"]) && ($_REQUEST["buscar"])) { echo $_REQUEST["textofiltro"]; } else { echo ""; } ?>" style="width:170px" />
                <input type="submit" name="buscar" value="Buscar" />
                <input type="submit" name="limpiar" value="Limpiar" />
                </form>
			</div>
<?			
			print "<div style=\"margin:5px 0px 10px 0px;font-weight:normal\">Pulse sobre el registro que desee <strong>".$paccion."</strong>:</div>";
			print "<div class=\"encab\">";
			for ($i=0;$i<sizeof($ptree);$i++){ ?>
				<div class="encab<? echo sizeof($ptree) ?>">
                	<div style="float:left"><? echo $ptree[$i][1] ?>&nbsp;</div>
                    <div style="float:left;width:10px;margin-top:2px">				
                        <div class="flecha4"<? if(($_REQUEST["asc"]) && ($_REQUEST["asc"] == $ptree[$i][0])) { ?> id="activa"<? } ?>><a href="index.php?site=<? echo $psite ?>&action=<? echo $paction ?>&asc=<? echo $ptree[$i][0] ?><? if($_REQUEST["buscar"]) { ?>&buscar=true&filtro=<? echo $_REQUEST["filtro"]; ?>&textofiltro=<? echo $_REQUEST["textofiltro"]; } ?>" title="Orden ascendente"><img src="images/sizer.gif" alt="" width="4" height="2" /></a></div>
                        <div class="flecha3"<? if(($_REQUEST["asc"]) && ($_REQUEST["asc"] == $ptree[$i][0])) { ?> id="activa"<? } ?>><a href="index.php?site=<? echo $psite ?>&action=<? echo $paction ?>&asc=<? echo $ptree[$i][0] ?><? if($_REQUEST["buscar"]) { ?>&buscar=true&filtro=<? echo $_REQUEST["filtro"]; ?>&textofiltro=<? echo $_REQUEST["textofiltro"]; } ?>" title="Orden ascendente"><img src="images/sizer.gif" alt="" width="6" height="2" /></a></div>
                        <div class="flecha2"<? if(($_REQUEST["asc"]) && ($_REQUEST["asc"] == $ptree[$i][0])) { ?> id="activa"<? } ?>><a href="index.php?site=<? echo $psite ?>&action=<? echo $paction ?>&asc=<? echo $ptree[$i][0] ?><? if($_REQUEST["buscar"]) { ?>&buscar=true&filtro=<? echo $_REQUEST["filtro"]; ?>&textofiltro=<? echo $_REQUEST["textofiltro"]; } ?>" title="Orden ascendente"><img src="images/sizer.gif" alt="" width="8" height="2" /></a></div>
                        <div class="flecha1"<? if(($_REQUEST["asc"]) && ($_REQUEST["asc"] == $ptree[$i][0])) { ?> id="activa"<? } ?>><a href="index.php?site=<? echo $psite ?>&action=<? echo $paction ?>&asc=<? echo $ptree[$i][0] ?><? if($_REQUEST["buscar"]) { ?>&buscar=true&filtro=<? echo $_REQUEST["filtro"]; ?>&textofiltro=<? echo $_REQUEST["textofiltro"]; } ?>" title="Orden ascendente"><img src="images/sizer.gif" alt="" width="10" height="2" /></a></div>
                    </div>
                    <div style="float:left;width:10px;margin-top:2px">				
                        <div class="flecha1"<? if(($_REQUEST["desc"]) && ($_REQUEST["desc"] == $ptree[$i][0])) { ?> id="activa"<? } ?>><a href="index.php?site=<? echo $psite ?>&action=<? echo $paction ?>&desc=<? echo $ptree[$i][0] ?><? if($_REQUEST["buscar"]) { ?>&buscar=true&filtro=<? echo $_REQUEST["filtro"]; ?>&textofiltro=<? echo $_REQUEST["textofiltro"]; } ?>" title="Orden descendente"><img src="images/sizer.gif" alt="" width="10" height="2" /></a></div>
                        <div class="flecha2"<? if(($_REQUEST["desc"]) && ($_REQUEST["desc"] == $ptree[$i][0])) { ?> id="activa"<? } ?>><a href="index.php?site=<? echo $psite ?>&action=<? echo $paction ?>&desc=<? echo $ptree[$i][0] ?><? if($_REQUEST["buscar"]) { ?>&buscar=true&filtro=<? echo $_REQUEST["filtro"]; ?>&textofiltro=<? echo $_REQUEST["textofiltro"]; } ?>" title="Orden descendente"><img src="images/sizer.gif" alt="" width="8" height="2" /></a></div>
                        <div class="flecha3"<? if(($_REQUEST["desc"]) && ($_REQUEST["desc"] == $ptree[$i][0])) { ?> id="activa"<? } ?>><a href="index.php?site=<? echo $psite ?>&action=<? echo $paction ?>&desc=<? echo $ptree[$i][0] ?><? if($_REQUEST["buscar"]) { ?>&buscar=true&filtro=<? echo $_REQUEST["filtro"]; ?>&textofiltro=<? echo $_REQUEST["textofiltro"]; } ?>" title="Orden descendente"><img src="images/sizer.gif" alt="" width="6" height="2" /></a></div>
                        <div class="flecha4"<? if(($_REQUEST["desc"]) && ($_REQUEST["desc"] == $ptree[$i][0])) { ?> id="activa"<? } ?>><a href="index.php?site=<? echo $psite ?>&action=<? echo $paction ?>&desc=<? echo $ptree[$i][0] ?><? if($_REQUEST["buscar"]) { ?>&buscar=true&filtro=<? echo $_REQUEST["filtro"]; ?>&textofiltro=<? echo $_REQUEST["textofiltro"]; } ?>" title="Orden descendente"><img src="images/sizer.gif" alt="" width="4" height="2" /></a></div>
                    </div>
					<br class="sep" />
				</div>
<?			}
			print "<br class=\"sep\" />";
			print "</div>";
			
			// Ordenación ascendente/descendente
			if($_REQUEST["asc"]) {
				if(strpos($psql, "order by") > -1)
					$psql = substr($psql, 0, strpos($psql, "order by"));
				$psql .= " order by ".$_REQUEST["asc"]." asc";
			}
			if($_REQUEST["desc"]) {
				if(strpos($psql, "order by") > -1)
					$psql = substr($psql, 0, strpos($psql, "order by"));
				$psql .= " order by ".$_REQUEST["desc"]." desc";
			}

			// Comprobamos si hay algún filtro de búsqueda o de limpia
			if(isset($_REQUEST["buscar"]))
				if($_REQUEST["textofiltro"]) {
					if(strpos($psql, "order by") > -1)
						// Comprobamos si es fecha
						$date_format = 'd-m-Y';
						$input = trim($_REQUEST["textofiltro"]);
						$time = strtotime($input);			
						$is_valid = date($date_format, $time) == $input;
						if($is_valid) $campobusqueda = date("Y-m-d", strtotime($_REQUEST["textofiltro"]));
						else $campobusqueda = $_REQUEST["textofiltro"];
						// Introducimos la búsqueda
						$psql1 = substr($psql, 0, strpos($psql, "order by"));
						if($psql1 == "") $psql1=$psql;
						if(strpos($psql, "where") > 0)
							$psql2 = " and ".$_REQUEST["filtro"]." like '%".$campobusqueda."%' ";
						else
							$psql2 = " where ".$_REQUEST["filtro"]." like '%".$campobusqueda."%' ";
						if(strpos($psql, "order by") != "")
							$psql3 = substr($psql, strpos($psql, "order by"), strlen($psql));
						$psql = $psql1.$psql2.$psql3;
				}

			// Realizamos la consulta
			$rs = mysql_query($psql);
			$num_rows = @mysql_num_rows($rs);			
			$tamPag = $ppaginacion;
			$numeroRegistros = $num_rows;		

			if (@mysql_num_rows($rs)==0){
				// Código para modificar (M) cuando aún no se ha insertado ninguno
				if(!isset($_REQUEST["buscar"])) print "<div style=\"margin:5px 0px 0px 6px\">A&uacute;n no se ha a&ntilde;adido ning&uacute;n registro. <a href=\"index.php?site=".$psite."&action=insert&".$pindex."=1\" style=\"text-decoration:underline\">Pulse aqu&iacute; para a&ntilde;adir</a></div>";
				else print "<div style=\"margin:5px 0px 0px 6px;color:#FF0000;font-weight:bold\">No se han encontrado registros con los parámetros de búsqueda indicados</div>";
			} else {
				if(!isset($_GET["pagina"])) { 
					$pagina=1; 
					$inicio=1; 
					$final=$tamPag; 
				}else{ 
					   $pagina = $_GET["pagina"]; 
					} 
					//calculo del limite inferior 
					$limitInf=($pagina-1)*$tamPag; 
				
					//calculo del numero de paginas 
					$numPags=ceil($numeroRegistros/$tamPag); 
					if(!isset($pagina)) 
					{ 
					   $pagina=1; 
					   $inicio=1; 
					   $final=$tamPag; 
					}else{ 
					   $seccionActual=intval(($pagina-1)/$tamPag); 
					   $inicio=($seccionActual*$tamPag)+1; 
					   if($pagina<$numPags) { 
						  $final=$inicio+$tamPag-1; 
					   }else{ 
						  $final=$numPags; 
					   } 
					   if ($final>$numPags){ 
						  $final=$numPags; 
					   } 
					} 
				
				$psql .= " LIMIT ".$limitInf.",".$tamPag;
				$rs = mysql_query($psql);
	
				$n = 0;
				$col=0;
				while($row=mysql_fetch_array($rs)) {		
					$n++;
					$col++;
					if($psite == "tareas") {
						if($row["finalizado"] == 1) {
							$colorcelda = array ("#86cd7d","#86cd7d");
							print "<div class=\"fila\" style=\"background-color:". $colorcelda[0]."\"><a href=\"index.php?site=".$psite."&action=".$paction."&".$pindex."=".$row[$pindex]."&pagina=".$_REQUEST["pagina"]."\" style=\"color:#000000\">";
						}
						else if(($row["finalizado"] == 0) && ($row["fechafin"] < date("Y-m-d"))) {
							$colorcelda = array ("#ff7e7e","#ff7e7e");
							print "<div class=\"fila\" style=\"background-color:". $colorcelda[0]."\"><a href=\"index.php?site=".$psite."&action=".$paction."&".$pindex."=".$row[$pindex]."&pagina=".$_REQUEST["pagina"]."\" style=\"color:#000000\">";
						}
						else {
							$colorcelda = array ("#E6E6E6","FFFFFF");
							print "<div class=\"fila\" style=\"background-color:". $colorcelda[(($n+1)%2)-1]."\"><a href=\"index.php?site=".$psite."&action=".$paction."&".$pindex."=".$row[$pindex]."&pagina=".$_REQUEST["pagina"]."\" style=\"color:#000000\">";
						}
					}
					else {
						$colorcelda = array ("#E6E6E6","FFFFFF");
						print "<div class=\"fila\" style=\"background-color:". $colorcelda[(($n+1)%2)-1]."\"><a href=\"index.php?site=".$psite."&action=".$paction."&".$pindex."=".$row[$pindex]."&pagina=".$_REQUEST["pagina"]."\">";
					}
					for ($i=0;$i<sizeof($ptree);$i++){
						// Código para mostrar fecha en formato español
						if (preg_match("/^(\d){4}\-(\d){2}\-(\d){2}$/", $row[$ptree[$i][0]])) {
							$d = explode("-", $row[$ptree[$i][0]]);
							$row[$ptree[$i][0]]=$d[2]."-". $d[1]."-".$d[0];
						}
						if($i==0) {
							print "<div class=\"col".sizeof($ptree)."\">";
							print "<div class=\"flecha1\"><img src=\"images/sizer.gif\" alt=\"\" width=\"1\" height=\"5\" /></div>";
							print "<div class=\"flecha2\"><img src=\"images/sizer.gif\" alt=\"\" width=\"1\" height=\"3\" /></div>";
							print "<div class=\"flecha3\"><img src=\"images/sizer.gif\" alt=\"\" width=\"1\" height=\"1\" /></div>";
							if((strpos($row[$ptree[$i][0]],".jpg")) || (strpos($row[$ptree[$i][0]],".gif")) || (strpos($row[$ptree[$i][0]],".png")) || (strpos($row[$ptree[$i][0]],".jpeg")) || (strpos($row[$ptree[$i][0]],".JPG")) || (strpos($row[$ptree[$i][0]],".GIF")) || (strpos($row[$ptree[$i][0]],".PNG")) || (strpos($row[$ptree[$i][0]],".JPEG")))
								if($psite == "revistaazar") print "<div class=\"subcol".sizeof($ptree)."\"><img src=\"../revista-azar/".$row[$ptree[$i][0]]."\" style=\"max-height:90px\" \></div>";
								else if($psite == "albumes") print "<div class=\"subcol".sizeof($ptree)."\"><img src=\"../fotos/albumes/portada/".$row[$ptree[$i][0]]."\" style=\"max-height:90px\" \></div>";
								else if($psite == "fotosalbumes") print "<div class=\"subcol".sizeof($ptree)."\"><img src=\"../fotos/albumes/mini/".$row[$ptree[$i][0]]."\" style=\"max-height:90px\" \></div>";								
								else print "<div class=\"subcol".sizeof($ptree)."\"><img src=\"../fotos/".$row[$ptree[$i][0]]."\" style=\"max-height:90px\" \></div>";
							else if(strpos($row[$ptree[$i][0]],".swf")) {
								print "<div class=\"subcol".sizeof($ptree)."\">";
								list($ancho, $altura, $tipo, $atr) = getimagesize("../fotos/".$row[$ptree[$i][0]]);
								if($ancho > 160) { $ancho = "160"; $redimension = 1; }
								print "<object width=\"".$ancho."\" height=\"".$altura."\" data=\"../fotos/".$row[$ptree[$i][0]]."\" type=\"application/x-shockwave-flash\" id=\"testmovie\"><param value=\"../fotos/".$row[$ptree[$i][0]]."\" name=\"movie\" /></object>";
								print "</div>";								
							}
							else
								print "<div class=\"subcol".sizeof($ptree)."\">".$row[$ptree[$i][0]]."</div>";
							print "<br class=\"sep\" />";
							print "</div>";
						}
						else {
							print "<div class=\"col".sizeof($ptree)."\" style=\"background-image:none\">".strip_tags($row[$ptree[$i][0]])."</div>";
						}
					}
					print "<br class=\"sep\" />";
					print "</a></div>";
					if ($col==3) $col=-1;
				}	
				
				print "<div class=\"encab\">";
				print "<div class=\"ant\">";
				if($pagina>1){ 
				   print "<a href='".$_SERVER["PHP_SELF"]."?site=".$psite."&action=".$paction."&pagina=".($pagina-1)."'>Anterior</a>"; 
				} 
				print "</div>";
				print "<div class=\"act\">";
				for($i=$inicio;$i<=$final;$i++){ 
				   if($i==$pagina){ 
					  print "<span class=\"pag\">".$i."&nbsp;</span>"; 
				   }else{ 
					  print "<a href='".$_SERVER["PHP_SELF"]."?site=".$psite."&action=".$paction."&pagina=".$i."'>".$i."</a> "; 
				   } 
				} 
				print "</div>";
				print "<div class=\"sig\">";
				if($pagina<$numPags){ 
					print "<a class='p' href='".$_SERVER["PHP_SELF"]."?site=".$psite."&action=".$paction."&pagina=".($pagina+1)."'>Siguiente</a>"; 
				} 
				print "</div>";
				print "<br class=\"sep\" \>";
				print "</div>";
					
			}
			print("</div>");
			@mysql_free_result($rs);
		}
	}
	
	
	function crearformulario($ptable,$pindex,$ptree,$ptitle,$paction,$pindextype,$psite,$pok,$size){
/*
		PARA EL CONTENIDO
		array("field","fieldtype","formtype","label","mandatory","selectsql","selectfield", "readonly", "submit", "path", "len", "ayuda", "size")

	 	0-  field: nombre del campo de la tabla
	 	1-  fieldtype: s:string, n:number, d:datetime, f:float, do:double
	 	2-  formtype: i:input, s:select, f:file, t:textarea, c:checkbox, h:hidden, x:html, d:datetime, fck:fckeditor, n:nodo, cp:color picker, m:multi select
	 	3-  label: etiqueta que verá el usuario para el campo
	 	4-  mandatory: * para requerido, y blanco para no requerido
	 	5-  selectsql: si formtype es s:select escriba la consulta que traera los datos para el select en (formato: "select * from tabla where campo=campo)
	 	6-  selectfield: si formtype es s:select escriba el nombre del campo de la consulta de selectsql que verá el usuario
	 	7-  readonly: * para readonly, y blanco para habilitado
	 	8-  submit: * si este campo necesita enviarse cuando cambie porque otro campo depende de él (EJEMPLOS CORRECTOS: (select * from tabla1 t1, tabla2 t2 where t1.campo=t2.campo and t1.campo=campo order by t1.campo) o (select * from tabla where campo=campo)
	 	9-  path: si formtype es f:file escriba la carpeta donde se guardaran los ficheros
		10- len: maximo de dato permitido
		11- ayuda: ayuda para la caja de ayuda
		12- size: si estamos introduciendo una imagen para redimensionar, las medidas de la misma (en formato 100x100 para reescalado a MAXIMOS o 100X100 para reescalado EXACTO)

	 	array("","","","","","","","","","","","","");
*/
		// Inicializamos los color picker a vacío
		$cp="false";

		// unknown: debemos determinar si hay que introducir nuevo, modificar o custom
		if ($paction=="insertupdate") {
			$vsql="select * from ".$ptable." where nodo =".$_REQUEST["nodo"];
			$result=mysql_query($vsql);
			if(mysql_num_rows($result)>0) $paction="update";
			else $paction="insert";
		}
	
		if ($paction=="insert") $paccion = "A&ntilde;adir";
		if ($paction=="update") $paccion = "Modificar";
		if ($paction=="delete") $paccion = "Eliminar";
		if ($paction=="") $paccion = "Consultar";	
		$rows = false;
		$js = "";
		$help = "";
		
		if (($paction!="")&&($paction!="insert")&&($pok!="submit")){
			$vsql = "select * from ".$ptable." where ".$pindex;
			if ($pindextype=="s"){
				$vsql .= " = '".@$_REQUEST[$pindex]."'";
			} else {
				$vsql .= " = ".@$_REQUEST[$pindex];
			}
			$rs = mysql_query($vsql);	
			if (mysql_num_rows($rs)>0){ 
				$rows = true;
				$row = mysql_fetch_array($rs);
			}
		}
		print "<div class=\"esta\">Est&aacute; en: <strong>".$ptitle." / ".$paccion." ".$ptitle."</strong></div>";
		print "<div id=\"contenido\">";
		print "<div class=\"info\">Campo obligatorio <img src=\"images/obligatorio.gif\" alt=\"\" /><br />Campo opcional <img src=\"images/opcional.gif\" alt=\"\" /></div>";

		if (($pok!="")&&($pok!="submit")){
			print "<div class=\"ok\">Los datos han sido guardados</div>";
		}
		
		$tipoform = "";
		for ($i=0;$i<sizeof($ptree);$i++){
			if ($ptree[$i][9]!=""){
				$tipoform = " enctype=\"multipart/form-data\" ";
			}
		}
		print "<form id=\"formu\" method=\"post\" action=\"index.php\" ".$tipoform.">";
		print "<input type=\"hidden\" name=\"accion\" value=\"guardar\" />";
		print "<input type=\"hidden\" name=\"pagina\" value=\"".$_REQUEST["pagina"]."\" />";
		print "<input type=\"hidden\" name=\"action\" value=\"".$paction."\" />";
		print "<input type=\"hidden\" name=\"site\" value=\"".$psite."\" />";
		print "<input type=\"hidden\" name=\"idimg\" value=\"\" />";
		print "<input type=\"hidden\" name=\"fieldimg\" value=\"\" />";
		print("<input type=\"hidden\" name=\"submitchange\" value=\"\" />");
		
		for ($i=0;$i<sizeof($ptree);$i++){
			$ivalor="";
			$imaxlen="";
			$idis="";
			if (($paction!="") && ($pok!="submit") && $rows){
				$ivalor = $row[$ptree[$i][0]];
			}
			else {
				if ($pok!="submit") {
					// Añadido especial para código de producto
					if($ptree[$i][6] == "codigo") {
						$sql_codigoproducto = mysql_query("SELECT MAX(p.idproductoventa) as maxidproducto, c.precodigo as precodigo FROM productosventa p, categorias c WHERE c.idcategoria=p.idcategoria");
						$row_codigoproducto = mysql_fetch_array($sql_codigoproducto);
						$codigoproducto =  $row_codigoproducto["precodigo"].str_pad($row_codigoproducto["maxidproducto"]+1, 6, "0", STR_PAD_LEFT);
						$ivalor = $codigoproducto;
					}
					else
						$ivalor = @$_REQUEST[$ptree[$i][0]];
				}
				else {
					// Añadido especial para código de producto
					if($ptree[$i][6] == "codigo") {
						$sql_codigoproducto = mysql_query("SELECT MAX(p.idproductoventa) as maxidproducto, c.precodigo as precodigo FROM productosventa p, categorias c WHERE c.idcategoria=p.idcategoria");
						$row_codigoproducto = mysql_fetch_array($sql_codigoproducto);
						$codigoproducto =  $row_codigoproducto["precodigo"].str_pad($row_codigoproducto["maxidproducto"]+1, 6, "0", STR_PAD_LEFT);
						$ivalor = $codigoproducto;
					}
					else					
						$ivalor = @$_REQUEST[$ptree[$i][0]];
				}
			}

			// node 
			if ($ptree[$i][2]=="n"){
				print "<input type=\"hidden\" name=\"".$ptree[$i][0]."\" size=\"60\" value=\"".$_GET[$ptree[$i][0]]."\"".$imaxlen.$idis." /><div class=\"sep\"><img src=\"images/sizer.gif\" alt=\"\" /></div>";
			}

			// hidden 
			if ($ptree[$i][2]=="h"){
				print "<input type=\"hidden\" name=\"".$ptree[$i][0]."\" size=\"60\" value=\"".$ivalor."\"".$imaxlen.$idis." /><div class=\"sep\"><img src=\"images/sizer.gif\" alt=\"\" /></div>";
			}

			// input 
			if ($ptree[$i][2]=="i"){
				if ($ptree[$i][4]==""){
					print "<p>";
				} else { 
					print "<p class=\"obligatorio\">";
				}
				print $ptree[$i][3].":</p>";
				if ($ptree[$i][11]!=""){
					print "<p class=\"ayuda\"><a tabindex=\"100\" href=\"javascript:ayuda(".($i+1) .")\"><img src=\"images/ayuda.gif\" alt=\"Ayuda\" /></a></p>";
				}
				if ($ptree[$i][10]!=""){
					$imaxlen=" maxlength=\"".$ptree[$i][10]."\" ";
				}
				if ($ptree[$i][7]!=""){
					$idis=" DISABLED ";
				}
				// Si es de tipo número, hay que comprobar que sólo introducimos números y puntos
				if($ptree[$i][1] == "n") print "<input type=\"text\" name=\"".$ptree[$i][0]."\" style=\"width:540px\" value=\"".$ivalor."\"".$imaxlen.$idis." onkeypress=\"return justNumbers(event)\" /><div class=\"seppuntos\"><img src=\"images/sizer.gif\" alt=\"\" /></div>";
				else if(($ptree[$i][1] == "f") ||($ptree[$i][1] == "do")) print "<input type=\"text\" name=\"".$ptree[$i][0]."\" style=\"width:540px\" value=\"".$ivalor."\"".$imaxlen.$idis." onkeypress=\"return justDecimalNumbers(event)\" /><div class=\"seppuntos\"><img src=\"images/sizer.gif\" alt=\"\" /></div>";
				else print "<input type=\"text\" name=\"".$ptree[$i][0]."\" style=\"width:540px\" value=\"".htmlspecialchars($ivalor, ENT_QUOTES, "ISO-8859-1")."\"".$imaxlen.$idis." /><div class=\"seppuntos\"><img src=\"images/sizer.gif\" alt=\"\" /></div>";
			}
			
			// textarea
			if ($ptree[$i][2]=="t"){
				if ($ptree[$i][4]==""){
					print "<p>";
				} else { 
					print "<p class=\"obligatorio\">";
				}
				print $ptree[$i][3].":</p>";
				if ($ptree[$i][11]!=""){
					print "<p class=\"ayuda\"><a tabindex=\"100\" href=\"javascript:ayuda(".($i+1) .")\"><img src=\"images/ayuda.gif\" alt=\"Ayuda\" /></a></p>";
				}
				if ($ptree[$i][10]!=""){
					$imaxlen=" maxlength=\"".$ptree[$i][10]."\" ";
				}
				if ($ptree[$i][7]!=""){
					$idis=" DISABLED ";
				}
				print "<textarea name=\"".$ptree[$i][0]."\">".$ivalor."</textarea><div class=\"seppuntos\"><img src=\"images/sizer.gif\" alt=\"\" /></div>";
			}

			// file
			if ($ptree[$i][2]=="f"){
				if ($ptree[$i][4]==""){
					print "<p>";
				} else { 
					print "<p class=\"obligatorio\">";
				}
				print $ptree[$i][3].":</p>";
				if ($ivalor==""){
					if ($ptree[$i][11]!=""){
						print "<p class=\"ayuda\"><a tabindex=\"100\" href=\"javascript:ayuda(".($i+1) .")\"><img src=\"images/ayuda.gif\" alt=\"Ayuda\" /></a></p>";
					}
					if ($ptree[$i][10]!=""){
						$imaxlen=" maxlength=\"".$ptree[$i][10]."\" ";
					}
					if ($ptree[$i][7]!=""){
						$idis=" DISABLED ";
					}
					print "<input type=\"file\" name=\"".$ptree[$i][0]."\" size=\"92\" />";
				}else{					
					//print "<input type=\"hidden\" name=\"".$ptree[$i][0]."\" value=\"".$ivalor."\" />";
					print "<input type=\"file\" name=\"".$ptree[$i][0]."\" size=\"92\" />";
					print "<div class=\"imagen\">";
					$ext = explode('.',$ivalor);
					$ext = $ext[count($ext)-1];
					$temp_filename = time().".".$ext;					
					// Tratamiento para PNG, GIF Y JPEG
					if(preg_match('/^(png|gif|jpe?g)$/',$ext)) {
						print "<a href=\"../".$ptree[$i][9]."/".$ivalor."\" rel=\"lightbox\" title=\"Imagen reducida. Pulse para ver a tamaño real\"><img src=\"../".$ptree[$i][9]."/".$ivalor."?x=".uniqid((double)microtime()*1000000,1)."\" id=\"imagen\" alt=\"Imagen reducida. Pulse para ver tamaño real\" width=\"100\" /></a>";
						if($ptree[$i][4] != "*") print "<div class=\"pie\"><a href=\"javascript:eliminar_".$ptree[$i][0]."('".$ivalor."')\"><img src=\"images/eliminar2.gif\" alt=\"Eliminar imagen\" /></a></div>";
					} else {
						// Tratamiento para SWF
						if(preg_match('/^(swf)$/',$ext)) {
							list($ancho, $altura, $tipo, $atr) = getimagesize("../".$ptree[$i][9]."/".$ivalor);
							if($ancho > 525) { $ancho = "525"; $redimension = 1; }
							print "<object width=\"".$ancho."\" height=\"".$altura."\" data=\"../".$ptree[$i][9]."/".$ivalor."\" type=\"application/x-shockwave-flash\" id=\"testmovie\"><param value=\"../".$ptree[$i][9]."/".$ivalor."\" name=\"movie\" /></object>";
							if($ptree[$i][4] != "*") print "<div class=\"pie\"><a href=\"javascript:eliminar_".$ptree[$i][0]."('".$ivalor."')\"><img src=\"images/eliminar2.gif\" alt=\"Eliminar animaci&oacute;n flash\" /></a></div>";
							if($redimension == 1) print "<div class=\"pie\">Tamaño reducido para visualizaci&oacute;n</div>";
						} else {
						// Fichero general
							print "<a href=\"../".$ptree[$i][9]."/".$ivalor."\" target=\"_blank\">".$ivalor."</a><br /><br />";							
							if($ptree[$i][4] != "*") print "<div class=\"pie\"><a href=\"javascript:eliminar_".$ptree[$i][0]."('".$ivalor."')\"><img src=\"images/eliminar2.gif\" alt=\"Eliminar fichero\" /></a></div>";
						}
					}
					print "</div>";
					print "<script type=\"text/javascript\">";
					print "function eliminar_".$ptree[$i][0]."(pid) {";
					print "document.getElementById('formu').accion.value=\"deleteimg\"; ";
					print "document.getElementById('formu').idimg.value=pid; ";
					print "document.getElementById('formu').fieldimg.value=\"".$ptree[$i][0]."\"; ";
					print "document.getElementById('formu').submit(); ";
					print "} ";
					print "</script>";
				}
				print "<div class=\"seppuntos\"><img src=\"images/sizer.gif\" alt=\"\" /></div>";
			}

			// select
			if ($ptree[$i][2]=="s"){
				if ($ptree[$i][4]==""){
					print "<p>";
				} else { 
					print "<p class=\"obligatorio\">";
				}
				print $ptree[$i][3].":</p>";
				if ($ptree[$i][11]!=""){
					print "<p class=\"ayuda\"><a tabindex=\"100\" href=\"javascript:ayuda(".($i+1) .")\"><img src=\"images/ayuda.gif\" alt=\"Ayuda\" /></a></p>";
				}
				
				print "<select name=\"".$ptree[$i][0]."\" ";
				
				// submit value
				if ($ptree[$i][8]!=""){
					print " onchange=\"javascript:submit_".$ptree[$i][0]."();\" ";
				}
				if (($ptree[$i][0] == "identidad") || ($ptree[$i][0] == "identidad2")){
					print " onchange=\"javascript:muestraevento();\" ";
				}	
				print ">";
				print "<option value=\"-1\">--Seleccione--</option>";
				
				// Hacemos consulta con "_REQUEST" si venimos o no de recargar el combo o con "row" si estamos haciendo una consulta
				if(substr($ptree[$i][5], 0, strrpos($ptree[$i][5], "where")) != "") {
					if(strpos($ptree[$i][5], "order by")) $orderby = substr($ptree[$i][5], strpos($ptree[$i][5], "order by"), strlen($ptree[$i][5])); else $orderby="";
					$ok = substr($ptree[$i][5], 0, strrpos($ptree[$i][5], "=")+1);
					$ok2 = substr($ok, strpos($ok, " "), strlen($ok2));
					$var = substr($ptree[$i][5], strrpos($ptree[$i][5], "=")+1, strlen($ptree[$i][5]));
					if(strpos($var, " ") > 0) $var = substr($var, 0, strpos($var, " "));	
					if((is_numeric($var)) || (strpos($var,")") > 0)) {
						$ptree[$i][5] = $ok.$var." ".$ok2." ".$orderby;
					} else {
						if(!(@$_REQUEST[$ptree[$i][0]])) $ptree[$i][5] = $ok.$row[$var]." ".$ok2." ".$orderby;
						else $ptree[$i][5] = $ok.$_REQUEST[$var]." ".$ok2." ".$orderby;
					}
				}				
				$rsselect = mysql_query($ptree[$i][5]);	
				if (mysql_num_rows($rsselect)>0){ 
					while($rowselect=mysql_fetch_array($rsselect)) {
						print "<option value=\"".$rowselect[$ptree[$i][0]]."\"";
						if ($ivalor==$rowselect[$ptree[$i][0]]){
							print " selected";
						}//idnoticia1
						if($ptree[$i][2] == "s") {
							$corte=substr(html_entity_decode(strip_tags($rowselect[$ptree[$i][6]])), 0, 70);
							if(strlen(substr(html_entity_decode(strip_tags($rowselect[$ptree[$i][6]])), 0, 70)) == 70) $corte=$corte."...";
							print ">".$corte."</option>";
						} else
							print ">".$rowselect[$ptree[$i][6]]."</option>";
					}
				}
				print "</select><div class=\"seppuntos\"><img src=\"images/sizer.gif\" alt=\"\" /></div>";
				
				// submit value
				if ($ptree[$i][8]!=""){
					print "<script type='text/javascript'>function submit_".$ptree[$i][0]."(){";
					print "document.getElementById('formu').submitchange.value='true';";
					print "document.getElementById('formu').submit();";
					print "}</script>";
				}
			}
			
			// datetime
			if ($ptree[$i][2]=="d"){
				if ($ptree[$i][4]==""){
					print "<p>";
				} else { 
					print "<p class=\"obligatorio\">";
				}
				print $ptree[$i][3].":</p>";
				if ($ptree[$i][11]!=""){
					print "<p class=\"ayuda\"><a tabindex=\"100\" href=\"javascript:ayuda(".($i+1) .")\"><img src=\"images/ayuda.gif\" alt=\"Ayuda\" /></a></p>";
				}				
?>				
				<script type="text/javascript" src="includes/calendar/calendarDateInput.js"></script>
<? 				if(($_REQUEST["action"]=="update") || ($_REQUEST["submitchange"] == "true")) { ?>
					<script type="text/javascript">DateInput('<? echo $ptree[$i][0] ?>', true, 'YYYY-MM-DD','<? echo $ivalor ?>')</script>
<?				} else { ?>
					<script type="text/javascript">DateInput('<? echo $ptree[$i][0] ?>', true, 'YYYY-MM-DD')</script>
<?				}			
				print "</select><div class=\"seppuntos\"><img src=\"images/sizer.gif\" alt=\"\" /></div>";
			}
			
			// ckfinder
			if ($ptree[$i][2]=="ckf"){
				$_SESSION['IsAuthorized'] = TRUE;
				
				if ($ptree[$i][4]==""){
					print "<p>";
				} else { 
					print "<p class=\"obligatorio\">";
				}
				print $ptree[$i][3].":</p>";
				if ($ptree[$i][11]!=""){
					print "<p class=\"ayuda\"><a tabindex=\"100\" href=\"javascript:ayuda(".($i+1) .")\"><img src=\"images/ayuda.gif\" alt=\"Ayuda\" /></a></p>";
				}
			?>
				<script type="text/javascript" src="includes/ckfinder/ckfinder.js"></script>
				<script type="text/javascript">
					function BrowseServer<? echo $ptree[$i][0]; ?>() {
						var finder = new CKFinder();
						finder.basePath = '/control/includes/ckfinder/';	// The path for the installation of CKFinder (default = "/ckfinder/").
						finder.selectActionFunction = SetFileField<? echo $ptree[$i][0]; ?>;
						finder.popup();
					}

					function SetFileField<? echo $ptree[$i][0]; ?>( fileUrl ) {
						document.getElementById( 'x<? echo $ptree[$i][0]; ?>' ).value = fileUrl.replace("/", "");
					}
				</script>
				<input id="x<? echo $ptree[$i][0]; ?>" name="<? echo $ptree[$i][0]; ?>" type="text" size="60" value="<? if( (($paction=="update") || ($paction=="delete")) && ($pok!="submit")) echo $row[$ptree[$i][0]]; ?>" />
				<input type="button" value="Browse Server" onclick="BrowseServer<? echo $ptree[$i][0]; ?>();" />
				<br class="sep" />
			<?
				if($ivalor != "") {
					print "<div class=\"imagen\">";
					$ext = explode('.',$ivalor);
					$ext = $ext[count($ext)-1];
					$temp_filename = time().".".$ext;					
					// Tratamiento para PNG, GIF Y JPEG
					if(preg_match('/^(png|gif|jpe?g)$/',$ext)) {
						print "<a href=\"../".$ptree[$i][9]."/".$ivalor."\" rel=\"lightbox\" title=\"Imagen reducida. Pulse para ver a tamaño real\"><img src=\"../".$ptree[$i][9]."/".$ivalor."?x=".uniqid((double)microtime()*1000000,1)."\" id=\"imagen\" alt=\"Imagen reducida. Pulse para ver tamaño real\" width=\"100\" /></a>";
					} else {
						// Tratamiento para SWF
						if(preg_match('/^(swf)$/',$ext)) {
							list($ancho, $altura, $tipo, $atr) = getimagesize("../".$ptree[$i][9]."/".$ivalor);
							print "<object width=\"".$ancho."\" height=\"".$altura."\" data=\"../".$ptree[$i][9]."/".$ivalor."\" type=\"application/x-shockwave-flash\" id=\"testmovie\"><param value=\"../".$ptree[$i][9]."/".$ivalor."\" name=\"movie\" /></object>";
						} else {
						// Fichero general
							print "<a href=\"../".$ptree[$i][9]."/".$ivalor."\" target=\"_blank\">".$ivalor."</a><br /><br />";
						}
					}
					print "</div>";
				}
				print "<div class=\"seppuntos\"><img src=\"images/sizer.gif\" alt=\"\" /></div>";
			}
			
			// ckeditor //Completa
			if ($ptree[$i][2]=="ck"){
				if ($ptree[$i][4]==""){
					print "<p>";
				} else { 
					print "<p class=\"obligatorio\">";
				}
				print $ptree[$i][3].":</p>";
				if ($ptree[$i][11]!=""){
					print "<p class=\"ayuda\"><a tabindex=\"100\" href=\"javascript:ayuda(".($i+1) .")\"><img src=\"images/ayuda.gif\" alt=\"Ayuda\" /></a></p>";
				}

				print "<div class=\"sep\"><img src=\"images/sizer.gif\" alt=\"\" /></div>";
				print "<script src=\"includes/ckeditor/ckeditor.js\"></script>";					
				print "<script src=\"includes/ckfinder/ckfinder.js\"></script>";					
				print "<textarea name=\"".$ptree[$i][0]."\" id=\"".$ptree[$i][0]."\" rows=\"10\" cols=\"80\">";
				if( (($paction=="update") || ($paction=="delete")) && ($pok!="submit")) echo $row[$ptree[$i][0]];
				else echo $_POST[$ptree[$i][0]];
				print "</textarea>
				<script>					
					CKEDITOR . replace (    '".$ptree[$i][0]."' ,   { 
						toolbar: [
							{ name: 'document', items : [ 'Source','-','Save','NewPage','DocProps','Preview','Print','-','Templates' ] },
							{ name: 'clipboard', items : [ 'Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo' ] },
							{ name: 'editing', items : [ 'Find','Replace','-','SelectAll','-','SpellChecker', 'Scayt' ] },
							{ name: 'forms', items : [ 'Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 
								'HiddenField' ] },
							'/',
							{ name: 'basicstyles', items : [ 'Bold','Italic','Underline','Strike','Subscript','Superscript','-','RemoveFormat' ] },
							{ name: 'insert', items : [ 'Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak','Iframe' ] },
							{ name: 'paragraph', items : [ 'NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote','CreateDiv',
							'-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','-','BidiLtr','BidiRtl' ] },
							{ name: 'links', items : [ 'Link','Unlink','Anchor' ] },
							
							'/',
							{ name: 'styles', items : [ 'Styles','Format','Font','FontSize' ] },
							{ name: 'colors', items : [ 'TextColor','BGColor' ] },
							{ name: 'tools', items : [ 'Maximize', 'ShowBlocks'] }
							],
						 filebrowserBrowseUrl   :   'includes/ckfinder/ckfinder.html' , 
						 filebrowserImageBrowseUrl   :   'includes/ckfinder/ckfinder.html?type=Images' , 
						 filebrowserFlashBrowseUrl   :   'includes/ckfinder/ckfinder.html?type=Flash' , 
						 filebrowserUploadUrl   :   'includes/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files' , 
						 filebrowserImageUploadUrl   :   'includes/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images' , 
						 filebrowserFlashUploadUrl   :   'includes/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash' 
					 } ) ; 
					 CKFinder . setupCKEditor (   null ,   'includes/ckfinder/'   ) ; 
				</script>";
				
				print "<div class=\"seppuntos\"><img src=\"images/sizer.gif\" alt=\"\" /></div>";
			}
			// ckeditor 2 //Standar
			if ($ptree[$i][2]=="ck2"){
				if ($ptree[$i][4]==""){
					print "<p>";
				} else { 
					print "<p class=\"obligatorio\">";
				}
				print $ptree[$i][3].":</p>";
				if ($ptree[$i][11]!=""){
					print "<p class=\"ayuda\"><a tabindex=\"100\" href=\"javascript:ayuda(".($i+1) .")\"><img src=\"images/ayuda.gif\" alt=\"Ayuda\" /></a></p>";
				}

				print "<div class=\"sep\"><img src=\"images/sizer.gif\" alt=\"\" /></div>";
				print "<script src=\"includes/ckeditor/ckeditor.js\"></script>";					
				print "<script src=\"includes/ckfinder/ckfinder.js\"></script>";					
				print "<textarea name=\"".$ptree[$i][0]."\" id=\"".$ptree[$i][0]."\" rows=\"10\" cols=\"80\">";
				if( (($paction=="update") || ($paction=="delete")) && ($pok!="submit")) echo $row[$ptree[$i][0]];
				else echo $_POST[$ptree[$i][0]];
				print "</textarea>
				<script>					
					CKEDITOR . replace (    '".$ptree[$i][0]."' ,   { 
						toolbar: [
							{ name: 'document', items : [ 'Source','-','Save','NewPage','DocProps','Preview','Print','-','Templates' ] },
							{ name: 'clipboard', items : [ 'Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo' ] },
							{ name: 'editing', items : [ 'Find','Replace','-','SelectAll','-','SpellChecker', 'Scayt' ] },
							{ name: 'basicstyles', items : [ 'Bold','Italic','Underline','Strike','Subscript','Superscript','-','RemoveFormat' ] },
							{ name: 'colors', items : [ 'TextColor','BGColor' ] },
							{ name: 'tools', items : [ 'Maximize', 'ShowBlocks' ] },
							{ name: 'paragraph', items : [ 'NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote',
							'-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'] },
							{ name: 'links', items : [ 'Link','Unlink','Anchor' ] },
							{ name: 'insert', items : [ 'Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak' ] },
							{ name: 'styles', items : [ 'Format','Font','FontSize' ] },
							],
						 filebrowserBrowseUrl   :   'includes/ckfinder/ckfinder.html' , 
						 filebrowserImageBrowseUrl   :   'includes/ckfinder/ckfinder.html?type=Images' , 
						 filebrowserFlashBrowseUrl   :   'includes/ckfinder/ckfinder.html?type=Flash' , 
						 filebrowserUploadUrl   :   'includes/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files' , 
						 filebrowserImageUploadUrl   :   'includes/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images' , 
						 filebrowserFlashUploadUrl   :   'includes/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash' 
					 } ) ; 
					 CKFinder . setupCKEditor (   null ,   'includes/ckfinder/'   ) ; 
					  
				</script>";
				
				print "<div class=\"seppuntos\"><img src=\"images/sizer.gif\" alt=\"\" /></div>";
			}
			// ckeditor 3 //Basica
			if ($ptree[$i][2]=="ck3"){
				if ($ptree[$i][4]==""){
					print "<p>";
				} else { 
					print "<p class=\"obligatorio\">";
				}
				print $ptree[$i][3].":</p>";
				if ($ptree[$i][11]!=""){
					print "<p class=\"ayuda\"><a tabindex=\"100\" href=\"javascript:ayuda(".($i+1) .")\"><img src=\"images/ayuda.gif\" alt=\"Ayuda\" /></a></p>";
				}

				print "<div class=\"sep\"><img src=\"images/sizer.gif\" alt=\"\" /></div>";
				print "<script src=\"includes/ckeditor/ckeditor.js\"></script>";					
				print "<script src=\"includes/ckfinder/ckfinder.js\"></script>";					
				print "<textarea name=\"".$ptree[$i][0]."\" id=\"".$ptree[$i][0]."\" rows=\"10\" cols=\"80\">";
				if( (($paction=="update") || ($paction=="delete")) && ($pok!="submit")) echo $row[$ptree[$i][0]];
				else echo $_POST[$ptree[$i][0]];
				print "</textarea>
				<script>					
					CKEDITOR . replace (    '".$ptree[$i][0]."' ,   { 
						toolbar: [
							{ name: 'basicstyles',
									items: [ 'Bold', 'Italic', 'Underline' ] },
							{ name: 'clipboard',
									groups: [ 'clipboard', 'undo' ],
									items: [ 'Cut', 'Copy', 'Paste', '-', 'Undo', 'Redo' ] },
							{ name: 'links',
								items: [ 'Link', 'Unlink' ] },
							{ name: 'styles',
									items : ['FontSize' ] },
							{ name: 'colors',
									items : [ 'TextColor','BGColor' ] },
							{ name: 'paragraph',
									items : [ 'NumberedList','BulletedList','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock' ] },
							],
						 filebrowserBrowseUrl   :   'includes/ckfinder/ckfinder.html' , 
						 filebrowserImageBrowseUrl   :   'includes/ckfinder/ckfinder.html?type=Images' , 
						 filebrowserFlashBrowseUrl   :   'includes/ckfinder/ckfinder.html?type=Flash' , 
						 filebrowserUploadUrl   :   'includes/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files' , 
						 filebrowserImageUploadUrl   :   'includes/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images' , 
						 filebrowserFlashUploadUrl   :   'includes/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash' 
					 } ) ; 
					 CKFinder . setupCKEditor (   null ,   'includes/ckfinder/'   ) ; 
					  
				</script>";
				
				print "<div class=\"seppuntos\"><img src=\"images/sizer.gif\" alt=\"\" /></div>";
			}
			
			// fckeditor
			if ($ptree[$i][2]=="fck"){
				include_once("includes/fckeditor/fckeditor.php") ;
				if ($ptree[$i][4]==""){
					print "<p>";
				} else { 
					print "<p class=\"obligatorio\">";
				}
				print $ptree[$i][3].":</p>";
				if ($ptree[$i][11]!=""){
					print "<p class=\"ayuda\"><a tabindex=\"100\" href=\"javascript:ayuda(".($i+1) .")\"><img src=\"images/ayuda.gif\" alt=\"Ayuda\" /></a></p>";
				}

				$oFCKeditor = new FCKeditor($ptree[$i][0]) ;
				$oFCKeditor->BasePath = 'includes/fckeditor/' ;
				if( (($paction=="update") || ($paction=="delete")) && ($pok!="submit")) $oFCKeditor->Value = $row[$ptree[$i][0]] ;
				else $oFCKeditor->Value = $_POST[$ptree[$i][0]] ;
				$oFCKeditor->ToolbarSet = 'Basico' ;
				$oFCKeditor->Create() ;	
				//$ptree[$i][0] = stripslashes( $_POST[$ptree[$i][0]] ) ;
				
				print "</select><div class=\"seppuntos\"><img src=\"images/sizer.gif\" alt=\"\" /></div>";
			}
			// fckeditor 2
			if ($ptree[$i][2]=="fck2"){
				include_once("includes/fckeditor/fckeditor.php") ;
				if ($ptree[$i][4]==""){
					print "<p>";
				} else { 
					print "<p class=\"obligatorio\">";
				}
				print $ptree[$i][3].":</p>";
				if ($ptree[$i][11]!=""){
					print "<p class=\"ayuda\"><a tabindex=\"100\" href=\"javascript:ayuda(".($i+1) .")\"><img src=\"images/ayuda.gif\" alt=\"Ayuda\" /></a></p>";
				}

				$oFCKeditor = new FCKeditor($ptree[$i][0]) ;
				$oFCKeditor->BasePath = 'includes/fckeditor/' ;
				if( (($paction=="update") || ($paction=="delete")) && ($pok!="submit")) $oFCKeditor->Value = $row[$ptree[$i][0]] ;
				else $oFCKeditor->Value = $_POST[$ptree[$i][0]] ;
				$oFCKeditor->ToolbarSet = 'Design' ;
				$oFCKeditor->Height = '500' ;
				$oFCKeditor->Create() ;	
				//$ptree[$i][0] = stripslashes( $_POST[$ptree[$i][0]] ) ;
				
				print "</select><div class=\"seppuntos\"><img src=\"images/sizer.gif\" alt=\"\" /></div>";
			}
			
			// timepicker
			if ($ptree[$i][2]=="tp"){
				echo"<style>
					.table_list {border-collapse:collapse; border:solid #cccccc 1px; width:100%;}
					.table_list td {padding:5px; border:solid #efefef 1px;}
					.table_list th {background:#75b2d1; padding:5px; color:#ffffff;}
					.table_list tr.odd {background:#e1eff5;}
					.time_picker_div {padding:5px; border:solid #999999 1px; background:#ffffff;}
				</style>";
				print "<script type=\"text/javascript\" src=\"includes/timepicker/mootools.v1.11.js\"></script>";
				print "<script type=\"text/javascript\" src=\"includes/timepicker/nogray_time_picker_min.js\"></script>";
				print "<script type=\"text/javascript\">
					window.addEvent(\"domready\", function (){";
						if($paction=="update") print "var tp".$i." = new TimePicker('time".$i."_picker', '".$ptree[$i][0]."', 'time".$i."_toggler', {format24:true, startTime:{hour:".substr($row[$ptree[$i][0]], 0, 2).", minute:".substr($row[$ptree[$i][0]], 3, 2)."}})";
						else print "var tp".$i." = new TimePicker('time".$i."_picker', '".$ptree[$i][0]."', 'time".$i."_toggler', {format24:true})";
				print "})";
				print "</script>";
				if ($ptree[$i][4]==""){
					print "<p>";
				} else { 
					print "<p class=\"obligatorio\">";
				}
				print $ptree[$i][3].":</p>";
				if ($ptree[$i][11]!=""){
					print "<p class=\"ayuda\"><a tabindex=\"100\" href=\"javascript:ayuda(".($i+1) .")\"><img src=\"images/ayuda.gif\" alt=\"Ayuda\" /></a></p>";
				}
				if($paction=="update") print "<input type=\"text\" name=\"".$ptree[$i][0]."\" id=\"".$ptree[$i][0]."\" value=".$ivalor." />";
				else print "<input type=\"text\" name=\"".$ptree[$i][0]."\" id=\"".$ptree[$i][0]."\" />";
				print "<div id=\"time".$i."_picker\" class=\"time_picker_div\"></div>";
				
				print "<div class=\"seppuntos\"><img src=\"images/sizer.gif\" alt=\"\" /></div>";
			}
			
			// color picker
			if ($ptree[$i][2]=="cp"){
				$cp="true";
				if ($ptree[$i][4]==""){
					print "<p>";
				} else { 
					print "<p class=\"obligatorio\">";
				}
				print $ptree[$i][3].":</p>";
				if ($ptree[$i][11]!=""){
					print "<p class=\"ayuda\"><a tabindex=\"100\" href=\"javascript:ayuda(".($i+1) .")\"><img src=\"images/ayuda.gif\" alt=\"Ayuda\" /></a></p>";
				}
				if ($ptree[$i][10]!=""){
					$imaxlen=" maxlength=\"".$ptree[$i][10]."\" ";
				}
				if ($ptree[$i][7]!=""){
					$idis=" DISABLED ";
				}				
				$cp_string=$cp_string."'field".$i.":control".$i."', ";
			?>
				<div style="clear:both"><input name="<? echo $ptree[$i][0] ?>" type="text" id="field<? echo $i ?>" value="<? echo $ivalor ?>" size="20" /> <span id="control<? echo $i ?>" class="colorpreview">&nbsp;</span></div>
				<div class="seppuntos"><img src="images/sizer.gif" alt="" width="1" height="1" /></div>	
			<?
			}
			
			// checkbox 
			if ($ptree[$i][2]=="c"){
				if ($ptree[$i][4]==""){
					print "<p>";
				} else { 
					print "<p class=\"obligatorio\">";
				}
				print $ptree[$i][3].":</p>";
				if ($ptree[$i][11]!=""){
					print "<p class=\"ayuda\"><a tabindex=\"100\" href=\"javascript:ayuda(".($i+1) .")\"><img src=\"images/ayuda.gif\" alt=\"Ayuda\" /></a></p>";
				}
				if ($ptree[$i][7]!=""){
					$idis=" DISABLED ";
				}
				if($ivalor==0) print "<input style=\"border:0px\" type=\"checkbox\" name=\"".$ptree[$i][0]."\" value=\"".$ivalor."\" /><div class=\"seppuntos\"><img src=\"images/sizer.gif\" alt=\"\" /></div>";
				if($ivalor==1) print "<input style=\"border:0px\" type=\"checkbox\" name=\"".$ptree[$i][0]."\" value=\"".$ivalor."\" checked /><div class=\"seppuntos\"><img src=\"images/sizer.gif\" alt=\"\" /></div>";
			}
			
			// VALIDACIÓN DE CAMPOS REQUERIDOS (checkbox "c" no se valida) ("f" con $ivalor tampoco)
			//if (($ptree[$i][4]!="") && ($ptree[$i][2]!="c") && (($ptree[$i][4]=="f") && ($ivalor))) {
			if($paction != "delete") {
				if (($ptree[$i][4]!="") && ($ptree[$i][2]!="c")) {
					if ($ptree[$i][2]=="fck") {
						$js .= "fckEditor1val = FCKeditorAPI.__Instances['".$ptree[$i][0]."'].GetHTML();";
						$js .= "if (fckEditor1val == '') { ";
						$js .= "alert('Por favor, el campo \'".$ptree[$i][3]."\' no puede estar vacío.'); return;} ";
					}
					else {
						if (($ptree[$i][2]=="f") && ($ivalor!="")) {
						} else {
							if ($ptree[$i][2]=="s"){
								$js .= "if (document.getElementById('formu').".$ptree[$i][0].".value == '-1') { ";
							} else {
								$js .= "if (document.getElementById('formu').".$ptree[$i][0].".value == '') { ";
							}
							if(strpos($ptree[$i][3], "<") > 0)  
								$js .= "alert('Por favor, el campo \'".substr($ptree[$i][3], 0, strpos($ptree[$i][3], "<"))."\' no puede estar vacío.'); ";
							else
								$js .= "alert('Por favor, el campo \'".$ptree[$i][3]."\' no puede estar vacío.'); ";
							$js .= "document.getElementById('formu').".$ptree[$i][0].".focus(); return;} ";
						}
					}
				}
	
				// validar tipo de dato numérico "n", "f" o "do"
				if (($ptree[$i][1]=="n") || ($ptree[$i][1]=="f") || ($ptree[$i][1]=="do")) {
					$js .= "if (isNaN(document.getElementById('formu').".$ptree[$i][0].".value)) { ";
					$js .= "alert('Sólo están permitidos valores numéricos y decimales correctos en el campo ".$ptree[$i][3]."');";
					$js .= "document.getElementById('formu').".$ptree[$i][0].".focus(); return;} ";
				}
				
				// validar campos "foto"
				if (($ptree[$i][2]=="f") && ($ptree[$i][12]!="")) {
					$js .= "tipo=document.getElementById('formu').".$ptree[$i][0].".value.substring((document.getElementById('formu').".$ptree[$i][0].".value.length)-3,(document.getElementById('formu').".$ptree[$i][0].".value.length)).toLowerCase();";
					$js .= "if ( (document.getElementById('formu').".$ptree[$i][0].".value != '') && ((tipo!='jpg') && (tipo!='gif') && (tipo!='png')) ) {";
					$js .= "alert('Sólo están permitidas imágenes de tipo JPG, GIF y PNG. Vuelva a introducir la imagen del campo ".$ptree[$i][3].", por favor');";
					$js .= "document.getElementById('formu').".$ptree[$i][0].".focus(); return;} ";
				}
				
				// envío de datos de un "checkbox"
				if ($ptree[$i][2]=="c") {
					$js .= "if (document.getElementById('formu').".$ptree[$i][0].".checked) { ";
					$js .= "document.getElementById('formu').".$ptree[$i][0].".value = 1;";
					$js .= "} else { ";
					$js .= "document.getElementById('formu').".$ptree[$i][0].".value = 0;";
					$js .= "}";
				}
			}
			
			// case de cada ayuda
			if ($ptree[$i][11]!=""){
				$help .= " case ". ($i+1) .": document.getElementById('textoayuda').innerHTML=\"".$ptree[$i][11]."\"+volver;";
				$help .= " break;";
			}			
		}
		
		// colorpicker string (para mostrar los color picker)
		if($cp=="true") {
		?>
				<!-- YUI Dependencies -->  
				<script type="text/javascript" src="http://yui.yahooapis.com/2.5.1/build/utilities/utilities.js" ></script>
				<script type="text/javascript" src="http://yui.yahooapis.com/2.5.1/build/slider/slider-min.js" ></script> 
				<!-- Color Picker source files for CSS and JavaScript -->
				<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.5.1/build/colorpicker/assets/skins/sam/colorpicker.css">
				<script type="text/javascript" src="http://yui.yahooapis.com/2.5.1/build/colorpicker/colorpicker-min.js" ></script>
				<script type="text/javascript" src="includes/colorpicker/windowfiles/dhtmlwindow.js"></script>
				<link rel="stylesheet" type="text/css" href="includes/colorpicker/windowfiles/dhtmlwindow.css" />
				<script type="text/javascript" src="includes/colorpicker/ddcolorpicker.js">
				/***********************************************
				* Color PIcker Widget (YUI Based)- By Dynamic Drive DHTML code library (http://www.dynamicdrive.com)
				* Requires: YUI Color Picker and DHTML Window Widget
				***********************************************/
				</script>
				<!--HTML for Color Picker. Should contain two unique IDs-->
				<div id="ddcolorwidget">
				Por favor, escoja un color:
				<div id="ddcolorpicker" style="position:relative; height:205px"></div>
				</div>
				<script type="text/javascript">
				ddcolorpicker.init({
					colorcontainer: ['ddcolorwidget', 'ddcolorpicker'], //id of widget DIV, id of inner color picker DIV
					displaymode: 'float', //'float' or 'inline'
					floatattributes: ['DD Color Picker Widget', 'width=390px,height=250px,resize=1,scrolling=1,center=1'], //'float' window attributes
					//fields: ['field1:control1'] //[fieldAid[:optionalcontrolAid], fieldBid[:optionalcontrolBid], etc]
					fields: [<? echo substr($cp_string,0, $cp_string.length-2); ?>] //[fieldAid[:optionalcontrolAid], fieldBid[:optionalcontrolBid], etc]
				})
				</script>
		<?
		}
		
		if (($paction!="")&&($paction!="insert")&&($pok!="submit")){
			mysql_free_result($rs);
		}		
		
		if ($paction=="insert") $boton="Guardar";
		if ($paction=="update") $boton="Guardar";
		if ($paction=="delete") $boton="Eliminar";
		print "<div class=\"fondointro\"><input class=\"volver\" type=\"button\" name=\"Volver\" onclick=\"javascript:history.back();\" value=\"&lt;&lt; Volver\" /><input type=\"button\" name=\"Submit\" onclick=\"javascript:enviar();\" value=\"".$boton."\" /></div>";
		print "</form>";
	
		// impresión de validación de requeridos
		print chr(13);
		print "<script type=\"text/javascript\">";
		
		if($_REQUEST["site"] == "eventos") {
			print "function muestraevento() {";
			print "if(document.getElementById('formu').identidad.options[document.getElementById('formu').identidad2.selectedIndex].text != '--Seleccione--') {";
			print "document.getElementById('formu').evento.value=document.getElementById('formu').identidad.options[document.getElementById('formu').identidad.selectedIndex].text+' - '+document.getElementById('formu').identidad2.options[document.getElementById('formu').identidad2.selectedIndex].text;";
			print "document.getElementById('formu').eventoEN.value=document.getElementById('formu').evento.value;";
			print "document.getElementById('formu').eventoDE.value=document.getElementById('formu').evento.value;";
			print "document.getElementById('formu').eventoFR.value=document.getElementById('formu').evento.value;";
			print "}";
			print "}";
		}
		
		print "var volver=\"<br /><br /><a href='javascript:ayuda()'>volver</a>\";";
		print " function enviar(){ ";
		if ($js!="") print $js;
		if ($paction=="insert") $pregunta="Desea guardar los datos";
		if ($paction=="update") $pregunta="Desea guardar los datos";
		if ($paction=="delete") $pregunta="Desea eliminar el registro seleccionado";
		
		print "if (confirm(\"¿".$pregunta."?\")){";
		for ($i=0;$i<sizeof($ptree);$i++){
			if ($ptree[$i][7]!=""){
				print "document.getElementById('formu').".$ptree[$i][0].".disabled = false;";
			}
		}
		print "document.getElementById('formu').submit();}}";

		// impresión de ayuda
		print chr(13);
		print "	function ayuda(i) {";
		print "	switch (i) {";
		print $help;
		print "	default: document.getElementById('textoayuda').innerHTML=\"Una vez cumplimentados los datos, pulse el bot&oacute;n <strong>Enviar</strong>.Si tiene dudas sobre el funcionamiento de alg&uacute;n elemento, pulse el bot&oacute;n de Ayuda correspondiente.\";";
		print " }} ";

		print "</script>";
		
		print "</div>";
	}
	
	function post($ptree,$pvalue){
		print "<form id=\"formpost\" method=\"post\" action=\"index.php\">";
		for ($i=0;$i<sizeof($ptree);$i++){
			print "<input type=\"hidden\" name=\"".$ptree[$i]."\" value=\"".$pvalue[$i]."\">";
		}
		print "<input type=\"hidden\" name=\"pagina\" value=\"".$_REQUEST["pagina"]."\">";
		print "</form>";
		print "<script type=\"text/javascript\">";
		print " function enviarpost(){";
		print " document.getElementById('formpost').submit();";
		print " } enviarpost();";
		print "</script>";	
		
	}
	
	function storefile($var, $location, $filename=NULL, $size) {	
		if(!isset($_SERVER['DOCUMENT_ROOT'])) 
		{ 
			$n = $_SERVER['SCRIPT_NAME']; 
			$f = ereg_replace('\\\\', '/',$_SERVER['SCRIPT_FILENAME']); 
			$f = str_replace('//','/',$f); 
			$_SERVER['DOCUMENT_ROOT'] = eregi_replace($n, "", $f); 
		}
			
   		$ok = false;

		$temp_filename = $_FILES[$var]['name'];
    	$ext = explode('.',$temp_filename);
	    $ext = $ext[count($ext)-1];
    	$temp_filename = time().".".$ext;
			   
		if (preg_match('/^(png|PNG|gif|GIF|JPE?G|jpe?g)$/',$ext)) {
			$name  = $_FILES[$var]["name"];
			$array = explode(".", $name);
			$nr    = count($array);
			$ext  = strtolower($array[$nr-1]);
			$ok = true;
		} else {
			if($ext != "") {
				$name  = $_FILES[$var]["name"];
				$array = explode(".", $name);
				$nr    = count($array);
				$ext  = $array[$nr-1];
				$ok = true;
			}
		}
   
		if($ok==true) {
    		$tempname = $_FILES[$var]['tmp_name'];
   			$uploadpath = "../".$location."/".$filename.".".$ext;
     		if(is_uploaded_file($_FILES[$var]['tmp_name'])) {  
       			move_uploaded_file($tempname, $uploadpath);
     		}
			// Tratamiento de imágenes (anchoxalto ó maximo)
			if($size!="") {
				// anchoxalto
				if(strpos($size, "x") > 0) {
					$sizes = explode("x", $size);
					thumb(strtolower($uploadpath), $sizes[0], $sizes[1]);
				}
				else {
					if(strpos($size, "X") > 0) {
						$sizes = explode("X", $size);
						thumbexact($uploadpath, $sizes[0], $sizes[1]);
					} else  {
						// máximo: medidas máximas para ancho y alto
						thumb($uploadpath, $size);
					}
				}
			}
     		return true;
   		} else {
     		return false;
   		}
  }
  
  function thumb($imagen,$ancho,$alto) {
	// Inicializamos las variables
	$anchura='';
	$altura='';
	// Comprobamos que sea de tipo 'gif' o 'jpg'
	$extension = explode(".",$imagen); 
	$num = count($extension)-1;
	// Lugar donde se guardarán los thumbnails respecto a la carpeta donde está la imagen "grande".
	$dir_thumb = "/";
	// para "pisar" la imagen anterior, no ponemos prefijo
	$prefijo_thumb = "";
	$camino_nombre=explode("/",$imagen); 
	// Aquí tendremos el nombre de la imagen.
	$nombre=end($camino_nombre);
	// Aquí la ruta especificada para buscar la imagen.
	$camino=substr($imagen,0,strlen($imagen)-strlen($nombre));
	// Comenzamos a crear la imagen
	if (($extension[$num]=="jpg") || ($extension[$num]=="JPG")) {$img = imagecreatefromjpeg($camino.$nombre);}
	if ($extension[$num]=="gif") {$img = imagecreatefromgif($camino.$nombre);}
	if ($extension[$num]=="png") {$img = imagecreatefrompng($camino.$nombre);}
	// miramos el tamaño de la imagen original...
	$datos = getimagesize($camino.$nombre);
	
	// ANCHOxALTO: creamos un thumbnail con los límites de ancho y alto que le pasamos
	// Si no pasamos '$ancho' o '$alto' ponemos valores por defecto
	if ($ancho==-1) $ancho=800;
	if ($alto==-1) $alto=600;	
	// Escalamos por $ancho
	if ($datos[0]>$ancho) {
		$anchura = $ancho;
		$ratio = ($datos[0] / $anchura);
		$altura = round($datos[1] / $ratio);
	}
	// Escalamos por $alto
	if ( (($datos[1]>$alto) && ($altura=='')) || ($altura>$alto) ) {
		$altura = $alto;
		$ratio = ($datos[1] / $altura);
		$anchura = round($datos[0] / $ratio);
	}
	// Si hemos reescalado, hacemos el thumb
	if ( ($altura!='') || ($anchura!='') ) {
		// esta será la nueva imagen reescalada
		$thumb = imagecreatetruecolor($anchura,$altura);
		// con esta función la reescalamos
		imagecopyresampled ($thumb, $img, 0, 0, 0, 0, $anchura, $altura, $datos[0], $datos[1]);		
		// voilà la salvamos con el nombre y en el lugar que nos interesa
		if ($extension[$num]=="jpg") imagejpeg($thumb,$camino.$dir_thumb.$prefijo_thumb.$nombre);
		if ($extension[$num]=="gif") imagegif($thumb,$camino.$dir_thumb.$prefijo_thumb.$nombre);
		if ($extension[$num]=="png") imagepng($thumb,$camino.$dir_thumb.$prefijo_thumb.$nombre);
	}
  }
  
  function thumbexact($img, $we, $he) { 
	// Comprobamos que sea de tipo 'gif' o 'jpg'
	$extension = explode(".",$img); 
	$num = count($extension)-1;
	// Lugar donde se guardarán los thumbnails respecto a la carpeta donde está la imagen "grande".
	$dir_thumb = "/";
	// para "pisar" la imagen anterior, no ponemos prefijo
	$prefijo_thumb = "";
	$camino_nombre=explode("/",$img); 
	// Aquí tendremos el nombre de la imagen.
	$nombre=end($camino_nombre);
	// Aquí la ruta especificada para buscar la imagen.
	$camino=substr($img,0,strlen($img)-strlen($nombre));
	
	list($w, $h, $tip) = getimagesize($img); 

	if (($w > $we) || ($h > $he)) {
		if ($w / $we > $h / $he) { 
			$hp = $h; 
			$wp = round(($we / $he) * $hp); 
		}  else { 
			$wp = $w; 
			$hp = round(($he / $we) * $wp); 
		} 
	
		$lp = round(($w - $wp) / 2); 
		$tp = round(($h - $hp) / 2); 
	
		$thumb = imagecreatetruecolor($we, $he); 
		if ($tip == 1) { 
			$source = imagecreatefromgif($img); 
		}  elseif ($tip == 2) { 
			$source = imagecreatefromjpeg($img); 
		}  elseif ($tip == 3) { 
			$source = imagecreatefrompng($img); 
		} 
	
		imagecopyresampled($thumb, $source, 0, 0, $lp, $tp, $we, $he, $wp, $hp); 
		imagejpeg($thumb, $camino.$dir_thumb.$prefijo_thumb.$nombre); 
		if ($tip == 1) { 
			imagegif($thumb,$camino.$dir_thumb.$prefijo_thumb.$nombre); 
		}  elseif ($tip == 2) { 
			imagejpeg($thumb,$camino.$dir_thumb.$prefijo_thumb.$nombre); 
		}  elseif ($tip == 3) { 
			imagepng($thumb,$camino.$dir_thumb.$prefijo_thumb.$nombre); 
		}
	}
  }
?>