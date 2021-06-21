<?
///////////////////////////////////////////////////////////////////////
//  puntos sobre Google Maps
//                           www.mardito.com/mapas
//
//  Si quieres usar este código, puedes hacerlo libremente,
//  pero debes dejar este mensaje de reconocimiento.
//
//  Mardito 2006 - www.mardito.com
///////////////////////////////////////////////////////////////////

$punto_nombre = preg_replace("/(\s+)?(\<.+\>)(\s+)?/", "$2",  nl2br(addslashes(htmlspecialchars(trim(str_replace("'","''",$_POST['punto_nombre']))))));
$punto_direcc = preg_replace("/\n|\r\n|\r/", "", nl2br(addslashes(htmlspecialchars(trim($_POST['punto_direcc'])))));
$punto_tipo = preg_replace("/(\s+)?(\<.+\>)(\s+)?/", "$2",  nl2br(addslashes(htmlspecialchars(trim(str_replace("'","''",$_POST['punto_tipo']))))));
$punto_email = preg_replace("/\n|\r\n|\r/", "", nl2br(addslashes(htmlspecialchars(trim($_POST['punto_email'])))));
$punto_marcador = preg_replace("/(\s+)?(\<.+\>)(\s+)?/", "$2",  nl2br(addslashes(htmlspecialchars(trim(str_replace("'","''",$_POST['punto_marcador']))))));
$punto_coment = preg_replace("/\n|\r\n|\r/", "", nl2br(addslashes(htmlspecialchars(trim($_POST['punto_coment'])))));
$punto_url = preg_replace("/\n|\r\n|\r/", "", nl2br(addslashes(htmlspecialchars(trim($_POST['punto_url'])))));
$punto_ip = preg_replace("/\n|\r\n|\r/", "", nl2br(addslashes(htmlspecialchars(trim($_POST['punto_ip'])))));
$x = $_GET['x'];
$y = $_GET['y'];

