<? include "php/conexion.php" ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xml:lang="es" lang="es" xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Programador Aut&oacute;nomo en Madrid - Dise&ntilde;ador Web Freelance en Madrid</title>
<? include "includes/metas.php" ?>
<link href="css/estilos.css?v=1.1" rel="stylesheet" type="text/css" />
</head>
<body>
	<div id="cont">
<? include "includes/superior.php" ?>
        <ul id="menu">
            <li class="home"><a href="index.php" class="activo"><img src="images/sizer.gif" alt="separador" width="1" height="1" /></a></li>
            <li class="portfolio"><a href="portfolio.php"><img src="images/sizer.gif" alt="separador" width="1" height="1" /></a></li>
            <li class="clientes"><a href="clientes.php"><img src="images/sizer.gif" alt="separador" width="1" height="1" /></a></li>
            <li class="servicios"><a href="servicios.php"><img src="images/sizer.gif" alt="separador" width="1" height="1" /></a></li>
            <li class="aplicacionesweb"><a href="aplicacionesweb.php"><img src="images/sizer.gif" alt="separador" width="1" height="1" /></a></li>
            <li class="contacto"><a href="contacto.php"><img src="images/sizer.gif" alt="separador" width="1" height="1" /></a></li>
            <li class="sep"><img src="images/sizer.gif" alt="separador" width="1" height="1" /></li>
        </ul>
        <div id="logo"><a href="index.php"><img src="images/logo.gif" alt="Programador Autónomo" /></a></div>
		<div id="contenido">
        	<div class="izda">
            	<h1><img src="images/quienes_somos.gif" alt="quiénes somos" /></h1>
                <p>
                    Somos un equipo de programadores freelance/autónomos que desarrollamos soluciones 
                    informáticas de alta calidad orientadas a internet.
                    <br /><br />
                    Contamos con sólidos conocimientos y experiencia en administración de proyectos, 
                    análisis y diseño de sistemas, programación y control de calidad.
                    <br /><br />
                    La metodología del desarrollo global de un proyecto para nuestros clientes consta de los siguientes pasos:<br />
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- Toma de requisitos del proyecto<br />
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- Realizaci&oacute;n y aprobaci&oacute;n del boceto del site<br />
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- Desarrollo de la programaci&oacute;n del site y su Gestor de Contenidos si lo tuviese<br />
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- Fase de pruebas<br />
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- Entrega del proyecto al cliente<br />
                    <br />
                    Nos especializamos en tecnolog&iacute;as de programaci&oacute;n <strong>PHP</strong>, <strong>ASP</strong>, <strong>AJAX</strong>, <strong>FLASH</strong> y Bases de datos <strong>MySQL</strong> y <strong>SQL Server</strong>.
                    <br /><br />
                    Adem&aacute;s realizamos <strong>posicionamiento web SEO/Adwords</strong> y <strong>campa&ntilde;as de e-mail marketing</strong>.
                    <br /><br />
                    Si lo desea, también podemos desarrollar su web en base a <strong>plantillas prediseñadas</strong>, reduciéndose considerablemente el coste del desarrollo
                    <br /><br />
                    Trabajamos para <strong>toda Espa&ntilde;a</strong> desde nuestras oficinas de <strong>Madrid</strong> y <strong>Gijón (Asturias)</strong>, realizando trabajos para otras ciudades de la península, como <strong>Barcelona</strong>, <strong>Valencia</strong> o <strong>Bilbao</strong>.
                </p>
            </div>
            <div class="dcha">
            	<h1><img src="images/ultimos_trabajos.gif" alt="últimos trabajos" /></h1>
<? 
	$cont=0;
	$result=mysql_query("SELECT * FROM trabajos WHERE oculto=0 ORDER BY orden", $db);
	while(($row=mysql_fetch_array($result)) && ($cont<=5)) {
		$cont++;
?>
				<div class="trabajo">
          	  		<a href="http://<? echo $row["url"] ?>" onclick="window.open(this.href); return false;"><img src="images/<? echo $row["fotohome"] ?>" alt="<? echo $row["trabajo"] ?>" /></a>
                	<p><a href="http://<? echo $row["url"] ?>" onclick="window.open(this.href); return false;"><? echo $row["trabajo"]; ?></a></p>
                    <span><a href="http://<? echo $row["url"] ?>" onclick="window.open(this.href); return false;"><? echo $row["trabajo"]; ?></a></span>
           		</div>
<?	} ?>
            </div>
            <br class="sep" />
		</div>
        <div class="linea-fina"></div>
		<ul class="inf">
            <li><img src="images/ico_php.gif" alt="Programada con PHP" /></li>
            <li><img src="images/ico_mysql.gif" alt="Base de datos en mySQL" /></li>
            <li><a href="http://validator.w3.org/check?uri=<? echo $_SERVER["SERVER_NAME"]. $_SERVER["REQUEST_URI"] ?>" onclick="window.open(this.href); return false;"><img src="images/ico_xhtml10.gif" alt="XHTML 1.0 Strict válido" /></a></li>
            <li><a href="http://jigsaw.w3.org/css-validator/validator?uri=<? echo $_SERVER["SERVER_NAME"]. $_SERVER["REQUEST_URI"] ?>&amp;profile=css3&amp;usermedium=all" onclick="window.open(this.href); return false;"><img src="images/ico_css.gif" alt="CSS válido" /></a></li>
            <li><a href="#"><img src="images/ico_taw.gif" alt="Accesibilidad" /></a></li>
            <li class="sep"><img src="images/sizer.gif" alt="separador" width="1" height="1" /></li>
            <li class="enlace-directorio">	<a href="http://www.directoriowebempresas.com/">Directorio de Empresas</a></li>
            <li style="margin-top:5px">
				<!--Script flesko-->
                <div class="flesko">
                Seleccionado por<br /><a class="iflesko" href="http://www.flesko.es/directorio/net_inteligente/herramientas_de_webmaster/creadores_web.php" title="Flesko Creadores diseñadores web"  onclick="window.open('http://www.flesko.es/directorio/net_inteligente/herramientas_de_webmaster/creadores_web.php?ides=32673');return false;"> Flesko</a></div>
                <!--NoScript flesko-->
            </li>
        </ul>
	</div>
<? include "includes/googleanalytics.php" ?>
</body>
</html>
<? include "php/desconexion.php" ?>