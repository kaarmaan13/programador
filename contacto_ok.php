<? include "php/conexion.php" ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xml:lang="es" lang="es" xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Programador Aut&oacute;nomo en Madrid - Dise&ntilde;ador Web Freelance en Madrid :: Contacto</title>
<? include "includes/metas.php" ?>
<link href="css/estilos.css?v=1.1" rel="stylesheet" type="text/css" />
<script type="text/javascript">
function enviar() {
	document.getElementById("formulario").submit();
}
</script>
</head>
<body>
	<div id="cont">
<? include "includes/superior.php" ?>
        <ul id="menu">
            <li class="home"><a href="index.php"><img src="images/sizer.gif" alt="" width="1" height="1" /></a></li>
            <li class="portfolio"><a href="portfolio.php"><img src="images/sizer.gif" alt="" width="1" height="1" /></a></li>
            <li class="clientes"><a href="clientes.php"><img src="images/sizer.gif" alt="" width="1" height="1" /></a></li>
            <li class="servicios"><a href="servicios.php"><img src="images/sizer.gif" alt="" width="1" height="1" /></a></li>
            <li class="aplicacionesweb"><a href="aplicacionesweb.php"><img src="images/sizer.gif" alt="" width="1" height="1" /></a></li>
            <li class="contacto"><a href="contacto.php" class="activo"><img src="images/sizer.gif" alt="" width="1" height="1" /></a></li>
            <li class="sep"><img src="images/sizer.gif" alt="" width="1" height="1" /></li>
        </ul>
        <div id="logo"><a href="index.php"><img src="images/logo.gif" alt="Programador Autónomo" /></a></div>
		<div id="contenido">
           	<h1><img src="images/contacto.gif" alt="contacto" /></h1>
			<div class="formulario">
            	<br />
            	Hemos recibido su correo correctamente.<br />
                Nos pondremos en contacto con usted a la mayor brevedad posible.<br /><br />
                Atentamente,<br />
                <strong>Programador Autónomo</strong>
            </div>
            <div class="datos">
            	<br /><br />
            	<img src="images/mapamundo.gif" alt="Mapa Mundi" />
                <br /><br /><br />
                Teléfono de contacto: <strong>637 22 51 51</strong><br /><br />
                E-mail: <strong><a href="mailto:info@programadorautonomo.com">info@programadorautonomo.com</a></strong>
            </div>
            <br class="sep" />
		</div>
<? include "includes/inferior.php" ?>
	</div>
<? include "includes/googleanalytics.php" ?>
</body>
</html>
<? include "php/desconexion.php" ?>