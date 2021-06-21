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
	width:90px;
	background-color:#A1B2D3;
	margin:7px 7px 7px 155px;
	padding:7px 7px 7px 7px;
	border:1px solid #BFBFBF;
	text-align:center;
	}
	.imagen .pie {
	padding:3px 0px 0px 0px;
	text-align:center;
	margin:0px;
	font-weight:normal;
	}
	</style>
	<script type="text/javascript">
		function enviar() {
			/* Nombre del Grupo */
			if (document.getElementById('formu').grupopuntos.value == '') {
				alert('Por favor, compruebe que los datos introducidos en el campo \'Nombre del Grupo\' son correctos');
				document.getElementById('formu').grupopuntos.focus();
				return;
			}
			if (document.getElementById('formu').accion.value=="modificargrupo") document.getElementById('formu').accion.value="modificar";
			if (document.getElementById('formu').accion.value=="eliminargrupo") document.getElementById('formu').accion.value="eliminar";

					document.getElementById('formu').submit();

		}
		
		function eliminar_foto(img, campo) {
			document.getElementById('formu').action="popup.php?borrarfoto="+img+"&campo="+campo;
			document.getElementById('formu').submit();
		}
	</script>
<title>Grupos de Puntos</title>
</head>
<body>
<div id="container">
    <div id="layout1">
<?
	// Acceso a Base de datos
	include('include/config.php');	
	
	if ($_REQUEST["borrarfoto"]!="") {
		// Borramos la imagen seleccionada
		@unlink($ruta_imagenes.$borrarfoto);
		// Borramos el registro
		$psql="UPDATE grupopuntos SET " . $_REQUEST["campo"] . "=null WHERE " . $_REQUEST["campo"] . " = '" . $_REQUEST["borrarfoto"] . "'";
		$result=mysql_query($psql);
	}
	if ($_REQUEST["accion"] == "modificar") {
		$result=mysql_query("UPDATE grupopuntos SET grupopuntos='$_REQUEST[grupopuntos]' WHERE idgrupopuntos=$_REQUEST[idgrupopuntos]");
		// Si ha introducido 'foto', la insertamos (comprobada ya en el script)
		if (!empty($_FILES [ 'iconogrupo' ][ 'name' ])) {
			$extension = explode(".",$_FILES [ 'iconogrupo' ][ 'name' ]);
			$num = count($extension)-1;
			$nombreicono='iconogrupo'.$_REQUEST["idgrupopuntos"].'.'.strtolower($extension[$num]);
			$result=mysql_query("UPDATE grupopuntos SET iconogrupo='$nombreicono' WHERE idgrupopuntos = $_REQUEST[idgrupopuntos]");
			move_uploaded_file ( $_FILES [ 'iconogrupo' ][ 'tmp_name' ], 'img/'.$nombreicono);
		}
		if (!empty($_FILES [ 'sombraiconogrupo' ][ 'name' ])) {
			$extension = explode(".",$_FILES [ 'sombraiconogrupo' ][ 'name' ]);
			$num = count($extension)-1;
			$nombreicono='sombraiconogrupo'.$_REQUEST["idgrupopuntos"].'.'.strtolower($extension[$num]);
			$result=mysql_query("UPDATE grupopuntos SET sombraiconogrupo='$nombreicono' WHERE idgrupopuntos = $_REQUEST[idgrupopuntos]");
			move_uploaded_file ( $_FILES [ 'sombraiconogrupo' ][ 'tmp_name' ], 'img/'.$nombreicono);
		}
		?><script type="text/javascript">window.opener.vacia();window.close();</script><?
	}
	if ($_REQUEST["accion"] == "eliminar") {
		// Borramos las imagenes asociadas
		$result=mysql_query("SELECT * FROM grupopuntos WHERE idgrupopuntos = ".$_REQUEST["idgrupopuntos"]);
		$row=mysql_fetch_array($result);
		if ($row["iconogrupo"]!="") {
			@unlink("img/".$row["iconogrupo"]);
		}
		if ($row["sombraiconogrupo"]!="") {
			@unlink("img/".$row["sombraiconogrupo"]);
		}
		$result=mysql_query("DELETE FROM grupopuntos WHERE idgrupopuntos=$_REQUEST[idgrupopuntos]");
		// Borramos todos los puntos asociados a este grupo
		$result2=mysql_query("SELECT * FROM puntos WHERE punto_tipo = ".$_REQUEST["idgrupopuntos"]);
		while($row2=mysql_fetch_array($result2)) {
			// Borramos las imagenes asociadas
			if ($row2["punto_logo"]!="") {
				@unlink($_REQUEST["ruta_imagenes"].$row2["punto_logo"]);
			}
			if ($row2["punto_fotomini"]!="") {
				@unlink($_REQUEST["ruta_imagenes"].$row2["punto_fotomini"]);
			}
			if ($row["punto_foto"]!="") {
				@unlink($_REQUEST["ruta_imagenes"].$row2["punto_foto"]);
			}
			// Borramos el registro
			$result=mysql_query("DELETE FROM puntos WHERE punto_ID = ".$row2["punto_ID"]);
		}
		?><script type="text/javascript">window.opener.vacia();window.close();</script><?
	}
