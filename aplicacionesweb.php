<? include "php/conexion.php" ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xml:lang="es" lang="es" xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Programador Aut&oacute;nomo en Madrid - Dise&ntilde;ador Web Freelance en Madrid :: Aplicaciones Web</title>
<? include "includes/metas.php" ?>
<link href="css/estilos.css?v=1.1" rel="stylesheet" type="text/css" />
</head>
<body>
	<div id="cont">
<? include "includes/superior.php" ?>
        <ul id="menu">
            <li class="home"><a href="index.php"><img src="images/sizer.gif" alt="" width="1" height="1" /></a></li>
            <li class="portfolio"><a href="portfolio.php"><img src="images/sizer.gif" alt="" width="1" height="1" /></a></li>
            <li class="clientes"><a href="clientes.php"><img src="images/sizer.gif" alt="" width="1" height="1" /></a></li>
            <li class="servicios"><a href="servicios.php"><img src="images/sizer.gif" alt="" width="1" height="1" /></a></li>
            <li class="aplicacionesweb"><a href="aplicacionesweb.php" class="activo"><img src="images/sizer.gif" alt="" width="1" height="1" /></a></li>
            <li class="contacto"><a href="contacto.php"><img src="images/sizer.gif" alt="" width="1" height="1" /></a></li>
            <li class="sep"><img src="images/sizer.gif" alt="" width="1" height="1" /></li>
        </ul>
        <div id="logo"><a href="index.php"><img src="images/logo.gif" alt="Programador Autónomo" /></a></div>
		<div id="contenido">
           	<h1><img src="images/aplicacionesweb.gif" alt="aplicaciones web" /></h1>
            Disponemos de una gran cantidad de soluciones que usted puede implementar en su web. Pequeños (o grandes) módulos que le pueden resultar de gran utilidad para reforzar su desarrollo en internet.<br /><br />
            A continuación puede ver algunas de ellas:
            <br /><br />
<? 
	$result=mysql_query("SELECT * FROM aplicacionesweb WHERE oculto=0 ORDER BY orden", $db);
	while($row=mysql_fetch_array($result)) {
?>
			<div class="aplicacionweb">
            	<div class="icono"><img src="images/<? echo $row["icono"] ?>" alt="<? echo $row["aplicacion"] ?>" /></div>
                <? if($row["descripcion"]) { ?><div class="descripcion"><? echo $row["descripcion"] ?></div><? } ?>
                <? if($row["fuente"]) { ?><div class="fuente"><strong>Fuente:</strong> <? echo $row["fuente"] ?></div><? } ?>
                <? if($row["tecnologias"]) { ?><div class="fuente"><strong>Tecnologías:</strong> <? echo $row["tecnologias"] ?></div><? } ?>
                <? if($row["url"]) { ?> <div class="url"><strong>URL Ejemplo:</strong> <a href="<? echo $row["url"] ?>" onclick="window.open(this.href); return false;"><? echo $row["url"] ?></a></div><? } ?>
            </div>
<?	} ?>
			<br class="sep" />
		</div>
<? include "includes/inferior.php" ?>
	</div>
<? include "includes/googleanalytics.php" ?>
</body>
</html>
<? include "php/desconexion.php" ?>