// ELIMINAR FOTOS
if ($borrarfoto!="") {
	// Borramos la imagen seleccionada
	@unlink($ruta_imagenes.$borrarfoto);
	// Borramos el registro
	$psql="UPDATE puntos SET " . $_REQUEST["campo"] . "=null WHERE " . $_REQUEST["campo"] . " = '" . $_REQUEST["borrarfoto"] . "'";
	$result=mysql_query($psql);
} else {
	// MODIFICAR PUNTO
	if($_REQUEST["accion"]=="modificar") {
		// Comprobamos que no estamos intentando introducir una nueva Home
		$result=mysql_query("SELECT * FROM puntos WHERE punto_ID=".$_REQUEST["punto"]);
		$row=mysql_fetch_array($result);
		if(($punto_tipo==1) && ($row["punto_tipo"]!=1) && (mysql_num_rows(mysql_query("SELECT * FROM puntos WHERE punto_tipo=1"))>0)) {
			?><script type="text/javascript">alert("Solo puede introducir un punto como Home.\nSi lo desea puede modificar/eliminar la Home actual y definir una nueva.");</script><?
		} else {
			$result=mysql_query("UPDATE puntos SET punto_nombre='$punto_nombre', punto_direcc='$punto_direcc', punto_tipo='$punto_tipo', punto_email='$punto_email', punto_coment='$punto_coment', punto_url='$punto_url', punto_ip='$punto_ip', punto_month='$month', punto_day='$day', punto_year='$year', punto_time='$time' WHERE punto_ID=" . $_REQUEST["punto"]);
			if (!empty($_FILES["punto_logo"]["name"])) {
				$extension = explode(".",$_FILES["punto_logo"]["name"]);
				$num = count($extension)-1;
				$nombrefoto='logomapa_'.$_REQUEST["punto"].'.'.strtolower($extension[$num]);
				// Subimos la animación a la base de datos y al servidor
				$result=mysql_query("UPDATE puntos SET punto_logo='$nombrefoto' WHERE punto_ID = " . $_REQUEST["punto"]);
				move_uploaded_file ( $_FILES [ 'punto_logo' ][ 'tmp_name' ], $ruta_imagenes.$nombrefoto);
				// Si la imagen que hemos subido supera los 150 de largo o 40 de alto, lo restringimos
				thumbexact($ruta_imagenes.$nombrefoto, 150, 40, 0);
			}
			// Si ha introducido 'fotomini', la insertamos (comprobada ya en el script)
			if (!empty($_FILES["punto_fotomini"]["name"])) {
				$extension = explode(".",$_FILES["punto_fotomini"]["name"]);
				$num = count($extension)-1;
				$nombrefoto='fotomapamini_'.$_REQUEST["punto"].'.'.strtolower($extension[$num]);
				// Subimos la animación a la base de datos y al servidor
				$result=mysql_query("UPDATE puntos SET punto_fotomini='$nombrefoto' WHERE punto_ID =" . $_REQUEST["punto"]);
				move_uploaded_file ( $_FILES [ 'punto_fotomini' ][ 'tmp_name' ], $ruta_imagenes.$nombrefoto);
				// Si la imagen que hemos subido supera los 120 de largo o 120 de alto, lo restringimos EXACTO
				thumbexact($ruta_imagenes.$nombrefoto, 120, 120, 0);
			}
			// Si ha introducido 'foto', la insertamos (comprobada ya en el script)
			if (!empty($_FILES["punto_foto"]["name"])) {
				$extension = explode(".",$_FILES["punto_foto"]["name"]);
				$num = count($extension)-1;
				$nombrefoto='fotomapa_'.$_REQUEST["punto"].'.'.strtolower($extension[$num]);
				// Subimos la animación a la base de datos y al servidor
				$result=mysql_query("UPDATE puntos SET punto_foto='$nombrefoto' WHERE punto_ID = " . $_REQUEST["punto"]);
				move_uploaded_file ( $_FILES [ 'punto_foto' ][ 'tmp_name' ], $ruta_imagenes.$nombrefoto);
				// Si la imagen que hemos subido supera los 120 de largo o 120 de alto, lo restringimos EXACTO
				thumb($ruta_imagenes.$nombrefoto, 780, 490, 0);
			}
		}
	} else {
		// ELIMINAR PUNTO
		if ($_REQUEST["accion"]=="eliminar") {
			// Borramos las imagenes asociadas
			$result=mysql_query("SELECT * FROM puntos WHERE punto_ID = ".$_REQUEST["punto"]);
			$row=mysql_fetch_array($result);
			if ($row["punto_logo"]!="") {
				@unlink($ruta_imagenes.$row["punto_logo"]);
			}
			if ($row["punto_fotomini"]!="") {
				@unlink($ruta_imagenes.$row["punto_fotomini"]);
			}
			if ($row["punto_foto"]!="") {
				@unlink($ruta_imagenes.$row["punto_foto"]);
			}
			// Borramos el registro
			$result=mysql_query("DELETE FROM puntos WHERE punto_ID = ".$_REQUEST["punto"]);
		} else {
			// INTRODUCIR PUNTO
			if(!empty($punto_nombre)) {
				$punto_ip = $_SERVER["REMOTE_ADDR"];
				$month = date(n);
				$day = date(j);
				$year = date(Y);
				$g = date(g)+1;
				$time = date($g.":".i." ".a);
				$checklocationquery="SELECT punto_lat, punto_long
									 FROM puntos
									 ORDER BY punto_ID DESC
									 LIMIT 1;";
				$checklocationresult=mysql_query($checklocationquery);
				$punto_check = mysql_fetch_object($checklocationresult);
				if($punto_check->punto_long != $x && $punto_check->punto_lat != $y) {
					// Comprobamos que no esté intentando introducir otro punto como "Home" que es ÚNICO
					$result=mysql_query("SELECT * FROM puntos WHERE punto_tipo='Home'");
					if (($punto_tipo=="1") && (mysql_num_rows($result)>0)) {
						echo "S&oacute;lo puede introducir un punto como <strong>Home</strong>";
					} else {
						$insertquery="INSERT INTO puntos
									  (punto_long, punto_lat, punto_nombre, punto_direcc, punto_tipo, punto_email, punto_marcador, punto_coment, punto_url, punto_ip, punto_month, punto_day, punto_year, punto_time)
									  VALUES ('$x', '$y', '$punto_nombre', '$punto_direcc', '$punto_tipo', '$punto_email', '$punto_marcador', '$punto_coment', '$punto_url', '$punto_ip', '$month', '$day', '$year', '$time');";
						$insertresult = mysql_query($insertquery);if(!$insertresult) {echo "Ei!  Error insertando los datos en la Base de Datos."; exit;}
					}
					$result=mysql_query("SELECT @@identity as codfoto");
					$row = mysql_fetch_array($result,1);
					$ultimo_id = $row["codfoto"];
					// Si ha introducido 'logo', la insertamos (comprobada ya en el script)
					if (!empty($_FILES["punto_logo"]["name"])) {	
						$extension = explode(".",$_FILES["punto_logo"]["name"]);
						$num = count($extension)-1;
						$nombrefoto='logomapa_'.$ultimo_id.'.'.strtolower($extension[$num]);
						// Subimos la animación a la base de datos y al servidor
						$result=mysql_query("UPDATE puntos SET punto_logo='$nombrefoto' WHERE punto_ID = $ultimo_id");
						move_uploaded_file ( $_FILES [ 'punto_logo' ][ 'tmp_name' ], $ruta_imagenes.$nombrefoto);
						// Si la imagen que hemos subido supera los 200 de largo o 40 de alto, lo restringimos
						thumb($ruta_imagenes.$nombrefoto, 200, 40, 0);
					}
					// Si ha introducido 'fotomini', la insertamos (comprobada ya en el script)
					if (!empty($_FILES["punto_fotomini"]["name"])) {
						$extension = explode(".",$_FILES["punto_fotomini"]["name"]);
						$num = count($extension)-1;
						$nombrefoto='fotomapamini_'.$ultimo_id.'.'.strtolower($extension[$num]);
						// Subimos la animación a la base de datos y al servidor
						$result=mysql_query("UPDATE puntos SET punto_fotomini='$nombrefoto' WHERE punto_ID = $ultimo_id");
						move_uploaded_file ( $_FILES [ 'punto_fotomini' ][ 'tmp_name' ], $ruta_imagenes.$nombrefoto);
						// Si la imagen que hemos subido supera los 120 de largo o 120 de alto, lo restringimos EXACTO
						thumb($ruta_imagenes.$nombrefoto, 120, 120, 0);
					}
					// Si ha introducido 'foto', la insertamos (comprobada ya en el script)
					if (!empty($_FILES["punto_foto"]["name"])) {
						$extension = explode(".",$_FILES["punto_foto"]["name"]);
						$num = count($extension)-1;
						$nombrefoto='fotomapa_'.$ultimo_id.'.'.strtolower($extension[$num]);
						// Subimos la animación a la base de datos y al servidor
						$result=mysql_query("UPDATE puntos SET punto_foto='$nombrefoto' WHERE punto_ID = $ultimo_id");
						move_uploaded_file ( $_FILES [ 'punto_foto' ][ 'tmp_name' ], $ruta_imagenes.$nombrefoto);
						// Si la imagen que hemos subido supera los 120 de largo o 120 de alto, lo restringimos EXACTO
						thumb($ruta_imagenes.$nombrefoto, 780, 490, 0);
					}
				}
			}
		}
	}
}
?> 