?>
		<div id="centro">
			<? if(($_REQUEST["accion"]=="modificargrupo") || ($_REQUEST["accion"]=="modificar")) { ?>
			<div style="font-weight:bold;margin:10px 0px 10px 20px;font-size:11px">Modificar grupo de puntos</div>
			<? } ?>
			<? if(($_REQUEST["accion"]=="eliminargrupo") || ($_REQUEST["accion"]=="eliminar")) { ?>
			<div style="font-weight:bold;margin:10px 0px 10px 20px;font-size:11px">Eliminar grupo de puntos</div>
			<? } ?>
			<div class="cuadro" style="width:500px">
				<form id="formu" method="post" action="popup.php" enctype="multipart/form-data">
					<input type="hidden" name="accion" value="<? echo $_REQUEST["accion"] ?>" />
					<input type="hidden" name="idgrupopuntos" value="<? echo $_REQUEST["idgrupopuntos"] ?>" />
					<input type="hidden" name="ruta_imagenes" value="<? echo $_REQUEST["ruta_imagenes"] ?>" />
<?
	$row=mysql_fetch_array(mysql_query("SELECT * FROM grupopuntos WHERE idgrupopuntos=$_REQUEST[idgrupopuntos]"));
?>
					<div style="float:left;width:145px;text-align:right;margin-right:10px;">Nombre del Grupo:</div><div style="float:left"><input type="text" name="grupopuntos" size="50" maxlength="255" value="<? echo $row["grupopuntos"] ?>" /></div><div class="sep"><img src="img/sizer.gif" alt="" width="1" height="1" /></div>
					<div style="float:left;width:145px;text-align:right;margin-right:10px;">Icono del Grupo:</div><div style="float:left"><input type="file" name="iconogrupo" size="50" maxlength="255" value="" /></div><div class="sep"><img src="img/sizer.gif" alt="" width="1" height="1" /></div>
					<? if($row["iconogrupo"]!=null) { ?>
					<div class="imagen">
						<img <? if(ereg(".png", $row["iconogrupo"])==1) { ?>style="behavior:url(css/iepngfix.htc);"<? } ?> src="img/<? echo $row["iconogrupo"]; ?>" id="imagen" alt="Icono de grupo" /></a>
					</div>
					<? } ?>					
					<div style="float:left;width:145px;text-align:right;margin-right:10px;">Sombra Icono del Grupo:</div><div style="float:left"><input type="file" name="sombraiconogrupo" size="50" maxlength="255" value="" /></div><div class="sep"><img src="img/sizer.gif" alt="" width="1" height="1" /></div>
					<? if($row["sombraiconogrupo"]!=null) { ?>
					<div class="imagen">
						<img <? if(ereg(".png", $row["sombraiconogrupo"])==1) { ?>style="behavior:url(css/iepngfix.htc);"<? } ?> src="img/<? echo $row["sombraiconogrupo"]; ?>" id="imagen" alt="Sombra icono de grupo" /></a>
						<div class="pie"><a href="javascript:eliminar_foto('<? echo $row["sombraiconogrupo"]; ?>','sombraiconogrupo')"><img src="../../images/eliminar2.gif" alt="Eliminar sombra" /></a></div>
					</div>
					<? } ?>	
					<? if(($_REQUEST["accion"]=="modificargrupo") || ($_REQUEST["accion"]=="modificar")) { ?>
					<div style="margin:10px 0px 0px 385px"><input type="button" name="Submit" onclick="javascript:enviar();" style="font-weight:bold" value="Modificar Grupo" /></div>
					<? } ?>
					<? if(($_REQUEST["accion"]=="eliminargrupo") || ($_REQUEST["accion"]=="eliminar")) { ?>
					<div style="margin:10px 0px 0px 385px"><input type="button" name="Submit" onclick="javascript:enviar();" style="font-weight:bold" value="Eliminar Grupo" /></div>
					<? } ?>
				</form>
			</div>
		</div>
	</div>
</div>
</body>