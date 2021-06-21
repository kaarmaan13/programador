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
	// Mostrar la home, sino Home o punto por defecto de inicio
	$query=mysql_query("SELECT * FROM puntos WHERE punto_tipo=1");
	$row=mysql_fetch_array($query);
	if(mysql_num_rows($query)>0)
	    $centerpoint = "" . $row["punto_lat"] . ",". $row["punto_long"] ."";
	else 
		$centerpoint = "43.53993928464425,-5.647670030593872";
	$linecolor = "#FF0000";
	$default_shadow = 'img/mm_20_shadow.png';
	
// Mostrar datos de la Base de datos
$query="SELECT * FROM puntos ORDER BY punto_ID;";
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
	.imagen {
	float:left;
	background-color:#A1B2D3;
	margin:7px 7px 7px 0px;
	padding:7px 7px 7px 7px;
	border:1px solid #BFBFBF;
	text-align:right;
	}
	.imagen .pie {
	padding:3px 0px 0px 0px;
	text-align:center;
	margin:0px;
	font-weight:normal;
	}
    </style>
    <script src="http://maps.google.com/maps?file=api&amp;v=2.x&amp;key=ABQIAAAASctQ9FwZgXyHr-LeCEWB1BRNtmAuglT0Ypxf0iLQ1xFvHy21PxTy1E9bD8k1cj0y8DVuquCcOV2DnQ" type="text/javascript"></script>
	<script src="include/pdmarker.js" type="text/javascript"></script>
	<script type="text/javascript">
		function enviarpunto() {
			/* Nombre del punto */
			if (document.getElementById('form1').punto_nombre.value == '') {
				alert('Por favor, debe introducir al menos un \'Nombre\' para el punto');
				document.getElementById('form1').punto_nombre.focus();
				return;
			}
	
			document.getElementById('form1').submit();
		}
	
		function enviar() {
			/* Nombre del Grupo */
			if (document.getElementById('formu').grupopuntos.value == '') {
				alert('Por favor, compruebe que los datos introducidos en el campo \'Nombre del Grupo\' son correctos');
				document.getElementById('formu').grupopuntos.focus();
				return;
			}
			/* Icono del Grupo */
			if (document.getElementById('formu').iconogrupo.value == '') {
				alert('Por favor, compruebe que los datos introducidos en el campo \'Icono del Grupo\' son correctos');
				document.getElementById('formu').iconogrupo.focus();
				return;
			}
	
			document.getElementById('formu').submit();
		}
		
		function eliminar_foto(img, campo) {
			document.getElementById('form1').action="index.php?borrarfoto="+img+"&campo="+campo;
			document.getElementById('form1').submit();
		}
		
		function modificar(punto) {
			document.getElementById('form1').action="index.php?accion=modificar&punto="+punto;
			/* Nombre del punto */
			if (document.getElementById('form1').punto_nombre.value == '') {
				alert('Por favor, debe introducir al menos un \'Nombre\' para dar de alta un punto');
				document.getElementById('form1').punto_nombre.focus();
				return;
			}
			document.getElementById('form1').submit();
		}
		
		function eliminar(punto) {
			document.getElementById('form1').action="index.php?accion=eliminar&punto="+punto;
			if (confirm("¿Está seguro de que desea eliminar este punto del mapa?")) {
				document.getElementById('form1').submit();
			}
		}
		
		function vacia() {
			document.getElementById('formu').accion.value="";
			document.getElementById('formu').submit();
		}
	</script>

	<? include('include/process.php'); ?>

<title>Mapas Google Maps</title>
</head>
<body onload="onLoad()" onunload="GUnload()">
<div id="container">
<?
	if ($_REQUEST["accion"] == "guardar") {
		$result=mysql_query("INSERT INTO grupopuntos (grupopuntos) VALUES ('".$_REQUEST["grupopuntos"]."') ");
		$ultimo_id=mysql_insert_id();
		if (!empty($_FILES [ 'iconogrupo' ][ 'name' ])) {
			$extension = explode(".",$_FILES [ 'iconogrupo' ][ 'name' ]);
			$num = count($extension)-1;
			$nombreicono='iconogrupo'.$ultimo_id.'.'.strtolower($extension[$num]);
			$result=mysql_query("UPDATE grupopuntos SET iconogrupo='$nombreicono' WHERE idgrupopuntos = $ultimo_id");
			move_uploaded_file ( $_FILES [ 'iconogrupo' ][ 'tmp_name' ], 'img/'.$nombreicono);
		}
		if (!empty($_FILES [ 'sombraiconogrupo' ][ 'name' ])) {
			$extension = explode(".",$_FILES [ 'sombraiconogrupo' ][ 'name' ]);
			$num = count($extension)-1;
			$nombreicono='sombraiconogrupo'.$ultimo_id.'.'.strtolower($extension[$num]);
			$result=mysql_query("UPDATE grupopuntos SET sombraiconogrupo='$nombreicono' WHERE idgrupopuntos = $ultimo_id");
			move_uploaded_file ( $_FILES [ 'sombraiconogrupo' ][ 'tmp_name' ], 'img/'.$nombreicono);
		}
		echo"<div id=\"color:#22FF00;width:200px;font-weight:bold;font-size:11px;margin-bottom:15px\">Los datos han sido guardados</div>";	
	}
?>
    <div id="layout1">
		<div id="cuerpo1">
			<form id="busqueda" action="#" onsubmit="showAddress(this.address.value); return false">
				<p><!-- Avenida Rufo García Rendueles 17, Gijón -->
					<input type="text" size="60" name="address" value="<? ?>" />
					<input type="submit" value="Situarme" />
				</p>
				<div id="map" style="width: <?= $mWidth; ?>px; height: <?= $mHeight; ?>px; color: #000000; border: thin solid; border-width: 5px; border-color:#000000"></div>
			</form>
		</div>
		<div id="cuerpo2">
			<div style="font-weight:bold;font-size:12px;margin-bottom:12px">Grupos de Puntos:</div>
			<div class="scroll">
