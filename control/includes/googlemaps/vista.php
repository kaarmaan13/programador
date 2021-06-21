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

	// Ruta de imágenes a subir
	$ruta_imagenes="../../../images/";
	// Funciones de reescalado imágenes
	include('../global_funciones.php');

	// Acceso a Base de datos
	include('include/config.php');
	// Introduccion de datos en la Base de datos
	include('include/introducir.php');

	$mWidth = 570;
	$mHeight = 570;
	$mapZoom = 16;

	// PUNTOS SELECCIONADOS
	// Si aún no hemos seleccionado ninguno checkbox, todos ON
	if($_REQUEST["itemsel"]=="") $_REQUEST["itemsel"]=$_REQUEST["idgrupopuntos"];
	$seleccionados = split( ",", $_REQUEST["itemsel"]);
	$querysel = "";
	for($i=0;$i<=count($seleccionados)-1;$i++) {
		if($seleccionados[$i]!="") {
			$querysel .= "idgrupopuntos=".$seleccionados[$i];
			if($i!=count($seleccionados)-1) $querysel .= " || ";
		}
	}
	if(substr($querysel, strlen($querysel)-3, strlen($querysel)) == "|| ") $querysel=substr($querysel, 0, strlen($querysel)-3);
	$querysel_puntos=str_replace("idgrupopuntos","punto_tipo",$querysel);
	// PUNTOS ENVIADOS
	$grupos = split( ",", $_REQUEST["idgrupopuntos"]);

	// Mostramos como punto inicial o Home el primer punto que hay en el array que nos pasan
	$query=mysql_query("SELECT * FROM puntos WHERE punto_tipo=".$grupos[0]);
	$row=mysql_fetch_array($query);
	if(mysql_num_rows($query)>0)
	    $centerpoint = "" . $row["punto_lat"] . ",". $row["punto_long"] ."";
	else 
		$centerpoint = "43.53993928464425,-5.647670030593872";
	$linecolor = "#FF0000";
	$default_shadow = 'img/mm_20_shadow.png';
	
