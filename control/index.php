<? 	header('Content-Type: text/html; charset=utf-8');
	include("includes/global_cliente.php");
	include("includes/global_funciones.php");
	include("includes/global_conexion.php");
	mysql_query('SET NAMES \'utf8\'');
?>
<?
	// Creación de tablas primarias si no existen
	$vsql = "CREATE TABLE IF NOT EXISTS `conf` ( 
			  `idconfiguracion` int(2) NOT NULL,
			  `entidad` varchar(100) NOT NULL default '',
			  `logo` varchar(40) default NULL,
			  `colorfuente1` varchar(7) NOT NULL default '',
			  `colorfuente2` varchar(7) NOT NULL default '',
			  `colorfondo` varchar(7) NOT NULL default '',
			  `colorfondomenu` varchar(7) NOT NULL default '',
			  `colorfondobotones` varchar(7) NOT NULL default '',
			  `colorfondocontenido` varchar(7) NOT NULL default ''
			) ENGINE=MyISAM;";
	mysql_query($vsql) or die( "Error en $vsql, error: " . mysql_error() );
	
	// Cambio CHMOD del directorio control/images. Lo creo si no existe
	$location = "control/images";
	// Cambio CHMOD del directorio control/images
	
	// Inserción datos de configuración por defecto
	$vsql = "SELECT * FROM conf";
	if(mysql_num_rows(mysql_query($vsql)) == 0) {
		$vsql = "INSERT INTO conf (idconfiguracion, entidad, logo, colorfuente1, colorfuente2, colorfondo, colorfondomenu, colorfondobotones, colorfondocontenido) VALUES (1, 'Nombre Entidad', '', '#FFFFFF', '#000000', '#FFFFFF' ,'#999999', '#000000', '#FFFFFF')";
		mysql_query($vsql);
	} else {
		$row=mysql_fetch_array(mysql_query($vsql));
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta http-equiv="Cache-Control" content="no-cache" /> 
<meta http-equiv="Pragma" content="no-cache" />
<meta http-equiv="Expires" content="-1" />
<title>Gestor de Contenidos - <? echo $global_titulo ?></title>
<? if ($_SESSION[$global_id_aplicacion]==""){ ?>
	<link href="css/inicio.php" type="text/css" rel="stylesheet" />
<? } else { ?>
	<link href="css/control.php" type="text/css" media="screen" rel="stylesheet" />
    <link rel="stylesheet" href="includes/lightbox/css/lightbox.css" type="text/css" media="screen" />
    <script src="includes/lightbox/js/prototype.js" type="text/javascript"></script>
    <script src="includes/lightbox/js/scriptaculous.js?load=effects,builder" type="text/javascript"></script>
    <script src="includes/lightbox/js/lightbox.js" type="text/javascript"></script>
<? }?>
<? include("includes/global_js.php")?>
<? if ($_SESSION[$global_id_aplicacion]==""){ ?>
</head>
<script type="text/javascript">
	function inicio() {
		document.getElementById('formu').login.focus();
	}
	
	function enviar() {
			// Usuario
			if (document.getElementById('formu').login.value=='') {
				alert("Por favor introduzca un \"Usuario\" ");
				document.getElementById('formu').login.focus();
				return;
			}
			// Contraseña
			if (document.getElementById('formu').clave.value=='') {
				alert("Por favor introduzca una \"Contraseña\" ");
				document.getElementById('formu').clave.focus();
				return;
			}
			
			document.getElementById('formu').submit();
	}
</script>
<body onload="inicio()">
	<div id="sup">
		<div class="logo"><? if($row["logo"] != "") { ?><img src="images/<? print $row["logo"] ?>" alt="" /><? } else { ?><? echo $row["entidad"] ?><? } ?></div>
	</div>
	<div id="cuadro">
		<div class="bandasup">Acceso al Gestor de Contenidos</div>
		<? if (@$loginerror!=""){ ?>		
			<div class="error">El <strong>usuario</strong> o <strong>contraseña</strong> introducidos son incorrectos</div>
		<? } ?>
		<div id="formulario">
			<form id="formu" method="post" action="index.php">
			<div><input type="hidden" name="dologin" value="true" /></div>
			<div class="fila">
				<div class="titulo"><img src="images/obligatorio.gif" alt="" /> Usuario: </div>
				<div class="input"><input class="inputintro" type="text" name="login" value="" /></div>
				<div class="sep"><img src="images/sizer.gif" alt="" /></div>
			</div>
			<div class="fila">
				<div class="titulo"><img src="images/obligatorio.gif" alt="" /> Contraseña: </div>
				<div class="input"><input class="inputintro" type="password" name="clave" value="" /></div>
				<div class="sep"><img src="images/sizer.gif" alt="" /></div>
			</div>
			<div class="fila">
				<div class="titulo"><img src="images/sizer.gif" alt="" /></div>
				<div class="input"><a href="javascript:enviar()"><img src="images/entrar_login.gif" alt="Introduzca su usuario y contraseña para acceder al Panel de Control" /></a></div>
				<div class="sep"><img src="images/sizer.gif" alt="" /></div>
			</div>
			</form>
		</div>
	</div>
<? } else { ?>
</head>
<body>
	<div id="arriba">
		<div class="logo">			
			<div class="entidad"><? if($row["logo"] != "") { ?><img src="images/<? print $row["logo"] ?>" alt="" /><? } else { ?><? echo $row["entidad"] ?><? } ?></div>
			<div style="width:200px;margin:15px 0px 5px 0px"><script type="text/javascript">document.write (displayDate());</script></div>
		</div>
		<div class="panel">Gestor de Contenidos</div>
		<div class="config"><a href="index.php?site=conf&action=update&idconfiguracion=1">Configuraci&oacute;n Intranet</a></div>
	</div>
		
	<? include("menu.php"); ?>
	<? include("contenido.php"); ?>
	<? include("ayuda.php"); ?>
	
	<? 
			if(!isset($_SERVER['DOCUMENT_ROOT']))
			{
				$n = $_SERVER['SCRIPT_NAME'];
				$f = ereg_replace('\\\\', '/',$_SERVER['SCRIPT_FILENAME']);
				$f = str_replace('//','/',$f);
				$_SERVER['DOCUMENT_ROOT'] = eregi_replace($n, "", $f); 
			}
	?>
<? } ?>
</body>
</html>
<?	include("includes/global_desconexion.php"); ?>