<?			$result=mysql_query("SELECT * FROM grupopuntos");
			if (mysql_num_rows($result)>0) { ?>
				<ul style="width:140px;margin:0px 10px 0px 0px">
<?				while($row=mysql_fetch_array($result)) { ?>
					<li style="width:140px;background-color:#CCCCCC;border:1px solid #000000;margin:0px 0px 8px 0px;padding:3px 3px 3px 3px">
						<div style="float:left;padding-right:10px"><img <? if(ereg(".png", $row["iconogrupo"])==1) { ?>style="behavior:url(css/iepngfix.htc);"<? } ?> src="img/<? echo $row["iconogrupo"] ?>" /></div>
						<div style="float:left;margin:3px 0px 6px 0px"><strong><? echo $row["grupopuntos"] ?></strong></div>
						<div class="sep"></div>
						<div style="float:left;padding:0px 3px 0px 35px"><a href="#" onclick="javascript:window.open('popup.php?accion=modificargrupo&idgrupopuntos=<? echo $row["idgrupopuntos"] ?>&ruta_imagenes=<? echo $ruta_imagenes ?>','ventana','width=580,height=420,scrolling=no')" style="text-decoration:underline;font-size:9px">modificar</a></div><div style="float:left">|</div>
						<div style="float:left;padding-left:3px"><a href="#" onclick="javascript:window.open('popup.php?accion=eliminargrupo&idgrupopuntos=<? echo $row["idgrupopuntos"] ?>&ruta_imagenes=<? echo $ruta_imagenes ?>','ventana','width=580,height=420,scrolling=no')" style="text-decoration:underline;font-size:9px">eliminar</a></div>
						<div class="sep"></div>
					</li>
<?				} ?>
				</ul>
			</div>
<?		} ?>
		</div>
		<div class="sep"><img src="img/sizer.gif" alt="" width="1" height="1" /></div>
		<div id="centro">
			<div class="cuadro">
<?		// Comprobamos que no esté intentando introducir otro punto como "Home" que es ÚNICO
		$result=mysql_query("SELECT * FROM grupopuntos WHERE grupopuntos='Home'");
		if(mysql_num_rows($result)==0) {?>
			<strong style="color:#FF0000">No ha introducido aún el punto inicial del mapa (Home). Por favor, introdúzcalo.</strong><br /><br />
<?		} ?>
				<strong style="font-size:13px">Crear Grupo de Puntos</strong>
				<br />
				<form id="formu" method="post" action="index.php" enctype="multipart/form-data">
					<input type="hidden" name="accion" value="guardar" />
					<input type="hidden" name="reload" value="" />
					<div style="float:left;width:145px;text-align:right;margin-right:10px;">Nombre del Grupo:</div><div style="float:left"><input type="text" name="grupopuntos" size="50" maxlength="255" value="" /></div><div class="sep"><img src="img/sizer.gif" alt="" width="1" height="1" /></div>
					<div style="float:left;width:145px;text-align:right;margin-right:10px;">Icono del Grupo:</div><div style="float:left"><input type="file" name="iconogrupo" size="50" maxlength="255" value="" /></div><div class="sep"><img src="img/sizer.gif" alt="" width="1" height="1" /></div>
					<div style="float:left;width:145px;text-align:right;margin-right:10px;">Sombra Icono del Grupo:</div><div style="float:left"><input type="file" name="sombraiconogrupo" size="50" maxlength="255" value="" /></div><div class="sep"><img src="img/sizer.gif" alt="" width="1" height="1" /></div>
					<div style="margin:10px 0px 0px 470px"><input type="button" name="Submit" onclick="javascript:enviar();" style="font-weight:bold" value="Añadir Grupo" /></div>
				</form>
			</div>
			<p>
				<strong style="font-size:12px;color:#FF3300">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Instrucciones:</strong>
				<ul>
					<li style="margin:10px 0px 10px 0px;color:#333333"><strong>AÑADIR UN GRUPO DE PUNTOS</strong></li>
					<li>Para crear un grupo de puntos, al que poder asociar puntos individuales, introduzca el <strong>Nombre del Grupo</strong> con el que se identificará (p. ej. 'Restaurantes').</li>
					<li>A continuación introduzca el <strong>Icono del Grupo</strong> con el que se identificará a cada punto del grupo.</li>
					<li>Finalmente, si lo desea, puede introducir una <strong>Sombra de Icono del Grupo</strong> para el icono definido anteriormente.</li>
					<li style="margin:10px 0px 10px 0px;color:#333333"><strong>AÑADIR UN PUNTO</strong></li>
					<li>Para ver los datos de los puntos ya introducidos, simplemente tienes que pulsar sobre las marcas en el mapa.</li>
					<li>Para introducir nuevo puntos, debes hacer doble click sobre su posicion en el mapa y rellenar los datos en el formulario que aparece.</li>
					<li>La opción <b>Situarme</b> que aparece sobre el mapa sirve para buscar un punto si sabemos su dirección, una vez la introduzcamos
					  nos aparecerá una marca sobre el mapa con la ubicación de dicha dirección. El problema es que dicha marca aparece siempre en medio de la calle,
					  así que hay que pulsar sobre su posición exacta (en una de las 2 aceras) para que aparezca el formulario de datos y entonces proceder de la forma habitual.</li>
				</ul>
			</p>
		</div>
    </div>
</div>
</body>
</html>