// Mostrar datos de la Base de datos
$query="SELECT * FROM puntos WHERE " . $querysel_puntos . " ORDER BY punto_ID";
$result = mysql_query($query);
if(!$result) {echo "Error obteniendo los datos de la Base de Datos."; exit;}
$a = 0;
while ($punto_row = mysql_fetch_object($result)) {
	//  Arreglamos la dirección Web
	$url = $punto_row->punto_url;
    if($url != "http://" && $url != "http:///" && $url != "") {
		$www = substr($url, 0, 3);
		if($www == 'htt' || $www == 'www'){
			$testedwebsite = $url;
			if($www == 'www'){
				$testedwebsite = 'http://' . $url;
			}
		}
        else{
            $testedwebsite = 'http://' . $url;
        }
	}
	else{
		$testedwebsite = '';
	}
	
	$coord_array[$a]['punto_ID'] = $punto_row->punto_ID;
	$coord_array[$a]['long'] = $punto_row->punto_long;
	$coord_array[$a]['lat'] = $punto_row->punto_lat;
    $coord_array[$a]['nombre'] = $punto_row->punto_nombre;
    $coord_array[$a]['direcc'] = $punto_row->punto_direcc;
	$coord_array[$a]['punto_tipo'] = $punto_row->punto_tipo;
	$coord_array[$a]['url'] = $testedwebsite;
	$coord_array[$a]['coment'] = $punto_row->punto_coment;
	$coord_array[$a]['marcador'] = $punto_row->punto_marcador;
    $coord_array[$a]['email'] = $punto_row->punto_email;
    $coord_array[$a]['punto_logo'] = $punto_row->punto_logo;
    $coord_array[$a]['punto_fotomini'] = $punto_row->punto_fotomini;
    $coord_array[$a]['punto_foto'] = $punto_row->punto_foto;
	$a++;
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml">
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <link href="favicon.png" type="image/png" rel="shortcut icon">
    <link media="screen" href="css/style.css" type="text/css" rel="stylesheet">
	<style type="text/css">
    v\:* {
      behavior:url(#default#VML);
    }
    </style>
    <script src="http://maps.google.com/maps?file=api&amp;v=2.x&amp;key=ABQIAAAASctQ9FwZgXyHr-LeCEWB1BRNtmAuglT0Ypxf0iLQ1xFvHy21PxTy1E9bD8k1cj0y8DVuquCcOV2DnQ" type="text/javascript"></script>
	<script src="include/pdmarker.js" type="text/javascript"></script>
	<script type="text/javascript">
		function actualizar() {
			string_itemsel="";
			for(i=0;i<document.getElementById("puntos").gruposel.length;i++) {
				if(document.getElementById("puntos").gruposel[i].checked) string_itemsel+=document.getElementById("puntos").gruposel[i].value;
				if((document.getElementById("puntos").gruposel[i].checked) && (i<document.getElementById("puntos").gruposel.length)) string_itemsel+=",";
			}
			document.getElementById("puntos").itemsel.value = string_itemsel;
			if(string_itemsel == "") alert("Debe seleccionar al menos un grupo de puntos para la búsqueda");
			else document.getElementById("puntos").submit();
		}
	</script>

	<? include('include/processvista.php'); ?>

<title>Mapas Google Maps</title>
</head>
<body onload="onLoad()" onunload="GUnload()">
<div id="container">
    <div id="layout1">
		<div id="cuerpo1">
			<form id="busqueda" action="#" onsubmit="showAddress(this.address.value); return false">
				<p>
					<input type="text" size="60" name="address" value="Avenida Rufo García Rendueles 17, Gijón" />
					<input type="submit" value="Situarme" />
				</p>
				<div id="map" style="width: <?= $mWidth; ?>px; height: <?= $mHeight; ?>px; color: #000000; border: thin solid; border-width: 5px; border-color:#000000"></div>
			</form>
		</div>
		<div id="cuerpo2">
			<div style="font-size:9px;margin:5px 32px 14px 0px;text-align:center">Seleccione los grupos de puntos para su consulta y pulse <strong>ACTUALIZAR MAPA</strong></div>
			<div class="scroll" style="height:460px">
			<form id="puntos" action="vista.php" method="post">
				<input type="hidden" name="idgrupopuntos" value="<? echo $_REQUEST["idgrupopuntos"] ?>" />
				<input type="hidden" name="itemsel" value="<? echo $_REQUEST["itemsel"] ?>" />
<?			// PUNTOS ENVIADOS
			$query = "";
			for($i=0;$i<=count($grupos)-1;$i++) {
				$query .= "idgrupopuntos=".$grupos[$i];
				if($i!=count($grupos)-1) $query .= " || ";
			}
			$result=mysql_query("SELECT * FROM grupopuntos WHERE ".$query);
				if (mysql_num_rows($result)>0) { ?>
				<ul style="width:140px;margin:0px 10px 0px 0px">
<?				while($row=mysql_fetch_array($result)) { ?>
					<li style="width:140px;background-color:#CCCCCC;border:1px solid #000000;margin:0px 0px 8px 0px;padding:3px 3px 3px 3px">
						<div style="float:left;padding-right:10px"><img <? if(ereg(".png", $row["iconogrupo"])==1) { ?>style="behavior:url(css/iepngfix.htc);"<? } ?> src="img/<? echo $row["iconogrupo"] ?>" /></div>
						<div style="float:left;margin:3px 0px 0px 0px"><strong><? echo $row["grupopuntos"] ?></strong></div>
						<div class="sep"></div>
						<div style="margin:0px 0px 0px 118px">
							<input style="border:0px;background:url(img/1x1.gif)" type="checkbox" name="gruposel" value="<? echo $row["idgrupopuntos"] ?>" <? if(in_array($row["idgrupopuntos"], $seleccionados)) echo "checked" ?> />
						</div>
					</li>
<?				} ?>
				</ul>
			</div>
			<div style="margin:10px 0px 0px 15px"><a href="javascript:actualizar()"><img src="img/btn_actualizar.gif" alt="" /></a></div>
<?		} ?>
			</form>
		</div>
		<div class="sep"><img src="img/sizer.gif" alt="" width="1" height="1" /></div>
    </div>
</div>
</body>
</html>